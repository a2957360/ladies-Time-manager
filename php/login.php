<?php 
ob_start();
session_start(); 
$errormessage = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $errormessage = "";
      $dsn = "mysql:host=localhost;dbname=wutia_Assignment";
      $username = 'wutia_001';
      $password = 'Wty2957360';
      $pdo = new PDO($dsn, $username, $password);
      $logname = $_POST['email'];
      $logpassword = $_POST['password'];
      $stmt = $pdo->prepare("SELECT * FROM `usertable` where `Email` = '$logname';");
      $stmt->execute();
      if($stmt != null){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($logpassword == $row['Password']){
              $_SESSION["Username"] = $logname;
              $id = $row['Id'];
              $_SESSION["UserId"] = $id;
              echo "<script> location.href='Calendar.php'; </script>";
          }else{
              $errormessage = "Your username or password is not correct, please enter again.";
          }
      }
    }else{
session_unset();
session_destroy();
    }
?>
<!doctype html>
<html class="gradient">
<head>
<meta charset="UTF-8">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="../js/nav.js"></script>-->
<title>Welcome to LadyTime</title>
</head>
<body>
<div class="">
<div class="xs-menu-cont">
 <div id="menutoggle" class="microMenu">
  <i href="#">≡</i>
      <div class="logoMicro">
        <a href="#">
        
         </a>
      </div>
      <div class="logInMicro">
        <a href="#">
          SignUp
        </a>
      </div>
  </div>
  <nav id="nav" class="xs-menu displaynone">
    <ul id="submenutoggle" class="navigation">
      <div class="logo">
        <a href="#">
          
        </a>
      </div>
      <div class="logIn">
        <a href="register.php">
          SignUp
        </a>
      </div>
    </ul>
  </nav>
</div>
<div class="middleContainer">
  <div class="titleLogin textLogin">
    Good to see you back
  </div>
  <div class="wordLogin textLogin">
    Far far away, behind the word mountains, far from
  </div>
  <div class="roundRecbtnContainer">
    <div class="whiteLine"></div>
    <div class="">sign in by account</div>
    <div class="whiteLine"></div>
  </div>
  <div class="roundRecbtnContainer">
  <!--form begin-->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
     <div class="" id="form1">
       <div class="inputForm formContainer">
        <div class="infoAndInput">
          <input name="email" type="text" class="feedback-input" id="email" placeholder="Email" />
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
        </div>
        <div class="infoAndInput">
          <password>
            <input name="password" type="password" class="feedback-input" id="password" placeholder="Password" value=""/>
            <button id="visInvis" class="buttonVis buttonInVis"></button>
          </password>
          <p  class="infoAndInputErr displaynoneinfo">
            <!--Must be at least 8 charactors include at least one uppercase letter and one number-->
          </p>
         </div>
       </div>
       <div class="forgetPassword displaynoneinfo">
          The email or password are not matched, <a href="#">Forget Password?</a>
        </div>
          <?=$errormessage?>
       <p class="inputForm">
       <input name="next" type="submit" class="feedback-input submitBtn" id="submit" value="Sign In"/>
       </p>
     </div>
   </form>
  <!--form end-->
  </div>
  <!--<div class="disclamer">
  By signing up I agree to the terms of service and privacy policy.
  </div>-->
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/nav.js"></script>

</body>
</html>
