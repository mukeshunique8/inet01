<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice-logo {
            max-width: 150px;
        }
        .invoice-header, .invoice-footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 2px solid #007bff;
        }
        .invoice-body {
            margin-top: 20px;
        }
        .invoice-table th {
            background-color: #007bff;
            color: #fff;
        }
        .invoice-table {
            margin-top: 20px;
        }
        .invoice-footer {
            text-align: center;
            background-color: #e9ecef;
            border-top: 2px solid #007bff;
        }
        .footer-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details p {
            margin: 0;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="invoice-header d-flex justify-content-between align-items-center">
            <img src="assets/img/inetLogo.jpg" alt="Company Logo" class="invoice-logo">
            <div class="text-right">
                <h1 class="display-4 text-primary">Invoice</h1>
                <p><strong>Order ID:</strong> <?= $order['orderId'] ?></p>
                <p><strong>Date:</strong> <?= $order['createdAt'] ?></p>
            </div>
        </div>

        <div class="invoice-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-primary">Customer Details</h4>
                    <p><strong>Name:</strong> <?= $order['userName'] ?></p>
                    <p><strong>Email:</strong> <?= $order['userMail'] ?></p>
                    <p><strong>Phone:</strong> <?= $order['phoneNumber'] ?></p>
                </div>
                <div class="col-md-6">
                    <h4 class="text-primary">Order Details</h4>
                    <table class="table table-bordered invoice-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $order['productName'] ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td><?= $order['totalPrice'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="invoice-details">
                <p><strong>Note:</strong> This is a system-generated digital invoice. Please retain it for your records.</p>
            </div>
        </div>

        <div class="invoice-footer">
            <p class="footer-text">Thank you for your purchase! If you have any questions, please contact us.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
