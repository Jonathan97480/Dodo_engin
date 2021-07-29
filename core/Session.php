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
     * Permet définir des info pour ensuite les afficher sur la vue pour 
     * récupérait dune info de session ou d'une action en cours ou une erreur
     * @param string message
     * @param string type (non obligatoire) 
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

    /* *
*Fonction a placer dans sa vu pour voir les message de type flache
 */
    public function flash()
    {

        if (isset($_SESSION['flash']['message'])) {
              
            $html = '<div class="alert-message ' . $_SESSION['flash']['type'] . ' text-white "><p>' . $_SESSION['flash']['message'] . '</p></div>';

            $_SESSION['flash'] = array();
            $this->deleteVar('ReturnForm');
            
            return $html;
        }
    }
    public function getFormReturn(){
        
        $data = $this->read('ReturnForm');

        if(empty( $data)){
            return false;
        }

        return $data;

    }

    private function deleteVar($key)
    {

        unset($_SESSION[$key]);
    }

    /* Permet de sotker un user et ces info dans la variable $_SESSION */
    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function read($key)
    {

        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        } else {

            return false;
        }
    }
    /* si l'utilisateur est deja connecter permet de recuperait son role */
    public function GetRole()
    {
        $role = $this->user('role_name');

        if ($role) {

            return $role;
        } else {

            return null;
        }
    }
    /**
     * @param string key
     * @return bool
     *  
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
}
