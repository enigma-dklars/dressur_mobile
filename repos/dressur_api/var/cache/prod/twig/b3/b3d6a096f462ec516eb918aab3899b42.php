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

/* public/_includes/footer_public.html.twig */
class __TwigTemplate_a73286f8e9844cfb7f6886b3d9ec738c extends Template
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
/* ── Footer public ──────────────────────────────────── */
#ds-footer {
    background: linear-gradient(160deg, #0f2650 0%, #1c3a6e 60%, #162f5a 100%);
    color: #e8edf5;
}
#ds-footer a { transition: color .18s; }
#ds-footer .ds-footer-link {
    color: #8aacd4;
    text-decoration: none;
    font-size: .88rem;
}
#ds-footer .ds-footer-link:hover { color: #fff; }
#ds-footer .ds-section-title {
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #fff;
    margin-bottom: .9rem;
}
#ds-footer .ds-social-btn {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: rgba(255,255,255,.1);
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    text-decoration: none;
    font-size: .95rem;
    transition: background .2s, transform .15s;
}
#ds-footer .ds-social-btn:hover { transform: translateY(-2px); }
#ds-footer .ds-social-btn.fb:hover   { background: #1877f2; }
#ds-footer .ds-social-btn.wa:hover   { background: #25d366; }
#ds-footer .ds-social-btn.gp:hover   { background: #01875f; }

#ds-footer .ds-play-btn {
    display: inline-flex; align-items: center; gap: .6rem;
    padding: .55rem 1rem;
    border-radius: 10px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.18);
    color: #fff;
    text-decoration: none;
    font-size: .85rem;
    transition: background .2s;
}
#ds-footer .ds-play-btn:hover { background: rgba(255,255,255,.17); color: #fff; }

#ds-footer .ds-divider { border-color: rgba(255,255,255,.1); }
#ds-footer .ds-bottom { font-size: .8rem; color: #5f83ab; }
#ds-footer .ds-top-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.15);
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
    transition: background .2s;
}
#ds-footer .ds-top-btn:hover { background: rgba(255,255,255,.22); color: #fff; }
</style>

<footer id=\"ds-footer\">
    <div class=\"container py-5\">
        <div class=\"row g-4\">

            ";
        // line 70
        yield "            <div class=\"col-lg-4 col-md-12\">
                <a href=\"";
        // line 71
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\" class=\"d-inline-block mb-3\">
                    <img src=\"/assets/images/brand-logo-2.png\" height=\"34\" alt=\"Dressur\"
                         style=\"filter: brightness(0) invert(1);\">
                </a>
                <p class=\"mb-4\" style=\"color:#8aacd4; font-size:.88rem; line-height:1.75; max-width:340px;\">
                    Plateforme africaine de marketing digital — boostez vos contacts,
                    promouvez votre affaire et développez votre présence en ligne en Afrique de l\x27Ouest.
                </p>
                <div class=\"d-flex gap-2\">
                    <a href=\"https://www.facebook.com/dressurds\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-social-btn fb\" title=\"Facebook Dressur\">
                        <i class=\"fab fa-facebook-f\"></i>
                    </a>
                    <a href=\"https://wa.me/22964044294\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-social-btn wa\" title=\"WhatsApp Dressur\">
                        <i class=\"fab fa-whatsapp\"></i>
                    </a>
                    <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-social-btn gp\" title=\"Dressur sur Google Play\">
                        <i class=\"fab fa-google-play\"></i>
                    </a>
                </div>
            </div>

            ";
        // line 96
        yield "            <div class=\"col-lg-2 col-md-4 col-6\">
                <div class=\"ds-section-title\">Navigation</div>
                <ul class=\"list-unstyled mb-0\" style=\"line-height:2;\">
                    <li><a href=\"";
        // line 99
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_public");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-house fa-xs me-2\" style=\"width:14px;\"></i>Accueil
                    </a></li>
                    <li><a href=\"";
        // line 102
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_actualite");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-newspaper fa-xs me-2\" style=\"width:14px;\"></i>Actualités
                    </a></li>
                    <li><a href=\"";
        // line 105
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-tags fa-xs me-2\" style=\"width:14px;\"></i>Tarifs
                    </a></li>
                    <li><a href=\"";
        // line 108
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contactez_nous");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-envelope fa-xs me-2\" style=\"width:14px;\"></i>Contact
                    </a></li>
                    <li><a href=\"";
        // line 111
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_connexion");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-arrow-right-to-bracket fa-xs me-2\" style=\"width:14px;\"></i>Connexion
                    </a></li>
                    <li><a href=\"";
        // line 114
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-user-plus fa-xs me-2\" style=\"width:14px;\"></i>Inscription
                    </a></li>
                </ul>
            </div>

            ";
        // line 121
        yield "            <div class=\"col-lg-3 col-md-4 col-6\">
                <div class=\"ds-section-title\">Nos services</div>
                <ul class=\"list-unstyled mb-0\" style=\"line-height:2;\">
                    <li><a href=\"";
        // line 124
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_services");
        yield "\" class=\"ds-footer-link fw-semibold\">
                        <i class=\"fas fa-th-large fa-xs me-2\" style=\"width:14px;\"></i>Tous les services
                    </a></li>
                    <li><a href=\"";
        // line 127
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dressur_bot");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fab fa-android fa-xs me-2\" style=\"width:14px;\"></i>Dressur Bot
                    </a></li>
                    <li><a href=\"";
        // line 130
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_boost_contact");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-bolt fa-xs me-2\" style=\"width:14px;\"></i>Boost Contact
                    </a></li>
                    <li><a href=\"";
        // line 133
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_affaire");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-briefcase fa-xs me-2\" style=\"width:14px;\"></i>Promotion Affaire
                    </a></li>
                    <li><a href=\"";
        // line 136
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"ds-footer-link\">
                        <i class=\"fas fa-share-nodes fa-xs me-2\" style=\"width:14px;\"></i>Promotions Réseaux Sociaux
                    </a></li>
                </ul>
            </div>

            ";
        // line 143
        yield "            <div class=\"col-lg-3 col-md-4 col-12\">
                <div class=\"ds-section-title\">Application mobile</div>
                <p style=\"color:#8aacd4; font-size:.85rem;\" class=\"mb-3\">
                    Accédez à Dressur depuis votre smartphone Android.
                </p>
                <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\"
                   target=\"_blank\" rel=\"noopener\" class=\"ds-play-btn mb-4\">
                    <i class=\"fab fa-google-play fa-lg\"></i>
                    <span>
                        <small class=\"d-block\" style=\"font-size:.68rem; opacity:.7;\">Disponible sur</small>
                        <strong style=\"font-size:.88rem;\">Google Play</strong>
                    </span>
                </a>

                <div class=\"ds-section-title mt-4\">Légal</div>
                <ul class=\"list-unstyled mb-0\" style=\"line-height:2;\">
                    <li><a href=\"";
        // line 159
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_conditions_utilisation");
        yield "\" class=\"ds-footer-link\">
                        Conditions d\x27utilisation
                    </a></li>
                    <li><a href=\"";
        // line 162
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("politique_confidentialite");
        yield "\" class=\"ds-footer-link\">
                        Politique de confidentialité
                    </a></li>
                </ul>
            </div>

        </div>
    </div>

    <hr class=\"ds-divider my-0\">

    <div class=\"container py-3\">
        <div class=\"d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 ds-bottom\">
            <span>© 2021 – ";
        // line 175
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " <strong class=\"text-white\">Dressur</strong>. Tous droits réservés.</span>
            <div class=\"d-flex align-items-center gap-3\">
                <span>Fait avec <span style=\"color:#e55;\">♥</span> en Afrique de l\x27Ouest</span>
                <a href=\"#\" class=\"ds-top-btn\" title=\"Retour en haut\" onclick=\"window.scrollTo({top:0,behavior:\x27smooth\x27});return false;\">
                    <i class=\"fas fa-chevron-up fa-sm\"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/_includes/footer_public.html.twig";
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
        return array (  264 => 175,  248 => 162,  242 => 159,  224 => 143,  215 => 136,  209 => 133,  203 => 130,  197 => 127,  191 => 124,  186 => 121,  177 => 114,  171 => 111,  165 => 108,  159 => 105,  153 => 102,  147 => 99,  142 => 96,  115 => 71,  112 => 70,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/_includes/footer_public.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/_includes/footer_public.html.twig");
    }
}
