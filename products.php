<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/products.class.php');
$products = new products();
$allProducts = $products->getAllProducts();
// var_dump($allProducts);exit;
$allCategories = $products->getAllCategoriesss();
// var_dump($allCategories);
// exit;

?>

<?php require('common/header.php') ?>
<!-- add Modal Start -->
<div class="modal fade" id="addProduct1" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addProduct">Add Products</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/add_products.php" id="addForm" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text">ID</span>
                        <input type="text" name="product_id" class="form-control" placeholder="Product ID">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">product Name</span>
                        <input type="text" name="product_name" class="form-control" placeholder="Product Name" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Description</span>
                        <input type="text" name="prod_description" class="form-control" placeholder="Enter Description" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Category Name</span>

                        <select class="form-select text-dark" name="category_id" id="selectProducts" required autocomplete="off">
                            <option value="" disabled selected>Select Products Name</option>
                            <?php foreach ($allCategories as $key => $cat) {
                                echo '<option value="' . $cat['category_id'] . '">' .  $cat['category_name'] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Size</span>
                        <input type="text" name="size" class="form-control" placeholder="Enter Size" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Color</span>
                        <input type="text" name="color" class="form-control" placeholder="Enter Color" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Price</span>
                        <input type="number" name="price" class="form-control" placeholder="Enter Price" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <!-- <span class="input-group-text" style="width: 130px;">Select Image</span> -->
                        <input type="file" name="images[]" class="form-control" placeholder="Enter Images" required multiple>
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


<body class="sb-nav-fixed bg-light">
    <?php require('common/navbar.php') ?>
    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-4">
                    <ol class="breadcrumb mb-4 bg-white py-3 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ps-2 ">
                                <a href="index.php" class="text-dark ms-4 text-decoration">Dashboard</a> / <a href="products.php" class="text-dark text-bold">Products</a>
                            </li>
                        </div>
                    </ol>
                </div>
                <div class="container-fluid px-4 bg-white">
                    <h1 class="mt-4">Products</h1>
                    <div class="row mb-2">
                        <div align='right'>
                            <button type="button" style="background-color:#3D464D;" class="btn text-white" data-bs-toggle="modal" data-bs-target="#addProduct1">
                                <span class="plus-sign">+</span>
                                <span class="vr"></span>
                                Add Product
                            </button>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Image</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Product Name</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Description</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Category Name</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">Price</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">size</th>
                                        <th class="text-center " style="background-color: #FFD333 !important; color:#3D464D !important">color</th>
                                        <th class="text-center" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allProducts as $prod) { ?>
                                        <tr>
                                            <td style="width: 15% !important;"><img src="assets/img/products/<?php echo $prod['image_name'] ?>" width="100%" height="0%" alt=""></td>
                                            <td id="" class="text-center"><?php echo $prod['prod_name'] ?></td>
                                            <td id="" class="text-center"><?php echo $prod['prod_description'] ?></td>
                                            <td id="" class="text-center"><?php echo $prod['category_name'] ?></td>
                                            <td id="" class="text-center"><?php echo $prod['prod_price'] ?></td>
                                            <td id=""><?php echo $prod['size'] ?></td>
                                            <td id=""><?php echo $prod['color'] ?></td>
                                            <td>
                                                <a data-id="<?php echo $prod['prod_id']; ?>" class="delete">
                                                    <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                </a>
                                                <button type="button" class="btn" data-bs-toggle="modal">
                                                    <a href="update_form_products.php?product_id=<?php echo $prod["prod_id"] ?>" title="Update">
                                                        <i class=" fa-solid fa-pen-to-square" style="color: green;"></i>
                                                    </a>
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
                        // console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.href = 'products.php';
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
                                prod_id: id
                            },
                            url: 'actions/delete_products.php',
                            success: function(response) {
                                if (response == 0) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'products.php';
                                    })
                                } else {
                                    Swal.fire('You can not deleted this Product')
                                }
                            }
                        })
                    }
                });
            });


        });
    </script>