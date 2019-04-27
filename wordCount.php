<?php include '../connection/connect.php';
    $sql = "SELECT description FROM spirits";
    $result = $conn->query($sql);
    $arr = [];
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $words = explode(" ", $row['description']);
            foreach($words as $word) {
                array_push($arr, $word);
            }
        }
    }
    echo sizeOf($arr);
?>