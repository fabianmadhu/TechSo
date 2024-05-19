<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($questionId, $answerId, $username, $notifiedUsername)
    {
        $data = array(
            'questionId' => $questionId,
            'answerId' => $answerId,
            'username' => $username,
            'notifiedUsername' => $notifiedUsername
        );

        if ($this->db->insert('notification', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function getNotificationsForUser($username)
    {
        $this->db->where('notifiedUsername', $username);
        $query = $this->db->get('notification');
        if ($query->num_rows() == 0) {
            return false;
        }
        $notifications = array();
        foreach ($query->result() as $row) {
            $notifications[] = $row;
        }
        return $notifications;
    }
}
