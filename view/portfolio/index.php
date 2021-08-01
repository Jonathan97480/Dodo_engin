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
    .my_contenaire {
        display: flex;
        margin: auto;
        width: 100vw;

        flex-direction: column;
        justify-content: center;
    }

    .block {
        width: 100%;
        margin: auto;



    }

    /* .site {
        background-color: #75645A;
    }

    .logo {
        background-color: #272B2A;
    } */

    .picture {

        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;


    }



    .ctm {
        max-width: 1230px;
        margin: auto;
    }

    .ctm h2 {

        margin-left: 15px;
        margin-top: 10px;
        font-style: normal;
        font-weight: bold;
        font-size: 40px;
        line-height: 56px;
        color: black;


    }

    a {
        cursor: pointer;

    }

    a:hover {
        transform: scale(1.05);
    }

    a h4 {
        margin-left: 20px;
        margin-bottom: 0;
        font-style: normal;
        font-weight: bold;
        font-size: 20px;
        line-height: 26px;
        color: black;
    }

    /*  .maquette .ctm h2 {
        color: black;
    } */

    .picture span {
        margin-top: 5px;
        display: block;
        margin: 20px;
        width: 263px;
        height: 287px;
        background-size: cover;
        background-position: center;
    }

    .decouvrire {
        margin-left: 25px;
        font-style: normal;
        font-weight: bold;
        font-size: 20px;
        line-height: 26px;
        color: #7B61FF;
    }
</style>


<div class="my_contenaire ">
    <div class="block site">

        <div class="ctm">
            <h2>Site</h2>
            <div class="picture">

                <?php foreach ($site as $key => $value) : ?>

                    <a href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">
                        <h4><?= str_delimite($value->name, 26, '...') ?></h4>
                        <span style="background-image: url(<?= Router::webroot('img/' . $value->img_description) ?>); "></span>
                    </a>

                <?php endforeach ?>
            </div>
            <?php
            if (count($site) >= 4) {

                echo "<a href='" . Router::url('portfolio/view_all/cat:site') . "' class='decouvrire' >Voir plus</a>";
            }
            ?>
        </div>

    </div>
    <div class="block maquette">
        <div class="ctm">
            <h2>Maquette</h2>
            <div class="picture">

                <?php foreach ($maquette as $key => $value) : ?>

                    <a href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">
                        <h4><?= str_delimite($value->name, 26, '...') ?></h4>
                        <span style="background-image: url(<?= Router::webroot('img/' . $value->img_description) ?>); "></span>
                    </a>

                <?php endforeach ?>
            </div>
            <?php
            if (count($maquette) >= 4) {

                echo "<a href='" . Router::url('portfolio/view_all/cat:maquette') . "' class='decouvrire' >Voir plus</a>";
            }
            ?>
        </div>
    </div>
    <div class="block logo">
        <div class="ctm">
            <h2>Logo</h2>
            <div class="picture">
                <?php foreach ($logo as $key => $value) : ?>

                    <a href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">
                        <h4><?= str_delimite($value->name, 26, '...') ?></h4>
                        <span style="background-image: url(<?= Router::webroot('img/' . $value->img_description) ?>); "></span>
                    </a>

                <?php endforeach ?>
            </div>
            <?php
            if (count($logo) >= 4) {

                echo "<a href='" . Router::url('portfolio/view_all/cat:logo') . "' class='decouvrire' >Voir plus</a>";
            }
            ?>
        </div>


    </div>

</div>