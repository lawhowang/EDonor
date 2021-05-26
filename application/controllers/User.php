<?php
class User extends CI_Controller {

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

  public function info()
  {
    if (isset($this->session->userdata['loggedIn'])) {
      $data["view"] = "user/info";
      $data["user"] = $this->session->userdata['loggedIn'];

      $query = $this->db->query("SELECT DATE(Users.registrationDateTime) AS registrationDate, Users.lastLoginDateTime, Donor.bloodType, Donor.gender, Donor.birthDate, Donor.emergencyContact, Donor.verificationStatus FROM Users LEFT JOIN Donor ON Users.id = Donor.userId AND Users.id = $this->userID");
      $data["bloodType"] = strlen($query->row()->bloodType) > 0 ? $query->row()->bloodType : 'No donation records' ;
      $data["gender"] = $query->row()->gender == "M" ? "Male" : "Female";
      $data["birthDate"] = $query->row()->birthDate;
      $data["registrationDate"] = $query->row()->registrationDate;
      $data["emergencyContact"] = $query->row()->emergencyContact;
      $data["verificationStatus"] = $query->row()->verificationStatus == 0 ? "Not verified" : "Verified";
      $this->load->view('template', $data);
    }
  }

  public function edit()
  {
    if (isset($this->session->userdata['loggedIn'])) {
      $data["message"] = "";
      if ($this->input->server('REQUEST_METHOD') == 'POST') {
        $firstName = $this->input->post('firstname');
        $lastName = $this->input->post('lastname');
        $birthDate = $this->input->post('birthDate');
        $gender = $this->input->post('gender') == 'M' ? 'M' : 'F';
        $password = $this->input->post('password');
				$email = $this->input->post('email');
				$emergencyContact = $this->input->post('emergencyContact');
        $errormsg = "";

        $query = $this->db->query("SELECT id from Users WHERE email = '$email' AND id <> $this->userID");
        if ($query->num_rows() > 0) {
          $errormsg .= "Email already exists<br>";
        }
        if (strlen($errormsg) == 0) {
					$this->db->trans_begin();
          $this->db->query("UPDATE Donor SET firstName = '$firstName', lastName = '$lastName', birthDate = '$birthDate', gender = '$gender', emergencyContact = '$emergencyContact' WHERE id = $this->donorID");
          if ($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
            $errormsg .= "Error while updating donor information<br>";
          } else {
            if (strlen($password) > 0)
              $this->db->query("UPDATE Users SET email = '$email', password = MD5('$password') WHERE id = $this->userID");
            else
              $this->db->query("UPDATE Users SET email = '$email' WHERE id = $this->userID");
						if ($this->db->trans_status() === FALSE) {
							$this->db->trans_rollback();
							$errormsg .= "Error while updating user information<br>";
            } else {
							$this->db->trans_commit();
							$this->session->userdata['loggedIn']['firstName'] = $firstName;
							$this->session->userdata['loggedIn']['lastName'] = $lastName;
							$this->session->userdata['loggedIn']['email'] = $email;
							$errormsg .= "Successfully updated<br>";
            }
          }
        }
        $data["message"] = $errormsg;
      }
      $data["view"] = "user/edit";
      $data["user"] = $this->session->userdata['loggedIn'];

      $query = $this->db->query("SELECT DATE(Users.registrationDateTime) AS registrationDate, Users.lastLoginDateTime, Donor.bloodType, Donor.gender, Donor.birthDate, Donor.emergencyContact, Donor.verificationStatus FROM Users LEFT JOIN Donor ON Users.id = Donor.userId AND Users.id = $this->userID");
      $data["bloodType"] = $query->row()->bloodType;
      $data["gender"] = $query->row()->gender;
      $data["birthDate"] = $query->row()->birthDate;
      $data["registrationDate"] = $query->row()->registrationDate;
      $data["emergencyContact"] = $query->row()->emergencyContact;
      $data["verificationStatus"] = $query->row()->verificationStatus == 0 ? "Not verified" : "Verified";
      $this->load->view('template', $data);
    }
  }

}