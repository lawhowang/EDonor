<?php
class Staff extends CI_Controller {

  private $userID;
  private $donorID;
  private $username;
  private $firstName;
  private $lastName;
  private $email;

  private $staffID;
  private $venueID;

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('url');
    if (isset($this->session->userdata['loggedIn']) && $this->session->userdata['loggedIn']['isStaff'] == 1) {
      $this->userID = $this->session->userdata['loggedIn']['userID'];
      $this->donorID = $this->session->userdata['loggedIn']['donorID'];
      $this->username = $this->session->userdata['loggedIn']['username'];
      $this->firstName = $this->session->userdata['loggedIn']['firstName'];
      $this->lastName = $this->session->userdata['loggedIn']['lastName'];
      $this->email = $this->session->userdata['loggedIn']['email'];
      $this->staffID = $this->session->userdata['loggedIn']['staffData']['ID'];
      $this->venueID = $this->session->userdata['loggedIn']['staffData']['venueID'];
    } else {
      $data["view"] = "login-form";
      $this->load->view('template', $data);
    }
  }

  public function verify()
  {
    if ($this->input->post('referenceNumber')) {
        $referenceNumber = $this->input->post('referenceNumber');
        $query = $this->db->query("SELECT * FROM Appointment WHERE id = $referenceNumber AND completed = 0");
        if ($query->num_rows() == 0) {
            $data["message"] = "Appointment not found or has completed.<br/>Please enter a valid appointment reference number to verify a donor.";
        } else {
            $verifyingDonorId = $query->row()->donorId;
            $query = $this->db->query("UPDATE Donor SET verificationStatus = 1 WHERE id = $verifyingDonorId");
            $bloodType = $this->input->post('bloodType');
            if (!$this->input->post('whiteBloodCell') || !$this->input->post('entryDate') || !$this->input->post('expiryDate')) {
                $data["message"] = "Please fill in all the field first";
            } else {
                $whiteBloodCell = $this->input->post('whiteBloodCell');
                $redBloodCell = $this->input->post('redBloodCell');
                $hemoglobin = $this->input->post('hemoglobin');
                $hematocrit = $this->input->post('hematocrit');

                if (!preg_match('/^\d+\.\d+$/', $whiteBloodCell) || !preg_match('/^\d+\.\d+$/', $redBloodCell) || !preg_match('/^\d+\.\d+$/', $hemoglobin) || !preg_match('/^\d+\.\d+$/', $hematocrit)) {
                    $data["message"] = "Only decimal numbers can be input for the Blood Cell fields";
                } else {
                    $entryDate = $this->input->post('entryDate');
                    $expiryDate = $this->input->post('expiryDate');
                    if ($entryDate > $expiryDate)
                        $data["message"] = "Expiry date must be after entry date";
                    else {
                        $this->db->trans_begin();
                        $query = $this->db->query("UPDATE Appointment SET completed = 1 WHERE id = $referenceNumber");
                        $query = $this->db->query("UPDATE Donor SET bloodType = '$bloodType' WHERE id = $verifyingDonorId");
                        $query = $this->db->query("INSERT INTO BloodPack VALUES (NULL, '$bloodType', $whiteBloodCell, $redBloodCell, $hemoglobin, $hematocrit, '$entryDate', '$expiryDate')");
                        if ($this->db->affected_rows() > 0) {
                            $bloodPackID = $this->db->insert_id();
                            $query = $this->db->query("INSERT INTO Inventory VALUES (NULL, $bloodPackID, 0, NULL, 0, NULL)");
                            $query = $this->db->query("INSERT INTO Donation VALUES ($verifyingDonorId, $bloodPackID, $this->venueID, $this->staffID, NULL)");
                            if ($this->db->affected_rows() > 0) {
                                $this->db->trans_commit();
                                $data["message"] = 'Record has been added successfully!';
                            } else {
                                $this->db->trans_rollback();
                            }
                        } else {
                            $this->db->trans_rollback();
                        }
                    }
                }
            }
        }
    }
    $data["user"] = $this->session->userdata['loggedIn'];
    $data["view"] = "staff/user/verify";
    $this->load->view('template', $data);
  }

}