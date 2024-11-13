<?php
    session_start();
    if (!isset($_SESSION['bgtheme'])) {
        $_SESSION['bgtheme'] = "#000000";
    }
    if (!isset($_SESSION['greeted'])) {
        $_SESSION['greeted'] = false;
    }
    if (!isset($_SESSION["textcolor"])) {
        $_SESSION["textcolor"] = "#FFFFFF";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['bgtheme'])) {
            $_SESSION['bgtheme'] = $_POST['bgtheme'];
        }
        if (isset($_POST['textcolor'])) {
            $_SESSION['textcolor'] = $_POST['textcolor'];
        }
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .bordered, #buttons {
                border-color: <?php echo $_SESSION["textcolor"]; ?> !important;
                color: <?php echo $_SESSION["textcolor"]; ?> !important;
            }
        </style>
    </head>
    <body style="background-color: <?php echo $_SESSION['bgtheme']; ?>; color: <?php echo $_SESSION["textcolor"]; ?>; border-color: <?php echo $_SESSION["textcolor"]; ?>;">

        <?php
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
        <header class="bordered">
            <h2>Kino Database Manager</h2>
            <form method="get" id="buttons">
                <input type="submit" name="page" value="Home" class="bordered">
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
                                echo '<input type="submit" name="page" value="Database" class="bordered">';
                            }
                        }
                    }
                ?>
                <input type="submit" name="page" value="Settings" class="bordered">
                <input type="submit" name="page" value="Logout" class="bordered">
            </form>
        </header>
        <div id="main">
            <?php

                if ($_SESSION['greeted'] == false) {
                    echo "Welcome, " . $_SESSION['username'] . "!";
                    $_SESSION['greeted'] = true;
                }
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                            case "Settings":
                                $queryString = $_SERVER['QUERY_STRING'];
                
                                echo "<h1>Settings</h1>
                                    <br>
                                    <form method='get' name='page' action='?" . htmlspecialchars($queryString) . "'>
                                        <ul>
                                            <li><input type='submit' name='page' value='Theme' style='border:0; background-color:transparent; color:blue; text-decoration:underline;'></li>
                                        </ul>
                                    </form>";
                                break;
                            case "Theme":
                                $queryString = $_SERVER['QUERY_STRING'];

                                echo "<h1>Theme</h1>
                                    <br>
                                    <form method='post' name='page' action='?" . htmlspecialchars($queryString) . "'>
                                        <label for='bgtheme'>Background Color:</label>
                                        <input type='color' id='bgtheme' name='bgtheme' value='" . htmlspecialchars($_SESSION['bgtheme']) . "'><br>
                                        <label for='textcolor'>Text Color:</label>
                                        <input type='color' id='textcolor' name='textcolor' value='" . htmlspecialchars($_SESSION['textcolor']) . "'>
                                        <input type='hidden' name='id' value='1'><br>
                                        <input type='submit' value='Submit'>
                                    </form>";
                        }
                    }
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["id"])) {
                        if ($_POST["id"] == "1") {
                            $_SESSION["bgtheme"] = $_POST["bgtheme"];
                            $_SESSION["textcolor"] = $_POST["textcolor"];
                            header("Location: database.php?page=Settings");
                        }
                    }
                }
            ?>
        </div>
        <footer class="bordered"><h5>Logged in as:
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
