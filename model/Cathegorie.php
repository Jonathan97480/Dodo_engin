<?php
class Cathegorie extends Model
{
     public $table = 't_cathegories';

     #region cathegorie

     /**
      * getListeCathegorie
      * return liste cathegorie or unique cathegorie by id
      * @param  int $id
      * @return void
      */
     public function getListeCathegorie($id = null)
     {

          if (empty($id)) {
               $d = $this->find(array());
          } else {
               $d = $this->find([
                    'conditions' => ['id!' => $id]
               ]);
          }

          foreach ($d as $key => $value) {

               $value->nameParent = $this->findFirst([
                    'conditions' => ['id' => $value->categorie_parent],
                    'fields' => 'name'
               ]);
               if (isset($value->nameParent->name)) {
                    $value->nameParent = $value->nameParent->name;
               }
               $d[$key] = $value;
          }

          return $d;
     }

     /**
      * saveCathegorie
      * Sauvegarder ou mettre ajour des catégories
      * @param  string $name
      * @param  string $description
      * @param  string $file
      * @param  int $id
      * @param  int $categorie_parent
      * @return array|stdClass
      */
     public function saveCathegorie(string $name, string $description, array $file, $id = null, $categorie_parent = "NULL")
     {
          $d = new stdClass();

          /* vérification de la présence du rôle dans la BD */
          $d->info = $this->findFirst([

               'conditions' => ['name' => $name]
          ]);

          if (!empty($d->info) && empty($id)) {
               throw new Exception("Cette categorie existe déja ");
          }

          /* Sauvegarde de l'image dans le serveur */
          if (!empty($file['name'])) {

               if (!empty($d->info)) {

                    if (!empty($d->info->img)  && $this->deleteImg($d->info->img) == false) {

                         throw new Exception("Impossible de supprimer l'ancien images");
                    }
               }

               $img = $this->saveImg($file);

               if (is_array($img)) {

                    $d->error = $img;
                    return $d;
               }
          } elseif (empty($id)) {

               throw new Exception("Vous devez rajouter une image pour le rôle");
          } elseif (!empty($id) && empty($file['name'])) {

               $img = $d->info->img;
          }


          /* sérialisation des donnée a sauvegarder */

          $tag = [
               'name' => htmlspecialchars($name),
               'description' => htmlspecialchars($description),
               'img' => $img
          ];
          if ($categorie_parent != "NULL") {
               $tag['categorie_parent'] = $categorie_parent;
          }
          if (!empty($id)) {
               $tag['id'] = $id;
          }




          $idTag = $this->save($tag);

          if (empty($id) && !empty($idTag)) {

               $id = $idTag;
          }

          $d = $this->getCategorieById($id);

          return $d;
     }

     /**
      * getCategorieById
      * retourne la catégorie qui correspond a l'id passer en paramètre 
      * @param  int $id
      * @return array|stdClass
      */
     public function getCategorieById(int $id)
     {
          $d = new stdClass();

          $d->info = $this->findFirst([

               'conditions' => ['id' => $id]
          ]);

          if (empty($d)) {

               throw new Exception("La categorie n'éxiste pas ");
          }


          $d->info = $this->getChildrenCategorie($d->info);


          return $d->info;
     }
     /**
      * deleteCathegorie
      * supprime la catégorie qui correspond a l'id passer en paramètre 
      * @param  int $id
      * @return void|array|stdClass
      */
     public function deleteCathegorie($id)
     {
          /* vérification si la Cathegorie existe dans la BD */
          $cathegorie = $this->findFirst([
               'conditions' => ['id' => $id]
          ]);

          if (empty($cathegorie)) {
               throw new Exception("La cathegorie ne peut être supprimé car il n'existe pas");
          }

          /* vérification si la catégorie est utiliser sur un article ou un projet  */
          $isPost = $this->find([
               'conditions' => ['cathegories_id' => $id]
          ], 't_cathegories_has_post');

          if (!empty($isPost)) {
               throw new Exception("La cathegorie que vous voulez supprimer et utilisé actuellement par un ou plusieurs Post vous dever changer le tag de ces post avant de supprimer ce tag");
          }



          $this->delete($id);

          $this->deleteImg($cathegorie->img);
     }
     /**
      * getChildrenCategorie
      * retourne les enfants d'une catégorie
      * @param  mixed $cathegorie
      * @return array|stdClass
      */
     private function getChildrenCategorie($cathegorie)
     {

          $d = $this->find([

               'conditions' => ['categorie_parent' => $cathegorie->id]

          ]);

          $cathegorie->child = $d;

          foreach ($cathegorie->child as $key => $value) {
               $cathegorie->child[$key] = $this->getChildrenCategorie($value);
          }



          return $cathegorie;
     }

     /**
      * clearParentCategorie
      * Retire le parent d'une catégorie 
      * @param  int $id
      * @return bool
      */
     public function clearParentCategorie($id)
     {

          $d = $this->findFirst([
               'conditions' => ['id' => $id]
          ]);

          $d->categorie_parent = null;

          $this->save($d);

          return true;
     }
     #endregion
     #region Image traitment

     /**
      * saveImg
      *
      * @param  array $file
      * @param  int $w
      * @param  int $h
      * @param  bool $resize
      * @return string
      */
     private function saveImg(array $file, int $w = 100, int $h = 100, bool $resize = true): string
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

                    throw new Exception('L\'extension du fichier est incorrecte');
               }

               /*Retrieving the current date */

               $dir = WEBROOTT . DS . 'img' . DS . 'icon';

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

                         return  'icon' . DS . $new_fil_name;
                    } else {

                         return  'icon' . DS . $file['name'];
                    }
               } else {
                    throw new Exception('Le fichier ñ\'a pas pu etre importer');
               }
          }
     }

     private function deleteImg(string $imgUrl)
     {

          $baseUrl = WEBROOTT . DS . 'img';

          if (file_exists($baseUrl . DS . $imgUrl)) {

               unlink($baseUrl . DS . $imgUrl);

               if (!file_exists($baseUrl . DS . $imgUrl)) {

                    return true;
               } else {

                    throw new Exception("Inpossible de supprimer l'image");
               }
          }

          return true;
     }


     #endregion

     #region Tags


     /**
      * getListeTags
      *Renvoie la liste des tag
      * @return array|stdClass
      */
     public function getListeTags()
     {

          $d = $this->find([], 't_tags');

          return $d;
     }

     /**
      * saveTag
      * Sauvegarde ou fait la mise ajour d'un tag existant 
      * @param  string $name
      * @param  string $description
      * @param  array $file
      * @param  int $id
      * @param  mixed $tag_parents
      * @return array|stdClass
      */
     public function saveTag(string $name, string $description, array $file, int $id = null, $tag_parents)
     {
          $d = new stdClass();

          /* vérification de la présence du rôle dans la BD */
          $d->info = $this->findFirst([

               'conditions' => ['name_tag' => $name]
          ], 't_tags');

          if (!empty($d->info) && empty($id)) {

               throw new Exception("Ce tag existe déja");
          }

          /* Sauvegarde de l'image dans le serveur */
          if (!empty($file['name'])) {

               if (!empty($d->info)) {

                    if (!empty($d->info->img)  && $this->deleteImg($d->info->img) == false) {

                         throw new Exception("Impossible de supprimer l'ancien images");
                    }
               }

               $img = $this->saveImg($file);

               if (is_array($img)) {

                    $d->error = $img;
                    return $d;
               }
          } elseif (empty($id)) {

               throw new Exception("Vous devez rajouter une image pour le rôle");
          } elseif (!empty($id) && empty($file['name'])) {

               $img = $d->info->url_tag;
          }


          /* sérialisation des données a sauvegarder */

          $tag = [
               'name_tag' => htmlspecialchars($name),
               'description_tag' => htmlspecialchars($description),
               'url_tag' => $img
          ];
          if (!empty($id)) {
               $tag['id'] = $id;
          }


          $idTag = $this->save($tag, 't_tags');

          if (empty($id) && !empty($idTag)) {

               $id = $idTag;
          }

          $d = $this->getTagById($id);

          return $d;
     }

     /**
      * getTagById
      * renvoie le tag qui correspond a l'id
      * @param  int $id
      * @return array|stdClass
      */
     public function getTagById(int $id)
     {
          $d = new stdClass();

          $d->info = $this->findFirst([

               'conditions' => ['id' => $id]
          ], 't_tags');

          if (empty($d)) {
               throw new Exception("Le tag n'éxiste pas ");
          }

          return $d->info;
     }
     /**
      * deleteTag
      * Supprime le tag qui correspond a l'id passer en paramètre 
      * @param  int $id
      * @return void
      */
     public function deleteTag($id)
     {
          /* vérification si le tag existe dans la BD */
          $tag = $this->findFirst([
               'conditions' => ['id' => $id]
          ], 't_tags');

          if (empty($tag)) {
               throw new Exception("Le rôle ne peut être supprimé car il n'existe pas");
          }



          /* vérification si le tag est utiliser sur une image  */
          $isPost = $this->find([

               'conditions' => ['fk_tag_id' => $id]

          ], 'tags_has_medias');

          if (!empty($isPost)) {

               throw new Exception("Le tag que vous voulez supprimer et utilise actuellement par un ou plusieurs Image vous dever changer le tag de ces post avant de supprimer ce tag");
          }

          $this->delete($id, 't_tags');
          $this->deleteImg($tag->url_tag);
     }
     #endregion


}
