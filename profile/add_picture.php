<?php
    include "session.php";
    $user = $_SESSION['username'];
    $path = '../';
    $to_images = $path . 'userimages/';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $newfile = $to_images . basename($_FILES['img']['name']);
    $img_path = 'userimages/' . basename($_FILES['img']['name']);

    if (!is_dir($path . 'userimages/')) {
        mkdir($path . 'userimages/');
    }

    move_uploaded_file($_FILES['img']['tmp_name'], $newfile);  #TODO: Make this secure

    $stmt = $db -> prepare("UPDATE tenants SET profile_img_url = :path
                                      WHERE username = :user;");
    $stmt -> execute(['path' => $img_path, 'user' => $user]);
    include $path . "header.php";
?>
<div class="row">
    <div class="large-12 columns">
        <h3>File upload successful</h3>
        <p>Return to <a href="profile.php">your profile</a></p>
    </div>
</div>
