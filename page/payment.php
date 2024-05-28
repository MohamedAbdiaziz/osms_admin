<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");?>
  <!-- Navbar end -->

  <div class="container-fluid">
    
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Payment</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
                <th>Payment ID</th>
                <th>Method type</th>
                <th>Description</th>
                <th>Customer Name</th>
                <th>Action</th>
                
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Cash</td>
              <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </td>
              <td>Mohamed</td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PyEdit">Edit</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#PtDelete">Delete</button>
              </td>
              <!-- Modal Edit Payment -->
              <div class="modal fade" id="PyEdit" tabindex="-1" aria-labelledby="PyEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="PyEditLabel">Update Payment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php">
                           
                      
                        <div class="mb-3">
                          <label for="PyType" class="form-label">Type</label>
                          <Select class="form-control" name="PyType" id="PyType" required>
                            <option value="" readonly>Select Type</option>
                          </select>      
                        </div>

                        

                        <button type="submit" name="PaymentformEdit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Delete Payment -->
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
                          <label class="form-label">Are you Sure to Delete Payment >PaymentName< </label>
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
              <th>Payment ID</th>
              <th>Method type</th>
              <th>Description</th>
              <th>Customer Name</th>
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