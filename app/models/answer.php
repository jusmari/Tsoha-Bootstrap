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
