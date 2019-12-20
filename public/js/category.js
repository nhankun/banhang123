$(window).bind("load", function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    formValidate();
});

function onChangeCssValid(e, replaceVal) {
    $(e).attr('class', replaceVal);
    return true;
}

function addNewProperty() {
    var c = $('.abc:last').attr('id');
    if (typeof c === 'undefined')
    {
        c = 0;
    }
    c++;
    var new_property = "<div class=\"row abc\" id=" + c + ">\n" +
        "        <div class=\"col-md-4\">\n" +
        "            <input name=\"Property[" + c + "][property_name]\" id=\"nameProperty_" + c + "\" placeholder=\"name\" type=\"text\" onchange=\"onChangeCssValid(this,'form-control');\" class=\"form-control nameclassrule\">\n" +
        "        </div>\n" +
        "        <div class=\"col-md-4\">\n" +
        "            <input name=\"Property[" + c + "][property_value]\" id=\"value_" + c + "\" placeholder=\"value\" type=\"text\" onchange=\"onChangeCssValid(this,'form-control');\" class=\"form-control valueclassrule\">\n" +
        "          \n" +
        "        </div>\n" +
        "        <div class=\"col-md-4\">\n" +
        "            <div style=\"width: 100%;height:100%;vertical-align: middle\">\n" +
        "                <span onclick=\"deleteProperty(this,null);\"><p class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></p></span>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "    </div>";

    $(".property-container").append(new_property);
}

function formValidate() {
    $.validator.addMethod("nRequired", $.validator.methods.required,
        "Tên thuộc tính không được rỗng");
    $.validator.addMethod("nMax", function (value, element) {
            return value.length < 200;
        },
        "Tên thuộc tính phải nhỏ hơn 200");

    $.validator.addMethod("vRequired", $.validator.methods.required,
        "Value không được rỗng");
    $.validator.addMethod("vMax", function (value, element) {
            return value.length < 200;
        },
        "Value phải nhỏ hơn 200");

    $.validator.addMethod("ncRequired", $.validator.methods.required,
        "Tên thuộc tính không được rỗng");
    $.validator.addMethod("ncMax", function (value, element) {
            return value.length < 200;
        },
        "Tên phải nhỏ hơn 200");

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
            ncMax: true
        },
    });

    $('#category-form').validate(
        {
            highlight: function (element) {
                $(element).parent().addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('has-error');
            }

        });
}

$('#category-form').submit(function () {
    formValidate();
});

function deleteProperty(e, id) {
    Swal.fire({
        title: 'Are you sure?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            if (id != null) {
                $(e).parents('#'+id).remove();
            } else {
                $(e).parents('.abc').remove();
            }
        }
    });
}
