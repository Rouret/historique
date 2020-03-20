<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>History</title>
    <link href="/vendor/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php
            include_once("./screens/nav.php");
        ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Menu</button>
            </nav>
            <div class="container-fluid">
            <?php
                if(isset($_GET["screen"])){
                    include_once("./screens/".$_GET["screen"].".php");
                }else{
                    header("Location:./index.php?screen=home");
                }
            ?>
            </div>
        </div>
    </div>
    <script src="/vendor/jquery-3.4.1/jquery.js"></script>
    <script src="/vendor/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            $("#wrapper").toggleClass("toggled");
        });
        $(".list-group-item").click(function(e) {
            location.href="./index.php?screen="+$(this).attr("data-target")
        });
    </script>
</body>

</html>
