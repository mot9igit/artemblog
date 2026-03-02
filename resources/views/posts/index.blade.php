<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Блог на Laravel</h2>

        @foreach($posts as $post)
            <div>
                <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                <p>{{ Str::limit($post->introtext, 150) }}</p>
            </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>
