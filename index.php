<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WP Plugin Generator</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,900">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css">
        <link rel="stylesheet" href="assets/styles/main.css">
    </head>
    <body>
        <div class="form-wrap">
            <h1>WP Plugin Generator</h1>
            <form id="generator-form" action="data.php" method="post">
                <input id="generator-name" title="Please enter a plugin name." class="base-input tooltip"  type="text" name="name" placeholder="Plugin Name"><br><br>
                <input id="generator-slug" title="Slug must be lowercase with dashes." class="base-input tooltip"  type="text" name="slug" placeholder="Plugin Slug"><br><br>
                <input id="generator-option" title="Option name must be lowercase with underscores." class="base-input tooltip"  type="text" name="option" placeholder="Database Option Name"><br><br>
                <input id="generator-namespace" title="Must be a valid namespace." class="base-input tooltip"  type="text" name="namespace" placeholder="PHP Namespace"><br><br>
                <input id="generator-version" title="Invalid version number." class="base-input tooltip"  type="text" name="version" placeholder="Plugin Version"><br><br>
                <input id="generator-url" title="Invalid URL. Remember the trailing slash." class="base-input tooltip" type="text" name="url" placeholder="Update URL"><br><br>
                <input id="generator-submit" class="btn" type="submit" value="Submit">
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js"></script>
        <script src="assets/scripts/app.js"></script>
    </body>
</html>
