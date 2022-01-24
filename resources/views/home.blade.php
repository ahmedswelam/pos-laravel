<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>POS</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
   
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css"> 
    <link rel="javascript" href="<?php echo asset('js/app.js')?>" type="text/javascript"> 

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body id="app-layout">

    <!-- Header Start-->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}" style="font-size: x-large;">POS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- Header End-->


<div class="container">
	<div class="row">

        <!-- products Section -->
		<div class="col-md-6"  style="width: 50%;">	
        
            <!-- Section title -->
            <h2><i class="fa fa-product-hunt" aria-hidden="true"></i> Products</h2>
            
            @foreach ($data as $value)
            <form action="{{url('home', $value->id)}}" method="POST">
            @csrf
            @if($value->pro_quantity == 0)
            <button class="btn btn-primary btn-sm cart-btn disabled">
            <i class="fas fa-cart-plus"></i></button>
            @else
            <div style="width: 16.66%;border:1px solid rgb(243, 243, 243)" class="mb-4 card">
                <img class="card-img-top gambar" src="{{asset('images/'.$value->pro_image)}}"
                alt="Card image cap" style="width:50%;margin-top: 7px;cursor: pointer;"
                onclick="this.closest('form').submit();return false;">
                <h3>{{$value->pro_name}}</h3>
                <p class="price">${{$value['pro_price']}}</p>
                    @endif
                </form>            
            </div>   
            @endforeach                
        </div>

		<!-- Cart Section -->
        <div class="col-md-4"  style="width: 50%;">
             <!-- Section title -->
            <h2>
                <i class="fa fa-shopping-cart" aria-hidden="true">
                </i> Shopping cart 
                <span class="badge">{{$totalQty}}</span>
            </h2>

            <!-- Section Content -->
            <div class="panel panel-default">
                <div class="panel-heading" style="font-weight: bold;font-size: large;">
                    <table class="table table-striped">

                        <!-- table header -->
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i class="fa fa-cog" aria-hidden="true"></i></th>	
                            </tr>
                        </thead>

                        <!-- table body -->
                        @if(Session::has('cart'))
                        <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['id']}}</td>
                            <td>{{ $product['pro_name']}}</td>   
                            <td>{{ $product['item']['pro_price']}}</td>                      
                            <td>{{ $product['qty']}}</td>
                            <td>{{ $product['pro_price']}}</td>
                            <td>
                                <a href="{{ Route('remove', ['id' => $product['item']['id']]) }}">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ Route('delete', ['id' => $product['item']['id']]) }}">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        @endif
                        <!-- table footer -->
                        <tfoot>
                        <td>Total Products : {{$totalQty}} <br> </td>
                        <td>Total Price: {{$totalprice}}</td>
        </tfoot>
        </table>
			  </div>









            <!-- JavaScripts -->
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>   
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-resource.min.js">
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-route.min.js"> </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

            <!-- Cart Javascript-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            {{-- <script src="{{ elixir('js/cart.js') }}"></script> --}}
</body>
	
</html>