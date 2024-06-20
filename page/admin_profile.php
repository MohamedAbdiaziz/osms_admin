<?php 
require_once("../classes/admin.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
$_SESSION['adminID']="6";
if (!isset($_SESSION['adminID'])) {
    echo "<script>window.location.href = '".$URL."authentication-login.php';</script>";
    exit();
}

$adminID = $_SESSION['adminID'];
$objAdmin = new Admin();
$admin = $objAdmin->getAdminById($adminID);
?>

<div class="body-wrapper">
    <!-- Navbar Start -->
    <?php include_once("../component/navbar.php"); ?>
    <!-- Navbar end -->

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin Profile</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- <div class="col-md-4">
                        <?php if (!empty($admin['Image'])): ?>
                            <img src="../assets/images/profile/<?= $admin['Image'] ?>" class="img-fluid img-thumbnail" alt="Profile Image">
                        <?php else: ?>
                            <img src="../assets/images/profile/user-1.jpg" class="img-fluid img-thumbnail" alt="Default Profile Image">
                        <?php endif; ?>
                    </div> -->
                    <div class="col-md-12">
                        <table class="table table-bordered ">
                            <tr>
                                
                                <td colspan="2" class="text-center">
                                    <div class="md-4">
                                        <?php if (!empty($admin['Image'])): ?>
                                            <img src="../assets/images/profile/<?= $admin['Image'] ?>" class="img-fluid img-thumbnail" alt="Profile Image"  width="160" height="160">
                                        <?php else: ?>
                                            <img src="../assets/images/profile/user-1.jpg" class="img-fluid img-thumbnail" width="160" height="160"  alt="Default Profile Image">
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Admin ID</th>
                                <td><?= $admin['id']?></td>
                            </tr>
                            <tr>
                                <th>Admin Name</th>
                                <td><?= $admin['name']?></td>
                            </tr>
                            <tr>
                                <th>Admin Email</th>
                                <td><?= $admin['email']?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td><?= $admin['Role']?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Footer Start -->
<?php include_once("../component/footer.php");?>
<!-- Footer End -->

<?php include_once("../component/footerhtml.php");?>
