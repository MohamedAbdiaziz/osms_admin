<?php
$title = "Inventory Report";
require_once("../classes/category.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
require_once'../db/DbConnect.php'; // Include your database connection
$dbconn = new DbConnect();
$conn = $dbconn->connect();
function getInventoryReport($conn) {
    $stmt = $conn->prepare("SELECT p.ProductName, s.Quantity, s.Status, p.UpdatedDate 
                            FROM tblstock s
                            JOIN tblproduct p ON s.Product = p.ID
                            ORDER BY p.UpdatedDate DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$inventoryReport = getInventoryReport($conn);
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php"); ?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Inventory Report</h3>
      </div>
      <div class="card-body">
        <table id="inventory-table" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Last Updated</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($inventoryReport as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['ProductName']) ?></td>
              <td><?= htmlspecialchars($row['Quantity']) ?></td>
              <td><?= htmlspecialchars($row['Status']) ?></td>
              <td><?= htmlspecialchars($row['UpdatedDate']) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Last Updated</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <!-- Footer start -->
    <?php include_once("../component/footer.php"); ?>
    <!-- Footer end -->
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#inventory-table').DataTable({
        "pagingType": "full_numbers",
        "language": {
          "paginate": {
            "first": "&laquo;",
            "last": "&raquo;",
            "previous": "&lsaquo;",
            "next": "&rsaquo;"
          }
        },
        
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

<?php include_once("../component/footerhtml.php"); ?>
