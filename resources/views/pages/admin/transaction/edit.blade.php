@extends('layouts.admin.app')

@section('title', 'Edit Transaction: ' . $data['transaction']->uuid)

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Transaction </strong>
        </div>
        <div class="card-body card-block">
            {{ Form::open(['route' => ['transaction.update', $data['transaction']->id], 'method' => 'put']) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name of transaction') }}
                    {{ Form::text('name', null ?? $data['transaction']->name, ['placeholder' => 'input transaction name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null ?? $data['transaction']->email, ['placeholder' => 'input email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('phone', 'Phone Number') }}
                    {{ Form::text('phone', null ?? $data['transaction']->phone, ['placeholder' => 'input phone number', 'class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('phone')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {!! Form::textarea('address', null ?? $data['transaction']->address, ['placeholder' => 'input address', 'cols' => '10', 'rows' => '3', 'class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::submit('Create transaction', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
