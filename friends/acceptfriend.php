<?php
    $path = '../';
    include $path . "profile/session.php";

    $user = $_SESSION['username'];
    $new_friend = $_POST['friend'];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $stmt = $db -> prepare('INSERT INTO friends (user_one, user_two)
                                      VALUES (:user, :new_friend);');
    $stmt -> execute(['user' => $user, 'new_friend' => $new_friend]);

    $stmt2 = $db -> prepare('DELETE FROM friend_requests
                                       WHERE receiving_user = :user AND sending_user = :new_friend;');
    $stmt2 -> execute(['user' => $user, 'new_friend' => $new_friend]);