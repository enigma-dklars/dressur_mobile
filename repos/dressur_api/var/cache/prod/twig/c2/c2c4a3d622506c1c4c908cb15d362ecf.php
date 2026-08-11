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

/* crud_formule_boost/index.html.twig */
class __TwigTemplate_170fb07a84eb154582a34791c1b2e2d7 extends Template
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
        yield "FormuleBoost index";
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
        yield "    <span class=\"h4 me-3\">FormuleBoost index</span>
    <a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 5
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_boost_new");
        yield "\">Create new</a>
    <table class=\"data-table table table-bordered table-striped\">
        <thead>
            <tr>
                <th></th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Type</th>
                <th>NbrJour</th>
                <th>NbContactsMax</th>
                <th>Activated</th>
                <th>Alert</th>
                <th width=\"1\">Id</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_boosts"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["formule_boost"]) {
            // line 22
            yield "            <tr>
                <td>";
            // line 23
            yield from $this->load("crud_formule_boost/_delete_form.html.twig", 23)->unwrap()->yield($context);
            yield "</td>
                <td>";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "titre", [], "any", false, false, false, 24), "html", null, true);
            yield "</td>
                <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "prix", [], "any", false, false, false, 25), "html", null, true);
            yield " FCFA</td>
                <td class=\"text-center\">
                    ";
            // line 27
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "typeBoost", [], "any", false, false, false, 27) == "quota")) {
                // line 28
                yield "                        <span class=\"badge bg-purple text-white\" style=\"background:#6f42c1\">Quota</span>
                    ";
            } else {
                // line 30
                yield "                        <span class=\"badge bg-info text-dark\">Durée</span>
                    ";
            }
            // line 32
            yield "                </td>
                <td class=\"text-center\">";
            // line 33
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "typeBoost", [], "any", false, false, false, 33) == "date")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "nbrJour", [], "any", false, false, false, 33) . " j"), "html", null, true)) : ("—"));
            yield "</td>
                <td class=\"text-center\">";
            // line 34
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "typeBoost", [], "any", false, false, false, 34) == "quota")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "nbContactsMax", [], "any", false, false, false, 34), "html", null, true)) : ("—"));
            yield "</td>
                <td class=\"text-center\">";
            // line 35
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "activated", [], "any", false, false, false, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                <td class=\"text-center\">";
            // line 36
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "alert", [], "any", false, false, false, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                <td>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_boost"], "id", [], "any", false, false, false, 37), "html", null, true);
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
        // line 39
        if (!$context['_iterated']) {
            // line 40
            yield "            <tr>
                <td colspan=\"9\">no records found</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['formule_boost'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "        </tbody>
    </table>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_formule_boost/index.html.twig";
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
        return array (  181 => 44,  172 => 40,  170 => 39,  155 => 37,  151 => 36,  147 => 35,  143 => 34,  139 => 33,  136 => 32,  132 => 30,  128 => 28,  126 => 27,  121 => 25,  117 => 24,  113 => 23,  110 => 22,  92 => 21,  73 => 5,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_boost/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_boost/index.html.twig");
    }
}
