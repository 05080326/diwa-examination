<!DOCTYPE html>
<html>
<head>
    <title>Book Assignments by Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
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
            margin-left: 10px;
        }
        .btn-primary { background: #007cba; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007cba;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .book-cover {
            width: 40px;
            height: 50px;
        }
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 3px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-active { background: #d4edda; color: #155724; }
        .status-overdue { background: #f8d7da; color: #721c24; }
        .status-returned { background: #cce5ff; color: #004085; }
        .filter-section {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-left: 10px;
        }
        .truncate {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Book Assignments by Student</h2>
            <div>
                @if(auth()->user()->role == 'teacher')
                    <a href="/books/assign" class="btn btn-primary">New Assignment</a>
                @endif
                <a href="/dashboard" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="filter-section">
            <label for="studentFilter"><strong>Filter by Student:</strong></label>
            <select id="studentFilter" onchange="filterAssignments()">
                <option value="">All Students</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ request()->query('filter') == $student->id ? 'selected' : '' }}>
                        {{ $student->fullname }}
                    </option>
                @endforeach
            </select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Student</th>
                    <th>Book Title</th>
                    <th>Book Description</th>
                    @if(auth()->user()->role == 'teacher')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
               @foreach($items as $item)
                   <tr>
                       <td><img src="{{ URL::asset('storage/' . $item->book->cover_image) }}" class="book-cover"></td>
                       <td>{{ $item->user->fullname }}</td>
                       <td>{{ $item->book->title }}</td>
                       <td>
                           <p class="truncate">
                               {{ $item->book->description }}
                           </p>
                       </td>
                       @if(auth()->user()->role == 'teacher')
                       <td>
                           <form action="/books/unassign/{{ $item->id }}" method="POST">
                               @csrf
                               @method('DELETE')
                               <button type="submit" style="display: inline-block; padding: 10px 20px; background: #b81724; color: white; text-decoration: none; border-radius: 5px; border: 0;">
                                   Unassign
                               </button>
                           </form>
                       </td>
                       @endif
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function filterAssignments() {
            let student_id = document.getElementById('studentFilter').value;

            let params = new URLSearchParams({
                filter: student_id
            });

            window.location.href = window.location.pathname + '?' + params;
        }
    </script>
</body>
</html>
