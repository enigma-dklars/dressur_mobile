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

/* private/hub_preferences.html.twig */
class __TwigTemplate_f476930204cb3e30fa9ecc669d4d8430 extends Template
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
            'script' => [$this, 'block_script'],
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
        yield "Préférences";
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
.ds-nav-card{display:flex;align-items:center;gap:16px;background:var(--bs-body-bg,#fff);border-radius:15px;border:1px solid var(--bs-border-color,rgba(0,0,0,.08));box-shadow:0 3px 10px rgba(0,0,0,.05);padding:15px 18px;margin-bottom:12px;text-decoration:none;color:inherit;transition:box-shadow .2s,transform .15s}
.ds-nav-card:hover{box-shadow:0 6px 16px rgba(0,0,0,.10);transform:translateY(-1px);color:inherit}
.ds-nav-card-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:rgba(13,110,253,.10);flex-shrink:0}
.ds-nav-card-icon i{font-size:24px;color:var(--bs-primary,#0d6efd)}
.ds-nav-card-body{flex:1}
.ds-nav-card-body .ds-title{font-weight:600;font-size:16px;margin:0 0 3px;color:var(--bs-body-color,#212529)}
.ds-nav-card-body .ds-sub{font-size:13px;color:var(--bs-secondary-color,#6c757d);margin:0}
.ds-nav-card-chevron{font-size:15px;color:var(--bs-secondary-color,#adb5bd)}
.ds-hub-title{font-weight:700;font-size:1.1rem;margin-bottom:16px;display:flex;align-items:center;gap:8px}

/* ── Dark theme ─── */
html.dark-theme .ds-nav-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 10px rgba(0,0,0,.3);color:#fcfcfc}
html.dark-theme .ds-nav-card:hover{box-shadow:0 6px 16px rgba(0,0,0,.4);color:#fcfcfc}
html.dark-theme .ds-nav-card-body .ds-title{color:#fcfcfc}
html.dark-theme .ds-nav-card-body .ds-sub{color:#9ea4aa}
html.dark-theme .ds-nav-card-chevron{color:#6c757d}
html.dark-theme .ds-nav-card-icon{background:rgba(13,110,253,.20)}
html.dark-theme .ds-hub-title{color:#fcfcfc}
html.semi-dark .ds-nav-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 10px rgba(0,0,0,.3);color:#fcfcfc}
html.semi-dark .ds-nav-card:hover{color:#fcfcfc}
html.semi-dark .ds-nav-card-body .ds-title{color:#fcfcfc}
html.semi-dark .ds-nav-card-body .ds-sub{color:#9ea4aa}
html.semi-dark .ds-hub-title{color:#fcfcfc}
</style>

<div class=\"ds-hub-wrap\">

    <h5 class=\"ds-hub-title\">
        <i class=\"fas fa-heart text-primary\"></i>Préférences
    </h5>

    <div class=\"ds-nav-card\" style=\"cursor:default\">
        <div class=\"ds-nav-card-icon\"><i class=\"fas fa-address-book\"></i></div>
        <div class=\"ds-nav-card-body\">
            <p class=\"ds-title\">Contacts Dressur</p>
            <p class=\"ds-sub\">Afficher le nombre de contacts disponibles dans le fil d\x27actualité et mettre Boost Contact en avant dans Services</p>
        </div>
        <div class=\"form-check form-switch fs-4 mb-0\">
            <input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"dsAddPageActuSwitch\" ";
        // line 45
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "addPageActu", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("checked") : (""));
        yield ">
        </div>
    </div>

    <a href=\"/preferencePays\" class=\"ds-nav-card\">
        <div class=\"ds-nav-card-icon\"><i class=\"fas fa-globe\"></i></div>
        <div class=\"ds-nav-card-body\">
            <p class=\"ds-title\">Pays ciblés</p>
            <p class=\"ds-sub\">Définissez les pays pour vos contacts et promotions</p>
        </div>
        <i class=\"fas fa-chevron-right ds-nav-card-chevron\"></i>
    </a>


</div>
";
        yield from [];
    }

    // line 62
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 63
        yield "<script>
(function(){
    var uid = ";
        // line 65
        yield json_encode(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "uid", [], "any", false, false, false, 65));
        yield ";
    var switchEl = document.getElementById(\x27dsAddPageActuSwitch\x27);
    if (!switchEl) return;

    switchEl.addEventListener(\x27change\x27, function(){
        var value = switchEl.checked ? \x271\x27 : \x270\x27;
        var previous = !switchEl.checked;
        fetch(\x27/api/updateAddPageActu/\x27 + uid + \x27/\x27 + value, { method: \x27POST\x27 })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.error) { switchEl.checked = previous; }
            })
            .catch(function(){ switchEl.checked = previous; });
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
        return "private/hub_preferences.html.twig";
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
        return array (  145 => 65,  141 => 63,  134 => 62,  113 => 45,  71 => 5,  64 => 4,  53 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/hub_preferences.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/hub_preferences.html.twig");
    }
}
