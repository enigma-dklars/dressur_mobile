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

/* crud_transaction/_delete_form.html.twig */
class __TwigTemplate_41706c5be7a8710015bf5e2967381ab4 extends Template
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
        yield "<form method=\"post\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 1)]), "html", null, true);
        yield "\" onsubmit=\"return confirm(\x27Are you sure you want to delete this item?\x27);\">
    <input type=\"hidden\" name=\"_token\" value=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 2))), "html", null, true);
        yield "\">
    <a href=\"";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 3)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-info\">Show</a>
    <a href=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 4)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success\">Edit</a>
    <span data-bs-toggle=\"modal\" data-bs-target=\"#modal_transaction_";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 5), "html", null, true);
        yield "\" class=\"btn btn-sm btn-primary\">More</span>
    <button
        type=\"button\"
        class=\"btn btn-sm btn-danger btn-force-process\"
        data-id=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 9), "html", null, true);
        yield "\"
        data-for=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "transactionFor", [], "any", false, false, false, 10), "html", null, true);
        yield "\"
        data-status=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "status", [], "any", false, false, false, 11), "html", null, true);
        yield "\"
        title=\"Vérifier et forcer le traitement du paiement\">
        ";
        // line 14
        yield "        Pay Check
    </button>
    ";
        // line 17
        yield "</form>
<div class=\"modal fade\" id=\"modal_transaction_";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "id", [], "any", false, false, false, 18), "html", null, true);
        yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-scrollable\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-striped table-bordered\">
                        ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["transaction"] ?? null), "annotherInfo", [], "any", false, false, false, 24));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 25
            yield "                            <tr>
                                <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "</td>
                                <td style=\"word-wrap: break-word; white-space: normal;\">";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
            yield "</td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        yield "                    
                    </table>
                </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
            </div>
        </div>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_transaction/_delete_form.html.twig";
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
        return array (  115 => 29,  106 => 27,  102 => 26,  99 => 25,  95 => 24,  86 => 18,  83 => 17,  79 => 14,  74 => 11,  70 => 10,  66 => 9,  59 => 5,  55 => 4,  51 => 3,  47 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_transaction/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_transaction/_delete_form.html.twig");
    }
}
