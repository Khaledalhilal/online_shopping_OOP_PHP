<?php require('common/header.php'); ?>
<?php
session_start();
$allProducts = $products->getAllProductsGroupByID($_GET['productId']);
$allProductsBySize = $products->getAllProductsGroupSize($_GET['productId']);
$allProductsByColors = $products->getAllProductsGroupColor($_GET['productId']);
$mightLikeProduct = $products->getAllProducts();
// var_dump($_SESSION);exit;
?>



<body>
    <?php require('common/navbar.php'); ?>



    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <?php foreach ($allProducts as $k => $prod) { ?>
                            <div class="carousel-item <?php echo ($k == 0) ? 'active' : ''; ?>">
                                <img class="w-100 h-100" src="../assets/img/products/<?php echo $prod['image_name'] ?>" alt="Image">
                            </div>
                        <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $allProducts[0]['prod_name'] ?></h3>
                    <h3 class="font-weight-semi-bold mb-4">$<?php echo $allProducts[0]['prod_price']  ?></h3>
                    <p class="mb-4"><?php echo $allProducts[0]['prod_description'] ?></p>

                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        <form>
                            <?php foreach ($allProductsBySize as $k => $prod) { ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-<?php echo $k ?>" name="size" value="<?php echo $prod['size'] ?>">
                                    <label class="custom-control-label mr-4 ml-2" for="size-<?php echo $k ?>">
                                        <?php echo strtoupper($prod['size']); ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </form>
                    </div>

                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            <?php foreach ($allProductsByColors as $k => $prod) { ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-<?php echo $k ?>" name="color" value="<?php echo $prod['color'] ?>">
                                    <label class="custom-control-label" for="color-<?php echo $k ?>"><?php echo $prod['color'] ?></label>
                                </div>
                            <?php } ?>
                        </form>
                    </div>


                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus" onclick="decrement()">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="qty" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus" onclick="increment()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 add-to-cart" id="incrementButton" data-id="<?php echo $_GET['productId']; ?>" onclick="addToCart()">
                            <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Products</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php foreach ($mightLikeProduct as $k => $prod) { ?>
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <a href="detail.php?productId=<?php echo $prod['prod_id'] ?>">
                                    <img class="img-fluid w-100" style="width:100% !important; height:150px !important;" src="../assets/img/products/<?php echo $prod['image_name'] ?>" alt="">
                                </a>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="detail.php"><?php echo $prod['prod_name'] ?></a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$<?php echo $prod['prod_price'] ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php require('common/footer.php'); ?>

    <!-- Footer End -->

    <!-- Back to Top -->
    <?php require('common/script.php'); ?>

    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function(e) {
                e.preventDefault();
                var productId = <?php echo $_GET['productId'] ?>;
                var productId = $(this).data('id');
                var selectedSize = $("input[name='size']:checked").val();
                var selectedColor = $("input[name='color']:checked").val();
                var quantity = $("#qty").val();

                $.ajax({
                    type: 'GET',
                    url: '../actions/addToCart.php',
                    data: {
                        productId: productId,
                        size: selectedSize,
                        color: selectedColor,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Product Added to Cart',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'detail.php?productId=' + productId;
                            });
                            updateCartCount();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    }
                });
            });

            function updateCartCount() {
                $.ajax({
                    type: 'GET',
                    url: 'get_cart_count.php',
                    success: function(count) {
                        $('#cart-count').text(count);
                    }
                });
            }
        });
    </script>
    <script>
        function updateCartCounter(value) {
            var counterElement = document.getElementById('cart-count');
            if (counterElement) {
                counterElement.textContent = value;
            }
        }
        updateCartCounter(<?php echo isset($_SESSION['cartCounter']) ? $_SESSION['cartCounter'] : 0; ?>);
    </script>
    <script>
        function increment() {
            var inputField = document.getElementById('qty');
            var currentValue = parseInt(inputField.value, 10);
            if (currentValue > 4) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Quantity Limit Exceeded',
                    text: 'You cannot add more than 5 items of the same product.',
                    confirmButtonText: 'OK',
                });
                inputField.value = 5;
            } else {
                inputField.value = currentValue + 1;
            }
        }

        function decrement() {
            var inputField = document.getElementById('qty');
            var currentValue = parseInt(inputField.value, 10);

            if (currentValue > 1) {
                inputField.value = currentValue - 1;
            }
        }
    </script>
</body>

</html>