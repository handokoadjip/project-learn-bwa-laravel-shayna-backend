@extends('layouts.admin.app')

@section('title', 'Products')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">List Product </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['products'] as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        {{-- appserviceprovider --}}
                                        <td>@currency($product->price)</td>
                                        <td>
                                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-picture-o"></i>
                                            </a>
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {{ Form::open(['route' => ['product.destroy', $product->id], 'method' => 'delete', 'class' => 'd-inline']) }}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("are you sure?")']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center pt-4">There is no product in here</td>
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