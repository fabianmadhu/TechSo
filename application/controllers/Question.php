<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Question extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('QuestionModel');
        $this->load->model('AnswerModel');
        $this->load->model('UserModel');
    }

    public function question_post()
    {
        $username = $this->session->username;
        $category = $this->post('category');
        $title = $this->post('title');
        $description = $this->post('description');

        $questionId = $this->QuestionModel->insertQuestion($username, $category, $title, $description);

        if ($questionId) {
            $this->response(json_encode(array('status' => 'success', 'data' => array('questionId' => $questionId))), REST_Controller::HTTP_OK);
        } else {
            $this->response(json_encode(array('status' => 'error', 'message' => 'Question insertion failed')), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function question_get()
    {
        $questionId = $this->get('id');
        $category = $this->get('category');
        if ($questionId) {
            $question = $this->QuestionModel->getQuestionsById($questionId);
            $categories = $this->QuestionModel->fetchCategories();

            if ($question) {
                $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
                $this->load->view('question_view', array('question' => $question, 'categories' => $categories));
                $this->load->view('includes/footer.php');
            } else {
                $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
                $this->load->view('errors/html/error_404.php', array('heading' => 'Error', 'message' => 'Ooops! Page Not Found'));
                $this->load->view('includes/footer.php');
            }
        } elseif ($category) {
            $questions = $this->QuestionModel->getQuestionsByCategory($category);
            $header = ($questions == false) ? "No $category questions found" : "$category questions (" . count($questions) . ")";

            $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
            $this->load->view('all_questions', array('questions' => $questions, 'header' => $header));
            $this->load->view('includes/footer.php');
        } else {
            $questions = $this->QuestionModel->getQuestionsById(null);
            $header = ($questions == false) ? "No questions added" : "All Questions (" . count($questions) . ")";

            $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
            $this->load->view('all_questions', array('questions' => $questions, 'header' => $header));
            $this->load->view('includes/footer.php');
        }
    }

    public function question_patch()
    {
        $id = $this->patch('id');
        $username = $this->session->username;
        $category = $this->patch('category');
        $title = $this->patch('title');
        $description = $this->patch('description');
        $this->QuestionModel->updateQuestion($id, $username, $category, $title, $description);

        $question = $this->QuestionModel->getQuestionsById($id);

        if ($question) {
            $this->response($question, REST_Controller::HTTP_OK);
        } else {
            $this->response('Error: Failed to update question', REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function question_delete($id)
    {
        $username = $this->session->username;
        $this->QuestionModel->removeQuestion($username, $id);

        $this->set_response(null, REST_Controller::HTTP_NO_CONTENT);
    }

    public function upvote_post()
    {
        $id = $this->post('id');
        $this->QuestionModel->likevote($id);

        $question = $this->QuestionModel->getQuestionsById($id);
        $this->response($question, REST_Controller::HTTP_OK);
    }

    public function downvote_post()
    {
        $id = $this->post('id');
        $this->QuestionModel->dislikevote($id);

        $question = $this->QuestionModel->getQuestionsById($id);
        $this->response($question, REST_Controller::HTTP_OK);
    }

    public function ask_get()
    {
        $categories = $this->QuestionModel->fetchCategories();

        $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('new_question', array('categories' => $categories));
        $this->load->view('includes/footer.php');
    }

    public function categories_get()
    {
        $categories = $this->QuestionModel->fetchCategories();

        $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('categories', array('categories' => $categories));
        $this->load->view('includes/footer.php');
    }

    public function search_get()
    {
        $keyword = $this->get('keyword');
        $questions = $this->QuestionModel->find($keyword);
        $header = ($questions == false) ? "No questions containing \"$keyword\" found" : "Questions containing \"$keyword\" (" . count($questions) . ")";

        $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('all_questions', array('questions' => $questions, 'header' => $header));
        $this->load->view('includes/footer.php');
    }
}
