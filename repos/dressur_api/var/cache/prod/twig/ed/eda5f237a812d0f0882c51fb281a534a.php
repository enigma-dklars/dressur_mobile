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

/* emails/verif_mail.html.twig */
class __TwigTemplate_19d328d1844d581862c55ea92510ee1f extends Template
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
            'contenu_mail' => [$this, 'block_contenu_mail'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "emails/templates_mail.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("emails/templates_mail.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_contenu_mail(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "  <style>
    .container {
      font-family: \x27Arial\x27, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      text-align: center;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
    }
    h2 {
      color: #333;
    }
    p {
      color: #555;
    }
     pre {
      background-color: #eee;
      padding: 10px;
      border-radius: 3px;
      font-size: 14px;
      margin: 10px 0;
    }
  </style>

  <div class=\"container\">
    <h2>Vérification de l\x27Adresse E-mail</h2>
    <p>";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["username"] ?? null), "html", null, true);
        yield ", Bienvenue sur Dressur ! Avant de commencer à utiliser notre application, veuillez vérifier votre adresse e-mail.</p>
    <p>Copiez et collez le code de vérification suivant dans la section prévue sur l\x27application Dressur :</p>
    <pre>Code de Vérification : ";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["code"] ?? null), "html", null, true);
        yield " </pre>
    <p>Merci de faire partie de la communauté Dressur !</p>
  </div>


";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/verif_mail.html.twig";
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
        return array (  93 => 34,  88 => 32,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/verif_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/verif_mail.html.twig");
    }
}
