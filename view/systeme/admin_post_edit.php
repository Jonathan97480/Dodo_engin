<?php
/*   die(debug($this))  */
if (!isset($post)) {

    if ($this->Session->getFormReturn()) {

        $post = $this->Session->getFormReturn();
    } else {
        $post = new stdClass();
        $post->id = "";
        $post->name = "";
        $post->idCat = "";
        $post->description = "";
        $post->img_description = "";
        $post->content = "";
        $post->online = "";
        $post->type = "";
    }
}
?>


<form action="<?= (isset($post->id) && $post->id != "") ? Router::url('systeme/admin_post_edit/id:' . $post->id) : Router::url('systeme/admin_post_edit') ?>" enctype="multipart/form-data" method="POST">
    <div class="mycontent">
        <div class="zoneText card shadow ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= (empty($post->id)) ? 'Ajouter un Article' : 'Editer un Article' ?></h6>
                <div class="d-flex flex-row mt-1">
                    <input class="btn btn-success mr-md-1 " name="saveArticle" type="submit" value="<?= (empty($post->id)) ? 'Sauvgarder' : 'Mettre à jour l\'article' ?>">
                    <?php if (!empty($post->id)) : ?>
                        <a class="btn btn-danger  " href="<?= Router::url('systeme/admin_deletePost/id:' . $post->id)  ?>"><i class="fas fa-trash-alt"></i> Supprimer</a>
                    <?php endif ?>

                </div>
            </div>
            <!-- id hidden impud-->
            <div class="form-group">
                <label for="label-titel " class="h5" style="margin: 15px 0 0 15px;" class="col-form-label col-form-label-sm h4">*Titre de l'article</label>
                <small id="titelHelpInline" style="margin: 15px 0 0 15px;" class="text-muted h5">0/100</small>
                <input type="text" class="h3" name="name" maxlength="100" value="<?= $post->name ?>" required placeholder="Donner un nom à votre poste" style="width: 99%;margin-left:7px" id="label-titel">
            </div>
            <input type="hidden" value=" <?= $post->id ?>" name="id">

            <label for="content" class="h5" style="margin: 15px 0 0 15px;" class="col-form-label col-form-label-sm h4">*Contenue de l'article</label><br>
            <textarea class="inputpost" style="height: 80vh;" id="content" name="content"><?= $post->content ?></textarea>

        </div>
        <div class="zone-params card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary h4">Parametre Article</h6>
            </div>
            <div class="content-params">
                <div class="">

                    <label class="h5" for="inputGroupSelect01">*Selection type de publication</label>
                    <br>

                    <select class=" w-75" name="type" id="inputGroupSelect01" required>

                        <option value="post" <?= ($post->type == "post") ? " selected" : "" ?>>Blog</option>
                        <option value="projet" <?= ($post->type == "projet") ? " selected" : "" ?>>Portfolio</option>
                    </select>
                </div>
                <hr>
                <div class=" ">
                    <div class="form-group">
                        <label for="label_online" class="col-form-label  h4">Mettre le document en ligne</label>
                        <input type="checkbox" name="online" id="label_online " <?= ($post->online == 1) ? 'checked' : '' ?>>

                    </div>
                    <hr>
                    <div class="form-group">

                        <label for="Vigniette" class="h5">Vigniette de l'article</label><br>
                        <small>Cliker sur l'image pour la changer</small>
                        <div class="mb-3">
                            <input type="file" style="display: none;" class="" class="custom-file-input" name="img" id="img-file">
                        </div>
                        <img class="thundail" onclick="addImg()" id="img_vigniette" src="<?= Router::webroot($post->img_description != "" && (file_exists(WEBROOTT . DS . 'img' . DS . $post->img_description)) ? 'img/' . $post->img_description : 'img/defaultImg.jpg') ?>" alt="">

                    </div>
                    <hr>
                    <div class="form-group w-100">
                        <label for="description" class="  h5">*Extrait de l'article</label>
                        <small id="descriptionHelpInline" class="text-muted h5">0/255</small>
                        <textarea required name="description" class="zone-description" maxlength="255" id="description"><?= $post->description ?></textarea>
                    </div>
                    <hr>
                    <div class="cat-select">

                        <label for="multiple">Sélection de Categories</label>

                        <!-- Getion des Categorie -->
                        <?php
                        if ($post->idCat != null) {
                            $post->idCat = explode(',', $post->idCat);
                        }
                        ?>

                        <select class="my-select" name="categorieListe[]" id="multiple" multiple>

                            <?php foreach ($allCategorie as $key => $value) : ?>

                                <?php

                                $selected = "";

                                if (is_array($post->idCat)) {

                                    foreach ($post->idCat as $key => $value2) {

                                        if ($value2 == $value->id) {

                                            $selected = "selected";

                                            break;
                                        }
                                    }
                                }

                                ?>

                                <option value="<?= $value->id ?>" <?= $selected ?>><?= $value->name ?></option>

                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
    let input = document.getElementById('img-file');

    $('#description').keyup(
        function() {
            var n_texte = $('#description').val();
            $('#descriptionHelpInline').text(n_texte.length + '/255')


        });

    $('#label-titel').keyup(
        function() {
            var n_texte = $('#label-titel').val();
            $('#titelHelpInline').text(n_texte.length + '/100')


        });
    $(function() {
        new SlimSelect({
            select: '#multiple'
        });
        tyniInit();
    });

    function tyniInit() {
        tinymce.init({
            selector: '.inputpost',
            height: 500,


            plugins: [
                "image",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools wordcount", "inlinepopus"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image",
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            relative_urls: false,
            images_upload_url: "<?= Router::url('admin/medias/upload') ?>",


            images_upload_handler: function(blobInfo, success, failure) {


                var xhr, formData;


                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', "<?= Router::url('admin/medias/upload') ?>");

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);
                    console.log(json);
                    if (!json || typeof json != 'string') {

                        failure('Invalid JSON: ' + xhr.responseText);
                        alert('Une erreur est survenue !\n\nCode :' + xhr.status + '\nTexte : ' + xhr.responseText);
                        return;
                    }

                    success(json);
                };

                formData = new FormData();

                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);

            },
            file_picker_callback: function(callback, value, meta) {
                tinymce.activeEditor.windowManager.openUrl({
                    title: 'File Manager',
                    url: "<?= Router::url('admin/medias/index') ?>",
                    onMessage: function(api, data) {
                        if (data.mceAction === 'customAction') {

                            callback(data.url);
                            api.close();
                        }
                    }
                });
            },


        });
    }


    function addImg() {
        input.click();
    }

    $(function() {

        let tool = new toolJs();
        input.addEventListener('change', () => {
            tool.linkInputToImg(input, 'img_vigniette');
        });

    })
</script>

<style>
    html,
    body {
        overflow: hidden;
        max-height: 100vh;
    }

    .container-fluid {
        max-height: 90vh !important;
        overflow-y: hidden !important;
    }

    form {
        max-height: 80vh;
        overflow-y: hidden;
    }

    .mycontent {
        display: flex;
        max-height: 80vh;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;

    }

    .zoneText {
        width: 65vw;
    }



    .zone-params {

        display: flex;
        flex-direction: column;
        text-align: center;
        max-height: 80vh;
        margin: 0 5px 0 5px;
        width: 350px;


    }

    #label_online {
        width: 50px;
        margin: 5px;
    }

    .thundail {
        width: 300px;
    }

    .zone-description {
        width: 90%;
        height: 200px;
    }

    .my-select {
        margin-bottom: 15px;
    }

    .content-params {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>