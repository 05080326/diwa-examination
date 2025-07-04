<!DOCTYPE html>
<html>
<head>
    <title>All Books</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 1000px; 
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
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        }
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .book-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background: #f8f9fa;
        }
        .book-cover {
            text-align: center;
            margin-bottom: 15px;
        }
        .book-cover img {
            max-width: 150px;
            max-height: 200px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .book-title {
            font-size: 18px;
            font-weight: bold;
            color: #007cba;
            margin-bottom: 10px;
        }
        .book-description {
            color: #666;
            line-height: 1.5;
        }
        .no-books {
            text-align: center;
            color: #666;
            font-style: italic;
            margin: 50px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>All Books</h2>
            <div>
                <a href="/books/create" class="btn btn-primary">Add New Book</a>
                <a href="/dashboard" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>
        
        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        @if($book->cover_url)
                            <div class="book-cover">
                                <img src="{{ $book->cover_url }}" alt="{{ $book->name }}" onerror="this.style.display='none'">
                            </div>
                        @endif
                        <div class="book-title">{{ $book->name }}</div>
                        <div class="book-description">{{ Str::limit($book->description, 150) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-books">
                No books available. <a href="/books/create">Create your first book!</a>
            </div>
        @endif
    </div>
</body>
</html>