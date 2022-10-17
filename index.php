<?php
include_once("connec.php");
require_once("connec.php");

function createConnection(): PDO
{
    return new PDO("mysql:host=". SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

$firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';



$connection = createConnection();
$query = 'INSERT INTO friends (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $connection->prepare($query);

$statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);

$newFriends = $statement->execute();

$newStatement = $connection->query("SELECT * FROM friends");
$newFriends = $newStatement->fetchAll(PDO::FETCH_ASSOC);
var_dump($newFriends);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <header>
    </header>
    <main>
        <form action="" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">firstname</span>
                <input name="firstname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">lastname</span>
                <input name="lastname" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" type="button">Button</button>
            </div>
        </form>
        <ul>
            <?php
            foreach($newFriends as $newFriend)
            { ?><li><?php echo $newFriend['firstname']." ".$newFriend['lastname'];?></li><?php

            } ?>
           
        </ul>
    </main>
    <footer>
    </footer>
</body>
</html>