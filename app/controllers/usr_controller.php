<?php

  class UsrController extends BaseController{

    public static function index(){
   	  View::make('home.html');
    }

    public static function login(){
   	  View::make('usr/login.html');
    }

    public static function list() {
      View::make('usr/list.html');
    }

    public static function show($id) {
      View::make('usr/show.html');
    }

    public static function edit($id) {
      View::make('usr/edit.html');
    }
  }
