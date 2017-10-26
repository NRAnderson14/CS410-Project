<?php
    $path = '../';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $searchterm = $_POST['search'];

    $sterm = "%$searchterm%";
    $stmt = $db -> prepare("SELECT fname, lname, user_id FROM tenants
                                      WHERE fname LIKE :term OR lname LIKE :term
                                      OR user_id LIKE :term;");
    $stmt -> execute(['term' => $sterm]);

    foreach($stmt as $res) {
?>
<div class="row">
    <div class="large-4 columns">
        <p><?= $res['fname'] . ' ' . $res['lname'] ?></p>
        <p><a href="<?= $path . 'users/tenantprofile.php?user=' . $res['user_id'] ?>"><?= $res['fname'] ?>'s Profile</a></p>
    </div>
</div>
<?php
    }
?>