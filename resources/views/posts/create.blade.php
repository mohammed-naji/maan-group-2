<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">

        <h1>Create New Post</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('create_post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>title</label>
                <input type="text" name="title" class="form-control" placeholder="Title..">
            </div>

            <div class="mb-3">
                <label>content</label>
                <textarea rows="5" name="content" class="form-control" placeholder="Title.."></textarea>
            </div>

            @include('seo')

            <button class="btn btn-success">Save</button>
        </form>

    </div>

</body>
</html>
