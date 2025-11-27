

    @extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        section {
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
        }
        h4, h4,h5 {
            color: #E81075;
        }
        p{
            font-size:18px;
            font-weight:500;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }


        section {
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
        }

        .faq-item, .destination, .press-item, .contact-info, .code-item {
            /* background: #e4e4e4; */
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .faq-item h5, .destination h5, .press-item h5, .contact-info h5, .code-item h5 {
            margin: 0;
            font-size:22px;
        }
        .faq-item p, .destination p, .press-item p, .contact-info p, .code-item p {
            margin: 5px 0;
        }
    </style>


<div class="titrepage">
     <h3>CONDITIONS D'UTILISATION</h3>
  </div>
    <section id="terms" class="container">
        <!-- <h4>Conditions d'Utilisation</h4> -->
        <p>Bienvenue sur kuqplan. En accédant à notre site et en l'utilisant, vous acceptez d'être lié par les présentes Conditions d'Utilisation et la Politique de Confidentialité. Nous nous réservons le droit de modifier ces termes à tout moment et sans préavis. Veuillez les lire attentivement avant d'utiliser notre site.</p>

        <h4>1. Utilisation Acceptable</h4>
        <p>
            1.1. Vous acceptez d'utiliser notre site uniquement à des fins légales et en respectant toutes les lois locales, nationales et internationales applicables.<br>
            1.2. Il est interdit d'utiliser notre site pour :<br>
            - Harceler, abuser ou nuire à autrui.<br>
            - Transmettre des contenus illégaux, offensants ou nuisibles.<br>
            - Impliquer des informations fausses ou trompeuses.<br>
            - Collecter des informations personnelles d'autres utilisateurs sans leur consentement.
        </p>

        <h4>2. Inscription et Sécurité du Compte </h4>
        <p>
            2.1. Pour utiliser certaines fonctionnalités de notre site, vous devez vous inscrire en fournissant des informations précises, complètes et à jour.<br>
            2.2. Vous êtes responsable de la sécurité de votre compte et de toutes les activités qui se produisent sous votre nom d'utilisateur et votre mot de passe.
        </p>

        <h4>3. Droits de Propriété Intellectuelle </h4>
        <p>
            3.1. Tous les contenus présents sur notre site, y compris mais sans s'y limiter, les textes, graphiques, logos, images et logiciels, sont la propriété de kuqplan ou de ses concédants de licence et sont protégés par les lois sur la propriété intellectuelle.<br>
            3.2. Vous ne pouvez pas reproduire, distribuer, modifier, créer des œuvres dérivées, afficher publiquement, exécuter publiquement, republier, télécharger, stocker ou transmettre tout matériel sur notre site sans notre autorisation écrite préalable.
        </p>

        <h4>4. Politique de Confidentialité </h4>
        <p>
            4.1. Nous collectons et utilisons vos informations personnelles conformément à notre Politique de Confidentialité.<br>
            4.2. Les informations collectées peuvent inclure, mais sans s'y limiter : nom, adresse e-mail, numéro de téléphone, et informations de paiement. Ces informations sont utilisées pour gérer votre compte et améliorer notre service.<br>
            4.3. Nous ne partageons pas vos informations personnelles avec des tiers, sauf si cela est nécessaire pour fournir nos services ou si la loi l'exige.
        </p>

        <h4> 5. Politique de Paiement</h4>
        <p>
            5.1. Les utilisateurs doivent payer pour débloquer les numéros de téléphone des membres féminins. Tous les paiements sont non remboursables.<br>
            5.2. En effectuant un paiement, vous acceptez nos conditions de facturation. Nous nous réservons le droit de modifier nos frais et méthodes de facturation à tout moment.
        </p>

        <h4>6. Limitation de Responsabilité </h4>
        <p>
            6.1. kuqplan ne peut être tenu responsable de tout dommage direct, indirect, accessoire, consécutif ou punitif résultant de l'utilisation ou de l'incapacité d'utiliser notre site.<br>
            6.2. Nous ne garantissons pas que notre site sera ininterrompu, exempt d'erreurs ou sécurisé.
        </p>

        <h4>7. Résiliation </h4>
        <p>
            7.1. Nous nous réservons le droit de suspendre ou de résilier votre accès à notre site à notre discrétion, sans préavis, pour toute violation de ces termes ou pour toute autre raison.
        </p>

        <h4>8. Loi Applicable et Juridiction </h4>
        <p>
            8.1. Ces Conditions d'Utilisation sont régies et interprétées conformément aux lois de notre pays.<br>
            8.2. Tout litige découlant de ou en relation avec ces termes sera soumis à la juridiction exclusive des tribunaux de [Votre Ville/Région].
        </p>

        <h4>9. Contact </h4>
        <p>
            9.1. Pour toute question concernant ces termes ou notre politique de confidentialité, veuillez nous contacter à [Adresse e-mail de contact].
        </p>
    </section>

    <section id="privacy" class="container">
        <h4>Politique de Confidentialité</h4>
        <p>Cette Politique de Confidentialité explique comment nous collectons, utilisons, divulguons et protégeons vos informations lorsque vous utilisez notre site web kuqplan.</p>

        <h4>1. Informations Collectées</h4>
        <p>
            1.1. Informations Personnelles : Lorsque vous vous inscrivez ou utilisez notre site, nous pouvons collecter des informations personnelles telles que votre nom, adresse e-mail, numéro de téléphone et informations de paiement.<br>
            1.2. Informations Non-Personnelles : Nous pouvons également collecter des informations non personnelles telles que votre adresse IP, type de navigateur, langue, et pages consultées.
        </p>

        <h4>2. Utilisation des Informations</h4>
        <p>
            2.1. Nous utilisons les informations collectées pour :<br>
            - Fournir et améliorer nos services.<br>
            - Traiter vos paiements et gérer votre compte.<br>
            - Communiquer avec vous concernant votre compte ou nos services.<br>
            - Protéger notre site contre les activités frauduleuses ou illégales.
        </p>

        <h4>3. Partage des Informations</h4>
        <p>
            3.1. Nous ne partageons pas vos informations personnelles avec des tiers, sauf si cela est nécessaire pour fournir nos services ou si la loi l'exige.<br>
            3.2. Nous pouvons partager des informations non personnelles avec des tiers pour des fins de marketing, de publicité ou autres utilisations commerciales.
        </p>

        <h4>4. Sécurité des Données</h4>
        <p>
            4.1. Nous prenons des mesures raisonnables pour protéger vos informations personnelles contre la perte, l'utilisation abusive et l'accès non autorisé.
        </p>

        <h4>5. Vos Droits</h4>
        <p>
            5.1. Vous avez le droit d'accéder, de corriger ou de supprimer vos informations personnelles en nous contactant à [Adresse e-mail de contact].
        </p>

        <h4>6. Modifications de cette Politique </h4>
        <p>
            6.1. Nous pouvons mettre à jour cette Politique de Confidentialité de temps en temps. Nous vous informerons de toute modification en publiant la nouvelle politique sur notre site.
        </p>
    </section>


    <div class="titrepage">
     <h4>FAQ</h4>
  </div>
    <section id="faq" class="container">
        <!-- <h4>FAQ</h4> -->
        <div class="faq-item">
            <h5>Comment puis-je m'inscrire sur kuqplan?</h5>
            <p>Pour vous inscrire, cliquez sur le bouton "S'inscrire" en haut de la page d'accueil et suivez les instructions pour créer un compte.</p>
        </div>
        <div class="faq-item">
            <h5>Comment puis-je modifier mon profil?</h5>
            <p>Pour modifier votre profil, connectez-vous à votre compte, accédez à la section "Mon Profil" et apportez les modifications nécessaires.</p>
        </div>
        <div class="faq-item">
            <h5>Comment contacter le support?</h5>
            <p>Vous pouvez contacter notre support client via la page de contact ou en envoyant un e-mail à support@kuqplan.com.</p>
        </div>
        <div class="faq-item">
            <h5>Quels sont les modes de paiement acceptés?</h5>
            <p>Nous acceptons les paiements par carte de crédit, PayPal et virement bancaire.</p>
        </div>
    </section>

    <section id="destinations" class="container">
        <h4>Mes Destinations</h4>
        <div class="destination">
            <p>Découvrez les meilleurs lieux de rencontre et événements à Paris pour trouver l'amour.</p>
        </div>
        <div class="destination">
            <p>Explorez les endroits romantiques et les activités pour les célibataires.</p>
        </div>
        <div class="destination">
            <p>Rencontrez des célibataires  et participez à des événements de rencontre.</p>
        </div>
    </section>

    <section id="press" class="container">
        <h4>Espace Presse</h4>
        <div class="press-item">
            <h5>Communiqué de Presse - Juin 2024</h5>
            <p>kuqplan annonce le lancement de sa nouvelle fonctionnalité de messagerie vidéo pour améliorer l'expérience utilisateur.</p>
        </div>
        <div class="press-item">
            <h5>Article en Vedette</h5>
            <p>Lisez notre article en vedette sur le blog de kuqplan pour découvrir des conseils de rencontre et des histoires de succès.</p>
        </div>
        <div class="press-item">
            <h5>Contact Presse</h5>
            <p>Pour les demandes de presse, veuillez contacter notre équipe à presse@kuqplan.com.</p>
        </div>
    </section>

    <section id="contact" class="container">
        <h4>Contact</h4>
        <div class="contact-info">
            <h5>Adresse</h5>
            <p>Benin/Cotnou</p>
        </div>
        <div class="contact-info">
            <h5>Téléphone</h5>
            <p>+22995558780</p>
        </div>
        <div class="contact-info">
            <h5>Email</h5>
            <p>contact@kuqplan.com</p>
        </div>

    </section>

    <section id="code" class="container">
        <h4>Code Professionnel</h4>
        <div class="code-item">
            <h5>Nos Engagements</h5>
            <p>Chez kuqplan, nous nous engageons à respecter les normes éthiques les plus élevées et à protéger la confidentialité et la sécurité de nos utilisateurs.</p>
        </div>
        <div class="code-item">
            <h5>Respect et Inclusion</h5>
            <p>Nous promouvons un environnement respectueux et inclusif, où chaque utilisateur est traité avec dignité et respect.</p>
        </div>
        <div class="code-item">
            <h5>Transparence</h5>
            <p>Nous croyons en la transparence et communiquons ouvertement sur nos pratiques, nos politiques et nos conditions d'utilisation.</p>
        </div>
    </section>
    @endsection

