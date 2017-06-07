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

    public static function update($id) {
      $params = $_POST;

      $attrs = array(
        'id' => $id,
        'body' => $params['body'],
        'correctAnswer' => $params['correctAnswer'],
        'possibleAnswers' => $params['possibleAnswers'],
        'name' => $params['name']
      );

      $q = new Question($attrs);
      $errors = $q->errors();

      if (count($errors) == 0) {
        $q->update();

        Redirect::to('/questions/' . $q->id, array('message' => "Kysymys on päivitetty onnistuneesti!"));
      } else {
        View::make('question/edit.html', array('errors' => $errors, 'q' => $q));
      }
    }

    public static function destroy($id) {
      $params = $_POST;
      $q = new Question(array('id' => $id));
      $q->destroy($id);

      Redirect::to('/questions', array('message' => "Kysymyksen poisto onnistunut!"));
    }

    public static function store(){
      $params = $_POST;
      $attributes = array(
        'name' => $params['name'],
        'body' => $params['body'],
        'correctAnswer' => $params['correctAnswer'],
        'possibleAnswers' => $params['possibleAnswers']
      );

      $ret = new Question($attributes);

      $errors = $ret->errors();

      if (count($errors) == 0) {
        $ret->save();

        Redirect::to('/questions/' . $ret->id, array('message' => 'Uuden kysymyksen luonti onnistui!'));
      } else {
        View::make('/question/new.html' , array('errors' => $errors, 'q' => $attributes));
      }
    }
  }
