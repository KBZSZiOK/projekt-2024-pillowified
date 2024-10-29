<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method="post">
            <input type="submit" value="Logout">
        </form>
        <?php
            session_start();

            if (!isset($_SESSION['username'])) {
                header("Location: login.php");
                exit();
            }
            
            echo "Welcome, " . $_SESSION['username'] . "!";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                session_destroy();
                header("Location: login.php");
                exit();
            }
        ?>
    </body>
</html>
