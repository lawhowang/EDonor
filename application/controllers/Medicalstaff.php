<?php
class Medicalstaff extends CI_Controller {

  private $userID;
  private $donorID;
  private $username;
  private $firstName;
  private $lastName;
  private $email;

  private $medicalStaffID;
  private $medicalStaffHospitalID;
  private $bloodTypeTable = array(
    'A+' => array ('A+', 'A-', 'O+', 'O-'),
    'O+' => array ('O+', 'O-'),
    'B+' => array ('B+', 'B-', 'O+', 'O-'),
    'AB+' => array ('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
    'A-' => array ('A-', 'O-'),
    'O-' => array ('O-'),
    'B-' => array ('B-', 'O-'),
    'AB-' => array ('AB-', 'A-', 'B-', 'O-'),
  );

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
    if (isset($this->session->userdata['loggedIn']) && $this->session->userdata['loggedIn']['isMedicalStaff'] == 1) {
      $this->userID = $this->session->userdata['loggedIn']['userID'];
      $this->donorID = $this->session->userdata['loggedIn']['donorID'];
      $this->username = $this->session->userdata['loggedIn']['username'];
      $this->firstName = $this->session->userdata['loggedIn']['firstName'];
      $this->lastName = $this->session->userdata['loggedIn']['lastName'];
      $this->email = $this->session->userdata['loggedIn']['email'];
      $this->medicalStaffID = $this->session->userdata['loggedIn']['medicalStaffData']['ID'];
      $this->medicalStaffHospitalID = $this->session->userdata['loggedIn']['medicalStaffData']['hospitalID'];
    } else {
      $data["view"] = "login-form";
      $this->load->view('template', $data);
    }
  }

  public function search()
  {
    if ($this->input->get('reset')) {
      $sth = array();
      $this->session->userdata['loggedIn']['searching'] = $sth;
    }
    $data["user"] = $this->session->userdata['loggedIn'];
    if ($this->input->post('bloodType') || isset($this->session->userdata['loggedIn']['searching']['bloodType'])) {
      if (isset($this->session->userdata['loggedIn']['searching']['bloodType'])) {
        $bloodType = $this->session->userdata['loggedIn']['searching']['bloodType'];
        $nonReservedOnly = $this->session->userdata['loggedIn']['searching']['nonReservedOnly'];
      }
      if ($this->input->post('bloodType')) {
        $bloodType = $this->input->post('bloodType');
        if ($this->input->post('showCompatible'))
          $bloodType = implode("','", $this->bloodTypeTable[$bloodType]);
        $nonReservedOnly = $this->input->post('nonReservedOnly');

        $this->session->userdata['loggedIn']['searching']['bloodType'] = $bloodType;
        $this->session->userdata['loggedIn']['searching']['nonReservedOnly'] = $nonReservedOnly;
      }

      if ($nonReservedOnly)
        $q = "SELECT *, BloodPack.id as bloodPackId, IF(Reservation.released IS NULL OR Reservation.released = 1 OR Reservation.reservedDate < NOW() - INTERVAL 2 HOUR, '0', '1') as reserved FROM Inventory LEFT JOIN BloodPack ON Inventory.bloodPackId = BloodPack.id LEFT JOIN Reservation ON Reservation.bloodPackId = BloodPack.id WHERE BloodPack.bloodType IN ('$bloodType') AND Inventory.sent = 0 AND BloodPack.expiryDate > CURDATE() HAVING reserved = 0";
      else
        $q = "SELECT *, BloodPack.id as bloodPackId, IF(Reservation.released IS NULL OR Reservation.released = 1 OR Reservation.reservedDate < NOW() - INTERVAL 2 HOUR, '0', '1') as reserved FROM Inventory LEFT JOIN BloodPack ON Inventory.bloodPackId = BloodPack.id LEFT JOIN Reservation ON Reservation.bloodPackId = BloodPack.id WHERE BloodPack.bloodType IN ('$bloodType') AND Inventory.sent = 0 AND BloodPack.expiryDate > CURDATE()";

      $query = $this->db->query($q);
      $data["bloodPacks"] = $query->result_array();
      $data["view"] = "medicalstaff/bloodpacklist";
    } else {
      $data["view"] = "medicalstaff/search";
    }
    $this->load->view('template', $data);
  }

  public function reserve()
  {
    $data["user"] = $this->session->userdata['loggedIn'];
    $bloodPackID = $this->input->get('bloodPackId');

    $query = $this->db->query("SELECT * FROM Reservation WHERE bloodPackId = $bloodPackID AND Reservation.released = 0 AND Reservation.reservedDate > NOW() - INTERVAL 2 HOUR");
    if ($query->num_rows() > 0) {
      //Reserved
      $this->review();
      return;
    }

    $query = $this->db->query("SELECT * FROM Reservation WHERE bloodPackId = $bloodPackID");
    if ($query->num_rows() == 0)
      $query = $this->db->query("INSERT INTO Reservation VALUES($this->medicalStaffHospitalID, $bloodPackID, NOW(), 0)");
    else
      $query = $this->db->query("UPDATE Reservation SET hospitalId = $this->medicalStaffHospitalID, reservedDate = NOW(), released = 0 WHERE bloodPackId = $bloodPackID");
    $this->search();
  }

  public function review($msg = "Blood packs can only be reserved for 2 hours. Afterwards, it will be released back to the pool. ")
  {
    $data["user"] = $this->session->userdata['loggedIn'];
    $query = $this->db->query("SELECT *, BloodPack.id AS bloodPackId FROM Reservation INNER JOIN BloodPack ON Reservation.bloodPackId = BloodPack.id INNER JOIN Inventory ON BloodPack.id = Inventory.bloodPackId WHERE hospitalId = $this->medicalStaffHospitalID AND released = 0 AND Inventory.sent = 0");
    $reservations = $query->result_array();
    $data["reservations"] = $reservations;
    $data["view"] = "medicalstaff/review";
    if (strlen($msg) > 0)
      $data["message"] = $msg;
    $this->load->view('template', $data);
  }

  public function cancel()
  {
    $id = $this->input->get('id');
    $query = $this->db->query("UPDATE Reservation SET released = 1 WHERE bloodPackId = $id AND hospitalId = $this->medicalStaffHospitalID");
    $this->review();
  }

  public function request()
  {
    $id = $this->input->get('id');
    $query = $this->db->query("UPDATE Inventory SET sent = 1, sentDate = NOW() WHERE bloodPackId = $id");
    $this->review("The blood pack will be delivered to the hospital soon");
  }
}