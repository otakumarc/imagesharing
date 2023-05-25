<!DOCTYPE html>
<html>
<head>
    <title>Feed</title>
    <style>
        /* CSS styling for the feed page */
        .post-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-picture {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .username {
            font-weight: bold;
        }

        .post-image {
            width: 100%;
            margin-bottom: 10px;
        }

        .post-actions {
            display: flex;
            align-items: center;
        }

        .like-button,
        .comment-button {
            margin-right: 10px;
        }

        #loader {
            text-align: center;
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var page = 1;
            var loading = false;
            var finished = false;

            function loadPosts() {
                if (loading || finished) {
                    return;
                }

                loading = true;
                $('#loader').show();

                $.ajax({
                    url: '/feed/loadmore',
                    method: 'POST',
                    data: { page: page },
                    success: function(response) {
                        if (response.posts.length > 0) {
                            var posts = response.posts;
                            var html = '';

                            for (var i = 0; i < posts.length; i++) {
                                var post = posts[i];

                                html += '<div class="post-container">';
                                html += '<div class="post-header">';
                                html += '<img class="profile-picture" src="' + post.profilePicture + '" alt="Profile Picture">';
                                html += '<div class="username">' + post.username + '</div>';
                                html += '</div>';
                                html += '<img class="post-image" src="' + post.imageUrl + '" alt="Post Image">';
                                html += '<div class="post-actions">';
                                html += '<button class="like-button">Like</button>';
                                html += '<button class="comment-button">Comment</button>';
                                html += '</div>';
                                html += '</div>';
                            }

                            $('#feed').append(html);
                            page++;
                        } else {
                            finished = true;
                        }
                    },
                    complete: function() {
                        loading = false;
                        $('#loader').hide();
                    }
                });
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    loadPosts();
                }
            });

            loadPosts();
        });
    </script>
</head>
<body>
    <div id="feed">
        <!-- Posts will be dynamically loaded here -->
    </div>

    <div id="loader">
        Loading...
    </div>
</body>
</html>
