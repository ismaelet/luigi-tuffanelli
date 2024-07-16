<!doctype html>
<html data-theme="<?= $_SESSION['theme-color'] ?>" data-theme-fluid="1">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<meta name="description" content="<?= sysData('desc_'.sysData('lang')) ?>">
<meta property="og:image" content="<?= sysData('logo') ?>">
<meta property="og:description" content="<?= sysData('desc_'.sysData('lang')) ?>">

<title><?= $view->page_title ?></title>

<?= $styles ?>

<?= $scripts ?>

<?= $favicon ?>

<?= $google_analytics ?>

<?= $facebook_pixel ?>

</head>

<body>

	{% place body %}

	{% end body %}
	
</body>
</html>