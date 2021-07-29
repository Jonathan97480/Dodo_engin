 <!-- DataTales Example -->
 <!-- Topbar Search -->
 <?php

    ?>
 <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo Router::url('admin/users/admin_users_list'); ?>" method="POST">
     <div class="input-group">
         <input type="text" class="form-control bg-light border-0 small  " name="cherche" style="background-color: #fff!important;" placeholder="chercher utilisateur" aria-label="Search" aria-describedby="basic-addon2">
         <div class="input-group-append">
             <button class="btn btn-primary" type="SUBMIT">
                 <i class="fas fa-search fa-sm"></i>
             </button>
         </div>
     </div>
 </form>
 <br>
 <hr>
 <br>

 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Liste Utilisateurs</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th>Login</th>
                         <th>Name</th>
                         <th>Date d'inscription</th>
                         <th>Rôle de l'utilisateur</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th>Login</th>
                         <th>Name</th>
                         <th>Date d'inscription</th>
                         <th>Rôle de l'utilisateur</th>
                         <th>Actions</th>
                     </tr>
                 </tfoot>
                 <tbody>
                
                     <?php foreach ($Users as $key => $value) : ?>
                         <tr>
                             <td><?= $value->login ?></td>
                             <td><?= $value->name ?></td>
                             <?php $date = new DateTime($value->registration_date) ?>
                             <td><?= $date->format('d-m-Y')  ?></td>
                             <td><?= $value->role_name ?></td>
                             <td>
                                 <a href="<?= Router::url('systeme/admin_add_user/id:' . $value->id) ?>" class="">
                                     <i class="fas fa-user-edit"></i>
                                 </a>
                                 <a href="<?= Router::url('systeme/admin_deleteUser/id:' . $value->id) ?>" class="">
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