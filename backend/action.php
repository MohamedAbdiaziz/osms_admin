<?php
  header('Content-Type: application/json');
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



  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST["name"])){
      echo "Dome";
    }
    switch ($_POST['name']) {
      case 'removeCategory':
        $objCategory->setid($_POST['CtID']);
        if($objCategory->RemoveCategory()){
          echo json_encode(["status" => 1]);
        }else{
          echo json_encode(["status" => 0]);  
        }
        
        break;
      case 'updateCategory':
        $categoryId = intval($_POST["id"]);
        $fields = [];


        if (!empty($_POST["name"])) {
          $fields["Name"] = $_POST["name"];
        }
        if (!empty($_POST["description"])) {
          $fields["Description"] = $_POST["description"];
        }
        if (!empty($_FILES["image"]["name"])) {

          $uploadDir = "../../osm/images/Category/";
          // $uploadFile = $uploadDir . basename($_FILES["ctImg"]["name"]);
          // $uploadOk = 1;
          // $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
          $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
          $newFileName = generateUniqueFileName($imageFileType);
          $uploadFile = $uploadDir . $newFileName;
          $uploadOk = 1;

          $check = getimagesize($_FILES["image"]["tmp_name"]);
          if($check !== false) {
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
          // Check if file already exists
          if (file_exists($uploadFile)) {$uploadOk = 0;}
          // Check file size
          if ($_FILES["image"]["size"] > 500000) {$uploadOk = 0;}
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
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
                  // $_SESSION['Action'] = "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                // $objCategory->setimage($newFileName);
                $fields["Image"] = $newFileName;

                // $_SESSION['Action'] = $objCategory->getimage();

              } else {
                  
                  $_SESSION['Action'] = "<script>"."alert('Sorry, there was an error uploading your file.')"."</script>";
                  header("location: ../forms/category.php");
                  exit();              
              }
          }




          



        }
        if (!empty($_POST["status"])) {
          $fields["Status"] = $_POST["status"];
        }
        


        if (count($fields) > 0) {
          $result = $category->updateCategory($categoryId, $fields);
          echo json_encode($result);
        } else {
          echo json_encode(["success" => false, "message" => "No fields to update."]);
        }

        break;
      
      default:
        // code...
        break;
    }
  }
  else{

  }

  if(isset($_POST['categoryEditform'])){

  }
?>