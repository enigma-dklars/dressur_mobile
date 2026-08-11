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

/* private/support.html.twig */
class __TwigTemplate_fb76511110d271d3b863cd4dd73529ec extends Template
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
        yield "Support Technique";
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
        yield "<div class=\"row justify-content-center g-4\">

    <div class=\"col-12\">
        <div class=\"text-center mb-2\">
            <i class=\"fas fa-headset fa-3x text-primary mb-3\"></i>
            <h4 class=\"fw-bold\">Support Technique</h4>
            <p class=\"text-muted\">Notre équipe est disponible pour vous aider.<br>Choisissez le canal qui vous convient le mieux.</p>
        </div>
    </div>

    ";
        // line 17
        yield "    <div class=\"col-md-5\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body text-center p-4\">
                <div class=\"mb-3\">
                    <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10\" style=\"width:64px;height:64px;\">
                        <i class=\"fab fa-whatsapp fa-2x text-success\"></i>
                    </span>
                </div>
                <h5 class=\"fw-bold mb-1\">WhatsApp</h5>
                <p class=\"text-muted small mb-1\">Pour une réponse rapide</p>
                <p class=\"text-muted small mb-4\">Disponible en semaine · Réponse en moins d\x271h</p>
                <a href=\"https://wa.me/22964044294\" target=\"_blank\" rel=\"noopener noreferrer\"
                   class=\"btn btn-success btn-lg w-100\">
                    <i class=\"fab fa-whatsapp me-2\"></i>Contacter sur WhatsApp
                </a>
            </div>
        </div>
    </div>

    ";
        // line 37
        yield "    <div class=\"col-md-5\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body text-center p-4\">
                <div class=\"mb-3\">
                    <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10\" style=\"width:64px;height:64px;\">
                        <i class=\"fas fa-envelope fa-2x text-primary\"></i>
                    </span>
                </div>
                <h5 class=\"fw-bold mb-1\">E-mail</h5>
                <p class=\"text-muted small mb-1\">Pour les demandes détaillées</p>
                <p class=\"text-muted small mb-4\">Réponse sous 24–48h ouvrées</p>
                <a href=\"mailto:dressur.ds@gmail.com\"
                   class=\"btn btn-primary btn-lg w-100\">
                    <i class=\"fas fa-envelope me-2\"></i>Envoyer un e-mail
                </a>
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
        return "private/support.html.twig";
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
        return array (  103 => 37,  82 => 17,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/support.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/support.html.twig");
    }
}
