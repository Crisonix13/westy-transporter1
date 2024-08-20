<?php
    session_start();
     if (!isset($_SESSION['registration_success'])) {
        header('Location: registration');
        exit();
    }
    
    unset($_SESSION['registration_success']);

    require 'components/header.php';
?>

<div class="d-flex text-center justify-content-center align-items-center vh-100">
    <div class="container w-50">
        <h1 class="fw-bold my-3">Thank you for registering</h1>
        <a href="index.php" class="btn btn-secondary text-center" style="background-color:#253E23">Continue</a>
    </div>
</div>