<?php

session_start();
if(!isset($_SESSION["email"])) {
    header("location:index.php");
    exit();
}

$msg = "";
if(isset($_POST['upload'])){
    $target = "./images/" . md5(uniqid(time())) . basename($_FILES['image']['name']);
    $text = $_POST['text'];
    
    // Încarcă fișierul XML
    $xml = simplexml_load_file('images.xml');
    
    // Adaugă noua imagine în XML
    $newImage = $xml->addChild('image');
    $newImage->addChild('id', uniqid());
    $newImage->addChild('title', $text);
    $newImage->addChild('path', $target);
    
    // Salvează modificările în fișierul XML
    $xml->asXML('images.xml');
    
    // Mută fișierul încărcat pe server
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        header('location:login_succes.php#work');
        exit();
    } else {
        $msg = "Vai! Vai! Vai!!!";
    }
}

if($msg != "") {
    echo $msg;
}
?>
