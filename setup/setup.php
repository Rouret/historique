<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Setup History</title>
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <!-- Main CSS-->
    <link href="/vendor/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="/setup/css/setup.css" rel="stylesheet" media="all">
</head>
<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">DataBase</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <div class="name">Host</div>
                            <div class="value">
                                <input class="input--style-6" type="text" id="host">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Db name</div>
                            <div class="value">
                                <input class="input--style-6" type="text" id="dbname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Username</div>
                            <div class="value">
                                <input class="input--style-6" type="text" id="username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <input class="input--style-6" type="text" id="password">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" type="submit" id="submit">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once("../components/modal.html");
    ?>
    <script src="/vendor/jquery-3.4.1/jquery.js"></script>
    <script src="/vendor/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="/setup/js/setup.js"></script>
</body>
</html>
