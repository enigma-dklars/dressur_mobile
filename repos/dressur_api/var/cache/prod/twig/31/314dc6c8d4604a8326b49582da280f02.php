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

/* crud_formule_promo_reseau/_delete_form.html.twig */
class __TwigTemplate_3fa0d52a4743b29e87a92a08a020f873 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["formule_promo_reseau"] ?? null), "id", [], "any", false, false, false, 1)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-info\">Show</a>
<a href=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["formule_promo_reseau"] ?? null), "id", [], "any", false, false, false, 2)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success\">Edit</a>


";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_formule_promo_reseau/_delete_form.html.twig";
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
        return array (  47 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_promo_reseau/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_promo_reseau/_delete_form.html.twig");
    }
}
