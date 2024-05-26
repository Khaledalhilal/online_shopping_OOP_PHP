<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php require('common/header.php'); ?>
<?php
session_start();


if ($_POST) {
    $products = new products();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT user_type,email, password FROM users WHERE email = ?";
    $params = array($email);
    $result = $products->data($sql, $params);

    if ($result && count($result) > 0) {
        $storedPasswordHash = $result[0]['password'];
        $user_type = $result[0]['user_type'];

        if (password_verify($password, $storedPasswordHash)) {
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['login'] = true;

            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href='index.php';
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password',
                        text: 'Please try again.'
                    }).then(() => {
                        window.location.href='signin.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Username',
                    text: 'Please try again.'
                }).then(() => {
                    window.location.href='login.php';
                });
            });
        </script>";
    }
}


?>



<style>
    .card-registration {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
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


    <div class="container-fluid mb-4">
        <section class="h-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2">
                            <div class="card-body p-0">
                                <section class="vh-100">
                                    <div class="container-fluid h-custom">
                                        <div class="row d-flex justify-content-center align-items-center h-100">
                                            <div class="col-md-9 col-lg-6 col-xl-5">
                                                <img src="../img/login.jpg" class="img-fluid" alt="Sample image">
                                            </div>
                                            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                                                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                                    <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                                    <button type="button" class="btn bg-blue-color  btn-floating text-white mx-1" style="background-color: #FFD333 !important;">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </button>

                                                    <button type="button" class="btn bg-blue-color text-white btn-floating mx-1" style="background-color: #FFD333 !important;">
                                                        <i class="fab fa-twitter"></i>
                                                    </button>

                                                    <button type="button" class="btn bg-blue-color text-white btn-floating mx-1" style="background-color: #FFD333 !important;">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </button>
                                                </div>

                                                <div class="divider d-flex align-items-center my-4">
                                                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                                                </div>

                                                <form action="" method="post">
                                                    <div class="form-outline mb-4">
                                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Your Email" autocomplete="off" />
                                                        <label class="form-label">E-mail</label>
                                                    </div>

                                                    <div class="form-outline mb-3">
                                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" autocomplete="off" />
                                                        <label class="form-label">Passwords</label>
                                                    </div>



                                                    <div class="text-center text-lg-start mt-4 pt-2">
                                                        <button type="submit" class="btn bg-blue-color btn-lg" style="background-color: #FFD333 !important;padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="footer">
        <?php require('common/footer.php'); ?>
        <?php require('common/script.php'); ?> </div>


    </html>