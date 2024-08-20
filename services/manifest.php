<?php
    session_start();

    if (!isset($_SESSION['user_logged_in'])){
        header('Location: login');
        exit();
    }

    require '../components/header.php';
    require '../components/db.php';
    include '../components/navbar.php';
?>

 <div class="container w-75 my-5">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <h1 class="fw-bold my-3 me-2">Approved Permits</h1>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <table class="table table-responsive table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Application #</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Reference Code</th>
                                        <th scope="col">Approved Date</th>
                                        <th scope="col">Expiry Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">
                                            <div class="text-center me-1">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewClientModal<?php echo $clientID; ?>">
                                                    <div class="d-flex align-items-center">
                                                        <a>Manage Manifest</a>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>