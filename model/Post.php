<?php


class Post extends Model
{
    public $table = 'post';


    /**
     * GetlisteArticle
     *  Return the first 10 articles per page 
     * @param  string $type
     * @param  int $curentPage
     * @return array|stdClass
     */
    public function  GetlisteArticle($type = null, $curentPage)
    {
        $perPage = 10;


        if ($type == null) {

            $d['posts'] = $this->find(array(
                'fields' => 'id,name,online,type,created,date_edit',


                'limit' => ($perPage * ($curentPage - 1)) . ',' . $perPage
            ));
        } else {

            $d['posts'] = $this->find(array(
                'fields' => 'id,name,online,type,created,date_edit',
                'conditions' => ['type' => $type],

                'limit' => ($perPage * ($curentPage - 1)) . ',' . $perPage
            ));
        }

        /*
                        PAGINATION 
                    */
        /*(FR)  Je récupère dans la base de données les nombres d'entrées qui ont le type post
        (EN) I retrieve from the database the number of entries that have the post type */
        $d['total'] = $this->findCount($type);

        /*(FR) Je fais le calcul du nombre de poste que je répare page
        (EN) I calculate the number of positions I repair page  */
        $d['page'] = ceil($d['total'] / $perPage);

        return $d;
    }

    /**
     * GetBlogByCathegorie
     * return firts 10 blog  by the Cathegorie
     * @param  string $type
     * @param  int $idCathegorie
     * @param  int $curentPage
     * @param  int $paramsPage
     * @return array|stdClass
     */
    public function GetBlogByCathegorie($type, $idCathegorie, $curentPage, $paramsPage = null)
    {
        $d = array();
        $perPage = 10;
        $page = $curentPage;
        $condition = array('online' => 1, 'type' => $type);

        /* (FR) Renvoie le nombre d'entrées qui porte le type post dans la base données */
        $d['total'] = $this->findCount($condition);

        if ($paramsPage != null && $paramsPage <= $d['total']) {

            $page = $paramsPage;
        }

        $r = $perPage * ($page - 1);

        $sql = "SELECT post.id As id ,img_description,name,description ,slug FROM " . $this->table . " 
        LEFT JOIN  t_cathegories_has_post ON t_cathegories_has_post.post_id = " . $this->table . ".id  
        WHERE t_cathegories_has_post.cathegories_id=" . $idCathegorie . " AND type ='" . $type . "' 
        LIMIT $r , $perPage ";


        $d['posts'] = $this->query($sql);

        if (empty($d['posts'])) {

            $d['posts'] = null;
        } else {

            $d['posts'] = $d['posts'];
        }


        /* (FR)Calcul pour définir le nombre de postes par page*/
        $d['page'] = ceil($d['total'] / $perPage);

        return $d;
    }

    /**
     * getLastArticle
     *  return 10 last post 
     * @param  string $type
     * @return array|stdClass
     */
    public function getLastArticle($type)
    {

        $sql = "SELECT id,name,slug FROM " . $this->table . " 
        WHERE type='" . $type . "' AND online=1 ORDER BY id DESC LIMIT 1,10";

        $d = $this->query($sql);

        return $d;
    }

    /**
     * GetArticleByType
     *return firts 10 Article by the Cathegorie
     * @param  string $type
     * @param  int $curentPage
     * @param  int $paramsPage
     * @return array|stdClass
     */
    public function GetArticleByType($type, $curentPage, $paramsPage = null)
    {

        /*(FR) Je défini le nombre de post par page*/

        $d = array();
        $perPage = 5;

        /*PAGINATION  */
        $condition = array('online' => 1, 'type' => $type);

        /*(FR) Renvoie tous les entrées de type post*/
        $page = $curentPage;

        /* (FR) Renvoie le nombre d'entrées qui porte le type post dans la base données */
        $d['total'] = $this->findCount($condition);

        if ($paramsPage != null && $paramsPage <= $d['total']) {

            $page = $paramsPage;
        }

        $sql = "SELECT    post.id AS id,post.name ,post.description AS description ,img_description,date_edit,slug, GROUP_CONCAT( t_cathegories.name ORDER BY t_cathegories.name  ) AS catName FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE  type='" . $type . "' AND online =1 GROUP BY post.id LIMIT " . ($perPage * ($page - 1)) . ',' . $perPage;

        $d['posts'] = $this->query($sql);

        /* (FR)Calcul pour définir le nombre de postes par page */
        $d['page'] = ceil($d['total'] / $perPage);

        return $d;
    }



    /**
     * GetListProjet
     * return les 4 dernière entrée pout les catégories Site Maquette et Logo
     * @return array|stdClass
     */
    public function GetListProjet()
    {

        $sql = "SELECT post.id AS id,post.name ,img_description,slug FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE  type='projet' AND online =1 AND t_cathegories.name='Site' GROUP BY post.id LIMIT 0 , 5 ";

        $d["site"] = $this->query($sql);



        $sql = "SELECT post.id AS id,post.name ,img_description,slug FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE  type='projet' AND online =1 AND t_cathegories.name='Maquette' GROUP BY post.id LIMIT 0 , 5 ";

        $d["maquette"] = $this->query($sql);

        $sql = "SELECT post.id AS id,post.name ,img_description,slug FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE  type='projet' AND online =1 AND t_cathegories.name='Logo' GROUP BY post.id LIMIT 0 , 5 ";

        $d["logo"] = $this->query($sql);

        return $d;
    }



    /**
     * getPost
     *  renvoi un article de type post grâce a sont id 
     * @param  int $id
     * @return array|stdClass
     */
    public function getPost($id)
    {

        $d = [];

        /*(FR) Je récupère l'article stocker la base de donnée qui correspond à cette $id*/
        $d = $this->findFirst(array(

            /*(FR) Je définis les champs que je veux récupérer */
            'fields'    => 'id,slug,content,name,img_description',

            /*(FR) Je définis mes conditions de recherche */
            'conditions' => array('online' => 1, 'id' => $id, 'type' => 'post')
        ));

        return $d;
    }

    /**
     * getProjet
     * renvoi un article de type projet plus les catégorie qui lui sont lié  grâce a sont id de l'article 
     * @param  int $id
     * @return array|stdClass
     */
    public function getProjet($id)
    {

        $sql = "SELECT post.name ,post.description,img_description,date_edit,slug,t_cathegories.name AS nameCat,content,date_edit FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE type='projet' AND online =1 AND post.id =$id";

        $r = $this->query($sql);

        if (!empty($r)) {
            $d['projet'] = $r[0];
            return $d;
        }

        $d['projet'] = null;

        return $d;
    }
    /**
     * getProjetByTag
     * renvoi tous les articles de type projet qui on le même tag 
     * @param  string $cat
     * @return array|stdClass
     */
    public function getProjetByTag($cat)
    {


        $sql = "SELECT post.id AS id ,post.name ,post.description,img_description,date_edit,slug,t_cathegories.name AS nameCat,content,date_edit FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE type='projet' AND online =1 AND t_cathegories.name = '$cat'";

        $r = $this->query($sql);


        return $r;
    }

    /**
     * getLastProjet
     * return les 5 dernier projet poster dans la BD
     * @return array|stdClass
     */
    public function getLastProjet()
    {


        $d = array();


        $sql = "SELECT post.id AS id,post.name ,post.description AS description,img_description,date_edit,slug,t_cathegories.name AS nameCat FROM post
       LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
       LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
       WHERE type='projet' AND online =1 ORDER BY post.id DESC LIMIT 0,5 ";

        $d = $this->query($sql);



        return $d;
    }

    /**
     * getPostByName
     * Permet de faire une recherche dans les articles 
     * @param  string $Search
     * @return array|stdClass
     */
    public function getPostByName($Search)
    {
        $post = new stdClass();
        $fields = "id,name,slug,created,img_description,description";

        if ($Search != null) {
            $Search = htmlspecialchars($Search);
            $post->info = $this->query('SELECT ' . $fields . ' FROM  ' . $this->table . ' WHERE name LIKE "%' . $Search . '%" ORDER BY id DESC');

            if (empty($post->info)) {

                $post->info = $this->query('SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE CONCAT(name,content) LIKE "%' . $Search . '%" ORDER BY id DESC');
            }

            if (!empty($post->info)) {
                return $post->info;
            }
        }
        unset($post->info);

        throw new Exception("Aucun article n'a été trouvé");
    }

    /**
     * getPostById
     * return un article de type post plus les catégorie qui lui sont attacher grâce a sont id 
     * @param  int $id
     * @return array|stdClass
     */
    public function getPostById($id)
    {
        $post = new stdClass();

        $fields = '' . $this->table . ".id AS id ,
        " . $this->table . ".name AS name,
        type,
        " . $this->table . ".description AS description,
        img_description,
        content,
        online,
        t_cathegories.name AS catName,
        GROUP_CONCAT(  t_cathegories.id ORDER BY t_cathegories.id ) AS idCat";

        $sql = "SELECT $fields FROM " . $this->table . " 
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id=" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE " . $this->table . ".id=$id";

        $post->info = $this->query($sql);

        if (!empty($post->info)) {

            return $post->info[0];
        }

        throw new Exception("l'article demandée n'existe pas");
    }

    /**
     * setPost
     * permet de poster un nouvelle article 
     * @param  string $name
     * @param  string $description
     * @param  string $content
     * @param  mixed $type
     * @param  mixed $online
     * @param  array $categorieListe
     * @param  array $file
     * @param  int $id
     * @return array|stdClass
     */
    public function setPost($name, $description, $content, $type, $online = null, $categorieListe = null, $file = null, $id = null)
    {
        $post = new stdClass();
        $img = null;

        if ($id == null) {

            $post->info = $this->find([
                'conditions' => ['name' => $name]
            ]);

            if (!empty($post->info)) {

                throw new Exception("vous avez déjà un article qui porte ce nom");
            }
        } else {

            $post->info = $this->find([
                'conditions' => ['id' => $id]
            ]);

            if (empty($post->info)) {

                throw new Exception("Cette article n'existe pas");
            }
        }

        /* Partie Save image dans la table media */

        if (!empty($file['name'])) {

            try {
                $img = new UploadImg();
                $img->upload($file, 'img/post');

                $img->reSize(870, 350, 'img/post', $img->getImg());
                $img->remove($img->getImg());
                $img = $img->getImgRezise();

                /* $img = $this->saveImgPost($file, 870, 350); */

                if ($id != null) {
                    $e = new UploadImg();
                    $e->remove($post->info[0]->img_description);
                }
            } catch (Exception $e) {

                throw new Exception($e->getMessage());
            }
        } elseif ($id == null) {

            throw new Exception("vous devez préciser une image à votre article");
        }

        unset($post->info);

        if ($img != null) {

            $post->img_description = $img;
        }

        $post->name = htmlspecialchars($name);

        $post->description = htmlspecialchars($description);

        $post->content = $content;
        $post->type = $type;

        if ($id == null) {

            $post->slug = AutoLinks($name);
            $post->created = date('Y-m-d h:i:s');
        } else {

            $post->id = $id;
            $post->date_edit = date('Y-m-d h:i:s');
        }

        if ($online != null) {

            $post->online = 1;
        } else {

            $post->online = 0;
        }



        /* sauvegarde de l'article  */

        $idReturn = $this->save($post);
        $id == null ? $id = $idReturn : '';
        /*      if ($id == null) {

            $id =  $idReturn;
        } */


        if ($categorieListe != null) {

            /* Gestion des catégories */
            foreach ($categorieListe as $key => $value) {

                $this->saveCategoriesPost($id, $value);
            }
        }

        return $id;
    }

    /**
     * saveCategoriesPost
     * permet de lier des catégorie a votre article 
     * @param  int $idPost
     * @param  int $idCat
     * @return void
     */
    private function saveCategoriesPost($idPost, $idCat)
    {

        $d = $this->find([

            'conditions' => [
                'post_id' => $idPost,
                'cathegories_id' => $idCat
            ]

        ], 't_cathegories_has_post');

        if (empty($d)) {

            $this->save([

                'post_id' => $idPost,
                'cathegories_id' => $idCat

            ], 't_cathegories_has_post');
        }
    }

    /**
     * supprime un article grâce a sont id 
     * @param  int $id
     * @return void
     */
    public function deletePost($id)
    {

        $img = $this->findFirst([
            'conditions' => ['id' => $id],
            'fields' => 'img_description'
        ]);
        $this->delete($id);


        $this->primaryKey = 'post_id';
        $this->delete($id, 't_cathegories_has_post');

        $e = new UploadImg();
        $e->remove($img->img_description);
    }


    /**
     * GetNumberArticle
     * Retourne le nombre article présent dans un type donnée 
     * @param  string $type
     * @return int|array
     */
    public function GetNumberArticle(string $type)
    {

        $value = $this->findCount(['type' => $type]);

        return $value;
    }
}
