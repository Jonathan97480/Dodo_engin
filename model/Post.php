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
        /* (FR) Renvoie le nombre d'entrées qui porte le type post dans la base données
                     (EN) Returns the number of entries with type post in the database */
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

        /*  */
        /* (FR)Calcul pour définir le nombre de postes par page
        (EN) Calculation to define the number of posts per page */

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

        /*(FR) Je défini le nombre de post par page
       (EN) I define the number of posts per page*/
        $d = array();
        $perPage = 5;

        /*
                           PAGINATION 
                       */
        $condition = array('online' => 1, 'type' => $type);

        /*(FR) Renvoie tous les entrées de type post
                     (EN) Returns all post type entries
                     
                     */
        $page = $curentPage;

        /* (FR) Renvoie le nombre d'entrées qui porte le type post dans la base données
                     (EN) Returns the number of entries with type post in the database */
        $d['total'] = $this->findCount($condition);

        if ($paramsPage != null && $paramsPage <= $d['total']) {

            $page = $paramsPage;
        }

        $sql = "SELECT    post.id AS id,post.name ,post.description AS description ,img_description,date_edit,slug, GROUP_CONCAT( t_cathegories.name ORDER BY t_cathegories.name  ) AS catName FROM post
        LEFT JOIN t_cathegories_has_post ON t_cathegories_has_post.post_id =" . $this->table . ".id 
        LEFT JOIN t_cathegories ON t_cathegories.id= t_cathegories_has_post.cathegories_id 
        WHERE  type='" . $type . "' AND online =1 GROUP BY post.id LIMIT " . ($perPage * ($page - 1)) . ',' . $perPage;

        $d['posts'] = $this->query($sql);
        /*  */
        /* (FR)Calcul pour définir le nombre de postes par page
        (EN) Calculation to define the number of posts per page */

        $d['page'] = ceil($d['total'] / $perPage);

        return $d;
    }

    /**
     * getPost
     *  return post by id
     * @param  int $id
     * @return array|stdClass
     */
    public function getPost($id)
    {
        $d = [];
        /*(FR) Je récupère l'article stocker la base de donnée qui correspond à cette $id
        (EN) I get the article store the database that corresponds to this id */
        $d = $this->findFirst(array(

            /*(FR) Je définis les champs que je veux récupérer
            (EN) I define the fields that I want retrieve */
            'fields'    => 'id,slug,content,name,img_description',

            /*(FR) Je définis mes conditions de recherche 
               (EN) I define my search conditions  */
            'conditions' => array('online' => 1, 'id' => $id, 'type' => 'post')
        ));

        return $d;
    }

    /**
     * getProjet
     * return projet by id
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
     * getLastProjet
     *
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
     * reutrn post by name 
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

        $post->error = "Aucun article n'a été trouvé";
        return $post->error;
    }

    /**
     * getPostById
     * Allows you to retrieve any type of post via its id
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

        if (empty($post->info)) {
            $post->error[20] = "l'article demandée n'existe pas";
            return $post;
        }
        return $post->info[0];
    }

    /**
     * setPost
     * Allows you to add or update a post
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

        if ($id == null) {

            $post->info = $this->find([
                'conditions' => ['name' => $name]
            ]);

            if (!empty($post->info)) {

                $post->error[10] = "vous avez déjà un article qui porte ce nom";
                return $post;
            }
        } else {

            $post->info = $this->find([
                'conditions' => ['id' => $id]
            ]);

            if (empty($post->info)) {

                $post->error[10] = "l'article n'existe pas";
                return $post;
            }
        }

        /* Partie Save image dans la table media */

        if (!empty($file['name'])) {


            $img = $this->saveImg($file, 870, 350);


            /* On vérifie que il Ya hu aucune hereure pendant la sauvegardé de l'image */
            if (is_array($img)) {

                $post->error = $img;
                return $post;
            } else {

                if ($id != null)

                    $this->deleteImg($post->info[0]->img_description);
            }
        } else {

            if ($id != null) {
            } else {

                $post->error[50] = "vous devez préciser une image à votre article";
                return $post;
            }
        }

        unset($post->info);

        if (isset($img)) {

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
        /* Vérification Avant Sauvegarde */


        /* sauvegarde de l'article  */
        /* je n'ais plus besoin de cette variable je la retire avant la sauvegarde */
        $idReturn = $this->save($post);

        if ($id == null) {

            $id =  $idReturn;
        }

        if ($categorieListe != null) {

            /* Gestion des categories */
            foreach ($categorieListe as $key => $value) {

                $this->saveCategoriesPost($id, $value);
            }
        }

        return $id;
    }

    /**
     * saveCategoriesPost
     * Allows you to link categories to the post
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
     * deletePost
     *  delete post by id
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

        $this->deleteImg($img->img_description);
    }
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

            $dir = WEBROOTT . DS . 'img' . DS . 'post';

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


                    $new_img->resize($w, $h);

                    //Define the file name
                    $new_fil_name = uniqid('img_') . "." . $extension;
                    $filetowrite = $dir .  DS . $new_fil_name;

                    $new_img->store($filetowrite);

                    unlink($oldImg);

                    return  'post' . DS . $new_fil_name;
                } else {

                    return  'post' . DS . $file['name'];
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

    public function GetNumberPost(string $type)
    {

        $value = $this->findCount(['type' => $type]);

        return $value;
    }
    #endregion
}
