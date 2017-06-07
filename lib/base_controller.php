<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        $user = Usr::find($user_id);

        return $user;
      }

      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])) {
          Redirect::to('/login', array('error' => 'You must be logged in to access this page'));
      }
    }

    public static function check_user_admin() {
      $usr = self::get_user_logged_in();

      if ($usr->admin != TRUE) {
          Redirect::to('/login', array('error' => 'You must be logged as admin to access this page'));
      }
    }
  }
