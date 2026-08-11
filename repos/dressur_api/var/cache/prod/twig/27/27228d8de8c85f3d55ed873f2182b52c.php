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

/* private/_includes/top_header.html.twig */
class __TwigTemplate_b2e28bc1c0c01ec232859e1af815bf6e extends Template
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
        // line 2
        $context["_appbar_titles"] = ["app_private" => "Accueil", "app_actu" => "Actualités", "app_actu_detail" => "Actualité", "app_contact" => "Contacts", "app_guide_import_contacts" => "Guide d\x27import", "app_export_vcf" => "Export VCF", "app_export_csv" => "Export CSV", "app_hub_services" => "Services", "app_listeboostcontact" => "Boost Contact", "app_newboostcontact" => "Boost Contact", "app_listepromoaffaire" => "Promo Affaire", "app_newpromoaffaire" => "Promo Affaire", "app_listepromoreseau" => "Promo Réseau", "app_newpromoreseau" => "Promo Réseau", "app_hub_preferences" => "Préférences", "app_preferencePays" => "Pays ciblés", "app_hub_parametres" => "Paramètres", "app_notifications" => "Notifications", "app_editprofil" => "Profil", "app_editPassword" => "Mot de passe", "app_tutoriels" => "Tutoriels", "app_assistant" => "Assistant IA", "app_support" => "Support", "app_addSuggestion" => "Suggestions", "app_signalerUser" => "Signaler", "app_apropos" => "À Propos", "app_deleteCompte" => "Supprimer le compte", "app_invitezVosAmis" => "Inviter des amis", "app_partagerDressur" => "Partager Dressur", "app_centreInteret" => "Centres d\x27intérêt", "app_confirmer_mail_web" => "Confirmation de l\x27adresse mail"];
        // line 35
        $context["_appbar_backs"] = ["app_contact" => "/parametres", "app_guide_import_contacts" => "/parametres", "app_export_vcf" => "/parametres", "app_export_csv" => "/parametres", "app_actu_detail" => "/actu", "app_confirmer_mail_web" => "/private", "app_listeboostcontact" => "/services", "app_newboostcontact" => "/services", "app_listepromoaffaire" => "/services", "app_newpromoaffaire" => "/services", "app_listepromoreseau" => "/services", "app_newpromoreseau" => "/services", "app_preferencePays" => "/preferences", "app_editprofil" => "/parametres", "app_editPassword" => "/parametres", "app_tutoriels" => "/parametres", "app_assistant" => "/parametres", "app_support" => "/parametres", "app_addSuggestion" => "/parametres", "app_signalerUser" => "/parametres", "app_apropos" => "/parametres", "app_deleteCompte" => "/parametres", "app_invitezVosAmis" => "/parametres", "app_partagerDressur" => "/parametres", "app_centreInteret" => "/parametres"];
        // line 62
        $context["_appbar_title"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["_appbar_titles"] ?? null), ($context["r"] ?? null), [], "array", true, true, false, 62) &&  !(null === (($_v0 = ($context["_appbar_titles"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[($context["r"] ?? null)] ?? null) : null)))) ? ((($_v1 = ($context["_appbar_titles"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[($context["r"] ?? null)] ?? null) : null)) : ("Dressur"));
        // line 63
        $context["_appbar_back"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["_appbar_backs"] ?? null), ($context["r"] ?? null), [], "array", true, true, false, 63) &&  !(null === (($_v2 = ($context["_appbar_backs"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2[($context["r"] ?? null)] ?? null) : null)))) ? ((($_v3 = ($context["_appbar_backs"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3[($context["r"] ?? null)] ?? null) : null)) : (null));
        // line 64
        yield "
<style>
/* ── AppBar mobile ── */
.ds-appbar {
    display: none;
    align-items: center;
    height: 56px;
    padding: 0 4px;
    background: var(--bs-body-bg, #fff);
    border-bottom: 1px solid rgba(0,0,0,.08);
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.ds-appbar-btn {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: var(--bs-body-color, #212529);
    font-size: 18px;
    cursor: pointer;
    flex-shrink: 0;
    text-decoration: none;
    transition: background .15s;
}
.ds-appbar-btn:hover { background: rgba(0,0,0,.06); color: inherit; }
.ds-appbar-title {
    flex: 1;
    font-weight: 600;
    font-size: 17px;
    text-align: center;
    color: var(--bs-body-color, #212529);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 4px;
}
.ds-appbar-right {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}
/* Badge de notification (appbar mobile + navbar desktop) */
.ds-notif-badge-wrap { position: relative; display: inline-flex; }
.ds-notif-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    min-width: 16px;
    height: 16px;
    padding: 0 3px;
    border-radius: 999px;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    display: none;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
}
/* dark / semi-dark */
html.dark-theme .ds-appbar {
    background: #1a2232;
    border-bottom: 1px solid rgba(255,255,255,.12);
    box-shadow: 0 1px 4px rgba(0,0,0,.3);
}
html.dark-theme .ds-appbar-title,
html.dark-theme .ds-appbar-btn { color: #fcfcfc; }
html.dark-theme .ds-appbar-btn:hover { background: rgba(255,255,255,.08); }
html.semi-dark .ds-appbar { background: #1a2232; border-bottom: 1px solid rgba(255,255,255,.12); }
html.semi-dark .ds-appbar-title,
html.semi-dark .ds-appbar-btn { color: #fcfcfc; }

@media screen and (max-width: 1024px) {
    .ds-appbar          { display: flex !important; }
    .top-header .navbar { display: none !important; }
}
@media screen and (min-width: 1025px) {
    .ds-appbar { display: none !important; }
}
</style>

<header class=\"top-header\">

    ";
        // line 158
        yield "    <div class=\"ds-appbar\">

        ";
        // line 161
        yield "        ";
        if ((($tmp = ($context["_appbar_back"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 162
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["_appbar_back"] ?? null), "html", null, true);
            yield "\" class=\"ds-appbar-btn\" title=\"Retour\">
                <i class=\"fas fa-arrow-left\"></i>
            </a>
        ";
        } else {
            // line 166
            yield "            <button class=\"ds-appbar-btn mobile-toggle-icon\" title=\"Menu\">
                <i class=\"bi bi-list\" style=\"font-size:22px\"></i>
            </button>
        ";
        }
        // line 170
        yield "
        ";
        // line 172
        yield "        <span class=\"ds-appbar-title\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["_appbar_title"] ?? null), "html", null, true);
        yield "</span>

        ";
        // line 175
        yield "        <div class=\"ds-appbar-right\">
            <button class=\"ds-appbar-btn change-theme\" title=\"Changer le thème\">
                <i class=\"fas ";
        // line 177
        if ((($context["theme"] ?? null) == "dark-theme")) {
            yield "fa-moon";
        } else {
            yield "fa-sun";
        }
        yield " ici-theme\"></i>
            </button>
            <a href=\"";
        // line 179
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_notifications");
        yield "\" class=\"ds-appbar-btn ds-notif-badge-wrap\" title=\"Notifications\">
                <i class=\"bi bi-bell-fill\"></i>
                <span class=\"ds-notif-badge\" id=\"dsNotifBadgeMobile\"></span>
            </a>
        </div>
    </div>

    ";
        // line 187
        yield "    <nav class=\"navbar navbar-expand\">
        <div class=\"mobile-toggle-icon d-xl-none\">
            <i class=\"bi bi-list\"></i>
        </div>
        <div class=\"top-navbar d-none d-xl-block\">
            <ul class=\"navbar-nav align-items-center\">
                ";
        // line 193
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "admin", [], "any", false, false, false, 193) == true)) {
            // line 194
            yield "                    <li class=\"nav-item\">
                        <a class=\"nav-link badge bg-danger\" href=\"";
            // line 195
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin");
            yield "\">Admin Dash</a>
                    </li>
                ";
        }
        // line 198
        yield "            </ul>
        </div>
        <div class=\"d-xl-none ms-auto\">
        </div>
        <form class=\"searchbar d-none d-xl-flex ms-auto\">
        </form>
        <div class=\"top-navbar-right ms-3\">
            <ul class=\"navbar-nav align-items-center\">
                <li class=\"nav-item dropdown dropdown-large\">
                    <a class=\"nav-link dropdown-toggle dropdown-toggle-nocaret\" href=\"javascript:;\" data-bs-toggle=\"dropdown\">
                    <div class=\"user-setting d-flex align-items-center gap-1\">
                        <div class=\"ds-avatar-sm\" data-name=\"";
        // line 209
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 209))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 209)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 209)))), "html", null, true);
        yield "\"></div>
                        <div class=\"user-name \">";
        // line 210
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 210), "html", null, true);
        yield "</div>
                    </div>
                    </a>
                    <ul class=\"dropdown-menu dropdown-menu-end\">
                        <li>
                            <a class=\"dropdown-item\" href=\"javascript:;\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"ds-avatar-lg\" data-name=\"";
        // line 217
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 217))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 217)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 217)))), "html", null, true);
        yield "\"></div>
                                <div class=\"ms-3\">
                                    <h6 class=\"mb-0 dropdown-user-name\">";
        // line 219
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 219), "html", null, true);
        yield "</h6>
                                    <small class=\"mb-0 dropdown-user-designation text-secondary\">@";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 220), "html", null, true);
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
                        <li>
                            <a class=\"dropdown-item\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#seDeconnecter\">
                                <div class=\"d-flex align-items-center\">
                                    <div class=\"setting-icon\"><i class=\"bi bi-lock-fill\"></i></div>
                                    <div class=\"setting-text ms-3\"><span>Se déconnecter</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <div class=\"notifications change-theme\">
                    <i class=\"fas ";
        // line 253
        if ((($context["theme"] ?? null) == "dark-theme")) {
            yield "fa-moon";
        } else {
            yield "fa-sun";
        }
        yield " ici-theme\"></i>
                </div>
                <li class=\"nav-item d-none d-sm-block\">
                    <a href=\"";
        // line 256
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_notifications");
        yield "\" class=\"nav-link\">
                    <div class=\"notifications ds-notif-badge-wrap\">
                        <i class=\"bi bi-bell-fill\"></i>
                        <span class=\"ds-notif-badge\" id=\"dsNotifBadgeDesktop\"></span>
                    </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script>
(function(){
    const LAST_SEEN_KEY = \x27ds_notif_last_seen_total\x27;
    const badges = [
        document.getElementById(\x27dsNotifBadgeMobile\x27),
        document.getElementById(\x27dsNotifBadgeDesktop\x27)
    ].filter(Boolean);

    function updateBadge(count){
        badges.forEach(function(el){
            if (count > 0) {
                el.textContent = count > 9 ? \x279+\x27 : String(count);
                el.style.display = \x27inline-flex\x27;
            } else {
                el.style.display = \x27none\x27;
            }
        });
    }
    window.dsUpdateNotifBadge = updateBadge;

    fetch(\x27/api/getNotifications\x27, { method: \x27POST\x27, credentials: \x27same-origin\x27 })
        .then(function(r){ return r.json(); })
        .then(function(data){
            if (data.error) return;
            const total = (data.notifications || []).length;
            let lastSeen = 0;
            try { lastSeen = parseInt(localStorage.getItem(LAST_SEEN_KEY) || \x270\x27, 10) || 0; } catch(e) {}
            updateBadge(Math.max(0, total - lastSeen));
        })
        .catch(function(){});
})();
</script>

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
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/_includes/top_header.html.twig";
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
        return array (  299 => 256,  289 => 253,  253 => 220,  249 => 219,  244 => 217,  234 => 210,  230 => 209,  217 => 198,  211 => 195,  208 => 194,  206 => 193,  198 => 187,  188 => 179,  179 => 177,  175 => 175,  169 => 172,  166 => 170,  160 => 166,  152 => 162,  149 => 161,  145 => 158,  50 => 64,  48 => 63,  46 => 62,  44 => 35,  42 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/_includes/top_header.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/_includes/top_header.html.twig");
    }
}
