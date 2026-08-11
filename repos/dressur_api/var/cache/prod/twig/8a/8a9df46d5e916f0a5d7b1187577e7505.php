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

/* emails/pass_edit_mail.html.twig */
class __TwigTemplate_85f887c684aa73f81d6b106c314a3d64 extends Template
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
      text-align: justify;
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
  </style>
  <div class=\"container\">
    <h2>Mot de Passe Modifié avec Succès</h2>
    <p>
        Votre mot de passe sur Dressur a été modifié avec succès. Si vous n\x27avez pas effectué cette modification, 
        veuillez nous contacter immédiatement à adresse e-mail du support :
        </strong> <a href=\"mailto:dressur.ds@gmail.com\" style=\"text-decoration: none;\">dressur.ds@gmail.com</a></span>.
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
        return "emails/pass_edit_mail.html.twig";
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
        return array (  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/pass_edit_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/pass_edit_mail.html.twig");
    }
}
