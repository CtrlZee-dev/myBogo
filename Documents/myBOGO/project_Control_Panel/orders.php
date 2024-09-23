<?php include('./includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <?php include('./includes/sidebar.php'); ?>

        <main id="orders" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <table class="table table-striped table-hover">
                <thead>
                    <h2 class="orderh2">Order list</h2>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">12345</th>
                        <td>John Doe</td>
                        <td>2024-05-30</td>
                        <td>Pending</td>
                        <td>$150.00</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-action="view" data-id="12345"> Edit</button>
                            <button type="button" class="btn btn-secondary" data-action="edit" data-id="12345">View</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">12346</th>
                        <td>Jane Smith</td>
                        <td>2024-05-29</td>
                        <td>Complete</td>
                        <td>$200.00</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-action="view" data-id="12345"> Edit</button>
                            <button type="button" class="btn btn-secondary" data-action="edit" data-id="12345">View</button>
                        </td>
                    </tr>

                </tbody>
            </table>






            <div class="order-details" id="orderDetails" style="display: none;">
                <h2 class="orderh2">Order Details</h2>
                <form id="orderForm">
                    <div class="form-group">
                        <label for="orderID">Order ID</label>
                        <input type="text" class="form-control" id="orderID" readonly>
                    </div>
                    <div class="form-group">
                        <label for="orderDate">Date</label>
                        <input type="text" class="form-control" id="orderDate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="orderStatus">Status</label>
                        <select class="form-control" id="orderStatus" disabled>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                            <option value="shipped">Shipped</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customerEmail">Customer Email</label>
                        <input type="email" class="form-control" id="customerEmail" readonly>
                    </div>
                    <div class="form-group">
                        <label for="shippingAddress">Shipping Address</label>
                        <textarea class="form-control" id="shippingAddress" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="province">Province </label>
                        <input type="province" class="form-control" id="province" readonly>
                    </div>
                    <div class="form-group">
                        <label for="postalCode">Postal Code </label>
                        <input type="text" class="form-control" id="postalCode" readonly>
                    </div>
                    <div class="form-group">
                        <label for="orderItems">Order Items</label>
                        <table class="table table-striped" id="orderItems">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Order items will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="totalAmount">Total Amount</label>
                        <input type="text" class="form-control" id="totalAmount" readonly>
                    </div>
                    <!-- 
                    <div class="form-group">
                        <label for="orderNote">Add Note</label>
                        <textarea class="form-control" id="orderNote" rows="3" readonly></textarea>
                    </div> -->

                    <button type="button" id="saveButton" class="btn btn-success" style="display:none;">Save</button>
                    <button type="button" id="cancelButton" class="btn btn-danger" style="display:none;">Cancel Order</button>
                </form>
            </div>



        </main>
    </div>
</div>









<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderForm = document.getElementById('orderForm');
        const formFields = orderForm.querySelectorAll('input, select, textarea');
        const saveButton = document.getElementById('saveButton');
        const cancelButton = document.getElementById('cancelButton');
        const orderItemsTableBody = document.getElementById('orderItems').querySelector('tbody');
        const orderNote = document.getElementById('orderNote');
        const orderDetails = document.getElementById('orderDetails');


        function setFormEditable(isEditable) {
            formFields.forEach(field => {
                if (field.id !== 'orderID') {
                    field.readOnly = !isEditable;
                    field.disabled = !isEditable;
                }
            });
            saveButton.style.display = isEditable ? 'block' : 'none';
            cancelButton.style.display = isEditable ? 'block' : 'none';
            orderNote.readOnly = !isEditable;
        }

        function populateForm(orderData) {
            document.getElementById('orderID').value = orderData.orderID;
            document.getElementById('orderDate').value = orderData.date;
            document.getElementById('orderStatus').value = orderData.status;
            document.getElementById('customerName').value = orderData.customer;
            document.getElementById('customerEmail').value = orderData.email;
            document.getElementById('shippingAddress').value = orderData.address;
            document.getElementById('totalAmount').value = orderData.totalAmount;

            // Clear existing order items
            orderItemsTableBody.innerHTML = '';

            // Populate order items
            orderData.items.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.productName}</td>
                    <td>${item.quantity}</td>
                    <td>${item.price}</td>
                    <td>${item.total}</td>
                `;
                orderItemsTableBody.appendChild(row);
            });

            // Populate order note
            orderNote.value = orderData.note || '';
        }

        function fetchOrderData(orderId) {
            // Placeholder function to simulate fetching order data
            // Replace with actual data fetching logic
            const orders = {
                '12345': {
                    orderID: '12345',
                    date: '2024-05-30',
                    status: 'Pending',
                    customer: 'John Doe',
                    email: 'johndoe@example.com',
                    address: '123 Main St, Anytown, USA',
                    items: [{
                            productName: 'Product A',
                            quantity: 2,
                            price: '$50.00',
                            total: '$100.00'
                        },
                        {
                            productName: 'Product B',
                            quantity: 1,
                            price: '$50.00',
                            total: '$50.00'
                        }
                    ],
                    totalAmount: '$150.00',
                    note: 'Please handle with care.'
                },
                '12346': {
                    orderID: '12346',
                    date: '2024-05-29',
                    status: 'Complete',
                    customer: 'Jane Smith',
                    email: 'janesmith@example.com',
                    address: '456 Elm St, Othertown, USA',
                    items: [{
                        productName: 'Product C',
                        quantity: 1,
                        price: '$200.00',
                        total: '$200.00'
                    }],
                    totalAmount: '$200.00',
                    note: 'Leave at the front door.'
                }
                // Add more orders as needed
            };
            return orders[orderId];
        }

        function saveOrderData(orderData) {
            // Placeholder function to simulate saving order data
            // Replace with actual data saving logic
            console.log('Order data saved:', orderData);
            alert('Order data saved successfully!');
        }

        document.querySelectorAll('a[data-action]').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const action = this.dataset.action;
                const orderId = this.dataset.id;
                const orderData = fetchOrderData(orderId);

                populateForm(orderData);

                if (action === 'edit') {
                    setFormEditable(true);
                } else if (action === 'view') {
                    setFormEditable(false);
                }
            });
        });

        saveButton.addEventListener('click', function() {
            const orderData = {
                orderID: document.getElementById('orderID').value,
                date: document.getElementById('orderDate').value,
                status: document.getElementById('orderStatus').value,
                customer: document.getElementById('customerName').value,
                email: document.getElementById('customerEmail').value,
                address: document.getElementById('shippingAddress').value,
                items: Array.from(orderItemsTableBody.querySelectorAll('tr')).map(row => {
                    const cells = row.querySelectorAll('td');
                    return {
                        productName: cells[0].innerText,
                        quantity: cells[1].innerText,
                        price: cells[2].innerText,
                        total: cells[3].innerText
                    };
                }),
                totalAmount: document.getElementById('totalAmount').value,
                note: orderNote.value
            };
            saveOrderData(orderData);
        });



        cancelButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to cancel this order?')) {
                document.getElementById('orderStatus').value = 'canceled';
                saveButton.click();
            }
        });



        document.querySelectorAll('a[data-action="view"]').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const orderId = this.dataset.id;
                const orderData = fetchOrderData(orderId);
                populateOrderDetails(orderData);
                orderDetails.style.display = 'block';
            });
        });
    });
</script>