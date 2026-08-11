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

/* public/promotion_affaire.html.twig */
class __TwigTemplate_2ab07b8a311a447cc8eaedb1a3bea07c extends Template
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
        $context["description"] = "Promouvez vos produits, services, événements, et plus encore avec Dressur. Utilisez notre service de Promotion Affaire pour atteindre un public ciblé et optimiser votre visibilité en ligne.";
        // line 4
        $context["title"] = "Promotion Affaire";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-promotion-affaire.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-promotion-affaire.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, Promotion Affaire, promotion produits, promotion services, promotion événements, marketing, visibilité en ligne, moteur de recherche, Dressur Mobile, Dressur Web\">
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
  \"@type\": \"Service\",
  \"@id\": \"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "#service\",
  \"name\": \"Promotion Affaire\",
  \"alternateName\": \"Dressur Promotion Affaire\",
  \"description\": \"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "\",
  \"provider\": {\"@type\": \"Organization\",\"name\": \"Dressur\",\"url\": \"https://dressur.site\",\"@id\": \"https://dressur.site/#organization\"},
  \"serviceType\": \"Promotion commerciale / Publicité ciblée\",
  \"areaServed\": \"Afrique de l\x27Ouest\",
  \"availableChannel\": [
    {\"@type\": \"ServiceChannel\",\"serviceUrl\": \"https://play.google.com/store/apps/details?id=com.dressur.ds\",\"servicePlatform\": \"Application mobile Android\"},
    {\"@type\": \"ServiceChannel\",\"serviceUrl\": \"https://dressur.site\",\"servicePlatform\": \"Web\"}
  ],
  \"offers\": {\"@type\": \"Offer\",\"price\": \"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min_price"] ?? null), "html", null, true);
        yield "\",\"priceCurrency\": \"XOF\",\"availability\": \"https://schema.org/InStock\",\"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\",\"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\",\"applicableCountry\": \"BJ\",\"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"},\"shippingDetails\": {\"@type\": \"OfferShippingDetails\",\"shippingRate\": {\"@type\": \"MonetaryAmount\",\"value\": \"0\",\"currency\": \"XOF\"},\"shippingDestination\": {\"@type\": \"DefinedRegion\",\"addressCountry\": \"BJ\"},\"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\",\"handlingTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"},\"transitTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"}}}},
  \"sameAs\": \"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\"
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Promotion Affaire\",\"item\":\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "\"}]}
</script>
";
        yield from [];
    }

    // line 46
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 48
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 49
        yield "<style>
    .page-hero {
        background: linear-gradient(135deg, #7c2d12 0%, #c2410c 55%, #ea580c 100%);
        padding: 56px 0 44px;
        position: relative; overflow: hidden;
    }
    .page-hero::before { content:\x27\x27; position:absolute; top:-80px; right:-80px; width:280px; height:280px; border-radius:50%; background:rgba(255,255,255,0.05); pointer-events:none; }
    .page-hero::after  { content:\x27\x27; position:absolute; bottom:-60px; left:-60px; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,0.03); pointer-events:none; }
    .page-hero-breadcrumb { display:flex; align-items:center; gap:8px; font-size:0.82rem; color:rgba(255,255,255,0.6); margin-bottom:14px; }
    .page-hero-breadcrumb a { color:rgba(255,255,255,0.7); text-decoration:none; }
    .page-hero-breadcrumb a:hover { color:#fff; }
    .page-hero h1 { color:#fff; font-weight:800; font-size:clamp(1.8rem,4vw,2.6rem); margin-bottom:10px; }
    .page-hero p  { color:rgba(255,255,255,0.82); font-size:1rem; margin-bottom:0; }
    .hero-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.25); color:#fff; padding:4px 14px; border-radius:50px; font-size:0.8rem; font-weight:700; margin-bottom:14px; }

    .section-tag { display:inline-block; background:#fff3e0; color:#c2410c; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:4px 14px; border-radius:50px; margin-bottom:10px; }
    html.dark-theme .section-tag { background:rgba(194,65,12,0.15); color:#fb923c; }
    .section-title { font-weight:800; color:#0f2460; font-size:clamp(1.3rem,3vw,1.8rem); margin-bottom:6px; }
    html.dark-theme .section-title { color:#fcfcfc; }
    .section-desc { color:#6c757d; font-size:0.95rem; }
    html.dark-theme .section-desc { color:#9ea4aa; }

    .feat-card { background:#fff; border-radius:18px; padding:28px 22px; border:1.5px solid #f1f3f9; box-shadow:0 2px 14px rgba(0,0,0,0.05); height:100%; transition:all 0.3s; }
    html.dark-theme .feat-card { background:#202a40; border-color:#2e3a55; box-shadow:none; }
    .feat-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(194,65,12,0.1); border-color:#fed7aa; }
    html.dark-theme .feat-card:hover { box-shadow:0 12px 32px rgba(251,146,60,0.07); border-color:#fb923c; }
    .feat-icon { width:52px; height:52px; border-radius:14px; background:#fff3e0; color:#c2410c; display:flex; align-items:center; justify-content:center; font-size:1.2rem; margin-bottom:14px; }
    html.dark-theme .feat-icon { background:rgba(194,65,12,0.15); color:#fb923c; }
    .feat-title { font-weight:800; color:#7c2d12; font-size:0.97rem; margin-bottom:8px; }
    html.dark-theme .feat-title { color:#fcfcfc; }
    .feat-desc { font-size:0.87rem; color:#6c757d; line-height:1.6; margin:0; }
    html.dark-theme .feat-desc { color:#9ea4aa; }

    .promo-types { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:14px; margin-bottom:0; }
    .promo-type-card { background:#fff; border:1.5px solid #f1f3f9; border-radius:16px; padding:20px 18px; text-align:center; transition:all 0.25s; }
    html.dark-theme .promo-type-card { background:#202a40; border-color:#2e3a55; }
    .promo-type-card:hover { border-color:#fed7aa; transform:translateY(-3px); box-shadow:0 8px 24px rgba(194,65,12,0.08); }
    html.dark-theme .promo-type-card:hover { border-color:#fb923c; }
    .promo-type-icon { font-size:1.8rem; margin-bottom:8px; }
    .promo-type-name { font-weight:700; font-size:0.88rem; color:#0f2460; }
    html.dark-theme .promo-type-name { color:#fcfcfc; }

    .dl-cta { background:linear-gradient(135deg,#7c2d12,#c2410c); border-radius:24px; padding:48px 36px; text-align:center; }
    .dl-cta h2 { color:#fff; font-weight:800; margin-bottom:10px; }
    .dl-cta p  { color:rgba(255,255,255,0.78); margin-bottom:24px; }

    .other-svc-strip { background:#f8f9ff; border-radius:20px; padding:32px; }
    html.dark-theme .other-svc-strip { background:#1a2232; }
    .other-svc-item { display:flex; align-items:flex-start; gap:14px; padding:16px; border-radius:14px; text-decoration:none; color:inherit; border:1.5px solid transparent; transition:all 0.2s; }
    .other-svc-item:hover { background:#fff; border-color:#d0dcff; color:inherit; box-shadow:0 4px 16px rgba(26,58,143,0.08); }
    html.dark-theme .other-svc-item:hover { background:#202a40; border-color:#4fc3f7; }
    .other-svc-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
    .other-svc-name { font-weight:700; font-size:0.92rem; color:#0f2460; margin-bottom:2px; }
    html.dark-theme .other-svc-name { color:#fcfcfc; }
    .other-svc-desc { font-size:0.82rem; color:#6c757d; line-height:1.4; }
    html.dark-theme .other-svc-desc { color:#9ea4aa; }
</style>
";
        yield from [];
    }

    // line 108
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 109
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 113
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <a href=\"";
        // line 115
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\">Services</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Promotion Affaire</span>
        </div>
        <div class=\"hero-badge\"><i class=\"fas fa-tags\"></i> À partir de ";
        // line 119
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min_price"] ?? null), "html", null, true);
        yield " FCFA</div>
        <h1><i class=\"fas fa-bullhorn me-2\" style=\"opacity:.7\"></i> Promotion Affaire</h1>
        <p class=\"mb-4\">Promouvez vos produits, services, événements et offres d\x27emploi auprès d\x27un public ciblé. Référencé sur Google.</p>
        <div class=\"d-flex gap-3 flex-wrap\">
            <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-google-play text-success me-2\"></i> Télécharger sur Google Play
            </a>
            <a href=\"";
        // line 126
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-user-plus me-2\"></i> S\x27inscrire
            </a>
        </div>
    </div>
</div>

<div class=\"container my-5\">

    ";
        // line 136
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Ce que vous pouvez promouvoir</span>
        <h2 class=\"section-title\">Tous types d\x27affaires acceptés</h2>
    </div>
    <div class=\"promo-types mb-5\">
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">🛍️</div><div class=\"promo-type-name\">Produits</div></div>
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">⚙️</div><div class=\"promo-type-name\">Services</div></div>
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">💼</div><div class=\"promo-type-name\">Offres d\x27emploi</div></div>
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">🎪</div><div class=\"promo-type-name\">Événements</div></div>
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">🏠</div><div class=\"promo-type-name\">Immobilier</div></div>
        <div class=\"promo-type-card\"><div class=\"promo-type-icon\">📢</div><div class=\"promo-type-name\">Annonces</div></div>
    </div>

    ";
        // line 150
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Fonctionnalités</span>
        <h2 class=\"section-title\">Pourquoi choisir Promotion Affaire ?</h2>
        <p class=\"section-desc\">Découvrez comment notre service peut booster la visibilité de vos affaires.</p>
    </div>
    <div class=\"row g-4 mb-5\">
        <div class=\"col-md-6\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-crosshairs\"></i></div>
                <p class=\"feat-title\">Visibilité ciblée</p>
                <p class=\"feat-desc\">Vos promotions sont présentées aux utilisateurs en fonction de vos préférences pays et intérêts, garantissant une audience pertinente.</p>
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-globe\"></i></div>
                <p class=\"feat-title\">Large diffusion &amp; SEO</p>
                <p class=\"feat-desc\">Les promotions sont visibles sur Dressur ET référencées sur les moteurs de recherche (Google) pour maximiser votre portée.</p>
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-image\"></i></div>
                <p class=\"feat-title\">Support visuel impactant</p>
                <p class=\"feat-desc\">Utilisez un visuel au format carré pour capter l\x27attention de vos clients potentiels et renforcer votre message.</p>
            </div>
        </div>
        <div class=\"col-md-6\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-align-left\"></i></div>
                <p class=\"feat-title\">Description détaillée</p>
                <p class=\"feat-desc\">Accompagnez vos promotions d\x27une description complète pour informer et convaincre vos clients potentiels.</p>
            </div>
        </div>
    </div>

    ";
        // line 187
        yield "    <div class=\"dl-cta mb-5\">
        <h2><i class=\"fas fa-bullhorn me-2\"></i> Commencez à promouvoir vos affaires</h2>
        <p>Inscrivez-vous sur Dressur pour accéder au service Promotion Affaire et bien plus encore.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"";
        // line 191
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-user-plus me-2\"></i> S\x27inscrire sur Dressur
            </a>
            <a href=\"";
        // line 194
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-tags me-2\"></i> Voir les tarifs
            </a>
        </div>
    </div>

    ";
        // line 201
        yield "    <div class=\"other-svc-strip\">
        <h3 class=\"section-title mb-1\" style=\"font-size:1.1rem;\"><i class=\"fas fa-grid-2 me-2\" style=\"color:#1a3a8f;opacity:.7\"></i> Autres services Dressur</h3>
        <p class=\"section-desc mb-4\">Découvrez aussi nos autres solutions.</p>
        <div class=\"row g-3\">
            <div class=\"col-md-4\">
                <a href=\"";
        // line 206
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"other-svc-item\">
                    <div class=\"other-svc-icon\" style=\"background:#d1fae5; color:#059669;\"><i class=\"fas fa-users\"></i></div>
                    <div>
                        <div class=\"other-svc-name\">Boost Contact</div>
                        <div class=\"other-svc-desc\">Trouvez de nouveaux contacts qualifiés via nos algorithmes intelligents.</div>
                    </div>
                </a>
            </div>
            <div class=\"col-md-4\">
                <a href=\"";
        // line 215
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"other-svc-item\">
                    <div class=\"other-svc-icon\" style=\"background:#dbeafe; color:#1d4ed8;\"><i class=\"fas fa-robot\"></i></div>
                    <div>
                        <div class=\"other-svc-name\">Dressur Bot</div>
                        <div class=\"other-svc-desc\">Automatisez l\x27envoi de messages WhatsApp en masse via une app Windows.</div>
                    </div>
                </a>
            </div>
            <div class=\"col-md-4\">
                <a href=\"";
        // line 224
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"other-svc-item\">
                    <div class=\"other-svc-icon\" style=\"background:#f3e8ff; color:#7c3aed;\"><i class=\"fas fa-thumbs-up\"></i></div>
                    <div>
                        <div class=\"other-svc-name\">Réseaux Sociaux</div>
                        <div class=\"other-svc-desc\">Achetez des abonnés, likes et vues sur Facebook, TikTok, YouTube et plus.</div>
                    </div>
                </a>
            </div>
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
        return "public/promotion_affaire.html.twig";
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
        return array (  387 => 224,  375 => 215,  363 => 206,  356 => 201,  347 => 194,  341 => 191,  335 => 187,  297 => 150,  282 => 136,  270 => 126,  260 => 119,  253 => 115,  248 => 113,  242 => 109,  235 => 108,  173 => 49,  166 => 48,  155 => 46,  147 => 42,  140 => 38,  134 => 37,  123 => 29,  119 => 28,  113 => 25,  107 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/promotion_affaire.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/promotion_affaire.html.twig");
    }
}
