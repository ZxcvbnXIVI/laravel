<!-- resources/views/blogs/index.blade.php -->

<h1>Blog Posts</h1>

@foreach ($blogs as $blog)
    <div>
        <h2>{{ $blog->title }}</h2>
        <p>{{ $blog->content }}</p>
    </div>
@endforeach
