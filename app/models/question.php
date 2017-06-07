
<?php

  class Question extends BaseModel{

    public $id, $body, $correctAnswer, $possibleAnswers, $name;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_name', 'validate_question_body', 'validate_correct_answer', 'validate_possible_answers');
    }

    public function validate_name() {
      $errors = array();
      $v = $this->name;

      if($this->validateNotEmpty($v)) $errors[] = "Tunniste ei saa olla tyhjä!";
      if($this->validateStringLengthLessThan($v, 140)) $errors[] = "Tunnisteen tulee olla alle 140 merkkiä pitkä!";

      return $errors;
    }

    public function validate_question_body() {
      $errors = array();
      $v = $this->body;

      if($this->validateNotEmpty($v)) $errors[] = "Kysymysosuus ei saa olla tyhjä!";
      if($this->validateStringLengthLessThan($v, 140)) $errors[] = "Kysymysosuus tulee olla alle 140 merkkiä pitkä!";

      return $errors;
    }

    public function validate_correct_answer() {
      $errors = array();
      $v = $this->correctAnswer;

      if($this->validateNotEmpty($v)) $errors[] = "Oikea vastaus ei saa olla tyhjä!";
      if($this->validateStringLengthLessThan($v, 200)) $errors[] = "Oikea vastaus tulee olla alle 140 merkkiä pitkä!";

      return $errors;
    }

    public function validate_possible_answers() {
      $errors = array();
      $v = $this->possibleAnswers;

      if($this->validateNotEmpty($v)) $errors[] = "Oikea vastaus ei saa olla tyhjä!";
      if($this->validateStringLengthLessThan($v, 140)) $errors[] = "Oikea vastaus tulee olla alle 140 merkkiä pitkä!";

      return $errors;
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
      $query = DB::connection()->prepare('INSERT INTO Question (name, body, possibleanswers, correctanswer) VALUES (:name, :body, :possibleanswers, :correctanswer) RETURNING id');

      $query->execute(array('name' => $this->name, 'body' => $this->body, 'possibleanswers' => $this->possibleAnswers, 'correctanswer' => $this->correctAnswer));

      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function update() {
      $query = DB::connection()->prepare('UPDATE Question SET name = :name, body = :body, possibleanswers = :possibleanswers, correctanswer = :correctanswer WHERE id = :id;');

      $query->execute(array('id' => $this->id, 'name' => $this->name, 'body' => $this->body, 'possibleanswers' => $this->possibleAnswers, 'correctanswer' => $this->correctAnswer));
    }

    public function destroy($id) {
      $query = DB::connection()->prepare('DELETE FROM Answer WHERE question_id = :id;');
      $query->execute(array('id' => $id));

      $query = DB::connection()->prepare('DELETE FROM Question WHERE id = :id;');
      $query->execute(array('id' => $id));
    }
  }
