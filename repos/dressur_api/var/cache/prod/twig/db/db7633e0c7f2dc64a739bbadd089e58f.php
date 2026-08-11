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

/* emails/promo_affaire_refusee_user.html.twig */
class __TwigTemplate_5872a03c00b01f3d564a9ce4a2347429 extends Template
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
        yield "<style>
  .container {
    font-family: Arial, sans-serif;
    max-width: 560px;
    padding: 20px;
  }
  .error-box {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
    padding: 14px 16px;
    font-size: 14px;
    color: #721c24;
    margin-bottom: 16px;
  }
  .motif-block {
    background-color: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 12px 16px;
    border-radius: 4px;
    margin: 12px 0;
    font-size: 14px;
    color: #856404;
  }
  .motif-block strong {
    color: #856404;
  }
  .info-block {
    background-color: #f0f4ff;
    border-left: 4px solid #2a4b9a;
    padding: 12px 16px;
    border-radius: 4px;
    margin: 12px 0;
  }
  .info-block p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
  }
  .info-block strong {
    color: #2a4b9a;
  }
</style>

<div class=\"container\">
  <h2 style=\"color:#c0392b; margin-bottom: 4px;\">❌ Promotion Refusée</h2>
  <p style=\"color:#555; margin-top: 0;\">Bonjour <strong>";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["user_nom"] ?? null), "html", null, true);
        yield "</strong>,</p>

  <div class=\"error-box\">
    Votre promotion affaire a été <strong>refusée</strong> par notre équipe de modération.
  </div>

  ";
        // line 56
        if ((($tmp = ($context["motif"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 57
            yield "  <div class=\"motif-block\">
    <strong>Motif du refus :</strong><br>
    ";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["motif"] ?? null), "html", null, true);
            yield "
  </div>
  ";
        }
        // line 62
        yield "
  <div class=\"info-block\">
    <p style=\"margin:0; font-size:14px; color:#333;\">
      Vous pouvez <strong>modifier votre promotion</strong> depuis l\x27application Dressur 
      en tenant compte du motif ci-dessus, puis la soumettre à nouveau pour validation.
    </p>
  </div>

  <p style=\"font-size:14px; color:#444;\">
    Pour toute question, contactez-nous via WhatsApp : 
    <a href=\"https://wa.me/+22964044294\">+229 64 04 42 94</a>
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
        return "emails/promo_affaire_refusee_user.html.twig";
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
        return array (  127 => 62,  121 => 59,  117 => 57,  115 => 56,  106 => 50,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/promo_affaire_refusee_user.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/promo_affaire_refusee_user.html.twig");
    }
}
