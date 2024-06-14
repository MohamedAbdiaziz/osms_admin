<?php 
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
require_once("../classes/product.class.php");
require_once("../classes/stock.class.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");

  if (isset($_SESSION['Action'])) {
    echo $_SESSION['Action'];
    unset($_SESSION['Action']);
  }
  ?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <h5 class="card-title fw-semibold mb-4">Add Stock</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php">
          
          <div class="mb-3">
            <label for="PrName" class="form-label">Product</label>
            <select class="form-control" name="PrName" id="PrName" required>
              <option value="" readonly>Select Product</option>
              <?php
                // Instantiate the Product class and fetch all products
                $objProduct = new Product();
                $objStock = new stock();
                $products = $objProduct->getAllProducts();
                $productsInStock= $objStock->getProductsInStock();

                // Loop through each product and create an option element
                foreach($products as $product) {
                  if(!in_array($product['ID'], $productsInStock)){
                    echo "<option value='".$product['ID']."'>".$product['ProductName']."</option>";         
                  }
                }
              ?>
            </select>      
          </div>

          <div class="mb-3">
            <label for="PtQuantity" class="form-label">Product Quantity</label>            
            <input type="number" class="form-control" id="PtQuantity" name="PtQuantity" step="1" min="0" placeholder="Enter Quantity" required>
          </div>
                             
          <button type="submit" name="Stockform" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <!-- Footer start -->
    <?php include_once("../component/footer.php");?>
    <!-- Footer end -->
  </div>
</div>

<?php include_once("../component/footerhtml.php");?>
