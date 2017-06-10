<?php


  function check_logged_in(){
    BaseController::check_logged_in();
  }

  function check_admin() {
    BaseController::check_user_admin();
  }

  $routes->get('/', function() {
    UsrController::index();
  });

  $routes->post('/login', function() {
    UsrController::handle_login();
  });

  $routes->get('/login', function() {
    UsrController::login();
  });

  $routes->post('/logout', function() {
    UsrController::logout();
  });

  $routes->get('/lobby', 'check_logged_in', function() {
    UsrController::lobby();
  });

  // ANSWERS

  $routes->get('/quiz', 'check_logged_in', function() {
    AnswerController::quiz();
  });

  $routes->post('/quiz', 'check_logged_in', function() {
    AnswerController::answerQuiz();
  });




  // QUESTIONS
  $routes->get('/questions', function() {
    QuestionController::list();
  });

  $routes->get('/questions/new', 'check_admin', function() {
    QuestionController::create();
  });

  $routes->post('/questions', 'check_admin', function() {
    QuestionController::store();
  });

  $routes->get('/questions/:id', 'check_admin', function($id) {
    QuestionController::show($id);
  });

  $routes->get('/questions/:id/edit', 'check_admin', function($id) {
    QuestionController::edit($id);
  });

  $routes->post('/questions/:id/edit', 'check_admin', function($id) {
    QuestionController::update($id);
  });

  $routes->post('/questions/:id/destroy', 'check_admin', function($id) {
    QuestionController::destroy($id);
  });





  // ORGANIZATIONS
  $routes->get('/organizations', function() {
    OrgController::list();
  });

  $routes->get('/organizations/new', 'check_admin', function() {
    OrgController::create();
  });

  $routes->get('/organizations/:id', 'check_admin', function($id) {
    OrgController::show($id);
  });

  $routes->get('/organizations/:id/edit', 'check_admin', function($id) {
    OrgController::edit($id);
  });

  $routes->post('/organizations', 'check_admin', function() {
    OrgController::store();
  });

  $routes->post('/organizations/:id/destroy', 'check_admin', function($id) {
    OrgController::destroy($id);
  });

  $routes->post('/organizations/:id/edit', 'check_admin', function($id) {
    OrgController::update($id);
  });




  // USERS
  $routes->get('/users', 'check_admin', function() {
    UsrController::list();
  });

  $routes->get('/users/new', 'check_admin', function() {
    UsrController::create();
  });

  $routes->get('/users/:id', 'check_admin', function($id) {
    UsrController::show($id);
  });

  $routes->get('/users/:id/edit', 'check_admin', function($id) {
    UsrController::edit($id);
  });

  $routes->post('/users', 'check_admin', function() {
    UsrController::store();
  });

  $routes->post('/users/:id/edit', 'check_admin', function($id) {
    UsrController::update($id);
  });

  $routes->post('/users/:id/destroy', 'check_admin', function($id) {
    UsrController::destroy($id);
  });
