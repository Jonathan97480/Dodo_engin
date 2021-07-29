<?php


if (!isset($tag)) {

    $tag = $this->Session->getFormReturn();

    if ($tag == false) {

        $tag = new stdClass();
        $tag->name_tag = "";
        $tag->description_tag = "";
        $tag->url_tag = "";
        $tag->id = "";
    }
}
?>
<form action="<?= (empty($tag->id)) ? Router::url('systeme/admin_add_tag') : Router::url('systeme/admin_add_tag/id:' . $tag->id)  ?>" method="POST" enctype="multipart/form-data">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= (empty($tag->id)) ? 'Ajouter un tag' : 'Editer un tag' ?></h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-md-1 " name="savetag" type="submit" value="<?= (empty($tag->id)) ? 'Sauvgarder' : 'Mettre à jour le tag' ?>" required>
                <?php if (!empty($tag->id)) : ?>
                    <a class="btn btn-danger  " href="<?= Router::url('systeme/deleteTag/id:' . $tag->id) ?>"><i class="fas fa-trash-alt"></i> Supprimer</a>
                <?php endif ?>

            </div>
        </div>

        <div class="card-body row m-auto w-75">
            <div class="table-responsive  w-50">

                <div class="form-group ">
                    <label for="Titre" class="w-25">Titre</label>
                    <input type="text" name="name" class="form-control" value="<?= $tag->name_tag ?>" id="titre_dag" placeholder="Titre du tag" required>
                </div><!-- end input titel -->

                <div class="form-group ">
                    <label for="Descritption" class="w-25">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="10" required><?= $tag->description_tag ?></textarea>

                </div><!-- end textarea description -->

            </div><!-- end table responsive -->
            <div class="ml-5 zone-select">

                <div class="zone-thundail">
                    <label for="">Icon du tag</label>
                    <input type="file" style="display: none;" name="thumbnail" id="img-file" accept="image/x-png,image/gif,image/jpeg" >
                    <img onclick="addImg()" id="img-id" src="<?= (empty($tag->url_tag)) ? Router::webroot('img/defaultImg') : Router::webroot('img/' . $tag->url_tag) ?>">
                    <br> <small>cliker sur l'image pour la changer</small>

                </div><!-- end thundail zone -->

            </div><!-- end zone select & thundai -->
        </div><!-- end first carrd  -->

</form> <!-- end form main -->

<style>
    .zone-thundail {
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-evenly;
    }

    .zone-select select {
        width: 100%;

    }

    #img-id {
        margin: auto;
        width: 100px;
        border-radius: 50%;
    }
</style>

<script>
    let input = document.getElementById('img-file');

    function addImg() {
        input.click();
    }
    $(function() {
        let input = document.getElementById('img-file');
        let tool = new toolJs();
        input.addEventListener('change', () => {
            tool.linkInputToImg(input, 'img-id');
        });

    })
</script>