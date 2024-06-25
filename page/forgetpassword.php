<?php
include_once("../hf/header.php");
require_once("../db/DbConnect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    try {
        $db = new DbConnect();
        $dbConn = $db->connect();

        $sql = "SELECT * FROM tblcustomer WHERE Email = :email";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer) {
            $token = bin2hex(random_bytes(50));
            $expires = date("U") + 1800;

            $sql = "INSERT INTO password_reset (email, token, expires) VALUES (:email, :token, :expires)";
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expires', $expires);
            $stmt->execute();

            $resetLink = "http://localhost:8082/osm/pages/resetpassword.php?token=" . $token;

            // Send the reset link via email (use a proper email sending function here)
            mail($email, "Password Reset Request", "Click the following link to reset your password: " . $resetLink);

            $_SESSION['success'] = "Password reset link has been sent to your email.";
        } else {
            $_SESSION['error'] = "No account found with that email address.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
?>

<section id="banner" class="py-3" style="background: #F9F3EC;">
    <div class="container">
        <div class="hero-content py-5 my-3">
            <h2 class="display-1 mt-3 mb-0">Forgot Password</h2>
            <nav class="breadcrumb">
                <a class="breadcrumb-item nav-link" href="#">Home</a>
                <a class="breadcrumb-item nav-link" href="#">Pages</a>
                <span class="breadcrumb-item active" aria-current="page">Forgot Password</span>
            </nav>
        </div>
    </div>
</section>

<section class="forgot-password padding-large">
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-5">
                <p class="mb-0">Enter your email address to receive a password reset link.</p>
                <hr class="my-1">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']);
                }
                ?>
                <form id="forgotPasswordForm" class="form-group flex-wrap" method="POST" action="">
                    <div class="form-input col-lg-12 my-4">
                        <input type="email" id="email" name="email" placeholder="Enter your email address" class="form-control mb-3 p-4" required>
                        <div class="d-grid my-3">
                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Send Reset Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include_once("../hf/footer.php"); ?>
