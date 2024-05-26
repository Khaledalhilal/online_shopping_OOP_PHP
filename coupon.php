<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/coupon.class.php');
$coupons = new coupon();
$allCoupons = $coupons->getAllCoupon();



?>

<?php require('common/header.php') ?>
<!-- add Modal Start -->
<div class="modal fade" id="addProduct1" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addProduct">Add Coupon Code</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/coupons/add_coupon.php" id="addForm" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Name</span>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Limit</span>
                        <input type="number" name="Limit" class="form-control" placeholder="Enter Limit" required autocomplete="off">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Expiry Date</span>
                        <input type="date" name="date" class="form-control" placeholder="Enter Expiry Date" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Discount</span>
                        <input type="number" name="discount" class="form-control" placeholder="Enter Discount" required autocomplete="off">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- add Modal End -->
<div class="modal fade" id="updateCoupon1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header" style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">Update Coupon Code</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateCoupon" action="actions/coupons/update_coupon.php" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text" style="width: 130px;">ID</span>
                        <input id="updateID" type="text" name="id" class="form-control" placeholder="Enter ID" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Name</span>
                        <input id="updateName" type="text" name="name" class="form-control" placeholder="Enter Name" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Limit</span>
                        <input id="updateLimit" type="number" name="limit" class="form-control" placeholder="Enter Limit" required autocomplete="off">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Expiry Date</span>
                        <input id="updateDate" type="date" name="date" class="form-control" placeholder="Enter Expiry Date" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Discount</span>
                        <input id="updateDiscount" type="number" name="discount" class="form-control" placeholder="Enter Discount" required autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
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
                <div class="container-fluid mt-4">
                    <ol class="breadcrumb  bg-white py-3 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ps-2">
                                <a href="index.php" class="text-dark text-decoration">Dashboard</a> / <a href="coupon.php" class="text-dark text-bold">Coupon Code</a>
                            </li>
                        </div>
                    </ol>
                </div>
                <div class="container-fluid px-4 bg-white">
                    <h1 class="mt-4">Coupon</h1>
                    <div class="row mb-2 ">
                        <div align='right'>
                            <button type="button" style="background-color: #3D464D !important;" class="btn shadow text-white border-0" data-bs-toggle="modal" data-bs-target="#addProduct1">
                                <span class="plus-sign">+</span>
                                <span class="vr"></span> Add Coupon
                            </button>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Name</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Limit</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Expiry Date</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Discount</th>
                                        <th class="text-center" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allCoupons as $coup) { ?>
                                        <tr>
                                            <td id="" class="text-center"><?php echo $coup['name'] ?></td>
                                            <td id="" class="text-center"><?php echo $coup['limitt'] ?></td>
                                            <td id="" class="text-center"><?php echo $coup['expiry_date'] ?></td>
                                            <td id="" class="text-center">%<?php echo $coup['discount'] ?></td>

                                            <td class="text-center">
                                                <a data-id="<?php echo $coup['coupon_id']; ?>" class="delete">
                                                    <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                </a>
                                                <button type="button" class="btn edit" data-id="<?php echo $coup['coupon_id'] ?>" name="<?php echo $coup['name'] ?>" limit="<?php echo $coup['limitt'] ?>" date="<?php echo $coup['expiry_date'] ?>" discount="<?php echo $coup['discount'] ?>" data-bs-toggle="modal" data-bs-target="#updateCoupon1">
                                                    <i class=" fa-solid fa-pen-to-square" style="color: green;" title="update"></i>
                                                </button>
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
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.href = 'coupon.php';
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

            $('.delete').on('click', function() {
                var id = $(this).data('id');
                console.log(id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            cache: false,
                            type: 'POST',
                            data: {
                                coupon_id: id
                            },
                            url: 'actions/coupons/delete_coupon.php',
                            success: function(response) {
                                if (response == 0) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your Coupon Code has been deleted.",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'coupon.php';
                                    })
                                } else {
                                    Swal.fire('You can not deleted this Coupon. Please try again')
                                }
                            }
                        })
                    }
                });
            });

            $('.edit').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).attr('name');
                var limit = $(this).attr('limit');
                var date = $(this).attr('date');
                var discount = $(this).attr('discount');

                $('#updateID').val(id);
                $('#updateName').val(name);
                $('#updateLimit').val(limit);
                $('#updateDate').val(date);
                $('#updateDiscount').val(discount);

            });
            $('#updateCoupon').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                title: response.message,
                                showConfirmButton: true,
                                icon: "success",
                                customClass: {
                                    confirmButton: 'button btn btn-primary ',
                                }
                            }).then((result) => {
                                window.location.href = 'coupon.php';
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