<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h2>Kino Database Manager</h2>
            <form method="get" id="buttons">
                <input type="submit" name="page" value="Frontpage">
                <input type="submit" name="page" value="Database">
                <input type="submit" name="page" value="Settings">
                <input type="submit" name="page" value="Logout">
            </form>
        </header>
        <div id="main">
            <?php
                session_start();

                if ($_SESSION['greeted'] == false) {
                    echo "Welcome, " . $_SESSION['username'] . "!";
                    $_SESSION['greeted'] = true;
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if ($_GET["page"] == "Logout") {
                        session_destroy();
                        header("Location: login.php");
                        exit();
                    }
                }

                // ------------------------------------------- //

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $host = "localhost";
                $dbUsername = "root";
                $dbPassword = "";
                $dbName = "kino";

                $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

                if ($conn->connect_error) {
                    die("Connection failed: ".$conn->connect_error);
                }
            ?>
        </div>
        <footer><h5>Logged in as: <?php 

                if (!isset($_SESSION['username'])) {
                    header("Location: login.php");
                    exit();
                } else {
                    echo $_SESSION['username'];
                }
             ?>
             </h5></footer>
    </body>
</html>
