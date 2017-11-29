<?php	
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$username="";
	if(isset($_POST['username'])){
		$username = $_POST['username'];
	};
	$count = 0;
	$count2 = 0;
	$posts = $db -> prepare("SELECT username FROM news WHERE username = :username;");
	$posts -> execute(['username' => $username]);
	foreach($posts as $post){
		$count2++;
	}
	$friends = $db -> prepare('(SELECT tenants.fname, tenants.lname, tenants.username
                                                        FROM friends INNER JOIN tenants ON friends.user_two = tenants.username
                                                        WHERE friends.user_one = :username) UNION
                                                        (SELECT tenants.fname, tenants.lname, tenants.username
                                                        FROM friends INNER JOIN tenants ON friends.user_one = tenants.username
                                                        WHERE friends.user_two = :username);');
                    $friends -> execute(['username' => $username]);
                    foreach($friends as $friend) {
						$count++;	
						
						?>

						<?php
					}
					if($count > 0){
						//friends and posts
						$news = $db -> prepare('select distinct news.* from news join friends on news.username = friends.user_one or news.username = friends.user_two where news.username = :username or friends.user_one = :username or friends.user_two = :username ORDER BY event_time DESC LIMIT 100;');
						$news -> execute(['username' => $username]);
						foreach($news as $new){
							$u = $new['username'];
							$news_text = $new['news_text'];
							$event_time = $new['event_time'];
							$picture = $db -> query("SELECT profile_img_url FROM tenants WHERE username = '$u'");
							foreach($picture as $pic){
								$user_image_pic = $pic['profile_img_url'];
								?>
								<div id="" style="background: white; margin-left: 20px; margin-right: 20px; border-radius: 5px; box">
									
									<?php
										if($u == $username){
									?>
									<p><a href=""><img src="../<?=$user_image_pic?>" height="50px;" width="50px;"></a>
									<span style="margin-left: 50px;"><a href=""><?=$u?></a></span></p>
									<?php
										}else{
									?>
									<p><a href="../users/tenantprofile.php?user=<?=$u?>"><img src="../<?=$user_image_pic?>" height="50px;" width="50px;"></a>
									<span style="margin-left: 50px;"><a href="../users/tenantprofile.php?user=<?=$u?>"><?=$u?></a></span></p>
									<?php
										}
									?>
									<hr style="margin-top: -10px;">
									<p style=" padding-left: 80px; padding-right: 80px;padding-top: -20px; word-wrap: break-word;"><?=$news_text?></p>
									<br style="padding-bottom: 30px;">
								</div>
								<br>
							<?php
							}
							
						}
					}
					else if($count == 0 && $count2 == 0){
						//no friends, no posts
						?>
						
						<div id="" style="background: white; margin-left: 20px; margin-right: 20px; border-radius: 5px; box">
						<!--
						No posts
						-->
						</div>
						<?php
					}else if($count == 0 && $count2 > 0){
						$no_friends = $db->query("SELECT * FROM news WHERE username = '$username'");
						foreach($no_friends as $p){
							$u = $p['username'];
							$news_text = $p['news_text'];
							$event_time = $p['event_time'];
							$picture = $db -> query("SELECT profile_img_url FROM tenants WHERE username = '$u'");
							foreach($picture as $pic){
								$user_image_pic = $pic['profile_img_url'];
								?>
								<div id="" style="background: white; margin-left: 20px; margin-right: 20px; border-radius: 5px; box">
									
									<?php
										if($u == $username){
									?>
									<p><a href=""><img src="../<?=$user_image_pic?>" height="50px;" width="50px;"></a>
									<span style="margin-left: 50px;"><a href=""><?=$u?></a></span></p>
									<?php
										}else{
									?>
									<p><a href="../users/tenantprofile.php?user=<?=$u?>"><img src="../<?=$user_image_pic?>" height="50px;" width="50px;"></a>
									<span style="margin-left: 50px;"><a href="../users/tenantprofile.php?user=<?=$u?>"><?=$u?></a></span></p>
									<?php
										}
									?>
									<hr style="margin-top: -10px;">
									<p style=" padding-left: 80px; padding-right: 80px;padding-top: -20px; word-wrap: break-word;"><?=$news_text?></p>
									<br style="padding-bottom: 30px;">
								</div>
								<br>
							<?php
							}
						}
						//no friends, you have posts
						
					}	
	//$count = $stmt -> fetchAll();
	//$counter = $count -> rowCount();
	//$stmt = $db -> query('SELECT news.username, news.news_text, news.event_time, users.fname, users.lname FROM users, news WHERE news.username='$username';');
	$date = date('Y-m-d H:i:s');
?>
	