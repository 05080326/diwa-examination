<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; }
        input { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007cba; color: white; border: none; cursor: pointer; }
        .error { color: red; margin: 10px 0; }
        .success { color: green; margin: 10px 0; }
        a { color: #007cba; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Login</h2>
    
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    
    <form method="POST" action="/login">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    
    <p><a href="/register">Don't have an account? Register</a></p>
</body>
</html>