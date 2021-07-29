<?php
class UsersController extends Controller
{


    /**
     * Login
     * send to the login page
     */
    function login()
    {
        $this->theme = 'login_and_logout';

        if ($this->request->data) {

            $data = $this->request->data;

            $this->loadModel('User');

            $user = $this->User->login($data->login, $data->password);
         

            if (empty($user->error)) {

                /*We check if the account is activated */
                if ($user->info->count_active == 1) {


                    $this->Session->write('User', $user->info);

                    if ($this->Session->read('User')) {


                        if (isset($data->remember)) {

                            setcookie('login', $user->info->login, time() + 365 * 24 * 3600, null, null, false, true);
                            setcookie('password', $user->info->password, time() + 365 * 24 * 3600, null, null, false, true);
                        }
           

                        /*I check if he has the role of admin */
                        if ($user->info->role_name == 'admin') {


                            /* If he has the role of admin I redirect him to the administration page */
                            $this->redirect(conf::$admin_prefixe );
                        } else {

                            /* Otherwise I redirect it to the home page */
                            $this->redirect('/');
                        }
                    }
                }
            }else{
                foreach ($user->error as $key => $value) {
                   
                    $this->Session->setFlash($value,'',$data);
                }
            }
        }
    }

    /**
     * Logout
     * Logs out the user who is currently logged in
     */
    function logout()
    {

        setcookie('login', '', time() - 3600);
        setcookie('password', '', time() - 3600);

        $this->theme = 'login_and_logout';
        unset($_SESSION['User']);
        $this->Session->setFlash('Vous éte déconnecté');


        $this->redirect('/');
    }

    /* (FR)Charge la page qui permet de récupérait sont mot de passe */
  /*   function ForgotPassword()
    {
        $this->theme = 'login_and_logout';
    } */
    /* (FR)Charge la page qui permet de s'enregistré*/
/*     function register()
    {
        $this->theme = 'login_and_logout';
        if (isset($_SESSION['User']) && !empty($_SESSION['User'])) {

            $this->Session->setFlash('vous êtes déjà enregistré et connecté au site');
            $this->redirect('');
        }
    } */

    /**
     * newUser
     *Send to page to create a new user
     * @param $_POST[name=>name,login=>login,email=>email,password1=>password1,password2=>password2]
     */
    function newUser()
    {
        $data = $this->request->data;



        $this->loadModel('User');
        if ($this->request->data) {

            $data = $this->request->data;

            $result = $this->User->register($data->name, $data->login,  $data->email,  $data->password, $data->password2);

            if (empty($result->error)) {


                $this->loadModel('Email');
                $message = $this->Email->findFirst(array(
                    'conditions' => (array('name' => 'register'))
                ));
                $message->email .= " <a href=" . BASE_URL . "/users/confirmation/email:" . $result->email . "/key:" . $result->validatekey . "'>Comfirmer Votre email </a> ";
                $email = new SendMail();
                $email->sendEmail($data->email, $message->email, 'Confirmation d\'inscription');
                $this->redirect('users/login');
            }
        }
    }

    /**
     * account_activation
     *Can be called via URL to activate the user's account
     * @param  string $email
     * @param  string $key
     */
    function account_activation($email = null, $key = null)
    {
        if ($email == null || $key == null) {

            $this->redirect('pages/accueil');
        } else {

            $this->loadModel('User');

            $user = $this->User->activation_user_account($email, $key);

            if (empty($user->error)) {
                $this->Session->setFlash('Votre compte a été activé avec succès');
            } else {
                $this->Session->setFlash('Une erreur est survenue nous n\'avons pas pu activer votre compte ');
            }
        }
    }

    /**
     * profil
     *Redirects the user to their profile page
     */
    function profil($id = null)
    {
        $this->loadModel('User');

        // We will check when you are connected
        if (isset($_SESSION['User']) && !empty($_SESSION['User'])) {
        
            
            if($id!=null){
               $id =$id;
            }else{
                $id = $_SESSION['User']->id;
            }


            //We check if data to save has been posted
            if (isset($this->request->data) && !empty($this->request->data)) {

                $avatar = null;
                
                $data = $this->request->data;

                if (isset($_FILES['avatar'])) {

                    $avatar = $_FILES['avatar'];
       
                }
          
                //If data has been posted we save it
                $user_profil = $this->User->set_profile(

                    $id,
                    $data->login,
                    $data->email,
                    $data->newmp,
                    $data->newmp2,
                    $avatar,
                    $data->address_1,
                    $data->address_2,
                    $data->zip_code,
                    $data->country,
                    $data->phone,
                    $data->mobile,
                    null,
                    $data->city

                );
                $this->Session->write('User', $user_profil->info);
            } else { //If no data has been posted we display the profile directly
                    $user_profil = $this->User->get_profile($id);
          
            }

            $d['user'] = $user_profil->info;

            $this->set($d);

        } else { //If this page is requested while there is no one connected, we can will redirect the login page

            return $this->redirect('users/login', 200);
        }
    }



 
}
