<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <a href="../forms/Product.php" class="btn btn-primary m-1">Add Product</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Product</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
                <th>Product ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Date Created</th>
                <th>Updated Date</th>
                <th>Type</th>
                <th>Color</th>
                <th>Size</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="../assets/images/products/s4.jpg" width="100" height="50"></td>
              <td>Sunglass</td>
              <td>Reduces sun light</td>
              <td>5</td>
              <td>2011-05-04</td>
              <td>2022-02-02</td>
              <td>Rimless Frames</td>
              <td>Black</td>
              <td>Meduim</td>
              <td>On</td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PtEdit">Edit</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#PtDelete">Delete</button>
              </td>
              <!-- Modal Edit Category -->
              <div class="modal fade" id="PtEdit" tabindex="-1" aria-labelledby="PtEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="PtEditLabel">Update Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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


                        <button type="submit" name="ProductformEdit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Delete Category -->
              <div class="modal fade" id="PtDelete" tabindex="-1" aria-labelledby="PtDeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="PtDeleteLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../backend/action.php" method="post">
                        <div class="mb-3">
                          <label class="form-label">Are you Sure to Delete Product >ProductName< </label>
                        </div>
                        <button type="submit" class="btn btn-primary">yes</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>            
          </tbody>
          <tfoot>
            <tr>
              <th>Product ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Date Created</th>
              <th>Updated Date</th>
              <th>Type</th>
              <th>Color</th>
              <th>Size</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <!-- Footer start -->
    <?php include_once("../component/footer.php");?>
    <!-- Footer end -->
  </div>
</div>

<!-- Include jQuery and DataTables library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

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




<?php include_once("../component/footerhtml.php");?>