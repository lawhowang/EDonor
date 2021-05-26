<?php
class Main extends CI_Controller {

  private $username;

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
    if (isset($this->session->userdata['loggedIn'])) {
      $this->username = $this->session->userdata['loggedIn']['username'];
    } else {
      $data["view"] = "login-form";
      $this->load->view('template', $data);
    }
  }

  public function index()
  {
    if (isset($this->session->userdata['loggedIn'])) {
      $data["view"] = "user/index";
      $data["user"] = $this->session->userdata['loggedIn'];
      $this->load->view('template', $data);
    }
  }
}