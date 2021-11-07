@extends('layouts.admin.app')

@section('title', 'Galleries')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">List Product Gallery </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Default</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['galleries'] as $gallery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gallery->product->name }}</td>
                                        <td>
                                            <img src="{{ asset($gallery->image) }}">
                                        </td>
                                        <td>{{ $gallery->is_default ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ Form::open(['route' => ['product-galleries.destroy', $gallery->id], 'method' => 'delete', 'class' => 'd-inline']) }}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("are you sure?")']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center pt-4">There is no gallery in here</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection