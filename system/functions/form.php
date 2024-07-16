<?php

//Add to database
function form_db_add($tbl, $fields) {

	$inputs = [];
	$values = [];
	$names = $pholders = '';

	foreach ($fields as $field)
		foreach ($field as $input) $inputs[] = $input;

	foreach ($inputs as $input) {

		$type = $input['type'] ?? 'text';

		if ($type != 'file') {
			
			if (isset($input['name'])) {

				$name = $input['name'];
				$value = $_POST[$name] ?? 0;

				//parse
				if (isset($input['parse'])) switch ($input['parse']) {

					case 'int': $value = (int) $value; break;

				}
				
				//store values
				$names .= $name . ', ';
				$pholders .= '?, ';
				$values[] = $value;
			}
		}
	}

	$names = rtrim($names, ', ');
	$pholders = rtrim($pholders, ', ');

	$query = $tbl .' (' . $names . ') VALUES (' . $pholders . ')';

	return DB::add($query, $values);

}

//Edit database
function form_db_update($tbl, $fields, $index, $indexVal) {

	$inputs = [];
	$values = [];
	$query = '';

	foreach ($fields as $field)
		foreach ($field as $input) $inputs[] = $input;

	foreach ($inputs as $input) {

		if (isset($input['name'])) {

			$name = $input['name'];
			$value = $_POST[$name] ?? 0;

			//parse
			if (isset($input['parse'])) switch ($input['parse']) {

				case 'int': $value = (int) $value; break;

			}
				
			//store values
			$values[] = $value;
			$query .= $name . '=?, ';

		}

	}

	$query = rtrim($query, ', ');

	$query = $tbl . ' SET ' . $query . ' WHERE ' . $index . '=?';
	$values[] = $indexVal;

	DB::update($query, $values);

}

//Generate form
function generate_form($fields, $data = false, $error = false, $done = false) {

	foreach ($fields as $field) { 

		echo '<div class="form-field">';

		foreach ($field as $input) generate_input($input, $data, $error, $done);

		echo '</div>';
		
	}

}

function generate_input($input, $data, $error, $done) {

	//basic data
	$type = $input['type'] ?? 'text';
	$name = $input['name'] ?? false;

	//calculate value
	$value = false;

	//if value is explicit
	if (isset($input['value'])) $value = $input['value'];

	//else get from POST, if set
	else if ($name && isset($_POST[$name])) $value = $_POST[$name];

	//else get from MySQL result, if set
	else if ($name && isset($data[$name])) $value = $data[$name];

	//else if it's a checkbox
	else if ($type == 'cbx') $value = 1;

	//start to generate
	//label
	switch ($type) {

		case 'lbl': ?>
		
			<p class="form-lbl"><?= $input['text'] ?>:</p>
		
			<?php break;

		case 'info': ?>

				<p class="form-text"><?= $input['text'] ?></p>

			<?php break;

		case 'done':

			if ($type == 'done' && $done) { ?>

				<p class="confirmation"><?= $input['text'] ?></p>

			<?php } break;

		case 'error':

			if ($input['error'] == $error) { ?>

				<p class="error"><?= $input['text'] ?></p>

			<?php } break;

		case 'search':

			input_search($input);

			break;

		case 'file': ?>

			<input
				type="file"
				class="inp file"
				name="<?= $name ?>"
				<?= isset($input['multiple']) ? 'multiple' : '' ?>
				<?= isset($input['required']) ? 'required' : '' ?>
			>

			<?php break;

		case 'select':

			$res = DB::select($input['query']);
			?>

			<select
				class="sel <?= isset($input['affect']) ? 'affect' : '' ?>"
				<?= isset($input['affect']) ? 'data-affect="' . $input['affect'] . '"' : '' ?>
				name="<?= $name ?>"
			>

				<?php if (isset($input['empty'])) { ?>

					<option value="0" selected>-Vuoto-</option>

				<?php } while ($row = $res->fetch_assoc()) { ?>

					<option
						value="<?= $row[$input['field-name']] ?>"

						<?php if ($row[$input['field-name']] == $value) echo 'selected' ?>
					>
						<?= $row[$input['field-show']] ?>
					</option>

				<?php } ?>

			</select>

			<?php break;

		case 'select-dependent': ?>

			<select
				class="sel"
				data-tbl="<?= $input['query-tbl'] ?>"
				data-filter="<?= $input['query-filter'] ?>"
				data-id="<?= $input['field-name'] ?>"
				data-show="<?= $input['field-show'] ?>"
				data-root="<?= __HTML_ROOT__ ?>"
				name="<?= $name ?>"
				disabled
			>
				<option>-</option>
			</select>

			<?php break;

		case 'textarea': ?>

			<textarea
				class="textarea"
				name="<?= $name ?>"
				placeholder="<?= $input['text'] ?? '' ?>"
				<?= isset($input['maxlength']) ? 'maxlength="' . $input['maxlength'] . '"' : '' ?>
			><?=
				$value ?: ''
			?></textarea>

			<?php break;

		case 'cbx': ?>

			<label class="cbx">

				<input
					type="checkbox"
					name="<?= $name ?>"
					value="<?= $value ?>"
					<?= isset($input['checked']) || ($name && isset($_POST[$name])) || ($name && isset($data[$name]) && $data[$name] == $value) ? 'checked' : '' ?>
					<?= isset($input['required']) ? 'required' : '' ?>
				>

				<div class="icon"></div>

				<p><?= $input['text'] ?></p>

			</label>

			<?php break;

		case 'btn': ?>

			<button
				type="submit"
				class="<?= $input['btn-type'] ?? 'pbtn' ?> <?= isset($input['load']) ? 'file-submit' : '' ?>"
				name="<?= $name ?: 'submit' ?>"
			>
				<?= $input['text'] ?? '' ?>
			</button>

			<?php if (isset($input['load'])) { ?>

				<div class="file-load"></div>

			<?php } ?>

			<?php break;

		default: ?>

			<input
				type="<?= $type ?>"
				class="inp <?= isset($input['size']) ? 'inp-size' . $input['size'] : '' ?>"
				name="<?= $name ?>"
				value="<?= $value ?>"
				placeholder="<?= $input['text'] ?? '' ?>"
				<?= isset($input['maxlength']) ? 'maxlength="' . $input['maxlength'] . '"' : '' ?>
				<?= isset($input['min']) ? 'min="' . $input['min'] . '"' : '' ?>
				<?= isset($input['max']) ? 'max="' . $input['max'] . '"' : '' ?>
				<?= isset($input['step']) ? 'step="' . $input['step'] . '"' : '' ?>
				<?= isset($input['required']) ? 'required' : '' ?>
				<?php
					if (isset($input['data']))
						foreach ($input['data'] as $dataName => $dataValue) echo 'data-' . $dataName . '="' . $dataValue . '" '
				?>
			>

			<?php break;

	}

}