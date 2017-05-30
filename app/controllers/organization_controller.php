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
  }
