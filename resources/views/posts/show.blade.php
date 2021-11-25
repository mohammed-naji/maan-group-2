<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Create</title>

    {{-- @if ($post->seo) --}}
    <meta name="author" content="{{ $post->seo->author??'' }}" />
    <meta name="description" content="{{ $post->seo->description??'' }}" />
    <meta name="keywords" content="{{ $post->seo->keywords??'' }}" />
    {{-- @endif --}}


    <meta property="og:url"                content="{{ route('show_post', $post->id) }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $post->title }}" />
    <meta property="og:description"        content="{{ $post->content }}" />
    <meta property="og:image"              content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">

        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

    </div>

</body>
</html>
