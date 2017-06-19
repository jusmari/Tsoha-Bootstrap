<?php

  class Answer extends BaseModel{

    public $usr_id, $question_id, $correct;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Answer');
      $query->execute();
      $rows = $query->fetchAll();
      $answs = array();

      foreach($rows as $row){
        $answs[] = new Answer(array(
          'usr_id' => $row['usr_id'],
          'question_id' => $row['question_id'],
          'correct' => $row['correct']
        ));
      }

      return $answs;
    }

    public static function deleteAnswersFromUser($id) {
      $query = DB::connection()->prepare('DELETE FROM answer WHERE usr_id = :id ;');
      $query->execute(array('id' => $id));
    }

    public static function getAllUserAnswers($id) {
      $query = DB::connection()->prepare('SELECT name, body, correct FROM question AS q LEFT JOIN answer AS a ON a.question_id = q.id WHERE a.usr_id = :id ;');
      $query->execute(array('id' => $id));
      $rows = $query->fetchAll();

      return $rows;
    }

    public static function getUserAnswerPercentage($id) {
      $query = DB::connection()->prepare(
      'SELECT
        CAST((SELECT COUNT(*)
        FROM answer
        WHERE usr_id = :id AND correct = true) AS FLOAT)
       /
        (SELECT count(*)
        FROM question) * 100
        AS res;');
      $query->execute(array('id' => $id));
      $rows = $query->fetch();

      return $rows['res'];
    }

    public static function find($usr_id, $q_id) {
      $query = DB::connection()->prepare('SELECT * FROM Answer WHERE usr_id = :u_id AND question_id = :q_id LIMIT 1');
      $query->execute(array('u_id' => $usr_id, 'q_id' => $q_id));
      $row = $query->fetch();

      if ($row) {
        return new Answer(array(
          'usr_id' => $row['usr_id'],
          'question_id' => $row['question_id'],
          'correct' => $row['correct']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Answer (usr_id, question_id, correct) VALUES (:usr_id, :question_id, :correct);');
      $query->execute(array('usr_id' => $this->usr_id, 'question_id' => $this->question_id, 'correct' => $this->correct));
    }
  }
