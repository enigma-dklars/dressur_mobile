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

/* crud_boost/show.html.twig */
class __TwigTemplate_39a4b9a8f1b007f6490b39427a2a039e extends Template
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
        yield "Boost";
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
        yield "    <h1>Boost</h1>
    <table class=\"table table-bordered table-striped\">
        <tbody>
            <tr><th>Id</th><td>";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "id", [], "any", false, false, false, 7), "html", null, true);
        yield "</td></tr>
            <tr><th>User</th><td>";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "user", [], "any", false, false, false, 8), "pseudo", [], "any", false, false, false, 8), "html", null, true);
        yield "</td></tr>
            <tr><th>Formule</th><td>";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "formuleBoost", [], "any", false, false, false, 9), "html", null, true);
        yield "</td></tr>
            <tr>
                <th>Type</th>
                <td>
                    ";
        // line 13
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "typeBoost", [], "any", false, false, false, 13) == "quota")) {
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
            <tr><th>Mode</th><td>";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "mode", [], "any", false, false, false, 20), "html", null, true);
        yield "</td></tr>
            <tr><th>Source</th><td>";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "source", [], "any", false, false, false, 21), "html", null, true);
        yield "</td></tr>
            <tr><th>DateDebut</th><td>";
        // line 22
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "dateDebut", [], "any", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "dateDebut", [], "any", false, false, false, 22), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td></tr>
            <tr>
                <th>DateExp</th>
                <td>";
        // line 25
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "dateExp", [], "any", false, false, false, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "dateExp", [], "any", false, false, false, 25), "Y-m-d H:i:s"), "html", null, true)) : ("— (quota non épuisé)"));
        yield "</td>
            </tr>
            <tr>
                <th>Contacts obtenus / max</th>
                <td>
                    ";
        // line 30
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "typeBoost", [], "any", false, false, false, 30) == "quota")) {
            // line 31
            yield "                        ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "nbContactsObtenus", [], "any", false, false, false, 31), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "formuleBoost", [], "any", false, false, false, 31), "nbContactsMax", [], "any", false, false, false, 31), "html", null, true);
            yield "
                    ";
        } else {
            // line 33
            yield "                        —
                    ";
        }
        // line 35
        yield "                </td>
            </tr>
        </tbody>
    </table>
    <a href=\"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\">back to list</a>
    <a href=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["boost"] ?? null), "id", [], "any", false, false, false, 40)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success\">Edit</a>
    ";
        // line 41
        yield Twig\Extension\CoreExtension::include($this->env, $context, "crud_boost/_delete_form.html.twig");
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_boost/show.html.twig";
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
        return array (  154 => 41,  150 => 40,  146 => 39,  140 => 35,  136 => 33,  128 => 31,  126 => 30,  118 => 25,  112 => 22,  108 => 21,  104 => 20,  100 => 18,  96 => 16,  92 => 14,  90 => 13,  83 => 9,  79 => 8,  75 => 7,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_boost/show.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_boost/show.html.twig");
    }
}
