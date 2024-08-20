<?php
    session_start();

    if (!isset($_SESSION['user_logged_in'])){
        header('Location: login');
        exit();
    }

    require 'components/header.php';
    require 'components/db.php';
    include 'components/navbar.php';

    $userQuery = "SELECT * FROM user ORDER BY userID DESC";
    $userResult = mysqli_query($conn, $userQuery);

    $users = [];
    
    while($row = mysqli_fetch_assoc($userResult)){
        $userID       = $row['userID'];
        $userFname    = $row['userFname'];
        $userLname    = $row['userLname'];
    
        $userType = isset($row['userType']) && !is_null($row['userType']) ? $row['userType'] : "N/A";
    
        switch ($row['userStatus']) {
            case 0:
                $userStatus = "In Progress";
                break;
            case 1:
                $userStatus = "Approved";
                break;
            case 2:
                $userStatus = "Rejected";
                break;
            default:
                $userStatus = "Unknown"; 
        }
    
        $users[] = [
            'userID' => $userID,
            'userFname' => $userFname,
            'userLname' => $userLname,
            'userType' => $userType,
            'userStatus' => $userStatus
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
        <h1 class="fw-bold my-3 me-2">Employees</h1> 
    </div>
    <table class="table table-responsive table-hover">
        <thead class="text-center">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center"><?php echo $user['userFname'] . " " . $user['userLname']; ?></td>
                        <td class="text-center"><?php echo $user['userType']; ?></td>
                        <td class="text-center"><?php echo $user['userStatus']; ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <!-- View Button -->
                                <div class="text-center me-1">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewUserModal<?php echo $user['userID']; ?>">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                    </button>
                                </div>
                                <!-- Edit Button -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $user['userID']; ?>">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editUserModal<?php echo $user['userID']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="functions.php" method="post">
                                        <div class="row align-items-center my-2">
                                            <div class="col-xl-3 col-lg-3 col-md-3">
                                                <label for="clientName" class="form-label">Status</label>
                                            </div>
                                            <div class="col-xl-9 col-lg-9 col-md-9">
                                                <select class="input-group form-control" id="inputGroupSelect01">
                                                    <option selected>Select option</option>
                                                    <option value="1">Approve</option>
                                                    <option value="2">Reject</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row align-items-center my-2">
                                            <div class="col-xl-3 col-lg-3 col-md-3">
                                                <label for="clientName" class="form-label">Department</label>
                                            </div>
                                            <div class="col-xl-9 col-lg-9 col-md-9">
                                                <select class="input-group form-control" id="inputGroupSelect01">
                                                    <option selected >Select option</option>
                                                    <option value="ASD">ASD</option>
                                                    <option value="LSD">LSD</option>
                                                    <option value="Database">Database</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" name="editUser" class="btn btn-success w-25">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>