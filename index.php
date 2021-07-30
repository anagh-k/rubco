<?php
session_start();
$conn=mysqli_connect('localhost','root','','logindb');
//Getting Input value
if(isset($_POST['login'])){
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $password=mysqli_real_escape_string($conn,$_POST['password']);
  if(empty($username)&&empty($password)){
  $error= 'Fileds are Mandatory';
  }else{
 //Checking Login Detail
 $result=mysqli_query($conn,"SELECT*FROM user WHERE username='$username' AND password='$password'");
 $row=mysqli_fetch_assoc($result);
 $count=mysqli_num_rows($result);
 if($count==1){
      $_SESSION['user']=array(
   'username'=>$row['username'],
   'password'=>$row['password'],
   'role'=>$row['role']
   );
   
   $role=$_SESSION['user']['role'];
   //Redirecting User Based on Role
switch($role){
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
 }else{
 $error='Your PassWord or UserName is not Found';
 }
}
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
{font-family: Arial, Helvetica, sans-serif;}

h1 {
  width: 100%;
  background-color: #FF0000;

  text-align: center;
  color:white;

  
}
.logo-image{
    width: 100px;
    height: 50px;
    
    overflow: hidden;
    margin-top: -56px;
}



</style>
<body>

<div>
   
  <h1>RUBCO<h1>
  <a class="navbar-brand" href="/">
      <div class="logo-image">
            <img src="rubco.jpg" class="img-fluid">
      </div>
</a>
      
</div>
<title>Login Page</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<div class="container d-flex justify-content-center align-items-center"
      style="min-height: 50vh">
<div align="center">
<h3>Login Page</h3>
<form class="border shadow p-3 rounded" 
      	      method="post" 
      	      style="width: 450px;">
<form method="POST" action="">
<body style="background-color:white;">

<table>

   <tr>
     <td>UserName:</td>
  <td><input type="text" name="username"/></td>
   </tr>
   <tr>
     <td>PassWord:</td>
  <td><input type="text" name="password"/></td>
   </tr><br>
   <tr>
     <td></td>
  <td ><input type="submit" name="login" value="Login"/></td>
   </tr>
</table>
<br>
</body>
</form>
</form>
</div>
<?php if(isset($error)){ echo $error; }?>
</div>
</html>