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

/* private/actualite.html.twig */
class __TwigTemplate_7621b340f37326e8f81299d3faf9a659 extends Template
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
        // line 3
        $context["isSiteApplication"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 3) == "sites_applications");
        // line 4
        $context["siteAppName"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nomSiteApp", [], "any", true, true, false, 4)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nomSiteApp", [], "any", false, false, false, 4), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nom", [], "any", false, false, false, 4))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nom", [], "any", false, false, false, 4))), "");
        // line 5
        $context["siteAppUrl"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "urlSiteApp", [], "any", true, true, false, 5)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "urlSiteApp", [], "any", false, false, false, 5), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "url", [], "any", false, false, false, 5))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "url", [], "any", false, false, false, 5))), "");
        // line 6
        $context["siteAppSubtype"] = Twig\Extension\CoreExtension::default(((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousTypeSiteApp", [], "any", true, true, false, 6)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 6), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousType", [], "any", false, false, false, 6))) : (CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "sousType", [], "any", false, false, false, 6))), "");
        // line 1
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
        } else {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 8), "html", null, true);
        }
        yield " — Actualité";
        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 11
        yield "<div class=\"row g-4\">

    <div class=\"col-12\">
        <a href=\"/actu\" class=\"btn btn-sm btn-secondary\">
            <i class=\"fas fa-arrow-left me-1\"></i> Retour aux actualités
        </a>
    </div>

    <div class=\"col-lg-8 mx-auto\">
        <div class=\"card shadow\">
            <img src=\"/promotion/";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "image", [], "any", false, false, false, 21), "html", null, true);
        yield "\" class=\"card-img-top w-100\" alt=\"";
        if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
        } else {
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 21), "html", null, true);
        }
        yield "\" style=\"height:auto; display:block;\">
            <div class=\"card-body p-4\">

                ";
        // line 24
        if ((($tmp = ($context["isSiteApplication"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 25
            yield "                    <div class=\"d-flex align-items-start mb-3\">
                        <div class=\"flex-grow-1\">
                            <h1 class=\"h3 mb-2 fw-bold\">";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppName"] ?? null), "html", null, true);
            yield "</h1>
                            <span class=\"badge bg-info\">
                                ";
            // line 29
            if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                yield "Site web
                                ";
            } elseif ((            // line 30
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                yield "Application mobile
                                ";
            } elseif ((            // line 31
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                yield "Logiciel desktop
                                ";
            } else {
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppSubtype"] ?? null), "html", null, true);
            }
            // line 33
            yield "                            </span>
                        </div>
                    </div>

                    <div class=\"fs-6 mb-3\">";
            // line 37
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 37), "html", null, true));
            yield "</div>
                ";
        } else {
            // line 39
            yield "                    <div class=\"d-flex align-items-start mb-3\">
                        <div class=\"flex-grow-1\">
                            <h5 class=\"mb-1 fw-bold\">";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 41), "html", null, true);
            yield "</h5>
                            <span class=\"badge bg-info\">
                                ";
            // line 43
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 43) == "produit_service")) {
                yield "Produit / Service
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 44
($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 44) == "offre_emploi")) {
                yield "Offre d\x27emploi
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 45
($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 45) == "dmd_emploi")) {
                yield "Demande d\x27emploi
                                ";
            } else {
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 46), "html", null, true);
                yield "
                                ";
            }
            // line 48
            yield "                            </span>
                        </div>
                        <div class=\"text-end text-muted small ms-3\">
                            <div><i class=\"fas fa-eye me-1\"></i>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nombreImpression", [], "any", false, false, false, 51), "html", null, true);
            yield " vues</div>
                            <div><i class=\"fas fa-hand-pointer me-1\"></i>";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "nombreDeVues", [], "any", false, false, false, 52), "html", null, true);
            yield " clics</div>
                        </div>
                    </div>

                    <p class=\"fs-6 mb-3\">";
            // line 56
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 56), "html", null, true));
            yield "</p>

                    ";
            // line 58
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 58)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 59
                yield "                        <hr>
                        <div class=\"row g-2\">
                        ";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "annotherInfo", [], "any", false, false, false, 61));
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 62
                    yield "                            ";
                    if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty($context["value"])) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 63
                        yield "                            <div class=\"col-12 mb-1\">
                                <span class=\"fw-bold text-primary\">";
                        // line 64
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace($context["key"], ["_" => " "])), "html", null, true);
                        yield " :</span>
                                <span>";
                        // line 65
                        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true));
                        yield "</span>
                            </div>
                            ";
                    }
                    // line 68
                    yield "                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                yield "                        </div>
                        <hr>
                    ";
            }
            // line 72
            yield "                ";
        }
        // line 73
        yield "
                <div class=\"mt-3 d-flex gap-2 flex-wrap\">
                    ";
        // line 75
        if ((($context["isSiteApplication"] ?? null) && ($context["siteAppUrl"] ?? null))) {
            // line 76
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["siteAppUrl"] ?? null), "html_attr");
            yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"btn btn-primary\">
                            ";
            // line 77
            if ((($context["siteAppSubtype"] ?? null) == "site_web")) {
                yield "Ouvrir
                            ";
            } elseif ((            // line 78
($context["siteAppSubtype"] ?? null) == "app_mobile")) {
                yield "Télécharger
                            ";
            } elseif ((            // line 79
($context["siteAppSubtype"] ?? null) == "logiciel_desktop")) {
                yield "Savoir plus
                            ";
            }
            // line 81
            yield "                            <i class=\"fas fa-external-link-alt ms-1\"></i>
                        </a>
                    ";
        }
        // line 84
        yield "                    ";
        $context["waText"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield "Bonjour/Bonsoir *";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 84), "html", null, true);
            yield "*, j\x27ai une question concernant votre promotion sur Dressur.";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 85
        yield "                    ";
        $context["waUrl"] = ((("https://wa.me/" . CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "whatsappNumber", [], "any", false, false, false, 85)) . "?text=") . Twig\Extension\CoreExtension::urlencode(($context["waText"] ?? null)));
        // line 86
        yield "                    <button type=\"button\" class=\"btn btn-success ds-contact-btn\"
                        data-wa-url=\"";
        // line 87
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["waUrl"] ?? null), "html", null, true);
        yield "\">
                        <i class=\"fab fa-whatsapp me-2\"></i>Contacter l\x27annonceur
                    </button>
                    <button class=\"btn btn-outline-secondary ds-share-btn\"
                        data-share-url=\"https://dressur.site/actualite/";
        // line 91
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 91), "html", null, true);
        yield "\"
                        data-share-title=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "pseudoAnnonceur", [], "any", false, false, false, 92), "html", null, true);
        yield " — Dressur\"
                        data-share-text=\"";
        // line 93
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "description", [], "any", false, false, false, 93), 0, 100), "html", null, true);
        yield "\">
                        <i class=\"fas fa-share-nodes me-1\"></i> Partager
                    </button>
                    <button class=\"btn btn-outline-dark ds-copy-btn\"
                        data-copy-url=\"https://dressur.site/actualite/";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promo"] ?? null), "token", [], "any", false, false, false, 97), "html", null, true);
        yield "\">
                        <i class=\"fas fa-link me-1\"></i> Copier le lien
                    </button>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 105
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["autresPromos"] ?? null)) > 0)) {
            // line 106
            yield "    <div class=\"col-12\">
        <h5 class=\"mb-3 fw-semibold\"><i class=\"fas fa-rectangle-ad me-2 text-info\"></i>Autres actualités</h5>
        <div class=\"row g-3\">
            ";
            // line 109
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["autresPromos"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["autre"]) {
                // line 110
                yield "            <div class=\"col-md-4\">
                <div class=\"card mb-0 shadow h-100\">
                    <a href=\"/actu/";
                // line 112
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 112), "html", null, true);
                yield "\">
                        <img src=\"/promotion/";
                // line 113
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "image", [], "any", false, false, false, 113), "html", null, true);
                yield "\" class=\"card-img-top image-actu\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 113), "html", null, true);
                yield "\">
                    </a>
                    <div class=\"card-body\">
                        <p class=\"card-text actu-small-description mb-2\">";
                // line 116
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "description", [], "any", false, false, false, 116), "html", null, true);
                yield "</p>
                        <div class=\"d-flex align-items-center justify-content-between\">
                            <div class=\"text-muted small\">
                                <span class=\"me-2\"><i class=\"fas fa-eye me-1\"></i>";
                // line 119
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "nombreImpression", [], "any", false, false, false, 119), "html", null, true);
                yield "</span>
                                <span><i class=\"fas fa-hand-pointer me-1\"></i>";
                // line 120
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "nombreDeVues", [], "any", false, false, false, 120), "html", null, true);
                yield "</span>
                            </div>
                            <div class=\"d-flex gap-1\">
                                <button class=\"btn btn-outline-secondary btn-sm py-0 px-2 ds-share-btn\"
                                    data-share-url=\"https://dressur.site/actualite/";
                // line 124
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 124), "html", null, true);
                yield "\"
                                    data-share-title=\"";
                // line 125
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "pseudoAnnonceur", [], "any", false, false, false, 125), "html", null, true);
                yield " — Dressur\"
                                    data-share-text=\"";
                // line 126
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "description", [], "any", false, false, false, 126), 0, 100), "html", null, true);
                yield "\">
                                    <i class=\"fas fa-share-nodes\"></i>
                                </button>
                                <a href=\"/actu/";
                // line 129
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["autre"], "token", [], "any", false, false, false, 129), "html", null, true);
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
            // line 138
            yield "        </div>
    </div>
    ";
        }
        // line 141
        yield "
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
        return "private/actualite.html.twig";
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
        return array (  388 => 141,  383 => 138,  368 => 129,  362 => 126,  358 => 125,  354 => 124,  347 => 120,  343 => 119,  337 => 116,  329 => 113,  325 => 112,  321 => 110,  317 => 109,  312 => 106,  310 => 105,  299 => 97,  292 => 93,  288 => 92,  284 => 91,  277 => 87,  274 => 86,  271 => 85,  263 => 84,  258 => 81,  253 => 79,  249 => 78,  245 => 77,  240 => 76,  238 => 75,  234 => 73,  231 => 72,  226 => 69,  220 => 68,  214 => 65,  210 => 64,  207 => 63,  204 => 62,  200 => 61,  196 => 59,  194 => 58,  189 => 56,  182 => 52,  178 => 51,  173 => 48,  168 => 46,  163 => 45,  159 => 44,  155 => 43,  150 => 41,  146 => 39,  141 => 37,  135 => 33,  132 => 32,  127 => 31,  123 => 30,  119 => 29,  114 => 27,  110 => 25,  108 => 24,  96 => 21,  84 => 11,  77 => 10,  61 => 8,  56 => 1,  54 => 6,  52 => 5,  50 => 4,  48 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/actualite.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/actualite.html.twig");
    }
}
