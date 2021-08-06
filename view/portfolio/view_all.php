<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.2.0/styles/atom-one-dark.min.css" />

<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= Router::theme('default/images/img_bg_4.jpg') ?>)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row row-mt-15em">
            <div class="col-md-7 mt-text text-left animate-box" data-animate-effect="fadeInUp">
                <h1><strong>Portfolio</strong></h1>
                <h2 class="titelView"><?= $cat ?></h2>
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
        margin-top: 55px;
        margin-bottom: 55px;


    }


    .picture {

        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;


    }

    .titelView {

        text-transform: capitalize;
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
        color: white;


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
    <div class="block ">

        <div class="ctm">

            <div class="picture">

                <?php foreach ($content as $key => $value) : ?>

                    <a href="<?= Router::url('portfolio/view/id:' . $value->id) ?>">
                        <h4><?= str_delimite($value->name, 26, '...') ?></h4>
                        <span style="background-image: url(<?= Router::webroot($value->img_description) ?>); "></span>
                    </a>

                <?php endforeach ?>
            </div>

        </div>

    </div>


</div>
<span>
    salut
</span>