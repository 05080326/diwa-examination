<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 50px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .user-info { background: #f5f5f5; padding: 15px; border-radius: 5px; }
        button { padding: 10px 20px; background: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Dashboard</h2>
        <form method="POST" action="/logout" style="margin: 0;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="user-info">
        <h3>Welcome, {{ auth()->user()->fullname }}!</h3>
        <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
        <p><strong>Full Name:</strong> {{ auth()->user()->fullname }}</p>
        <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
    </div>

    <div style="margin-top: 30px;">
        <h3>Book Management</h3>

        @if (auth()->user()->role == 'teacher')
        <a href="/books/create" style="display: inline-block; padding: 10px 20px; background: #007cba; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">Create New Book</a>
        <a href="/books/assign" style="display: inline-block; padding: 10px 20px; background: #ffc107; color: black; text-decoration: none; border-radius: 5px; margin-right: 10px;">Assign Book</a>
        @endif

        <a href="/books" style="display: inline-block; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">View All Books</a>
        <a href="/books/assignments" style="display: inline-block; padding: 10px 20px; background: #17a2b8; color: white; text-decoration: none; border-radius: 5px;">View Assignments</a>
    </div>
</body>
</html>
