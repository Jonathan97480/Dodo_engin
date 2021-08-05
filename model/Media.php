<?php
class Media extends Model
{
    public $table = 't_medias';



    /**
     * get_all_img
     *  renvoie toute les images
     * @return stdClass list
     */
    public  function get_all_img()
    {

        $upload_img = new stdClass();

        $upload_img->list = $this->find([]);

        return $upload_img;
    }

    /**
     * delete_img
     *  supprime l'image de la bd et du serveur et retire le liens de l'image au catégories 
     * @param  int $id
     * @return bool 
     */
    public function delete_img(int $id)
    {


        /*We retrieve the info on the image in the database*/
        $media = $this->findFirst(array(
            'conditions' => array('id' => $id)

        ));

        if (!empty($media)) {

            /*Remove image from folder*/
            @unlink(WEBROOTT . DS . 'img' . DS . $media->urlsmall);
            @unlink(WEBROOTT . DS . 'img' . DS . $media->urlbig);

            /*Deletion of image info in the database */
            $this->delete($id);

            $this->primaryKey = "fk_media_id";

            $this->delete($id, 'tags_has_medias');

            try {

                $e = new UploadImg();
                $e->remove($media->urlsmall);
                $e->remove($media->urlbig);
            } catch (Exception $e) {

                throw new Exception($e->getMessage());
            }

            return true;
        } else {

            return false;
        }

        return false;
    }
    /**
     * upload
     * Mets a jour ou ajoute une image a la base de données 
     * @param  array $file (ex:$_FILES)
     * @return stdClass|array file and error
     */
    public function upload(array $file)
    {
        $upload_img = [];


        foreach ($file['name'] as $key => $value) {
            $fil['name'] = $file['name'][$key];
            $fil['type'] = $file['type'][$key];
            $fil['tmp_name'] = $file['tmp_name'][$key];
            $fil['error'] = $file['error'][$key];
            $fil['size'] = $file['size'][$key];
            /* I verify that the file was transmitted by HTTP POST*/
            if (is_uploaded_file($file['tmp_name'][$key])) {

                $e = new UploadImg();

                /*Retrieving the current date */
                $date = (date('Y,m'));
                $temp_date = explode(',', $date);
                $date = $temp_date[0] . '/' . $temp_date[1];
                $dir = 'img' . '/' . $date . '/' . 'big';

                $e->upload($fil, $dir, true);

                $dir = 'img' . '/' . $date . '/' . 'small';

                $e->reSize(150, 150, $dir, $e->getImg(), false);


                /* Serialization of image info to save the database */
                $data = array(
                    'name' => $file['name'][$key],
                    'urlbig' =>  $e->getImg(),
                    'urlsmall' => $e->getImgRezise(),
                    'type' => 'img',
                    'info' => ''

                );

                //We keep the name of the image in the gallery database
                $img_id = $this->save($data);

                if (!empty($img_id)) {

                    $upload_img[$key] = $this->findFirst([
                        'conditions' => ['id' => $img_id]
                    ]);
                } else {
                    throw new Exception('La sauvegarde dans la base de données a échoué');
                }
            }
        }

        return $upload_img;
    }

    /**
     * uploadTyni
     * Téléchargement d'image pour le tynimce
     * @param  mixed $file
     * @return void
     */
    public function uploadTyni($file)
    {
        $file = $file['file'];
        $upload_img = new stdClass;
        $upload_img->file = array();
        $upload_img->error = array();

        /* I verify that the file was transmitted by HTTP POST*/
        if (is_uploaded_file($file['tmp_name'])) {

            //Extension recovery
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            /*I will check that the extensions match */
            if (!in_array($extension, array("gif", "jpg", 'jpeg', "png"))) {

                throw new Exception('L\'extension du fichier est incorrecte');
            }

            /*Retrieving the current date */
            $date = (date('Y,m'));
            $temp_date = explode(',', $date);
            $date = $temp_date[0] . DS . $temp_date[1];
            $dir = WEBROOTT . DS . 'img' . DS . $date;

            /*Check if the folder exists */
            if (!file_exists($dir .  DS . 'big')) {

                mkdir($dir .  DS . 'big', 0777, true);
            }
            /*I define the path where I will save my image and I store it in the variable $filetowrite */
            $new_fil_name = uniqid('img_') . "." . $extension;
            $filetowrite = $dir .  DS . 'big' . DS . $new_fil_name;

            $urlBig = $date .  DS . 'big' . DS . $new_fil_name;
            /* I move file to image folder */
            if (move_uploaded_file($file['tmp_name'], $filetowrite)) {



                //Image resizing
                $new_img = new img($filetowrite);
                $new_img->cropSquare();
                $new_img->resize(150, 150);

                //Define the file name
                if (!file_exists($dir .  DS . 'small')) {

                    mkdir($dir .  DS . 'small', 0777, true);
                }
                $filetowrite = $dir .  DS . 'small' . DS . $new_fil_name;

                $new_img->store($filetowrite);

                /* Serialization of image info to save the database */
                $data = array(
                    'name' => $file['name'],
                    'urlsmall' =>  $date . DS . 'small' . DS . $new_fil_name,
                    'urlbig' => $urlBig,
                    'type' => 'img',
                    'info' => ''

                );

                //We keep the name of the image in the gallery database
                $img_id = $this->save($data);

                if (!empty($img_id)) {

                    $upload_img = $this->findFirst([
                        'conditions' => ['id' => $img_id]
                    ]);

                    return $upload_img->urlbig;
                } else {
                    throw new Exception('La sauvegarde dans la base de données a échoué');
                }
            } else {
                throw new Exception('Le fichier ñ\'a pas pu etre importer');
            }
        }
    }
    /**
     * getGaleriePicture
     *  retourne toute les images destiner a la galerie
     * @return array!stdClass
     */
    public function getGaleriePicture()
    {
        $d = $this->find([
            'fields' => 'urlsmall,urlbig,id,name'
        ]);
        return $d;
    }
    public function getInfoPicture($id)
    {

        $fields = 'name,info,isgalerie ,' . $this->table . '.id AS id, GROUP_CONCAT(  t_tags.name_tag ORDER BY t_tags.name_tag  ) AS tagName';

        $sql = "SELECT $fields FROM " . $this->table . " 
        LEFT JOIN tags_has_medias ON fk_media_id =" . $this->table . ".id  
        LEFT JOIN t_tags ON t_tags.id =tags_has_medias.fk_tag_id
        WHERE " . $this->table . ".id = $id AND type='img'  GROUP BY t_medias.id  ";

        $d = $this->query($sql);

        $d[0]->tagName = explode(',', $d[0]->tagName);

        return $d[0];
    }
    /**
     * saveInfoPicture
     * update info picture (name and description and tags)
     * @param  string $name
     * @param  string $info
     * @param  array $tag
     * @param  int $id
     * @return array|stdClass
     */
    public function saveInfoPicture($name, $description, $tag = null, $id, $isGalerie = null)
    {

        $info = new stdClass();

        $info->result = $this->findFirst([
            'conditions' => ['id' => $id]
        ]);

        if (empty($info)) {
            throw new Exception("l'image n'existe pas");
        }

        unset($info->result);


        if (is_numeric($id)) {

            $info->name = htmlspecialchars($name);
            $info->info = htmlspecialchars($description);
            $info->id = $id;

            if ($isGalerie == 1) {
                $info->isgalerie = 1;
            } else {
                $info->isgalerie = 0;
            }

            $this->save($info);

            $this->linkPictureToCategorie($id, $tag);



            $info = new stdClass();
            $info->id = $id;

            return $info;
        } else {
            throw new Exception("Une erreure est survenue");
        }
    }

    /**
     * linkPictureToCategorie
     * create jointure t_medais and  tags_has_medias
     * @param  int $idPicture
     * @param  array $catId
     * @return void
     */
    private function linkPictureToCategorie($idPicture, $catId = null)
    {
        $this->primaryKey = 'fk_media_id';
        $this->delete($idPicture, 'tags_has_medias');

        $this->primaryKey = 'id';
        if ($catId != null) {

            foreach ($catId as $key => $value) {

                $this->save([
                    'fk_media_id' => $idPicture,
                    'fk_tag_id' => $value
                ], 'tags_has_medias');
            }
        }
    }

    /**
     * getGalerie
     * Returns the images selected by the user to be displayed in the gallery
     * @return void
     */
    public function getGalerie()
    {

        $fields = $this->table . '.id AS id , urlsmall ,urlbig,name ,name_tag ';

        $sql = "SELECT $fields FROM " . $this->table . " 
      LEFT JOIN tags_has_medias ON tags_has_medias.fk_media_id = " . $this->table . ".id 
      LEFT JOIN t_tags ON t_tags.id=tags_has_medias.fk_tag_id 
      WHERE isgalerie = 1 ";

        $d['pic'] = $this->query($sql);

        $d['tags'] = $this->find([], 't_tags');

        return $d;
    }
}
