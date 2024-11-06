<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["page"])) {
                    if ($_GET["page"] == "Logout") {
                        session_destroy();
                        header("Location: login.php");
                        exit();
                    }
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

            $sql = "SELECT * FROM uzytkownicy";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $user_found = false;
        
                while ($user = $result->fetch_assoc()) {
                    if ($user["ID"] == $_SESSION["user_id"]) {
                        $user_found = true;
                    }
                }
        
                if (!$user_found) {
                    session_destroy();
                    header("Location: login.php");
                    exit();
                }
            } else {
                session_destroy();
                header("Location: login.php");
                exit();
            }
        ?>
        <header>
            <h2>Kino Database Manager</h2>
            <form method="get" id="buttons">
                <input type="submit" name="page" value="Home">
                <?php
                    $host = "localhost";
                    $dbUsername = "root";
                    $dbPassword = "";
                    $dbName = "kino";
        
                    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        
                    if ($conn->connect_error) {
                        die("Connection failed: ".$conn->connect_error);
                    }
        
                    $sql = "SELECT * FROM uzytkownicy";
                    $result = $conn->query($sql);
                     
                    while ($user = $result->fetch_assoc()) {
                        if ($user["ID"] == $_SESSION["user_id"]) {
                            if ($user["Access"] == "1") {
                                echo '<input type="submit" name="page" value="Database">';
                            }
                        }
                    }
                ?>
                <input type="submit" name="page" value="Settings">
                <input type="submit" name="page" value="Logout">
            </form>
        </header>
        <div id="main">
            <?php
                if ($_SESSION['greeted'] == false) {
                    echo "Welcome, " . $_SESSION['username'] . "!";
                    $_SESSION['greeted'] = true;
                }
            ?>
        </div>
        <footer><h5>Logged in as:
        <?php 
            if (!isset($_SESSION['username'])) {
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                echo $_SESSION['username'];
            }
        ?>
        </h5></footer>
    </body>
</html>
