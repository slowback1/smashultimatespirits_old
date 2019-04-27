<?php 
    include '../connection/connect.php';
    $offset = $_GET['offset'] * 60; 
    $sql = "SELECT * FROM spirits ORDER BY id ASC LIMIT 60 OFFSET $offset";
    $result = $conn->query($sql);
    
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['series'] == "Other") {
                        echo "<a href='details.php?id=".$row['id']."'><div class='spirit' id='".$row['id']."'><p class='hidden'>".$row['name']."</p><p class='hidden'>".$row['game']."</p><p class='hidden'>".$row['series']."</p><p class='hidden'>".$row['description']."</p><p><img src='./img/seriesIcons/".$row['series'].".png'< alt='icon' class='otherIcon' />". $row['id'] ."</p><div class='imageContainer')><img src='img/spiritImages/".$row['id'].".png'/></div><h5>".$row['name']."</h5></div></a>";
                    } else if($row['id'] == 575) {
                    echo "<a href='details.php?id=".$row['id']."'><div class='spirit' id='".$row['id']."'><p class='hidden'>".$row['name']."</p><p class='hidden'>".$row['game']."</p><p class='hidden'>".$row['series']."</p><p class='hidden'>".$row['description']."</p><p><img src='./img/seriesIcons/".$row['series'].".png'< alt='icon' class='thumbnailIcon' />". $row['id'] ."</p><div class='imageContainer')><img src='img/spiritImages/".$row['id'].".png' class='buzzbuzz'/></div><h5>".$row['name']."</h5></div></a>";
                    } else {
                      echo "<a href='details.php?id=".$row['id']."'><div class='spirit' id='".$row['id']."'><p class='hidden'>".$row['name']."</p><p class='hidden'>".$row['game']."</p><p class='hidden'>".$row['series']."</p><p class='hidden'>".$row['description']."</p><p><img src='./img/seriesIcons/".$row['series'].".png'< alt='icon' class='thumbnailIcon' />". $row['id'] ."</p><div class='imageContainer')><img src='img/spiritImages/".$row['id'].".png'/></div><h5>".$row['name']."</h5></div></a>";
                    }
                }
            } else {
                echo false;
            }
?>