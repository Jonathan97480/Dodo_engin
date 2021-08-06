<?php
/* debug($categorie); */

if (!isset($categorie)) {

    $categorie = $this->Session->getFormReturn();

    if ($categorie == false) {

        $categorie = new stdClass();
        $categorie->name = "";
        $categorie->description = "";
        $categorie->img = "";
        $categorie->id = "";
        $categorie->tag = "";
    }
}
?>
<form action="<?= (empty($categorie->id)) ? Router::url('systeme/admin_add_categorie') : Router::url('systeme/admin_add_categorie/id:' . $categorie->id)  ?>" method="POST" enctype="multipart/form-data">
    <div class="card shadow w-75">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= (empty($categorie->id)) ? 'Ajouter une categorie' : 'Editer une categorie' ?></h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-md-1 " name="saveCategorie" type="submit" value="<?= (empty($categorie->id)) ? 'Sauvgarder' : 'Mettre à jour la categorie' ?>" required>
                <?php if (!empty($categorie->id)) : ?>
                    <a class="btn btn-danger  " href="<?= Router::url('systeme/deleteCategorie/id:' . $categorie->id) ?>"><i class="fas fa-trash-alt"></i> Supprimer</a>
                <?php endif ?>

            </div>
        </div>

        <div class="card-body row m-auto w-75">
            <div class="table-responsive  w-50">

                <div class="form-group ">
                    <label for="Titre" class="w-25">Titre</label>
                    <input type="text" name="name" class="form-control" value="<?= $categorie->name ?>" id="titre_categorie" placeholder="Titre de la categorie" required>
                </div>
                <div class="form-group ">
                    <label for="tag-p">Categorie parent selection</label><br>
                    <select name="categorie_parent" id="tag-p" style="width: 100%;">
                        <option value="NULL">Aucun Parent</option>
                        <?php foreach ($allCategorie as $key => $value) :     ?>
                            <option value="<?= $value->id ?>" <?= (isset($categorie->categorie_parent) && $value->id == $categorie->categorie_parent) ? 'selected' : "" ?>><?= $value->name ?></option>
                        <?php endforeach ?>
                    </select><!-- end select parent categorie -->
                </div>
                <div class="form-group ">
                    <label for="Descritption" class="w-25">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="10" required><?= $categorie->description ?></textarea>

                </div>

            </div>
            <div class="ml-5 zone-select">

                <div class="zone-thundail">

                    <label for="">Icon de la categorie</label>

                    <input type="file" style="display: none;" name="thumbnail" id="img-file" accept="image/x-png,image/gif,image/jpeg">

                    <img onclick="addImg()" id="img-id" src="<?= (empty($categorie->img)) ? Router::webroot('img/defaultImg') : Router::webroot($categorie->img) ?>">

                    <br> <small>cliker sur l'image pour la changer</small>

                </div><!-- end thundail zone -->

            </div><!-- end zone select & thundai -->
        </div>
    </div>
    <?php if (isset($categorie->child)  && !empty($categorie->child)) : ?>
        <div class="child ">
            <div class="card shadow w100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des categories enfant </h6>

                </div>

                <div class="zoneCantentChild">
                    <?php foreach ($categorie->child as $key => $value) : ?>
                        <div class="ct1">
                            <div class="b-left">
                                <?= $value->name ?><span><a title="éditer la categorie" href="<?= Router::url('systeme/admin_add_categorie/id:' . $value->id) ?>"><i class="fas fa-edit"></i></a>
                                    <a title="retirait de la liste des enfants" href="<?= Router::url('systeme/clearCategorie/id:' . $categorie->id . '/idCat:' . $value->id) ?>"><i class="fas fa-minus"></i></a></span>
                            </div>
                        </div>

                        <?= getchild($value->child, $categorie) ?>

                </div>
                <hr>
            <?php endforeach ?>
            </div>
        </div>

        </div><!-- children zone -->
    <?php endif ?>
</form>

<style>
    .zone-thundail {
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-evenly;
    }

    .ct1 {
        display: flex;
    }

    .b-left,
    .b-right p {
        margin: 10px;

        display: inline-block;
        color: white;
        padding: 5px;
        border: solid black;
        border-radius: 15px;
        margin: 0;
    }

    .b-right {
        display: inline-block;
        margin-left: 50px;

    }

    .b-right p {

        background-color: #E02D1B;
        margin-top: 2px;

    }

    .b-left {
        float: left;
        background-color: #17A673;
        margin-top: 5px;
        margin-left: 10px;
    }

    .b-left span,
    .b-right p>span {

        margin: 5px;
    }

    .b-left span i,
    .b-right p>span i {

        margin: 2px;

    }

    #img-id {
        margin: auto;
        width: 100px;
        border-radius: 50%;
    }

    .zone-select select {
        width: 100%;

    }

    .child {
        width: 25%;
        margin-left: 20px;

    }

    form {
        display: flex;
        flex-direction: row;
        overflow-y: auto;
        max-height: 75vh;
        margin-bottom: 20px;

    }

    .zoneCantentChild {
        min-height: 65vh;
        max-height: 65vh;
        overflow-x: auto;
        width: 100%;

    }
</style>
<script>
    let input = document.getElementById('img-file');

    function addImg() {
        input.click();
    }

    $(function() {
        let tool = new toolJs();
        input.addEventListener('change', () => {
            tool.linkInputToImg(input, 'img-id');
        });

    })
</script>


<?php
function getchild($cat, $categorie)
{
    if (!empty($cat)) {
        foreach ($cat as $key => $value) {

            $c = '  <div class="b-right">
        <p>
            ' . $value->name . ' <span><a title="éditer la categorie" href="' . Router::url('systeme/admin_add_categorie/id:' . $value->id) . '"><i class="fas fa-edit"></i>
            </a><a title="retirait de la liste des enfants" href="' . Router::url('systeme/clearCategorie/id:' . $categorie->id . '/idCat:' . $value->id) . '"><i class="fas fa-minus"></i></a></span>
        </p>
        ';
            foreach ($value->child as $key => $value2) {
                $c .= getchild($value2, $categorie) . '</div>';
            }


            /*   $c .= '</div> '; */
        }
        return $c;
    }
}
?>