<?php 
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!--  navbar Start -->
  <?php include_once("../component/navbar.php");?>
  <!-- navbar end -->

  <div class="container-fluid">
    
    <h5 class="card-title fw-semibold mb-4">Add User</h5>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="../backend/action.php">  
          <div class="mb-3">
            <label for="Fname" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="Fname" id="Fname" placeholder="Enter User name" required>           
          </div>
          <div class="mb-3">
            <label for="Uname" class="form-label">User Name</label>
            <input type="text" class="form-control" name="Uname" id="Uname" placeholder="Enter User name" required>           
          </div>
          <div class="mb-3">
            <label for="Uemail" class="form-label">Email</label>
            <input type="text" class="form-control" name="Uemail" id="Uemail" placeholder="Enter Email" required>           
          </div>
          <div class="mb-3">
            <label for="uRole" class="form-label">Role</label>
            <Select class="form-control" name="uRole" id="uRole" required>
              <option value="" readonly>Select Product</option>
            </select>      
          </div>
          <div class="mb-3">
            <label for="PtQuantity" class="form-label">Product Quantity</label>            
            <input type="number" class="form-control" id="PtQuantity" name="PtQuantity" step="1" min="0" placeholder="Enter Quantity" required>
          </div>                             
          <button type="submit" name="Userform" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  <!-- Footer start -->
  <?php include_once("../component/footer.php");?>
  <!-- Footer end -->
  </div>
</div>




<?php include_once("../component/footerhtml.php");?>