@extends('layouts.admin.app')

@section('title', 'Edit Galery: ' .  $data['product']->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Product</strong>
        </div>
        <div class="card-body card-block">
            {{ Form::open(['route' => ['product.update', $data['product']->id], 'method' => 'put']) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name of Product') }}
                    {{ Form::text('name', null ?? $data['product']->name, ['placeholder' => 'input product name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('type', 'Type Product') }}
                    {{ Form::text('type', null ?? $data['product']->type, ['placeholder' => 'input product type', 'class' => $errors->has('type') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description Product') }}
                    {!! Form::textarea('description', null ?? $data['product']->description, ['placeholder' => 'input description', 'cols' => '10', 'rows' => '3', 'class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('quantity', 'Quantity Product') }}
                    {{ Form::number('quantity', null ?? $data['product']->quantity, ['placeholder' => 'input product quantity', 'class' => $errors->has('quantity') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('quantity')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label('price', 'Price') }}
                    {{ Form::text('price', null ?? 'Rp. ' . number_format($data['product']->price,0,',','.'), ['placeholder' => 'input product price', 'class' => $errors->has('price') ? 'form-control is-invalid' : 'form-control']) }}
                    @error('price')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::submit('Create Product', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('append-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description'), {
        removePlugins: ['ImageUpload']
    })

    let tanpa_rupiah = document.getElementById('price');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix)
    {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

@endpush