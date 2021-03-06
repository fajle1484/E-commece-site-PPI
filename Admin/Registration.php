<?php require_once '../partial/_header.php';?>


<?php
 $message = false;

 if (isset($_POST['register'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $username = trim($_POST ['username']);


    require_once '../database/db_connection.php';

    $query = "INSERT INTO   users_information (`first_name`, `last_name`, `username`,
               `email`, `password`,  `email_verification_token`, `email_at`, `active`, `role`) 
             VALUES (:first_name, :last_name, 
             :username, :email, :password, :email_verification_token, :email_at, :active, :role)";


    $stmt = $connect->prepare($query);

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindValue(':email_verification_token', '');
    $stmt->bindValue(':email_at', date('Y-m-d'));
    $stmt->bindValue(':active', 1);
    $stmt->bindValue(':role', 'admin');
    $response = $stmt->execute();

      if($response){
          $message = 'Registration Successful';
          header('Location:index.php');
      }
      else{
          $message = 'Registration Usuccessful';
      }

  }


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,
                  minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registration Form</title>
        <link rel="stylesheet" href="../css/cstyle.css" type="text/css">
    </head>
<body>
<h1> Admin Registration Form:</h1>
    <div class="register">
        <form id="registration" method="post" action="">
                <?php if ($message): ?>
                    <div class="alert alert-success" id="masegg">
                       <?php echo $message; ?>
                    </div>
                <?php endif; ?>
            <h2>Regitration Here</h2>
                <label>First Name:</label><br>
                <input type="text" name="first_name" placeholder="Enter your first name" id="name"
                       required><br><br>

                <label>Last Name:</label><br>
                <input type="text" name="last_name" placeholder="Enter your last name" id="name"
                       required><br><br>

                <label>E-mail:</label><br>
                <input type="email" name="email" placeholder="Enter your E-mail"
                       id="name" required><br><br>

                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Enter your password" id="name"
                       required><br><br>

                <label>Username</label><br>
                <input type="text" name="username" placeholder="Enter your username" id="name">
                <br><br>

            <button type="submit" name="register" id="sub">Register</button>
        </form>

    </div>
  <?php require_once '../partial/_footer.php';?>
</body>
</html>