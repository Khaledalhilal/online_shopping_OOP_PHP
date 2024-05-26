<?php require('common/header.php');
session_start();
?>
<style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }


    .bg-indigo {
        background-color: #FFD333 !important;
    }
</style>

<body>
    <?php
    require('common/navbar.php'); ?>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item ">Checkout</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <section class="h-100 h-custom ">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <form id="registrationForm" action="../actions/addUser.php">
                                    <div class="row g-0">
                                        <div class="col-lg-6" style="background-color: #3D464D !important;">
                                            <div class="p-5">
                                                <h3 class="fw-normal mb-5" style="color: #FFD333 !important;">Account Information</h3>
                                                <div class="row">
                                                    <div class="col-md-6 mb-4 pb-2">

                                                        <div class="form-outline">
                                                            <input type="text" id="form3Examplev2" name="firstName" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label text-white" for="form3Examplev2">First name</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 pb-2">

                                                        <div class="form-outline">
                                                            <input type="text" id="form3Examplev3" name="lastName" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label text-white" for="form3Examplev3">Last name</label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="email" id="form3Examplev4" name="email" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label text-white" for="form3Examplev4">E-mail</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-5 mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="form3Examplea7" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label text-white" for="form3Examplea7">Code +</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="form3Examplea8" name="phoneNb" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label text-white " for="form3Examplea8">Phone Number</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="password" name="password" id="pass" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label text-white" for="form3Examplev5">Password</label>
                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input type="password" name="RepeatPassword" id="repeatPass" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label text-white" for="form3Examplev5">Repeat Password</label>
                                                    </div>
                                                    <!-- Display error message if passwords do not match -->
                                                    <label class="form-label text-white" id="passwordMatchError"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 bg-indigo text-white">
                                            <div class="p-5">
                                                <h3 class="fw-normal mb-5">Address Details</h3>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="form3Examplea2" name="streetNb" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label" for="form3Examplea2">Street + Nr</label>
                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="form3Examplea3" name="state" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label" for="form3Examplea3">State</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5 mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <input type="number" id="form3Examplea4" name="zipCode" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label" for="form3Examplea4">Zip Code</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-7 mb-4 pb-2">
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="form3Examplea5" name="city" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label" for="form3Examplea5">City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 mb-4 pb-2" hidden>
                                                        <div class="form-outline form-white">
                                                            <input type="text" id="form3Examplea5" name="userType" class="form-control form-control-lg" value="client" required autocomplete="off" />
                                                            <label class="form-label" for="form3Examplea5">UserType</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="form3Examplea6" name="country" class="form-control form-control-lg" required autocomplete="off" />
                                                        <label class="form-label" for="form3Examplea6">Country</label>
                                                    </div>
                                                </div>


                                                <div class="form-check d-flex justify-content-start mb-4 pb-3">
                                                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" />
                                                    <label class="form-check-label text-white" for="form2Example3">
                                                        I do accept the <a href="#!" class="text-white"><u>Terms and Conditions</u></a> of KH
                                                        SHOP
                                                    </label>
                                                </div>

                                                <button type="submit" class="btn btn-light btn-lg" data-mdb-ripple-color="dark">Register</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require('common/footer.php'); ?>
    <?php require('common/script.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(e) {
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
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                footer: '<a href="profileTable.php" style="color: red !important;">Do You Want to Update Your Address?</a>',

                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.href = 'cart.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
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