<div class="card shadow mb-4">
    <div class="card-header py-3 ">


        <h6 class=" m-0 font-weight-bold text-primary">Email Edition</h6>

    </div>
    <?php foreach ($email as $key => $value) : ?>
        <form action="<?php echo Router::url('admin/posts/settings') ?>" method="POST">


            <input type="hidden" name="id" value="<?= $value->id ?>">
            <input type="hidden" name="name" value="<?= $value->name ?>">

            <div class="card-body">

                <?php if ($value->name == 'register') : ?>

                    <h3>Email de confirmation d'inscription</h3>
                <?php elseif ($value->name == 'contact') : ?>
                    <h3>Email de confirmation du formulaire de contact</h3>
                <?php elseif ($value->name == 'news') : ?>
                    <h3>Email de confirmation d'inscription newsletter</h3>
                <?php endif ?>
                <textarea name="email" class="inputcontent" style="width: 60%; height: 70vh ; ">
                <?= $value->email ?>
            </textarea>


            </div>
            <hr>


            <button type="submit" name="message" class="btn-danger ">
                Mise à jour
            </button>
        </form>
    <?php endforeach ?>
    <br>


</div>