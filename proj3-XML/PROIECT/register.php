<!doctype html>

<?php
// Captcha
$nr1 = rand(1, 9);
$nr2 = rand(1, 9);
$sum = $nr1 + $nr2;

if (isset($_POST['submit'])) {
    $xml = simplexml_load_file('users.xml');
    $sum1 = $_POST['cap1'];
    $sum2 = $_POST['sc'];
    $emailExists = false;

    // Verifică dacă emailul există deja
    foreach ($xml->user as $user) {
        if ($user->email == $_POST['email']) {
            $emailExists = true;
            break;
        }
    }

    if ($emailExists) {
        echo " Email deja existent!";
    } elseif ($sum1 == $sum2) {
        $pass1 = $_POST['parola'];
        $pass2 = $_POST['parola1'];
        if ($pass1 == $pass2) {
            $newUser = $xml->addChild('user');
            $newUser->addChild('id', uniqid());
            $newUser->addChild('nume', $_POST['nume']);
            $newUser->addChild('parola', password_hash($pass1, PASSWORD_DEFAULT));
            $newUser->addChild('email', $_POST['email']);
            $xml->asXML('users.xml');
            echo "Inregistrarea a fost adaugata cu succes!";
        } else {
            echo "<h1 style='z-index:1000; color:white;'> Parolele nu coincid sau suma este introdusa gresit!</h1>";
        }
    }
}
?>

<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/registercss.css">
</head>
<body>
    <video width="320" height="240" style="position:absolute; top:0; left: 0; object-fit: cover; width: 100%; height: 100%; pointer-events:none;" autoplay loop muted>
        <source src="video1.mp4" type="video/mp4">
    </video>

    <div class="col-md-4 col-md-offset-4" id="login">
        <section id="inner-wrapper" class="login" style="border-radius: 15px; background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3));">
            <article>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group text-centered">
                        <p>SIGN UP</p>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="nume" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="parola" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="parola1" class="form-control" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span style="color:white" class="input-group-addon"><?php echo "" . $nr1 . "+ " . $nr2 . "="; ?> <input type="text" name="cap1" required></span>
                            <input type="hidden" name="sc" value="<?php echo $sum ?>">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Submit">
                </form>
            </article>
        </section>
    </div>
</body>
</html>
