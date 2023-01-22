<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class UserController extends \Restserver\libraries\REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users
        if ($id === NULL) {
            $user = new UserModel;
            $result_user = $user->get_user();
            $this->response($result_user, 200);
        } else {
            $id = (int)$id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $user = new UserModel;
            $result = $user->findUser($id);

            if (!empty($result)) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        $user = new UserModel;
        $data = [
            'username' => $this->input->post('username'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ];
        $result = $user->insertUser($data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'New User Created'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Create User'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put($id)
    {
        $user = new UserModel;
        $data = [
            'username' => $this->put('username'),
            'first_name' => $this->put('first_name'),
            'last_name' => $this->put('last_name'),
            'email' => $this->put('email'),
            'password' => $this->put('password')
        ];
        echo $id;
        $result = $user->updateUser($id, $data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'User Updated'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Update User'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete($id)
    {
        $user = new UserModel;
        $result = $user->deleteUser($id);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'User Deleted'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Delete User'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}

?>