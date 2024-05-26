<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php require('common/header.php');
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require("class/products.class.php");
$products = new products();
$cat_count = $products->countCategories();
$prod_count = $products->countProducts();
$order_count = $products->countOrders();
$user_count = $products->countUsers();
$orders = $products->getOrdersForChar();
$categories = $products->getCategoriesForChar();
$productChar = $products->getProductsPerCategoriesForChar();
$prod = $products->getProductsForChar();

?>

<body class="sb-nav-fixed bg-light">

    <?php require('common/navbar.php') ?>

    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4 bg-white py-3 shadow">
                        <li class="breadcrumb-item ">
                            <a href="index.php" class="text-black ms-4">
                                Dashboard
                        </li>
                        </a>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card bg-primary text-white mb-4 border-0 shadow-sm border-radius-0" >
                                <h5 class="card-body ms-4">Nbr of Categories</h5>
                                <div class="card-footer">
                                    <h3 class="text-center counter"><?php echo $cat_count[0]['cat_count'] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card bg-warning text-white mb-4 border-0">
                                <h5 class="card-body ms-4">Nbr Of Products</h5>
                                <div class="card-footer">
                                    <h3 class="text-center counter"><?php echo $prod_count[0]['prod_count'] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card bg-success text-white mb-4 border-0">
                                <h5 class="card-body ms-4">Nbr Of Orders</h5>
                                <div class="card-footer">
                                    <h3 class="text-center counter"><?php echo $order_count[0]['order_count'] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 ">
                            <div class="card bg-danger text-white mb-4 border-0">
                                <h5 class="card-body ms-4">Nbr of Users</h5>
                                <div class="card-footer">
                                    <h3 class="text-center counter"><?php echo $user_count[0]['user_count'] ?></h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4" style="border-radius:0px;">
                                <div class="card-header" style="background-color:#FFD333 !important;border-radius:0px;">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Products and Orders
                                </div>

                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4" style="border-radius:0px;">
                                <div class="card-header" style="background-color:#FFD333 !important;border-radius:0px;">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Categories and Products
                                </div>

                                <div class="card-body">
                                    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>

                                </div>
                            </div>
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
        <?php $XValues = [];
        $YValues = [];

        foreach ($prod as $value) {
            $XValues[] = $value['prod_name'];
        }
        foreach ($orders as $value) {
            $YValues[] = $value['orderPerProd'];
        }
        ?>
        var xValues = <?php echo json_encode($XValues); ?>;
        var yValues = <?php echo json_encode($YValues); ?>;
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Number Of Orders for each product",
                }
            }
        });
    </script>
    <script>
        <?php
        $data = [];

        foreach ($productChar as $value) {
            $data[] = [
                'category' => $value['category_name'],
                'count' => $value['product_count']
            ];
        }
        ?>
        var chartData = <?php echo json_encode($data); ?>;
        var xValues = chartData.map(item => item.category);
        var yValues = chartData.map(item => item.count);

        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Categories'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Product Count'
                        },
                        ticks: {
                            beginAtZero: true 
                        }
                    }]
                },
                title: {
                    display: true,
                    text: "Related Products For Categories",
                }
            }
        });
    </script>



    <!-- To Counter Up the Nbrs in the cards -->
    <script>
        $(document).ready(function() {

            $('.counter').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>
</body>

</html>