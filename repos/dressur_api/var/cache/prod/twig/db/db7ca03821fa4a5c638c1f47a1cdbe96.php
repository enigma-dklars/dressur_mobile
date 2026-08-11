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

/* historique_programme_recompense/index.html.twig */
class __TwigTemplate_f446f868dc316fafdc37fb5ef75b2c3f extends Template
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
        yield "Historique Programme Recompense";
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
        yield "\t<div class=\"\">
\t\t<div class=\"row mb-3 align-items-center\">
\t\t\t<div class=\"col-md-6\">
\t\t\t\t<p class=\"h4 me-3\">Historique Programme Récompense</p>
\t\t\t</div>
\t\t\t<div class=\"col-md-6 text-end\">
\t\t\t\t<a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_historique_programme_recompense_new");
        yield "\" class=\"btn btn-primary\">Create new</a>
\t\t\t</div>
\t\t</div>
\t</div>
\t
\t<div class=\"table-responsive\">
\t\t<table class=\"data-table table table-bordered table-striped\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>Actions</th>
\t\t\t\t\t<th>Id</th>
\t\t\t\t\t<th>User</th>
\t\t\t\t\t<th>Nbr Vue</th>
\t\t\t\t\t<th>Nbr Partage</th>
\t\t\t\t\t<th>Récompense</th>
\t\t\t\t\t<th>Status</th>
\t\t\t\t\t<th>Référence</th>
\t\t\t\t\t<th>Créé le</th>
\t\t\t\t\t<th>Modifié le</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["historique_programme_recompenses"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["historique"]) {
            // line 35
            yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 37
            yield from $this->load("historique_programme_recompense/_delete_form.html.twig", 37)->unwrap()->yield(CoreExtension::merge($context, ["historique_programme_recompense" => $context["historique"]]));
            // line 38
            yield "\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td>";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "id", [], "any", false, false, false, 40), "html", null, true);
            yield "</td>

\t\t\t\t\t\t<!-- USER -->
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t";
            // line 44
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "user", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 45
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-primary\">
\t\t\t\t\t\t\t\t\t";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "user", [], "any", false, false, false, 46), "pseudo", [], "any", false, false, false, 46), "html", null, true);
                yield "
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t";
            } else {
                // line 49
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-danger\">
\t\t\t\t\t\t\t\t\tAucun user
\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t";
            }
            // line 53
            yield "\t\t\t\t\t\t</td>

\t\t\t\t\t\t<td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "nbrVue", [], "any", false, false, false, 55), "html", null, true);
            yield "</td>
\t\t\t\t\t\t<td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "nbrPartage", [], "any", false, false, false, 56), "html", null, true);
            yield "</td>
\t\t\t\t\t\t<td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "recompense", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>

\t\t\t\t\t\t<td class=\"text-center\">
\t\t\t\t\t\t\t";
            // line 60
            $context["status"] = CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "status", [], "any", false, false, false, 60);
            // line 61
            yield "
\t\t\t\t\t\t\t";
            // line 62
            if ((($context["status"] ?? null) == "en_attente")) {
                // line 63
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-warning\">En attente</span>

\t\t\t\t\t\t\t";
            } elseif ((            // line 65
($context["status"] ?? null) == "en_cours")) {
                // line 66
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-info\">En cours</span>

\t\t\t\t\t\t\t";
            } elseif ((            // line 68
($context["status"] ?? null) == "approuver")) {
                // line 69
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-success\">Approuvé</span>

\t\t\t\t\t\t\t";
            } elseif ((            // line 71
($context["status"] ?? null) == "terminer")) {
                // line 72
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-primary\">Terminé</span>

\t\t\t\t\t\t\t";
            } elseif ((            // line 74
($context["status"] ?? null) == "echouer")) {
                // line 75
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-dark\">Échoué</span>

\t\t\t\t\t\t\t";
            } elseif ((            // line 77
($context["status"] ?? null) == "refuser")) {
                // line 78
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-danger\">Refusé</span>

\t\t\t\t\t\t\t";
            } else {
                // line 81
                yield "\t\t\t\t\t\t\t\t<span class=\"badge bg-secondary\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["status"] ?? null), "html", null, true);
                yield "</span>
\t\t\t\t\t\t\t";
            }
            // line 83
            yield "\t\t\t\t\t\t</td>


\t\t\t\t\t\t<td>";
            // line 86
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "referenceParticipation", [], "any", false, false, false, 86), "html", null, true);
            yield "</td>
\t\t\t\t\t\t<td>";
            // line 87
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "createdAt", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "createdAt", [], "any", false, false, false, 87), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
\t\t\t\t\t\t<td>";
            // line 88
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "updatedAt", [], "any", false, false, false, 88)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["historique"], "updatedAt", [], "any", false, false, false, 88), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
\t\t\t\t\t</tr>
\t\t\t\t";
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
        // line 90
        if (!$context['_iterated']) {
            // line 91
            yield "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td colspan=\"10\" class=\"text-center\">
\t\t\t\t\t\t\tAucun enregistrement trouvé
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['historique'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        yield "\t\t\t</tbody>
\t\t</table>
\t</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "historique_programme_recompense/index.html.twig";
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
        return array (  262 => 97,  251 => 91,  249 => 90,  234 => 88,  230 => 87,  226 => 86,  221 => 83,  215 => 81,  210 => 78,  208 => 77,  204 => 75,  202 => 74,  198 => 72,  196 => 71,  192 => 69,  190 => 68,  186 => 66,  184 => 65,  180 => 63,  178 => 62,  175 => 61,  173 => 60,  167 => 57,  163 => 56,  159 => 55,  155 => 53,  149 => 49,  143 => 46,  140 => 45,  138 => 44,  131 => 40,  127 => 38,  125 => 37,  121 => 35,  103 => 34,  78 => 12,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "historique_programme_recompense/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/historique_programme_recompense/index.html.twig");
    }
}
