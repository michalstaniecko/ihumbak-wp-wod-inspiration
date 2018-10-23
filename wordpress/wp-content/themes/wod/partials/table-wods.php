<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 21.10.18
 * Time: 17:28
 */

$wod       = new WOD();
$exercises = new Exercise();

$wod_details = $wod->get_wods_details();

//print_r($exercises->get_exercise('metabolic'));

?>
<div class="wod-table">

	<div class="row no-gutters">
		<div class="col wod-table-column-heading">
			<div class="border-bottom">Workout Descriptor</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left wod-table-heading">
					Modality
				</div>
				<div class="wod-table-heading-right wod-table-heading ">
					<?php foreach ( $wod->get_modality() as $value ): ?>
						<div class="wod-table-item"><?= $value ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">
					Time
				</div>
				<div class="wod-table-heading-right wod-table-heading  ">

					<?php foreach ( $wod->get_time() as $value ): ?>
						<div class="wod-table-item"><?= $value ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">
					Total Repetitions
				</div>
				<div class="wod-table-heading-right wod-table-heading  ">

					<?php foreach ( $wod->get_repetitions() as $value ): ?>
						<div class="wod-table-item"><?= $value ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">
					Scheme
				</div>
				<div class="wod-table-heading-right wod-table-heading  ">

					<?php foreach ( $wod->get_scheme() as $value ): ?>
						<div class="wod-table-item"><?= $value ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">
					Priority
				</div>
				<div class="wod-table-heading-right wod-table-heading  ">

					<?php foreach ( $wod->get_priority() as $value ): ?>
						<div class="wod-table-item"><?= $value ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row  js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">

					Movements - <br/>
					Gymnastics
				</div>
				<div class="wod-table-heading-right wod-table-heading ">
					<?php foreach ( $exercises->get_exercise( 'gymnastic' ) as $exercise ): ?>
						<div class="wod-table-item"><?= $exercise['name'] ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row  js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">

					Movements - <br/>
					Weightlifint
				</div>
				<div class="wod-table-heading-right wod-table-heading ">
					<?php foreach ( $exercises->get_exercise( 'weightlifting' ) as $exercise ): ?>
						<div class="wod-table-item"><?= $exercise['name'] ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row js-wod-table-hightlight">
				<div class="wod-table-heading-left  wod-table-heading">

					Movements - <br/>
					Metabolic
				</div>
				<div class="wod-table-heading-right wod-table-heading  ">
					<?php foreach ( $exercises->get_exercise( 'metabolic' ) as $exercise ): ?>
						<div class="wod-table-item"><?= $exercise['name'] ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="row no-gutters text-center">
				<?= $wod_details ?>
			</div>
		</div>
	</div>
</div>
