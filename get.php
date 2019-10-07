<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Wochenmail erstellen</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="col-xl-8 col-12">
            <h1>Zeitraum festlegen</h1>
            <br>
            <form action="getwochenmail.php" method="post">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Von:</label> <input class="form-control" name="von" type="date">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Bis:</label> <input class="form-control" name="bis" type="date">
                    </div>
                </div>
                <br>

                <button class="btn btn-primary btn-lg mb-3" type="submit">Wochenmail erstellen</button>
            </form>
        </div>
		

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

