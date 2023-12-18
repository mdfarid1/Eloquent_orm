@extends("welcome")
@section("content")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Show</title>
</head>
<body>
    <div class="m-5 ">
        <div>
            <h2>Sell Products</h2>
        </div>
        <div class="col-md-4">
            @if(Session::has('success'))
            <p class="alert alert-success" id="success-alert" style="background-color: rgb(118, 240, 207);">{{ Session::get('success') }}</p>
            @endif
            @if(Session::has('error'))
            <p class="alert alert-success" id="error-alert" style="background-color: rgb(245, 95, 90);">{{ Session::get('error') }}</p>
            @endif
        </div>
       <div class="card">

        <div>
            <table class="table table-bordered border-dark">
                <thead>
                  <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col" class="text-center">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($products as $key=> $product)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{floor( $product->price) }}</td>
                        <td class="text-center"><a href="{{ url("/products/sell/".$product->id) }}"><button class="btn btn-primary">Sell Product</button></a></td>

                   </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

       </div>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, {{ session('timeout', 3000) }});
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('error-alert').style.display = 'none';
        }, {{ session('timeout', 3000) }});
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
@endsection
