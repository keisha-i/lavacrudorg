<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Users_model extends Model {
	
    public function read() {

        return $this->db->table('kjur_users')->get_all();
    }

    public function create($kjur_last_name, $kjur_first_name, $kjur_email, $kjur_gender, $kjur_address) {
        $data = array(
            'kjur_last_name' => $kjur_last_name,
            'kjur_first_name' => $kjur_first_name,
            'kjur_email' => $kjur_email,
            'kjur_gender' => $kjur_gender,
            'kjur_address' => $kjur_address
        );

        return $this->db->table('kjur_users')->insert($data);

    }

    public function get_one($id) {
        return $this->db->table('kjur_users')->where('id', $id)->get();
    }

    public function update($kjur_last_name, $kjur_first_name, $kjur_email, $kjur_gender, $kjur_address, $id) {
        $data = array(
            'kjur_last_name' => $kjur_last_name,
            'kjur_first_name' => $kjur_first_name,
            'kjur_email' => $kjur_email,
            'kjur_gender' => $kjur_gender,
            'kjur_address' => $kjur_address
        );

        return $this->db->table('kjur_users')->where('id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table('kjur_users')->where('id', $id)->delete();
    }

    public function get_users_with_pagination($limit, $offset) {
        return $this->db->table('kjur_users')
                        ->limit($limit)
                        ->offset($offset)
                        ->get_all();
    }
    
    public function get_total_users() {
        $this->db->from('kjur_users');  // Replace 'kjur_users' with your table name
        return $this->db->count_all_results();  // Get the total row count
    }      

}
?>
