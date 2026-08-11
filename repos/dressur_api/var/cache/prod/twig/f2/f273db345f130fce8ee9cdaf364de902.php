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

/* private/hub_services.html.twig */
class __TwigTemplate_ab17d58e6d1b798e46ae27d369cc63c5 extends Template
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
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "basePrivate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Services";
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 5
        yield "<style>
.ds-hub-wrap{max-width:720px;margin:0 auto}
.ds-service-card{background:var(--bs-body-bg,#fff);border-radius:15px;border:1px solid var(--bs-border-color,rgba(0,0,0,.08));box-shadow:0 3px 10px rgba(0,0,0,.05);padding:20px;margin-bottom:14px}
.ds-svc-header{display:flex;align-items:center;gap:14px;margin-bottom:12px}
.ds-svc-icon{width:52px;height:52px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(13,110,253,.10);flex-shrink:0}
.ds-svc-icon i{font-size:24px;color:var(--bs-primary,#0d6efd)}
.ds-svc-title{font-weight:600;font-size:17px;margin:0;color:var(--bs-body-color,#212529)}
.ds-svc-desc{font-size:14px;color:var(--bs-secondary-color,#6c757d);line-height:1.55;margin-bottom:18px}
.ds-svc-actions{display:flex;gap:10px}
.ds-svc-actions a{flex:1;text-align:center}
.ds-hub-title{font-weight:700;font-size:1.1rem;margin-bottom:16px;display:flex;align-items:center;gap:8px}

/* ── Dark theme ─── */
html.dark-theme .ds-service-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 10px rgba(0,0,0,.3)}
html.dark-theme .ds-svc-title{color:#fcfcfc}
html.dark-theme .ds-svc-desc{color:#9ea4aa}
html.dark-theme .ds-hub-title{color:#fcfcfc}
html.dark-theme .ds-svc-icon{background:rgba(13,110,253,.20)}
html.semi-dark .ds-service-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 10px rgba(0,0,0,.3)}
html.semi-dark .ds-svc-title{color:#fcfcfc}
html.semi-dark .ds-svc-desc{color:#9ea4aa}
html.semi-dark .ds-hub-title{color:#fcfcfc}
</style>

<div class=\"ds-hub-wrap\">

    <h5 class=\"ds-hub-title\">
        <i class=\"fas fa-briefcase text-primary\"></i>Services
    </h5>

    ";
        // line 35
        $context["boost_card"] = new Markup("    <div class=\"ds-service-card\">
        <div class=\"ds-svc-header\">
            <div class=\"ds-svc-icon\"><i class=\"fas fa-address-book\"></i></div>
            <h6 class=\"ds-svc-title\">Boost Contact</h6>
        </div>
        <p class=\"ds-svc-desc\">Rendez votre numéro visible aux contacts correspondant à vos préférences pays. Augmentez votre réseau professionnel ciblé.</p>
        <div class=\"ds-svc-actions\">
            <a href=\"/newboostcontact\" class=\"btn btn-md btn-primary rounded-3 \">
                Faire un Boost
            </a>
            <a href=\"/listeboostcontact\" class=\"btn btn-md btn-outline-secondary rounded-3 \">
                Voir la liste
            </a>
        </div>
    </div>
    ", $this->env->getCharset());
        // line 52
        yield "
    ";
        // line 53
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "addPageActu", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 54
            yield "        ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["boost_card"] ?? null), "html", null, true);
            yield "
    ";
        }
        // line 56
        yield "
    ";
        // line 58
        yield "    <div class=\"ds-service-card\">
        <div class=\"ds-svc-header\">
            <div class=\"ds-svc-icon\"><i class=\"fas fa-store\"></i></div>
            <h6 class=\"ds-svc-title\">Promotion Affaire</h6>
        </div>
        <p class=\"ds-svc-desc\">Faites la promotion de vos produits et services. Les utilisateurs intéressés vous contacteront directement.</p>
        <div class=\"ds-svc-actions\">
            <a href=\"/newpromoaffaire\" class=\"btn btn-md btn-primary rounded-3 \">
                Faire une Promo
            </a>
            <a href=\"/listepromoaffaire\" class=\"btn btn-md btn-outline-secondary rounded-3 \">
                Voir la liste
            </a>
        </div>
    </div>

    ";
        // line 75
        yield "    <div class=\"ds-service-card\">
        <div class=\"ds-svc-header\">
            <div class=\"ds-svc-icon\"><i class=\"fas fa-chart-line\"></i></div>
            <h6 class=\"ds-svc-title\">Promotion Réseau Sociaux</h6>
        </div>
        <p class=\"ds-svc-desc\">Gagnez des abonnés, vues, likes sur TikTok, Instagram, Telegram, YouTube et plus encore.</p>
        <div class=\"ds-svc-actions\">
            <a href=\"/newpromoreseau\" class=\"btn btn-md btn-primary rounded-3 \">
                Démarrer
            </a>
            <a href=\"/listepromoreseau\" class=\"btn btn-md btn-outline-secondary rounded-3 \">
                Voir la liste
            </a>
        </div>
    </div>

    ";
        // line 91
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "addPageActu", [], "any", false, false, false, 91)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 92
            yield "        ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["boost_card"] ?? null), "html", null, true);
            yield "
    ";
        }
        // line 94
        yield "
    ";
        // line 95
        yield from $this->load("private/_includes/_sociaux.html.twig", 95)->unwrap()->yield($context);
        // line 96
        yield "
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/hub_services.html.twig";
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
        return array (  182 => 96,  180 => 95,  177 => 94,  171 => 92,  169 => 91,  151 => 75,  133 => 58,  130 => 56,  124 => 54,  122 => 53,  119 => 52,  102 => 35,  70 => 5,  63 => 4,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/hub_services.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/hub_services.html.twig");
    }
}
