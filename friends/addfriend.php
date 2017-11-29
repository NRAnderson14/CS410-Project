<?php
    $path = '../';
    include $path . "profile/session.php";

    $user_sending = $_SESSION['username'];
    $user_receiving = $_POST['sentto'];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $stmt = $db -> prepare('INSERT INTO friend_requests (sending_user, receiving_user)
                                      VALUES (:sending, :receiving);');
    $stmt -> execute(['sending' => $user_sending, 'receiving' => $user_receiving]);
	
	$stmt = $db -> prepare('INSERT INTO notifications (recipient, sender, notification, type, viewed)
                                      VALUES (:recipient, :sender, "You have a friend request", "friend_request", "0");');
    $stmt -> execute(['recipient' => $user_receiving, 'sender' => $user_sending]);
	