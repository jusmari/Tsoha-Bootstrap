<?php

  class QuestionController extends BaseController{

    public static function list() {
      $ret = Question::all();

      View::make('question/list.html', array('questions' => $ret));
    }

    public static function show($id) {
      $q = Question::find($id);

      View::make('question/show.html', array('q' => $q));
    }

    public static function create() {
      View::make('question/new.html');
    }

    public static function edit($id) {
      $q = Question::find($id);

      View::make('question/edit.html', array('q' => $q));
    }

    public static function store(){
      $params = $_POST;

      $ret = new Question(array(
        'name' => $params['name'],
        'body' => $params['body'],
        'correctAnswer' => $params['correctAnswer'],
        'possibleAnswers' => $params['possibleAnswers']
      ));

      $ret->save();

      Redirect::to('/questions/' . $ret->id, array('message' => 'Uuden kysymyksen luonti onnistui!'));
    }
  }
