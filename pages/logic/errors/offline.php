<?php

if (isset($_POST['submit'])) {
	
	if (isset($_SESSION['user'])) logout('login');
	else redirect('/login');

}