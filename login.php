<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style1.css">
    </head>
    <body>
            <form action="login.php" method="post">
                <h2 id="login-text">Login</h2>
                <div id="stuff">
                    <div id="inputs">
                        <label for="username">Username: </label>
                        <input type="text" id="username" name="username" required><br>
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" required><br>
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

            if (isset($_SESSION["username"])) {
                header("Location: database.php");
                exit();
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $conn->real_escape_string($_POST["username"]);
                $password = $conn->real_escape_string($_POST["password"]);

                $sql = "SELECT * FROM Administratorzy";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if ($user["Haslo"] == $password) {
                        $_SESSION["username"] = $user["Nazwa"];
                        $_SESSION["user_id"] = $user["ID"];
                        header("Location: database.php");
                        exit();
                    } else {
                        echo "Incorrect password!";
                    }
                } else {
                    echo "User not found!";
                }
            }

            $conn->close();
        ?>
    </body>
</html>
