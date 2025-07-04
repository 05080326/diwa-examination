<!DOCTYPE html>
<html>
<head>
    <title>Assign Book to User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007cba;
            padding-bottom: 15px;
        }
        h2 {
            color: #007cba;
            margin: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        select, input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        select:focus, input[type="date"]:focus {
            outline: none;
            border-color: #007cba;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #007cba;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
            margin-left: 10px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #edd4da;
            color: #571517;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #e6c3cc;
        }
        .book-preview, .user-preview {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            border-left: 4px solid #007cba;
        }
        .preview-title {
            font-weight: bold;
            color: #007cba;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Assign Book to User</h2>
            <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/books/assign">
            @csrf

            <div class="form-group">
                <label for="book_id">Select Book *</label>
                <select id="book_id" name="book_id" required onchange="showBookPreview()">
                    <option value="">Choose a book...</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
                <div id="bookPreview" class="book-preview" style="display: none;">
                    <div class="preview-title" id="bookTitle"></div>
                    <div id="bookDesc"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="user_id">Select student *</label>
                <select id="user_id" name="user_id" required onchange="showUserPreview()">
                    <option value="">Choose a student...</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Assign Book</button>
                <a href="/books" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>

    </script>
</body>
</html>
