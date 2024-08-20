<?php
    session_start();

    if (!isset($_SESSION['user_logged_in'])){
        header('Location: login');
        exit();
    }

    require 'components/header.php';
    require 'components/db.php';
    include 'components/navbar.php';

    $clientQuery = "SELECT * FROM client ORDER BY clientID DESC";
    $clientResult = mysqli_query($conn, $clientQuery);

    $clients = [];
    
    while($row = mysqli_fetch_assoc($clientResult)){
        $clientID       = $row['clientID'];
        $clientName     = $row['clientName'];
        $clientStatus   = $row['clientStatus'];

        $clientSubmitted = isset($row['clientSubmitted']) && !is_null($row['clientSubmitted']) ? $row['clientSubmitted'] : "N/A";
        $clientExpiry    = isset($row['clientExpiry']) && !is_null($row['clientExpiry']) ? $row['clientExpiry'] : "N/A";

        $clients[] = [
            'clientID' => $clientID,
            'clientName' => $clientName,
            'clientStatus' => $clientStatus,
            'clientSubmitted' => $clientSubmitted,
            'clientExpiry' => $clientExpiry
        ];
    }

?>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
</style>
<div class="container w-75">
    <div class="d-flex justify-content-center">
        <h1 class="fw-bold my-3 me-2">Clients</h1> 
    </div>
    <div class="text-end">
        <button class="btn btn-secondary" style="background-color:#253E23"  href="#" data-bs-toggle="modal" data-bs-target="#addClientModal" role="button">
            <i class="fa-solid fa-plus me-1"></i>Add Client
        </button>
    </div>
    <table class="table table-responsive table-hover">
        <thead class="text-center">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Date Submitted</th>
                <th scope="col">Date Expiry</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($clients)):?>
                <tr>
                    <td colspan="5" class="text-center">No clients found.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="text-center"><?php echo $clientName; ?></td>
                    <td class="text-center"><?php echo $clientStatus; ?></td>
                    <td class="text-center"><?php echo $clientSubmitted; ?></td>
                    <td class="text-center"><?php echo $clientExpiry; ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <!-- View Button -->
                            <div class="text-center me-1">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewClientModal<?php echo $clientID; ?>">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-eye"></i>
                                    </div>
                                </button>
                            </div>
                            <!-- Edit Button -->
                            <div class="text-center">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editClientModal<?php echo $clientID; ?>">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
</div>

<!-- Add Client Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions.php" method="post">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientName" class="form-label">Name:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Enter client name" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientAddress" class="form-label">Address:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientAddress" name="clientAddress" placeholder="Enter client address" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientTypeEstablishment" class="form-label">Type of Establishment:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientTypeEstablishment" name="clientTypeEstablishment" placeholder="Enter type of establishment" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientContactPerson" class="form-label">Contact Person:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientContactPerson" name="clientContactPerson" placeholder="Enter client contact person" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientContactNumber" class="form-label">Contact Number:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="number" class="form-control" id="clientContactNumber" name="clientContactNumber" placeholder="Enter client contact number" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientEmail" class="form-label">Email:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Enter client email" required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientCRS" class="form-label">CRS ID No.:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientCRS" name="clientCRS" placeholder="Enter client CRS ID no." required>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="clientHW" class="form-label">HW ID No.:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input type="text" class="form-control" id="clientHW" name="clientHW" placeholder="Enter client HW ID no." required>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" name="addClient" class="btn btn-success w-25">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>