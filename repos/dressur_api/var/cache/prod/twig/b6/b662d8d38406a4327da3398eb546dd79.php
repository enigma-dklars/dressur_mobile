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

/* crud_boost/index.html.twig */
class __TwigTemplate_72f4909b0ff4af6d8c2442b1413138a7 extends Template
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

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Boost index";
        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"d-flex align-items-center justify-content-between mb-3\">
    <p class=\"h4 mb-0\">Boost index</p>
    <a href=\"";
        // line 6
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_admin_new");
        yield "\" class=\"btn btn-sm btn-success\">
        <i class=\"bi bi-rocket-takeoff me-2\"></i>Ajouter un Boost Contact
    </a>
</div>
";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 10));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 11
            yield "    <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield " alert-dismissible fade show\">
        ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                yield "<p class=\"mb-0\">";
                yield $context["message"];
                yield "</p>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        yield "<!-- Filtre Source -->
<div class=\"mb-3 d-flex align-items-center gap-2\">
    <span class=\"small fw-semibold me-1\">Source :</span>
    <a href=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">Tous (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "total", [], "any", false, false, false, 19), "html", null, true);
        yield ")</a>
    <a href=\"";
        // line 20
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "mobile"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "mobile")) ? ("bg-warning text-dark") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">mobile (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "mobile", [], "any", false, false, false, 20), "html", null, true);
        yield ")</a>
    <a href=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "web"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "web")) ? ("bg-primary text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">web (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "web", [], "any", false, false, false, 21), "html", null, true);
        yield ")</a>
    <a href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "none"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "none")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">none (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "none", [], "any", false, false, false, 22), "html", null, true);
        yield ")</a>
</div>
<div class=\"table-responsive\">
    <table class=\"data-table table table-bordered table-striped\">
    <thead>
        <tr>
            <th></th>
            <th>Source</th>
            <th>User</th>
            <th width=\"1\">Status</th>
            <th width=\"1\">Type</th>
            <th width=\"1\">Mode</th>
            <th>Formule</th>
            <th>Contacts</th>
            <th>DateDebut</th>
            <th>DateExp</th>
            <th>Id</th>
        </tr>
    </thead>
    <tbody>
    ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["boosts"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["boost"]) {
            // line 43
            yield "        <tr>
            <td>";
            // line 44
            yield from $this->load("crud_boost/_delete_form.html.twig", 44)->unwrap()->yield($context);
            yield "</td>
            <td class=\"text-center\">
                ";
            // line 46
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "source", [], "any", false, false, false, 46) == "web")) {
                // line 47
                yield "                    <span class=\"badge bg-primary\">web</span>
                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 48
$context["boost"], "source", [], "any", false, false, false, 48) == "mobile")) {
                // line 49
                yield "                    <span class=\"badge bg-warning text-dark\">mobile</span>
                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 50
$context["boost"], "source", [], "any", false, false, false, 50) == "admin")) {
                // line 51
                yield "                    <span class=\"badge bg-success\">admin</span>
                ";
            } else {
                // line 53
                yield "                    <span class=\"badge bg-secondary\">none</span>
                ";
            }
            // line 55
            yield "            </td>
            <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "user", [], "any", false, false, false, 56), "pseudo", [], "any", false, false, false, 56), "html", null, true);
            yield "</td>
            <td class=\"text-center\">
                ";
            // line 58
            if (($this->extensions['Twig\Extension\CoreExtension']->convertDate() < CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateDebut", [], "any", false, false, false, 58))) {
                // line 59
                yield "                    <span class=\"badge bg-danger\">Programmé</span>
                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 60
$context["boost"], "typeBoost", [], "any", false, false, false, 60) == "quota")) {
                // line 61
                yield "                    ";
                if ((null === CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 61))) {
                    // line 62
                    yield "                        <span class=\"badge bg-warning\">En cours</span>
                    ";
                } else {
                    // line 64
                    yield "                        <span class=\"badge bg-success\">Terminé</span>
                    ";
                }
                // line 66
                yield "                ";
            } else {
                // line 67
                yield "                    ";
                if (( !(null === CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 67)) && ($this->extensions['Twig\Extension\CoreExtension']->convertDate() < CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 67)))) {
                    // line 68
                    yield "                        <span class=\"badge bg-warning\">En cours</span>
                    ";
                } else {
                    // line 70
                    yield "                        <span class=\"badge bg-success\">Terminé</span>
                    ";
                }
                // line 72
                yield "                ";
            }
            // line 73
            yield "            </td>
            <td class=\"text-center\">
                ";
            // line 75
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "typeBoost", [], "any", false, false, false, 75) == "quota")) {
                // line 76
                yield "                    <span class=\"badge text-white\" style=\"background:#6f42c1\">Quota</span>
                ";
            } else {
                // line 78
                yield "                    <span class=\"badge bg-info text-dark\">Durée</span>
                ";
            }
            // line 80
            yield "            </td>
            <td class=\"text-center\">
                ";
            // line 82
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "mode", [], "any", false, false, false, 82) == "Gratuit")) {
                // line 83
                yield "                    <span class=\"badge bg-danger\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "mode", [], "any", false, false, false, 83), "html", null, true);
                yield "</span>
                ";
            } else {
                // line 85
                yield "                    <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "mode", [], "any", false, false, false, 85), "html", null, true);
                yield "</span>
                ";
            }
            // line 87
            yield "            </td>
            <td>";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "formuleBoost", [], "any", false, false, false, 88), "html", null, true);
            yield "</td>
            <td class=\"text-center\">
                ";
            // line 90
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "typeBoost", [], "any", false, false, false, 90) == "quota")) {
                // line 91
                yield "                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "nbContactsObtenus", [], "any", false, false, false, 91), "html", null, true);
                yield " / ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "formuleBoost", [], "any", false, false, false, 91), "nbContactsMax", [], "any", false, false, false, 91), "html", null, true);
                yield "
                ";
            } else {
                // line 93
                yield "                    ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "nbContactsObtenus", [], "any", true, true, false, 93) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "nbContactsObtenus", [], "any", false, false, false, 93)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "nbContactsObtenus", [], "any", false, false, false, 93), "html", null, true)) : (0));
                yield "
                ";
            }
            // line 95
            yield "            </td>
            <td>";
            // line 96
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateDebut", [], "any", false, false, false, 96)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateDebut", [], "any", false, false, false, 96), "Y-m-d H:i"), "html", null, true)) : (""));
            yield "</td>
            <td>";
            // line 97
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 97)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 97), "Y-m-d H:i"), "html", null, true)) : ("—"));
            yield "</td>
            <td>";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "id", [], "any", false, false, false, 98), "html", null, true);
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
        // line 100
        if (!$context['_iterated']) {
            // line 101
            yield "        <tr>
            <td colspan=\"11\">no records found</td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['boost'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        yield "    </tbody>
</table>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_boost/index.html.twig";
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
        return array (  347 => 105,  338 => 101,  336 => 100,  321 => 98,  317 => 97,  313 => 96,  310 => 95,  304 => 93,  296 => 91,  294 => 90,  289 => 88,  286 => 87,  280 => 85,  274 => 83,  272 => 82,  268 => 80,  264 => 78,  260 => 76,  258 => 75,  254 => 73,  251 => 72,  247 => 70,  243 => 68,  240 => 67,  237 => 66,  233 => 64,  229 => 62,  226 => 61,  224 => 60,  221 => 59,  219 => 58,  214 => 56,  211 => 55,  207 => 53,  203 => 51,  201 => 50,  198 => 49,  196 => 48,  193 => 47,  191 => 46,  186 => 44,  183 => 43,  165 => 42,  138 => 22,  130 => 21,  122 => 20,  114 => 19,  109 => 16,  101 => 13,  90 => 12,  85 => 11,  81 => 10,  74 => 6,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_boost/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_boost/index.html.twig");
    }
}
