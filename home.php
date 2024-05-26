<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/home.class.php');
$home = new home();
$slider = $home->getAll();

?>
<?php require('common/header.php') ?>
<div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="addImage" aria-hidden="true">
    <div class="modal-dialog border-0 ">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #3D464D;">
                <h1 class="modal-title fs-5 text-white" id="addImage">Add New SlideShow </h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/home/update.php" id="addForm" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <span class="input-group-text text-center" style="width: 120px !important">Title</span>
                        <input type="text" name="headTitle" class="form-control" placeholder="Enter Title" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 120px !important">Description</span>
                        <input type="text" name="primaryTitle" class="form-control" placeholder="Enter Description" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" name="images[]" class="form-control" multiple required>
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
                                <a href="index.php" class="text-dark text-decoration">Dashboard</a> / <a href="home.php" class="text-dark text-bold"> home.php</a>
                            </li>
                        </div>
                    </ol>
                </div>
                <div class="container-fluid px-4 bg-white mb-4">
                    <h2 class="mt-4 ">All Sliders</h2>

                    <div class="row mb-2 bg-white">
                        <div align='right' class="border-0">
                            <button id="add-slider-button" type="button" style="background-color: #3D464D !important;" class="btn text-white border-0" data-bs-toggle="modal" data-bs-target="#addImage">
                                <span class="plus-sign">+</span>
                                <span class="vr"></span> Add Slider
                            </button>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="table table-bordered table-responsive">
                                <thead>

                                    <tr>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Image</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Title</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">description</th>
                                        <th class="text-center col" style="background-color: #FFD333 !important; color:#3D464D !important">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($slider as $all) { ?>
                                        <tr>

                                            <td class="w-100" style="width: 15% !important;">
                                                <img src="assets/img/carousel/<?php echo $all['carousel_image'] ?>" alt="" style="width: 100%;">
                                            </td>
                                            <td id="name" class="text-center"><?php echo $all['head_title'] ?></td>
                                            <td id="name" class="text-center"><?php echo $all['primary_title'] ?></td>
                                            <td class="text-center">
                                                <a id="delete-image-link" data-id="<?php echo $all['carousel_id']; ?>" class="delete">
                                                    <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                </a>

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
            var imageArrayLength = <?php echo count($slider); ?>;

            function toggleDeleteLink() {
                if (imageArrayLength >= 3) {
                    $('#delete-image-link').removeClass('disabled');
                } else {
                    $('#delete-image-link').addClass('disabled');
                }
            }

            function toggleAddSliderButton() {
                if (imageArrayLength < 4) {
                    return true;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'You cannot add more than 4 images.',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                    return false;
                }
            }
            toggleDeleteLink();

            $('.delete').on('click', function() {
                if (imageArrayLength >= 3) {
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
                                    caro_id: id
                                },
                                url: 'actions/home/deleteImage.php',
                                success: function(response) {
                                    console.log(response);
                                    if (response != 0) {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Your Slider has been deleted.",
                                            icon: "success"
                                        }).then((result) => {
                                            window.location.href = 'home.php';
                                        });
                                    } else {}
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'You need at least 3 images to delete.',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'button btn btn-primary app_style'
                        }
                    });
                }
            });

            $('#add-slider-button').click(function() {
                return toggleAddSliderButton();
            });

            $('#addImage').on('show.bs.modal', function(e) {
                return toggleAddSliderButton();
            });

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
                            window.location.href = 'home.php';
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