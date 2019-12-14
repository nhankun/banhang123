<style>
    .img-thumbnail {
        padding: 0.7em;
    }

    .img-panel {
        border: 2px solid #eee;
        padding: 1em 0 0 0;
    }
    .widget-img-panel{

    }
</style>

<div class="row img-panel">
    @if(isset($images))
        @foreach($images as $image)
            <div class="col-md-2 widget-img-panel" id="{!! $image->id !!}">
                <label for="fileImage">
                    <img src="{!! asset($image->link) !!}" class="img-thumbnail" style="width:192px; height:192px;" alt="{!! $image->title !!}">
                    <div class="row justify-content-center mt-2">
                        <p class="btn btn-danger mb-0" onclick="deleted(this,{!! $image->id !!})"><i class="fa fa-trash-alt"></i></p>
                    </div>
                </label>
            </div>
        @endforeach
    @endif
    <div class="place"></div>

    <div class="col-md-2 image_add mb-3">
        <label for="fileImage_add">
            <img src="{!! asset('images/image_add.png') !!}" class="img-thumbnail" style="width:192px; height:192px;"
                 alt="">
        </label>
        <div class="js-add-file">
            <input type="file" name="fileImages[]" id="fileImage_add" style="display: none"
               onChange="imagePreviews(this,'place',0)" multiple>
        </div>
    </div>

</div>

<hr class="line">

<div class="position-relative form-row">
    <a href="{!! route('products.index') !!}" class="mt-1 btn btn-light col-6">Back</a>
    <button type="submit" class="mt-1 btn btn-primary col-6" onclick="uploadImage();">Continue</button>
</div>
<script>
    var i = 0;
    var filesToUpload = new Array();
    function imagePreviews(input,PlaceInsertImagePreview,hidden_id) {
        var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
        if(input.files){
            var k=0;
            let fileAmount = input.files.length;
            for(g = 0 ; g < fileAmount;g++)
            {
                let file= input.files[g];
                let name = input.files[g].name;
                var fileNameExt = name.substr(name.lastIndexOf('.') + 1);
                var FileSize = input.files[g].size / 1024 / 1024; // in MB
                if (FileSize > 40) {
                    Swal.fire('files big ^_^');
                    break;
                }
                if ($.inArray(fileNameExt, validExtensions) == -1) {
                    input.value = '';
                    Swal.fire('image_file'+validExtensions.join(', '));
                    break;
                }
                filesToUpload.push({
                    id: k,
                    file: file
                });
                addFileImage();
                readerFileImages(k,name,hidden_id,PlaceInsertImagePreview,file);
                k++;
            }
            console.log(filesToUpload);
        }
    }

    function readerFileImages(k,name,hidden_id,placeToInsertImagePreview,file){
        var reader = new FileReader();
        reader.onload = function(event)
        {
            var markup1 = `<div class="col-md-2 widget-img-panel" id="${k}">
                <label for="fileImage">
                    <img src="${event.target.result}" class="img-thumbnail" style="width:192px; height:192px;" alt="">
                <div class="row justify-content-center mt-2">
                        <p class="btn btn-danger mb-0" onclick="deleted(this,null)"><i class="fa fa-trash-alt"></i></p>
                    </div>
                </label>
            </div>
               <div class="place"></div>`;
            $('.'+placeToInsertImagePreview).replaceWith(markup1);
        };
        reader.readAsDataURL(file);
    }

    function uploadImage()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var form_data = new FormData();
        for (var i = 0, len = filesToUpload.length; i < len; i++) {
            form_data.append("files[]", filesToUpload[i].file);
        }
        var action = $("form").attr('action');
        $.ajax({
            method: "POST",
            url: action,
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                filesToUpload = [];
                Swal.fire({
                    type: 'success',
                    title: 'save_file',
                    showConfirmButton: false,
                    timer: 2500
                })
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function addFileImage()
    {
        $("input[name='fileImages[]']").removeAttr("id");
        var markup2 = `<input type="file" name="fileImages[]" id="fileImage_add" style="display: none"
               onChange="imagePreviews(this,'place',0)" multiple>`;
        $(".js-add-file").append(markup2);
    }

    function deleted(e,id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $(e).preventDefault();
        var domain = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
        var action = domain+"/admin/products/image/delete/"+id;
        console.log(action);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                if(id != null)
                {
                    console.log(id);
                    $.ajax({
                        method: "POST",
                        url: action,
                        data: {id:id},
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            filesToUpload = [];
                            $(e).parent().parent().parent().remove();
                            Swal.fire({
                                type: 'success',
                                title: 'save_file',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }else {
                    $(e).parent().parent().parent().remove();
                }
            }
        });
    }


    function addElementImages() {
        let element = `<div class="col-md-2 mb-3">
                <label for="fileImage_${i}">
                    <img src="{!! asset('uploads/defaults/providers/images/asusLogo.png') !!}" class="img-thumbnail" style="width:192px; height:192px;" alt="">
                </label>
                <input type="file" name="fileImages_${i}" id="fileImage_${i}" style="display: none">
            </div>
    <div class="place"></div>`;
        $('.place').replaceWith(element);
        i++;
    }
</script>


