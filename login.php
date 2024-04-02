<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
 <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url('images/pex-1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
<!-- home section starts -->
  <section class="home" id="home">

    <div class="content">
      <a class="btn">LogIn Now! </a><br>
      <a class="btn">Welcome,Please Type in your details! </a>
</div>

    
    <?php if ($is_invalid): ?>
        <em style="color:red; font-weight: bold;font-size: 30px;">Incorrect email or password !</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email" style="color:white; font-weight: bold;font-size: 20px;">email</label><br>
        <input type="email" style="width: 250px; height:30px ;" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"><br>
        
        <label for="password" style="color:white; font-weight: bold;font-size: 20px;">Password</label><br>
        <input type="password" style="width: 250px; height:30px ;" name="password" id="password">
        <br>
        <br>
        <button style="font-weight: bold;font-size: 20px; width: 250px; height:30px ; color:maroon; font-weight: bold;">Log in</button>
<div><br>
     <p style="color:red; font-weight: bold;font-size: 20px;">Have no existing account<p><br>
     <button style="width: 250px; height:30px ;"><a href="signup.html" style="color: green; font-weight: bold;font-size: 20px; font-weight: bold;">Sign Up Now</a>
    </button>
    </div>
    </form>
    
</body>
</html>








