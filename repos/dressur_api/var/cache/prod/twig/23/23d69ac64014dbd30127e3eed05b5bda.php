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

/* private/_includes/top_header_admin.html.twig */
class __TwigTemplate_6c937335fbcff7f50707fd6095a04e35 extends Template
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
        yield "<header class=\"top-header\">        
    <nav class=\"navbar navbar-expand\">
        <div class=\"mobile-toggle-icon d-xl-none\">
            <i class=\"bi bi-list\"></i>
        </div>
        <div class=\"top-navbar d-none d-xl-block\">
            <ul class=\"navbar-nav align-items-center\">
                ";
        // line 8
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "admin", [], "any", false, false, false, 8) == true)) {
            // line 9
            yield "                    <li class=\"nav-item\">
                        <a class=\"nav-link badge bg-danger\" href=\"";
            // line 10
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin");
            yield "\">Admin Dash</a>
                    </li>
                ";
        }
        // line 13
        yield "                ";
        // line 22
        yield "            </ul>
        </div>
        <div class=\"d-xl-none ms-auto\">
            ";
        // line 26
        yield "        </div>
        <form class=\"searchbar d-none d-xl-flex ms-auto\">
            ";
        // line 31
        yield "        </form>
        <div class=\"top-navbar-right ms-3\">
            <ul class=\"navbar-nav align-items-center\">
                <li class=\"nav-item dropdown dropdown-large\">
                    <a class=\"nav-link dropdown-toggle dropdown-toggle-nocaret\" href=\"javascript:;\" data-bs-toggle=\"dropdown\">
                    <div class=\"user-setting d-flex align-items-center gap-1\">
                        <div class=\"ds-avatar-sm\" data-name=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 37))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 37)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 37)))), "html", null, true);
        yield "\"></div>
                        <div class=\"user-name \">";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 38), "html", null, true);
        yield "</div>
                    </div>
                    </a>
                    <ul class=\"dropdown-menu dropdown-menu-end\">
                        <li>
                            <a class=\"dropdown-item\" href=\"javascript:;\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"ds-avatar-lg\" data-name=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 45))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 45)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 45)))), "html", null, true);
        yield "\"></div>
                                <div class=\"ms-3\">
                                    <h6 class=\"mb-0 dropdown-user-name\">";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 47), "html", null, true);
        yield "</h6>
                                    <small class=\"mb-0 dropdown-user-designation text-secondary\">@";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 48), "html", null, true);
        yield "</small>
                                </div>
                            </div>
                            </a>
                        </li>
                        <li><hr class=\"dropdown-divider\"></li>
                        <li>
                            <a href=\"/editprofil\" class=\"dropdown-item\">
                                <div class=\"d-flex align-items-center\">
                                <div class=\"setting-icon\"><i class=\"bi bi-person-fill\"></i></div>
                                <div class=\"setting-text ms-3\"><span>Profile</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href=\"/editPassword\" class=\"dropdown-item\">
                                <div class=\"d-flex align-items-center\">
                                <div class=\"setting-icon\"><i class=\"bi bi-gear-fill\"></i></div>
                                <div class=\"setting-text ms-3\"><span>Modifier le mot de passe</span></div>
                                </div>
                            </a>
                        </li>
                        ";
        // line 78
        yield "                        ";
        // line 86
        yield "                        ";
        // line 87
        yield "                        <li>
                            <a class=\"dropdown-item\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#seDeconnecter\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"setting-icon\"><i class=\"bi bi-lock-fill\"></i></div>
                                    <div class=\"setting-text ms-3\"><span>Se déconnecter</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                ";
        // line 198
        yield "                ";
        // line 306
        yield "                <div class=\"notifications change-theme\">
                    <i class=\"fas ";
        // line 307
        if ((($context["theme"] ?? null) == "dark-theme")) {
            yield "fa-moon";
        } else {
            yield "fa-sun";
        }
        yield " ici-theme\"></i>
                </div>
                <li class=\"nav-item dropdown dropdown-large d-none d-sm-block\">
                    <a class=\"nav-link dropdown-toggle dropdown-toggle-nocaret\" href=\"#\" data-bs-toggle=\"dropdown\">
                    <div class=\"notifications\">
                        ";
        // line 313
        yield "                        <i class=\"bi bi-bell-fill\"></i>
                    </div>
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-end p-0\">
                    <div class=\"p-2 border-bottom m-2\">
                        <h5 class=\"h5 mb-0\">Notifications</h5>
                    </div>
                    <div class=\"header-notifications-list p-2\">
                        <div class=\"dropdown-item bg-light radius-10 mb-1\">
                        <form class=\"dropdown-searchbar position-relative\">
                            <div class=\"position-absolute top-50 start-0 translate-middle-y px-3 search-icon\"><i class=\"bi bi-search\"></i></div>
                            <input class=\"form-control\" type=\"search\" placeholder=\"Rechercher Notification\">
                        </form>
                        </div>
                        <a class=\"dropdown-item\" href=\"#\">
                        <div class=\"d-flex align-items-center\">
                            <div class=\"ms-3 flex-grow-1\">
                            <h6 class=\"mb-0 dropdown-msg-user\">Aucune notification</h6>
                            <small class=\"mb-0 dropdown-msg-text text-secondary d-flex align-items-center\">Aucune notification</small>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class=\"p-2\">
                    <div><hr class=\"dropdown-divider\"></div>
                        <a class=\"dropdown-item\" href=\"#\">
                        <div class=\"text-center\">Affichier toutes les Notifications</div>
                        </a>
                    </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style>
.ds-avatar-sm,.ds-avatar-lg{border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;flex-shrink:0;letter-spacing:.5px;}
.ds-avatar-sm{width:36px;height:36px;font-size:14px;}
.ds-avatar-lg{width:60px;height:60px;font-size:22px;}
</style>
<script>
(function(){
    var COLORS=[\x27#1565C0\x27,\x27#2E7D32\x27,\x27#6A1B9A\x27,\x27#C62828\x27,\x27#00838F\x27,\x27#E65100\x27,\x27#4527A0\x27,\x27#00695C\x27,\x27#558B2F\x27,\x27#283593\x27,\x27#880E4F\x27,\x27#37474F\x27];
    function hashColor(name){var k=(name||\x27\x27).toLowerCase(),h=0;for(var i=0;i<k.length;i++)h=(h*31+k.charCodeAt(i))&0x7FFFFFFF;return COLORS[h%COLORS.length];}
    function initials(name){var p=(name||\x27\x27).trim().split(/\\s+/).filter(function(x){return x.length>0;});if(!p.length)return\x27?\x27;if(p.length===1)return p[0][0].toUpperCase();return(p[0][0]+p[1][0]).toUpperCase();}
    document.querySelectorAll(\x27.ds-avatar-sm,.ds-avatar-lg\x27).forEach(function(el){var n=el.getAttribute(\x27data-name\x27)||\x27\x27;el.style.backgroundColor=hashColor(n);el.textContent=initials(n);});
})();
</script>

<div class=\"modal fade\" id=\"seDeconnecter\" tabindex=\"-1\" aria-labelledby=\"seDeconnecterLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-centered\">
        <div class=\"modal-content border-0 shadow-lg\" style=\"border-radius:16px;overflow:hidden;\">
            <div class=\"modal-header border-0 pb-0 pt-4 px-4\">
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Fermer\"></button>
            </div>
            <div class=\"modal-body text-center px-4 pt-2 pb-3\">
                <div class=\"mb-3\" style=\"width:64px;height:64px;border-radius:50%;background:rgba(220,53,69,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto;\">
                    <i class=\"bi bi-box-arrow-right\" style=\"font-size:1.8rem;color:#dc3545;\"></i>
                </div>
                <h5 class=\"fw-bold mb-1\" style=\"font-size:1.15rem;\">Se déconnecter ?</h5>
                <p class=\"text-muted mb-0\" style=\"font-size:.88rem;\">Vous allez fermer votre session en cours.<br>Voulez-vous continuer ?</p>
            </div>
            <div class=\"modal-footer border-0 px-4 pb-4 pt-0 d-flex gap-2 justify-content-center\">
                <button type=\"button\" class=\"btn btn-light px-4\" data-bs-dismiss=\"modal\" style=\"border-radius:10px;font-weight:600;\">Annuler</button>
                <a href=\"/logout\" class=\"btn btn-danger px-4\" style=\"border-radius:10px;font-weight:600;\">
                    <i class=\"bi bi-box-arrow-right me-1\"></i> Déconnecter
                </a>
            </div>
        </div>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/_includes/top_header_admin.html.twig";
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
        return array (  162 => 313,  150 => 307,  147 => 306,  145 => 198,  133 => 87,  131 => 86,  129 => 78,  104 => 48,  100 => 47,  95 => 45,  85 => 38,  81 => 37,  73 => 31,  69 => 26,  64 => 22,  62 => 13,  56 => 10,  53 => 9,  51 => 8,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/_includes/top_header_admin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/_includes/top_header_admin.html.twig");
    }
}
