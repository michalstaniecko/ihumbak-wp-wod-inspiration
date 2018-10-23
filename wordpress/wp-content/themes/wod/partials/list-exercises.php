<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 20.10.18
 * Time: 16:22
 */

$data = get_query_var('data');
$exercises = $data['exercises'];
?>

<table>
	<thead>
	<tr>
		<td><?= __( 'Exercise', 'wod' ) ?></td>
		<td><?= __( 'Type', 'wod' ) ?></td>
		<td colspan="2"></td>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($exercises as $exercise): ?>
		<tr>
			<td>
				<?= $exercise['name'] ?>
			</td>
			<td>
				<?php print_r($exercise['type'][0]->name) ?>
			</td>
			<td>edit</td>
			<td>remove</td>
		</tr>

	<?php
	endforeach;
	?>
	</tbody>
</table>
