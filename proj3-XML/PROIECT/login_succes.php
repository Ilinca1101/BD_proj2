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
    <style>
        .image-container {
            margin-bottom: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
        }
        .image-container .buttons {
            margin-top: 5px;
        }
        .image-container .buttons a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .image-container .buttons a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="is-preload">
    <div id="wrapper">
        <header id="header">
            <div class="logo">
                <span class="icon fa-gem"></span>
            </div>
            <div class="content">
                <div class="inner">
                    <h1 style="color:white">BINE AI VENIT, <?= $_SESSION["email"] ?>.</h1>
                    <p style="color: white">WHAT MAKES ME HAPPY?</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="#intro">Music</a></li>
                    <li><a href="#work">Traveling</a></li>
                    <li><a href="#about">Little Stuff</a></li>
                    <li><a href="#contact">Family</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div id="main">
            <article id="intro">
                <h2 style="color: white" class="major">Music</h2>
                <p>Without music, life would be a mistake.</p>
                <canvas id="myCanvas" width="280" height="80" style="border:1px solid #d3d3d3;"></canvas>
                <script>
                    var c = document.getElementById("myCanvas");
                    var ctx = c.getContext("2d");
                    ctx.font = "30px Arial";
                    ctx.strokeText("Friedrich Nietzsche",10,50);
                </script>
                <iframe width="420" height="315" src="https://www.youtube.com/embed/4oXgCJf4hf8"></iframe>
                <i onclick="myFunction(this)" class="fa fa-thumbs-up" style="color:white; height: 100px; width:100px"></i>
                <a href="#"><img src="share.png" width="30px" height="30px"></a>
            </article>

            <article id="work">
                <h2 style="color: white" class="major">Traveling <?= $_SESSION["email"] ?></h2>
                <p>Wherever you go becomes a part of you somehow. - Anita Desai</p>
                <?php
$xml = simplexml_load_file('images.xml');
foreach ($xml->image as $image) {
    echo '<div class="image-container">';
    echo '<img src="' . htmlspecialchars($image->path) . '" alt="' . htmlspecialchars($image->title) . '" style="max-width: 200px;">';
    echo '<p>' . htmlspecialchars($image->title) . '</p>';
    if ($_SESSION['email'] == 'alex.alex@yahoo.com') {
        echo '<div class="buttons">';
        echo '<a href="edit.php?id=' . htmlspecialchars($image->id) . '">Edit</a>';
        echo '<a href="delete.php?id=' . htmlspecialchars($image->id) . '">Delete</a>';
        echo '</div>';
    }
    echo '</div>';
}
?>


                <form method="post" action="save.php" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <input type="file" name="image">
                    <textarea style="color:white" name="text" cols="40" rows="4" placeholder="write something about your photo"></textarea>
                    <input type="submit" name="upload" value="Upload Image">
                </form>

                <form method="post" action="login_succes.php#work">
                    <input style="color:white" type="text" name="search">
                    <input type="submit" name="sub1" value="Search">
                </form>
                <?php 
                if(isset($_POST['sub1'])){
                    $searchTerm = $_POST['search'];
                    foreach ($xml->image as $image) {
                        if ($image->title == $searchTerm) {
                            echo "<img style='width:500px; height:500px' class='image main' src='".$image->path."' alt='".$image->title."'/><br>";
                        }
                    }
                }
                ?>
            </article>

            <article id="about">
                <h2 style="color: white" class="major">Stuff like this</h2>
                <?php
                // Exemplu de utilizare a XML pentru detalii utilizator
                $userXml = simplexml_load_file('users.xml');
                $userDetails = null;
                foreach ($userXml->user as $user) {
                    if ($user->id == 1) {
                        $userDetails = $user;
                        break;
                    }
                }

                class Info {
                    protected $mancare;
                    protected $culoare;

                    public function setMancare($var) {
                        $this->mancare = $var;
                    }

                    public function setCuloare($var) {
                        $this->culoare = $var;
                    }

                    public function showMancare() {
                        echo $this->mancare;
                    }

                    public function showCuloare() {
                        echo $this->culoare;
                    }
                }

                class Info2 extends Info {
                    protected $hobby;
                    protected $familie;

                    public function setHobby($var) {
                        $this->hobby = $var;
                    }

                    public function setFamilie($var) {
                        $this->familie = $var;
                    }

                    public function showHobby() {
                        echo $this->hobby;
                    }

                    public function showFamilie() {
                        echo $this->familie;
                    }
                }

                if ($userDetails) {
                    $inf = new Info();
                    $inf1 = new Info2();
                    $inf->setCuloare($userDetails->culoare);
                    $inf->setMancare($userDetails->mancare);
                    $inf1->setHobby($userDetails->hobby);
                    $inf1->setFamilie($userDetails->familie);

                    echo "<svg width='300' height='200'><polygon points='100,10 40,198 190,78 10,78 160,198' style='fill:lime;stroke:purple;stroke-width:5;fill-rule:evenodd;' /></svg><br>";
                    echo "<label style='color:white'>" . $inf->showCuloare() . "</label><br>";
                    echo "<label style='color:white'>" . $inf1->showHobby() . "</label><br>";
                    echo "<label style='color:white'>" . $inf->showMancare() . "</label><br>";
                    echo "<label style='color:white'>" . $inf1->showFamilie() . "</label><br>";
                }
                ?>
                <video width="320" height="240" controls>
                    <source src="v1.mp4" type="video/mp4"> 
                </video>
            </article>

            <article id="contact">
                <h2 style="color: white" class="major">Family</h2>
                <p>You don't choose your family. This is a gift from God to you, just as you are one to it. - Desmond Tutu</p>
                <audio controls autoplay>
                    <source src="audiov.mp3" type="audio/mpeg">
                </audio>
            </article>
        </div>

        <footer id="footer">
            <p>...</p>
        </footer>
    </div>

    <div id="bg"></div>
  
    <style>
        p {
            color: white;
        }
        .edits {
            color: white;
            text-decoration: none;
        }
        .edits:hover {
            letter-spacing: 3px;
            color: aqua;
        }
    </style>
    <script>
        function myFunction(x) {
            x.classList.toggle("fa-thumbs-down");
        }
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        function anti_right() {
            alert('You cannot right-click!');
            return false;
        }
        document.oncontextmenu = anti_right;
    </script>
</body>
</html>
