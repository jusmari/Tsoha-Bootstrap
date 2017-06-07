<?php

  class Usr extends BaseModel{

    public $id, $name, $password, $admin;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_name', 'validate_password');
    }

    public function validate_name(){
      $errors = array();
      $v = $this->name;

      if($this->validateNotEmpty($v)) $errors[] = "Nimi ei saa olla tyhjä!";
      if($this->validateStringLengthMoreThan($v, 5)) $errors[] = "Nimen tulee olla yli viisi merkkiä pitkä!";
      if($this->validateStringLengthLessThan($v, 50)) $errors[] = "Nimen tulee olla alle 50 merkkiä pitkä!";

      return $errors;
    }

    public function validate_password() {
      $errors = array();
      $v = $this->password;

      if($this->validateNotEmpty($v)) $errors[] = "Salasana ei saa olla tyhjä!";
      if($this->validateStringLengthMoreThan($v, 5)) $errors[] = "Salasanan tulee olla yli viisi merkkiä pitkä!";
      if($this->validateStringLengthLessThan($v, 50)) $errors[] = "Salasanan tulee olla alle 50 merkkiä pitkä!";

      return $errors;
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Usr');
      $query->execute();
      $rows = $query->fetchAll();
      $users = array();

      foreach($rows as $row){
        $users[] = new Usr(array(
          'id' => $row['id'],
          'name' => $row['name'],
          'password' => $row['password'],
          'admin' => $row['admin']
        ));
      }

      return $users;
    }

    public static function find($id) {
      $query = DB::connection()->prepare('SELECT * FROM Usr WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if ($row) {
        return new Usr(array(
          'id' => $row['id'],
          'name' => $row['name'],
          'password' => $row['password'],
          'admin' => $row['admin']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Usr (name, password, admin) VALUES (:name, :password, :admin) RETURNING id');
      $query->execute(array('name' => $this->name, 'password' => $this->password, 'admin' => $this->admin));
      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function update($id) {
      $query = DB::connection()->prepare('UPDATE Usr SET name = :name, password = :password, admin = :admin WHERE id = :id;');

      $query->execute(array('id' => $this->id, 'name' => $this->name, 'password' => $this->password, 'admin' => $this->admin));
    }

    public function destroy($id) {
      $query = DB::connection()->prepare('DELETE FROM Membership WHERE usr_id = :id;');
      $query->execute(array('id' => $id));

      $query = DB::connection()->prepare('DELETE FROM Answer WHERE usr_id = :id;');
      $query->execute(array('id' => $id));

      $query = DB::connection()->prepare('DELETE FROM Usr WHERE id = :id;');
      $query->execute(array('id' => $id));
    }

    public static function authenticate($name, $pw) {
      $query = DB::connection()->prepare('SELECT * FROM Usr WHERE name = :name AND password = :password LIMIT 1');
      $query->execute(array('name' => $name, 'password' => $pw));
      $row = $query->fetch();
      if($row){
        return $row[0];
      }else{
        return null;
      }
    }
  }
