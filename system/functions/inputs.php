<?php

function input_search($input) {

	$config = $input['search'];

	?>

	<div
		class="ajax-search"
		data-tbl="<?= $config['tbl'] ?>"
		data-name-id="<?= $config['name-id'] ?? '' ?>"
		data-name-show="<?= $config['name-show'] ?? '' ?>"
		data-filter="<?= $config['filter'] ?? '' ?>"
		data-hroot="<?= __HTML_ROOT__ ?>"
	>
						
		<input type="hidden" class="ajax-search-id" name="<?= $input['name'] ?>" value="<?= $config['value-id'] ?? '' ?>" <?= isset($input['required']) ? 'required' : '' ?>>

		<input type="text" class="inp ajax-search-txt" value="<?= $config['value-show'] ?? '' ?>" placeholder="<?= $input['text'] ?? '' ?>" <?= isset($input['required']) ? 'required' : '' ?> autocomplete="off">

		<div class="ajax-search-ddown">
			<div class="ajax-search-box"></div>
		</div>
		
	</div>

<?php }