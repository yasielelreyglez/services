<?php

/**
 * Positions Model.
 */
class Positions_model extends CI_Model {

	# save $data on 'positions'
	function save($data) {
		
		$this->db->set('title', $data['title']);
		$this->db->set('latitude', $data['latitude']);
		$this->db->set('longitude', $data['longitude']);

		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('positions');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('positions');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'positions'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('positions')->row();
		} else {
			return $this->db->get('positions')->result();
		}
	}

	# destroy $data from  'positions'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('positions');

		return $this->db->affected_rows();
	}

}
