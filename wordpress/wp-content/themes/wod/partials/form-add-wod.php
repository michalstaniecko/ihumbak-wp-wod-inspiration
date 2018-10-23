<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 20.10.18
 * Time: 16:29
 */
$data      = get_query_var( 'data' );
$post_id   = $data['post_id'];
$exercises = $data['exercises'];
$wod       = new WOD();
$forms     = new Forms();
?>
<form action="<?= admin_url( 'admin-post.php' ) ?>" method="POST">
	<input type="hidden" name="action" value="add_wod"/>
	<input type="hidden" name="back-url" value="<?= get_permalink( $post_id ) ?>"/>
	<div class="form-group">
		<label for="wod-name"><?= __( 'Name', 'wod' ) ?></label>
		<input type="text" id="wod-name" name="wod-name" class="form-control" autocomplete="off"/>
	</div>
	<div class="form-row">
		<div class="col-sm-6 d-flex">

			<div class="form-group d-flex flex-column w-100">
				<label for="wod-description"><?= __( 'Description', 'wod' ) ?></label>
				<textarea name="wod-description" id="wod-description" class="form-control flex-grow-1"></textarea>
				<small class="form-text text-muted">Details about Workout</small>
			</div>
		</div>
		<div class="col-sm-6">

			<div class="form-group">

				<label for="wod-exercises[]"><?= __( 'Exercises', 'wod' ) ?></label>
				<?php $forms->select( 'wod-exercises[]', $exercises, true ); ?>
				<small class="form-text text-muted">Select tags for this Workout</small>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class=" col-sm-12 col-md-1-5">
			<div class="form-group">

				<label for="wod-modality[]"><?= __( 'Modality/Load', 'wod' ) ?></label>
				<?php $forms->select( 'wod-modality[]', $wod->get_modality(), true ); ?>
			</div>
		</div>
		<div class=" col-sm-6 col-md-1-5">

			<label for="wod-time"><?= __( 'Time', 'wod' ) ?></label>
			<?php $forms->select( 'wod-time', $wod->get_time() ); ?>
		</div>
		<div class=" col-sm-6 col-md-1-5">

			<label for="wod-repetitions"><?= __( 'Total Repetitions', 'wod' ) ?></label>
			<?php $forms->select( 'wod-repetitions', $wod->get_repetitions() ); ?>
		</div>
		<div class=" col-sm-6 col-md-1-5">

			<label for="wod-repetitions"><?= __( 'Scheme', 'wod' ) ?></label>
			<?php $forms->select( 'wod-scheme', $wod->get_scheme() ); ?>
		</div>
		<div class=" col-sm-6 col-md-1-5">

			<label for="wod-priority"><?= __( 'Priority', 'wod' ) ?></label>
			<?php $forms->select( 'wod-priority', $wod->get_priority() ); ?>
		</div>
	</div>
	<button type="submit" class="btn btn-primary"><?= __( 'Save', 'wod' ) ?></button>
</form>
