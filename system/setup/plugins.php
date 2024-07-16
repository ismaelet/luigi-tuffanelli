<?php

start_plugins();

function start_plugins() {

	foreach (glob(__SERVER_ROOT__.'/app/plugins/*', GLOB_ONLYDIR) as $dir)
		if (file_exists($file = $dir.'/setup.php')) include_once ($file);

}