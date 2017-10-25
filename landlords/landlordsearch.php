<?php
    $path = '../';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $searchterm = $_POST['search'];

    $sterm = "%$searchterm%";
    $stmt = $db -> prepare("SELECT fname, lname, website FROM landlords
                                      WHERE fname LIKE :term OR lname LIKE :term
                                      OR company_name LIKE :term;");
    $stmt -> execute(['term' => $sterm]);

    foreach($stmt as $res) {
?>
<div class="row">
    <div class="large-4 columns">
        <p><?= $res['fname'] . ' ' . $res['lname'] ?></p>
        <p><a href="http://<?= $res['website'] ?>"><?= $res['website'] ?></a></p>
    </div>
</div>
<?php
    }
?>