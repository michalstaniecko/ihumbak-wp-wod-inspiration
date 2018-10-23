<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 23.10.18
 * Time: 23:29
 */
?>
<div class="row">
	<div class="col-md-4 mx-auto">

		<form name="loginform" id="loginform" action="http://wod.local/wp-login.php" method="post">

			<div class="form-group">
				<label for="user_login">Username or Email Address</label>
				<input type="text" name="log" id="user_login" class="form-control" value="" size="20">
			</div>
			<div class="form-group">
				<label for="user_pass">Password</label>
				<input type="password" name="pwd" id="user_pass" class="form-control" value="" size="20">
			</div>

			<div class="form-group"><label><input name="rememberme" type="checkbox" class="" id="rememberme" value="forever"> Remember Me</label></div>
			<p class="login-submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Log In">
				<input type="hidden" name="redirect_to" value="<?= get_permalink() ?>">
			</p>

		</form>
	</div>
</div>
