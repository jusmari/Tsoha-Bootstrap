<?php

  class Usr extends BaseModel{

    public $id, $name, $password, $admin;

    public function __construct($attributes){
      parent::__construct($attributes);
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



  }
