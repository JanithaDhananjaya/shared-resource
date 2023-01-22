<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class PostController extends \Restserver\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PostModel');
    }

    public function index_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the posts
        if ($id === NULL) {
            $post = new PostModel;
            $result_post = $post->get_post();
            $this->response($result_post, 200);
        } else {
            $id = (int)$id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $post = new PostModel;
            $result = $post->findPost($id);

            if (!empty($result)) {
                $this->set_response($result, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Post could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }

    public function index_post()
    {
        $post = new PostModel;
        $data = [
            'image' => $this->input->post('image'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'user_id' => $this->input->post('user_id')
        ];
        $result = $post->addPost($data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'New Post Created'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Create Post'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put($id)
    {
        $post = new PostModel;
        $data = [
            'image' => $this->input->post('image'),
            'title' => $this->put('username'),
            'description' => $this->put('description'),
            'user_id' => $this->put('user_id')
        ];
        echo $id;
        $result = $post->updatePost($id, $data);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Post Updated'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Update Post'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete($id)
    {
        $post = new PostModel;
        $result = $post->deletePost($id);
        if ($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Post Deleted'
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to Delete Post'
            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}