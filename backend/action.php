<?php
  // header('Content-Type: application/json');
  // import class
  require_once("../classes/category.class.php");
  include_once("./connection.php");

  // object of category
  $objCategory = new category;


  // Function to generate a unique identifier
  function generateUniqueFileName($extension) {
      return uniqid('img_', true) . '.' . $extension;
  }


  // Post of Category form
  if (isset($_POST['categoryform'] )) {
    $objCategory->setname($_POST['ctName']);
    $objCategory->setdescription($_POST['ctDesc']);

    if(isset($_FILES["ctImg"])){
      $uploadDir = "../../osm/images/Category/";
      // $uploadFile = $uploadDir . basename($_FILES["ctImg"]["name"]);
      // $uploadOk = 1;
      // $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
      $imageFileType = strtolower(pathinfo($_FILES["ctImg"]["name"], PATHINFO_EXTENSION));
      $newFileName = generateUniqueFileName($imageFileType);
      $uploadFile = $uploadDir . $newFileName;
      $uploadOk = 1;

      $check = getimagesize($_FILES["ctImg"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      // Check if file already exists
      if (file_exists($uploadFile)) {$uploadOk = 0;}
      // Check file size
      if ($_FILES["ctImg"]["size"] > 500000) {$uploadOk = 0;}
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {$uploadOk = 0;}
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          
          $_SESSION['Action'] = "<script>"."alert('Sorry, your file was not uploaded.')"."</script>";
          header("location: ../forms/category.php");
          exit();
          
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["ctImg"]["tmp_name"], $uploadFile)) {
              // $_SESSION['Action'] = "The file ". htmlspecialchars( basename( $_FILES["ctImg"]["name"])). " has been uploaded.";
            $objCategory->setimage($newFileName);

            // $_SESSION['Action'] = $objCategory->getimage();

          } else {
              
              $_SESSION['Action'] = "<script>"."alert('Sorry, there was an error uploading your file.')"."</script>";
              header("location: ../forms/category.php");
              exit();              
          }
      }
    }else{
      $objCategory->setimage("");
    }

    if($objCategory->InsertCategory()){
      $_SESSION['Action'] = "<script>"."alert('Success, category created.')"."</script>";
      header("location: ../forms/category.php");
      exit();
      
    }else{
      $_SESSION['Action'] =  "<script>"."alert('Sorry,failed to created category.')"."</script>";
      header("location: ../forms/category.php");
      exit();    
    }
  }else{
    $_SESSION['Action']= "Failed To create category";
  }



  
  if(isset($_POST['action'])){
    switch ($_POST['action']) {
      case 'removeCategory':
        $objCategory->setid($_POST['CtID']);
        if($objCategory->RemoveCategory()){
          echo json_encode(["status" => 1]);
        }else{
          echo json_encode(["status" => 0]);  
        }
        
        break;

      default:
        // code...
        break;
    }
  }  
    


if(isset($_POST['updateCategory'])){
    $name = NULL;
    $desc = NULL;
    $status = NULL;
    $img = NULL;

    echo $id = $_POST['ctID'];

    if (!empty($_POST['ctName'])) {
        $name = $_POST['ctName'];
    }
    if (!empty($_POST['ctDesc'])) {
        $desc = $_POST['ctDesc'];
    }
    if (!empty($_POST['ctStatus'])) {
        $status = $_POST['ctStatus'];
    }

    if (isset($_FILES['ctImg']) && $_FILES['ctImg']['tmp_name'] != '') {
        $uploadDir = "../../osm/images/Category/";
        $imageFileType = strtolower(pathinfo($_FILES["ctImg"]["name"], PATHINFO_EXTENSION));
        $newFileName = generateUniqueFileName($imageFileType);
        $uploadFile = $uploadDir . $newFileName;
        $uploadOk = 1;

        $check = getimagesize($_FILES["ctImg"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($uploadFile)) {
            $uploadOk = 0;
        }
        if ($_FILES["ctImg"]["size"] > 500000) {
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $_SESSION['Action'] = "<script>alert('Sorry, your file was not uploaded.')</script>";
            header("location: ../page/category.php");
            exit();
        } else {
            if (move_uploaded_file($_FILES["ctImg"]["tmp_name"], $uploadFile)) {
                $img = $newFileName;
            } else {
                $_SESSION['Action'] = "<script>alert('Sorry, there was an error uploading your file.')</script>";
                header("location: ../page/category.php");
                exit();
            }
        }
    }

    // Setting the object properties
    $objCategory->setid($id);
    $objCategory->setdescription($desc);
    $objCategory->setstatus($status);
    $objCategory->setimage($img);
    $objCategory->setname($name);

    // Optionally output the values
    $objCategory->getid();
    $objCategory->getdescription();
    $objCategory->getstatus();
    $objCategory->getimage();
    $objCategory->getname();

    // Perform the update operation
    if ($objCategory->UpdateCategory()) {
        $_SESSION['Action'] = "<script>alert('Updated SuccessFull')</script>";
                header("location: ../page/category.php");
        exit();
    } else {
        $_SESSION['Action'] = "<script>alert('Updated Failed')</script>";
                header("location: ../page/category.php");
        exit();
    }
}


  



?>