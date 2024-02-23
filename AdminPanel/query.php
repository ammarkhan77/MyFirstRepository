<?php
include("dbcon.php");
session_start();

// Log In Work Starts here

if (isset($_POST["login"])) {
    $userEmail = $_POST["uEmail"];
    $userPassword = $_POST["uPassword"];
    $query = $pdo->prepare("select * from users where email = :usEmail AND passsword = :usPassword");
    $query->bindParam("usEmail", $userEmail);
    $query->bindParam("usPassword", $userPassword);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($user);
    if ($user['role_id'] == 1) {
        $_SESSION['adminEmail'] = $user['email'];
        $_SESSION['adminName'] = $user['name'];
        $_SESSION['adminId'] = $user['id'];
        echo "<script>alert('login successfully');
        location.assign('index.php')</script>";
    } else if ($user['role_id'] == 2) {
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userName'] = $user['name'];
        $_SESSION['userId'] = $user['id'];
        echo "<script>alert('login successfully');
        location.assign('website.php')</script>";
    }
}

// Add Category Starts here

if (isset($_POST['addCategory'])) {
    $cName = $_POST['categoryName'];
    $cDes = $_POST['categoryDec'];
    $imageName = $_FILES['categoryImage']['name'];
    $imageTmpName = $_FILES['categoryImage']['tmp_name'];
    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    //  print_r($extension);
    $destination = "img/" . $imageName;
    if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") {
        if (move_uploaded_file($imageTmpName, $destination)) {
            $query = $pdo->prepare("insert into temcategories (name, image, des) values (:cName  , :cImage, :cDes)");
            $query->bindParam('cName', $cName);
            $query->bindParam('cImage', $imageName);
            $query->bindParam('cDes', $cDes);
            $query->execute();
            echo "<script>alert('category added successfully');
                          location.assign('viewcategory.php')</script>";
        }
    } else {
        echo "<script>alert('invalid extension');
                         </script>";
    }
}

// Edit Categoy Starts here

if (isset($_POST["editCategory"])) {
    $id = $_GET["id"];
    $cName = $_POST["categoryName"];
    $cDes = $_POST["categoryDes"];
    $query = $pdo->prepare("update temcategories set name = :cName,des = :cDes where id = :cId");
    if (isset($_FILES["categoryImage"])) {
        $imageName = $_FILES["categoryImage"]["name"];
        $imageTmpName = $_FILES["categoryImage"]["tmp_name"];
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $destination = "img/.$imageName";
        if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") {
            if (move_uploaded_file($imageTmpName, $destination)) {
                $query = $pdo->prepare("update temcategories set name = :cName,des = :cDes,image = :cimage where id = :cId");
                $query->bindParam("cimage", $imageName);
            }
        } else {
            echo "<script>alert('Image is not valid')</script>";
        }
    }
    $query->bindParam("cId", $id);
    $query->bindParam("cName", $cName);
    $query->bindParam("cDes", $cDes);
    $query->execute();
    echo "<script>alert('Category Updated Successfully');location.assign('viewcategory.php')</script>";
}

// Delete Category Working Starts here

if (isset($_GET["did"])) {
    $dId = $_GET["did"];
    $query = $pdo->prepare("delete from temcategories where id=:cId");
    $query->bindParam("cId", $dId);
    $query->execute();
}

// Add Products Working Starts here

if (isset($_POST["addproduct"])) {
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQty = $_POST["productQty"];
    $productDes = $_POST["productDes"];
    $categoryId = $_POST["categoryId"];
    $productImageName = $_FILES["productImage"]["name"];
    $productImageTmpName = $_FILES["productImage"]["tmp_name"];
    $extension = pathinfo($productImageName, PATHINFO_EXTENSION);
    $destination = "img/" . $productImageName;
    if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") {
        if (move_uploaded_file($productImageTmpName, $destination)) {
            $query = $pdo->prepare("insert into temproducts (name,image,price,des,qty,c_id) values (:pName,:pImage,:pPrice,:pDes,:pQty,:pc_id)");
            $query->bindParam('pName', $productName);
            $query->bindParam('pImage', $productImageName);
            $query->bindParam('pPrice', $productPrice);
            $query->bindParam('pDes', $productDes);
            $query->bindParam('pQty', $productQty);
            $query->bindParam('pc_id', $categoryId);
            $query->execute();
            echo "<script>alert('Product added successfully');
                          location.assign('viewProduct.php')</script>";
        }


    }
}

// Edit Products Working Starts here

if (isset($_POST['updateProduct'])) {
    $id = $_GET['id'];
    $pName = $_POST['productName'];
    $pPrice = $_POST['productPrice'];
    $pQty = $_POST['productQty'];
    $pDes = $_POST['productDes'];
    $pCatId = $_POST['categoryId'];
    $query = $pdo->prepare('update temproducts set name = :pName, price = :pPrice, des = :pDes, qty = :pQty,c_id = :pc_id where id = :pId');
    if (isset($_FILES['productImage'])) {
        $pImageName = $_FILES['productImage']['name'];
        $pImageTemName = $_FILES['productImage']['tmp_name'];
        $extension = pathinfo($pImageName,PATHINFO_EXTENSION);
        $destination = "img/.$pImageName";
        if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp") {
            if (move_uploaded_file($pImageTemName,$destination)) {
                $query = $pdo->prepare("update temproducts set name = :ppName, image = :ppImage , price = :ppPrice , des = :ppDes, qty = :ppQty, c_id = :pcId where id = :ppid");
                $query->bindParam('ppImage', $pImageName);
            }
        }
    }
    $query->bindParam('ppid', $id);
    $query->bindParam('ppName', $pName);
    $query->bindParam('ppPrice', $pPrice);
    $query->bindParam('ppDes', $pDes);
    $query->bindParam('ppQty', $pQty);
    $query->bindParam('pcid', $pCatId);
    $query->execute();
    echo "<script>alert('Product Updated successfully');
                  location.assign('viewProduct.php')</script>";
}

?>