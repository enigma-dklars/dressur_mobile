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

/* crud_formule_promo_affaire/index.html.twig */
class __TwigTemplate_06236b8c41ec4c960491b87278c54ffb extends Template
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
        yield "FormulePromoAffaire index";
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
        yield "    <span class=\"h4 me-3\">FormulePromoAffaire index</span>
    <a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_affaire_new");
        yield "\">Create new</a>

    <table class=\"data-table table table-bordered table-striped\">
        <thead>
            <tr>
                <th></th>
                <th>Titre</th>
                <th>Prix</th>
                <th>NbrJour</th>
                <th>Activated</th>
                <th>Alert</th>
                <th>Ref.</th>
                <th width=\"1\">Id</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_promo_affaires"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["formule_promo_affaire"]) {
            // line 24
            yield "            <tr>
                <td>";
            // line 25
            yield Twig\Extension\CoreExtension::include($this->env, $context, "crud_formule_promo_affaire/_delete_form.html.twig");
            yield "</td>
                <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "titre", [], "any", false, false, false, 26), "html", null, true);
            yield "</td>
                <td>";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "prix", [], "any", false, false, false, 27), "html", null, true);
            yield "</td>
                <td>";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "nbrJour", [], "any", false, false, false, 28), "html", null, true);
            yield "</td>
                <td class=\"text-center\">";
            // line 29
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "activated", [], "any", false, false, false, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                <td class=\"text-center\">";
            // line 30
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "alert", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                <td class=\"text-center\">";
            // line 31
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "referencement", [], "any", false, false, false, 31)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                <td>";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_affaire"], "id", [], "any", false, false, false, 32), "html", null, true);
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
        // line 34
        if (!$context['_iterated']) {
            // line 35
            yield "            <tr>
                <td colspan=\"6\">no records found</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['formule_promo_affaire'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
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
        return "crud_formule_promo_affaire/index.html.twig";
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
        return array (  167 => 39,  158 => 35,  156 => 34,  141 => 32,  137 => 31,  133 => 30,  129 => 29,  125 => 28,  121 => 27,  117 => 26,  113 => 25,  110 => 24,  92 => 23,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_promo_affaire/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_promo_affaire/index.html.twig");
    }
}
