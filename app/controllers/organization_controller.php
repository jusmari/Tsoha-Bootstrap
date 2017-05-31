<?php

  class OrgController extends BaseController{

    public static function list() {
      View::make('organization/list.html');
    }

    public static function show($id) {
      View::make('organization/show.html');
    }

    public static function edit($id) {
      View::make('organization/edit.html');
    }

    public static function create() {
      View::make('organization/new.html');
    }

    public static function store(){
      $params = $_POST;

      $ret = new Organization(array(
        'id' => $params['id'],
        'name' => $params['name']
      ));

      $ret->save();

      Redirect::to('/organizations/' . $ret->id, array('message' => 'Uuden järjestön luonti onnistui!'));
    }
  }
