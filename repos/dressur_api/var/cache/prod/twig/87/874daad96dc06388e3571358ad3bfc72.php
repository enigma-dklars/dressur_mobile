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

/* crud_formule_boost/show.html.twig */
class __TwigTemplate_77f43caf657389e4ca424dae64d6d8b7 extends Template
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
        yield "FormuleBoost";
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
        yield "    <h1>FormuleBoost</h1>
    <table class=\"table table-bordered table-striped\">
        <tbody>
            <tr><th>Id</th><td>";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "id", [], "any", false, false, false, 7), "html", null, true);
        yield "</td></tr>
            <tr><th>Titre</th><td>";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "titre", [], "any", false, false, false, 8), "html", null, true);
        yield "</td></tr>
            <tr><th>Prix</th><td>";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "prix", [], "any", false, false, false, 9), "html", null, true);
        yield " FCFA</td></tr>
            <tr>
                <th>Type de boost</th>
                <td>
                    ";
        // line 13
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "typeBoost", [], "any", false, false, false, 13) == "quota")) {
            // line 14
            yield "                        <span class=\"badge text-white\" style=\"background:#6f42c1\">Par Contacts (quota)</span>
                    ";
        } else {
            // line 16
            yield "                        <span class=\"badge bg-info text-dark\">Par Durée (date)</span>
                    ";
        }
        // line 18
        yield "                </td>
            </tr>
            <tr><th>NbrJour <small class=\"text-muted\">(type date)</small></th><td>";
        // line 20
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "typeBoost", [], "any", false, false, false, 20) == "date")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "nbrJour", [], "any", false, false, false, 20), "html", null, true)) : ("—"));
        yield "</td></tr>
            <tr><th>NbContactsMax <small class=\"text-muted\">(type quota)</small></th><td>";
        // line 21
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "typeBoost", [], "any", false, false, false, 21) == "quota")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "nbContactsMax", [], "any", false, false, false, 21), "html", null, true)) : ("—"));
        yield "</td></tr>
            <tr><th>Activated</th><td>";
        // line 22
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "activated", [], "any", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td></tr>
            <tr><th>Alert</th><td>";
        // line 23
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "alert", [], "any", false, false, false, 23)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td></tr>
        </tbody>
    </table>
    <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_boost_index");
        yield "\">back to list</a>
    <a href=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_boost_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["formule_boost"] ?? null), "id", [], "any", false, false, false, 27)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success\">Edit</a>
    ";
        // line 28
        yield Twig\Extension\CoreExtension::include($this->env, $context, "crud_formule_boost/_delete_form.html.twig");
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_formule_boost/show.html.twig";
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
        return array (  130 => 28,  126 => 27,  122 => 26,  116 => 23,  112 => 22,  108 => 21,  104 => 20,  100 => 18,  96 => 16,  92 => 14,  90 => 13,  83 => 9,  79 => 8,  75 => 7,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_boost/show.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_boost/show.html.twig");
    }
}
