<?php
    include "session.php";
    $user = $_SESSION['username'];
    $path = '../';
    $to_images = $path . 'userimages/';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $newfile = $to_images . basename($_FILES['img']['name']);
    $img_path = 'userimages/' . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $newfile)) {
        echo "File successfully uploaded";
    } else {
        echo "Error uploading file";
    }

    $stmt = $db -> prepare("UPDATE users SET img_url = :path
                                      WHERE user_id = :user;");
    $stmt -> execute(['path' => $img_path, 'user' => $user]);
    include $path . "header.php";
?>
<div class="row">
    <div class="large-12 columns">
        <h3>File upload successful</h3>
        <p>Return to <a href="profile.php">your profile</a></p>
    </div>
</div>
