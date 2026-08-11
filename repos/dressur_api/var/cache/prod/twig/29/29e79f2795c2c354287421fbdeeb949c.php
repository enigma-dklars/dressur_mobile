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

/* historique_programme_recompense/_delete_form.html.twig */
class __TwigTemplate_6e10d7655f09d6e310f1f02c0da821dd extends Template
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
        yield "<div class=\"d-flex gap-1\">
    <!-- Bouton Voir -->
    <a class=\"btn btn-sm btn-info\" href=\"";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_historique_programme_recompense_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["historique_programme_recompense"] ?? null), "id", [], "any", false, false, false, 3)]), "html", null, true);
        yield "\">
        Show
    </a>

    <!-- Bouton Modifier -->
    <a class=\"btn btn-sm btn-primary\" href=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_historique_programme_recompense_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["historique_programme_recompense"] ?? null), "id", [], "any", false, false, false, 8)]), "html", null, true);
        yield "\">
        Update
    </a>

    <!-- Formulaire Supprimer -->
    <form method=\"post\" action=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_historique_programme_recompense_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["historique_programme_recompense"] ?? null), "id", [], "any", false, false, false, 13)]), "html", null, true);
        yield "\"
          onsubmit=\"return confirm(\x27Êtes-vous sûr de vouloir supprimer cet élément ?\x27);\">
        <input type=\"hidden\" name=\"_token\" value=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, ($context["historique_programme_recompense"] ?? null), "id", [], "any", false, false, false, 15))), "html", null, true);
        yield "\">
        <button class=\"btn btn-sm btn-danger\">Delete</button>
    </form>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "historique_programme_recompense/_delete_form.html.twig";
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
        return array (  67 => 15,  62 => 13,  54 => 8,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "historique_programme_recompense/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/historique_programme_recompense/_delete_form.html.twig");
    }
}
