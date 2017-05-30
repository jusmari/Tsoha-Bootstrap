<?php

  $routes->get('/', function() {
    UsrController::index();
  });


  // QUESTIONS
  $routes->get('/questions', function() {
    QuestionController::list();
  });

  // ORGANIZATIONS
  $routes->get('/organizations', function() {
    OrgController::list();
  });

  $routes->get('/organizations/:id', function($id) {
    OrgController::show($id);
  });

  $routes->get('/organizations/:id/edit', function($id) {
    OrgController::edit($id);
  });


  // USERS
  $routes->get('/users', function() {
    UsrController::list();
  });

  $routes->get('/users/:id', function($id) {
    UsrController::show($id);
  });

  $routes->get('/users/:id/edit', function($id) {
    UsrController::edit($id);
  });
