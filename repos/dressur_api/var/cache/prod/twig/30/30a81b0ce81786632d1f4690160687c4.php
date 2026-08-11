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

/* private/contact.html.twig */
class __TwigTemplate_2b15a9f011a0715e5b0673d12752ebec extends Template
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
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Contacts";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "
";
        // line 8
        yield "<div class=\"d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2\">
    <div>
        <h5 class=\"mb-0 fw-bold\">Contacts Dressur</h5>
        <small class=\"text-muted\" id=\"contactCount\">
            ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["contacts"] ?? null)), "html", null, true);
        yield " contact";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["contacts"] ?? null)) != 1)) ? ("s") : (""));
        yield "
        </small>
    </div>
    ";
        // line 15
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["contacts"] ?? null)) > 0)) {
            // line 16
            yield "    <div class=\"d-flex gap-2 flex-wrap\">
        <a href=\"";
            // line 17
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_export_csv");
            yield "\" class=\"btn btn-sm btn-outline-secondary\" title=\"Exporter en CSV\">
            <i class=\"fa-solid fa-file-export me-1\"></i> CSV
        </a>
        <a href=\"";
            // line 20
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_export_vcf");
            yield "\" class=\"btn btn-sm btn-outline-secondary\" title=\"Exporter en VCF\">
            <i class=\"fa-solid fa-file-export me-1\"></i> VCF
        </a>
        <a href=\"";
            // line 23
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_guide_import_contacts");
            yield "\" class=\"btn btn-sm btn-primary\" title=\"Guide d\x27import dans le téléphone\">
            <i class=\"fas fa-mobile-alt me-1\"></i> Importer dans mon téléphone
        </a>
    </div>
    ";
        }
        // line 28
        yield "</div>

";
        // line 31
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["contacts"] ?? null)) > 0)) {
            // line 32
            yield "<div class=\"mb-3\">
    <div class=\"input-group shadow-sm\">
        <span class=\"input-group-text bg-white border-end-0 text-muted\">
            <i class=\"fas fa-search\"></i>
        </span>
        <input type=\"text\"
               id=\"searchContact\"
               class=\"form-control border-start-0 border-end-0 ps-0\"
               placeholder=\"Rechercher par nom, pseudo, téléphone...\">
        <button class=\"btn btn-outline-secondary border-start-0\"
                type=\"button\"
                id=\"clearSearch\"
                style=\"display:none;\"
                title=\"Effacer\">
            <i class=\"fas fa-times\"></i>
        </button>
    </div>
</div>

<div id=\"noSearchResult\" class=\"alert alert-info text-center d-none\">
    <i class=\"fas fa-search me-2\"></i>Aucun contact trouvé pour cette recherche.
</div>
";
        }
        // line 55
        yield "
";
        // line 57
        yield "<div class=\"row g-3\" id=\"contactGrid\">
    ";
        // line 58
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["contacts"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
            // line 59
            yield "
        <div class=\"col-md-4 col-sm-6 contact-card-col\"
             data-nom=\"";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 61)), "html", null, true);
            yield "\"
             data-pseudo=\"";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 62)), "html", null, true);
            yield "\"
             data-tel=\"";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tel", [], "any", false, false, false, 63)), "html", null, true);
            yield "\">

            <div class=\"card h-100 border-0 shadow-sm\">
                <div class=\"card-body pb-1\">

                    ";
            // line 69
            yield "                    <div class=\"d-flex align-items-center\">

                        ";
            // line 72
            yield "                        <div class=\"contact-avatar flex-shrink-0\"
                             data-name=\"";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim((((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 73))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 73)) : (CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 73)))), "html", null, true);
            yield "\">
                        </div>

                        <div class=\"ms-2 overflow-hidden flex-grow-1\">
                            <div class=\"fw-semibold text-truncate\" style=\"font-size:.92rem;\">
                                ";
            // line 78
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 78))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 79
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 79), "html", null, true);
                yield "
                                    ";
                // line 80
                if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 80))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 81
                    yield "                                        <span class=\"text-muted fw-normal\" style=\"font-size:.82rem;\">- ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 81), "html", null, true);
                    yield "</span>
                                    ";
                }
                // line 83
                yield "                                ";
            } else {
                // line 84
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 84), "html", null, true);
                yield "
                                ";
            }
            // line 86
            yield "                            </div>
                            <small class=\"text-muted\">";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tel", [], "any", false, false, false, 87), "html", null, true);
            yield "</small>
                        </div>

                        ";
            // line 91
            yield "                        ";
            if (((((CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tiktok", [], "any", false, false, false, 91) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "instagram", [], "any", false, false, false, 91)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "facebook", [], "any", false, false, false, 91)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "youtube", [], "any", false, false, false, 91)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "apropos", [], "any", false, false, false, 91))) {
                // line 92
                yield "                            <button class=\"btn btn-link btn-sm text-muted p-1 ms-1 flex-shrink-0\"
                                    data-bs-toggle=\"modal\"
                                    data-bs-target=\"#modal_contact_";
                // line 94
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "id", [], "any", false, false, false, 94), "html", null, true);
                yield "\">
                                <i class=\"fas fa-info-circle fa-lg\"></i>
                            </button>
                        ";
            }
            // line 98
            yield "                    </div>

                    <hr class=\"my-2\">

                    ";
            // line 103
            yield "                    <div class=\"d-flex justify-content-around py-1\">
                        <a href=\"tel:";
            // line 104
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tel", [], "any", false, false, false, 104), "html", null, true);
            yield "\"
                           class=\"btn btn-link text-primary p-1\"
                           title=\"Appeler\">
                            <i class=\"fas fa-phone fa-lg\"></i>
                        </a>
                        <a href=\"sms:";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tel", [], "any", false, false, false, 109), "html", null, true);
            yield "\"
                           class=\"btn btn-link text-primary p-1\"
                           title=\"Envoyer un SMS\">
                            <i class=\"fas fa-comment fa-lg\"></i>
                        </a>
                        <a href=\"mailto:";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "mail", [], "any", false, false, false, 114), "html", null, true);
            yield "\"
                           class=\"btn btn-link text-primary p-1\"
                           title=\"Envoyer un email\">
                            <i class=\"fas fa-envelope fa-lg\"></i>
                        </a>
                        <a href=\"https://wa.me/";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tel", [], "any", false, false, false, 119), "html", null, true);
            yield "\"
                           class=\"btn btn-link text-primary p-1\"
                           title=\"WhatsApp\"
                           target=\"_blank\"
                           rel=\"noopener noreferrer\">
                            <i class=\"fab fa-whatsapp fa-lg\"></i>
                        </a>
                    </div>

                </div>
            </div>

            ";
            // line 132
            yield "            ";
            if (((((CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tiktok", [], "any", false, false, false, 132) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "instagram", [], "any", false, false, false, 132)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "facebook", [], "any", false, false, false, 132)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "youtube", [], "any", false, false, false, 132)) || CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "apropos", [], "any", false, false, false, 132))) {
                // line 133
                yield "                <div class=\"modal fade\"
                     id=\"modal_contact_";
                // line 134
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "id", [], "any", false, false, false, 134), "html", null, true);
                yield "\"
                     tabindex=\"-1\"
                     aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-dialog-centered\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header py-2\">
                                <h6 class=\"modal-title fw-bold\">
                                    ";
                // line 141
                yield (((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 141))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 141), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 141), "html", null, true)));
                yield "
                                    ";
                // line 142
                if (( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 142)) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "nom", [], "any", false, false, false, 142)))) {
                    // line 143
                    yield "                                        <small class=\"text-muted fw-normal\">@";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "pseudo", [], "any", false, false, false, 143), "html", null, true);
                    yield "</small>
                                    ";
                }
                // line 145
                yield "                                </h6>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
                            </div>
                            <div class=\"modal-body\">
                                ";
                // line 149
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tiktok", [], "any", false, false, false, 149)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 150
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "tiktok", [], "any", false, false, false, 150), "html", null, true);
                    yield "\" class=\"btn btn-light w-100 text-start mb-2\" target=\"_blank\" rel=\"noopener noreferrer\">
                                        <i class=\"fab fa-tiktok me-2\"></i> TikTok
                                    </a>
                                ";
                }
                // line 154
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "instagram", [], "any", false, false, false, 154)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 155
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "instagram", [], "any", false, false, false, 155), "html", null, true);
                    yield "\" class=\"btn btn-light w-100 text-start mb-2\" target=\"_blank\" rel=\"noopener noreferrer\">
                                        <i class=\"fab fa-instagram me-2\"></i> Instagram
                                    </a>
                                ";
                }
                // line 159
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "facebook", [], "any", false, false, false, 159)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 160
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "facebook", [], "any", false, false, false, 160), "html", null, true);
                    yield "\" class=\"btn btn-light w-100 text-start mb-2\" target=\"_blank\" rel=\"noopener noreferrer\">
                                        <i class=\"fab fa-facebook-f me-2\"></i> Facebook
                                    </a>
                                ";
                }
                // line 164
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "youtube", [], "any", false, false, false, 164)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 165
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "youtube", [], "any", false, false, false, 165), "html", null, true);
                    yield "\" class=\"btn btn-light w-100 text-start mb-2\" target=\"_blank\" rel=\"noopener noreferrer\">
                                        <i class=\"fab fa-youtube me-2\"></i> YouTube
                                    </a>
                                ";
                }
                // line 169
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "apropos", [], "any", false, false, false, 169)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 170
                    yield "                                    <div class=\"p-3 bg-light rounded small mt-1\" style=\"white-space: pre-line;\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["contact"], "apropos", [], "any", false, false, false, 170), "html", null, true);
                    yield "</div>
                                ";
                }
                // line 172
                yield "                            </div>
                            <div class=\"modal-footer py-2\">
                                <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            }
            // line 180
            yield "
        </div>

    ";
            $context['_iterated'] = true;
        }
        // line 183
        if (!$context['_iterated']) {
            // line 184
            yield "
        <div class=\"col-12\">
            <div class=\"card border-0 bg-light text-center py-5\">
                <div class=\"card-body\">
                    <i class=\"fas fa-address-book text-muted\" style=\"font-size:3rem;\"></i>
                    <p class=\"mt-3 mb-1 fw-semibold text-muted\">Vous n\x27avez pas encore de contact sur Dressur.</p>
                    <p class=\"small text-muted mb-3\">Faites un Boost Contact pour en avoir.</p>
                    <a href=\"/newboostcontact\" class=\"btn btn-primary btn-sm\">
                        <i class=\"fas fa-rocket me-1\"></i> Créer un Boost
                    </a>
                </div>
            </div>
        </div>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['contact'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 199
        yield "</div>

";
        // line 202
        yield "<style>
.contact-avatar {
    width:  44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 15px;
    color: #fff;
    letter-spacing: .5px;
    flex-shrink: 0;
}
</style>

";
        // line 219
        yield "<script>
(function () {
    /* Palette identique à la mobile (liste_contact.dart) */
    var COLORS = [
        \x27#1565C0\x27, \x27#2E7D32\x27, \x27#6A1B9A\x27, \x27#C62828\x27,
        \x27#00838F\x27, \x27#E65100\x27, \x27#4527A0\x27, \x27#00695C\x27,
        \x27#558B2F\x27, \x27#283593\x27, \x27#880E4F\x27, \x27#37474F\x27
    ];

    function hashColor(name) {
        var key = (name || \x27\x27).toLowerCase();
        var h = 0;
        for (var i = 0; i < key.length; i++) {
            h = (h * 31 + key.charCodeAt(i)) & 0x7FFFFFFF;
        }
        return COLORS[h % COLORS.length];
    }

    function initials(name) {
        var parts = (name || \x27\x27).trim().split(/\\s+/).filter(function (p) { return p.length > 0; });
        if (parts.length === 0) return \x27?\x27;
        if (parts.length === 1)  return parts[0][0].toUpperCase();
        return (parts[0][0] + parts[1][0]).toUpperCase();
    }

    /* ── Avatars ── */
    document.querySelectorAll(\x27.contact-avatar\x27).forEach(function (el) {
        var name = el.getAttribute(\x27data-name\x27) || \x27\x27;
        el.style.backgroundColor = hashColor(name);
        el.textContent = initials(name);
    });

    /* ── Recherche client-side ── */
    var searchInput = document.getElementById(\x27searchContact\x27);
    if (!searchInput) return;

    var clearBtn   = document.getElementById(\x27clearSearch\x27);
    var noResult   = document.getElementById(\x27noSearchResult\x27);
    var cards      = document.querySelectorAll(\x27.contact-card-col\x27);
    var countEl    = document.getElementById(\x27contactCount\x27);
    var totalCount = cards.length;

    function doFilter() {
        var query   = searchInput.value.toLowerCase().trim();
        var visible = 0;

        if (clearBtn) clearBtn.style.display = query ? \x27\x27 : \x27none\x27;

        cards.forEach(function (col) {
            var nom    = col.getAttribute(\x27data-nom\x27)    || \x27\x27;
            var pseudo = col.getAttribute(\x27data-pseudo\x27) || \x27\x27;
            var tel    = col.getAttribute(\x27data-tel\x27)    || \x27\x27;
            var match  = !query ||
                         nom.indexOf(query)    !== -1 ||
                         pseudo.indexOf(query) !== -1 ||
                         tel.indexOf(query)    !== -1;
            col.style.display = match ? \x27\x27 : \x27none\x27;
            if (match) visible++;
        });

        if (noResult) noResult.classList.toggle(\x27d-none\x27, visible > 0);

        if (countEl) {
            var suffix  = visible !== 1 ? \x27s\x27 : \x27\x27;
            var extra   = (visible !== totalCount) ? \x27 / \x27 + totalCount : \x27\x27;
            countEl.textContent = visible + extra + \x27 contact\x27 + suffix;
        }
    }

    searchInput.addEventListener(\x27input\x27, doFilter);

    if (clearBtn) {
        clearBtn.addEventListener(\x27click\x27, function () {
            searchInput.value = \x27\x27;
            doFilter();
            searchInput.focus();
        });
    }
}());
</script>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/contact.html.twig";
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
        return array (  431 => 219,  413 => 202,  409 => 199,  389 => 184,  387 => 183,  380 => 180,  370 => 172,  364 => 170,  361 => 169,  353 => 165,  350 => 164,  342 => 160,  339 => 159,  331 => 155,  328 => 154,  320 => 150,  318 => 149,  312 => 145,  306 => 143,  304 => 142,  300 => 141,  290 => 134,  287 => 133,  284 => 132,  269 => 119,  261 => 114,  253 => 109,  245 => 104,  242 => 103,  236 => 98,  229 => 94,  225 => 92,  222 => 91,  216 => 87,  213 => 86,  207 => 84,  204 => 83,  198 => 81,  196 => 80,  191 => 79,  189 => 78,  181 => 73,  178 => 72,  174 => 69,  166 => 63,  162 => 62,  158 => 61,  154 => 59,  149 => 58,  146 => 57,  143 => 55,  118 => 32,  116 => 31,  112 => 28,  104 => 23,  98 => 20,  92 => 17,  89 => 16,  87 => 15,  79 => 12,  73 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/contact.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/contact.html.twig");
    }
}
