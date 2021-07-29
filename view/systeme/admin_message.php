 <!-- DataTales Example -->
 <!-- Topbar Search -->
 <?php

    ?>

 <div class="card shadow mb-4">

     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary"><?= (isset($MessageRead)) ? 'Lecture du message: ' . $MessageRead->objet_message : 'Liste des messages' ?> </h6>
     </div>
     <div class="card-body">
         <div>
             <?php if (!isset($MessageRead)) : ?>
                 <table id="myTable">
                     <thead>
                         <tr>
                             <th>Statu</th>
                             <th>objet du message</th>
                             <th>date</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tfoot>
                         <tr>
                             <th>Statu</th>
                             <th>objet du message</th>
                             <th>date</th>
                             <th>Actions</th>
                         </tr>
                     </tfoot>
                     <tbody>
                         <?php if (isset($meesages) && !empty($meesages)) : ?>
                             <?php foreach ($meesages as $key => $value) : ?>
                                 <tr>
                                     <td> <i class="<?= ($value->is_read) ? 'fas fa-envelope-open-text' :  'fas fa-envelope' ?>  "></i></td>
                                     <td><?= $value->objet_message ?></td>

                                     <td><?= $value->date ?></td>

                                     <td>
                                         <a href="<?= Router::url('systeme/admin_message/id:' . $value->id) ?>" class="icon-Liste">
                                             <i class="fas fa-book-reader"></i>
                                         </a>
                                         <a href="<?= Router::url('systeme/deleteMessage/id:' . $value->id) ?>" class="icon-Liste">
                                             <i class="fas fa-trash-alt"></i>
                                         </a>

                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         <?php endif ?>
                     </tbody>
                 </table>

             <?php else : ?>
                 <div class="d-flex flex-grow-0 justify-content-between">
                     <div class="d-flex flex-lg-column justify-content-center">
                         <span>
                             nom complet :
                             <strong> <?= $MessageRead->full_name ?></strong>
                         </span>
                         <span>
                             email :
                             <strong><?= $MessageRead->email ?> </strong>
                         </span>
                         <span>
                             Suject du message :
                             <strong><?= $MessageRead->objet_message ?> </strong>
                         </span>
                     </div>
                     <div class="action-btn">
                         <a class="btn btn-primary" href="mailto:<?= $MessageRead->email ?>">Répondre</a>
                         <a class="btn btn-danger" href="<?= Router::url('systeme/deleteMessage/id:' . $MessageRead->id) ?>">Supprimer</a>
                     </div>
                 </div>


                 <div class=" container-lg margintop20 content">
                     <?= $MessageRead->content_message ?>
                 </div>
             <?php endif ?>
         </div>
     </div>
 </div>

 <style>
     .icon-Liste {
         margin: 5px;
         text-align: center;
     }

     .content {
         height: 60vh;
         max-height: 60vh;
         margin-top: 20px;
         overflow-y: auto;
         text-align: left;
         border: solid 0.5px black;
         border-radius: 15px;
         font-size: 20px;
     }
 </style>

 <script>
     $(function() {
         $('#myTable').DataTable();
     });
 </script>