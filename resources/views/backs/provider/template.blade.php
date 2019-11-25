{{--@if( $errors->any() )--}}
{{--    <div class="col-11">--}}
{{--        <ul class="alert alert-danger">--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
<style>
    .invalid-feedback{
        font-size: 15px;
        font-family: sans-serif;
    }
</style>
<div class="position-relative form-group">
    <label for="name" class="">Name</label>
    <input name="name" id="name" placeholder="name placeholder" value="{!! isset($provider) ? $provider->name : old('name')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}.
    </div>
    @enderror
</div>
<div class="position-relative form-group">
    <label for="Email" class="">Email</label>
    <input name="email" id="Email" placeholder="with a placeholder" value="{!! isset($provider) ? $provider->email : old('email')!!}" type="email" onchange="onChangeCssValid(this,'form-control');" class="form-control @error('email') is-invalid @enderror">
    @error('email')
    <div class="invalid-feedback">
        {{ $message }}.
    </div>
    @enderror
</div>
<div class="position-relative form-group">
    <label for="address" class="">address</label>
    <input name="address" id="address" placeholder="address placeholder" value="{!! isset($provider) ? $provider->address : old('address')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control @error('address') is-invalid @enderror">
    @error('address')
    <div class="invalid-feedback">
        {{ $message }}.
    </div>
    @enderror
</div>
<div class="position-relative form-group">
    <label for="tel" class="">tel</label>
    <input name="tel" id="tel" placeholder="tel placeholder" value="{!! isset($provider) ? $provider->tel : old('tel')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control @error('tel') is-invalid @enderror">
    @error('tel')
    <div class="invalid-feedback">
        {{ $message }}.
    </div>
    @enderror
</div>
<div class="position-relative form-group">
    <label for="website" class="">website</label>
    <input name="website" id="website" placeholder="website placeholder" value="{!! isset($provider) ? $provider->website : old('website')!!}" type="text" onchange="onChangeCssValid(this,'form-control');" class="form-control @error('website') is-invalid @enderror">
    @error('website')
    <div class="invalid-feedback">
        {{ $message }}.
    </div>
    @enderror
</div>
<div class="position-relative form-group row">
    <div class="col-md-4">
        <label for="image" class="">image</label>
        <input name="fileImage" id="image" type="file" class="form-control-file @error('fileImage') is-invalid @enderror"  onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);onChangeCssValid(this,'form-control-file');">
        @error('fileImage')
        <div class="invalid-feedback">
            {{ $message }}.
        </div>
        @enderror
        <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
    </div>
    <div class="col-md-8">
        <label for="imagePreview">Image preview</label>
        <img src="{{ isset($provider) ? asset($provider->image) : asset('uploads/defaults/providers/images/dfp.png') }}" id="imagePreview" alt="" width="140" style="display: block;margin-bottom: 1em;">
    </div>
</div>
<div class="position-relative form-group row">
    <button class="mt-1 btn btn-primary col-6">Save</button>
    <a href="{!! route('providers.index') !!}" class="mt-1 btn btn-light col-6">Back</a>
</div>
<script !src="">
    function onChangeCssValid(e,replaceVal) {
        $(e).attr('class',replaceVal);
        return true;
    }
</script>

