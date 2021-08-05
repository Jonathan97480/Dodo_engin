<?php
interface UploadImgInterface
{

    /**
     * upload
     *
     * @param  array $file
     * @param  string $definePath
     * @return string
     */
    public function upload(array $file, string $definePath, bool $autoRename): string;

    /**
     * reSize
     *
     * @param  int $W
     * @param  int $H
     * @param  string $pathImg
     * @return string
     */
    public function reSize(int $W, int $H, string $path, string $pathImg, bool $cropsuqare = false): string;


    /**
     * remove
     *
     * @param  string $pathImg
     * @return bool
     */
    public function remove(string $pathImg): bool;

    /**
     * move
     *
     * @param  string $curentPathImg
     * @param  string $newPathImg
     * @return bool
     */
    public function move(string $curentPathImg, string $newPathImg): bool;
}



class UploadImg implements UploadImgInterface
{
    private $img;
    private $imgrezise;


    function __construct()
    {
    }

    /**
     * getImg
     * retourne le chemin verre Votre image 
     * @return string
     */
    public function getImg(): string
    {

        if (is_null($this->img)) {

            throw new Exception("L'image n'existe pas encore");
        }

        return $this->img;
    }


    /**
     * getImgRezise
     *  retourne le chemin verre l'image que vous avez redimensionner avec le méthode resize 
     * @return string
     */
    public function getImgRezise(): string
    {

        if (is_null($this->imgrezise)) {

            throw new Exception("Vous navez pas encore redimensionner Votre Image");
        }

        return $this->imgrezise;
    }


    /**
     * upload
     * Permet de télécharger une image sur le serveur
     * @param  array $file
     * @param  string $definePath
     * @return string
     */
    public function upload(array $file, string $definePath, bool $autoRename = false): string
    {
        //On récupère l'extension du fichier 
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        /*On vérifie que l'extension du fichier correspond au extension que on autorise */
        if (!in_array($extension, array("gif", "jpg", 'jpeg', "png"))) {

            throw new Exception('L\'extension du fichier est incorrecte');
        }
        /* Traitement du path */
        $path = $this->pathNormalize($definePath);

        /* on définit dans quelle dossier on va poster l'image  */
        $dir = WEBROOTT . DS . $path;

        /*On vérifie que ce dossier existe  */
        if (!file_exists($dir)) {
            /* On crée le dossier si il n'existe pas  */
            mkdir($dir, 0777, true);
        }
        /* on concatène le chemin verre le dossier avec le non du fichier */
        $newName = "";
        if ($autoRename) {
            $newName = uniqid('img_') . "." . $extension;
            $filetowrite = $dir .  DS . $newName;
        } else {

            $filetowrite = $dir .  DS . $file['name'];
        }

        /* on déplace notre image a l'emplacement que on a définie  */
        if (move_uploaded_file($file['tmp_name'], $filetowrite)) {

            if ($autoRename) {
                $v = $definePath . DS . $newName;
            } else {
                $v = $definePath . DS . $file['name'];
            }

            $v = str_replace('\\', '/', $v);
            $this->img = $v;

            return $v;
        }

        throw new Exception('Le fichier ñ\'a pas pu etre importer');
    }

    /**
     * remove
     *  Supprime l'image du serveur
     * @param  mixed $pathImg
     * @return bool
     */
    public function remove(string $pathImg): bool
    {
        $path = WEBROOTT . DS . $pathImg;
        $path = $this->pathNormalize($path);


        $path = str_replace('/', '\\', $path);


        if (file_exists($path)) {

            unlink($path);

            if (file_exists($path)) {

                throw new Exception("l'image n'exite pas ou vous n'avez pas les permissions nécessaire pour la supprimer ");
            }
        }

        return true;
    }

    /**
     * move
     *  permet de déplacer une Image
     * @param  mixed $curentPathImg
     * @param  mixed $newPathImg
     * @return bool
     */
    public function move(string $curentPathImg, string $newPathImg): bool
    {
        $dir = $this->pathNormalize($newPathImg);
        $dir = WEBROOTT . DS . $dir;
        if (move_uploaded_file($curentPathImg, $dir)) {

            unlink($curentPathImg);
            $this->img = $dir;
            return $dir;
        }

        throw new Exception('Le fichier ñ\'a pas pu étre importer');
    }
    /**
     * pathNormalize
     *  Normalise le chemin selon le système d'exploitation du serveur 
     * @param  string $path
     * @return string
     */
    private function pathNormalize(string $path): string
    {

        $v = explode("/", $path);
        $maxElements = count($v);
        $newPath = "";

        for ($i = 0; $i < $maxElements; $i++) {

            if ($i != $maxElements - 1) {

                $newPath =  $newPath . $v[$i] . DS . "";

                continue;
            }

            $newPath = $newPath . $v[$i];
        }


        return $newPath;
    }
    /**
     * reSize
     *
     * @param  int $W
     * @param  int $H
     * @param  string $path
     * @param  string $pathImg
     * @return string
     */
    public function reSize(int $W, int $H, string $path, string $pathImg = null, bool $cropSquare = false): string
    {

        if (is_null($pathImg)) {

            if (!is_null($this->img)) {

                $pathImg = $this->img;
            } else {

                throw new Exception("Il faut un path verre une image pour utiliser cette méthode");
            }
        }

        if (is_null($this->img)) {

            $this->img = $pathImg;
        }
        /* on stock le chemin ou se trouve notre image actuellement */

        $nameImg =  explode("/", $pathImg);

        $nameImg = $nameImg[count($nameImg) - 1];
        //On récupère l'extension du fichier 
        $extension = strtolower(pathinfo($nameImg, PATHINFO_EXTENSION));

        $oldPath = WEBROOTT . DS . $pathImg;
        $oldPath = str_replace("/", "\\", $oldPath);


        //On stock notre nouvelle image dans la cette variable 
        $new_img = new img($oldPath);
        if ($cropSquare) {
            $new_img->cropSquare();
        }
        /* On redimensionne notre image avec les dimension demander   */
        $new_img->resize($W, $H);

        //On définie le nom que on vas donnée a notre nouvelle image 
        $new_fil_name = uniqid('img_') . "." . $extension;

        $filetowrite = WEBROOTT  .  DS . $path . DS . $new_fil_name;
        $filetowrite = str_replace("/", "\\", $filetowrite);

        /* on stock notre nouvelle image dans le chemin défini ho dessue  */

        $new_img->store($filetowrite);

        $new_fil_name = $path . DS . $new_fil_name;
        $this->imgrezise = str_replace('\\', '/', $new_fil_name);

        return $new_fil_name;
    }
}
