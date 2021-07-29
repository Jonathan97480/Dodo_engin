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

<div class="gtco-section gtco-gray-bg">
    <div class="gtco-container">
        <div class="row">
            <?php $nb = 0; ?>
            <?php foreach ($projet['posts'] as $key => $value) : ?>

                <?php $nb++; ?>
                <div class="col-lg-4 col-md-4 col-sm-6">

                    <a href="<?= Router::url('portfolio/view/id:' . $value->id) ?>" class="gtco-card-item">
                        <figure>
                            <div class="overlay"><i class="ti-plus"></i></div>
                            <img src="<?= Router::webroot('img/' . $value->img_description) ?>" alt="Image" class="img-responsive">
                        </figure>
                        <div class="gtco-text text-left">
                            <h2><?= $value->name ?></h2>
                            <p><?= $value->description ?></p>
                            <p class="gtco-category"><?= $value->date_edit ?></p>
                        </div>
                    </a>

                </div>

                <?php if ($nb == 2) : ?>

                    <div class="clearfix visible-sm-block"></div>

                <?php elseif ($nb == 3) : ?>

                    <div class="clearfix visible-lg-block visible-md-block"></div>

                    <?php $nb = 0; ?>

                <?php endif ?>

            <?php endforeach ?>


            <div class="clearfix visible-lg-block visible-md-block"></div>

        </div>
    </div>
</div>