<!DOCTYPE html>
<html>
<head>
    <title>Create Book</title>
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
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="url"], textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="url"]:focus, textarea:focus {
            outline: none;
            border-color: #007cba;
        }
        textarea {
            height: 120px;
            resize: vertical;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background: #007cba;
            color: white;
        }
        .btn-primary:hover {
            background: #005a87;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background: #545b62;
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
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .preview {
            margin-top: 15px;
            text-align: center;
        }
        .preview img {
            max-width: 200px;
            max-height: 300px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Create New Book</h2>
            <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/books" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Book Name *</label>
                <input type="text" id="name" name="title" value="{{ old('title') }}" required placeholder="Enter book title">
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required placeholder="Enter book description, summary, or details">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="cover_image">Book Cover</label>
                <input type="file" id="cover_image" name="cover_image" onchange="previewUploadImage(event)">
                <div class="preview" id="imagePreview" style="display: none;">
                    <img id="coverPreview" src="" alt="Book Cover Preview">
                </div>
            </div>

{{--            <div class="form-group">--}}
{{--                <label for="cover_url">Book Cover URL</label>--}}
{{--                <input type="url" id="cover_url" name="cover_image" value="{{ old('cover_image') }}" placeholder="https://example.com/book-cover.jpg" onchange="previewImage()">--}}
{{--                <div class="preview" id="imagePreview" style="display: none;">--}}
{{--                    <img id="coverPreview" src="" alt="Book Cover Preview">--}}
{{--                </div>--}}
{{--            </div>--}}

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    Create Book
                </button>
                <a href="/books" class="btn btn-secondary">View All Books</a>
            </div>
        </form>
    </div>

    <script>
        function previewUploadImage(event) {
            const file = event.target.files[0];

            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('coverPreview');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please upload a valid image file.');
            }
        }

        function previewImage() {
            const url = document.getElementById('cover_url').value;
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('coverPreview');

            if (url) {
                img.src = url;
                preview.style.display = 'block';
                img.onerror = function() {
                    preview.style.display = 'none';
                };
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
