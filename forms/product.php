<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!--  navbar Start -->
  <?php include_once("../component/navbar.php");?>
  <!-- navbar end -->

  <div class="container-fluid">
    
    <h5 class="card-title fw-semibold mb-4">Add Product</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php">
          <div class="mb-3">
            <label for="PtName" class="form-label">Prodcut Name</label>
            <input type="text" class="form-control" name="PtName" id="PtName" placeholder="Enter Prodcut name" required>           
          </div>
          <div class="mb-3">
            <label for="PtDesc" class="form-label">Product Description</label>
            <textarea type="text" class="form-control" name="PtDesc" id="PtDesc" placeholder="Enter Product Description"></textarea>      
          </div>    
        
          <div class="mb-3">
            <label for="CtID" class="form-label">Category</label>
            <Select class="form-control" name="CtID" id="CtID" required>
              <option value="" readonly>Select Category</option>
            </select>      
          </div>

          <div class="mb-3">
            <label for="PtPrice" class="form-label">Prodcut Price</label>            
            <input type="number" class="form-control" id="PtPrice" name="PtPrice" step="0.01" min="0" placeholder="Enter price" required>
          </div>

          <div class="mb-3">
            <label for="TypID" class="form-label">Type</label>
            <Select class="form-control" name="TypID" id="TypID" required>
              <option value="" readonly>Select Type</option>
            </select>      
          </div>
          <div class="mb-3">
            <label for="SizeID" class="form-label">Size</label>
            <Select class="form-control" name="SizeID" id="SizeID" required>
              <option value="" readonly>Select Size</option>
            </select>      
          </div>
          <div class="mb-3">
            <label for="ColorID" class="form-label">Color</label>
            <Select class="form-control" name="ColorID" id="ColorID" required>
              <option value="" readonly>Select Color</option>
            </select>      
          </div>

          <div class="mb-3">
            <label for="PtImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="PtImage" accept="image/*" required>
          </div>

          <div class="mb-3">
            <div id="imagePreview"></div>
          </div>


          <button type="submit" name="Productform" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  <!-- Footer start -->
  <?php include_once("../component/footer.php");?>
  <!-- Footer end -->
  </div>
</div>




<?php include_once("../component/footerhtml.php");?>