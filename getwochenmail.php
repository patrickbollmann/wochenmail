<!DOCTYPE HTML>

<html>
<head> </head>
<body>

<?php
    header('Content-Type: text/html; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "wochenmail");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }

    $von = mysqli_real_escape_string($mysqli, $_POST['von']);
    $bis = mysqli_real_escape_string($mysqli, $_POST['bis']);

        $sql = "SELECT * FROM event WHERE date >= '$von' AND date <= '$bis' ORDER BY date ASC, time ASC";
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row["date"] != $predate){
				$predate = $row["date"];
                echo "<u>";
                echo getTag(date("N", strtotime($row["date"]))).", der ".date("d.m.Y", strtotime($row["date"]));
                echo "</u>";
				echo "<br>";
			}
			 
			 echo date("H:i", strtotime($row["time"])).", ";
			 echo $row["location"]."<br>";
			 echo "<b>".$row["name"]."</b><br>";
			 echo $row["description"]."<br>";
             echo "<a href=".$row["link"].">".$row["link"]."</a><br><br>";
		}
        $mysqli->close();
    
    function getTag($day){
        switch($day){
            case 1:
                return "Montag";
                break;
            case 2:
                return "Dienstag";
                break;
            case 3:
                return "Mittwoch";
                break;
            case 4:
                return "Donnerstag";
                break;
            case 5:
                return "Freitag";
                break;
            case 6:
                return "Samstag";
                break;
            case 7:
                return "Sonntag";
                break;
                
        }
    }
    
    
?>
</body>
</html>
