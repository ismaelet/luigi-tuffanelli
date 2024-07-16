{% block form-body %}

<input type="hidden" name="url" value="<?= $_GET['url'] ?? '' ?>">

<div class="load ld-lef">
	<input type="text" name="username" id="username" class="inp" placeholder="Username" required>
</div>

<div class="load ld-rig">
	<input type="password" name="password" id="password" class="inp" placeholder="Password" required>
</div>

<?php if ($error) { ?>
	<p class="error">Dati di accesso errati</p>
<?php } ?>

<div id="options-bar" class="flex va-cen">

	<label class="cbx load ld-rig">

		<input type="checkbox" name="remember" checked>

		<div class="icon"></div>

		<p>Resta connesso</p>

	</label>

	<a href="<?= html_link('login/recover') ?>" class="load ld-lef">
		<p class="txt-c1-h txt-rig">Hai dimenticato la password?</p>
	</a>

</div>

{% end form-body %}

{% block form-footer %}

<div class="load ld-rig">
	<button type="submit" name="submit" id="submit" class="pbtn">Log In</button>
</div>

{% end form-footer %}