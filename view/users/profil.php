
<?php 
/* debug($this); */
?>
<h1 style="margin-left:600px; display:inline;">Votre Profil</h1><br>
<div style="display:block;  margin-left:500px; ">

    <form action="<?php echo Router::url('users/profil/id:'.$user->id) ?>" method="post" style="display:inline;" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?= $user->id ?>" id="">
        <table style="margin-top: 30px;">
            <tr>
                <td>
                    <label for="login">Avatar</label>
                </td>

                <td>
                    <img src=" <?php  echo Router::webroot( $user->avatar)  ?>" alt="" width="150px">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="login">Votre Login</label>
                </td>

                <td>
                    <input type="text" name="login" id="login" placeholder="login" value="<?php echo $user->login ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="name">Votre nom Complet</label>
                </td>
                <td>
                    <input type="text" name="name" id="name" placeholder="Votre nom" value="<?php echo $user->name ?>">
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Votre Email</label>
                </td>
                <td>

                    <input type="email" name="email" id="email" placeholder="Votre Email" value="<?php echo $user->email ?>">
                    <br>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="newmp">Nouveau mot de passe</label>
                </td>
                <td>
                    <input type="password" name="newmp" id="newmp" placeholder="Mot de passe">
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="newmp2">Confirmation du mot de passe</label>
                </td>
                <td>
                    <input type="password" name="newmp2" id="newmp2" placeholder="Confirm mot de passe">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="newmp2">adresse 1</label>
                </td>
                <td>
                    <input type="text" name="address_1" id="address_1" placeholder="Votre adresse 1" value="<?php echo $user->address_1 ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="address_2">adresse 2</label>
                </td>
                <td>
                    <input type="text" name="address_2" id="address_2" placeholder="Votre adresse 2" value="<?php echo $user->address_2 ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="zip_code">Code postal</label>
                </td>
                <td>
                    <input type="text" name="zip_code" id="zip_code" placeholder="Votre code postal"value="<?php echo $user->zip_code ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="country">Votre region</label>
                </td>
                <td>
                    <input type="text" name="country" id="country" placeholder="Votre region"value="<?php echo $user->country ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="country">Votre telephone fixe</label>
                </td>
                <td>
                    <input type="text" name="phone" id="phone" placeholder="Votre telephone fixe"value="<?php echo $user->phone ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="mobile">Votre telephone mobile</label>
                </td>
                <td>
                    <input type="text" name="mobile" id="mobile" placeholder="Votre telephone mobile"value="<?php echo $user->mobile ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="city">Votre  Ville</label>
                </td>
                <td>
                    <input type="text" name="city" id="city" placeholder="Votre  Ville" value="<?php echo $user->city ?>">
                    <br>
                </td>

            </tr>
            <tr>
                <td>
                <label for="avatar">Telecharger un Avatar</label>
                </td>
                <td>
                    <input type="file" name="avatar" id="avatar">
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Votre Grade</h3>
                </td>
                <td>
                    <p><?= $user->role ?></p>
                </td>
            </tr>
    
        </table>
        <button type="submit">Valider</button>
    </form>

</div>