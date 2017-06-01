<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function validateStringLength($string, $minl, $maxl) {
      $errors = array();

      if($string == '' || $string == NULL){
          $errors[] = "Merkkijonon pituus tulee olla välillä " . $minl . ".." . $maxl;
      }

      if(!strlen($string) <= $maxl) {
          $errors[] = "Merkkijonon pituus tulee olla välillä " . $minl . ".." . $maxl;
      }

      if (!strlen($string) >= $minl) {
        $errors[] = "Merkkijonon pituus tulee olla välillä " . $minl . ".." . $maxl;
      }

      return $errors;
    }

    public function validateNotEmpty($string) {
      $errors = array();

      if($string == '' || $string == NULL){
          $errors[] = "Tyhjä syöte"
      }

      return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      foreach($this->validators as $validator){
          $valArr = array();
          $valArr = $this->{$validator}();
          $errors = array_merge($errors, $valArr);
      }

      return $errors;
    }

  }
