<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post CRUD Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">

        <h2>Our posts</h2>
        <div class="row mt-4">
            <div class="col-4">
                <form id="form_data">
                    <input type="text" id="title" name="title" placeholder="Title" class="form-control mb-3">
                    <textarea name="content" rows="5" id="content" placeholder="Content" class="form-control mb-3"></textarea>
                    <button class="btn btn-dark">Add</button>
                </form>
            </div>
            <div class="col-8">
                Data
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        $('#form_data').submit(function(e) {
            e.preventDefault();

            var t = $('#title').val();
            var c = $('#content').val();

            $.ajax({
                type: 'post',
                url: '{{ route("posts.store") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: t,
                    content: c
                },
                success: function(res) {
                    console.log(res);
                },
                error: function() {

                }
            })

        })

    </script>
</body>
</html>