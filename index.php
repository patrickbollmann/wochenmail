<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Wochenmail Formular</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="col-xl-8 col-12">
            <h1>Patricks private Seite</h1>
            <br>
            <form action="formular.php" method="post">
                <h2>Persönliche Informationen</h2>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Vorname:</label> <input class="form-control" name="vorname" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Nachname:</label> <input class="form-control" name="nachname" type="text">
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>E-Mail:</label> <input class="form-control" name="email" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Tel (Optional):</label> <input class="form-control" name="tel" type="text">
                    </div>
                </div>
                <br>

                <h2>Termin</h2>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Name der Veranstaltung:</label> <input class="form-control" name="veranstaltung" type="text" value= <?php echo $num; ?>>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Datum:</label> <input class="form-control" name="datum" type="date" value= <?php echo date('Y-m-d'); ?>>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Uhrzeit:</label> <input class="form-control" name="zeit" type="time" value="0">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Ort:</label> <input class="form-control" name="ort" type="text">
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12 col-12 mb-3">
                        <label>Beschreibung:</label> <input class="form-control" name="beschreibung" type="text" value="Beschreibe hier kurz deine Veranstaltung">
                    </div>
                </div>
                <br>
				<div class="row">
                    <div class="col-md-12 col-12 mb-3">
                        <label>Link zur Veranstaltung:</label> <input class="form-control" name="link" type="text">
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="g-recaptcha" data-sitekey="6Ld4cnsUAAAAADnwsUyd2N5mxvEqw6AW5xeQg1mJ"></div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <button class="btn btn-primary btn-lg mb-3" type="submit">Termin abschicken</button>
                    </div>
                </div>
            </form>
        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<a href="https://patrickbollmann.de/impressum/">Impressum/Datenschutz</a>
    </body>
</html>

