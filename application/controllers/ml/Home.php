<?php
class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
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
            if ($data['today_vote_count'] == VOTE_LIMIT || VOTE_LIMIT == 0) {
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

        if ($data['today_vote_count'] || VOTE_LIMIT == 0) {
            // $data['contestants'] = $this->General->getdata('contestant','*');

            $data['week'] = $week_id = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
            $votes = $this->General->getdata('contestant_weekly_votes','contestant_id,vote_count,week_id','','week_id DESC');
            $data['votes_array'] = nestedArrayKeySetter($votes,'week_id');

            // echo '<pre>'; print_r($data['votes_array']); echo '</pre>'; die;

            $data['total_current_weekly_vote'] = $this->General->getrow('contestant_weekly_votes','sum(vote_count) as total_votes,week_id',array('week_id'=>$week_id->id))->total_votes;

            $data['total_weekly_vote'] = $this->General->getrow('contestant_weekly_votes','sum(vote_count) as total_votes,week_id')->total_votes;

            //echo $data['total_weekly_vote']; die;
            // echo '<pre>'; print_r($data['total_weekly_vote']); echo '</pre>'; die;
            // $data['total_weekly_vote'] = arrayKeySetter($votes,'contestant_id');
            $voted_contestant_ids = $this->General->getdata('vote_details','contestant_id',array('week_id'=>$week_id->id,'ip_address'=>$ipAddress));

            $data['voted_contestant_ids'] = array_map (function($value){
                return $value['contestant_id'];
            } , $voted_contestant_ids);
            $data['page_title'] = 'Result - '.$week_id->week_name;
            // $data['top_trending'] = $this->VM->getTopTrending();
            // $data['top_popular'] = $this->VM->getTopPopular();
            // $data['top_gamers'] = $this->VM->getTopGamers();
            // $data['contestants'] = $this->VM->getNominatedContestantsByWeekId($week_id->id);
            $Nominatedcontestants = $this->VM->getNominatedContestantsByWeekId($week_id->id);


            $contestants = $this->VM->getNominatedContestants();

           //echo '<pre>'; print_r($week_id->id); echo '</pre>'; die; 
            $weeklyvotes= $this->VM->getWeeklyWiseVotes();
            $data['weeklyvotes'] = arrayKeySetter($weeklyvotes,'week_id');
            // echo '<pre>'; print_r($data ); echo '</pre>'; die;
            
            $data['Nominatedcontestants'] = arrayKeySetter($Nominatedcontestants,'id');
            $data['contestants'] = arrayKeySetter($contestants,'id');

            $currentDateTime = new DateTime(); // Get current datetime
            $interval = new DateInterval('PT210M'); // Create an interval of 210 minutes
            $currentDateTime->sub($interval); // Subtract the interval from the current datetime
            $data['last_updated'] = $currentDateTime->format('M d Y h:i A'); // Output the result in desired format with AM/PM indicator
            // echo '<pre>'; print_r($data['weeklyvotes']); echo '</pre>'; die;
            
            $this->template->write_view("content",'ml/results', $data);
            $this->template->load();
        }else{
            redirect('ml/Home');
            return;
        }
    }
    function go_back(){
        $ipAddress = $this->input->ip_address();
        $data['today_vote_count'] = $this->hasVotedToday($ipAddress);
        if ($data['today_vote_count'] < VOTE_LIMIT) {
            redirect('ml/Home');
        }elseif($data['today_vote_count'] == VOTE_LIMIT || VOTE_LIMIT == 0){
            redirect('ml/Home/dashboard');
        }
    }
    public function vote() {
        // Get the encrypted contestant ID and IP address from the AJAX request
        $encryptedContestantId = $this->input->post('contestant_id');
        $ipAddress = $this->input->ip_address();
        if (!$this->input->is_ajax_request()) {
            // This request is not initiated from a web browser, so reject it
            show_error('Access Forbidden', 403); // You can customize the error message and code
            return;
        }
        if (empty($_SERVER['HTTP_REFERER'])) {
            // HTTP_REFERER is not set, indicating the request may not be from a browser
            show_error('Access Forbidden', 403); // You can customize the error message and code
            return;
        }
    
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

        $data['contestants'] = $this->General->getdata('contestant','*','','status');
        $this->template->write_view("content",'ml/all_contestants', $data);
        $this->template->load();
    }

    function task_results(){
        $data =array();
        $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $data['week_name'] = $week_name = $week->week_name;
        $data['page_title'] = 'Captaincy Task - '.$week_name;

        $data['captaincy_task'] = $this->VM->getCaptaincyTaskResult();
        $data['weekly_task'] = $this->VM->getWeeklyTaskResult();
        $data['daily_task'] = $this->VM->getDailyTaskResult();

        // echo '<pre>'; print_r($data['daily_task']); echo '</pre>'; die;

        $data['contestants'] = $this->General->getdata('contestant','*');
        $this->template->write_view("content",'ml/task_results', $data);
        $this->template->load();
    }
    function team_details(){
        $data =array();
        $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $data['week_name'] = $week_name = $week->week_name;
        $data['page_title'] = ' Teams';

        // $data['kitchen_team'] = $this->VM->getKitchenTeam();
        // $data['vessel_team'] = $this->VM->getVesselTeam();
        // $data['house_cleaning'] = $this->VM->getHouseCleaning();
        // $data['toilet_cleaning'] = $this->VM->getToiletCleaning();


         //echo '<pre>'; print_r($data['kitchen_team']); echo '</pre>'; die;

        $data['contestants'] = $this->General->getdata('contestant','*');
        $this->template->write_view("content",'ml/team_details', $data);
        $this->template->load();
    }
    function power_team(){
        $data =array();
        $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');
        // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
        $data['week_name'] = $week_name = $week->week_name;
        $data['page_title'] = 'Power Team';
        $data['contestants'] = $this->VM->getPowerTeam();
        $data['all_weeks'] = $all_weeks;

        $this->template->write_view("content",'ml/power_team', $data);
        $this->template->load();
    }

function other_bedroom_team($type){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');
    // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
    $data['week_name'] = $week_name = $week->week_name;
    if($type==2){
         $data['page_title'] = 'Nest Team';
    }elseif($type==3){
        $data['page_title'] = 'Den Team';
    }  elseif($type==4){
        $data['page_title'] = 'Tunnel Team';
   }

    $data['contestants'] = $this->VM->getBedRoomTeam($type);
    $data['all_weeks'] = $all_weeks;

    $this->template->write_view("content",'ml/power_team', $data);
    $this->template->load();
}


function working_team($type){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');
    // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
    $data['week_name'] = $week_name = $week->week_name;
    if($type==1){
        $data['page_title'] = 'Cooking Team';
    }elseif($type==2){
         $data['page_title'] = 'Vessel Cleaning Team';
    }elseif($type==3){
        $data['page_title'] = 'House Cleanig Team';
    }  elseif($type==4){
        $data['page_title'] = 'Toilet Cleaning Team';
   }

    $data['contestants'] = $this->VM->getWorkingTeam($type);
    $data['all_weeks'] = $all_weeks;
    $data['type'] = $type;


    $this->template->write_view("content",'ml/working_team', $data);
    $this->template->load();
}

// function z_confedtial_login_user_aget(){
        
// }

function z_confedtial_login_user_dashboard(){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $data['week_name'] = $week_name = $week->week_name;
    $week_id = $week->id;
    $data['contestants'] = $this->VM->getNominatedContestantsByWeekId($week_id);
    $this->template->write_view("content",'ml/z_vote', $data);
    $this->template->load();
}
public function z_confedtial_login_user_save() {
    $counters = $this->input->post('counters');
    $error = false;

    foreach ($counters as $contestant_id => $counter) {
        if (!is_numeric($counter)) {
            $error = true;
            break;
        }
    }

    if ($error) {
        echo "Error: Please enter a number for all counters.";
    } else {
        $result = $this->VM->update_counters($counters);
        if($result == 1){
            echo "Counters saved successfully!";
        }else{
            echo "Error,Not Saved";
        }
    }
}


function eviction(){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $all_weeks = $this->General->getdata('master_weeks','id,week_name,is_current,has_eviction',array('id <='=>$week->id),'id desc');
    // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
    $data['week_name'] = $week_name = $week->week_name;
    $data['page_title'] = 'Evicted Contestants';
    $data['contestants'] = $this->VM->getEvictedContestants();
    $data['all_weeks'] = $all_weeks;

    $this->template->write_view("content",'ml/evicted_contestants', $data);
    $this->template->load();
}
function jail(){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');
    // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
    $data['week_name'] = $week_name = $week->week_name;
    $data['page_title'] = 'Weekly Prisoners';
    $data['contestants'] = $this->VM->getJailContestants();
    $data['all_weeks'] = $all_weeks;

    $this->template->write_view("content",'ml/jail_contestants', $data);
    $this->template->load();
}

function dashboard(){
    $data =array();
    $data['page_title'] = ' Dashboard';
    $this->template->write_view("content",'ml/dashboard', $data);
    $this->template->load();
}

function captain_details(){
    $data =array();
    $data['page_title'] = 'Captain Details';

    // $data['contestants'] = $this->General->getdata('contestant','*','','status');
    $data['house_captains'] = $this->VM->getCptainsByType();
    //$data['kitchen_captain'] = $this->VM->getCptainsByType(1);
   // $data['vessel_captain'] = $this->VM->getCptainsByType(2);
    //$data['floor_captain'] = $this->VM->getCptainsByType(3);
    //$data['bathroom_captain'] = $this->VM->getCptainsByType(4);
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));

    $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');

    $data['all_weeks'] = $all_weeks;

    $this->template->write_view("content",'ml/captains', $data);
    $this->template->load();
}


function  profile(){
    $data =array();
    $data['page_title'] = 'Profile';

    $this->template->write_view("content",'ml/profile', $data);
    $this->template->load();
}

function peoples_room(){
    $data =array();
    $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
    $all_weeks = $this->General->getdata('master_weeks','id,week_name',array('id <='=>$week->id),'id desc');
    // echo '<pre>'; print_r($all_weeks); echo '</pre>'; die;
    $data['week_name'] = $week_name = $week->week_name;
    $data['page_title'] = "People's Room";
    $data['contestants'] = $this->VM->getPeoplesRoom();
    $data['all_weeks'] = $all_weeks;

    $this->template->write_view("content",'ml/peoples_room', $data);
    $this->template->load();
}







}