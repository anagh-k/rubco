<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'logindb');
//Getting Input value
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  if (empty($username) && empty($password)) {
    $error = 'Fileds are Mandatory';
  } else {
    //Checking Login Detail
    $result = mysqli_query($conn, "SELECT*FROM user WHERE username='$username' AND password='$password'");
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      $_SESSION['user'] = array(
        'username' => $row['username'],
        'password' => $row['password'],
        'role' => $row['role']
      );

      $role = $_SESSION['user']['role'];
      //Redirecting User Based on Role
      switch ($role) {
        case 'clerk':
          header('location:clerk.php');
          break;
        case 'officehead':
          header('location:officehead.php');
        case 'adminone':
          header('location:adminone.php');
        case 'admintwo':
          header('location:admintwo.php');
          break;
        case 'adminthree':
          header('location:adminthree.php');
          break;
      }
    } else {
      $error = 1;
    }
  }
}
?>
<html>

<head>
  <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .main-content {
      width: 50%;
      border-radius: 20px;
      box-shadow: 0 5px 5px rgba(0, 0, 0, 0.4);
      margin: 5em auto;
      display: flex;
    }

    .company__info {
      background-color: #008080;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
    }

    .fa-android {
      font-size: 3em;
    }

    @media screen and (max-width: 640px) {
      .main-content {
        width: 90%;
      }

      .company__info {
        display: none;
      }

      .login_form {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
      }
    }

    @media screen and (min-width: 642px) and (max-width: 800px) {
      .main-content {
        width: 70%;
      }
    }

    .row>h2 {
      color: #008080;
    }

    .login_form {
      background-color: #fff;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
      border-top: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    form {
      padding: 0 2em;
    }

    .form__input {
      width: 100%;
      border: 0px solid transparent;
      border-radius: 0;
      border-bottom: 1px solid #aaa;
      padding: 1em 0.5em 0.5em;
      padding-left: 2em;
      outline: none;
      margin: 1.5em auto;
      transition: all 0.5s ease;
    }

    .form__input:focus {
      border-bottom-color: #008080;
      box-shadow: 0 0 5px rgba(0, 80, 80, 0.4);
      border-radius: 4px;
    }

    .my-sub {
      transition: all 0.5s ease;
      width: 70%;
      border-radius: 30px;
      color: #008080;
      font-weight: 600;
      background-color: #fff;
      border: 1px solid #008080;
      margin-top: 1.5em;
      margin-bottom: 1em;
    }

    .btn:hover,
    .btn:focus {
      background-color: #008080;
      color: #fff;
    }
  </style>

<body>
  <nav class="navbar navbar-dark bg-dark" style="height:70; align-content: center">
    <a class="navbar-brand">
      <img src="rubco.jpg" height="50" class="d-inline-block align-center" alt="" style="padding-bottom: 10" />
      <span class="navbar-text navbar-light h1" style="color: white">
        Rubco
      </span></a>
  </nav>

  <div>

    <head>
      <meta charset="UTF-8" />
      <title>Login Page</title>
    </head>

    <body>
      <!-- Main Content -->
      <div class="container-fluid">
        <div class="row main-content bg-success text-center">
          <div class="col-md-4 text-center company__info">
            <span class="company__logo">
              <h2><span class="fa fa-android"></span></h2>
            </span>
            <img src="rubco.jpg" height="100" alt="" />
          </div>
          <div class="col-md-8 col-xs-12 col-sm-12 login_form">
            <div class="container-fluid">
              <div class="row">
                <h2>Log In</h2>
              </div>
              <div class="row">
                <form control="" class="form-group" method="POST">
                  <div class="row">
                    <input type="text" name="username" id="username" class="form__input <?php echo (isset($error)) ? 'border-danger' : '' ?>" placeholder="Username" />
                  </div>
                  <div class="row">
                    <!-- <span class="fa fa-lock"></span> -->
                    <input type="password" name="password" id="password" class="form__input <?php echo (isset($error)) ? 'border-danger' : '' ?>" placeholder="Password" />
                  </div>
                  <?php echo (isset($error)) ? '<div class="alert alert-danger" role="alert">
                    username or password incorrect
                  </div>' : '' ?>
                  <div class="row">
                    <input type="submit" value="Submit" class="my-sub btn" name="login" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </body>

</html>