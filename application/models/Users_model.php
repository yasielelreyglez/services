<?php

/**
 * Users Model.
 */
class Users_model extends CI_Model {

	# save $data on 'users'
	function save($data) {
		
		$this->db->set('username', $data['username']);
		$this->db->set('email', $data['email']);
		$this->db->set('password', $data['password']);
		$this->db->set('created', $data['created']);
		$this->db->set('role', $data['role']);

		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('users');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('users');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'users'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('users')->row();
		} else {
			return $this->db->get('users')->result();
		}
	}

	# destroy $data from  'users'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('users');

		return $this->db->affected_rows();
	}

}
