<?php

/**
 * Subcategory Model.
 */
class Category_model extends CI_Model {

	# save $data on 'subcategory'
	function save($data) {
		
		$this->db->set('title', $data['title']);
		$this->db->set('icon', $data['icon']);


		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('categories');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('categories');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'subcategory'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('categories')->row();
		} else {
			return $this->db->get('categories')->result();
		}
	}

	# destroy $data from  'subcategory'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('categories');

		return $this->db->affected_rows();
	}

}
