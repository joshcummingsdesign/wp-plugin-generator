<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>WP Plugin Generator</title>
        <link rel="stylesheet" href="assets/styles/main.css">
    </head>
    <body>
        <h1>WP Plugin Generator</h1>
        <form id="generator-form" action="data.php" method="post">
            <input type="text" name="name" placeholder="Plugin Name" required><br><br>
            <input type="text" name="slug" placeholder="Plugin Slug" required><br><br>
            <input type="text" name="option" placeholder="Database Option Name" required><br><br>
            <input type="text" name="namespace" placeholder="PHP Namespace" required><br><br>
            <input type="text" name="version" placeholder="Plugin Version" required><br><br>
            <input type="text" name="url" placeholder="Update URL" required><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
