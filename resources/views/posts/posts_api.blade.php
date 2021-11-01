<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">

        <h2>Our posts</h2>

        <div class="row posts-wrapper">
        </div>

        <input type="text" class="form-control" id="city" placeholder="City Name..">
        <div class="weather_result">

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>

        $('#city').keyup(function() {
            var city = $(this).val();
            if(city.length > 2) {
                axios.get('https://api.openweathermap.org/data/2.5/weather?q='+city+'&appid=dccab945679f3bb9019537a309e05e47&units=metric')
                // .then(function(res) {
                //     console.log(res);
                // })
                .then(res => {

                    // var c = (res.data.main.temp - 32) * (5/9);
                    // var c = ((32 * res.data.main.temp - 32) * 5) / 9
                    // console.log(res.data.main.temp)
                    $('.weather_result').html(`As Maram request to show the temp in C ${res.data.main.temp}`);

                } )
                .catch(e => console.log(e))
            }

        })
        // axios.get()
        // axios.post()
        // axios.put()
        // axios.delete()

        //getData();
        function getData() {
            // axios.get('http://127.0.0.1:8000/api/v1/posts')
            axios.get('https://jsonplaceholder.typicode.com/posts')
            .then( function(res) {
                console.log(res.data);
                // $.each(res.data, function(key, post) {
                //     let col = `
                //     <div class="col-12 mb-4">
                //         <div class="card">
                //             <div class="card-body">
                //                 <h2>${post.title}</h2>
                //                 <p>${post.body}</p>
                //             </div>
                //         </div>
                //     </div>
                //     `;
                //     $('.posts-wrapper').append(col);
                // })
            } )
        }

        //addData();
        function addData() {
            axios.post('http://127.0.0.1:8000/api/v1/posts', {
                title: 'This is new post from axios',
                content: 'This is new content from axios',
            })
            .then(res => console.log(res))
        }


        //updateData();
        function updateData() {
            axios.put('http://127.0.0.1:8000/api/v1/posts/3', {
                title: 'This is new updated title',
            })
            .then(res => console.log(res))
        }

        deteleData(2);
        function deteleData(id) {
            axios.delete('http://127.0.0.1:8000/api/v1/posts/'+id).then(res => console.log(res))
        }
    </script>
</body>
</html>
