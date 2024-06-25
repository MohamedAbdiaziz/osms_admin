<?php $title = "Category Form" ?>
<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!--  navbar Start -->
  <?php include_once("../component/navbar.php");
  if (isset($_SESSION['failed_to_upload'])) {
    echo $_SESSION['failed_to_upload'];
    // unset($_SESSION['failed_to_upload']);
  }
  if (isset($_SESSION['Action'])) {
    echo $_SESSION['Action'];
    unset($_SESSION['Action']);
  }
  if (isset($_SESSION['Failed'])) {
    echo $_SESSION['Failed'];
    // unset($_SESSION['Failed']);
  }

  ?>
  <!-- navbar end -->

  <div class="container-fluid">
    
    <h5 class="card-title fw-semibold mb-4">Add Category</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="ctName" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="ctName" id="ctName" placeholder="Enter Category name" required>           
          </div>
          <div class="mb-3">
            <label for="ctDesc" class="form-label">Category Description</label>
            <textarea type="text" class="form-control" name="ctDesc" id="ctDesc" placeholder="Enter Category Description" ></textarea>      
          </div>          
          <div class="mb-3">
            <label for="imageUpload" class="form-label">Category Image</label>
            <input type="file" class="form-control" name="ctImg" id="imageUpload" required accept="image/*">
          </div>
          <div class="mb-3">
            <div id="imagePreview"></div>
          </div>
          <button type="submit" name="categoryform" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  <!-- Footer start -->
  <?php include_once("../component/footer.php");?>
  <!-- Footer end -->
  </div>
</div>




<?php include_once("../component/footerhtml.php");?>