@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cart</div>
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="table">
                            @if(Session::has('cart') && count(Session::get('cart')) > 1)
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Remove Product</th>
                                </tr>
                                </thead>
                            <tbody>
                                @foreach(Session::get('cart') as $key => $item)
                                    @if($key !== 'total')
                                            <tr>
                                                <td><img width="100px" height="100px" class="img-responsive" src="{{url('/storage/'.$item['product']->file_path)}}" alt="No Image"></td>
                                                <td>{{$item['product']->title}}</td>
                                                <td>{{$item['product']->description}}</td>
                                                <td>{{($item['product']->price * $item['quantity']) . ' $'}}</td>
                                                <td>{{$item['quantity']}}</td>
                                                <td><a href="{{route('cart.remove', $item)}}">Remove</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                            </tbody>
                        </table>
                        <form action="{{route('cart.checkout')}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input class="form-control" id="name" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-details">Contact Details*</label>
                                <input class="form-control" id="contact-details" name="contactDetails" placeholder="Enter contact details" required>
                            </div>
                            <div class="form-group">
                                <label for="comments">Comments*</label>
                                <input step="any" class="form-control" id="comments" name="comments">
                            </div>
                            <button type="submit" class="btn btn-primary">Checkout</button>
                            @if ($errors->any())
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </form>
                        @else
                            <span>The cart is empty.</span>
                        @endif
                        <a href="{{route('products.index')}}">Go to index</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection