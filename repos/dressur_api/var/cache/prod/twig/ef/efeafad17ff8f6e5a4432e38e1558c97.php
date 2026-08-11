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

/* basePrivate.html.twig */
class __TwigTemplate_58ddaf15ed5c5a2755f15d761ac8b3c3 extends Template
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
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
            'script' => [$this, 'block_script'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 1), "requestUri", [], "any", false, false, false, 1)) && is_string($_v1 = "/crud") && str_starts_with($_v0, $_v1))) {
            // line 2
            yield "    ";
            if ((($tmp = ($context["user"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 3
                yield "        ";
                if (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "admin", [], "any", false, false, false, 3) == false) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 3) != true))) {
                    // line 4
                    yield "            <script>
                window.location.href = \"";
                    // line 5
                    yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_private");
                    yield "\";
            </script>
        ";
                }
                // line 8
                yield "    ";
            } else {
                // line 9
                yield "        <script>
            window.location.href = \"";
                // line 10
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_private");
                yield "\";
        </script>
    ";
            }
        }
        // line 14
        yield "<!doctype html>
<html lang=\"fr\" class=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["theme"] ?? null), "html", null, true);
        yield "\">
<head>
    <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\x27gtm.start\x27:
        new Date().getTime(),event:\x27gtm.js\x27});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!=\x27dataLayer\x27?\x27&l=\x27+l:\x27\x27;j.async=true;j.src=
        \x27https://www.googletagmanager.com/gtm.js?id=\x27+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,\x27script\x27,\x27dataLayer\x27,\x27GTM-T734ZNFG\x27);</script>
    <!-- End Google Tag Manager -->
        
    <!-- Required meta tags -->
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"robots\" content=\"noindex, nofollow\">
    <meta name=\"googlebot\" content=\"noindex, nofollow\">
    <link rel=\"icon\" href=\"/assets/images/dressur_logo_blanc.png\" type=\"image/png\" />
    <!--plugins-->
    <link href=\"/assets/plugins/simplebar/css/simplebar.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/metismenu/css/metisMenu.min.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/datatable/css/dataTables.bootstrap5.min.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/select2/css/select2.min.css\" rel=\"stylesheet\" />
    <link href=\"/assets/plugins/select2/css/select2-bootstrap4.css\" rel=\"stylesheet\" />
    <!-- Bootstrap CSS -->
    <link href=\"/assets/css/bootstrap.min.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/bootstrap-extended.css\" rel=\"stylesheet\" />
    <link href=\"https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap\" rel=\"stylesheet\">
    <link href=\"/assets/css/style.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/icons.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"/assets/bootstrap-icons191/font/bootstrap-icons.css\">
    <link rel=\"stylesheet\" href=\"/assets/fontawesome/css/all.min.css\" />

    <!-- loader-->
    <link href=\"/assets/css/pace.min.css\" rel=\"stylesheet\" />

    <!--Theme Styles-->
    <link href=\"/assets/css/dark-theme.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/light-theme.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/semi-dark.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/preloader.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/my-css.css\" rel=\"stylesheet\" />

    <title>";
        // line 58
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield " | Dressur Web</title>

    <style>
    /* ── Interface mobile / tablette (≤ 1024px) ─────────────────── */
    @media screen and (max-width: 1024px) {

        /* Masquer le bouton hamburger (remplacé par la barre du bas) */
        .mobile-toggle-icon { display: none !important; }

        /* Annuler le margin-top desktop (navbar fixe masquée sur mobile) */
        .page-content { margin-top: 0 !important; }

        /* Espace pour la barre de navigation fixe en bas */
        .page-content { padding-bottom: 76px !important; }

        /* ── Barre de navigation en bas ─────────── */
        .ds-mobile-bottomnav {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 62px;
            background: var(--bs-body-bg, #fff);
            border-top: 1px solid rgba(0,0,0,.10);
            display: flex !important;
            align-items: stretch;
            z-index: 1050;
            box-shadow: 0 -2px 12px rgba(0,0,0,.08);
        }
        .ds-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            text-decoration: none;
            color: var(--bs-secondary-color, #6c757d);
            font-size: 10px;
            font-weight: 500;
            padding: 8px 2px 4px;
            transition: color .2s;
        }
        .ds-nav-item i { font-size: 20px; line-height: 1; }
        .ds-nav-item.active { color: var(--bs-primary, #0d6efd); }
        .ds-nav-item.active i { font-weight: 900; }

    }

    /* Masqué sur desktop */
    @media screen and (min-width: 1025px) {
        .ds-mobile-bottomnav { display: none !important; }
    }

    /* ── Bandeau statut boost global ─────────────────────────────────── */
    #ds-status-banner {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1055;
        display: none;
        padding: 10px 16px;
        color: #fff;
        font-size: .9rem;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        box-shadow: 0 2px 8px rgba(0,0,0,.18);
        transition: top .3s;
    }
    #ds-status-banner.ds-banner-visible { display: flex; }
    #ds-status-banner .ds-banner-text { flex: 1; min-width: 0; line-height: 1.4; }
    #ds-status-banner .ds-banner-actions { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }
    #ds-status-banner .ds-banner-btn-main {
        padding: 5px 14px; border-radius: 6px; border: none;
        font-size: .85rem; font-weight: 600; cursor: pointer;
        background: #fff; transition: opacity .2s;
    }
    #ds-status-banner .ds-banner-btn-main:hover { opacity: .88; }
    #ds-status-banner .ds-banner-btn-sec {
        padding: 4px 12px; border-radius: 6px; border: 2px solid rgba(255,255,255,.7);
        font-size: .82rem; font-weight: 500; cursor: pointer;
        background: transparent; color: #fff; transition: opacity .2s;
    }
    #ds-status-banner .ds-banner-btn-sec:hover { opacity: .8; }
    #ds-status-banner .ds-banner-close {
        background: none; border: none; color: rgba(255,255,255,.8);
        font-size: 1.2rem; cursor: pointer; padding: 0 2px; line-height: 1; flex-shrink: 0;
    }
    #ds-status-banner.ds-banner-green  { background: #16a34a; }
    #ds-status-banner.ds-banner-blue   { background: #2563eb; }
    #ds-status-banner.ds-banner-orange { background: #ea580c; }
    #ds-status-banner.ds-banner-green  .ds-banner-btn-main { color: #16a34a; }
    #ds-status-banner.ds-banner-blue   .ds-banner-btn-main { color: #2563eb; }
    #ds-status-banner.ds-banner-orange .ds-banner-btn-main { color: #ea580c; }
    </style>
</head>

<body>
";
        // line 157
        $context["r"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 157), "attributes", [], "any", false, false, false, 157), "get", ["_route"], "method", false, false, false, 157);
        // line 158
        $context["_services_routes"] = ["app_newboostcontact", "app_listeboostcontact", "app_newpromoaffaire", "app_listepromoaffaire", "app_newpromoreseau", "app_listepromoreseau", "app_hub_services"];
        // line 159
        $context["_params_routes"] = ["app_editprofil", "app_editPassword", "app_addSuggestion", "app_signalerUser", "app_support", "app_apropos", "app_deleteCompte", "app_hub_parametres", "app_preferencePays", "app_hub_preferences", "app_contact", "app_guide_import_contacts", "app_export_vcf", "app_export_csv", "app_notifications"];
        // line 160
        $context["_actu_active"] = CoreExtension::inFilter(($context["r"] ?? null), ["app_actu", "app_actu_detail", "app_private"]);
        // line 161
        $context["_services_active"] = CoreExtension::inFilter(($context["r"] ?? null), ($context["_services_routes"] ?? null));
        // line 162
        $context["_params_active"] = CoreExtension::inFilter(($context["r"] ?? null), ($context["_params_routes"] ?? null));
        // line 163
        yield "
    <!--start wrapper-->
    <div class=\"wrapper\">
        ";
        // line 166
        yield from $this->load("private/_includes/top_header.html.twig", 166)->unwrap()->yield($context);
        // line 167
        yield "
        ";
        // line 169
        yield "        <div id=\"ds-status-banner\" role=\"alert\" aria-live=\"polite\">
            <span class=\"ds-banner-text\" id=\"ds-banner-text\"></span>
            <div class=\"ds-banner-actions\" id=\"ds-banner-actions\"></div>
            <button class=\"ds-banner-close\" id=\"ds-banner-close\" aria-label=\"Fermer\">×</button>
        </div>

        ";
        // line 175
        yield from $this->load("private/_includes/sidebar_wrapper.html.twig", 175)->unwrap()->yield($context);
        // line 176
        yield "

        <!--start content-->
            <main class=\"page-content p-3\">
                ";
        // line 180
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 181
        yield "            </main>
        <!--end page main-->

        <!--start overlay-->
            <div class=\"overlay nav-toggle-icon\"></div>
        <!--end overlay-->

        ";
        // line 189
        yield "        <nav class=\"ds-mobile-bottomnav\">
            <a href=\"/services\"      class=\"ds-nav-item ";
        // line 190
        yield (((($tmp = ($context["_services_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
                <i class=\"fas fa-briefcase\"></i><span>Services</span>
            </a>
            <a href=\"/private\"       class=\"ds-nav-item ";
        // line 193
        yield (((($tmp = ($context["_actu_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
                <i class=\"fas fa-newspaper\"></i><span>Actu</span>
            </a>
            <a href=\"/parametres\"    class=\"ds-nav-item ";
        // line 196
        yield (((($tmp = ($context["_params_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
                <i class=\"fas fa-gear\"></i><span>Paramètres</span>
            </a>
        </nav>

        <!--Start Back To Top Button-->
            <a href=\"javaScript:;\" class=\"back-to-top\"><i class=\x27bx bxs-up-arrow-alt\x27></i></a>
        <!--End Back To Top Button-->
    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src=\"/assets/js/bootstrap.bundle.min.js\"></script>
    <!--plugins-->
    <script src=\"/assets/js/jquery.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js\"></script>
    <script src=\"/assets/plugins/simplebar/js/simplebar.min.js\"></script>
    <script src=\"/assets/plugins/metismenu/js/metisMenu.min.js\"></script>
    <script src=\"/assets/plugins/easyPieChart/jquery.easypiechart.js\"></script>
    <script src=\"/assets/plugins/peity/jquery.peity.min.js\"></script>
    <script src=\"/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js\"></script>
    <script src=\"/assets/js/pace.min.js\"></script>
    <script src=\"/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js\"></script>
    <script src=\"/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js\"></script>
    <script src=\"/assets/plugins/apexcharts-bundle/js/apexcharts.min.js\"></script>
    <script src=\"/assets/plugins/datatable/js/jquery.dataTables.min.js\"></script>
    <script src=\"/assets/plugins/datatable/js/dataTables.bootstrap5.min.js\"></script>
    <script src=\"/assets/js/table-datatable.js\"></script>
    <script src=\"/assets/plugins/select2/js/select2.min.js\"></script>
    <script src=\"/assets/js/form-select2.js\"></script>
    <script src=\"/assets/js/sweetalert.js\"></script>
    
    <!--app-->
    <script src=\"/assets/js/app.js\"></script>
    <script src=\"/assets/js/index.js\"></script>
    
    <script>
        // new PerfectScrollbar(\".wrapper\")
        // new PerfectScrollbar(\".best-product\")
        // new PerfectScrollbar(\".top-sellers-list\")
    </script>
        
    ";
        // line 239
        yield from $this->unwrap()->yieldBlock('script', $context, $blocks);
        // line 240
        yield "
    <script src=\"/assets/js/custum-js-ds.js\"></script>

    <script>
        /**
 * Script de gestion du formulaire de promotion affaire
 * Compatible avec l\x27injection dynamique de HTML via jQuery .html()
 * Utilise la délégation d\x27événements pour fonctionner avec du contenu injecté
 * Version corrigée avec validation en temps réel
 */

(function(\$) {
    \x27use strict\x27;

    // ==========================================
    // CONFIGURATION ET VARIABLES GLOBALES
    // ==========================================
    const API_BASE_URL = window.API_BASE_URL || \"https://dressur.site/api\";
    const LANG_USER = window.LANG_USER || \x27fr\x27;
    const DRESSUR_STATUS_RATE = 0.25; // 25% du prix de la formule
    const MAX_IMAGE_SIZE = 1024 * 1024; // 1 MB

    /**
     * Récupère l\x27UID de l\x27utilisateur depuis l\x27input caché
     */
    function getUID() {
        const \$uidInput = \$(\x27#uid\x27);
        if (\$uidInput.length) {
            return \$uidInput.val() || \x270000\x27;
        }
        return window.UID_USER || \x270000\x27;
    }

    // Variables globales pour l\x27état du formulaire
    let selectedImage = null;
    let currentFormuleData = {
        id: 0,
        prix: 0,
        jours: 0,
        titre: \x27\x27
    };

    // ==========================================
    // UTILITAIRES
    // ==========================================
    
    /**
     * Affiche une alerte Bootstrap
     */
    function showAlert(title, message, type = \x27danger\x27) {
        const alertId = \x27alert-\x27 + Date.now();
        const alertHTML = `
            <div id=\"\${alertId}\" class=\"alert alert-\${type} alert-dismissible fade show\" role=\"alert\">
                <strong>\${title}</strong><br>\${message}
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        `;
        
        const \$container = \$(\x27#alertContainer\x27);
        if (\$container.length) {
            \$container.html(alertHTML);
            
            // Auto-close après 5 secondes
            setTimeout(() => {
                const \$alert = \$(`#\${alertId}`);
                if (\$alert.length) {
                    const bsAlert = new bootstrap.Alert(\$alert[0]);
                    bsAlert.close();
                }
            }, 5000);
        }
    }

    /**
     * Formate un nombre en français
     */
    function formatNumber(num) {
        return Math.round(num).toLocaleString(\x27fr-FR\x27);
    }

    /**
     * Vérifie si une image est carrée
     */
    function isImageSquare(file) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const aspectRatio = img.width / img.height;
                    resolve(aspectRatio >= 0.8 && aspectRatio <= 1.2);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // ==========================================
    // SECTION PRODUITS/SERVICES - CALCULS
    // ==========================================
    
    /**
     * Calcule le montant du programme de récompense
     */
    function calculateRewardAmount() {
        const \$participateReward = \$(\x27#participateReward\x27);
        if (!\$participateReward.length || !\$participateReward.is(\x27:checked\x27)) {
            return 0;
        }
        return parseInt(\$(\x27#rewardBudget\x27).val()) || 0;
    }

    function updateRewardBreakdown(budget) {
        if (budget > 0) {
            const pool = Math.round(budget * 0.8);
            const commission = budget - pool;
            \$(\x27#rewardPoolAmount\x27).text(formatNumber(pool));
            \$(\x27#rewardCommissionAmount\x27).text(formatNumber(commission));
            \$(\x27#rewardBreakdown\x27).show();
        } else {
            \$(\x27#rewardBreakdown\x27).hide();
        }
    }

    /**
     * Calcule les frais du statut Dressur
     */
    function calculateDressurStatusAmount() {
        const \$publishStatus = \$(\x27#publishDressurStatus\x27);
        if (!\$publishStatus.length || !\$publishStatus.is(\x27:checked\x27) || currentFormuleData.prix < 1000) {
            return 0;
        }
        
        return currentFormuleData.prix * DRESSUR_STATUS_RATE;
    }

    /**
     * Calcule le montant du boost Facebook
     */
    function calculateBoostFacebookAmount() {
        const \$boostFb = \$(\x27#boostFacebook\x27);
        if (!\$boostFb.length || !\$boostFb.is(\x27:checked\x27)) {
            return 0;
        }
        const amount = parseInt(\$(\x27#boostFacebookAmount\x27).val()) || 0;
        return amount >= 700 ? amount : 0;
    }

    /**
     * Met à jour le récapitulatif des prix
     */
    function updatePricingSummary() {
        const formulePrice = currentFormuleData.prix;
        const rewardAmount = calculateRewardAmount();
        const statusAmount = calculateDressurStatusAmount();
        const boostFbAmount = calculateBoostFacebookAmount();
        const total = formulePrice + rewardAmount + statusAmount + boostFbAmount;

        // Mise à jour du DOM avec jQuery
        \$(\x27#summaryFormulePrice\x27).text(formatNumber(formulePrice) + \x27 F\x27);
        \$(\x27#summaryRewardPrice\x27).text(formatNumber(rewardAmount) + \x27 F\x27);
        \$(\x27#summaryStatusPrice\x27).text(formatNumber(statusAmount) + \x27 F\x27);
        \$(\x27#summaryBoostFacebookPrice\x27).text(formatNumber(boostFbAmount) + \x27 F\x27);
        \$(\x27#summaryTotal\x27).text(formatNumber(total) + \x27 F\x27);
        \$(\x27#rewardAmount\x27).text(formatNumber(rewardAmount));
        \$(\x27#statusAmount\x27).text(formatNumber(statusAmount));
    }

    // ==========================================
    // VALIDATION EN TEMPS RÉEL
    // ==========================================

    /**
     * Vérifie si le formulaire Produits/Services est valide
     */
    function isProduitServiceFormValid() {
        const hasFormule = currentFormuleData.id && currentFormuleData.id !== 0;
        const hasDescription = \$(\x27#descriptionPromo\x27).length && \$(\x27#descriptionPromo\x27).val().trim() !== \x27\x27;
        const hasImage = selectedImage !== null;
        const hasPaymentMethod = \$(\x27#paymentMethod\x27).length && \$(\x27#paymentMethod\x27).val() !== \x27\x27;
        const hasPaymentNumber = \$(\x27#paymentNumber\x27).length && \$(\x27#paymentNumber\x27).val().trim() !== \x27\x27;
        const hasWhatsapp = !\$(\x27#whatsappContact\x27).length || /^\\+\\d{11,}\$/.test((\$(\x27#whatsappContact\x27).val() || \x27\x27).trim());

        return hasFormule && hasDescription && hasImage && hasPaymentMethod && hasPaymentNumber && hasWhatsapp;
    }

    /**
     * Vérifie si le formulaire Demandes d\x27emploi est valide
     */
    function isDemandeEmploiFormValid() {
        const hasTitle = \$(\x27#titreDemande\x27).length && \$(\x27#titreDemande\x27).val().trim() !== \x27\x27;
        const hasDescription = \$(\x27#descriptionProfil\x27).length && \$(\x27#descriptionProfil\x27).val().trim() !== \x27\x27;
        const hasCompetences = \$(\x27#competences\x27).length && \$(\x27#competences\x27).val().trim() !== \x27\x27;
        const hasExperience = \$(\x27#niveauExperience\x27).length && \$(\x27#niveauExperience\x27).val().trim() !== \x27\x27;
        const hasSector = \$(\x27#secteurActivite\x27).length && \$(\x27#secteurActivite\x27).val().trim() !== \x27\x27;
        const hasContractType = \$(\x27#typeContrat\x27).length && \$(\x27#typeContrat\x27).val().trim() !== \x27\x27;
        const hasLocation = \$(\x27#localisationSouhaite\x27).length && \$(\x27#localisationSouhaite\x27).val().trim() !== \x27\x27;
        const hasSalary = \$(\x27#salaireSouhaite\x27).length && \$(\x27#salaireSouhaite\x27).val().trim() !== \x27\x27;
        const hasLanguages = \$(\x27#languesParle\x27).length && \$(\x27#languesParle\x27).val().trim() !== \x27\x27;
        const hasPortfolio = \$(\x27#lienPortfolio\x27).length && \$(\x27#lienPortfolio\x27).val().trim() !== \x27\x27;
        const hasCoordinates = \$(\x27#coordonneesDemandeur\x27).length && \$(\x27#coordonneesDemandeur\x27).val().trim() !== \x27\x27;

        return hasTitle && hasDescription && hasCompetences && hasExperience && hasSector && 
               hasContractType && hasLocation && hasSalary && hasLanguages && hasPortfolio && hasCoordinates;
    }

    /**
     * Vérifie si le formulaire Offres d\x27emploi est valide
     */
    function isOffreEmploiFormValid() {
        const hasTitle = \$(\x27#titrePoste\x27).length && \$(\x27#titrePoste\x27).val().trim() !== \x27\x27;
        const hasDescription = \$(\x27#descriptionPoste\x27).length && \$(\x27#descriptionPoste\x27).val().trim() !== \x27\x27;
        const hasSkills = \$(\x27#competencesRequises\x27).length && \$(\x27#competencesRequises\x27).val().trim() !== \x27\x27;
        const hasContractType = \$(\x27#typeContratOffre\x27).length && \$(\x27#typeContratOffre\x27).val().trim() !== \x27\x27;
        const hasLocation = \$(\x27#lieuTravail\x27).length && \$(\x27#lieuTravail\x27).val().trim() !== \x27\x27;
        const hasSalary = \$(\x27#salaireOffre\x27).length && \$(\x27#salaireOffre\x27).val().trim() !== \x27\x27;
        const hasExperience = \$(\x27#niveauExperienceOffre\x27).length && \$(\x27#niveauExperienceOffre\x27).val().trim() !== \x27\x27;
        const hasSchedule = \$(\x27#horaireTravail\x27).length && \$(\x27#horaireTravail\x27).val().trim() !== \x27\x27;
        const hasBenefits = \$(\x27#avantages\x27).length && \$(\x27#avantages\x27).val().trim() !== \x27\x27;
        const hasDuration = \$(\x27#dureeContrat\x27).length && \$(\x27#dureeContrat\x27).val().trim() !== \x27\x27;
        const hasContact = \$(\x27#contactEmployeur\x27).length && \$(\x27#contactEmployeur\x27).val().trim() !== \x27\x27;
        const hasDeadline = \$(\x27#dateLimiteCandidature\x27).length && \$(\x27#dateLimiteCandidature\x27).val().trim() !== \x27\x27;

        return hasTitle && hasDescription && hasSkills && hasContractType && hasLocation && 
               hasSalary && hasExperience && hasSchedule && hasBenefits && hasDuration && 
               hasContact && hasDeadline;
    }

    /**
     * Met à jour l\x27état des boutons de soumission
     */
    function updateSubmitButtonsState() {
        // Vérifier le formulaire Produits/Services
        const isProduitValid = isProduitServiceFormValid();
        \$(\x27#submitProduitService\x27).prop(\x27disabled\x27, !isProduitValid);

        // Vérifier le formulaire Demandes d\x27emploi
        const isDemandeValid = isDemandeEmploiFormValid();
        \$(\x27#submitDemande\x27).prop(\x27disabled\x27, !isDemandeValid);

        // Vérifier le formulaire Offres d\x27emploi
        const isOffreValid = isOffreEmploiFormValid();
        \$(\x27#submitOffre\x27).prop(\x27disabled\x27, !isOffreValid);
    }

    // ==========================================
    // GESTION DU TYPE DE PROMOTION
    // ==========================================
    
    \$(document).on(\x27change\x27, \x27#typePromoAffaire\x27, function() {
        const type = \$(this).val();
        \$(\x27#produitServiceSection\x27).toggle(type === \x27produit_service\x27);
        \$(\x27#demandeEmploiSection\x27).toggle(type === \x27dmd_emploi\x27);
        \$(\x27#offreEmploiSection\x27).toggle(type === \x27offre_emploi\x27);
        
        // Mettre à jour l\x27état des boutons
        updateSubmitButtonsState();
    });

    // ==========================================
    // GESTION DES FORMULES (PRODUITS/SERVICES)
    // ==========================================
    
    \$(document).on(\x27change\x27, \x27#formulePromoPageNewAffaire\x27, function() {
        const \$selected = \$(this).find(\x27option:selected\x27);
        const prix = parseInt(\$selected.data(\x27prix\x27)) || 0;
        const jours = parseInt(\$selected.data(\x27jours\x27)) || 0;
        const titre = \$selected.data(\x27titre\x27) || \x27\x27;

        currentFormuleData = {
            id: \$(this).val(),
            prix: prix,
            jours: jours,
            titre: titre
        };

        const message = `Formule de \${jours} jour(s) pour \${formatNumber(prix)} FCFA.`;
        \$(\x27#formuleMessage\x27).text(message);
        
        // Activer le bouton d\x27upload d\x27image
        \$(\x27#imageUploadBtn\x27).prop(\x27disabled\x27, false);

        // Afficher le bloc Statut WhatsApp seulement si formule >= 1000 FCFA
        if (prix >= 1000) {
            \$(\x27#dressurStatusBlock\x27).show();
        } else {
            \$(\x27#dressurStatusBlock\x27).hide();
            \$(\x27#publishDressurStatus\x27).prop(\x27checked\x27, false);
            \$(\x27#statusSection\x27).hide();
        }

        updatePricingSummary();
        updateSubmitButtonsState();
    });

    // ==========================================
    // GESTION DE L\x27IMAGE
    // ==========================================
    
    \$(document).on(\x27click\x27, \x27#imageUploadBtn\x27, function() {
        \$(\x27#imageUpload\x27).click();
    });

    \$(document).on(\x27change\x27, \x27#imageUpload\x27, async function() {
        const file = this.files[0];
        if (!file) return;

        // Vérifier la taille
        if (file.size > MAX_IMAGE_SIZE) {
            showAlert(\x27Attention !!!\x27, \x27L\\\x27image ne peut pas dépasser 1 Mo.\x27, \x27warning\x27);
            return;
        }

        // Vérifier le format carré
        const isSquare = await isImageSquare(file);
        if (!isSquare) {
            showAlert(\x27Attention !!!\x27, \x27L\\\x27image doit être proche d\\\x27un carré.\x27, \x27warning\x27);
            return;
        }

        selectedImage = file;

        // Afficher l\x27aperçu
        const reader = new FileReader();
        reader.onload = function(e) {
            \$(\x27#imagePreview\x27).html(`<img src=\"\${e.target.result}\" alt=\"Aperçu\">`);
        };
        reader.readAsDataURL(file);

        // Mettre à jour l\x27état du bouton
        updateSubmitButtonsState();
    });

    // ==========================================
    // PROGRAMME DE RÉCOMPENSE
    // ==========================================
    
    // ==========================================
    // BOOST PAGE FACEBOOK
    // ==========================================

    \$(document).on(\x27change\x27, \x27#boostFacebook\x27, function() {
        \$(\x27#boostFacebookSection\x27).toggle(this.checked);
        if (!this.checked) {
            \$(\x27#boostFacebookAmount\x27).val(\x27700\x27);
        }
        updatePricingSummary();
    });

    \$(document).on(\x27input\x27, \x27#boostFacebookAmount\x27, function() {
        const val = parseInt(\$(this).val()) || 0;
        if (val < 700) {
            \$(this).addClass(\x27is-invalid\x27);
        } else {
            \$(this).removeClass(\x27is-invalid\x27);
        }
        updatePricingSummary();
    });

    \$(document).on(\x27change\x27, \x27#participateReward\x27, function() {
        \$(\x27#rewardSection\x27).toggle(this.checked);
        if (this.checked) {
            \$(\x27#rewardBudget\x27).val(\x27500\x27);
            \$(\x27.budget-btn\x27).removeClass(\x27btn-primary btn-outline-primary active\x27).addClass(\x27btn-outline-primary\x27);
            \$(\x27.budget-btn[data-budget=\"500\"]\x27).removeClass(\x27btn-outline-primary\x27).addClass(\x27btn-primary\x27);
        } else {
            \$(\x27#rewardBudget\x27).val(\x270\x27);
            \$(\x27.budget-btn\x27).removeClass(\x27btn-primary active\x27).addClass(\x27btn-outline-primary\x27);
        }
        updatePricingSummary();
    });

    \$(document).on(\x27click\x27, \x27.budget-btn\x27, function() {
        const budget = parseInt(\$(this).data(\x27budget\x27));
        \$(\x27#rewardBudget\x27).val(budget);
        \$(\x27.budget-btn\x27).removeClass(\x27btn-primary active\x27).addClass(\x27btn-outline-primary\x27);
        \$(this).removeClass(\x27btn-outline-primary\x27).addClass(\x27btn-primary\x27);
        updatePricingSummary();
    });

    // ==========================================
    // STATUT DRESSUR
    // ==========================================
    
    \$(document).on(\x27change\x27, \x27#publishDressurStatus\x27, function() {
        \$(\x27#statusSection\x27).toggle(this.checked);
        updatePricingSummary();
    });

    // ==========================================
    // SURVEILLANCE EN TEMPS RÉEL - PRODUITS/SERVICES
    // ==========================================

    \$(document).on(\x27input change\x27, \x27#descriptionPromo, #paymentNumber, #whatsappContact\x27, function() {
        updateSubmitButtonsState();
    });

    \$(document).on(\x27change\x27, \x27#paymentMethod\x27, function() {
        updateSubmitButtonsState();
    });

    // ==========================================
    // SURVEILLANCE EN TEMPS RÉEL - DEMANDES D\x27EMPLOI
    // ==========================================

    \$(document).on(\x27input change\x27, \x27#titreDemande, #descriptionProfil, #competences, #niveauExperience, \x27 +
        \x27#secteurActivite, #typeContrat, #localisationSouhaite, #salaireSouhaite, #languesParle, \x27 +
        \x27#lienPortfolio, #coordonneesDemandeur\x27, function() {
        updateSubmitButtonsState();
    });

    // ==========================================
    // SURVEILLANCE EN TEMPS RÉEL - OFFRES D\x27EMPLOI
    // ==========================================

    \$(document).on(\x27input change\x27, \x27#titrePoste, #descriptionPoste, #competencesRequises, #typeContratOffre, \x27 +
        \x27#lieuTravail, #salaireOffre, #niveauExperienceOffre, #horaireTravail, #avantages, #dureeContrat, \x27 +
        \x27#contactEmployeur, #dateLimiteCandidature, #lienInformation\x27, function() {
        updateSubmitButtonsState();
    });

    // ==========================================
    // VALIDATION ET SOUMISSION - PRODUITS/SERVICES
    // ==========================================
    
    function validateProduitServiceForm() {
        const errors = [];

        if (!currentFormuleData.id) {
            errors.push(\x27Veuillez choisir une formule.\x27);
        }
        if (!\$(\x27#descriptionPromo\x27).val().trim()) {
            errors.push(\x27Veuillez entrer une description.\x27);
        }
        if (!selectedImage) {
            errors.push(\x27Veuillez sélectionner une image.\x27);
        }
        const waVal = (\$(\x27#whatsappContact\x27).val() || \x27\x27).trim();
        if (!waVal || !/^\\+\\d{11,}\$/.test(waVal)) {
            errors.push(\x27Le numéro WhatsApp de contact doit commencer par + suivi d\\\x27au moins 11 chiffres.\x27);
            \$(\x27#whatsappContact\x27).addClass(\x27is-invalid\x27);
        } else {
            \$(\x27#whatsappContact\x27).removeClass(\x27is-invalid\x27);
        }
        if (!\$(\x27#paymentMethod\x27).val()) {
            errors.push(\x27Veuillez choisir un moyen de paiement.\x27);
        }
        if (!\$(\x27#paymentNumber\x27).val().trim()) {
            errors.push(\x27Veuillez entrer un numéro de paiement.\x27);
        }
        if (\$(\x27#boostFacebook\x27).is(\x27:checked\x27)) {
            const boostFbAmount = parseInt(\$(\x27#boostFacebookAmount\x27).val()) || 0;
            if (boostFbAmount < 700) {
                errors.push(\x27Le montant minimum pour le boost Facebook est de 700 FCFA.\x27);
            }
        }

        return errors;
    }

    \$(document).on(\x27submit\x27, \x27#produitServiceForm\x27, async function(e) {
        e.preventDefault();

        const errors = validateProduitServiceForm();
        if (errors.length > 0) {
            showAlert(\x27Attention !!!\x27, errors.join(\x27<br>\x27), \x27warning\x27);
            return;
        }

        // Désactiver le bouton et afficher le spinner
        const \$submitBtn = \$(\x27#submitProduitService\x27);
        \$submitBtn.prop(\x27disabled\x27, true);
        \$(\x27#submitSpinner\x27).show();
        \$(\x27#submitText\x27).text(\x27Traitement en cours...\x27);

        try {
            const formData = new FormData();
            formData.append(\x27idFormulePromoAffaire\x27, currentFormuleData.id);
            formData.append(\x27text\x27, \$(\x27#descriptionPromo\x27).val());
            formData.append(\x27uid\x27, getUID());
            formData.append(\x27image\x27, selectedImage);
            formData.append(\x27paymentMethod\x27, \$(\x27#paymentMethod\x27).val());
            formData.append(\x27tel\x27, \$(\x27#paymentNumber\x27).val());
            formData.append(\x27inProgrammeRecompense\x27, \$(\x27#participateReward\x27).is(\x27:checked\x27));
            formData.append(\x27rewardBudget\x27, \$(\x27#rewardBudget\x27).val());
            formData.append(\x27publishOnDressurStatus\x27, \$(\x27#publishDressurStatus\x27).is(\x27:checked\x27));
            formData.append(\x27boostFacebook\x27, \$(\x27#boostFacebook\x27).is(\x27:checked\x27) ? \x271\x27 : \x270\x27);
            formData.append(\x27montantBoostFacebook\x27, \$(\x27#boostFacebookAmount\x27).val() || \x270\x27);
            formData.append(\x27whatsappContact\x27, \$(\x27#whatsappContact\x27).val().trim());
            formData.append(\x27source\x27, \x27web\x27);

            const response = await fetch(`\${API_BASE_URL}/addProduitService`, {
                method: \x27POST\x27,
                body: formData
            });

            const data = await response.json();

            if (response.ok && !data.error) {
                showAlert(\x27Succès\x27, \x27Votre promotion a été enregistrée avec succès. Elle sera publiée après paiement et accord d\\\x27un administrateur.\x27, \x27success\x27);
                
                // Réinitialiser le formulaire
                \$(\x27#produitServiceForm\x27)[0].reset();
                \$(\x27#imagePreview\x27).html(\x27\x27);
                selectedImage = null;
                currentFormuleData = { id: 0, prix: 0, jours: 0, titre: \x27\x27 };
                updatePricingSummary();
                updateSubmitButtonsState();
            } else {
                showAlert(data.titre || \x27Erreur\x27, data.message || \x27Une erreur est survenue.\x27, \x27danger\x27);
            }
        } catch (error) {
            console.error(\x27Erreur:\x27, error);
            showAlert(\x27Erreur\x27, \x27Une erreur est survenue lors de l\\\x27envoi. Veuillez réessayer.\x27, \x27danger\x27);
        } finally {
            \$submitBtn.prop(\x27disabled\x27, false);
            \$(\x27#submitSpinner\x27).hide();
            \$(\x27#submitText\x27).text(\x27VALIDER ET PAYER\x27);
            updateSubmitButtonsState();
        }
    });

    // ==========================================
    // VALIDATION ET SOUMISSION - DEMANDES D\x27EMPLOI
    // ==========================================
    
    \$(document).on(\x27submit\x27, \x27#demandeEmploiForm\x27, async function(e) {
        e.preventDefault();

        const \$submitBtn = \$(\x27#submitDemande\x27);
        \$submitBtn.prop(\x27disabled\x27, true);
        \$(\x27#submitDemandeSpinner\x27).show();
        \$(\x27#submitDemandeText\x27).text(\x27Traitement en cours...\x27);

        try {
            const formData = new FormData();
            formData.append(\x27uid\x27, getUID());
            formData.append(\x27titre_demande_poste_rechercher\x27, \$(\x27#titreDemande\x27).val());
            formData.append(\x27description_profil_demandeur\x27, \$(\x27#descriptionProfil\x27).val());
            formData.append(\x27competence_qualification\x27, \$(\x27#competences\x27).val());
            formData.append(\x27niveau_experience\x27, \$(\x27#niveauExperience\x27).val());
            formData.append(\x27secteur_activite_rechercher\x27, \$(\x27#secteurActivite\x27).val());
            formData.append(\x27type_contrat_rechercher\x27, \$(\x27#typeContrat\x27).val());
            formData.append(\x27localisation_souhaite\x27, \$(\x27#localisationSouhaite\x27).val());
            formData.append(\x27salaire_souhaite\x27, \$(\x27#salaireSouhaite\x27).val());
            formData.append(\x27langues_parle\x27, \$(\x27#languesParle\x27).val());
            formData.append(\x27lien_portfolio\x27, \$(\x27#lienPortfolio\x27).val());
            formData.append(\x27coordonne_demandeur\x27, \$(\x27#coordonneesDemandeur\x27).val());
            formData.append(\x27source\x27, \x27web\x27);

            const response = await fetch(`\${API_BASE_URL}/newDmdEmploi`, {
                method: \x27POST\x27,
                body: formData
            });

            const data = await response.json();

            if (response.ok && !data.error) {
                showAlert(\x27Succès\x27, \x27Votre demande d\\\x27emploi a été enregistrée et sera publiée après accord d\\\x27un administrateur.\x27, \x27success\x27);
                \$(\x27#demandeEmploiForm\x27)[0].reset();
                updateSubmitButtonsState();
            } else {
                showAlert(data.titre || \x27Erreur\x27, data.message || \x27Une erreur est survenue.\x27, \x27danger\x27);
            }
        } catch (error) {
            console.error(\x27Erreur:\x27, error);
            showAlert(\x27Erreur\x27, \x27Une erreur est survenue lors de l\\\x27envoi. Veuillez réessayer.\x27, \x27danger\x27);
        } finally {
            \$submitBtn.prop(\x27disabled\x27, false);
            \$(\x27#submitDemandeSpinner\x27).hide();
            \$(\x27#submitDemandeText\x27).text(\x27ENREGISTRER\x27);
            updateSubmitButtonsState();
        }
    });

    // ==========================================
    // VALIDATION ET SOUMISSION - OFFRES D\x27EMPLOI
    // ==========================================
    
    \$(document).on(\x27submit\x27, \x27#offreEmploiForm\x27, async function(e) {
        e.preventDefault();

        const \$submitBtn = \$(\x27#submitOffre\x27);
        \$submitBtn.prop(\x27disabled\x27, true);
        \$(\x27#submitOffreSpinner\x27).show();
        \$(\x27#submitOffreText\x27).text(\x27Traitement en cours...\x27);

        try {
            const formData = new FormData();
            formData.append(\x27uid\x27, getUID());
            formData.append(\x27titre_poste\x27, \$(\x27#titrePoste\x27).val());
            formData.append(\x27description_poste\x27, \$(\x27#descriptionPoste\x27).val());
            formData.append(\x27competences_requises\x27, \$(\x27#competencesRequises\x27).val());
            formData.append(\x27type_contrat\x27, \$(\x27#typeContratOffre\x27).val());
            formData.append(\x27lieu_travail\x27, \$(\x27#lieuTravail\x27).val());
            formData.append(\x27salaire\x27, \$(\x27#salaireOffre\x27).val());
            formData.append(\x27niveau_experience\x27, \$(\x27#niveauExperienceOffre\x27).val());
            formData.append(\x27horaire_travail\x27, \$(\x27#horaireTravail\x27).val());
            formData.append(\x27avantages\x27, \$(\x27#avantages\x27).val());
            formData.append(\x27dure_contrat_not_cdi\x27, \$(\x27#dureeContrat\x27).val());
            formData.append(\x27contact_emploiyeur\x27, \$(\x27#contactEmployeur\x27).val());
            formData.append(\x27date_limite_candidature\x27, \$(\x27#dateLimiteCandidature\x27).val());
            formData.append(\x27lien_information_otionel\x27, \$(\x27#lienInformation\x27).val());
            formData.append(\x27source\x27, \x27web\x27);

            const response = await fetch(`\${API_BASE_URL}/newOffreEmploi`, {
                method: \x27POST\x27,
                body: formData
            });

            const data = await response.json();

            if (response.ok && !data.error) {
                showAlert(\x27Succès\x27, \x27Votre offre d\\\x27emploi a été enregistrée et sera publiée après accord d\\\x27un administrateur.\x27, \x27success\x27);
                \$(\x27#offreEmploiForm\x27)[0].reset();
                updateSubmitButtonsState();
            } else {
                showAlert(data.titre || \x27Erreur\x27, data.message || \x27Une erreur est survenue.\x27, \x27danger\x27);
            }
        } catch (error) {
            console.error(\x27Erreur:\x27, error);
            showAlert(\x27Erreur\x27, \x27Une erreur est survenue lors de l\\\x27envoi. Veuillez réessayer.\x27, \x27danger\x27);
        } finally {
            \$submitBtn.prop(\x27disabled\x27, false);
            \$(\x27#submitOffreSpinner\x27).hide();
            \$(\x27#submitOffreText\x27).text(\x27ENREGISTRER\x27);
            updateSubmitButtonsState();
        }
    });

    // ==========================================
    // INITIALISATION AU CHARGEMENT DU DOM
    // ==========================================
    
    \$(document).ready(function() {
        // Désactiver les boutons au démarrage
        \$(\x27#imageUploadBtn\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitProduitService\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitDemande\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitOffre\x27).prop(\x27disabled\x27, true);

        // Masquer les sections par défaut
        \$(\x27#rewardSection\x27).hide();
        \$(\x27#rewardBudget\x27).val(\x270\x27);
        \$(\x27.budget-btn\x27).removeClass(\x27btn-primary active\x27).addClass(\x27btn-outline-primary\x27);
        \$(\x27#statusSection\x27).hide();
        \$(\x27#boostFacebookSection\x27).hide();
        \$(\x27#boostFacebookAmount\x27).val(\x27700\x27);
        \$(\x27#demandeEmploiSection\x27).hide();
        \$(\x27#offreEmploiSection\x27).hide();

        // Initialiser l\x27état des boutons
        updateSubmitButtonsState();
    });

    // ==========================================
    // FONCTION PUBLIQUE POUR RÉINITIALISER
    // ==========================================
    
    /**
     * Réinitialise le formulaire et l\x27état global
     * Utile si le formulaire est réinjecté dynamiquement
     */
    window.resetPromotionForm = function() {
        selectedImage = null;
        currentFormuleData = {
            id: 0,
            prix: 0,
            jours: 0,
            titre: \x27\x27
        };
        
        \$(\x27#produitServiceForm\x27)[0].reset();
        \$(\x27#demandeEmploiForm\x27)[0].reset();
        \$(\x27#offreEmploiForm\x27)[0].reset();
        
        \$(\x27#imagePreview\x27).html(\x27\x27);
        \$(\x27#formuleMessage\x27).text(\x27\x27);
        
        updatePricingSummary();
        updateSubmitButtonsState();
        
        \$(\x27#imageUploadBtn\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitProduitService\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitDemande\x27).prop(\x27disabled\x27, true);
        \$(\x27#submitOffre\x27).prop(\x27disabled\x27, true);
    };

    /**
     * Fonction pour mettre à jour les variables globales
     * Utile si les données utilisateur changent
     */
    window.updatePromotionFormConfig = function(config) {
        if (config.apiBaseUrl) window.API_BASE_URL = config.apiBaseUrl;
        if (config.uidUser) window.UID_USER = config.uidUser;
        if (config.langUser) window.LANG_USER = config.langUser;
    };

})(jQuery);


    </script>

    ";
        // line 945
        yield "    <script>
    (function () {
        \x27use strict\x27;

        var DS_UID      = \x27";
        // line 949
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "uid", [], "any", false, false, false, 949), "js"), "html", null, true);
        yield "\x27;
        var SESSION_KEY = \x27dsStatusBannerClosed\x27;
        var banner      = document.getElementById(\x27ds-status-banner\x27);
        var bannerText  = document.getElementById(\x27ds-banner-text\x27);
        var bannerAct   = document.getElementById(\x27ds-banner-actions\x27);
        var bannerClose = document.getElementById(\x27ds-banner-close\x27);

        if (!banner || !DS_UID || DS_UID === \x27\x27) return;

        function buildActions(html) {
            bannerAct.innerHTML = html;
        }

        function showBanner(type, text, actionsHtml) {
            var stored = JSON.parse(sessionStorage.getItem(SESSION_KEY) || \x27{}\x27);
            if (stored[type]) return;

            banner.className = \x27ds-banner-visible ds-banner-\x27 + type;
            bannerText.textContent = text;
            buildActions(actionsHtml);

            // Décaler le contenu de la page pour éviter qu\x27il passe sous le bandeau
            var h = banner.offsetHeight;
            document.querySelector(\x27.wrapper\x27) && (document.querySelector(\x27.wrapper\x27).style.marginTop = h + \x27px\x27);
        }

        bannerClose.addEventListener(\x27click\x27, function () {
            // Détecter le type actif et le stocker en session
            var type = banner.dataset.bannerType || \x27generic\x27;
            var stored = JSON.parse(sessionStorage.getItem(SESSION_KEY) || \x27{}\x27);
            stored[type] = true;
            sessionStorage.setItem(SESSION_KEY, JSON.stringify(stored));
            banner.className = \x27\x27;
            banner.style.display = \x27none\x27;
            document.querySelector(\x27.wrapper\x27) && (document.querySelector(\x27.wrapper\x27).style.marginTop = \x27\x27);
        });

        // Délégation pour les boutons du bandeau
        bannerAct.addEventListener(\x27click\x27, function (e) {
            var t = e.target.closest(\x27[data-ds-action]\x27);
            if (!t) return;
            var action = t.dataset.dsAction;
            if (action === \x27vcf\x27) {
                window.location.href = \x27/export_vcf\x27;
            } else if (action === \x27contacts\x27) {
                window.location.href = \x27/contact\x27;
            } else if (action === \x27boost-list\x27) {
                window.location.href = \x27/listeboostcontact\x27;
            } else if (action === \x27new-boost\x27) {
                window.location.href = \x27/newboostcontact\x27;
            }
        });

        // Fetch des données utilisateur au chargement
        fetch(\x27/api/getUserInfo\x27, {
            method: \x27POST\x27,
            headers: { \x27Content-Type\x27: \x27application/x-www-form-urlencoded\x27 },
            body: \x27uid=\x27 + encodeURIComponent(DS_UID)
        })
        .then(function (r) { return r.ok ? r.json() : null; })
        .then(function (data) {
            if (!data || data.error) return;

            var nbContacts  = parseInt(data.nombreContactDispo) || 0;
            var boostActif  = data.boostActif || null;

            // Priorité 1 : contacts disponibles
            if (nbContacts > 0) {
                banner.dataset.bannerType = \x27contacts\x27;
                var stored = JSON.parse(sessionStorage.getItem(SESSION_KEY) || \x27{}\x27);
                // Si nouvelle valeur par rapport à la session, effacer le flag pour réafficher
                var prevN = parseInt(sessionStorage.getItem(\x27dsContactsDispo\x27) || \x270\x27);
                if (prevN !== nbContacts) {
                    stored[\x27contacts\x27] = false;
                    sessionStorage.setItem(SESSION_KEY, JSON.stringify(stored));
                }
                sessionStorage.setItem(\x27dsContactsDispo\x27, nbContacts);
                showBanner(\x27green\x27,
                    \x27📥 Vous avez \x27 + nbContacts + \x27 contact(s) Dressur disponibles à importer\x27,
                    \x27<button class=\"ds-banner-btn-main\" data-ds-action=\"vcf\">Télécharger VCF</button>\x27 +
                    \x27<button class=\"ds-banner-btn-sec\" data-ds-action=\"contacts\">Voir la liste</button>\x27
                );
                return;
            }

            if (!boostActif) return;

            var typeBoost      = boostActif.typeBoost || \x27\x27;
            var nbObtenus      = parseInt(boostActif.nbContactsObtenus) || 0;
            var nbMax          = parseInt(boostActif.nbContactsMax) || 0;
            var estExpire      = boostActif.estExpire === true || boostActif.estExpire === 1;

            // Priorité 3 : boost expiré (durée ou quota atteint)
            if (estExpire) {
                banner.dataset.bannerType = \x27expire\x27;
                showBanner(\x27orange\x27,
                    \x27🔴 Votre boost est terminé — Relancez pour continuer à recevoir des contacts\x27,
                    \x27<button class=\"ds-banner-btn-main\" data-ds-action=\"new-boost\">Faire un nouveau boost</button>\x27
                );
                return;
            }

            // Priorité 2 : boost quota actif non atteint
            if (typeBoost === \x27quota\x27 && !estExpire) {
                banner.dataset.bannerType = \x27quota\x27;
                showBanner(\x27blue\x27,
                    \x27🔵 Boost actif — \x27 + nbObtenus + \x27/\x27 + nbMax + \x27 contacts reçus\x27,
                    \x27<button class=\"ds-banner-btn-main\" data-ds-action=\"boost-list\">Voir mon boost</button>\x27
                );
                return;
            }
        })
        .catch(function () { /* silencieux */ });
    })();
    </script>

    ";
        // line 1066
        yield "    <style>
    @keyframes dsInterruptFadeIn {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #ds-interrupt-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0,0,0,0.75);
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    #ds-interrupt-backdrop.ds-interrupt-visible {
        display: flex;
    }
    #ds-interrupt-box {
        background: #fff;
        border-radius: 16px;
        padding: 32px 28px 24px;
        max-width: 480px;
        width: 100%;
        text-align: center;
        box-shadow: 0 8px 40px rgba(0,0,0,0.28);
        animation: dsInterruptFadeIn .35s cubic-bezier(.22,.68,0,1.2) both;
    }
    #ds-interrupt-box .ds-int-icon {
        font-size: 3rem;
        line-height: 1;
        margin-bottom: 12px;
    }
    #ds-interrupt-box .ds-int-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 12px;
        line-height: 1.3;
    }
    #ds-interrupt-box .ds-int-body {
        font-size: .95rem;
        color: #444;
        margin: 0 0 24px;
        line-height: 1.55;
    }
    #ds-interrupt-box .ds-int-btn-main {
        display: block;
        width: 100%;
        padding: 14px 20px;
        background: #4CAF50;
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-bottom: 14px;
        transition: background .2s;
    }
    #ds-interrupt-box .ds-int-btn-main:hover { background: #43a047; }
    #ds-interrupt-box .ds-int-btn-later {
        display: block;
        width: 100%;
        background: none;
        border: none;
        color: #888;
        font-size: .9rem;
        cursor: pointer;
        padding: 4px 0 10px;
        text-decoration: underline;
        transition: color .2s;
    }
    #ds-interrupt-box .ds-int-btn-later:hover { color: #555; }
    #ds-interrupt-box .ds-int-footer {
        font-size: .75rem;
        color: #aaa;
        margin-top: 10px;
    }
    </style>

    <div id=\"ds-interrupt-backdrop\" role=\"dialog\" aria-modal=\"true\" aria-labelledby=\"ds-int-title-text\">
        <div id=\"ds-interrupt-box\">
            <div class=\"ds-int-icon\">
                <svg width=\"52\" height=\"52\" viewBox=\"0 0 52 52\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" aria-hidden=\"true\">
                    <circle cx=\"26\" cy=\"26\" r=\"26\" fill=\"#E8F5E9\"/>
                    <ellipse cx=\"26\" cy=\"22\" rx=\"7\" ry=\"7.5\" fill=\"#4CAF50\"/>
                    <ellipse cx=\"17\" cy=\"24\" rx=\"5\" ry=\"5.5\" fill=\"#81C784\"/>
                    <ellipse cx=\"35\" cy=\"24\" rx=\"5\" ry=\"5.5\" fill=\"#81C784\"/>
                    <path d=\"M12 40c0-6.627 6.268-12 14-12s14 5.373 14 12\" stroke=\"#4CAF50\" stroke-width=\"2.5\" stroke-linecap=\"round\" fill=\"none\"/>
                    <path d=\"M7 40c0-4.418 4.477-8 10-8\" stroke=\"#81C784\" stroke-width=\"2\" stroke-linecap=\"round\" fill=\"none\"/>
                    <path d=\"M45 40c0-4.418-4.477-8-10-8\" stroke=\"#81C784\" stroke-width=\"2\" stroke-linecap=\"round\" fill=\"none\"/>
                </svg>
            </div>
            <p class=\"ds-int-title\" id=\"ds-int-title-text\">Vous avez <span id=\"ds-int-nb\">0</span> contact(s) Dressur disponibles&nbsp;!</p>
            <p class=\"ds-int-body\">Ces contacts ont été obtenus grâce à votre Boost Contact. Téléchargez votre fichier VCF maintenant et importez-le dans votre téléphone pour les enregistrer.</p>
            <button class=\"ds-int-btn-main\" id=\"ds-int-btn-vcf\">📥 Télécharger mes contacts (VCF)</button>
            <button class=\"ds-int-btn-later\" id=\"ds-int-btn-later\">Plus tard — je le ferai depuis la page Contacts</button>
            <p class=\"ds-int-footer\">Ce message s\x27affiche au maximum toutes les 4 heures tant que vous avez des contacts non importés.</p>
        </div>
    </div>

    <script>
    (function () {
        \x27use strict\x27;

        // Ne pas déclencher sur /contact ni /export_vcf
        var path = window.location.pathname;
        if (path.indexOf(\x27/contact\x27) !== -1 || path.indexOf(\x27/export_vcf\x27) !== -1) return;

        var DS_UID_INT = \x27";
        // line 1176
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "uid", [], "any", false, false, false, 1176), "js"), "html", null, true);
        yield "\x27;
        if (!DS_UID_INT || DS_UID_INT === \x27\x27) return;

        var LS_KEY   = \x27dressur_contacts_interrupt_ts\x27;
        var DELAY_MS = 4 * 60 * 60 * 1000; // 4 heures

        var backdrop = document.getElementById(\x27ds-interrupt-backdrop\x27);
        var nbSpan   = document.getElementById(\x27ds-int-nb\x27);
        var btnVcf   = document.getElementById(\x27ds-int-btn-vcf\x27);
        var btnLater = document.getElementById(\x27ds-int-btn-later\x27);

        function closeModal() {
            backdrop.classList.remove(\x27ds-interrupt-visible\x27);
        }

        btnVcf.addEventListener(\x27click\x27, function () {
            window.location.href = \x27/export_vcf\x27;
            setTimeout(closeModal, 800);
        });

        btnLater.addEventListener(\x27click\x27, function () {
            closeModal();
            window.location.href = \x27/contact\x27;
        });

        document.addEventListener(\x27DOMContentLoaded\x27, function () {
            // Vérifier le throttle (4 h)
            var lastTs = parseInt(localStorage.getItem(LS_KEY) || \x270\x27, 10);
            var now    = Date.now();
            if (lastTs && (now - lastTs) < DELAY_MS) return;

            fetch(\x27/api/getUserInfo\x27, {
                method: \x27POST\x27,
                headers: { \x27Content-Type\x27: \x27application/x-www-form-urlencoded\x27 },
                body: \x27uid=\x27 + encodeURIComponent(DS_UID_INT)
            })
            .then(function (r) { return r.ok ? r.json() : null; })
            .then(function (data) {
                if (!data || data.error) return;
                var nb = parseInt(data.nombreContactDispo) || 0;
                if (nb < 1) return;
                nbSpan.textContent = nb;
                backdrop.classList.add(\x27ds-interrupt-visible\x27);
                localStorage.setItem(LS_KEY, String(Date.now()));
            })
            .catch(function () { /* silencieux */ });
        });
    })();
    </script>
</body>
</html>";
        yield from [];
    }

    // line 58
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 180
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 239
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "basePrivate.html.twig";
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
        return array (  1357 => 239,  1347 => 180,  1337 => 58,  1281 => 1176,  1169 => 1066,  1050 => 949,  1044 => 945,  338 => 240,  336 => 239,  290 => 196,  284 => 193,  278 => 190,  275 => 189,  266 => 181,  264 => 180,  258 => 176,  256 => 175,  248 => 169,  245 => 167,  243 => 166,  238 => 163,  236 => 162,  234 => 161,  232 => 160,  230 => 159,  228 => 158,  226 => 157,  124 => 58,  78 => 15,  75 => 14,  68 => 10,  65 => 9,  62 => 8,  56 => 5,  53 => 4,  50 => 3,  47 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "basePrivate.html.twig", "/home/runner/workspace/repos/dressur_api/templates/basePrivate.html.twig");
    }
}
