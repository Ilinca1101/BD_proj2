<?php
if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    exit();
}

// Încarcă fișierul XML
$xml = simplexml_load_file('users.xml');
$user = null;

// Găsește utilizatorul pe baza ID-ului
foreach ($xml->user as $u) {
    if ($u->id == $_GET['id']) {
        $user = $u;
        break;
    }
}

if ($user == null) {
    echo "User not found.";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile: <?php echo $user->nume; ?></h2>
    <p>ID: <?php echo $user->id; ?></p>
    <p>Email: <?php echo $user->email; ?></p>
</body>
</html>
