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

/* private/tutoriels.html.twig */
class __TwigTemplate_832e7ac5fe260fea1d5bf625cb529954 extends Template
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
        yield "Tutoriels";
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
.ds-tuto-wrap{max-width:720px;margin:0 auto}

.ds-tuto-header{
    display:flex;align-items:center;gap:16px;margin-bottom:16px;padding:16px 18px;border-radius:18px;
    background:linear-gradient(135deg,var(--bs-primary,#0d6efd),rgba(13,110,253,.78));
    box-shadow:0 6px 16px rgba(13,110,253,.30);color:#fff;
}
.ds-tuto-header-icon{width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ds-tuto-header-icon i{font-size:24px;color:#fff}
.ds-tuto-header-title{font-weight:700;font-size:16px;margin:0 0 3px}
.ds-tuto-header-sub{font-size:13px;margin:0;opacity:.85}

.ds-tuto-card{display:flex;background:var(--bs-body-bg,#fff);border:1px solid var(--bs-border-color,rgba(0,0,0,.08));border-radius:16px;box-shadow:0 3px 10px rgba(0,0,0,.07);margin-bottom:12px;overflow:hidden}
.ds-tuto-bar{width:5px;flex-shrink:0;background:var(--bs-primary,#0d6efd)}
.ds-tuto-bar.ds-yt{background:#ff0000}
.ds-tuto-body{flex:1;padding:14px}
.ds-tuto-num{width:28px;height:28px;border-radius:8px;background:rgba(13,110,253,.12);color:var(--bs-primary,#0d6efd);font-weight:700;font-size:13px;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0}
.ds-tuto-num.ds-yt{background:rgba(255,0,0,.12);color:#ff0000}
.ds-tuto-title-row{display:flex;align-items:center;gap:10px;margin-bottom:8px}
.ds-tuto-title{font-weight:600;font-size:15px;margin:0;color:var(--bs-body-color,#212529)}
.ds-tuto-desc{font-size:13px;color:var(--bs-secondary-color,#6c757d);line-height:1.55;margin:0 0 12px}
.ds-tuto-btn{display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:10px;background:var(--bs-primary,#0d6efd);color:#fff;font-size:13px;font-weight:600;text-decoration:none}
.ds-tuto-btn.ds-yt{background:#ff0000}
.ds-tuto-btn:hover{color:#fff}

.ds-tuto-state{text-align:center;padding:60px 20px}
.ds-tuto-state i{font-size:40px;color:#ced4da;margin-bottom:14px;display:block}
.ds-tuto-state p{color:#8a8f98;font-size:14px;margin:0 0 16px}

html.dark-theme .ds-tuto-card,html.semi-dark .ds-tuto-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 10px rgba(0,0,0,.3)}
html.dark-theme .ds-tuto-title,html.semi-dark .ds-tuto-title{color:#fcfcfc}
</style>

<div class=\"ds-tuto-wrap\">

    <div class=\"ds-tuto-header\">
        <div class=\"ds-tuto-header-icon\"><i class=\"fas fa-graduation-cap\"></i></div>
        <div>
            <p class=\"ds-tuto-header-title\">Tutoriels Dressur</p>
            <p class=\"ds-tuto-header-sub\" id=\"dsTutoCount\">Chargement...</p>
        </div>
    </div>

    <div id=\"dsTutoList\"></div>

    <div id=\"dsTutoLoading\" class=\"ds-tuto-state\">
        <div class=\"spinner-border text-primary\" role=\"status\"></div>
    </div>

    <div id=\"dsTutoError\" class=\"ds-tuto-state\" style=\"display:none\">
        <i class=\"fas fa-circle-exclamation\"></i>
        <p>Impossible de charger les tutoriels.</p>
        <button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"dsTutoRetryBtn\">
            <i class=\"fas fa-arrows-rotate me-1\"></i>Réessayer
        </button>
    </div>

    <div id=\"dsTutoEmpty\" class=\"ds-tuto-state\" style=\"display:none\">
        <i class=\"fas fa-graduation-cap\"></i>
        <p>Aucun tutoriel disponible</p>
    </div>

</div>
";
        yield from [];
    }

    // line 71
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 72
        yield "<script>
(function(){
    const listEl    = document.getElementById(\x27dsTutoList\x27);
    const countEl    = document.getElementById(\x27dsTutoCount\x27);
    const loadingEl = document.getElementById(\x27dsTutoLoading\x27);
    const errorEl   = document.getElementById(\x27dsTutoError\x27);
    const emptyEl   = document.getElementById(\x27dsTutoEmpty\x27);

    function escapeHtml(str){
        const div = document.createElement(\x27div\x27);
        div.textContent = str || \x27\x27;
        return div.innerHTML;
    }

    function isYoutube(url){
        const u = (url || \x27\x27).toLowerCase();
        return u.includes(\x27youtube\x27) || u.includes(\x27youtu.be\x27);
    }

    function setState(state){
        loadingEl.style.display = state === \x27loading\x27 ? \x27\x27 : \x27none\x27;
        errorEl.style.display   = state === \x27error\x27   ? \x27\x27 : \x27none\x27;
        emptyEl.style.display   = state === \x27empty\x27   ? \x27\x27 : \x27none\x27;
        listEl.style.display    = state === \x27list\x27    ? \x27\x27 : \x27none\x27;
    }

    function render(tutos){
        countEl.textContent = tutos.length + (tutos.length > 1 ? \x27 tutoriels disponibles\x27 : \x27 tutoriel disponible\x27);
        if (!tutos.length) {
            listEl.innerHTML = \x27\x27;
            setState(\x27empty\x27);
            return;
        }
        let html = \x27\x27;
        tutos.forEach(function(t, i){
            const yt = isYoutube(t.url);
            html += \x27<div class=\"ds-tuto-card\">\x27 +
                        \x27<div class=\"ds-tuto-bar\x27 + (yt ? \x27 ds-yt\x27 : \x27\x27) + \x27\"></div>\x27 +
                        \x27<div class=\"ds-tuto-body\">\x27 +
                            \x27<div class=\"ds-tuto-title-row\">\x27 +
                                \x27<span class=\"ds-tuto-num\x27 + (yt ? \x27 ds-yt\x27 : \x27\x27) + \x27\">\x27 + (i+1) + \x27</span>\x27 +
                                \x27<p class=\"ds-tuto-title\">\x27 + escapeHtml(t.titre) +
                                    (yt ? \x27 <i class=\"fab fa-youtube\" style=\"color:#ff0000\"></i>\x27 : \x27\x27) +
                                \x27</p>\x27 +
                            \x27</div>\x27 +
                            (t.description ? \x27<p class=\"ds-tuto-desc\">\x27 + escapeHtml(t.description) + \x27</p>\x27 : \x27\x27) +
                            (t.url ? \x27<a class=\"ds-tuto-btn\x27 + (yt ? \x27 ds-yt\x27 : \x27\x27) + \x27\" href=\"\x27 + escapeHtml(t.url) + \x27\" target=\"_blank\" rel=\"noopener\">\x27 +
                                \x27<i class=\"fa\x27 + (yt ? \x27b fa-youtube\x27 : \x27s fa-arrow-up-right-from-square\x27) + \x27\"></i>\x27 +
                                (yt ? \x27Voir sur YouTube\x27 : \x27Voir le tutoriel\x27) +
                            \x27</a>\x27 : \x27\x27) +
                        \x27</div>\x27 +
                    \x27</div>\x27;
        });
        listEl.innerHTML = html;
        setState(\x27list\x27);
    }

    function fetchTutos(){
        setState(\x27loading\x27);
        countEl.textContent = \x27Chargement...\x27;
        fetch(\x27/api/getTutos\x27, { method: \x27POST\x27, credentials: \x27same-origin\x27 })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.error) { setState(\x27error\x27); return; }
                render(data.tutos || []);
            })
            .catch(function(){ setState(\x27error\x27); });
    }

    document.getElementById(\x27dsTutoRetryBtn\x27).addEventListener(\x27click\x27, fetchTutos);

    fetchTutos();
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
        return "private/tutoriels.html.twig";
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
        return array (  147 => 72,  140 => 71,  71 => 5,  64 => 4,  53 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/tutoriels.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/tutoriels.html.twig");
    }
}
