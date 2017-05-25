<?php

  class UsrController extends BaseController{

    public static function login(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('usr/login.html');
    }

    public static function list() {
      View::make('usr/list.html');
    }
  }
