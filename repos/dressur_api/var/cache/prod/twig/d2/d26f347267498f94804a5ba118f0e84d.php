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

/* emails/passe_4got_mail.html.twig */
class __TwigTemplate_c7521d5b8be92bb0fd8f3c45909ff480 extends Template
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

      max-width: 600px;
      text-align: center;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
    }
    h2 {
      color: #333;
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
    <h2>Récupération de Mot de Passe</h2>
    <p>
        ";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["username"] ?? null), "html", null, true);
        yield ", vous avez demandé une réinitialisation de votre mot de passe sur Dressur.
    </p>
    <p>
        Utilisez votre adresse mail suivie du mot de passe ci-dessous pour vous connecter :
    </p>
    <pre>Mot de Passe : ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["code"] ?? null), "html", null, true);
        yield "</pre>
    <p>
        Si vous n\x27avez pas effectué cette demande, vous pouvez ignorer ce message.
        Ce code expire dans <strong style=\"color:#2a4b9a;\">10 min</strong>. Assurez-vous de le traiter rapidement pour des raisons de sécurité.
    </p>
    <p>
         Merci de faire confiance à Dressur pour la sécurité de votre compte.
    </p>
  </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/passe_4got_mail.html.twig";
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
        return array (  95 => 36,  87 => 31,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/passe_4got_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/passe_4got_mail.html.twig");
    }
}
