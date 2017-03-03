<?php

namespace WPSG;

class Generator
{
    public $name;
    public $slug;
    public $option;
    public $namespace;
    public $version;
    public $url;

    public function __construct() {
        $this->name = 'WP Plugin Starter';
        $this->slug = 'plugin-name';
        $this->option = 'plugin_name_settings';
        $this->namespace = 'PLUGIN_NAME';
        $this->version = '1.0';
        $this->url = 'https://example.com/';
    }

    /**
     * Copy a directory recursively.
     *
     * @param string $src The source directory
     * @param string $dst The destination
     */
    public static function recursive_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recursive_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Delete a directory recursively.
     *
     * @param string $dir The driectory to delete
     */
    public static function recursive_delete($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!self::recursive_delete($dir . '/' . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    /**
     * Glob with recursive search.
     *
     * @param string $pattern The pattern. No tilde expansion or parameter substitution is done
     * @param int    $flags   Valid glob flags
     *
     * @return array Returns an array containing the matched files/directories
     */
    public static function rglob($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, self::rglob($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

    /**
     * Batch rename files.
     *
     * @param array $arr The array of files to rename (each value being $src => $dst)
     */
    public function batch_rename_files($arr) {
        foreach ($arr as $src => $dst) {
            rename($src, $dst);
        }
    }

    /**
     * Batch search replace files.
     *
     * @param array $arr The search-replace array (each value being $src, $old, $new)
     */
    public function batch_search_replace_files($arr) {
        foreach ($arr as $val) {
            $src    = $val[0];
            $old    = $val[1];
            $new    = $val[2];
            $output = file_get_contents($src);
            $output = str_replace($old, $new, $output);
            file_put_contents($src, $output);
        }
    }

    /**
     * Search and replace all files in a directory.
     *
     * @param string $src The source directory
     * @param string $old The string to replace
     * @param string $new The replacement string
     */
    public function search_replace_all_files($src, $old, $new) {
        $files = self::rglob($src . '/*.php');
        foreach ($files as $file) {
            $output = file_get_contents($file);
            $output = str_replace($old, $new, $output);
            file_put_contents($file, $output);
        }
    }

    /**
     * Crates and downloads a zip file.
     *
     * @param string $src      The source directory
     * @param string $filename The name of the zip file (minus the .zip)
     */
    public function zip_it($src, $filename) {
        $zipname = $filename.'.zip';

        $zip = new \ZipArchive();

        $zip->open($zipname, \ZipArchive::CREATE);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $path = $file->getPathName();
                $rel_path = str_replace($src . '/', '', $path);
                $zip->addFile($path, $rel_path);
            }
        }

        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

        unlink($zipname);
    }
}
