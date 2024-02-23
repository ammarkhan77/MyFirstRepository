<h1>Hello User</h1>
<?php
include('query.php');

if(isset($_SESSION['userEmail'])){
    ?>
    <a href="weblogout.php">Log Out</a>
    <?php
}
    else {
        ?>
        <a href="signin.php">Log In</a>
        <?php
    }

?>