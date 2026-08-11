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

/* public/actualite_detail.html.twig */
class __TwigTemplate_468c629b5a79257c3a47e3fdfd079ce3 extends Template
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
            'robots_meta' => [$this, 'block_robots_meta'],
            'jsonld' => [$this, 'block_jsonld'],
            'referencement' => [$this, 'block_referencement'],
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
        $context["isSiteApplication"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 3) == "sites_applications");
        // line 4
        $context["siteAppName"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nomSiteApp", [], "any", true, true, false, 4)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nomSiteApp", [], "any", false, false, false, 4), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nom", [], "any", false, false, false, 4))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nom", [], "any", false, false, false, 4))), "");
        // line 5
        $context["siteAppUrl"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "urlSiteApp", [], "any", true, true, false, 5)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "urlSiteApp", [], "any", false, false, false, 5), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "url", [], "any", false, false, false, 5))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "url", [], "any", false, false, false, 5))), "");
        // line 6
        $context["siteAppSubtype"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousTypeSiteApp", [], "any", true, true, false, 6)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 6), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousType", [], "any", false, false, false, 6))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousType", [], "any", false, false, false, 6))), "");
        // line 8
        $context["title"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 8) . " — Actualité");
        // line 9
        $context["description"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 9) == "offre_emploi")) {
                yield "Offre d\x27emploi";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "titre_demande_poste_rechercher", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "titre_demande_poste_rechercher", [], "any", false, false, false, 9))) {
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "titre_demande_poste_rechercher", [], "any", false, false, false, 9), "html", null, true);
                }
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "lieu_travail", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "lieu_travail", [], "any", false, false, false, 9))) {
                    yield " à ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "lieu_travail", [], "any", false, false, false, 9), "html", null, true);
                }
                yield " par ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 9), "html", null, true);
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "description_poste", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "description_poste", [], "any", false, false, false, 9))) {
                    yield " · ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "description_poste", [], "any", false, false, false, 9), 0, 80), "html", null, true);
                }
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 9) == "dmd_emploi")) {
                yield "Demande d\x27emploi";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "titre_demande_poste_rechercher", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "titre_demande_poste_rechercher", [], "any", false, false, false, 9))) {
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "titre_demande_poste_rechercher", [], "any", false, false, false, 9), "html", null, true);
                }
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "localisation_souhaite", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "localisation_souhaite", [], "any", false, false, false, 9))) {
                    yield " à ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "localisation_souhaite", [], "any", false, false, false, 9), "html", null, true);
                }
                yield " par ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 9), "html", null, true);
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 9), "description_profil_demandeur", [], "any", true, true, false, 9) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "description_profil_demandeur", [], "any", false, false, false, 9))) {
                    yield " · ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 9), "description_profil_demandeur", [], "any", false, false, false, 9), 0, 80), "html", null, true);
                }
            } else {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 9), 0, 160), "html", null, true);
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["description"] = Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::trim(($context["description"] ?? null)), 0, 155);
        // line 1
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_robots_meta(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 13
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "isFakeVue", [], "any", false, false, false, 13) || !CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "status", [], "any", false, false, false, 13), [3, 4]))) {
            // line 14
            yield "<meta name=\"robots\" content=\"noindex, nofollow\">
<meta name=\"googlebot\" content=\"noindex, nofollow\">
";
        } else {
            // line 17
            yield "<meta name=\"robots\" content=\"index, follow\">
<meta name=\"googlebot\" content=\"index, follow\">
";
        }
        yield from [];
    }

    // line 22
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 23
        if (( !CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "isFakeVue", [], "any", false, false, false, 23) && CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "status", [], "any", false, false, false, 23), [3, 4]))) {
            // line 24
            yield "<script type=\"application/ld+json\">
";
            // line 25
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 25) == "produit_service")) {
                // line 26
                yield "{
  \"@context\": \"https://schema.org\",
  \"@type\": \"Product\",
  \"name\": \"";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 29), "js"), "html", null, true);
                yield " — Dressur\",
  \"description\": \"";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 30), 0, 500), "js"), "html", null, true);
                yield "\",
  \"image\": \"https://dressur.site/promotion/";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 31), "html", null, true);
                yield "\",
  \"url\": \"https://dressur.site/actualite/";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 32), "html", null, true);
                yield "\",
  \"brand\": {
    \"@type\": \"Brand\",
    \"name\": \"";
                // line 35
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 35), "js"), "html", null, true);
                yield "\"
  },
  \"offers\": {
    \"@type\": \"Offer\",
    \"availability\": \"https://schema.org/InStock\",
    \"url\": \"https://dressur.site/actualite/";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 40), "html", null, true);
                yield "\",
    \"priceSpecification\": {
      \"@type\": \"PriceSpecification\",
      \"priceCurrency\": \"XOF\",
      \"price\": 0,
      \"minPrice\": 0
    },
    \"hasMerchantReturnPolicy\": {
      \"@type\": \"MerchantReturnPolicy\",
      \"applicableCountry\": \"BJ\",
      \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"
    },
    \"shippingDetails\": {
      \"@type\": \"OfferShippingDetails\",
      \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"},
      \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"},
      \"deliveryTime\": {
        \"@type\": \"ShippingDeliveryTime\",
        \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"},
        \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}
      }
    },
    \"seller\": {
      \"@type\": \"Person\",
      \"name\": \"";
                // line 64
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 64), "js"), "html", null, true);
                yield "\"
    }
  }
}
";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 68
($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 68) == "offre_emploi")) {
                // line 69
                yield "{
  \"@context\": \"https://schema.org\",
  \"@type\": \"JobPosting\",
  \"title\": \"";
                // line 72
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 72), "titre_demande_poste_rechercher", [], "any", true, true, false, 72) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 72), "titre_demande_poste_rechercher", [], "any", false, false, false, 72))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 72), "titre_demande_poste_rechercher", [], "any", false, false, false, 72)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 72))), "js"), "html", null, true);
                yield "\",
  \"description\": \"";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 73), "description_poste", [], "any", true, true, false, 73) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 73), "description_poste", [], "any", false, false, false, 73))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 73), "description_poste", [], "any", false, false, false, 73)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 73))), 0, 1000), "js"), "html", null, true);
                yield "\",
  \"image\": \"https://dressur.site/promotion/";
                // line 74
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 74), "html", null, true);
                yield "\",
  \"url\": \"https://dressur.site/actualite/";
                // line 75
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 75), "html", null, true);
                yield "\",
  \"datePosted\": \"";
                // line 76
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d"), "html", null, true);
                yield "\",
  \"employmentType\": \"";
                // line 77
                yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 77), "type_contrat", [], "any", true, true, false, 77) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 77), "type_contrat", [], "any", false, false, false, 77))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 77), "type_contrat", [], "any", false, false, false, 77), "js"), "html", null, true)) : ("FULL_TIME"));
                yield "\",
  \"hiringOrganization\": {
    \"@type\": \"Organization\",
    \"name\": \"";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 80), "js"), "html", null, true);
                yield "\",
    \"sameAs\": \"https://dressur.site\"
  },
  \"jobLocation\": {
    \"@type\": \"Place\",
    \"address\": {
      \"@type\": \"PostalAddress\",
      \"addressLocality\": \"";
                // line 87
                yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 87), "lieu_travail", [], "any", true, true, false, 87) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 87), "lieu_travail", [], "any", false, false, false, 87))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 87), "lieu_travail", [], "any", false, false, false, 87), "js"), "html", null, true)) : (""));
                yield "\"
    }
  }
}
";
            } else {
                // line 92
                yield "{
  \"@context\": \"https://schema.org\",
  \"@type\": \"Service\",
  \"name\": \"";
                // line 95
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 95), "js"), "html", null, true);
                yield " — Dressur\",
  \"description\": \"";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 96), 0, 500), "js"), "html", null, true);
                yield "\",
  \"image\": \"https://dressur.site/promotion/";
                // line 97
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 97), "html", null, true);
                yield "\",
  \"url\": \"https://dressur.site/actualite/";
                // line 98
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 98), "html", null, true);
                yield "\",
  \"provider\": {
    \"@type\": \"Person\",
    \"name\": \"";
                // line 101
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 101), "js"), "html", null, true);
                yield "\"
  },
  \"offers\": {
    \"@type\": \"Offer\",
    \"availability\": \"https://schema.org/InStock\",
    \"url\": \"https://dressur.site/actualite/";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 106), "html", null, true);
                yield "\",
    \"priceSpecification\": {
      \"@type\": \"PriceSpecification\",
      \"priceCurrency\": \"XOF\",
      \"price\": 0,
      \"minPrice\": 0
    },
    \"hasMerchantReturnPolicy\": {
      \"@type\": \"MerchantReturnPolicy\",
      \"applicableCountry\": \"BJ\",
      \"returnPolicyCategory\": \"https://schema.org/MerchantReturnNotPermitted\"
    },
    \"shippingDetails\": {
      \"@type\": \"OfferShippingDetails\",
      \"shippingRate\": {\"@type\": \"MonetaryAmount\", \"value\": \"0\", \"currency\": \"XOF\"},
      \"shippingDestination\": {\"@type\": \"DefinedRegion\", \"addressCountry\": \"BJ\"},
      \"deliveryTime\": {
        \"@type\": \"ShippingDeliveryTime\",
        \"handlingTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"},
        \"transitTime\": {\"@type\": \"QuantitativeValue\", \"minValue\": 0, \"maxValue\": 0, \"unitCode\": \"DAY\"}
      }
    }
  }
}
";
            }
            // line 131
            yield "</script>
<script type=\"application/ld+json\">
{\"@context\":\"https://schema.org\",\"@type\":\"BreadcrumbList\",\"itemListElement\":[{\"@type\":\"ListItem\",\"position\":1,\"name\":\"Accueil\",\"item\":\"https://dressur.site/\"},{\"@type\":\"ListItem\",\"position\":2,\"name\":\"Actualités\",\"item\":\"https://dressur.site/actualite\"},{\"@type\":\"ListItem\",\"position\":3,\"name\":\"";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 133), "js"), "html", null, true);
            yield "\",\"item\":\"https://dressur.site/actualite/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 133), "html", null, true);
            yield "\"}]}
</script>
<script type=\"application/ld+json\">
{
  \"@context\": \"https://schema.org\",
  \"@type\": \"Article\",
  \"headline\": \"";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "js"), "html", null, true);
            yield "\",
  \"description\": \"";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "js"), "html", null, true);
            yield "\",
  \"image\": {
    \"@type\": \"ImageObject\",
    \"url\": \"https://dressur.site/promotion/";
            // line 143
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 143), "html", null, true);
            yield "\"
  },
  \"url\": \"https://dressur.site/actualite/";
            // line 145
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 145), "html", null, true);
            yield "\",
  \"datePublished\": \"";
            // line 146
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "datePublished", [], "any", false, false, false, 146), "html", null, true);
            yield "\",
  \"dateModified\": \"";
            // line 147
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "datePublished", [], "any", false, false, false, 147), "html", null, true);
            yield "\",
  \"author\": {
    \"@type\": \"Person\",
    \"name\": \"";
            // line 150
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 150), "js"), "html", null, true);
            yield "\"
  },
  \"publisher\": {
    \"@type\": \"Organization\",
    \"name\": \"Dressur\",
    \"url\": \"https://dressur.site\",
    \"@id\": \"https://dressur.site/#organization\",
    \"logo\": {
      \"@type\": \"ImageObject\",
      \"url\": \"https://dressur.site/assets/images/dressur_logo_blanc.png\",
      \"width\": 200,
      \"height\": 60
    }
  },
  \"mainEntityOfPage\": {
    \"@type\": \"WebPage\",
    \"@id\": \"https://dressur.site/actualite/";
            // line 166
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 166), "html", null, true);
            yield "\"
  }
}
</script>
";
        }
        yield from [];
    }

    // line 173
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 174
        yield "    <meta property=\"og:title\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta property=\"og:description\" content=\"";
        // line 175
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/promotion/";
        // line 176
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 176), "html", null, true);
        yield "\" />
    <meta property=\"og:url\" content=\"https://dressur.site/actualite/";
        // line 177
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 177), "html", null, true);
        yield "\" />
    <meta property=\"og:type\" content=\"article\" />
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"twitter:image\" content=\"https://dressur.site/promotion/";
        // line 182
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 182), "html", null, true);
        yield "\" />
    <meta name=\"description\" content=\"";
        // line 183
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
";
        yield from [];
    }

    // line 186
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 188
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 189
        yield "<div class=\"container my-3\">

    <div class=\"mb-3 h6\">
        <span class=\"fw-bolder\">Dressur</span> /
        <a href=\"/actualite\" class=\"text-decoration-none\">Actualités</a> /
        <span class=\"text-primary\">";
        // line 194
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 194), "html", null, true);
        yield "</span>
    </div>

    <div class=\"row g-4\">
        <div class=\"col-lg-8 mx-auto\">
            ";
        // line 199
        $context["altPromo"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 199) == "offre_emploi")) {
                yield "Offre d\x27emploi";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 199), "titre_demande_poste_rechercher", [], "any", true, true, false, 199) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "titre_demande_poste_rechercher", [], "any", false, false, false, 199))) {
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "titre_demande_poste_rechercher", [], "any", false, false, false, 199), "html", null, true);
                }
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 199), "lieu_travail", [], "any", true, true, false, 199) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "lieu_travail", [], "any", false, false, false, 199))) {
                    yield " à ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "lieu_travail", [], "any", false, false, false, 199), "html", null, true);
                }
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 199), "html", null, true);
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 199) == "dmd_emploi")) {
                yield "Demande d\x27emploi";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 199), "titre_demande_poste_rechercher", [], "any", true, true, false, 199) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "titre_demande_poste_rechercher", [], "any", false, false, false, 199))) {
                    yield " — ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "titre_demande_poste_rechercher", [], "any", false, false, false, 199), "html", null, true);
                }
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, true, false, 199), "localisation_souhaite", [], "any", true, true, false, 199) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "localisation_souhaite", [], "any", false, false, false, 199))) {
                    yield " à ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 199), "localisation_souhaite", [], "any", false, false, false, 199), "html", null, true);
                }
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 199), "html", null, true);
            } else {
                yield "Promotion produit / service — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 199), "html", null, true);
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 200
        yield "            <div class=\"card shadow\">
                <img src=\"/promotion/";
        // line 201
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 201), "html", null, true);
        yield "\" class=\"card-img-top w-100\" alt=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(($context["altPromo"] ?? null)), "html", null, true);
        yield "\" style=\"height:auto; display:block;\">
                <div class=\"card-body p-4\">

                    ";
        // line 204
        if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 205
            yield "                        <div class=\"d-flex align-items-start mb-3\">
                            <div class=\"flex-grow-1\">
                                <h1 class=\"h3 mb-2 fw-bold\">";
            // line 207
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            yield "</h1>
                                <span class=\"badge bg-info\">
                                    ";
            // line 209
            if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                yield "Site web
                                    ";
            } elseif ((            // line 210
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                yield "Application mobile
                                    ";
            } elseif ((            // line 211
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                yield "Logiciel desktop
                                    ";
            } else {
                // line 212
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppSubtype"] ?? null), "html", null, true);
            }
            // line 213
            yield "                                </span>
                            </div>
                        </div>

                        <div class=\"fs-6 mb-3\">";
            // line 217
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 217), "html", null, true));
            yield "</div>
                    ";
        } else {
            // line 219
            yield "                        <div class=\"d-flex align-items-start mb-3\">
                            <div class=\"flex-grow-1\">
                                <h5 class=\"mb-1 fw-bold\">";
            // line 221
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 221), "html", null, true);
            yield "</h5>
                                <span class=\"badge bg-info\">
                                    ";
            // line 223
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 223) == "produit_service")) {
                yield "Produit / Service
                                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 224
($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 224) == "offre_emploi")) {
                yield "Offre d\x27emploi
                                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 225
($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 225) == "dmd_emploi")) {
                yield "Demande d\x27emploi
                                    ";
            } else {
                // line 226
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 226), "html", null, true);
                yield "
                                    ";
            }
            // line 228
            yield "                                </span>
                            </div>
                            <div class=\"text-end text-muted small ms-3\">
                                <div><i class=\"fas fa-eye me-1\"></i>";
            // line 231
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nombreImpression", [], "any", false, false, false, 231), "html", null, true);
            yield " vues</div>
                                <div><i class=\"fas fa-hand-pointer me-1\"></i>";
            // line 232
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nombreDeVues", [], "any", false, false, false, 232), "html", null, true);
            yield " clics</div>
                            </div>
                        </div>

                        <p class=\"fs-6 mb-3\">";
            // line 236
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 236), "html", null, true));
            yield "</p>

                        ";
            // line 238
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 238)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 239
                yield "                            <hr>
                            <div class=\"row g-2\">
                            ";
                // line 241
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 241));
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 242
                    yield "                                ";
                    if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty($context["value"])) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 243
                        yield "                                <div class=\"col-12 mb-1\">
                                    <span class=\"fw-bold text-primary\">";
                        // line 244
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace($context["key"], ["_" => " "])), "html", null, true);
                        yield " :</span>
                                    <span>";
                        // line 245
                        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true));
                        yield "</span>
                                </div>
                                ";
                    }
                    // line 248
                    yield "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 249
                yield "                            </div>
                            <hr>
                        ";
            }
            // line 252
            yield "                    ";
        }
        // line 253
        yield "
                    <div class=\"mt-3 d-flex gap-2 flex-wrap\">
                        ";
        // line 255
        if ((($context["isSiteApplication"] ?? null) && ($context["siteAppUrl"] ?? null))) {
            // line 256
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppUrl"] ?? null), "html_attr");
            yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-primary\">
                                ";
            // line 257
            if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                yield "Ouvrir
                                ";
            } elseif ((            // line 258
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                yield "Télécharger
                                ";
            } elseif ((            // line 259
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                yield "Savoir plus
                                ";
            }
            // line 261
            yield "                                <i class=\"fas fa-external-link-alt ms-1\"></i>
                            </a>
                        ";
        }
        // line 264
        yield "                        ";
        $context["waText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield "Bonjour/Bonsoir *";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 264), "html", null, true);
            yield "*, j\x27ai une question concernant votre promotion sur Dressur.";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 265
        yield "                        ";
        $context["waUrl"] = ((("https://wa.me/" . CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "whatsappNumber", [], "any", false, false, false, 265)) . "?text=") . Twig\Extension\CoreExtension::urlencode(($context["waText"] ?? null)));
        // line 266
        yield "                        <button type=\"button\" class=\"btn btn-success ds-contact-btn\"
                            data-wa-url=\"";
        // line 267
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["waUrl"] ?? null), "html", null, true);
        yield "\">
                            <i class=\"fab fa-whatsapp me-2\"></i>Contacter l\x27annonceur
                        </button>
                        <button class=\"btn btn-outline-secondary ds-share-btn\"
                            data-share-url=\"https://dressur.site/actualite/";
        // line 271
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 271), "html", null, true);
        yield "\"
                            data-share-title=\"";
        // line 272
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 272), "html", null, true);
        yield " — Dressur\"
                            data-share-text=\"";
        // line 273
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 273), 0, 100), "html", null, true);
        yield "\">
                            <i class=\"fas fa-share-nodes me-1\"></i> Partager
                        </button>
                        <button class=\"btn btn-outline-dark ds-copy-btn\"
                            data-copy-url=\"https://dressur.site/actualite/";
        // line 277
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 277), "html", null, true);
        yield "\">
                            <i class=\"fas fa-link me-1\"></i> Copier le lien
                        </button>
                        ";
        // line 280
        if ((($context["is_connect"] ?? null) == "non")) {
            // line 281
            yield "                        <a href=\"/connexion\" class=\"btn btn-outline-primary\">
                            <i class=\"fas fa-user me-1\"></i>Rejoindre Dressur
                        </a>
                        ";
        }
        // line 285
        yield "                    </div>
                </div>
            </div>
        </div>

        ";
        // line 290
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["autresPromos"] ?? null)) > 0)) {
            // line 291
            yield "        <div class=\"col-12\">
            <h5 class=\"mb-3 fw-semibold\"><i class=\"fas fa-rectangle-ad me-2 text-info\"></i>Autres actualités</h5>
            <div class=\"row g-3\">
                ";
            // line 294
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["autresPromos"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["autre"]) {
                // line 295
                yield "                ";
                $context["altAutre"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "typePromotionAffaire", [], "any", false, false, false, 295) == "offre_emploi")) {
                        yield "Offre d\x27emploi";
                        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, true, false, 295), "titre_demande_poste_rechercher", [], "any", true, true, false, 295) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "titre_demande_poste_rechercher", [], "any", false, false, false, 295))) {
                            yield " — ";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "titre_demande_poste_rechercher", [], "any", false, false, false, 295), "html", null, true);
                        }
                        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, true, false, 295), "lieu_travail", [], "any", true, true, false, 295) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "lieu_travail", [], "any", false, false, false, 295))) {
                            yield " à ";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "lieu_travail", [], "any", false, false, false, 295), "html", null, true);
                        }
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 295), "html", null, true);
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "typePromotionAffaire", [], "any", false, false, false, 295) == "dmd_emploi")) {
                        yield "Demande d\x27emploi";
                        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, true, false, 295), "titre_demande_poste_rechercher", [], "any", true, true, false, 295) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "titre_demande_poste_rechercher", [], "any", false, false, false, 295))) {
                            yield " — ";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "titre_demande_poste_rechercher", [], "any", false, false, false, 295), "html", null, true);
                        }
                        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, true, false, 295), "localisation_souhaite", [], "any", true, true, false, 295) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "localisation_souhaite", [], "any", false, false, false, 295))) {
                            yield " à ";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "annotherInfo", [], "any", false, false, false, 295), "localisation_souhaite", [], "any", false, false, false, 295), "html", null, true);
                        }
                        yield " — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 295), "html", null, true);
                    } else {
                        yield "Promotion produit / service — ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 295), "html", null, true);
                    }
                    yield from [];
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 296
                yield "                <div class=\"col-md-4\">
                    <div class=\"card mb-0 shadow h-100\">
                        <a href=\"/actualite/";
                // line 298
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 298), "html", null, true);
                yield "\">
                            <img src=\"/promotion/";
                // line 299
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "image", [], "any", false, false, false, 299), "html", null, true);
                yield "\" class=\"card-img-top image-actu\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(($context["altAutre"] ?? null)), "html", null, true);
                yield "\">
                        </a>
                        <div class=\"card-body\">
                            <p class=\"card-text actu-small-description mb-2\">";
                // line 302
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "description", [], "any", false, false, false, 302), "html", null, true);
                yield "</p>
                            <div class=\"d-flex align-items-center justify-content-between\">
                                <div class=\"text-muted small\">
                                    <span class=\"me-2\"><i class=\"fas fa-eye me-1\"></i>";
                // line 305
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "nombreImpression", [], "any", false, false, false, 305), "html", null, true);
                yield "</span>
                                    <span><i class=\"fas fa-hand-pointer me-1\"></i>";
                // line 306
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "nombreDeVues", [], "any", false, false, false, 306), "html", null, true);
                yield "</span>
                                </div>
                                <div class=\"d-flex gap-1\">
                                    <button class=\"btn btn-outline-secondary btn-sm py-0 px-2 ds-share-btn\"
                                        data-share-url=\"https://dressur.site/actualite/";
                // line 310
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 310), "html", null, true);
                yield "\"
                                        data-share-title=\"";
                // line 311
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 311), "html", null, true);
                yield " — Dressur\"
                                        data-share-text=\"";
                // line 312
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "description", [], "any", false, false, false, 312), 0, 100), "html", null, true);
                yield "\">
                                        <i class=\"fas fa-share-nodes\"></i>
                                    </button>
                                    <a href=\"/actualite/";
                // line 315
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 315), "html", null, true);
                yield "\" class=\"btn btn-info btn-sm py-0 px-2\">
                                        Voir <i class=\"fas fa-arrow-right ms-1\"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['autre'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 324
            yield "            </div>
        </div>
        ";
        }
        // line 327
        yield "
    </div>
</div>

<!-- Modal sécurité paiement -->
<div class=\"modal fade\" id=\"modalContactAnnonceur\" tabindex=\"-1\" aria-labelledby=\"modalContactAnnonceurLabel\" aria-hidden=\"true\">
  <div class=\"modal-dialog modal-dialog-centered\">
    <div class=\"modal-content border-0 shadow-lg\">
      <div class=\"modal-header bg-warning text-dark border-0\">
        <h5 class=\"modal-title fw-bold\" id=\"modalContactAnnonceurLabel\">
          <i class=\"fas fa-shield-halved me-2\"></i>Avertissement important
        </h5>
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Fermer\"></button>
      </div>
      <div class=\"modal-body py-4\">
        <p class=\"mb-3\">Avant de contacter cet annonceur, veuillez prendre connaissance de cet avertissement :</p>
        <div class=\"alert alert-danger mb-3\">
          <i class=\"fas fa-triangle-exclamation me-2\"></i>
          <strong>Payez uniquement via un moyen sécurisé</strong> permettant d\x27engager un recours en cas de litige
          (carte bancaire, PayPal, etc.).
        </div>
        <p class=\"mb-2 text-muted small\">
          Si vous effectuez un paiement direct (virement bancaire, Mobile Money, envoi d\x27argent via une tierce personne, etc.)
          et que vous êtes victime d\x27une arnaque, <strong>Dressur ne pourra en aucun cas être tenu responsable</strong>.
        </p>
        <p class=\"mb-0 text-muted small\">
          En cas de doute, n\x27envoyez aucune somme d\x27argent avant d\x27avoir vérifié l\x27identité et la fiabilité de l\x27annonceur.
          Votre sécurité est votre priorité.
        </p>
      </div>
      <div class=\"modal-footer border-0 pt-0 d-flex gap-2\">
        <button type=\"button\" class=\"btn btn-secondary flex-fill\" data-bs-dismiss=\"modal\">
          <i class=\"fas fa-arrow-left me-1\"></i> Annuler
        </button>
        <a href=\"#\" id=\"btnConfirmerContact\" target=\"_blank\" class=\"btn btn-success flex-fill\" data-bs-dismiss=\"modal\">
          <i class=\"fab fa-whatsapp me-2\"></i>Je comprends, continuer
        </a>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
    // Partage vers les applications
    if (!window._dsShareReady) {
        window._dsShareReady = true;
        document.addEventListener(\x27click\x27, async function(e) {
            var btn = e.target.closest(\x27.ds-share-btn\x27);
            if (!btn) return;
            var shareData = {
                title: btn.dataset.shareTitle,
                text: btn.dataset.shareText,
                url: btn.dataset.shareUrl
            };
            var copyToClipboard = async function(url, el) {
                try {
                    await navigator.clipboard.writeText(url);
                    var orig = el.innerHTML;
                    el.innerHTML = \x27<i class=\"fas fa-check me-1\"></i> Copié !\x27;
                    setTimeout(function() { el.innerHTML = orig; }, 2000);
                } catch(err) {
                    window.open(url, \x27_blank\x27);
                }
            };
            if (navigator.share) {
                try {
                    await navigator.share(shareData);
                } catch(err) {
                    if (err.name !== \x27AbortError\x27) {
                        await copyToClipboard(btn.dataset.shareUrl, btn);
                    }
                }
            } else {
                await copyToClipboard(btn.dataset.shareUrl, btn);
            }
        });
    }

    // Copier le lien
    document.addEventListener(\x27click\x27, async function(e) {
        var btn = e.target.closest(\x27.ds-copy-btn\x27);
        if (!btn) return;
        try {
            await navigator.clipboard.writeText(btn.dataset.copyUrl);
            var orig = btn.innerHTML;
            btn.innerHTML = \x27<i class=\"fas fa-check me-1\"></i> Lien copié !\x27;
            setTimeout(function() { btn.innerHTML = orig; }, 2500);
        } catch(err) {
            var tmp = document.createElement(\x27input\x27);
            tmp.value = btn.dataset.copyUrl;
            document.body.appendChild(tmp);
            tmp.select();
            document.execCommand(\x27copy\x27);
            document.body.removeChild(tmp);
            var orig = btn.innerHTML;
            btn.innerHTML = \x27<i class=\"fas fa-check me-1\"></i> Lien copié !\x27;
            setTimeout(function() { btn.innerHTML = orig; }, 2500);
        }
    });

    // Modal contacter l\x27annonceur
    document.addEventListener(\x27click\x27, function(e) {
        var btn = e.target.closest(\x27.ds-contact-btn\x27);
        if (!btn) return;
        document.getElementById(\x27btnConfirmerContact\x27).href = btn.dataset.waUrl;
        var modal = new bootstrap.Modal(document.getElementById(\x27modalContactAnnonceur\x27));
        modal.show();
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
        return "public/actualite_detail.html.twig";
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
        return array (  838 => 327,  833 => 324,  818 => 315,  812 => 312,  808 => 311,  804 => 310,  797 => 306,  793 => 305,  787 => 302,  779 => 299,  775 => 298,  771 => 296,  738 => 295,  734 => 294,  729 => 291,  727 => 290,  720 => 285,  714 => 281,  712 => 280,  706 => 277,  699 => 273,  695 => 272,  691 => 271,  684 => 267,  681 => 266,  678 => 265,  670 => 264,  665 => 261,  660 => 259,  656 => 258,  652 => 257,  647 => 256,  645 => 255,  641 => 253,  638 => 252,  633 => 249,  627 => 248,  621 => 245,  617 => 244,  614 => 243,  611 => 242,  607 => 241,  603 => 239,  601 => 238,  596 => 236,  589 => 232,  585 => 231,  580 => 228,  575 => 226,  570 => 225,  566 => 224,  562 => 223,  557 => 221,  553 => 219,  548 => 217,  542 => 213,  539 => 212,  534 => 211,  530 => 210,  526 => 209,  521 => 207,  517 => 205,  515 => 204,  507 => 201,  504 => 200,  470 => 199,  462 => 194,  455 => 189,  448 => 188,  437 => 186,  430 => 183,  426 => 182,  422 => 181,  418 => 180,  412 => 177,  408 => 176,  404 => 175,  399 => 174,  392 => 173,  381 => 166,  362 => 150,  356 => 147,  352 => 146,  348 => 145,  343 => 143,  337 => 140,  333 => 139,  322 => 133,  318 => 131,  290 => 106,  282 => 101,  276 => 98,  272 => 97,  268 => 96,  264 => 95,  259 => 92,  251 => 87,  241 => 80,  235 => 77,  231 => 76,  227 => 75,  223 => 74,  219 => 73,  215 => 72,  210 => 69,  208 => 68,  201 => 64,  174 => 40,  166 => 35,  160 => 32,  156 => 31,  152 => 30,  148 => 29,  143 => 26,  141 => 25,  138 => 24,  136 => 23,  129 => 22,  121 => 17,  116 => 14,  114 => 13,  107 => 12,  102 => 1,  100 => 10,  61 => 9,  59 => 8,  57 => 6,  55 => 5,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/actualite_detail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/actualite_detail.html.twig");
    }
}
