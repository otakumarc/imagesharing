<!DOCTYPE html>
<html>
<head>
    <title>View Image</title>
</head>
<body>
    <h1>View Image</h1>
    <img src="<?php echo $imageUrl; ?>" alt="Image"><br>

    <p>Caption: <?php echo $caption; ?></p>
    <p>Uploaded by: <?php echo $uploadedBy; ?></p>
    <p>Likes: <?php echo $likesCount; ?></p>

    <h2>Comments</h2>
    <?php if (!empty($comments)) : ?>
        <ul>
            <?php foreach ($comments as $comment) : ?>
                <li><?php echo $comment['content']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <form method="POST" action="/comment/add">
        <label for="content">Add Comment:</label>
        <textarea id="content" name="content" required></textarea><br>

        <input type="hidden" name="image_id" value="<?php echo $imageId; ?>">

        <button type="submit">Add Comment</button>
    </form>
</body>
</html>
