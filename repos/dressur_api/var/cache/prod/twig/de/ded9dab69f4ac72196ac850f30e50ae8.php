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

/* private/addSuggestion.html.twig */
class __TwigTemplate_22ef63b72cf0343680bc5b3a39355c14 extends Template
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
        return "basePrivate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Suggestion";
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
        yield "<div class=\"card mt-3\">
    <div class=\"card-body\">
        <p class=\"h4 text-center mb-3\">Faire une Suggestion</p>
        <div class=\"row g-2\">
            <div class=\"col-md-6 text-center\">
                <i class=\"text-warning fas fa-lightbulb py-3\" style=\"font-size: 12rem;\"></i>
                <p class=\"text-center pb-3\">
                    Nous cherchons constamment à améliorer notre application pour vous. Votre opinion est précieuse ! Que vous ayez une idée, une suggestion de fonctionnalité ou des commentaires, faites-nous en part.
                </p>
            </div>
            <div class=\"col-md-6\">
                <div class=\"row g-2\">

                    <div class=\"col-12\">
                        <div class=\"mt-0\" id=\"msgError\" style=\"display: none;\"></div>
                    </div>
                    <div class=\"col-12\">
                        <label for=\"\">Votre ou vos suggestions</label>
                        <textarea id=\"suggestion\"  rows=\"10\" class=\"form-control getInfo\"></textarea>
                    </div>
                    <div class=\"col-12\">
                        <button class=\"btn btn-warning\" id=\"addSuggerer\">SUGGERER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/addSuggestion.html.twig";
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
        return array (  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/addSuggestion.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/addSuggestion.html.twig");
    }
}
