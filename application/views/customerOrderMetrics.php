<div class="container-fluid mt-3">
  <div class="container   align-items-center gap-3  d-flex flex-column flex-md-row flex-wrap justify-content-around text-center py-5 rounded border-0">
    <!-- Card for Number of Customers -->
    <div class="card hover text-white shadow-lg web-1 border-0 col-12 col-md-4 p-2 d-flex align-items-center mb-3 mb-md-0" style="max-width: 300px;">
      <img class="card-img-top mb-3"
           src="assets/img/userIcon.svg"
           alt="User Profile"
           style="max-width: 150px; width: 100%; height: auto;">
      <div class="card-body d-flex flex-column align-items-center">
        <h5 class="text-nowrap">Number of Customers</h5>
        <p id="customersCount" class="display-6 text-white">~</p>
        <a class="text-white" onclick="toggleCustomers()" href="#customer-div">View all customers</a>
      </div>
    </div>
    <!-- Card for Number of Orders -->
    <div class="card text-white shadow-lg web-2 border-0 col-12 col-md-4 p-2 d-flex align-items-center mb-3 mb-md-0" style="max-width: 300px;">
      <img class="card-img-top mb-3"
           src="assets/img/orderIcon.svg"
           alt="User Profile"
           style="max-width: 150px; width: 100%; height: auto;">
      <div class="card-body d-flex flex-column align-items-center">
        <h5 class="text-nowrap">Number of Orders</h5>
        <p id="ordersCount" class="display-6 text-white">~</p>
        <a class="text-white" onclick="toggleOrdersList()" href="#ordersList-div">View all Orders</a>
      </div>
    </div>
    <!-- Card for Number of Admins -->
    <div class="card text-white shadow-lg web-3 border-0 col-12 col-md-4 p-2 d-flex align-items-center" style="max-width: 300px;">
      <img class="card-img-top mb-3"
           src="assets/img/userIcon.svg"
           alt="User Profile"
           style="max-width: 150px; width: 100%; height: auto;">
      <div class="card-body d-flex flex-column align-items-center">
        <h5 class="text-nowrap">Number of Admins</h5>
        <p class="display-6 text-white">3</p>
        <a class="text-white" onclick="toggleCustomers()" href="#customer-div">View all customers</a>
      </div>
    </div>
  </div>
</div>
