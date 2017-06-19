<?php

  class Usr extends BaseModel{

    public $id, $name, $password, $admin, $email;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_name', 'validate_password', 'validate_email');
    }

    public function validate_name(){
      $errors = array();
      $v = $this->name;

      if (!preg_match("/^[a-zA-Z ]*$/",$v)) $errors[] = "Vain kirjaimet ja välilyönnit sallittuja!";
      if($this->validateNotEmpty($v)) $errors[] = "Nimi ei saa olla tyhjä!";
      if($this->validateStringLengthMoreThan($v, 3)) $errors[] = "Nimen tulee olla yli kolme merkkiä pitkä!";
      if($this->validateStringLengthLessThan($v, 50)) $errors[] = "Nimen tulee olla alle 50 merkkiä pitkä!";

      return $errors;
    }

    public function validate_email() {
      $errors = array();

      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $errors[] = "Sähköpostiosoite on väärässä muodossa!";

      return $errors;;
    }

    public function validate_password() {
      $errors = array();
      $v = $this->password;

      if($this->validateNotEmpty($v)) $errors[] = "Salasana ei saa olla tyhjä!";
      if($this->validateStringLengthMoreThan($v, 3)) $errors[] = "Salasanan tulee olla yli kolme merkkiä pitkä!";
      if($this->validateStringLengthLessThan($v, 200)) $errors[] = "Salasanan tulee olla alle 50 merkkiä pitkä!";

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
          'admin' => $row['admin'],
          'email' => $row['email']
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
          'admin' => $row['admin'],
          'email' => $row['email']
        ));
      }

      return null;
    }

    public function save() {
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);

      $query = DB::connection()->prepare('INSERT INTO Usr (name, password, admin, email) VALUES (:name, :password, :admin, :email) RETURNING id');
      $query->execute(array('name' => $this->name, 'password' => $this->password, 'admin' => $this->admin, 'email' => $this->email));
      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function update($pwChanged) {
      if ($pwChanged) {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      }

      $query = DB::connection()->prepare('UPDATE Usr SET name = :name, password = :password, admin = :admin, email = :email WHERE id = :id;');

      $query->execute(array('id' => $this->id, 'name' => $this->name, 'password' => $this->password, 'admin' => $this->admin, 'email' => $this->email));
    }

    public function destroy($id) {
      $query = DB::connection()->prepare('DELETE FROM Membership WHERE usr_id = :id;');
      $query->execute(array('id' => $id));

      $query = DB::connection()->prepare('DELETE FROM Answer WHERE usr_id = :id;');
      $query->execute(array('id' => $id));

      $query = DB::connection()->prepare('DELETE FROM Usr WHERE id = :id;');
      $query->execute(array('id' => $id));
    }

    public static function authenticate($name, $no_hash_pw) {


      $query = DB::connection()->prepare('SELECT * FROM Usr WHERE name = :name LIMIT 1');
      $query->execute(array('name' => $name));
      $row = $query->fetch();

      if($row && password_verify($no_hash_pw, $row['password'])){
        return new Usr(array(
          'id' => $row['id'],
          'name' => $row['name'],
          'password' => $row['password'],
          'admin' => $row['admin'],
          'email' => $row['email']
        ));
      }else{
        return null;
      }
    }

    public static function checkUniqueUsername($check) {
      $query = DB::connection()->prepare('SELECT name FROM Usr WHERE name = :name LIMIT 1');
      $query->execute(array('name' => $check));
      $row = $query->fetch();

      return ($row['name'] == $check) ? TRUE : FALSE;
    }
  }
