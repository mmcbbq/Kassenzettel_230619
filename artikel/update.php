<?php
include '../Class/Artikel.php';

$id = $_GET['id'] ?? $_POST["id"];
$artikel = Artikel::findOneById($id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $artikel->setname($_POST['name']);
    $artikel->setPreis($_POST['preis']);
    $artikel->setMwstsatz($_POST['mwst']);


    echo 'update';
    header( "refresh:2;url=show.php" );
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    ?>
    <!doctype html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport'
              content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <div class='pb-10'>
        <div class='container ml-20 shadow-lg pt-10 p-3 my-5 bg-body-tertiary rounded'>
            <form method='post' action='update.php' class='mb-10 '>
                <div class="form-floating  mb-3 mt-5">
                    <input type="text" class="form-control" id="name" name='name' placeholder="Name"
                           value='<?php echo $artikel->getName() ?>'>
                    <label for="name">Name</label>
                </div>
                <div class="form-floating  mb-3">
                    <input type="number" class="form-control" id="preis" name='preis' placeholder="Preis" step="0.01"
                           value='<?php echo $artikel->getPreis() ?>'>
                    <label for="preis">Preis</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mwst" id="mwst1" value='7' <?php echo $artikel->getMwstsatz()== 7 ? 'checked' : ""; ?>>
                    <label class="form-check-label" for="mwst1">
                        7
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mwst" id="mwst2" value='19' <?php echo $artikel->getMwstsatz()== 19 ? 'checked' : ""; ?>>
                    <label class="form-check-label" for="mwst2">
                        19
                    </label>
                </div>





                <div class="form-floating mb-3 ml-10">
                    <input type='submit' value='Save' class="btn btn-dark ">
                </div>
                <div>
                    <input class="form-control" type='hidden' id='id' name='id' value='<?php echo $artikel->getId() ?>'>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
}
















