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
{{--<h5 class="card-title title">Thuộc tính mặc định</h5>--}}
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
        @foreach($propertyDefaults as $property)
            <div class="row abc" id="{!! $property->id !!}">
                <div class="col-md-4">
                    <input name="Property[new_{!! $property->id !!}][property_name]" id="nameProperty_{!! $property->id !!}" placeholder="name" value="{!! isset($property) ? $property->name : old('nameProperty')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control nameclassrule @error('nameProperty') is-invalid @enderror">
                    @error('nameProperty')
                    <div class="invalid-feedback">
                        {{ $message }}.
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <input name="Property[new_{!! $property->id !!}][property_value]" id="value_{!! $property->id !!}" placeholder="value" value="{!! isset($property) ? $property->value : old('value')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control valueclassrule @error('value') is-invalid @enderror">
                    @error('value')
                    <div class="invalid-feedback">
                        {{ $message }}.
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div style="width: 100%;height:100%;vertical-align: middle">
                        <span onclick="deleteProperty(this,{{$property->id}});"><p class="btn btn-danger"><i class="fas fa-trash"></i></p></span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if(isset($properties))
        @foreach($properties as $property)
            <div class="row abc" id="{!! $property->id !!}">
                <div class="col-md-4">
                    <input name="Property[{!! $property->id !!}][property_name]" id="nameProperty_{!! $property->id !!}" placeholder="name" value="{!! isset($property) ? $property->name : old('nameProperty')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control nameclassrule @error('nameProperty') is-invalid @enderror">
                    @error('nameProperty')
                    <div class="invalid-feedback">
                        {{ $message }}.
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <input name="Property[{!! $property->id !!}][property_value]" id="value_{!! $property->id !!}" placeholder="value" value="{!! isset($property) ? $property->value : old('value')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control valueclassrule @error('value') is-invalid @enderror">
                    @error('value')
                    <div class="invalid-feedback">
                        {{ $message }}.
                    </div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div style="width: 100%;height:100%;vertical-align: middle">
                        <span onclick="deleteProperty(this,{{$property->id}});"><p class="btn btn-danger"><i class="fas fa-trash"></i></p></span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div>
<hr class="line">
<div class="position-relative form-group row">
    <a href="{!! route('images.index') !!}" class="mt-1 btn btn-light col-6">Back</a>
    <button type="submit" class="mt-1 btn btn-primary col-6">Save</button>
</div>
<script !src="">
    var url_delete_property = "{!! route('property.delete') !!}";
</script>
<script src="{!! asset('backs/admin/js/property.js') !!}"></script>

