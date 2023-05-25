<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>
    <h1>Upload Image</h1>
    <form method="POST" action="/image/upload" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br>

        <label for="caption">Caption:</label>
        <textarea id="caption" name="caption"></textarea><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>
