<?php 
    include '../connection/connect.php';
    include './redirect.php';
    include './sanitize.php';
?>
<?php 
    $id = $_POST['id'];
    $sql1 = "DELETE FROM quizQuestions WHERE id=$id";
    $csql = "SELECT * FROM quizQuestions WHERE id=".$id;
    $res = $conn->query($csql);
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $question = $row['question'];
            $corAns = $row['corAns'];
            $wrongAns1 = $row['wrongAns1'];
            $wrongAns2 = $row['wrongAns2'];
            $wrongAns3 = $row['wrongAns3'];
        }
    }
    $username = $_COOKIE['admin_access'];
    $usql = "INSERT INTO quizChangelog (user, oldQuestion, oldCorAns, oldWrongAns1, oldWrongAns2, oldWrongAns3, action)
    VALUES ('$username', '$question', '$corAns', '$wrongAns1', '$wrongAns2', '$wrongAns3', 'delete')";
    if($conn->query($usql) == TRUE) {
        echo "yeet";
    } else {
        echo $conn->error;  
    }
    
    if($conn->query($sql1) === TRUE) {
        redirect('../index.php?ecode=deletesuccess');
    } else {
        redirect('../index.php?ecode=failure');
    }
    $conn->close();
?>