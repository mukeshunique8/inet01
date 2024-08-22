<?php

class Crud_model extends CI_Model
{


  // Validate user credentials during login
  public function validateAdmin($data)
  {
    // Check if user exists with the given email and password
    $this->db->where('username', $data['username']);
    $this->db->where('password', $data['password']);
    $query = $this->db->get('admins');
    return $query->row();
  }

  // Update user's login status

  public function updateLoginStatus($username, $status) {
    $data = array( 'isLoggedIn' => $status  );

    $this->db->where('username', $username);
    $this->db->update('admins', $data);
}
 

public function createNewUser($data) {
  $this->db->insert('users', $data);
  if ($this->db->affected_rows() > 0) {
      return true;
  } else {
      return array('error' => 'Failed to insert user data');
  }
}

public function getUserByEmail($email) {
  $this->db->where('email', $email);
  $query = $this->db->get('users');
  return $query->row_array();
}

public function getOrderById($orderId) {
  // Example query - adjust as needed
  $this->db->where('orderId', $orderId);
  $query = $this->db->get('ordersList'); // Replace 'orders' with your actual table name
  return $query->row_array(); // Returns a single row as an associative array
}

}

