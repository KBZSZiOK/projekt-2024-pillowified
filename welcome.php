<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method="post">
            <input type="submit" value="Logout" name="submit">
        </form>
        <?php
            session_start();

            if (!isset($_SESSION['username'])) {
                header("Location: login.php");
                exit();
            }
            if ($_SESSION['greeted'] == false) {
                echo "Welcome, " . $_SESSION['username'] . "!";
                $_SESSION['greeted'] = true;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["submit"] == "Logout") {
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
    </body>
</html>
