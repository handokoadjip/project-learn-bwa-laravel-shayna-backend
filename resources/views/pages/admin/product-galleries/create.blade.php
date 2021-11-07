@extends('layouts.admin.app')

@section('title', 'Create Galery')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add Product Gallery</strong>
        </div>
        <div class="card-body card-block">
            {{ Form::open(['route' => 'product-galleries.store', 'method' => 'post', 'files' => true]) }}
                <div class="form-group">
                    {{ Form::label('product_id', 'Name of Product') }}
                    {{ Form::select('product_id', $data['products'], null, ['placeholder' => 'Choose product', 'class' => $errors->has('product_id') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('product_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('image', 'Upload Image') }}
                    {{ Form::file('image', ['class' => $errors->has('image') ? 'form-control is-invalid h-100' : 'form-control h-100']) }}
                    @error('image')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">  
                    {{ Form::label('default', 'Default Image ?') }}
                    @if($errors->has("is_default"))
                        <small class="text-danger">({{ $errors->first("is_default") }})</small>
                    @endif
                    
                    <div class="custom-control custom-radio">                        
                        {!! Form::radio("is_default", 1, false, ['class' => 'custom-control-input', 'id' => "yes"]) !!}
                        {{ Form::label('yes', 'Yes', ['class' => 'custom-control-label']) }}
                        
                    </div>
                    
                    <div class="custom-control custom-radio">                        
                        {!! Form::radio("is_default", 0, false, ['class' => 'custom-control-input', 'id' => "no"]) !!}
                        {{ Form::label('no', 'No', ['class' => 'custom-control-label']) }}
                    </div>    
                </div>
                <div class="form-group">
                    {{ Form::submit('Create Gallery', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection