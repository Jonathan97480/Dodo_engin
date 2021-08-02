<?php
class Message extends Model
{
    public $table = 't_messages';


    /**
     * getAllmessage
     * Renvoie tous les messages 
     * @return array|bool
     */
    public function getAllmessage()
    {

        $d = $this->find([
            'fields' => 'id,objet_message,date,is_read'
        ]);

        return $d;
    }

    /**
     * deleteMessage
     *  permet de supprimer un message dans la messagerie de l'administration
     * @param  int $id
     * @return void
     */
    public function deleteMessage($id)
    {

        try {

            $this->readMessage($id);
            $this->delete($id);
            return;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * postMessage
     *  Rajoute des messages dans la messagerie de l'administration 
     * @param  string $email
     * @param  string $obj
     * @param  string $content
     * @param  string $fullName
     * @return void
     */
    public function postMessage($email, $obj, $content, $fullName)
    {
        $m = new stdClass();

        /* Validation du formulaire */
        if (!isVarsEmpty([$obj, $email, $content, $fullName])) {





            if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {

                throw new Exception("email Invalide .", 10);
            }



            $this->save([
                'objet_message' => htmlspecialchars($obj),
                'email' => $email,
                'content_message' => htmlspecialchars($content),
                'full_name' => htmlspecialchars($fullName)
            ]);

            return;
        }


        throw new Exception('Tous les champs ne sont pas remplies', 20);
    }

    /**
     * readMessage
     *  retourne le message a lire et le définie comme Vue par l'administrateur 
     * @param  int $id
     * @return array|stdClass
     */
    public function readMessage($id)
    {

        if (is_numeric($id) == false) {

            throw new Exception("id type incorrect . ");
        }

        $m = new stdClass();

        $m->message = $this->findFirst([

            'conditions' => ['id' => $id]
        ]);

        if (empty($m->message)) {
            throw new Exception("Ce message n'existe pas .");
        }

        $this->save([

            'id' => $id,
            'is_read' => 1
        ]);

        return $m->message;
    }

    /**
     * getNewMessages
     *  retourne les 5 dernier message qui ne sont pas encore lue et renvoi aussi le nombre de message à lire
     * @return array|stdClass
     */
    public function getNewMessages()
    {

        $d = new stdClass();

        $d->info = $this->find([
            'conditions' => ['is_read' => '0'],
            'LIMIT' => '0,5',
            'ORDER BY' => 'id DESC'
        ]);

        $d->count = $this->countMessages();

        return $d;
    }

    /**
     * countMessages
     *  renvoi le nombre de message a lire ou le nombre de message lue
     * @param bool $is_Read
     * @return strign|Int
     */
    public function countMessages(bool $is_Read = false)
    {

        if (!$is_Read) {
            $d = $this->findCount([
                'is_read' => '0'
            ]);
        } else {
            $d = $this->findCount([
                'is_read' => '1'
            ]);
        }


        return $d;
    }
}
