<?php

  class UsrController extends BaseController{

    public static function index(){
   	  View::make('home.html');
    }

    public static function login(){
   	  View::make('usr/login.html');
    }

    public static function list() {
      $u = Usr::all();

      View::make('usr/list.html', array('users' => $u));
    }

    public static function show($id) {
      $u = Usr::find($id);

      View::make('usr/show.html', array('user' => $u));
    }

    public static function edit($id) {
      View::make('usr/edit.html');
    }

    public static function create() {
      View::make('usr/new.html');
    }

    public static function store(){
      $params = $_POST;

      $ret = new Usr(array(
        'name' => $params['name'],
        'password' => $params['password'],
        'admin' => "false"
      ));

      $ret->save();

      Redirect::to('/users/' . $ret->id, array('message' => 'Uuden käyttäjän luonti onnistui!'));
    }
  }
