<div id="ordersList-div" class="container-fluid ">
  <!-- Container -->
  <div class="container-xxl  border-0">
    <div class="card border-0 text-white mt-5 text-center">
      <!-- Card Header -->
      <div id="ordersCardHeader"
        class="card-header rounded-top bg-stripe  border-0 d-flex justify-content-between align-items-center">
        <h2 class="fw-light text-white fs-4">OrdersList</h2>
        <button id="orderList-toggle" class="btn border-0 p-0">
          <i id="orderList-toggle-icon" class="bi bi-chevron-down text-white"></i>
        </button>
      </div>



      <div id="orderLists" class="card-body rounded-bottom web-2  overflow-auto d-none">
        <!-- Filters and Sorts -->
        <div id="filter-sort" class="card-body  mb-3  ">
          <!-- Filter By -->
          <div class="d-flex justify-content-start align-items-center mb-3">
            <h5 class="me-3 text-nowrap">Filter By:</h5>
            <input id="filterEmail" type="text" class="form-control me-2" placeholder="Filter by Email" />
            <input id="filterPhone" type="text" class="form-control me-2" placeholder="Filter by Phone" />
            <button class="bg-transparent text-white fs-4 border-0 rounded" onclick="refreshOrdersList()">
            <i class="bi bi-arrow-clockwise"></i>
          </button>
          </div>

          <!-- Sort By -->
          <div class="d-flex justify-content-start align-items-center mb-3">
            <h5 class="me-3 text-nowrap">Sort By:</h5>
            <select id="sortBy" class="form-select">
              <option value="">Select Sort</option>
              <option value="priceAsc">Price Low to High</option>
              <option value="priceDesc">Price High to Low</option>
              <option value="dateAsc">Date Oldest to Newest</option>
              <option value="dateDesc">Date Newest to Oldest</option>
              <option value="nameAsc">Product Name A to Z</option>
              <option value="nameDesc">Product Name Z to A</option>
            </select>
            <button id="clearSort" class="btn btn-light  ms-2">Clear</button>
          </div>
        </div>
        <div id="refreshLoader2" class="d-none mt-3 text-center">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <!-- Table -->
        <div id="ordersListTable" class="table-responsive bg-light rounded no-scrollbar" style="max-height: 400px;">
          <table class="table table-bordered table-hover">
            <!-- Table Header -->
            <thead class="thead-light">
              <tr>
                <th style="min-width: 50px;">Invoice</th>
                <th style="min-width: 50px;">No</th>
                <th style="min-width: 150px;">OrderBy</th>
                <th style="min-width: 150px;">E-mail</th>
                <th style="min-width: 150px;">Receiver Name</th>
                <th style="min-width: 150px;">Receiver Mobile</th>
                <th style="min-width: 150px;">OrderID</th>
                <th style="min-width: 150px;">ProductName</th>
                <th style="min-width: 150px;">ProductId</th>
                <th style="min-width: 150px;">Quantity</th>
                <th style="min-width: 150px;">Price</th>
                <th style="min-width: 300px;">OrderedAt</th>
                <th style="min-width: 350px;">Delivery Address</th>
              </tr>
            </thead>
            <!-- Table Body -->
            <tbody id="orderList-rows">
              <!-- Dynamic rows will be added here -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Card Footer -->
      <div class="card-footer d-none">
        <p class="text-center text-danger">No Products Found</p>
      </div>
    </div>

   
<!-- Invoice Preview Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header row text-center">
        <!-- <h5 class="modal-title" id="invoiceModalLabel">Invoice Preview</h5>  -->
       
        <div class="col-10">
        <p class="text-success " id="invoiceMsjSuccess"></p>
        <p class="text-danger" id="invoiceMsjError"></p>
        </div>
         <button type="button" class="close border-0 bg-transparent col-2 fs-4" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
        
      </div>
      <div class="modal-body" id="invoiceContent">
        <!-- Invoice content will be loaded here -->
      </div>
      <div class="modal-footer">
        <!-- <p class="text-success" id="invoiceMsjSuccess"></p>
        <p class="text-danger" id="invoiceMsjError"></p> -->
      </div>
    </div>
  </div>
</div>


  </div>
</div>