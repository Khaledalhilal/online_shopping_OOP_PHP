<?php
session_start();
if (!isset($_SESSION['email'])) {

    echo "<script>window.location.href='login.php'</script>";
}
require('class/contact.php');
$contact = new contact();
$allContacts = $contact->getAllContacts();
?>

<?php require('common/header.php') ?>

<body class="sb-nav-fixed">
    <?php require('common/navbar.php') ?>
    <div id="layoutSidenav">
        <?php require('common/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Contact Us</h1>
                    <ol class="breadcrumb mb-4 bg-light py-2">
                        <div class=" text-dark">
                            <li class="breadcrumb-item ">
                                <a href="index.php" class="text-dark text-decoration">Dashboard</a> / <a href="contact.php" class="text-dark"> Contact Us</a>
                            </li>
                        </div>
                    </ol>

                    <div class="row mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center col">User Name</th>
                                        <th class="text-center col">Email</th>
                                        <th class="text-center col">Phone Number</th>
                                        <th class="text-center col">Subject</th>
                                        <th class="text-center col">Message</th>
                                        <th class="text-center col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allContacts as $con) { ?>
                                        <tr>
                                            <td id="" class="text-center"><?php echo $con['firstName'] . " " . $con['lastName']  ?></td>
                                            <td id="" class="text-center"><?php echo $con['email'] ?></td>
                                            <td id="" class="text-center"><?php echo $con['phone_number'] ?></td>
                                            <td id="" class="text-center"><?php echo $con['subject'] ?></td>
                                            <td id="" class="text-center"><?php echo $con['message'] ?></td>
                                            <td id="" class="text-center"><?php echo $con['message'] ?></td>
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