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

/* public/_includes/header_public.html.twig */
class __TwigTemplate_df7080afc0906ce2a5d66dbb375eb521 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<style>
/* ── Header public ──────────────────────────────────── */
#ds-header {
    position: sticky;
    top: 0;
    z-index: 1040;
    background: #fff;
    border-bottom: 1px solid rgba(0,0,0,.08);
    transition: box-shadow .25s, background .25s;
}
#ds-header.scrolled {
    box-shadow: 0 4px 24px rgba(42,75,154,.13);
}
html.dark-theme #ds-header {
    background: #1a2232;
    border-bottom-color: rgba(255,255,255,.07);
}

#ds-header .navbar-brand img { height: 36px; width: auto; transition: filter .25s; }
html.dark-theme #ds-header .navbar-brand img { filter: brightness(0) invert(1); }

/* Nav links */
#ds-header .nav-link {
    color: #293445;
    font-weight: 600;
    font-size: .9rem;
    padding: .45rem .75rem;
    border-radius: 6px;
    position: relative;
    transition: color .2s, background .2s;
}
html.dark-theme #ds-header .nav-link { color: #c9d3e8; }
#ds-header .nav-link:hover { color: #2a4b9a; background: rgba(42,75,154,.06); }
html.dark-theme #ds-header .nav-link:hover { color: #7fa4f7; background: rgba(127,164,247,.1); }
#ds-header .nav-link.ds-active { color: #2a4b9a !important; }
html.dark-theme #ds-header .nav-link.ds-active { color: #7fa4f7 !important; }
#ds-header .nav-link.ds-active::after {
    content: \x27\x27;
    position: absolute;
    bottom: -2px; left: 50%; transform: translateX(-50%);
    width: 22px; height: 3px;
    background: #2a4b9a;
    border-radius: 3px;
}
html.dark-theme #ds-header .nav-link.ds-active::after { background: #7fa4f7; }

/* Dropdown */
#ds-header .dropdown-menu {
    border: 1.5px solid rgba(42,75,154,.18);
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(42,75,154,.13);
    padding: .5rem;
    min-width: 220px;
}
html.dark-theme #ds-header .dropdown-menu {
    background: #202a40;
    border-color: rgba(127,164,247,.15);
}
#ds-header .dropdown-item {
    border-radius: 8px;
    font-weight: 500;
    font-size: .88rem;
    color: #293445;
    padding: .5rem .9rem;
    transition: background .15s, color .15s;
}
html.dark-theme #ds-header .dropdown-item { color: #c9d3e8; }
#ds-header .dropdown-item:hover { background: rgba(42,75,154,.08); color: #2a4b9a; }
html.dark-theme #ds-header .dropdown-item:hover { background: rgba(127,164,247,.12); color: #7fa4f7; }
#ds-header .dropdown-divider { border-color: rgba(42,75,154,.1); }

/* Boutons CTA */
#ds-header .btn-ds-login {
    font-size: .85rem; font-weight: 600;
    padding: .42rem 1.1rem;
    border-radius: 8px;
    border: 1.5px solid #2a4b9a;
    color: #2a4b9a;
    background: transparent;
    transition: background .2s, color .2s;
}
#ds-header .btn-ds-login:hover { background: #2a4b9a; color: #fff; }
html.dark-theme #ds-header .btn-ds-login { border-color: #7fa4f7; color: #7fa4f7; }
html.dark-theme #ds-header .btn-ds-login:hover { background: #7fa4f7; color: #1a2232; }

#ds-header .btn-ds-register {
    font-size: .85rem; font-weight: 600;
    padding: .42rem 1.1rem;
    border-radius: 8px;
    background: #2a4b9a;
    color: #fff;
    border: 1.5px solid #2a4b9a;
    transition: background .2s, box-shadow .2s;
}
#ds-header .btn-ds-register:hover { background: #1e3876; box-shadow: 0 4px 14px rgba(42,75,154,.35); color: #fff; }

#ds-header .btn-ds-dashboard {
    font-size: .85rem; font-weight: 600;
    padding: .42rem 1.1rem;
    border-radius: 8px;
    background: #16a34a;
    color: #fff;
    border: 1.5px solid #16a34a;
    transition: background .2s;
}
#ds-header .btn-ds-dashboard:hover { background: #15803d; color: #fff; }

/* Thème toggle */
#ds-header .ds-theme-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1.5px solid rgba(42,75,154,.2);
    background: rgba(42,75,154,.06);
    color: #2a4b9a;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: background .2s, color .2s;
    font-size: 15px;
}
#ds-header .ds-theme-btn:hover { background: rgba(42,75,154,.14); }
html.dark-theme #ds-header .ds-theme-btn { background: rgba(127,164,247,.1); color: #7fa4f7; border-color: rgba(127,164,247,.25); }

/* Hamburger */
#ds-header .navbar-toggler {
    border: 1.5px solid rgba(42,75,154,.3);
    border-radius: 8px;
    padding: .4rem .7rem;
    color: #2a4b9a;
}
html.dark-theme #ds-header .navbar-toggler { color: #7fa4f7; border-color: rgba(127,164,247,.3); }

/* Mobile collapse */
@media (max-width: 991px) {
    #ds-header .navbar-collapse {
        padding: 1rem 0 .5rem;
        border-top: 1px solid rgba(42,75,154,.08);
        margin-top: .5rem;
    }
    html.dark-theme #ds-header .navbar-collapse { border-top-color: rgba(127,164,247,.1); }
    #ds-header .nav-link.ds-active::after { display: none; }
    #ds-header .ds-cta-group { margin-top: .75rem; padding-top: .75rem; border-top: 1px solid rgba(42,75,154,.08); }
    html.dark-theme #ds-header .ds-cta-group { border-top-color: rgba(127,164,247,.1); }
}
</style>

<header id=\"ds-header\">
    <nav class=\"navbar navbar-expand-lg py-2\">
        <div class=\"container\">

            <a class=\"navbar-brand me-4\" href=\"";
        // line 150
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\">
                <img src=\"/assets/images/brand-logo-2.png\" alt=\"Dressur\"/>
            </a>

            <button class=\"navbar-toggler border-0 shadow-none\" type=\"button\"
                    data-bs-toggle=\"collapse\" data-bs-target=\"#dsNavCollapse\"
                    aria-controls=\"dsNavCollapse\" aria-expanded=\"false\" aria-label=\"Menu\">
                <i class=\"fas fa-bars\"></i>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"dsNavCollapse\">
                <ul class=\"navbar-nav gap-1 me-auto\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 163
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 163), "pathInfo", [], "any", false, false, false, 163) == $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public"))) {
            yield "ds-active";
        }
        yield "\"
                           href=\"";
        // line 164
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\">Accueil</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 167
        if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 167), "pathInfo", [], "any", false, false, false, 167)) && is_string($_v1 = "/actualite") && str_starts_with($_v0, $_v1))) {
            yield "ds-active";
        }
        yield "\"
                           href=\"";
        // line 168
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_actualite");
        yield "\">Actualités</a>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle dropdown-toggle-nocaret ";
        // line 171
        if (CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 171), "pathInfo", [], "any", false, false, false, 171), [$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services"), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot"), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact"), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire"), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux")])) {
            yield "ds-active";
        }
        yield "\"
                           href=\"#\" data-bs-toggle=\"dropdown\">
                            Services <i class=\"fas fa-chevron-down fa-xs ms-1 align-middle\"></i>
                        </a>
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"";
        // line 176
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\" class=\"dropdown-item fw-bold\" style=\"color:#2a4b9a;\">
                                <i class=\"fas fa-th-large me-2\"></i>Tous les services
                            </a></li>
                            <li><hr class=\"dropdown-divider\"></li>
                            <li><a href=\"";
        // line 180
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"dropdown-item\">
                                <i class=\"fab fa-android me-2 text-success\"></i>Dressur Bot
                            </a></li>
                            <li><a href=\"";
        // line 183
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"dropdown-item\">
                                <i class=\"fas fa-bolt me-2 text-warning\"></i>Boost Contact
                            </a></li>
                            <li><a href=\"";
        // line 186
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"dropdown-item\">
                                <i class=\"fas fa-bullhorn me-2 text-danger\"></i>Promotion Affaire
                            </a></li>
                            <li><a href=\"";
        // line 189
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"dropdown-item\">
                                <i class=\"fas fa-thumbs-up me-2 text-info\"></i>Promotions Réseaux Sociaux
                            </a></li>
                        </ul>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 195
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 195), "pathInfo", [], "any", false, false, false, 195) == $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs"))) {
            yield "ds-active";
        }
        yield "\"
                           href=\"";
        // line 196
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\">Tarifs</a>
                    </li>
                    <li class=\"nav-item\">
                        <a class=\"nav-link ";
        // line 199
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 199), "pathInfo", [], "any", false, false, false, 199) == $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contactez_nous"))) {
            yield "ds-active";
        }
        yield "\"
                           href=\"";
        // line 200
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contactez_nous");
        yield "\">Contact</a>
                    </li>
                </ul>

                <div class=\"d-flex align-items-center gap-2 ds-cta-group\">
                    <div class=\"ds-theme-btn\" id=\"ds-public-theme-btn\" title=\"Changer le thème\">
                        <i class=\"fas fa-moon\" id=\"ds-public-theme-icon\"></i>
                    </div>
                    ";
        // line 208
        if ((($context["is_connect"] ?? null) == "oui")) {
            // line 209
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_private");
            yield "\" class=\"btn-ds-dashboard text-decoration-none\">
                            <i class=\"fas fa-house-user me-1\"></i>Dashboard
                        </a>
                    ";
        } else {
            // line 213
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_connexion");
            yield "\" class=\"btn-ds-login text-decoration-none\">
                            <i class=\"fas fa-arrow-right-to-bracket me-1\"></i>Connexion
                        </a>
                        <a href=\"";
            // line 216
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
            yield "\" class=\"btn-ds-register text-decoration-none\">
                            <i class=\"fas fa-user-plus me-1\"></i>Inscription
                        </a>
                    ";
        }
        // line 220
        yield "                </div>
            </div>

        </div>
    </nav>
</header>

<script>
(function(){
    /* ── Scroll shadow ── */
    var h = document.getElementById(\x27ds-header\x27);
    if(h){
        function onScroll(){ h.classList.toggle(\x27scrolled\x27, window.scrollY > 10); }
        window.addEventListener(\x27scroll\x27, onScroll, {passive:true});
        onScroll();
    }

    /* ── Theme toggle autonome ── */
    var btn  = document.getElementById(\x27ds-public-theme-btn\x27);
    var icon = document.getElementById(\x27ds-public-theme-icon\x27);
    if(!btn || !icon) return;

    /* Convention : fa-moon = \"cliquer pour passer en dark\" (on est en light)
                   fa-sun  = \"cliquer pour passer en light\" (on est en dark) */
    function isDark(){
        return document.documentElement.classList.contains(\x27dark-theme\x27);
    }

    function syncIcon(){
        if(isDark()){
            icon.className = \x27fas fa-sun\x27;   /* on est en dark → proposer le soleil */
        } else {
            icon.className = \x27fas fa-moon\x27;  /* on est en light → proposer la lune */
        }
    }

    function setThemeCookie(theme){
        var d = new Date();
        d.setTime(d.getTime() + 365*24*60*60*1000);
        document.cookie = \x27theme=\x27 + theme + \x27;expires=\x27 + d.toUTCString() + \x27;path=/\x27;
    }

    /* Synchroniser l\x27icône au chargement selon le vrai état du <html> */
    syncIcon();

    btn.addEventListener(\x27click\x27, function(){
        var html = document.documentElement;
        if(isDark()){
            html.classList.remove(\x27dark-theme\x27);
            html.classList.add(\x27light-theme\x27);
            setThemeCookie(\x27light-theme\x27);
        } else {
            html.classList.remove(\x27light-theme\x27, \x27semi-dark\x27);
            html.classList.add(\x27dark-theme\x27);
            setThemeCookie(\x27dark-theme\x27);
        }
        syncIcon();
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
        return "public/_includes/header_public.html.twig";
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
        return array (  330 => 220,  323 => 216,  316 => 213,  308 => 209,  306 => 208,  295 => 200,  289 => 199,  283 => 196,  277 => 195,  268 => 189,  262 => 186,  256 => 183,  250 => 180,  243 => 176,  233 => 171,  227 => 168,  221 => 167,  215 => 164,  209 => 163,  193 => 150,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/_includes/header_public.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/_includes/header_public.html.twig");
    }
}
