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

/* public/promotion_reseau_detail.html.twig */
class __TwigTemplate_b41e1b242cbc5ee21f30ea7000f153f1 extends Template
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
            'referencement' => [$this, 'block_referencement'],
            'jsonld' => [$this, 'block_jsonld'],
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $context["platformName"] = CoreExtension::getAttribute($this->env, $this->source, ($context["formule"] ?? null), "titre", [], "any", false, false, false, 3);
        // line 4
        $context["min_price_safe"] = (((($context["min_price"] ?? null) >= 100)) ? (($context["min_price"] ?? null)) : (100));
        // line 5
        $context["title"] = (("Promotion " . ($context["platformName"] ?? null)) . " — Abonnés, Likes, Vues pas chers");
        // line 6
        $context["description"] = (((("Boostez votre présence sur " . ($context["platformName"] ?? null)) . " avec Dressur : achetez des abonnés, likes, vues, commentaires et bien plus. Livraison rapide, à partir de ") . ($context["min_price_safe"] ?? null)) . " F CFA.");
        // line 1
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 9
        yield "    <meta property=\"og:title\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta property=\"og:description\" content=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-promotion-reseaux-sociaux.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"description\" content=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, ";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", abonnés ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", likes ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", vues ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", promotion réseaux sociaux, ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield " pas cher Afrique\">
";
        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 22
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"Service\",
  \"@id\": \"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "#service\",
  \"name\": \"Promotion ";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "\",
  \"description\": \"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\",
  \"provider\": {\"@type\":\"Organization\",\"name\":\"Dressur\",\"url\":\"https://dressur.site\",\"@id\":\"https://dressur.site/#organization\"},
  \"serviceType\": \"Promotion réseaux sociaux — ";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "\",
  \"areaServed\": \"Afrique de l\x27Ouest\",
  \"offers\": {
    \"@type\": \"AggregateOffer\",
    \"lowPrice\": \"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min_price_safe"] ?? null), "html", null, true);
        yield "\",
    \"priceCurrency\": \"XOF\",
    \"availability\": \"https://schema.org/InStock\",
    \"url\": \"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\"
  }
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[
  {\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},
  {\"@type\":\"ListItem\",\"position\":2,\"name\":\"Promotions Réseaux Sociaux\",\"item\":\"";
        // line 45
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\"},
  {\"@type\":\"ListItem\",\"position\":3,\"name\":\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "\",\"item\":\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\"}
]}
</script>
";
        yield from [];
    }

    // line 51
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 53
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 54
        yield "<div class=\"container mt-3\">

    <div class=\"mb-3 h6\">
        <span class=\"fw-bolder\">Dressur</span> /
        <a href=\"";
        // line 58
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"text-decoration-none\">Réseaux Sociaux</a> /
        <span class=\"text-primary\">";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</span>
    </div>

    <header class=\"text-white text-center py-5 rounded mb-4\" style=\"background-color: #2a4b9a !important;\">
        <div class=\"container\">
            <h1 class=\"display-5 fw-bold\">Promotion ";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</h1>
            <p class=\"lead mb-4\">
                Abonnés, likes, vues, commentaires sur ";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ".<br>
                Livraison rapide — à partir de <strong>";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min_price_safe"] ?? null), "html", null, true);
        yield " F CFA</strong>.
            </p>
            <a href=\"";
        // line 69
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-light btn-lg me-2\">
                <i class=\"fas fa-user-plus me-1\"></i> Commencer
            </a>
            <a href=\"";
        // line 72
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn btn-outline-light btn-lg\">
                <i class=\"fas fa-tags me-1\"></i> Tous les tarifs
            </a>
        </div>
    </header>

    ";
        // line 79
        yield "    <section class=\"mb-5\">
        <h2 class=\"fw-semibold mb-1 text-center\">Services disponibles — ";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</h2>
        <p class=\"text-center text-muted mb-4\">Cliquez sur un service pour voir les détails et commander.</p>

        ";
        // line 83
        if (Twig\Extension\CoreExtension::testEmpty(($context["enfants"] ?? null))) {
            // line 84
            yield "            <div class=\"alert alert-info text-center\">Aucun service disponible pour le moment.</div>
        ";
        } else {
            // line 86
            yield "            <div class=\"row g-3\">
                ";
            // line 87
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["enfants"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 88
                yield "                ";
                $context["prix_fcfa"] = Twig\Extension\CoreExtension::round((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 88), "prix", [], "any", false, false, false, 88) * 1.2) * 1.7) * 700), 0, "ceil");
                // line 89
                yield "                ";
                $context["prix_display"] = (((($context["prix_fcfa"] ?? null) >= 100)) ? (($context["prix_fcfa"] ?? null)) : (100));
                // line 90
                yield "                <div class=\"col-md-6 col-lg-4 d-flex align-items-stretch\">
                    <div class=\"card mb-0 shadow-sm w-100\" style=\"border-top: 4px solid #2a4b9a;\">
                        <div class=\"card-body d-flex flex-column p-4\">
                            <h5 class=\"card-title fw-semibold\" style=\"color:#2a4b9a;\">";
                // line 93
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 93), "titre", [], "any", false, false, false, 93), "html", null, true);
                yield "</h5>
                            <p class=\"card-text text-muted mt-2 flex-grow-1\"
                               style=\"display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;\">
                                ";
                // line 96
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 96), "description", [], "any", false, false, false, 96)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 97
                    yield "                                    ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 97), "description", [], "any", false, false, false, 97), "html", null, true);
                    yield "
                                ";
                } else {
                    // line 99
                    yield "                                    Augmentez le nombre de ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 99), "titre", [], "any", false, false, false, 99)), "html", null, true);
                    yield " sur votre compte ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
                    yield ".
                                ";
                }
                // line 101
                yield "                            </p>
                            <div class=\"mt-3 d-flex align-items-center justify-content-between\">
                                <span class=\"fw-bold\" style=\"color:#2a4b9a; font-size:1.05rem;\">";
                // line 103
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["prix_display"] ?? null), 0, ",", " "), "html", null, true);
                yield " F CFA</span>
                                <a href=\"";
                // line 104
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promo_reseau_service_detail", ["token" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "token", [], "any", false, false, false, 104)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-primary\">
                                    Détails <i class=\"fas fa-arrow-right ms-1\"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 112
            yield "            </div>
        ";
        }
        // line 114
        yield "    </section>

    ";
        // line 117
        yield "    <section class=\"mb-5\">
        <h2 class=\"fw-semibold text-center mb-4\">Comment ça marche ?</h2>
        <div class=\"row g-3 text-center\">
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle mb-3\"
                              style=\"width:56px;height:56px;background:#eef2ff;\">
                            <span class=\"fw-bold fs-4\" style=\"color:#2a4b9a;\">1</span>
                        </span>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Créez un compte</h5>
                        <p class=\"text-muted mt-2\">Inscrivez-vous gratuitement sur Dressur en quelques secondes.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle mb-3\"
                              style=\"width:56px;height:56px;background:#eef2ff;\">
                            <span class=\"fw-bold fs-4\" style=\"color:#2a4b9a;\">2</span>
                        </span>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Choisissez un service</h5>
                        <p class=\"text-muted mt-2\">Sélectionnez le service ";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield " qui vous convient et rechargez votre compte.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle mb-3\"
                              style=\"width:56px;height:56px;background:#eef2ff;\">
                            <span class=\"fw-bold fs-4\" style=\"color:#2a4b9a;\">3</span>
                        </span>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Résultats garantis</h5>
                        <p class=\"text-muted mt-2\">Votre commande est traitée rapidement. Vos statistiques augmentent en temps réel.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    ";
        // line 160
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["autres_formules"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 161
            yield "    <section class=\"mb-5\">
        <h2 class=\"fw-semibold mb-4\"><i class=\"fas fa-play fs-5 me-2\"></i>Autres plateformes disponibles</h2>
        <div class=\"row g-3\">
            ";
            // line 164
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["autres_formules"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 165
                yield "            <div class=\"col-md-4 col-6\">
                <a href=\"";
                // line 166
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promo_reseau_detail", ["token" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "token", [], "any", false, false, false, 166)]), "html", null, true);
                yield "\"
                   class=\"card mb-0 shadow-sm text-decoration-none h-100\" style=\"border-top: 3px solid #2a4b9a;\">
                    <div class=\"card-body text-center py-3\">
                        <i class=\"fas fa-thumbs-up mb-2\" style=\"color:#2a4b9a;\"></i>
                        <div class=\"fw-semibold\" style=\"color:#2a4b9a;\">";
                // line 170
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "titre", [], "any", false, false, false, 170), "html", null, true);
                yield "</div>
                    </div>
                </a>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 175
            yield "        </div>
    </section>
    ";
        }
        // line 178
        yield "
    <section class=\"pb-5\">
        <div class=\"card mb-0 shadow-sm\">
            <div class=\"card-body text-center py-5\">
                <h2 class=\"fw-bold mb-2\">Prêt à booster votre ";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield " ?</h2>
                <p class=\"lead text-muted mb-4\">Des milliers d\x27utilisateurs font confiance à Dressur chaque jour.</p>
                <a href=\"";
        // line 184
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-primary btn-lg me-2\">
                    <i class=\"fas fa-user-plus me-1\"></i> Commencer maintenant
                </a>
                <a href=\"";
        // line 187
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"btn btn-outline-primary btn-lg\">
                    <i class=\"fas fa-arrow-left me-1\"></i> Tous les réseaux
                </a>
            </div>
        </div>
    </section>

</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/promotion_reseau_detail.html.twig";
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
        return array (  433 => 187,  427 => 184,  422 => 182,  416 => 178,  411 => 175,  400 => 170,  393 => 166,  390 => 165,  386 => 164,  381 => 161,  378 => 160,  356 => 140,  331 => 117,  327 => 114,  323 => 112,  309 => 104,  305 => 103,  301 => 101,  293 => 99,  287 => 97,  285 => 96,  279 => 93,  274 => 90,  271 => 89,  268 => 88,  264 => 87,  261 => 86,  257 => 84,  255 => 83,  249 => 80,  246 => 79,  237 => 72,  231 => 69,  226 => 67,  222 => 66,  217 => 64,  209 => 59,  205 => 58,  199 => 54,  192 => 53,  181 => 51,  170 => 46,  166 => 45,  156 => 38,  150 => 35,  143 => 31,  138 => 29,  134 => 28,  130 => 27,  126 => 26,  120 => 22,  113 => 21,  98 => 18,  94 => 17,  90 => 16,  86 => 15,  80 => 12,  75 => 10,  70 => 9,  63 => 8,  58 => 1,  56 => 6,  54 => 5,  52 => 4,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/promotion_reseau_detail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/promotion_reseau_detail.html.twig");
    }
}
