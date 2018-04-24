@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="table">
                            @if(count($products))
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        @if(Auth::check())
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        @else
                                            <th>Add To Cart</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <img width="100px" height="100px" class="img-responsive" src="{{url('/storage/'.$product->file_path)}}" alt="No Image">
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->description ? $product->description : '-'}}</td>
                                            <td>{{$product->price . ' $'}}</td>
                                            @if(Auth::check())
                                                <td><a href="{{route('products.edit', $product->id)}}">Edit</a></td>
                                                <td><a href="" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                                                    <form id="delete-form" action="{{ route('products.delete', $product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </td>
                                            @else
                                                <td><a href="{{route('cart.store', $product->id)}}">Add</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                </tbody>
                            @else
                                <span>No products available</span>
                            @endif
                        </table>
                        @if(count($products))
                            {{$products->links()}}
                            @endif
                        @if(Auth::check())
                            <div class="container">
                                <a href="{{route('products.create')}}">Add</a>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @else
                        <a href="{{route('cart.index')}}">Go to cart</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection