{% block main %}

<!-- Body -->
<div id="body" class="hei-100 pad-h-2 center-content txt-cen">

	<h1 class="mar-t-1 txt-bold txt-upp">Sito Offline</h1>

	<p class="mwid-600 mar-t-1 txt-12rem">
		Il nostro sito è al momento in offline per un aggiornamento. Torneremo attivi non appena possibile.
	</p>
	
</div>

<!-- Login button -->
<form method="POST" id="login" class="place-cenX">

	<button type="submit" name="submit" class="clickable">

		<span class="txt-icon small bgr-c1" <?= icon_svg('key') ?>></span>
		<span class="text br-b-1 br-c1 txt-c1 txt-09rem">Login come amministratore</span>

	</button>

</form>

{% end main %}