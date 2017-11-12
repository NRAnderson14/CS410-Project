<?php
    $path = '../';
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $searchterm = $_POST['search'];

    if($searchterm != "") {
        $sterm = "%$searchterm%";
        $stmt = $db->prepare("SELECT IFNULL(company_name, fname) AS name1, IFNULL(lname, 1) AS name2, website
                                        FROM landlords
                                        WHERE fname LIKE :term OR lname LIKE :term
                                        OR company_name LIKE :term OR CONCAT(fname, ' ', lname) LIKE :term;");
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
            print '<div class="row align-left">';
            $i = 1;
            foreach ($stmt as $res) {
                if ($res['name2'] == 1) { //They have a company name
                    $landlord = $res['name1'];
                } else {    //First and last name
                    $landlord = $res['name1'] . ' ' . $res['name2'];
                }
                ?>
                <div class="large-4 columns text-center card">
                    <p><?= $landlord ?></p>
                    <p><a href="http://<?= $res['website'] ?>"><?= $res['website'] ?></a></p>
                </div>
                <?php
                if($i % 3 == 0) {
                    print '</div>';
                    print '<div class="row align-left">';
                }
                $i++;
            }
            print '</div>';
        }
    }
?>