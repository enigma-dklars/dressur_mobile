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

/* public/boost_contact.html.twig */
class __TwigTemplate_a2f7e0c02fd34f6b0894c05341b3493b extends Template
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
        $context["description"] = "Boost Contact est un service de Dressur qui vous permet de trouver facilement de nouveaux contacts selon vos préférences, gagner du temps et de l\x27énergie, économiser de l\x27argent, augmenter votre visibilité et booster le rendement de vos activités.";
        // line 4
        $context["title"] = "Boost Contact";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-boost-contact.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-boost-contact.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Boost Contact, Dressur, nouveaux contacts, communication, visibilité, marketing, réseau\">
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "#service\",
  \"name\": \"Boost Contact\",
  \"alternateName\": \"Dressur Boost Contact\",
  \"description\": \"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "\",
  \"provider\": {\"@type\": \"Organization\",\"name\": \"Dressur\",\"url\": \"https://dressur.site\",\"@id\": \"https://dressur.site/#organization\"},
  \"serviceType\": \"Marketing numérique\",
  \"areaServed\": \"Afrique de l\x27Ouest\",
  \"availableChannel\": {\"@type\": \"ServiceChannel\",\"serviceUrl\": \"https://play.google.com/store/apps/details?id=com.dressur.ds\",\"servicePlatform\": \"Application mobile Android\"},
  \"offers\": {\"@type\": \"Offer\",\"price\": \"0\",\"priceCurrency\": \"XOF\",\"availability\": \"https://schema.org/InStock\",\"url\": \"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\",\"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\",\"applicableCountry\": \"BJ\",\"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"},\"shippingDetails\": {\"@type\": \"OfferShippingDetails\",\"shippingRate\": {\"@type\": \"MonetaryAmount\",\"value\": \"0\",\"currency\": \"XOF\"},\"shippingDestination\": {\"@type\": \"DefinedRegion\",\"addressCountry\": \"BJ\"},\"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\",\"handlingTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"},\"transitTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"}}}}
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Boost Contact\",\"item\":\"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
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
        background: linear-gradient(135deg, #064e3b 0%, #059669 55%, #10b981 100%);
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

    .section-tag { display:inline-block; background:#d1fae5; color:#065f46; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:4px 14px; border-radius:50px; margin-bottom:10px; }
    html.dark-theme .section-tag { background:rgba(16,185,129,0.15); color:#34d399; }
    .section-title { font-weight:800; color:#0f2460; font-size:clamp(1.3rem,3vw,1.8rem); margin-bottom:6px; }
    html.dark-theme .section-title { color:#fcfcfc; }
    .section-desc { color:#6c757d; font-size:0.95rem; }
    html.dark-theme .section-desc { color:#9ea4aa; }

    .feat-card { background:#fff; border-radius:18px; padding:28px 22px; border:1.5px solid #f1f3f9; box-shadow:0 2px 14px rgba(0,0,0,0.05); height:100%; transition:all 0.3s; }
    html.dark-theme .feat-card { background:#202a40; border-color:#2e3a55; box-shadow:none; }
    .feat-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(5,150,105,0.1); border-color:#a7f3d0; }
    html.dark-theme .feat-card:hover { box-shadow:0 12px 32px rgba(52,211,153,0.07); border-color:#34d399; }
    .feat-icon { width:52px; height:52px; border-radius:14px; background:#d1fae5; color:#059669; display:flex; align-items:center; justify-content:center; font-size:1.2rem; margin-bottom:14px; }
    html.dark-theme .feat-icon { background:rgba(5,150,105,0.2); color:#34d399; }
    .feat-title { font-weight:800; color:#065f46; font-size:0.97rem; margin-bottom:8px; }
    html.dark-theme .feat-title { color:#fcfcfc; }
    .feat-desc { font-size:0.87rem; color:#6c757d; line-height:1.6; margin:0; }
    html.dark-theme .feat-desc { color:#9ea4aa; }

    .notice-banner { background:#fef2f2; border:1.5px solid #fecaca; border-radius:16px; padding:18px 22px; display:flex; align-items:flex-start; gap:14px; }
    html.dark-theme .notice-banner { background:rgba(239,68,68,0.08); border-color:rgba(239,68,68,0.2); }
    .notice-banner i { color:#ef4444; font-size:1.1rem; flex-shrink:0; margin-top:2px; }
    .notice-banner p { margin:0; font-size:0.88rem; color:#7f1d1d; line-height:1.55; }
    html.dark-theme .notice-banner p { color:#fca5a5; }

    .dl-cta { background:linear-gradient(135deg,#064e3b,#059669); border-radius:24px; padding:48px 36px; text-align:center; }
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

    // line 101
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 102
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 106
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <a href=\"";
        // line 108
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\">Services</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Boost Contact</span>
        </div>
        <div class=\"hero-badge\"><i class=\"fas fa-check\"></i> Gratuit &amp; Payant</div>
        <h1><i class=\"fas fa-users me-2\" style=\"opacity:.7\"></i> Boost Contact</h1>
        <p class=\"mb-4\">Optimisez vos contacts et augmentez votre visibilité avec les algorithmes intelligents de Dressur.</p>
        <div class=\"d-flex gap-3 flex-wrap\">
            <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-google-play text-success me-2\"></i> Télécharger sur Google Play
            </a>
            <a href=\"";
        // line 119
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-user-plus me-2\"></i> S\x27inscrire gratuitement
            </a>
        </div>
    </div>
</div>

<div class=\"container my-5\">

    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Fonctionnalités</span>
        <h2 class=\"section-title\">Pourquoi choisir Boost Contact ?</h2>
        <p class=\"section-desc\">Découvrez comment Boost Contact peut transformer vos interactions professionnelles.</p>
    </div>

    <div class=\"row g-4 mb-5\">
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-magnifying-glass\"></i></div>
                <p class=\"feat-title\">Trouver de nouveaux contacts</p>
                <p class=\"feat-desc\">Nos algorithmes intelligents vous affichent les contacts en fonction de vos préférences pays et ceux des autres utilisateurs.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-clock\"></i></div>
                <p class=\"feat-title\">Gagner du temps et de l\x27énergie</p>
                <p class=\"feat-desc\">Les contacts que vous enregistrez sont automatiquement ajoutés à votre téléphone et réciproquement dans celui de votre contact.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-piggy-bank\"></i></div>
                <p class=\"feat-title\">Économiser de l\x27argent</p>
                <p class=\"feat-desc\">Plus besoin de payer pour être diffusé dans des listes de diffusion ou sur des statuts WhatsApp.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-eye\"></i></div>
                <p class=\"feat-title\">Augmenter votre visibilité</p>
                <p class=\"feat-desc\">Atteignez les personnes qui comptent vraiment pour votre activité rapidement et efficacement.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-chart-line\"></i></div>
                <p class=\"feat-title\">Booster le rendement</p>
                <p class=\"feat-desc\">Plus de contacts pertinents = plus d\x27opportunités ! Développez votre réseau et votre chiffre d\x27affaires.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-mobile-screen\"></i></div>
                <p class=\"feat-title\">Mobile &amp; Web</p>
                <p class=\"feat-desc\">Disponible sur l\x27application mobile Android (Google Play) et accessible depuis n\x27importe quel navigateur web.</p>
            </div>
        </div>
    </div>

    ";
        // line 180
        yield "    <div class=\"notice-banner mb-5\">
        <i class=\"fas fa-circle-exclamation\"></i>
        <p><strong>Note :</strong> Ce service est plus efficace depuis l\x27application mobile, car les contacts sont enregistrés automatiquement dans les téléphones. Les utilisateurs d\x27iPhone peuvent utiliser la version web de Dressur.</p>
    </div>

    ";
        // line 186
        yield "    <div class=\"dl-cta mb-5\">
        <h2><i class=\"fab fa-google-play me-2\"></i> Télécharger Dressur</h2>
        <p>Commencez à utiliser Boost Contact dès aujourd\x27hui en téléchargeant l\x27application Dressur.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\"
               class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-google-play text-success me-2\"></i> Télécharger sur Google Play
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
        // line 215
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"other-svc-item\">
                    <div class=\"other-svc-icon\" style=\"background:#fff3e0; color:#c2410c;\"><i class=\"fas fa-bullhorn\"></i></div>
                    <div>
                        <div class=\"other-svc-name\">Promotion Affaire</div>
                        <div class=\"other-svc-desc\">Promouvez vos produits, services et offres d\x27emploi auprès d\x27un public ciblé.</div>
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
        return "public/boost_contact.html.twig";
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
        return array (  375 => 224,  363 => 215,  351 => 206,  344 => 201,  335 => 194,  325 => 186,  318 => 180,  255 => 119,  241 => 108,  236 => 106,  230 => 102,  223 => 101,  164 => 45,  157 => 44,  146 => 42,  138 => 38,  131 => 34,  123 => 29,  119 => 28,  113 => 25,  107 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/boost_contact.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/boost_contact.html.twig");
    }
}
