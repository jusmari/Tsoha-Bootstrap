<?php

  $routes->get('/', function() {
    UsrController::index();
  });


  // QUESTIONS
  $routes->get('/questions', function() {
    QuestionController::list();
  });

  $routes->get('/questions/new', function() {
    QuestionController::create();
  });

  $routes->post('/questions', function() {
    QuestionController::store();
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

  $routes->get('/organizations/new', function() {
    OrgController::create();
  });

  $routes->post('/organization', function() {
    OrgController::store();
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
