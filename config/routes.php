<?php

  $routes->get('/', function() {
    UsrController::index();
  });

  $routes->post('/login', function() {
    UsrController::handle_login();
  });

  $routes->get('/lobby', function() {

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

  $routes->get('/questions/:id', function($id) {
    QuestionController::show($id);
  });

  $routes->get('/questions/:id/edit', function($id) {
    QuestionController::edit($id);
  });

  $routes->post('/questions/:id/edit', function($id) {
    QuestionController::update($id);
  });

  $routes->post('/questions/:id/destroy', function($id) {
    QuestionController::destroy($id);
  });





  // ORGANIZATIONS
  $routes->get('/organizations', function() {
    OrgController::list();
  });

  $routes->get('/organizations/new', function() {
    OrgController::create();
  });

  $routes->get('/organizations/:id', function($id) {
    OrgController::show($id);
  });

  $routes->get('/organizations/:id/edit', function($id) {
    OrgController::edit($id);
  });


  $routes->post('/organization', function() {
    OrgController::store();
  });








  // USERS
  $routes->get('/users', function() {
    UsrController::list();
  });

  $routes->get('/users/new', function() {
    UsrController::create();
  });

  $routes->get('/users/:id', function($id) {
    UsrController::show($id);
  });

  $routes->get('/users/:id/edit', function($id) {
    UsrController::edit($id);
  });

  $routes->post('/users', function() {
    UsrController::store();
  });

  $routes->post('/users/:id/edit', function($id) {
    UsrController::update($id);
  });

  $routes->post('/users/:id/destroy', function($id) {
    UsrController::destroy($id);
  });
