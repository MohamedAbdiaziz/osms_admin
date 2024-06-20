<?php 
require_once("../classes/admin.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");

if (!isset($_SESSION['adminID'])) {
    header("Location: login.php");
    exit();
}

$adminID = $_SESSION['adminID'];
$objAdmin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate the input
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New password and confirm password do not match.";
    } else {
        // Check current password
        $admin = $objAdmin->getAdminById($adminID);
        if (!password_verify($currentPassword, $admin['password']) && $admin['password'] !== md5($currentPassword)) {
            $error = "Current password is incorrect.";
            
        } else {
            // Update password
            $hashedPassword = md5($newPassword);
            if ($objAdmin->updateAdminPassword($adminID, $hashedPassword)) {
                $success = "Password updated successfully.";
            } else {
                $error = "Failed to update the password.";
            }
        }

    }

}
?>

<div class="body-wrapper">
    <!-- Navbar Start -->
    <?php include_once("../component/navbar.php"); ?>
    <!-- Navbar end -->

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
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
