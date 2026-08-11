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

/* private/editPassword.html.twig */
class __TwigTemplate_e157e81d3113f21f8bd448aa97db829e extends Template
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
        yield "Mot de passe";
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
        yield "<div class=\"card\">
    <div class=\"card-body\">
        <h4 class=\"text-center pb-3\">Modifier le mot de passe</h4>
        
        <div class=\"row g-2\">
            <div class=\"col-md-1\"></div>
            <div class=\"col-md-4\">
                <div class=\"card\"><img src=\"/assets/images/passe_oublier.png\" alt=\"\" class=\"card-img-top\"></div>
            </div>
            <div class=\"col-md-1\"></div>
            <div class=\"col-md-5\">
                <div class=\"row g-2\">

                    <div class=\"col-12\">
                        <div class=\"mt-0\" id=\"msgError\" style=\"display: none;\"></div>
                    </div>
                    <div class=\"col-12 text-center my-3\">
                        Renseignez l\x27ancien et le nouveau mot de passe.
                    </div>
                    <div class=\"col-12\">
                        <label for=\"inputAncienMdp\" class=\"mb-1\">Ancien mot de passe</label>
                        <div class=\"ms-auto position-relative\">
                        <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-lock-fill fs-6 fs-6\"></i></div>
                        <input type=\"password\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputAncienMdp\" placeholder=\"Ancien mot de passe\">
                        </div>
                    </div>
                    <div class=\"col-12\">
                        <label for=\"inputNewMdp\" class=\"mb-1\">Nouveau mot de passe</label>
                        <div class=\"ms-auto position-relative\">
                        <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-lock-fill fs-6 fs-6\"></i></div>
                        <input type=\"password\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputNewMdp\" placeholder=\"Nouveau mot de passe\">
                        </div>
                    </div>
                    <div class=\"col-12\">
                        <label for=\"inputConfNewMdp\" class=\"mb-1\">Confirmer le nouveau mot de passe</label>
                        <div class=\"ms-auto position-relative\">
                        <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-lock-fill fs-6 fs-6\"></i></div>
                        <input type=\"password\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputConfNewMdp\" placeholder=\"Confirmer le nouveau mot de passe\">
                        </div>
                    </div>
                    <div class=\"col-12\">
                        <button class=\"btn btn-primary mt-2\" id=\"editMdp\">MODIFIER</button>
                    </div>
                </div>
            </div>
            <div class=\"col-md-1\"></div>
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
        return "private/editPassword.html.twig";
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
        return new Source("", "private/editPassword.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/editPassword.html.twig");
    }
}
