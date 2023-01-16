<?php
class GlobalView
{
    public function head()
    {
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="./jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://kit.fontawesome.com/0b8d4ff304.js" crossorigin="anonymous"></script>
    <link defer rel="stylesheet" type="text/css" href="./index.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
    <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link defer rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
    <script defer src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js">
    </script>

    <link rel="icon" href="../public/images/wasafat-logo">
    <title>projet_TDW</title>
</head>
<?php
    }
    public function header()
    {
    ?>
<div class="header-container">
    <div class="logo">
        <img src="../public/images/logo" alt="" width="80px">
    </div>
    <div class="social-signin">
        <div>
            <h3 style="margin:0">Connecté en tant que :<b> <?php echo $_SESSION["admin"]["username"] ?> </b></h3>
        </div>
    </div>
    <form action="./redirect.php" method="post">
        <button type="submit" class="action-btn" name="logout" style="font-size:24px">
            Se déconnecter
        </button>
    </form>
</div>


<?php
    }
}