<?php include 'header.php';
if (empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<div class="header">
    <h2>Home Page</h2>
</div>
<div class="content">
    </h3>Welcome <?php echo $_SESSION["name"]; ?></h3>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>

</html>