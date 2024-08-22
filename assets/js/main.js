const BASE_URL = "http://localhost/project01_admin/";

document.addEventListener("DOMContentLoaded", () => {
	const form = document.getElementById("addUserForm");
	const modalAlert = document.getElementById("modalAlert");
	const addUserModal = new bootstrap.Modal(
		document.getElementById("addUserModal")
	);
	const addUserModalCloseBtn = document.getElementById("addUserCloseBtn");

	form.addEventListener("submit", async (event) => {
		event.preventDefault();

		modalAlert.classList.add("d-none");
		modalAlert.classList.remove("alert-success", "alert-danger", "alert-info");

		if (!form.checkValidity()) {
			event.stopPropagation();
			form.classList.add("was-validated");
			return;
		}

		modalAlert.classList.remove("d-none");
		modalAlert.classList.add("alert-info");
		modalAlert.textContent = "Submitting...";

		try {
			const formData = new FormData(form);
			const response = await fetch(`${BASE_URL}api/addNewUser`, {
				method: "POST",
				body: formData,
			});

			const result = await response.json();

			if (response.ok && result.success) {
				modalAlert.classList.remove("alert-info");
				modalAlert.classList.add("alert-success");
				modalAlert.textContent = result.message || "User added successfully!";
				refreshCustomerData();
				setTimeout(() => {
					addUserModalCloseBtn.click();
				}, 3000);
			} else {
				throw new Error(result.message || "Failed to add user");
			}
		} catch (error) {
			// window.location.href = `${BASE_URL}application/views/errors/html/error404.php`;

			modalAlert.classList.remove("alert-info");
			modalAlert.classList.add("alert-danger");
			modalAlert.textContent = error.message;
		} finally {
			setTimeout(() => {
				modalAlert.classList.add("d-none");
			}, 3000);
		}
	});
});

document.addEventListener("DOMContentLoaded", function () {
	fetchCustomerData();
});

// Show the Add User Modal
function showAddUserModal() {
	let modal = new bootstrap.Modal(document.getElementById("addUserModal"));
	modal.show();
}

// Show the confirmation modal
function showConfirmModal() {
	let confirmModal = new bootstrap.Modal(
		document.getElementById("confirmModal")
	);
	confirmModal.show();
}

// Save changes and hide confirmation modal
document.getElementById("saveChanges").onclick = async function () {
	// Add your save logic here
	let confirmModal = bootstrap.Modal.getInstance(
		document.getElementById("confirmModal")
	);
	confirmModal.hide();
};

function fetchCustomerData() {
	fetch(`${BASE_URL}api/fetchCustomerList`)
		.then((response) => response.json())
		.then((data) => {
			const customerTable = document.getElementById("customer-table");
			const noDataMessage = document.getElementById("no-data-message");
			const customerRows = document.getElementById("customer-rows");
			const customersCountEl = document.getElementById("customersCount");

			if (data.customers.length > 0) {
				// Count the number of customers
				const customerCount = data.customers.length;
				customersCountEl.textContent = customerCount;
				console.log(data.customers);

				noDataMessage.classList.add("d-none");
				customerTable.classList.remove("d-none");
				customerRows.innerHTML = "";

				data.customers.forEach((customer, index) => {
					const row = document.createElement("div");
					row.className = "row mt-4";
					row.innerHTML = `
                    <div class="col-12 d-flex">
                        <div class="col-1 fs-6 fs-md-5" style="min-width: 80px;">${
													index + 1
												}</div>
                        <div class="col-1 d-flex align-items-center justify-content-center fs-6 fs-md-5" style="min-width: 80px;">
                            <div class="status-dot ${
															customer.isLoggedIn === "1" ? "online" : "offline"
														}"></div>
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-center gap-3 fs-6 fs-md-5" style="min-width: 150px;">
                            <span id="name-${customer.id}">${
						customer.fullName
					}</span>
                        </div>
                        <div class="col-3 fs-6 fs-md-5" id="email-${
													customer.id
												}" style="min-width: 200px;">
                            ${customer.email}
                        </div>
                        <div class="col-2 fs-6 fs-md-5" id="phone-${
													customer.id
												}" style="min-width: 120px;">
                            ${customer.phoneNumber ? customer.phoneNumber : "-"}
                        </div>
                        <div class="col-2 gap-4 fs-6 fs-md-5" style="min-width: 100px;">
                            <button class="btn btn-sm btn-primary" onclick="editUser(${
															customer.id
														})">Edit</button>
                            <button class="btn btn-sm btn-light d-none" id="cancel-${
															customer.id
														}" onclick="cancelEdit(${
						customer.id
					})">Cancel</button>
                            <button class="btn btn-sm btn-success d-none" id="save-${
															customer.id
														}" onclick="saveUser(${customer.id})">Save</button>
                            <button disabled class="btn btn-sm btn-danger d-none" id="error-${
															customer.id
														}">Failed</button>
                        </div>
                    </div>
                  `;
					customerRows.appendChild(row);
				});
			} else {
				noDataMessage.classList.remove("d-none");
				customerTable.classList.add("d-none");
				customersCountEl.textContent = "-";
			}
		})
		.catch((error) => {
			console.error("Error fetching customer data:", error);
		});
}

function refreshCustomerData() {
	const refreshLoader1 = document.getElementById("refreshLoader1");
	const customerContainer = document.getElementById("customer-container");
	fetchCustomerData();
	refreshLoader1.classList.remove("d-none");
	customerContainer.classList.add("d-none");
	setTimeout(() => {
		refreshLoader1.classList.add("d-none");
		customerContainer.classList.remove("d-none");
	}, 1000);
}

function editUser(id) {
	let nameField = document.getElementById(`name-${id}`);
	let emailField = document.getElementById(`email-${id}`);
	let phoneField = document.getElementById(`phone-${id}`);
	let editButton = document.querySelector(`button[onclick="editUser(${id})"]`);
	let cancelButton = document.getElementById(`cancel-${id}`);
	let saveButton = document.getElementById(`save-${id}`);
	let errorButton = document.getElementById(`error-${id}`);

	// Store the original content before editing
	nameField.setAttribute("data-original", nameField.textContent.trim());
	emailField.setAttribute("data-original", emailField.textContent.trim());
	phoneField.setAttribute("data-original", phoneField.textContent.trim());

	nameField.innerHTML = `<input type="text" class="form-control" value="${nameField.getAttribute(
		"data-original"
	)}">`;
	emailField.innerHTML = `<input type="text" class="form-control" value="${emailField.getAttribute(
		"data-original"
	)}">`;
	phoneField.innerHTML = `<input type="text" class="form-control" value="${phoneField.getAttribute(
		"data-original"
	)}">`;

	editButton.classList.add("d-none");
	saveButton.classList.remove("d-none");
	cancelButton.classList.remove("d-none");
}

async function saveUser(id) {
	// Show the confirmation modal
	let confirmModal = new bootstrap.Modal(
		document.getElementById("confirmModal")
	);
	confirmModal.show();

	document.getElementById("saveChanges").onclick = async function () {
		let nameField = document.getElementById(`name-${id}`);
		let emailField = document.getElementById(`email-${id}`);
		let phoneField = document.getElementById(`phone-${id}`);
		let editButton = document.querySelector(
			`button[onclick="editUser(${id})"]`
		);
		let cancelButton = document.getElementById(`cancel-${id}`);
		let saveButton = document.getElementById(`save-${id}`);
		let errorButton = document.getElementById(`error-${id}`);

		// Store the original values
		const originalName = nameField.textContent.trim();
		const originalEmail = emailField.textContent.trim();
		const originalPhone = phoneField.textContent.trim();

		// Get input values
		let name = nameField.querySelector("input").value.trim();
		let email = emailField.querySelector("input").value.trim();
		let phone = phoneField.querySelector("input").value.trim();

		// Hide previous alerts
		document.getElementById("successAlert").classList.add("d-none");
		document.getElementById("errorAlert").classList.add("d-none");

		try {
			// Call function to update customer info
			const success = await updateCustomerInfo(id, { name, email, phone });

			if (success) {
				// Update the fields
				nameField.textContent = name;
				emailField.textContent = email;
				phoneField.textContent = phone;

				// Change the Save button back to Edit button
				editButton.classList.remove("d-none");
				saveButton.classList.add("d-none");
				cancelButton.classList.add("d-none");

				// Hide the confirmation modal
				confirmModal.hide();

				// Show the success alert
				const successAlert = document.getElementById("successAlert");
				successAlert.classList.remove("d-none");

				// Automatically hide the success alert after 3 seconds
				setTimeout(() => {
					successAlert.classList.add("d-none");
				}, 3000);
			} else {
				handleFailure();
			}
		} catch (error) {
			console.error("Error saving customer info:", error);
			handleFailure();
		}

		function handleFailure() {
			// Hide the confirmation modal
			confirmModal.hide();

			// Revert the fields back to their original non-editable content
			nameField.innerHTML = nameField.getAttribute("data-original");
			emailField.innerHTML = emailField.getAttribute("data-original");
			phoneField.innerHTML = phoneField.getAttribute("data-original");

			// Show the failed button
			errorButton.classList.remove("d-none");

			// Hide the Edit, Save, and Cancel buttons
			editButton.classList.add("d-none");
			saveButton.classList.add("d-none");
			cancelButton.classList.add("d-none");

			// After 2 seconds, hide the Failed button and show the Edit button again
			setTimeout(() => {
				errorButton.classList.add("d-none");
				editButton.classList.remove("d-none");
			}, 2000);

			// Show the error alert
			const errorAlert = document.getElementById("errorAlert");
			errorAlert.classList.remove("d-none");

			// Automatically hide the error alert after 3 seconds
			setTimeout(() => {
				errorAlert.classList.add("d-none");
			}, 3000);
		}
	};
}

async function updateCustomerInfo(id, updatedData) {
	try {
		const response = await fetch(
			"http://localhost/project01_admin/api/updateCustomer",
			{
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded", // Adjust if sending JSON
				},
				body: new URLSearchParams({
					id,
					...updatedData,
				}).toString(),
			}
		);

		const result = await response.json();
		return result.success; // Check for success or failure
	} catch (error) {
		console.error("Error updating customer info:", error);
		return false;
	}
}

function cancelEdit(id) {
	let nameField = document.getElementById(`name-${id}`);
	let emailField = document.getElementById(`email-${id}`);
	let phoneField = document.getElementById(`phone-${id}`);
	let editButton = document.querySelector(`button[onclick="editUser(${id})"]`);
	let cancelButton = document.getElementById(`cancel-${id}`);
	let saveButton = document.getElementById(`save-${id}`);

	// Revert to original content
	nameField.textContent = nameField.getAttribute("data-original");
	emailField.textContent = emailField.getAttribute("data-original");
	phoneField.textContent = phoneField.getAttribute("data-original");

	// Change the Save button back to Edit button
	editButton.classList.remove("d-none");
	saveButton.classList.add("d-none");
	cancelButton.classList.add("d-none");
}

// CUSTOMER ORDERLIST
function debounce(func, delay) {
	let timeoutId;
	return function (...args) {
		clearTimeout(timeoutId);
		timeoutId = setTimeout(() => func.apply(this, args), delay);
	};
}

// Function to fetch orders list
function fetchOrdersList(email = "", phone = "", sort = "") {
	fetch(`${BASE_URL}api/fetchOrdersList`)
		.then((response) => response.json())
		.then((data) => {
			let ordersList = data.ordersList;
			const ordersCountEL = document.getElementById("ordersCount");
			const ordersCountCount = ordersList.length;
			ordersCountEL.textContent = ordersCountCount;
			console.log(ordersList);

			// Apply filter
			if (email || phone) {
				ordersList = ordersList.filter((order) => {
					const emailMatch = email
						? order.userMail.toLowerCase().includes(email.toLowerCase())
						: true;
					const phoneMatch = phone ? order.phoneNumber.includes(phone) : true;
					return emailMatch && phoneMatch;
				});
			}

			// Apply sorting
			if (sort) {
				ordersList.sort((a, b) => {
					switch (sort) {
						case "priceAsc":
							return a.totalPrice - b.totalPrice;
						case "priceDesc":
							return b.totalPrice - a.totalPrice;
						case "dateAsc":
							return new Date(a.createdAt) - new Date(b.createdAt);
						case "dateDesc":
							return new Date(b.createdAt) - new Date(a.createdAt);
						case "nameAsc":
							return a.productName.localeCompare(b.productName);
						case "nameDesc":
							return b.productName.localeCompare(a.productName);
						default:
							return 0;
					}
				});
			}

			// Clear any existing rows
			const customerRows = document.getElementById("orderList-rows");
			customerRows.innerHTML = "";

			const noProductsFound = document.querySelector(".card-footer");
			if (ordersList.length === 0) {
				// Show no results message
				noProductsFound.classList.remove("d-none");
			} else {
				// Hide no results message
				noProductsFound.classList.add("d-none");
				const orderLists = document.getElementById("orderLists");
				orderLists.classList.remove("d-none");

				// Populate rows
				ordersList.forEach((order, index) => {
					const row = document.createElement("tr");
					row.innerHTML = `
						<td class="user-select-all">
							<button id="generateInvoiceBtn-${order.orderId}" class="btn" onclick="generateInvoice('${order.orderId}')">
								<i class="bi bi-file-earmark-text"></i>
							</button>
							<div id="refreshLoader-${order.orderId}" class="d-none mt-3 text-center">
								<div class="spinner-border" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>
						</td>
						<td class="user-select-all">${index + 1}</td>
						<td class="user-select-all">${order.userName}</td>
						<td class="user-select-all">${order.userMail}</td>
						<td class="user-select-all">${order.firstName} ${order.lastName}</td>
						<td class="user-select-all">${order.phoneNumber}</td>
						<td class="user-select-all">${order.orderId}</td>
						<td class="user-select-all">${order.productName}</td>
						<td class="user-select-all">${order.productId}</td>
						<td class="user-select-all">${order.quantity}</td>
						<td class="user-select-all">${order.totalPrice}</td>
						<td class="user-select-all">${order.createdAt}</td>
						<td class="user-select-all">${order.address}, ${order.city}, ${order.pincode}</td>
					`;
					customerRows.appendChild(row);
				});
			}
		})
		.catch((error) => {
			console.error("Error fetching orders data:", error);
		});
}

// Debounced fetch function
const fetchOrdersListDebounced = debounce((email, phone, sort) => {
	fetchOrdersList(email, phone, sort);
}, 700); // 700 ms debounce delay

// Event listeners for sorting and filtering
document.addEventListener("DOMContentLoaded", () => {
	const filterEmail = document.getElementById("filterEmail");
	const filterPhone = document.getElementById("filterPhone");
	const sortBy = document.getElementById("sortBy");
	const clearSort = document.getElementById("clearSort");

	filterEmail.addEventListener("input", () => {
		const emailValue = filterEmail.value;
		const phoneValue = filterPhone.value;
		const sortValue = sortBy.value;
		fetchOrdersListDebounced(emailValue, phoneValue, sortValue);
	});

	filterPhone.addEventListener("input", () => {
		const emailValue = filterEmail.value;
		const phoneValue = filterPhone.value;
		const sortValue = sortBy.value;
		fetchOrdersListDebounced(emailValue, phoneValue, sortValue);
	});

	sortBy.addEventListener("change", () => {
		const emailValue = filterEmail.value;
		const phoneValue = filterPhone.value;
		const sortValue = sortBy.value;
		fetchOrdersListDebounced(emailValue, phoneValue, sortValue);
	});

	clearSort.addEventListener("click", () => {
		filterEmail.value = "";
		filterPhone.value = "";
		sortBy.value = "";
		fetchOrdersListDebounced();
	});

	// Initial fetch
	fetchOrdersList();
});

// Function to refresh orders list
function refreshOrdersList() {
	const refreshLoader2 = document.getElementById("refreshLoader2")
	const ordersListTable = document.getElementById("ordersListTable")
	refreshLoader2.classList.remove("d-none")
	ordersListTable.classList.add("d-none")
	fetchOrdersList();
	setTimeout(() => {
		refreshLoader2.classList.add("d-none")
		ordersListTable.classList.remove("d-none")
	}, 500);
}

	// CUSTOMER CARD BODY TOGGLE

	const customerToggleBtn = document.getElementById("customer-toggle");
	const customerList = document.getElementById("customerList");
	const toggleIcon = document.getElementById("toggle-icon");
	const customerCardHeader = document.getElementById("customerCardHeader");

	function toggleCustomers() {
		console.log("Toggling Customers"); // Check if the function is called
		customerList.classList.toggle("d-none");
		console.log(
			"Customer List is visible:",
			!customerList.classList.contains("d-none")
		); // Check visibility

		if (customerList.classList.contains("d-none")) {
			toggleIcon.classList.remove("bi-chevron-up");
			toggleIcon.classList.add("bi-chevron-down");
			customerCardHeader.classList.add("rounded");
			customerCardHeader.classList.remove("rounded-top");
		} else {
			toggleIcon.classList.remove("bi-chevron-down");
			toggleIcon.classList.add("bi-chevron-up");
			customerCardHeader.classList.remove("rounded");
			customerCardHeader.classList.add("rounded-top");
		}
	}

	customerToggleBtn.addEventListener("click", toggleCustomers);

	// CUSTOMER ORDERLIST CARD BODY TOGGLE

	const orderListToggleBtn = document.getElementById("orderList-toggle");
	const orderListToggleIcon = document.getElementById("orderList-toggle-icon");
	const orderLists = document.getElementById("orderLists");
	const ordersCardHeader = document.getElementById("ordersCardHeader");

	function toggleOrdersList() {
		orderLists.classList.toggle("d-none");
		if (!orderLists.classList.contains("d-none")) {
			orderListToggleIcon.classList.add("bi-chevron-up");
			orderListToggleIcon.classList.remove("bi-chevron-down");
			ordersCardHeader.classList.remove("rounded");
			ordersCardHeader.classList.add("rounded-top");
			console.log("jj");
		} else {
			orderListToggleIcon.classList.remove("bi-chevron-up");
			orderListToggleIcon.classList.add("bi-chevron-down");
			ordersCardHeader.classList.remove("rounded-top");
			ordersCardHeader.classList.add("rounded");
		}
	}
	orderListToggleBtn.addEventListener("click", toggleOrdersList);

// GENERATE INVOICE
function generateInvoice(orderId) {
	const refreshLoaderID = document.getElementById(`refreshLoader-${orderId}`);
	const generateInvoiceBtnID = document.getElementById(`generateInvoiceBtn-${orderId}`);
	const invoiceMsjSuccess = document.getElementById(`invoiceMsjSuccess`);
	const invoiceMsjError = document.getElementById(`invoiceMsjError`);
	
	// Ensure elements exist
	if (!refreshLoaderID || !generateInvoiceBtnID) {
			console.error("Required elements for invoice generation are missing.");
			return;
	}
	
	// Show the loader and hide the button
	refreshLoaderID.classList.remove("d-none");
	generateInvoiceBtnID.classList.add("d-none");

	// Fetch the invoice data
	fetch(`${BASE_URL}api/generateInvoice?orderId=${orderId}`)
		.then((response) => response.json())
		.then((data) => {
			console.log(data);
			if (data.success) {
				// Hide the loader and show the button
				refreshLoaderID.classList.add("d-none");
				generateInvoiceBtnID.classList.remove("d-none");

				// Load the invoice content into the modal
				const invoiceContent = `
					<iframe src="${data.downloadLink}" frameborder="0" style="width: 100%; height: 400px;"></iframe>
				`;
				document.getElementById("invoiceContent").innerHTML = invoiceContent;
				// Show the modal
				const invoiceModal = document.getElementById("invoiceModal");
				invoiceModal.style.display = "block";
				invoiceModal.classList.add("show");
				document.body.classList.add("modal-open");

				// Send the invoice to the customer via email
				sendInvoiceEmail(data.customerEmail, data.downloadLink)
					.then(() => {
						invoiceMsjSuccess.innerHTML = "Invoice generated and sent to the customer successfully.";
						// Clear the success message after 3 seconds
						setTimeout(() => {
							invoiceMsjSuccess.innerHTML = "";
						}, 3000);
					})
					.catch((error) => {
						console.error("Error sending invoice email:", error);
						invoiceMsjError.innerHTML = "<span class='text-success'>Invoice Generated</span>, <strong>but failed to send email.</strong>";
						// Clear the error message after 3 seconds
						setTimeout(() => {
							invoiceMsjError.innerHTML = "";
						}, 3000);
					});
			} else {
				// Hide the loader and show the button
				refreshLoaderID.classList.add("d-none");
				generateInvoiceBtnID.classList.remove("d-none");

				invoiceMsjError.innerHTML = "Failed to generate invoice";
				// Clear the error message after 3 seconds
				setTimeout(() => {
					invoiceMsjError.innerHTML = "";
				}, 3000);
			}
		})
		.catch((error) => {
			console.error("Error generating invoice:", error);
			// Hide the loader and show the button in case of error
			refreshLoaderID.classList.add("d-none");
			generateInvoiceBtnID.classList.remove("d-none");
		});
}



// Function to hide the modal when the close button is clicked
function closeModal() {
	const invoiceModal = document.getElementById("invoiceModal");
	invoiceModal.style.display = "none";
	invoiceModal.classList.remove("show");
	document.body.classList.remove("modal-open");
}

// Event listener for the close button
document
	.querySelector("#invoiceModal .close")
	.addEventListener("click", closeModal);

// Function to send invoice email
function sendInvoiceEmail(email, downloadLink) {
	return fetch(`${BASE_URL}api/sendInvoiceEmail`, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ email, downloadLink }),
	})
		.then((response) => response.json())
		.then((data) => {
			if (!data.success) {
				throw new Error(data.message || "Failed to send email");
			}
		});
}

// function generateInvoice(orderId) {
// 	fetch(`${BASE_URL}api/generateInvoice?orderId=${orderId}`)
// 			.then(response => response.json())
// 			.then(data => {
// 				console.log(data);
// 				if (data.success) {
// 						console.log(data.success);

// 							window.open(data.downloadLink, '_blank'); // Opens the PDF in a new tab
// 					} else {
// 							alert(data.message || 'Failed to generate invoice');
// 					}
// 			})
// 			.catch(error => {
// 					console.error('Error generating invoice:', error);
// 			});
// // }

function handleAddUserClick() {
	const offcanvasElement = document.getElementById('offcanvasNavbar'); 
  const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
	if (offcanvasInstance) {
    offcanvasInstance.hide();
  }
  // Close the modal
  const addUsermodal = new bootstrap.Modal(document.getElementById('addUserModal'));
  addUsermodal.hide();
  
	showAddUserModal()
}

function handleClickCustomer() {
	const offcanvasElement = document.getElementById('offcanvasNavbar');
	const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);

	if (offcanvasInstance) {
		offcanvasInstance.hide();
	}

	// Check if customer list is already visible
	if (customerList.classList.contains("d-none")) {
		// If not visible, toggle and then scroll into view
		toggleCustomers();
		customerList.scrollIntoView({ behavior: "smooth" });
	} else {
		// If visible, just scroll into view
		customerList.scrollIntoView({ behavior: "smooth" });
	}
}

function handleClickOrdersList() {
	const offcanvasElement = document.getElementById('offcanvasNavbar');
	const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);

	if (offcanvasInstance) {
		offcanvasInstance.hide();
	}

	// Check if orders list is already visible
	if (orderLists.classList.contains("d-none")) {
		// If not visible, toggle and then scroll into view
		toggleOrdersList();
		orderLists.scrollIntoView({ behavior: "smooth" });
	} else {
		// If visible, just scroll into view
		orderLists.scrollIntoView({ behavior: "smooth" });
	}
}
