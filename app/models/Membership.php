<?php

  class Membership extends BaseModel{

    public $organization_id, $usr_id;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Membership');
      $query->execute();
      $rows = $query->fetchAll();
      $answs = array();

      foreach($rows as $row){
        $answs[] = new Membership(array(
          'organization_id' => $row['organization_id'],
          'usr_id' => $row['usr_id']
        ));
      }

      return $answs;
    }

    public static function getMembershipCount($org_id) {
      
    }

    public static function find($usr_id, $organization_id) {
      $query = DB::connection()->prepare('SELECT * FROM Membership WHERE usr_id = :u_id AND $organization_id = :o_id LIMIT 1');
      $query->execute(array('u_id' => $usr_id, 'o_id' => $organization_id));
      $row = $query->fetch();

      if ($row) {
        return new Membership(array(
          'organization_id' => $row['organization_id'],
          'usr_id' => $row['usr_id']
        ));
      }

      return null;
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Membership (usr_id, organization_id) VALUES (:usr_id, :question_id) RETURNING id');
      $query->execute(array('usr_id' => $this->usr_id, 'organization_id' => $this->organization_id));
      $row = $query->fetch();
      $this->id = $row['id'];
    }
  }
