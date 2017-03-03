<?php

namespace WPSG;

require_once 'class-generator.php';

$generator = new Generator();

// POST variables
$name      = $_POST['name'];
$slug      = $_POST['slug'];
$option    = $_POST['option'];
$namespace = $_POST['namespace'];
$version   = $_POST['version'];
$url       = $_POST['url'];

// Make a temp directory
$rand = mt_rand(100000, 999999);
$temp = 'tmp/' . $rand;
mkdir($temp);

// Set file locations
$src  = 'wp-plugin-starter';
$dst  = $temp . '/' . $slug;
$pdst = $dst . '/' . $slug;

// Copy the source files
$generator::recursive_copy($src, $dst);

// Batch rename files
$arr = [
    $dst . '/' . $generator->slug => $dst . '/' . $slug,
    $pdst . '/' . $generator->slug . '.php' => $pdst . '/' . $slug . '.php',
    $pdst . '/frontend/js/' . $generator->slug . '-frontend.js' => $pdst . '/frontend/js/' . $slug . '-frontend.js',
    $pdst . '/frontend/css/' . $generator->slug . '-frontend.css' => $pdst . '/frontend/css/' . $slug . '-frontend.css',
    $pdst . '/admin/js/' . $generator->slug . '-admin.js' => $pdst . '/admin/js/' . $slug . '-admin.js',
    $pdst . '/admin/css/' . $generator->slug . '-admin.css' => $pdst . '/admin/css/' . $slug . '-admin.css',
];
$generator->batch_rename_files($arr);

// Batch search replace specific files
$arr = [
    [
        $pdst . '/' . $slug . '.php',
        $generator->name,
        $name,
    ],
    [
        $pdst . '/' . $slug . '.php',
        $generator->version,
        $version,
    ],
    [
        $pdst . '/' . $slug . '.php',
        $generator->slug,
        $slug,
    ],
    [
        $pdst . '/includes/class-info.php',
        $generator->slug,
        $slug,
    ],
    [
        $pdst . '/includes/class-info.php',
        $generator->version,
        $version,
    ],
    [
        $pdst . '/includes/class-info.php',
        $generator->option,
        $option,
    ],
    [
        $pdst . '/includes/class-info.php',
        $generator->url,
        $url,
    ],
    [
        $pdst . '/frontend/class-frontend.php',
        $generator->slug,
        $slug,
    ],
    [
        $pdst . '/admin/class-admin.php',
        $generator->slug,
        $slug,
    ],
];
$generator->batch_search_replace_files($arr);

// Search and replace namespace in all files
$generator->search_replace_all_files($pdst, $generator->namespace, $namespace);

// Create and download zip file
$generator->zip_it($dst, $slug);

// Delete temp directory
$generator::recursive_delete($temp);
