<!-- resources/views/emails/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
    <h1>Welcome to our platform, {{ $user->name }}!</h1>
    <p>Thank you for signing up. We are excited to have you onboard.</p>
</body>
</html>
