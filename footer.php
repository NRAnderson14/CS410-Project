		<footer class="footer" style="margin-top: 100px; padding-top: 40px;">
			<div class="small-up-1 medium-up-3 align-center">
				<div class="column foot">
				<h4 class="footer-header">Contact Info</h4>
				<a href=""><p>Email</p></a>
				<a href=""><p>Phone</p></a>
				<a href=""><p>Support</p></a>
				</div>
				<div class="column mid foot">
				<h4 id="footer-two" class="footer-header">Other</h4>
				<a href=""><p>Privacy Policy</p></a>
				<p>Winona, MN</p>
				<p>2017 Rent Smart</p>
				</div>
				<div class="column foot">
				<h4 class="footer-header">Social Media</h4>
				<a href=""><p>Facebook <i class="fa fa-facebook" aria-hidden="true"></i></p></a>
				<a href=""><p>Twitter <i class="fa fa-twitter" aria-hidden="true"></i></p></a>
				<a href=""><p>Instagram <i class="fa fa-instagram" aria-hidden="true"></i></p></a>
				</div>
			</div>
		</footer>
		</div>

	</div>
</div>
	<script>
	$(document).foundation();
	</script>
	<script src=<?php print($path . "js/notification.js") ?> ></script>
        <?php
//            if (isset($user_has_rated))
            if (isset($_SESSION['username'])) {
                print '<script src="<?= $path ?>js/rate_property.js"></script>';
            }
            $currpath = $_SERVER['REQUEST_URI'];

            $currpage = substr($currpath, strrpos($currpath, '/')+1, strlen($currpath)-strrpos($currpath, '.php')+3);
            //if user is a landlord, we are on a property page, and they own the property,
            //  enable editing the page
            if(isset($user_owns_property)) {
                if($user_owns_property) {
                    print "<script src=\"{$path}js/update_property.js\"></script>";
                }
            }
        ?>
</html>
