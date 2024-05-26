<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/orders.class.php');
$orders = new orders();
$allOrders = $orders->getAllOrdersByName($_GET['fName'], $_GET['lName']);


?>

<?php require('common/header.php') ?>
<div class="modal fade" id="info" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header" style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">More Details About Order</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Product Name</th>
                            <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Price</th>
                            <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Quantity</th>
                            <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetailsBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<body class="sb-nav-fixed bg-light">
    <?php require('common/navbar.php') ?>
    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Orders Info </h1>
                    <ol class="breadcrumb mb-4 bg-white py-3 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ">
                                <a href="index.php" class="text-dark text-decoration ms-4">Dashboard</a> / <a href="order_info.php" class="text-dark"> Orders Info.</a>
                            </li>
                        </div>
                    </ol>
                    <div class="row mb-4 bg-white p-2 " style="min-height: 300px;">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Client Name</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">E-mail</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Phone Number</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Status</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($allOrders as $or) {

                                    ?>
                                        <tr class="text-center">
                                            <td id="name" class="text-center"><?php echo $or['client_firstName'] ?> <?php echo $or['client_lastName'] ?></td>
                                            <td id="name" class="text-center"> <?php echo $or['email'] ?></td>
                                            <td id="name" class="text-center"> <?php echo $or['phone_number'] ?></td>
                                            <td id="name" class="text-center"><?php echo $or['status'] ?></td>
                                            <td>
                                                <button type="button" class="btn edit" data-order-id="<?php echo $or['order_id']; ?>" data-first-name="<?php echo $or['client_firstName']; ?>" data-last-name="<?php echo $or['client_lastName']; ?>" data-bs-toggle="modal" data-bs-target="#info">
                                                    <i class="fa fa-fw fa-solid fa-eye" style="background-color: white !important;color:blue;" title="more Info"></i>
                                                </button>
                                            </td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php require('common/footer.php') ?>
        </div>
    </div>
    <?php require('common/script.php') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            new DataTable('#dataTable');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit').on('click', function() {
                var orderId = $(this).data('order-id');
                var firstName = $(this).data('first-name');
                var lastName = $(this).data('last-name');

                // Use AJAX to fetch product details for the specific order
                $.ajax({
                    type: 'POST',
                    url: 'actions/get_order_details.php', // Create a PHP script to fetch order details
                    data: {
                        orderId: orderId,
                        fName: firstName,
                        lName: lastName,

                    },
                    success: function(response) {
                        // Parse the response JSON and update modal content
                        var orderDetails = JSON.parse(response);
                        updateModalContent(orderDetails);
                    }
                });
            });

            function updateModalContent(orderDetails) {
                var tbody = $('#orderDetailsBody');
                tbody.empty();

                orderDetails.forEach(function(product) {
                    var row = '<tr>';
                    row += '<td class="text-center">' + product.productName + '</td>';
                    row += '<td class="text-center">$' + product.price + '</td>';
                    row += '<td class="text-center">' + product.quantity + '</td>';
                    row += '<td class="text-center">$' + product.total + '</td>';
                    row += '</tr>';
                    tbody.append(row);
                });
            }
        });
    </script>