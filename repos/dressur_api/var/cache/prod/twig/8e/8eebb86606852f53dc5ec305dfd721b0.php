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

/* crud_deleted_ds/_delete_form.html.twig */
class __TwigTemplate_3f7a366581d97302a2dcfc77911320f3 extends Template
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_deleted_d_s_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "id", [], "any", false, false, false, 1)]), "html", null, true);
        yield "\" onsubmit=\"return confirm(\x27Are you sure you want to delete this item?\x27);\">
    <input type=\"hidden\" name=\"_token\" value=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "id", [], "any", false, false, false, 2))), "html", null, true);
        yield "\">
    ";
        // line 4
        yield "    ";
        // line 5
        yield "    <button class=\"btn btn-sm btn-danger\">Delete</button>
    <span data-bs-toggle=\"modal\" data-bs-target=\"#modal_deleted_d_";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "id", [], "any", false, false, false, 6), "html", null, true);
        yield "\" class=\"btn btn-sm ";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "motif", [], "any", false, false, false, 6) != "GET OUT BY ADMIN")) {
            yield "btn-primary";
        } else {
            yield "btn-dark";
        }
        yield "\">More</span>
</form>
<div class=\"modal fade\" id=\"modal_deleted_d_";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "id", [], "any", false, false, false, 8), "html", null, true);
        yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-dialog-scrollable\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <p class=\"px-3\">
                    <table class=\"table table-striped table-bordered\">
                        ";
        // line 14
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["deleted_d"] ?? null), "motif", [], "any", false, false, false, 14), "html", null, true));
        yield "
                    </table>
                </p>
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
        return "crud_deleted_ds/_delete_form.html.twig";
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
        return array (  76 => 14,  67 => 8,  56 => 6,  53 => 5,  51 => 4,  47 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_deleted_ds/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_deleted_ds/_delete_form.html.twig");
    }
}
