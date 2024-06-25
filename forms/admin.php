<?php $title = "Admin Form" ?>
<?php
require_once("../classes/admin.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");

?>

<div class="body-wrapper">
    <!-- Navbar Start -->
    <?php include_once("../component/navbar.php");
    

    
    if (isset($_SESSION['Action'])) {
        echo $_SESSION['Action'];
        unset($_SESSION['Action']);
    }
    if (isset($_SESSION['Failed'])) {
        echo $_SESSION['Failed'];
        unset($_SESSION['Failed']);
    }
    ?>
    <!-- Navbar end -->
    <div class="container-fluid">
<?php if($_SESSION['admin_role'] === "Super Admin"){?>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Admin</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="../backend/action.php">
                    <div class="mb-3">
                        <label for="adminName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="adminName" id="adminName" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="adminEmail" id="adminEmail" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="adminPassword" id="adminPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminRole" class="form-label">Role</label>
                        <select class="form-control" name="adminRole" id="adminRole" required>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="addAdmin" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <?php }else{?>
            <p>Only Super User Can Add User or Manage</p>
        <?php }?>
    </div>

</div>

<!-- Footer Start -->
<?php include_once("../component/footer.php"); ?>
<!-- Footer End -->

<?php include_once("../component/footerhtml.php"); ?>
