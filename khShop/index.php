<?php require("common/header.php"); ?>
<?php
session_start();

$allCategories = $products->getAllCategoriesss();
$allProducts = $products->getAllProducts();
$allLanding = $products->getAllCarousel();
$recentProducts = $products->getRecentProducts();
?>


<div>
    <?php require('common/navbar.php'); ?>


    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($allLanding as $index => $item) { ?>
                            <li data-target="#header-carousel" data-slide-to="<?php echo $index; ?>" <?php echo ($index === 0) ? 'class="active"' : ''; ?>></li>
                        <?php } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($allLanding as $index => $item) { ?>
                            <div class="carousel-item position-relative <?php echo ($index === 0) ? 'active' : ''; ?>" style="height: 430px;">
                                <img class="position-absolute w-100 h-100" src="../assets/img/carousel/<?php echo $item['carousel_image']; ?>" style="object-fit: cover;">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown"><?php echo $item['head_title']; ?></h1>
                                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn"><?php echo $item['primary_title']; ?></p>
                                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="shop.php">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3 ">
            <?php foreach ($allCategories as $k => $cat) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1 ">
                    <a class="text-decoration-none" href="shop.php?cat_id=<?php echo $cat['category_id'] ?>">
                        <div class="cat-item d-flex align-items-center mb-4 ">
                            <div class="overflow-hidden" style="width: 150px; height: 100px;">
                                <img class="img-fluid" src="../assets/img/categories/<?php echo $cat["cat_image"] ?>" alt="">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6><?php echo $cat['category_name'] ?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Products</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php foreach ($allProducts as $k => $prod) { ?>
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <a href="detail.php?productId=<?php echo $prod['prod_id'] ?>">
                                    <img class="img-fluid " style="width:100% !important; height:150px !important;" src="../assets/img/products/<?php echo $prod['image_name'] ?>" alt="">
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



    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php foreach ($recentProducts as $k => $prod) { ?>
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <a href="detail.php?productId=<?php echo $prod['prod_id'] ?>">
                                    <img class="img-fluid " src="../assets/img/products/<?php echo $prod['image_name'] ?>" style="width:100% !important; height:150px !important;" alt="">
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




    <?php require('common/footer.php'); ?>
    <?php require('common/script.php'); ?>
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