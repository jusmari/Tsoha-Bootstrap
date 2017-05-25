<?php

  $routes->get('/', function() {
    UserController::login();
  });


  // USERS
  $routes->get('/questions', function() {
    QuestionController::list();
  });


  // ORGANIZATIONS
  $routes->get('/organizatons', function() {
    OrganizatonController::list();
  });
