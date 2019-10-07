<?php
	header('Content-Type: text/plain; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "wochenmail");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }

    #$sql = "SELECT * FROM Daten";
    #$result = $mysqli->query($sql);
    #$row = $result->fetch_assoc();

    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $veranstaltung = $_POST["veranstaltung"];
    $datum = $_POST["datum"];
    $zeit = $_POST["zeit"];
    $ort = $_POST["ort"];
    $beschreibung = $_POST["beschreibung"];
	$link = $_POST["link"];
	#captcha
	$secretKey = "key";
	$responseKey = $_POST["g-recaptcha-response"];
	$userIP = $_SERVER["REMOTE-ADDR"];
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
	$response = file_get_contents($url);
	$response = json_decode($response);	
	
	#check captcha
	if($response->success){
		echo "Captcha OK! \n";
		#check eingabe
    if ($vorname == null or $nachname == null or $link == null or $email == null or $veranstaltung == null or $datum == null or $zeit == null or $ort == null or $beschreibung == null){
        echo "Bitte alle Felder ausfüllen";
    }
	#eintrag in db
	else {
        echo "Führe Anfrage aus...\r\n";

        /* Test */
        $sql = "SELECT id FROM `people` WHERE forename = '$vorname' AND surname = '$nachname' and email = '$email'";
        $result = $mysqli->query($sql);
		$people_id = $result->fetch_assoc();
		$pid = $people_id['id'];
		if($pid == ""){
		
		/* People */
        $sql = "INSERT INTO people (forename, surname, email, tel) VALUES (?, ?, ?, ?);";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("ssss", $vorname, $nachname, $email, $tel);
            $OK = $stmt->execute();
			$last = $mysqli->insert_id;
			echo $last;
            
			if ($OK) {
                $adresse_id = $mysqli->insert_id;
                echo "Erfolg Mensch\r\n";
            } else {
                echo $stmt->error . "\r\n";
            }
        }

        /* Event */
        $sql = "INSERT INTO event(date, time, name, location, description, person_id, link) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("sssssss", $datum, $zeit, $veranstaltung, $ort, $beschreibung, $last, $link);
            $OK = $stmt->execute();

            if ($OK) {
                echo "Termin erfolgreich eingetragen\r\n";
            } else {
                echo $stmt->error . "\r\n";
            }
        }
		}
		else{
			/* Event */
        $sql = "INSERT INTO event(date, time, name, location, description, person_id, link) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("sssssss", $datum, $zeit, $veranstaltung, $ort, $beschreibung, $pid, $link);
            $OK = $stmt->execute();

            if ($OK) {
                echo "Termin erfolgreich eingetragen\r\n";
            } else {
                echo $stmt->error . "\r\n";
            }
        }
		}
	
        #$row = $result->fetch_assoc();

        #$adresseID = mysqli_query($verbindung, "INSERT INTO Adresse(Straße, Hausnummer, PLZ, Stadt) VALUES ('homoweg', '7', '33098', 'Paderborn'); SELECT LAST_INSERT_ID()");
        #echo $adresseID;
        #$kunde = "INSERT INTO Kunde(Adresse_ID, Vorname, Nachname, Email, Telefon) VALUES ('$adresseID', '$vorname', '$nachname', '$email', '$tel');SELECT LAST_INSERT_ID()";
        #$kundenID = mysqli_query($verbindung, $kunde);
        #$rechnung = "INSERT_INTO Rechnung (Rechnungsnummer, Kunde_ID, Rechnungsdatum, Leistungsdatum, Rabatt, Versandkosten, Zahlung_erhalten) VALUES ('$rechnungsnummer', '$kundenID', '$rechnungsdatum', '$leistungsdatum', '$rabatt', '$versandkosten', '$zahlung_erhalten')";
        #$eintragenRechnung = $mysqli->query($rechnung);
        #$aufstellung = "INSERT_INTO Kunde (Rechnungsnummer, Artikelnummer, Anzahl, Preis,) VALUES ('$rechnungsnummer', '$artikelnummer', '$anzahl', '$preis')";
        #$eintragenAufstellung = $mysqli->query($aufstellung);

        #echo "Daten von " . $_POST["vorname"] . " " . $_POST["nachname"] . " gespeichert";
	}
}
	else{
		echo "Captcha failed";
	}
        $mysqli->close();
    
?>
