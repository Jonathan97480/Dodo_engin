<?php

$siteInfo = $_SESSION['site_info'];

/* Get form return data */
$data = $this->Session->getFormReturn();

if (empty($data)) {

	$data = new stdClass();
	$data->fullName = "";
	$data->email = "";
	$data->obj = "";
	$data->content = "";
}

?>
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= Router::theme('default/images/img_bg_4.jpg') ?>)" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row row-mt-15em">
			<div class="col-md-7 mt-text text-left animate-box" data-animate-effect="fadeInUp">
				<h1>Entrer en <strong>contact</strong></h1>
				<h2>Vous avez des questions où vous voulez un devis n'hésitez pas à prendre contact</h2>
			</div>
		</div>
	</div>
</header>

<?php echo $this->Session->flash(); ?>

<div class="gtco-section gtco-gray-bg">
	<div class="gtco-container">
		<div class="row">

			<div class="col-md-12">
				<div class="col-md-6 animate-box">
					<h3>Entrer en contact</h3>
					<form action="<?= Router::url('pages/contact') ?>" method="POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Votre nom complet</label>
								<input type="text" id="name" name="fullName" value="<?= $data->fullName ?>" class="form-control" placeholder="Votre nom complet" required>
							</div>

						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input type="text" id="email" value="<?= $data->email ?>" name="email" class="form-control" placeholder="Votre adresse email" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="subject">Subject</label>
								<input type="text" id="subject" value="<?= $data->obj ?>" name="obj" class="form-control" placeholder="Le sujet de votre message" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<textarea name="content" id="message" cols="30" rows="10" class="form-control" placeholder="Écrivez-nous votre message"><?= $data->content ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="sendMessage" value="Envoyer votre message" class="btn btn-primary">
						</div>

					</form>
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">

					<div class="gtco-contact-info">
						<h3>Contact Information</h3>
						<ul>

							<li class="phone"><a href="'tel://'.<?= $siteInfo->fix_phone ?>"><?= $siteInfo->fix_phone ?></a></li>
							<li class="phone"><a href="'tel://'.<?= $siteInfo->mobile_number ?>"><?= $siteInfo->mobile_number ?></a></li>
							<li class="email"><a href="'mailto:'<?= $siteInfo->site_email ?>"><?= $siteInfo->site_email ?></a></li>

						</ul>
					</div>


				</div>
			</div>

		</div>
	</div>
</div>