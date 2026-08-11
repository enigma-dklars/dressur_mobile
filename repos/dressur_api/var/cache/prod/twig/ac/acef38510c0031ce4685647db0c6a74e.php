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

/* crud_promo_reseau/index.html.twig */
class __TwigTemplate_c9f50f2674cbe6be205f16b03b3e91ad extends Template
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
        yield "PromoReseau index";
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
            <span class=\"h4 me-3\">PromoReseau index</span>
            <a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_new");
        yield "\">Create new</a>
        </div>
        <div class=\"col-4 text-end fs-5 
            ";
        // line 12
        if ((($context["soldeZefame"] ?? null) <= 5)) {
            yield "text-danger";
        }
        yield " 
            ";
        // line 13
        if (((($context["soldeZefame"] ?? null) > 5) && (($context["soldeZefame"] ?? null) <= 10))) {
            yield "text-warning";
        }
        // line 14
        yield "            ";
        if ((($context["soldeZefame"] ?? null) > 10)) {
            yield "text-success";
        }
        // line 15
        yield "        \">
            Solde : ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["soldeZefame"] ?? null), "html", null, true);
        yield " €
        </div>
    </div>

    <!-- Filtre Source -->
    <div class=\"mb-3 d-flex align-items-center gap-2\">
        <span class=\"small fw-semibold me-1\">Source :</span>
        <a href=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index");
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">Tous (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "total", [], "any", false, false, false, 23), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 24
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "mobile"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "mobile")) ? ("bg-warning text-dark") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">mobile (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "mobile", [], "any", false, false, false, 24), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "web"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "web")) ? ("bg-primary text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">web (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "web", [], "any", false, false, false, 25), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "none"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "none")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">none (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "none", [], "any", false, false, false, 26), "html", null, true);
        yield ")</a>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Source</th>
                    <th>Service</th>
                    <th>User</th>
                    <th>Qte.</th>
                    <th>Prix</th>
                    <th>Prix.Zef</th>
                    <th>Status</th>
                    <th>Id.Zef</th>
                    <th>C.Debut</th>
                    <th>C.Restant</th>
                    <th>Url</th>
                    <th>Id</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["promo_reseaus"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["promo_reseau"]) {
            // line 52
            yield "                <tr>
                    <td>";
            // line 53
            yield from $this->load("crud_promo_reseau/_delete_form.html.twig", 53)->unwrap()->yield($context);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 55
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "source", [], "any", false, false, false, 55) == "web")) {
                // line 56
                yield "                            <span class=\"badge bg-primary\">web</span>
                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 57
$context["promo_reseau"], "source", [], "any", false, false, false, 57) == "mobile")) {
                // line 58
                yield "                            <span class=\"badge bg-warning text-dark\">mobile</span>
                        ";
            } else {
                // line 60
                yield "                            <span class=\"badge bg-secondary\">none</span>
                        ";
            }
            // line 62
            yield "                    </td>
                    <td>";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "formulePromoReseau", [], "any", false, false, false, 63), "html", null, true);
            yield "</td>
                    <td>";
            // line 64
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "user", [], "any", false, false, false, 64), "pseudo", [], "any", false, false, false, 64), "html", null, true);
            yield "</td>
                    <td>";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "qteDemander", [], "any", false, false, false, 65), "html", null, true);
            yield "</td>
                    <td>";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "prixFixer", [], "any", false, false, false, 66), "html", null, true);
            yield "</td>
                    <td>";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "prixZefame", [], "any", false, false, false, 67), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 69
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "status", [], "any", false, false, false, 69) == 0)) {
                yield " <span class=\"badge bg-info text-white fw-normal\">Rembour</span> ";
            }
            // line 70
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "status", [], "any", false, false, false, 70) == 1)) {
                yield " 
                            <span class=\"badge bg-warning text-white fw-normal\">En.Attent</span>
                            <a href=\"";
                // line 72
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_demarrage_direct_zefame", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "id", [], "any", false, false, false, 72)]), "html", null, true);
                yield "\" class=\"badge bg-danger text-white fw-normal\">Démarrer</a> 
                        ";
            }
            // line 74
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "status", [], "any", false, false, false, 74) == 2)) {
                yield " <span class=\"badge bg-danger text-white fw-normal\">En.Cours</span> ";
            }
            // line 75
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "status", [], "any", false, false, false, 75) == 3)) {
                yield " <span class=\"badge bg-success text-white fw-normal\">Terminer</span> ";
            }
            // line 76
            yield "                    </td>
                    <td>";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "idZefame", [], "any", false, false, false, 77), "html", null, true);
            yield "</td>
                    <td>";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "compteurDebut", [], "any", false, false, false, 78), "html", null, true);
            yield "</td>
                    <td>";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "compteurRestant", [], "any", false, false, false, 79), "html", null, true);
            yield "</td>
                    <td>
                        <span url=\"";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "url", [], "any", false, false, false, 81), "html", null, true);
            yield "\" class=\"copier_url badge bg-danger\" style=\"cursor: pointer;\"><i class=\"fas fa-copy\"></i> Copier</span>
                        <span url=\"";
            // line 82
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "url", [], "any", false, false, false, 82), "html", null, true);
            yield "\" class=\"afficher_url badge bg-primary mt-1\" style=\"cursor: pointer;\"><i class=\"fas fa-eye\"></i> Afficher</span>
                        <textarea id=\"urlTextarea\" style=\"display: none;\">";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "url", [], "any", false, false, false, 83), "html", null, true);
            yield "</textarea>
                    </td>
                    <td>";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "id", [], "any", false, false, false, 85), "html", null, true);
            yield "</td>
                    <td>";
            // line 86
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "createdAt", [], "any", false, false, false, 86)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "createdAt", [], "any", false, false, false, 86), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 87
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "updatedAt", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promo_reseau"], "updatedAt", [], "any", false, false, false, 87), "Y-m-d H:i:s"), "html", null, true)) : (""));
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
        // line 89
        if (!$context['_iterated']) {
            // line 90
            yield "                <tr>
                    <td colspan=\"11\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promo_reseau'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        yield "            </tbody>
        </table>
    </div>

";
        yield from [];
    }

    // line 101
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 102
        yield "    <script>
        \$(document).ready(function() {
        // Fonction pour copier l\x27URL dans le presse-papiers
        \$(\x27.copier_url\x27).click(function() {
            var url = \$(this).attr(\x27url\x27);
            navigator.clipboard.writeText(url).then(function() {
                alert(\x27URL copiée dans le presse-papiers\x27);
            }, function(err) {
                console.error(\x27Erreur lors de la copie de l\\\x27URL: \x27, err);
            });
        });

        // Fonction pour afficher l\x27URL dans un SweetAlert ou une modale
        \$(\x27.afficher_url\x27).click(function() {
            var url = \$(this).attr(\x27url\x27);
            // Utilisation de SweetAlert pour afficher l\x27URL
            Swal.fire({
                title: \x27URL\x27,
                text: url,
                icon: \x27info\x27,
                confirmButtonText: \x27OK\x27
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
        return "crud_promo_reseau/index.html.twig";
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
        return array (  335 => 102,  328 => 101,  319 => 94,  310 => 90,  308 => 89,  293 => 87,  289 => 86,  285 => 85,  280 => 83,  276 => 82,  272 => 81,  267 => 79,  263 => 78,  259 => 77,  256 => 76,  251 => 75,  246 => 74,  241 => 72,  235 => 70,  231 => 69,  226 => 67,  222 => 66,  218 => 65,  214 => 64,  210 => 63,  207 => 62,  203 => 60,  199 => 58,  197 => 57,  194 => 56,  192 => 55,  187 => 53,  184 => 52,  166 => 51,  134 => 26,  126 => 25,  118 => 24,  110 => 23,  100 => 16,  97 => 15,  92 => 14,  88 => 13,  82 => 12,  76 => 9,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_promo_reseau/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_promo_reseau/index.html.twig");
    }
}
