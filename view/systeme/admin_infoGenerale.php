<?php
$siteInfo = $_SESSION['site_info'];
/* die(debug($_SESSION)); */
?>

<div class="container">

    <h2 class="h1. Bootstrap heading text-center">INFO GENERALE DU SITE </h2>

    <form action="<?php Router::url('admin/systeme/infoGenerale') ?>" method="POST">

        <input type="hidden" value="<?= $siteInfo->id ?>" name="id">
        <!-- name site -->
        <div class="form-group">
            <strong> <label for="nameSite">Nom du site</label></strong>
            <input type="text" class="form-control" name="name_site" value="<?= $siteInfo->name_site ?>" id="nameSite" aria-describedby="non du site">
            <small id="nameHelp" class="form-text text-muted">le non du site qui sera afficher sur vos pages</small>
        </div>
        <!-- email site -->
        <div class="form-group">
            <strong> <label for="emailContact">Adresse email de contact</label></strong>
            <input type="email" class="form-control" name="site_email" value="<?= $siteInfo->site_email ?>" id="emailContact" aria-describedby="Votre adresse email">
            <small id="emailHelp" class="form-text text-muted">L'adresse email qui sera afficher dans me contacter</small>
        </div>
        <!-- phone fixe number -->
        <div class="form-group">
            <strong> <label for="FixeNumberContact">Votre numero de telephone fixe</label></strong>
            <input type="number" class="form-control" name="fix_phone" value="<?= $siteInfo->fix_phone ?>" id="FixeNumberContact" aria-describedby="Votre numero de fixe">
            <small id="FixeHelp" class="form-text text-muted">le numero de telephone fixe qui sera afficher dans me contacter</small>
        </div>
        <!-- phone mobile number -->
        <div class="form-group">
            <strong> <label for="MobileNumberContact">Votre numero de telephone mobile</label></strong>
            <input type="number" class="form-control" name="mobile_number" value="<?= $siteInfo->mobile_number ?>" id="MobileNumberContact" aria-describedby="Votre numero de mobile">
            <small id="MobileHelp" class="form-text text-muted">le numero de telephone mobile qui sera afficher dans me contacter</small>
        </div>
        <!-- Adrsse de votre de reseaux facebook -->
        <div class="form-group">
            <strong> <label for="urlFacebbok">Votre adresse Facebook</label></strong>
            <input type="url" class="form-control" name="url_facebook" value="<?= $siteInfo->url_facebook ?>" id="urlFacebbok" aria-describedby="Votre adresse facebook">
            <small id="FacebookHelp" class="form-text text-muted">Votre adresse Facebook</small>
        </div>
        <!-- Adrsse de votre de reseaux tweeter -->
        <div class="form-group">
            <strong><label for="urlTweeter">Votre adresse Tweeter</label></strong>
            <input type="url" class="form-control" name="url_tweeter" value="<?= $siteInfo->url_tweeter ?>" id="urlTweeter" aria-describedby="Votre adresse tweeter">
            <small id="TweeterkHelp" class="form-text text-muted">Votre adresse Tweeter</small>
        </div>
        <!-- Adrsse de votre de reseaux instagrame -->
        <div class="form-group">
            <strong> <label for="urlInstagrame">Votre adresse instagrame</label></strong>
            <input type="url" class="form-control" name="url_insta" value="<?= $siteInfo->url_insta ?>" id="urlInstagrame" aria-describedby="Votre adresse instagrame">
            <small id="InstagrameHelp" class="form-text text-muted">Votre adresse Instagrame</small>
        </div>
        <!-- Adrsse de votre de reseaux youtube -->
        <div class="form-group">
            <strong> <label for="urlYoutube">Votre adresse youtube</label></strong>
            <input type="url" class="form-control" name="url_youtube" value="<?= $siteInfo->url_youtube ?>" id="urlYoutube" aria-describedby="Votre adresse youtube">
            <small id="YoutubeHelp" class="form-text text-muted">Votre adresse Youtube</small>
        </div>

        <!-- Adrsse de votre de reseaux Linkedin -->
        <div class="form-group">
            <strong><label for="urlLinkedin">Votre adresse Linkedin</label></strong>
            <input type="url" class="form-control" name="url_Linkedin" value="<?= $siteInfo->url_Linkedin ?>" id="urlLinkedin" aria-describedby="Votre adresse linkedin">
            <small id="LinkedinHelp" class="form-text text-muted">Votre adresse Linkedin</small>
        </div>

        <button type="submit" class="btn btn-primary">Sauvegarder les informations</button>
    </form>


</div>