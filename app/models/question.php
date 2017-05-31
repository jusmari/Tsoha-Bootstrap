
<?php

  class Question extends BaseModel{

    public $id, $body, $correctAnswer, $possibleAnswers, $name;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Question');
      $query->execute();
      $rows = $query->fetchAll();
      $questions = array();

      foreach($rows as $row){
        $questions[] = new Question(array(
          'id' => $row['id'],
          'name' => $row['name'],
          'body' => $row['body'],
          'correctAnswer' => $row['correctanswer'],
          'possibleAnswers' => $row['possibleanswers']
        ));
      }

      return $questions;
    }

    public static function find($id) {
      $query = DB::connection()->prepare('SELECT * FROM Question WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if ($row) {
        return new Question(array(
          'id' => $row['id'],
          'name' => $row['name'],
          'body' => $row['body'],
          'possibleAnswers' => $row['possibleanswers'],
          'correctAnswer' => $row['correctanswer']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Question (body, possibleanswers, correctanswer) VALUES (:body, :possibleanswers, :correctanswer) RETURNING id');

      $query->execute(array('body' => $this->body, 'possibleanswers' => $this->possibleAnswers, 'correctanswer' => $this->correctAnswer));

      $row = $query->fetch();
      $this->id = $row['id'];
    }



  }
