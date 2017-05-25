<?php

  class QuestionsController extends BaseController{

    public static function list() {
      View::make('organization/organizations_list.html');
    }
  }
