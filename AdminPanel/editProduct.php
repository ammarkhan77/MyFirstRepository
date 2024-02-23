<?php
include('query.php');
include('header.php');
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $pdo->prepare('select temproducts.*, temcategories.name as catName, temcategories.id as catId from temproducts inner join temcategories on temproducts.c_id = temcategories.id where temproducts.id = :id');
    $query->bindParam('id', $id);
    $query->execute();
    $product = $query->fetch(PDO::FETCH_ASSOC);
}
?>





<!-- Blank Start -->
<div class="container-fluid pt-4 px-4 ">
    <div class="row vh-100 bg-light rounded mx-0 ">
        <div class="col-md-6 text-center m-5">
            <h3> Update Product</h3>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group m-3">
                    <label for="">Name</label>
                    <input type="text" name="productName" value="<?php echo $product["name"] ?>" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Price</label>
                    <input type="text" name="productPrice" value="<?php echo $product["price"] ?>" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Quantity</label>
                    <input type="text" name="productQty" value="<?php echo $product["qty"] ?>" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group m-3">
                    <label for="">Image</label>
                    <input type="file" name="productImage" id="" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    <span>value="
                        <?php echo $product["image"] ?>"
                    </span>
                </div>

                <div class="form-group m-3">
                    <label for="">Description</label>
                    <input type="text" name="productDes" value="<?php echo $product["des"] ?>" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group">
                    <label for="">Select Category</label>
                    <select class="form-control" name="categoryId" id="">
                        <option value="<?php echo $product["catId"] ?>">
                            <?php echo $product["catName"] ?>
                        </option>
                        
                        <?php
                        $query = $pdo->prepare("Select * from temcategories where name != :cateName ");
                        $query->bindParam('cateName', $product['catName']);
                        $query->execute();
                        $categoriesList = $query->fetchall(PDO::FETCH_ASSOC);
                        foreach ($categoriesList as $cat) {
                            ?>
                            <option value="<?php echo $cat['id'] ?>">
                                <?php echo $cat['name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                        
                    </select>
                </div>

                <button name="updateProduct" class="btn btn-info m-5" type="">Update Product</button>
            </form>
        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include('footer.php');
?>