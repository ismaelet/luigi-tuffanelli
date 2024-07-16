<?php

//setup Google Analytics
function google_analytics($user) {

	if (sysData('google_analytics') && !$user->admin)
		return file_get_contents(__SERVER_ROOT__.'/vendor/google_analytics/analytics.php');
}

//setup Facebook Pixel
function facebook_pixel() {

	if (sysData('facebook_pixel'))
		return file_get_contents(__SERVER_ROOT__.'/vendor/facebook_pixel/pixel.php');

}