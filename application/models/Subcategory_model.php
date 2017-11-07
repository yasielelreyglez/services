<?php

/**
 * Subcategory Model.
 */
class Subcategory_model extends CI_Model {

	# save $data on 'subcategory'
	function save($data) {
		
		$this->db->set('title', $data['title']);
		$this->db->set('icon', $data['icon']);
        $this->db->set('category_id', $data['category_id']);

		if($data['id'] == NULL) {
			$this->db->set('created_at', date('Y-m-d h:i:s',time()));
			$this->db->insert('subcategories');
		} else {
			$this->db->where('id', $data['id']);
			$this->db->set('updated_at', date('Y-m-d h:i:s',time()));
			$this->db->update('subcategories');
		}

		return $this->db->affected_rows();
	}

	# retrives $data from 'subcategory'
	function find($id = NULL) {
		if($id != NULL) {
			$this->db->where('id', $id);
			return $this->db->get('subcategories')->row();
		} else {
			return $this->db->get('subcategories')->result();
		}
	}

	# destroy $data from  'subcategory'
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('subcategories');

		return $this->db->affected_rows();
	}

}
