<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/orders.class.php');
$orders = new orders();
$allOrders = $orders->getAllOrdersGroupByName();
$allProducts = $orders->getAllProducts();
$allUsers = $orders->getAllUsers();
?>

<?php require('common/header.php') ?>

<body class="sb-nav-fixed bg-light">
    <?php require('common/navbar.php') ?>
    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Orders</h1>
                    <ol class="breadcrumb mb-4 bg-white py-3 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ">
                                <a href="index.php" class="text-dark text-decoration ms-4">Dashboard</a> / <a href="order.php" class="text-dark"> Orders</a>
                            </li>
                        </div>
                    </ol>
                    <div class="row mb-4 bg-white p-2 " style="min-height: 300px;">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">User Name</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Date</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allOrders as $or) { ?>
                                        <tr class="text-center">
                                            <td id="name" class="text-center"><?php echo $or['firstName'] ?> <?php echo $or['lastName'] ?></td>

                                            <td id="name" class="text-center"><?php echo $or['order_date'] ?></td>

                                            <td>

                                                <a href="order_info.php?fName=<?php echo $or['firstName'] ?>&lName=<?php echo $or['lastName'] ?>">
                                                    <i class="fa fa-fw fa-solid fa-eye" style="background-color: white;" title="more Info"></i>
                                                </a>
                                            </td>
                                        </tr>
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