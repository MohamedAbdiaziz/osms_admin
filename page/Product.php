<?php $title = "Products Page" ?>
<?php 
require_once("../classes/product.class.php");
require_once("../classes/category.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");
  if (isset($_SESSION['failed_to_upload'])) {
    echo $_SESSION['failed_to_upload'];
  }
  if (isset($_SESSION['Action'])) {
    echo $_SESSION['Action'];
    unset($_SESSION['Action']);
  }
  if (isset($_SESSION['Failed'])) {
    echo $_SESSION['Failed'];
  }
  ?>

  <!-- Navbar end -->

  <div class="container-fluid">
    <a href="../forms/product.php" class="btn btn-primary m-1">Add Product</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Products</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Category</th>
              <th>Type</th>
              <th>Color</th>
              <th>Size</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $objProduct = new Product();
              $objCategory = new Category();
              $products = $objProduct->getAllProducts();
              $categories = $objCategory->GetCategies();

              // Create a category lookup array
              $categoryLookup = [];
              foreach($categories as $category) {
                  $categoryLookup[$category['ID']] = $category['Name'];
              }

              foreach($products as $product){
            ?>
            <tr>
              <td><?= $product['ID']?></td>
              <td><img src="../../osm/images/Category/<?= $product['Image'];?>" width="100" height="50"></td>
              <td><?= $product['ProductName']?></td>
              <td><?= substr($product['Description'], 0, 20) . "..." ?></td>
              <td><?= $categoryLookup[$product['Category']] ?? 'Unknown' ?></td>
              <td><?= $product['Type']?></td>
              <td><?= $product['Color']?></td>
              <td><?= $product['Size']?></td>
              <td><?= $product['Price']?></td>
              <td><?= $product['Status']?></td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProdEdit_<?= $product['ID']?>">Edit</button>
                <button class="btn btn-danger" onclick="removeProduct(<?= $product['ID']?>)">Delete</button>
              </td>
              <!-- Modal Edit Product -->
              <div class="modal fade" id="ProdEdit_<?= $product['ID']?>" tabindex="-1" aria-labelledby="ProdEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ProdEditLabel">Update Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php" enctype="multipart/form-data">
                        <input type="hidden" name="prodID" value="<?= $product['ID']?>">
                        <div class="mb-3">
                          <label for="prodName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" name="prodName" id="prodName_<?= $product['ID']?>" value="<?= $product['ProductName']?>" required>
                        </div>
                        <div class="mb-3">
                          <label for="prodDesc" class="form-label">Product Description</label>
                          <textarea class="form-control" name="prodDesc" id="prodDesc_<?= $product['ID']?>" required><?= $product['Description']?></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="prodCategory" class="form-label">Category</label>
                          <select class="form-control" name="prodCategory" id="prodCategory_<?= $product['ID']?>" required>
                            <?php foreach($categories as $category): ?>
                              <option value="<?= $category['ID']?>" <?= $category['ID'] == $product['Category'] ? 'selected' : ''?>><?= $category['Name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="prodType" class="form-label">Type</label>
                          <select class="form-control" name="prodType" id="prodType_<?= $product['ID']?>" required>
                            <option value="Glasses" <?= $product['Type'] == 'Glasses' ? 'selected' : ''?>>Glasses</option>
                            <option value="Contact Lenses"<?= $product['Type'] == 'Contact Lenses' ? 'selected' : ''?>>Contact Lenses</option>
                            <option value="Sunglasses"<?= $product['Type'] == 'Sunglasses' ? 'selected' : ''?>>Sunglasses</option>
                            <option value="Accessories"<?= $product['Type'] == 'Accessories' ? 'selected' : ''?>>Accessories</option>
                          </select>
                          
                        </div>
                        <div class="mb-3">
                          <label for="prodColor" class="form-label">Color</label>
                          <select class="form-control" name="prodColor" id="prodColor_<?= $product['ID']?>" required>
                            <option value="Red" <?= $product['Color'] == 'Red' ? 'selected' : ''?>>Red</option>
                            <option value="Blue" <?= $product['Color'] == 'Blue' ? 'selected' : ''?>>Blue</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="prodSize" class="form-label">Size</label>
                          <select class="form-control" name="prodSize" id="prodSize_<?= $product['ID']?>" required>
                            <option value="Small" <?= $product['Size'] == 'Small' ? 'selected' : ''?>>Small</option>
                            <option value="Medium" <?= $product['Size'] == 'Medium' ? 'selected' : ''?>>Medium</option>
                            <option value="Large" <?= $product['Size'] == 'Large' ? 'selected' : ''?>>Large</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="prodPrice" class="form-label">Price</label>
                          <input type="number" class="form-control" name="prodPrice" id="prodPrice_<?= $product['ID']?>" value="<?= $product['Price']?>" required>
                        </div>
                        <div class="mb-3">
                          <label for="prodStatus" class="form-label">Status</label>
                          <select class="form-control" name="prodStatus" id="prodStatus_<?= $product['ID']?>" required>
                            <option value="Active" <?= $product['Status'] == 'Active' ? 'selected' : ''?>>Active</option>
                            <option value="Inactive" <?= $product['Status'] == 'Inactive' ? 'selected' : ''?>>Inactive</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="prodImg" class="form-label">Product Image</label>
                          <input type="file" class="form-control" name="prodImg" id="prodImg_<?= $product['ID']?>" accept="image/*">
                          <input type="hidden" name="existingImg" value="<?= $product['Image']?>">
                        </div>
                        <button type="submit" name="updateProduct" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
            <?php
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Product ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Category</th>
              <th>Type</th>
              <th>Color</th>
              <th>Size</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Include jQuery and DataTables library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

<script>
  function removeProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
      window.location.href = "../backend/action.php?prodDelete=" + id;
    }
  }
</script>

<script>
$(document).ready(function() {
    $('#table-id').DataTable({
        "pagingType": "full_numbers",
        "language": {
          "paginate": {
            "first": "&laquo;",
            "last": "&raquo;",
            "previous": "&lsaquo;",
            "next": "&rsaquo;"
          }
        },
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        }
    });
    
  });

</script>


<!-- Footer Start -->
<?php include_once("../component/footer.php");?>
<!-- Footer End -->

<?php include_once("../component/footerhtml.php");?>
