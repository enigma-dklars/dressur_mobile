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

/* public/contactez_nous.html.twig */
class __TwigTemplate_a203760d899747dd5c07ac3468d71e75 extends Template
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
        $context["description"] = "Contactez-nous pour toute question ou demande d\x27information. Retrouvez nos coordonnées et comment nous joindre facilement.";
        // line 4
        $context["title"] = "Contacts";
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
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-contactez-nous.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_contactez_nous");
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
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/og/og-contactez-nous.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"contact Dressur, nous joindre, coordonnées Dressur, WhatsApp Dressur, email Dressur, Facebook Dressur, application Dressur, support Dressur\" />
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
    { \"@type\": \"ContactPage\", \"name\": \"Contactez Dressur\", \"description\": \"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\", \"url\": \"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_contactez_nous");
        yield "\", \"mainEntity\": { \"@id\": \"https://dressur.site/#organization\" } },
    { \"@type\": \"Organization\", \"@id\": \"https://dressur.site/#organization\", \"name\": \"Dressur\", \"url\": \"https://dressur.site\", \"logo\": \"https://dressur.site/assets/images/dressur_logo_blanc.png\", \"telephone\": \"+229-64-04-42-94\", \"email\": \"dressur.ds@gmail.com\", \"sameAs\": [\"https://www.facebook.com/dressurds\", \"https://play.google.com/store/apps/details?id=com.dressur.ds\"], \"contactPoint\": [{ \"@type\": \"ContactPoint\", \"telephone\": \"+229-64-04-42-94\", \"contactType\": \"customer service\", \"availableLanguage\": [\"French\"], \"contactOption\": \"TollFree\" }, { \"@type\": \"ContactPoint\", \"email\": \"dressur.ds@gmail.com\", \"contactType\": \"customer support\", \"availableLanguage\": [\"French\"] }] }
  ]
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Contacts\",\"item\":\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_contactez_nous");
        yield "\"}]}
</script>
";
        yield from [];
    }

    // line 35
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 37
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 38
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

    /* Contact cards */
    .contact-card {
        background: #fff;
        border-radius: 18px;
        padding: 24px 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        text-decoration: none;
        color: inherit;
        border: 1.5px solid #e9ecef;
        transition: all 0.28s;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }
    html.dark-theme .contact-card {
        background: #202a40;
        border-color: #2e3a55;
        box-shadow: none;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        border-color: #1a3a8f;
        box-shadow: 0 10px 30px rgba(26,58,143,0.14);
        color: inherit;
    }
    html.dark-theme .contact-card:hover {
        border-color: #4fc3f7;
        box-shadow: 0 10px 30px rgba(79,195,247,0.1);
    }
    .contact-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .contact-label {
        font-size: 0.75rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }
    .contact-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f2460;
        line-height: 1.2;
    }
    html.dark-theme .contact-value { color: #fcfcfc; }
    .contact-arrow {
        margin-left: auto;
        color: #cbd5e1;
        font-size: 0.8rem;
        flex-shrink: 0;
        transition: color 0.2s, transform 0.2s;
    }
    .contact-card:hover .contact-arrow { color: #1a3a8f; transform: translateX(3px); }
    html.dark-theme .contact-card:hover .contact-arrow { color: #4fc3f7; }

    /* Form */
    .contact-form-wrap {
        background: #fff;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 3px 20px rgba(0,0,0,0.07);
    }
    html.dark-theme .contact-form-wrap {
        background: #202a40;
        box-shadow: 0 3px 20px rgba(0,0,0,0.25);
    }
    .contact-form-wrap h3 {
        font-weight: 800;
        color: #0f2460;
        font-size: 1.2rem;
        margin-bottom: 6px;
    }
    html.dark-theme .contact-form-wrap h3 { color: #fcfcfc; }
    .contact-form-wrap .sub { font-size: 0.87rem; color: #6c757d; margin-bottom: 24px; }
    .form-label-custom {
        font-size: 0.82rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }
    html.dark-theme .form-label-custom { color: #c8cdd4; }
    .form-control-custom {
        width: 100%;
        background: #f8f9ff;
        border: 1.5px solid #e9ecef;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #374151;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        font-family: inherit;
    }
    html.dark-theme .form-control-custom {
        background: #1a2232;
        border-color: #2e3a55;
        color: #fcfcfc;
    }
    .form-control-custom:focus {
        border-color: #1a3a8f;
        box-shadow: 0 0 0 3px rgba(26,58,143,0.1);
    }
    html.dark-theme .form-control-custom:focus {
        border-color: #4fc3f7;
        box-shadow: 0 0 0 3px rgba(79,195,247,0.1);
    }
    textarea.form-control-custom { resize: vertical; }
    .btn-send {
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 13px 32px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.28s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(26,58,143,0.3);
    }
    .btn-send:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26,58,143,0.35); }

    /* Side info */
    .contact-sidebar h4 {
        font-weight: 800;
        color: #0f2460;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }
    html.dark-theme .contact-sidebar h4 { color: #fcfcfc; }
    .contact-sidebar .sub { font-size: 0.9rem; color: #6c757d; margin-bottom: 28px; line-height: 1.6; }
    html.dark-theme .contact-sidebar .sub { color: #9ea4aa; }
    .availability-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #d1fae5;
        color: #065f46;
        font-size: 0.82rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 50px;
        margin-bottom: 24px;
    }
    html.dark-theme .availability-badge { background: rgba(16,185,129,0.15); color: #34d399; }
    .availability-dot { width: 8px; height: 8px; background: #10b981; border-radius: 50%; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }
</style>
";
        yield from [];
    }

    // line 228
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 229
        yield "
<div class=\"page-hero\">
    <div class=\"container\">
        <div class=\"page-hero-breadcrumb\">
            <a href=\"";
        // line 233
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\"><i class=\"fas fa-house me-1\"></i> Accueil</a>
            <i class=\"fas fa-chevron-right\" style=\"font-size:10px\"></i>
            <span>Contacts</span>
        </div>
        <h1><i class=\"fas fa-headset me-2\" style=\"opacity:.7\"></i> Contactez-nous</h1>
        <p>Notre équipe vous répond dans les meilleurs délais</p>
    </div>
</div>

<div class=\"container my-5\">
    <div class=\"row g-5 align-items-start\">

        ";
        // line 246
        yield "        <div class=\"col-lg-5 contact-sidebar\">
            <h4>On est là pour vous aider</h4>
            <p class=\"sub\">N\x27hésitez pas à nous joindre via WhatsApp, par appel, email ou Facebook. Choisissez le canal qui vous convient le mieux.</p>
            <div class=\"availability-badge\">
                <span class=\"availability-dot\"></span> Disponible maintenant
            </div>

            <div class=\"d-flex flex-column gap-3\">
                <a href=\"tel:+22964044294\" class=\"contact-card\">
                    <div class=\"contact-icon\" style=\"background:#dbeafe; color:#1d4ed8;\">
                        <i class=\"fas fa-phone\"></i>
                    </div>
                    <div>
                        <div class=\"contact-label\">Appel direct</div>
                        <div class=\"contact-value\">+229 64 04 42 94</div>
                    </div>
                    <i class=\"fas fa-arrow-right contact-arrow\"></i>
                </a>

                <a href=\"https://wa.me/+22964044294\" target=\"_blank\" class=\"contact-card\">
                    <div class=\"contact-icon\" style=\"background:#d1fae5; color:#059669;\">
                        <i class=\"fab fa-whatsapp\"></i>
                    </div>
                    <div>
                        <div class=\"contact-label\">WhatsApp</div>
                        <div class=\"contact-value\">+229 64 04 42 94</div>
                    </div>
                    <i class=\"fas fa-arrow-right contact-arrow\"></i>
                </a>

                <a href=\"mailto:dressur.ds@gmail.com\" class=\"contact-card\">
                    <div class=\"contact-icon\" style=\"background:#fef3c7; color:#d97706;\">
                        <i class=\"fas fa-envelope\"></i>
                    </div>
                    <div>
                        <div class=\"contact-label\">Email</div>
                        <div class=\"contact-value\">dressur.ds@gmail.com</div>
                    </div>
                    <i class=\"fas fa-arrow-right contact-arrow\"></i>
                </a>

                <a href=\"https://www.facebook.com/dressurds\" target=\"_blank\" class=\"contact-card\">
                    <div class=\"contact-icon\" style=\"background:#dbeafe; color:#1d4ed8;\">
                        <i class=\"fab fa-facebook\"></i>
                    </div>
                    <div>
                        <div class=\"contact-label\">Facebook</div>
                        <div class=\"contact-value\">facebook.com/dressurds</div>
                    </div>
                    <i class=\"fas fa-arrow-right contact-arrow\"></i>
                </a>

                <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" class=\"contact-card\">
                    <div class=\"contact-icon\" style=\"background:#fce7f3; color:#db2777;\">
                        <i class=\"fab fa-google-play\"></i>
                    </div>
                    <div>
                        <div class=\"contact-label\">Application mobile</div>
                        <div class=\"contact-value\">Télécharger sur Play Store</div>
                    </div>
                    <i class=\"fas fa-arrow-right contact-arrow\"></i>
                </a>
            </div>
        </div>

        ";
        // line 312
        yield "        <div class=\"col-lg-7\">
            <div class=\"contact-form-wrap\">
                <h3><i class=\"fas fa-paper-plane me-2\" style=\"color:#1a3a8f; opacity:.8\"></i> Envoyer un message</h3>
                <p class=\"sub\">Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</p>

                <div id=\"msgError\" style=\"display:none;\" class=\"mb-3\"></div>

                <div class=\"row g-3 mb-3\">
                    <div class=\"col-sm-6\">
                        <label class=\"form-label-custom\" for=\"nom-prenom\">Nom &amp; Prénom(s)</label>
                        <input type=\"text\" class=\"form-control-custom getInfo\" id=\"nom-prenom\" placeholder=\"Jean Dupont\">
                    </div>
                    <div class=\"col-sm-6\">
                        <label class=\"form-label-custom\" for=\"e-mail\">E-mail</label>
                        <input type=\"text\" class=\"form-control-custom getInfo\" id=\"e-mail\" placeholder=\"jean@exemple.com\">
                    </div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label-custom\" for=\"objet\">Objet</label>
                    <input type=\"text\" class=\"form-control-custom getInfo\" id=\"objet\" placeholder=\"Sujet de votre message\">
                </div>

                <div class=\"mb-4\">
                    <label class=\"form-label-custom\" for=\"message\">Message</label>
                    <textarea class=\"form-control-custom getInfo\" id=\"message\" rows=\"5\" placeholder=\"Décrivez votre demande…\"></textarea>
                </div>

                <div class=\"text-end\">
                    <button class=\"btn-send\" id=\"envoyer\">
                        <i class=\"fas fa-paper-plane\"></i> Envoyer le message
                    </button>
                </div>
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
        return "public/contactez_nous.html.twig";
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
        return array (  438 => 312,  371 => 246,  356 => 233,  350 => 229,  343 => 228,  150 => 38,  143 => 37,  132 => 35,  124 => 31,  113 => 25,  107 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/contactez_nous.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/contactez_nous.html.twig");
    }
}
