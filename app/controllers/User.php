<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {

    public function __construct() {

        parent:: __construct();
        $this->call->model('users_model');
    }
	
    public function read() {

        $data ['users'] = $this->users_model->read();
        $data ['name'] = "LavaLust Framework";
        $this->call->view('users/display', $data);
    }

    public function create() {

        if($this->form_validation->submitted()) {
            
            if($this->form_validation->run()) {
                $last_name = $this->io->post('lastname');
                $first_name = $this->io->post('firstname');
                $email = $this->io->post('email');
                $gender = $this->io->post('gender');
                $address = $this->io->post('address');

                if($this->users_model->create($last_name, $first_name, $email, $gender, $address)) {
                    //success message
                    set_flash_alerts('success', 'User was added successfully');
                    redirect('users/add');
                }

            } else{
                //error message
                set_flash_alerts('danger', $this->form_validation->errors());
                redirect('users/add');
            }

           
        }
        $this->call->view('users/create');
    }

    public function update($id) {
        if($this->form_validation->submitted()) {
            
            if($this->form_validation->run()) {
                $last_name = $this->io->post('lastname');
                $first_name = $this->io->post('firstname');
                $email = $this->io->post('email');
                $gender = $this->io->post('gender');
                $address = $this->io->post('address');

                if($this->users_model->update($last_name, $first_name, $email, $gender, $address, $id)) {
                    //success message
                    set_flash_alerts('success', 'User was updated successfully');
                    redirect('users/read');
                }

            } else{
                //error message
                set_flash_alerts('danger', $this->form_validation->errors());
                redirect('users/read');
            }
        }
        $data['ui'] = $this->users_model->get_one($id);
        $this->call->view('users/update', $data);
    }

    public function delete($id) {
        if($this->users_model->delete($id)) {
            set_flash_alerts('success', 'User was deleted successfully');
            redirect('users/read');
        }else{
            set_flash_alerts('danger', 'Something went wrong');
            redirect('users/read');
        }
    }
}
?>
