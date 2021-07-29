 <!-- DataTales Example -->
 <!-- Topbar Search -->
 <?php

    ?>

 <div class="card shadow mb-4">
     <div>
         <a href="<?= Router::url('systeme/admin_add_tag') ?>" class="btn btn-primary m-2 btn-icon-split ">
             <span class="icon text-white-50"><i class="fas fa-tags"></i></span>
             <span class="text"> Ajouter un tag</span>

         </a>

     </div>
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Liste des Tag</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>Nom du tag</th>
                         <th>Description</th>
                         <th>Tag icon</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th>Nom du tag</th>
                         <th>Description</th>
                         <th>Tag icon</th>
                         <th>Actions</th>
                     </tr>
                 </tfoot>
                 <tbody>

                     <?php foreach ($tags as $key => $value) : ?>
                         <tr>
                             <td><?= $value->name_tag ?></td>
                             <td><?= $value->description_tag ?></td>
                            
                             <td> <img src="<?= (!empty($value->url_tag)) ? Router::webroot('img/' . $value->url_tag) : "" ?>" alt="" class="icon-Liste"></td>
                             <td>
                                 <a href="<?= Router::url('systeme/admin_add_tag/id:' . $value->id) ?>" class="">
                                     <i class="fas fa-user-edit"></i>
                                 </a>
                                 <a href="<?= Router::url('systeme/deleteTag/id:' . $value->id) ?>"  class="">
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