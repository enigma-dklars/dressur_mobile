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

/* public/promotion_reseau_service_detail.html.twig */
class __TwigTemplate_99de1b2e7a30de482372be9d58905235 extends Template
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
        $context["platformName"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "parent", [], "any", false, false, false, 3), "titre", [], "any", false, false, false, 3);
        // line 4
        $context["serviceName"] = CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "titre", [], "any", false, false, false, 4);
        // line 5
        $context["prix_fcfa"] = Twig\Extension\CoreExtension::round((((CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "prix", [], "any", false, false, false, 5) * 1.2) * 1.7) * 700), 0, "ceil");
        // line 6
        $context["prix_display"] = (((($context["prix_fcfa"] ?? null) >= 100)) ? (($context["prix_fcfa"] ?? null)) : (100));
        // line 7
        $context["title"] = (((((($context["serviceName"] ?? null) . " ") . ($context["platformName"] ?? null)) . " — À partir de ") . ($context["prix_display"] ?? null)) . " F CFA");
        // line 8
        $context["description"] = (((((("Achetez des " . Twig\Extension\CoreExtension::lower($this->env->getCharset(), ($context["serviceName"] ?? null))) . " sur ") . ($context["platformName"] ?? null)) . " avec Dressur. Livraison rapide et fiable. À partir de ") . ($context["prix_display"] ?? null)) . " F CFA. Paiement Mobile Money sécurisé.");
        // line 1
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 11
        yield "    <meta property=\"og:title\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta property=\"og:description\" content=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/og/og-promotion-reseaux-sociaux.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_service_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\" />
    <meta property=\"og:type\" content=\"product\" />
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"description\" content=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"Dressur, ";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", acheter ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ($context["serviceName"] ?? null)), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ($context["serviceName"] ?? null)), "html", null, true);
        yield " pas cher Afrique, promotion réseaux sociaux Bénin\">
";
        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 24
        yield "<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"Product\",
  \"@id\": \"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_service_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "#product\",
  \"name\": \"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "\",
  \"description\": \"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\",
  \"url\": \"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_service_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\",
  \"brand\": {\"@type\":\"Brand\",\"name\":\"Dressur\",\"url\":\"https://dressur.site\"},
  \"image\": \"https://dressur.site/assets/img/og/og-promotion-reseaux-sociaux.jpg\",
  \"offers\": {
    \"@type\": \"Offer\",
    \"price\": \"";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["prix_display"] ?? null), "html", null, true);
        yield "\",
    \"priceCurrency\": \"XOF\",
    \"availability\": \"https://schema.org/InStock\",
    \"url\": \"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_inscription");
        yield "\",
    \"seller\": {\"@type\":\"Organization\",\"name\":\"Dressur\",\"url\":\"https://dressur.site\"},
    \"hasMerchantReturnPolicy\": {\"@type\":\"MerchantReturnPolicy\",\"applicableCountry\":\"BJ\",\"returnPolicyCategory\":\"https://schema.org/MerchantReturnNotPermitted\"},
    \"shippingDetails\": {
      \"@type\":\"OfferShippingDetails\",
      \"shippingRate\":{\"@type\":\"MonetaryAmount\",\"value\":\"0\",\"currency\":\"XOF\"},
      \"shippingDestination\":{\"@type\":\"DefinedRegion\",\"addressCountry\":\"BJ\"},
      \"deliveryTime\":{\"@type\":\"ShippingDeliveryTime\",\"handlingTime\":{\"@type\":\"QuantitativeValue\",\"minValue\":0,\"maxValue\":0,\"unitCode\":\"DAY\"},\"transitTime\":{\"@type\":\"QuantitativeValue\",\"minValue\":0,\"maxValue\":0,\"unitCode\":\"DAY\"}}
    }
  }
}
</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[
  {\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},
  {\"@type\":\"ListItem\",\"position\":2,\"name\":\"Réseaux Sociaux\",\"item\":\"";
        // line 54
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promotion_reseaux_sociaux");
        yield "\"},
  {\"@type\":\"ListItem\",\"position\":3,\"name\":\"";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "\",\"item\":\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_detail", ["token" => ($context["parent_token"] ?? null)]), "html", null, true);
        yield "\"},
  {\"@type\":\"ListItem\",\"position\":4,\"name\":\"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield "\",\"item\":\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_promo_reseau_service_detail", ["token" => ($context["current_token"] ?? null)]), "html", null, true);
        yield "\"}
]}
</script>
";
        yield from [];
    }

    // line 61
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 63
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 64
        yield "<div class=\"container mt-3\">

    ";
        // line 67
        yield "    <div class=\"mb-3 h6\">
        <span class=\"fw-bolder\">Dressur</span> /
        <a href=\"";
        // line 69
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"text-decoration-none\">Réseaux Sociaux</a> /
        <a href=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promo_reseau_detail", ["token" => ($context["parent_token"] ?? null)]), "html", null, true);
        yield "\" class=\"text-decoration-none\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</a> /
        <span class=\"text-primary\">";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield "</span>
    </div>

    ";
        // line 75
        yield "    <header class=\"text-white text-center py-5 rounded mb-4\" style=\"background-color: #2a4b9a !important;\">
        <div class=\"container\">
            <h1 class=\"display-5 fw-bold\">";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</h1>
            <p class=\"lead mb-2\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "</p>
            <p class=\"fs-3 fw-bold mb-4\">";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["prix_display"] ?? null), 0, ",", " "), "html", null, true);
        yield " F CFA</p>
            <a href=\"";
        // line 80
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-light btn-lg me-2\">
                <i class=\"fas fa-shopping-cart me-1\"></i> Commander maintenant
            </a>
            <a href=\"";
        // line 83
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tarifs");
        yield "\" class=\"btn btn-outline-light btn-lg\">
                <i class=\"fas fa-tags me-1\"></i> Voir tous les tarifs
            </a>
        </div>
    </header>

    ";
        // line 90
        yield "    <section class=\"mb-5\">
        <div class=\"row g-4\">
            <div class=\"col-md-7 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <h2 class=\"fw-semibold mb-4\" style=\"color:#2a4b9a;\">
                            <i class=\"fas fa-info-circle me-2\"></i>Détails du service
                        </h2>
                        <table class=\"table table-borderless mb-0\">
                            <tbody>
                                <tr>
                                    <td class=\"text-muted fw-semibold\" style=\"width:40%;\">Service</td>
                                    <td class=\"fw-bold\">";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["serviceName"] ?? null), "html", null, true);
        yield "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-muted fw-semibold\">Plateforme</td>
                                    <td class=\"fw-bold\">";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-muted fw-semibold\">Prix</td>
                                    <td class=\"fw-bold\" style=\"color:#2a4b9a;\">";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["prix_display"] ?? null), 0, ",", " "), "html", null, true);
        yield " F CFA</td>
                                </tr>
                                ";
        // line 112
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "qteMin", [], "any", false, false, false, 112) && CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "qteMax", [], "any", false, false, false, 112))) {
            // line 113
            yield "                                <tr>
                                    <td class=\"text-muted fw-semibold\">Quantité</td>
                                    <td>";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "qteMin", [], "any", false, false, false, 115), 0, ",", " "), "html", null, true);
            yield " – ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "qteMax", [], "any", false, false, false, 115), 0, ",", " "), "html", null, true);
            yield "</td>
                                </tr>
                                ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 117
($context["service"] ?? null), "qte", [], "any", false, false, false, 117)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 118
            yield "                                <tr>
                                    <td class=\"text-muted fw-semibold\">Quantité</td>
                                    <td>";
            // line 120
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "qte", [], "any", false, false, false, 120), 0, ",", " "), "html", null, true);
            yield "</td>
                                </tr>
                                ";
        }
        // line 123
        yield "                                <tr>
                                    <td class=\"text-muted fw-semibold\">Livraison</td>
                                    <td><span class=\"badge bg-success\">Rapide</span></td>
                                </tr>
                                <tr>
                                    <td class=\"text-muted fw-semibold\">Disponibilité</td>
                                    <td><span class=\"badge bg-success\">En stock</span></td>
                                </tr>
                            </tbody>
                        </table>
                        ";
        // line 133
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "description", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 134
            yield "                        <hr>
                        <div class=\"text-muted\" style=\"white-space: pre-wrap; line-height: 1.7;\">";
            // line 135
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["service"] ?? null), "description", [], "any", false, false, false, 135), "html", null, true));
            yield "</div>
                        ";
        }
        // line 137
        yield "                    </div>
                </div>
            </div>
            <div class=\"col-md-5 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\" style=\"background:#eef2ff; border: 2px solid #2a4b9a;\">
                    <div class=\"card-body p-4 text-center d-flex flex-column justify-content-center\">
                        <i class=\"fas fa-bolt fs-1 mb-3\" style=\"color:#2a4b9a;\"></i>
                        <h4 class=\"fw-bold\" style=\"color:#2a4b9a;\">Prêt à commander ?</h4>
                        <p class=\"text-muted mt-2 mb-4\">
                            Créez un compte Dressur gratuitement, rechargez votre solde et passez votre commande en quelques clics.
                        </p>
                        <a href=\"";
        // line 148
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" class=\"btn btn-primary btn-lg mb-2\">
                            <i class=\"fas fa-user-plus me-1\"></i> S\x27inscrire gratuitement
                        </a>
                        <a href=\"";
        // line 151
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_connexion");
        yield "\" class=\"btn btn-outline-primary\">
                            <i class=\"fas fa-sign-in-alt me-1\"></i> Déjà inscrit ? Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    ";
        // line 161
        yield "    <section class=\"mb-5\">
        <h2 class=\"fw-semibold text-center mb-4\">Pourquoi choisir Dressur ?</h2>
        <div class=\"row g-3 text-center\">
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <i class=\"fas fa-shield-alt fs-2 mb-3\" style=\"color:#2a4b9a;\"></i>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Paiement sécurisé</h5>
                        <p class=\"text-muted mt-2\">Rechargez votre compte via Mobile Money (MTN, Moov) en toute sécurité.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <i class=\"fas fa-rocket fs-2 mb-3\" style=\"color:#2a4b9a;\"></i>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Livraison rapide</h5>
                        <p class=\"text-muted mt-2\">Vos ";
        // line 178
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ($context["serviceName"] ?? null)), "html", null, true);
        yield " sont délivrés rapidement après validation de la commande.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4 d-flex align-items-stretch\">
                <div class=\"card mb-0 shadow-sm w-100\">
                    <div class=\"card-body p-4\">
                        <i class=\"fas fa-headset fs-2 mb-3\" style=\"color:#2a4b9a;\"></i>
                        <h5 class=\"fw-semibold\" style=\"color:#2a4b9a;\">Support disponible</h5>
                        <p class=\"text-muted mt-2\">Notre équipe est disponible pour vous accompagner à chaque étape.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    ";
        // line 195
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["autres_services"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 196
            yield "    <section class=\"mb-5\">
        <h2 class=\"fw-semibold mb-4\"><i class=\"fas fa-play fs-5 me-2\"></i>Autres services ";
            // line 197
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
            yield "</h2>
        <div class=\"row g-3\">
            ";
            // line 199
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["autres_services"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 200
                yield "            ";
                $context["p"] = Twig\Extension\CoreExtension::round((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 200), "prix", [], "any", false, false, false, 200) * 1.2) * 1.7) * 700), 0, "ceil");
                // line 201
                yield "            ";
                $context["p_display"] = (((($context["p"] ?? null) >= 100)) ? (($context["p"] ?? null)) : (100));
                // line 202
                yield "            <div class=\"col-md-4 col-6 d-flex align-items-stretch\">
                <a href=\"";
                // line 203
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promo_reseau_service_detail", ["token" => CoreExtension::getAttribute($this->env, $this->source, $context["item"], "token", [], "any", false, false, false, 203)]), "html", null, true);
                yield "\"
                   class=\"card mb-0 shadow-sm text-decoration-none w-100\" style=\"border-top: 3px solid #2a4b9a;\">
                    <div class=\"card-body py-3 px-3\">
                        <div class=\"fw-semibold\" style=\"color:#2a4b9a;\">";
                // line 206
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "enfant", [], "any", false, false, false, 206), "titre", [], "any", false, false, false, 206), "html", null, true);
                yield "</div>
                        <small class=\"text-muted\">";
                // line 207
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["p_display"] ?? null), 0, ",", " "), "html", null, true);
                yield " F CFA</small>
                    </div>
                </a>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 212
            yield "        </div>
    </section>
    ";
        }
        // line 215
        yield "
    <section class=\"pb-5\">
        <div class=\"card mb-0 shadow-sm\">
            <div class=\"card-body text-center py-4\">
                <a href=\"";
        // line 219
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promo_reseau_detail", ["token" => ($context["parent_token"] ?? null)]), "html", null, true);
        yield "\" class=\"btn btn-outline-primary me-2\">
                    <i class=\"fas fa-arrow-left me-1\"></i> Retour à ";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["platformName"] ?? null), "html", null, true);
        yield "
                </a>
                <a href=\"";
        // line 222
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_promotion_reseaux_sociaux");
        yield "\" class=\"btn btn-outline-secondary\">
                    <i class=\"fas fa-th me-1\"></i> Tous les réseaux sociaux
                </a>
            </div>
        </div>
    </section>

</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/promotion_reseau_service_detail.html.twig";
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
        return array (  486 => 222,  481 => 220,  477 => 219,  471 => 215,  466 => 212,  455 => 207,  451 => 206,  445 => 203,  442 => 202,  439 => 201,  436 => 200,  432 => 199,  427 => 197,  424 => 196,  421 => 195,  402 => 178,  383 => 161,  371 => 151,  365 => 148,  352 => 137,  347 => 135,  344 => 134,  342 => 133,  330 => 123,  324 => 120,  320 => 118,  318 => 117,  311 => 115,  307 => 113,  305 => 112,  300 => 110,  293 => 106,  286 => 102,  272 => 90,  263 => 83,  257 => 80,  253 => 79,  249 => 78,  243 => 77,  239 => 75,  233 => 71,  227 => 70,  223 => 69,  219 => 67,  215 => 64,  208 => 63,  197 => 61,  186 => 56,  180 => 55,  176 => 54,  158 => 39,  152 => 36,  144 => 31,  140 => 30,  134 => 29,  130 => 28,  124 => 24,  117 => 23,  102 => 20,  98 => 19,  94 => 18,  90 => 17,  84 => 14,  79 => 12,  74 => 11,  67 => 10,  62 => 1,  60 => 8,  58 => 7,  56 => 6,  54 => 5,  52 => 4,  50 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/promotion_reseau_service_detail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/promotion_reseau_service_detail.html.twig");
    }
}
