<?php
if ($this->Session->read('parametre')) {
    $user = $this->Session->read('parametre');
}
if (!isset($user)) {

    $user = new stdClass();
    $user->login = "";
    $user->email = "";
    $user->password = "";
    $user->name = "";
    $user->first_name = "";
    $user->zip_code = "";
    $user->city = "";
    $user->address = "";
    $user->address_2 = "";
    $user->phone = "";
    $user->avatar = "";
    $user->fk_role_id = "";
    $user->count_active = "";
    $user->t_users_id = "";
}

?>

<form action="<?= (empty($user->t_users_id)) ? Router::url('systeme/admin_add_user') :  Router::url('systeme/admin_add_user/id:' . $user->t_users_id) ?>" method="POST" enctype="multipart/form-data">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= ($user->t_users_id != '') ? 'Editer un utilisateur' : 'Ajouter un utilisateur' ?></h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-2 " name="saveUser" type="submit" value=" <?= ($user->t_users_id != '') ? 'Valider' : 'Sauvgarder' ?> ">
                <?php if ($user->t_users_id != "") : ?>
                    <a class="btn btn-danger " href="<?= Router::url('systeme/admin_deleteUser/id:' . $user->t_users_id) ?>">Supprimer</a>
                <?php endif ?>
            </div>
        </div>


        <div class="card-body row">
            <div class="table-responsive col-4">

                <div class="form-group ">
                    <label for="prenom_user" class="w-25">Prénom</label>
                    <input type="text" name="name" value="<?= $user->name ?>" class="form-control" id="prenom_user" placeholder="Votre Prenom" required>
                </div>
                <div class="form-group ">
                    <label for="mail_user" class="w-25">Email</label>
                    <input type="mail" name="email" value="<?= $user->email ?>" class="form-control" id="mail_user" placeholder="Votre Email" required>
                </div>
                <div class="form-group ">
                    <label for="adress1_user" class="w-25">Adresse 1</label>
                    <input type="text" name="address" value="<?= $user->address ?>" class="form-control" id="adress1_user" placeholder="Adresse 1" required>
                </div>
                <div class="form-group ">
                    <label for="codepostal_user" class="w-25">Code Postal</label>
                    <input type="number" name="zip_code" value="<?= $user->zip_code ?>" class="form-control" id="codepostal_user" placeholder="Votre Code Postal" required>
                </div>
                <div class="form-group ">
                    <label for="login" class="w-25">Login (exemple Fab974)</label>
                    <input type="text" value="<?= $user->login ?>" name="login" class="form-control" id="login" placeholder="Votre Login" required pattern="[a-zA-Z0-9_]{5,}">
                </div>

            </div>
            <div class="table-responsive col-4">

                <div class="form-group ">
                    <label for="nom_user" class="w-25">Nom</label>
                    <input type="text" value="<?= $user->first_name ?>" name="first_name" class="form-control" id="nom_user" placeholder="Votre Nom" required>
                </div>
                <div class="form-group ">
                    <label for="tel_user" class="w-25">Téléphone</label>
                    <input type="tel" value="<?= $user->phone ?>" name="phone" class="form-control" id="tel_user" placeholder="Votre Telephone" required>
                </div>
                <div class="form-group ">
                    <label for="adress2_user" class="w-25">Adresse 2</label>
                    <input type="text" value="<?= $user->address_2 ?>" name="address_2" class="form-control" id="adress2_user" placeholder="Votre Adresse" required>
                </div>
                <div class="form-group ">
                    <label for="ville_user" class="w-25">Ville</label>
                    <input type="text" name="city" value="<?= $user->city ?>" class="form-control" id="ville_user" placeholder="Votre Ville" required>
                </div>
                <div class="form-group ">
                    <label for="mdp_user" class="w-25">Mot de Passe (exemple Pass9)</label>
                    <input type="password" name="password" value="" class="form-control" id="mdp_user" placeholder="Laisser vide pour ne pas modifier" pattern="[a-zA-Z0-9_]{5,}">
                </div>

            </div>
            <div class="table-responsive col-4">

                <div class="form-group d-flex flex-column justify-content-center align-items-center ">

                    <img class="img-profile rounded-circle" id="img-id" src="<?= (empty($user->avatar)) ? Router::webroot('img/defaultImg.jpg') : Router::webroot($user->avatar) ?>" style="width:150px; height:150px">
                    <div class="custom-file mt-3">
                        <input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" style="width: 20vw!important;margin:0 0 0 5vw;" for="inputGroupFile01">choisissez un avatar</label>
                    </div>
                </div>

            </div>

            <div class="form-group w-75  d-flex flex-row justify-content-start align-items-center text-white rounded" style="background-color: gray; height:50px;width:66%!important;">
                <label class="form-check-label font-weight-bold"> &nbsp&nbsp Role</label>
                <?php foreach ($roles as $key => $value) : ?>
                    <div class="form-check mx-4">
                        <input class="form-check-input" <?= ($user->fk_role_id == $value->id) ? 'checked ' : "" ?> type="radio" name="role" id="admin_radio" value="<?= $value->id ?>">
                        <label class="form-check-label" for="admin_radio"><?= $value->role_name ?></label>
                    </div>

                <?php endforeach ?>
            </div>
            <div class="form-group w-100  d-flex flex-row justify-content-start align-items-center">
                <div class="form-check mx-4">
                    <input class="form-check-input" <?= ($user->count_active == 1) ? 'checked' : "" ?> type="radio" name="count_active" id="active_user" value="1">
                    <label class="form-check-label" for="active_user"> Compte actif</label>
                </div>


                <div class="form-check ml-5">
                    <input class="form-check-input " <?= ($user->count_active == 0) ? 'checked' : "" ?> type="radio" name="count_active" id="blocked_user" value="0">
                    <label class="form-check-label" for="blocked_user"> Compte bloqué </label>
                </div>
            </div>



        </div>
    </div>
    </div>
</form>

<script>
    $(function() {
        let input = document.getElementById('inputGroupFile01');
        let tool = new toolJs();
        input.addEventListener('change', () => {
            tool.linkInputToImg(input, 'img-id');
        });

    })
</script>