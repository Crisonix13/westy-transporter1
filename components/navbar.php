<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
        header("Location: index.php");
        exit();
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    $current_page = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav class="navbar nav-underline navbar-expand-lg" style="background-color:#586854">
    <div class="container-fluid w-75 d-flex justify-content-between align-items-center">
        <a class="navbar-brand text-light" href="index">Westy</a>
        <?php if (isset($_SESSION['user_logged_in'])): ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-end">
                    <li class="nav-item">
                        <a class="nav-link text-light <?php echo $current_page == 'client' ? 'active' : 'inactive'; ?>" href="/westy-transporter/client">Client</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle <?php echo $current_page == '/services/generator' || $current_page == '/services/ptt-form' || $current_page == '/services/manifest' || $current_page == '/services/hw-inventory' ? 'active' : 'inactive'; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/westy-transporter/services/generator">Generator</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/westy-transporter/services/ptt-form">PTT Form</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/westy-transporter/services/manifest">Service Manifest</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/westy-transporter/services/hw-inventory">HW Inventory</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle <?php echo $current_page == '/transporter/inventory' || $current_page == '/transporter/manifest' ? 'active' : 'inactive'; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transporter</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/westy-transporter/transporter/inventory">Inventory</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/westy-transporter/transporter/manifest">Transport Manifest</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light dropdown-toggle <?php echo $current_page == 'tsd-facility/application' || $current_page == 'tsd-facility/manifest' ? 'active' : 'inactive'; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">TSD Facility</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/westy-transporter/tsd-facility/application">Applications</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/westy-transporter/tsd-facility/manifest">TSD Facility Manifest</a>
                        </div>
                    </li>
                    <?php if ($_SESSION['userType'] == 'Admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-light <?php echo $current_page == 'user' ? 'active' : 'inactive'; ?>" href="user">Users</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout">Logout</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
