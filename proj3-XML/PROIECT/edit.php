<!DOCTYPE HTML>
<?php 
session_start();
if(!isset($_SESSION["email"])){
    header("location:index.php");
    exit();
}
?>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/registercss.css">
</head>
<body>
    <article>
        <center>
            <h2 style="color: white" class="major">Traveling <?php echo $_SESSION["email"] ?></h2>
            <?php
            // Încarcă fișierul XML
            $xml = simplexml_load_file('images.xml');
            $record = null;

            // Găsește imaginea pe care să o editezi
            if (!isset($_POST["submit"])) {
                foreach ($xml->image as $image) {
                    if ($image->id == $_GET['id']) {
                        $record = $image;
                        break;
                    }
                }
            } else {
                foreach ($xml->image as $image) {
                    if ($image->id == $_POST['id']) {
                        $record = $image;
                        break;
                    }
                }

                if ($record != null) {
                    $title = $_POST['title'];
                    $target = $record->path;

                    if ($_FILES['image']['name']) {
                        $target = "./images/" . basename($_FILES['image']['name']);
                    }

                    // Actualizează datele în XML
                    $record->title = $title;
                    $record->path = $target;

                    // Salvează modificările în fișierul XML
                    $xml->asXML('images.xml');

                    // Mută fișierul încărcat, dacă este cazul
                    if ($_FILES['image']['name']) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $target);
                    }

                    header('location:login_succes.php#work');
                    exit();
                }
            }
            ?>
            <h1>Editati inregistrarea:</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    Titlu:<br/>
    <input type="text" name="title" value="<?php echo (string)$record->title; ?>"/><br/>
    Imagine: <br/>
    <input type="file" name="image"/><br/>
    <img src="<?php echo (string)$record->path; ?>" style="max-width: 200px;"><br/>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
    <input type="submit" name="submit" value="Edit"/>
</form>

        </center>
    </article>
</body>
</html>
