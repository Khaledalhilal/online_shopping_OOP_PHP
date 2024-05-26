<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
require("class/DAL.class.php");
$dal = new DAL();

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT user_type,email, password FROM users WHERE email = ?";
    $params = array($email);
    $result = $dal->data($sql, $params);
    if ($result && count($result) > 0 && strtolower($result[0]['user_type']) === 'admin') {
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
                        window.location.href='login.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid E-mail',
                    text: 'Please try again.'
                }).then(() => {
                    window.location.href='login.php';
                });
            });
        </script>";
    }
}


?>



<?php require('common/header.php'); ?>

<style>
    body {
        margin-bottom: 0;
    }

    .background-radial-gradient {
        background-color: #3D464D;
        background-image: radial-gradient(650px circle at 0% 0%,
                #3D464D 15%,
                #3D464D 35%,
                #3D464D 75%,
                #3D464D 80%,
                transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                #FFD333 15%,
                #3D464D 35%,
                #3D464D 75%,
                #3D464D 80%,
                transparent 100%);
    }

    #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: radial-gradient(#FFD333, #3D464D);
        overflow: hidden;
    }

    #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: radial-gradient(#FFD333, #3D464D);
        overflow: hidden;
    }

    .bg-glass {
        background-color: rgba(255, 255, 255, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
    }
</style>

<body>
    <section class="background-radial-gradient overflow-hidden" style="height: 100vh;">

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <!-- <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        The best offer <br />
                        <span style="color: hsl(218, 81%, 75%)">for KH-Shop</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Discover the latest trends in fashion at our online clothing store from casual wear to sophisticated evening outfits
                    </p>
                </div> -->
                <center>

                    <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong" style="background: radial-gradient(#FFD333, #3D464D); overflow: hidden;">
                        </div>
                        <div id="radius-shape-2" class="position-absolute shadow-5-strong" style="border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%; bottom: -60px; right: -110px; width: 300px; height: 300px; background: radial-gradient(#FFD333, #3D464D); overflow: hidden;">
                        </div>

                        <div class="card bg-glass" style="border-radius: 0px;">
                            <div class="card-body px-4 py-5 px-md-5">
                                <form action="" method="POST">
                                    <div class="form-outline mb-4">
                                        <input type="email" id="form3Example3" name="email" class="form-control" style=" color: #3D464D;" placeholder="Enter Your E-mail" required autocomplete="off" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example4" name="password" class="form-control" style=" color: #3D464D;" placeholder="Enter Your Password" required autocomplete="off" />
                                    </div>
                                    <div class="align-items-end">
                                        <button type="submit" class="btn btn-primary btn-block mb-4 float-end" style="background-color: #FFD333; color: #3D464D;border:0px; border-radius:0px">
                                            Sign in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </section>
</body>

</html>


</html>