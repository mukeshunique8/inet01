<div id="customer-div" class="container-fluid   ">
  <div class="container-xxl  position-relative border-0">
    <div id="" class="card border-0 mt-4 text-center text-white">
      <div id="customerCardHeader" class="card-header rounded bg-stripe  border-0 justify-content-between w-100 d-flex">
        <h2 class="fw-light fs-4 text-white">Customers</h2>
        <button id="customer-toggle" class="btn border-0 p-0">
          <i id="toggle-icon" class="bi bi-chevron-down text-white"></i>
        </button>
      </div>
      <div id="customerList" class="card-body p-0  rounded-bottom web-2 d-none">
        <div class="d-flex gap-5 justify-content-end">
          <button class="bg-transparent text-white fs-4 border-0 rounded" onclick="refreshCustomerData()">
            <i class="bi bi-arrow-clockwise"></i>
          </button>
          <button onclick="showAddUserModal()" class="bg-transparent fs-4 border-0 rounded text-white">
            <i class="bi bi-plus-lg"></i>
          </button>
        </div>
        <div id="refreshLoader1" class="d-none my-3 text-center">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <!-- TABLE -->
        <div class="no-scrollbar" id="customer-container">

          <div id="customer-table">
            <div class="fw-bold py-3  d-flex">
              <div class="col-1 fs-6 fs-md-5" style="min-width: 80px;">No</div>
              <div class="col-1 fs-6 fs-md-5" style="min-width: 80px;">Status</div>
              <div class="col-3 fs-6 fs-md-5" style="min-width: 150px;">Name</div>
              <div class="col-3 fs-6 fs-md-5" style="min-width: 200px;">Email</div>
              <div class="col-2 fs-6 fs-md-5" style="min-width: 120px;">Phone</div>
              <div class="col-2 fs-6 fs-md-5" style="min-width: 100px;">Actions</div>
            </div>
            <!-- Placeholder for dynamic rows -->
            <div id="customer-rows" class="no-scrollbar" style="max-height: 400px; overflow-y: auto;">
              <!-- Dynamic rows will be added here -->
            </div>
          </div>

        </div>

        <div id="no-data-message" class="d-none">
          <p>No users found.</p>
        </div>
      </div>


      <!-- Add User Modal -->

      <div class="modal fade text-black" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
              <button id="addUserCloseBtn" type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
  <form id="addUserForm" novalidate>
    <div class="row mb-3">
      <div class="col-auto">
        <label for="firstName" class="form-label">First Name:</label>
      </div>
      <div class="col">
        <input type="text" class="form-control" id="firstName" name="firstName" required>
        <div class="invalid-feedback">Please enter a first name.</div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-auto">
        <label for="lastName" class="form-label">Last Name:</label>
      </div>
      <div class="col">
        <input type="text" class="form-control" id="lastName" name="lastName" required>
        <div class="invalid-feedback">Please enter a last name.</div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-auto">
        <label for="email" class="form-label">Email:</label>
      </div>
      <div class="col">
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-auto">
        <label for="phoneNumber" class="form-label">Phone Number:</label>
      </div>
      <div class="col">
        <div class="input-group">
          <span class="input-group-text">+91</span>
          <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
          <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-auto">
        <label for="password" class="form-label">Password:</label>
      </div>
      <div class="col">
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="invalid-feedback">Please enter a password.</div>
      </div>
    </div>
    <div id="modalAlert" class="alert d-none"></div>
    <div class="text-end">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>



          </div>
        </div>
      </div>


      <!--  Confirmation Modal -->
      <div class="modal fade text-black" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmModalLabel">Confirm Changes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to save the changes?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="saveChanges">Save</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- <div class="card-footer">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veritatis, a deleniti. Dicta necessitatibus pariatur reprehenderit nihil aut voluptates enim optio eligendi velit alias!</p>
      </div> -->
  </div>

  <!-- ALERT  -->
  <div
    class="position-absolute container row justify-content-center align-items-center mt-5 z-3 top-0 start-50 translate-middle">
    <!-- Success Alert -->
    <div id="successAlert" class="alert text-center col-12 col-md-6 alert-success d-none" role="alert">
      Customer information updated successfully!
    </div>

    <!-- Error Alert -->
    <div id="errorAlert" class="alert col-12 text-center col-md-6 alert-danger d-none" role="alert">
      Failed to update customer information. Please try again.
    </div>
  </div>
</div>
</div>