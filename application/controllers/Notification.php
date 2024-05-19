<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Notification extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NotificationModel');
        
        $this->load->model('UserModel');
    }

    public function notification_get()
    {
        $notifiedUsername = $this->session->username;
        $notifications = $this->NotificationModel->getNotificationsForUser($notifiedUsername);

        if ($notifications) {
            $this->response($notifications, REST_Controller::HTTP_OK);
        } else {
            $this->response('Error: Failed to fetch notifications', REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function answer_post()
    {
        $questionId = $this->post('questionId');
        $username = $this->session->username;
        $description = $this->post('description');
        $answerId = $this->AnswerModel->addAnswer($questionId, $username, $description);

        $answer = $this->AnswerModel->getAnswerById($answerId);

        if ($answer) {
            // Get the username of the user who asked the question
            $question = $this->QuestionModel->getQuestionById($questionId);
            $askerUsername = $question->username;

            // Create a new notification
            $this->NotificationModel->create($questionId, $answerId, $username, $askerUsername);

            $this->response($answer, REST_Controller::HTTP_OK);
        } else {
            $this->response('Error: Failed to insert notification', REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
