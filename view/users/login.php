<!-- Outer Row -->

<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Nous saluons votre retour!</h1>
                            </div>
                            <form class="user" action="<?php echo Router::url('users/login'); ?>" method="POST">
                                <div class="form-group">
                                    <input type="texte" name="login" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez votre pseudo">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value=" Connexion">


                            </form>
                            <hr>
                            <div class="text-center">
                               <!--  <a class="small" href="<?php echo Router::url('users/ForgotPassword') ?>">Vous avez oublié votre mot de passe?</a> -->
                            </div>
                            <div class="text-center">
                               <!--  <a class="small" href="<?php echo Router::url('users/register') ?>">Créer un nouveau compte!</a>
 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>