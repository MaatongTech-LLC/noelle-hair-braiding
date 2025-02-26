<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Contact Mail</h2>
<p>You received an email with this information :</p>
<ul>
    <li><strong>Name</strong> : {{ $data['name'] }}</li>
    <li><strong>Email</strong> : {{ $data['email'] }}</li>
    <li><strong>Phone</strong> : {{ $data['phone'] }}</li>
    <li><strong>Subject</strong> : {{ $data['subject'] }}</li>
    <li><strong>Message</strong> : {{ $data['message'] }}</li>
</ul>
</body>
</html>
