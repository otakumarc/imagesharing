<!DOCTYPE html>
<html>
<head>
    <title>Like Image</title>
</head>
<body>
    <h1>Like Image</h1>
    <form method="POST" action="/like/like">
        <input type="hidden" name="image_id" value="<?php echo $imageId; ?>">

        <button type="submit">Like</button>
    </form>
</body>
</html>
