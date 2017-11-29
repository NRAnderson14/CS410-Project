<?php
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $type   = $_POST['itemtype'];
    $rating = $_POST['rating'];
    $id     = $_POST['pid'];

    if(!isset($_SESSION)){
        session_start();
    }
    $user   = $_SESSION['username'];
    echo $user;

    if ($type == "property") {
        $rating_insert = $db -> prepare('INSERT INTO property_ratings (property_id, rating_tenant, rating)
                                                   VALUES (:pid, :tenant, :rating);');
        $rating_insert -> execute(['pid' => $id, 'tenant' => $user, 'rating' => $rating]);

    } else if ($type == "landlord") {
        $rating_insert = $db -> prepare('INSERT INTO landlord_ratings (landlord, rating_tenant, rating)
                                                   VALUES ((SELECT landlord FROM properties WHERE property_id = :pid), :tenant, :rating);');  //Will maybe work
        $rating_insert -> execute(['pid' => $id, 'tenant' => $user, 'rating' => $rating]);

    }