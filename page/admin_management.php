<?php 
require_once("../classes/admin.class.php");
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
    <a href="../forms/admin.php" class="btn btn-primary m-1">Add Admin</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Admins</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $objAdmin = new Admin();
              $admins = $objAdmin->GetAdmins();
              foreach($admins as $admin){
            ?>
            <tr>
              <td><?= $admin['id']?></td>
              <td><?= $admin['name']?></td>
              <td><?= $admin['email']?></td>
              <td><?= $admin['Role']?></td>
              <td><?= $admin['status']?></td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AdminEdit_<?= $admin['id']?>">Edit</button>
                <button class="btn btn-danger" onclick="removeAdmin(<?= $admin['id']?>)">Delete</button>
              </td>
              <!-- Modal Edit Admin -->
              <div class="modal fade" id="AdminEdit_<?= $admin['id']?>" tabindex="-1" aria-labelledby="AdminEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="AdminEditLabel">Update Admin</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php">
                        <input type="hidden" name="adminID" value="<?= $admin['id']?>">
                        <div class="mb-3">
                          <label for="adminName" class="form-label">Admin Name</label>
                          <input type="text" class="form-control" name="adminName" id="adminName_<?= $admin['id']?>" value="<?= $admin['name']?>" required>
                        </div>
                        <div class="mb-3">
                          <label for="adminEmail" class="form-label">Admin Email</label>
                          <input type="email" class="form-control" name="adminEmail" id="adminEmail_<?= $admin['id']?>" value="<?= $admin['email']?>" required>
                        </div>
                        <div class="mb-3">
                          <label for="adminRole" class="form-label">Role</label>
                          <select class="form-control" name="adminRole" id="adminRole_<?= $admin['id']?>" required>
                            <option value="Super Admin" <?= $admin['Role'] == 'Super Admin' ? 'selected' : ''?>>Super Admin</option>
                            <option value="Admin" <?= $admin['Role'] == 'Admin' ? 'selected' : ''?>>Admin</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="adminStatus" class="form-label">Satus</label>
                          <select class="form-control" name="adminStatus" id="adminStatus_<?= $admin['id']?>" required>
                            <option value="Active" <?= $admin['status'] == 'Active' ? 'selected' : ''?>>Active</option>
                            <option value="Inactive" <?= $admin['status'] == 'Inactive' ? 'selected' : ''?>>Inactive</option>
                          </select>
                        </div>
                        
                        <button type="submit" name="updateAdmin" class="btn btn-primary">Submit</button>
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
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
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
  function removeAdmin(id) {
    if (confirm("Are you sure you want to delete this admin?")) {
      window.location.href = "../backend/action.php?adminDelete=" + id;
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
