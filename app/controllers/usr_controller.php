<?php

  class UsrController extends BaseController{

    public static function index(){
      if (self::get_user_logged_in()) Redirect::to('/lobby');

   	  View::make('home.html');
    }

    public static function lobby() {
      $id = self::get_user_logged_in()->id;
      $user_answers = Answer::getAllUserAnswers($id);
      if (count($user_answers) == 0) $user_answers = NULL;

      $ans_percentage = Answer::getUserAnswerPercentage($id);

      View::make('lobby.html', array('stats' => $user_answers, 'percentage' => round($ans_percentage)));
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
      $memberships = Membership::getAllUserMembershipOrganizations($id);
      $org = $memberships[0];
      $org2 = null;
      if (isset($memberships[1])) $org2 = $memberships[1];

      View::make('usr/edit.html', array('user' => $usr, 'orgs' => $orgs, 'org' => $org, 'org2' => $org2));
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

      $attributes = array(
        'name' => $params['username'],
        'password' => $params['password'],
        'email' => $params['email']
      );

      $usr = new Usr($attributes);

      $errors = $usr->errors();

      if ($params['password'] != $params['passwordConfirmation']) {
        $errors[] = "Antamasi salasanat eivät täsmää";
      }

      if (Usr::checkUniqueUsername($params['username'])) {
        $errors[] = "Käyttäjänimi on jo käytössä!";
      }

      if (count($errors) == 0) {
        $usr->save();

        self::createMemberships($params, $usr->id);

        self::handle_login();
      } else {

        Redirect::to('/register', array('errors' => $errors, 'atrs' => $params));
      }
    }

    public static function update($id) {
      $params = $_POST;
      $oldUser = Usr::find($id);
      $passwordChanged = FALSE;

      $oldUser->name = $params['name'];

      if (!$oldUser->admin) {
        $oldUser->admin = (isset($params['admin'])) ? TRUE : 'f';
      }

      $errors = $oldUser->errors();

      if ($params['password'] !== '') {
        $oldUser->password = $params['password'];
        $passwordChanged = TRUE;

        if ($params['password'] !== $params['passwordConfirmation']) {
          $errors[] = "Salasanat eivät täsmää";
        }
      }

      if (count($errors) == 0) {
        $oldUser->update($passwordChanged);

        Membership::deleteMembershipsFromUser($id);
        self::createMemberships($params, $id);

        Redirect::to('/users/' . $oldUser->id, array('message' => "Käyttäjän tiedot on päivitetty onnistuneesti!"));
      } else {
        $orgs = Organization::all();
        $memberships = array($params['org'], $params['org2']);

        View::make('usr/edit.html', array('errors' => $errors, 'user' => $oldUser, 'orgs' => $orgs, 'memberships' => $memberships));
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
