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

/* public/tarifs.html.twig */
class __TwigTemplate_1739002614af47fc20ece0f660d8fced extends Template
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
        $context["description"] = "Sur cette page sont regroupés les tarifs de chacun des services de Dressur : Dressur Bot, Boost Contact, Promotion Affaire, Promotion réseaux sociaux...";
        // line 4
        $context["title"] = "Tarifs des services Dressur";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-tarifs.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-tarifs.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"tarif Dressur, prix kdo, prix cassé, prix gratuit, email Dressur, Facebook Dressur, application Dressur, support Dressur\" />
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
        $context["bot_prices"] = Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), Twig\Extension\CoreExtension::map($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_dressur_bots"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 21); }));
        // line 22
        $context["boost_prices"] = Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), Twig\Extension\CoreExtension::map($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_boosts"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 22); }));
        // line 23
        $context["promo_affaire_prices"] = Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), Twig\Extension\CoreExtension::map($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_promo_affaires"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 23); }));
        // line 24
        $context["reseau_prices"] = Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), Twig\Extension\CoreExtension::map($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_promo_reseaus"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return ((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 24) > 0) && CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "available", [], "any", false, false, false, 24)); }), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return (((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 24) * 1.2) * 1.7) * 700); }));
        // line 25
        $context["bot_min"] = (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["bot_prices"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["bot_prices"] ?? null))) : (0));
        // line 26
        $context["boost_min"] = (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["boost_prices"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["boost_prices"] ?? null))) : (0));
        // line 27
        $context["promo_affaire_min"] = (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["promo_affaire_prices"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["promo_affaire_prices"] ?? null))) : (0));
        // line 28
        $context["reseau_min"] = (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["reseau_prices"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["reseau_prices"] ?? null))) : (0));
        // line 29
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"ItemList\",
  \"name\": \"Tarifs des services Dressur\",
  \"description\": \"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 35
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\",
  \"itemListElement\": [
    { \"@type\": \"ListItem\", \"position\": 1, \"item\": { \"@type\": \"Service\", \"name\": \"Dressur Bot\", \"description\": \"Automatisez l\x27envoi de messages WhatsApp en masse avec Dressur Bot.\", \"url\": \"";
        // line 37
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "\", \"offers\": { \"@type\": \"Offer\", \"price\": \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bot_min"] ?? null), "html", null, true);
        yield "\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\", \"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\", \"applicableCountry\": \"BJ\", \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"}, \"shippingDetails\": {\"@type\": \"OfferShippingDetails\", \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"}, \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"}, \"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\", \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}, \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}}} } } },
    { \"@type\": \"ListItem\", \"position\": 2, \"item\": { \"@type\": \"Service\", \"name\": \"Boost Contact\", \"description\": \"Optimisez vos contacts et augmentez votre visibilité avec Dressur.\", \"url\": \"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_boost_contact");
        yield "\", \"offers\": { \"@type\": \"Offer\", \"price\": \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["boost_min"] ?? null), "html", null, true);
        yield "\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\", \"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\", \"applicableCountry\": \"BJ\", \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"}, \"shippingDetails\": {\"@type\": \"OfferShippingDetails\", \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"}, \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"}, \"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\", \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}, \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}}} } } },
    { \"@type\": \"ListItem\", \"position\": 3, \"item\": { \"@type\": \"Service\", \"name\": \"Promotion Affaire\", \"description\": \"Promouvez vos produits, services et événements auprès d\x27un public ciblé.\", \"url\": \"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_affaire");
        yield "\", \"offers\": { \"@type\": \"Offer\", \"price\": \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["promo_affaire_min"] ?? null), "html", null, true);
        yield "\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\", \"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\", \"applicableCountry\": \"BJ\", \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"}, \"shippingDetails\": {\"@type\": \"OfferShippingDetails\", \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"}, \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"}, \"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\", \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}, \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}}} } } },
    { \"@type\": \"ListItem\", \"position\": 4, \"item\": { \"@type\": \"Service\", \"name\": \"Promotions Réseaux Sociaux\", \"description\": \"Achetez des abonnés, likes, vues sur Facebook, TikTok, Instagram, YouTube et plus.\", \"url\": \"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\", \"offers\": { \"@type\": \"Offer\", \"price\": \"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["reseau_min"] ?? null), "html", null, true);
        yield "\", \"priceCurrency\": \"XOF\", \"availability\": \"https://schema.org/InStock\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\", \"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\", \"applicableCountry\": \"BJ\", \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"}, \"shippingDetails\": {\"@type\": \"OfferShippingDetails\", \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"}, \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"}, \"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\", \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}, \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}}} } } }
  ]
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Tarifs\",\"item\":\"";
        // line 45
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\"}]}
</script>
<script type=\"application/ld+json\">
{ \"@context\": \"https://schema.org\", \"@type\": \"FAQPage\", \"mainEntity\": [ { \"@type\": \"Question\", \"name\": \"Le service Boost Contact de Dressur est-il gratuit ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Oui, le service Boost Contact est disponible en mode Gratuit et en mode Payant. La formule gratuite vous permet déjà de trouver de nouveaux contacts et d\x27augmenter votre visibilité.\" } }, { \"@type\": \"Question\", \"name\": \"Le service Promotion Affaire de Dressur est-il payant ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Oui, le service Promotion Affaire est un service entièrement payant. Il vous permet de publier vos produits, services et offres d\x27emploi auprès d\x27un public ciblé. Plusieurs formules sont disponibles selon vos besoins.\" } }, { \"@type\": \"Question\", \"name\": \"Dressur Bot est-il gratuit ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Non, Dressur Bot est un service payant proposé sous forme d\x27abonnement en FCFA. Plusieurs formules sont disponibles selon la durée d\x27activation souhaitée.\" } }, { \"@type\": \"Question\", \"name\": \"Quels réseaux sociaux sont supportés par le service Promotions Réseaux Sociaux ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Dressur prend en charge Facebook, TikTok, Instagram, YouTube, Twitter, Telegram, Twitch, Spotify et bien d\x27autres plateformes. Les tarifs peuvent varier en fonction des plateformes.\" } }, { \"@type\": \"Question\", \"name\": \"Comment contacter l\x27assistance Dressur pour des questions sur les tarifs ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Vous pouvez contacter l\x27assistance Dressur via WhatsApp au +229 64 04 42 94 ou par email à dressur.ds@gmail.com. L\x27équipe vous répondra dans les meilleurs délais.\" } }, { \"@type\": \"Question\", \"name\": \"Les tarifs de Dressur sont-ils en FCFA ?\", \"acceptedAnswer\": { \"@type\": \"Answer\", \"text\": \"Oui, tous les tarifs des services Dressur sont exprimés en Francs CFA (FCFA), la monnaie utilisée en Afrique de l\x27Ouest.\" } } ] }
</script>
";
        yield from [];
    }

    // line 52
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 54
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 55
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

    /* Nav tabs */
    .tarif-nav { border-bottom: none; gap: 8px; flex-wrap: wrap; }
    .tarif-nav .nav-link {
        border: 1.5px solid #e9ecef;
        border-radius: 50px;
        color: #374151;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 7px 20px;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: all 0.2s;
        background: #fff;
    }
    html.dark-theme .tarif-nav .nav-link { background: #202a40; border-color: #2e3a55; color: #c8cdd4; }
    .tarif-nav .nav-link:hover { border-color: #1a3a8f; color: #1a3a8f; }
    html.dark-theme .tarif-nav .nav-link:hover { border-color: #4fc3f7; color: #4fc3f7; }
    .tarif-nav .nav-link.active {
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        color: #fff !important;
        border-color: transparent;
        box-shadow: 0 4px 14px rgba(26,58,143,0.3);
    }

    /* Service section */
    .tarif-section {
        background: #fff;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.07);
        margin-bottom: 24px;
    }
    html.dark-theme .tarif-section { background: #202a40; box-shadow: 0 3px 20px rgba(0,0,0,0.25); }
    .tarif-service-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        padding-bottom: 18px;
        border-bottom: 1.5px solid #f1f3f9;
    }
    html.dark-theme .tarif-service-header { border-color: #2e3a55; }
    .tarif-service-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .tarif-service-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f2460;
        margin: 0;
        line-height: 1.2;
    }
    html.dark-theme .tarif-service-title { color: #fcfcfc; }
    .tarif-service-desc { font-size: 0.87rem; color: #6c757d; margin: 3px 0 0; }
    html.dark-theme .tarif-service-desc { color: #9ea4aa; }

    /* Tables */
    .tarif-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .tarif-table thead tr { background: #f1f5fd; }
    html.dark-theme .tarif-table thead tr { background: #1a2232; }
    .tarif-table thead th {
        padding: 12px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #1a3a8f;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }
    html.dark-theme .tarif-table thead th { color: #4fc3f7; }
    .tarif-table thead th:first-child { border-radius: 10px 0 0 10px; }
    .tarif-table thead th:last-child  { border-radius: 0 10px 10px 0; }
    .tarif-table tbody tr {
        border-bottom: 1px solid #f1f3f9;
        transition: background 0.15s;
    }
    html.dark-theme .tarif-table tbody tr { border-color: #2e3a55; }
    .tarif-table tbody tr:hover { background: #f8f9ff; }
    html.dark-theme .tarif-table tbody tr:hover { background: rgba(79,195,247,0.04); }
    .tarif-table tbody tr:last-child { border-bottom: none; }
    .tarif-table tbody td {
        padding: 13px 16px;
        font-size: 0.9rem;
        color: #374151;
        border: none;
        vertical-align: middle;
    }
    html.dark-theme .tarif-table tbody td { color: #c8cdd4; }
    .tarif-table .price-cell {
        font-weight: 800;
        color: #0f2460;
        font-size: 0.95rem;
    }
    html.dark-theme .tarif-table .price-cell { color: #4fc3f7; }
    .tarif-note {
        font-size: 0.83rem;
        color: #6c757d;
        background: #f8f9ff;
        border-left: 3px solid #1a3a8f;
        border-radius: 0 8px 8px 0;
        padding: 10px 14px;
        margin-top: 16px;
    }
    html.dark-theme .tarif-note { background: #1a2232; border-color: #4fc3f7; color: #9ea4aa; }

    /* Sticky nav */
    .tarif-sticky-nav { position: sticky; top: 70px; z-index: 10; background: #f8f9ff; padding: 16px 0; margin-bottom: 28px; }
    html.dark-theme .tarif-sticky-nav { background: #1a2232; }

    /* CTA strip */
    .tarif-cta {
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        border-radius: 20px;
        padding: 36px;
        text-align: center;
        margin-top: 32px;
    }
    .tarif-cta h4 { color: #fff; font-weight: 800; margin-bottom: 8px; }
    .tarif-cta p  { color: rgba(255,255,255,0.8); font-size: 0.9rem; margin-bottom: 20px; }
</style>
";
        yield from [];
    }

    // line 213
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 214
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 218
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Tarifs</span>
        </div>
        <h1><i class=\"fas fa-tags me-2\" style=\"opacity:.7\"></i> Tarifs</h1>
        <p>Tous les prix de nos services, transparents et à jour en FCFA</p>
    </div>
</div>

<div class=\"container my-5\">

    ";
        // line 230
        yield "    <div class=\"tarif-sticky-nav\">
        <ul class=\"nav tarif-nav\">
            <li class=\"nav-item\">
                <a class=\"nav-link active\" href=\"#dressur-bot\"><i class=\"fas fa-robot\"></i> Dressur Bot</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#boost-contact\"><i class=\"fas fa-users\"></i> Boost Contact</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#promo-affaire\"><i class=\"fas fa-bullhorn\"></i> Promotion Affaire</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#promo-reseau\"><i class=\"fas fa-thumbs-up\"></i> Réseaux Sociaux</a>
            </li>
        </ul>
    </div>

    ";
        // line 248
        yield "    <div class=\"tarif-section\" id=\"dressur-bot\">
        <div class=\"tarif-service-header\">
            <div class=\"tarif-service-icon\" style=\"background:#e8f0fe; color:#1a3a8f;\">
                <i class=\"fas fa-robot\"></i>
            </div>
            <div>
                <p class=\"tarif-service-title\"><a href=\"";
        // line 254
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" style=\"color:inherit; text-decoration:none;\">1. Dressur Bot</a></p>
                <p class=\"tarif-service-desc\">Automatisez l\x27envoi de messages WhatsApp en masse — nombre de messages illimité pendant la durée d\x27activation.</p>
            </div>
        </div>
        <div class=\"table-responsive\">
            <table class=\"tarif-table\">
                <thead>
                    <tr>
                        <th>Formule</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>Signature Dressur</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 269
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_dressur_bots"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 270
            yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
            // line 271
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 271), "html", null, true);
            yield "</span></td>
                        <td class=\"price-cell\">";
            // line 272
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 272), "html", null, true);
            yield " FCFA</td>
                        <td>";
            // line 273
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 273), "html", null, true);
            yield " jour(s)</td>
                        <td>
                            ";
            // line 275
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["f"], "signature", [], "any", false, false, false, 275) == "oui")) {
                // line 276
                yield "                                <span class=\"badge rounded-pill\" style=\"background:#fee2e2; color:#b91c1c; font-weight:600; font-size:.78rem;\">
                                    <i class=\"fas fa-signature me-1\"></i> Oui
                                </span>
                            ";
            } else {
                // line 280
                yield "                                <span class=\"badge rounded-pill\" style=\"background:#d1fae5; color:#065f46; font-weight:600; font-size:.78rem;\">
                                    <i class=\"fas fa-check me-1\"></i> Non
                                </span>
                            ";
            }
            // line 284
            yield "                        </td>
                    </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 287
        yield "                </tbody>
            </table>
        </div>
        <div class=\"tarif-note\">
            <i class=\"fas fa-info-circle me-2\"></i>
            Le nombre de messages envoyés n\x27est pas limité. Attention toutefois au volume envoyé depuis un même compte WhatsApp pour éviter une suspension.
        </div>
    </div>

    ";
        // line 297
        yield "    <div class=\"tarif-section\" id=\"boost-contact\">
        <div class=\"tarif-service-header\">
            <div class=\"tarif-service-icon\" style=\"background:#d1fae5; color:#065f46;\">
                <i class=\"fas fa-users\"></i>
            </div>
            <div>
                <p class=\"tarif-service-title\"><a href=\"";
        // line 303
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" style=\"color:inherit; text-decoration:none;\">2. Boost Contact</a></p>
                <p class=\"tarif-service-desc\">Disponible en mode <span class=\"fw-bold text-success\">Gratuit</span> et <span class=\"fw-bold text-danger\">Payant</span>. Ci-dessous les formules payantes.</p>
            </div>
        </div>
        ";
        // line 307
        $context["formule_boosts_duree_gratuit"] = Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_boosts"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return ((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "typeBoost", [], "any", false, false, false, 307) != "quota") && (CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 307) <= 0)); });
        // line 308
        yield "        ";
        $context["formule_boosts_quota_gratuit"] = Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_boosts"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return ((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "typeBoost", [], "any", false, false, false, 308) == "quota") && (CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 308) <= 0)); });
        // line 309
        yield "        ";
        $context["formule_boosts_duree_payant"] = Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_boosts"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return ((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "typeBoost", [], "any", false, false, false, 309) != "quota") && (CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 309) > 0)); });
        // line 310
        yield "        ";
        $context["formule_boosts_quota_payant"] = Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["formule_boosts"] ?? null), function ($__f__) use ($context, $macros) { $context["f"] = $__f__; return ((CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "typeBoost", [], "any", false, false, false, 310) == "quota") && (CoreExtension::getAttribute($this->env, $this->source, ($context["f"] ?? null), "prix", [], "any", false, false, false, 310) > 0)); });
        // line 311
        yield "
        ";
        // line 312
        if (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["formule_boosts_duree_gratuit"] ?? null)) > 0) || (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["formule_boosts_quota_gratuit"] ?? null)) > 0))) {
            // line 313
            yield "        <p class=\"fw-semibold mt-3 mb-2 text-success\"><i class=\"fas fa-gift me-1\"></i> Gratuit</p>
        <div class=\"table-responsive\">
            <table class=\"tarif-table\">
                <thead>
                    <tr>
                        <th>Formule</th>
                        <th>Type</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    ";
            // line 324
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_boosts_duree_gratuit"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 325
                yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
                // line 326
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 326), "html", null, true);
                yield "</span></td>
                        <td>Par durée</td>
                        <td>";
                // line 328
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 328), "html", null, true);
                yield " jour(s)</td>
                    </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 331
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_boosts_quota_gratuit"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 332
                yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
                // line 333
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 333), "html", null, true);
                yield "</span></td>
                        <td>Par quota</td>
                        <td>";
                // line 335
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbContactsMax", [], "any", false, false, false, 335), "html", null, true);
                yield " contact(s)</td>
                    </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 338
            yield "                </tbody>
            </table>
        </div>
        ";
        }
        // line 342
        yield "
        ";
        // line 343
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["formule_boosts_duree_payant"] ?? null)) > 0)) {
            // line 344
            yield "        <p class=\"fw-semibold mt-3 mb-2 text-danger\"><i class=\"fas fa-calendar-days me-1\"></i> Payant — Par durée</p>
        <div class=\"table-responsive\">
            <table class=\"tarif-table\">
                <thead>
                    <tr>
                        <th>Formule</th>
                        <th>Prix</th>
                        <th>Durée</th>
                    </tr>
                </thead>
                <tbody>
                    ";
            // line 355
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_boosts_duree_payant"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 356
                yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
                // line 357
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 357), "html", null, true);
                yield "</span></td>
                        <td class=\"price-cell\">";
                // line 358
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 358), "html", null, true);
                yield " FCFA</td>
                        <td>";
                // line 359
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 359), "html", null, true);
                yield " jour(s)</td>
                    </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 362
            yield "                </tbody>
            </table>
        </div>
        ";
        }
        // line 366
        yield "
        ";
        // line 367
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["formule_boosts_quota_payant"] ?? null)) > 0)) {
            // line 368
            yield "        <p class=\"fw-semibold mt-3 mb-2 text-danger\"><i class=\"fas fa-address-book me-1\"></i> Payant — Par quota</p>
        <div class=\"table-responsive\">
            <table class=\"tarif-table\">
                <thead>
                    <tr>
                        <th>Formule</th>
                        <th>Prix</th>
                        <th>Contacts</th>
                    </tr>
                </thead>
                <tbody>
                    ";
            // line 379
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_boosts_quota_payant"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 380
                yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
                // line 381
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 381), "html", null, true);
                yield "</span></td>
                        <td class=\"price-cell\">";
                // line 382
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 382), "html", null, true);
                yield " FCFA</td>
                        <td>";
                // line 383
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbContactsMax", [], "any", false, false, false, 383), "html", null, true);
                yield " contact(s)</td>
                    </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 386
            yield "                </tbody>
            </table>
        </div>
        ";
        }
        // line 390
        yield "    </div>

    ";
        // line 393
        yield "    <div class=\"tarif-section\" id=\"promo-affaire\">
        <div class=\"tarif-service-header\">
            <div class=\"tarif-service-icon\" style=\"background:#fff3e0; color:#c2410c;\">
                <i class=\"fas fa-bullhorn\"></i>
            </div>
            <div>
                <p class=\"tarif-service-title\"><a href=\"";
        // line 399
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" style=\"color:inherit; text-decoration:none;\">3. Promotion Affaire</a></p>
                <p class=\"tarif-service-desc\">Service <span class=\"fw-bold text-danger\">Payant</span>. Publiez vos produits, services, offres d\x27emploi auprès d\x27un public ciblé.</p>
            </div>
        </div>
        <div class=\"table-responsive\">
            <table class=\"tarif-table\">
                <thead>
                    <tr>
                        <th>Formule</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>SEO</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 414
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_promo_affaires"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 415
            yield "                    <tr>
                        <td><span class=\"fw-semibold\">";
            // line 416
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 416), "html", null, true);
            yield "</span></td>
                        <td class=\"price-cell\">";
            // line 417
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 417), "html", null, true);
            yield " FCFA</td>
                        <td>";
            // line 418
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 418), "html", null, true);
            yield " jour(s)</td>
                        <td>
                            ";
            // line 420
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["f"], "referencement", [], "any", false, false, false, 420)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge rounded-pill\" style=\"background:#d1fae5;color:#065f46;font-weight:600;font-size:.78rem;\"><i class=\"fas fa-check me-1\"></i>Oui</span>") : ("<span class=\"badge rounded-pill\" style=\"background:#fee2e2;color:#b91c1c;font-weight:600;font-size:.78rem;\">Non</span>"));
            // line 422
            yield "
                        </td>
                    </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 425
        if (!$context['_iterated']) {
            // line 426
            yield "                    <tr><td colspan=\"4\" class=\"text-center text-muted py-4\">Aucune formule disponible</td></tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['f'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 428
        yield "                </tbody>
            </table>
        </div>
    </div>

    ";
        // line 434
        yield "    <div class=\"tarif-section\" id=\"promo-reseau\">
        <div class=\"tarif-service-header\">
            <div class=\"tarif-service-icon\" style=\"background:#f3e8ff; color:#7c3aed;\">
                <i class=\"fas fa-thumbs-up\"></i>
            </div>
            <div>
                <p class=\"tarif-service-title\"><a href=\"";
        // line 440
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" style=\"color:inherit; text-decoration:none;\">4. Promotions Réseaux Sociaux</a></p>
                <p class=\"tarif-service-desc\">Augmentez votre visibilité sur les réseaux sociaux. Les tarifs peuvent varier selon les plateformes.</p>
            </div>
        </div>
        ";
        // line 444
        $context["reseau_icons"] = ["facebook" => "fa-brands fa-facebook", "instagram" => "fa-brands fa-instagram", "tiktok" => "fa-brands fa-tiktok", "youtube" => "fa-brands fa-youtube", "telegram" => "fa-brands fa-telegram", "twitter" => "fa-brands fa-x-twitter", "twitch" => "fa-brands fa-twitch", "spotify" => "fa-brands fa-spotify"];
        // line 454
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["promo_reseau_groups"] ?? null));
        foreach ($context['_seq'] as $context["reseau_name"] => $context["items"]) {
            // line 455
            yield "            <p class=\"fw-semibold mt-3 mb-2\">
                <i class=\"";
            // line 456
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["reseau_icons"] ?? null), Twig\Extension\CoreExtension::lower($this->env->getCharset(), $context["reseau_name"]), [], "array", true, true, false, 456)) ? (Twig\Extension\CoreExtension::default((($_v0 = ($context["reseau_icons"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[Twig\Extension\CoreExtension::lower($this->env->getCharset(), $context["reseau_name"])] ?? null) : null), "fas fa-share-nodes")) : ("fas fa-share-nodes")), "html", null, true);
            yield " me-1\"></i> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["reseau_name"], "html", null, true);
            yield "
            </p>
            <div class=\"table-responsive\">
                <table class=\"tarif-table\">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Prix / 1000</th>
                            <th>Qté</th>
                            <th>Min</th>
                            <th>Max</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
            // line 470
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["items"]);
            foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
                // line 471
                yield "                        <tr>
                            <td><span class=\"fw-semibold\">";
                // line 472
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 472), "html", null, true);
                yield "</span></td>
                            <td class=\"price-cell\">";
                // line 473
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((((CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 473) * 1.2) * 1.7) * 700), "html", null, true);
                yield " FCFA</td>
                            <td>";
                // line 474
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "qte", [], "any", false, false, false, 474), "html", null, true);
                yield "</td>
                            <td>";
                // line 475
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "qteMin", [], "any", false, false, false, 475), "html", null, true);
                yield "</td>
                            <td>";
                // line 476
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "qteMax", [], "any", false, false, false, 476), "html", null, true);
                yield "</td>
                        </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 479
            yield "                    </tbody>
                </table>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['reseau_name'], $context['items'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 483
        yield "    </div>

    ";
        // line 486
        yield "    <div class=\"tarif-cta\">
        <h4><i class=\"fas fa-headset me-2\"></i> Un doute sur un tarif ?</h4>
        <p>Notre équipe est disponible sur WhatsApp pour répondre à toutes vos questions.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"https://wa.me/+22964044294\" target=\"_blank\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-whatsapp text-success me-2\"></i> WhatsApp
            </a>
            <a href=\"";
        // line 493
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contactez_nous");
        yield "\" class=\"btn btn-outline-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-envelope me-2\"></i> Nous contacter
            </a>
        </div>
    </div>

</div>
";
        yield from [];
    }

    // line 502
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 503
        yield "<script>
(function () {
    var navLinks = document.querySelectorAll(\x27.tarif-nav .nav-link\x27);
    navLinks.forEach(function (link) {
        link.addEventListener(\x27click\x27, function (e) {
            navLinks.forEach(function (l) { l.classList.remove(\x27active\x27); });
            link.classList.add(\x27active\x27);
        });
    });
    window.addEventListener(\x27scroll\x27, function () {
        var ids = [\x27dressur-bot\x27, \x27boost-contact\x27, \x27promo-affaire\x27, \x27promo-reseau\x27];
        var current = \x27\x27;
        ids.forEach(function (id) {
            var el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - 140) { current = id; }
        });
        navLinks.forEach(function (link) {
            link.classList.remove(\x27active\x27);
            if (link.getAttribute(\x27href\x27) === \x27#\x27 + current) { link.classList.add(\x27active\x27); }
        });
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
        return "public/tarifs.html.twig";
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
        return array (  874 => 503,  867 => 502,  854 => 493,  845 => 486,  841 => 483,  832 => 479,  823 => 476,  819 => 475,  815 => 474,  811 => 473,  807 => 472,  804 => 471,  800 => 470,  781 => 456,  778 => 455,  773 => 454,  771 => 444,  764 => 440,  756 => 434,  749 => 428,  742 => 426,  740 => 425,  733 => 422,  731 => 420,  726 => 418,  722 => 417,  718 => 416,  715 => 415,  710 => 414,  692 => 399,  684 => 393,  680 => 390,  674 => 386,  665 => 383,  661 => 382,  657 => 381,  654 => 380,  650 => 379,  637 => 368,  635 => 367,  632 => 366,  626 => 362,  617 => 359,  613 => 358,  609 => 357,  606 => 356,  602 => 355,  589 => 344,  587 => 343,  584 => 342,  578 => 338,  569 => 335,  564 => 333,  561 => 332,  556 => 331,  547 => 328,  542 => 326,  539 => 325,  535 => 324,  522 => 313,  520 => 312,  517 => 311,  514 => 310,  511 => 309,  508 => 308,  506 => 307,  499 => 303,  491 => 297,  480 => 287,  472 => 284,  466 => 280,  460 => 276,  458 => 275,  453 => 273,  449 => 272,  445 => 271,  442 => 270,  438 => 269,  420 => 254,  412 => 248,  393 => 230,  379 => 218,  373 => 214,  366 => 213,  205 => 55,  198 => 54,  187 => 52,  176 => 45,  164 => 40,  156 => 39,  148 => 38,  140 => 37,  135 => 35,  131 => 34,  124 => 29,  122 => 28,  120 => 27,  118 => 26,  116 => 25,  114 => 24,  112 => 23,  110 => 22,  108 => 21,  101 => 20,  93 => 16,  88 => 14,  84 => 13,  78 => 10,  73 => 8,  68 => 7,  61 => 6,  56 => 1,  54 => 4,  52 => 3,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/tarifs.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/tarifs.html.twig");
    }
}
