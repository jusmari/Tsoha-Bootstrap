<?php

  class OrgController extends BaseController{

    public static function list() {
      $orgs = Organization::all();

      View::make('organization/list.html', array('orgs' => $orgs));
    }

    public static function show($id) {
      $o = Organization::find($id);

      View::make('organization/show.html', array('o' => $o));
    }

    public static function edit($id) {
      $o = Organization::find($id);


      View::make('organization/edit.html', array('o' => $o));
    }

    public static function create() {
      View::make('organization/new.html');
    }

    public static function store(){
      $params = $_POST;

      $ret = new Organization(array(
        'name' => $params['name']
      ));

      $ret->save();

      Redirect::to('/organizations/' . $ret->id, array('message' => 'Uuden järjestön luonti onnistui!'));
    }
  }
