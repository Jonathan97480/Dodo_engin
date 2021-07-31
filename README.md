

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




