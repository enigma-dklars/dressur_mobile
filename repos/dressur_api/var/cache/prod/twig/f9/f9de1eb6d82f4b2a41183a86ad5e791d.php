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

/* public/actualite_cards.html.twig */
class __TwigTemplate_597daea0a9d4bcb437dac9d111236472 extends Template
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
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["actus"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["actu"]) {
            // line 2
            yield "    ";
            $context["isSiteApplication"] = (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 2) == "sites_applications");
            // line 3
            yield "    ";
            $context["siteAppName"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", true, true, false, 3)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", false, false, false, 3), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 3))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 3))), "");
            // line 4
            yield "    ";
            $context["siteAppUrl"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", true, true, false, 4)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", false, false, false, 4), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 4))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 4))), "");
            // line 5
            yield "    ";
            $context["siteAppSubtype"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", true, true, false, 5)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", false, false, false, 5), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 5))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 5))), "");
            // line 6
            yield "    ";
            $context["waText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                yield "Bonjour/Bonsoir *";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 6), "html", null, true);
                yield "*, j\x27ai une question concernant la promotion ci-dessous: ";
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 6)) >= 100)) {
                    yield "<<";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 6), 0, 100), "html", null, true);
                    yield "...>>";
                } else {
                    yield "<<";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 6), "html", null, true);
                    yield ">>";
                }
                yield " *Depuis Dressur.* ";
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 7
            yield "    ";
            $context["waUrl"] = ((("https://wa.me/" . CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "whatsappNumber", [], "any", false, false, false, 7)) . "?text=") . Twig\Extension\CoreExtension::urlencode(($context["waText"] ?? null)));
            // line 8
            yield "    ";
            $context["altText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 8) == "offre_emploi")) {
                    yield "Offre d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 8), "titre_demande_poste_rechercher", [], "any", true, true, false, 8) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "titre_demande_poste_rechercher", [], "any", false, false, false, 8))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "titre_demande_poste_rechercher", [], "any", false, false, false, 8), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 8), "lieu_travail", [], "any", true, true, false, 8) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "lieu_travail", [], "any", false, false, false, 8))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "lieu_travail", [], "any", false, false, false, 8), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 8), "html", null, true);
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 8) == "dmd_emploi")) {
                    yield "Demande d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 8), "titre_demande_poste_rechercher", [], "any", true, true, false, 8) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "titre_demande_poste_rechercher", [], "any", false, false, false, 8))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "titre_demande_poste_rechercher", [], "any", false, false, false, 8), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 8), "localisation_souhaite", [], "any", true, true, false, 8) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "localisation_souhaite", [], "any", false, false, false, 8))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 8), "localisation_souhaite", [], "any", false, false, false, 8), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 8), "html", null, true);
                } else {
                    yield "Promotion produit / service — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 8), "html", null, true);
                }
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 9
            yield "    <div class=\"col-md-4\">
        <div class=\"card mb-0 shadow h-100\">
            <a href=\"/actualite/";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 11), "html", null, true);
            yield "\">
                <img src=\"/promotion/";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "image", [], "any", false, false, false, 12), "html", null, true);
            yield "\" class=\"card-img-top image-actu\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(($context["altText"] ?? null)), "html", null, true);
            yield "\" width=\"400\" height=\"300\">
            </a>
            <div class=\"card-body\">
                ";
            // line 15
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 16
                yield "                    <h2 class=\"h5 mb-1\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
                yield "</h2>
                    <div class=\"text-muted small mb-2\">
                        ";
                // line 18
                if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                    yield "Site web
                        ";
                } elseif ((                // line 19
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                    yield "Application mobile
                        ";
                } elseif ((                // line 20
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                    yield "Logiciel desktop
                        ";
                } else {
                    // line 21
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppSubtype"] ?? null), "html", null, true);
                }
                // line 22
                yield "                    </div>
                    <div class=\"card-text actu-app-description\">";
                // line 23
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 23), "html", null, true));
                yield "</div>
                ";
            } else {
                // line 25
                yield "                    <p class=\"card-text actu-small-description\">
                        ";
                // line 26
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 26) == "produit_service")) {
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 26), "html", null, true);
                    yield " ";
                }
                // line 27
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 27) == "offre_emploi")) {
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 27), "description_poste", [], "any", false, false, false, 27), "html", null, true);
                    yield " ";
                }
                // line 28
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 28) == "dmd_emploi")) {
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 28), "description_profil_demandeur", [], "any", false, false, false, 28), "html", null, true);
                    yield " ";
                }
                // line 29
                yield "                    </p>
                ";
            }
            // line 31
            yield "                <div class=\"row align-items-center\">
                    ";
            // line 32
            if ((($tmp =  !($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 33
                yield "                        <div class=\"col-6\">
                            <div class=\"row g-2\">
                                <div class=\"col-auto\"><i class=\"fas fa-eye me-1\"></i> ";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreImpression", [], "any", false, false, false, 35), "html", null, true);
                yield "</div>
                                <div class=\"col-auto\"><i class=\"fas fa-hand-pointer me-1\"></i> ";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreDeVues", [], "any", false, false, false, 36), "html", null, true);
                yield "</div>
                            </div>
                        </div>
                    ";
            } else {
                // line 40
                yield "                        <div class=\"col-6\"></div>
                    ";
            }
            // line 42
            yield "                    <div class=\"col-6 text-end d-flex gap-1 justify-content-end\">
                        ";
            // line 43
            if ((($tmp =  !($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 44
                yield "                            <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["waUrl"] ?? null), "html", null, true);
                yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-success btn-sm rounded-2 py-0\"><i class=\"fab fa-whatsapp\"></i></a>
                        ";
            }
            // line 46
            yield "                        <button class=\"btn btn-outline-secondary btn-sm py-0 px-2 ds-share-btn\"
                            data-share-url=\"https://dressur.site/actualite/";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 47), "html", null, true);
            yield "\"
                            data-share-title=\"";
            // line 48
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 48), "html", null, true);
                yield " — Dressur";
            }
            yield "\"
                            data-share-text=\"";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 49), 0, 100), "html", null, true);
            yield "\">
                            <i class=\"fas fa-share-nodes\"></i>
                        </button>
                        ";
            // line 52
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 53
                yield "                            ";
                if ((($tmp = ($context["siteAppUrl"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 54
                    yield "                                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppUrl"] ?? null), "html_attr");
                    yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-info btn-sm rounded-2 py-0\">
                                    ";
                    // line 55
                    if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                        yield "Ouvrir
                                    ";
                    } elseif ((                    // line 56
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                        yield "Télécharger
                                    ";
                    } elseif ((                    // line 57
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                        yield "Savoir plus
                                    ";
                    }
                    // line 59
                    yield "                                </a>
                            ";
                }
                // line 61
                yield "                        ";
            } else {
                // line 62
                yield "                            <a href=\"/actualite/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 62), "html", null, true);
                yield "\" class=\"btn btn-info btn-sm rounded-2 py-0\">Voir</a>
                        ";
            }
            // line 64
            yield "                    </div>
                </div>
            </div>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['actu'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/actualite_cards.html.twig";
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
        return array (  282 => 64,  276 => 62,  273 => 61,  269 => 59,  264 => 57,  260 => 56,  256 => 55,  251 => 54,  248 => 53,  246 => 52,  240 => 49,  231 => 48,  227 => 47,  224 => 46,  218 => 44,  216 => 43,  213 => 42,  209 => 40,  202 => 36,  198 => 35,  194 => 33,  192 => 32,  189 => 31,  185 => 29,  178 => 28,  171 => 27,  165 => 26,  162 => 25,  157 => 23,  154 => 22,  151 => 21,  146 => 20,  142 => 19,  138 => 18,  132 => 16,  130 => 15,  122 => 12,  118 => 11,  114 => 9,  79 => 8,  76 => 7,  58 => 6,  55 => 5,  52 => 4,  49 => 3,  46 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/actualite_cards.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/actualite_cards.html.twig");
    }
}
