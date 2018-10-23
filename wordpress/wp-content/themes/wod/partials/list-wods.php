<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 20.10.18
 * Time: 16:33
 */

$data = get_query_var( 'data' );
$wods = $data['wods'];
$wod  = new WOD();
?>

<div class="row">
	<?php
	if ( $wods->have_posts() ): while ( $wods->have_posts() ): $wods->the_post(); ?>
		<?php
		$exercises      = rwmb_meta( 'wod_exercises' );
		$exercises_name = [];
		foreach ( $exercises as $exercise ) {
			$exercises_name[] = get_the_title( $exercise );
		}
		$exercises_name = implode( ', ', $exercises_name );
		?>
		<div class="col-3 d-flex mb-5">

			<div class="card flex-grow-1 border-primary">
				<div
					class="card-header bg-primary text-white <?php echo get_post_status() == 'future' ? 'bg-info' : null ?>"><?php the_title(); ?></div>
				<div class="card-body  ">

					<p class="card-text">

						<?= nl2br( rwmb_meta( 'wod_description' ) ) ?>
					</p>
					<?php /*
 TODO: brakuje funkcji dodawania wyniku użytkownika
					<a href="#" class="card-link">
						<?= __('Add score','wod') ?>
					</a>
 */ ?>


					<?php

					$modalities  = rwmb_meta( 'wod_modality' );
					$_modalities = [];
					foreach ( $modalities as $modality_id ) {
						$_modalities[] = ( $wod->modality )[ $modality_id ];
					}
					?>
				</div>

				<ul class="list-group list-group-flush  " data-toggle="tooltip" data-placement="top" title="Modalities">


					<?php foreach ($_modalities as $item):?>
						<a href="#" class="list-group-item  list-group-item-light list-group-item-action"><?= $item ?></a>
					<?php endforeach; ?>
				</ul>
				<div class="card-footer border-top-0" data-toggle="tooltip" data-placement="top" title="Exercises">
					<?php // TODO: linki filtrujące wody po ćwiczeniach ?>
					<div class="  text-muted small"><?= $exercises_name ?></div>

				</div>
			</div>
		</div>

	<?php endwhile;
		wp_reset_postdata(); endif;
	?>

</div>
