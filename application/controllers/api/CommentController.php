<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class CommentController extends \Restserver\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommentModel');
    }

    public function index_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users
        if ($id === NULL) {
            $comment = new CommentModel;
            $result_comment = $comment->get_comment();
            $this->response($result_comment, 200);
        } else {
            $id = (int)$id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $comment = new CommentModel;
            $result = $comment->findComment($id);

            if (!empty($result)) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Comment could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        $comment = new CommentModel;
        $data = [
            'comment' => $this->input->post('comment'),
            'post_id' => $this->input->post('post_id'),
            'user_id' => $this->input->post('user_id')
        ];
        $result = $comment->insertComment($data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Comment added'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to add Comment'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put($id)
    {
        $comment = new CommentModel;
        $data = [
            'comment' => $this->put('comment'),
            'post_id' => $this->put('post_id'),
            'user_id' => $this->put('user_id')
        ];
        echo $id;
        $result = $comment->updateComment($id, $data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'comment Updated'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Update Comment'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete($id)
    {
        $comment = new CommentModel;
        $result = $comment->deleteUser($id);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Comment Deleted'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Delete Comment'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

?>