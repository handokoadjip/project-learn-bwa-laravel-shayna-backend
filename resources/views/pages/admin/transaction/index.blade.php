@extends('layouts.admin.app')

@section('title', 'Transaction')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">List Transactions </h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Grand Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['transactions'] as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->name }}</td>
                                        <td>{{ $transaction->phone }}</td>
                                        <td>@_currency($transaction->total)</td>
                                        <td>
                                            @switch($transaction->status)
                                                @case('PENDING')
                                                    @php $status = 'warning' @endphp
                                                    @break
                                                    
                                                @case('SUCCESS')
                                                    @php $status = 'success' @endphp
                                                    @break
                                                    
                                                @default
                                                    @php $status = 'danger' @endphp
                                                    @break            
                                            @endswitch
                                            <span class="badge badge-{{ $status }}">{{ $transaction->status }}</span>
                                        </td>
                                        <td>
                                            @if ($transaction->status === 'PENDING')
                                                <a href="{{ route('transaction.status', $transaction->id ) }}?status=SUCCESS" class="btn btn-sm btn-success">
                                                    <i class="fa fa-check"></i>
                                                </a>

                                                <a href="{{ route('transaction.status', $transaction->id ) }}?status=FAILED" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"  data-target="#transactionModal" data-remote="{{ route('transaction.show', $transaction->id) }}" data-title="Detail transaction {{ $transaction->uuid }}">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            {{ Form::open(['route' => ['transaction.destroy', $transaction->id], 'method' => 'delete', 'class' => 'd-inline']) }}
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

<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin text-center"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('append-scripts')
    <script>
            jQuery(document).ready(function($){
                $('#transactionModal').on('show.bs.modal', function(e){
                    let button = $(e.relatedTarget)
                    let modal = $(this)

                    modal.find('.modal-body').load(button.data('remote'))
                    modal.find('.modal-title').html(button.data('title'))
                })
            })
    </script>
@endpush