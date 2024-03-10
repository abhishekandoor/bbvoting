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
    
}