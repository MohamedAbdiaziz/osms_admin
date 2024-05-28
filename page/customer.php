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
        <h3 class="card-title">All customer</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
                <th>customer ID</th>
                <th>Image</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Password</th>
              <th>JoinedDate</th>
              <th>Status</th>
              <th>Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
                <th>6</th>
                <th><img src="../assets/images/products/s1.jpg"  width="100" height="50"></th>
              <td>Tiger Nixon</td>
              <td>TigerNixon</td>
              <td>tgiegr@osms.com</td>
              <td>********</td>
              <td>2011-04-25</td>
              <td>On</td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CtEdit">Edit</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#CtDelete">Delete</button>
              </td>
              <!-- Modal Edit customer -->
              <div class="modal fade" id="CtEdit" tabindex="-1" aria-labelledby="CtEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CtEditLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Delete customer -->
              <div class="modal fade" id="CtDelete" tabindex="-1" aria-labelledby="CtDeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CtDeleteLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
            
           
            
          </tbody>
          <tfoot>
            <tr>
            <th>customer ID</th>
                <th>Image</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Password</th>
              <th>JoinedDate</th>
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