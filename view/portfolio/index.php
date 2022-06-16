<?php
/* die(debug($this)) */
?>
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= Router::theme('default/images/img_bg_4.jpg') ?>)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row ">
            <div class=" mt-text text-left animate-box" data-animate-effect="fadeInUp">
                <h1><strong>Portfolio</strong></h1>
                <h2>Les projets que j'ai réalisé</h2>
            </div>
        </div>
    </div>
</header>

<!-- css -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
    }

    .my_contenaire {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-row-gap: 50px;

        margin-left: 10%;
        width: 100%;
        max-width: 100%;
        min-height: 100vh;
        padding-top: 100px;

        padding-bottom: 50px;

    }




    .my_contenaire {
        margin-left: 0% !important;

    }





    .card-mobile {
        margin: 0 auto;
        width: 240px;
        height: 320px;
        perspective: 1000px;
        text-align: center;
    }

    .card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }

    .card-mobile:hover .card-inner {
        transform: rotateY(180deg);
    }

    .card-front,
    .card-back {
        position: absolute;
        height: 100%;
        width: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .card-back {
        transform: rotateY(180deg);
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card-back .card-image {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border: solid 1px #cecece;
        border-radius: 100%;
        background-image: url('images/back.jpg');
        background-size: cover;
        background-position: center center;
    }

    .card-back p {
        margin-top: 12px;
    }

    .card-back .card-icons {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-back .card-icons a {
        font-size: 18px;
        color: white;
        background: black;
        width: 42px;
        height: 42px;
        border-radius: 100%;
        margin: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: opacity .2s;
    }

    .card-back .card-icons a:hover {
        cursor: pointer;
        opacity: 0.7;
    }

    .card-front {
        transition: opacity .6s;
        background-position: center;
        background-size: cover;
    }

    .card-content {
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 100%;
    }

    .card-mobile:hover .card-front {
        opacity: 0;
    }

    .btn-actions {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
    }

    .btn-actions a {
        font-size: 1rem;
        margin: 5px;
        text-decoration: none;
        color: white;
        background-color: rgb(52, 52, 177);
        padding: 10px;
        border-radius: 5px;
    }



    .my_contenaire {

        grid-template-rows: 1fr;


    }
</style>


<div class="my_contenaire ">

    <?php foreach ($site as $key => $value) : ?>

        <!-- Card -->
        <div class="card-mobile">
            <div class="card-inner">
                <div class="card-front">
                    <div class="card-content" style="background-image: url('<?= Router::webroot($value->img_description) ?>');">

                    </div>
                </div>
                <div class="card-back">
                    <h2><?= str_delimite($value->name, 26, '...') ?>
                        <!--    <br> <span>Graphic Designer</span> -->
                    </h2>
                    <div class="btn-actions">
                        <a class="btn" href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>







</div>