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
        <header class="bordered" style="background-color: <?php echo $_SESSION['bgtheme']; ?>;">
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
                                        <li><input type='submit' name='page' value='Theme' style='border:0; background-color:transparent; color:" . $_SESSION['textcolor'] . "; text-decoration:underline;'></li>
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
                                break;
                                case "Database":
                                    $queryString = $_SERVER['QUERY_STRING'];
                                    
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

                                    $table_query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'kino'";
                                    $table_result = $conn->query($table_query);

                                    $tables = [];
                                    if ($table_result) {
                                        while ($row = $table_result->fetch_assoc()) {
                                            $tables[] = $row['TABLE_NAME'];
                                        }
                                    }
                                    while ($user = $result->fetch_assoc()) {
                                        if ($user["ID"] == $_SESSION["user_id"]) {
                                            if ($user["Modify"] == "1") {
                                                echo '
                                                    <div id="left" class="bordered" style="width:25%;">
                                                        <h2>Table Modifier<h2>
                                                        <form method="POST">
                                                            <select name="actioner" id="actioner">';
                                                        
                                                            foreach ($tables as $table_name) {
                                                                echo '<option value="' . htmlspecialchars($table_name) . '">' . htmlspecialchars($table_name) . '</option>';
                                                            }

                                                            echo '
                                                            </select>
                                                            <br><br><div>
                                                                <h5>Row Adder</h5>
                                                                    <input type="textbox" name="changer-text">
                                                                    <input type="hidden" name="id" value="2">
                                                                    <input type="submit" value="Add" name="changer">
                                                            </div>
                                                            <div>
                                                                <h5>Row Remover</h5>
                                                                    <input type="textbox" name="changer-text">
                                                                    <input type="hidden" name="id" value="3">
                                                                    <input type="submit" value="Remove" name="changer">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="right" class="bordered" style="width:75%; left:25%;">
                                                        BBBBBBBBBBBBBBBBB
                                                    </div>';
                                            } else {
                                                echo '
                                                    <div id="right" style="width:100%; height:100%;">
                                                        BBBBBBBBBBBBBBBBB
                                                    </div>';
                                            }
                                        }
                                    }
                                    break;
                            case "waltuh":
                                $queryString = $_SERVER['QUERY_STRING'];

                                echo '<div class="tenor-gif-embed" data-postid="25293991" data-share-method="host" data-aspect-ratio="1.33333" data-width="20%"><a href="https://tenor.com/view/walter-white-walter-white-falling-gif-25293991">Walter White Walter White Falling GIF</a>from <a href="https://tenor.com/search/walter+white-gifs">Walter White GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>';
                                break;
                        }
                    }
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["id"])) {
                        if ($_POST["id"] == "1") {
                            $_SESSION["bgtheme"] = $_POST["bgtheme"];
                            $_SESSION["textcolor"] = $_POST["textcolor"];
                            header("Location: database.php?page=Settings");
                        } elseif ($_POST["id"] == "2" || $_POST["id"] == "3") {
                            header("Location: database.php?page=Database");
                        }
                    }
                }
            ?>
        </div>
        <footer class="bordered" style="background-color: <?php echo $_SESSION['bgtheme']; ?>;"><h5>Logged in as:
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
