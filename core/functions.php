<?php
function debug($var)
{
    /* (FR)La fonction debug peut être appelé de n'importe où dans le projet
   (EN) The debug function can be called from anywhere in the project */
    if (conf::$debug > 0) {

        /* (FR)Je stock les info de la fonction debug_backtrace
       (EN) I store the info of the debug_backtrace function */
        $debug = (debug_backtrace());

        /* (FR)J'affiche en HTML le numéro de la ligne et le nom du fichier de ou l'appel a été fait
      (EN) I display in HTML the line number and the name of the file where the call was made */
        echo '<p>&nbsp;</p>
        <p>
            <a  href="#">
            
                <strong>' . $debug[0]['file'] . '</strong> l.' . $debug[0]['line'] . '
            </a>
        </p>';
        /*(FR) J'affiche par où est passé mon appel avant d'arriver à mon debug
        (EN) I post where my call went before arriving at my debug */
        echo '<ol >';
        foreach ($debug as $k => $v) {
            if ($k > 0) {
                echo '<li><strong>' . $v['file'] . '</strong>l.' . $v['line'] . '</li>';
            }
        }
        /*(FR)Pour finir on affiche le compte de la variable
        (EN) Finally we display the account of the variable */
        echo '</ol>';
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

/**
 * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
 * @param bool $succes if these equal false the request failed if equal true the request succeeded
 * @param string $msg Can contain a message to send
 * @param array|stdClass $results The result of the API request 
 * Returns the result of the request to the user in json format
 */
function  retour_json(bool $succes, string $msg,  $results = null)
{
    header('Content-Type: application/json');
    header("Content-Security-Policy: default-src 'self'");
    
    $retour['success'] = $succes;
    $retour['message'] = $msg;
    $retour['results'] = $results;


    echo json_encode($retour);

    exit();
}

/**
 * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
 * @param array $vars An array of variables
 * @return bool  
 * Allows you to pass several variables in an array to test if it is not empty
 */
function isVarsEmpty(array $vars): bool
{

    foreach ($vars as $key => $value) {

        if (empty($value)) {
            return true;
        }
    }
    return false;
}

/**
 * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
 * @param int $strength The desired length for the key
 * @return string  
 * Key generator for the API
 */
function generate_Key_api(int $strength = 16): string
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

/**
 * SaveImage
 *
 * @param  mixed $file
 * @param  mixed $type
 * @param  mixed $is_rename
 * @param  mixed $save_data_base
 * @return stdClass
 */
function SaveImage($file,  array $type = null, bool $is_rename = false, Model $save_data_base = null):stdClass
{

    $result = new stdClass();
    $result->urlImg = '';
    $result->error = '';
    reset($file);
    $temp = current($file);
    /* (FR)Je vais vérifier que les extensions correspondent */
    /* (EN)I will check that the extensions match */
    if ($type == null) {
        $type = array("gif", "jpg", "png", "svg");
    }
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), $type)) {
        header("HTTP/1.1 400 Invalid extension.");
        return null;
    }

    /* (FR)Récupération de la date courante
        (FN)Retrieving the current date */
    $date = (date('Y,m'));
    $temp_date = explode(',', $date);
    $date = $temp_date[0] . DS . $temp_date[1];
    $dir = WEBROOTT  . DS . 'img' . DS . $date;



    /*(FR)Vérifie si le dossier existe
         (EN)Check if the folder exists */
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    /*(FR) Je définis le chemin où je vais enregistrer mon image et je la stock dans la variable $filetowrite*/
    /* (EN)I define the path where I will save my image and I store it in the variable $filetowrite */
    $filetowrite = $dir .  DS . $temp['name'];

    /*(FR)Vérifie si le fichier existe
        (EN) Check if the file exists */
    if (!file_exists($dir . DS . $temp['name'])) {



        /* (FR)Je déplacer fichier dans le dossier image
            (EN) I move file to image folder */
        move_uploaded_file($temp['tmp_name'], $filetowrite);

        if (file_exists($filetowrite)) {

            $result->urlImg = 'img' . DS . $date . DS . $temp['name'];
            /* save dans la base de donée Média  */
            if ($save_data_base != null) {
                $data = array(
                    'name' => $temp['name'],
                    'url' =>  $temp_date[0] . '/' . $temp_date[1] . '/' . $temp['name'],
                    'type' => 'img',
                    'info' => ''

                );
                $save_data_base->save($data);
            }
            return  $result;
        }
        $result->error = "err:Nous n'avons pas pus créer le fichier dans le serveur verfier les droit decriture";
        return $result;
    } else {

        /* si is_rename et egale a true je renome le fichier si il existe deja  */
        if ($is_rename) {

            /* Je defini un nouveau nom pour l'image  */
            $newName = uniqid('img_') . '.' . pathinfo($temp['name'], PATHINFO_EXTENSION);

            $filetowrite = $dir .  DS . $newName;


            /* (FR)Je déplacer fichier dans le dossier image
            (EN) I move file to image folder */
            move_uploaded_file($temp['tmp_name'], $filetowrite);



            if (file_exists($filetowrite)) {

                $result->urlImg = 'img' . DS . $date . DS . $newName;

                /* save dans la base de donée Média  */
                if ($save_data_base != null) {
                    $data = array(
                        'name' => $temp['name'],
                        'url' =>  $temp_date[0] . '/' . $temp_date[1] . '/' . $temp['name'],
                        'type' => 'img',
                        'info' => ''

                    );
                    $save_data_base->save($data);
                }
                return  $result;
            }
            $result->error = "err:Nous n'avons pas pus créer le fichier dans le serveur verfier les droit decriture";
            return $result;
        } else {
            /* (FR)Si il a déjà un fichier du même nom on redirige avec un message d'erreur */
            /*   $result->error = 'err:Un fichier portant ce nom est cette extension existe déjà'; */
            $result->urlImg = 'img' . DS . $date . DS . $temp['name'];
            return $result;
        }
    }
}

/**
 *Supprime une image présente dans le serveur 
 * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
 * @param string $url_img chemin verre le dossier a partir du dossier WEBBROOT 
 * 
 * @return objet  qui contient success et error
 */
function deleteImage($url_img, $delet_data_base = null, $id_img_table_media = null)
{

    $result = new stdClass();
    $result->error = '';
    $result->success = '';

    if (!empty($url_img)) {

        if (file_exists(WEBROOTT . DS . $url_img)) {
            unlink(WEBROOTT . DS . $url_img);
            if (file_exists(WEBROOTT . DS . $url_img)) {

                $result->success = false;
                $result->error = "err:le fichier ne peut pas être supprimé vérifier les droits d'écriture sur le dossier";
            } else {
                /* Suppression de limage dans la table medias */
                if ($delet_data_base != null && !empty($delet_data_base)  && $id_img_table_media != null && !empty($id_img_table_media)) {
                    $delet_data_base->delete($id_img_table_media);
                }

                $result->success = true;
            }
        } else {
            $result->success = false;
            $result->error = "err:le fichier a supprimer n'existe pas a l'endroit que vous avait spésifier";
        }
    }
    return $result;
}

/**
 *Convertie une chaine de caractère en slug 
 * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
 * @param string $strlink le string a convertir en slug 
 * @return string  return le slug demander 
 */
function AutoLinks($strlink)
{
    $str = str_replace('?', '', $strlink);
    $str = str_replace(':', ' ', $str);
    $str = preg_replace('/\s/', '-', $strlink); // Remplace les espaces par des '-'.


    $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');


    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str); // Remplace les accents des caractères
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    $str = preg_replace('/(^\w\-]+)/i', '', $str); // Remplace les caractères spéciaux sauf les '-'
    $str = preg_replace('/([_])/i', '', $str); // Remplace les underscores


    $str = strtolower($str); // On écrit le tout en minuscule


    return $str;
}

function lister_fichiers($rep)
{
    $d = array();
    if (is_dir($rep)) {
        $d['rep'] = $rep;
        $d['fichier'] = array();
        if ($iteration = opendir($rep)) {
            while (($fichier = readdir($iteration)) !== false) {
                if ($fichier != "." && $fichier != ".." && $fichier != "Thumbs.db") {
                    array_push($d['fichier'], $fichier);
                }
            }
            closedir($iteration);
        }
    }
    return $d;
}

function getDirrecurse($path = '.', $key = null)
{
    $d = array();
    $ignore = array('cgi-bin', '.', '..');
    $dir = @opendir($path);
    while (false !== ($file = readdir($dir))) {
        if (!in_array($file, $ignore)) {

            if (is_dir("$path/$file")) {
                $d[$file] = array();
                foreach (getDirrecurse("$path/$file", $file) as $key => $value) {
                    array_push($d[$file], $value);
                }
            } else {
                if ($key == null) {
                    $d[$file] = array();
                } else {
                    array_push($d, $file);
                }
            }
        }
    }
    closedir($dir);
    return $d;
}

