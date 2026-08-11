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

/* private/actu.html.twig */
class __TwigTemplate_9f15d8663b1210c2e68f0ee001050faf extends Template
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
        yield "Actualités";
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
        $context['_seq'] = CoreExtension::ensureTraversable(($context["actus"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["actu"]) {
            // line 8
            yield "        ";
            $context["isSiteApplication"] = (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 8) == "sites_applications");
            // line 9
            yield "        ";
            $context["siteAppName"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", true, true, false, 9)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", false, false, false, 9), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 9))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 9))), "");
            // line 10
            yield "        ";
            $context["siteAppUrl"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", true, true, false, 10)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", false, false, false, 10), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 10))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 10))), "");
            // line 11
            yield "        ";
            $context["siteAppSubtype"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", true, true, false, 11)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", false, false, false, 11), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 11))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 11))), "");
            // line 12
            yield "        <div class=\"col-md-4\">
            <div class=\"card mb-0 shadow h-100\">
                <a href=\"/actu/";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 14), "html", null, true);
            yield "\">
                    <img src=\"/promotion/";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "image", [], "any", false, false, false, 15), "html", null, true);
            yield "\" class=\"card-img-top image-actu\" alt=\"";
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 15), "html", null, true);
            }
            yield "\">
                </a>
                <div class=\"card-body\">
                    ";
            // line 18
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 19
                yield "                        <h5 class=\"card-title mb-1\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
                yield "</h5>
                        <div class=\"text-muted small mb-3\">
                            ";
                // line 21
                if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                    yield "Site web
                            ";
                } elseif ((                // line 22
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                    yield "Application mobile
                            ";
                } elseif ((                // line 23
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                    yield "Logiciel desktop
                            ";
                } else {
                    // line 24
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppSubtype"] ?? null), "html", null, true);
                }
                // line 25
                yield "                        </div>
                        <div class=\"card-text mb-3\">";
                // line 26
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 26), "html", null, true));
                yield "</div>
                    ";
            } else {
                // line 28
                yield "                        <p class=\"card-text actu-small-description mb-2\">
                            ";
                // line 29
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 29) == "produit_service")) {
                    yield "<div class=\"actu-small-description mb-1\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 29), "html", null, true);
                    yield "</div>";
                }
                // line 30
                yield "                            ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 30) == "offre_emploi")) {
                    yield "<div class=\"actu-small-description mb-1\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 30), "description_poste", [], "any", false, false, false, 30), "html", null, true);
                    yield "</div>";
                }
                // line 31
                yield "                            ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 31) == "dmd_emploi")) {
                    yield "<div class=\"actu-small-description mb-1\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 31), "description_profil_demandeur", [], "any", false, false, false, 31), "html", null, true);
                    yield "</div>";
                }
                // line 32
                yield "                        </p>
                    ";
            }
            // line 34
            yield "                    <div class=\"row align-items-center\">
                        ";
            // line 35
            if ((($tmp =  !($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 36
                yield "                            <div class=\"col-5\">
                                <div class=\"row g-2\">
                                    <div class=\"col-auto text-muted small\"><i class=\"fas fa-eye me-1\"></i>";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreImpression", [], "any", false, false, false, 38), "html", null, true);
                yield "</div>
                                    <div class=\"col-auto text-muted small\"><i class=\"fas fa-hand-pointer me-1\"></i>";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreDeVues", [], "any", false, false, false, 39), "html", null, true);
                yield "</div>
                                </div>
                            </div>
                        ";
            }
            // line 43
            yield "                        <div class=\"";
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "col-12";
            } else {
                yield "col-7";
            }
            yield " text-end d-flex gap-1 justify-content-end\">
                            <button class=\"btn btn-outline-secondary btn-sm py-0 px-2 ds-share-btn\"
                                data-share-url=\"https://dressur.site/actualite/";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 45), "html", null, true);
            yield "\"
                                data-share-title=\"";
            // line 46
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 46), "html", null, true);
                yield " — Dressur";
            }
            yield "\"
                                data-share-text=\"";
            // line 47
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 47), "html", null, true);
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 47), 0, 100), "html", null, true);
            }
            yield "\">
                                <i class=\"fas fa-share-nodes\"></i>
                            </button>
                            ";
            // line 50
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 51
                yield "                                ";
                if ((($tmp = ($context["siteAppUrl"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 52
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppUrl"] ?? null), "html", null, true);
                    yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-outline-primary btn-sm py-0 px-2\">
                                        ";
                    // line 53
                    if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                        yield "Ouvrir
                                        ";
                    } elseif ((                    // line 54
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                        yield "Télécharger
                                        ";
                    } elseif ((                    // line 55
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                        yield "Savoir plus
                                        ";
                    } else {
                        // line 56
                        yield "Savoir plus";
                    }
                    // line 57
                    yield "                                        <i class=\"fas fa-external-link-alt ms-1\"></i>
                                    </a>
                                ";
                }
                // line 60
                yield "                            ";
            } else {
                // line 61
                yield "                                <a href=\"/actu/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 61), "html", null, true);
                yield "\" class=\"btn btn-outline-primary btn-sm py-0 px-2\">
                                    Voir <i class=\"fas fa-arrow-right ms-1\"></i>
                                </a>
                            ";
            }
            // line 65
            yield "                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
            $context['_iterated'] = true;
        }
        // line 70
        if (!$context['_iterated']) {
            // line 71
            yield "        <div class=\"alert alert-info text-center fw-semibold fs-6\">
            Aucune actualité disponible selon vos préférences.
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['actu'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "
";
        // line 76
        yield from $this->load("private/_includes/_sociaux.html.twig", 76)->unwrap()->yield($context);
        // line 77
        yield "
</div>
<script>
(function() {
    if (window._dsShareReady) return;
    window._dsShareReady = true;
    document.addEventListener(\x27click\x27, async function(e) {
        var btn = e.target.closest(\x27.ds-share-btn\x27);
        if (!btn) return;
        var shareData = {
            title: btn.dataset.shareTitle,
            text: btn.dataset.shareText,
            url: btn.dataset.shareUrl
        };
        if (navigator.share) {
            try { await navigator.share(shareData); } catch(err) {}
        } else {
            try {
                await navigator.clipboard.writeText(btn.dataset.shareUrl);
                var orig = btn.innerHTML;
                btn.innerHTML = \x27<i class=\"fas fa-check\"></i>\x27;
                setTimeout(function() { btn.innerHTML = orig; }, 2000);
            } catch(err) {
                window.open(btn.dataset.shareUrl, \x27_blank\x27);
            }
        }
    });
})();
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/actu.html.twig";
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
        return array (  289 => 77,  287 => 76,  284 => 75,  275 => 71,  273 => 70,  264 => 65,  256 => 61,  253 => 60,  248 => 57,  245 => 56,  240 => 55,  236 => 54,  232 => 53,  227 => 52,  224 => 51,  222 => 50,  212 => 47,  203 => 46,  199 => 45,  189 => 43,  182 => 39,  178 => 38,  174 => 36,  172 => 35,  169 => 34,  165 => 32,  158 => 31,  151 => 30,  145 => 29,  142 => 28,  137 => 26,  134 => 25,  131 => 24,  126 => 23,  122 => 22,  118 => 21,  112 => 19,  110 => 18,  98 => 15,  94 => 14,  90 => 12,  87 => 11,  84 => 10,  81 => 9,  78 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/actu.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/actu.html.twig");
    }
}
