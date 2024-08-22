<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin-Dashboard</title>
  </head>

  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- BOOTSTRAP LINK -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />

  <!-- BOOTSTRAP ICONS -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
  />

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-xNBoqkP1C2e3sWGsWzw4MTQ3NNkp06D9VGTLtMDz0BbqVbqH5cT6sJkZX7rNujHs0clNf0Ey1SDl9VQ6glFnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <body class="bg-metalic">
    <nav class="navbar  container-fluid bg-stripe shadow-lg text-white fixed-top">
      <div class=" container-xxl">
        <div class="row w-100 justify-content-between px-md-2 px-0">
          <div class="col-auto justify-content-center align-items-center d-flex">
            <button
              class=" bg-transparent text-white border-0"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar"
              aria-label="Toggle navigation"
            >
            <i class=" bi bi-list fs-3 text-white"></i>
              <!-- <span class="navbar-toggler-icon fs-5 text-white "></span> -->
            </button>
            
            <a class="navbar-brand text-white ps-2 p-0 " href="#"
              >Dashboard</a  >
          </div>

          <div class="col-auto">
            <button
              class="btn p-0 border-0"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasProfile"
              aria-controls="offcanvasProfile"
              aria-label="User Profile"
            >
              <i class="bi bi-person-circle fs-3 text-white"></i>
            </button>
          </div>
        </div>

        <!-- Right Side Offcanvas - User Profile -->
        <div
          class="offcanvas bg-dark offcanvas-end"
          tabindex="-1"
          id="offcanvasProfile"
          aria-labelledby="offcanvasProfileLabel"
        >
          <div class="offcanvas-header justify-content-end me-3">
            <!-- Back Button (using Bootstrap Icons) -->

            <button
              type="button"
              class="btn-back bg-transparent text-white border-0 p-0"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            >
              <i class="bi bi-arrow-left-circle fs-3"></i>
            </button>
          </div>
          <div class="offcanvas-body">
            <div class="d-flex flex-column align-items-center">
              <i class="bi bi-person-circle fs-1 mb-3"></i>
              <h6 class="fs-5 text-white"><?php echo $this->session->userdata('username'); ?></h6>
            </div>
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs text-white w-100 mt-3">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="profile-details-tab"
                  data-bs-toggle="tab"
                  href="#profile-details"
                  >Profile Details</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="settings-tab"
                  data-bs-toggle="tab"
                  href="#settings"
                  >Settings</a
                >
              </li>
            </ul>
            <!-- Tab Content -->
            <div class="tab-content mt-3">
  <div class="tab-pane fade show active" id="profile-details">
    <ul class="list-group">
      <li class="list-group-item text-truncate py-3">
        <strong>First Name:</strong>
        <em class="user-select-all ms-1"><?php echo $this->session->userdata('firstname'); ?></em>
      </li>
      <li class="list-group-item text-truncate py-3">
        <strong>Last Name:</strong>
        <em class="user-select-all ms-1"><?php echo $this->session->userdata('lastname'); ?></em>
      </li>
      <li class="list-group-item text-truncate py-3">
        <strong>Email:</strong>
        <em class="user-select-all ms-1"><?php echo $this->session->userdata('email'); ?></em>
      </li>
      <li class="list-group-item text-truncate py-3">
        <strong>Phone Number:</strong>
        <em class="user-select-all ms-1"><?php echo $this->session->userdata('phonenumber'); ?></em>
      </li>
    </ul>
  </div>
  <div class="tab-pane fade" id="settings">
    <!-- Basic Settings Placeholder -->
    <p>Settings will be configured later.</p>
  </div>
</div>

            <!-- Logout Button -->
            <a  href="<?php echo base_url('crud/adminLogout'); ?>"  class="btn btn-danger d-flex justify-content-center mx-auto col-6 mt-4">  Logout </a>

          </div>
        </div>

        <!-- Left Side Offcanvas -->
        <div
          class="offcanvas bg-dark offcanvas-start"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header d-flex  ">
          <button
              type="button"
              class="btn-back bg-transparent text-white border-0 p-0"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
              class="cursor-pointer"
            >
              <i class="bi bi-arrow-left-circle fs-3"></i>
            </button>
            <!-- <h5 class="offcanvas-title  ms-3" id="offcanvasNavbarLabel">Dashboard</h5> -->
           
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav gap-2  justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="text-white fs-4 text-decoration-none" href="#ordersList-div" onclick="handleAddUserClick()" class="nav-link active" aria-current="page">Add New User</a>
              </li>
              <li class="nav-item">
                <a class="text-white fs-4 text-decoration-none" href="#customers-div"  class="nav-link" onclick="handleClickCustomer()">Customers</a>
              </li>
              
              <li class="nav-item">
                <a class="text-white fs-4 text-decoration-none" href="#ordersList-div" class="nav-link active" onclick="handleClickOrdersList()" aria-current="page">OrdersList</a>
              </li>
              <!-- <li class="nav-item">
                <a class="text-white fs-4 text-decoration-none" class="nav-link active" aria-current="page">OrdersList</a>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li> -->
            </ul>
            <!-- <form class="d-flex mt-3" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form> -->
          </div>
        </div>
      </div>
    </nav>

    <div class="my-4 text-center bg-stripe">
  <p>~</p>

    </div>



