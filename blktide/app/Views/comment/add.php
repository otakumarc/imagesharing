<!DOCTYPE html>
<html>
<head>
    <title>Add Comment</title>
</head>
<body>
    <h1>Add Comment</h1>
    <form method="POST" action="/comment/add">
        <label for="content">Comment:</label>
        <textarea id="content" name="content" required></textarea><br>

        <input type="hidden" name="image_id" value="<?php echo $imageId; ?>">

        <button type="submit">Add Comment</button>
    </form>
</body>
</html>
