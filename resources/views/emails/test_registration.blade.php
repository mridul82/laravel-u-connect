<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Urja Connect!</title>
</head>
<body>
    <h1>Hi {{ $name }},</h1>
    <p>Welcome to Urja Connect! We're so excited to have you on board.</p>

    <h2>Your Student Id : {{ $register_id }}</h2>


    <p>**Important:** Please keep your credentials safe and confidential. Never share them with anyone.</p>

    <p>If you have any questions, feel free to reach out to us at urja.connect@findtutor.tech</p>

    <p>Thanks,<br>The Urja Connect Team</p>
{{--
    <p>Attachment: <a href="{{ $attachment_path }}">Your User Credentials.pdf</a></p> --}}
</body>
</html>
