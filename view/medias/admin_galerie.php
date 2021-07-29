<div class="my-content">

    <div class="card shadow w-75">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajouter une Image</h6>
            <div class="d-flex flex-row mt-1">
                <form method="POST" id="add-id" enctype="multipart/form-data">
                    <input style="display: none;" id="file-input" name="add-picture[]" multiple type="file">

                </form>
                <button class="btn btn-success mr-md-1 " id="btn-action">Ajouter une image</button>

            </div>
        </div>
        <!--  -->
        <div class="picture-list" id="list-pic">
            <div id="target"></div>
            <?php foreach ($pic as $key => $value) : ?>
                <div class="card-thundail" id="<?= 'img_' . $value->id ?>">
                    <i class="fas fa-info-circle" onclick="getInfo(<?= $value->id ?>);" title="info image"></i>
                    <a class="pict-param example-image-link" href="<?= Router::webroot('img/' . $value->urlbig) ?>" data-lightbox="example-2" data-title="Optional caption.">
                        <img class="example-image" src="<?= Router::webroot('img/' . $value->urlsmall) ?>" alt="image-1" />
                    </a>
                </div>
            <?php endforeach ?>
        </div>

    </div>
    <form action="" id="panel-id" method="POST" enctype="multipart/form-data">




    </form>
</div>

<style>
    .my-content,
    .zone-tag {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;

    }

    .card-thundail {
        position: relative;
        display: inline-block;
        padding: 20px;
    }

    .card-thundail i {
        cursor: pointer;
        position: absolute;
        top: 15px;
        right: 5px;
        font-size: 20px;
        color: #3B9AFF;
    }


    .picture-list {

        display: flex;
        flex-direction: row;
        justify-content: end !important;
        flex-wrap: wrap;
        height: 70vh;
        overflow-y: auto;
        margin-left: 1vw;
    }

    .w-95 {
        width: 95%;
        margin-left: 10px;
    }

    .lable-op {
        margin-top: 5px;
        margin-left: 10px;
    }

    .pict-param,
    .pict-param img {
        display: inline-block;
        margin: 0;
        padding: 0;
        margin: 5px;
        transition: 1s;
        /* Animation */
        cursor: pointer;
        width: 150px;
        height: 150px;
        overflow: hidden;


    }

    .pict-param {
        overflow: hidden;
    }

    .pict-param img:hover {

        width: 180px;
        height: 180px;
    }

    .tag-app {
        padding: 10px;
        border-radius: 15px;
        min-width: 120px;
        text-align: center;
        margin: 5px;
        color: white;


    }

    .selected {
        background-color: #50B767;
    }

    .unselected {

        background-color: #1D8AFF;
    }

    #panel-id {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 400px;
        height: 80vh;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .detail-picture {
        width: 400px;
        height: 80vh;
    }
    .select{
       box-shadow: 5px 5px 5px blue;
    }
</style>


<script>
    let $url = <?= Router::url() ?>;
    let input = document.getElementById('file-input');
    let formInfoBlock = document.getElementById('panel-id');
    let selectDiv
    class InfoGalerie {

        id = 0;
        url = "";

        constructor(idPicture, baseUrl) {

            this.id = idPicture;
            this.url = baseUrl;
        }


        getInfo(callback) {

            $.getJSON(this.url + 'systeme/admin_getInfoGalerie/id:' + this.id, (data) => {

                console.log(data['results']);
                callback(this.#generatePanelInfo(data['results']));
            });
        }

        #generatePanelInfo(data) {
            var checked = "";
            if (data['info']['isgalerie'] == 1) {
                checked = "checked";
            }
            let panel = "";
            panel += '<input type="hidden" name="id" value="' + data['info']['id'] + '">'
            panel += '<div class="card shadow ">'
            panel += '      <div class="card-header py-3">'
            panel += '          <h6 class="m-0 font-weight-bold text-primary">Propriétés de l\'image</h6>'
            panel += '          <div class="d-flex flex-row mt-1">'
            panel += '              <input class="btn btn-success mr-md-1 " name="saveCategorie" type="submit" value="Mettre à jour l\'image " required>'
            panel += '              <a class="btn btn-danger  " onclick="deletePicture(' + data['info']['id'] + ');" ><i class="fas fa-trash-alt"></i> Supprimer</a>'
            panel += '          </div>'
            panel += '      </div>'
            panel += '      <div class="detail-picture" >'
            panel += '          <div id="report-id" ></div>'
            panel += '          <div>'
            panel += '              <label class="lable-op" for="titel-id">Titre de l\'image </label><br>'
            panel += '              <input class="w-95" type="text" value="' + data['info']['name'] + '" name="name" placeholder="Entrée un titre pour l\'image " id="titel-id" required >'
            panel += '          </div>'
            panel += '          <hr>'
            panel += '          <div>'
            panel += '              <label class="lable-op" for="isGalery-id">Afficher l\'image dans la galerie du site</label>'

            panel += '              <input type="checkbox" name="isgalerie" value="1" style="color:#ffff" ' + checked + '>'
            panel += '          </div>'
            panel += '          <hr>'
            panel += '          <div>'
            panel += '              <label class="lable-op" for="description-id">Description de l\'image </label><br>'
            panel += '              <textarea class="w-95" name="info" id="" cols="30" rows="10">' + data['info']['info'] + '</textarea>'
            panel += '          </div>'
            panel += '          <hr>'
            panel += '          <div class="zone-tag">'

            for (let index = 0; index < data['tagList'].length; index++) {

                const element = data['tagList'][index];
                let $select = "unselected";
                let check = "";
                console.log(data);
                for (let i = 0; i < data['info']['tagName'].length; i++) {

                    const element2 = data['info']['tagName'][i];

                    $select = "unselected";
                    check = "";
                    if (element2 == element['name_tag']) {
                        $select = 'selected';
                        check = 'checked'
                    }
                }

                panel += '    <div class="tag-app ' + $select + '">'
                panel += '       <input type="checkbox" name="tags[]" value="' + element['id'] + '" ' + check + '>'
                panel += '       <label for="">' + element['name_tag'] + '</label>'
                panel += '   </div>'

            }
            panel += '          </div>'
            panel += '    </div>'
            panel += '</div>'

            return panel;
        }
    }

    $(function() {


        document.getElementById('btn-action').addEventListener('click', () => {
            input.click();
        });

        /* vérifier le changement de statut d'entrée  */
        input.addEventListener('change', () => {

            let pic = [];

            /* generate placeholder */
            for (let index2 = 0; index2 < document.getElementById('file-input').files.length; index2++) {

                createPictureBlock((link) => {

                    if (link != "undefined") {

                        pic.push(link);
                        document.getElementById('target').before(pic[index2]);
                        console.log(pic)

                    }
                });
            }

            /* upload picture  */
            postAjax($url + 'systeme/uploadImg', 'add-id', (data) => {
				console.log(data);
                /* adds pictures to gallery */
                for (let index = 0; index < data['results'].length; index++) {

                    if (typeof(data['results'][index]['error']) == 'undefined') {

                        /* generate elements and add this elements in the Dom */
                        let myDiv = document.createElement('div');
                        myDiv.setAttribute('class', 'card-thundail');
                        myDiv.setAttribute('id', 'img_'+data['results'][index]['id']);

                        let myIcon = document.createElement('i');
                        myIcon.setAttribute('onclick', 'getInfo(' + data['results'][index]['id'] + ',)');
                        myIcon.setAttribute('class', 'fas fa-info-circle');

                        myDiv.appendChild(myIcon);

                        let myLink = '<img class="example-image" src="' + $url + 'img/' + data['results'][index]['urlsmall'] + '" ); alt="">';

                        pic[index].innerHTML = myLink;

                        pic[index].setAttribute('class', 'pict-param example-image-link');
                        pic[index].setAttribute('href', '' + $url + 'img/' + data['results'][index]['urlbig'] + '');

                        myDiv.appendChild(pic[index]);
                        document.getElementById('target').before(myDiv);

                    } else {
                        /* remove placeholder if upload fail */
                        pic[index].remove();
                    }

                }
                /* if placeholder is not use this is remove element in the dom */
                for (let index = 0; index < pic.length; index++) {
                    const element = pic[index];
                    element.remove;
                }
                pic = {};
            });

        });

        /* If the form is submitted send the new information related to the image*/
        $(formInfoBlock).submit((event) => {
            event.preventDefault();
            /* report-id */
            postAjax($url + 'systeme/setInfoPicture', 'panel-id', (data) => {
                console.log(data);
                let message = "";
                if (typeof(data['results']['error']) == 'undefined') {

                    message = '<span style="color:#ffff;text-align: center;">La sauvegarde des infos s\'est bien passé</span>'
                } else {
                    message = '<span style="color:#ffff;text-align: center;" >La sauvegarde des infos n\'a pas pu aboutir</span>'
                }
                getInfo(data['results']['id'], message);


            })


        })

    });

    /*Retrieves image information when clicked to display it*/
    function getInfo(id, $message = null, isError = false) {

        let info = new InfoGalerie(id, $url);

        info.getInfo((data) => {

            document.getElementById('panel-id').innerHTML = data

            if(selectDiv!=null){
                
                selectDiv.setAttribute('class',"card-thundail");
                selectDiv =null;
            }
             selectDiv = document.getElementById('img_'+id);
             selectDiv.setAttribute('class',"card-thundail select");


            if ($message != null) {



                let resultElement = document.getElementById('report-id');
                resultElement.setAttribute('class', ((isError) ? 'b-danger' : 'bg-success'))
                resultElement.innerHTML = $message
            }

        });

    }
    /* generate placeholder block */
    function createPictureBlock(lin) {

        let link = document.createElement('a');
        link.setAttribute('class', 'pict-param placeHolder');
        link.setAttribute('data-lightbox', 'example-2');
        link.setAttribute('data-title', 'Optional caption.');

        let img = document.createElement('img');

        img.setAttribute('src', 'https://via.placeholder.com/150');

        link.appendChild(img);

        lin(link);
    }

    /* This function is called to post data in AJAX*/
    function postAjax(url, idform, calback) {

        let myform = new FormData();

        if (idform != null) {

            myform = new FormData(document.getElementById(idform));

        }
        $.ajax({
            type: "POST",
            url: url,
            data: myform,
            processData: false,
            contentType: false,

            success: function(data) {

                calback(data);
            }
        });
    }

    function deletePicture(id, elementId) {

        postAjax($url + 'systeme/deleteImg/id:' + id, null, (reponse) => {

            if (reponse['results']['delete'] == true) {

                document.getElementById('img_' + id).remove();
                formInfoBlock.innerHTML = "";

            } else {

                let resultElement = document.getElementById('report-id');
                resultElement.setAttribute('class', ((isError) ? 'b-danger' : 'bg-success'));
                message = '<span style="color:#ffff;text-align: center;" >La suppression  de l\'image n\'a pas pu aboutir</span>';
                resultElement.innerHTML = message;
            }


        });


    }
</script>