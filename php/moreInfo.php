<?php 
    ob_start();
    session_start(); 
    $errormessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = "mysql:host=localhost;dbname=wutia_Assignment";
    $username = 'wutia_001';
    $password = 'Wty2957360';
    $pdo = new PDO($dsn, $username, $password);

    $Frequency = $_POST['frequency'];
    $Duration = $_POST['duration'];
    $LastTime = $_POST['lastTime'];
    $Mail = $_SESSION["Username"];
    $Color = $_POST["colorOfBlood"];
    $Texture = $_POST["textureOfBlood"];
    $Type = $_POST["typeOfBlood"];
    $Abnormal = $_POST["abnormalOfBlood"];
    $UserId = '';

    $stmt = $pdo->prepare("SELECT `Id` FROM `usertable` WHERE `Email` = '$Mail';");
    $stmt->execute();
    if($stmt != null){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $UserId = $row['Id'];
          $_SESSION["UserId"] = $UserId;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO `ladytable` VALUES ('','$UserId','$Frequency','$Duration','$LastTime');");
    $stmt->execute();
    $stmt = $pdo->prepare("SELECT `Id` FROM `ladytable` WHERE `UserId` = '$UserId' ORDER BY `Id` DESC LIMIT 1;");
    $stmt->execute();
    if($stmt != null){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $MounthId = $row['Id'];
    }
    $stmt = $pdo->prepare("INSERT INTO `bloodtable` VALUES ('','$UserId','$MounthId','$Color','$Texture','$Type','$Abnormal');");
    $stmt->execute();
      if($stmt != null){
          echo "<script> location.href='Calendar.php'; </script>";
      }else{
        $errormessage = "Sorry, we have some issue in our database.";
      }
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
        <a href="#">
          Signin
        </a>
      </div>
    </ul>
  </nav>
</div>
<div class="middleContainer">
  <div class="titleLogin textLogin">
    Just Need a Bit More Info
  </div>
  <!--<div class="wordLogin textLogin">
    Far far away, behind the word mountains, far from
  </div>-->
  <!--<div class="roundRecbtnContainer">
    <div class="roundRecbtn">
      <a href="#"><img src="../images/004-facebook-1.svg" alt=""/><span>Sign up with Facebook</span></a>
    </div>
  </div>
  <div class="roundRecbtnContainer">
    <div class="whiteLine"></div>
    <div class="">or register using form</div>
    <div class="whiteLine"></div>
  </div>-->
  <div class="roundRecbtnContainer">
  <!--form begin-->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
     <div id="form1">
       <div class="inputForm formContainer">
        <div class="infoAndInput">
          <!--<input name="email" type="text" class="feedback-input" id="email" placeholder="Frequency" />-->
          <select name="frequency" id="frequency" class="">
              <option value="hide">--- Frequency ---</option>
              <option value="21">21-23 days</option>
              <option value="23">24-26 days</option>
              <option value="27">27-29 days</option>
              <option value="30">30-32 days</option>
              <option value="31">32+ days</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
        </div>
        <div class="infoAndInput">
          <select name="duration" id="duration" class="">
              <option value="hide">--- Duration ---</option>
              <option value="1">1-2 days</option>
              <option value="2">2-4 days</option>
              <option value="3">3-6 days</option>
              <option value="5">5-9 days</option>
              <option value="10">10+ days</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
         </div>
       </div>
       <div class="inputForm formContainer">
        <div  class="infoAndInput infoAndInput2" style="position:relative;">
         <input name="lastTime" type="text" id="lastTime" class="feedback-input lastTime" placeholder="MM-DD-YYYY" value=""/>
         <label for="lastTime" class="fixedLabel">Last Time: </label>
         <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
         </p>
         </div>
       </div>
        <div class="inputForm formContainer" style="margin-top:1em;">
        <div class="infoAndInput">
          <!--<input name="email" type="text" class="feedback-input" id="email" placeholder="Frequency" />-->
          <select name="colorOfBlood" id="colorOfBlood" class="">
              <option value="Clear">Clear</option>
              <option value="Bright red blood">Bright red blood</option>
              <option value="Dark brown blood">Dark brown blood</option>
              <option value="Orange,yellow or green">Orange,yellow or green</option>
              <option value="Pnik or grey">Pnik or grey</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
        </div>
        <div class="infoAndInput">
          <select name="textureOfBlood" id="textureOfBlood" class="">
              <option value="Normal">Normal</option>
              <option value="Thin">Thin</option>
              <option value="Lumpy">Lumpy</option>
              <option value="Slimy">Slimy</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
         </div>
       </div>
       <div class="inputForm formContainer" style="margin-top:1em;">
        <div class="infoAndInput">
          <!--<input name="email" type="text" class="feedback-input" id="email" placeholder="Frequency" />-->
          <select name="typeOfBlood" id="typeOfBlood" class="">
              <option value="Normal">Normal</option>
              <option value="Heavy">Heavy</option>
              <option value="Painful">Painful</option>
              <option value="Irregular">Irregular</option>
              <option value="Missed">Missed</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
        </div>
        <div class="infoAndInput">
          <select name="abnormalOfBlood" id="abnormalOfBlood" class="">
              <option value="Normal">Normal</option>
              <option value="Fibroids">Fibroids</option>
              <option value="Miscarriage">Miscarriage</option>
              <option value="PMS">PMS</option>
              <option value="Endometriosis">Endometriosis</option>
              <option value="PCOS">PCOS</option>
              <option value="Menopause">Menopause</option>
              <option value="Medication">Medication</option>
              <option value="Others">Others</option>
          </select>
          <p class="infoAndInputErr displaynoneinfo">
            <!--Please enter a valid email address. <br/>e.g. fella@example.com-->
          </p>
         </div>
       </div>
       <p class="inputForm">
       <input name="Done" type="submit" class="feedback-input submitBtn" id="submit" value="Done"/>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/nav.js"></script>

</body>
</html>
