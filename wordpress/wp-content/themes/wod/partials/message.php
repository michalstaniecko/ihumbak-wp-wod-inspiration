<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 19.10.18
 * Time: 17:22
 */

$messages = array(
	'exercise_added' => 'exercise added',
	'wod_added' => 'wod added'
)

?>
<?php if (!empty($_GET['status'])):?>
<div class="container-fluid-stop container-fluid">
	<div class="alert alert-success">
		<?php echo $messages[$_GET['status']]; ?>
	</div>
</div>
<?php endif;?>
