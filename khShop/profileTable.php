<?php session_start();

require('common/header.php');
?>
<?php
$email = $_SESSION['email'];
$allContact = $products->getContactByEmail($email);


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

    @media only screen and (max-width: 600px) {
        .display-sm-none {
            display: none !important;
        }
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
                                <center>
                                    <form id="registrationForm" action="../actions/updateProfile.php">
                                        <div class="row g-0">
                                            <div class="col-lg-12" style="background-color: #3D464D !important;">
                                                <div class="p-5">
                                                    <h3 class="fw-normal mb-5" style="color: #FFD333 !important;">Account Information</h3>

                                                    <div class="col-md-6 mb-4 pb-2" hidden>

                                                        <div class="form-outline">
                                                            <input type="text" id="form3Examplev2" value="<?php echo $allContact[0]['user_id'] ?>" name="userID" class="form-control form-control-lg" required autocomplete="off" />
                                                            <label class="form-label text-white" for="form3Examplev2">user ID</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4 pb-2 input-group mb-3">
                                                        <label class="input-group-text display-sm-none" style="background-color: #FFD333;width:125px" for="form3Examplev2">First name</label>
                                                        <input type="text" id="form3Examplev2" value="<?php echo $allContact[0]['firstName'] ?>" name="firstName" class="form-control form-control-lg" required autocomplete="off" />
                                                    </div>
                                                    <div class="col-md-6 mb-4 pb-2 input-group mb-3">
                                                        <label class="input-group-text display-sm-none" style="background-color: #FFD333;width:125px" for="form3Examplev3">Last name</label>
                                                        <input type="text" id="form3Examplev3" value="<?php echo $allContact[0]['lastName'] ?>" name="lastName" class="form-control form-control-lg" required autocomplete="off" />
                                                    </div>


                                                    <div class="col-md-6 mb-4 pb-2 input-group mb-3">
                                                        <label class="input-group-text display-sm-none" style="background-color: #FFD333;width:125px" for="form3Examplev4">E-mail</label>
                                                        <input type="email" id="form3Examplev4" value="<?php echo $allContact[0]['email'] ?>" name="email" class="form-control form-control-lg" required autocomplete="off" />
                                                    </div>
                                                    <div class="col-md-6  pb-2 input-group ">
                                                        <label class="input-group-text display-sm-none" style="background-color: #FFD333; width:125px" for="form3Examplea8">Phone Number</label>
                                                        <input type="number" id="form3Examplea8" value="<?php echo $allContact[0]['phone_number'] ?>" name="phoneNb" class="form-control form-control-lg" required autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class=" mt-0" style="margin-left:100px;margin-top:-30px !important;">
                                                    <input class=" btn bg-danger text-white mb-4 " type="submit" value="Update">
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                </center>
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

                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.href = 'profileTable.php';
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