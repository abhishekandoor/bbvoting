<?php
class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('General');
        $this->load->model('Voting_Model','VM');
    }
    function index(){
        // echo 'helo'; die;
       

        $data =array();
        $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $data['week_name'] = $week_name = $week->week_name;
        $week_id = $week->id;
        $data['contestants'] = $this->VM->getNominatedContestantsByWeekId($week_id);
        $ipAddress = $this->input->ip_address();
        $data['page_title'] = 'Vote Your Favourite Contestant - '.$week_name;
        $data['today_vote_count'] = $this->hasVotedToday($ipAddress);
            // Check if the user has already voted today
            if ($data['today_vote_count'] == VOTE_LIMIT) {
            // User has already voted today, return an error message
                redirect('ml/Home/results');
            }

        // $html = '';
        // echo '<pre>'; print_r($data['contestants']); echo '</pre>'; die;
        $this->template->write_view("content",'ml/contestants', $data);
        $this->template->load();
    }
    function success_page(){
        $encoded_value = $this->input->post('encoded_value');
        $decoded_value = base64_decode($encoded_value);
        if($decoded_value == 2255){
            $this->template->write_view("content",'ml/success_page');
            $this->template->load();
        }else{
            redirect();
        }
    }
    function results(){
        // Check if the user has already voted today
        $ipAddress = $this->input->ip_address();
        $data =array();
        $data['today_vote_count'] = $this->hasVotedToday($ipAddress);

        if ($data['today_vote_count']) {
            // $data['contestants'] = $this->General->getdata('contestant','*');

            $data['week'] = $week_id = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
            $votes = $this->General->getdata('contestant_weekly_votes','contestant_id,vote_count',array('week_id'=>$week_id->id));
            $data['total_weekly_vote'] = $this->General->getrow('contestant_weekly_votes','sum(vote_count) as total_votes',array('week_id'=>$week_id->id))->total_votes;
            $data['votes_array'] = arrayKeySetter($votes,'contestant_id');
            $voted_contestant_ids = $this->General->getdata('vote_details','contestant_id',array('week_id'=>$week_id->id,'ip_address'=>$ipAddress));

            $data['voted_contestant_ids'] = array_map (function($value){
                return $value['contestant_id'];
            } , $voted_contestant_ids);
            $data['page_title'] = 'Result - '.$week_id->week_name;
            $data['top_trending'] = $this->VM->getTopTrending();
            $data['top_popular'] = $this->VM->getTopPopular();
            $data['top_gamers'] = $this->VM->getTopGamers();
            $data['contestants'] = $this->VM->getNominatedContestantsByWeekId($week_id->id);

            // echo '<pre>'; print_r($data['top_gamers']); echo '</pre>'; die;
            $currentDateTime = new DateTime(); // Get current datetime
            $interval = new DateInterval('PT210M'); // Create an interval of 210 minutes
            $currentDateTime->sub($interval); // Subtract the interval from the current datetime
            $data['last_updated'] = $currentDateTime->format('M d Y h:i A'); // Output the result in desired format with AM/PM indicator
            $this->template->write_view("content",'ml/results', $data);
            $this->template->load();
        }else{
            redirect('ml/Home');
            return;
        }
    }
    public function vote() {
        // Get the encrypted contestant ID and IP address from the AJAX request
        $encryptedContestantId = $this->input->post('contestant_id');
        $ipAddress = $this->input->ip_address();
    
        // Decrypt the contestant ID (assuming you're using base64 encoding)
        $contestantId = base64_decode($encryptedContestantId);
        
        // Check if the user has already voted today
        if ($this->hasVotedToday($ipAddress) == VOTE_LIMIT) {
            // User has already voted today, return an error message
            echo json_encode(array('status'=>'failed','message'=>'Sorry, you can only three vote per day.'));
            return;
        }
    
        // Record the vote in the database
        $week_id = $this->General->getrow('master_weeks','id',array('is_current'=>1))->id;
        $result = $this->VM->recordVote($contestantId, $ipAddress, $week_id);
        if ($result) {
            // Vote recorded successfully
            // Set a cookie to track the vote and prevent multiple votes from the same IP address
            setcookie('voted_' . $ipAddress, '1', time() + (86400), "/"); // Cookie expires in 24 hours
            echo json_encode(array('status'=>'success','message'=>'Vote recorded successfully'));
            return;
        } else {
            // Error recording vote
            echo json_encode(array('status'=>'error','message'=>'Something went wrong,Please Try Again Later'));
            return;
        }
    }
    
    // Function to check if the user has already voted today
    private function hasVotedToday($ipAddress) {
        // Check if a cookie exists for the user's IP address
        // if(isset($_COOKIE['voted_' . $ipAddress])){
        //     return true;
        // }else{
            $currentDate = date('Y-m-d');

            $week_id = $this->General->getrow('master_weeks','id',array('is_current'=>1))->id;
            $is_voted = $this->General->is_record_exists('vote_details','week_id='.$week_id.' and ip_address="'.$ipAddress.'" and DATE(voted_on) = "'.$currentDate.'"');
            return $is_voted;
        // }
    }

    private function isValidIpAddress($ipAddress) {
        // Implement your own logic to validate IP address (e.g., check format, blacklists, etc.)
        return true; // Return true for demonstration purposes
    }
    function aboutus(){

        $data =array();
        // $data['contestants'] = $this->General->getdata('contestants','*');
        $this->template->write_view("content",'ml/about-us', $data);
        $this->template->load();
        

    }

    function all_contestants(){
        $data =array();
        $data['page_title'] = 'All Contestants';

        $data['contestants'] = $this->General->getdata('contestant','*');
        $this->template->write_view("content",'ml/all_contestants', $data);
        $this->template->load();
    }
}