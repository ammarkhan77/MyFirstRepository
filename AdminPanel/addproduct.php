<?php
include('query.php');
include('header.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4 ">
    <div class="row vh-100 bg-light rounded mx-0 ">
        <div class="col-md-6 text-center m-5">
            <h3> Add Product</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group m-3">
                    <label for="">Name</label>
                    <input type="text" name="productName" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Price</label>
                    <input type="text" name="productPrice" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
                
                <div class="form-group m-3">
                    <label for="">Quantity</label>
                    <input type="text" name="productQty" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Image</label>
                    <input type="file" name="productImage" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Description</label>
                    <input type="text" name="productDes" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group">
                  <label for="">Select Category</label>
                  <select class="form-control" name="categoryId" id="">
                    <option value="">Select Category</option>
                  <?php
                     $query = $pdo->query("Select * from temcategories");
                     $categories = $query->fetchall(PDO::FETCH_ASSOC);
                     foreach($categories as $allcategories){
                        ?>
                        <option value="<?php echo $allcategories['id']?>"><?php echo $allcategories['name']?></option>
                        <?php
                     }
                    ?>
                  </select>
                </div>
                

                <button name="addproduct" class="btn btn-info m-5" type="addproduct">Add Product</button>
            </form>
        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include('footer.php');
?>