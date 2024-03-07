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
        $data['contestants'] = $this->General->getdata('contestant','*');

        // $html = '';
        // echo '<pre>'; print_r($data['contestants']); echo '</pre>'; die;
        $this->template->write_view("content",'ml/contestants', $data);
        $this->template->load();
    }
    function results(){
        $data =array();
        $data['contestants'] = $this->General->getdata('contestant','*');
        $data['week'] = $week_id = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $votes = $this->General->getdata('contestant_weekly_votes','contestant_id,vote_count',array('week_id'=>$week_id->id));
        $data['total_weekly_vote'] = $this->General->getrow('contestant_weekly_votes','sum(vote_count) as total_votes',array('week_id'=>$week_id->id))->total_votes;
        $data['votes_array'] = arrayKeySetter($votes,'contestant_id');

        $this->template->write_view("content",'ml/results', $data);
        $this->template->load();
    }
    public function vote() {
        // Get the encrypted contestant ID and IP address from the AJAX request
        $encryptedContestantId = $this->input->post('contestant_id');
        $ipAddress = $this->input->ip_address();

        // Decrypt the contestant ID (assuming you're using base64 encoding)
        $contestantId = base64_decode($encryptedContestantId);

        // Validate the IP address (you can implement your own validation logic here)
        if ($this->isValidIpAddress($ipAddress)) {
            // Record the vote in the database
            $week_id = $this->General->getrow('master_weeks','id',array('is_current'=>1))->id;
            $result = $this->VM->recordVote($contestantId, $ipAddress,$week_id);
            if ($result) {
                // Vote recorded successfully
                echo "Vote recorded successfully";
            } else {
                // Error recording vote
                echo "Error recording vote";
            }
        } else {
            // Invalid IP address
            echo "Invalid IP address";
        }
    }

    private function isValidIpAddress($ipAddress) {
        // Implement your own logic to validate IP address (e.g., check format, blacklists, etc.)
        return true; // Return true for demonstration purposes
    }
}