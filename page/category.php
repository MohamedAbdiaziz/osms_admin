<?php 
require_once("../classes/category.class.php");
include_once("../component/headerhtml.php");

include_once("../component/sidebar.php");
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");
if (isset($_SESSION['failed_to_upload'])) {
    echo $_SESSION['failed_to_upload'];
    // unset($_SESSION['failed_to_upload']);
  }
  if (isset($_SESSION['Action'])) {
    echo $_SESSION['Action'];
    unset($_SESSION['Action']);
  }
  if (isset($_SESSION['Failed'])) {
    echo $_SESSION['Failed'];
    // unset($_SESSION['Failed']);
  }


  ?>

  <!-- Navbar end -->

  <div class="container-fluid">
    <a href="../forms/category.php" class="btn btn-primary m-1">Add Category</a>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Category</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
                <th>Category ID</th>
                <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Created At</th>
              
              <th>Status</th>
              <th>Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
              
              $objcategory = new category();
              $categories = $objcategory->GetCategies();

              foreach($categories as $key => $category){              
            ?>
            <tr>
                <th><?= $category['ID']?></th>
                <th><img src="../../osm/images/Category/<?= $category['Image'];?>"  width="100" height="50"></th>
              <td><?= $category['Name']?></td>
              <td><?= substr($category['Description'],0,20)."..." ?></td>
              
              <td><?= $category['CreatedDate']?></td>
              <td><?= $category['Status']?></td>
              <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CtEdit_<?= $category['ID']?>">Edit</button>
                <button class="btn btn-danger" onclick="removeCategory(<?= $category['ID']?>)">Delete</button>
              </td>
              <!-- Modal Edit Category -->
              <div class="modal fade" id="CtEdit_<?= $category['ID']?>" tabindex="-1" aria-labelledby="CtEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="CtEditLabel">Update Category</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="../backend/action.php" enctype="multipart/form-data">
                        <input type="text" name="ctID" hidden  value="<?= $category['ID']?>" > 
                        <div class="mb-3">
                          <label for="ctName" class="form-label">Category Name</label>
                          <input type="text" class="form-control" name="ctName" id="ctName_<?= $category['ID'] ?>" placeholder="Enter Category name" value="<?= $category['Name']?>" >           
                        </div>
                        <div class="mb-3">
                          <label for="ctDesc" class="form-label">Category Description</label>
                          <textarea type="text" class="form-control" name="ctDesc" id="ctDesc_<?= $category['ID'] ?>" placeholder="Enter Category Description" ><?= $category['Description']?></textarea>      
                        </div> 
                        <div class="mb-3">
                          <label for="ctStatus" class="form-label">Category Status</label>
                          <select class="form-control" id="ctStatus_<?= $category['ID'] ?>" name="ctStatus">
                            <option <?php if($category['Status']=="Active")?> value="Active">Active</option>
                            <option <?php if($category['Status']=="Deactive")?> value="Deactive">Deactive</option>                            
                          </select>
                        </div>          
                        <div class="mb-3">
                          <label for="imageUpload" class="form-label">Category Image</label>
                          <input type="file" class="form-control" value="<?= $category['Image'] ?>" name="ctImg" id="imageUpload imageUpload_<?= $category['ID'] ?>"  accept="image/*">
                        </div>
                        <div class="mb-3">
                          <div id="imagePreview"></div>
                        </div>

                        <button type="submit" name="updateCategory" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              
            </tr>

          <?php } ?>
            
           
            
          </tbody>
          <tfoot>
            <tr>
              <th>Category ID</th>
                <th>Image</th>
              <th>Name</th>
              <th>Description</th>
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


<script>
    function removeCategory(CtID) {
      // body...
      if (confirm("Are you sure you want to delete this category?")) {

        $.ajax({
          url: "../backend/action.php",
          data: "CtID=" + CtID + "&action=removeCategory",
          method: "post"
        }).done(function(response){
          try {
            var data = JSON.parse(response);
            if (data.status == 1) {
              location.reload();
              alert('Delete Successfull');
            }
             else {              
              alert('Failed To delete Category');
            }
          } catch (e) {
            alert('Failed to parse JSON response: '+response);
          }
        })

        
      }
    }
    
  </script>

<script>
        function editCategory(categoryId) {
            // Get input values
            var formData = new FormData();
            formData.append("action", "updateCategory");
            formData.append("id", categoryId);

            var name = document.getElementById("ctName_" + categoryId).value;
            var description = document.getElementById("ctDesc_" + categoryId).value;
            var status = document.getElementById("ctStatus_" + categoryId).value;
            var image = document.getElementById("imageUpload_" + categoryId).files[0];

            // Prepare data to be sent in the AJAX request
            // var data = "action=updateCategory&id=" + categoryId;
            if (name) formData.append("name", name);
            if (description) formData.append("description", description);
            if (status) formData.append("status", status);
            if (image) formData.append("image", image);
            console.log(formData);

            // $.ajax({
            //   url: "../backend/action.php",
            //   data: formData,
            //   method: "post"
            // }).done(function(response){
            //   try {
            //     var data = JSON.parse(response);
            //     if (data.status == 1) {
            //       location.reload();
            //       alert('Updatw Successfull');
            //     }
            //      else {              
            //       alert('Failed To Updatw Category');
            //     }
            //   } catch (e) {
            //     alert('Failed to parse JSON response: '+response);
            //   }
            // })

            // var xhr = new XMLHttpRequest();
            // xhr.open("POST", "../backend/action.php", true);
            // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            // xhr.onreadystatechange = function () {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
            //         var response = JSON.parse(xhr.responseText);
            //         if (response.success) {
            //             alert("Category updated successfully!");
            //         } else {
            //             alert("Failed to update category: " + response.message);
            //         }
            //     }
            // };
            // xhr.send(formData);
        }
    </script>


<?php include_once("../component/footerhtml.php");?>