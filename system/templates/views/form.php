{% extends main %}

{% block main %}

<div id="form-background" class="bgr" <?= $form['bgr'] ?? '' ?>></div>

<form method="POST" enctype="multipart/form-data" id="form-template" class="form-template">

	<div class="head">

		<h1 class="title"><?= $title ?? $view->title ?></h1>

	</div>
	
	<div class="body">

		{% place form-body %}
		{% end form-body %}

	</div>
	
	<div class="footer">

		{% place form-footer %}
		{% end form-footer %}

	</div>

</form>

{% end main %}