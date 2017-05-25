<?php

  class QuestionController extends BaseController{

    public static function list() {
      View::make('question/list.html');
    }

    public static function show($id) {
      View::make('question/show.html');
    }
  }
