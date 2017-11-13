<?php

/**
 * Service Model.
 */
class Service_model extends CI_Model {

	# save $data on 'showservice'
	function save($data) {
		
		$this->db->set('title', $data['title']);
		$this->db->set('subtitle', $data['subtitle']);
		$this->db->set('phone', $data['phone']);
		$this->db->set('address', $data['address']);
		$this->db->set('other_phone', $data['other_phone']);
		$this->db->set('email', $data['email']);
		$this->db->set('url', $data['url']);
		$this->db->set('week_days', $data['week_days']);
		$this->db->set('start_time', $data['start_time']);
		$this->db->set('end_time', $data['end_time']);
		$this->db->set('visits', $data['visits']);

		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('showservice');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('showservice');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'showservice'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('showservice')->row();
		} else {
			return $this->db->get('showservice')->result();
		}
	}

	# destroy $data from  'showservice'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('showservice');

		return $this->db->affected_rows();
	}

}
