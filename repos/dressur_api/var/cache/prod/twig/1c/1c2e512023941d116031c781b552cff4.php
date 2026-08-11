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

/* public/index.html.twig */
class __TwigTemplate_4e0898cdad966cbaf095773d69413ebd extends Template
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
        $context["description"] = "Découvrez Dressur, la solution mobile et web qui vous permet de gérer vos compétences et de garantir une grande visibilité. Téléchargez l\x27application et inscrivez-vous dès aujourd\x27hui !";
        // line 4
        $context["title"] = "Accueil";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-accueil.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_public");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-accueil.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, actualités Dressur, produits Dressur, services Dressur, promotions, annonces utilisateurs, gestion compétences, visibilité, réseau social, marketing digital\">
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
  \"@graph\": [
    {
      \"@type\": \"Organization\",
      \"@id\": \"https://dressur.site/#organization\",
      \"name\": \"Dressur\",
      \"url\": \"https://dressur.site\",
      \"logo\": \"https://dressur.site/assets/images/dressur_logo_blanc.png\",
      \"sameAs\": [
        \"https://www.facebook.com/dressurds\",
        \"https://play.google.com/store/apps/details?id=com.dressur.ds\"
      ],
      \"contactPoint\": {
        \"@type\": \"ContactPoint\",
        \"telephone\": \"+229-64-04-42-94\",
        \"contactType\": \"customer service\",
        \"availableLanguage\": [\"French\"]
      }
    },
    {
      \"@type\": \"WebSite\",
      \"@id\": \"https://dressur.site/#website\",
      \"url\": \"https://dressur.site\",
      \"name\": \"Dressur\",
      \"description\": \"";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
      \"publisher\": { \"@id\": \"https://dressur.site/#organization\" },
      \"inLanguage\": \"fr\"
    },
    {
      \"@type\": \"MobileApplication\",
      \"name\": \"Dressur\",
      \"operatingSystem\": \"Android\",
      \"applicationCategory\": \"BusinessApplication\",
      \"description\": \"Application mobile Dressur — gérez vos compétences, trouvez des contacts et promouvez vos affaires en Afrique de l\x27Ouest.\",
      \"url\": \"https://play.google.com/store/apps/details?id=com.dressur.ds\",
      \"publisher\": { \"@id\": \"https://dressur.site/#organization\" }
    },
    {
      \"@type\": \"ItemList\",
      \"name\": \"Services Dressur\",
      \"itemListElement\": [
        { \"@type\": \"ListItem\", \"position\": 1, \"name\": \"Boost Contact\", \"url\": \"";
        // line 64
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "\" },
        { \"@type\": \"ListItem\", \"position\": 2, \"name\": \"Promotion Affaire\", \"url\": \"";
        // line 65
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "\" },
        { \"@type\": \"ListItem\", \"position\": 3, \"name\": \"Promotions Réseaux Sociaux\", \"url\": \"";
        // line 66
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\" },
        { \"@type\": \"ListItem\", \"position\": 4, \"name\": \"Dressur Bot\", \"url\": \"";
        // line 67
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "\" }
      ]
    }
  ]
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"}]}
</script>
";
        yield from [];
    }

    // line 78
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 81
        yield "<style>
    /* ══════════════════════════════════════
       HERO
    ══════════════════════════════════════ */
    .hero-section {
        background: linear-gradient(135deg, #0f2460 0%, #1a3a8f 50%, #1565c0 100%);
        min-height: 88vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: \x27\x27;
        position: absolute;
        top: -50%; right: -10%;
        width: 600px; height: 600px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        pointer-events: none;
    }
    .hero-section::after {
        content: \x27\x27;
        position: absolute;
        bottom: -30%; left: -5%;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);
        pointer-events: none;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        backdrop-filter: blur(4px);
        margin-bottom: 20px;
    }
    .hero-title {
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 16px;
    }
    .hero-title span {
        background: linear-gradient(90deg, #4fc3f7, #81d4fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-subtitle {
        color: rgba(255,255,255,0.8);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 10px;
    }
    .hero-animated-tag {
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255,255,255,0.9);
        margin-bottom: 32px;
        min-height: 28px;
    }
    .hero-animated-tag span { color: #4fc3f7; }
    .btn-hero-primary {
        background: #fff;
        color: #1a3a8f;
        border: none;
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    .btn-hero-primary:hover {
        background: #e3f2fd;
        color: #0d47a1;
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(0,0,0,0.25);
    }
    .btn-hero-outline {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 2px solid rgba(255,255,255,0.35);
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        backdrop-filter: blur(4px);
    }
    .btn-hero-outline:hover {
        background: rgba(255,255,255,0.2);
        color: #fff;
        border-color: rgba(255,255,255,0.6);
        transform: translateY(-2px);
    }
    /* FIX: image complète, pas de crop */
    .hero-image-wrap img {
        border-radius: 20px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        width: 100%;
        height: auto;
        display: block;
    }

    /* ══════════════════════════════════════
       STATS BAR
    ══════════════════════════════════════ */
    .stats-bar {
        padding: 0;
        position: relative;
        z-index: 2;
    }
    .stats-inner {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.12);
        padding: 28px 36px;
        margin-top: -36px;
        position: relative;
    }
    .stat-item {
        text-align: center;
        padding: 8px 16px;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 900;
        color: #1a3a8f;
        line-height: 1;
        display: block;
        letter-spacing: -1px;
    }
    .stat-label {
        font-size: 0.78rem;
        color: #6c757d;
        font-weight: 600;
        margin-top: 5px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-divider {
        width: 1px;
        background: #e9ecef;
        align-self: stretch;
        margin: 4px 0;
    }

    /* dark-theme override */
    html.dark-theme .stats-inner {
        background: #202a40;
        box-shadow: 0 8px 40px rgba(0,0,0,0.35);
    }
    html.dark-theme .stat-number { color: #4fc3f7; }
    html.dark-theme .stat-label  { color: #9ea4aa; }
    html.dark-theme .stat-divider { background: #2e3a55; }

    /* ══════════════════════════════════════
       SECTION HEADERS
    ══════════════════════════════════════ */
    .section-tag {
        display: inline-block;
        background: #e8f0fe;
        color: #1a3a8f;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 4px 14px;
        border-radius: 50px;
        margin-bottom: 12px;
    }
    html.dark-theme .section-tag {
        background: rgba(79,195,247,0.15);
        color: #4fc3f7;
    }
    .section-title {
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: #0f2460;
        margin-bottom: 10px;
    }
    html.dark-theme .section-title { color: #fcfcfc; }
    .section-desc {
        color: #6c757d;
        font-size: 1rem;
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.7;
    }
    html.dark-theme .section-desc { color: #9ea4aa; }

    /* ══════════════════════════════════════
       SERVICES
    ══════════════════════════════════════ */
    .services-section {
        background: #f8f9ff;
        padding: 80px 0 60px;
    }
    html.dark-theme .services-section { background: #1a2232; }

    .service-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px 28px;
        height: 100%;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
        border: 2px solid transparent;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }
    html.dark-theme .service-card {
        background: #202a40;
        box-shadow: 0 2px 16px rgba(0,0,0,0.2);
        color: #fcfcfc;
    }
    .service-card:hover {
        transform: translateY(-8px);
        border-color: #1a3a8f;
        box-shadow: 0 20px 50px rgba(26,58,143,0.15);
        color: inherit;
    }
    html.dark-theme .service-card:hover {
        border-color: #4fc3f7;
        box-shadow: 0 20px 50px rgba(79,195,247,0.12);
        color: #fcfcfc;
    }
    .service-icon {
        width: 64px; height: 64px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 20px;
        flex-shrink: 0;
    }
    .service-icon.blue   { background: #e8f0fe; color: #1a3a8f; }
    .service-icon.green  { background: #e8f5e9; color: #2e7d32; }
    .service-icon.orange { background: #fff3e0; color: #e65100; }
    .service-icon.purple { background: #f3e5f5; color: #6a1b9a; }
    .service-icon.teal   { background: #e0f2f1; color: #00695c; }
    html.dark-theme .service-icon.blue   { background: rgba(26,58,143,0.3);  color: #90caf9; }
    html.dark-theme .service-icon.orange { background: rgba(230,81,0,0.25);  color: #ffb74d; }
    html.dark-theme .service-icon.purple { background: rgba(106,27,154,0.3); color: #ce93d8; }
    html.dark-theme .service-icon.teal   { background: rgba(0,105,92,0.3);   color: #80cbc4; }
    .service-card h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f2460;
        margin-bottom: 10px;
    }
    html.dark-theme .service-card h5 { color: #fcfcfc; }
    .service-card p {
        font-size: 0.88rem;
        color: #6c757d;
        line-height: 1.65;
        flex-grow: 1;
        margin-bottom: 16px;
    }
    html.dark-theme .service-card p { color: #9ea4aa; }
    .service-link {
        font-size: 0.85rem;
        font-weight: 700;
        color: #1a3a8f;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
        text-decoration: none;
    }
    html.dark-theme .service-link { color: #4fc3f7; }
    .service-link:hover { opacity: 0.8; }
    .service-card.featured {
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        color: #fff;
    }
    .service-card.featured h5,
    .service-card.featured p,
    .service-card.featured .service-link { color: #fff; }
    .service-card.featured .service-icon { background: rgba(255,255,255,0.15); color: #fff; }
    .service-card.featured:hover { border-color: #4fc3f7; }
    html.dark-theme .service-card.featured { background: linear-gradient(135deg, #0d1e4a, #1a3a8f); }

    /* ══════════════════════════════════════
       HOW IT WORKS
    ══════════════════════════════════════ */
    .how-section {
        padding: 80px 0;
        background: #fff;
    }
    html.dark-theme .how-section { background: #202a40; }

    .step-number {
        width: 52px; height: 52px;
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0 auto 20px;
        box-shadow: 0 8px 20px rgba(26,58,143,0.3);
    }
    .step-card {
        text-align: center;
        padding: 32px 20px;
        position: relative;
    }
    .step-connector {
        position: absolute;
        top: 52px; right: -20%;
        width: 40%; height: 2px;
        background: repeating-linear-gradient(90deg,#1a3a8f 0,#1a3a8f 6px,transparent 6px,transparent 12px);
        opacity: 0.25;
    }
    .step-card:last-child .step-connector { display: none; }
    .step-card h5 {
        font-weight: 700;
        color: #0f2460;
        margin-bottom: 10px;
    }
    html.dark-theme .step-card h5 { color: #fcfcfc; }
    .step-card p {
        font-size: 0.88rem;
        color: #6c757d;
        line-height: 1.65;
    }
    html.dark-theme .step-card p { color: #9ea4aa; }

    /* ══════════════════════════════════════
       SOCIAL NETWORKS
    ══════════════════════════════════════ */
    .social-section {
        padding: 70px 0;
        background: #f8f9ff;
    }
    html.dark-theme .social-section { background: #1a2232; }

    .social-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        max-width: 780px;
        margin: 0 auto;
    }
    .social-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1.5px solid #e9ecef;
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        transition: all 0.25s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    html.dark-theme .social-pill {
        background: #202a40;
        border-color: #2e3a55;
        color: #fcfcfc;
        box-shadow: none;
    }
    .social-pill:hover {
        border-color: #1a3a8f;
        box-shadow: 0 4px 16px rgba(26,58,143,0.15);
        transform: translateY(-2px);
    }
    html.dark-theme .social-pill:hover {
        border-color: #4fc3f7;
        box-shadow: 0 4px 16px rgba(79,195,247,0.12);
    }

    /* ══════════════════════════════════════
       PROMOTIONS
    ══════════════════════════════════════ */
    .promos-section {
        padding: 80px 0;
        background: #fff;
    }
    html.dark-theme .promos-section { background: #202a40; }

    .promo-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: none;
        height: 100%;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }
    html.dark-theme .promo-card {
        background: #1a2232;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .promo-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.14);
        color: inherit;
    }
    html.dark-theme .promo-card:hover {
        box-shadow: 0 16px 40px rgba(0,0,0,0.4);
    }
    .promo-card .card-img-top {
        height: 200px;
        object-fit: cover;
        display: block;
        width: 100%;
    }
    .promo-card .card-body { flex: 1; }
    .promo-card .card-text {
        font-size: 0.88rem;
        line-height: 1.55;
        color: #374151;
    }
    html.dark-theme .promo-card .card-text { color: #c8cdd4; }
    .promo-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 0.8rem;
        color: #6c757d;
    }
    .promo-meta i { color: #1a3a8f; }
    html.dark-theme .promo-meta i { color: #4fc3f7; }

    /* ══════════════════════════════════════
       TÉMOIGNAGES
    ══════════════════════════════════════ */
    .testimonials-section {
        padding: 80px 0;
        background: #fff;
    }
    html.dark-theme .testimonials-section { background: #202a40; }

    .testi-card {
        background: #f8f9ff;
        border-radius: 20px;
        padding: 32px 28px;
        height: 100%;
        position: relative;
        border: 1.5px solid transparent;
        transition: all 0.3s;
    }
    html.dark-theme .testi-card {
        background: #1a2232;
        border-color: #2e3a55;
    }
    .testi-card:hover {
        border-color: #1a3a8f;
        box-shadow: 0 12px 36px rgba(26,58,143,0.1);
        transform: translateY(-4px);
    }
    html.dark-theme .testi-card:hover {
        border-color: #4fc3f7;
        box-shadow: 0 12px 36px rgba(79,195,247,0.08);
    }
    .testi-quote {
        font-size: 2.5rem;
        color: #1a3a8f;
        line-height: 1;
        margin-bottom: 12px;
        opacity: 0.25;
    }
    html.dark-theme .testi-quote { color: #4fc3f7; }
    .testi-text {
        font-size: 0.92rem;
        color: #374151;
        line-height: 1.7;
        margin-bottom: 20px;
        font-style: italic;
    }
    html.dark-theme .testi-text { color: #c8cdd4; }
    .testi-stars { color: #f59e0b; font-size: 0.85rem; margin-bottom: 14px; }
    .testi-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .testi-avatar {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a3a8f, #1565c0);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .testi-name {
        font-weight: 700;
        font-size: 0.9rem;
        color: #0f2460;
        line-height: 1.2;
    }
    html.dark-theme .testi-name { color: #fcfcfc; }
    .testi-role {
        font-size: 0.78rem;
        color: #6c757d;
    }

    /* ══════════════════════════════════════
       FAQ
    ══════════════════════════════════════ */
    .faq-section {
        padding: 80px 0;
        background: #f8f9ff;
    }
    html.dark-theme .faq-section { background: #1a2232; }

    .faq-item {
        background: #fff;
        border-radius: 14px;
        margin-bottom: 12px;
        border: 1.5px solid #e9ecef;
        overflow: hidden;
        transition: border-color 0.25s;
    }
    html.dark-theme .faq-item {
        background: #202a40;
        border-color: #2e3a55;
    }
    .faq-item.open { border-color: #1a3a8f; }
    html.dark-theme .faq-item.open { border-color: #4fc3f7; }
    .faq-question {
        width: 100%;
        background: none;
        border: none;
        padding: 18px 22px;
        text-align: left;
        font-weight: 700;
        font-size: 0.95rem;
        color: #0f2460;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: color 0.2s;
    }
    html.dark-theme .faq-question { color: #fcfcfc; }
    .faq-question:hover { color: #1a3a8f; }
    html.dark-theme .faq-question:hover { color: #4fc3f7; }
    .faq-icon {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #e8f0fe;
        color: #1a3a8f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }
    html.dark-theme .faq-icon { background: rgba(79,195,247,0.15); color: #4fc3f7; }
    .faq-item.open .faq-icon { background: #1a3a8f; color: #fff; transform: rotate(180deg); }
    html.dark-theme .faq-item.open .faq-icon { background: #4fc3f7; color: #0f2460; }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.2s;
        padding: 0 22px;
        font-size: 0.9rem;
        color: #6c757d;
        line-height: 1.75;
    }
    html.dark-theme .faq-answer { color: #9ea4aa; }
    .faq-item.open .faq-answer { max-height: 300px; padding: 0 22px 18px; }

    /* ══════════════════════════════════════
       CTA BOTTOM
    ══════════════════════════════════════ */
    .cta-section {
        background: linear-gradient(135deg, #0f2460 0%, #1a3a8f 60%, #1565c0 100%);
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: \x27\x27;
        position: absolute;
        top: -60px; right: -60px;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        pointer-events: none;
    }
    .cta-section h2 {
        color: #fff;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800;
        margin-bottom: 14px;
    }
    .cta-section p {
        color: rgba(255,255,255,0.8);
        font-size: 1.05rem;
        max-width: 500px;
        margin: 0 auto 36px;
        line-height: 1.7;
    }

    /* ══════════════════════════════════════
       CURSOR BLINK
    ══════════════════════════════════════ */
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
    .typed-cursor { animation: blink 1s infinite; color: #4fc3f7; }

    @media (max-width: 991px) {
        .hero-section { min-height: auto; padding: 60px 0 60px; }
        .hero-image-wrap { margin-top: 40px; }
        .step-connector { display: none; }
        .stats-inner { margin-top: 0; border-radius: 0; }
    }
</style>
";
        yield from [];
    }

    // line 731
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 732
        yield "
";
        // line 736
        yield "<section class=\"hero-section\">
    <div class=\"container py-5\">
        <div class=\"row align-items-center g-5\">
            <div class=\"col-lg-6\" data-aos=\"fade-right\">
                <div class=\"hero-badge\">
                    <i class=\"fas fa-circle-check fs-6\"></i>
                    Plateforme de mise en relation #1 en Afrique de l\x27Ouest
                </div>
                <h1 class=\"hero-title\">
                    Boostez votre<br>
                    <span>visibilité &amp; vos affaires</span><br>
                    avec Dressur
                </h1>
                <p class=\"hero-subtitle\">
                    Gérez vos compétences, trouvez de nouveaux contacts et promouvez vos produits &amp; services auprès de milliers d\x27utilisateurs.
                </p>
                <div class=\"hero-animated-tag mb-4\">
                    Service actif&nbsp;: <span id=\"animated-service\"></span><span class=\"typed-cursor\">|</span>
                </div>
                <div class=\"d-flex flex-wrap gap-3\">
                    <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" class=\"btn-hero-primary\">
                        <i class=\"fab fa-google-play\"></i> Google Play
                    </a>
                    <a href=\"";
        // line 759
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn-hero-outline\">
                        <i class=\"fas fa-user-plus\"></i> S\x27inscrire gratuitement
                    </a>
                </div>
            </div>
            <div class=\"col-lg-6\" data-aos=\"fade-left\" data-aos-delay=\"200\">
                <div class=\"hero-image-wrap\">
                    <img src=\"/assets/img/hero_new.png\" alt=\"Dressur Mobile &amp; Web\" class=\"animated\">
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 776
        yield "<div class=\"stats-bar\">
    <div class=\"container\">
        <div class=\"stats-inner\">
            <div class=\"row g-0 justify-content-center align-items-center text-center\">
                <div class=\"col-6 col-md\">
                    <div class=\"stat-item\">
                        <span class=\"stat-number\">10 000+</span>
                        <span class=\"stat-label\">Membres</span>
                    </div>
                </div>
                <div class=\"col-auto d-none d-md-block\">
                    <div class=\"stat-divider\" style=\"height:48px;\"></div>
                </div>
                <div class=\"col-6 col-md\">
                    <div class=\"stat-item\">
                        <span class=\"stat-number\">50 000+</span>
                        <span class=\"stat-label\">Contacts échangés</span>
                    </div>
                </div>
                <div class=\"col-auto d-none d-md-block\">
                    <div class=\"stat-divider\" style=\"height:48px;\"></div>
                </div>
                <div class=\"col-6 col-md\">
                    <div class=\"stat-item\">
                        <span class=\"stat-number\">15+</span>
                        <span class=\"stat-label\">Réseaux supportés</span>
                    </div>
                </div>
                <div class=\"col-auto d-none d-md-block\">
                    <div class=\"stat-divider\" style=\"height:48px;\"></div>
                </div>
                <div class=\"col-6 col-md\">
                    <div class=\"stat-item\">
                        <span class=\"stat-number\">4.8 ★</span>
                        <span class=\"stat-label\">Note Google Play</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

";
        // line 821
        yield "<section class=\"services-section\">
    <div class=\"container\">
        <div class=\"text-center mb-5\" data-aos=\"fade-up\">
            <span class=\"section-tag\">Nos Services</span>
            <h2 class=\"section-title\">Tout ce dont vous avez besoin</h2>
            <p class=\"section-desc\">Des outils puissants pour développer votre réseau, promouvoir vos affaires et automatiser votre communication.</p>
        </div>

        <div class=\"row g-4\">
            <div class=\"col-lg-8\" data-aos=\"fade-up\" data-aos-delay=\"50\">
                <a href=\"";
        // line 831
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"service-card featured d-flex\">
                    <div class=\"d-flex flex-column\">
                        <div class=\"service-icon\">
                            <i class=\"fas fa-robot\"></i>
                        </div>
                        <h5>Dressur Bot — Envoi WhatsApp en masse</h5>
                        <p>Application Windows qui automatise l\x27envoi de messages via WhatsApp Web ou Desktop. Fournissez un fichier VCF et un message : le bot s\x27occupe du reste. Idéal pour les campagnes marketing et la prospection à grande échelle.</p>
                        <span class=\"service-link\">Découvrir Dressur Bot <i class=\"fas fa-arrow-right\"></i></span>
                    </div>
                </a>
            </div>

            <div class=\"col-lg-4\" data-aos=\"fade-up\" data-aos-delay=\"100\">
                <a href=\"";
        // line 844
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"service-card\">
                    <div class=\"service-icon blue\"><i class=\"fas fa-users\"></i></div>
                    <h5>Boost Contact</h5>
                    <p>Nos algorithmes intelligents vous affichent les contacts selon vos préférences pays et centres d\x27intérêt.</p>
                    <span class=\"service-link\">En savoir plus <i class=\"fas fa-arrow-right\"></i></span>
                </a>
            </div>

            <div class=\"col-lg-4\" data-aos=\"fade-up\" data-aos-delay=\"150\">
                <a href=\"";
        // line 853
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"service-card\">
                    <div class=\"service-icon orange\"><i class=\"fas fa-bullhorn\"></i></div>
                    <h5>Promotion Affaire</h5>
                    <p>Publiez vos offres d\x27emploi, produits, services ou demandes. Atteignez des milliers de prospects ciblés.</p>
                    <span class=\"service-link\">En savoir plus <i class=\"fas fa-arrow-right\"></i></span>
                </a>
            </div>

            <div class=\"col-lg-4\" data-aos=\"fade-up\" data-aos-delay=\"200\">
                <a href=\"";
        // line 862
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"service-card\">
                    <div class=\"service-icon purple\"><i class=\"fas fa-thumbs-up\"></i></div>
                    <h5>Promotions Réseaux Sociaux</h5>
                    <p>Achetez des abonnés, likes, commentaires et partages sur Facebook, TikTok, Instagram, YouTube et plus.</p>
                    <span class=\"service-link\">En savoir plus <i class=\"fas fa-arrow-right\"></i></span>
                </a>
            </div>

            <div class=\"col-lg-4\" data-aos=\"fade-up\" data-aos-delay=\"250\">
                <div class=\"service-card\">
                    <div class=\"service-icon teal\"><i class=\"fas fa-clock\"></i></div>
                    <h5>Gain de Temps</h5>
                    <p>Les contacts enregistrés sont synchronisés automatiquement dans les deux téléphones. Zéro saisie manuelle.</p>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 884
        yield "<section class=\"how-section\">
    <div class=\"container\">
        <div class=\"text-center mb-5\" data-aos=\"fade-up\">
            <span class=\"section-tag\">Comment ça marche</span>
            <h2 class=\"section-title\">En 3 étapes simples</h2>
            <p class=\"section-desc\">Rejoignez Dressur et commencez à développer votre réseau en quelques minutes.</p>
        </div>
        <div class=\"row justify-content-center\">
            <div class=\"col-md-4 position-relative\" data-aos=\"fade-up\" data-aos-delay=\"50\">
                <div class=\"step-card\">
                    <div class=\"step-connector\"></div>
                    <div class=\"step-number\">1</div>
                    <h5>Créez votre compte</h5>
                    <p>Inscrivez-vous gratuitement en quelques secondes. Renseignez vos compétences, votre pays et vos centres d\x27intérêt.</p>
                </div>
            </div>
            <div class=\"col-md-4 position-relative\" data-aos=\"fade-up\" data-aos-delay=\"150\">
                <div class=\"step-card\">
                    <div class=\"step-connector\"></div>
                    <div class=\"step-number\">2</div>
                    <h5>Découvrez des contacts</h5>
                    <p>Parcourez les profils recommandés par notre algorithme et échangez vos coordonnées en un seul clic.</p>
                </div>
            </div>
            <div class=\"col-md-4 position-relative\" data-aos=\"fade-up\" data-aos-delay=\"250\">
                <div class=\"step-card\">
                    <div class=\"step-number\">3</div>
                    <h5>Boostez vos affaires</h5>
                    <p>Publiez vos promotions, automatisez vos envois WhatsApp et augmentez votre présence sur les réseaux sociaux.</p>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 922
        yield "<section class=\"social-section\">
    <div class=\"container\">
        <div class=\"text-center mb-5\" data-aos=\"fade-up\">
            <span class=\"section-tag\">Réseaux Supportés</span>
            <h2 class=\"section-title\">Tous vos réseaux, une seule plateforme</h2>
            <p class=\"section-desc\">Achetez des interactions sur plus de 15 plateformes sociales pour amplifier votre présence en ligne.</p>
        </div>
        <div class=\"social-grid\" data-aos=\"fade-up\" data-aos-delay=\"100\">
            <div class=\"social-pill\"><i class=\"fab fa-facebook text-primary\"></i> Facebook</div>
            <div class=\"social-pill\"><i class=\"fab fa-instagram text-danger\"></i> Instagram</div>
            <div class=\"social-pill\"><i class=\"fab fa-tiktok\"></i> TikTok</div>
            <div class=\"social-pill\"><i class=\"fab fa-youtube text-danger\"></i> YouTube</div>
            <div class=\"social-pill\"><i class=\"fab fa-twitter text-info\"></i> Twitter / X</div>
            <div class=\"social-pill\"><i class=\"fab fa-linkedin text-primary\"></i> LinkedIn</div>
            <div class=\"social-pill\"><i class=\"fab fa-whatsapp text-success\"></i> WhatsApp</div>
            <div class=\"social-pill\"><i class=\"fab fa-snapchat text-warning\"></i> Snapchat</div>
            <div class=\"social-pill\"><i class=\"fab fa-pinterest text-danger\"></i> Pinterest</div>
            <div class=\"social-pill\"><i class=\"fab fa-discord\" style=\"color:#5865f2\"></i> Discord</div>
            <div class=\"social-pill\"><i class=\"fab fa-telegram text-info\"></i> Telegram</div>
            <div class=\"social-pill\"><i class=\"fab fa-reddit\" style=\"color:#ff4500\"></i> Reddit</div>
            <div class=\"social-pill\"><i class=\"fab fa-tumblr\"></i> Tumblr</div>
            <div class=\"social-pill\"><i class=\"fab fa-medium\"></i> Medium</div>
            <div class=\"social-pill\"><i class=\"fas fa-plus text-secondary\"></i> Et plus encore…</div>
        </div>
    </div>
</section>

";
        // line 952
        yield "<section class=\"testimonials-section\">
    <div class=\"container\">
        <div class=\"text-center mb-5\" data-aos=\"fade-up\">
            <span class=\"section-tag\">Témoignages</span>
            <h2 class=\"section-title\">Ce que disent nos utilisateurs</h2>
            <p class=\"section-desc\">Des entrepreneurs et professionnels de toute l\x27Afrique de l\x27Ouest nous font confiance.</p>
        </div>
        <div class=\"row g-4\">
            <div class=\"col-md-4\" data-aos=\"fade-up\" data-aos-delay=\"50\">
                <div class=\"testi-card\">
                    <div class=\"testi-quote\">\"</div>
                    <div class=\"testi-stars\">
                        <i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i>
                    </div>
                    <p class=\"testi-text\">Grâce à Dressur, j\x27ai pu trouver de nouveaux clients en quelques jours. Les promotions affaires sont vraiment efficaces pour toucher une cible précise.</p>
                    <div class=\"testi-author\">
                        <div class=\"testi-avatar\">KA</div>
                        <div>
                            <div class=\"testi-name\">Kofi Agyeman</div>
                            <div class=\"testi-role\">Entrepreneur, Ghana</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4\" data-aos=\"fade-up\" data-aos-delay=\"120\">
                <div class=\"testi-card\">
                    <div class=\"testi-quote\">\"</div>
                    <div class=\"testi-stars\">
                        <i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i>
                    </div>
                    <p class=\"testi-text\">Dressur Bot m\x27a fait gagner un temps fou. J\x27envoie mes offres à des centaines de contacts WhatsApp en quelques minutes. Un outil indispensable !</p>
                    <div class=\"testi-author\">
                        <div class=\"testi-avatar\">MN</div>
                        <div>
                            <div class=\"testi-name\">Marie Ndiaye</div>
                            <div class=\"testi-role\">Commerciale, Sénégal</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4\" data-aos=\"fade-up\" data-aos-delay=\"200\">
                <div class=\"testi-card\">
                    <div class=\"testi-quote\">\"</div>
                    <div class=\"testi-stars\">
                        <i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star-half-alt\"></i>
                    </div>
                    <p class=\"testi-text\">J\x27ai boosté ma page Facebook avec le service réseaux sociaux. Les abonnés sont arrivés rapidement et ma visibilité a vraiment augmenté.</p>
                    <div class=\"testi-author\">
                        <div class=\"testi-avatar\">OT</div>
                        <div>
                            <div class=\"testi-name\">Oumar Touré</div>
                            <div class=\"testi-role\">Créateur de contenu, Côte d\x27Ivoire</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 1015
        yield "<section class=\"promos-section\">
    <div class=\"container\">
        <div class=\"d-flex align-items-end justify-content-between flex-wrap gap-3 mb-5\" data-aos=\"fade-up\">
            <div>
                <span class=\"section-tag\">Annonces récentes</span>
                <h2 class=\"section-title mb-0\">Top 6 des Promotions Affaires</h2>
            </div>
            <a href=\"";
        // line 1022
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"btn btn-outline-primary rounded-pill px-4 fw-semibold\">
                Voir tout <i class=\"fas fa-arrow-right ms-2\"></i>
            </a>
        </div>

        <div class=\"row g-4\">
            ";
        // line 1028
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
            // line 1029
            yield "                ";
            $context["altText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 1029) == "offre_emploi")) {
                    yield "Offre d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 1029), "titre_demande_poste_rechercher", [], "any", true, true, false, 1029) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "titre_demande_poste_rechercher", [], "any", false, false, false, 1029))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "titre_demande_poste_rechercher", [], "any", false, false, false, 1029), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 1029), "lieu_travail", [], "any", true, true, false, 1029) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "lieu_travail", [], "any", false, false, false, 1029))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "lieu_travail", [], "any", false, false, false, 1029), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 1029), "html", null, true);
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 1029) == "dmd_emploi")) {
                    yield "Demande d\x27emploi";
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 1029), "titre_demande_poste_rechercher", [], "any", true, true, false, 1029) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "titre_demande_poste_rechercher", [], "any", false, false, false, 1029))) {
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "titre_demande_poste_rechercher", [], "any", false, false, false, 1029), "html", null, true);
                    }
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, true, false, 1029), "localisation_souhaite", [], "any", true, true, false, 1029) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "localisation_souhaite", [], "any", false, false, false, 1029))) {
                        yield " à ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1029), "localisation_souhaite", [], "any", false, false, false, 1029), "html", null, true);
                    }
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 1029), "html", null, true);
                } else {
                    yield "Promotion produit / service — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "pseudoAnnonceur", [], "any", false, false, false, 1029), "html", null, true);
                }
                yield from [];
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 1030
            yield "
                <div class=\"col-md-4\" data-aos=\"fade-up\" data-aos-delay=\"";
            // line 1031
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 1031) * 50), "html", null, true);
            yield "\">
                    <a href=\"/actualite/";
            // line 1032
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "token", [], "any", false, false, false, 1032), "html", null, true);
            yield "\" class=\"promo-card card mb-0\">
                        <img src=\"/assets/images/placeholder.png\"
                             data-original=\"/promotion/";
            // line 1034
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "image", [], "any", false, false, false, 1034), "html", null, true);
            yield "\"
                             class=\"lazy card-img-top image-actu\"
                             alt=\"";
            // line 1036
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(($context["altText"] ?? null)), "html", null, true);
            yield "\"
                             loading=\"lazy\"
                             width=\"400\" height=\"200\">
                        <div class=\"card-body p-3\">
                            <p class=\"card-text actu-small-description mb-3\">
                                ";
            // line 1041
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 1041) == "produit_service")) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "description", [], "any", false, false, false, 1041), "html", null, true);
            }
            // line 1042
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 1042) == "offre_emploi")) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1042), "description_poste", [], "any", false, false, false, 1042), "html", null, true);
            }
            // line 1043
            yield "                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "typePromotionAffaire", [], "any", false, false, false, 1043) == "dmd_emploi")) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "annotherInfo", [], "any", false, false, false, 1043), "description_profil_demandeur", [], "any", false, false, false, 1043), "html", null, true);
            }
            // line 1044
            yield "                            </p>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <div class=\"promo-meta\">
                                    <span><i class=\"fas fa-eye me-1\"></i>";
            // line 1047
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreImpression", [], "any", false, false, false, 1047), "html", null, true);
            yield "</span>
                                    <span><i class=\"fas fa-hand-pointer me-1\"></i>";
            // line 1048
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["actu"], "nombreDeVues", [], "any", false, false, false, 1048), "html", null, true);
            yield "</span>
                                </div>
                                <span class=\"btn btn-outline-primary btn-sm rounded-pill px-3 py-1\" style=\"font-size:0.8rem; pointer-events:none;\">
                                    Voir <i class=\"fas fa-arrow-right ms-1\"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            ";
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
        // line 1058
        yield "        </div>
    </div>
</section>

";
        // line 1065
        yield "<section class=\"faq-section\">
    <div class=\"container\">
        <div class=\"row g-5 align-items-start\">
            <div class=\"col-lg-4\" data-aos=\"fade-right\">
                <span class=\"section-tag\">FAQ</span>
                <h2 class=\"section-title\">Questions fréquentes</h2>
                <p class=\"section-desc\" style=\"max-width:100%;\">Une question ? Retrouvez les réponses aux interrogations les plus courantes sur Dressur.</p>
                <a href=\"";
        // line 1072
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contactez_nous");
        yield "\" class=\"btn btn-outline-primary rounded-pill px-4 mt-3 fw-semibold\">
                    <i class=\"fas fa-envelope me-2\"></i> Nous contacter
                </a>
            </div>
            <div class=\"col-lg-8\" data-aos=\"fade-left\">
                <div class=\"faq-item\">
                    <button class=\"faq-question\" onclick=\"toggleFaq(this)\">
                        Dressur est-il gratuit ?
                        <span class=\"faq-icon\"><i class=\"fas fa-chevron-down\"></i></span>
                    </button>
                    <div class=\"faq-answer\">L\x27inscription sur Dressur est entièrement gratuite. Certains services premium comme le Boost Contact, les promotions et Dressur Bot sont payants. Consultez la page <a href=\"";
        // line 1082
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\">Tarifs</a> pour les détails.</div>
                </div>
                <div class=\"faq-item\">
                    <button class=\"faq-question\" onclick=\"toggleFaq(this)\">
                        Comment fonctionne Dressur Bot ?
                        <span class=\"faq-icon\"><i class=\"fas fa-chevron-down\"></i></span>
                    </button>
                    <div class=\"faq-answer\">Dressur Bot est une application Windows. Vous fournissez un fichier VCF contenant vos contacts et le message à envoyer. Le bot automatise l\x27envoi via WhatsApp Web ou WhatsApp Desktop, sans aucune manipulation manuelle.</div>
                </div>
                <div class=\"faq-item\">
                    <button class=\"faq-question\" onclick=\"toggleFaq(this)\">
                        Quels réseaux sociaux sont supportés pour les promotions ?
                        <span class=\"faq-icon\"><i class=\"fas fa-chevron-down\"></i></span>
                    </button>
                    <div class=\"faq-answer\">Nous supportons plus de 15 plateformes : Facebook, Instagram, TikTok, YouTube, Twitter/X, LinkedIn, WhatsApp, Snapchat, Pinterest, Discord, Telegram, Reddit et plus encore.</div>
                </div>
                <div class=\"faq-item\">
                    <button class=\"faq-question\" onclick=\"toggleFaq(this)\">
                        Dressur est-il disponible dans mon pays ?
                        <span class=\"faq-icon\"><i class=\"fas fa-chevron-down\"></i></span>
                    </button>
                    <div class=\"faq-answer\">Dressur est principalement orienté Afrique de l\x27Ouest mais accessible partout dans le monde. L\x27application mobile est disponible sur Google Play pour les utilisateurs Android.</div>
                </div>
                <div class=\"faq-item\">
                    <button class=\"faq-question\" onclick=\"toggleFaq(this)\">
                        Comment sont sécurisées mes données personnelles ?
                        <span class=\"faq-icon\"><i class=\"fas fa-chevron-down\"></i></span>
                    </button>
                    <div class=\"faq-answer\">Vos données sont protégées conformément à notre <a href=\"";
        // line 1110
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("politique_confidentialite");
        yield "\">politique de confidentialité</a>. Elles ne sont jamais revendues à des tiers et vous pouvez demander leur suppression à tout moment.</div>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 1120
        yield "<section class=\"cta-section\">
    <div class=\"container position-relative\" data-aos=\"fade-up\">
        <h2>Prêt à développer votre réseau ?</h2>
        <p>Rejoignez des milliers d\x27entrepreneurs et professionnels qui font confiance à Dressur pour booster leur visibilité.</p>
        <div class=\"d-flex flex-wrap gap-3 justify-content-center\">
            <a href=\"";
        // line 1125
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn-hero-primary\">
                <i class=\"fas fa-user-plus\"></i> Créer mon compte gratuit
            </a>
            <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" class=\"btn-hero-outline\">
                <i class=\"fab fa-google-play\"></i> Télécharger l\x27app
            </a>
        </div>
    </div>
</section>

";
        yield from [];
    }

    // line 1137
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1138
        yield "<script>
(function () {
    const services = [\x27Boost Contact\x27, \x27Promotion Affaire\x27, \x27Promotions Réseaux Sociaux\x27, \x27Dressur Bot\x27];
    let si = 0, ci = 0, deleting = false;
    const el = document.getElementById(\x27animated-service\x27);
    if (!el) return;
    function tick() {
        const word = services[si];
        if (!deleting) {
            el.textContent = word.substring(0, ci + 1);
            ci++;
            if (ci === word.length) { deleting = true; setTimeout(tick, 1600); return; }
        } else {
            el.textContent = word.substring(0, ci - 1);
            ci--;
            if (ci === 0) { deleting = false; si = (si + 1) % services.length; }
        }
        setTimeout(tick, deleting ? 60 : 90);
    }
    tick();
})();

function toggleFaq(btn) {
    const item = btn.closest(\x27.faq-item\x27);
    const isOpen = item.classList.contains(\x27open\x27);
    document.querySelectorAll(\x27.faq-item.open\x27).forEach(el => el.classList.remove(\x27open\x27));
    if (!isOpen) item.classList.add(\x27open\x27);
}
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/index.html.twig";
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
        return array (  1391 => 1138,  1384 => 1137,  1368 => 1125,  1361 => 1120,  1351 => 1110,  1320 => 1082,  1307 => 1072,  1298 => 1065,  1292 => 1058,  1268 => 1048,  1264 => 1047,  1259 => 1044,  1254 => 1043,  1249 => 1042,  1245 => 1041,  1237 => 1036,  1232 => 1034,  1227 => 1032,  1223 => 1031,  1220 => 1030,  1187 => 1029,  1170 => 1028,  1161 => 1022,  1152 => 1015,  1090 => 952,  1061 => 922,  1024 => 884,  1002 => 862,  990 => 853,  978 => 844,  962 => 831,  950 => 821,  906 => 776,  889 => 759,  864 => 736,  861 => 732,  854 => 731,  201 => 81,  194 => 80,  183 => 78,  168 => 67,  164 => 66,  160 => 65,  156 => 64,  136 => 47,  108 => 21,  101 => 20,  93 => 16,  88 => 14,  84 => 13,  78 => 10,  73 => 8,  68 => 7,  61 => 6,  56 => 1,  54 => 4,  52 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/index.html.twig");
    }
}
