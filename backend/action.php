<?php
  // header('Content-Type: application/json');
  // import class
  require_once("../classes/category.class.php");
  require_once("../classes/product.class.php");
  require_once("../classes/stock.class.php");
  require_once("../classes/order.class.php");
  require_once("../classes/admin.class.php");
  require_once("../classes/customer.class.php");
  include_once("./connection.php");

  // object of category
  


if(isset($_POST['categoryform'] )){
    handleCategoryForm();
    exit();
}elseif (isset($_POST['ctremove'])) {
  RemoveCategory();
}
elseif (isset($_POST['updateCategory'])) {
  UpdateCategory();
  exit();
}elseif (isset($_POST['productform'])) {
    handleProductForm();
    
}
elseif (isset($_GET['prodDelete'])) {
    removeProd();
}
elseif (isset($_POST['updateProduct'])) {
  updateProduct();

}elseif(isset($_POST['updateStock'])){
  updateStock();
}
elseif (isset($_GET['removeStock'])){
    removeStock();
}
elseif(isset($_POST['Stockform'])){
  Stockform();
}
elseif(isset($_POST['updateTransactionStatus'])){
    updatetransaction();
}
elseif(isset($_POST['trans_delete'])){
    deletetransaction();
}
elseif(isset($_POST['deleteOrder'])){
  deleteOrder();
}
elseif(isset($_POST['updateOrderStatus'])){
  updateOrderStatus();
}elseif(isset($_POST['addAdmin'])){
  addAdmin();
}elseif(isset($_GET['adminDelete'])){
  adminDelete();
}elseif(isset($_POST['updateAdmin'])){
  updateAdmin();
}elseif(isset($_POST['updateCustomer'])){
  updateCustomer();
}elseif(isset($_GET['customerDelete'])){
  customerDelete();
}
elseif(isset($_POST['login_process'])){
  login_process();
}
else{
    $_SESSION['Action']= "Failed To create category";
  }


  // Function to generate a unique identifier
  function generateUniqueFileName($extension) {
      return uniqid('img_', true) . '.' . $extension;
  }

  // Post of Category form
  function  handleCategoryForm() {
    $objCategory = new category;
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
  }
  
  function  RemoveCategory(){
    $objCategory = new category;
    switch ($_POST['ctremove']) {
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
    
  function  UpdateCategory(){
    $objCategory = new category;
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

      if (isset($_FILES['ctImg']) && !empty($_FILES['ctImg']['tmp_name'])) {
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
              $img=Null;
              exit();
          } else {
              if (move_uploaded_file($_FILES["ctImg"]["tmp_name"], $uploadFile)) {
                  $img = $newFileName;
              } else {
                  $_SESSION['Action'] = "<script>alert('Sorry, there was an error uploading your file.')</script>";
                  header("location: ../page/category.php");
                  $img=Null;
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

  function handleProductForm() {
    $product = new product();

    $prodName = $_POST['prodName'];
    $prodDesc = $_POST['prodDesc'];
    $prodCategory = $_POST['prodCategory'];
    $prodType = $_POST['prodType'];
    $prodColor = $_POST['prodColor'];
    $prodSize = $_POST['prodSize'];
    $prodPrice = $_POST['prodPrice'];
    $prodStatus = $_POST['prodStatus'];
    $prodImg;

    if(isset($_FILES["prodImg"])){
      $uploadDir = "../../osm/images/Category/";
      // $uploadFile = $uploadDir . basename($_FILES["ctImg"]["name"]);
      // $uploadOk = 1;
      // $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
      $imageFileType = strtolower(pathinfo($_FILES["prodImg"]["name"], PATHINFO_EXTENSION));
      $newFileName = generateUniqueFileName($imageFileType);
      $uploadFile = $uploadDir . $newFileName;
      $uploadOk = 1;

      $check = getimagesize($_FILES["prodImg"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      // Check if file already exists
      if (file_exists($uploadFile)) {$uploadOk = 0;}
      // Check file size
      if ($_FILES["prodImg"]["size"] > 500000) {$uploadOk = 0;}
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
          if (move_uploaded_file($_FILES["prodImg"]["tmp_name"], $uploadFile)) {
              // $_SESSION['Action'] = "The file ". htmlspecialchars( basename( $_FILES["ctImg"]["name"])). " has been uploaded.";
            $prodImg=$newFileName;

            // $_SESSION['Action'] = $objCategory->getimage();

          } else {
              
              $_SESSION['Action'] = "<script>"."alert('Sorry, there was an error uploading your file.')"."</script>";
              header("location: ../forms/category.php");
              exit();              
          }
      }
    }else{
      
    }

    $product->setName($prodName);
    $product->setDescription($prodDesc);
    
    $product->setImage($prodImg);
    $product->setPrice($prodPrice);
    $product->setType($prodType);
    $product->setColor($prodColor);
    $product->setSize($prodSize);
    $product->setCid($prodCategory);
    $product->setStatus($prodStatus);
    
    // echo $product->getName();
    // echo $product->getDescription();
    // echo $product->getCid();
    // echo $product->getImage();
    // echo $product->getPrice();
    // echo $product->getType();
    // echo $product->getColor();
    // echo $product->getSize();
    // echo $product->getStatus();

    if($product->InsertProduct()){
      $_SESSION['Action'] = "<script>"."alert('Success, product created.')"."</script>";
      header("location: ../forms/product.php");
      exit();
      
    }else{
      $_SESSION['Action'] =  "<script>"."alert('Sorry,failed to created product.')"."</script>";
      header("location: ../forms/product.php");
      exit();    
    }


  }


  function removeProd(){
    $product = new product();
    $product->setId($_GET['prodDelete']);
    if($product->DeleteProduct()){
      $_SESSION['Action'] = "<script>"."alert('Success, product Delete.')"."</script>";
      header("location: ../page/product.php");
      exit();
      
    }else{
      $_SESSION['Action'] = "<script>"."alert('Failed, product Delete.')"."</script>";
      header("location: ../page/product.php");
      exit();
      
    }
  }
  

  function updateProduct() {
    $objProduct = new Product();
    $productID = $_POST['prodID'];
    $name = $_POST['prodName'];
    $description = $_POST['prodDesc'];
    $categoryID = $_POST['prodCategory'];
    $type = $_POST['prodType'];
    $color = $_POST['prodColor'];
    $size = $_POST['prodSize'];
    $price = $_POST['prodPrice'];
    $status = $_POST['prodStatus'];
    $existingImg = $_POST['existingImg'];
    
    $image = $_FILES['prodImg']['name'];
    $targetDir = "../../osm/images/Category/";
    $targetFile = $targetDir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
      


    // Check if image file is a actual image or fake image
    if ($image) {
        $check = getimagesize($_FILES['prodImg']['tmp_name']);
        if ($check === false) {
            $_SESSION['failed_to_upload'] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $_SESSION['failed_to_upload'] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['prodImg']['size'] > 500000) {
            $_SESSION['failed_to_upload'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION['failed_to_upload'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['failed_to_upload'] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['prodImg']['tmp_name'], $targetFile)) {
                $_SESSION['Action'] = "The file ". htmlspecialchars(basename($image)). " has been uploaded.";
            } else {
                $_SESSION['failed_to_upload'] = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $image = $existingImg;
    }

    
    $result = $objProduct->updateProduct($productID, $name, $description, $categoryID, $type, $color, $size, $price, $status, $image);

    if ($result=="Success") {
        $_SESSION['Action'] = "Product updated successfully.";
    } else {
        $_SESSION['Failed'] = "Failed to update product.";
    }

    header("Location: ../page/product.php");
    exit();
  }

  function updateStock(){
    $objStock = new stock();
    $objStock->setId($_POST['stockID']);
    $objStock->setQuantity($_POST['stockQuantity']);
    // echo $objStock->getId();
    $result = $objStock->updateStock();
    if($result == "Success"){
      $_SESSION['Action'] = "<script>"."alert('Success, stock updated.')"."</script>";
      header("location: ../page/stock.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, Stock update.')"."</script>";
      header("location: ../page/stock.php");
    }
  }

  function removeStock(){
    $stock = new stock();
    $stock->setId($_GET['removeStock']);
    // echo $stock->getId();
    if($stock->removeStock()){
      $_SESSION['Action'] = "<script>"."alert('Success, stock Deleted.')"."</script>";
      header("location: ../page/stock.php");
    }else{
      $_SESSION['Action'] = "<script>"."alert('Failed, stock Delete.')"."</script>";
      header("location: ../page/stock.php");
    }

  }
  function Stockform()
  {
    $objStock = new stock();
    $objStock->setProdId($_POST['PrName']);
    $objStock->setQuantity($_POST['PtQuantity']);

    if($objStock->insertStock()){
      $_SESSION['Action'] = "<script>"."alert('Success, stock Inserted.')"."</script>";
      header("location: ../forms/stock.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, stock Insert.')"."</script>";
      header("location: ../forms/stock.php");
    }
    
  }
  function updatetransaction()
  {
    // echo $_POST['TxStatus'];
    // echo  $_POST['trans_id'];
    // exit();
    require_once("../classes/transaction.class.php");
    $objTrans = new transaction();
    $objTrans->setStatus($_POST['TxStatus']);
    $objTrans->setId($_POST['trans_id']);
    if($objTrans->updateTransaction()){
      $_SESSION['Action'] = "<script>"."alert('Success, transaction Updated.')"."</script>";
      header("location: ../page/payment.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, transaction update.')"."</script>";
      header("location: ../page/payment.php");
    }
    
  }
  function deletetransaction()
  {
    // echo $_POST['TxStatus'];
    // echo  $_POST['trans_id'];
    // exit();
    require_once("../classes/transaction.class.php");
    $objTrans = new transaction();
    // $objTrans->setStatus($_POST['TxStatus']);
    $objTrans->setId($_POST['trans_id']);
    if($objTrans->deleteTransaction()){
      $_SESSION['Action'] = "<script>"."alert('Success, transaction deleted.')"."</script>";
      header("location: ../page/payment.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, transaction delete.')"."</script>";
      header("location: ../page/payment.php");
    }
    
  }
  function deleteOrder()
  {
    $objOrder = new order();
    $objOrder->setId($_POST['order_id']);
    if($objOrder->deleteOrder()){
      $_SESSION['Action'] = "<script>"."alert('Success, Order deleted.')"."</script>";
      header("location: ../page/order.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, Order delete.')"."</script>";
      header("location: ../page/order.php");
    }
    
  }
  function updateOrderStatus()
  {
    $objOrder = new order();
    $objOrder->setId($_POST['order_id']);
    $objOrder->setStatus($_POST['OrderStatus']);
    if($objOrder->updateOrderStatus()){
      $_SESSION['Action'] = "<script>"."alert('Success, Order Updated.')"."</script>";
      header("location: ../page/order.php");
    }
    else{
      $_SESSION['Action'] = "<script>"."alert('Failed, Order Update.')"."</script>";
      header("location: ../page/order.php");
    }
    
  }
  function addAdmin()
  {
    $admin = new Admin();
    $admin->setname($_POST['adminName']);
    $admin->setemail($_POST['adminEmail']);
    $admin->setphone($_POST['adminPhone']);
    $admin->setaddress($_POST['adminAddress']);
    // $admin->setstatus($_POST['adminStatus']);
    $admin->setpassword(md5($_POST['adminPassword']));
    $admin->setRole($_POST['adminRole']);

    $result = $admin->InsertAdmin();

    if ($result == "Success") {
        $_SESSION['Action'] = "<script>"."alert('Success, Admin Added.')"."</script>";
    } elseif($result  == 1062) {
        $_SESSION['Failed'] = "<script>"."alert('Username or Email already exists. Please choose a different username or email.')"."</script>";
    }else{
        $_SESSION['Failed'] = "<script>"."alert('Failed, Admin Add.')"."</script>";

    }
    header("Location: ../forms/admin.php");
    exit();
  }
  function updateAdmin()
  {
    $admin = new Admin();
    $admin->setId($_POST['adminID']);
    $admin->setname($_POST['adminName']);
    $admin->setemail($_POST['adminEmail']);
    $admin->setstatus($_POST['adminStatus']);
    $admin->setpassword(md5($_POST['adminPassword']));
    $admin->setRole($_POST['adminRole']);

    $result = $admin->UpdateAdmin();

    if ($result) {
        $_SESSION['Action'] = "<script>"."alert('Success, Admin Updated.')"."</script>";
    } else {
        $_SESSION['Failed'] = "<script>"."alert('Failed, Admin Update.')"."</script>";
    }
    header("Location: ../page/admin_management.php");
    exit();
  }
  function adminDelete(){
    $admin = new Admin();
    $admin->setId($_GET['adminDelete']);
    $result = $admin->RemoveAdmin();
    if ($result == "Success") {
        $_SESSION['Action'] = "<script>"."alert('Success, Admin Deleted.')"."</script>";
    } else {
        $_SESSION['Failed'] = "<script>"."alert('Failed, Admin Delete.')"."</script>";
    }
    header("Location: ../page/admin_management.php");
    exit();
  }
  function updateCustomer(){
    $customer = new Customer();
    $customer->setUsername($_POST['customerUsername']);
    $customer->setStatus($_POST['status']);
    $result = $customer->UpdateCustomer();
    if ($result) {
        $_SESSION['Action'] = "<script>"."alert('Success, Customer Updated.')"."</script>";
    } else {
        $_SESSION['Failed'] = "<script>"."alert('Failed, Customer Update.')"."</script>";
    }
    header("Location: ../page/customer_management.php");
    exit();
  }
  function customerDelete()
  {
    $customer = new Customer();
    $customer->setUsername($_GET['customerDelete']);
    $result = $customer->RemoveCustomer();
    if ($result) {
        $_SESSION['Action'] = "<script>"."alert('Success, Customer Deleted.')"."</script>";
    } else {
        $_SESSION['Failed'] = "<script>"."alert('Failed, Customer Delete.')"."</script>";
    }
    header("Location: ../page/customer_management.php");
    exit();
  }
  function login_process(){
      

    require_once("../db/DbConnect.php");

    // Check if the form is submitted
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    try {
        $db = new DbConnect();
        $dbConn = $db->connect();

        $sql = "SELECT * FROM admins WHERE Username = :username AND Status= 'Active'";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if ($password === $admin['Password']) {
                // Password is correct
                $_SESSION['admin_id'] = $admin['ID'];
                $_SESSION['admin_username'] = $admin['Username'];
                $_SESSION['admin_role'] = $admin['Role'];
                header("Location: ../page/index.php");
                
            } else {

                $_SESSION['error'] = "Invalid username or password.";
                 header("Location: ../page/authentication-login.php");
                
            }
        } else {
            $_SESSION['error'] = "Invalid username or password.";
             header("Location: ../page/authentication-login.php");
            
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
         header("Location: ../page/authentication-login.php");
        
    }
    exit();
    

  }


exit();

?>