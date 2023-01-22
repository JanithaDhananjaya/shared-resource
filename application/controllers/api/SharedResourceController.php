<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'Libraries/REST_Controller.php';

class SharedResourceController extends \Restserver\Libraries\REST_Controller
{
    public function index_get()
    {
        echo "I am Restfull API";
    }
}

?>