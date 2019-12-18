<link rel="stylesheet" href="{!! asset('backs/admin/select2/dist/css/select2.min.css') !!}">
<script src="{!! asset('backs/admin/select2/dist/js/select2.min.js') !!}"></script>

<div class="form-row">
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="category_id" class="">
                Category
            </label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                @foreach($categories as $category)
                    <option value="{!! $category->id !!}"
                            @if(isset($product) && ($product->category_id == $category->id))
                                selected
                            @endif
                    >{!! $category->name !!}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative form-group">
            <label for="provider_id" class="">
                Provider
            </label>
            <select name="provider_id" id="provider_id" class="form-control @error('provider_id') is-invalid @enderror">
                @foreach($providers as $provider)
                    <option value="{!! $provider->id !!}"
                        @if( isset($product) && ($product->provider_id == $provider->id))
                            selected
                        @endif
                    >{!! $provider->name !!}</option>
                @endforeach
            </select>
            @if ($errors->has('provider_id'))
                <span class="text-danger">{{ $errors->first('provider_id') }}</span>
            @endif
        </div>
    </div>
</div>


<div class="position-relative form-group">
    <label for="name" class="">
        Name
    </label>
    <input name="name" id="name" type="text" value="{!! isset($product) ? $product->name : old('name') !!}"
           class="form-control @error('name') is-invalid @enderror">
    @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
</div>
<div class="position-relative form-group">
    <label for="quantity" class="">
        Quantity
    </label>
    <input name="quantity" id="quantity" type="number" value="{!! isset($product) ? $product->quantity : old('quantity') !!}"
           class="form-control @error('quantity') is-invalid @enderror">
    @if ($errors->has('quantity'))
        <span class="text-danger">{{ $errors->first('quantity') }}</span>
    @endif
</div>

<div class="position-relative form-group">
    <label for="price" class="">
        price
    </label>
    <input name="price" id="price" type="number" value="{!! isset($product) ? $product->price : old('price') !!}"
           class="form-control @error('price') is-invalid @enderror">
    @if ($errors->has('price'))
        <span class="text-danger">{{ $errors->first('price') }}</span>
    @endif
</div>

<div class="position-relative form-group">
    <label for="description" class="">
        Description
    </label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
{!! isset($product) ? $product->description : old('description') !!}
    </textarea>
    @if ($errors->has('description'))
        <span class="text-danger">{{ $errors->first('description') }}</span>
    @endif
</div>

<hr class="line">

<div class="position-relative form-row">
    <a href="{!! route('managerProduct.index') !!}" class="mt-1 btn btn-light col-6">Back</a>
    <button type="submit" class="mt-1 btn btn-primary col-6">Continue</button>
</div>

<script !src="">
    $('#category_id').select2();
    $('#provider_id').select2();
</script>

