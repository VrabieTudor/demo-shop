@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{!empty($product) ? 'Edit Product' : 'Add a new Product'}}</div>
                    <div class="card-body">
                        <form method="POST" action='{{!empty($product) ? route('products.update', $product->id) : route('products.store')}}' enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="{{!empty($product) ? 'PUT' : 'POST'}}">
                            <div class="form-group">
                                <label for="title">Title*</label>
                                <input class="form-control" id="title" name="title" placeholder="Enter title" required value="{{!empty($product) ? $product->title : old('title')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" id="description" name="description" placeholder="Enter description" {{!empty($product) ? '' : 'required'}} value="{{!empty($product) ? $product->description : old('description')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price*</label>
                                <input type="number" step="any" class="form-control" id="price" name="price" min="1" required value="{{!empty($product) ? $product->price : old('price')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">Image*</label>
                                <input type="file" class="form-control" id="image" name="file" {{!empty($product) ? '' : 'required'}}>
                            </div>
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
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a  href="{{route('products.index')}}">Products</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection