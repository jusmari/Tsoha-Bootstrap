<?php

  class Organization extends BaseModel{

    public $id, $name;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Organization');
      $query->execute();
      $rows = $query->fetchAll();
      $orgs = array();

      foreach($rows as $row){
        $orgs[] = new Organization(array(
          'id' => $row['id'],
          'name' => $row['name']
        ));
      }

      return $orgs;
    }

    public static function find($id) {
      $query = DB::connection()->prepare('SELECT * FROM Organization WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if ($row) {
        return new Organization(array(
          'id' => $row['id'],
          'name' => $row['name']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Organization (name) VALUES (:name) RETURNING id');
      $query->execute(array('name' => $this->name));
      $row = $query->fetch();
      $this->id = $row['id'];
    }
  }
