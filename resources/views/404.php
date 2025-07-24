<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .error-container {
        text-align: center;
        padding: 2rem;
        max-width: 600px;
    }

    .error-code {
        font-size: 120px;
        font-weight: bold;
        color: #dc3545;
        line-height: 1;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-message {
        font-size: 24px;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .error-description {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .back-home {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .back-home:hover {
        background-color: #0056b3;
    }

    @media (max-width: 576px) {
        .error-code {
            font-size: 80px;
        }

        .error-message {
            font-size: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-message">Page Not Found</h1>
        <p class="error-description">The page you are looking for might have been removed, had its name changed, or is
            temporarily unavailable.</p>
        <a href="{{url('/')}}" class="back-home">Back to Home</a>
    </div>
</body>

</html>