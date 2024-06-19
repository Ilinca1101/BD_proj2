<?php
session_start();
if($_SESSION["email"] == "alex.alex@yahoo.com") {
    $idToDelete = $_GET['id'];

    // Încarcă fișierul XML
    $xml = simplexml_load_file('images.xml');
    $indexToDelete = -1;

    // Găsește indexul imaginii de șters
    for ($i = 0; $i < count($xml->image); $i++) {
        if ($xml->image[$i]->id == $idToDelete) {
            $indexToDelete = $i;
            break;
        }
    }

    if ($indexToDelete != -1) {
        // Șterge imaginea de pe server
        $imagePath = (string)$xml->image[$indexToDelete]->path;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Șterge intrarea din fișierul XML
        unset($xml->image[$indexToDelete]);

        // Salvează modificările în fișierul XML
        $xml->asXML('images.xml');
    }

    header('location:login_succes.php#work');
} else {
    header("Location:logout.php");
}
?>
