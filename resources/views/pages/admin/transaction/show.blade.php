<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $data['transaction']->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $data['transaction']->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $data['transaction']->phone }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ $data['transaction']->address }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ $data['transaction']->status }}</td>
    </tr>
    <tr>
        <th>Product</th>
        <td>
            <table class="table table-bordered w-100">
                
                <tr>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Price</th>
                </tr>
                @foreach ($data['transaction']->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->type }}</td>
                        <td>@currency($detail->product->price)</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
<div class="row">
    <div class="col-4">
        <a href="{{ route('transaction.status', $data['transaction']->id) }}?status=PENDING" class="btn btn-block btn-warning">
            <i class="fa fa-spinner"></i> set Pending
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transaction.status', $data['transaction']->id) }}?status=SUCCESS" class="btn btn-block btn-success">
            <i class="fa fa-check"></i> set Success
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transaction.status', $data['transaction']->id) }}?status=FAILED" class="btn btn-block btn-danger">
            <i class="fa fa-times"></i> set Failed
        </a>
    </div>
</div>