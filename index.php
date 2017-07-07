<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'arbitrage';
$user = 'arbitrage';
$pass = 'QCUNCjS3uSpZ9I0U';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$db = new PDO($dsn, $user, $pass, $opt);

$sql = "SELECT * FROM slides WHERE uuid=:id";

try
{
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $_GET['id'], PDO::PARAM_STR);
    $stmt->execute();
    $data = $stmt->fetch();
}
catch(PDOException $e)
{
    // TODO Error handling
    exit;
}

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <title>CHANGEME</title>
    <!-- TODO Add Google Analytics -->
    <!-- TODO Add Facebook Pixel -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    <div class="container-fluid">
        <?php if(isset($data['next_uuid'])) { ?>
        <br />
        <div class="row" id="header-button">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-block btn-lg">Next Page</button>
            </div>
        </div>
        <?php } ?>
        <br />
        <h2 id="title"><?= $data['title'] ?></h2>
        <center>
        <hr />
        <div class="row thumbnail" id="image-frame">
            <img src="img/<?= $data['img_url'] ?>" style="min-width: 90%; min-height: auto;"/>
        </div>
        <hr />
        </center>
        <?php if(isset($data['next_uuid'])) { ?>
        <div class="row" id="footer-button">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-block btn-lg">Next Page</button>
            </div>
        </div>
        <?php } ?>
        <div class="row" id="ad-row-1">

        </div>
        <div class="row" id="ad-row-2">

        </div>
        <div class="row" id="ad-row-3">

        </div>
    </div>
    <?php if(isset($data['next_uuid'])) { ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btn").click(() => {
                window.location.href = "index.php?id=<?= $data['next_uuid'] ?>";
            });
        });
    </script>
    <?php } ?>
</body>