<?php

include '../Class/Artikel.php';
include '../Class/Kassenzettel.php';
include '../Class/Posten.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
var_dump($_POST);

  Kassenzettel::create($_POST);

}else

{

?>


<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
</head>
<script>
    function addForm() {
        let aid = document.createElement('input')
        aid.setAttribute('type', 'text')
        aid.setAttribute('name', 'aId[]')
        let anzahl = document.createElement('input')
        anzahl.setAttribute('type', 'text')
        anzahl.setAttribute('name', 'anzahl[]')
        let divele = document.createElement('div')
        divele.appendChild(aid)
        divele.appendChild(anzahl)
        document.getElementById("neu").appendChild(divele)
    }


</script>
<body>


<div>
    <form action='create.php' method='post'>
        <div id='neu'>
            <div>
                <input type='number' name='aId[]' value=''>
                <input type='number' name='anzahl[]' value=''>
            </div>
        </div>
        <input type='submit' value='Save'>
    </form>
</div>
<button onclick='addForm()'>add</button>
</body>
</html>

<?php
};

