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

/* crud_promotion/index.html.twig */
class __TwigTemplate_163ed95862da0be0fa84a160a025f878 extends Template
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
            'script' => [$this, 'block_script'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "baseAdmin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("baseAdmin.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Promotion index";
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
        yield "    <div class=\"row g-2\">
        <div class=\"col-8\">
            <span class=\"h4 me-3\">Promotion index</span>
        </div>
        <div class=\"col-4 text-end fs-5 d-flex gap-2 justify-content-end align-items-center\">
            <a class=\"btn btn-sm btn-success h4\" href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_admin_new");
        yield "\">
                <i class=\"fas fa-plus-circle me-1\"></i>Nouvelle Promotion
            </a>
            <a class=\"btn btn-sm btn-danger h4 js-confirm-orphan\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_delete_images_no_use");
        yield "\">Delete Images No Used</a>
        </div>
    </div>

    <!-- Filtre Source -->
    <div class=\"mb-3 d-flex align-items-center gap-2\">
        <span class=\"fw-semibold me-1\">Source :</span>
        <a href=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index");
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">Tous (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "total", [], "any", false, false, false, 21), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "mobile"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "mobile")) ? ("bg-warning text-dark") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">mobile (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "mobile", [], "any", false, false, false, 22), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "web"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "web")) ? ("bg-primary text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">web (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "web", [], "any", false, false, false, 23), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 24
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "none"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "none")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">none (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "none", [], "any", false, false, false, 24), "html", null, true);
        yield ")</a>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Source</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Type P.A</th>
                    <th>Mode</th>
                    <th>Récomp.</th>
                    <th>DS Statut</th>
                    <th>Boost FB</th>
                    <th>WhatsApp</th>
                    <th>Limited</th>
                    <th>Fake</th>
                    <th>Ref.</th>
                    <th>Formule</th>
                    <th>DateDebut</th>
                    <th>DateExp</th>
                    <th>Nbr.Vue</th>
                    <th>Nbr.Imprs</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["promotions"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["promotion"]) {
            // line 55
            yield "                <tr>
                    <td></td>
                    <td>";
            // line 57
            yield from $this->load("crud_promotion/_delete_form.html.twig", 57)->unwrap()->yield($context);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 59
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "source", [], "any", false, false, false, 59) == "web")) {
                // line 60
                yield "                            <span class=\"badge bg-primary\">web</span>
                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 61
$context["promotion"], "source", [], "any", false, false, false, 61) == "mobile")) {
                // line 62
                yield "                            <span class=\"badge bg-warning text-dark\">mobile</span>
                        ";
            } else {
                // line 64
                yield "                            <span class=\"badge bg-secondary\">none</span>
                        ";
            }
            // line 66
            yield "                    </td>
                    <td>";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "user", [], "any", false, false, false, 67), "pseudo", [], "any", false, false, false, 67), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 69
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 69) == 0)) {
                $context["bg_badge"] = "bg-danger";
                yield " ";
                $context["status_name"] = "Rejeter";
            }
            // line 70
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 70) == 1)) {
                $context["bg_badge"] = "bg-warning";
                yield " ";
                $context["status_name"] = "Attente";
            }
            // line 71
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 71) == 2)) {
                $context["bg_badge"] = "bg-warning";
                yield " ";
                $context["status_name"] = "Att. Pay";
            }
            // line 72
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 72) == 3)) {
                $context["bg_badge"] = "bg-success";
                yield " ";
                $context["status_name"] = "En cours";
            }
            // line 73
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 73) == 4)) {
                $context["bg_badge"] = "bg-success";
                yield " ";
                $context["status_name"] = "Terminer";
            }
            // line 74
            yield "                        <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg_badge"] ?? null), "html", null, true);
            yield " text-white mb-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["status_name"] ?? null), "html", null, true);
            yield "</span>
                    </td>
                    <td class=\"text-center\">
                        ";
            // line 77
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "typePromotionAffaire", [], "any", false, false, false, 77) == "produit_service")) {
                // line 78
                yield "                            ";
                $context["bg_badge"] = "bg-success";
                // line 79
                yield "                            ";
                $context["tpa"] = "Produit Service";
                // line 80
                yield "                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "typePromotionAffaire", [], "any", false, false, false, 80) == "sites_applications")) {
                // line 81
                yield "                            ";
                $context["bg_badge"] = "bg-info";
                // line 82
                yield "                            ";
                $context["tpa"] = "Sites & Apps";
                // line 83
                yield "                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "typePromotionAffaire", [], "any", false, false, false, 83) == "offre_emploi")) {
                // line 84
                yield "                            ";
                $context["bg_badge"] = "bg-warning";
                // line 85
                yield "                            ";
                $context["tpa"] = "Offre Emploi";
                // line 86
                yield "                        ";
            } else {
                // line 87
                yield "                            ";
                $context["bg_badge"] = "bg-danger";
                // line 88
                yield "                            ";
                $context["tpa"] = "Demande Emploi";
                // line 89
                yield "                        ";
            }
            // line 90
            yield "                        <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg_badge"] ?? null), "html", null, true);
            yield " text-white mb-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["tpa"] ?? null), "html", null, true);
            yield "</span>
                        ";
            // line 91
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "typePromotionAffaire", [], "any", false, false, false, 91) == "sites_applications")) {
                // line 92
                yield "                            <div class=\"small mt-1 text-start\">
                                ";
                // line 93
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "nomSiteApp", [], "any", false, false, false, 93)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<strong>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "nomSiteApp", [], "any", false, false, false, 93), "html", null, true);
                    yield "</strong><br>";
                }
                // line 94
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "sousTypeSiteApp", [], "any", false, false, false, 94)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 95
                    yield "                                    <span class=\"badge bg-secondary\">
                                        ";
                    // line 96
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "sousTypeSiteApp", [], "any", false, false, false, 96) == "site_web")) {
                        yield "Site web
                                        ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 97
$context["promotion"], "sousTypeSiteApp", [], "any", false, false, false, 97) == "app_mobile")) {
                        yield "App mobile
                                        ";
                    } else {
                        // line 98
                        yield "Logiciel";
                    }
                    // line 99
                    yield "                                    </span>
                                ";
                }
                // line 101
                yield "                                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "urlSiteApp", [], "any", false, false, false, 101)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 102
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "urlSiteApp", [], "any", false, false, false, 102), "html", null, true);
                    yield "\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"ms-1 small\">
                                        <i class=\"fas fa-external-link-alt\"></i>
                                    </a>
                                ";
                }
                // line 106
                yield "                            </div>
                        ";
            }
            // line 108
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 110
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "mode", [], "any", false, false, false, 110) == "Gratuit")) {
                // line 111
                yield "                            <span class=\"badge bg-danger\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "mode", [], "any", false, false, false, 111), "html", null, true);
                yield "</span>
                        ";
            } else {
                // line 113
                yield "                            <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "mode", [], "any", false, false, false, 113), "html", null, true);
                yield "</span>
                        ";
            }
            // line 115
            yield "                    </td>
                    <td class=\"text-center\">";
            // line 116
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "inProgrammeRecompense", [], "any", false, false, false, 116)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td class=\"text-center\">";
            // line 117
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "publishOnDressurStatus", [], "any", false, false, false, 117)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td class=\"text-center\">";
            // line 118
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "boostFacebook", [], "any", false, false, false, 118)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ((("<span class=\"badge bg-primary\">" . CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "montantBoostFacebook", [], "any", false, false, false, 118)) . " F</span>")) : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 120
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "whatsappContact", [], "any", false, false, false, 120)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 121
                yield "                            <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "whatsappContact", [], "any", false, false, false, 121), "html", null, true);
                yield "</span>
                        ";
            } else {
                // line 123
                yield "                            <span class=\"badge bg-secondary\" title=\"Fallback : numéro utilisateur\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "user", [], "any", false, false, false, 123), "tel", [], "any", false, false, false, 123), "html", null, true);
                yield "</span>
                        ";
            }
            // line 125
            yield "                    </td>
                    <td class=\"text-center\">";
            // line 126
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "limited", [], "any", false, false, false, 126)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td class=\"text-center\">";
            // line 127
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "isFakeVue", [], "any", false, false, false, 127)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td class=\"text-center\">";
            // line 128
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "referencement", [], "any", false, false, false, 128)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td>";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "formulePromoAffaire", [], "any", false, false, false, 129), "html", null, true);
            yield "</td>
                    <td>";
            // line 130
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "dateDebut", [], "any", false, false, false, 130)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "dateDebut", [], "any", false, false, false, 130), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 131
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "dateExp", [], "any", false, false, false, 131)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "dateExp", [], "any", false, false, false, 131), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "nombreDeVue", [], "any", false, false, false, 132), "html", null, true);
            yield "</td>
                    <td>";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "nombreImpression", [], "any", false, false, false, 133), "html", null, true);
            yield "</td>
                    <td>";
            // line 134
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "id", [], "any", false, false, false, 134), "html", null, true);
            yield "</td>
                </tr>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 136
        if (!$context['_iterated']) {
            // line 137
            yield "                <tr>
                    <td colspan=\"14\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promotion'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        yield "            </tbody>
        </table>
    </div>

";
        yield from [];
    }

    // line 147
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 148
        yield "<script>
document.querySelectorAll(\x27.js-confirm-orphan\x27).forEach(function (btn) {
    btn.addEventListener(\x27click\x27, function (e) {
        e.preventDefault();
        var href = this.href;
        Swal.fire({
            title: \x27Supprimer les images non utilisées ?\x27,
            text: \x27Toutes les images non liées à une promotion seront définitivement supprimées.\x27,
            icon: \x27warning\x27,
            showCancelButton: true,
            confirmButtonColor: \x27#d33\x27,
            cancelButtonColor: \x27#6c757d\x27,
            confirmButtonText: \x27Oui, supprimer\x27,
            cancelButtonText: \x27Annuler\x27
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_promotion/index.html.twig";
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
        return array (  466 => 148,  459 => 147,  450 => 141,  441 => 137,  439 => 136,  424 => 134,  420 => 133,  416 => 132,  412 => 131,  408 => 130,  404 => 129,  400 => 128,  396 => 127,  392 => 126,  389 => 125,  383 => 123,  377 => 121,  375 => 120,  370 => 118,  366 => 117,  362 => 116,  359 => 115,  353 => 113,  347 => 111,  345 => 110,  341 => 108,  337 => 106,  329 => 102,  326 => 101,  322 => 99,  319 => 98,  314 => 97,  310 => 96,  307 => 95,  304 => 94,  298 => 93,  295 => 92,  293 => 91,  286 => 90,  283 => 89,  280 => 88,  277 => 87,  274 => 86,  271 => 85,  268 => 84,  265 => 83,  262 => 82,  259 => 81,  256 => 80,  253 => 79,  250 => 78,  248 => 77,  239 => 74,  232 => 73,  225 => 72,  218 => 71,  211 => 70,  205 => 69,  200 => 67,  197 => 66,  193 => 64,  189 => 62,  187 => 61,  184 => 60,  182 => 59,  177 => 57,  173 => 55,  155 => 54,  118 => 24,  110 => 23,  102 => 22,  94 => 21,  84 => 14,  78 => 11,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_promotion/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_promotion/index.html.twig");
    }
}
