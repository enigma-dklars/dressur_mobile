<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* public/politique_confidentialite.html.twig */
class __TwigTemplate_57f52114a8e7d40f049c9896f7d2251b extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        $context["description"] = "Consultez la Politique de Confidentialité de Dressur afin de comprendre comment vos données
personnelles sont collectées, utilisées, protégées et conservées, ainsi que les droits dont vous disposez concernant
leur traitement.";
        // line 4
        $context["title"] = "Politique de Confidentialité de Dressur";
        // line 5
        yield "
<!DOCTYPE html>
<html lang=\"fr\">

<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur</title>
    <meta name=\"robots\" content=\"index, follow\">
    <meta name=\"googlebot\" content=\"index, follow\">
    <link rel=\"canonical\" href=\"https://dressur.site/politique-confidentialite\" />
    <!-- Open Graph Meta Tags -->
    <meta property=\"og:title\" content=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur\" />
    <meta property=\"og:description\" content=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/hero.jpg\" />
    <meta property=\"og:url\" content=\"https://dressur.site/politique-confidentialite\" />
    <meta property=\"og:type\" content=\"website\" />

    <!-- Twitter Card Meta Tags (facultatif) -->
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/hero.jpg\" />

    <!-- Autres balises meta facultatives -->
    <meta name=\"description\" content=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\"
        content=\"Politique de Confidentialité Dressur, données personnelles Dressur, protection des données Dressur, traitement des données Dressur, sécurité des informations Dressur, droits des utilisateurs Dressur, respect de la vie privée Dressur, gestion des données Dressur\" />
    <style>
        body {
            font-family: \x27Segoe UI\x27, Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f7f6;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            text-align: center;
        }

        h2 {
            color: #2980b9;
            margin-top: 30px;
            border-left: 5px solid #3498db;
            padding-left: 15px;
        }

        h3 {
            color: #34495e;
            margin-top: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        ul {
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 8px;
        }

        .date {
            font-style: italic;
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .important {
            background-color: #e8f4f8;
            border: 1px solid #b3d9e8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        code {
            background-color: #f8f9fa;
            padding: 2px 4px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.9em;
        }

        .references {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
            font-size: 0.9em;
        }

        .references h3 {
            margin-top: 0;
        }

        .references ol {
            margin: 10px 0;
            padding-left: 20px;
        }

        .references li {
            margin-bottom: 5px;
            word-break: break-all;
        }

        hr {
            border: none;
            border-top: 2px solid #e0e0e0;
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <div class=\"container\">
        <h1>Politique de Confidentialité de Dressur</h1>
        <p class=\"date\">Date d\x27entrée en vigueur : 23 février 2026</p>

        <p>La présente Politique de Confidentialité décrit comment l\x27application mobile Dressur (ci-après l\x27«
            Application »), fournie par <strong>l\x27équipe Dressur</strong>, plateforme de marketing digital en Afrique de l\x27Ouest (ci-après « nous », « notre » ou « nos »),
            collecte, utilise, partage et protège vos informations personnelles. Nous nous engageons à protéger votre
            vie privée et à traiter vos données personnelles de manière transparente et sécurisée.</p>

        <p>En utilisant l\x27Application, vous consentez à la collecte et à l\x27utilisation de vos informations conformément
            à cette politique.</p>

        <h2>1. Notre engagement pour la protection de vos données</h2>
        <div class=\"important\">
            <p>Conformément à notre fiche Google Play, Dressur collecte et partage certaines données (coordonnées,
                photos, contacts) pour assurer le service de mise en relation. <strong>Toutes les données sont chiffrées
                    pendant la transmission.</strong> Vous pouvez demander leur suppression à tout moment.</p>
        </div>

        <h2>2. Informations que nous collectons</h2>
        <p>Nous collectons différentes catégories d\x27informations pour fournir et améliorer nos services :</p>

        <h3>2.1. Informations que vous nous fournissez directement</h3>

        <p><strong>Lors de l\x27inscription :</strong></p>
        <ul>
            <li><strong>Numéro de téléphone (WhatsApp)</strong> : Collecté pour l\x27identification unique de
                l\x27utilisateur, la communication et la facilitation des interactions au sein de l\x27Application. Il est
                également utilisé pour la vérification du compte.</li>
            <li><strong>Adresse e-mail</strong> : Utilisée pour la connexion, la récupération de compte et l\x27envoi de
                communications importantes (mises à jour, notifications de sécurité, etc.).</li>
            <li><strong>Mot de passe</strong> : Stocké sous forme hachée et sécurisée pour protéger l\x27accès à votre
                compte.</li>
        </ul>

        <p><strong>Informations de profil (facultatif) :</strong></p>
        <ul>
            <li>Nom complet</li>
            <li>Pseudo</li>
            <li>Section « À propos » (biographie)</li>
            <li>Liens vers vos profils de réseaux sociaux (TikTok, Instagram, Facebook, YouTube)</li>
        </ul>

        <p><strong>Motif de suppression de compte (facultatif) :</strong> Si vous choisissez de supprimer votre compte,
            vous avez la possibilité de nous fournir un motif, qui sera utilisé pour améliorer nos services.</p>

        <h3>2.2. Informations collectées automatiquement</h3>
        <ul>
            <li><strong>Informations sur l\x27appareil et l\x27utilisation</strong> : Nous pouvons collecter des informations
                sur votre appareil mobile (modèle, système d\x27exploitation, identifiants uniques de l\x27appareil) et sur la
                manière dont vous utilisez l\x27Application (pages visitées, fonctionnalités utilisées, durée des
                sessions). Ces données sont généralement anonymisées ou agrégées.</li>
            <li><strong>Informations de localisation</strong> : Bien que l\x27Application ne demande pas explicitement une
                permission de localisation GPS, elle peut déduire votre pays à partir de votre numéro de téléphone ou de
                vos préférences pour adapter le contenu (par exemple, les publicités ou les contacts suggérés).</li>
            <li><strong>Données de connexion</strong> : Informations relatives à votre connexion internet (adresse IP,
                type de connexion) pour des raisons de sécurité et de performance.</li>
        </ul>

        <h3>2.3. Informations relatives aux contacts</h3>
        <p>Si vous nous accordez l\x27autorisation d\x27accéder à vos contacts :</p>
        <ul>
            <li><strong>Numéros de téléphone de vos contacts locaux</strong> : L\x27Application lit les numéros de
                téléphone de votre carnet d\x27adresses pour identifier les utilisateurs de Dressur parmi vos contacts. Ces
                numéros sont traités de manière sécurisée et ne sont pas stockés sur nos serveurs de manière
                persistante, sauf pour la comparaison avec notre base de données d\x27utilisateurs Dressur.</li>
            <li><strong>Contacts Dressur identifiés</strong> : Les numéros de téléphone des contacts qui sont également
                des utilisateurs de Dressur sont stockés localement dans une base de données SQLite sur votre appareil
                pour faciliter les interactions au sein de l\x27Application (par exemple, affichage des contacts Dressur,
                messagerie).</li>
        </ul>

        <h2>3. Comment nous utilisons vos informations</h2>
        <p>Nous utilisons les informations collectées pour les finalités suivantes :</p>
        <ul>
            <li><strong>Fournir et maintenir l\x27Application</strong> : Création et gestion de votre compte,
                authentification, fourniture des fonctionnalités de l\x27Application.</li>
            <li><strong>Améliorer et personnaliser l\x27expérience utilisateur</strong> : Adapter le contenu, les
                publicités et les fonctionnalités en fonction de vos préférences et de votre utilisation.</li>
            <li><strong>Communication</strong> : Vous envoyer des notifications importantes, des mises à jour, des
                alertes de sécurité et des messages de support.</li>
            <li><strong>Sécurité et prévention de la fraude</strong> : Protéger l\x27Application et nos utilisateurs contre
                les activités frauduleuses ou malveillantes.</li>
            <li><strong>Analyse et recherche</strong> : Comprendre comment l\x27Application est utilisée pour l\x27améliorer
                et développer de nouvelles fonctionnalités. Ces analyses sont généralement basées sur des données
                agrégées et anonymisées.</li>
            <li><strong>Conformité légale</strong> : Respecter les obligations légales et réglementaires applicables.
            </li>
        </ul>

        <h2>4. Partage de vos informations</h2>
        <p>Nous ne vendons ni ne louons vos informations personnelles à des tiers. Nous pouvons partager vos
            informations dans les cas suivants :</p>
        <ul>
            <li><strong>Avec votre consentement</strong> : Nous pouvons partager vos informations avec des tiers si vous
                nous donnez votre consentement explicite.</li>
            <li><strong>Fournisseurs de services tiers</strong> : Nous pouvons faire appel à des entreprises tierces
                pour nous aider à exploiter l\x27Application (par exemple, hébergement, analyse de données, services de
                notification). Ces fournisseurs n\x27ont accès à vos informations que dans la mesure nécessaire pour
                exécuter leurs fonctions et sont tenus de maintenir la confidentialité de vos informations.</li>
            <li><strong>Exigences légales</strong> : Nous pouvons divulguer vos informations si la loi l\x27exige ou si
                nous pensons de bonne foi qu\x27une telle action est nécessaire pour se conformer à une obligation légale,
                protéger nos droits ou notre propriété, prévenir une fraude ou assurer la sécurité de nos utilisateurs.
            </li>
            <li><strong>Transferts d\x27entreprise</strong> : En cas de fusion, acquisition, vente d\x27actifs ou faillite,
                vos informations peuvent être transférées à la partie tierce concernée.</li>
        </ul>

        <h2>5. Stockage et Sécurité des Données</h2>
        <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées pour protéger vos
            informations personnelles contre l\x27accès non autorisé, la divulgation, l\x27altération ou la destruction.
            <strong>Toutes les données sont chiffrées pendant la transmission</strong> entre votre appareil et nos
            serveurs. Cependant, aucune méthode de transmission sur Internet ou de stockage électronique n\x27est
            totalement sécurisée. Par conséquent, nous ne pouvons garantir une sécurité absolue de vos informations.
        </p>

        <p>Vos données sont stockées sur des serveurs sécurisés et, pour certaines données sensibles (comme les mots de
            passe), elles sont chiffrées.</p>

        <h2>6. Vos Droits</h2>
        <p>Conformément aux lois applicables en matière de protection des données, vous disposez des droits suivants
            concernant vos informations personnelles :</p>
        <ul>
            <li><strong>Droit d\x27accès</strong> : Vous pouvez demander à accéder aux informations personnelles que nous
                détenons à votre sujet.</li>
            <li><strong>Droit de rectification</strong> : Vous pouvez demander la correction de toute information
                personnelle inexacte ou incomplète.</li>
            <li><strong>Droit à l\x27effacement (droit à l\x27oubli)</strong> : Vous pouvez demander la suppression de vos
                informations personnelles, sous certaines conditions (voir section 7 des CGU concernant la suppression
                de compte).</li>
            <li><strong>Droit à la limitation du traitement</strong> : Vous pouvez demander la limitation du traitement
                de vos informations personnelles.</li>
            <li><strong>Droit d\x27opposition</strong> : Vous pouvez vous opposer au traitement de vos informations
                personnelles dans certaines situations.</li>
            <li><strong>Droit à la portabilité des données</strong> : Vous pouvez demander à recevoir vos informations
                personnelles dans un format structuré, couramment utilisé et lisible par machine.</li>
        </ul>

        <p>Pour exercer ces droits, veuillez nous contacter à l\x27adresse indiquée dans la section « Contact ».</p>

        <h2>7. Conservation des Données</h2>
        <p>Nous conservons vos informations personnelles aussi longtemps que nécessaire pour les finalités décrites dans
            cette Politique de Confidentialité, sauf si une période de conservation plus longue est requise ou permise
            par la loi. Lorsque vos informations ne sont plus nécessaires, nous les supprimons ou les anonymisons de
            manière sécurisée.</p>

        <h2>8. Modifications de cette Politique de Confidentialité</h2>
        <p>Nous pouvons mettre à jour notre Politique de Confidentialité de temps à autre. Nous vous informerons de tout
            changement en publiant la nouvelle Politique de Confidentialité sur cette page et en mettant à jour la «
            Date d\x27entrée en vigueur » en haut de cette politique. Nous vous encourageons à consulter régulièrement
            cette Politique de Confidentialité pour prendre connaissance des éventuelles modifications.</p>

        <h2>9. Contact</h2>
        <p>Pour toute question concernant cette Politique de Confidentialité ou nos pratiques en matière de données,
            veuillez nous contacter à <a href=\"mailto:dressur.ds@gmail.com\">dressur.ds@gmail.com</a>.</p>
    </div>
</body>

</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/politique_confidentialite.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  90 => 30,  83 => 26,  79 => 25,  69 => 18,  65 => 17,  57 => 12,  48 => 5,  46 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/politique_confidentialite.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/politique_confidentialite.html.twig");
    }
}
