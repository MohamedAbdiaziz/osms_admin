<?php 
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
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
  <!-- Navbar End -->

  <div class="container-fluid">
    
    <h5 class="card-title fw-semibold mb-4">Add Product</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="prodName" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="prodName" id="prodName" placeholder="Enter Product name" required>           
          </div>
          <div class="mb-3">
            <label for="prodDesc" class="form-label">Product Description</label>
            <textarea class="form-control" name="prodDesc" id="prodDesc" placeholder="Enter Product Description" required></textarea>      
          </div>
          <div class="mb-3">
            <label for="prodCategory" class="form-label">Product Category</label>
            <select class="form-control" id="prodCategory" name="prodCategory" required>
              <?php
                require_once("../classes/category.class.php");
                $objCategory = new Category();
                $categories = $objCategory->GetCategies();
                foreach ($categories as $category) {
                  echo '<option value="'.$category['ID'].'">'.$category['Name'].'</option>';
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="prodPrice" class="form-label">Product Price</label>
            <input type="number" class="form-control" name="prodPrice" id="prodPrice" placeholder="Enter Product Price" required>
          </div>
          <div class="mb-3">
            <label for="prodType" class="form-label">Product Type</label>
            <select class="form-control" name="prodType" id="prodType" required>
              <option value="Glasses">Glasses</option>
              <option value="Contact Lenses">Contact Lenses</option>
              <option value="Sunglasses">Sunglasses</option>
              <option value="Accessories">Accessories</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="prodColor" class="form-label">Product Color</label>
            <select class="form-control" name="prodColor" id="prodColor" required>
              <option value="Black">Black</option>
              <option value="Brown">Brown</option>
              <option value="Blue">Blue</option>
              <option value="Green">Green</option>
              <option value="Gray">Gray</option>
              <option value="Red">Red</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="prodSize" class="form-label">Product Size</label>
            <select class="form-control" name="prodSize" id="prodSize" required>
              <option value="Small">Small</option>
              <option value="Medium">Medium</option>
              <option value="Large">Large</option>
              <option value="Extra Large">Extra Large</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="prodStatus" class="form-label">Product Status</label>
            <select class="form-control" id="prodStatus" name="prodStatus" required>
              <option value="Active">Active</option>
              <option value="Deactive">Deactive</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="imageUpload" class="form-label">Product Image</label>
            <input type="file" class="form-control" name="prodImg" id="imageUpload" required accept="image/*">
          </div>
          <div class="mb-3">
            <div id="imagePreview"></div>
          </div>
          <button type="submit" name="productform" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  <!-- Footer start -->
  <?php include_once("../component/footer.php");?>
  <!-- Footer end -->
  </div>
</div>

<?php include_once("../component/footerhtml.php");?>
