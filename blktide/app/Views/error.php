<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <style>
        /* CSS styling for the error page */
        .error-container {
            text-align: center;
            margin-top: 100px;
        }

        .error-code {
            font-size: 48px;
            font-weight: bold;
        }

        .error-message {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code"><?php echo $errorCode; ?></div>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    </div>
</body>
</html>
