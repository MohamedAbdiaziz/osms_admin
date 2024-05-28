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
      <div class="card-title">
        <h3>Product Properties</h3>
      </div>
    </div>
      
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TypeProduct">Add Type</button>
            <h2>List Type Of Products</h2>
            <table id="table-id" class="table table-striped table-class" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>John Doe</td>
                  <td>john@example.com</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jane Smith</td>
                  <td>jane@example.com</td>
                </tr>
              </tbody>
            </table>
          
          </div>
        </div>

      </div>
      

    </div>

    <!-- Modal type of product -->
    <div class="modal fade" id="TypeProduct" tabindex="-1" aria-labelledby="TypeProductLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="TypeProductLabel">Modal title</h5>
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

    <!-- Modal Size of product -->
    <div class="modal fade" id="TypeProduct" tabindex="-1" aria-labelledby="TypeProductLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="TypeProductLabel">Modal title</h5>
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