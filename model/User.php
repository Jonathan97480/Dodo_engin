<?php
class User extends Model
{

    public $table = 't_users';
    public $login_length = 5;
    public $password_length = 5;

    #region Users
    /**
     * login
     * Allows to check if a user exists at the time of his connection 
     * return of hereure if the info of the form is not correct
     * @param  mixed $login
     * @param  mixed $password
     * @return array|stdClass
     */
    public function login($login, $password): stdClass
    {
        $user = new stdClass();
        $user->info = [];
        $user->error = [];

        if (!isVarsEmpty([$login, $password])) {

            if (strlen($login) < $this->login_length) {
                $user->error[110] = "Le login doit faire " . $this->login_length . " caractères minimum";
            }

            if (strlen($password) < $this->password_length) {
                $user->error[120] = "Le mot de pass doit faire " . $this->password_length . " caractères minimum";
            }

            /*If no error detected, I launch my user search in the database*/
            if (empty($user->error)) {

                $password = sha1(htmlspecialchars($password));
                $login = htmlspecialchars($login);

                $sql = "SELECT * FROM " . $this->table . " LEFT JOIN t_roles ON t_roles.id=fk_role_id WHERE login= '$login' AND password='$password'";
                $user->info =  $this->query($sql);

                if (empty($user->info)) {
                    $user->error[130] = "L'utilisateur n'existe pas";
                } else {
                    $user->info = $user->info[0];
                }
            }
        } else {
            $user->error[100] = "Vous devez remplir tous les champs";
        }

        return $user;
    }

    /**
     * deleteUser
     * dlete User in dataBase
     * @param  int $id
     * @return array|stdClass
     */
    public function deleteUser($id)
    {


        $user = new stdClass();

        if (is_numeric($id)) {
            $user->info = $this->findFirst([
                'conditions' => ['id' => $id]
            ]);

            if ($user->info->fk_role_id == 1) {

                $user->error[10] = " Les admin ne peuvent pas être supprimé ";
                return $user;
            }

            if (!empty($user->info)) {

                $this->primaryKey = "t_users_id";

                $this->delete($id, 't_users_has_t_users_info');

                $this->primaryKey = "id";

                $this->delete($id);
                return true;
            } else {

                $user->error[20] = "Cette utilisateur n'existe pas ";
                return $user;
            }
        } else {

            $user->error[10] = "l'id est incorrecte";
            return $user;
        }
    }

    /**
     * register
     *  regist user and info user in the DB
     * @param  string $name
     * @param  string $firstName
     * @param  string $login
     * @param  string $email
     * @param  string $pass
     * @param  string $adress1
     * @param  string $adress2
     * @param  int $zipcode
     * @param  string $tel
     * @param  string $city
     * @param  int $role
     * @param  int $isActive
     * @param  array $file
     * @param  int $idUser
     * @return array|stdClass
     */
    public function register(string $name, string $firstName, string $login, string $email, string $pass, string $adress1, string $adress2, string $zipcode, string $tel, string $city, string $role = null, int $isActive = null, array $file = null, $idUser = null): stdClass
    {

        $user = new stdClass();
        $user->info = new stdClass();
        $user->error = [];



        /* Vérification que l'email est correct ho niveau de son format */
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            /* (FR)On cherche si l'adresse email existe déjà dans la base de donnée */
            $emailExist = $this->find(array(
                'conditions' => array('email' => $email),
                'fields' => 'email'
            ));
        }

        /* Vérification que le login correspond bien ho cristaires demander  */
        if (preg_match('/^[a-zA-z0-9_]+$/', $login)) {

            /* (FR)On cherche si le login existe déjà dans la base de donnée */
            $loginExist = $this->find(array(
                'conditions' => array('login' => $login),
                'fields' => 'login'
            ));
        }

        if (!empty($loginExist) && empty($idUser)) {
            $user->error[100] = "ce login est déjà utilisé";
        }

        if (!empty($emailExist) && empty($idUser)) {
            $user->error[110] = "cette email est déjà utilisé";
        }

        if ($idUser == null && empty($pass)) {
            $user->error[110] = "Le mot de passe est obligatoire pour ajouter un utilisateur";
        }

        /* (FR)si tout est correct on sauvegarde le nouvelle utilisateur  */
        /* (FR)Encodage du mot de passe pour sauvegarde */
        if (empty($user->error)) {

            $user->info->login = htmlspecialchars($login);
            $user->info->name = htmlspecialchars($name);
            $user->info->first_name = htmlspecialchars($firstName);

            if (!empty($pass)) {

                $user->info->password = sha1(htmlspecialchars($pass));
            }

            $user->info->email = htmlspecialchars($email);
            if (!empty($role)) {
                $user->info->fk_role_id = htmlspecialchars($role);
            }
            if (!empty($isActive)) {
                $user->info->count_active = $isActive;
            }

            $user->info->fk_lang = 1;




            if (isset($file['avatar']['name']) && !empty($file['avatar']['name'])) {
                $e = $this->saveImg($file['avatar']);
                if (is_string($e)) {

                    $user->info->avatar = $e;
                } else {

                    $user->error[50] = $e;
                }
            } else {
                if (empty($idUser)) {
                    $user->info->avatar = 'avatar/avatar_default.png';
                }
            }

            if (!empty($idUser)) {

                $user->info->id = $idUser;
            }
            if (empty($user->error)) {

                $idTusers = $this->save($user->info);
                $user->info = new stdClass();

                $user->info->zip_code = $zipcode;
                $user->info->country = 'Réunion';
                $user->info->city = htmlspecialchars($city);
                $user->info->address = $adress1;
                $user->info->address_2 = $adress2;
                $user->info->phone = $tel;

                if (!empty($idUser)) {

                    $user->info->id =   $this->findFirst([
                        'conditions' => ['t_users_id' => $idUser],
                        'fields' => "t_users_info_id AS id"
                    ], 't_users_has_t_users_info')->id;
                }

                $idInfoUser = $this->save($user->info, 't_users_info');
                if (empty($idUser)) {
                    $link = new stdClass();
                    $link->t_users_id = $idTusers;
                    $link->t_users_info_id = $idInfoUser;
                    $this->save($link, 't_users_has_t_users_info');
                }


                $user->info = new stdClass();


                if (!empty($idTusers)) {
                    $user->info->id = $idTusers;
                } else {

                    $user->info->id = $idUser;
                }
            } else {
                return $user;
            }
        }

        return $user;
    }
    private function validation_key_generation()
    {

        $keyLength = 12;
        $key = "";
        for ($i = 1; $i < $keyLength; $i++) {

            $key .= mt_rand(0, 9);
        }
        return $key;
    }
    /**
     * loadInfoUser
     *  return info the user 
     * @param  int $idUser
     * @return array|stdClass
     */
    public function loadInfoUser($idUser)
    {

        $sql = "SELECT * FROM " . $this->table . " 
        LEFT JOIN t_users_has_t_users_info ON t_users_has_t_users_info.t_users_id = " . $this->table . ".id 
        LEFT JOIN t_users_info ON t_users_info.id = t_users_has_t_users_info.t_users_info_id 
        LEFT JOIN t_roles ON t_roles.id = t_users.fk_role_id 
        WHERE " . $this->table . ".id = $idUser";

        $d = $this->query($sql);
        if (!empty($d)) {
            $d = $d[0];
        }
        return $d;
    }
    /**
     * get_profile
     * Allows you to retrieve the user's profile
     * @param  int $id Takes id of user search
     * @return array|stdClass 
     */
    function get_profile(int $id): stdClass
    {
        $user = new stdClass();
        $user->info = new stdClass();
        $user->error = [];

        $user->info =  $this->query("SELECT 
        " . $this->table . ".id,
        login,
        email,
        name,
        first_name,
        count_active,
        avatar,
        date_inscription,
        role,
        zip_code,
        country,
        city,
        address_1,
        address_2,
        phone,mobile
         FROM " . $this->table .  " 
        LEFT JOIN t_users_has_t_users_info   ON t_users_id =" . $this->table . ".id 
        LEFT JOIN t_users_info ON t_users_info.id =t_users_has_t_users_info.t_users_info_id 
        WHERE " . $this->table . ".id =" . $id)[0];

        if (empty($user->info->user)) $user->error[100] = 'L\'utilisateur ñ\'existe pas';

        return  $user;
    }

    /**
     * set_profile
     * Allows you to modify a user's profile
     * @param  int $id profile id to modify
     * @param  string $login Optional parameters
     * @param  string $email Optional parameters
     * @param  string $mp1 Optional parameters
     * @param  string $mp2 Optional parameters
     * @param  array $avatar_file Optional parameters
     * @param  string $address_1 Optional parameters
     * @param  string $address_2 Optional parameters
     * @param  string $zip_code Optional parameters
     * @param  string $country Optional parameters
     * @param  string $phone Optional parameters
     * @param  string $mobile Optional parameters
     * @param  string $role Optional parameters
     * @param  string $city Optional parameters
     * @return array|stdClass
     */
    function set_profile(int $id, string $login = null, string $email = null, string $mp1 = null, string $mp2 = null, array $avatar_file = null, string $address_1 = null, string $address_2 = null, string $zip_code = null, string $country = null, string $phone = null, string $mobile = null, string $role = null, string $city = null)
    {

        $user = new stdClass();
        $user->info = new stdClass();
        $user->error = [];
        $user->info->id = $id;

        /* (Fr)Vérification du mot de passe */
        if ($mp2 != null  && !empty($mp2)) {

            if ($mp1 == $mp2) {
                $user->info->password = sha1(htmlspecialchars($mp1));
            } else {
                $user->error[100] = 'Vos deux mots de passe ne sont pas identiques';
            }
        }
        /* (FR)Vérification du login */
        if ($login != null && !empty($login)) {

            if (!preg_match('/^[a-zA-z0-9_]+$/', $login)) {

                $user->error[110] = 'Votre login contient des caractères non autorisé';
            } else {

                $user->info->login = htmlspecialchars($login);
            }
        }
        /* (FR) Vérification de l'email */
        if ($email != null && !empty($email)) {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $user->error[120] = "Votre adresse email ñ'est pas valide";
            } else {
                $user->info->email = htmlspecialchars($email);
            }
        }

        /* (FR) Gestion d'avatar */
        if ($avatar_file != null && !empty($avatar_file)) {


            $old_avatar = $this->get_profile($id)->info->avatar;

            $folder = 'img' . DS . 'avatar';

            /* (FR) Je vérifie que le fichier a été transmis par le HTTP POST */
            if (is_uploaded_file($avatar_file['tmp_name'])) {


                /* (FR)Je vais vérifier que les extensions correspondent */
                if (!in_array(strtolower(pathinfo($avatar_file['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) {

                    $user->error[130] = "L'extension de votre fichier n'est pas autorisé";
                } else {


                    $dir = WEBROOTT . DS . $folder;

                    /*(FR) Je définis le chemin où je vais enregistrer mon image et je la stock dans la variable $filetowrite*/
                    $filetowrite = $dir .  DS . $avatar_file['name'];

                    @mkdir($dir, 0777, true);

                    /* (FR)Je déplacer fichier dans le dossier image*/
                    if (move_uploaded_file($avatar_file['tmp_name'], $filetowrite)) {

                        /* resize avatar */
                        $avatar = new img($filetowrite);
                        $avatar->cropSquare();
                        $avatar->resize(64, 64);
                        $avatar->store($filetowrite);

                        if (WEBROOTT . DS . $old_avatar != $filetowrite && $old_avatar != "img/avatar_default.png") unlink(WEBROOTT . DS . $old_avatar);

                        $user->info->avatar = $folder . DS . $avatar_file['name'];
                    }
                }
            }
        }
        /* Gestion role */
        if ($role != null && !empty($role)) {
            $user->info->role = htmlspecialchars($role);
        }

        /* save info t_user */
        if (empty($user->error && !empty($user->info))) {

            $this->save($user->info);
            unset($user->info);
            $user->info = new stdClass();
        }

        /* Parite t_users_info */

        /* Gestion adresse_1 */
        if ($address_1 != null && !empty($address_1)) {
            $user->info->address_1 = htmlspecialchars($address_1);
        }
        /* Gestion adresse_2 */
        if ($address_2 != null && !empty($address_2)) {
            $user->info->address_2 = htmlspecialchars($address_2);
        }
        /* Gestion zip_code */
        if ($zip_code != null && !empty($zip_code)) {
            $user->info->zip_code = htmlspecialchars($zip_code);
        }
        /* Gestion country */
        if ($country != null && !empty($country)) {
            $user->info->country = htmlspecialchars($country);
        }
        /* Gestion phone */
        if ($phone != null && !empty($phone)) {
            $user->info->phone = htmlspecialchars($phone);
        }
        /* Gestion mobile */
        if ($mobile != null && !empty($mobile)) {
            $user->info->mobile = htmlspecialchars($mobile);
        }
        /* Gestion city */
        if ($city != null && !empty($city)) {
            $user->info->city = htmlspecialchars($city);
        }

        if (empty($user->error && !empty($user->info))) {

            $user->info->id =  $this->query("SELECT t_users_info.id FROM " . $this->table .  " 
            LEFT JOIN t_users_has_t_users_info   ON t_users_id =" . $this->table . ".id 
            LEFT JOIN t_users_info ON t_users_info.id =t_users_has_t_users_info.t_users_info_id 
            WHERE " . $this->table . ".id =" . $id)[0]->id;

            $join_id =  $this->save($user->info, 't_users_info');
            unset($user->info);

            if (!empty($join_id)) {

                $user->info = new stdClass();
                $user->info->t_users_id = $id;
                $user->info->t_users_info_id = $join_id;

                $this->save($user->info, 't_users_has_t_users_info');
                unset($user->info);
            }
        }

        if (empty($user->error)) {
            $user = $this->get_profile($id);
        }
        return $user;
    }


    /**
     * find_users
     *Allows to retrieve the list of users or to search inside
     * @param  string $Search
     * @return stdClass Users liste
     */
    function find_users(string $Search = null)
    {
        $user = new stdClass();
        $user->info = new stdClass();
        $user->error = [];

        if ($Search != null) {
            $Search = htmlspecialchars($Search);
            $user->info = $this->query('SELECT t_users.id AS id,name,login,registration_date,role_name FROM  ' . $this->table . 'LEFT JOIN t_roles ON t_roles.id = fk_role_id  WHERE name LIKE "%' . $Search . '%" ORDER BY id DESC');

            if (empty($user->info)) {

                $user->info = $this->query('SELECT t_users.id AS id,name,login,registration_date,role_name FROM ' . $this->table .  ' LEFT JOIN t_roles ON t_roles.id = fk_role_id  WHERE CONCAT(name, email,login) LIKE "%' . $Search . '%" ORDER BY id DESC');
            }

            $user->info;
        } else { /* Si aucune recherche est demander on envoit la liste de tout les Utilisateur */


            $user->info = $this->query('SELECT t_users.id AS id,name,login,registration_date,role_name FROM  ' . $this->table . ' LEFT JOIN t_roles ON t_roles.id = fk_role_id');
        }
        return $user;
    }


    /**
     * activation_user_account
     *Activation of the user account via email
     * @param  string   $email
     * @param  string $key
     * @return stdClass info & error
     * @error
     * 100=>This user account does not exist
     */
    function activation_user_account(string $email, string $key)
    {

        $user = new stdClass();
        $user->info = new stdClass();
        $user->error = [];

        $user->info = $this->findFirst(array(

            'conditions' => array('validatekey' => $key, 'email' => $email)
        ));

        if (!empty($user->info)) {

            $user->info->count_active = 1;

            $this->User->save($user->info);
        } else {

            $user->error[100] = 'Ce compte utilisateur n\'existe pas';
        }

        return $user;
    }
    #endregion

    #region Image traitment
    private function saveImg(array $file, $w = 100, $h = 100, $resize = true): string
    {
        $upload_img = new stdClass();
        $upload_img->file = array();
        $upload_img->error = array();



        /* I verify that the file was transmitted by HTTP POST*/
        if (is_uploaded_file($file['tmp_name'])) {

            //Extension recovery
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            /*I will check that the extensions match */
            if (!in_array($extension, array("gif", "jpg", 'jpeg', "png"))) {
                $upload_img->error[100] = 'L\'extension du fichier est incorrecte';
            }

            /*Retrieving the current date */

            $dir = WEBROOTT . DS . 'img' . DS . 'avatar';

            /*Check if the folder exists */
            if (!file_exists($dir)) {

                mkdir($dir, 0777, true);
            }
            /*I define the path where I will save my image and I store it in the variable $filetowrite */
            $filetowrite = $dir .  DS . $file['name'];

            /* I move file to image folder */
            if (move_uploaded_file($file['tmp_name'], $filetowrite)) {


                if ($resize) {

                    $oldImg = $filetowrite;

                    //Image resizing
                    $new_img = new img($filetowrite);

                    $new_img->cropSquare();
                    $new_img->resize($w, $h);

                    //Define the file name
                    $new_fil_name = uniqid('img_') . "." . $extension;
                    $filetowrite = $dir .  DS . $new_fil_name;

                    $new_img->store($filetowrite);

                    unlink($oldImg);

                    return  'avatar' . DS . $new_fil_name;
                } else {

                    return  'avatar' . DS . $file['name'];
                }
            } else {
                $upload_img->error[110] = 'Le fichier ñ\'a pas pu etre importer';
            }
        }

        return $upload_img->error;
    }

    private function deleteImg(string $imgUrl)
    {

        $baseUrl = WEBROOTT . DS . 'img';

        if (file_exists($baseUrl . DS . $imgUrl)) {

            unlink($baseUrl . DS . $imgUrl);

            if (!file_exists($baseUrl . DS . $imgUrl)) {

                return true;
            } else {

                return false;
            }
        }

        return true;
    }


    #endregion

    #region roles

    /**
     * getListeRoles
     * return  the list roles 
     * @return void
     */
    public function getListeRoles()
    {

        $d = $this->find([], 't_roles');
        return $d;
    }


    /**
     * saveRole
     * save new role and update role existant
     * @param  string $name
     * @param  string $description
     * @param  array $file
     * @param  int $id
     * @return array|stdClass
     */
    public function saveRole(string $name, string $description, array $file, $id = null)
    {
        $d = new stdClass();

        /* vérification de la présence du rôle dans la BD */
        $d->info = $this->findFirst([

            'conditions' => ['role_name' => $name]
        ], 't_roles');

        if (!empty($d->info) && empty($id)) {

            $d->error[10] = "Ce role existe déja ";
            return $d;
        }

        /* Sauvegarde de l'image dans le serveur */
        if (!empty($file['name'])) {

            if (!empty($d->info)) {

                if (!empty($d->info->img_role)  && $this->deleteImg($d->info->img_role) == false) {

                    $d->error[50] = "Impossible de supprimer l'ancien images";
                    return $d;
                }
            }

            $img = $this->saveImg($file);

            if (is_array($img)) {

                $d->error = $img;
                return $d;
            }
        } elseif (empty($id)) {

            $d->error = "Vous devez rajouter une image pour le rôle";
            return $d;
        } elseif (!empty($id) && empty($file['name'])) {

            $img = $d->info->img_role;
        }


        /* sérialisation des donnée a sauvegarder */

        $role = [
            'role_name' => htmlspecialchars($name),
            'description_role' => htmlspecialchars($description),
            'img_role' => $img
        ];
        if (!empty($id)) {
            $role['id'] = $id;
        }



        $idTag = $this->save($role, 't_roles');

        if (empty($id) && !empty($idTag)) {

            $id = $idTag;
        }

        $d = $this->getRoleById($id);

        return $d;
    }

    /**
     * getRoleById
     * return role by id 
     * @param  int $id
     * @return array|stdClass|int
     */
    public function getRoleById(int $id)
    {
        $d = new stdClass();

        $d->info = $this->findFirst([

            'conditions' => ['id' => $id]
        ], 't_roles');

        if (empty($d)) {

            $d->error[10] = "Le role n'éxiste pas ";
            return $d;
        }

        return $d->info;
    }

    /**
     * deleteRole
     *  delete role by id
     * @param  int $id
     * @return void
     */
    public function deleteRole($id)
    {
        $role = $this->findFirst([
            'conditions' => ['id' => $id]
        ], 't_roles');

        if (empty($role)) {
            $role->error[10] = "Le rôle ne peut être supprimé car il n'existe pas";
            return $role;
        }

        if ($role->role_name == 'admin') {
            $role->error[10] = "Le rôle d'admin ne peut pas être supprimé ";
            return $role;
        }

        $isRole = $this->find([
            'conditions' => ['fk_role_id' => $id]
        ]);

        if (!empty($isRole)) {
            $role->error[10] = "Le rôle que vous voulez supprimer et utilise actuellement par un ou plusieurs utilisateurs veuillez les changer role pour pouvoir supprimer";
            return $role;
        }



        $this->delete($id, 't_roles');

        $this->deleteImg($role->img_role);
    }
    #endregion


}
