

## Function Global


 *str_delimited*

 Permet de remplacer la fin d'un texte et de limiter la longueur d'un texte et mettre les caractères désirait à la fin .

    str_delimited(string $texte , int lenght , string completed)

*Exemple:*

Dans une publication on a un titre qui est trop long et on voudrait qu'il ne fasse pas plus de 26 caractères et que pour signifier que le titre est plus long rajouter ... a la fin

dans ce cas on utilisera cette méthode ce qui donnera 

    $myTitre ="Paysage d'une montagne recouvert de neige";
    $myTitre = str_limited($myTitre,26,"...");

    //Maintenant notre titre ressemble a sa

    $myTitre ="Paysage d'une montagne ...";


## Class Session

*setFlash*

Permet de générai des messages flash , cette méthode de class peut être appeler de puis les contrôleurs 

    $this->Session->setFlash(string $message ,string $type='bg-success',$parametre=null);

*flash*

cette fonction doit être placer dans votre thème et sera appeler a chaque foi que votre page sera appeler 

    $this->Session->flash

*GetRole*

renvoi le rôle de utilisateur qui est connecter .

    $this->Session->getRole();


*user*

permet de récupérait des info sur l'utilisateur connecter exemple id le rôle ou la date d'inscription.

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

permet de récuperait les donée passer dans un formulaire .
cette method et appelade de puis la vue 

    this->Session->getFormReturn();

