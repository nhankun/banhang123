<style>
    .invalid-feedback{
        font-size: 15px;
        font-family: sans-serif;
    }
    .line{
        border-top: 3px solid #3f6ad8;
    }
    .title{
        color: #3f6ad8;
    }
    #imagePreview{
        margin: 0 !important;
    }
    .error{
        color: red;
    }
    .invalid-feedback{
        display: block !important;
    }
</style>
{{--@foreach ($errors->all() as $error)--}}
{{--    @if($errors->get('fileImage'))--}}
{{--    <li>{{ $error }}</li>--}}
{{--    @endif--}}
{{--@endforeach--}}
<h5 class="card-title title">Thông tin chung</h5>
<hr class="line">
<div class="row">
    <div class="position-relative form-group col-md-6">
        <label for="name" class="">Name</label>
        <input name="name" id="name" placeholder="name placeholder"
               value="{!! isset($category) ? $category->name : old('name')!!}" type="text"
               onchange="onChangeCssValid(this,'form-control');"
               class="form-control namecategoryrule @error('name') is-invalid @enderror">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}.
        </div>
        @enderror
    </div>
    <div class="position-relative form-group col-md-6">
        <span style="display: block;margin-bottom: 0.5em">Icon</span>
        <label for="fileImage">
            <img src="{{ isset($category) ? asset($category->icon) : asset('uploads/defaults/providers/images/dfp.png') }}"
                id="imagePreview" alt="" width="50" height="40" style="display: block;margin-bottom: 1em;">
        </label>
        <input name="fileImage" id="fileImage" type="file" style="display: none;" class="form-control-file"
               onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);onChangeCssValid(this,'form-control-file');">
{{--        @error('fileImage')--}}
{{--        <div class="invalid-feedback">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--        @enderror--}}
        @foreach ($errors->get('fileImage') as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
        <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a
            bit lighter and easily wraps to a new line.</small>
    </div>
</div>
<h5 class="card-title title">Thuộc tính mặc định</h5>
<hr class="line">
<div class="position-relative form-group property-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label for="nameProperty" class="">Name</label>
            </div>
            <div class="col-md-4">
                <label for="value" class="">Value</label>
            </div>
            <div class="col-md-4">
                <div style="width: 100%;height:100%;vertical-align: middle">
                    <span onclick="addNewProperty();"><p class="btn btn-primary">Thêm thuộc tính &nbsp;<i class="fas fa-plus-circle"></i></p></span>
                </div>
            </div>
        </div>
    </div>
@if(isset($propertyDefaults))
    @foreach($propertyDefaults as $key => $property)
        <div class="row abc" id="{!! $key !!}">
            <div class="col-md-4">
                <input name="Property[{!! $key !!}][property_name]" id="nameProperty_{!! $key !!}" placeholder="name" value="{!! isset($property) ? $property->property_name : old('nameProperty')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control nameclassrule">
            </div>
            <div class="col-md-4">
                <input name="Property[{!! $key !!}][property_value]" id="value_{!! $key !!}" placeholder="value" value="{!! isset($property) ? $property->property_value : old('value')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control valueclassrule">
            </div>
            <div class="col-md-4">
                <div style="width: 100%;height:100%;vertical-align: middle">
                    <span onclick="deleteProperty(this,{{$key}});"><p class="btn btn-danger"><i class="fas fa-trash"></i></p></span>
                </div>
            </div>
        </div>
    @endforeach
@endif
</div>
<hr class="line">
<div class="position-relative form-group row">
    <button type="submit" class="mt-1 btn btn-primary col-6">Save</button>
    <a href="{!! route('categories.index') !!}" class="mt-1 btn btn-light col-6">Back</a>
</div>
<script src="{!! asset('backs/admin/js/category.js') !!}"></script>

