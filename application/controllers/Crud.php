<?php

// Require Composer autoload file
require_once(APPPATH . '../vendor/autoload.php');
use Dompdf\Dompdf;


class Crud extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('crud_model');
    $this->load->helper('url'); // Make sure the URL helper is loaded
    $this->load->library('session');
  }


  // LogIn function

  public function adminLogin()
  {

    if ($this->input->server('REQUEST_METHOD') === 'POST') {

      $data = array(
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password')
      );

      $adminInfo = $this->crud_model->validateAdmin($data);

      if ($adminInfo) {
        $this->session->set_userdata('username', $adminInfo->username);
        $this->session->set_userdata('firstname', $adminInfo->firstname);
        $this->session->set_userdata('lastname', $adminInfo->lastname);
        $this->session->set_userdata('email', $adminInfo->email);
        $this->session->set_userdata('phonenumber', $adminInfo->phonenumber);

        // Update login status in the database
        $this->crud_model->updateLoginStatus($adminInfo->username, true);

        redirect(base_url('dashboard'));

      } else {
        $this->load->view('errors/NoUserFound');

      }

    } else {
      $this->load->view('login');
    }
  }


  // Logout function
  public function adminLogout()
  {
    $username = $this->session->userdata('username');
    $this->crud_model->updateLoginStatus($username, false);

    // Destroy session data
    $this->session->sess_destroy();

    redirect(base_url('welcome'));
  }


  public function fetchCustomerList()
  {
    // Fetch the customer data from the 'users' table
    $query = $this->db->get('users');

    // Check if any data is found
    if ($query->num_rows() > 0) {
      $data['customers'] = $query->result_array(); // Get the result as an array of arrays
    } else {
      $data['customers'] = array(); // Return an empty array if no data is found
    }
    echo json_encode($data);
  }

  public function fetchCustomerById($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('users');

    if ($query->num_rows() > 0) {
      return $query->row_array(); // Return a single row as an associative array
    } else {
      return null; // Return null if no data found
    }
  }

  public function updateCustomer()
  {
    // Retrieve POST data
    $id = $this->input->post('id');
    $fullName = $this->input->post('name');
    $email = $this->input->post('email');
    $phoneNumber = $this->input->post('phone');

    // Split the full name into first name and last name
    $nameParts = explode(' ', $fullName, 2); // Split into at most 2 parts
    $firstName = $nameParts[0]; // First part as first name
    $lastName = isset($nameParts[1]) ? $nameParts[1] : ''; // Second part as last name (if available)

    $lastUpdatedBy = $this->session->userdata('username');


    // Validate the input data if needed

    // Prepare data for update
    $data = array(
      'firstName' => $firstName,
      'fullName' => $fullName,
      'lastName' => $lastName,
      'email' => $email,
      'phoneNumber' => $phoneNumber,
      'lastUpdatedBy' => $lastUpdatedBy
    );

    // Check if customer exists before updating
    $customer = $this->fetchCustomerById($id);

    if ($customer) {
      $this->db->where('id', $id);
      $this->db->update('users', $data);

      if ($this->db->affected_rows() > 0) {
        // Update successful
        $response = array('success' => true);
      } else {
        // No rows updated, possibly no change in data
        $response = array('success' => false, 'message' => 'No changes made.');
      }
    } else {
      // Customer not found
      $response = array('success' => false, 'message' => 'Customer not found.');
    }

    echo json_encode($response);
  }

  public function addNewUser()
  {
    if ($this->input->server('REQUEST_METHOD') === "POST") {
      $email = $this->input->post('email');
      $existing_user = $this->crud_model->getUserByEmail($email);
      if ($existing_user) {
        echo json_encode(['success' => false, 'message' => 'Email address already exists']);
        return;
      }
      // Retrieve the username from session
      $lastUpdatedBy = $this->session->userdata('username');

      if (empty($lastUpdatedBy)) {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve admin username for updating']);
        return;
      }
      $data = array(
        'email' => $email,
        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        'isLoggedIn' => 0, // Set isLoggedIn to 0 for new users
        'firstName' => $this->input->post('firstName'),
        'lastName' => $this->input->post('lastName'),
        'fullName' => $this->input->post('firstName') . ' ' . $this->input->post('lastName'),
        'phoneNumber' => $this->input->post('phoneNumber'),
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
        'lastUpdatedBy' => $lastUpdatedBy
      );

      $response = $this->crud_model->createNewUser($data);

      if (is_array($response) && isset($response['error'])) {
        echo json_encode(['success' => false, 'message' => $response['error']]);
      } else if ($response === true) {
        echo json_encode(['success' => true, 'message' => 'New User Added Successfully']);
      } else {
        echo json_encode(['success' => false, 'message' => 'Failed to Add New User']);
      }
    } else {
      echo json_encode(['success' => false, 'message' => 'Invalid Request']);

    }
  }


  public function fetchOrdersList()
  {
    $query = $this->db->get('ordersList');
    if ($query->num_rows() > 0) {
      $data['ordersList'] = $query->result_array();
    } else {
      $data['ordersList'] = array();
    }
    echo json_encode($data);


  }


  // INVOICE GENERATE
  public function generateInvoice()
  {
    $orderId = $this->input->get('orderId');

    // Load order details
    $this->load->model('crud_model');
    $order = $this->crud_model->getOrderById($orderId);

    if (!$order) {
      echo json_encode(['success' => false, 'message' => 'Order not found']);
      return;
    }


    // Load invoice view
    $html = $this->load->view('invoiceTemplate', ['order' => $order], true);

    // Initialize Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Generate PDF
    $output = $dompdf->output();
    $pdfFileName = "invoice_{$orderId}.pdf";
    $pdfFilePath = FCPATH . 'application/invoices/' . $pdfFileName;

    // Save PDF to file
    file_put_contents($pdfFilePath, $output);

    // Provide download link
    echo json_encode([
      'success' => true,
      'downloadLink' => base_url('application/invoices/' . $pdfFileName),
      'customerEmail' => $order['userMail']
    ]);
  }


  // SENDVOICEMAIL

  public function sendInvoiceEmail()
  {
    $postData = json_decode($this->input->raw_input_stream, true);
    $email = $postData['email'];
    $downloadLink = $postData['downloadLink'];

    // Load the email library
    $this->load->library('email');
    // Email configuration
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.office365.com',
      'smtp_port' => 587, // Ensure it's 587 for TLS
      'smtp_user' => 'muthukumaran@inetcsc.com', // Your Office 365 email
      'smtp_pass' => 'Inet@tech24', // Your Office 365 email password
      'smtp_crypto' => 'tls', // Ensure it's set to 'tls'
      'mailtype' => 'html', // or 'text' depending on your email content
      'charset' => 'utf-8',
      'wordwrap' => TRUE,
      'newline' => "\r\n", // Important for some servers to recognize line breaks
      'crlf' => "\r\n"
  );
  
    $this->email->initialize($config);


    $this->email->from('muthukumaran@inetcsc.com', 'INet');
    $this->email->to($email);
    // $this->email->to("muthu888mukesh@gmail.com");
    $this->email->subject('Your Invoice is Ready');
    $this->email->message("Dear Customer,\n\nYour invoice is ready. You can download it using the link below:\n\n" . $downloadLink . "\n\nThank you for your business!");

    // Send the email
    if ($this->email->send()) {
      echo json_encode(['success' => true]);
    } else {
      // Output the email error message for debugging
      echo json_encode(['success' => false, 'message' => $this->email->print_debugger()]);
    }
  }


}