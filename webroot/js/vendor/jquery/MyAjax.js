class toolJs {

    constructor() {

    }

    /* class a mettre sir les element customE
        sur l'imput file mettre id inputI
    */
    elementsToFormData(formData) {

        form = new FormData();

        input = document.getElementById('inputI');
        if (typeof (input != "undefined")) {

            file = $(input).prop('files')[0];
            form.append('file', file);
        }


        $('.customE').each(function () {

            if ($(this).val() != '') {

                form.append($(this).attr('data'), $(this).val());

            } else if ($(this).text() != '') {

                form.append($(this).attr('data'), $(this).text());

            } else {

                form.append($(this).attr('data'), 'endefine');
            }



        })
        formData(form);

    }

    /* This function is called to post data in AJAX*/
    postAjax(url, idform = null, calback) {

        let myform = new FormData();

        if (idform != null && typeof (idform) == 'string') {

            myform = new FormData(document.getElementById(idform));

        } else if (idform != null && typeof (idform) == 'object') {

            myform = idform;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: myform,
            processData: false,
            contentType: false,

            success: function (data) {

                calback(data);
            }
        });
    }


    getSiezeImg(input, targetW, targetH) {
        file = input.files[0];
        window.URL = window.URL || window.webkitURL;
        img = new Image();

        img.onload = function () {
            if (img.width > targetW || img.height > targetH) {
                errorSieze(img.width - targetW, img.height - targetH);
            }
        }
        img.src = window.URL.createObjectURL(file);
    }

    errorSieze(width, height) {
        let str = "votre image est trop "
        if (width > 0) { str += "large de " + width + "px"; }
        if (width > 0 && height > 0) { str += " et trop "; }
        if (height > 0) { str += "haute de " + height + "px."; }
        alert(str);
    }

    linkInputToImg(input, idImg) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + idImg).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}



