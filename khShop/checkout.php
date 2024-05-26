<?php require('common/header.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
$discount = $_GET['discount'];
$email = $_SESSION['email'];
$AllContact = $products->getContactByEmail($email);

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
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form action="../actions/updateUser.php" id="addForm">
                        <div class="row">
                            <div class="col-md-6 form-group" hidden>
                                <label>UserId</label>
                                <input class="form-control" name="userID" value="<?php echo $AllContact[0]['user_id'] ?>" type="text" placeholder="First Name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group" hidden>
                                <label>Address</label>
                                <input class="form-control" name="addressID" value="<?php echo $AllContact[0]['address_id'] ?>" type="text" placeholder="First Name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Fist Name</label>
                                <input class="form-control" name="firstName" value="<?php echo $AllContact[0]['client_firstName'] ?>" type="text" placeholder="First Name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" name="lastName" value="<?php echo $AllContact[0]['client_lastName'] ?>" type="text" placeholder="Last Name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Street Nbr</label>
                                <input class="form-control" name="streetNbr" value="<?php echo $AllContact[0]['street_nb'] ?>" type="text" placeholder="123 Street" required autocomplete="off">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" value="<?php echo $AllContact[0]['country'] ?>" type="text" placeholder="123 Street" required autocomplete="off">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" name="city" type="text" value="<?php echo $AllContact[0]['city'] ?>" placeholder="New York" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" name="state" type="text" value="<?php echo $AllContact[0]['state'] ?>" placeholder="New York" required autocomplete="off">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" name="zipCode" type="number" value="<?php echo $AllContact[0]['zipCode'] ?>" placeholder="123" required autocomplete="off">
                            </div>

                        </div>
                        <div class=" text-end w-25 ">
                            <input class="form-control bg-primary text-white p-2" type="submit" value="Update" placeholder="123">
                        </div>
                    </form>


                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Order Total</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="mb-3">Products</h6>
                            <h6 class="mb-3">Price</h6>
                            <h6 class="mb-3">Quantity</h6>
                            <h6 class="mb-3">Subtotal</h6>
                        </div>
                        <?php
                        $subtotal = 0;

                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            $ids = implode(',', array_column($_SESSION['cart'], 'productId'));
                            $products = new products();
                            $getAll = $products->get($ids);

                            foreach ($getAll as $k => $all) {
                                echo '<div class="d-flex justify-content-between">';
                                echo '<p>' . $all['prod_name'] . '</p>';
                                echo '<p>$' . $all['prod_price'] . '</p>';
                                $quantity = $_SESSION['cart'][$k]['quantity'];
                                echo '<p> ' . $quantity . '</p>';
                                $productSubtotal = $all['prod_price'] * $quantity;
                                echo '<p> $' . $productSubtotal . '</p>';
                                echo '</div>';
                                $subtotal += $productSubtotal;
                            }
                        }
                        $discount = $_GET['discount']; // Retrieve discount from the URL parameter
                        $discountAmount = ($subtotal * $discount) / 100;
                        $adjustedSubtotal = $subtotal - $discountAmount;

                        $shippingCost = 10; // Fixed shipping cost

                        $total = $adjustedSubtotal + $shippingCost;


                        ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$<?php echo number_format($subtotal, 2); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium">%<?php echo $discount ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>

                            <h5>$ <span id="total-price"><?php echo number_format($total, 2); ?></span> </h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">

                    <button id="placeOrder" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Checkout End -->



    <?php require('common/footer.php'); ?>
    <?php require('common/script.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var discount = <?php echo $_GET['discount'] ?>;

            $('#addForm').submit(function(e) {
                e.preventDefault();
                var form = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: form,
                    success: function(response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary '
                                }
                            }).then(function() {
                                window.location.href = 'checkout.php?discount=' + discount;
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary '
                                }
                            });
                        }
                    }
                });
            });


            $('#placeOrder').click(function(e) {
                e.preventDefault();
                var totalPrice = document.getElementById('total-price').innerText;
                // Create form data with the total price
                var formData = new FormData();
                formData.append('totalPrice', totalPrice);
                $.ajax({
                    url: '../actions/add_order.php',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,

                    success: function(response) {
                        // console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary '
                                }
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary '
                                }
                            });
                        }
                    }
                });
            });
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