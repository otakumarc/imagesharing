<!DOCTYPE html>
<html>
<head>
    <title>Messaging</title>
    <style>
        /* CSS styling for the messaging page */
        .conversation-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .conversation-list-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        .conversation-list-item:hover {
            background-color: #f2f2f2;
        }

        .conversation-list-item .profile-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .conversation-list-item .username {
            font-weight: bold;
        }

        .message-container {
            padding: 20px;
        }

        .message-container .message {
            margin-bottom: 10px;
        }

        .message-container .message .sender {
            font-weight: bold;
        }

        .message-container .message .timestamp {
            font-size: 12px;
            color: #888;
        }

        .message-input {
            display: flex;
        }

        .message-input input[type="text"] {
            flex-grow: 1;
            padding: 10px;
        }

        .message-input button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load the conversation when a user is clicked
            $('.conversation-list-item').click(function() {
                var conversationId = $(this).data('conversation-id');
                loadConversation(conversationId);
            });

            // Send a message when the form is submitted
            $('#message-form').submit(function(e) {
                e.preventDefault();
                var conversationId = $('#conversation-id').val();
                var message = $('#message-input').val();
                sendMessage(conversationId, message);
            });

            function loadConversation(conversationId) {
                // Implement the code to load the conversation here
                // Use AJAX to fetch the conversation data and display it in the message container
            }

            function sendMessage(conversationId, message) {
                // Implement the code to send a message here
                // Use AJAX to send the message and update the conversation in real-time
                // Clear the input field after sending the message
                $('#message-input').val('');
            }
        });
    </script>
</head>
<body>
    <div>
        <ul class="conversation-list">
            <?php foreach ($conversations as $conversation) : ?>
                <li class="conversation-list-item" data-conversation-id="<?php echo $conversation['id']; ?>">
                    <img class="profile-picture" src="<?php echo $conversation['profilePicture']; ?>" alt="Profile Picture">
                    <div class="username"><?php echo $conversation['username']; ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="message-container">
        <!-- Messages will be dynamically loaded here -->
    </div>

    <div>
        <form id="message-form">
            <input type="hidden" id="conversation-id" value="">
            <div class="message-input">
                <input type="text" id="message-input" placeholder="Type your message...">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
</body>
</html>
