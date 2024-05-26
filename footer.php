<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/footer.class.php');
$footer = new footer();
$all = $footer->getAll();


?>
<?php require('common/header.php') ?>

<div class="modal fade" id="updateCoupon1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">update Phone Nbr</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateCategory" action="actions/categories/update_categories.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text">ID</span>
                        <input type="text" name="category_id" id="updateID" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category Name</span>
                        <input type="text" name="category_name" id="updateName" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" name="images" class="form-control" placeholder="Category Name">
                    </div>
                    <div id="imagee"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
                    <h1 class="mt-4">Footer</h1>
                    <ol class="breadcrumb mb-4 bg-white py-3 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ">
                                <a href="index.php" class="text-dark text-decoration ms-4">Dashboard</a> / <a href="footer.php" class="text-dark">Footer</a>
                            </li>
                        </div>
                    </ol>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="shadow p-3 mb-5 bg-body rounded">
                                <h4 class="text-center mb-2">Address</h4>
                                <div class="card-body">
                                    <?php foreach ($all as $items) { ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="addressInput_<?php echo $items["footer_id"] ?>" value="<?php echo $items['address'] ?>">
                                            <span class="input-group-text" style="background-color: #FFD333 !important;border-radius:0px;">
                                                <button class="btn updateAddress text-white" data-id="<?php echo $items["footer_id"] ?>">
                                                    Update
                                                </button>
                                            </span>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-3">
                            <div class="shadow p-3 mb-5 bg-body rounded">
                                <h4 class="text-center mb-2">E-mail</h4>
                                <div class="card-body">
                                    <?php foreach ($all as $items) { ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="emailInput_<?php echo $items["footer_id"] ?>" value="<?php echo $items['email'] ?>">
                                            <span class="input-group-text" style="background-color: #FFD333 !important;border-radius:0px;">
                                                <button class="btn updateEmail text-white" data-id="<?php echo $items["footer_id"] ?>">
                                                    Update
                                                </button>
                                            </span>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <center>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="shadow p-3 mb-5 bg-body rounded">
                                    <h4 class="text-center mb-2">Phone Number</h4>
                                    <div class="card-body">
                                        <?php foreach ($all as $items) { ?>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="phoneInput_<?php echo $items["footer_id"] ?>" value="<?php echo $items['phone_number'] ?>">
                                                <span class="input-group-text" style="background-color: #FFD333 !important;border-radius:0px;">
                                                    <button class="btn updatePhone text-white" data-id="<?php echo $items["footer_id"] ?>">
                                                        Update
                                                    </button>
                                                </span>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </center>
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


            $('.updateAddress').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var address = $('#addressInput_' + id).val();

                $.ajax({
                    url: 'actions/update_footer/address.php',
                    type: 'POST',
                    data: {
                        footer_id: id,
                        address: address,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'an error occurred, please try again',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        } else {

                        }
                    }
                });
            });

            $('.updateEmail').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var email = $('#emailInput_' + id).val();

                $.ajax({
                    url: 'actions/update_footer/email.php',
                    type: 'POST',
                    data: {
                        footer_id: id,
                        email: email,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'an error occurred, please try again',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        } else {

                        }
                    }
                });
            });
            $('.updatePhone').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var phone = $('#phoneInput_' + id).val();

                $.ajax({
                    url: 'actions/update_footer/phoneNb.php',
                    type: 'POST',
                    data: {
                        footer_id: id,
                        phone: phone,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'an error occurred, please try again',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        } else {

                        }
                    }
                });
            });






        });
    </script>