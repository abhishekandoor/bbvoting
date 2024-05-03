<?php

class Voting_Model extends CI_Model
{
	   
	public function __construct(){
		parent::__construct();
		$this->load->library('AdminLib');
        $this->load->model('General','GM');
	}	

	public function recordVote($contestantId, $ipAddress,$weekId){

        $this->db->trans_start();

        //contastants total vote increament
        $this->db->set('total_vote', 'total_vote+1', FALSE); // Increment the 'votes' column by 1
        $this->db->where('id', $contestantId);
        $this->db->update('contestant'); // Assuming 'contestants' is the name of your table


        //contestant_weekly_votes insertion/vote count updation
        // Check if a record already exists for the contestant and week
        $existingRecord = $this->db->get_where('contestant_weekly_votes', array('contestant_id' => $contestantId, 'week_id' => $weekId))->row();

        if ($existingRecord) {
            // Update the existing record
            $this->db->where('id', $existingRecord->id);
            $this->db->set('vote_count', 'vote_count+1', FALSE);
            $this->db->update('contestant_weekly_votes');
        } else {
            // Insert a new record
            $data = array(
                'contestant_id' => $contestantId,
                'vote_count' => 1, // Initialize vote count to 1
                'week_id' => $weekId
            );
            $this->db->insert('contestant_weekly_votes', $data);
        }


        //contestant_daily_votes insertion/vote count updation
        // Check if a record already exists for the contestant and week
        $currentDate = date('Y-m-d');

        $existingRecord = $this->db->get_where('contestant_daily_votes', array('contestant_id' => $contestantId, 'week_id' => $weekId,'date'=>$currentDate))->row();

        if ($existingRecord) {
            // Update the existing record
            $this->db->where('id', $existingRecord->id);
            $this->db->set('vote_count', 'vote_count+1', FALSE);
            $this->db->update('contestant_daily_votes');
        } else {
            // Insert a new record
            $data = array(
                'contestant_id' => $contestantId,
                'vote_count' => 1, // Initialize vote count to 1
                'week_id' => $weekId,
                'date'=>$currentDate
            );
            $this->db->insert('contestant_daily_votes', $data);
        }

        //vote_details  entry
        $data = array(
            'contestant_id' => $contestantId,
            'week_id' => $weekId,
            'voted_on' => date('Y-m-d H:i:s'),
            'ip_address' => $ipAddress
        );

        $this->db->insert('vote_details', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            return 1;
        }
    }

    public function update_counters($counters) {
        $this->db->trans_start();

        $week = $this->General->getrow('master_weeks','id,week_name',array('is_current'=>1));
        $weekId = $week->id;
        foreach ($counters as $contestantId => $counter) {

             //contastants total vote increament
            $this->db->set('total_vote', 'total_vote+'.(int)$counter, FALSE); // Increment the 'votes' column by 1
            $this->db->where('id', $contestantId);
            $this->db->update('contestant'); // Assuming 'contestants' is the name of your table


            //contestant_weekly_votes insertion/vote count updation
            // Check if a record already exists for the contestant and week
            $existingRecord = $this->db->get_where('contestant_weekly_votes', array('contestant_id' => $contestantId, 'week_id' => $weekId))->row();

            if ($existingRecord) {
                // Update the existing record
                $this->db->where('id', $existingRecord->id);
                $this->db->set('vote_count', 'vote_count+'.(int)$counter, FALSE);
                $this->db->update('contestant_weekly_votes');
            } else {
                // Insert a new record
                $data = array(
                    'contestant_id' => $contestantId,
                    'vote_count' => 1, // Initialize vote count to 1
                    'week_id' => $weekId
                );
                $this->db->insert('contestant_weekly_votes', $data);
            }


            //contestant_daily_votes insertion/vote count updation
            // Check if a record already exists for the contestant and week
            $currentDate = date('Y-m-d');

            $existingRecord = $this->db->get_where('contestant_daily_votes', array('contestant_id' => $contestantId, 'week_id' => $weekId,'date'=>$currentDate))->row();

            if ($existingRecord) {
                // Update the existing record
                $this->db->where('id', $existingRecord->id);
                $this->db->set('vote_count', 'vote_count+'.(int)$counter, FALSE);
                $this->db->update('contestant_daily_votes');
            } else {
                // Insert a new record
                $data = array(
                    'contestant_id' => $contestantId,
                    'vote_count' => 1, // Initialize vote count to 1
                    'week_id' => $weekId,
                    'date'=>$currentDate
                );
                $this->db->insert('contestant_daily_votes', $data);
            }



        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            return 1;
        }
    }

    function getTopTrending(){
        $this->db->select('name,trending_number,photo_url');
        $this->db->from('top_trending as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->order_by('trending_number');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getTopPopular(){
        $this->db->select('name,popular_number,photo_url');
        $this->db->from('top_popular as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->order_by('popular_number');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getTopGamers(){
        $this->db->select('name,position_number,photo_url');
        $this->db->from('top_gamers as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->order_by('position_number');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getNominatedContestantsByWeekId($week_id){
        $this->db->select('C.name,C.profession,C.id,C.photo_url,CV.vote_count');
        $this->db->from('contestant_weekly_votes as CV');
        $this->db->join('contestant as C','C.id = CV.contestant_id');
        $this->db->where('CV.week_id',$week_id);
        $this->db->where_not_in('C.status',array(2,4));
        $this->db->order_by('vote_count','desc');
        $data = $this->db->get()->result_array();
        //echo '<pre>'; print_r($data); echo '</pre>'; die;
        return $data;

    }

    function getNominatedContestants(){
        $this->db->select('C.name,C.profession,C.id,C.photo_url');
        $this->db->from('contestant_weekly_votes as CV');
        $this->db->join('contestant as C','C.id = CV.contestant_id');
        $this->db->order_by('vote_count','desc');
        $this->db->group_by('C.id');
        $data = $this->db->get()->result_array(); 
        return $data;
    }

    function getCaptaincyTaskResult(){
        $this->db->select('name,photo_url');
        $this->db->from('task_results as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.task_type',1);
        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getWeeklyTaskResult(){
        $this->db->select('name,photo_url');
        $this->db->from('task_results as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.task_type',2);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getDailyTaskResult(){
        $this->db->select('name,photo_url,day');
        $this->db->from('task_results as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.task_type',3);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function getKitchenTeam(){
        $this->db->select('name,photo_url,is_power_team');
        $this->db->from('team_details as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.type',1);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function getVesselTeam(){
        $this->db->select('name,photo_url,is_power_team');
        $this->db->from('team_details as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.type',2);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function getHouseCleaning(){
        $this->db->select('name,photo_url,is_power_team');
        $this->db->from('team_details as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.type',3);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }
    function getToiletCleaning(){
        $this->db->select('name,photo_url,is_power_team');
        $this->db->from('team_details as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        $this->db->where('T.is_active',1);
        $this->db->where('T.type',4);

        $this->db->order_by('T.id');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getPowerTeam(){
        $this->db->select('name,photo_url,week_id');
        $this->db->from('bedroom_teams as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);
        $this->db->where('T.type',1);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
    function getBedRoomTeam($type){
        $this->db->select('name,photo_url,week_id,C.id');
        $this->db->from('bedroom_teams as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);
        $this->db->where('T.type',$type);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
    function getWorkingTeam($type){
        $this->db->select('name,photo_url,week_id,C.id');
        $this->db->from('working_team as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);
        $this->db->where('T.type',$type);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
   
    function getEvictedContestants(){
        $this->db->select('name,photo_url,week_id');
        $this->db->from('evition_details as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
    function getJailContestants(){
        $this->db->select('name,photo_url,week_id');
        $this->db->from('jail_contestants as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
    function getCptainsByType($type=0){
        $this->db->select('name,photo_url,week_id');
        $this->db->from('weekly_captain as T');
        $this->db->join('contestant as C','C.id = T.contestant_id');
        // $this->db->where('T.is_active',1);
        $this->db->where('T.type',$type);

        $this->db->order_by('week_id','desc');
        $data = $this->db->get()->result_array();
        $new_data = nestedArrayKeySetter($data,'week_id');
        //echo '<pre>'; print_r($new_data); echo '</pre>'; die;
        return $new_data;
    }
    function getWeeklyWiseVotes(){
        
// Assuming $this->General->getrow() retrieves data from your database
// Adjust the query based on your database structure
$this->db->select('week_id, SUM(vote_count) as total_votes');
$this->db->from('contestant_weekly_votes');
$this->db->group_by('week_id');
$result = $this->db->get()->result_array();

return $result;
        //echo '<pre>'; print_r($result); echo '</pre>'; die;


    }



}