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

/* preuve/show.html.twig */
class __TwigTemplate_0db81558c95b788a14602850b223389e extends Template
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
        yield "Preuve";
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
        yield "    <h1>Preuve</h1>

    <table class=\"table table-bordered table-striped\">
        <tbody>
            <tr>
                <th>Id</th>
                <td>";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 12), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>CaptureListeStatut</th>
                <td class=\"text-center\">
                    ";
        // line 17
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "captureListeStatut", [], "any", false, false, false, 17)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 18
            yield "                        <img 
                            src=\"";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "captureListeStatut", [], "any", false, false, false, 19))), "html", null, true);
            yield "\"
                            alt=\"Capture Liste\"
                            class=\"img-fluid rounded\"
                            style=\"max-width:120px; max-height:120px;\"
                        >
                    ";
        } else {
            // line 25
            yield "                        <span class=\"badge bg-danger\">Non fourni</span>
                    ";
        }
        // line 27
        yield "                </td>
            </tr>
            <tr>
                <th>CaptureStatutOuvert</th>
                <td class=\"text-center\">
                    ";
        // line 32
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "captureStatutOuvert", [], "any", false, false, false, 32)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 33
            yield "                        <img 
                            src=\"";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "captureStatutOuvert", [], "any", false, false, false, 34))), "html", null, true);
            yield "\"
                            alt=\"Capture Ouvert\"
                            class=\"img-fluid rounded\"
                            style=\"max-width:120px; max-height:120px;\"
                        >
                    ";
        } else {
            // line 40
            yield "                        <span class=\"badge bg-danger\">Non fourni</span>
                    ";
        }
        // line 42
        yield "                </td>
            </tr>
            <tr>
                <th>CreatedAt</th>
                <td>";
        // line 46
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "createdAt", [], "any", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "createdAt", [], "any", false, false, false, 46), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>UpdatedAt</th>
                <td>";
        // line 50
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "updatedAt", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "updatedAt", [], "any", false, false, false, 50), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
            </tr>
        </tbody>
    </table>

    <a href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_index");
        yield "\">back to list</a>

    <a href=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["preuve"] ?? null), "id", [], "any", false, false, false, 57)]), "html", null, true);
        yield "\">edit</a>

    ";
        // line 59
        yield Twig\Extension\CoreExtension::include($this->env, $context, "preuve/_delete_form.html.twig");
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "preuve/show.html.twig";
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
        return array (  160 => 59,  155 => 57,  150 => 55,  142 => 50,  135 => 46,  129 => 42,  125 => 40,  116 => 34,  113 => 33,  111 => 32,  104 => 27,  100 => 25,  91 => 19,  88 => 18,  86 => 17,  78 => 12,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "preuve/show.html.twig", "/home/runner/workspace/repos/dressur_api/templates/preuve/show.html.twig");
    }
}
