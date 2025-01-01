<!DOCTYPE html>
<html>
<head>
    <title>HTML Files in Current Directory</title>
</head>
<body>
    <h1>HTML Files</h1>
    <ul>
        <?php
        // Get the current directory
        $current_directory = __DIR__;

        // Scan the directory for files
        $files = scandir($current_directory);

        // Filter for HTML files
        $html_files = array_filter($files, function ($file) {
            return preg_match('/\.html$/i', $file); // Case-insensitive match for .html extension
        });

        // Sort alphabetically (optional)
        sort($html_files);

        // Loop through the HTML files and create links
        foreach ($html_files as $file) {
            echo "<li><a href=\"$file\">$file</a></li>";
        }

        // Message if no HTML files found.
        if (empty($html_files)) {
            echo "<li>No HTML files found in this directory.</li>";
        }
        ?>
    </ul>
</body>
</html>