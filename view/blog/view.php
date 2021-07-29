<?php

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.2.0/styles/atom-one-dark.min.css" />

<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= Router::theme('default/images/img_bg_4.jpg') ?>)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row row-mt-15em">
            <div class="col-md-7 mt-text text-left animate-box" data-animate-effect="fadeInUp">
                <h1><strong>Blog</strong></h1>
                <h2><?= $blog->name ?></h2>
            </div>
        </div>
    </div>
</header>

<div class="gtco-section gtco-gray-bg">
    <div class="gtco-container">
        <div class="row">
            <article>
                <h3><?= $blog->name ?></h3>
                <div>
                    <img src="<?= Router::url('img/' . $blog->img_description) ?>" alt="">
                </div>

                <?= $blog->content  ?>

            </article>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.2.0/highlight.min.js"></script>

<script>
    hljs.initHighlightingOnLoad();
</script>