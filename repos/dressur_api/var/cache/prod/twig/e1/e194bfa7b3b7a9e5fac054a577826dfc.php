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

/* public/promotion_reseaux_sociaux.html.twig */
class __TwigTemplate_d046fcf78d2ce60ae1013c6635341d47 extends Template
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
        $context["description"] = "Promotion Réseaux Sociaux sur Dressur - Achetez des interactions, likes, abonnés, vues, etc., sur TikTok, Facebook, YouTube, Twitter, et plus. Augmentez votre visibilité avec Dressur.";
        // line 4
        $context["title"] = "Promotions Réseaux Sociaux";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-promotion-reseaux-sociaux.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-promotion-reseaux-sociaux.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Promotion Réseaux Sociaux, Dressur, TikTok, Facebook, YouTube, Twitter, Telegram, Twitch, Spotify, acheter likes, abonnés, vues, interactions\">
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "#service\",
  \"name\": \"Promotions Réseaux Sociaux\",
  \"alternateName\": \"Dressur Promotions Réseaux Sociaux\",
  \"description\": \"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\",
  \"provider\": {\"@type\": \"Organization\",\"name\": \"Dressur\",\"url\": \"https://dressur.site\",\"@id\": \"https://dressur.site/#organization\"},
  \"serviceType\": \"Promotion réseaux sociaux\",
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
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Promotions Réseaux Sociaux\",\"item\":\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
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
        background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 55%, #a855f7 100%);
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

    .section-tag { display:inline-block; background:#f3e8ff; color:#7c3aed; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:4px 14px; border-radius:50px; margin-bottom:10px; }
    html.dark-theme .section-tag { background:rgba(124,58,237,0.15); color:#c084fc; }
    .section-title { font-weight:800; color:#0f2460; font-size:clamp(1.3rem,3vw,1.8rem); margin-bottom:6px; }
    html.dark-theme .section-title { color:#fcfcfc; }
    .section-desc { color:#6c757d; font-size:0.95rem; }
    html.dark-theme .section-desc { color:#9ea4aa; }

    /* Platforms grid */
    .platforms-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); gap:12px; margin-bottom:0; }
    .platform-pill {
        background:#fff; border:1.5px solid #f1f3f9;
        border-radius:14px; padding:14px 10px;
        text-align:center; font-size:0.82rem; font-weight:700;
        color:#374151; display:flex; flex-direction:column;
        align-items:center; gap:7px; transition:all 0.2s;
    }
    html.dark-theme .platform-pill { background:#202a40; border-color:#2e3a55; color:#c8cdd4; }
    .platform-pill:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(124,58,237,0.1); border-color:#e9d5ff; }
    html.dark-theme .platform-pill:hover { border-color:#c084fc; }
    .platform-pill i { font-size:1.5rem; }

    /* Feat cards */
    .feat-card { background:#fff; border-radius:18px; padding:28px 22px; border:1.5px solid #f1f3f9; box-shadow:0 2px 14px rgba(0,0,0,0.05); height:100%; transition:all 0.3s; }
    html.dark-theme .feat-card { background:#202a40; border-color:#2e3a55; box-shadow:none; }
    .feat-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(124,58,237,0.1); border-color:#e9d5ff; }
    html.dark-theme .feat-card:hover { box-shadow:0 12px 32px rgba(192,132,252,0.07); border-color:#c084fc; }
    .feat-icon { width:52px; height:52px; border-radius:14px; background:#f3e8ff; color:#7c3aed; display:flex; align-items:center; justify-content:center; font-size:1.2rem; margin-bottom:14px; }
    html.dark-theme .feat-icon { background:rgba(124,58,237,0.15); color:#c084fc; }
    .feat-title { font-weight:800; color:#4c1d95; font-size:0.97rem; margin-bottom:8px; }
    html.dark-theme .feat-title { color:#fcfcfc; }
    .feat-desc { font-size:0.87rem; color:#6c757d; line-height:1.6; margin:0; }
    html.dark-theme .feat-desc { color:#9ea4aa; }

    .dl-cta { background:linear-gradient(135deg,#4c1d95,#7c3aed); border-radius:24px; padding:48px 36px; text-align:center; }
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

    // line 114
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 115
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 119
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <a href=\"";
        // line 121
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\">Services</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Réseaux Sociaux</span>
        </div>
        <div class=\"hero-badge\"><i class=\"fas fa-star\"></i> +15 plateformes supportées</div>
        <h1><i class=\"fas fa-thumbs-up me-2\" style=\"opacity:.7\"></i> Promotions Réseaux Sociaux</h1>
        <p class=\"mb-4\">Augmentez votre visibilité sur les réseaux sociaux — abonnés, likes, vues, commentaires et bien plus.</p>
        <div class=\"d-flex gap-3 flex-wrap\">
            <a href=\"";
        // line 129
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-rocket me-2\"></i> Commencer maintenant
            </a>
            <a href=\"";
        // line 132
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-tags me-2\"></i> Voir les tarifs
            </a>
        </div>
    </div>
</div>

<div class=\"container my-5\">

    ";
        // line 142
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Plateformes</span>
        <h2 class=\"section-title\">15+ réseaux sociaux supportés</h2>
        <p class=\"section-desc\">Choisissez la plateforme qui correspond à votre audience.</p>
    </div>
    <div class=\"platforms-grid mb-5\">
        <div class=\"platform-pill\"><i class=\"fab fa-facebook\" style=\"color:#1877f2\"></i> Facebook</div>
        <div class=\"platform-pill\"><i class=\"fab fa-tiktok\" style=\"color:#000\"></i> TikTok</div>
        <div class=\"platform-pill\"><i class=\"fab fa-instagram\" style=\"color:#e1306c\"></i> Instagram</div>
        <div class=\"platform-pill\"><i class=\"fab fa-youtube\" style=\"color:#ff0000\"></i> YouTube</div>
        <div class=\"platform-pill\"><i class=\"fab fa-twitter\" style=\"color:#1da1f2\"></i> Twitter/X</div>
        <div class=\"platform-pill\"><i class=\"fab fa-telegram\" style=\"color:#229ed9\"></i> Telegram</div>
        <div class=\"platform-pill\"><i class=\"fab fa-whatsapp\" style=\"color:#25d366\"></i> WhatsApp</div>
        <div class=\"platform-pill\"><i class=\"fab fa-twitch\" style=\"color:#9147ff\"></i> Twitch</div>
        <div class=\"platform-pill\"><i class=\"fab fa-spotify\" style=\"color:#1ed760\"></i> Spotify</div>
        <div class=\"platform-pill\"><i class=\"fab fa-linkedin\" style=\"color:#0077b5\"></i> LinkedIn</div>
        <div class=\"platform-pill\"><i class=\"fab fa-snapchat\" style=\"color:#fffc00\"></i> Snapchat</div>
        <div class=\"platform-pill\"><i class=\"fab fa-pinterest\" style=\"color:#e60023\"></i> Pinterest</div>
        <div class=\"platform-pill\"><i class=\"fab fa-discord\" style=\"color:#5865f2\"></i> Discord</div>
        <div class=\"platform-pill\"><i class=\"fab fa-reddit\" style=\"color:#ff4500\"></i> Reddit</div>
        <div class=\"platform-pill\"><i class=\"fas fa-ellipsis\" style=\"color:#6c757d\"></i> Et plus…</div>
    </div>

    ";
        // line 166
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Fonctionnalités</span>
        <h2 class=\"section-title\">Ce que vous pouvez acheter</h2>
        <p class=\"section-desc\">Chaque interaction compte pour votre présence en ligne.</p>
    </div>
    <div class=\"row g-4 mb-5\">
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-heart\"></i></div>
                <p class=\"feat-title\">Likes &amp; Interactions</p>
                <p class=\"feat-desc\">Boostez vos publications avec des likes, commentaires et partages sur Facebook, TikTok, Instagram et autres.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-user-plus\"></i></div>
                <p class=\"feat-title\">Abonnés</p>
                <p class=\"feat-desc\">Obtenez plus d\x27abonnés sur vos profils sociaux pour augmenter votre crédibilité et attirer une audience plus large.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-play\"></i></div>
                <p class=\"feat-title\">Vues vidéo</p>
                <p class=\"feat-desc\">Augmentez le nombre de vues de vos vidéos sur YouTube et d\x27autres plateformes pour atteindre un public plus large.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-signal\"></i></div>
                <p class=\"feat-title\">Spectateurs en direct</p>
                <p class=\"feat-desc\">Augmentez le nombre de personnes qui regardent vos streams en direct sur Twitch, YouTube et Facebook.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-shield-check\"></i></div>
                <p class=\"feat-title\">Présence renforcée</p>
                <p class=\"feat-desc\">Une présence plus forte et visible vous donne la confiance des utilisateurs et peut attirer plus de clients potentiels.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-magnifying-glass\"></i></div>
                <p class=\"feat-title\">Référencement SEO</p>
                <p class=\"feat-desc\">Nos promotions sont également référencées sur les moteurs de recherche pour une visibilité maximale et durable.</p>
            </div>
        </div>
    </div>

    ";
        // line 217
        yield "    <div class=\"dl-cta mb-5\">
        <h2><i class=\"fas fa-rocket me-2\"></i> Commencez dès aujourd\x27hui</h2>
        <p>Utilisez Dressur pour booster vos réseaux sociaux et atteindre de nouveaux sommets.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"";
        // line 221
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-user-plus me-2\"></i> Commencer les promotions
            </a>
            <a href=\"";
        // line 224
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-tags me-2\"></i> Voir les tarifs
            </a>
        </div>
    </div>

    ";
        // line 231
        yield "    <div class=\"other-svc-strip\">
        <h3 class=\"section-title mb-1\" style=\"font-size:1.1rem;\"><i class=\"fas fa-grid-2 me-2\" style=\"color:#1a3a8f;opacity:.7\"></i> Autres services Dressur</h3>
        <p class=\"section-desc mb-4\">Découvrez aussi nos autres solutions.</p>
        <div class=\"row g-3\">
            <div class=\"col-md-4\">
                <a href=\"";
        // line 236
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
        // line 245
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
        // line 254
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"other-svc-item\">
                    <div class=\"other-svc-icon\" style=\"background:#fff3e0; color:#c2410c;\"><i class=\"fas fa-bullhorn\"></i></div>
                    <div>
                        <div class=\"other-svc-name\">Promotion Affaire</div>
                        <div class=\"other-svc-desc\">Promouvez vos produits, services et offres d\x27emploi auprès d\x27un public ciblé.</div>
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
        return "public/promotion_reseaux_sociaux.html.twig";
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
        return array (  417 => 254,  405 => 245,  393 => 236,  386 => 231,  377 => 224,  371 => 221,  365 => 217,  313 => 166,  288 => 142,  276 => 132,  270 => 129,  259 => 121,  254 => 119,  248 => 115,  241 => 114,  173 => 49,  166 => 48,  155 => 46,  147 => 42,  140 => 38,  134 => 37,  123 => 29,  119 => 28,  113 => 25,  107 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/promotion_reseaux_sociaux.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/promotion_reseaux_sociaux.html.twig");
    }
}
