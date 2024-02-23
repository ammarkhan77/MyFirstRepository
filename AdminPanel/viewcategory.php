<?php
include('query.php');
include('header.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded mx-0">
        <div class="col-md-6 text-center m-3">
            <h3> View Category</h3>
            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $pdo->query("select * from temcategories");
                        $allCategories = $query->fetchall(PDO::FETCH_ASSOC);
                        // print_r($allCategories);
                        foreach ($allCategories as $singleItem) {
                            ?>
                            <tr class="">
                                <td scope="row" class="m-2">
                                    <?php echo $singleItem["name"] ?>
                                </td>
                                <td class="m-2">
                                    <?php echo $singleItem["des"] ?>
                                </td>
                                <td class="m-2"><img height="100px" src="img/<?php echo $singleItem["image"] ?>" alt="">
                                </td>
                                <td class="m-2"><a href="editcategory.php?id=<?php echo $singleItem["id"] ?>"
                                        class="btn btn-success">Edit</a></td>
                                <td class="m-2"><a href="?did=<?php echo $singleItem["id"] ?>" class="btn btn-danger">Delete</a></td>
                                <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="addcategory.php">Add Categories</a>
        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include('footer.php');
?>