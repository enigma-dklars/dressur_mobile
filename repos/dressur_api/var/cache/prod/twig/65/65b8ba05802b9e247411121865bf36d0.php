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

/* preuve/_delete_form.html.twig */
class __TwigTemplate_28199c735a29e417766e8b044aa94c6a extends Template
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
        yield "<div
\tclass=\"d-flex gap-1\">

\t";
        // line 5
        yield "\t";
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "isIsTreated", [], "any", false, false, false, 5)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 6
            yield "
\t\t<!-- Bouton ouverture modal -->
\t\t<button type=\"button\" class=\"btn btn-success btn-sm\" data-bs-toggle=\"modal\" data-bs-target=\"#acceptModal";
            // line 8
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 8), "html", null, true);
            yield "\">
\t\t\tAccepter
\t\t</button>

\t\t<!-- Modal -->
\t\t<div class=\"modal fade\" id=\"acceptModal";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 13), "html", null, true);
            yield "\" tabindex=\"-1\">
\t\t\t<div class=\"modal-dialog\">
\t\t\t\t<div class=\"modal-content\">
\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t\t<h5 class=\"modal-title\">Validation des vues</h5>
\t\t\t\t\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
\t\t\t\t\t</div>

\t\t\t\t\t<form method=\"post\" action=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_accept", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 21)]), "html", null, true);
            yield "\">
\t\t\t\t\t\t<div class=\"modal-body\">

\t\t\t\t\t\t\t<input type=\"hidden\" name=\"_token\" value=\"";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("accept" . CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 24))), "html", null, true);
            yield "\">

\t\t\t\t\t\t\t<div class=\"mb-3\">
\t\t\t\t\t\t\t\t<label class=\"form-label\">Nombre de vues</label>
\t\t\t\t\t\t\t\t<input type=\"number\" name=\"nbrVue\" class=\"form-control\" min=\"0\" required>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Annuler</button>
\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-success\">Confirmer</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</form>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

\t\t<!-- Bouton Refuser -->
\t\t<form method=\"post\" action=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_refuse", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 43)]), "html", null, true);
            yield "\" onsubmit=\"return confirm(\x27Refuser cette preuve ?\x27);\">
\t\t\t<input type=\"hidden\" name=\"_token\" value=\"";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("refuse" . CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 44))), "html", null, true);
            yield "\">
\t\t\t<button class=\"btn btn-danger btn-sm\">Refuser</button>
\t\t</form>

\t";
        }
        // line 49
        yield "

\t<!-- Bouton Voir -->
\t<a class=\"btn btn-sm btn-info\" href=\"";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 52)]), "html", null, true);
        yield "\">
\t\tShow
\t</a>

\t<!-- Bouton Modifier -->
\t<a class=\"btn btn-sm btn-primary\" href=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 57)]), "html", null, true);
        yield "\">
\t\tUpdate
\t</a>

\t<!-- Formulaire Supprimer -->
\t<form method=\"post\" action=\"";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 62)]), "html", null, true);
        yield "\" onsubmit=\"return confirm(\x27Êtes-vous sûr de vouloir supprimer cet élément ?\x27);\">
\t\t<input type=\"hidden\" name=\"_token\" value=\"";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 63))), "html", null, true);
        yield "\">
\t\t<button class=\"btn btn-sm btn-danger\">Delete</button>
\t</form>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "preuve/_delete_form.html.twig";
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
        return array (  138 => 63,  134 => 62,  126 => 57,  118 => 52,  113 => 49,  105 => 44,  101 => 43,  79 => 24,  73 => 21,  62 => 13,  54 => 8,  50 => 6,  47 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "preuve/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/preuve/_delete_form.html.twig");
    }
}
