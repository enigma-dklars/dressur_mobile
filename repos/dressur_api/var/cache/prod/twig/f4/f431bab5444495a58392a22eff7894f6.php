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

/* public/services.html.twig */
class __TwigTemplate_f993e794092749aeaf05a44ffb456ef4 extends Template
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
        $context["title"] = "Nos Services";
        // line 4
        $context["description"] = "Découvrez tous les services proposés par Dressur : Boost Contact, Dressur Bot, Promotion Affaire, Promotion Réseaux Sociaux et bien plus encore.";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-dressur.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_services");
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
    <meta name=\"description\" content=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, services, Boost Contact, Dressur Bot, Promotion Affaire, Réseaux Sociaux, WhatsApp, marketing digital\">
";
        yield from [];
    }

    // line 19
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 20
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"ItemList\",
  \"name\": \"Services Dressur\",
  \"description\": \"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_services");
        yield "\",
  \"numberOfItems\": 5,
  \"itemListElement\": [
    { \"@type\": \"ListItem\", \"position\": 1, \"item\": { \"@type\": \"Service\", \"@id\": \"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "#service\", \"name\": \"Boost Contact\", \"description\": \"Trouvez de nouveaux contacts qualifiés grâce à nos algorithmes intelligents.\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "\", \"provider\": {\"@type\": \"Organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\"}, \"offers\": {\"@type\": \"Offer\", \"price\": \"0\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\"} } },
    { \"@type\": \"ListItem\", \"position\": 2, \"item\": { \"@type\": \"SoftwareApplication\", \"@id\": \"";
        // line 30
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "#software\", \"name\": \"Dressur Bot\", \"description\": \"Application Windows pour automatiser l\x27envoi de messages sur WhatsApp.\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "\", \"operatingSystem\": \"Windows\", \"applicationCategory\": \"BusinessApplication\", \"provider\": {\"@type\": \"Organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\"} } },
    { \"@type\": \"ListItem\", \"position\": 3, \"item\": { \"@type\": \"Service\", \"@id\": \"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "#service\", \"name\": \"Promotion Affaire\", \"description\": \"Promouvez vos produits, services, offres d\x27emploi et événements auprès d\x27un public ciblé.\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "\", \"provider\": {\"@type\": \"Organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\"}, \"offers\": {\"@type\": \"Offer\", \"price\": \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("min_price_affaire", $context)) ? (Twig\Extension\CoreExtension::default(($context["min_price_affaire"] ?? null), "500")) : ("500")), "html", null, true);
        yield "\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\"} } },
    { \"@type\": \"ListItem\", \"position\": 4, \"item\": { \"@type\": \"Service\", \"@id\": \"";
        // line 32
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "#service\", \"name\": \"Promotion Réseaux Sociaux\", \"description\": \"Achetez des abonnés, likes, commentaires et partages sur Facebook, TikTok, Instagram, YouTube.\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\", \"provider\": {\"@type\": \"Organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\"}, \"offers\": {\"@type\": \"Offer\", \"price\": \"100\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\"} } },
    { \"@type\": \"ListItem\", \"position\": 5, \"item\": { \"@type\": \"Service\", \"@id\": \"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_actualite");
        yield "#service\", \"name\": \"Actualités & Marketplace\", \"description\": \"Parcourez les dernières annonces et actualités de la communauté Dressur.\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_actualite");
        yield "\", \"provider\": {\"@type\": \"Organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\"}, \"offers\": {\"@type\": \"Offer\", \"price\": \"0\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\"} } }
  ]
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Nos Services\",\"item\":\"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_services");
        yield "\"}]}
</script>
";
        yield from [];
    }

    // line 42
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 44
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 45
        yield "<style>
    .page-hero {
        background: linear-gradient(135deg, #0f2460 0%, #1a3a8f 50%, #1565c0 100%);
        padding: 60px 0 48px;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content:\x27\x27;
        position:absolute;
        top:-80px; right:-80px;
        width:300px; height:300px;
        border-radius:50%;
        background:rgba(255,255,255,0.04);
        pointer-events:none;
    }
    .page-hero::after {
        content:\x27\x27;
        position:absolute;
        bottom:-60px; left:-60px;
        width:220px; height:220px;
        border-radius:50%;
        background:rgba(255,255,255,0.03);
        pointer-events:none;
    }
    .page-hero-breadcrumb {
        display:flex; align-items:center; gap:8px;
        font-size:0.82rem; color:rgba(255,255,255,0.6); margin-bottom:14px;
    }
    .page-hero-breadcrumb a { color:rgba(255,255,255,0.7); text-decoration:none; }
    .page-hero-breadcrumb a:hover { color:#fff; }
    .page-hero h1 { color:#fff; font-weight:800; font-size:clamp(1.9rem,4vw,2.8rem); margin-bottom:10px; }
    .page-hero p { color:rgba(255,255,255,0.78); font-size:1.05rem; max-width:580px; margin-bottom:28px; }
    .page-hero .hero-actions { display:flex; gap:12px; flex-wrap:wrap; }
    .btn-hero-primary {
        background:#fff; color:#0f2460; border:none; border-radius:50px;
        padding:11px 28px; font-weight:700; font-size:0.92rem;
        text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:7px;
        box-shadow:0 4px 16px rgba(0,0,0,0.15);
    }
    .btn-hero-primary:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.2); color:#0f2460; }
    .btn-hero-outline {
        background:transparent; color:#fff; border:2px solid rgba(255,255,255,0.5);
        border-radius:50px; padding:11px 28px; font-weight:700; font-size:0.92rem;
        text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center; gap:7px;
    }
    .btn-hero-outline:hover { border-color:#fff; background:rgba(255,255,255,0.08); color:#fff; }

    /* Section */
    .section-tag {
        display:inline-block; background:#e8f0fe; color:#1a3a8f;
        font-size:0.75rem; font-weight:700; text-transform:uppercase;
        letter-spacing:0.8px; padding:4px 14px; border-radius:50px; margin-bottom:10px;
    }
    html.dark-theme .section-tag { background:#1a3a8f; color:#e8f0fe; }
    .section-title { font-weight:800; color:#0f2460; font-size:clamp(1.4rem,3vw,2rem); margin-bottom:8px; }
    html.dark-theme .section-title { color:#fcfcfc; }
    .section-desc { color:#6c757d; font-size:0.95rem; max-width:520px; margin:0 auto; }
    html.dark-theme .section-desc { color:#9ea4aa; }

    /* Service cards */
    .svc-card {
        background:#fff;
        border-radius:20px;
        padding:32px 24px;
        border:1.5px solid #f1f3f9;
        box-shadow:0 2px 16px rgba(0,0,0,0.05);
        transition:all 0.3s;
        height:100%;
        display:flex; flex-direction:column; align-items:center; text-align:center;
        position:relative;
        overflow:hidden;
    }
    html.dark-theme .svc-card { background:#202a40; border-color:#2e3a55; box-shadow:none; }
    .svc-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(26,58,143,0.12); border-color:#d0dcff; }
    html.dark-theme .svc-card:hover { box-shadow:0 16px 40px rgba(79,195,247,0.08); border-color:#4fc3f7; }
    .svc-card-accent {
        position:absolute; top:0; left:0; right:0; height:4px;
        border-radius:20px 20px 0 0;
    }
    .svc-icon {
        width:68px; height:68px; border-radius:18px;
        display:flex; align-items:center; justify-content:center;
        font-size:1.6rem; margin-bottom:18px; flex-shrink:0;
    }
    .svc-title {
        font-size:1.1rem; font-weight:800; color:#0f2460; margin-bottom:10px;
        text-decoration:none; display:block;
    }
    html.dark-theme .svc-title { color:#fcfcfc; }
    .svc-title:hover { color:#1a3a8f; }
    html.dark-theme .svc-title:hover { color:#4fc3f7; }
    .svc-desc { font-size:0.87rem; color:#6c757d; line-height:1.6; flex:1; margin-bottom:20px; }
    html.dark-theme .svc-desc { color:#9ea4aa; }
    .svc-badges { display:flex; gap:6px; flex-wrap:wrap; justify-content:center; margin-bottom:18px; }
    .svc-badge {
        font-size:0.74rem; font-weight:700; padding:3px 10px; border-radius:50px;
        display:inline-flex; align-items:center; gap:4px;
    }
    .badge-free  { background:#d1fae5; color:#065f46; }
    .badge-paid  { background:#fff3e0; color:#c2410c; }
    .badge-win   { background:#dbeafe; color:#1d4ed8; }
    html.dark-theme .badge-free { background:rgba(16,185,129,0.15); color:#34d399; }
    html.dark-theme .badge-paid { background:rgba(245,158,11,0.15); color:#fbbf24; }
    html.dark-theme .badge-win  { background:rgba(59,130,246,0.15); color:#60a5fa; }
    .btn-svc {
        display:inline-flex; align-items:center; gap:6px;
        background:linear-gradient(135deg,#0f2460,#1a3a8f);
        color:#fff; border:none; border-radius:50px;
        padding:9px 22px; font-weight:700; font-size:0.85rem;
        text-decoration:none; transition:all 0.2s;
        box-shadow:0 4px 12px rgba(26,58,143,0.25);
    }
    .btn-svc:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(26,58,143,0.35); color:#fff; }

    /* CTA bottom */
    .cta-strip {
        background:linear-gradient(135deg,#0f2460,#1a3a8f);
        border-radius:24px; padding:48px 36px; text-align:center;
    }
    .cta-strip h2 { color:#fff; font-weight:800; margin-bottom:10px; }
    .cta-strip p  { color:rgba(255,255,255,0.78); margin-bottom:24px; font-size:1rem; }
</style>
";
        yield from [];
    }

    // line 170
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 171
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 175
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Nos Services</span>
        </div>
        <h1><i class=\"fas fa-grid-2 me-2\" style=\"opacity:.7\"></i> Nos Services</h1>
        <p>Découvrez l\x27ensemble des solutions Dressur pour développer votre réseau, promouvoir vos activités et automatiser vos communications.</p>
        <div class=\"hero-actions\">
            <a href=\"";
        // line 182
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn-hero-primary\"><i class=\"fas fa-tags\"></i> Voir les tarifs</a>
            <a href=\"";
        // line 183
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn-hero-outline\"><i class=\"fas fa-user-plus\"></i> S\x27inscrire gratuitement</a>
        </div>
    </div>
</div>

<div class=\"container my-5\">

    <div class=\"text-center mb-5\">
        <span class=\"section-tag\">Ce que Dressur vous offre</span>
        <h2 class=\"section-title\">5 services pour booster votre activité</h2>
        <p class=\"section-desc\">Cliquez sur un service pour découvrir ses fonctionnalités et tarifs.</p>
    </div>

    <div class=\"row g-4\">

        ";
        // line 199
        yield "        <div class=\"col-md-6 col-lg-4 d-flex\">
            <div class=\"svc-card\">
                <div class=\"svc-card-accent\" style=\"background:linear-gradient(90deg,#059669,#34d399);\"></div>
                <div class=\"svc-icon\" style=\"background:#d1fae5; color:#059669;\"><i class=\"fas fa-users\"></i></div>
                <a href=\"";
        // line 203
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"svc-title\">Boost Contact</a>
                <p class=\"svc-desc\">Trouvez de nouveaux contacts qualifiés grâce à nos algorithmes intelligents. Vos contacts s\x27enregistrent mutuellement et automatiquement dans vos téléphones.</p>
                <div class=\"svc-badges\">
                    <span class=\"svc-badge badge-free\"><i class=\"fas fa-check\"></i> Gratuit</span>
                    <span class=\"svc-badge badge-paid\">À partir de 100 FCFA</span>
                </div>
                <a href=\"";
        // line 209
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"btn-svc\">Découvrir <i class=\"fas fa-arrow-right\"></i></a>
            </div>
        </div>

        ";
        // line 214
        yield "        <div class=\"col-md-6 col-lg-4 d-flex\">
            <div class=\"svc-card\">
                <div class=\"svc-card-accent\" style=\"background:linear-gradient(90deg,#1d4ed8,#60a5fa);\"></div>
                <div class=\"svc-icon\" style=\"background:#dbeafe; color:#1d4ed8;\"><i class=\"fas fa-robot\"></i></div>
                <a href=\"";
        // line 218
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"svc-title\">Dressur Bot</a>
                <p class=\"svc-desc\">Application Windows pour automatiser l\x27envoi de messages sur WhatsApp Web et WhatsApp Desktop. Envoyez à plus d\x271 million de contacts sans bug.</p>
                <div class=\"svc-badges\">
                    <span class=\"svc-badge badge-win\"><i class=\"fab fa-windows\"></i> Windows</span>
                    <span class=\"svc-badge badge-paid\">Payant</span>
                </div>
                <a href=\"";
        // line 224
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"btn-svc\">Découvrir <i class=\"fas fa-arrow-right\"></i></a>
            </div>
        </div>

        ";
        // line 229
        yield "        <div class=\"col-md-6 col-lg-4 d-flex\">
            <div class=\"svc-card\">
                <div class=\"svc-card-accent\" style=\"background:linear-gradient(90deg,#c2410c,#fb923c);\"></div>
                <div class=\"svc-icon\" style=\"background:#fff3e0; color:#c2410c;\"><i class=\"fas fa-bullhorn\"></i></div>
                <a href=\"";
        // line 233
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"svc-title\">Promotion Affaire</a>
                <p class=\"svc-desc\">Promouvez vos produits, services, offres d\x27emploi et événements auprès d\x27un public ciblé. Vos annonces sont aussi référencées sur Google.</p>
                <div class=\"svc-badges\">
                    <span class=\"svc-badge badge-paid\">À partir de ";
        // line 236
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("min_price_affaire", $context)) ? (Twig\Extension\CoreExtension::default(($context["min_price_affaire"] ?? null), "500")) : ("500")), "html", null, true);
        yield " FCFA</span>
                </div>
                <a href=\"";
        // line 238
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"btn-svc\">Découvrir <i class=\"fas fa-arrow-right\"></i></a>
            </div>
        </div>

        ";
        // line 243
        yield "        <div class=\"col-md-6 col-lg-4 d-flex\">
            <div class=\"svc-card\">
                <div class=\"svc-card-accent\" style=\"background:linear-gradient(90deg,#7c3aed,#c084fc);\"></div>
                <div class=\"svc-icon\" style=\"background:#f3e8ff; color:#7c3aed;\"><i class=\"fas fa-thumbs-up\"></i></div>
                <a href=\"";
        // line 247
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"svc-title\">Promotions Réseaux Sociaux</a>
                <p class=\"svc-desc\">Achetez des abonnés, likes, commentaires et partages sur Facebook, TikTok, Instagram, YouTube, Telegram et bien d\x27autres plateformes.</p>
                <div class=\"svc-badges\">
                    <span class=\"svc-badge badge-paid\">À partir de 100 FCFA</span>
                </div>
                <a href=\"";
        // line 252
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"btn-svc\">Découvrir <i class=\"fas fa-arrow-right\"></i></a>
            </div>
        </div>

        ";
        // line 257
        yield "        <div class=\"col-md-6 col-lg-4 d-flex\">
            <div class=\"svc-card\">
                <div class=\"svc-card-accent\" style=\"background:linear-gradient(90deg,#0284c7,#38bdf8);\"></div>
                <div class=\"svc-icon\" style=\"background:#e0f2fe; color:#0284c7;\"><i class=\"fas fa-newspaper\"></i></div>
                <a href=\"";
        // line 261
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_actualite");
        yield "\" class=\"svc-title\">Actualités &amp; Marketplace</a>
                <p class=\"svc-desc\">Parcourez les dernières annonces, offres d\x27emploi, opportunités d\x27affaires et actualités publiées par la communauté Dressur.</p>
                <div class=\"svc-badges\">
                    <span class=\"svc-badge badge-free\"><i class=\"fas fa-check\"></i> Gratuit</span>
                </div>
                <a href=\"";
        // line 266
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_actualite");
        yield "\" class=\"btn-svc\">Parcourir <i class=\"fas fa-arrow-right\"></i></a>
            </div>
        </div>

    </div>

    ";
        // line 273
        yield "    <div class=\"cta-strip mt-5\">
        <h2>Prêt à développer votre activité ?</h2>
        <p>Rejoignez des milliers d\x27utilisateurs qui font confiance à Dressur chaque jour.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\"
               class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-google-play text-success me-2\"></i> Télécharger sur Google Play
            </a>
            <a href=\"";
        // line 281
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-user-plus me-2\"></i> S\x27inscrire gratuitement
            </a>
        </div>
    </div>

</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/services.html.twig";
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
        return array (  480 => 281,  470 => 273,  461 => 266,  453 => 261,  447 => 257,  440 => 252,  432 => 247,  426 => 243,  419 => 238,  414 => 236,  408 => 233,  402 => 229,  395 => 224,  386 => 218,  380 => 214,  373 => 209,  364 => 203,  358 => 199,  340 => 183,  336 => 182,  326 => 175,  320 => 171,  313 => 170,  185 => 45,  178 => 44,  167 => 42,  159 => 38,  149 => 33,  143 => 32,  135 => 31,  129 => 30,  123 => 29,  117 => 26,  113 => 25,  106 => 20,  99 => 19,  91 => 15,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/services.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/services.html.twig");
    }
}
