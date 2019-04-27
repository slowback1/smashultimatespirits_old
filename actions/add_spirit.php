<?php 
    include './sanitize.php';
    include '../connection/connect.php';
    include './redirect.php';
?>

<?php
    $id = sanitize($_POST['id']);
    $username = sanitize($_POST['username']);
    $name = addslashes(sanitize($_POST['name']));
    $game = addslashes(sanitize($_POST['game']));
    $series = addslashes(sanitize($_POST['series']));
    $description = addslashes(sanitize($_POST['description']));
    
    //$image = sanitize($_POST['image']); 
    $csql = "INSERT INTO spiritChangelog (user, newName, newGame, newSeries, newDescription, action) VALUES ('$username', '$name', '$game', '$series', '$description', 'add')";
    if($conn->query($csql) == TRUE) {
        echo "yeet";
    }
    $sql = "INSERT INTO spirits (id, created_by, name, game, series, description) VALUES ('$id','$username', '$name', '$game', '$series', '$description')";
    
    if($conn->query($sql) === TRUE) {
        redirect('../index.php?ecode=addsuccess');
    } else {
        redirect('../index.php?ecode=failure');
    }
?>