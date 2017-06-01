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
      $ms = Membership::getAllUserMembershipOrganizations($id);

      View::make('usr/show.html', array('user' => $u, 'ms' => $ms));
    }

    public static function edit($id) {
      View::make('usr/edit.html');
    }

    public static function create() {
      $orgs = Organization::all();

      View::make('usr/new.html', array('orgs' => $orgs));
    }

    private static function createMemberships($params, $u_id) {
      $membership = new Membership(array(
        'usr_id' => $u_id,
        'organization_id' => $params['org']
      ));

      $membership->save();

      if ($params['org2'] != "null") {
        $membership2 = new Membership(array(
          'usr_id' => $u_id,
          'organization_id' => $params['org2']
        ));

        $membership2->save();
      }
    }

    public static function store(){
      $params = $_POST;

      $usr = new Usr(array(
        'name' => $params['name'],
        'password' => $params['password'],
        'admin' => "false"
      ));

      $usr->save();

      self::createMemberships($params, $usr->id);

      Redirect::to('/users/' . $usr->id, array('message' => 'Uuden käyttäjän luonti onnistui!'));
    }


  }
