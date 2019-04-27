<?php
include './sanitize.php';
include './redirect.php';
include '../connection/connect.php';

$id = sanitize($_POST['id']);
$username = sanitize($_POST['username']);
$name = addslashes(sanitize($_POST['name']));
$game = addslashes(sanitize($_POST['game']));
$series = sanitize($_POST['series']);
$description = addslashes(sanitize($_POST['description']));
$image = sanitize($_POST['image']);
$author = sanitize($_POST['author']);
    function checkIfEmpty($item) {
        if($item == null || $item == "" || empty($item)) {
            return true;
        } else {
            return false;
        }
    }
    
    $qry_name = (!checkIfEmpty($name) ? "name='$name'" : "");
    $qry_user = (!checkIfEmpty($username) ? "edited_by='$username'" : "");
    $qry_game = (!checkIfEmpty($game) ? "game='$game'" : "");
    $qry_series = (!checkIfEmpty($series) ? "series='$series'" : "");
    $qry_description = (!checkIfEmpty($description) ? "description='$description'" : "");
    $qry_image = (!checkIfEmpty($image) ? "image='$image'" : "");
    $qry_author = (!checkifEmpty($author) ? "author='$author'" : "");
    
    $settings_arr = [$qry_name, $qry_user, $qry_game, $qry_series, $qry_description, $qry_image, $qry_author];
    $last = 0;
    $res = "";
    
        foreach($settings_arr as $key=>$value) {
        if(checkIfEmpty($value)) {
            //do nothing
        } else {
            $last = $key;
        }
    }
    foreach($settings_arr as $key=>$value) {
        if(checkIfEmpty($value)) {
            $res = $res;
        } else {
            if($key != $last) {
                $res = $res .  $value . ", ";
            } else {
                $res = $res . $value;
            }
        }
    }
    $csql = "SELECT * FROM spirits WHERE id=$id";
    $result = $conn->query($csql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $oldname = $row['name'];
            $oldgame = $row['game'];
            $oldseries = $row['series'];
            $olddescription = $row['description'];
            $oldimage = $row['image'];
        }
    }
    $usql = "INSERT INTO spiritChangelog (oldName, oldGame, oldSeries, oldDescription, oldImage, newName, newGame, newSeries, newDescription, newImage, user, action)
    VALUES ('$oldname', '$oldgame', '$oldseries', '$olddescription', '$oldimage', '$name', '$game', '$series', '$description', '$image', '$username', 'edit')";
    if($conn->query($usql) == TRUE) {
        echo "yote";
    } else {
        echo $conn->error;
    }
    $sql = "UPDATE spirits SET $res WHERE id=$id";
    
    if($conn->query($sql) == TRUE) {
        redirect('../index.php?ecode=editsuccess');
    } else {
    	redirect('../index.php?ecode=failure');
        echo $db->error;
    }