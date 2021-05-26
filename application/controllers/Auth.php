<?php
class Auth extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function index()
  {
    $this->login();
  }

  public function register($message = '')
  {
    if (isset($this->session->userdata['loggedIn'])) {
      redirect('/main');
      return;
    }
    $data["view"] = "registration-form";
    $data["message"] = $message;
    $this->load->view('template', $data);
  }

  public function login($message = '')
  {
    $data["view"] = "login-form";
    $data["message"] = $message;
    $this->load->view('template', $data);
  }

  public function processRegistration() {
    $firstName = $this->input->post('firstname');
    $lastName = $this->input->post('lastname');
    $birthDate = $this->input->post('birthDate');
    $gender = $this->input->post('gender') == 'M' ? 'M' : 'F';
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $email = $this->input->post('email');

    $errormsg = "";

    if (!$firstName) {
      $errormsg .= "Please enter your first name<br>";
    }
    
    if (!$lastName) {
      $errormsg .= "Please enter your last name<br>";
    }

    if (!$birthDate) {
      $errormsg .= "Please enter your birth date<br>";
    }

    if (!$gender) {
      $errormsg .= "Please enter your gender<br>";
    }

    if (!$username) {
      $errormsg .= "Please enter your username<br>";
    } else {
      $query = $this->db->query("SELECT id from Users WHERE username = '$username'");
      if ($query->num_rows() > 0) {
        $errormsg .= "Username already exists<br>";
      }
    }

    if (!$password) {
      $errormsg .= "Please enter your password<br>";
    }

    if (!$email) {
      $errormsg .= "Please enter your email<br>";
    } else {
      $query = $this->db->query("SELECT id from Users WHERE email = '$email'");
      if ($query->num_rows() > 0) {
        $errormsg .= "Email already exists<br>";
      }
    }

    if (strlen($errormsg) > 0) {
      $this->register($errormsg);
      return;
    }

    $this->db->trans_begin();
    $query = $this->db->query("INSERT INTO Users VALUES (NULL, '$username', MD5('$password'), '$email', NULL, NULL)");
    if ($this->db->affected_rows() > 0) {
      $userID = $this->db->insert_id();
      $query = $this->db->query("INSERT INTO Donor VALUES (NULL, $userID, '$firstName', '$lastName', '$gender', '$birthDate', NULL, NULL, 0, NULL)");
      if ($this->db->affected_rows() > 0) {
        $donorID = $this->db->insert_id();
        $this->db->trans_commit();
        $sessionData = array(
          'userID' => $userID,
          'donorID' => $donorID,
          'username' => $username,
          'firstName' => $firstName,
          'lastName' => $lastName,
          'email' => $email,
          'isDonor' => 1,
          'isStaff' => 0,
          'isMedicalStaff' => 0
        );
        $this->session->set_userdata('loggedIn', $sessionData);
        redirect('/main');
      } else {
        $this->db->trans_rollback();
      }
    } else {
      $this->db->trans_rollback();
    }
  }

  public function processLogin() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $query = $this->db->query("SELECT Users.id as userId, Donor.id as donorId, username, firstName, lastName, email FROM Users LEFT JOIN Donor ON Donor.userId = Users.id WHERE (username = '$username' OR email = '$username') AND password = MD5('$password')");
    if ($query->num_rows() > 0) {
      $userID = $query->row()->userId;
      $this->db->query("UPDATE Users SET lastLoginDateTime = NOW() WHERE id = $userID");
      if (!isset($query->row()->donorId))
        $isDonor = 0;
      else {
        $donorID = $query->row()->donorId;
        $isDonor = 1;
      }
      $username = $query->row()->username;
      $firstName = $query->row()->firstName;
      $lastName = $query->row()->lastName;
      $email = $query->row()->email;

      $query = $this->db->query("SELECT * FROM Staff WHERE userId = $userID");
      $isStaff = $query->num_rows() > 0 ? 1 : 0;
      if ($isStaff) {
        $staffID = $query->row()->id;
        $staffVenueID = $query->row()->venueId;
        $username = $query->row()->username;
        $firstName = $query->row()->firstName;
        $lastName = $query->row()->lastName;
        $email = $query->row()->email;
      }

      $query = $this->db->query("SELECT * FROM MedicalStaff WHERE userId = $userID");
      $isMedicalStaff = $query->num_rows() > 0 ? 1 : 0;
      if ($isMedicalStaff) {
        $medicalStaffID = $query->row()->id;
        $medicalStaffHospitalID = $query->row()->hospitalId;
        $username = $query->row()->username;
        $firstName = $query->row()->firstName;
        $lastName = $query->row()->lastName;
        $email = $query->row()->email;
      }

      $sessionData = array(
        'userID' => $userID,
        'donorID' => $donorID,
        'username' => $username,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'isDonor' => $isDonor,
        'isStaff' => $isStaff,
        'isMedicalStaff' => $isMedicalStaff
      );

      if ($isStaff) {
        $sessionData['staffData'] = array(
          'ID' => $staffID,
          'venueID' => $staffVenueID
        );
      }
      if ($isMedicalStaff) {
        $sessionData['medicalStaffData'] = array(
          'ID' => $medicalStaffID,
          'hospitalID' => $medicalStaffHospitalID
        );
      }
      
      $this->session->set_userdata('loggedIn', $sessionData);
      redirect('/main');
    } else {
      $this->login('Invalid username or password');
    }
  }

  public function logout() {
    $sessionData = array();
    $this->session->unset_userdata('loggedIn', $sessionData);
    redirect('/main');
  }
}