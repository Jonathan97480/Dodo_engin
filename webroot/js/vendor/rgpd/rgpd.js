function generateRgpdBlock(baseUrl) {

    let tool = new toolJs();

    let DivParent = document.createElement('div');
    DivParent.setAttribute('class', 'content');

    let paragraphe = document.createElement('p');
    let btnValide = document.createElement('a');
    let btnDecline = document.createElement('a');
    $message = "";
    tool.postAjax(baseUrl + 'systeme/getRgpdTexte', null, (data) => {


        paragraphe.innerHTML = data['results']['description'];

        DivParent.appendChild(paragraphe);

        btnValide.innerHTML = "Aceppter les Cookie";
        btnValide.setAttribute('class', 'btn btn-primary')
        btnDecline.innerHTML = "Refuser les Cookie";
        btnDecline.setAttribute('class', 'btn btn-primary')

        let btnContent = document.createElement('div')

        btnContent.setAttribute('class', 'btnContent');
        btnContent.appendChild(btnValide);
        btnContent.appendChild(btnDecline);

        DivParent.appendChild(btnContent);
        document.getElementById('wrapper').appendChild(DivParent);

        btnValide.addEventListener('click', () => {
            closePanelle(DivParent);


            tool.postAjax(baseUrl + 'systeme/setRgpdUser/valid:true', null, (data) => {

            })
        })
        btnDecline.addEventListener('click', () => {
            closePanelle(DivParent);
            tool.postAjax(baseUrl + 'systeme/setRgpdUser/valid:false', null, (data) => {

            })
        });


    })

}

function closePanelle(element) {
    element.remove()
}