<?php
class Commentaire extends Model
{
    public $table = 't_commentaires';
    public $cont = 0;

    /**
     * getComentaire
     * return commentaire link the post
     * @param  int $idPost
     * @param  int $idCommentaire
     * @return void
     */
    public function getComentaire($idPost, $idCommentaire = null)
    {

        $d = [];

        $sql = "SELECT t_commentaires.id AS id, content, date_com,id_article ,t_users.login,t_users.avatar,id_user,id_reponce FROM " . $this->table . " 
        LEFT JOIN t_users ON t_users.id =id_user ";

        if ($idCommentaire == null) {

            $sql .= " WHERE id_article =$idPost AND id_reponce is null";
        } else {

            $sql .= " WHERE id_article =$idPost AND t_commentaires.id=$idCommentaire ";
        }


        $d['com'] = $this->query($sql);

        $this->count = 0;

        $d['com'] = $this->getResponses($d['com']);

        $d['contCom'] = $this->count;

        return $d;
    }
    /**
     * getResponses
     * return responses link in the commentaire parent
     * @param  array|stdClass $commentaire
     * @return array|stdClass 
     */
    private function getResponses($commentaire)
    {

        foreach ($commentaire as $key => $value) {
            $this->count++;
            $sql = "SELECT t_commentaires.id AS id, content, date_com,id_article ,t_users.login,t_users.avatar,id_user,id_reponce FROM " . $this->table . " 
            LEFT JOIN t_users ON t_users.id =id_user 
            WHERE id_article = $value->id_article AND id_reponce = $value->id";

            $d = $this->query($sql);

            $value->reponses = $this->getResponses($d);

            $commentaire[$key] = $value;
        }

        return $commentaire;
    }

    /**
     * postCommentaire
     * save commentaire in the BD
     * @param  string $login
     * @param  int $idPost
     * @param  string $message
     * @param  int $idParent
     * @param  int $idUser
     * @return array|stdclass
     */
    public function postCommentaire($login = null, $idPost, $message, $idParent = null, $idUser = null)
    {
        $myMessage = new stdClass();

        if ($login == null && $idUser == null) {

            $myMessage->error[10] = "Vous devez préciser un login ou vous connectez";
        }

        if ($login != null) {

            $myMessage->info['login'] = $login;
        } else {

            $myMessage->info['id_user'] = $idUser;
        }

        if ($idParent != null) {
            $myMessage->info['id_reponce'] = $idParent;
        }

        $myMessage->info['id_article'] = $idPost;
        $myMessage->info['content'] = $message;

        $id =  $this->save($myMessage->info);

        $message = $this->getComentaire($idPost, $id);

        return $message;
    }
}
