<?php

class Session
{
    function __construct()
    {
        /* si la variable Session n'est pas encore initialiser  */
        if (!isset($_SESSION)) {
            /* je démarre une session  */
            session_start();
        }
    }
    /**
     * setFlash
     * Permet définir des info pour ensuite les afficher sur la vue pour 
     * récupérait dune info de session ou d'une action en cours ou une erreur
     * @param string $message
     * @param string $type 
     * @return void
     */
    function setFlash($message, $type = 'bg-success', $parametre = null)
    {
        if ($parametre == null) {
            $parametre = array();
        }
        $_SESSION['flash'] = array(
            'message' => $message,
            'type' => $type,

        );
        $this->write('ReturnForm', $parametre);
    }


    /**
     * flash
     * Fonction a placer dans sa vu pour voir les message de type flache
     * @return string
     */
    public function flash(): string
    {

        if (isset($_SESSION['flash']['message'])) {

            $html = '<div class="alert-message ' . $_SESSION['flash']['type'] . ' text-white "><p>' . $_SESSION['flash']['message'] . '</p></div>';

            $_SESSION['flash'] = array();
            $this->deleteVar('ReturnForm');

            return $html;
        }
        return "";
    }
    /**
     * getFormReturn
     * encas erreur de validation de votre formulaire récupérait
     *  le contenue du formulaire grâce a cette méthode 
     *  @return bool|stdClass
     */
    public function getFormReturn()
    {

        $data = $this->read('ReturnForm');

        if (empty($data)) {
            return false;
        }

        return $data;
    }

    /**
     * deleteVar
     * supprime de la Session  les valeur associer à votre clé
     * @param  mixed $key
     * @return void
     */
    private function deleteVar($key)
    {
        if (isset($_SESSION[$key])) {

            unset($_SESSION[$key]);
            return;
        }

        throw new Exception("la clé n'est pas présent dans la Session .");
    }

    /* Permet de stoker un user et ces info dans la variable $_SESSION */
    /**
     * write
     * permet d'enregistré des donné dans la session
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function write($key, $value): void
    {

        $_SESSION[$key] = $value;
    }



    /**
     * read
     * permet lire les donnés dans le session para pore a 
     * la clé qui a était utiliser pour les sauvegarder
     * @param  mixed $key
     * @return bool|object
     */
    public function read($key)
    {

        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        }

        return false;
    }

    /**
     * GetRole
     * récupère le rôle de utilisateur connectée
     * @return bool|strign
     */
    public function GetRole()
    {
        $role = $this->user('role_name');

        if ($role) {

            return $role;
        }

        return null;
    }

    /**
     * @param string key
     * récupère les infos sur l'utilisateur
     *  connecté par rapport à la clé passée en paramètre 
     * @return 
     * */
    public function user($key)
    {
        $user_key = $this->read('User');

        if ($user_key) {


            if (isset($user_key->$key)) {

                return $user_key->$key;
            }
        }
        return false;
    }

    /* Gestion CSRF  */

    /**
     * generateCSRF
     * génère la clé CSRF
     */
    private function generateCSRF()
    {

        $_SESSION['csrf'] = md5(time() + rand());
    }


    /**
     * getParamCSRF
     * récupère la clé CSRF au format params pour l'url 
     * @return string
     */
    public function getParamCSRF(): string
    {

        if (isset($_SESSION['csrf'])) {

            return "/csrf:" . $_SESSION['csrf'];
        }

        throw new Exception("La clé CSRF n'ai pas encore défini .");
    }

    /**
     * getCSRF
     * récupère la clé CSRF
     * @return string
     */
    public function getCSRF(): string
    {

        if (isset($_SESSION['csrf'])) {

            return  $_SESSION['csrf'];
        }

        throw new Exception("La clé CSRF n'ai pas encore défini .");
    }

    /**
     * checkCSRF
     * vérifie si la clé CSRF est authentique 
     * @param  string $key
     * @return bool
     */
    function checkCSRF($key): bool
    {

        if ($key === $_SESSION['csrf']) {

            return true;
        }

        return false;
    }
}
