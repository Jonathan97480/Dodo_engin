 <!-- DataTales Example -->
 <!-- Topbar Search -->
 <?php

    ?>

 <div class="card shadow mb-4">
     <div>
         <a href="<?= Router::url('systeme/admin_add_role') ?>" class="btn btn-primary m-2 btn-icon-split ">
             <span class="icon text-white-50"><i class="fas fa-user-tag"></i></span>
             <span class="text"> Ajouter un role</span>
            
         </a>

     </div>
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Liste des roles</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>Nom du role</th>
                         <th>Description</th>
                         <th>Role icon</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th>Nom du role</th>
                         <th>Description</th>
                         <th>Role icon</th>
                         <th>Actions</th>
                     </tr>
                 </tfoot>
                 <tbody>

                     <?php foreach ($roles as $key => $value) : ?>
                         <tr>
                             <td><?= $value->role_name ?></td>
                             <td><?= $value->description_role ?></td>
                             <td> <img src="<?= (!empty($value->img_role)) ? Router::webroot('img/' . $value->img_role) : "" ?>" alt="" class="icon-Liste"> </td>
                             <td>
                                 <a href="<?= Router::url('systeme/admin_add_role/id:' . $value->id) ?>" class="">
                                     <i class="fas fa-user-edit"></i>
                                 </a>
                                 <a href="<?= Router::url('systeme/deleteRole/id:'.$value->id)?>" class="">
                                     <i class="fas fa-trash-alt"></i>
                                 </a>

                             </td>


                         </tr>
                     <?php endforeach ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <style>
 
 .icon-Liste{
     width: 50px;
     border-radius: 50%;
 }
 </style>