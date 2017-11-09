<?php
    $path = '../';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $searchterm = $_POST['search'];

    if($searchterm != "") {
        $sterm = "%$searchterm%";
        $stmt = $db->prepare("SELECT fname, lname, username FROM tenants
                                        WHERE fname LIKE :term OR lname LIKE :term
                                        OR username LIKE :term OR CONCAT(fname, ' ', lname) LIKE :term;");
        $stmt->execute(['term' => $sterm]);

        if ($stmt->rowCount() == 0) {
            ?>
            <div class="row">
                <div class="large-12 columns text-center">
                    <h4>No Results for "<?= $searchterm ?>"</h4>
                </div>
            </div>
            <?php
        } else {
            foreach ($stmt as $res) {
                ?>
                <div class="row">
                    <div class="large-4 columns">
                        <p><?= $res['fname'] . ' ' . $res['lname'] ?></p>
                        <p>
                            <a href="<?= $path . 'users/tenantprofile.php?user=' . $res['username'] ?>"><?= $res['fname'] ?>
                                's Profile</a></p>
                    </div>
                </div>
                <?php
            }
        }
    }
?>