
let baseUrlImg;
let dataTag = [];
let allTag = [];
let myForm = document.getElementById('idform')

function initCard(allT, baseU,tag) {
    allTag = allT;
    baseUrlImg = baseU+'webroot/';
    console.log(baseUrlImg);
     generateCardEdit(tag); 
}




function generateCardEdit(tag) {

    let Card = ' <div class="card shadow mb-4">';
    Card += '<div class="card-header py-3">';

    Card += '   <h6 class="m-0 font-weight-bold text-primary">Editer un tag</h6>';

    Card += '    <div class="d-flex flex-row mt-1">';
    Card += '       <input class="btn btn-success mr-md-1 " name="savetag" type="submit" value="Mettre à jour le tag" required>';
    Card += '       <a class="btn btn-danger  " href="<i class="fas fa-trash-alt"></i> Supprimer</a>';
    Card += '    </div>';
    Card += '</div>';

    Card += '<div class="card-body row m-auto w-75">';
    Card += '<div class="table-responsive  w-50">';

    Card += '<div class="form-group ">';
    Card += '   <label for="Titre" class="w-25">Titre</label>';
    Card += '   <input type="text" name="name" class="form-control" value="' + tag['name_tag'] + '" id="titre_dag" placeholder="Titre du tag" required>';
    Card += '</div><!-- end input titel -->';

    Card += '<div class="form-group ">';
    Card += '   <label for="Descritption" class="w-25">Description</label>';
    Card += '   <textarea class="form-control" name="description" cols="30" rows="10" required>' + tag['description_tag'] + '</textarea>';
    Card += '</div><!-- end textarea description -->';

    Card += '</div><!-- end table responsive -->';
    Card += '<div class="ml-5 zone-select">';

    Card += '<label for="tag-p">Tag parent selection</label>';
    Card += '<select name="tag_parents" id="tag-p">';
    Card += '   <option value="NULL">Aucun Parent</option>';

    for (let index = 0; index < allTag.length; index++) {
        const element = allTag[index];
        Card += '<option value="' + element['id'] + '" ' + (element['id'] == tag['tag_parents'] ? "selected" : "" + '>' + element['name_tag']) + '</option>';
    }

    Card += '</select><!-- end select parent tag -->';


    Card += '<div class="zone-thundail">';
    Card += '   <label for="">Icon du tag</label>';
    Card += '   <input type="file" style="display: none;" name="thumbnail" id="img-file" accept="image/x-png,image/gif,image/jpeg" onchange="readImg(this, "img-id");">';
    Card += '   <img style="width: 100px; border-radius:50%; " onclick="addImg()" id="img-id" src="' + (tag["url_tag"] == "" ? baseUrlImg + "img/defaultImg" : baseUrlImg + "img/" + tag["url_tag"] )+ '">';
    Card += '   <br> <small>cliker sur l"image pour la changer</small>';

    Card += '        </div><!-- end thundail zone -->';

    Card += '    </div><!-- end zone select & thundai -->';
    Card += '   </div><!-- end first carrd  -->';

    drawCard(Card);

}

function drawCard(card) {
    myForm.innerHTML=card;
}






