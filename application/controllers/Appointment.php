<?php
class Appointment extends CI_Controller {

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

  public function make()
  {
    //
    $query = $this->db->query("SELECT id FROM Survey WHERE donorId = $this->donorID AND completedDate >= DATE_ADD(NOW(), INTERVAL -2 MONTH)");
    if ($query->num_rows() == 0) {
      redirect("donation/survey");
      return;
    }
    //
    $data["user"] = $this->session->userdata['loggedIn'];
    if ($this->input->post('confirm')) {
      $data["venueID"] = $this->session->userdata['appointmentDetails']['venueID'];
      $data["timeSlot"] = $this->session->userdata['appointmentDetails']['timeSlot'];
      $data["date"] = $this->session->userdata['appointmentDetails']['date'];
      $data["venueName"] = $this->session->userdata['appointmentDetails']['venueName'];
      $data["emergencyContact"] = $this->session->userdata['appointmentDetails']['emergencyContact'];
      $venueID = $data["venueID"];
      $datetime = $data["date"] . ' ' . $data["timeSlot"];
      $query = $this->db->query("INSERT INTO Appointment VALUES (NULL, $this->donorID, $venueID, '$datetime', 0)");
      if ($this->db->affected_rows() > 0) {
        $data["referenceNumber"] = $this->db->insert_id();
        $data["message"] = "The appointment has been created successfully";
      } else {
        $data["message"] = "The appointment has been cancelled due to system error";
      }
      $sessionData = array();
      $this->session->unset_userdata('appointmentDetails', $sessionData);
      $data["view"] = "appointment/make/final";
    } else if ($this->input->post('timeSlot')) {
      $timeSlot = $this->input->post('timeSlot');
      $venueID = $this->session->userdata['appointmentDetails']['venueID'];
      $this->session->userdata['appointmentDetails']['timeSlot'] = $timeSlot;
      $data["timeSlot"] = $timeSlot;
      $data["date"] = $this->session->userdata['appointmentDetails']['date'];

      $query = $this->db->query("SELECT name FROM DonationVenue WHERE id = $venueID");
      $data["venueName"] = $query->row()->name;
      $this->session->userdata['appointmentDetails']['venueName'] = $data["venueName"];

      $query = $this->db->query("SELECT Donor.emergencyContact FROM Users LEFT JOIN Donor ON Users.id = Donor.userId AND Users.id = $this->userID");
      $data["emergencyContact"] = $query->row()->emergencyContact;
      $this->session->userdata['appointmentDetails']['emergencyContact'] = $data["emergencyContact"];
      $data["view"] = "appointment/make/step4";
    } else if ($this->input->post('date')) {
      $date = $this->input->post('date');
      if ($date > date("Y-m-d")) {
        $this->session->userdata['appointmentDetails']['date'] = $date;
        $venueID = $this->session->userdata['appointmentDetails']['venueID'];
        $query = $this->db->query("SELECT DATE_FORMAT(openTime, '%H:%i') AS openTime, DATE_FORMAT(closeTime, '%H:%i') AS closeTime FROM DonationVenue WHERE id = $venueID");
        $data["openTime"] = $query->row()->openTime;
        $data["closeTime"] = $query->row()->closeTime;
        $data["view"] = "appointment/make/step3";
      } else {
        $data["message"] = "The date must be after today!";
        $data["view"] = "appointment/make/step2";
      }
    } else if ($this->input->post('venue')) {
      $venueID = $this->input->post('venue');
      $appointmentDetails = array('venueID' => $venueID);
      $this->session->set_userdata('appointmentDetails', $appointmentDetails);
      $data["view"] = "appointment/make/step2";
    } else {
      $query = $this->db->query("SELECT DonationVenue.id, name, address, DATE_FORMAT(openTime, '%H:%i') AS openTime, DATE_FORMAT(closeTime, '%H:%i') AS closeTime FROM DonationVenue INNER JOIN Location ON DonationVenue.locationId = Location.id");
      $venue = $query->result_array();
      $data["venue"] = $venue;
      $data["view"] = "appointment/make/step1";
    }
    $this->load->view('template', $data);
  }

  public function review()
  {
    $data["user"] = $this->session->userdata['loggedIn'];
    $query = $this->db->query("SELECT Appointment.id, DATE(date) AS date, TIME(date) AS time, name AS venueName, address FROM Appointment INNER JOIN DonationVenue ON Appointment.venueId = DonationVenue.id INNER JOIN Location ON DonationVenue.locationId = Location.id WHERE Appointment.donorId = $this->donorID AND Appointment.date >= DATE_ADD(NOW(), INTERVAL -2 MONTH)");
    $appointments = $query->result_array();
    $data["appointments"] = $appointments;
    $data["view"] = "appointment/review";
    $this->load->view('template', $data);
  }

  public function cancel()
  {
    $data["user"] = $this->session->userdata['loggedIn'];
    $appointmentID = $this->input->get('id');
    $query = $this->db->query("DELETE FROM Appointment WHERE donorId = $this->donorID AND id = $appointmentID");
    redirect('appointment/review');
  }

}