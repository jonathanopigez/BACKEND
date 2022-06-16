<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "menuiz";
$message = "";
try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["login"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $query = "SELECT * FROM t_d_user_usr WHERE  USR_MAIL = :username AND USR_PASSWORD = sha1(:password)";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'username'     =>     $_POST["username"],
                    'password'     =>     $_POST["password"],
                    // 'USR_FIRSTNAME'    =>     $_POST["firstname"],
                    // 'USR_LASTNAME'    =>     $_POST["lastname"]
                )
            );
            $users = $statement->fetchAll();

            $count = count($users);

            if ($count > 0) {
                foreach ($users as $user) {
                    $_SESSION["name"] = $user['USR_FIRSTNAME'] . ' ' . $user['USR_LASTNAME'];
                }



                header("location:index.php");
            } else {
                $message = '<label>Wrong Data</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Menuiz - Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <h3 align="">Hello </h3><br />
        <form method="post">
            <label>Email</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
            <a href="inscription.php">S'inscrire</a>
        </form>
    </div>
    <br />
</body>

</html>