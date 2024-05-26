<?php require("common/header.php"); ?>
<?php
session_start();
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $allProducts = $products->getAllCategoriesById($cat_id);
    $max_price = $products->getMaxPrices();
    $min_price = $products->getMinPrices();
    $allColors = $products->getColors();
    $allSizes = $products->getSizes();
} else {
    $allProducts = $products->getAllCategories();
    $max_price = $products->getMaxPrices();
    $min_price = $products->getMinPrices();
    $allColors = $products->getColors();
    $allSizes = $products->getSizes();
}

?>

<style>
    .range-form {
        width: 400px;
        margin: auto;
        padding: 50px;
    }

    .range-slider {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 10px;
        border-radius: 5px;
        background: #FFD333 !important;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;

        &:hover {
            opacity: 1;
        }

        &::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            background: #6C757D !important;
            cursor: pointer;
            border-radius: 50%;
        }

        &::-moz-range-thumb {
            width: 18px;
            height: 18px;
            background: #6C757D !important;
            cursor: pointer;
        }
    }
</style>

<body>
    <?php require("common/navbar.php"); ?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="row non-filter mb-5" id="productContainer">

    </div>

    <!-- Shop Start -->
    <div class="container-fluid">
        <form method="post" id="search_form">
            <div class="row px-xl-5">
                <div class="col-lg-3 col-md-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form class="range-form">
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input type="range" min="<?php echo $min_price[0]['min_price'] ?>" max="<?php echo $max_price[0]['max_price'] ?>" value="<?php echo ($min_price[0]['min_price'] + $max_price[0]['max_price']) / 2; ?>" class="form-control-range range-slider" id="myRange" oninput="updatePrice(this.value)">
                                </div>
                                <div class="col-md-3">
                                    <span id="demo"><?php echo $min_price[0]['min_price']; ?></span> $
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Color Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="" checked>
                            <label class="custom-control-label" for="size-all">All Colors</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <?php foreach ($allColors as $k => $color) { ?>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input " id="size-1">
                                <label>
                                    <input type="checkbox" class="product_check" id="colors" value="<?php echo $products->cleanString(strtoupper($color['color'])) ?>"> <?php echo $color['color'] ?></label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- Color End -->

                    <!-- Size Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <?php foreach ($allSizes as $k => $size) { ?>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input " id="size-1">
                                <label>
                                    <input type="checkbox" class="product_check" id="sizes" value="<?php echo $products->cleanString(strtoupper($size['size'])) ?>"> <?php echo $size['size'] ?></label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- Size End -->
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 col-md-8">
                            <div class="text-center">
                                <img src="" id="loader" width="200" style="display: none;" alt="">
                            </div>
                            <div class="row pb-3" id="result">
                                <?php ?>
                                <?php
                                if (empty($allProducts)) {

                                    echo '<div class="col-12 text-center">';
                                    echo "<h2 class='ms-4'>No Products for this category</h2>";
                                    echo '</div>';
                                } else {
                                    foreach ($allProducts as $k => $prod) { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <div>
                                                        <a href="detail.php?productId=<?php echo $prod['prod_id']; ?>">
                                                            <img class="img-fluid " src="../assets/img/products/<?php echo $prod['image_name']; ?>" alt="<?php echo $prod['prod_name']; ?>" style="width:100% !important; height:150px !important;">
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href="details.php?productId=<?php echo $prod['prod_id']; ?>">
                                                        <?php echo $prod['prod_name']; ?>
                                                    </a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5><?php echo $prod['prod_price']; ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="col-12" id="pagination_link">

                        </div>

                    </div>
                </div>
                <!-- Shop Product End -->

            </div>


        </form>
    </div>
    <!-- Shop End -->


    <?php require('common/footer.php'); ?>
    <?php require('common/script.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $(".product_check").click(function() {
                updateProducts();
            });

            $("#myRange").on("input", function() {
                updatePrice(this.value);
                updateProducts();
            });

            function updatePrice(value) {
                document.getElementById("demo").textContent = value;
            }

            function updateProducts() {
                $("#loader").show();

                var action = 'data';
                var colors = get_filter_text('colors');
                var sizes = get_filter_text('sizes');
                var minPrice = $("#myRange").data('user-interacted') === true ? $("#myRange").val() : null;

                $.ajax({
                    url: "../actions/load_products.php",
                    method: 'POST',
                    data: {
                        action: action,
                        colors: colors,
                        sizes: sizes,
                        minPrice: minPrice
                    },
                    success: function(response) {
                        $("#result").html(response);
                        $("#loader").hide();
                    },
                });
            }

            $(document).ready(function() {
                $(".product_check").click(function() {
                    updateProducts();
                });

                $("#myRange").on("input", function() {
                    $("#myRange").data('user-interacted', true);
                    updatePrice(this.value);
                    updateProducts();
                });

                function updatePrice(value) {
                    document.getElementById("demo").textContent = value;
                }

                function get_filter_text(text_id) {
                    var filterData = [];
                    $('#' + text_id + ':checked').each(function() {
                        filterData.push($(this).val());
                    });
                    return filterData;
                }
            });


            function get_filter_text(text_id) {
                var filterData = [];
                $('#' + text_id + ':checked').each(function() {
                    filterData.push($(this).val());
                });
                return filterData;
            }
        });
    </script>
    <?php require("common/script.php"); ?>
    <script>
        function updateCartCounter(value) {
            var counterElement = document.getElementById('cart-count');
            if (counterElement) {
                counterElement.textContent = value;
            }
        }

        updateCartCounter(<?php echo isset($_SESSION['cartCounter']) ? $_SESSION['cartCounter'] : 0; ?>);
    </script>

</body>

</html>