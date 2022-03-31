<?php
  class Password_model extends CI_Model {
    public function security_password(){
      if (!$this->session->userdata('logged_in')) {
        redirect('login');
      }
    }

    public function security(){
      if ((!$this->session->userdata('type') == 'admin') || (!$this->session->userdata('type') == 'writer')) {
        redirect('login');
      }
    }

    public function security_only_admin(){
      if ((!$this->session->userdata('type') == 'admin')) {
        redirect('login');
      }
    }

    public function is_admin(){
      if (($this->session->userdata('type') == 'admin')) {
        return TRUE;
      }
    }

    public function is_logged_in(){
      if (!$this->session->userdata('logged_in')) {
        redirect('login');
      }
    }
  }
?>
