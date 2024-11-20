<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');



class User extends  Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('users_model');
    }

    // Fetch all users
    public function read() {
        $page = $this->input->get('page') ?? 1;
        $limit = $this->input->get('limit') ?? 10;
        $offset = ($page - 1) * $limit;
        
        // Get the user data with pagination
        $users = $this->users_model->get_users_with_pagination($limit, $offset);
        
        // Get the total number of users for pagination calculation
        $totalUsers = $this->users_model->get_total_users();
        
        // Calculate total pages
        $totalPages = ceil($totalUsers / $limit);
        
        // Return the data in JSON format
        echo json_encode([
            'users' => $users,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }
    


    

    // Create a new user
    public function create() {
        if($this->form_validation->submitted() && $this->form_validation->run()) {
            $last_name = $this->io->post('lastname');
            $first_name = $this->io->post('firstname');
            $email = $this->io->post('email');
            $gender = $this->io->post('gender');
            $address = $this->io->post('address');
    
            if($this->users_model->create($last_name, $first_name, $email, $gender, $address)) {
                echo json_encode(['status' => 'success', 'message' => 'User was added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add user']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->form_validation->errors()]);
        }
    }
    

    // Update a user
    public function update($id) {
        if($this->form_validation->submitted()) {
    
            if($this->form_validation->run()) {
                $last_name = $this->io->post('lastname');
                $first_name = $this->io->post('firstname');
                $email = $this->io->post('email');
                $gender = $this->io->post('gender');
                $address = $this->io->post('address');
    
                if($this->users_model->update($last_name, $first_name, $email, $gender, $address, $id)) {
                    // Respond with success
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'User updated successfully!'
                    ]);
                } else {
                    // Respond with error
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Something went wrong, please try again.'
                    ]);
                }
            } else {
                // Respond with form validation error
                echo json_encode([
                    'status' => 'error',
                    'message' => $this->form_validation->errors()
                ]);
            }
        }
    }
    
    

    // Delete a user
    public function delete($id) {
        if($this->users_model->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'User was deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
        }
    }
    

    // Get a single user
    public function get_user($id) {
        $user = $this->users_model->get_one($id);
        echo json_encode($user);
    }
}
?>
