    <?php
    session_start();

    ?>
    <?php require('common/header.php');
    $allAddress = $products->getAllAddresses();
    $allCoupons = $products->getAllCoupons();
    $discount = isset($_SESSION[1]['coupon_discounts']) ? $_SESSION['coupon_discounts'] : 0;
    ?>

    <body>

        <?php require('common/navbar.php'); ?>

        <!-- Breadcrumb Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-12">
                    <nav class="breadcrumb bg-light mb-30">
                        <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                        <a class="breadcrumb-item text-dark active" href="shop.php">Shop</a>
                        <span class="breadcrumb-item ">Shopping Cart</span>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->


        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                $ids = implode(',', array_column($_SESSION['cart'], 'productId'));
                                $getAll = $products->get($ids);

                                foreach ($getAll as $all) {
                                    $cartItem = array_values(array_filter($_SESSION['cart'], function ($item) use ($all) {
                                        return $item['productId'] == $all['prod_id'];
                                    }))[0];
                            ?>
                                    <tr>
                                        <td><img src="../assets/img/products/<?php echo $all['image_name'] ?>" alt="" style="width: 50px; height:50px"></td>
                                        <td class="align-middle"><?php echo $all['prod_price'] ?></td>
                                        <td class="align-middle">
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-minus" data-product-id="<?php echo $all['prod_id']; ?>">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $cartItem['quantity']; ?>" id="quantity_<?php echo $all['prod_id']; ?>">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary btn-plus" data-product-id="<?php echo $all['prod_id']; ?>">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle total" id="total_<?php echo $all['prod_id']; ?>" data-price="<?php echo $all['prod_price']; ?>">
                                            <?php echo $all['prod_price'] * $cartItem['quantity']; ?>
                                        </td>
                                        <td class="align-middle">
                                            <form method="post" action="../actions/remove_from_cart.php">
                                                <input type="hidden" name="product_id" value="<?php echo $all['prod_id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>Your cart is empty</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4">
                    <form class="mb-30" action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" name="coupon" id="coupon" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button class="btn btn-primary set_coupon" id="generate">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 id="" class="">Subtotal</h6>
                                <h6 id="subtotal" class="subtotal subb">0.00</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <h6 id="" class="">Discount</h6>

                                <h6><span id="discount" class="discount"><?php echo $discount; ?></span></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h5 id="">$10.00</h5>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>$<span id="total">10.00</span></h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 check">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->


        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <?php require('common/footer.php'); ?>
        <?php require('common/script.php'); ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



        <script>
            function updateQuantityInCart(productId, newQuantity, subtotal) {
                $.ajax({
                    type: 'POST',
                    url: '../actions/update_quantity.php',
                    data: {
                        productId: productId,
                        quantity: newQuantity,
                        subtotal: subtotal // Pass the subtotal to the server
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#cart_counter').text(response.newCartCounter);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update quantity in the cart.'
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('AJAX Request Failed:', textStatus, errorThrown);
                    }
                });
            }

            $(document).ready(function() {
                updateSubtotalAndShipping();

                $('#generate').on('click', function(e) {
                    e.preventDefault();
                    var name = $('#coupon').val();
                    var price = $('#subtotal').text();

                    $.ajax({
                        type: 'POST',
                        url: '../actions/get_discount.php',
                        data: {
                            name: name,
                            price: price,
                        },
                        success: function(response) {
                            var responseData = JSON.parse(response);
                            if (responseData.flag == -1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Coupon Code incorrect, please try again!',
                                    showConfirmButton: true,
                                    customClass: {
                                        confirmButton: 'button btn btn-primary app_style'
                                    }
                                });
                            }
                            if (responseData.flag == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No enough Limit to Discount',
                                    showConfirmButton: true,
                                    customClass: {
                                        confirmButton: 'button btn btn-primary app_style'
                                    }
                                });
                            }
                            if (responseData.flag == 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Expiry date has been passed',
                                    showConfirmButton: true,
                                    customClass: {
                                        confirmButton: 'button btn btn-primary app_style'
                                    }
                                });
                            }

                            updateDiscountAndTotal(responseData.discount, responseData.total);
                        }
                    });
                });

                function updateDiscountAndTotal(discount, total) {
                    $('#discount').text(discount + '%');
                    $('#total').text(isNaN(total) ? '0.00' : total.toFixed(2));
                    updateSubtotalAndShipping();
                }

                function updateSubtotalAndShipping() {
                    var subtotal = 0;

                    $('.table tbody tr').each(function() {
                        var total = parseFloat($(this).find('.total').text());
                        if (!isNaN(total)) {
                            subtotal += total;
                        }
                    });

                    var discount = parseFloat($('#discount').text());
                    var discountAmount = (subtotal * discount) / 100;

                    $('#discount').text(discount + '%');
                    $('#subtotal').text((subtotal - discountAmount).toFixed(2));
                    $('#total').text((subtotal + 10).toFixed(2));
                }

                $('.btn-minus').off().click(function() {
                    updateQuantity($(this).data('product-id'), -1);
                });

                $('.btn-plus').off().click(function() {
                    updateQuantity($(this).data('product-id'), 1);
                });

                function updateQuantity(productId, change) {
                    var quantityInput = $('#quantity_' + productId);
                    var currentQuantity = parseInt(quantityInput.val());
                    var oldQuantity = currentQuantity;

                    var newQuantity = currentQuantity + change;

                    if (newQuantity < 1) {
                        newQuantity = 1;
                    }

                    if (newQuantity > 5) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Quantity Limit Exceeded',
                            text: 'You cannot add more than 5 items of the same product.',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                newQuantity = 5;
                            } else {
                                newQuantity = oldQuantity;
                            }

                            quantityInput.val(newQuantity);
                            updateTotal(productId, newQuantity);

                            // Call the function to update quantity in the cart
                            updateQuantityInCart(productId, newQuantity);
                        });
                    } else {
                        quantityInput.val(newQuantity);
                        updateTotal(productId, newQuantity);

                        // Call the function to update quantity in the cart
                        updateQuantityInCart(productId, newQuantity);
                    }
                }

                function updateTotal(productId, quantity) {
                    var price = parseFloat($('#total_' + productId).data('price'));
                    var total = price * quantity;

                    $('#total_' + productId).text(isNaN(total) ? '0.00' : total.toFixed(2));
                    updateSubtotalAndShipping();
                }
            });
        </script>
        <script>
            $('.check').on('click', function(e) {
                var email = <?php echo isset($_SESSION['email']) ? json_encode($_SESSION['email']) : 'null'; ?>;
                var userType = <?php echo isset($_SESSION['user_type']) ? json_encode($_SESSION['user_type']) : 'null'; ?>;

                if (userType === 'client' & email !== null) {
                    var discount = $('#discount').text().replace('%', '');

                    window.location.href = 'checkout.php?discount=' + discount;
                } else {
                    e.preventDefault();
                    $.ajax({
                        cache: false,
                        type: 'POST',
                        url: '../actions/check_login.php',
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.href = 'checkout.php';

                            } else {
                                var formHtml = `
                            <form id="checkSignIn">
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" />
                                </div>
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked />
                                            <label class="form-check-label" for="rememberMe"> Remember me </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="#!" class="color-red">Forgot password?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p>Not a member? <a href="register.php">Register</a></p>
                                </div>
                            </form>`;

                                Swal.fire({
                                    title: 'Enter your credentials',
                                    html: formHtml,
                                    showCancelButton: true,
                                    confirmButtonText: 'Sign In',
                                    cancelButtonText: 'Cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var formData = {
                                            email: $('#email').val(),
                                            password: $('#password').val(),
                                            rememberMe: $('#rememberMe').is(':checked')
                                        };

                                        $.ajax({
                                            url: '../actions/check_login.php',
                                            type: 'POST',
                                            data: formData,
                                            success: function(response) {
                                                if (response.status == 'success') {
                                                    var discount = $('#discount').text().replace('%', '');

                                                    window.location.href = 'checkout.php?discount=' + discount;

                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Login Failed',
                                                        text: 'Please check your credentials and try again.'
                                                    });
                                                }
                                            }
                                        });
                                    }
                                });
                            }
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


    </body>

    </html>