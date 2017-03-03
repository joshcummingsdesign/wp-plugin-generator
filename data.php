<?php

require_once 'functions.php';

// POST variables
$name    = $_POST['name'];
$slug    = $_POST['slug'];
$option  = $_POST['option'];
$domain  = $_POST['domain'];
$version = $_POST['version'];
$url     = $_POST['url'];

// File locations
$src = 'wp-plugin-starter';
$dst = 'tmp/' . $slug;

// Copy the source files
recurse_copy($src, $dst);

// Rename the main plugin directory
rename($dst . '/' . 'plugin-name', $dst . '/' . $slug);

//
