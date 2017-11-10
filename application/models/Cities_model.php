<?php

/**
 * Cities Model.
 */
class Cities_model extends CI_Model {

	# save $data on 'cities'
	function save($data) {
		
		$this->db->set('title', $data['title']);

		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('cities');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('cities');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'cities'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('cities')->row();
		} else {
			return $this->db->get('cities')->result();
		}
	}

	# destroy $data from  'cities'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('cities');

		return $this->db->affected_rows();
	}

}
