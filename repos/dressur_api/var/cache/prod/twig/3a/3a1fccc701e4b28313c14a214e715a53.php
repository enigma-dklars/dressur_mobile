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

/* public/actualite.html.twig */
class __TwigTemplate_3c04b3392f6fe189590700461125a3b2 extends Template
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
            'style' => [$this, 'block_style'],
            'body' => [$this, 'block_body'],
            'script' => [$this, 'block_script'],
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
        $context["description"] = "Découvrez les derniers produits, services et propositions des utilisateurs de Dressur. Restez informé sur les nouveautés et les initiatives au sein de notre communauté.";
        // line 4
        $context["title"] = "Actualités";
        // line 1
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    <meta property=\"og:title\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta property=\"og:description\" content=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-actualite.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_actualite");
        yield "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-actualite.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"actualités Dressur, nouveautés Dressur, promotions Dressur, annonces Dressur, communauté Dressur, produits Dressur, services Dressur\" />
";
        yield from [];
    }

    // line 20
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 21
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"CollectionPage\",
  \"name\": \"Actualités Dressur\",
  \"description\": \"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_actualite");
        yield "\",
  \"publisher\": { \"@type\": \"Organization\", \"name\": \"Dressur\", \"@id\": \"https://dressur.site/#organization\" },
  \"mainEntity\": {
    \"@type\": \"ItemList\",
    \"name\": \"Promotions Affaires des utilisateurs Dressur\",
    \"itemListElement\": [
      ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["actus"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["actu"]) {
            // line 34
            yield "      { \"@type\": \"ListItem\", \"position\": ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 34), "html", null, true);
            yield ", \"url\": \"https://dressur.site/actualite/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 34), "html", null, true);
            yield "\", \"name\": \"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 34), "js"), "html", null, true);
            yield " — Promotion Dressur\" }";
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 34)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield ",";
            }
            // line 35
            yield "      ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['actu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "    ]
  }
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Actualités\",\"item\":\"";
        // line 41
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_actualite");
        yield "\"}]}
</script>
";
        yield from [];
    }

    // line 45
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 47
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 48
        yield "<style>
    .page-hero {
        background: linear-gradient(135deg, #0f2460 0%, #1a3a8f 50%, #1565c0 100%);
        padding: 52px 0 40px;
        position: relative;
        overflow: hidden;
    }
    .page-hero::after {
        content: \x27\x27;
        position: absolute;
        bottom: -40px; right: -40px;
        width: 240px; height: 240px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        pointer-events: none;
    }
    .page-hero-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.6);
        margin-bottom: 12px;
    }
    .page-hero-breadcrumb a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .page-hero-breadcrumb a:hover { color: #fff; }
    .page-hero h1 { color: #fff; font-weight: 800; font-size: clamp(1.8rem,4vw,2.6rem); margin-bottom: 8px; }
    .page-hero p  { color: rgba(255,255,255,0.75); font-size: 1rem; margin: 0; }
    .page-hero .badge-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 14px;
    }

    /* Cards */
    .actu-card {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 3px 16px rgba(0,0,0,0.08);
        transition: all 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    html.dark-theme .actu-card {
        background: #202a40;
        box-shadow: 0 3px 16px rgba(0,0,0,0.25);
    }
    .actu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 36px rgba(0,0,0,0.13);
    }
    html.dark-theme .actu-card:hover { box-shadow: 0 14px 36px rgba(0,0,0,0.4); }
    .actu-card .card-img-top {
        height: 200px;
        object-fit: cover;
        display: block;
        width: 100%;
        cursor: pointer;
    }
    .actu-card .card-body { flex: 1; padding: 16px; }
    .actu-small-description {
        font-size: 0.87rem;
        color: #374151;
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 14px;
        min-height: 60px;
        cursor: pointer;
    }
    html.dark-theme .actu-small-description { color: #c8cdd4; }
    .actu-app-description {
        font-size: 0.87rem;
        color: #374151;
        line-height: 1.55;
        margin-bottom: 14px;
    }
    html.dark-theme .actu-app-description { color: #c8cdd4; }
    .actu-meta {
        font-size: 0.79rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .actu-meta i { color: #1a3a8f; }
    html.dark-theme .actu-meta i { color: #4fc3f7; }
    .actu-actions { display: flex; gap: 6px; }
    .btn-wa {
        background: #25d366;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 0.82rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: opacity 0.2s;
    }
    .btn-wa:hover { opacity: 0.85; color: #fff; }
    .btn-see {
        background: #e8f0fe;
        color: #1a3a8f;
        border: none;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }
    html.dark-theme .btn-see { background: rgba(79,195,247,0.15); color: #4fc3f7; }
    .btn-see:hover { background: #1a3a8f; color: #fff; }
    html.dark-theme .btn-see:hover { background: #4fc3f7; color: #0f2460; }
    .btn-share {
        background: transparent;
        border: 1.5px solid #dee2e6;
        border-radius: 8px;
        padding: 5px 9px;
        font-size: 0.82rem;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.2s;
    }
    html.dark-theme .btn-share { border-color: #2e3a55; color: #9ea4aa; }
    .btn-share:hover { border-color: #1a3a8f; color: #1a3a8f; }
    html.dark-theme .btn-share:hover { border-color: #4fc3f7; color: #4fc3f7; }

    /* End / loader */
    .actu-end-msg {
        text-align: center;
        padding: 28px 0;
        color: #9ca3af;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .actu-end-msg::before, .actu-end-msg::after {
        content: \x27\x27;
        flex: 1;
        max-width: 80px;
        height: 1px;
        background: #e5e7eb;
    }
    html.dark-theme .actu-end-msg { color: #6b7280; }
    html.dark-theme .actu-end-msg::before,
    html.dark-theme .actu-end-msg::after { background: #2e3a55; }
</style>
";
        yield from [];
    }

    // line 216
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 217
        yield "
";
        // line 219
        yield "<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 222
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Actualités</span>
        </div>
        <h1><i class=\"fas fa-newspaper me-2\" style=\"opacity:.7\"></i> Actualités</h1>
        <p>Produits, services et annonces de notre communauté</p>
        <div class=\"badge-count\"><i class=\"fas fa-layer-group\"></i> ";
        // line 228
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["total"] ?? null), "html", null, true);
        yield " annonce";
        yield (((($context["total"] ?? null) > 1)) ? ("s") : (""));
        yield " disponible";
        yield (((($context["total"] ?? null) > 1)) ? ("s") : (""));
        yield "</div>
    </div>
</div>

";
        // line 233
        yield "<div class=\"container my-5\">
    <div class=\"row g-4\" id=\"actualite-grid\" data-offset=\"12\" data-total=\"";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["total"] ?? null), "html", null, true);
        yield "\">
        ";
        // line 235
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["actus"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["actu"]) {
            // line 236
            yield "            ";
            $context["isSiteApplication"] = (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 236) == "sites_applications");
            // line 237
            yield "            ";
            $context["siteAppName"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", true, true, false, 237)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nomSiteApp", [], "any", false, false, false, 237), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 237))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nom", [], "any", false, false, false, 237))), "");
            // line 238
            yield "            ";
            $context["siteAppUrl"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", true, true, false, 238)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "urlSiteApp", [], "any", false, false, false, 238), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 238))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "url", [], "any", false, false, false, 238))), "");
            // line 239
            yield "            ";
            $context["siteAppSubtype"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", true, true, false, 239)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousTypeSiteApp", [], "any", false, false, false, 239), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 239))) : (CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "sousType", [], "any", false, false, false, 239))), "");
            // line 240
            yield "            ";
            $context["waText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                yield "Bonjour/Bonsoir *";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 240), "html", null, true);
                yield "*, j\x27ai une question concernant la promotion ci-dessous: ";
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 240)) >= 100)) {
                    yield "<<";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 240), 0, 100), "html", null, true);
                    yield "...>>";
                } else {
                    yield "<<";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 240), "html", null, true);
                    yield ">>";
                }
                yield " *Depuis Dressur.* ";
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 241
            yield "            ";
            $context["waUrl"] = ((("https://wa.me/" . CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "whatsappNumber", [], "any", false, false, false, 241)) . "?text=") . Twig\Extension\CoreExtension::urlencode(($context["waText"] ?? null)));
            // line 242
            yield "            ";
            $context["altText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 242) == "offre_emploi")) {
                    yield "Offre d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 242), "titre_demande_poste_rechercher", [], "any", true, true, false, 242) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "titre_demande_poste_rechercher", [], "any", false, false, false, 242))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "titre_demande_poste_rechercher", [], "any", false, false, false, 242), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 242), "lieu_travail", [], "any", true, true, false, 242) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "lieu_travail", [], "any", false, false, false, 242))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "lieu_travail", [], "any", false, false, false, 242), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 242), "html", null, true);
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 242) == "dmd_emploi")) {
                    yield "Demande d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 242), "titre_demande_poste_rechercher", [], "any", true, true, false, 242) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "titre_demande_poste_rechercher", [], "any", false, false, false, 242))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "titre_demande_poste_rechercher", [], "any", false, false, false, 242), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 242), "localisation_souhaite", [], "any", true, true, false, 242) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "localisation_souhaite", [], "any", false, false, false, 242))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 242), "localisation_souhaite", [], "any", false, false, false, 242), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 242), "html", null, true);
                } else {
                    yield "Promotion produit / service — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 242), "html", null, true);
                }
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 243
            yield "
            <div class=\"col-md-4\">
                <div class=\"actu-card card mb-0\">
                    <a href=\"/actualite/";
            // line 246
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 246), "html", null, true);
            yield "\">
                        <img src=\"/assets/images/placeholder.png\"
                             data-original=\"/promotion/";
            // line 248
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "image", [], "any", false, false, false, 248), "html", null, true);
            yield "\"
                             class=\"lazy card-img-top image-actu\"
                             alt=\"";
            // line 250
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(($context["altText"] ?? null)), "html", null, true);
            yield "\"
                             loading=\"lazy\" width=\"400\" height=\"200\">
                    </a>
                    <div class=\"card-body d-flex flex-column\">
                        ";
            // line 254
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 255
                yield "                            <h2 class=\"h5 mb-1\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
                yield "</h2>
                            <div class=\"text-muted small mb-2\">
                                ";
                // line 257
                if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                    yield "Site web
                                ";
                } elseif ((                // line 258
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                    yield "Application mobile
                                ";
                } elseif ((                // line 259
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                    yield "Logiciel desktop
                                ";
                } else {
                    // line 260
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppSubtype"] ?? null), "html", null, true);
                }
                // line 261
                yield "                            </div>
                            <div class=\"actu-app-description\">";
                // line 262
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 262), "html", null, true));
                yield "</div>
                        ";
            } else {
                // line 264
                yield "                            <p class=\"actu-small-description\">
                                ";
                // line 265
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 265) == "produit_service")) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 265), "html", null, true);
                }
                // line 266
                yield "                                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 266) == "offre_emploi")) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 266), "description_poste", [], "any", false, false, false, 266), "html", null, true);
                }
                // line 267
                yield "                                ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 267) == "dmd_emploi")) {
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 267), "description_profil_demandeur", [], "any", false, false, false, 267), "html", null, true);
                }
                // line 268
                yield "                            </p>
                        ";
            }
            // line 270
            yield "                        <div class=\"d-flex align-items-center justify-content-between mt-auto\">
                            ";
            // line 271
            if ((($tmp =  !($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 272
                yield "                                <div class=\"actu-meta\">
                                    <span><i class=\"fas fa-eye me-1\"></i>";
                // line 273
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreImpression", [], "any", false, false, false, 273), "html", null, true);
                yield "</span>
                                    <span><i class=\"fas fa-hand-pointer me-1\"></i>";
                // line 274
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreDeVues", [], "any", false, false, false, 274), "html", null, true);
                yield "</span>
                                </div>
                            ";
            } else {
                // line 277
                yield "                                <div></div>
                            ";
            }
            // line 279
            yield "                            <div class=\"actu-actions\">
                                ";
            // line 280
            if ((($tmp =  !($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 281
                yield "                                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["waUrl"] ?? null), "html", null, true);
                yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn-wa\"><i class=\"fab fa-whatsapp\"></i></a>
                                ";
            }
            // line 283
            yield "                                <button class=\"btn-share ds-share-btn\"
                                    data-share-url=\"https://dressur.site/actualite/";
            // line 284
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 284), "html", null, true);
            yield "\"
                                    data-share-title=\"";
            // line 285
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 285), "html", null, true);
                yield " — Dressur";
            }
            yield "\"
                                    data-share-text=\"";
            // line 286
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 286), 0, 100), "html", null, true);
            yield "\">
                                    <i class=\"fas fa-share-nodes\"></i>
                                </button>
                                ";
            // line 289
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 290
                yield "                                    ";
                if ((($tmp = ($context["siteAppUrl"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 291
                    yield "                                        <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppUrl"] ?? null), "html_attr");
                    yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn-see\">
                                            ";
                    // line 292
                    if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                        yield "Ouvrir
                                            ";
                    } elseif ((                    // line 293
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                        yield "Télécharger
                                            ";
                    } elseif ((                    // line 294
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                        yield "Savoir plus
                                            ";
                    }
                    // line 296
                    yield "                                            <i class=\"fas fa-external-link-alt\"></i>
                                        </a>
                                    ";
                }
                // line 299
                yield "                                ";
            } else {
                // line 300
                yield "                                    <a href=\"/actualite/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 300), "html", null, true);
                yield "\" class=\"btn-see\">Voir <i class=\"fas fa-arrow-right\"></i></a>
                                ";
            }
            // line 302
            yield "                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['actu'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 308
        yield "    </div>

    <div id=\"actualite-loader\" class=\"text-center py-5\" style=\"display:none;\">
        <div class=\"spinner-border text-primary\" role=\"status\">
            <span class=\"visually-hidden\">Chargement…</span>
        </div>
    </div>
    <div id=\"actualite-end\" class=\"actu-end-msg\" style=\"display:none;\">Fin des actualités</div>
</div>
";
        yield from [];
    }

    // line 319
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 320
        yield "<script>
(function () {
    var grid    = document.getElementById(\x27actualite-grid\x27);
    var loader  = document.getElementById(\x27actualite-loader\x27);
    var endMsg  = document.getElementById(\x27actualite-end\x27);
    if (!grid) return;
    var offset  = parseInt(grid.dataset.offset, 10) || 12;
    var total   = parseInt(grid.dataset.total, 10)  || 0;
    var loading = false;
    var done    = offset >= total;
    if (done) { endMsg.style.display = \x27flex\x27; }
    function loadMore() {
        if (loading || done) return;
        loading = true;
        loader.style.display = \x27block\x27;
        \$.ajax({
            url: \x27/actualite/more\x27, type: \x27GET\x27, data: { offset: offset },
            success: function (html, status, xhr) {
                loader.style.display = \x27none\x27;
                \$(grid).append(html);
                offset += 12;
                grid.dataset.offset = offset;
                if (xhr.getResponseHeader(\x27X-Has-More\x27) === \x270\x27 || offset >= total) {
                    done = true;
                    endMsg.style.display = \x27flex\x27;
                }
                loading = false;
            },
            error: function () { loader.style.display = \x27none\x27; loading = false; }
        });
    }
    \$(window).on(\x27scroll\x27, function () {
        if (done || loading) return;
        if (\$(window).scrollTop() + \$(window).height() >= \$(document).height() - 300) { loadMore(); }
    });
    if (window._dsShareReady) return;
    window._dsShareReady = true;
    document.addEventListener(\x27click\x27, async function (e) {
        var btn = e.target.closest(\x27.ds-share-btn\x27);
        if (!btn) return;
        var shareData = { title: btn.dataset.shareTitle, text: btn.dataset.shareText, url: btn.dataset.shareUrl };
        if (navigator.share) {
            try { await navigator.share(shareData); } catch (err) {}
        } else {
            try {
                await navigator.clipboard.writeText(btn.dataset.shareUrl);
                var orig = btn.innerHTML;
                btn.innerHTML = \x27<i class=\"fas fa-check\"></i>\x27;
                setTimeout(function () { btn.innerHTML = orig; }, 2000);
            } catch (err) { window.open(btn.dataset.shareUrl, \x27_blank\x27); }
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
        return "public/actualite.html.twig";
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
        return array (  687 => 320,  680 => 319,  666 => 308,  655 => 302,  649 => 300,  646 => 299,  641 => 296,  636 => 294,  632 => 293,  628 => 292,  623 => 291,  620 => 290,  618 => 289,  612 => 286,  603 => 285,  599 => 284,  596 => 283,  590 => 281,  588 => 280,  585 => 279,  581 => 277,  575 => 274,  571 => 273,  568 => 272,  566 => 271,  563 => 270,  559 => 268,  554 => 267,  549 => 266,  545 => 265,  542 => 264,  537 => 262,  534 => 261,  531 => 260,  526 => 259,  522 => 258,  518 => 257,  512 => 255,  510 => 254,  503 => 250,  498 => 248,  493 => 246,  488 => 243,  453 => 242,  450 => 241,  432 => 240,  429 => 239,  426 => 238,  423 => 237,  420 => 236,  416 => 235,  412 => 234,  409 => 233,  398 => 228,  389 => 222,  384 => 219,  381 => 217,  374 => 216,  203 => 48,  196 => 47,  185 => 45,  177 => 41,  170 => 36,  156 => 35,  145 => 34,  128 => 33,  119 => 27,  115 => 26,  108 => 21,  101 => 20,  93 => 16,  88 => 14,  84 => 13,  78 => 10,  73 => 8,  68 => 7,  61 => 6,  56 => 1,  54 => 4,  52 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/actualite.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/actualite.html.twig");
    }
}
