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

/* private/listepromoaffaire.html.twig */
class __TwigTemplate_add1a4adf1d89a36b9e07680bbfd1428 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "basePrivate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Promo. Affaire";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "<div class=\"row g-3\">
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listepromoaffaire"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["promoaffaire"]) {
            // line 8
            yield "        <div class=\"col-md-4\">
            <div class=\"card mb-0 h-100\">
                <div class=\"card-body\">
                    ";
            // line 11
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 11) == "produit_service")) {
                // line 12
                yield "                        ";
                $context["bg_badge"] = "bg-success";
                // line 13
                yield "                        ";
                $context["tpa"] = "Produit Service";
                // line 14
                yield "                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 14) == "sites_applications")) {
                // line 15
                yield "                        ";
                $context["bg_badge"] = "bg-info";
                // line 16
                yield "                        ";
                $context["tpa"] = "Sites & Applications";
                // line 17
                yield "                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 17) == "offre_emploi")) {
                // line 18
                yield "                        ";
                $context["bg_badge"] = "bg-warning";
                // line 19
                yield "                        ";
                $context["tpa"] = "Offre Emploi";
                // line 20
                yield "                    ";
            } else {
                // line 21
                yield "                        ";
                $context["bg_badge"] = "bg-danger";
                // line 22
                yield "                        ";
                $context["tpa"] = "Demande Emploi";
                // line 23
                yield "                    ";
            }
            // line 24
            yield "                    <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg_badge"] ?? null), "html", null, true);
            yield " text-white mb-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["tpa"] ?? null), "html", null, true);
            yield "</span>
                    
                    ";
            // line 26
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 26) == 0)) {
                $context["bg_badge"] = "bg-danger";
            }
            // line 27
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 27) == 1)) {
                $context["bg_badge"] = "bg-warning";
            }
            // line 28
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 28) == 2)) {
                $context["bg_badge"] = "bg-warning";
            }
            // line 29
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 29) == 3)) {
                $context["bg_badge"] = "bg-success";
            }
            // line 30
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 30) == 4)) {
                $context["bg_badge"] = "bg-success";
            }
            // line 31
            yield "                    <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg_badge"] ?? null), "html", null, true);
            yield " text-white mb-1 mx-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "status", [], "any", false, false, false, 31), "html", null, true);
            yield "</span> 
                    
                    ";
            // line 33
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 33) == 0)) {
                // line 34
                yield "                        <p>
                            Motif : ";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motif", [], "any", false, false, false, 35), "html", null, true);
                yield "
                        </p>
                        ";
                // line 37
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motifsRefus", [], "any", false, false, false, 37)) > 1)) {
                    // line 38
                    yield "                            <button class=\"btn btn-sm btn-outline-secondary mb-1\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_historique_refus_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 38), "html", null, true);
                    yield "\">
                                Voir les refus précédents (";
                    // line 39
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motifsRefus", [], "any", false, false, false, 39)) - 1), "html", null, true);
                    yield ")
                            </button>
                        ";
                }
                // line 42
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 42) == "produit_service")) {
                    yield " <div class=\"actu-small-description mb-1\"> <span class=\"text-success small\">Tenez compte du motif de refus pour modifier votre promotion. Merci...</span> </div> ";
                }
                // line 43
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 43) == "offre_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> <span class=\"text-success small\">Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci...</span> </div> ";
                }
                // line 44
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 44) == "dmd_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> <span class=\"text-success small\">Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci...</span> </div> ";
                }
                // line 45
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 45) == "sites_applications")) {
                    yield " <div class=\"actu-small-description mb-1\"> <span class=\"text-success small\">Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci...</span> </div> ";
                }
                // line 46
                yield "                    ";
            } else {
                // line 47
                yield "                        ";
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motifsRefus", [], "any", false, false, false, 47)) > 0)) {
                    // line 48
                    yield "                            <button class=\"btn btn-sm btn-outline-secondary mb-1\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_historique_refus_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 48), "html", null, true);
                    yield "\">
                                <i class=\"fas fa-history me-1\"></i> Historique des refus
                            </button>
                        ";
                }
                // line 52
                yield "                        <div class=\"d-flex justify-content-between mb-1\">
                            <div>
                                Impressions : <strong>";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nombreImpression", [], "any", false, false, false, 54), "html", null, true);
                yield "</strong>
                            </div>
                            <div>
                                Vues : <strong>";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nombreDeVues", [], "any", false, false, false, 57), "html", null, true);
                yield "</strong>
                            </div>
                        </div>
                        ";
                // line 60
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 60) == "produit_service")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 60), "html", null, true);
                    yield " </div> ";
                }
                // line 61
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 61) == "offre_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "annotherInfo", [], "any", false, false, false, 61), "description_poste", [], "any", false, false, false, 61), "html", null, true);
                    yield " </div> ";
                }
                // line 62
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 62) == "dmd_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "annotherInfo", [], "any", false, false, false, 62), "description_profil_demandeur", [], "any", false, false, false, 62), "html", null, true);
                    yield " </div> ";
                }
                // line 63
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 63) == "sites_applications")) {
                    // line 64
                    yield "                            <div class=\"mb-1\">
                                ";
                    // line 65
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "sousTypeSiteApp", [], "any", false, false, false, 65) == "site_web")) {
                        // line 66
                        yield "                                    <span class=\"badge bg-info text-white\">Site web</span>
                                ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 67
$context["promoaffaire"], "sousTypeSiteApp", [], "any", false, false, false, 67) == "app_mobile")) {
                        // line 68
                        yield "                                    <span class=\"badge bg-info text-white\">App mobile</span>
                                ";
                    } else {
                        // line 70
                        yield "                                    <span class=\"badge bg-info text-white\">Logiciel</span>
                                ";
                    }
                    // line 72
                    yield "                            </div>
                            ";
                    // line 73
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nomSiteApp", [], "any", false, false, false, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 74
                        yield "                                <div class=\"fw-semibold mb-1\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nomSiteApp", [], "any", false, false, false, 74), "html", null, true);
                        yield "</div>
                            ";
                    }
                    // line 76
                    yield "                            <div class=\"actu-small-description mb-1\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 76), "html", null, true);
                    yield "</div>
                            ";
                    // line 77
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "urlSiteApp", [], "any", false, false, false, 77)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 78
                        yield "                                <div class=\"mb-1\">
                                    <a href=\"";
                        // line 79
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "urlSiteApp", [], "any", false, false, false, 79), "html", null, true);
                        yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-sm btn-outline-primary rounded-pill\">
                                        ";
                        // line 80
                        if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "sousTypeSiteApp", [], "any", false, false, false, 80) == "site_web")) {
                            // line 81
                            yield "                                            <i class=\"fas fa-globe me-1\"></i> Visiter
                                        ";
                        } elseif ((CoreExtension::getAttribute($this->env, $this->source,                         // line 82
$context["promoaffaire"], "sousTypeSiteApp", [], "any", false, false, false, 82) == "app_mobile")) {
                            // line 83
                            yield "                                            <i class=\"fas fa-mobile-alt me-1\"></i> Installer
                                        ";
                        } else {
                            // line 85
                            yield "                                            <i class=\"fas fa-download me-1\"></i> Télécharger
                                        ";
                        }
                        // line 87
                        yield "                                    </a>
                                </div>
                            ";
                    }
                    // line 90
                    yield "                        ";
                }
                // line 91
                yield "                    ";
            }
            // line 92
            yield "                    
                    <div class=\"";
            // line 93
            if (((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 93) == 2) || (CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 93) == 4))) {
                yield "d-flex justify-content-between";
            } else {
                yield "text-end";
            }
            yield " mt-2\">
                        ";
            // line 94
            if (((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 94) == 2) || (CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 94) == 4))) {
                // line 95
                yield "                            <button class=\"btn btn-sm btn-warning rounded-pill\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_payerpromoaffaire_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 95), "html", null, true);
                yield "\"><i class=\"fas fa-credit-card me-1\"></i> Payer</button>
                        ";
            }
            // line 97
            yield "                        ";
            if (((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 97) == 0) && (CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 97) == "produit_service"))) {
                // line 98
                yield "                            <button class=\"btn btn-sm btn-danger text-white editPromotionAffaire rounded-pill\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_modifier_promoaffaire_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 98), "html", null, true);
                yield "\"><i class=\"fas fa-pen me-1\"></i> Modifier</button>
                        ";
            }
            // line 100
            yield "                        <button class=\"btn btn-sm btn-primary rounded-pill\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_promoaffaire_";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 100), "html", null, true);
            yield "\"><i class=\"fas fa-info me-2\"></i>";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 100) != 2)) {
                yield "Détails";
            }
            yield "</button>
                    </div>
                </div>
            </div>

            <div class=\"modal fade\" id=\"modal_modifier_promoaffaire_";
            // line 105
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 105), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5>Modifier la promotion affaire</h5>
                        </div>
                        <div class=\"modal-body\">
                            <div class=\"col-12\">
                                <div class=\"mt-0 msgError\" id=\"msgError-";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 113), "html", null, true);
            yield "\" style=\"display: none;\"></div>
                            </div>
                            <div hidden>
                                <input type=\"text\" id=\"idPromoAffaire-";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield "\">
                            </div>
                            <form id=\"promotionForm\" enctype=\"multipart/form-data\" class=\"mt-2\">
                                <div class=\"row\">
                                    <div class=\"col-md-12\">
                                        <label for=\"image\" class=\"form-label\">Sélectionner une image</label>
                                        <input type=\"file\" class=\"form-control getInfo imagePromoServiceProduit\" id=\"image_";
            // line 122
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 122), "html", null, true);
            yield "\" accept=\"image/*\" id_promo_affaire=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 122), "html", null, true);
            yield "\">
                                        <div id=\"imagePreview_";
            // line 123
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 123), "html", null, true);
            yield "\" class=\"mt-2\">
                                            <img src=\"/promotion/";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "image", [], "any", false, false, false, 124), "html", null, true);
            yield "\" class=\"card-img-top\" style=\"height: 325px; object-fit: contain;\">
                                        </div>
                                    </div>
                                    <div class=\"col-md-12\">
                                        <label for=\"description\" class=\"form-label\">Description de la promotion</label>
                                        <textarea class=\"form-control getInfo\" id=\"description_";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 129), "html", null, true);
            yield "\" rows=\"15\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 129), "html", null, true);
            yield "</textarea>
                                    </div>
                                    <div class=\"col-md-12 mt-3\">
                                        <label class=\"form-label\">Numéro WhatsApp de contact</label>
                                        <input type=\"text\" class=\"form-control\" id=\"whatsappContact_";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 133), "html", null, true);
            yield "\" name=\"whatsappContact\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "whatsappContact", [], "any", false, false, false, 133), "html", null, true);
            yield "\" placeholder=\"+22900000000\">
                                        <div class=\"form-text\">Format international requis, ex : +22900000000</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm me-2\" data-bs-dismiss=\"modal\">Fermer</button>
                            <button type=\"button\" class=\"btn btn-primary btn-sm modifierpromoaffaire\" id_promo_affaire=\"";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 141), "html", null, true);
            yield "\" id=\"modifierpromoaffaire-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 141), "html", null, true);
            yield "\">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>

            ";
            // line 148
            yield "            ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motifsRefus", [], "any", false, false, false, 148)) > 0)) {
                // line 149
                yield "            <div class=\"modal fade\" id=\"modal_historique_refus_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 149), "html", null, true);
                yield "\" tabindex=\"-1\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\"><i class=\"fas fa-history me-2\"></i>Historique des refus</h5>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
                        </div>
                        <div class=\"modal-body\">
                            <ol>
                                ";
                // line 158
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motifsRefus", [], "any", false, false, false, 158), function ($__a__, $__b__) use ($context, $macros) { $context["a"] = $__a__; $context["b"] = $__b__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["b"] ?? null), "dateRefus", [], "any", false, false, false, 158) <=> CoreExtension::getAttribute($this->env, $this->source, ($context["a"] ?? null), "dateRefus", [], "any", false, false, false, 158)); }));
                foreach ($context['_seq'] as $context["_key"] => $context["motifEntry"]) {
                    // line 159
                    yield "                                    <li class=\"mb-3\">
                                        <strong>";
                    // line 160
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["motifEntry"], "dateRefus", [], "any", false, false, false, 160), "d/m/Y à H:i"), "html", null, true);
                    yield "</strong>
                                        <div>";
                    // line 161
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["motifEntry"], "motif", [], "any", false, false, false, 161), "html", null, true);
                    yield "</div>
                                    </li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['motifEntry'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 164
                yield "                            </ol>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            ";
            }
            // line 173
            yield "
            <div class=\"modal fade\" id=\"modal_payerpromoaffaire_";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 174), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5>Démarer la promotion affaire</h5>
                        </div>
                        <div class=\"modal-body\">
                            <div class=\"col-12\">
                                <div class=\"mt-0 msgError msgError-";
            // line 182
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 182), "html", null, true);
            yield "\" id=\"msgError-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 182), "html", null, true);
            yield "\" style=\"display: none;\"></div>
                            </div>
                            <div hidden>
                                <input type=\"text\" id=\"idPromoAffaire-";
            // line 185
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 185), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 185), "html", null, true);
            yield "\">
                            </div>
                            <div class=\"mb-2\">
                                <label for=\"formulBoost\">Formule de Boost</label>
                                <select id=\"formulBosst\" class=\"form-select getInfoBoostPayant-";
            // line 189
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 189), "html", null, true);
            yield " formulBoostPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 189), "html", null, true);
            yield "\">
                                    <option value=\"\" selected disabled>Choissisez une Formule de Boost</option>
                                    ";
            // line 191
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["listeFormulBoost"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["formulBoost"]) {
                // line 192
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "id", [], "any", false, false, false, 192), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "label", [], "any", false, false, false, 192), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['formulBoost'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 194
            yield "                                </select>
                            </div>
                            <div class=\"mb-2\">
                                <label for=\"moyen-paiement\">Moyen de paiement mobile ou par carte</label>
                                <select id=\"moyen-paiement-";
            // line 198
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 198), "html", null, true);
            yield "\" class=\"form-select getInfo getInfoBoostPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 198), "html", null, true);
            yield " moyenPaiementPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 198), "html", null, true);
            yield "\">
                                    <option value=\"\" disabled selected>Choisisez le Moyen de paiement mobile ou par carte</option>
                                    ";
            // line 200
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["uneMethodePaiement"]) {
                // line 201
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "value", [], "any", false, false, false, 201), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "titre", [], "any", false, false, false, 201), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['uneMethodePaiement'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 203
            yield "                                </select>
                            </div>
                            <div>
                                <label for=\"numero-paiement\">Indicatif + Numéro de Paiement</label>
                                <input type=\"text\" class=\"form-control getInfo getInfoBoostPayant-";
            // line 207
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 207), "html", null, true);
            yield " numeroPaiementPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 207), "html", null, true);
            yield "\" id=\"numero-paiement-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 207), "html", null, true);
            yield "\">
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm me-2\" data-bs-dismiss=\"modal\">Fermer</button>
                            <button type=\"button\" class=\"btn btn-primary btn-sm payerpromoaffaire\" payerpromoaffaire=\"";
            // line 212
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 212), "html", null, true);
            yield "\" id=\"payerpromoaffaire-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 212), "html", null, true);
            yield "\">PAYER et BOOSTER</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"modal fade\" id=\"modal_promoaffaire_";
            // line 218
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 218), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-body p-0\">
                            <img src=\"/promotion/";
            // line 222
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "image", [], "any", false, false, false, 222), "html", null, true);
            yield "\" alt=\"\" class=\"card-img-top mb-3\">
                            <p class=\"px-3\">
                                Formule de promotion : ";
            // line 224
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "formulePromotion", [], "any", false, false, false, 224), "html", null, true);
            yield " Fcfa
                            </p>
                            <p class=\"px-3\">
                                Date de début : ";
            // line 227
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "dateDebut", [], "any", false, false, false, 227), "html", null, true);
            yield "
                            </p>
                            <p class=\"px-3\">
                                Date de fin : ";
            // line 230
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "dateExp", [], "any", false, false, false, 230), "html", null, true);
            yield "
                            </p>
                            <p class=\"px-3\">
                                ";
            // line 233
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 233), "html", null, true));
            yield "
                            </p>
                            <div class=\"px-3\">
                                ";
            // line 236
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "annotherInfo", [], "any", false, false, false, 236));
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 237
                yield "                                    <div class=\"mb-1\">
                                        <div class=\"fw-bolder text-primary fs-6\">";
                // line 238
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace($context["key"], ["_" => " "])), "html", null, true);
                yield " : </div>
                                        <div style=\"word-wrap: break-word; white-space: normal;\">";
                // line 239
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true));
                yield "</div>
                                        <hr>
                                    </div>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 243
            yield "                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
            $context['_iterated'] = true;
        }
        // line 252
        if (!$context['_iterated']) {
            // line 253
            yield "        <div class=\"alert alert-info text-center fw-semibold fs-6\">
            Aucune Promotion Affaire trouvé.
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promoaffaire'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 257
        yield "</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/listepromoaffaire.html.twig";
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
        return array (  686 => 257,  677 => 253,  675 => 252,  662 => 243,  652 => 239,  648 => 238,  645 => 237,  641 => 236,  635 => 233,  629 => 230,  623 => 227,  617 => 224,  612 => 222,  605 => 218,  594 => 212,  582 => 207,  576 => 203,  565 => 201,  561 => 200,  552 => 198,  546 => 194,  535 => 192,  531 => 191,  524 => 189,  515 => 185,  507 => 182,  496 => 174,  493 => 173,  482 => 164,  473 => 161,  469 => 160,  466 => 159,  462 => 158,  449 => 149,  446 => 148,  435 => 141,  422 => 133,  413 => 129,  405 => 124,  401 => 123,  395 => 122,  384 => 116,  378 => 113,  367 => 105,  354 => 100,  348 => 98,  345 => 97,  339 => 95,  337 => 94,  329 => 93,  326 => 92,  323 => 91,  320 => 90,  315 => 87,  311 => 85,  307 => 83,  305 => 82,  302 => 81,  300 => 80,  296 => 79,  293 => 78,  291 => 77,  286 => 76,  280 => 74,  278 => 73,  275 => 72,  271 => 70,  267 => 68,  265 => 67,  262 => 66,  260 => 65,  257 => 64,  254 => 63,  247 => 62,  240 => 61,  234 => 60,  228 => 57,  222 => 54,  218 => 52,  210 => 48,  207 => 47,  204 => 46,  199 => 45,  194 => 44,  189 => 43,  184 => 42,  178 => 39,  173 => 38,  171 => 37,  166 => 35,  163 => 34,  161 => 33,  153 => 31,  148 => 30,  143 => 29,  138 => 28,  133 => 27,  129 => 26,  121 => 24,  118 => 23,  115 => 22,  112 => 21,  109 => 20,  106 => 19,  103 => 18,  100 => 17,  97 => 16,  94 => 15,  91 => 14,  88 => 13,  85 => 12,  83 => 11,  78 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/listepromoaffaire.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/listepromoaffaire.html.twig");
    }
}
