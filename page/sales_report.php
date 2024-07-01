<?php
$title = "Sales Report";
require_once("../classes/category.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
include 'db_connection.php'; // Include your database connection

function getSalesReport($conn) {
    // Update this query based on your actual sales table structure
    $stmt = $conn->prepare("SELECT p.ProductName, p.Price, (p.Price * p.SalesCount) as 'Subtotal', si.SaleDate 
                            FROM tblproduct p ORDER BY p.SalesCount DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$salesReport = getSalesReport($conn);
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php"); ?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Sales Report</h3>
      </div>
      <div class="card-body">
        <table id="sales-table" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Customer</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
              <th>Sale Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($salesReport as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['ProductName']) ?></td>
              <td><?= htmlspecialchars($row['Customer']) ?></td>
              <td><?= htmlspecialchars($row['Quantity']) ?></td>
              <td><?= htmlspecialchars($row['Price']) ?></td>
              <td><?= htmlspecialchars($row['Subtotal']) ?></td>
              <td><?= htmlspecialchars($row['SaleDate']) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Product Name</th>
              <th>Customer</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
              <th>Sale Date</th>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#sales-table').DataTable({
        "pagingType": "full_numbers",
        "language": {
          "paginate": {
            "first": "&laquo;",
            "last": "&raquo;",
            "previous": "&lsaquo;",
            "next": "&rsaquo;"
          }
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>

<?php include_once("../component/footerhtml.php"); ?>
