@extends('pages.template')
@section('title', 'Update Product Type')

@section('container__content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered text-center ">
                <thead>
                    <tr>
                        <th class="border border-primary" scope="col">Number</th>
                        <th class="border border-primary" scope="col">Stationary Type Name</th>
                        <th class="border border-primary" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($productTypes); $i++)
                        <tr>
                            <td class="border border-primary">{{ $i + 1 }}</td>
                            <td class="border border-primary">{{ $productTypes[$i]->name }}</td>
                            <td class="border border-primary">
                                <form action="/productType/update" method="POST" enctype="multipart/form-data"
                                    class="form-inline my-2">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control mr-sm-2" placeholder="Type Name"
                                        aria-label="Name" aria-describedby="basic-addon1" id="name" name="name">
                                    <button type="submit" class="btn btn-primary my-2 my-sm-0 mr-sm-2">Update</button>
                                    <button type="submit" class="btn btn-danger my-2 my-sm-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endfor

                </tbody>
            </table>
        </div>
    </div>
@endsection
