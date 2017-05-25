<?php

  class QuestionsController extends BaseController{

    public static function list() {
      View::make('organization/list.html');
    }

    public static function show($id) {
      View::make('organization/show.html')
    }
  }
