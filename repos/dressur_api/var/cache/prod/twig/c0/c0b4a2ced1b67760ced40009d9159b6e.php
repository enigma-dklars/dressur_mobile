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

/* public/dressur_bot.html.twig */
class __TwigTemplate_a6fcd69c36b38651a76194255ce11089 extends Template
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
        $context["embedLink"] = "https://www.youtube.com/embed/gBXp67DxnL4";
        // line 4
        $context["youtubeLink"] = "https://www.youtube.com/watch?v=gBXp67DxnL4";
        // line 5
        $context["description"] = "Dressur Bot est une application Windows qui automatise l\x27envoi de messages sur WhatsApp Web et Desktop. Simplifiez vos campagnes de communication en masse en fournissant simplement le texte du message et un fichier VCF contenant les contacts. Idéal pour les entreprises et les professionnels.";
        // line 6
        $context["title"] = "Dressur Bot";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-dressur-bot.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-dressur-bot.jpg\" />
    <meta name=\"description\" content=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, Dressur Bot, automatisation WhatsApp, envoi de messages WhatsApp, WhatsApp Web, WhatsApp Desktop, fichier VCF, communication en masse, marketing WhatsApp, bot WhatsApp, application Windows\">
";
        yield from [];
    }

    // line 22
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 23
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"SoftwareApplication\",
  \"@id\": \"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "#software\",
  \"name\": \"Dressur Bot\",
  \"description\": \"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 30
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "\",
  \"downloadUrl\": \"https://dressur.site/assets/dressur_bot/dressur_bot.exe\",
  \"operatingSystem\": \"Windows\",
  \"applicationCategory\": \"BusinessApplication\",
  \"softwareVersion\": \"1.0\",
  \"screenshot\": \"https://dressur.site/assets/img/og/og-dressur-bot.jpg\",
  \"featureList\": [\"Automatisation de l\x27envoi de messages WhatsApp\",\"Compatible WhatsApp Web et WhatsApp Desktop\",\"Support des fichiers VCF pour les contacts\",\"Communication en masse sans limitation\"],
  \"author\": {\"@type\": \"Organization\",\"name\": \"Dressur\",\"url\": \"https://dressur.site\",\"@id\": \"https://dressur.site/#organization\"},
  \"offers\": {\"@type\": \"Offer\",\"price\": \"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min_price"] ?? null), "html", null, true);
        yield "\",\"priceCurrency\": \"XOF\",\"availability\": \"https://schema.org/InStock\",\"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\",\"hasMerchantReturnPolicy\": {\"@type\": \"MerchantReturnPolicy\",\"applicableCountry\": \"BJ\",\"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"},\"shippingDetails\": {\"@type\": \"OfferShippingDetails\",\"shippingRate\": {\"@type\": \"MonetaryAmount\",\"value\": \"0\",\"currency\": \"XOF\"},\"shippingDestination\": {\"@type\": \"DefinedRegion\",\"addressCountry\": \"BJ\"},\"deliveryTime\": {\"@type\": \"ShippingDeliveryTime\",\"handlingTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"},\"transitTime\": {\"@type\": \"QuantitativeValue\",\"minValue\": 0,\"maxValue\": 0,\"unitCode\": \"DAY\"}}}},
  \"sameAs\": \"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_tarifs");
        yield "\"
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Dressur Bot\",\"item\":\"";
        // line 43
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_dressur_bot");
        yield "\"}]}
</script>
";
        yield from [];
    }

    // line 47
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 49
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 50
        yield "<style>
    .page-hero {
        background: linear-gradient(135deg, #0f2460 0%, #1a3a8f 55%, #1565c0 100%);
        padding: 56px 0 44px;
        position: relative; overflow: hidden;
    }
    .page-hero::before { content:\x27\x27; position:absolute; top:-80px; right:-80px; width:280px; height:280px; border-radius:50%; background:rgba(255,255,255,0.04); pointer-events:none; }
    .page-hero::after  { content:\x27\x27; position:absolute; bottom:-60px; left:-60px; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,0.03); pointer-events:none; }
    .page-hero-breadcrumb { display:flex; align-items:center; gap:8px; font-size:0.82rem; color:rgba(255,255,255,0.6); margin-bottom:14px; }
    .page-hero-breadcrumb a { color:rgba(255,255,255,0.7); text-decoration:none; }
    .page-hero-breadcrumb a:hover { color:#fff; }
    .page-hero h1 { color:#fff; font-weight:800; font-size:clamp(1.8rem,4vw,2.6rem); margin-bottom:10px; }
    .page-hero p  { color:rgba(255,255,255,0.78); font-size:1rem; margin-bottom:0; }
    .hero-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); color:#fff; padding:4px 14px; border-radius:50px; font-size:0.8rem; font-weight:600; margin-bottom:14px; }

    .section-tag { display:inline-block; background:#e8f0fe; color:#1a3a8f; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; padding:4px 14px; border-radius:50px; margin-bottom:10px; }
    html.dark-theme .section-tag { background:#1a3a8f; color:#e8f0fe; }
    .section-title { font-weight:800; color:#0f2460; font-size:clamp(1.3rem,3vw,1.8rem); margin-bottom:6px; }
    html.dark-theme .section-title { color:#fcfcfc; }
    .section-desc { color:#6c757d; font-size:0.95rem; }
    html.dark-theme .section-desc { color:#9ea4aa; }

    /* Feature cards */
    .feat-card { background:#fff; border-radius:18px; padding:28px 22px; border:1.5px solid #f1f3f9; box-shadow:0 2px 14px rgba(0,0,0,0.05); height:100%; transition:all 0.3s; }
    html.dark-theme .feat-card { background:#202a40; border-color:#2e3a55; box-shadow:none; }
    .feat-card:hover { transform:translateY(-4px); box-shadow:0 12px 32px rgba(26,58,143,0.1); border-color:#d0dcff; }
    html.dark-theme .feat-card:hover { box-shadow:0 12px 32px rgba(79,195,247,0.07); border-color:#4fc3f7; }
    .feat-icon { width:52px; height:52px; border-radius:14px; background:#e8f0fe; color:#1a3a8f; display:flex; align-items:center; justify-content:center; font-size:1.2rem; margin-bottom:14px; }
    html.dark-theme .feat-icon { background:rgba(26,58,143,0.3); color:#4fc3f7; }
    .feat-title { font-weight:800; color:#0f2460; font-size:0.97rem; margin-bottom:8px; }
    html.dark-theme .feat-title { color:#fcfcfc; }
    .feat-desc { font-size:0.87rem; color:#6c757d; line-height:1.6; margin:0; }
    html.dark-theme .feat-desc { color:#9ea4aa; }

    /* Video */
    .video-wrap { border-radius:18px; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,0.12); }
    .video-wrap iframe { display:block; width:100%; height:370px; border:0; }

    /* Download CTA */
    .dl-cta { background:linear-gradient(135deg,#0f2460,#1a3a8f); border-radius:24px; padding:48px 36px; text-align:center; }
    .dl-cta h2 { color:#fff; font-weight:800; margin-bottom:10px; }
    .dl-cta p  { color:rgba(255,255,255,0.78); margin-bottom:24px; }
    .btn-dl { background:#fff; color:#0f2460; border:none; border-radius:50px; padding:13px 30px; font-weight:800; font-size:0.95rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; box-shadow:0 4px 16px rgba(0,0,0,0.15); transition:all 0.2s; }
    .btn-dl:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.2); color:#0f2460; }
    .btn-yt { background:transparent; border:2px solid rgba(255,255,255,0.5); color:#fff; border-radius:50px; padding:11px 24px; font-weight:700; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:7px; transition:all 0.2s; }
    .btn-yt:hover { border-color:#fff; background:rgba(255,255,255,0.08); color:#fff; }

    /* Other services strip */
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

    // line 111
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 112
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 116
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <a href=\"";
        // line 118
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\">Services</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Dressur Bot</span>
        </div>
        <div class=\"hero-badge\"><i class=\"fab fa-windows\"></i> Application Windows</div>
        <h1><i class=\"fas fa-robot me-2\" style=\"opacity:.7\"></i> Dressur Bot</h1>
        <p class=\"mb-4\">Automatisez l\x27envoi de messages WhatsApp en masse — jusqu\x27à 1 million de contacts, sans bug.</p>
        <div class=\"d-flex gap-3 flex-wrap\">
            <a href=\"/assets/dressur_bot/dressur_bot.exe\" class=\"btn btn-light rounded-pill px-4 fw-bold\">
                <i class=\"fas fa-download me-2\"></i> Télécharger Dressur Bot
            </a>
            <a href=\"";
        // line 129
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["youtubeLink"] ?? null), "html", null, true);
        yield "\" target=\"_blank\" class=\"btn btn-danger rounded-pill px-4 fw-bold\">
                <i class=\"fab fa-youtube me-2\"></i> Tutoriel vidéo
            </a>
        </div>
    </div>
</div>

<div class=\"container my-5\">

    ";
        // line 139
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Fonctionnalités</span>
        <h2 class=\"section-title\">Pourquoi choisir Dressur Bot ?</h2>
        <p class=\"section-desc\">Découvrez comment Dressur Bot peut transformer vos communications WhatsApp.</p>
    </div>
    <div class=\"row g-4 mb-5\">
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-infinity\"></i></div>
                <p class=\"feat-title\">Automatisation complète</p>
                <p class=\"feat-desc\">Envoyez des messages à vos contacts sur WhatsApp sans intervention manuelle. Dressur Bot supporte l\x27action répétitive jusqu\x27à plus de 1 000 000 de fois sans bug.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fab fa-whatsapp\"></i></div>
                <p class=\"feat-title\">Compatibilité étendue</p>
                <p class=\"feat-desc\">Fonctionne avec WhatsApp Web et WhatsApp Desktop, offrant une flexibilité totale. Peu importe votre environnement de travail, Dressur Bot s\x27adapte.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-wand-magic-sparkles\"></i></div>
                <p class=\"feat-title\">Simplicité d\x27utilisation</p>
                <p class=\"feat-desc\">Il suffit de fournir le texte du message et un fichier VCF contenant les contacts. En quelques clics, vos messages sont prêts à être envoyés.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-clock\"></i></div>
                <p class=\"feat-title\">Gain de temps significatif</p>
                <p class=\"feat-desc\">Éliminez la tâche répétitive d\x27envoyer des messages individuels. Concentrez-vous sur ce qui compte pendant que Dressur Bot s\x27occupe du reste.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-bolt\"></i></div>
                <p class=\"feat-title\">Efficacité inégalée</p>
                <p class=\"feat-desc\">Idéal pour les campagnes de marketing, notifications de groupe et besoins de communication en masse. Atteignez votre audience cible rapidement.</p>
            </div>
        </div>
        <div class=\"col-md-4\">
            <div class=\"feat-card\">
                <div class=\"feat-icon\"><i class=\"fas fa-shield-halved\"></i></div>
                <p class=\"feat-title\">Sécurité et confidentialité</p>
                <p class=\"feat-desc\">Dressur Bot respecte votre confidentialité et celle de vos contacts. Vos données sont protégées par des protocoles de sécurité avancés.</p>
            </div>
        </div>
    </div>

    ";
        // line 190
        yield "    <div class=\"text-center mb-4\">
        <span class=\"section-tag\">Tutoriel</span>
        <h2 class=\"section-title\">Comment utiliser Dressur Bot ?</h2>
        <p class=\"section-desc\">Regardez notre tutoriel pour démarrer en quelques minutes.</p>
    </div>
    <div class=\"row justify-content-center mb-5\">
        <div class=\"col-lg-8\">
            <div class=\"video-wrap\">
                <iframe src=\"";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["embedLink"] ?? null), "html", null, true);
        yield "\" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    ";
        // line 204
        yield "    <div class=\"dl-cta mb-5\">
        <h2><i class=\"fas fa-download me-2\"></i> Télécharger Dressur Bot</h2>
        <p>Commencez à utiliser Dressur Bot dès aujourd\x27hui en téléchargeant le fichier .exe pour Windows.</p>
        <div class=\"d-flex gap-3 justify-content-center flex-wrap\">
            <a href=\"/assets/dressur_bot/dressur_bot.exe\" class=\"btn-dl\">
                <i class=\"fas fa-download\"></i> Télécharger (.exe)
            </a>
            <a href=\"";
        // line 211
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn-yt\">
                <i class=\"fas fa-tags me-2\"></i> Voir les tarifs
            </a>
        </div>
    </div>

    ";
        // line 218
        yield "    <div class=\"other-svc-strip\">
        <h3 class=\"section-title mb-1\" style=\"font-size:1.1rem;\"><i class=\"fas fa-grid-2 me-2\" style=\"color:#1a3a8f;opacity:.7\"></i> Autres services Dressur</h3>
        <p class=\"section-desc mb-4\">Découvrez aussi nos autres solutions.</p>
        <div class=\"row g-3\">
            <div class=\"col-md-4\">
                <a href=\"";
        // line 223
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
        // line 232
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
        // line 241
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
        return "public/dressur_bot.html.twig";
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
        return array (  403 => 241,  391 => 232,  379 => 223,  372 => 218,  363 => 211,  354 => 204,  346 => 198,  336 => 190,  284 => 139,  272 => 129,  258 => 118,  253 => 116,  247 => 112,  240 => 111,  176 => 50,  169 => 49,  158 => 47,  150 => 43,  143 => 39,  137 => 38,  126 => 30,  122 => 29,  117 => 27,  111 => 23,  104 => 22,  96 => 18,  91 => 16,  87 => 15,  81 => 12,  76 => 10,  71 => 9,  64 => 8,  59 => 1,  57 => 6,  55 => 5,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/dressur_bot.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/dressur_bot.html.twig");
    }
}
