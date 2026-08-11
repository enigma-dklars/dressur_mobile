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

/* private/_includes/sidebar_wrapper.html.twig */
class __TwigTemplate_67861d8adc9c6396432b4937a0fbe45b extends Template
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
        $context["r"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 1), "attributes", [], "any", false, false, false, 1), "get", ["_route"], "method", false, false, false, 1);
        // line 2
        yield "
";
        // line 4
        yield "
";
        // line 5
        $context["services_routes"] = ["app_newboostcontact", "app_listeboostcontact", "app_newpromoaffaire", "app_listepromoaffaire", "app_newpromoreseau", "app_listepromoreseau", "app_hub_services"];
        // line 6
        $context["services_active"] = CoreExtension::inFilter(($context["r"] ?? null), ($context["services_routes"] ?? null));
        // line 7
        yield "
";
        // line 8
        $context["actu_active"] = CoreExtension::inFilter(($context["r"] ?? null), ["app_actu", "app_actu_detail"]);
        // line 9
        yield "

";
        // line 11
        $context["params_routes"] = ["app_editprofil", "app_editPassword", "app_tutoriels", "app_assistant", "app_addSuggestion", "app_signalerUser", "app_support", "app_apropos", "app_deleteCompte", "app_hub_parametres", "app_preferencePays", "app_hub_preferences", "app_contact", "app_guide_import_contacts", "app_export_vcf", "app_export_csv", "app_notifications"];
        // line 12
        $context["params_active"] = CoreExtension::inFilter(($context["r"] ?? null), ($context["params_routes"] ?? null));
        // line 13
        yield "
<aside class=\"sidebar-wrapper\" data-simplebar=\"true\">
    <div class=\"sidebar-header\">
      <div>
        <img src=\"/assets/images/ds_logo.png\" class=\"logo-icon\" alt=\"logo icon\">
      </div>
      <div>
        <h4 class=\"logo-text\">Dressur</h4>
      </div>
      <div class=\"toggle-icon ms-auto\"><i class=\"bi bi-chevron-double-left\"></i>
      </div>
    </div>
    <!--navigation-->
    <ul class=\"metismenu\" id=\"menu\">

      ";
        // line 29
        yield "      ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "admin", [], "any", false, false, false, 29) == true)) {
            // line 30
            yield "      <li class=\"";
            yield (((($context["r"] ?? null) == "app_admin")) ? ("mm-active") : (""));
            yield "\">
        <a href=\"/admin\" class=\"";
            // line 31
            yield (((($context["r"] ?? null) == "app_admin")) ? ("active") : (""));
            yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-user-shield text-danger\"></i></div>
          <div class=\"menu-title text-danger\">Administration</div>
        </a>
      </li>
      ";
        }
        // line 37
        yield "
      ";
        // line 39
        yield "      <li class=\"";
        yield (((($context["r"] ?? null) == "app_public")) ? ("mm-active") : (""));
        yield "\">
        <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\" class=\"";
        yield (((($context["r"] ?? null) == "app_public")) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-globe\"></i></div>
          <div class=\"menu-title\">Public</div>
        </a>
      </li>

      ";
        // line 47
        yield "      <li class=\"";
        yield (((($context["r"] ?? null) == "app_private")) ? ("mm-active") : (""));
        yield "\">
        <a href=\"/private\" class=\"";
        // line 48
        yield (((($context["r"] ?? null) == "app_private")) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-house-user\"></i></div>
          <div class=\"menu-title\">Dashboard</div>
        </a>
      </li>
      ";
        // line 54
        yield "      <li class=\"";
        yield (((($tmp = ($context["services_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\">
        <a href=\"/services\" class=\"";
        // line 55
        yield (((($tmp = ($context["services_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-briefcase\"></i></div>
          <div class=\"menu-title\">Services</div>
        </a>
        <ul class=\"";
        // line 59
        yield (((($tmp = ($context["services_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-show") : (""));
        yield "\">

          ";
        // line 62
        yield "          <li class=\"";
        yield (((($context["r"] ?? null) == "app_newboostcontact")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/newboostcontact\" class=\"small-fort ";
        // line 63
        yield (((($context["r"] ?? null) == "app_newboostcontact")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-square-plus\"></i>Boost Contact
            </a>
          </li>
          <li class=\"";
        // line 67
        yield (((($context["r"] ?? null) == "app_listeboostcontact")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/listeboostcontact\" class=\"small-fort ";
        // line 68
        yield (((($context["r"] ?? null) == "app_listeboostcontact")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-align-left\"></i>Liste Boost Contact
            </a>
          </li>

          ";
        // line 74
        yield "          <li class=\"";
        yield (((($context["r"] ?? null) == "app_newpromoaffaire")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/newpromoaffaire\" class=\"small-fort ";
        // line 75
        yield (((($context["r"] ?? null) == "app_newpromoaffaire")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-square-plus\"></i>Promotion Affaire
            </a>
          </li>
          <li class=\"";
        // line 79
        yield (((($context["r"] ?? null) == "app_listepromoaffaire")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/listepromoaffaire\" class=\"small-fort ";
        // line 80
        yield (((($context["r"] ?? null) == "app_listepromoaffaire")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-align-left\"></i>Liste Promo. Affaire
            </a>
          </li>

          ";
        // line 86
        yield "          <li class=\"";
        yield (((($context["r"] ?? null) == "app_newpromoreseau")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/newpromoreseau\" class=\"small-fort ";
        // line 87
        yield (((($context["r"] ?? null) == "app_newpromoreseau")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-square-plus\"></i>Promo. Réseau Sociaux
            </a>
          </li>
          <li class=\"";
        // line 91
        yield (((($context["r"] ?? null) == "app_listepromoreseau")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/listepromoreseau\" class=\"small-fort ";
        // line 92
        yield (((($context["r"] ?? null) == "app_listepromoreseau")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-align-left\"></i>Liste Promo. Réseau S.
            </a>
          </li>

        </ul>
      </li>

      ";
        // line 101
        yield "      <li class=\"";
        yield (((($tmp = ($context["actu_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\">
        <a href=\"/actu\" class=\"";
        // line 102
        yield (((($tmp = ($context["actu_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-newspaper\"></i></div>
          <div class=\"menu-title\">Actu</div>
        </a>
      </li>
      ";
        // line 108
        yield "      <li class=\"";
        yield (((($tmp = ($context["params_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\">
        <a href=\"/parametres\" class=\"";
        // line 109
        yield (((($tmp = ($context["params_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-gear\"></i></div>
          <div class=\"menu-title\">Paramètres</div>
        </a>
        <ul class=\"";
        // line 113
        yield (((($tmp = ($context["params_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-show") : (""));
        yield "\">


          ";
        // line 117
        yield "          <li class=\"sidebar-section-label\"><span>Mon Espace</span></li>
          <li class=\"";
        // line 118
        yield ((CoreExtension::inFilter(($context["r"] ?? null), ["app_notifications"])) ? ("mm-active") : (""));
        yield "\">
            <a href=\"";
        // line 119
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_notifications");
        yield "\" class=\"small-fort ";
        yield ((CoreExtension::inFilter(($context["r"] ?? null), ["app_notifications"])) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-bell\"></i>Notifications
            </a>
          </li>
          <li class=\"";
        // line 123
        yield (((($context["r"] ?? null) == "app_contact")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/contact\" class=\"small-fort ";
        // line 124
        yield (((($context["r"] ?? null) == "app_contact")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-address-book\"></i>Contacts
            </a>
          </li>
          <li>
            <a href=\"#\" class=\"small-fort sidebar-soon\">
              <i class=\"fas fa-trophy\"></i>Récompenses
            </a>
          </li>

          <li class=\"";
        // line 134
        yield (((($context["r"] ?? null) == "app_guide_import_contacts")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/contacts/guide-import\" class=\"small-fort ";
        // line 135
        yield (((($context["r"] ?? null) == "app_guide_import_contacts")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-book-open\"></i>Guide d\x27import
            </a>
          </li>
          <li class=\"";
        // line 139
        yield (((($context["r"] ?? null) == "app_export_vcf")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/export_vcf\" class=\"small-fort ";
        // line 140
        yield (((($context["r"] ?? null) == "app_export_vcf")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-address-card\"></i>Export VCF
            </a>
          </li>
          <li class=\"";
        // line 144
        yield (((($context["r"] ?? null) == "app_export_csv")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/export_csv\" class=\"small-fort ";
        // line 145
        yield (((($context["r"] ?? null) == "app_export_csv")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-file-csv\"></i>Export CSV
            </a>
          </li>

          ";
        // line 151
        yield "          <li class=\"sidebar-section-label\"><span>Mon Compte</span></li>
          <li class=\"";
        // line 152
        yield (((($context["r"] ?? null) == "app_editprofil")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/editprofil\" class=\"small-fort ";
        // line 153
        yield (((($context["r"] ?? null) == "app_editprofil")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-user\"></i>Profil
            </a>
          </li>
          <li class=\"";
        // line 157
        yield (((($context["r"] ?? null) == "app_editPassword")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/editPassword\" class=\"small-fort ";
        // line 158
        yield (((($context["r"] ?? null) == "app_editPassword")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-lock\"></i>Modifier le mot de passe
            </a>
          </li>
          <li class=\"";
        // line 162
        yield ((CoreExtension::inFilter(($context["r"] ?? null), ["app_preferencePays", "app_hub_preferences"])) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/preferences\" class=\"small-fort ";
        // line 163
        yield ((CoreExtension::inFilter(($context["r"] ?? null), ["app_preferencePays", "app_hub_preferences"])) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-heart\"></i>Préférences
            </a>
          </li>

          ";
        // line 169
        yield "          <li class=\"sidebar-section-label\"><span>Assistance &amp; Avis</span></li>
          <li class=\"";
        // line 170
        yield (((($context["r"] ?? null) == "app_tutoriels")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"";
        // line 171
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tutoriels");
        yield "\" class=\"small-fort ";
        yield (((($context["r"] ?? null) == "app_tutoriels")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-graduation-cap\"></i>Tutoriels
            </a>
          </li>
          <li class=\"";
        // line 175
        yield (((($context["r"] ?? null) == "app_assistant")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"";
        // line 176
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_assistant");
        yield "\" class=\"small-fort ";
        yield (((($context["r"] ?? null) == "app_assistant")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-comments\"></i>Assistant IA
            </a>
          </li>
          <li class=\"";
        // line 180
        yield (((($context["r"] ?? null) == "app_support")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/support\" class=\"small-fort ";
        // line 181
        yield (((($context["r"] ?? null) == "app_support")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-headset\"></i>Support Technique
            </a>
          </li>
          <li class=\"";
        // line 185
        yield (((($context["r"] ?? null) == "app_addSuggestion")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/addSuggestion\" class=\"small-fort ";
        // line 186
        yield (((($context["r"] ?? null) == "app_addSuggestion")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-lightbulb\"></i>Suggestions
            </a>
          </li>
          <li class=\"";
        // line 190
        yield (((($context["r"] ?? null) == "app_signalerUser")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/signalerUser\" class=\"small-fort ";
        // line 191
        yield (((($context["r"] ?? null) == "app_signalerUser")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-triangle-exclamation\"></i>Signaler un utilisateur
            </a>
          </li>

          ";
        // line 197
        yield "          <li class=\"sidebar-section-label\"><span>Actions Avancées</span></li>
          <li class=\"";
        // line 198
        yield (((($context["r"] ?? null) == "app_deleteCompte")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/deleteCompte\" class=\"small-fort ";
        // line 199
        yield (((($context["r"] ?? null) == "app_deleteCompte")) ? ("active") : (""));
        yield "\" style=\"color:#e74c3c;\">
              <i class=\"fas fa-trash\"></i>Supprimer mon compte
            </a>
          </li>

          ";
        // line 205
        yield "          <li class=\"sidebar-section-label\"><span>Application</span></li>
          <li class=\"";
        // line 206
        yield (((($context["r"] ?? null) == "app_apropos")) ? ("mm-active") : (""));
        yield "\">
            <a href=\"/apropos\" class=\"small-fort ";
        // line 207
        yield (((($context["r"] ?? null) == "app_apropos")) ? ("active") : (""));
        yield "\">
              <i class=\"fas fa-circle-info\"></i>À Propos
            </a>
          </li>
          <li>
            <a href=\"/logout\" class=\"small-fort\">
              <i class=\"fas fa-right-from-bracket\"></i>Se déconnecter
            </a>
          </li>

        </ul>
      </li>

    </ul>
    <!--end navigation-->
</aside>

<style>
/* Labels de section dans les sous-menus */
.sidebar-section-label {
  list-style: none;
  padding: 10px 20px 4px 20px;
  pointer-events: none;
}
.sidebar-section-label span {
  font-size: 0.68rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #888;
  opacity: 0.7;
}
/* Liens non encore disponibles */
.sidebar-soon {
  opacity: 0.5;
  cursor: default;
  pointer-events: none;
}
html.dark-theme .sidebar-section-label span {
  color: #aaa;
}
</style>

<script>
(function () {
    window.addEventListener(\x27load\x27, function () {
        setTimeout(function () {
            var active = document.querySelector(\x27.sidebar-wrapper .mm-active\x27);
            var scrollEl = document.querySelector(\x27.sidebar-wrapper .simplebar-content-wrapper\x27);
            if (!active || !scrollEl) return;
            var offsetTop = 0;
            var node = active;
            while (node && node !== scrollEl) {
                offsetTop += node.offsetTop;
                var parent = node.offsetParent;
                if (!parent || parent === document.body || parent === document.documentElement) break;
                node = parent;
            }
            scrollEl.scrollTop = Math.max(0, offsetTop - (scrollEl.clientHeight / 2) + (active.offsetHeight / 2));
        }, 250);
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
        return "private/_includes/sidebar_wrapper.html.twig";
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
        return array (  445 => 207,  441 => 206,  438 => 205,  430 => 199,  426 => 198,  423 => 197,  415 => 191,  411 => 190,  404 => 186,  400 => 185,  393 => 181,  389 => 180,  380 => 176,  376 => 175,  367 => 171,  363 => 170,  360 => 169,  352 => 163,  348 => 162,  341 => 158,  337 => 157,  330 => 153,  326 => 152,  323 => 151,  315 => 145,  311 => 144,  304 => 140,  300 => 139,  293 => 135,  289 => 134,  276 => 124,  272 => 123,  263 => 119,  259 => 118,  256 => 117,  250 => 113,  243 => 109,  238 => 108,  230 => 102,  225 => 101,  214 => 92,  210 => 91,  203 => 87,  198 => 86,  190 => 80,  186 => 79,  179 => 75,  174 => 74,  166 => 68,  162 => 67,  155 => 63,  150 => 62,  145 => 59,  138 => 55,  133 => 54,  125 => 48,  120 => 47,  109 => 40,  104 => 39,  101 => 37,  92 => 31,  87 => 30,  84 => 29,  67 => 13,  65 => 12,  63 => 11,  59 => 9,  57 => 8,  54 => 7,  52 => 6,  50 => 5,  47 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/_includes/sidebar_wrapper.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/_includes/sidebar_wrapper.html.twig");
    }
}
