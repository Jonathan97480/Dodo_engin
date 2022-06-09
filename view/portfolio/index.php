<?php
/* die(debug($this)) */
?>
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= Router::theme('default/images/img_bg_4.jpg') ?>)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row row-mt-15em">
            <div class="col-md-7 mt-text text-left animate-box" data-animate-effect="fadeInUp">
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

    @media (min-width:1400px) {

        .card-mobile {
            display: none;
        }

        .card-deskop {


            position: relative;
            width: 300px;
            height: 400px;
            background: white;
            transform-style: preserve-3d;
            transform: perspective(1000px);
            box-shadow: 10px 20px 40px rgba(0, 0, 0, 25);
            transition: 1s;
        }

        .imgBox {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1;
            transform-origin: left;
            transform-style: preserve-3d;
            background: black;
            transition: 1s;
        }

        .card-deskop:hover {
            transform: translateX(50%);
            transition: 1s;
        }

        .card-deskop:hover .imgBox {
            transform: rotateY(-180deg);
        }

        .imgBox img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-style: preserve-3d;
            /* backface-visibility: hidden; */
        }

        .card-deskop .details {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-deskop .details .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .card-deskop .details .content h2 {
            text-align: center;
            font-weight: 700;
            line-height: 1em;
        }

        .card-deskop .details .content h2 span {
            color: red;
            font-size: 0.8em;
        }

        .card-deskop .details .content .btn-actions {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .card-deskop .details .content .btn-actions a {
            font-size: 1rem;
            margin: 5px;
            text-decoration: none;
            color: white;
            background-color: rgb(52, 52, 177);
            padding: 10px;
            border-radius: 5px;
        }


        .block {
            width: 100%;
            margin: auto;



        }
    }

    @media (max-width:1399px) {

        .my_contenaire {
            margin-left: 0% !important;

        }

        .card-deskop {
            display: none;
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
    }

    @media (max-width:750px) {
        .my_contenaire {

            grid-template-columns: 1fr;


        }
    }
</style>


<div class="my_contenaire ">

    <?php foreach ($site as $key => $value) : ?>

        <div class="card-deskop">
            <div class="imgBox">
                <img src="<?= Router::webroot($value->img_description) ?>" alt="">
            </div>
            <div class="details">
                <div class="content">
                    <h2><?= str_delimite($value->name, 26, '...') ?>
                        <!--    <br> <span>Graphic Designer</span> -->
                    </h2>
                    <div class="btn-actions">
                        <a class="btn" href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Card Pobile End Potable -->
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