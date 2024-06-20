<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif;">

<div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f4f4f4;">

    <h2 style="text-align: center; color: #333;">Email Verification</h2>

    <p style="font-size: 16px; line-height: 1.6; color: #666;">
        Hello {{ $user->name }},<br><br>

        Please click the button below to verify your email address:
    </p>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('user.email_verification', $token) }}"
           style="display: inline-block; background-color: #009688; color: #fff; text-decoration: none; padding: 10px 20px;">Verify
            Email</a>
    </div>

    <p style="font-size: 14px; line-height: 1.6; color: #666; margin-top: 20px;">
        If you did not create an account, you can safely ignore this email.
    </p>

</div>

</body>
</html>