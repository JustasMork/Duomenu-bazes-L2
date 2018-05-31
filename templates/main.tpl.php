<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex">
    <title>Nekilnojamas turtas</title>

    <script type="text/javascript" src="scripts/jquery-1.12.0.min.js"></script>
    <link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="libraries/bootstrap/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
            integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <script type="text/javascript" src="scripts/main.js"></script>
</head>
<body>
<nav id="navbar-example2" class="navbar navbar-light bg-light">

    <div class="container">
        <a class="navbar-brand" href="#">Nekilnojamas turtas</a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="<?= URL('realty', 'list') ?>">Nekilnojamas turtas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL('user', 'list') ?>">Vartotojai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL('sale_contract', 'list') ?>">Pirkimo-pardavimo sutartys</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL('building_type', 'list') ?>">Statinio tipai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL('heating_type','add') ?>">Pridėti šildymo tipą</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:50px;">
    <?php if(sessionExits('error')){ ?>
        <div class="alert alert-danger fade show" role="alert">
            <?= sessionGetOnce('error') ?>
        </div>
    <?php } ?>
    <?php if(sessionExits('success')){ ?>
        <div class="alert alert-success fade show" role="alert">
            <?= sessionGetOnce('success') ?>
        </div>
    <?php } ?>

            <?php
            // įtraukiame veiksmų failą
            if(file_exists($actionFile)) {
                include $actionFile;
            }
            ?>

</div>
</body>
</html>