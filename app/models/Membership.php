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

    public static function find($usr_id, $organization_id) {
      $query = DB::connection()->prepare('SELECT * FROM Membership WHERE usr_id = :u_id AND organization_id = :o_id LIMIT 1');
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

    public static function getAllUserMembershipOrganizations($usr_id) {
      $query = DB::connection()->prepare('SELECT name FROM organization AS org, membership AS mem WHERE org.id = mem.organization_id AND mem.usr_id = :id;');
      $query->execute(array('id' => $usr_id));
      $rows = $query->fetchAll();
      $ret = array();

      foreach($rows as $row){
        $ret[] = $row['name'] ;
      }

      return $ret;
    }

    public static function getAllOrgsMemberCount() {
      $query = DB::connection()->prepare('SELECT organization_id AS org, count(usr_id) AS members FROM membership GROUP BY org;');
      $query->execute();
      $rows = $query->fetchAll();
      $ret = array();

      foreach($rows as $row){
        $ret[$row['org']] = $row['members'];
      }

      return $ret;
    }

    public static function getOrgMemberCount($org_id) {
      $query = DB::connection()->prepare('SELECT count(usr_id) AS members FROM membership WHERE organization_id = :id LIMIT 1;');
      $query->execute(array('id' => $org_id));
      $row = $query->fetch();

      if ($row) {
        return $row[0];
      }

      return null;
    }

    public static function deleteMembershipsFromUser($id) {
      $query = DB::connection()->prepare('DELETE FROM Membership WHERE usr_id = :id');
      $query->execute(array('id' => $id));
    }

    public function save() {
      $query = DB::connection()->prepare('INSERT INTO Membership (usr_id, organization_id) VALUES (:usr_id, :organization_id);');
      $query->execute(array('usr_id' => $this->usr_id, 'organization_id' => $this->organization_id));
    }
  }
