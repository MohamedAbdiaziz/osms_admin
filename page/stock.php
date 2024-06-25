<?php $title = "Stocks page" ?>
<?php 
require_once("../classes/stock.class.php");
require_once("../classes/product.class.php");
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
    <a href="../forms/stock.php" class="btn btn-primary m-1">Add Stock</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Stock</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Stock ID</th>
              <th>Product ID</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $objStock = new Stock();
              $stocks = $objStock->getStocks();
              foreach($stocks as $stock){
            ?>
            <tr>
              <td><?= $stock['ID']?></td>
              <td><?= $stock['ProductName']?></td>
              <td><?= $stock['Quantity']?></td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StockEdit_<?= $stock['ID']?>">Edit</button>
                <button class="btn btn-danger" onclick="removeStock(<?= $stock['ID']?>)">Delete</button>
              </td>
              <!-- Modal Edit Stock -->
              <div class="modal fade" id="StockEdit_<?= $stock['ID']?>" tabindex="-1" aria-labelledby="StockEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="StockEditLabel">Update Stock</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php">
                        <input type="hidden" name="stockID" value="<?= $stock['ID']?>">
                        <input type="text" class="form-control" name="stockProductID" id="stockProductID_<?= $stock['ID']?>" value="<?= $stock['prodid']?>" hidden required>
                        
                        <div class="mb-3">
                          <label for="stockQuantity" class="form-label">Quantity</label>
                          <input type="text" class="form-control" name="stockQuantity" id="stockQuantity_<?= $stock['ID']?>" value="<?= $stock['Quantity']?>" required>
                        </div>
                        <button type="submit" name="updateStock" class="btn btn-primary">Submit</button>
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
              <th>Stock ID</th>
              <th>Product ID</th>
              <th>Quantity</th>
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

<script>
  function removeStock(id) {
    if (confirm("Are you sure you want to delete this stock?")) {
      window.location.href = "../backend/action.php?removeStock=" + id;
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
