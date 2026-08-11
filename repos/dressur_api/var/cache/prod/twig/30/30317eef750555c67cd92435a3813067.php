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

/* emails/promo_affaire_acceptee_user.html.twig */
class __TwigTemplate_347821305591e66affbcc012487a65e0 extends Template
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
  .success-box {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 4px;
    padding: 14px 16px;
    font-size: 14px;
    color: #155724;
    margin-bottom: 16px;
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
  .section-title {
    font-size: 13px;
    text-transform: uppercase;
    color: #888;
    letter-spacing: 1px;
    margin: 18px 0 6px 0;
  }
</style>

<div class=\"container\">
  <h2 style=\"color:#2a4b9a; margin-bottom: 4px;\">🎉 Promotion Acceptée !</h2>
  <p style=\"color:#555; margin-top: 0;\">Bonjour <strong>";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["user_nom"] ?? null), "html", null, true);
        yield "</strong>,</p>

  <div class=\"success-box\">
    ✅ Votre promotion affaire a été <strong>acceptée</strong> et est maintenant <strong>en ligne</strong> sur Dressur.
  </div>

  <p style=\"font-size:14px; color:#444;\">
    Votre annonce est désormais visible par les utilisateurs de la plateforme Dressur.
    Elle restera active pendant la durée correspondant à votre formule.
  </p>

  ";
        // line 56
        if ((($tmp = ($context["formule_titre"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 57
            yield "  <p class=\"section-title\">Votre formule</p>
  <div class=\"info-block\">
    <p><strong>Formule :</strong> ";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["formule_titre"] ?? null), "html", null, true);
            yield "</p>
    ";
            // line 60
            if ((($tmp = ($context["formule_nbr_jour"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 61
                yield "    <p><strong>Durée :</strong> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["formule_nbr_jour"] ?? null), "html", null, true);
                yield " jour(s)</p>
    ";
            }
            // line 63
            yield "  </div>
  ";
        }
        // line 65
        yield "
  <p style=\"font-size:14px; color:#444;\">
    Merci de faire confiance à <strong>Dressur</strong> pour la promotion de votre activité. <br>
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
        return "emails/promo_affaire_acceptee_user.html.twig";
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
        return array (  137 => 65,  133 => 63,  127 => 61,  125 => 60,  121 => 59,  117 => 57,  115 => 56,  101 => 45,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/promo_affaire_acceptee_user.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/promo_affaire_acceptee_user.html.twig");
    }
}
