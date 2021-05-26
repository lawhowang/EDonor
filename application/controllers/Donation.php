<?php
class Donation extends CI_Controller {

  private $userID;
  private $donorID;
  private $username;
  private $firstName;
  private $lastName;
  private $email;

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
    if (isset($this->session->userdata['loggedIn'])) {
      $this->userID = $this->session->userdata['loggedIn']['userID'];
      $this->donorID = $this->session->userdata['loggedIn']['donorID'];
      $this->username = $this->session->userdata['loggedIn']['username'];
      $this->firstName = $this->session->userdata['loggedIn']['firstName'];
      $this->lastName = $this->session->userdata['loggedIn']['lastName'];
      $this->email = $this->session->userdata['loggedIn']['email'];
    } else {
      $data["view"] = "login-form";
      $this->load->view('template', $data);
    }
  }

  public function history()
  {
    $data["user"] = $this->session->userdata['loggedIn'];
    $query = $this->db->query("SELECT CONCAT(CAST(Donation.donorId AS CHAR(10)), '00', CAST(Donation.bloodPackId AS CHAR(10))) AS id, DonationVenue.name AS venueName, donationDate, 'SUCCESS' AS status FROM Donation INNER JOIN DonationVenue ON Donation.venueId = DonationVenue.id WHERE donationDate >= DATE_ADD(NOW(), INTERVAL -2 MONTH) AND donorId = $this->donorID");
    $donations = $query->result_array();
    $data["donations"] = $donations;
    $data["view"] = "donation/history";
    $this->load->view('template', $data);
  }
  
  public function survey() {
    if ($this->input->post('submit')) {
      $donatedBefore = $this->input->post('donatedBefore') ? 1 : 0;
      $lastDonationDate = $this->input->post('lastDonationDate');
      $hasTravel = $this->input->post('hasTravel') ? 1 : 0;
      echo "INSERT INTO Survey VALUES (NULL, $this->donorID, $donatedBefore, $hasTravel, $lastDonationDate, NULL)";
      $query = $this->db->query("INSERT INTO Survey VALUES (NULL, $this->donorID, $donatedBefore, $hasTravel, $lastDonationDate, NULL)");
      redirect('appointment/make');
    } else {
      $data["user"] = $this->session->userdata['loggedIn'];
      $data["view"] = "donation/survey";
    }
    $this->load->view('template', $data);
  }
}