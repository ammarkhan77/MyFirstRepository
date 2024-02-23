<?php
include('query.php');
include('header.php');
?>
<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
    // echo ($id);
    $query = $pdo->prepare("select * from temcategories where id = :cId");
    $query->bindParam("cId",$id);
    $query->execute();
    $cat = $query->fetch(PDO::FETCH_ASSOC); 
    // print_r($cat);
}
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center">
            <h3> Edit Category</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group m-3">
                    <label for="">Name</label>
                    <input type="text" name="categoryName" value="<?php echo $cat["name"]?>" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Image</label>
                    <input type="file" name="categoryImage" value="<?php echo $cat["image"]?>" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Description</label>
                    <input type="text" name="categoryDes" value="<?php echo $cat["des"]?>" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <button name="editCategory" class="btn btn-info m-5" type="submit">Add Category</button>
            </form>
        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include('footer.php');
?>