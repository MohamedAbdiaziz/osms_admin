<?php 
require_once("../classes/customer.class.php");
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");
  if (isset($_SESSION['Action'])) {
        echo $_SESSION['Action'];
        unset($_SESSION['Action']);
    }
    if (isset($_SESSION['Failed'])) {
        echo $_SESSION['Failed'];
        unset($_SESSION['Failed']);
    }
     ?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <!-- <a href="../forms/customer.php" class="btn btn-primary m-1">Add Customer</a> -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Customers</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $objCustomer = new Customer();
              $customers = $objCustomer->getCustomers();
              $sn = 1;
              foreach($customers as $customer){
            ?>
            <tr>
              <td><?= $sn++;?></td>
              <td><?= $customer['Name']?></td>
              <td><?= $customer['Username']?></td>
              <td><?= $customer['Email']?></td>
              <td><?= $customer['Mobile']?></td>
              <td><?= $customer['Address']?></td>
              <td><?= $customer['Status']?></td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CustomerEdit_<?= $customer['Username']?>">Edit</button>
                <button class="btn btn-danger" onclick="removeCustomer('<?php echo $customer['Username'];?>')">Delete</button>
              </td>
              <!-- Modal Edit Customer -->
              <div class="modal fade" id="CustomerEdit_<?= $customer['Username']?>" tabindex="-1" aria-labelledby="CustomerEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CustomerEditLabel">Update Customer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php">
                        <input type="hidden" name="customerUsername" value="<?= $customer['Username']?>">
                        <div class="mb-3">
                          <label for="customerName" class="form-label">Customer Name</label>
                          <input type="text" class="form-control" name="customerName" id="customerName_<?= $customer['Username']?>" value="<?= $customer['Name']?>" required readonly>
                        </div>
                        <div class="mb-3">
                          <label for="status" class="form-label">Status</label>
                          <!-- <input type="text" class="form-control" name="customerName" id="customerName_<?= $customer['Username']?>" value="<?= $customer['Name']?>" required> -->
                          <select class="form-control" name="status" id="status_<?= $customer['Username']?>">
                            <option value="Active" <?php if($customer['Status']=="Active"){ echo "selected";} ?> >Active</option>
                            <option value="Inactive" <?php if($customer['Status']=="Inactive"){ echo "selected";} ?> >Inactive</option>

                          </select>

                        </div>
                        
                        <button type="submit" name="updateCustomer" class="btn btn-primary">Submit</button>
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
              <th>ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
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
  function removeCustomer(id) {
    if (confirm("Are you sure you want to delete this customer?")) {
      window.location.href = "../backend/action.php?customerDelete=" + id;
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
        }
    });
});
</script>

<!-- Footer Start -->
<?php include_once("../component/footer.php");?>
<!-- Footer End -->

<?php include_once("../component/footerhtml.php");?>
