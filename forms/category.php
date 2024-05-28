<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!--  navbar Start -->
  <?php include_once("../component/navbar.php");?>
  <!-- navbar end -->

  <div class="container-fluid">
    
    <h5 class="card-title fw-semibold mb-4">Add Category</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php">
          <div class="mb-3">
            <label for="ctName" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="ctName" id="ctName" placeholder="Enter Category name" required>           
          </div>
          <div class="mb-3">
            <label for="ctDesc" class="form-label">Category Description</label>
            <textarea type="text" class="form-control" name="ctDesc" id="ctDesc" placeholder="Enter Category Description" ></textarea>      
          </div>          
          <div class="mb-3">
            <label for="PtDesc" class="form-label">Product Description</label>
            <input type="file" class="form-control" id="imageUpload" required accept="image/*">
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