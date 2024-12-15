<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Login Page</h1>
@if('failure')
    <h2>Wrong username or password!</h2>
@endif
<form action="{{ route('login.authenticate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="loginname" placeholder="name">
    <input type="password" name="loginpassword" placeholder="password">
    <button>Login</button>
</form>
</body>
</html>
