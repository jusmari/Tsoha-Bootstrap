<?php

  class QuestionsController extends BaseController{

    public static function list() {
      View::make('question/questions_list.html');
    }
  }
