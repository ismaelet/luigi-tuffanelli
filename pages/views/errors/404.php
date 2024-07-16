{% block main %}

<div id="background" class="bgr" <?= background_image('bgr.jpg') ?>></div>

<div id="body" class="hei-100 center-content txt-cen">

	<h1 id="title" class="txt-upp txt-bold pad-h-1">Errore 404</h1>

	<p id="stitle" class="txt-15rem mar-t-1">Pagina non trovata</p>

	<a href="<?= html_link() ?>" class="go-back sbtn mar-t-2 mar-h-auto txt-1rem txt-upp">Torna alla home</a>

</div>

{% end main %}