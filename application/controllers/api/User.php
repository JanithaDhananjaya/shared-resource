<?php

    require APPPATH.'libraries/REST_Controller.php';

    class User extends REST_Controller{



    /*
        INSERT: POST REQUEST TYPE
        UPDATE: PUT REQUEST TYPE
        DELETE: DELETE REQUEST TYPE
        LIST: GET REQUEST TYPE
    */

    public function index_post(){

        echo "This is POST Method";
    }

    }


?>