<?php $title = "Transactions" ?>
<?php 
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
require_once("../classes/transaction.class.php");
$objTrans = new transaction();
$transactions = $objTrans->getAllTransactions();
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
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Payments</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Payment ID</th>
              <th>Customer ID</th>
              <th>Stripe Session ID</th>
              <th>Amount</th>
              <th>Created At</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($transactions)): ?>
              <?php foreach($transactions AS $row){ ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['customer_id']; ?></td>
                  <td><?php echo $row['Description']; ?></td>
                  <td><?php echo $row['amount']; ?></td>
                  <td><?php echo $row['created_at']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PyEdit<?php echo $row['id']; ?>">Edit</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#PtDelete<?php echo $row['id']; ?>">Delete</button>
                  </td>
                  <!-- Modal Edit Payment -->
                  <div class="modal fade" id="PyEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="PyEditLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="PyEditLabel">Update Payment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../backend/action.php">
                            <div class="mb-3">
                              <label for="TxStatus" class="form-label">Status</label>
                              <input type="text" hidden name="trans_id" value="<?php echo $row['id'];?>">
                              <select class="form-control" name="TxStatus" id="TxStatus" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending" <?php if($row['status']=="Pending"): echo "selected"; endif;?>>Pending</option>
                                <option value="completed" <?php if($row['status']=="completed"): echo "selected"; endif;?>>completed</option>
                                <option value="Failed" <?php if($row['status']=="Failed"): echo "selected"; endif;?>>Failed</option>
                              </select>
                            </div>
                            <input type="hidden" name="transactionId" value="<?php echo $transactionId; ?>" />
                            <button type="submit" name="updateTransactionStatus" class="btn btn-primary">Submit</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Delete Payment -->
                  <div class="modal fade" id="PtDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="PtDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="PtDeleteLabel">Delete Payment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="../backend/action.php" method="post">
                            <div class="mb-3">
                              <label class="form-label">Are you sure to delete this payment?</label>
                            </div>
                            <input type="text" hidden name="trans_id" value="<?php echo $row['id'];?>">
                            <button type="submit" name="trans_delete" class="btn btn-primary">Yes</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              <?php } ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center">No transactions found</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Payment ID</th>
              <th>Customer ID</th>
              <th>Stripe Session ID</th>
              <th>Amount</th>
              <th>Created At</th>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

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
