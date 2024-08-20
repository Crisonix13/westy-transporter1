<?php
    session_start();

    if (isset($_SESSION['user_logged_in'])) {
        header('Location: index');
        exit();
    }

    require 'components/header.php';
    include 'components/navbar.php';
?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="border:none;">
        <div class="container w-100">
            <img src="assets/logo.png" style="width:50%; height: 50%"class="img-fluid mx-auto d-block">
            <h1 class="text-center fw-bold my-3" style="color:#253E23">Westy Transporter</h1>
            <div class="card w-100">
                <div class="card-body mx-3 my-3">
                    <form action="functions.php" method="post" autocomplete="off">
                        <div class="row my-2">
                            <div class="col-xl-3 col-lg-3 col-md-3 my-2">
                                <label class="fw-bold" for="email">Email</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="input-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                                    <span class="input-group-text bg-white">
                                        <i class="fa-regular fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-xl-3 col-lg-3 col-md-3 my-2">
                                <label class="fw-bold" for="password">Password</label>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="input-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                                    <span class="input-group-text bg-white">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-secondary" name="login" style="background-color:#253E23">Sign in</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <small>Don't have an account? <a class="link-secondary" href="registration">Register</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
