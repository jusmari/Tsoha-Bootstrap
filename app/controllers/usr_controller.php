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

    public static function create() {
      View::make('usr/new.html')
    }

    public static function store(){
      $params = $_POST;

      $ret = new Usr(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));

      $ret->save();

      Redirect::to('/users/' . $ret->id, array('message' => 'Uuden käyttäjän luonti onnistui!'));
    }
  }
