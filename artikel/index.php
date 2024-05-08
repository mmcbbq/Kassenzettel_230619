<?php
include '../Class/Artikel.php';
?>
<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<div class='container ml-20 pt-10'>
    <div class='row'>
        <?php
        foreach (Artikel::findAll() as $artikel) {
            ?>
            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <?php
                        echo '<h5 class="card-title">' . $artikel->getName() . ' </h5>';
                        echo '<p class="card-text">'.'Preis: ' . $artikel->getPreis() . '</p>';
                        echo '<p class="card-text">'.'MWST: ' . $artikel->getMwstsatz() . '</p>';
                        ?>
                        <a href="update.php?id=<?php echo $artikel->getId(); ?>" class="btn btn-primary">Update</a>
                        <a href="delete.php?id=<?php echo $artikel->getId(); ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <div class='m-1'>
        <a href="create.php" class="btn btn-secondary">Create</a>
    </div>
</div>

</body>
</html>