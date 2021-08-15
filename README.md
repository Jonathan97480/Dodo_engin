

## Function Global


 *str_delimited*

 Permets de remplacer la fin d'un texte et de limiter la longueur d'un texte et mettre les caractères désirait à la fin .

    str_delimited(string $texte , int lenght , string completed)

*Exemple:*

Dans une publication on a un titre qui est trop long et on voudrait qu'il ne fasse pas plus de 26 caractères et que pour signifier que le titre est plus long rajouter ... à la fin

dans ce cas on utilisera cette méthode ce qui donnera

    $myTitre ="Paysage d'une montagne recouvert de neige";
    $myTitre = str_limited($myTitre,26,"...");

    //Maintenant notre titre ressemble a sa

    $myTitre ="Paysage d'une montagne ...";


## Class Session

*setFlash*

Permets de générer des messages flash, cette méthode de classe peut être appelé depuis les contrôleurs 

    $this->Session->setFlash(string $message ,string $type='bg-success',$parametre=null);

*flash*

Cette fonction doit être placée dans votre thème et sera appelée à chaque fois que votre page sera appelé. 

    $this->Session->flash

*GetRole*

Renvoi le rôle d'utilisateur qui est connecté.

    $this->Session->getRole();


*user*

Permet de récupérer des infos sur l'utilisateur connecter exemple id le rôle ou la date d'inscription.

    $this->Session->user($key);

Liste des key Disponible 
    id
    login
    name
    passwor
    email
    validatekey 
    validate
    avatar
    fk_role_id
    count_active
    registration_date
    fk_lang
    first_name
    enable_user
    role_name
    description_role 
    img_role

    
*getFormReturn*

Permets de récupéraient les données passer dans un formulaire, cette method et appelable de depuis la vue.

    this->Session->getFormReturn();

## Class  VideoStream    

Pour utiliser cette classe, vous devrez écrire un code simple comme ci-dessous :


    $stream = new VideoStream($filePath);
    $stream->start();

Comprendre la classe et la logique HTML5 Streaming :

La classe prend simplement le chemin du fichier vidéo comme paramètre de constructeur. Il peut soit lui donner un chemin local, soit même un emplacement de fichier amazon s3 (expliqué plus tard).

après avoir appelé la méthode 'start()', il essaie d'abord d'ouvrir le fichier, puis de définir les en-têtes appropriés, puis de diffuser le contenu requis et enfin de fermer le gestionnaire de système de fichiers.

La partie en-tête est la plus importante car ici, vous communiquerez avec le navigateur client, dites-lui que vous pouvez accepter la demande de plage et vérifier si le navigateur a fait des demandes de plage ou non et décider de la quantité de données à diffuser. Dans le réglage de l'en-tête, par défaut, le type mime du fichier mp4 est indiqué. Vous pouvez le changer selon vos besoins. Cependant, à l'heure actuelle, mp4 est le format le plus largement pris en charge par les principaux navigateurs, il est donc fortement recommandé d'utiliser ce format. L'en-tête « Accept-Ranges » est important pour indiquer au navigateur que le serveur accepte toute demande de niveau d'octet dans la plage donnée, afin que le navigateur puisse décider de la plage lui-même et faire des demandes de plage personnalisées par la suite. Lorsque le navigateur fait une demande de plage, il inclut un en-tête supplémentaire nommé 'HTTP_RANGE'. Dans la méthode 'setHeader()',

La méthode 'stream()' diffuse simplement la quantité de données prédéfinie avec une taille de tampon personnalisable. La taille de la mémoire tampon sert simplement à optimiser l'utilisation de la mémoire du serveur afin qu'une mémoire non énorme ne soit pas utilisée en cas de nombre élevé de demandes simultanées.

Diffusion à partir du service Amazon S3 :
Vous pouvez avoir très facilement la prise en charge de l'emplacement des fichiers du service s3 sur la classe ci-dessus. Tout d'abord, assurez-vous d'enregistrer 'streamWrapper' avec votre client s3 :

1
$s3Client->registerStreamWrapper();
puis, tout en passant le chemin du fichier au constructeur de la classe VideoStream, utilisez le format « s3://{bucket}/{key} » comme chaîne de fichier. Modifiez ensuite la méthode 'open()' de la classe, comme ci-dessous :


    /**
    * Open stream
    */
    private function open()
    {
        // Create a stream context to allow seeking
        $context = stream_context_create(array(
            's3' => array(
                'seekable' => true
            )
        ));
        if (!($this->stream = fopen($this->path, 'rb', false, $context))) {
            die('Could not open stream for reading');
        }
        
    }
Maintenant, tout devrait bien se passer et le streaming devrait également fonctionner à partir de l'emplacement Amazon S3.

## Class UploadImg

Cette méthode permet géraient tous ce qui se rapporte au traitement de l'image et à son stockage dans le serveur.

*Upload()*

Cette méthode permet de télécharger une image sur le serveur .
Elle prend plusieurs paramètres à l'entrée.

    public function upload(array $file, string $definePath, bool $autoRename): string;

$file: Est le fichier présent dans la variable Php $_FILES.

$definePath: Le chemin verre le dossier où sera stockée l'image. 

$autoRename : Si le fichier doit être renommé de manière automatique ou pas.

*reSize*

Méthode pour redimensionner une image.

    public function reSize(int $W, int $H, string $path, string $pathImg, bool $cropsuqare = false): string;

   $W:La taille de l'image en largeur

   $H: La taille de l'image en hauteur

   $path: Le répertoire ou l'image doit être stocké

   $patImg: Le chemin vers l'image d'origine

   $cropsuquare: Si l'image doit être coupée ou pas parapore a la taille demander 

   *remove*

Méthode pour supprimer une image du serveur.

        public function remove(string $pathImg): bool;

*move*

Méthode pour déplacer une image sur le serveur

        public function move(string $curentPathImg, string $newPathImg): bool;

*les getter*

    getImg()

retourne le chemin depuis le dossier webRoot verre l'image télécharger 


    getImgRezise()

Retourne le chemin depuis le dossier webRoot verre l'image redimensionner 

    getImgNameOrigin()

Renvoi le non d'origine de l'image même si vous lavez renommée automatiquement