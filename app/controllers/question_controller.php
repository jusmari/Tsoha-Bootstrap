<?php

  class QuestionController extends BaseController{

    public static function list() {
      View::make('question/list.html');
    }

    public static function show($id) {
      View::make('question/show.html');
    }

    public static function create() {
      View::make('question/new.html')
    }

    public static function store(){
      $params = $_POST;

      $ret = new Question(array(
        'id' => $row['id'],
        'body' => $row['body'],
        'correctAnswer' => $row['correctAnswer'],
        'possibleAnswers' => $row['possibleAnswers']
      ));

      $ret->save();

      Redirect::to('/questions/' . $ret->id, array('message' => 'Uuden kysymyksen luonti onnistui!'));
    }
  }
