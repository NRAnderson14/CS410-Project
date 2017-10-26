<?php
    $path = '../';
    include $path . 'profile/session.php';
    include $path . 'header.php';

    $user = $_GET['user'];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT users.user_id, tenants.fname, tenants.lname, users.img_url, tenants.about_tenant 
                                      FROM users INNER JOIN tenants ON users.user_id = tenants.user_id
                                      WHERE tenants.user_id = :user;');
    $stmt -> execute(['user' => $user]);
    $user_info = $stmt -> fetch();
?>
<main>
<div class="upperBackground"></div>
<div class="row" id="profileHeader">
    <div class="large-12 columns">

        <img src="<?= $path . $user_info['img_url'] ?>" alt="Profile Picture" id="profilePicture">
        <h1 id="userName"><?= $user_info['fname'] . ' ' . $user_info['lname'] ?></h1>
    </div>
</div>

<div class="row">
    <div class="large-12 columns text-center">
        <p><?= $user_info['about_tenant'] ?></p>
    </div>
</div>

<div class="row">
    <div class="large-12 columns text-center">
        <button class="button" id="addbutton" name="<?= $user_info['user_id'] ?>">Add Friend</button>
    </div>
</div>
<div id="burner"></div>
</main>
<script src="../js/addfriend.js" type="text/javascript"></script>


