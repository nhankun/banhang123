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
</style>
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
        <label for="image">
            <img src="{{ isset($category) ? asset($category->icon) : asset('uploads/defaults/providers/images/dfp.png') }}"
                id="imagePreview" alt="" width="50" height="40" style="display: block;margin-bottom: 1em;">
        </label>
        <input name="fileImage" id="image" type="file" style="display: none;" class="form-control-file"
               onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);onChangeCssValid(this,'form-control-file');">
        @error('fileImage')
        <div class="invalid-feedback">
            {{ $message }}.
        </div>
        @enderror
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
@if(isset($category))
    @foreach($category->propertyDefault as $property)
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
                    <span onclick="deleteProperty(this,'old_1');"><p class="btn btn-danger"><i class="fas fa-trash"></i></p></span>
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
<script !src="">
    $(window).bind("load",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        formValidate();
    });

    function onChangeCssValid(e,replaceVal) {
        $(e).attr('class',replaceVal);
        return true;
    }
    var c = 0;
    function addNewProperty() {
        c++;
        var new_property  = "<div class=\"row abc\" id=new_"+c+">\n" +
            "        <div class=\"col-md-4\">\n" +
            "            <input name=\"Property[new_"+c+"][property_name]\" id=\"nameProperty_"+c+"\" placeholder=\"name\" type=\"text\" onchange=\"onChangeCssValid(this,'form-control');\" class=\"form-control nameclassrule\">\n" +
            "        </div>\n" +
            "        <div class=\"col-md-4\">\n" +
            "            <input name=\"Property[new_"+c+"][property_value]\" id=\"value_"+c+"\" placeholder=\"value\" type=\"text\" onchange=\"onChangeCssValid(this,'form-control');\" class=\"form-control valueclassrule\">\n" +
            "          \n" +
            "        </div>\n" +
            "        <div class=\"col-md-4\">\n" +
            "            <div style=\"width: 100%;height:100%;vertical-align: middle\">\n" +
            "                <span onclick=\"deleteProperty(this,new_"+c+");\"><p class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></p></span>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>";

        $(".property-container").append(new_property);
    }

    function deleteProperty(e,id) {
        $(e).parents('.abc').remove();
    }

    function formValidate() {
        $.validator.addMethod("nRequired", $.validator.methods.required,
            "Tên thuộc tính không được rỗng");
        $.validator.addMethod("nMax", function(value, element) {
                return value.length < 200;
            },
            "Tên thuộc tính phải nhỏ hơn 200");

        $.validator.addMethod("vRequired", $.validator.methods.required,
            "Value không được rỗng");
        $.validator.addMethod("vMax", function(value, element) {
                return value.length < 200;
            },
            "Value phải nhỏ hơn 200");

        $.validator.addMethod("ncRequired", $.validator.methods.required,
            "Tên thuộc tính không được rỗng");

        $.validator.addClassRules({
            nameclassrule: {
                nRequired: true,
                nMax: true
            },
            valueclassrule: {
                vRequired: true,
                vMax: true
            },
            namecategoryrule: {
                ncRequired: true,
            },
        });

        $('#category-form').validate(
            {
                highlight: function(element) {
                    $(element).parent().addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).parent().removeClass('has-error');
                }

            });
    }

    $('#category-form').submit(function(){
        formValidate();
    });
</script>

