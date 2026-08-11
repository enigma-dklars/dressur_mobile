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

/* private/_includes/sidebar_admin.html.twig */
class __TwigTemplate_fba44b1e0ac1710428a9ec1e4a15c788 extends Template
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
        $context["user_special"] = ["app_crud_user_check_and_confirme", "app_crud_user_check", "app_crud_user_purge", "app_crud_user_banned"];
        // line 5
        $context["is_user"] = (((is_string($_v0 = ($context["r"] ?? null)) && is_string($_v1 = "app_crud_user") && str_starts_with($_v0, $_v1)) &&  !(is_string($_v2 = ($context["r"] ?? null)) && is_string($_v3 = "app_crud_user_bot") && str_starts_with($_v2, $_v3))) && !CoreExtension::inFilter(($context["r"] ?? null), ($context["user_special"] ?? null)));
        // line 6
        $context["is_user_bot"] = (is_string($_v4 = ($context["r"] ?? null)) && is_string($_v5 = "app_crud_user_bot") && str_starts_with($_v4, $_v5));
        // line 7
        $context["is_boost"] = (is_string($_v6 = ($context["r"] ?? null)) && is_string($_v7 = "app_crud_boost") && str_starts_with($_v6, $_v7));
        // line 8
        $context["is_promotion"] = (is_string($_v8 = ($context["r"] ?? null)) && is_string($_v9 = "app_crud_promotion") && str_starts_with($_v8, $_v9));
        // line 9
        $context["is_promo_reseau"] = (is_string($_v10 = ($context["r"] ?? null)) && is_string($_v11 = "app_crud_promo_reseau") && str_starts_with($_v10, $_v11));
        // line 10
        $context["is_histo_recomp"] = (is_string($_v12 = ($context["r"] ?? null)) && is_string($_v13 = "app_historique_programme_recompense") && str_starts_with($_v12, $_v13));
        // line 11
        $context["is_preuve"] = (is_string($_v14 = ($context["r"] ?? null)) && is_string($_v15 = "app_preuve") && str_starts_with($_v14, $_v15));
        // line 12
        $context["is_f_boost"] = (is_string($_v16 = ($context["r"] ?? null)) && is_string($_v17 = "app_crud_formule_boost") && str_starts_with($_v16, $_v17));
        // line 13
        $context["is_f_affaire"] = (is_string($_v18 = ($context["r"] ?? null)) && is_string($_v19 = "app_crud_formule_promo_affaire") && str_starts_with($_v18, $_v19));
        // line 14
        $context["is_f_reseau"] = (is_string($_v20 = ($context["r"] ?? null)) && is_string($_v21 = "app_crud_formule_promo_reseau") && str_starts_with($_v20, $_v21));
        // line 15
        $context["is_f_bot"] = (is_string($_v22 = ($context["r"] ?? null)) && is_string($_v23 = "app_crud_formule_dressur_bot") && str_starts_with($_v22, $_v23));
        // line 16
        $context["is_env"] = ((is_string($_v24 = ($context["r"] ?? null)) && is_string($_v25 = "app_crud_env") && str_starts_with($_v24, $_v25)) &&  !(is_string($_v26 = ($context["r"] ?? null)) && is_string($_v27 = "app_crud_env_mail") && str_starts_with($_v26, $_v27)));
        // line 17
        $context["is_env_paiem"] = (is_string($_v28 = ($context["r"] ?? null)) && is_string($_v29 = "app_env_paiement_api") && str_starts_with($_v28, $_v29));
        // line 18
        $context["is_methode"] = (is_string($_v30 = ($context["r"] ?? null)) && is_string($_v31 = "app_methode_paiement") && str_starts_with($_v30, $_v31));
        // line 19
        $context["is_env_mail"] = (is_string($_v32 = ($context["r"] ?? null)) && is_string($_v33 = "app_crud_env_mail") && str_starts_with($_v32, $_v33));
        // line 20
        $context["is_mot"] = (is_string($_v34 = ($context["r"] ?? null)) && is_string($_v35 = "app_crud_mot_refuser") && str_starts_with($_v34, $_v35));
        // line 21
        $context["is_deleted"] = (is_string($_v36 = ($context["r"] ?? null)) && is_string($_v37 = "app_crud_deleted_d_s") && str_starts_with($_v36, $_v37));
        // line 22
        $context["is_transaction"] = (is_string($_v38 = ($context["r"] ?? null)) && is_string($_v39 = "app_crud_transaction") && str_starts_with($_v38, $_v39));
        // line 23
        $context["is_suggestion"] = (is_string($_v40 = ($context["r"] ?? null)) && is_string($_v41 = "app_crud_suggestion") && str_starts_with($_v40, $_v41));
        // line 24
        $context["is_signalement"] = (is_string($_v42 = ($context["r"] ?? null)) && is_string($_v43 = "app_crud_signalement") && str_starts_with($_v42, $_v43));
        // line 25
        $context["is_comm_mail"] = (is_string($_v44 = ($context["r"] ?? null)) && is_string($_v45 = "app_communication_mail") && str_starts_with($_v44, $_v45));
        // line 26
        $context["is_story"] = (is_string($_v46 = ($context["r"] ?? null)) && is_string($_v47 = "app_crud_story") && str_starts_with($_v46, $_v47));
        // line 27
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
      <li class=\"my-0 ";
        // line 41
        yield (((($context["r"] ?? null) == "app_admin")) ? ("mm-active") : (""));
        yield "\">
        <a href=\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin");
        yield "\" class=\"py-1 ";
        yield (((($context["r"] ?? null) == "app_admin")) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-gauge text-warning\"></i>
          </div>
          <div class=\"menu-title text-warning\">Dashboard Admin</div>
        </a>
      </li>
      <li class=\"my-0 ";
        // line 48
        yield (((($context["r"] ?? null) == "app_private")) ? ("mm-active") : (""));
        yield "\">
        <a href=\"/private\" class=\"py-1 ";
        // line 49
        yield (((($context["r"] ?? null) == "app_private")) ? ("active") : (""));
        yield "\">
          <div class=\"parent-icon\"><i class=\"fas fa-house-user text-success\"></i>
          </div>
          <div class=\"menu-title text-success\">Espace User</div>
        </a>
      </li>

      <hr class=\"my-2\">
      
      <li class=\"my-0 ";
        // line 58
        yield (((($tmp = ($context["is_user"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_user"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Utilisateurs</a></li>
      <li class=\"my-0 ";
        // line 59
        yield (((($context["r"] ?? null) == "app_crud_user_check_and_confirme")) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_check_and_confirme");
        yield "\" class=\"py-1 small-fort bg-success text-white ";
        yield (((($context["r"] ?? null) == "app_crud_user_check_and_confirme")) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Check User Confirm</a></li>
      <li class=\"my-0 ";
        // line 60
        yield (((($context["r"] ?? null) == "app_crud_user_check")) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_check");
        yield "\" class=\"py-1 small-fort bg-info text-white ";
        yield (((($context["r"] ?? null) == "app_crud_user_check")) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Check User</a></li>
      <li class=\"my-0 ";
        // line 61
        yield (((($context["r"] ?? null) == "app_crud_user_purge")) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_purge");
        yield "\" class=\"py-1 small-fort bg-danger text-white ";
        yield (((($context["r"] ?? null) == "app_crud_user_purge")) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Purge User</a></li>
      <li class=\"my-0 ";
        // line 62
        yield (((($context["r"] ?? null) == "app_crud_user_banned")) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_banned");
        yield "\" class=\"py-1 small-fort bg-warning text-dark ";
        yield (((($context["r"] ?? null) == "app_crud_user_banned")) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Bannir User</a></li>
      <li class=\"my-0 ";
        // line 63
        yield (((($tmp = ($context["is_user_bot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_bot_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_user_bot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Users DS Bot</a></li>

      <hr class=\"my-2\">

      <li class=\"my-0 ";
        // line 67
        yield (((($tmp = ($context["is_story"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_story"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-film\"></i>Stories</a></li>
      <li class=\"my-0 ";
        // line 68
        yield (((($tmp = ($context["is_boost"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_boost"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Boost Contact</a></li>
      <li class=\"my-0 ";
        // line 69
        yield (((($tmp = ($context["is_promotion"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_promotion"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>P. Affaire</a></li>
      <li class=\"my-0 ";
        // line 70
        yield (((($tmp = ($context["is_promo_reseau"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_promo_reseau"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>P. Réseaux Sociaux</a></li>
      <li class=\"my-0 ";
        // line 71
        yield (((($tmp = ($context["is_histo_recomp"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_historique_programme_recompense_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_histo_recomp"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>H. P. Récompense</a></li>
      <li class=\"my-0 ";
        // line 72
        yield (((($tmp = ($context["is_preuve"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_preuve"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Preuve Récompense</a></li>

      <hr class=\"my-2\">

      <li class=\"my-0 ";
        // line 76
        yield (((($tmp = ($context["is_f_boost"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_boost_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_f_boost"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>F. Boosts</a></li>
      <li class=\"my-0 ";
        // line 77
        yield (((($tmp = ($context["is_f_affaire"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_affaire_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_f_affaire"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>F. Affaires</a></li>
      <li class=\"my-0 ";
        // line 78
        yield (((($tmp = ($context["is_f_reseau"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_f_reseau"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>F. Réseaux Sociaux</a></li>
      <li class=\"my-0 ";
        // line 79
        yield (((($tmp = ($context["is_f_bot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_dressur_bot_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_f_bot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>F. Dressur Bot</a></li>

      <hr class=\"my-2\">
      
      <li class=\"my-0 ";
        // line 83
        yield (((($tmp = ($context["is_env"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_env"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Env</a></li>
      <li class=\"my-0 ";
        // line 84
        yield (((($tmp = ($context["is_env_paiem"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_env_paiement_api_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_env_paiem"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Env Paiement Api</a></li>
      <li class=\"my-0 ";
        // line 85
        yield (((($tmp = ($context["is_methode"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_methode_paiement_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_methode"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Env M. Paiement</a></li>
      <li class=\"my-0 ";
        // line 86
        yield (((($tmp = ($context["is_env_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_env_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Env Mail Sender</a></li>
      <li class=\"my-0 ";
        // line 87
        yield (((($tmp = ($context["is_env_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tuto_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_env_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Tuto</a></li>

      <hr class=\"my-2\">

      <li class=\"my-0 ";
        // line 91
        yield (((($tmp = ($context["is_comm_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_comm_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-envelope\"></i>Communication Mail</a></li>

      <hr class=\"my-2\">
      
      <li class=\"my-0 ";
        // line 95
        yield (((($tmp = ($context["is_mot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_mot_refuser_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_mot"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Mot Refuser</a></li>
      <li class=\"my-0 ";
        // line 96
        yield (((($tmp = ($context["is_deleted"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_deleted_d_s_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_deleted"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Deleted DS</a></li>
      <li class=\"my-0 ";
        // line 97
        yield (((($tmp = ($context["is_transaction"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_transaction"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Transaction</a></li>
      <li class=\"my-0 ";
        // line 98
        yield (((($tmp = ($context["is_suggestion"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_suggestion_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_suggestion"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Suggestion</a></li>
      <li class=\"my-0 ";
        // line 99
        yield (((($tmp = ($context["is_signalement"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("mm-active") : (""));
        yield "\"> <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_signalement_index");
        yield "\" class=\"py-1 small-fort ";
        yield (((($tmp = ($context["is_signalement"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"><i class=\"me-2 fas fa-align-left\"></i>Signalement</a></li>


    </ul>
    <!--end navigation-->
</aside>

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
        return "private/_includes/sidebar_admin.html.twig";
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
        return array (  363 => 99,  355 => 98,  347 => 97,  339 => 96,  331 => 95,  320 => 91,  309 => 87,  301 => 86,  293 => 85,  285 => 84,  277 => 83,  266 => 79,  258 => 78,  250 => 77,  242 => 76,  231 => 72,  223 => 71,  215 => 70,  207 => 69,  199 => 68,  191 => 67,  180 => 63,  172 => 62,  164 => 61,  156 => 60,  148 => 59,  140 => 58,  128 => 49,  124 => 48,  113 => 42,  109 => 41,  93 => 27,  91 => 26,  89 => 25,  87 => 24,  85 => 23,  83 => 22,  81 => 21,  79 => 20,  77 => 19,  75 => 18,  73 => 17,  71 => 16,  69 => 15,  67 => 14,  65 => 13,  63 => 12,  61 => 11,  59 => 10,  57 => 9,  55 => 8,  53 => 7,  51 => 6,  49 => 5,  47 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/_includes/sidebar_admin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/_includes/sidebar_admin.html.twig");
    }
}
