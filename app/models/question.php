
<?php

  class Question extends BaseModel{

    public $id, $body, $correctAnswer, $possibleAnswers;

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
          'body' => $row['body'],
          'correctAnswer' => $row['correctAnswer'],
          'possibleAnswers' => $row['possibleAnswers']
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
          'body' => $row['body'],
          'possibleAnswers' => $row['possibleAnswers'],
          'correctAnswer' => $row['correctAnswer']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Question (body, possibleAnswers, correctAnswer) VALUES (:body, :possibleAnswers, :correctAnswer) RETURNING id');
      
      $query->execute(array('body' => $this->body, 'possibleAnswers' => $this->possibleAnswers, 'correctAnswer' => $this->$correctAnswer));

      $row = $query->fetch();
      $this->id = $row['id'];
    }



  }
