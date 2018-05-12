<?php 
    ob_start();
    session_start(); 
    $errormessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = "mysql:host=localhost;dbname=wutia_Assignment";
    $username = 'wutia_001';
    $password = 'Wty2957360';
    $pdo = new PDO($dsn, $username, $password);
    $Mail = $_POST['email'];
    $Password = $_POST['password'];
    $Repassword = $_POST['password'];
    if($Mail == null || $Password == null)
    {
      $errormessage = "Please Enter Username or Password.";
    }

    if($Password == $Repassword){
    $stmt = $pdo->prepare("SELECT * FROM `usertable` WHERE `Email` = '$Mail';");
    $stmt->execute();
    if($stmt != null){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $errormessage = "Username repeat";
        }
    }
    $stmt = $pdo->prepare("INSERT INTO `usertable` VALUES ('','$Mail','','$Password','','');");
    $stmt->execute();
      if($stmt != null){
          $stmt->fetch(PDO::FETCH_ASSOC);
          $_SESSION["Username"] = $Mail;
          echo "<script> location.href='moreInfo.php'; </script>";
      }else{
        $errormessage = "Sorry, we have some issue in our database.";
      }
    }else{
      $errormessage = "You two password should be same!";
    }
    }

?>
<!doctype html>
<html class="gradient">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
          Signin
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
        <a href="login.php">
          Signin
        </a>
      </div>
    </ul>
  </nav>
</div>
<div class="middleContainer">
  <div class="titleLogin textLogin">
    voluptatem accusantium doloremqu
  </div>
  <div class="wordLogin textLogin">
    Far far away, behind the word mountains, far from
  </div>
  <div class="roundRecbtnContainer">
    <div class="whiteLine"></div>
    <div class="">register using form</div>
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
        <?=  $errormessage ?><br>
       <p class="inputForm">
       <input name="next" type="submit" class="feedback-input submitBtn" id="submit" value="Next"/>
       </p>
     </div>
    </form> 
  <!--form end-->
  </div>
  <div class="disclamer">
  By signing up I agree to the terms of service and privacy policy.
  </div>
</div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/nav.js"></script> -->

</body>
</html>
