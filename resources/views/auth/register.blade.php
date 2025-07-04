<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; }
        input, select { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007cba; color: white; border: none; cursor: pointer; }
        .error { color: red; margin: 10px 0; }
        a { color: #007cba; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Register</h2>
    
    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <form method="POST" action="/register">
        @csrf
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
        <input type="text" name="fullname" placeholder="Full Name" value="{{ old('fullname') }}" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
        </select>
        <button type="submit">Register</button>
    </form>
    
    <p><a href="/login">Already have an account? Login</a></p>
</body>
</html>