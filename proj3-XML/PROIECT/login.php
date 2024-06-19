 <body style="background-color:lightgray;">

<?php 
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $pass = $_POST['parola'];

    $xml = simplexml_load_file('users.xml');
    $found = false;

    foreach ($xml->user as $user) {
        if ($user->email == $email && password_verify($pass, $user->parola)) {
            $found = true;
            break;
        }
    }

    if ($found) {
        setcookie('email', $email);
        setcookie('parola', $pass);
        session_start();
        $_SESSION['email'] = $email;
        header('Location: login_succes.php');
    } else {
        echo "<h1> Login failed. Invalid email or password.</h1>";
    }
}
      
?>
<head>
    <link rel="stylesheet" href="assets/css/logincss.css";>
</head>



<div class="form-bg">

    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <div class="form-container">
                    
                        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <h3 class="title">User Login</h3>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                            <input class="form-control" type="email" name="email" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <input class="form-control" type="password" name="parola" placeholder="Password">
                        </div>
                        <span class="forgot-pass"> Remember me:<input type="checkbox" name="rem" value="1"></span>
                        <button class="btn signin" type="submit" >Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 </form>
        
        </body>