<?php
/* debug($role); */

if (!isset($role)) {

    $role = $this->Session->getFormReturn();

    if ($role == false) {

        $role = new stdClass();
        $role->role_name = "";
        $role->description_role = "";
        $role->img_role = "";
        $role->id = "";
        
    }
}
?>
<form action="<?= (empty($role->id)) ? Router::url('admin/systeme/admin_add_role') : Router::url('admin/systeme/admin_add_role/id:' . $role->id)  ?>" method="POST" enctype="multipart/form-data">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= (empty($role->id)) ? 'Ajouter un role' : 'Editer un role' ?></h6>
            <div class="d-flex flex-row mt-1">
                <input class="btn btn-success mr-md-1 " name="saverole" type="submit" value="<?= (empty($role->id)) ? 'Sauvgarder' : 'Mettre à jour le role' ?>" required>
                <?php if (!empty($role->id)) : ?>
                    <a class="btn btn-danger  " href="<?= Router::url('systeme/deleteRole/id:'.$role->id)?>"><i class="fas fa-trash-alt"></i> Supprimer</a>
                <?php endif ?>

            </div>
        </div>

        <div class="card-body row m-auto w-75">
            <div class="table-responsive  w-50">

                <div class="form-group ">
                    <label for="Titre" class="w-25">Titre</label>
                    <input type="text" name="role_name" class="form-control" value="<?= $role->role_name ?>" id="titre_role" placeholder="Titre du role" required>
                </div>
                <div class="form-group ">
                    <label for="Descritption" class="w-25">Description</label>
                    <textarea class="form-control" name="description_role" id="" cols="30" rows="10" required><?= $role->description_role ?></textarea>

                </div>

            </div>
            <div class="ml-5 ">
                <label for="">Icon du role</label>
                <div>
                    <div class="input-group mb-3">

                        <div class="custom-file">
                            <input type="file" name="thumbnail" accept="image/x-png,image/gif,image/jpeg"  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">choisissez une image</label>

                        </div>

                    </div>
                    <small>(format supporter jpg,gif,png)</small><br>

                    <label for="">Miniature</label>
                    <br>
                    <img style="width: 100px; border-radius:50%; margin-top:50px " id="img-id"  src="<?= (empty($role->img_role)) ? Router::webroot('img/defaultImg') : Router::webroot('img/' . $role->img_role) ?>" style="width:150px; height:150px">
                </div>


            </div>
        </div>
</form>

<script>
  $(function(){
        let input = document.getElementById('inputGroupFile01');
        let tool = new toolJs();
        input.addEventListener('change',()=>{
            tool.linkInputToImg(input,'img-id');
        });
      
    })

</script>