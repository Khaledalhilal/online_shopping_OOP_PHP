<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/categories.class.php');
$categories = new categories();
$allCategories = $categories->getAllCategories();


?>

<?php require('common/header.php') ?>
<!--! add Modal Start -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">Add Category</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/categories/add_categories.php" id="addForm" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text">ID</span>
                        <input type="text" name="category_id" class="form-control" placeholder="Category ID">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category Name</span>
                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" name="images" class="form-control" placeholder="Category Name" required>
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
<!--! add Modal End -->

<!-- update Modal Start -->
<div class="modal fade" id="updateCoupon1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">Add Category</h1>
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
                        <input type="text" name="category_name" id="updateName" class="form-control" required autocomplete="off">
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
<!-- update Modal End -->

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
                                <a href="index.php" class="text-dark text-decoration">Dashboard</a> / <a href="categories.php" class="text-dark text-bold"> Categories</a>
                            </li>
                        </div>
                    </ol>
                </div>
                <div class="container-fluid px-4 bg-white mb-4">
                    <h2 class="mt-4 ">Categories</h2>
                    <div class="row mb-2 bg-white">
                        <div align='right' class="border-0">
                            <button type="button" style="background-color:#3D464D;" class="btn text-white border-0" data-bs-toggle="modal" data-bs-target="#addCategory">
                                <span class="plus-sign">+</span>
                                <span class="vr"></span>
                                Add Category
                            </button>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered ">
                                <thead>

                                    <tr>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Image</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Name</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allCategories as $cat) { ?>
                                        <tr>

                                            <td class="w-100 text-center" style="width: 15% !important;">
                                                <img src=" assets/img/categories/<?php echo $cat['cat_image'] ?>" alt="" height="100%" width="100%">
                                            </td>
                                            <td id="name" class="text-center" style="width: 40%;"><?php echo $cat['category_name'] ?></td>
                                            <td class="text-center">
                                                <a data-id="<?php echo $cat['category_id']; ?>" class="delete">
                                                    <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                </a>
                                                <button type="button" class="btn edit" data-id="<?php echo $cat['category_id'] ?>" name="<?php echo $cat['category_name'] ?>" img="<?php echo $cat['cat_image'] ?>" data-bs-toggle="modal" data-bs-target="#updateCoupon1">
                                                    <i class=" fa-solid fa-pen-to-square" style="color: green;" title="Update"></i>
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
                                window.location.href = 'categories.php';
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
                                cat_id: id
                            },
                            url: 'actions/categories/delete_categories.php',
                            success: function(response) {
                                if (response == 0) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'categories.php';
                                    })
                                } else {
                                    Swal.fire('You can not deleted this category')
                                }
                            }
                        })
                    }
                });
            });
            $('.edit').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).attr('name');
                var img = $(this).attr('img');


                $('#updateID').val(id);
                $('#updateName').val(name);
                $('#imagee').html('<img src="assets/img/categories/' + img + '" height="150px" width="150px" alt="">');


            });
            $('#updateCategory').submit(function(e) {
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
                                window.location.href = 'categories.php';
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