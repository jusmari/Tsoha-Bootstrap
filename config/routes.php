<?php

  $routes->get('/', function() {
    UsrController::login();
  });


  // QUESTIONS
  $routes->get('/questions', function() {
    QuestionController::list();
  });

  $routes->get('/questions/:id', function($id) {
    QuestionController::show($id);
  });


  // ORGANIZATIONS
  $routes->get('/organizations', function() {
    OrgController::list();
  });

  $routes->get('/organizations/:id', function($id) {
    OrgController::show($id);
  });


  // USERS
  $routes->get('/users', function() {
    UsrController::list();
  });
