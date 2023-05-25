<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        /* CSS styling for the profile page */
        .banner {
            height: 200px;
            background-color: #f2f2f2;
            /* Add additional styling for the banner */
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* Add additional styling for the profile picture */
        }

        .follow-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            /* Add additional styling for the follow button */
        }

        .unfollow-button {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            cursor: pointer;
            /* Add additional styling for the unfollow button */
        }

        .message-button {
            padding: 10px 20px;
            background-color: #2ecc71;
            color: #fff;
            border: none;
            cursor: pointer;
            /* Add additional styling for the message button */
        }

        .image-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
            /* Add additional styling for the image row */
        }

        .image-item {
            width: 23%;
            margin-bottom: 20px;
            /* Add additional styling for the image item */
        }

        .image-item img {
            width: 100%;
            /* Add additional styling for the image */
        }
    </style>
</head>
<body>
    <div class="banner">
        <!-- Add banner content here -->
    </div>

    <div>
        <img class="profile-picture" src="<?php echo $profilePictureUrl; ?>" alt="Profile Picture">
        <h2><?php echo $username; ?></h2>
        <p><?php echo $followerCount; ?> followers</p>
        <p><?php echo $followingCount; ?> following</p>

        <?php if ($isFollowing) : ?>
            <button class="unfollow-button">Unfollow</button>
        <?php else : ?>
            <button class="follow-button">Follow</button>
        <?php endif; ?>

        <button class="message-button">Message</button>
    </div>

    <div class="image-row">
        <?php foreach ($images as $image) : ?>
            <div class="image-item">
                <img src="<?php echo $image['url']; ?>" alt="Image">
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        // JavaScript for infinite scroll effect
        window.addEventListener('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                // Load more images here
            }
        });
    </script>
</body>
</html>
