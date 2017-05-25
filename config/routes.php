<?php

  $routes->get('/', function() {
    UserController::login();
  });


  // QUESTIONS
  $routes->get('/questions', function() {
    QuestionController::list();
  });

  $routes->get('/questions/:id', function($id) {
    QuestionController::show($id);
  });


  // ORGANIZATIONS
  $routes->get('/organizatons', function() {
    OrganizatonController::list();
  });

  $routes->get('/organizations/:id', function($id) {
    OrganizatonController::show($id);
  });
