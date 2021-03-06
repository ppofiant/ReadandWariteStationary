@extends('layouts.app')
@section('title', 'Update Product')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="/product/{{ $product->id }}/edit" method="POST">
            @method('patch')
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ $product->name }}" aria-label="Name"
                    aria-describedby="basic-addon1" id="name" name="name" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{ $product->description }}" aria-label="Description"
                    aria-describedby="basic-addon1" id="description" name="description" required>
            </div>
            <div class="input-group mb-3">
                <input type="number" class="form-control" value="{{ $product->stock }}" aria-label="Stock"
                    aria-describedby="basic-addon1" id="stock" name="stock" required>
            </div>
            <div class="input-group mb-3">
                <input type="number" class="form-control" value="{{ $product->price }}" aria-label="Price"
                    aria-describedby="basic-addon1" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Stationary Data</button>
        </form>
    </div>
@endsection
