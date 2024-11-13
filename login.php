<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style1.css">
    </head>
    <body>
        <div id="info">
            <h5>* login info:<br>
                admin - hotdog32 // 1, 1, 1<br>
                moderator - kebab123 // 1, 1, 0<br>
                viewer - password // 0, 0, 0
            </h5>
        </div>
            <form action="login.php" method="post">
                <h2 id="login-text">Login</h2>
                <div id="stuff">
                    <div id="inputs">
                        <div id="i1">
                            <label for="username">Username: </label>
                            <input type="text" id="username" name="username" required><br>
                        </div>
                        <div id="i2">
                            <label for="password">Password: </label>
                            <input type="password" id="password" name="password" required><br>
                        </div>
                    </div>
                    <input type="submit" value="Login" id="sender">
                </div>
            </form>

        <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            session_start();

            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "kino";

            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

            if ($conn->connect_error) {
                die("Connection failed: ".$conn->connect_error);
            }

            if (isset($_SESSION["user_id"])) {
                header("Location: database.php");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $conn->real_escape_string($_POST["username"]);
                $password = $conn->real_escape_string($_POST["password"]);
            
                $sql = "SELECT * FROM uzytkownicy";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    $user_found = false;
            
                    while ($user = $result->fetch_assoc()) {
                        if ($user["Nazwa"] == $username) {
                            $user_found = true;
            
                            if ($user["Haslo"] == $password) {
                                $_SESSION["username"] = $user["Nazwa"];
                                $_SESSION["user_id"] = $user["ID"];
                                $_SESSION["greeted"] = false;
                                header("Location: database.php?page=Home");
                                exit();
                            } else {
                                echo "Incorrect password!";
                                exit();
                            }
                        }
                    }
            
                    if (!$user_found) {
                        echo "User not found!";
                    }
                } else {
                    echo "No users in the database!";
                }
            }

            $conn->close();
        ?>
    </body>
</html>
