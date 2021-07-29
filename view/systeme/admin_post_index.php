 <!-- DataTales Example -->
 <!-- Topbar Search -->
 <?php/*  die(debug($this)) */ ?>

 <div class="container-fluid">
     <div>
         <a class="btn btn-primary" href="<?= Router::url('systeme/admin_post_edit') ?>">Ajouter un nouveau post</a>
     </div><br>
     <hr>
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Liste Des Posts</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Titre</th>
                             <th>Date de creation</th>
                             <th>Date de modification</th>
                             <th>Le type de post</th>
                             <th>onligne</th>
                             <th>action</th>
                         </tr>
                     </thead>
                     <tfoot>
                         <tr>
                             <th>Titre</th>
                             <th>Date de creation</th>
                             <th>Date de modification</th>
                             <th>Le type de post</th>
                             <th>onligne</th>
                             <th>action</th>
                         </tr>
                     </tfoot>
                     <tbody>
                         <?php foreach ($posts as $key => $value) : ?>
                             <tr>
                                 <td><?= $value->name ?></td>
                                 <td><?= date_format(date_create($value->created), 'd/m/Y') ?></td>
                                 <td><?= date_format(date_create($value->date_edit), 'd/m/Y') ?></td>
                                 <td><?=($value->type == "post") ?'<i class="fas fa-blog"></i> '.  'Blog'  :  '<i class="fas fa-project-diagram"></i> '.'Portfolio' ?></td>
                                 <td>
                                     <?php if ($value->online == 1) : ?>
                                         <span class="btn-success info-line">En ligne</span>
                                     <?php else : ?>
                                         <span class="btn-danger info-line">Hor ligne</span>
                                     <?php endif ?>
                                 </td>
                                 <td>
                                     <a title="Editer un post" href="<?= Router::url('systeme/admin_post_edit/id:' . $value->id) ?>" class="btn btn-primary my-btn">
                                         <i class="fas fa-edit"></i>
                                     </a>
                                     <a title="Supprimer un post" href="<?= Router::url('systeme/admin_deletePost/id:' . $value->id)  ?>" class="btn btn-danger my-btn">
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
 </div>

 <style>
     table {
         text-align: center;
     }

     .info-line {
         padding: 5px;
         border-radius: 15px;

     }
     .my-btn{
         margin: 2px;
     }
 </style>