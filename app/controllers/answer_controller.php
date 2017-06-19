<?php

  class AnswerController extends BaseController{


    public static function quiz() {
      $questions = Question::allWithPossibleAnswersExploded();

      View::make('answer/quiz.html', array('questions' => $questions));
    }

    public static function answerQuiz() {
      $user_id = self::get_user_logged_in()->id;
      $params = $_POST;
      $questionAmount = count($params);
      $correctAmount = 0;

      Answer::deleteAnswersFromUser($user_id);

      foreach ($params as $key => $value) {
        $q = Question::find($key);
        $correctAnswer = $q->correctAnswer;
        $correct = "f";

        if ($value == $correctAnswer) {
          $correct = "t";
          $correctAmount++;
        }

        $answer = new Answer(array(
          'question_id' => $key,
          'usr_id' => $user_id,
          'correct' => $correct
        ));

        $answer->save();
      }

      if ($correctAmount == 0) {
        Redirect::to('/lobby', array('message' => "Vastasit oikein 0??!!% tarkkuudella!"));
      } else {
        $answerPercentage = $correctAmount / $questionAmount * 100;

        Redirect::to('/lobby', array('message' => "Vastasit oikein " . round($answerPercentage, 2) . " % tarkkuudella!"));
      }

    }

    public static function results() {
      $users = Usr::all();
      $passedUsers = array();
      $failedUsers = array();

      foreach ($users as $u) {
        if (round(Answer::getUserAnswerPercentage($u->id)) >= 75) {
          $passedUsers[] = $u;
        } else {
          $failedUsers[] = $u;
        }
      }

      View::make('answer/results.html', array('passedUsers' => $passedUsers, 'failedUsers' => $failedUsers));
    }















  }
