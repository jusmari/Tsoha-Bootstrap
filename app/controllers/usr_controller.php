<?php

  class UsrController extends BaseController{

    public static function index(){
      if (self::get_user_logged_in()) Redirect::to('/lobby');

   	  View::make('home.html');
    }

    public static function lobby() {
      View::make('lobby.html');
    }

    public static function login(){
   	  View::make('usr/login.html');
    }

    public static function logout(){
      $_SESSION['user'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
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
      $usr = Usr::find($id);
      $orgs = Organization::all();

      View::make('usr/edit.html', array('user' => $usr, 'orgs' => $orgs));
    }

    public static function create($attrs = false, $errors = false) {
      $orgs = Organization::all();

      if($attrs) {
        View::make('usr/new.html', array('orgs' => $orgs, 'attrs' => $attrs, 'errors' => $errors));
      } else {
        View::make('usr/new.html', array('orgs' => $orgs));
      }
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
      $attributes = array(
        'name' => $params['name'],
        'password' => $params['password']
      );

      $usr = new Usr($attributes);

      $errors = $usr->errors();

      if ($params['password'] != $params['passwordConfirmation']) {
        $errors[] = "Antamasi salasanat eivät täsmää";
      }

      if (count($errors) == 0) {
        $usr->save();

        self::createMemberships($params, $usr->id);

        Redirect::to('/users/' . $usr->id, array('message' => 'Uuden käyttäjän luonti onnistui!'));
      } else {
        self::create($attributes, $errors);
      }
    }

    public static function update($id) {
      $params = $_POST;

      $attrs = array(
        'id' => $id,
        'name' => $params['name'],
        'password' => $params['password']
      );

      if (isset($params['admin'])) $attrs['admin'] = TRUE;

      $q = new Usr($attrs);
      $errors = $q->errors();

      if (count($errors) == 0) {
        $q->update();

        Membership::deleteMembershipsFromUser($id);
        self::createMemberships($params, $id);

        Redirect::to('/users/' . $q->id, array('message' => "Käyttäjän tiedot on päivitetty onnistuneesti!"));
      } else {
        $orgs = Organization::all();

        View::make('usr/edit.html', array('errors' => $errors, 'user' => $q, 'orgs' => $orgs));
      }
    }

    public static function destroy($id) {
      $q = new Usr(array('id' => $id));
      $q->destroy($id);

      Redirect::to('/users', array('message' => "Käyttäjän poisto onnistunut!"));
    }

    public static function handle_login() {
      $params = $_POST;

      $user = Usr::authenticate($params['username'], $params['password']);

      if(!$user){
        View::make('home.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
      }else{
        $_SESSION['user'] = $user->id;

        Redirect::to('/lobby', array('message' => 'Tervetuloa, ' . $user->name . '!'));
      }
    }
  }
