<?php

  class OrgController extends BaseController{

    public static function list() {
      $orgs = Organization::all();
      $members = Membership::getAllOrgsMemberCount();

      View::make('organization/list.html', array('orgs' => $orgs, 'members' => $members));
    }

    public static function show($id) {
      $o = Organization::find($id);
      $m = Membership::getOrgMemberCount($id);

      View::make('organization/show.html', array('o' => $o, 'm' => $m));
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
