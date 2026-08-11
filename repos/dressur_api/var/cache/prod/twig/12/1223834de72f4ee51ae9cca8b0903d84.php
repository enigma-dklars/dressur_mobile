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

/* baseAdmin.html.twig */
class __TwigTemplate_3ca292e85ba8e0a7204c86f02f294a8f extends Template
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
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css\" integrity=\"sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" />

    <!-- loader-->
    <link href=\"/assets/css/pace.min.css\" rel=\"stylesheet\" />

    <!--Theme Styles-->
    <link href=\"/assets/css/dark-theme.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/light-theme.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/semi-dark.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/preloader.css\" rel=\"stylesheet\" />
    <link href=\"/assets/css/my-css.css\" rel=\"stylesheet\" />

    <title>";
        // line 50
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield " | Dressur Web</title>
</head>

<body>
    <!--start wrapper-->
    <div class=\"wrapper\">
        ";
        // line 56
        yield from $this->load("private/_includes/top_header_admin.html.twig", 56)->unwrap()->yield($context);
        // line 57
        yield "        
        ";
        // line 58
        yield from $this->load("private/_includes/sidebar_admin.html.twig", 58)->unwrap()->yield($context);
        // line 59
        yield "
        <!--start content-->
            <main class=\"page-content p-3\">
                ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 62));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 63
            yield "                    <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield " alert-dismissible fade show\" role=\"alert\">
                        ";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 65
                yield "                            <p class=\"mb-0\">";
                yield $context["message"];
                yield "</p>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            yield "                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Fermer\"></button>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        yield "                ";
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 71
        yield "            </main>
        <!--end page main-->

        <!--start overlay-->
            <div class=\"overlay nav-toggle-icon\"></div>
        <!--end overlay-->

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
        // line 116
        yield from $this->unwrap()->yieldBlock('script', $context, $blocks);
        // line 117
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
    const DRESSUR_STATUS_PRICE_PER_7_DAYS = 5000;
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

        const \$viewsGoal = \$(\x27#viewsGoal\x27);
        const viewsGoal = \$viewsGoal.length ? parseInt(\$viewsGoal.val()) || 2500 : 2500;
        const effectiveViews = viewsGoal < 2500 ? 2500 : viewsGoal;
        
        // Règle de 3 : 4000 vues = 2500 FCFA
        const baseReward = (effectiveViews * 2500) / 4000;
        // Ajout de 20% de commission plateforme
        return baseReward * 1.2;
    }

    /**
     * Calcule les frais du statut Dressur
     */
    function calculateDressurStatusAmount() {
        const \$publishStatus = \$(\x27#publishDressurStatus\x27);
        if (!\$publishStatus.length || !\$publishStatus.is(\x27:checked\x27) || currentFormuleData.jours === 0) {
            return 0;
        }
        
        return (currentFormuleData.jours * DRESSUR_STATUS_PRICE_PER_7_DAYS) / 7;
    }

    /**
     * Calcule la commission Fedapay
     */
    function calculateFedapayCommission(subTotal) {
        if (subTotal === 0) return 0;
        return (subTotal * 0.03) + 100;
    }

    /**
     * Met à jour le récapitulatif des prix
     */
    function updatePricingSummary() {
        const formulePrice = currentFormuleData.prix;
        const rewardAmount = calculateRewardAmount();
        const statusAmount = calculateDressurStatusAmount();
        const subTotal = formulePrice + rewardAmount + statusAmount;
        const fedapayCommission = calculateFedapayCommission(subTotal);
        const total = subTotal + fedapayCommission;

        // Mise à jour du DOM avec jQuery
        \$(\x27#summaryFormulePrice\x27).text(formatNumber(formulePrice) + \x27 F\x27);
        \$(\x27#summaryRewardPrice\x27).text(formatNumber(rewardAmount) + \x27 F\x27);
        \$(\x27#summaryStatusPrice\x27).text(formatNumber(statusAmount) + \x27 F\x27);
        \$(\x27#summarySubTotal\x27).text(formatNumber(subTotal) + \x27 F\x27);
        \$(\x27#summaryFedapayCommission\x27).text(formatNumber(fedapayCommission) + \x27 F\x27);
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
    
    \$(document).on(\x27change\x27, \x27#participateReward\x27, function() {
        \$(\x27#rewardSection\x27).toggle(this.checked);
        updatePricingSummary();
    });

    \$(document).on(\x27input\x27, \x27#viewsGoal\x27, function() {
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
            formData.append(\x27totalViewsGoal\x27, \$(\x27#viewsGoal\x27).val());
            formData.append(\x27publishOnDressurStatus\x27, \$(\x27#publishDressurStatus\x27).is(\x27:checked\x27));
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
        \$(\x27#statusSection\x27).hide();
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
</body>
</html>";
        yield from [];
    }

    // line 50
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 70
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 116
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
        return "baseAdmin.html.twig";
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
        return array (  887 => 116,  877 => 70,  867 => 50,  219 => 117,  217 => 116,  170 => 71,  167 => 70,  159 => 67,  150 => 65,  146 => 64,  141 => 63,  137 => 62,  132 => 59,  130 => 58,  127 => 57,  125 => 56,  116 => 50,  78 => 15,  75 => 14,  68 => 10,  65 => 9,  62 => 8,  56 => 5,  53 => 4,  50 => 3,  47 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "baseAdmin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/baseAdmin.html.twig");
    }
}
