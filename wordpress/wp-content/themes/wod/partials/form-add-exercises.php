<?php $data = get_query_var('data'); ?>
<?php $post_id = $data['post_id']; ?>
<form action="<?= admin_url( 'admin-post.php' ) ?>" method="POST" class="exercise-form">
	<input type="hidden" name="action" value="add_exercise"/>
	<input type="hidden" name="back-url" value="<?= get_permalink($post_id) ?>"/>
	<div class="form-row exercise-form__row">
		<div class="col">
			<div class="form-row">

				<div class="col-sm-6">

					<div class="form-group">

						<input type="text" name="exercise-name[]" class="form-control" autocomplete="off"/>
					</div>
				</div>
				<div class="col-sm-6">

					<div class="form-group">

						<select name="exercise-type[]" class="form-control">
							<option value="gymnastic"><?= __( 'Gymnastic', 'wod' ) ?></option>
							<option value="metabolic"><?= __( 'Metabolic', 'wod' ) ?></option>
							<option value="weightlifting"><?= __( 'Weightlifting', 'wod' ) ?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-auto">
			<div class="exercise-form__add-row js-exercise-form__add-row"><?= __( 'Add row', 'wod' ) ?></div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary"><?= __( 'Save', 'wod' ) ?></button>
</form>
