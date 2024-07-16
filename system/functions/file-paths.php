<?php

//get url of a file
function file_url($file) {

	global $view;

	if ($file[0] == '/') $urlRaw = $file;
	else $urlRaw = assets_directory($view->url) . $file;

	$url = __HTML_ROOT__ . file_time($urlRaw);

	return $url;

}

//avoid cache if the chached file is not up to date
function file_time($file) {

	if (!strpos($file, '?=') && file_exists($url = __SERVER_ROOT__ . $file)) $file .= '?=' . filemtime($url);
	
	return $file;

}

//put the image as background image
function background_image($img) {

	return 'style="background-image: url(' . file_url($img) . ');"';

}

//put a svg as background image
function img_svg($img) {

	return 'style="mask: url(' . file_url($img) . '); -webkit-mask: url(' . file_url($img) . ') center;"';

}

//get the url of an icon
function icon_url($file) {

	global $view;

	$file = $file . '.svg';

	if ($file[0] == '/') $urlRaw = $file;
	else if (file_exists(__SERVER_ROOT__ . $path = assets_directory($view->url) . $file)) $urlRaw = $path;
	else $urlRaw = __ICONS__ . $file;

	$url = __HTML_ROOT__ . file_time($urlRaw);

	return $url;

}

//put an icon as background image
function icon_css($icon) {

	return 'style="background-image: url(' . icon_url($icon) . ');"';

}

//put a svg icon as background image
function icon_svg($icon) {

	return 'style="mask: url(' . icon_url($icon) . '); -webkit-mask: url('.icon_url($icon) . ') center;"';

}

//embedded icon
function icon_embed($file) {

	$file = $file . '.svg';

	if ($file[0] == '/') $url = $file;
	else $url = __ICONS__ . $file;

	return file_get_contents(__SERVER_ROOT__ . $url);
	
}

//html url
function html_link($url = '') {

	return __HTML_ROOT__ . '/' . $url;

}

//get the url of a page's image folder 
function assets_directory($page_url) {

	$url = substr($page_url, strpos($page_url, 'pages') - 1);

	$url = str_replace(['/views/', '.php'], ['/images/', '/'], $url);

	return $url;

}

//parse a url from php to html
function parse_html($url, $full = true) {

	$url = str_replace("\\", "/", $url);

	if (strpos($url, __SERVER_ROOT__) !== false) $url = $full ? __HTML_ROOT__ . '/' . substr($url, strlen(__SERVER_ROOT__) + 1) : '/' . substr($url, strlen(__SERVER_ROOT__) + 1);
	
	return $url;

}

//get all files in a folder
function scan($path, $ext = '*') {

	$files = [];

	if (strpos($path, __SERVER_ROOT__) === false) $path = __SERVER_ROOT__ . $path;

	foreach (glob($path . '/*.' . $ext) as $file) $files[] = $file;

	return $files;

}

//get all files in the subfolders of a folder
function scans($path, $ext = '*') {

	$files = [];

	foreach (glob(__SERVER_ROOT__ . $path . '/*', GLOB_ONLYDIR) as $dir) array_push($files, ...scan($dir, $ext));

	return $files;

}