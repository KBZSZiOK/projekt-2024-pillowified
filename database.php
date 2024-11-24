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
                        $_SESSION['user'] = $user;
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
            <h2>Goofy Ahh Cinema</h2>
            <form method="get" id="buttons">
                <input type="submit" name="page" value="Home" class="bordered">
                <?php
                    if ($conn->connect_error) {
                        die("Connection failed: ".$conn->connect_error);
                    }
        
                    $sql = "SELECT * FROM uzytkownicy";
                    $result = $conn->query($sql);
                     
                    $user = $_SESSION['user'];
                    if ($user["Access"] == "1") {
                        echo '<input type="submit" name="page" value="Database" class="bordered">';
                    }
                     
                ?>
                <input type="submit" name="page" value="Settings" class="bordered">
                <input type="submit" name="page" value="Logout" class="bordered">
            </form>
        </header>
        <div id="main">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                            case "Home":
                                $queryString = $_SERVER['QUERY_STRING'];

                                echo "
                                <div id='scroller'>
                                    <span>please work</span>
                                </div>";
                                if ($_SESSION['greeted'] == false) {
                                    echo "<div id='welcomer'>Welcome, " . $_SESSION['username'] . "!</div>";
                                    $_SESSION['greeted'] = true;
                                }
                                echo "<div id='main-home'>
                                <div>
                                    <h1>Welcome to our Cinema!</h1>
                                    <p>no idea what to put here ¯\_(ツ)_/¯
                                    <br>wait for updates ig
                                    <br>(surely will add a special page for visitors)</p>

                                </div>";
                                echo "</div>";
                                break;
                            case "Settings":
                                $queryString = $_SERVER['QUERY_STRING'];
                
                                echo "<div><h1>Settings</h1>
                                <br>
                                <form method='get' name='page' action='?" . htmlspecialchars($queryString) . "'>
                                    <ul>
                                        <li><input type='submit' name='page' value='Theme' style='border:0; background-color:transparent; color:" . $_SESSION['textcolor'] . "; text-decoration:underline;'></li>
                                    </ul>
                                </form></div>";
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
                                
                                echo '<div id="main-database">';

                                if ($conn->connect_error) {
                                    die("Connection failed: ".$conn->connect_error);
                                }

                                $table_query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'kino'";
                                $table_result = $conn->query($table_query);

                                $tables = [];
                                if ($table_result) {
                                    while ($row = $table_result->fetch_assoc()) {
                                        if ($row['TABLE_NAME'] != "uzytkownicy") {
                                            $tables[] = $row['TABLE_NAME'];
                                        }
                                    }
                                }
                                $_SESSION['tables_array'] = $tables;
                                        $user = $_SESSION['user'];
                                        if ($user["Modify"] == "1") {
                                            echo '
                                                <div id="left" class="bordered"><br>
                                                    <div><h2>Table Modifier</h2>
                                                    <form method="POST">
                                                        <select name="actioner" id="actioner">';
                                                        foreach ($tables as $table_name) {
                                                            echo '<option value="' . htmlspecialchars($table_name) . '">' . htmlspecialchars($table_name) . '</option>';
                                                        }
                                                    echo '
                                                        </select>';
                                                        echo '<input type="hidden" name="id" value="2">';
                                                        echo '<input type="submit" value="Go" name="tablechooser"><br>';
                                                    echo '</form></div>';
                                            if (isset($_SESSION['chosentable'])) {
                                                echo 'Chosen table: ' . htmlspecialchars($_SESSION["chosentable"]);
                                                echo '<br><br>
                                                    <form method="POST">
                                                        <div>
                                                            <h5>Row Adder</h5>';
                                                            if (isset($_SESSION['columns_array'])) {
                                                                $columns_array = $_SESSION['columns_array'];
                                                                $not_null_columns = $_SESSION['not_null_columns'];
                                                                $keys = $_SESSION['keys'];

                                                                $columns_array = $_SESSION['columns_array'];
                                                                $columns_data_types = $_SESSION['column_type'];
                                                    
                                                                foreach ($columns_array as $index => $column_name) {
                                                                    if (isset($columns_data_types[$index])) {
                                                                        $column_type = $columns_data_types[$index];
                                                        
                                                                        echo '<label for="' . htmlspecialchars($column_name) . '">' . htmlspecialchars($column_name) . '</label><br>';
                                                        
                                                                        $input_type = 'text'; 
                                                                        if ($column_type == 'int' || $column_type == 'bigint' || $column_type == 'smallint') {
                                                                            $input_type = 'number';
                                                                        } elseif ($column_type == 'date' || $column_type == 'datetime' || $column_type == 'timestamp') {
                                                                            $input_type = 'date';
                                                                        } elseif ($column_type == 'boolean' || $column_type == 'tinyint') {
                                                                            $input_type = 'checkbox';
                                                                        }
                                                        
                                                                        echo '<input type="' . $input_type . '" name="' . htmlspecialchars($column_name) . '" id="' . htmlspecialchars($column_name).'"';
                                                                        
                                                                    
                                                                        if (in_array($column_name, $not_null_columns) && !in_array($column_name, $keys) && $input_type != 'checkbox') {
                                                                            echo ' required';
                                                                        }
                                                                        if ($column_type == 'boolean' || $column_type == 'tinyint') {
                                                                            echo ' value="1"';
                                                                        }

                                                                        echo '><br>';
                                                                    } else {
                                                                        echo "Data type not found for column: " . htmlspecialchars($column_name) . "<br>";
                                                                    }
                                                                }
                                                            } else {
                                                                echo "No columns available.";
                                                            }
                                                            echo '<input type="hidden" name="id" value="3">
                                                            <input type="submit" value="Add" name="changer">
                                                        </div>
                                                    </form><br>
                                                        <form method="POST">
                                                        <div>
                                                            <h5>Row Remover</h5>';
                                                            if (isset($_SESSION['keys'])) {
                                                                $keys = $_SESSION['keys'];
                                                                foreach ($keys as $key_name) {
                                                                    echo '<label for="' . htmlspecialchars($key_name) . '">'.htmlspecialchars($key_name).'</label><br>';
                                                                    echo '<input type="number" name="' . htmlspecialchars($key_name) . '" id="' . htmlspecialchars($key_name) . '"><br>';
                                                                }
                                                            } else {
                                                                echo "No keys available.";
                                                            }
                                                            echo '<input type="submit" value="Remove" name="changer">
                                                        </div>
                                                        <input type="hidden" name="id" value="4">
                                                        </form>';
                                            }
                                            echo '
                                                <br></div>';
                                        }
                                        if ($user["Select"] == "1") {
                                            echo '
                                                <div id="right" class="bordered">';
                                                echo '<h1>Table Previewer</h1>
                                                <form method="post">
                                                <select name="table_previewer" id="table_previewer">';
                                                foreach ($tables as $table_name) {
                                                    echo '<option value="' . htmlspecialchars($table_name) . '">' . htmlspecialchars($table_name) . '</option>';
                                                }
                                                echo '
                                                </select>';
                                                echo '<input type="hidden" name="id" value="5">';
                                                echo '<input type="submit" value="Go" name="tablechooser">
                                                </form>';
                                                if (isset($_SESSION['previewtable']) && isset($_SESSION['columns_tablepreviewer']) && isset($_SESSION['rows_tablepreviewer'])) {
                                                    echo 'Chosen table: ' . htmlspecialchars($_SESSION["previewtable"]);
                                                    echo '<br><br><table>
                                                            <tr>';
                                                    foreach ($_SESSION['columns_tablepreviewer'] as $column_name) {
                                                        echo "<th>" . htmlspecialchars($column_name) . "</th>";
                                                    }
                                                    echo '</tr>';
                                                    foreach ($_SESSION['rows_tablepreviewer'] as $row) {
                                                        echo '<tr>';
                                                        foreach ($row as $value) {
                                                            echo '<td>' . htmlspecialchars($value) . '</td>';
                                                        }
                                                        echo '</tr>';
                                                    }
                                                    echo '</table>';
                                                } else {
                                                    echo "No data available to display.";
                                                }
                                                echo '<br><br></div>';
                                        }
                                        if ($user["Modify"] == "0" && $user["Select"] == "0") {
                                            header("Location: database.php?page=waltuh");
                                        }   
                                    
                                
                                echo '</div>';
                                break;
                            case "waltuh":
                                $queryString = $_SERVER['QUERY_STRING'];
                                $user = $_SESSION['user'];
                                if ($user["Modify"] == "1" || $user["Select"] == "1" || $user["Access"] == "0") {
                                    header("Location: database.php?page=Home");
                                }   
                                echo '<div id="waltuh">
                                    <h1>NO PERMS?</h1>
                                    <div class="tenor-gif-embed" data-postid="18043850" data-share-method="host" data-aspect-ratio="1.3617" data-width="100%"><a href="https://tenor.com/view/walter-white-falling-fast-gif-18043850">Walter White Falling GIF</a>from <a href="https://tenor.com/search/walter+white-gifs">Walter White GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
                                </div>';
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
                        } elseif ($_POST["id"] == "2") {
                            $_SESSION["chosentable"] = $_POST["actioner"];

                            if ($conn->connect_error) {
                                die("Connection failed: ".$conn->connect_error);
                            }

                            $not_null_columns = [];
                            $result = $conn->query("SELECT COLUMN_NAME, IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'kino' AND TABLE_NAME = '".$conn->real_escape_string($_SESSION['chosentable'])."'");
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['IS_NULLABLE'] === 'NO') {
                                        $not_null_columns[] = $row['COLUMN_NAME'];
                                    }
                                }
                            }

                            $columns_query = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $conn->real_escape_string($_SESSION['chosentable']) . "' AND TABLE_SCHEMA = 'kino'";
                            $columns_result = $conn->query($columns_query);

                            $key_query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = '". $conn->real_escape_string($_SESSION['chosentable']) . "' AND TABLE_SCHEMA = 'kino' AND CONSTRAINT_NAME = 'PRIMARY'";
                            $key_result = $conn->query($key_query);

                            $columns_array = [];
                            $column_type = [];
                            if ($columns_result) {
                                while ($column = $columns_result->fetch_assoc()) {
                                    $columns_array[] = $column['COLUMN_NAME'];
                                    $column_type[] = $column['DATA_TYPE'];
                                }
                            }
                            if ($columns_result) {
                                while ($type = $columns_result->fetch_assoc()) {
                                    $column_type[] = $type['DATA_TYPE'];
                                }
                            }
                            $keys = [];
                            if ($key_result) {
                                while ($key = $key_result->fetch_assoc()) {
                                    $keys[] = $key['COLUMN_NAME'];
                                }
                            }
                            $_SESSION['keys'] = $keys;
                            $_SESSION['columns_array'] = $columns_array;
                            $_SESSION['not_null_columns'] = $not_null_columns;
                            $_SESSION['column_type'] = $column_type;
                            header("Location: database.php?page=Database");
                        } elseif ($_POST["id"] == "3") {
                            if (isset($_SESSION['columns_array'])) {
                                $columns_array = $_SESSION['columns_array'];
                                $column_types = $_SESSION['column_types'];
                                
                                $columns = [];
                                $values = [];
                            
                                foreach ($columns_array as $column_name) {
                                    if (isset($_POST[$column_name])) {
                                        $value = $_POST[$column_name];
                            
                                        if (isset($column_types[$column_name]) && $column_types[$column_name] === 'tinyint(1)') {
                                            $value = $value === 'on' ? 1 : 0;
                                        } else {
                                            $value = !empty($value) ? $value : NULL;
                                        }
                            
                                        
                                        $columns[] = "`" . $column_name . "`";
                                        $values[] = "'" . $conn->real_escape_string($value) . "'";
                                    }
                                }
                            
                                if (!empty($columns) && !empty($values)) {
                                    $columns_str = implode(", ", $columns);
                                    $values_str = implode(", ", $values);
                            
                                    $sql = "INSERT INTO `" . $_SESSION["chosentable"] . "` ($columns_str) VALUES ($values_str)";
                                    
                            
                                    if ($conn->query($sql) === TRUE) {
                                        echo "New record created successfully!";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                }
                            }
                            
                            if ($_SESSION["previewtable"]) {
                                $columns_query_tablepreviewer = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $conn->real_escape_string($_SESSION['previewtable']) . "' AND TABLE_SCHEMA = 'kino'";
                                $columns_result_tablepreviewer = $conn->query($columns_query_tablepreviewer);

                                $columns_tablepreviewer = [];
                                if ($columns_result_tablepreviewer) {
                                    while ($column = $columns_result_tablepreviewer->fetch_assoc()) {
                                        $columns_tablepreviewer[] = $column['COLUMN_NAME'];
                                    }
                                }
                                $_SESSION['columns_tablepreviewer'] = $columns_tablepreviewer;

                                $rows_query_tablepreviewer = "SELECT * FROM " . $conn->real_escape_string($_SESSION['previewtable']);
                                $rows_result_tablepreviewer = $conn->query($rows_query_tablepreviewer);

                                $rows_tablepreviewer = [];
                                if ($rows_result_tablepreviewer) {
                                    while ($row = $rows_result_tablepreviewer->fetch_assoc()) {
                                        $rows_tablepreviewer[] = $row;
                                    }
                                }
                                $_SESSION['rows_tablepreviewer'] = $rows_tablepreviewer;
                            }

                            header("Location: database.php?page=Database");
                        } elseif ($_POST["id"] == "4") {
                            $table_name = $_SESSION['chosentable'];
                            $keys = $_SESSION['keys'];

                            $conditions = [];
                            foreach ($keys as $key_name) {
                                if (isset($_POST[$key_name])) {
                                    $key_value = $conn->real_escape_string($_POST[$key_name]);
                                    $conditions[] = "`$key_name` = '$key_value'";
                                }

                                if (!empty($conditions)) {
                                    $where_clause = implode(" AND ", $conditions);
                        
                                    $sql = "DELETE FROM `$table_name` WHERE $where_clause";
                        
                                    if ($conn->query($sql) === TRUE) {
                                        echo "Row removed successfully!";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                } else {
                                    echo "No key values provided!";
                                }
                            }

                            if ($_SESSION["previewtable"]) {
                                $columns_query_tablepreviewer = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $conn->real_escape_string($_SESSION['previewtable']) . "' AND TABLE_SCHEMA = 'kino'";
                                $columns_result_tablepreviewer = $conn->query($columns_query_tablepreviewer);

                                $columns_tablepreviewer = [];
                                if ($columns_result_tablepreviewer) {
                                    while ($column = $columns_result_tablepreviewer->fetch_assoc()) {
                                        $columns_tablepreviewer[] = $column['COLUMN_NAME'];
                                    }
                                }
                                $_SESSION['columns_tablepreviewer'] = $columns_tablepreviewer;

                                $rows_query_tablepreviewer = "SELECT * FROM " . $conn->real_escape_string($_SESSION['previewtable']);
                                $rows_result_tablepreviewer = $conn->query($rows_query_tablepreviewer);

                                $rows_tablepreviewer = [];
                                if ($rows_result_tablepreviewer) {
                                    while ($row = $rows_result_tablepreviewer->fetch_assoc()) {
                                        $rows_tablepreviewer[] = $row;
                                    }
                                }
                                $_SESSION['rows_tablepreviewer'] = $rows_tablepreviewer;
                            }

                            header("Location: database.php?page=Database");
                        } elseif ($_POST["id"] == "5") {
                            $_SESSION['previewtable'] = $_POST["table_previewer"];

                            $columns_query_tablepreviewer = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $conn->real_escape_string($_SESSION['previewtable']) . "' AND TABLE_SCHEMA = 'kino'";
                            $columns_result_tablepreviewer = $conn->query($columns_query_tablepreviewer);

                            $columns_tablepreviewer = [];
                            if ($columns_result_tablepreviewer) {
                                while ($column = $columns_result_tablepreviewer->fetch_assoc()) {
                                    $columns_tablepreviewer[] = $column['COLUMN_NAME'];
                                }
                            }
                            $_SESSION['columns_tablepreviewer'] = $columns_tablepreviewer;

                            $rows_query_tablepreviewer = "SELECT * FROM " . $conn->real_escape_string($_SESSION['previewtable']);
                            $rows_result_tablepreviewer = $conn->query($rows_query_tablepreviewer);

                            $rows_tablepreviewer = [];
                            if ($rows_result_tablepreviewer) {
                                while ($row = $rows_result_tablepreviewer->fetch_assoc()) {
                                    $rows_tablepreviewer[] = $row;
                                }
                            }
                            $_SESSION['rows_tablepreviewer'] = $rows_tablepreviewer;

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
