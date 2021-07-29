-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 13 mars 2021 à 12:51
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dodo_engine`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `online` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `content` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `img_description` varchar(255) NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `name`, `online`, `type`, `slug`, `created`, `content`, `description`, `img_description`, `date_edit`) VALUES
(37, 'Tests Unitaires: Que sont-ils et comment les implémenter ?', 1, 'post', 'tests-unitaires:-que-sont-ils-et-comment-les-implementer-?', '2021-03-13 07:08:27', '<div class=\"mt-5 flex justify-items-start space-x-4 lg:space-x-6\">&nbsp;</div>\r\n<div class=\"markdown-styles_markdown__1DI9D\">\r\n<p>Savoir coder des tests unitaires est&nbsp;<a href=\"https://practicalprogramming.fr/monter-en-competences-efficacement/\">une comp&eacute;tence essentielle pour tout d&eacute;veloppeur</a>&nbsp;souhaitant progresser dans son m&eacute;tier. Non seulement&nbsp;<strong>c\'est un &eacute;l&eacute;ment essentiel &agrave; tout code source pour s\'assurer que l\'application fonctionne toujours comme pr&eacute;vu malgr&eacute; des &eacute;volutions dans le code</strong>, mais les tests unitaires sont &eacute;galement &agrave; la base de bonnes pratiques de l\'ing&eacute;nierie logicielle telles que le Test Driven Development (TDD) ou l\'int&eacute;gration continue dans&nbsp;<a href=\"https://practicalprogramming.fr/pourquoi-le-devops/\">une boucle DevOps</a>.</p>\r\n<div class=\"\"><iframe id=\"widget2\" class=\"w-full\" title=\"YouTube video player\" src=\"https://www.youtube.com/embed/cnXLi8D-cW0?enablejsapi=1&amp;origin=https%3A%2F%2Fpracticalprogramming.fr&amp;widgetid=1\" width=\"640\" height=\"360\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\" data-gtm-yt-inspected-1_25=\"true\" data-mce-fragment=\"1\"></iframe></div>\r\n<p><strong>Parfois n&eacute;glig&eacute;e par manque de temps ou par ignorance, une bonne couverture de code par des tests unitaires fait la diff&eacute;rence entre une codebase &eacute;volutive et un ch&acirc;teau de cartes o&ugrave; l\'ajout de chaque nouvel &eacute;l&eacute;ment est de plus en plus difficile.</strong></p>\r\n<h2 id=\"les-tests-unitaires-interet-et-bonnes-pratiques\">Les tests unitaires&nbsp;: int&eacute;r&ecirc;t et bonnes pratiques</h2>\r\n<h3 id=\"a-quoi-servent-les-tests-unitaires-\"></h3>\r\n<p><strong>Les tests unitaires permettent de v&eacute;rifier le bon fonctionnement d&rsquo;une petite partie bien pr&eacute;cise (unit&eacute; ou module) d&rsquo;une application</strong>. Ils s\'assurent qu\'une m&eacute;thode expos&eacute;e &agrave; la manipulation par un utilisateur fonctionne bien de la fa&ccedil;on dont elle a &eacute;t&eacute; con&ccedil;ue.</p>\r\n<p>Ils sont la base sur laquelle les autres processus de tests (tests fonctionnels, d&rsquo;int&eacute;gration, de r&eacute;gression, de performance&hellip;) doivent &ecirc;tre construits pour assurer des fondations solides dans le cadre du d&eacute;veloppement d\'une application.</p>\r\n<p>Mike Cohn, l&rsquo;un des th&eacute;oriciens pionniers de la m&eacute;thodologie agile&nbsp;<strong>Scrum</strong>, met d&rsquo;ailleurs les tests unitaires &agrave; la base de sa&nbsp;<strong>Pyramide des tests&nbsp;</strong>(<em>test pyramid</em>) qui rappelle aux d&eacute;veloppeurs de construire leurs tests sur diff&eacute;rents niveaux de granularit&eacute;&nbsp;:</p>\r\n<div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<img src=\"https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=3840&amp;fit=clip\" sizes=\"(max-width: 750) 100vw, 750px\" srcset=\"https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=640&amp;fit=clip 640w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=750&amp;fit=clip 750w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=828&amp;fit=clip 828w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=1080&amp;fit=clip 1080w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=1200&amp;fit=clip 1200w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=1920&amp;fit=clip 1920w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=2048&amp;fit=clip 2048w, https://cdn.sanity.io/images/kjg6yd05/production/3248e3f6e9f5af465032b699544538cbbdf9b8a3-466x246.png?w=3840&amp;fit=clip 3840w\" /></div>\r\n<p class=\"font-thin text-center font-sans text-sm text-gray-800 dark:text-white\">Exemple de pyramide de tests comportant les tests unitaires &agrave; la base de la pyramide</p>\r\n</div>\r\n<p>Par exemple, prenons le cas d\'<a href=\"https://practicalprogramming.fr/node-js-api/\">une API Node JS</a>&nbsp;qui permettrait &agrave; un gestionnaire de Parkings de g&eacute;rer les r&eacute;servations des clients. Une fonction essentielle &agrave; son API est de s\'assurer qu\'il y a des places disponibles aux dates souhait&eacute;es par l\'automobiliste:</p>\r\n<pre><code class=\"language-javascript\"><span class=\"token token\">const</span> <span class=\"token token function-variable\">bookParkingSpace</span> <span class=\"token token\">=</span> <span class=\"token token\">(</span><span class=\"token token parameter\">vehicule</span><span class=\"token token parameter\">,</span><span class=\"token token parameter\"> checkin</span><span class=\"token token parameter\">,</span><span class=\"token token parameter\"> checkout</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n  <span class=\"token token control-flow\">if</span> <span class=\"token token\">(</span><span class=\"token token\">!</span><span class=\"token token\">isEligibleVehicule</span><span class=\"token token\">(</span>vehicule<span class=\"token token\">)</span><span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n     <span class=\"token token control-flow\">throw</span> <span class=\"token token\">new</span> <span class=\"token token\">Error</span><span class=\"token token\">(</span>\"<span class=\"token token maybe-class-name\">This</span> vehicule is not eligible <span class=\"token token control-flow\">for</span> our parking\"\r\n  <span class=\"token token\">}</span>\r\n  <span class=\"token token control-flow\">if</span> <span class=\"token token\">(</span><span class=\"token token\">!</span><span class=\"token token\">availableSpot</span><span class=\"token token\">(</span><span class=\"token token parameter\">entree</span><span class=\"token token parameter\">,</span><span class=\"token token parameter\">sortie</span><span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n    <span class=\"token token control-flow\">throw</span> <span class=\"token token\">new</span> <span class=\"token token\">Error</span><span class=\"token token\">(</span><span class=\"token token\">\"No spaces available at your desired dates\"</span><span class=\"token token\">)</span>\r\n  <span class=\"token token\">}</span>\r\n  <span class=\"token token control-flow\">return</span> <span class=\"token token\">true</span>\r\n<span class=\"token token\">}</span>\r\n\r\n<span class=\"token token\">const</span> <span class=\"token token function-variable\">isEligibleVehicule</span> <span class=\"token token\">=</span> <span class=\"token token parameter\">vehicule</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n  <span class=\"token token control-flow\">if</span> <span class=\"token token\">(</span>vehicule<span class=\"token token\">.</span><span class=\"token token property-access\">height</span> <span class=\"token token\">&gt;</span> <span class=\"token token\">275</span> <span class=\"token token\">||</span> vehicule<span class=\"token token\">.</span><span class=\"token token property-access\">length</span> <span class=\"token token\">&gt;</span> <span class=\"token token\">500</span> <span class=\"token token\">||</span> vehicule<span class=\"token token\">.</span><span class=\"token token property-access\">type</span> <span class=\"token token\">!==</span> <span class=\"token token\">\"Car\"</span><span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n    <span class=\"token token control-flow\">return</span> <span class=\"token token\">false</span>\r\n  <span class=\"token token\">}</span>\r\n  <span class=\"token token control-flow\">return</span> <span class=\"token token\">true</span>\r\n<span class=\"token token\">}</span>\r\n\r\n<span class=\"token token\">const</span> <span class=\"token token function-variable\">availableSpot</span> <span class=\"token token\">=</span> <span class=\"token token\">(</span><span class=\"token token parameter\">checkin</span><span class=\"token token parameter\">,</span><span class=\"token token parameter\"> checkout</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n <span class=\"token token\">// Pour simplifier mon exemple, je fais comme si mon appel &agrave; la base de donn&eacute;e &eacute;tait synchrone</span>\r\n  <span class=\"token token\">const</span> availableParkingSpot <span class=\"token token\">=</span> db<span class=\"token token\">.</span><span class=\"token token property-access\">parking</span><span class=\"token token\">.</span><span class=\"token token method property-access\">findOne</span><span class=\"token token\">(</span><span class=\"token token\">{</span>status<span class=\"token token\">:</span><span class=\"token token\">\"available\"</span><span class=\"token token\">,</span> entry<span class=\"token token\">:</span> checkin<span class=\"token token\">,</span> exit<span class=\"token token\">:</span> checkout<span class=\"token token\">}</span><span class=\"token token\">)</span>\r\n  <span class=\"token token control-flow\">return</span> availableParkingSpot\r\n<span class=\"token token\">}</span></code></pre>\r\n<p>Dans cet exemple, seule la fonction&nbsp;<code>bookParkingSpace</code>&nbsp;est expos&eacute;e &agrave; une interaction avec l\'utilisateur. Les fonctions&nbsp;<code>isEligibleVehicule</code>&nbsp;et&nbsp;<code>availableSpot</code>&nbsp;sont des fonctions priv&eacute;es dans le sens o&ugrave; elles ne sont manipul&eacute;es que par bookParkingSpace. En &eacute;crivant un test unitaire sur&nbsp;<code>bookParkingSpace</code>, nous couvrons indirectement les deux fonctions suivantes.</p>\r\n<p>En &eacute;crivant des tests unitaires sur la fonction&nbsp;<code>bookParkingSpace</code>,<strong>&nbsp;je m\'assure du bon fonctionnement des diff&eacute;rents cas de figures</strong>&nbsp;de requ&ecirc;tes avant de d&eacute;ployer ma fonctionnalit&eacute;. Je m\'assure qu\'un poids lourd, qu\'une moto, qu\'un v&eacute;hicule trop grand ou trop large ne puisse pas r&eacute;server de place. Je m\'assure &eacute;galement que j\'ai bien une place disponible &agrave; ces dates-l&agrave;.</p>\r\n<p><strong>Gr&acirc;ce &agrave; ces tests unitaires, je me prot&egrave;ge &eacute;galement des futures &eacute;volutions de mon code</strong>, lorsque j\'aurai besoin d\'adapter une fonctionnalit&eacute;, qu\'elle ne vienne pas casser involontairement ces contr&ocirc;les qui sont essentiels au bon fonctionnement de mon service de place de parking.</p>\r\n<p>L<strong>&rsquo;importance de la mise en place de tests unitaires est souvent sous-estim&eacute;e</strong>&nbsp;par les entreprises et les programmes de formation, si bien qu&rsquo;un bon nombre de d&eacute;veloppeurs en d&eacute;but de carri&egrave;re n&rsquo;en ont jamais pratiqu&eacute; voire entendu parler. Pourtant, la capacit&eacute; &agrave; comprendre, &eacute;crire et automatiser des tests unitaires est une&nbsp;<strong>comp&eacute;tence de base exig&eacute;e par toutes les entreprises technologiques de pointe</strong>.</p>\r\n<h2 id=\"que-sont-les-tests-unitaires-\">Que sont les tests unitaires ?</h2>\r\n<p>Comme on l\'a vu dans le sch&eacute;ma de pyramide de tests, il existe de nombreux types de tests automatis&eacute;s.</p>\r\n<p><strong>Un test unitaire est une suite d&rsquo;op&eacute;rations permettant de v&eacute;rifier la validit&eacute; d&rsquo;unit&eacute;s individuelles d&rsquo;une application, ind&eacute;pendamment les unes des autres.</strong></p>\r\n<p>Le scope d\'un test unitaire est limit&eacute; &agrave; une fonction \"publique\", pouvant toutefois englober les fonctions enfants dont elle a besoin pour fonctionner. L\'int&eacute;r&ecirc;t d\'isoler chaque unit&eacute; pour un test est d\'assurer son bon fonctionnement dans le temps.&nbsp;<strong>Si jamais un test venait &agrave; &eacute;chouer suite &agrave; une mise &agrave; jour du code source, le d&eacute;veloppeur sera en capacit&eacute; d\'identifier directement le module affect&eacute; par son nouveau code.</strong></p>\r\n<p>Plusieurs crit&egrave;res r&eacute;unis permettent d&rsquo;&eacute;tablir un test unitaire:</p>\r\n<h3 id=\"unite\"></h3>\r\n<p>Un test unitaire se concentre sur une seule&nbsp;<strong>unit&eacute;</strong>, qui est le&nbsp;<strong>plus petit &eacute;l&eacute;ment identifiable de notre application</strong>. Selon les contextes et les langages de programmation, plusieurs &eacute;l&eacute;ments du code peuvent constituer une unit&eacute;. Il peut s&rsquo;agir d&rsquo;une&nbsp;<strong>fonction</strong>, d&rsquo;une&nbsp;<strong>m&eacute;thode de classe</strong>, d&rsquo;un&nbsp;<strong>module</strong>, d&rsquo;un&nbsp;<strong>objet</strong>&hellip;&nbsp;Parce qu&rsquo;ils se concentrent sur les plus petites parties de notre application, les&nbsp;<strong>tests unitaires</strong>&nbsp;sont des tests de&nbsp;<strong>bas niveau</strong>&nbsp;(comme dans la Pyramide). &Agrave; l&rsquo;inverse, les tests de&nbsp;<strong>haut niveau</strong>&nbsp;contr&ocirc;lent la validit&eacute; d&rsquo;une ou plusieurs fonctionnalit&eacute;s compl&egrave;tes.</p>\r\n<h3 id=\"boite-blanche\"></h3>\r\n<p>Bien qu&rsquo;ils soient parfois &eacute;crits par des ing&eacute;nieurs qualit&eacute;,&nbsp;<strong>les tests unitaires sont la plupart du temps cod&eacute;s par les d&eacute;veloppeurs eux-m&ecirc;mes</strong>, pendant le d&eacute;veloppement et non apr&egrave;s. Ils n&eacute;cessitent d&rsquo;invoquer une partie du code (l&rsquo;unit&eacute; test&eacute;e) qui doit donc &ecirc;tre connu et font ainsi partie des&nbsp;<strong>tests en bo&icirc;te blanche</strong>&nbsp;(<em>white-box testing</em>). &Agrave; l&rsquo;inverse, les&nbsp;<strong>tests en bo&icirc;te noire</strong>&nbsp;(<em>black-box testing)</em>&nbsp;d&eacute;rivent de l&rsquo;interface et ne n&eacute;cessitent pas de conna&icirc;tre le code.</p>\r\n<h3 id=\"isolation\"></h3>\r\n<p>Les tests unitaires visant &agrave;<strong>&nbsp;tester chaque unit&eacute; en isolation totale&nbsp;</strong>par rapport aux autres, ils doivent pouvoir &ecirc;tre ind&eacute;pendants des tests lui pr&eacute;c&eacute;dents. Votre suite de tests unitaires doit pouvoir &ecirc;tre lanc&eacute; dans n\'importe quel ordre sans affecter le r&eacute;sultat des tests suivants. C\'est pourquoi l\'utilisation de Mocks et Stubs est indispensable aux tests unitaires.</p>\r\n<h3 id=\"rapidite\"></h3>\r\n<p>La petite &eacute;chelle des tests unitaires et le fait qu&rsquo;ils soient &eacute;crits par les d&eacute;veloppeurs pendant le d&eacute;veloppement font que les&nbsp;<strong>tests unitaires sont souvent tr&egrave;s rapides</strong>. Ils peuvent ainsi &ecirc;tre lanc&eacute;s tr&egrave;s fr&eacute;quemment, id&eacute;alement &agrave; chaque modification dans le code ou &agrave; chaque compilation. Cette fa&ccedil;on de proc&eacute;der permet de&nbsp;<strong>rep&eacute;rer les bugs bien plus rapidement</strong>&nbsp;: si vous avez accidentellement cass&eacute; une fonctionnalit&eacute; pendant votre dernier changement, vous le saurez imm&eacute;diatement et n&rsquo;aurez pas &agrave; chercher bien loin pour le r&eacute;parer. Vous n&rsquo;&ecirc;tes bien s&ucirc;r pas oblig&eacute;s de lancer tous les tests unitaires &agrave; chaque fois.</p>\r\n<h3 id=\"rejouabilite\"></h3>\r\n<p>L\'int&eacute;r&ecirc;t de bons tests unitaires r&eacute;side dans le fait qu\'ils soient&nbsp;<em>idempotents</em>, c&rsquo;est-&agrave;-dire que pour un test donn&eacute;, quel que soit l\'environnement ou le nombre de fois qu\'il soit jou&eacute;, il produise toujours le m&ecirc;me r&eacute;sultat.&nbsp;<strong>C\'est pourquoi il est indispensable de faire abstraction des appels en base de donn&eacute;es ou des requ&ecirc;tes HTTP pour avoir un test unitaire robuste.</strong></p>\r\n<h3 id=\"automatises\"></h3>\r\n<p>Les tests unitaires doivent produire un r&eacute;sultat Pass ou Fail automatiquement. Ils doivent pouvoir &ecirc;tre interpr&eacute;t&eacute;s par un test runner et ne pas demander au d&eacute;veloppeur de lire ou d\'observer manuellement que le test a r&eacute;ussi ou &eacute;chou&eacute;. C\'est pourquoi les tests automatis&eacute;s, qu\'ils soient unitaires ou non, sont ex&eacute;cut&eacute;s par un test runner et &eacute;valu&eacute;s par une librairie d\'assertion.</p>\r\n<p>Pour reprendre l\'exemple de l\'API de parkings illustr&eacute; plus haut, voici &agrave; quoi ressembleraient ses tests unitaires:</p>\r\n<pre><code class=\"language-javascript\"><span class=\"token token\">describe</span><span class=\"token token\">(</span><span class=\"token token\">\'Book a parking spot\'</span><span class=\"token token\">,</span> <span class=\"token token\">(</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n    <span class=\"token token\">it</span><span class=\"token token\">(</span><span class=\"token token\">\'should not allow an uneligible vehicule to book a parking spot\'</span><span class=\"token token\">,</span> <span class=\"token token\">async</span> <span class=\"token token\">(</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n      <span class=\"token token\">// Arrange</span>\r\n      <span class=\"token token\">const</span> motorcycle <span class=\"token token\">=</span> <span class=\"token token\">{</span>\r\n          type<span class=\"token token\">:</span> <span class=\"token token\">\"motorcycle\"</span>\r\n      <span class=\"token token\">}</span><span class=\"token token\">;</span>\r\n      <span class=\"token token\">const</span> largeVehicule <span class=\"token token\">=</span> <span class=\"token token\">{</span>\r\n          length<span class=\"token token\">:</span> <span class=\"token token\">550</span>\r\n      <span class=\"token token\">}</span>\r\n      <span class=\"token token\">const</span> highVehicule <span class=\"token token\">=</span> <span class=\"token token\">{</span>\r\n          height<span class=\"token token\">:</span> <span class=\"token token\">550</span>\r\n      <span class=\"token token\">}</span>\r\n  \r\n      <span class=\"token token\">// Act</span>\r\n      <span class=\"token token control-flow\">try</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">const</span> motorCycleBooking <span class=\"token token\">=</span> <span class=\"token token\">bookParkingSpace</span><span class=\"token token\">(</span>motorcycle<span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-01\"</span><span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-10\"</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n\r\n      <span class=\"token token\">}</span> <span class=\"token token control-flow\">catch</span> <span class=\"token token\">(</span>err<span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">// Assert</span>\r\n        <span class=\"token token\">expect</span><span class=\"token token\">(</span>err<span class=\"token token\">.</span><span class=\"token token property-access\">message</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toEqual</span><span class=\"token token\">(</span><span class=\"token token\">\"This vehicule is not eligible for our parking\"</span><span class=\"token token\">)</span>\r\n      <span class=\"token token\">}</span>\r\n      <span class=\"token token control-flow\">try</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">const</span> longVehiculeBooking <span class=\"token token\">=</span> <span class=\"token token\">bookParkingSpace</span><span class=\"token token\">(</span>motorcycle<span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-01\"</span><span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-10\"</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n\r\n      <span class=\"token token\">}</span> <span class=\"token token control-flow\">catch</span> <span class=\"token token\">(</span>err<span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">// Assert</span>\r\n        <span class=\"token token\">expect</span><span class=\"token token\">(</span>err<span class=\"token token\">.</span><span class=\"token token property-access\">message</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toEqual</span><span class=\"token token\">(</span><span class=\"token token\">\"This vehicule is not eligible for our parking\"</span><span class=\"token token\">)</span>\r\n      <span class=\"token token\">}</span>\r\n      <span class=\"token token control-flow\">try</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">const</span> highVehiculeBooking <span class=\"token token\">=</span> <span class=\"token token\">bookParkingSpace</span><span class=\"token token\">(</span>motorcycle<span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-01\"</span><span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-10\"</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n\r\n      <span class=\"token token\">}</span> <span class=\"token token control-flow\">catch</span> <span class=\"token token\">(</span>err<span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">// Assert</span>\r\n        <span class=\"token token\">expect</span><span class=\"token token\">(</span>err<span class=\"token token\">.</span><span class=\"token token property-access\">message</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toEqual</span><span class=\"token token\">(</span><span class=\"token token\">\"This vehicule is not eligible for our parking\"</span><span class=\"token token\">)</span>\r\n      <span class=\"token token\">}</span>\r\n  \r\n\r\n    <span class=\"token token\">}</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n    <span class=\"token token\">it</span><span class=\"token token\">(</span><span class=\"token token\">\'should not allow a booking if no spot is available\'</span><span class=\"token token\">,</span> <span class=\"token token\">async</span> <span class=\"token token\">(</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n        <span class=\"token token\">// Arrange</span>\r\n        jest<span class=\"token token\">.</span><span class=\"token token method property-access\">mock</span><span class=\"token token\">(</span>db<span class=\"token token\">,</span><span class=\"token token\">\'findOne\'</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">mockReturnedValue</span><span class=\"token token\">(</span><span class=\"token token null nil\">null</span><span class=\"token token\">)</span>\r\n        <span class=\"token token\">const</span> car <span class=\"token token\">=</span> <span class=\"token token\">{</span>\r\n            type<span class=\"token token\">:</span> <span class=\"token token\">\"Car\"</span><span class=\"token token\">,</span>\r\n            height<span class=\"token token\">:</span> <span class=\"token token\">175</span><span class=\"token token\">,</span>\r\n            length<span class=\"token token\">:</span> <span class=\"token token\">330</span>\r\n        <span class=\"token token\">}</span>\r\n    \r\n        <span class=\"token token\">// Act</span>\r\n        <span class=\"token token control-flow\">try</span> <span class=\"token token\">{</span>\r\n            <span class=\"token token\">const</span> carBooking <span class=\"token token\">=</span> <span class=\"token token\">bookParkingSpace</span><span class=\"token token\">(</span>car<span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-01\"</span><span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-10\"</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n\r\n        <span class=\"token token\">}</span> <span class=\"token token control-flow\">catch</span> <span class=\"token token\">(</span>error<span class=\"token token\">)</span> <span class=\"token token\">{</span>\r\n            <span class=\"token token\">// Assert</span>\r\n            <span class=\"token token\">expect</span><span class=\"token token\">(</span>error<span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toBeDefined</span><span class=\"token token\">(</span><span class=\"token token\">)</span>\r\n            <span class=\"token token\">expect</span><span class=\"token token\">(</span>error<span class=\"token token\">.</span><span class=\"token token property-access\">message</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toEqual</span><span class=\"token token\">(</span><span class=\"token token\">\"No spaces available at your desired dates\"</span><span class=\"token token\">)</span>\r\n        <span class=\"token token\">}</span>\r\n      <span class=\"token token\">}</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n    <span class=\"token token\">it</span><span class=\"token token\">(</span><span class=\"token token\">\'should allow a booking if all is ok\'</span><span class=\"token token\">,</span> <span class=\"token token\">async</span> <span class=\"token token\">(</span><span class=\"token token\">)</span> <span class=\"token token arrow\">=&gt;</span> <span class=\"token token\">{</span>\r\n    <span class=\"token token\">// Arrange</span>\r\n    jest<span class=\"token token\">.</span><span class=\"token token method property-access\">mock</span><span class=\"token token\">(</span>db<span class=\"token token\">,</span><span class=\"token token\">\'findOne\'</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">mockReturnedValue</span><span class=\"token token\">(</span><span class=\"token token\">{</span>spot<span class=\"token token\">:</span><span class=\"token token\">231</span><span class=\"token token\">}</span><span class=\"token token\">)</span>\r\n    <span class=\"token token\">const</span> car <span class=\"token token\">=</span> <span class=\"token token\">{</span>\r\n        type<span class=\"token token\">:</span> <span class=\"token token\">\"Car\"</span><span class=\"token token\">,</span>\r\n        height<span class=\"token token\">:</span> <span class=\"token token\">175</span><span class=\"token token\">,</span>\r\n        length<span class=\"token token\">:</span> <span class=\"token token\">330</span>\r\n    <span class=\"token token\">}</span>\r\n    <span class=\"token token\">// Act</span>\r\n    <span class=\"token token\">const</span> carBooking <span class=\"token token\">=</span> <span class=\"token token\">bookParkingSpace</span><span class=\"token token\">(</span>car<span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-01\"</span><span class=\"token token\">,</span> <span class=\"token token\">\"2020-10-10\"</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n    <span class=\"token token\">// Assert</span>\r\n    <span class=\"token token\">expect</span><span class=\"token token\">(</span>carBooking<span class=\"token token\">.</span><span class=\"token token property-access\">spot</span><span class=\"token token\">)</span><span class=\"token token\">.</span><span class=\"token token method property-access\">toBeDefined</span><span class=\"token token\">(</span><span class=\"token token\">)</span>\r\n    <span class=\"token token\">}</span><span class=\"token token\">)</span><span class=\"token token\">;</span>\r\n<span class=\"token token\">}</span><span class=\"token token\">)</span></code></pre>\r\n<p>Nos tests unitaires se sont content&eacute;s d\'&eacute;valuer&nbsp;<code>bookParkingSpace</code>&nbsp;et ses diff&eacute;rentes issues. J\'ai planifi&eacute; les cas de figures qui me permettent de passer dans les diff&eacute;rentes branches de mon code afin de couvrir tous les cas d\'usage.</p>\r\n<h2 id=\"linteret-des-tests-unitaires\">L&rsquo;int&eacute;r&ecirc;t des tests unitaires</h2>\r\n<p>Les tests unitaires ne sont pas seulement un pilier de la m&eacute;thodologie Scrum, ils sont aussi et surtout &agrave; l&rsquo;origine m&ecirc;me d&rsquo;autres&nbsp;<strong>m&eacute;thodes agiles de d&eacute;veloppement de logiciels&nbsp;</strong>telles que&nbsp;<strong>XP (Extreme Programming</strong>) et&nbsp;<strong>TDD (Test-driven development</strong>).</p>\r\n<p>Bas&eacute;es sur des cycles de d&eacute;veloppement tr&egrave;s courts, ces m&eacute;thodes encouragent les d&eacute;veloppeurs &agrave;&nbsp;<strong>&eacute;crire le test unitaire pendant, voire avant qu&rsquo;ils &eacute;crivent la fonctionnalit&eacute; qu&rsquo;il teste</strong>. Cette m&eacute;thode permet au d&eacute;veloppeur d&rsquo;&eacute;crire une&nbsp;<strong>sp&eacute;cification</strong>&nbsp;avant de produire le code qui la satisfait d&rsquo;une mani&egrave;re v&eacute;rifiable. D&egrave;s lors, l&rsquo;int&eacute;r&ecirc;t principal du test unitaire n&rsquo;est plus de trouver des bugs mais de&nbsp;<strong>permettre de d&eacute;velopper des composants qui se conforment &agrave; une sp&eacute;cification.</strong></p>\r\n<p>L&rsquo;utilisation du test unitaire en tant que sp&eacute;cification permet de produire du code d&rsquo;une&nbsp;<strong>bien meilleure qualit&eacute; initiale</strong>. C&rsquo;est &eacute;galement un excellent moyen de&nbsp;<strong>faciliter la collaboration entre plusieurs d&eacute;veloppeurs</strong>&nbsp;: le code ainsi produit est plus facilement compr&eacute;hensible, maintenable, debuggable et moins prompt &agrave; casser &agrave; la premi&egrave;re modification. Des avantages qui font que cette m&eacute;thode est utilis&eacute;e par des leaders de la technologie tels que&nbsp;<a href=\"https://www.quora.com/Do-teams-from-Google-and-Facebook-use-TDD-to-write-software-If-yes-what-approximate-percentage-of-teams-are-doing-that\">Google</a>.</p>\r\n<h2 id=\"les-bonnes-pratiques-pour-coder-de-bons-tests-unitaires-\">Les bonnes pratiques pour coder de bons tests unitaires&nbsp;?</h2>\r\n<p>Si les tests unitaires acc&eacute;l&egrave;rent le d&eacute;veloppement, am&eacute;liorent la qualit&eacute; du code et facilitent la collaboration, encore faut-il respecter quelques&nbsp;<strong>bonnes pratiques</strong>&nbsp;pendant leur &eacute;laboration.</p>\r\n<h3 id=\"adopter-un-outil-ou-un-framework-de-test\"></h3>\r\n<p>Parce qu&rsquo;ils existent pour acc&eacute;l&eacute;rer et faciliter le d&eacute;veloppement, vous avez tout int&eacute;r&ecirc;t &agrave;&nbsp;<strong>automatiser vos tests unitaires</strong>. Plusieurs solutions pr&eacute;vues &agrave; cet effet existent sur le march&eacute; telles que le&nbsp;<a href=\"https://practicalprogramming.fr/boite-a-outils-node-js/jest/\"><strong>framework de test Jest pour Node.js</strong></a>. Jest est un framework ultra-rapide, performant et simple d&rsquo;utilisation utilis&eacute;e par des soci&eacute;t&eacute;s telles que Airbnb, Amazon, et Facebook.</p>\r\n<h3 id=\"elaborer-un-plan-de-test\"></h3>\r\n<p>Dans la vie comme dans le code,&nbsp;<strong>l&rsquo;organisation&nbsp;</strong>et la&nbsp;<strong>planification&nbsp;</strong>sont tr&egrave;s souvent de bonnes pratiques et permettent d&rsquo;&eacute;viter de perdre du temps sur des erreurs.&nbsp;<strong>&Eacute;laborez toujours un plan de test</strong>&nbsp;pour structurer vos tests unitaires, m&ecirc;me si c&rsquo;est uniquement dans votre t&ecirc;te et que vous ne le documentez pas. Un plan de test peut &ecirc;tre plus ou moins d&eacute;taill&eacute; et peut inclure&nbsp;: la d&eacute;finition de l&rsquo;unit&eacute; choisie, une description des fonctionnalit&eacute;s test&eacute;es, les inputs test&eacute;s et les outputs attendus, les outils utilis&eacute;s, la fr&eacute;quence de test&nbsp;etc.</p>\r\n<h3 id=\"le-choix-de-lunite\"></h3>\r\n<p>Quand on &eacute;labore un&nbsp;<strong>plan de test</strong>, le choix de l&rsquo;unit&eacute; test&eacute;e est fondamental. Pour les optimiser au maximum, il est important que&nbsp;<strong>les tests unitaires ne testent que les &eacute;l&eacute;ments les plus petits possibles</strong>&nbsp;dans votre application. On veillera donc par exemple &agrave;&nbsp;<strong>ne</strong>&nbsp;<strong>pas tester toutes les m&eacute;thodes d&rsquo;une classe</strong>&nbsp;mais plut&ocirc;t des parties de fonctionnalit&eacute;s. Si un bug survient dans celle-ci, il sera alors plus facile de savoir quelle partie du code est &agrave; r&eacute;parer en se basant sur le test unitaire qui a &eacute;chou&eacute;, faisant gagner un temps consid&eacute;rable.</p>\r\n<h3 id=\"lindependance\"></h3>\r\n<p>L&rsquo;&eacute;criture de tests unitaires est peut-&ecirc;tre l&rsquo;un des seuls domaines o&ugrave; &ecirc;tre un ind&eacute;pendantiste est socialement acceptable. Veillez &agrave;&nbsp;<strong>isoler vos tests unitaires au maximum</strong>&nbsp;et &agrave; les rendre totalement ind&eacute;pendants les uns des autres.&nbsp;<strong>Ne faites jamais appel &agrave; une base de donn&eacute;es ou &agrave; une API externe</strong>&nbsp;m&ecirc;me si votre classe en d&eacute;pend&nbsp;:&nbsp;<strong>utilisez toujours des donn&eacute;es de test</strong>&nbsp;les plus proches possibles des donn&eacute;es r&eacute;elles. De la m&ecirc;me fa&ccedil;on, on utilise des&nbsp;<em>mocks</em>&nbsp;et des&nbsp;<em>stubs</em>&nbsp;pour simuler le fonctionnement des autres modules qui ne sont pas dans le scope de notre unit&eacute;, ceux-ci seront test&eacute;s unitairement de leurs c&ocirc;t&eacute;s. La raison est toujours la m&ecirc;me&nbsp;: plus le p&eacute;rim&egrave;tre test&eacute; est restreint, plus facile et rapide il sera de remonter jusqu&rsquo;au bug qui a caus&eacute; l&rsquo;&eacute;chec du test unitaire.</p>\r\n<h2 id=\"autres-conseils-et-bonnes-pratiques\">Autres conseils et bonnes pratiques</h2>\r\n<p>Voici p&ecirc;le-m&ecirc;le d&rsquo;autres conseils et bonnes pratiques pour &eacute;crire des tests unitaires optimaux&nbsp;:</p>\r\n<ul>\r\n<li>S&eacute;parez votre&nbsp;<strong>environnement de test</strong>&nbsp;de votre environnement de d&eacute;veloppement</li>\r\n<li>Gardez vos tests unitaires&nbsp;<strong>tr&egrave;s rapides</strong>, jusqu&rsquo;&agrave; une dizaine de secondes au maximum</li>\r\n<li><strong>Avant de r&eacute;parer un bug,</strong>&nbsp;&eacute;crivez ou modifiez un test unitaire pour exposer ce bug</li>\r\n<li>Choisissez la bonne unit&eacute; pour que votre plan de test couvre un<strong>&nbsp;maximum de fonctionnalit&eacute;s</strong></li>\r\n<li>Utilisez un logiciel de&nbsp;<strong>gestion des versions</strong>&nbsp;pour garder une trace de tous vos tests unitaires</li>\r\n<li>Veillez au&nbsp;<strong>nommage de vos variables</strong>&nbsp;: suivez &agrave; la lettre les conventions de nommage pour faciliter la collaboration</li>\r\n<li>Utilisez le&nbsp;<strong>template AAA</strong>&nbsp;pour am&eacute;liorer la lisibilit&eacute; de votre test&nbsp;:&nbsp;<strong>Arrange</strong>&nbsp;(cr&eacute;ation des objets, des donn&eacute;es de test et d&eacute;finition des attentes),&nbsp;<strong>Act</strong>&nbsp;(invocation de la m&eacute;thode test&eacute;e),&nbsp;<strong>Assert</strong>&nbsp;(r&eacute;sultat du test unitaire)</li>\r\n<li><strong>Testez toujours et tout le temps</strong>&nbsp;<strong>!</strong></li>\r\n</ul>\r\n</div>\r\n<div class=\"pt-2\">&nbsp;</div>', 'Savoir coder des tests unitaires est une compétence essentielle pour tout développeur souhaitant progresser dans son métier. Non seulement c\'est un élément essentiel à tout code source pour s\'assurer que l\'application fonctionne toujours comme prévu ', 'post\\img_604c2caaf2d44.png', '2021-03-13 07:21:50'),
(38, 'Le Responsive Web Design', 1, 'post', 'le-responsive-web-design', '2021-03-13 11:14:38', '<p>Elu \"<em><strong>mot-cl&eacute; de l\'ann&eacute;e 2013</strong></em>\" par le&nbsp;<a href=\"http://mashable.com/\" target=\"_blank\" rel=\"noopener\">magazine Mashable</a>, le Responsive Web Design (RWD) fait parti aujourd\'hui de tous nos projets web, mais reste toujours aussi n&eacute;buleux et insaisissable m&ecirc;me chez les professionnels !</p>\r\n<h2 id=\"id-0\" class=\"page-section\">Pr&eacute;ambule</h2>\r\n<p>Le Responsive Web Design, ou&nbsp;<strong>conception web adaptative</strong>&nbsp;est une approche de conception Web qui vise gr&acirc;ce &agrave; diff&eacute;rents principes et techniques, &agrave; offrir pour l\'utilisateur une consultation confortable qui pourra&nbsp;<strong>s&rsquo;auto-adapter quelle que soit son support de lecture</strong>&nbsp;(Desktop, T&eacute;l&eacute;phones mobiles, Tablettes, Liseuses &hellip;).<br />Le terme de \"Responsive Web Design\" a &eacute;t&eacute; cit&eacute; pour la premi&egrave;re fois par&nbsp;<a href=\"https://twitter.com/beep\" target=\"_blank\" rel=\"noopener\">Ethan Marcotte</a>&nbsp;dans un article de&nbsp;<a href=\"https://alistapart.com/\" target=\"_blank\" rel=\"noopener\">A List Apart</a>&nbsp;publi&eacute; en mai 2010.</p>\r\n<p>&nbsp;</p>\r\n<h2 id=\"id-1\" class=\"page-section\">Quelles sont les principales techniques de Responsive Web Design ?</h2>\r\n<p>Le Responsive Web Design fait appel aussi bien &agrave; des&nbsp;<strong>m&eacute;thodes de conception ergonomique</strong>, puisqu\'il ne s\'agit plus de concevoir autant de parcours qu\'il y a de familles de terminaux mais de concevoir une seule interface auto-adaptable. Mais &eacute;galement &agrave; des&nbsp;<strong>requ&ecirc;tes (les Media Queries)</strong>&nbsp;poussant des styles CSS diff&eacute;rents en fonction de la taille de l\'&eacute;cran de l&rsquo;internaute.<br />Cela engendre des&nbsp;<strong>&eacute;conomies</strong>&nbsp;dans la conception et la maintenance de sites web b&eacute;n&eacute;ficiant de ce mode de conception.</p>\r\n<p>&nbsp;</p>\r\n<h2 id=\"id-2\" class=\"page-section\">Site d&eacute;di&eacute;, application ou responsive ? Quelle solution ?</h2>\r\n<p>Lorsque l&rsquo;on veut proposer &agrave; ses visiteurs un site visible sur mobile,&nbsp;<strong>trois solutions</strong>&nbsp;s&rsquo;offrent &agrave; nous :</p>\r\n<ul>\r\n<li>Cr&eacute;er un site d&eacute;di&eacute;</li>\r\n<li>D&eacute;velopper une application</li>\r\n<li>Cr&eacute;er un site en version responsive</li>\r\n</ul>\r\n<p>Chacun de ces choix poss&egrave;de ses avantages et ses inconv&eacute;nients.</p>\r\n<p>&nbsp;</p>\r\n<h3>Un site d&eacute;di&eacute;</h3>\r\n<p>Cela consiste &agrave; concevoir un site d&eacute;di&eacute;&nbsp;<strong>pour chaque support</strong>&nbsp;: un site desktop, un site pour tablettes, un site pour smartphones, etc.</p>\r\n<p><strong>Avantages</strong></p>\r\n<ul>\r\n<li>La structure et contenus du site d&eacute;di&eacute; sont pr&eacute;cis&eacute;ment adapt&eacute; au support</li>\r\n<li>Possibilit&eacute; de d&eacute;velopper des fonctionnalit&eacute;s vari&eacute;es (notamment le touch)</li>\r\n<li>Peut &ecirc;tre une alternative \"rapide\", en attendant une refonte compl&egrave;te (et responsive) de son site web</li>\r\n</ul>\r\n<p><strong>Inconv&eacute;nients</strong></p>\r\n<ul>\r\n<li>Le contenu dupliqu&eacute;</li>\r\n<li>La maintenance de plusieurs versions de site et de plusieurs adresses web prend &eacute;norm&eacute;ment de temps</li>\r\n<li>Les diff&eacute;rentes adresses web sont moins facilement indexables par les moteurs de recherche</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>Une application mobile</h3>\r\n<p>Une application est un produit d&eacute;velopp&eacute; sp&eacute;cifiquement dans divers langages (iOS, Android, WindowsPhone) et qui se t&eacute;l&eacute;charge et se r&eacute;f&eacute;rence au sein d\'un \"Store\" (AppStore, Google Play, Windows store).</p>\r\n<p><strong>Avantages</strong></p>\r\n<ul>\r\n<li>Une prise en charge facilit&eacute;e de fonctionnalit&eacute;s natives (touch, acc&eacute;l&eacute;rom&egrave;tre, notifications, GPS, etc.)</li>\r\n<li>Un total ajustement au p&eacute;riph&eacute;rique (ergonomie, performances, densit&eacute; de pixels)</li>\r\n<li>Visibilit&eacute; de la marque dans les &laquo; stores &raquo;</li>\r\n<li>Acc&egrave;s directe au smartphone de l&rsquo;utilisateur</li>\r\n</ul>\r\n<p><strong>Inconv&eacute;nients</strong></p>\r\n<ul>\r\n<li>N&eacute;cessite un d&eacute;veloppement dans plusieurs langages propres &agrave; iOS, Android, WindowsPhone, etc.</li>\r\n<li>Cette solution repr&eacute;sente un certain co&ucirc;t en ce qui concerne le d&eacute;veloppement et la maintenance contenus</li>\r\n<li>Non index&eacute; par les moteurs de recherche</li>\r\n<li>La mise &agrave; jour de l\'application n&eacute;cessite une action de l\'utilisateur</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>Un site responsive</h3>\r\n<p>Cette solution para&icirc;t la plus facile &agrave; l\'heure o&ugrave; des centaines de formats d\'&eacute;crans diff&eacute;rents se connectent &agrave; chaque instant.</p>\r\n<p><strong>Avantages</strong></p>\r\n<ul>\r\n<li>Le Responsive peut &ecirc;tre envisag&eacute; apr&egrave;s la conception initiale du site m&ecirc;me si ce n\'est pas l&rsquo;id&eacute;al</li>\r\n<li>Le co&ucirc;t ainsi que les d&eacute;lais sont g&eacute;n&eacute;ralement inf&eacute;rieurs aux autres solutions</li>\r\n<li>Une mise &agrave; jour transparente et un d&eacute;ploiement multi-plateformes</li>\r\n<li>La gestion du projet est facilit&eacute;</li>\r\n</ul>\r\n<p>L\'un des avantages ind&eacute;niables depuis quelques temps est que Google met en avant les sites \"adapt&eacute;s au mobile\" au sein de ses r&eacute;sultats de recherche.</p>\r\n<p><strong>Inconv&eacute;nients</strong></p>\r\n<ul>\r\n<li>Il est difficile de contourner les limites ergonomiques et de performances des navigateurs web</li>\r\n<li>Il est n&eacute;cessaire de pr&eacute;voir des tests tout au long du projet</li>\r\n</ul>\r\n<p>Il est fr&eacute;quent qu\'un cumul de diff&eacute;rentes m&eacute;thodes soit employ&eacute; : par exemple un site &agrave; la fois d&eacute;di&eacute; et responsive, ou un site responsive compl&eacute;t&eacute; d&rsquo;une application.</p>\r\n<h2 id=\"id-3\" class=\"page-section\">Autres notions &agrave; conna&icirc;tre :</h2>\r\n<h3>DESIGN STATIQUE</h3>\r\n<p>La mise en page statique correspond &agrave; la grande majorit&eacute; des sites web construit avant l\'arriv&eacute;e du Responsive Web Design dans les ann&eacute;es 2010.<br />Il utilise des&nbsp;<strong>dimensions fig&eacute;es</strong>&nbsp;(souvent 960px) quelle que soit la surface de l\'&eacute;cran.<br />Par exemple, si la fen&ecirc;tre du navigateur est plus large que le site, il y aura du blanc sur les c&ocirc;t&eacute;s. Par contre, si elle est moins large, il y aura une barre de scroll horizontal en bas de la fen&ecirc;tre pour pouvoir acc&eacute;der &agrave; la partie cach&eacute;e, ce qui n&rsquo;est pas du tout ergonomique.</p>\r\n<h3>DESIGN ADAPTATIVE</h3>\r\n<p>Un design Adaptatif est une am&eacute;lioration du design statique : les&nbsp;<strong>unit&eacute;s de largeur</strong>&nbsp;sont fixes, mais&nbsp;<strong>diff&eacute;rentes selon la taille de l&rsquo;&eacute;cran</strong>. Lorsque la fen&ecirc;tre du navigateur est redimensionn&eacute;e, &agrave; chaque franchissement de points de rupture (souvent : 320px, 480px, 768px, 1024px), une mise en page correspondante est utilis&eacute;e.</p>\r\n<h3>DESIGN LIQUIDE</h3>\r\n<p>Ici les largeurs des diff&eacute;rents &eacute;l&eacute;ments, sont&nbsp;<strong>exprim&eacute;es en pourcentage</strong>, ce qui fait que le site s&rsquo;adapte de fa&ccedil;on automatique &agrave; la taille de la fen&ecirc;tre. Ce design n&rsquo;est pas tr&egrave;s adapt&eacute; aux tr&egrave;s grandes tailles d&rsquo;&eacute;crans ni aux tr&egrave;s petites tailles.</p>\r\n<h3>DESIGN MOBILE FIRST</h3>\r\n<p>Syst&egrave;me qui&nbsp;<strong>privil&eacute;gie la construction d\'une ergonomie mobile</strong>&nbsp;avec un faible espace d&rsquo;affichage avant de concevoir celle pour &laquo; desktop &raquo; (ordinateur de bureau) qui reste le standard de l\'affichage traditionnel.<br />L\'augmentation constante des ventes via smartphone accro&icirc;t l&rsquo;int&eacute;r&ecirc;t de cette d&eacute;marche pens&eacute;e pour am&eacute;liorer l\'exp&eacute;rience utilisateur...</p>\r\n<p><br />Parmi les outils destin&eacute;s &agrave; la cr&eacute;ation de site web, le CMS Drupal a &eacute;labor&eacute; la version 8 de son CMS en int&eacute;grant cette pens&eacute;e &laquo; Mobile First &raquo;.</p>', 'Elu &quot;mot-clé de l\'année 2013&quot; par le magazine Mashable, le Responsive Web Design (RWD) fait parti aujourd\'hui de tous nos projets web, mais reste toujours aussi nébuleux et insaisissable même chez les professionnels !', 'post\\img_604c665e66dec.gif', NULL);
INSERT INTO `post` (`id`, `name`, `online`, `type`, `slug`, `created`, `content`, `description`, `img_description`, `date_edit`) VALUES
(39, 'Comment fonctionne le moteur de recherche Google ?', 1, 'post', 'comment-fonctionne-le-moteur-de-recherche-google-?', '2021-03-13 11:19:30', '<p><strong>5,5 milliards : il s\'agit du nombre de requ&ecirc;tes r&eacute;alis&eacute;es par jour sur le c&eacute;l&egrave;bre moteur de recherche Google. Nous l\'utilisons tous, et tous les jours ! C\'est un fait. Mais savez-vous r&eacute;ellement comment fonctionne le moteur de recherche Google ?</strong></p>\r\n<p>La visibilit&eacute; en ligne est devenue un enjeu majeur, avec un objectif prioritaire pour de nombreuses entreprises : un&nbsp;<a rel=\" noopener\">meilleur r&eacute;f&eacute;rencement Google</a>.</p>\r\n<p>Un&nbsp;<strong>bon r&eacute;f&eacute;rencement</strong>&nbsp;Google augmente consid&eacute;rablement le nombre de visites d\'un site web. En effet, la premi&egrave;re page de r&eacute;sultats de Google capte &agrave; elle seule 95 % des clics li&eacute;s &agrave; une recherche. Les pages suivantes ne totalisent que 5 % du trafic.</p>\r\n<p>Pour am&eacute;liorer son positionnement, il est indispensable de comprendre&nbsp;<strong>comment fonctionne un moteur de recherche comme Google</strong>. Nous vous expliquons les fondamentaux, les r&egrave;gles de base de l\'optimisation SEO et pourquoi une strat&eacute;gie web globale est essentielle.</p>\r\n<p><img src=\"https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=600&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg\" sizes=\"(max-width: 600px) 100vw, 600px\" srcset=\"https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=300&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 300w, https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=600&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 600w, https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=900&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 900w, https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=1200&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 1200w, https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=1500&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 1500w, https://blog.adimeo.com/hs-fs/hubfs/comment-fonctionne-le-moteur-de-recherche-google.jpg?width=1800&amp;name=comment-fonctionne-le-moteur-de-recherche-google.jpg 1800w\" alt=\"Comment fonctionne un moteur de recherche\" width=\"600\" /></p>\r\n<h2 id=\"id-0\" class=\"page-section\">Le fonctionnement de Google : ce que l\'on sait</h2>\r\n<p>Le&nbsp;<strong>fonctionnement de Google</strong>&nbsp;repose sur le principe d\'une gigantesque base de donn&eacute;es, aliment&eacute;e et constamment mise &agrave; jour par un robot.&nbsp;</p>\r\n<p>Le robot&nbsp;<strong>analyse le web et indexe les pages trouv&eacute;es</strong>, passant d&rsquo;une page &agrave; l&rsquo;autre en suivant les liens contenus dans chacune des pages.</p>\r\n<p>Pour chaque page, Google ajoute &agrave; sa base de donn&eacute;es l&rsquo;adresse de la page, le contenu de la page (titre, texte, balises meta, descriptions des images etc.) et les liens allant vers d&rsquo;autres pages. C&rsquo;est cette&nbsp;<strong>indexation</strong>&nbsp;qui nourrit les r&eacute;sultats affich&eacute;s par le moteur de recherche.</p>\r\n<p>L&rsquo;<strong>algorithme de Google</strong>&nbsp;pour classer les pages en r&eacute;ponse &agrave; une requ&ecirc;te est tenu secret et il &eacute;volue en permanence.</p>\r\n<p>Plus de 200 param&egrave;tres seraient pris en compte. N&eacute;anmoins, nous savons que les principaux crit&egrave;res de Google sont&nbsp;:</p>\r\n<ul>\r\n<li>L&rsquo;ensemble des mots contenus sur la page, leur contexte et leur position&nbsp;: Google utilise ces &eacute;l&eacute;ments pour d&eacute;terminer la&nbsp;<strong>pertinence de la page</strong>&nbsp;par rapport aux&nbsp;<strong>mots utilis&eacute;s dans les recherches</strong>.</li>\r\n<li>Le nombre de&nbsp;<strong>liens pointant vers cette page</strong>&nbsp;: un nombre important de liens signale &agrave; Google que c&rsquo;est une page de r&eacute;f&eacute;rence.</li>\r\n<li>Le&nbsp;<strong>texte des pages pointant vers cette page</strong>&nbsp;: le contenu des pages qui renvoient vers la page influence &eacute;galement l&rsquo;&eacute;valuation de la pertinence.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<div class=\"hs-responsive-embed-wrapper hs-responsive-embed\">\r\n<div class=\"hs-responsive-embed-inner-wrapper\"><iframe class=\"hs-responsive-embed-target-iframe hs-responsive-embed-iframe\" src=\"https://www.youtube.com/embed/BNHR6IQJGZs\" width=\"600\" height=\"338\" allowfullscreen=\"allowfullscreen\" data-service=\"youtube\" data-mce-fragment=\"1\"></iframe></div>\r\n</div>\r\n<p>&nbsp;</p>\r\n<h2 id=\"id-1\" class=\"page-section\">Optimiser son r&eacute;f&eacute;rencement : les r&egrave;gles de base</h2>\r\n<h3>Les mots-cl&eacute;s</h3>\r\n<p><a href=\"https://blog.adimeo.com/les-bons-mots-cles-pour-un-contenu-web-bien-reference\" rel=\" noopener\">Trouver les bons mots-cl&eacute;s</a>&nbsp;est important, pensez alors &agrave; la pertinence et la r&eacute;currence des mots-cl&eacute;s. Plus le mot-cl&eacute; est r&eacute;p&eacute;t&eacute;, plus la page sera consid&eacute;r&eacute;e par Google comme pertinente pour ce mot. Si le mot-cl&eacute; est plac&eacute; dans le titre ou au tout d&eacute;but de la page, il sera &eacute;galement davantage pris en compte. Pensez aussi &agrave; utiliser des synonymes de ce mot. Il est plus difficile d&rsquo;<strong>optimiser son r&eacute;f&eacute;rencement</strong>&nbsp;pour des mots-cl&eacute;s courts et g&eacute;n&eacute;riques. Les mots peu utilis&eacute;s et les combinaisons de mots-cl&eacute;s plus longues peuvent vous aider &agrave;&nbsp;<strong>g&eacute;n&eacute;rer du trafic</strong>. C&rsquo;est ce que l&rsquo;on appelle la&nbsp;<strong>longue&nbsp;</strong><strong>tra&icirc;ne</strong>.</p>\r\n<h3>Les liens</h3>\r\n<p>Les liens pointant vers votre page contribuent &agrave; booster votre r&eacute;f&eacute;rencement Google. Travaillez sur vos&nbsp;<strong>liens internes et externes</strong>&nbsp;(netlinking). La qualit&eacute; des pages dont proviennent les liens est d&eacute;terminante (Page Rank). Plus la page qui pointe vers votre page est consid&eacute;r&eacute;e comme une&nbsp;<strong>page de r&eacute;f&eacute;rence,</strong>&nbsp;plus l&rsquo;impact sur votre r&eacute;f&eacute;rencement sera important.</p>\r\n<p>N&eacute;anmoins, il faut avoir en t&ecirc;te que Google est intelligent et capable de d&eacute;tecter les strat&eacute;gies SEO trop grossi&egrave;res, comme le bourrage de mots-cl&eacute;s. Google cherche avant tout &agrave; proposer des contenus pertinents &agrave; ses utilisateurs et &agrave; leur fournir des r&eacute;sultats de recherche qui r&eacute;pondent &agrave; leurs attentes. A ce titre, Google est configur&eacute; pour privil&eacute;gier les contenus de qualit&eacute;.</p>\r\n<h2 id=\"id-2\" class=\"page-section\">Une strat&eacute;gie web globale : fournir des r&eacute;sultats</h2>\r\n<p>Si Google joue un r&ocirc;le important pour les&nbsp;<strong>strat&eacute;gies online,</strong>&nbsp;ce n&rsquo;est pas une fin en soi. Vos contenus doivent avant tout r&eacute;pondre aux besoins de vos utilisateurs et mettre en avant votre proposition de valeur. Il ne s&rsquo;agit pas d&rsquo;&eacute;crire pour Google, mais bien d&rsquo;<strong>&eacute;crire pour vos utilisateurs</strong>&nbsp;en tenant compte de Google.</p>\r\n<p>Une&nbsp;<strong>strat&eacute;gie web globale</strong>&nbsp;est essentielle pour atteindre vos objectifs. Cette strat&eacute;gie doit placer votre utilisateur au c&oelig;ur de la d&eacute;marche. Tenez compte de l&rsquo;&eacute;volution des usages. De plus en plus d&rsquo;utilisateurs sont &laquo; mobile first &raquo; et certains, comme les Millennials, &laquo; mobile only &raquo;. Votre site doit &ecirc;tre&nbsp;<strong>responsive</strong>&nbsp;et&nbsp;<strong>optimis&eacute; pour les mobiles</strong>. Google indexe d&rsquo;ailleurs la version mobile des pages en priorit&eacute;. Restez en veille sur les innovations&nbsp;et adoptez de nouveaux formats pour vous d&eacute;marquer, comme la vid&eacute;o, les snippets ou la&nbsp;<strong>position z&eacute;ro</strong>.</p>\r\n<p><span style=\"text-decoration: underline;\">D&eacute;finissez une strat&eacute;gie de contenus efficace et percutante !</span></p>\r\n<p>&nbsp;</p>\r\n<p>Voil&agrave;&nbsp;<strong>comment fonctionne un moteur de recherche comme Google</strong>&nbsp;! Pour &ecirc;tre mieux r&eacute;f&eacute;renc&eacute; par ce dernier, travaillez votre&nbsp;<strong>strat&eacute;gie SEO,</strong>&nbsp;vos mots-cl&eacute;s et votre netlinking. N&rsquo;h&eacute;sitez pas &agrave; adopter une d&eacute;marche de&nbsp;<em>test and learn</em>, en v&eacute;rifiant les r&eacute;sultats obtenus et en ajustant votre strat&eacute;gie si besoin. Cr&eacute;ez toujours des contenus qui ont du sens et pens&eacute;s pour vos utilisateurs afin de<strong>&nbsp;fournir des r&eacute;sultats</strong>. C&rsquo;est effectivement ainsi que vous boosterez votre&nbsp;<strong>visibilit&eacute; en ligne</strong>.</p>', '5,5 milliards : il s\'agit du nombre de requêtes réalisées par jour sur le célèbre moteur de recherche Google. Nous l\'utilisons tous, et tous les jours ! C\'est un fait. Mais savez-vous réellement comment fonctionne le moteur de recherche Google ?', 'post\\img_604c67827d634.jpg', '2021-03-13 11:35:39');

-- --------------------------------------------------------

--
-- Structure de la table `tags_has_medias`
--

DROP TABLE IF EXISTS `tags_has_medias`;
CREATE TABLE IF NOT EXISTS `tags_has_medias` (
  `fk_media_id` int(11) NOT NULL,
  `fk_tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tags_has_medias`
--

INSERT INTO `tags_has_medias` (`fk_media_id`, `fk_tag_id`) VALUES
(121, 5),
(121, 5),
(122, 5),
(32, 5),
(37, 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_cathegories`
--

DROP TABLE IF EXISTS `t_cathegories`;
CREATE TABLE IF NOT EXISTS `t_cathegories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `categorie_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_cathegories`
--

INSERT INTO `t_cathegories` (`id`, `name`, `img`, `description`, `categorie_parent`) VALUES
(1, 'Gamme Jam', 'icon\\img_603a0064c230a.jpg', 'test 2', 2),
(2, 'pixel Art', 'icon\\img_603a00ba4c29d.jpg', 'Le pixel art  aussi appelé art du pixel ou art des pixels  au Québec, désigne une composition numérique qui utilise une définition d\'écran basse et un nombre de couleurs limité.', NULL),
(4, 'Youtube', 'icon\\img_603a00d607022.jpg', 'vidéo en ligne', NULL),
(5, 'Twitch', 'icon\\img_603a01b0d2cb0.png', 'zaezezae', NULL),
(6, 'Technique pixel art ', 'icon\\img_603a20ca51d83.gif', 'Tous se qui conserne les technique de dessin d\'un pixel art ', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_cathegories_has_post`
--

DROP TABLE IF EXISTS `t_cathegories_has_post`;
CREATE TABLE IF NOT EXISTS `t_cathegories_has_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `cathegories_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_cathegories_has_post`
--

INSERT INTO `t_cathegories_has_post` (`id`, `post_id`, `cathegories_id`) VALUES
(2, 26, 2),
(11, 33, 4),
(10, 33, 2),
(14, 0, 2),
(15, 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `t_commentaires`
--

DROP TABLE IF EXISTS `t_commentaires`;
CREATE TABLE IF NOT EXISTS `t_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_com` datetime NOT NULL DEFAULT current_timestamp(),
  `id_article` int(11) NOT NULL,
  `id_reponce` int(11) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_commentaires`
--

INSERT INTO `t_commentaires` (`id`, `content`, `id_user`, `date_com`, `id_article`, `id_reponce`, `login`) VALUES
(73, 'yolo', 1, '2021-03-08 11:26:48', 35, NULL, NULL),
(72, 'mon message', 1, '2021-03-08 11:26:32', 35, NULL, NULL),
(71, 'babou', 1, '2021-03-08 09:41:28', 24, 64, NULL),
(70, 'erzezrez', 1, '2021-03-08 09:39:02', 24, 69, NULL),
(69, 'yola', 1, '2021-03-08 09:35:41', 24, 68, NULL),
(68, 'yo', 1, '2021-03-08 09:35:19', 24, 65, NULL),
(67, 'zaezaeza', 1, '2021-03-08 09:35:07', 24, 63, NULL),
(66, 'zezezaezaea', 1, '2021-03-08 09:32:28', 24, 62, NULL),
(65, 'aezeazeaze', 1, '2021-03-08 09:32:20', 24, NULL, NULL),
(64, 'salut', 1, '2021-03-08 09:21:01', 24, 62, NULL),
(63, 'yo', 1, '2021-03-08 09:15:52', 24, 61, NULL),
(62, 'bonjour', 1, '2021-03-08 09:14:52', 24, NULL, NULL),
(61, 'salut', 1, '2021-03-08 09:14:28', 24, NULL, NULL),
(74, 'mon message', 1, '2021-03-08 11:27:28', 35, 72, NULL),
(75, 'yolo', 1, '2021-03-08 11:27:42', 35, NULL, NULL),
(76, 'salut', 1, '2021-03-08 11:30:15', 35, NULL, NULL),
(77, 'salut', 1, '2021-03-08 11:32:13', 35, NULL, NULL),
(78, 'bonjour', 1, '2021-03-08 11:32:20', 35, NULL, NULL),
(79, 'salut les lou lou', 1, '2021-03-08 11:33:30', 35, NULL, NULL),
(80, 'frt', 1, '2021-03-08 11:34:30', 35, NULL, NULL),
(81, 'derty', 1, '2021-03-08 11:35:03', 35, NULL, NULL),
(82, 'salut', 1, '2021-03-08 11:35:44', 35, NULL, NULL),
(83, 'test', 1, '2021-03-08 11:37:53', 35, NULL, NULL),
(84, 'erezrzeerze', 1, '2021-03-08 11:38:35', 35, NULL, NULL),
(85, 'ezzaezae', 1, '2021-03-08 11:39:24', 35, NULL, NULL),
(86, 'erzerzer', 1, '2021-03-08 11:40:18', 35, NULL, NULL),
(87, 'test', 1, '2021-03-08 11:41:39', 35, NULL, NULL),
(88, 'fddfsdfs', 1, '2021-03-08 11:42:21', 35, NULL, NULL),
(89, 'je suis fou', 1, '2021-03-08 11:42:35', 35, NULL, NULL),
(90, 'Mercie pour le test', 1, '2021-03-08 11:42:48', 35, 87, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_home`
--

DROP TABLE IF EXISTS `t_home`;
CREATE TABLE IF NOT EXISTS `t_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` text NOT NULL,
  `quote` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_home`
--

INSERT INTO `t_home` (`id`, `titel`, `quote`, `presentation`, `is_active`) VALUES
(1, 'Bienvenue à Dragonnser Art!', 'L’art, c’est le plus court chemin de l’homme à l’homme. <br><small>Citations d\'André Malraux</small>', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae fugiat ipsa voluptate, magni eligendi dolore ullam non et minima vel labore modi unde saepe ea reiciendis, officiis laboriosam dolorem?\r\n                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae fugiat ipsa voluptate, magni eligendi dolore ullam non et minima vel labore modi unde saepe ea reiciendis, officiis laboriosam dolorem?\r\n                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae fugiat ipsa voluptate, magni eligendi dolore ullam non et minima vel labore modi unde saepe ea reiciendis, officiis laboriosam dolorem?\r\n                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis molestiae fugiat ipsa voluptate, magni eligendi dolore ullam non et minima vel labore modi unde saepe ea reiciendis, officiis laboriosam dolorem?', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_medias`
--

DROP TABLE IF EXISTS `t_medias`;
CREATE TABLE IF NOT EXISTS `t_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `urlsmall` varchar(255) NOT NULL,
  `isgalerie` int(1) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `info` text NOT NULL DEFAULT '',
  `urlbig` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_medias`
--

INSERT INTO `t_medias` (`id`, `name`, `urlsmall`, `isgalerie`, `type`, `info`, `urlbig`) VALUES
(111, 'img_5facad4a284b5_img_5f8834b4deaaa.jpg', '2021\\03\\small\\img_603f1e4a423e4.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a423e4.jpg'),
(110, 'img_5facad4a9dd40_img_5f8834b5cecfc.jpg', '2021\\03\\small\\img_603f1e4a3692b.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a3692b.jpg'),
(29, 'img_5facad4a5c7d1_img_5f8834b5a0bf5.jpg', '2021\\03\\small\\img_603f026a84a60.jpg', 1, 'img', '', '2021\\03\\big\\img_603f026a84a60.jpg'),
(32, 'img_5facad4a442c5_img_5f8834b4f3afc.jpg', '2021\\03\\small\\img_603f026aa7eb2.jpg', 1, 'img', '', '2021\\03\\big\\img_603f026aa7eb2.jpg'),
(134, 'img_5facad70ed96f_img_5f8834d66c528.jpg', '2021\\03\\small\\img_6042222b9f3ff.jpg', 0, 'img', '', '2021\\03\\big\\img_6042222b9f3ff.jpg'),
(135, 'img_5facad71a94dd_img_5f8834d92fc71.jpg', '2021\\03\\small\\img_6042222ba7bb3.jpg', 0, 'img', '', '2021\\03\\big\\img_6042222ba7bb3.jpg'),
(35, 'img_5facad4ab6be9_img_5f8834b5e1133.jpg', '2021\\03\\small\\img_603f026ac4b83.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ac4b83.jpg'),
(36, 'img_5facad4acdef8_img_5f8834b5f197c.jpg', '2021\\03\\small\\img_603f026accf9f.jpg', 1, 'img', '', '2021\\03\\big\\img_603f026accf9f.jpg'),
(37, 'img_5facad4ae4b2c_img_5f8834b6a9563.jpg', '2021\\03\\small\\img_603f026ad534c.jpg', 1, 'img', '', '2021\\03\\big\\img_603f026ad534c.jpg'),
(38, 'img_5facad4af019a_img_5f8834b6b1b90.jpg', '2021\\03\\small\\img_603f026ad9634.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ad9634.jpg'),
(133, 'img_5facad70e17c1_img_5f8834d60f3e8.jpg', '2021\\03\\small\\img_6042222b99a52.jpg', 0, 'img', '', '2021\\03\\big\\img_6042222b99a52.jpg'),
(40, 'img_5facad4b4c384_img_5f8834b7b9a9f.jpg', '2021\\03\\small\\img_603f026ae9fa4.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ae9fa4.jpg'),
(42, 'img_5facad4b080c2_img_5f8834b6ba4ef.jpg', '2021\\03\\small\\img_603f026b0cbf9.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b0cbf9.jpg'),
(43, 'img_5facad4b84a5e_img_5f8834b7e010b.jpg', '2021\\03\\small\\img_603f026b10fdc.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b10fdc.jpg'),
(136, 'img_5facad71befba_img_5f8834d93e833.jpg', '2021\\03\\small\\img_6042222bb1dc0.jpg', 0, 'img', '', '2021\\03\\big\\img_6042222bb1dc0.jpg'),
(45, 'img_5facad4b7390f_img_5f8834b7d4900.jpg', '2021\\03\\small\\img_603f026b242c6.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b242c6.jpg'),
(52, 'img_5facad4c6ffd0_img_5f8834b53d85a.jpg', '2021\\03\\small\\img_603f026b7e2b7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b7e2b7.jpg'),
(53, 'img_5facad4c12d5c_img_5f8834b9b2c29.jpg', '2021\\03\\small\\img_603f026b91ecb.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b91ecb.jpg'),
(54, 'img_5facad4c9240c_img_5f8834b62c826.jpg', '2021\\03\\small\\img_603f026b9ea6c.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026b9ea6c.jpg'),
(55, 'img_5facad4ca95c6_img_5f8834b63d3ee.jpg', '2021\\03\\small\\img_603f026ba7223.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ba7223.jpg'),
(56, 'img_5facad4cbae47_img_5f8834b66b3c7.jpg', '2021\\03\\small\\img_603f026badba7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026badba7.jpg'),
(57, 'img_5facad4cd3670_img_5f8834b67d443.jpg', '2021\\03\\small\\img_603f026bb9afa.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026bb9afa.jpg'),
(58, 'img_5facad4cea320_img_5f8834b68d317.jpg', '2021\\03\\small\\img_603f026bc2610.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026bc2610.jpg'),
(59, 'img_5facad4d0dc9d_img_5f8834b69d962.jpg', '2021\\03\\small\\img_603f026bcc28f.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026bcc28f.jpg'),
(60, 'img_5facad4d4ee09_img_5f8834b73b5c3.jpg', '2021\\03\\small\\img_603f026bd2c06.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026bd2c06.jpg'),
(112, 'img_5facad4a442c5_img_5f8834b4f3afc.jpg', '2021\\03\\small\\img_603f1e4a50a30.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a50a30.jpg'),
(62, 'img_5facad4d38bc0_img_5f8834b72bd3a.jpg', '2021\\03\\small\\img_603f026be2ff7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026be2ff7.jpg'),
(63, 'img_5facad4d64ebb_img_5f8834b74b2b2.jpg', '2021\\03\\small\\img_603f026beb0e3.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026beb0e3.jpg'),
(64, 'img_5facad4d90c70_img_5f8834b81cc3e.jpg', '2021\\03\\small\\img_603f026c0532e.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c0532e.jpg'),
(65, 'img_5facad4d817ed_img_5f8834b78ec0e.jpg', '2021\\03\\small\\img_603f026c0d758.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c0d758.jpg'),
(67, 'img_5facad4dbe35d_img_5f8834b83be50.jpg', '2021\\03\\small\\img_603f026c1af1f.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c1af1f.jpg'),
(69, 'img_5facad4dea065_img_5f8834b89e3f4.jpg', '2021\\03\\small\\img_603f026c2b599.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c2b599.jpg'),
(70, 'img_5facad4e2d49b_img_5f8834b93ed38.jpg', '2021\\03\\small\\img_603f026c39aab.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c39aab.jpg'),
(71, 'img_5facad4e7e3da_img_5f8834b461ec5.jpg', '2021\\03\\small\\img_603f026c45b1e.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c45b1e.jpg'),
(72, 'img_5facad4e9a780_img_5f8834b616a51.jpg', '2021\\03\\small\\img_603f026c4c442.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c4c442.jpg'),
(73, 'img_5facad4e47f67_img_5f8834b98b30f.jpg', '2021\\03\\small\\img_603f026c51257.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c51257.jpg'),
(74, 'img_5facad4e1234f_img_5f8834b92be51.jpg', '2021\\03\\small\\img_603f026c5dfa3.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c5dfa3.jpg'),
(75, 'img_5facad4e64067_img_5f8834b99fe65.jpg', '2021\\03\\small\\img_603f026c6afda.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c6afda.jpg'),
(76, 'img_5facad4e90761_img_5f8834b598cfc.jpg', '2021\\03\\small\\img_603f026c7784d.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c7784d.jpg'),
(77, 'img_5facad4eaadeb_img_5f8834b773f87.jpg', '2021\\03\\small\\img_603f026c78b64.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c78b64.jpg'),
(78, 'img_5facad4ece175_img_5f8834b868d08.jpg', '2021\\03\\small\\img_603f026c8cdce.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c8cdce.jpg'),
(109, 'img_5facad4a5c7d1_img_5f8834b5a0bf5.jpg', '2021\\03\\small\\img_603f1e4a2e0a0.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a2e0a0.jpg'),
(80, 'img_5facad4f5a771_img_5f8834b6493b0.jpg', '2021\\03\\small\\img_603f026c9d896.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026c9d896.jpg'),
(81, 'img_5facad4f8a18a_img_5f8834b8010fc.jpg', '2021\\03\\small\\img_603f026ca5f8d.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ca5f8d.jpg'),
(82, 'img_5facad4f34dfd_img_5f8834b4822ff.jpg', '2021\\03\\small\\img_603f026cbacc9.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026cbacc9.jpg'),
(83, 'img_5facad4f083e4_img_5f8834b889eda.jpg', '2021\\03\\small\\img_603f026cc37c2.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026cc37c2.jpg'),
(84, 'img_5facad4f716c3_img_5f8834b6598a6.jpg', '2021\\03\\small\\img_603f026ccfb86.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ccfb86.jpg'),
(85, 'img_5facad4f2369f_img_5f8834b4560ed.jpg', '2021\\03\\small\\img_603f026cd8133.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026cd8133.jpg'),
(86, 'img_5facad4f4963f_img_5f8834b6215d7.jpg', '2021\\03\\small\\img_603f026cde2f7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026cde2f7.jpg'),
(87, 'img_5facad4fae769_img_5f8834b9522f7.jpg', '2021\\03\\small\\img_603f026ce4201.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026ce4201.jpg'),
(88, 'img_5facad4fc86f1_img_5f8834b9761c7.jpg', '2021\\03\\small\\img_603f026cf019d.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026cf019d.jpg'),
(89, 'img_5facad4fe3fc2_img_5f8834b49064c.jpg', '2021\\03\\small\\img_603f026d0874a.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d0874a.jpg'),
(90, 'img_5facad4fef2f4_img_5f8834b70692f.jpg', '2021\\03\\small\\img_603f026d0c76e.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d0c76e.jpg'),
(91, 'img_5facad5a0d4a8_img_5f8834c4f1cbc.JPG', '2021\\03\\small\\img_603f026d1a998.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d1a998.jpg'),
(92, 'img_5facad5a6e920_img_5f8834c5e5003.jpg', '2021\\03\\small\\img_603f026d22754.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d22754.jpg'),
(93, 'img_5facad5a9bba9_img_5f8834c6b4ecf.jpg', '2021\\03\\small\\img_603f026d2b1a8.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d2b1a8.jpg'),
(94, 'img_5facad5a255ad_img_5f8834c5b1915.jpg', '2021\\03\\small\\img_603f026d3f149.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d3f149.jpg'),
(95, 'img_5facad5a00643_img_5f8834c4cd3d0.jpg', '2021\\03\\small\\img_603f026d4d618.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d4d618.jpg'),
(96, 'img_5facad5a853b9_img_5f8834c6a50ce.jpg', '2021\\03\\small\\img_603f026d517a3.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d517a3.jpg'),
(108, 'img_5facad4a0a8e2_img_5f8834b4c8b0c.jpg', '2021\\03\\small\\img_603f1e4a1ea84.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a1ea84.jpg'),
(98, 'img_5facad5a58476_img_5f8834c5d5dfd.jpg', '2021\\03\\small\\img_603f026d630a9.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d630a9.jpg'),
(99, 'img_5facad5abfcd4_img_5f8834c6d02d4.jpg', '2021\\03\\small\\img_603f026d6af71.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d6af71.jpg'),
(100, 'img_5facad5ad7b93_img_5f8834c6e08fc.jpg', '2021\\03\\small\\img_603f026d73109.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d73109.jpg'),
(101, 'img_5facad5aedcfe_img_5f8834c6efe6a.jpg', '2021\\03\\small\\img_603f026d7ad8d.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d7ad8d.jpg'),
(102, 'img_5facad5b0feee_img_5f8834c7a3116.jpg', '2021\\03\\small\\img_603f026d834de.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d834de.jpg'),
(103, 'img_5facad5b5c67b_img_5f8834c8ad15e.jpg', '2021\\03\\small\\img_603f026d8bd07.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d8bd07.jpg'),
(105, 'img_5facad5b25ac5_img_5f8834c7b221a.jpg', '2021\\03\\small\\img_603f026d9a567.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026d9a567.jpg'),
(106, 'img_5facad5b724e1_img_5f8834c8bc666.jpg', '2021\\03\\small\\img_603f026da67f4.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026da67f4.jpg'),
(107, 'img_5facad5b41369_img_5f8834c08d82d.jpg', '2021\\03\\small\\img_603f026dbb651.jpg', 0, 'img', '', '2021\\03\\big\\img_603f026dbb651.jpg'),
(114, 'img_5facad4a886ff_img_5f8834b5bfd9a.jpg', '2021\\03\\small\\img_603f1e4a64c43.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a64c43.jpg'),
(115, 'img_5facad4ab6be9_img_5f8834b5e1133.jpg', '2021\\03\\small\\img_603f1e4a6d9de.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a6d9de.jpg'),
(116, 'img_5facad4acdef8_img_5f8834b5f197c.jpg', '2021\\03\\small\\img_603f1e4a760de.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a760de.jpg'),
(117, 'img_5facad4ae4b2c_img_5f8834b6a9563.jpg', '2021\\03\\small\\img_603f1e4a7e713.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a7e713.jpg'),
(118, 'img_5facad4af019a_img_5f8834b6b1b90.jpg', '2021\\03\\small\\img_603f1e4a829ea.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a829ea.jpg'),
(119, 'img_5facad4b2ff7f_img_5f8834b7a4acc.jpg', '2021\\03\\small\\img_603f1e4a86e24.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a86e24.jpg'),
(120, 'img_5facad4b4c384_img_5f8834b7b9a9f.jpg', '2021\\03\\small\\img_603f1e4a935f7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a935f7.jpg'),
(121, 'img_5facad4b13dea_img_5f8834b6c2ef3.jpg', '2021\\03\\small\\img_603f1e4a9dcac.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4a9dcac.jpg'),
(122, 'img_5facad4b080c2_img_5f8834b6ba4ef.jpg', '2021\\03\\small\\img_603f1e4aaa4c5.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4aaa4c5.jpg'),
(123, 'img_5facad4b84a5e_img_5f8834b7e010b.jpg', '2021\\03\\small\\img_603f1e4aaea6c.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4aaea6c.jpg'),
(125, 'img_5facad4b7390f_img_5f8834b7d4900.jpg', '2021\\03\\small\\img_603f1e4ac1ab7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4ac1ab7.jpg'),
(126, 'img_5facad4ba0870_img_5f8834b8b372c.jpg', '2021\\03\\small\\img_603f1e4ac7cea.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4ac7cea.jpg'),
(130, 'img_5facad4c2c52d_img_5f8834b9c48eb.jpg', '2021\\03\\small\\img_603f1e4af3bf7.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4af3bf7.jpg'),
(132, 'img_5facad4c6ffd0_img_5f8834b53d85a.jpg', '2021\\03\\small\\img_603f1e4b270bb.jpg', 0, 'img', '', '2021\\03\\big\\img_603f1e4b270bb.jpg'),
(156, 'logo-2582747_1280.png', '2021\\03\\small\\img_604c43cec4e34.png', 0, 'img', '', '2021\\03\\big\\img_604c43cec4e34.png'),
(157, 'logo-2582748_1280.png', '2021\\03\\small\\img_604c43cf0413c.png', 0, 'img', '', '2021\\03\\big\\img_604c43cf0413c.png');

-- --------------------------------------------------------

--
-- Structure de la table `t_messages`
--

DROP TABLE IF EXISTS `t_messages`;
CREATE TABLE IF NOT EXISTS `t_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet_message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `content_message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_messages`
--

INSERT INTO `t_messages` (`id`, `objet_message`, `date`, `content_message`, `is_read`, `email`, `full_name`) VALUES
(11, 'test des la messagerie ', '2021-03-13 08:05:07', 'ceci est un test de la messagerie ', 0, 'beroute97480@hotmail.fr', 'Gauvin jonathan');

-- --------------------------------------------------------

--
-- Structure de la table `t_rgpd`
--

DROP TABLE IF EXISTS `t_rgpd`;
CREATE TABLE IF NOT EXISTS `t_rgpd` (
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_rgpd`
--

INSERT INTO `t_rgpd` (`name`, `description`, `img_url`) VALUES
('rgpd', '<p>Le(s) service(s) [citer le nom du ou des services concern&eacute;s] dispose(nt) de moyens informatiques destin&eacute;s &agrave; g&eacute;rer plus facilement &hellip; [indiquer la finalit&eacute; du traitement].Les informations enregistr&eacute;es sont r&eacute;serv&eacute;es &agrave; l&rsquo;usage du (ou des) service(s) concern&eacute;(s) et ne peuvent &ecirc;tre communiqu&eacute;es qu&rsquo;aux destinataires suivants : [pr&eacute;ciser les destinataires]. Depuis la loi n&deg; 78-17 du 6 janvier 1978 modifi&eacute;e, relative &agrave; l&rsquo;informatique, aux fichiers et aux libert&eacute;s, toute personne peut obtenir communication et, le cas &eacute;ch&eacute;ant, rectification ou suppression des informations la concernant, en s&rsquo;adressant au service [citer le nom du service ou des services concern&eacute;s] avec copie au DPO de l&rsquo;&eacute;tablissement (quand il a &eacute;t&eacute; nomm&eacute;). Toute personne peut &eacute;galement, pour des motifs l&eacute;gitimes, s&rsquo;opposer au traitement des donn&eacute;es la concernant &ldquo;[&agrave; ne pas faire figurer si le traitement pr&eacute;sente un caract&egrave;re obligatoire.]</p>', NULL),
('legal_notive', '<p>Merci de lire avec attention les diff&eacute;rentes modalit&eacute;s d&rsquo;utilisation du pr&eacute;sent site avant d&rsquo;y parcourir ses pages. En vous connectant sur ce site, vous acceptez, sans r&eacute;serves, les pr&eacute;sentes modalit&eacute;s.</p>\r\n<p>Aussi, conform&eacute;ment &agrave; l&rsquo;article n&deg;6 de la Loi n&deg;2004-575 du 21 Juin 2004 pour la confiance dans l&rsquo;&eacute;conomie num&eacute;rique, les responsables du pr&eacute;sent site internet&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>&nbsp;sont :</p>\r\n<p><strong>&Eacute;diteur du Site :</strong></p>\r\n<p>SARL ANTHEDESIGN Num&eacute;ro de SIRET : 75221735600027</p>\r\n<p>Responsable &eacute;ditorial :&nbsp;<a href=\"https://www.anthedesign.fr/author/hugo-essique/\">Hugo ESSIQUE</a></p>\r\n<p>12 Rue du Huit Mai 1945, 60350 ATTICHY</p>\r\n<p>T&eacute;l&eacute;phone : 09 72 21 25 07</p>\r\n<p>Email : contact@anthedesign.fr</p>\r\n<p>Site Web :&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a></p>\r\n<p><strong>H&eacute;bergement :</strong></p>\r\n<p>H&eacute;bergeur : SARL ANTHEDESIGN<br />12 Rue du Huit Mai 1945, 60350 ATTICHY<br />Site Web :&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a></p>\r\n<p><strong>D&eacute;veloppement</strong><strong>&nbsp;:</strong></p>\r\n<p>SARL ANTHEDESIGN</p>\r\n<p>Adresse : 12 Rue du Huit Mai 1945, 60350 ATTICHY</p>\r\n<p>Site Web :&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a></p>\r\n<p><strong>Conditions d&rsquo;utilisation :</strong></p>\r\n<p>Ce site (<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>) est propos&eacute; en diff&eacute;rents langages web (HTML, HTML5, Javascript, CSS, etc&hellip;) pour un meilleur confort d&rsquo;utilisation et un graphisme plus agr&eacute;able.</p>\r\n<p>Nous vous recommandons de recourir &agrave; des navigateurs modernes comme Internet explorer, Safari, Firefox, Google Chrome, etc&hellip;</p>\r\n<p>L&rsquo;<a href=\"https://www.anthedesign.fr/\">agence web AntheDesign</a><strong>&nbsp;</strong>met en &oelig;uvre tous les moyens dont elle dispose, pour assurer une information fiable et une mise &agrave; jour fiable de ses sites internet.</p>\r\n<p>Toutefois, des erreurs ou omissions peuvent survenir. L&rsquo;internaute devra donc s&rsquo;assurer de l&rsquo;exactitude des informations aupr&egrave;s de AntheDesign , et signaler toutes modifications du site qu&rsquo;il jugerait utile. AntheDesign n&rsquo;est en aucun cas responsable de l&rsquo;utilisation faite de ces informations, et de tout pr&eacute;judice direct ou indirect pouvant en d&eacute;couler.</p>\r\n<p><strong>Cookies</strong>&nbsp;: Le site&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>&nbsp;peut-&ecirc;tre amen&eacute; &agrave; vous demander l&rsquo;acceptation des cookies pour des besoins de statistiques et d&rsquo;affichage. Un&nbsp;<a href=\"https://www.anthedesign.fr/autour-du-web/cookie/\">cookie</a>&nbsp;est une information d&eacute;pos&eacute;e sur votre disque dur par le serveur du site que vous visitez.</p>\r\n<p>Il contient plusieurs donn&eacute;es qui sont stock&eacute;es sur votre ordinateur dans un simple fichier texte auquel un serveur acc&egrave;de pour lire et enregistrer des informations . Certaines parties de ce site ne peuvent &ecirc;tre fonctionnelles sans l&rsquo;acceptation de cookies.</p>\r\n<p><strong>Liens hypertextes :</strong>&nbsp;Les sites internet de peuvent offrir des liens vers d&rsquo;autres sites internet ou d&rsquo;autres ressources disponibles sur Internet. SARL ANTHEDESIGN ne dispose d&rsquo;aucun moyen pour contr&ocirc;ler les sites en connexion avec ses sites internet.</p>\r\n<p>AntheDesign ne r&eacute;pond pas de la disponibilit&eacute; de tels sites et sources externes, ni ne la garantit. Elle ne peut &ecirc;tre tenue pour responsable de tout dommage, de quelque nature que ce soit, r&eacute;sultant du contenu de ces sites ou sources externes, et notamment des informations, produits ou services qu&rsquo;ils proposent, ou de tout usage qui peut &ecirc;tre fait de ces &eacute;l&eacute;ments. Les risques li&eacute;s &agrave; cette utilisation incombent pleinement &agrave; l&rsquo;internaute, qui doit se conformer &agrave; leurs conditions d&rsquo;utilisation.</p>\r\n<p>Les utilisateurs, les abonn&eacute;s et les visiteurs des sites internet &nbsp;ne peuvent pas mettre en place un hyperlien en direction de ce site sans l&rsquo;autorisation expresse et pr&eacute;alable de SARL ANTHEDESIGN.</p>\r\n<p>Dans l&rsquo;hypoth&egrave;se o&ugrave; un utilisateur ou visiteur souhaiterait mettre en place un hyperlien en direction d&rsquo;un des sites internet de SARL ANTHEDESIGN, il lui appartiendra d&rsquo;adresser un email accessible sur le site afin de formuler sa demande de mise en place d&rsquo;un hyperlien.</p>\r\n<p>La SARL ANTHEDESIGN se r&eacute;serve le droit d&rsquo;accepter ou de refuser un hyperlien sans avoir &agrave; en justifier sa d&eacute;cision.</p>\r\n<p><strong>Services fournis :</strong></p>\r\n<p>L&rsquo;ensemble des activit&eacute;s de la soci&eacute;t&eacute; ainsi que ses informations sont pr&eacute;sent&eacute;s sur notre site&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>.</p>\r\n<p>SARL ANTHEDESIGN s&rsquo;efforce de fournir sur le site www.anthedesign.fr des informations aussi pr&eacute;cises que possible. Les renseignements figurant sur le site&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>&nbsp;ne sont pas exhaustifs et les photos non contractuelles.</p>\r\n<p>Ils sont donn&eacute;s sous r&eacute;serve de modifications ayant &eacute;t&eacute; apport&eacute;es depuis leur mise en ligne. Par ailleurs, tous les informations indiqu&eacute;es sur le site www.anthedesign.fr<strong>&nbsp;</strong>sont donn&eacute;es &agrave; titre indicatif, et sont susceptibles de changer ou d&rsquo;&eacute;voluer sans pr&eacute;avis.</p>\r\n<p><strong>Limitation contractuelles sur les donn&eacute;es :</strong></p>\r\n<p>Les informations contenues sur ce site sont aussi pr&eacute;cises que possible et le site remis &agrave; jour &agrave; diff&eacute;rentes p&eacute;riodes de l&rsquo;ann&eacute;e, mais peut toutefois contenir des inexactitudes ou des omissions.</p>\r\n<p>Si vous constatez une lacune, erreur ou ce qui parait &ecirc;tre un dysfonctionnement, merci de bien vouloir le signaler par courriel, &agrave; l&rsquo;adresse contact@anthedesign.fr, en d&eacute;crivant le probl&egrave;me de la mani&egrave;re la plus pr&eacute;cise possible (page posant probl&egrave;me, type d&rsquo;ordinateur et de navigateur utilis&eacute;, &hellip;).</p>\r\n<p>Tout contenu t&eacute;l&eacute;charg&eacute; se fait aux risques et p&eacute;rils de l&rsquo;utilisateur et sous sa seule responsabilit&eacute;. En cons&eacute;quence, ne saurait &ecirc;tre tenu responsable d&rsquo;un quelconque dommage subi par l&rsquo;ordinateur de l&rsquo;utilisateur ou d&rsquo;une quelconque perte de donn&eacute;es cons&eacute;cutives au t&eacute;l&eacute;chargement.</p>\r\n<p>De plus, l&rsquo;utilisateur du site s&rsquo;engage &agrave; acc&eacute;der au site en utilisant un mat&eacute;riel r&eacute;cent, ne contenant pas de virus et avec un navigateur de derni&egrave;re g&eacute;n&eacute;ration mis-&agrave;-jour.</p>\r\n<p>Les liens hypertextes mis en place dans le cadre du pr&eacute;sent site internet en direction d&rsquo;autres ressources pr&eacute;sentes sur le r&eacute;seau Internet ne sauraient engager la responsabilit&eacute; de SARL ANTHEDESIGN.</p>\r\n<p><strong>Propri&eacute;t&eacute; intellectuelle :</strong></p>\r\n<p>Tout le contenu du pr&eacute;sent site&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>, incluant, de fa&ccedil;on non limitative, les graphismes, images, textes, vid&eacute;os, animations, sons, logos, gifs et ic&ocirc;nes ainsi que leur mise en forme sont la propri&eacute;t&eacute; exclusive de la soci&eacute;t&eacute; &agrave; l&rsquo;exception des marques, logos ou contenus appartenant &agrave; d&rsquo;autres soci&eacute;t&eacute;s partenaires ou auteurs.</p>\r\n<p>Toute reproduction, distribution, modification, adaptation, retransmission ou publication, m&ecirc;me partielle, de ces diff&eacute;rents &eacute;l&eacute;ments est strictement interdite sans l&rsquo;accord expr&egrave;s par &eacute;crit de SARL ANTHEDESIGN. Cette repr&eacute;sentation ou reproduction, par quelque proc&eacute;d&eacute; que ce soit, constitue une contrefa&ccedil;on sanctionn&eacute;e par les articles L.335-2 et suivants du Code de la propri&eacute;t&eacute; intellectuelle. Le non-respect de cette interdiction constitue une contrefa&ccedil;on pouvant engager la responsabilit&eacute; civile et p&eacute;nale du contrefacteur. En outre, les propri&eacute;taires des Contenus copi&eacute;s pourraient intenter une action en justice &agrave; votre encontre.</p>\r\n<p><strong>D&eacute;claration &agrave; la CNIL :</strong></p>\r\n<p>Conform&eacute;ment &agrave; la loi 78-17 du 6 janvier 1978 (modifi&eacute;e par la loi 2004-801 du 6 ao&ucirc;t 2004 relative &agrave; la protection des personnes physiques &agrave; l&rsquo;&eacute;gard des traitements de donn&eacute;es &agrave; caract&egrave;re personnel) relative &agrave; l&rsquo;informatique, aux fichiers et aux libert&eacute;s, ce site a fait l&rsquo;objet d&rsquo;une d&eacute;claration 1656629 aupr&egrave;s de la Commission nationale de l&rsquo;informatique et des libert&eacute;s (<a href=\"http://www.cnil.fr/\">www.cnil.fr</a>).</p>\r\n<p><strong>Litiges :</strong></p>\r\n<p>Les pr&eacute;sentes conditions du site&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>&nbsp;sont r&eacute;gies par les lois fran&ccedil;aises et toute contestation ou litiges qui pourraient na&icirc;tre de l&rsquo;interpr&eacute;tation ou de l&rsquo;ex&eacute;cution de celles-ci seront de la comp&eacute;tence exclusive des tribunaux dont d&eacute;pend le si&egrave;ge social de la soci&eacute;t&eacute;. La langue de r&eacute;f&eacute;rence, pour le r&egrave;glement de contentieux &eacute;ventuels, est le fran&ccedil;ais.</p>\r\n<p><strong>Donn&eacute;es personnelles :</strong></p>\r\n<p>De mani&egrave;re g&eacute;n&eacute;rale, vous n&rsquo;&ecirc;tes pas tenu de nous communiquer vos donn&eacute;es personnelles lorsque vous visitez notre site Internet&nbsp;<a href=\"https://www.anthedesign.fr/\">www.anthedesign.fr</a>.</p>\r\n<p>Cependant, ce principe comporte certaines exceptions. En effet, pour certains services propos&eacute;s par notre site, vous pouvez &ecirc;tre amen&eacute;s &agrave; nous communiquer certaines donn&eacute;es telles que : votre nom, votre fonction, le nom de votre soci&eacute;t&eacute;, votre adresse &eacute;lectronique, et votre num&eacute;ro de t&eacute;l&eacute;phone. Tel est le cas lorsque vous remplissez le formulaire qui vous est propos&eacute; en ligne, dans la rubrique &laquo;&nbsp;<a href=\"https://www.anthedesign.fr/contact/\">contact</a>&nbsp;&raquo;.</p>\r\n<p>Dans tous les cas, vous pouvez refuser de fournir vos donn&eacute;es personnelles. Dans ce cas, vous ne pourrez pas utiliser les services du site, notamment celui de solliciter des renseignements sur notre soci&eacute;t&eacute;, ou de recevoir les lettres d&rsquo;information.</p>\r\n<p>Enfin, nous pouvons collecter de mani&egrave;re automatique certaines informations vous concernant lors d&rsquo;une simple navigation sur notre site internet, notamment : des informations concernant l&rsquo;utilisation de notre site, comme les zones que vous visitez et les services auxquels vous acc&eacute;dez, votre&nbsp;<a href=\"https://www.anthedesign.fr/hebergement-web/adresse-ip/\">adresse IP</a>, le type de votre navigateur, vos temps d&rsquo;acc&egrave;s.</p>\r\n<p>De telles informations sont utilis&eacute;es exclusivement &agrave; des fins de statistiques internes, de mani&egrave;re &agrave; am&eacute;liorer la qualit&eacute; des services qui vous sont propos&eacute;s. Les bases de donn&eacute;es sont prot&eacute;g&eacute;es par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative &agrave; la protection juridique des bases de donn&eacute;es.</p>', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_roles`
--

DROP TABLE IF EXISTS `t_roles`;
CREATE TABLE IF NOT EXISTS `t_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  `description_role` varchar(255) DEFAULT NULL,
  `img_role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_roles`
--

INSERT INTO `t_roles` (`id`, `role_name`, `description_role`, `img_role`) VALUES
(1, 'admin', 'gère l\'ensemble du site et possède tout les droit d\'administration ', 'avatar\\img_6039ffa8ce94d.png'),
(6, 'modérateur', 'gère le blog et le portfolio peut supprimer des commentaires ', 'avatar\\img_6039ffbbcd804.png'),
(22, 'user', 'utilisateur standard du site ', 'avatar\\img_6039ffe76e9f2.png');

-- --------------------------------------------------------

--
-- Structure de la table `t_site_info`
--

DROP TABLE IF EXISTS `t_site_info`;
CREATE TABLE IF NOT EXISTS `t_site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_site` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `fix_phone` int(11) DEFAULT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `url_facebook` varchar(255) DEFAULT NULL,
  `url_tweeter` varchar(255) DEFAULT NULL,
  `url_insta` varchar(255) DEFAULT NULL,
  `url_youtube` varchar(255) DEFAULT NULL,
  `url_Linkedin` varchar(255) DEFAULT NULL,
  `url_pinterest` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_site_info`
--

INSERT INTO `t_site_info` (`id`, `name_site`, `site_email`, `fix_phone`, `mobile_number`, `url_facebook`, `url_tweeter`, `url_insta`, `url_youtube`, `url_Linkedin`, `url_pinterest`) VALUES
(1, 'Jon-Développement', 'jonathanfrt97480@gmail.com', 262000000, 692417574, '', '', '', '', 'https://www.linkedin.com/in/gauvin-jonathan/', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_tags`
--

DROP TABLE IF EXISTS `t_tags`;
CREATE TABLE IF NOT EXISTS `t_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(45) NOT NULL,
  `description_tag` varchar(255) NOT NULL,
  `url_tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_tags`
--

INSERT INTO `t_tags` (`id`, `name_tag`, `description_tag`, `url_tag`) VALUES
(5, 'tag de test', 'ezaeazezaeza', 'icon\\img_603b4a6a61cee.png');

-- --------------------------------------------------------

--
-- Structure de la table `t_tracker`
--

DROP TABLE IF EXISTS `t_tracker`;
CREATE TABLE IF NOT EXISTS `t_tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_connection` date NOT NULL DEFAULT current_timestamp(),
  `ip_user` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_tracker`
--

INSERT INTO `t_tracker` (`id`, `date_connection`, `ip_user`) VALUES
(1, '2021-03-04', '::1'),
(2, '2021-03-05', '::1'),
(3, '2021-03-05', '::1'),
(4, '2021-03-05', '::1'),
(5, '2021-03-05', '::1'),
(6, '2021-03-05', '::1'),
(7, '2021-03-05', '::1'),
(8, '2021-03-05', '::1'),
(9, '2021-03-05', '::1'),
(10, '2021-03-05', '::1'),
(11, '2021-03-05', '::1'),
(12, '2021-03-05', '::1'),
(13, '2021-03-05', '::1'),
(14, '2021-03-05', '::1'),
(15, '2021-03-05', '::1'),
(16, '2021-03-05', '::1'),
(17, '2021-03-05', '::1'),
(18, '2021-03-05', '::1'),
(19, '2021-03-05', '::1'),
(20, '2021-03-05', '::1'),
(21, '2021-03-05', '::1'),
(22, '2021-03-05', '::1'),
(23, '2021-03-05', '::1'),
(24, '2021-03-05', '::1'),
(25, '2021-03-05', '::1'),
(26, '2021-03-05', '::1'),
(27, '2021-03-05', '::1'),
(28, '2021-03-05', '::1'),
(29, '2021-03-05', '::1'),
(30, '2021-03-05', '::1'),
(31, '2021-03-06', '::1'),
(32, '2021-03-06', '::1'),
(33, '2021-03-07', '::1'),
(34, '2021-03-08', '::1'),
(35, '2021-03-08', '::1'),
(36, '2021-03-08', '::1'),
(37, '2021-03-08', '::1'),
(38, '2021-03-08', '::1'),
(39, '2021-03-08', '::1'),
(40, '2021-03-08', '::1'),
(41, '2021-03-08', '::1'),
(42, '2021-03-08', '::1'),
(43, '2021-03-08', '::1'),
(44, '2021-03-08', '::1'),
(45, '2021-03-08', '::1'),
(46, '2021-03-08', '::1'),
(47, '2021-03-08', '::1'),
(48, '2021-03-08', '::1'),
(49, '2021-03-08', '::1'),
(50, '2021-03-08', '::1'),
(51, '2021-03-08', '::1'),
(52, '2021-03-08', '::1'),
(53, '2021-03-08', '::1'),
(54, '2021-03-08', '::1'),
(55, '2021-03-08', '::1'),
(56, '2021-03-08', '::1'),
(57, '2021-03-08', '::1'),
(58, '2021-03-08', '::1'),
(59, '2021-03-08', '::1'),
(60, '2021-03-08', '::1'),
(61, '2021-03-08', '::1'),
(62, '2021-03-08', '::1'),
(63, '2021-03-08', '::1'),
(64, '2021-03-08', '::1'),
(65, '2021-03-08', '::1'),
(66, '2021-03-08', '::1'),
(67, '2021-03-08', '::1'),
(68, '2021-03-08', '::1'),
(69, '2021-03-08', '::1'),
(70, '2021-03-08', '::1'),
(71, '2021-03-08', '::1'),
(72, '2021-03-08', '::1'),
(73, '2021-03-08', '::1'),
(74, '2021-03-08', '::1'),
(75, '2021-03-08', '::1'),
(76, '2021-03-08', '::1'),
(77, '2021-03-08', '::1'),
(78, '2021-03-08', '::1'),
(79, '2021-03-08', '::1'),
(80, '2021-03-08', '::1'),
(81, '2021-03-08', '::1'),
(82, '2021-03-08', '::1'),
(83, '2021-03-08', '::1'),
(84, '2021-03-08', '::1'),
(85, '2021-03-08', '::1'),
(86, '2021-03-08', '::1'),
(87, '2021-03-08', '::1'),
(88, '2021-03-08', '::1'),
(89, '2021-03-08', '::1'),
(90, '2021-03-08', '::1'),
(91, '2021-03-08', '::1'),
(92, '2021-03-08', '::1'),
(93, '2021-03-08', '::1'),
(94, '2021-03-08', '::1'),
(95, '2021-03-08', '::1'),
(96, '2021-03-08', '::1'),
(97, '2021-03-08', '::1'),
(98, '2021-03-08', '::1'),
(99, '2021-03-08', '::1'),
(100, '2021-03-08', '::1'),
(101, '2021-03-12', '::1'),
(102, '2021-03-12', '::1'),
(103, '2021-03-12', '::1'),
(104, '2021-03-12', '::1'),
(105, '2021-03-12', '::1'),
(106, '2021-03-12', '::1'),
(107, '2021-03-12', '::1'),
(108, '2021-03-12', '::1'),
(109, '2021-03-12', '::1'),
(110, '2021-03-12', '::1'),
(111, '2021-03-13', '::1'),
(112, '2021-03-13', '::1'),
(113, '2021-03-13', '::1'),
(114, '2021-03-13', '::1'),
(115, '2021-03-13', '::1'),
(116, '2021-03-13', '::1'),
(117, '2021-03-13', '::1'),
(118, '2021-03-13', '::1'),
(119, '2021-03-13', '::1'),
(120, '2021-03-13', '::1'),
(121, '2021-03-13', '::1'),
(122, '2021-03-13', '::1'),
(123, '2021-03-13', '::1'),
(124, '2021-03-13', '::1'),
(125, '2021-03-13', '::1'),
(126, '2021-03-13', '::1'),
(127, '2021-03-13', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `validatekey` varchar(255) NOT NULL DEFAULT '0',
  `validate` int(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL,
  `fk_role_id` int(11) NOT NULL DEFAULT 2,
  `count_active` tinyint(1) NOT NULL DEFAULT 0,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `fk_lang` int(11) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `enable_user` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`id`, `login`, `name`, `password`, `email`, `validatekey`, `validate`, `avatar`, `fk_role_id`, `count_active`, `registration_date`, `fk_lang`, `first_name`, `enable_user`) VALUES
(1, 'admin', 'fredy fred', 'd033e22ae348aeb5660fc2140aec35850c4da997', '97480@hotmail.fr', '', 1, 'avatar\\img_603a000394189.jpg', 1, 1, '2021-02-17 20:42:10', 1, 'Gina Fontaine5', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_users_has_t_users_info`
--

DROP TABLE IF EXISTS `t_users_has_t_users_info`;
CREATE TABLE IF NOT EXISTS `t_users_has_t_users_info` (
  `t_users_id` int(11) NOT NULL,
  `t_users_info_id` int(11) NOT NULL,
  PRIMARY KEY (`t_users_id`,`t_users_info_id`),
  KEY `fk_t_users_has_t_users_info_t_users_info1_idx` (`t_users_info_id`),
  KEY `fk_t_users_has_t_users_info_t_users_idx` (`t_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_users_has_t_users_info`
--

INSERT INTO `t_users_has_t_users_info` (`t_users_id`, `t_users_info_id`) VALUES
(1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `t_users_info`
--

DROP TABLE IF EXISTS `t_users_info`;
CREATE TABLE IF NOT EXISTS `t_users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zip_code` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_users_info`
--

INSERT INTO `t_users_info` (`id`, `zip_code`, `country`, `city`, `address`, `address_2`, `phone`, `mobile`) VALUES
(39, '97480', 'Réunion', 'Saint Joseph', '6 rue renée', '6 rue rené hoareau bat b porte 18, batiment b porte 18', '0692417574', NULL),
(40, '97480', 'Réunion', 'Saint Joseph', '6 rue renée hoareau', '6 rue renée hoareau, batiment b porte 11', '0262413776', NULL),
(41, '97480', 'Réunion', 'saint joseph', '5a rue joseph bedier les jaques', '5a rue joseph bedier les jaques', '0692417574', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
