<?php


if (!isset($rgpd)) {

    $rgpd = $this->Session->getFormReturn();

    if ($rgpd == false) {
        $rgpd = new stdClass();
        $rgpd->description = "";
    }
}

?>
<!-- RGPD POPUP -->
<div class="card shadow mb-4">
    <form action="<?= Router::url('admin/systeme/admin_rgpd') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="rgpd" value="rgpd">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">RGPD Popup Texte</h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-md-1 " name="save" type="submit" value=" Mettre à jour le Texte" required>

            </div>
        </div>

        <div class="card-body row m-auto w-75">
            <div class="table-responsive   my-flex">


                <div class="form-group ">
                    <label for="Descritption" class="w-25">Texte</label>
                    <textarea class="form-control zone-text" name="info" id="" cols="30" rows="10"><?= $rgpd->description ?></textarea>

                </div><!-- end textarea description -->
                <div class="description">
                    <h6>Définition du mot RGPD</h6>
                    <p>
                        Le règlement UE 2016/679 du Parlement Européen et du Conseil du 27 avril 2016 relatif
                        à la protection des personnes physiques à l'égard du traitement des données à caractère
                        personnel et à la libre circulation de ces données, et abrogeant la directive 95/46/CE
                        dit règlement général sur la protection des données (RGPD, ou encore GDPR, de l'anglais
                        General Data Protection Regulation), est un règlement de l'Union européenne qui constitue
                        le texte de référence en matière de protection des données à caractère personnel1.
                        Il renforce et unifie la protection des données pour les individus au sein de l'Union
                        européenne.
                    </p>
                </div>

            </div><!-- end table responsive -->

        </div>

    </form> <!-- end form main -->
</div><!-- end first carrd  -->
<br>
<?php

if (!isset($legal_notive)) {

    $legal_notive = $this->Session->getFormReturn();

    if ($legal_notive == false) {
        $legal_notive = new stdClass();
        $legal_notive->description = "";
    }
}
?>
<!-- MENTION LEGALE -->
<div class="card shadow mb-4">
    <form action="<?= Router::url('admin/systeme/admin_rgpd') ?>" method="POST" enctype="multipart/form-data">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mention Légale Texte</h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-md-1 " name="save" type="submit" value=" Mettre à jour les mention légale" required>

            </div>
        </div>

        <div class="card-body row m-auto w-75">
            <div class="table-responsive   my-flex">


                <div class="form-group ">
                    <label for="Descritption" class="w-25">Texte</label>
                    <textarea class="form-control zone-text" name="info" id="" cols="30" rows="10"><?= $legal_notive->description ?></textarea>

                </div><!-- end textarea description -->

                <div class="description">
                    <h6>Définition du mot Mentions légales</h6>
                    <p>
                        Les mentions légales désignent les mentions obligatoires qui doivent apparaître sur tout
                        support de communication. Les mentions légales d'un site internet servent à assurer une
                        certaine transparence, à rassurer les internautes sur l'identité de celui qui émet les
                        informations. La personne morale ou physique devient l'éditeur du site et est responsable
                        de son contenu.
                    </p>
                </div>

            </div><!-- end table responsive -->
        </div>



    </form> <!-- end form main -->
</div><!-- end first carrd  -->
<style>
    .my-flex {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .description {

        margin-left: 20px;
    }

    .zone-select select {
        width: 100%;

    }

    .zone-text {
        width: 30vw;
        height: 75%;
    }

    #img-id {
        margin: auto;
        width: 100px;
        border-radius: 50%;
    }
</style>

<script>
    $(function() {
        tinymce.init({
            selector: '.zone-text',
            height: 300,
            width: 600,

            plugins: [

                "searchreplace  code ",
                "insertdatetime media paste ", "inlinepopus"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
            content_css: '//www.tiny.cloud/css/codepen.min.css',

        });
    })
</script>