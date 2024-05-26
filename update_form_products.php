<?php
if ($_GET) {
    $prod_id = $_GET['product_id'];
    require('class/products.class.php');
    $products = new products();
    $allProducts = $products->getAllProductsById($prod_id);
    $allImages = $products->getAllImages($_GET['product_id']);
    $allCategories = $products->getAllCategoriesss();
}



?>

<?php require('common/header.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body class="sb-nav-fixed bg-light">
    <?php require('common/navbar.php') ?>
    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Products</h1>
                    <ol class="breadcrumb mb-4 bg-light py-2 shadow">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ">
                                <a href="index.php" class="text-dark text-decoration">Dashboard</a> / <a href="products.php" class="text-dark"> Products</a>
                            </li>
                        </div>
                    </ol>
                    <div class="row mb-4">
                        <div class="card-body bordered">

                            <form action="actions/update_products.php" id="addForm" method="post" enctype="multipart/form-data">

                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Product ID</span>
                                    <input type="text" class="form-control" name="productID" value="<?php echo $allProducts[0]['prod_id'] ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Product Name</span>
                                    <input type="text" class="form-control" name="productName" value="<?php echo $allProducts[0]['prod_name'] ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px;">Category Name</span>

                                    <select class="form-select text-dark" name="category_id" id="selectProducts" required autocomplete="off">
                                        <option value="" disabled>Select Category Name</option>
                                        <?php foreach ($allCategories as $cat) {
                                            $selected = ($cat['category_id'] == $allProducts[0]['cat_id']) ? 'selected' : '';
                                            echo '<option value="' . $cat['category_id'] . '" ' . $selected . '>' . $cat['category_name'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Size</span>
                                    <input type="text" class="form-control" name="size" value="<?php echo $allProducts[0]['size'] ?>" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Color</span>
                                    <input type="text" class="form-control" value="<?php echo $allProducts[0]['color'] ?>" name="color" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Description</span>
                                    <input type="text" class="form-control" value="<?php echo $allProducts[0]['prod_description'] ?>" name="description" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Price </span>
                                    <input type="number" class="form-control" value="<?php echo $allProducts[0]['prod_price'] ?>" name="price" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Image</span>
                                    <input type="file" class="form-control" name="images[]" multiple>
                                </div>
                                <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #00546f !important; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                            </form>
                        </div>
                    </div>
                    <form action="">
                        <div class="row">
                            <?php foreach ($allImages as $k => $image) { ?>
                                <div class="col-lg-3 col-sm-6 mb-2">
                                    <div class="contain position-relative text-center">
                                        <img src="assets/img/products/<?php echo $image['image_name'] ?>" alt="" class="image">
                                        <div class="overlay">
                                            <a data-id="<?php echo $image['image_id']; ?>" class="delete">
                                                <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
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
            var productId = <?php echo $_GET['product_id'] ?>;
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
                                window.location.href = 'update_form_products.php?product_id=' + productId;
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
                var productId = <?php echo $_GET['product_id'] ?>;

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
                                img_id: id
                            },
                            url: 'actions/delete_images.php',
                            success: function(response) {
                                if (response == 0) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Image been deleted.",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'update_form_products.php?product_id=' + productId;
                                    })
                                } else {
                                    Swal.fire('You can not deleted this product')
                                }
                            }
                        })
                    }
                });
            });


        });
    </script>