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

/* emails/promo_affaire_edit_admin_notif.html.twig */
class __TwigTemplate_8d77bbf6435fd2875106c3b358a16b59 extends Template
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
  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    margin: 2px 0;
  }
  .badge-oui { background-color: #d4edda; color: #155724; }
  .badge-non { background-color: #f8d7da; color: #721c24; }
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
  .alert-box {
    background-color: #cce5ff;
    border: 1px solid #b8daff;
    border-radius: 4px;
    padding: 12px;
    font-size: 14px;
    color: #004085;
    margin-bottom: 16px;
  }
</style>

<div class=\"container\">
  <h2 style=\"color:#2a4b9a; margin-bottom: 4px;\">✏️ Promotion Affaire Modifiée</h2>
  <p style=\"color:#555; margin-top: 0;\">Un utilisateur vient de modifier une promotion affaire existante.</p>

  <div class=\"alert-box\">
    ℹ️ La promotion a été remise en attente de validation (statut 1). Veuillez la vérifier depuis le panneau d\x27administration.
  </div>

  <p class=\"section-title\">Utilisateur</p>
  <div class=\"info-block\">
    <p><strong>Nom :</strong> ";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["user_nom"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Email :</strong> ";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["user_mail"] ?? null), "html", null, true);
        yield "</p>
    <p><strong>Téléphone :</strong> ";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["user_tel"] ?? null), "html", null, true);
        yield "</p>
  </div>

  <p class=\"section-title\">Promotion concernée</p>
  <div class=\"info-block\">
    <p><strong>ID Promotion :</strong> #";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["promotion_id"] ?? null), "html", null, true);
        yield "</p>
    <p>
      <strong>Description modifiée :</strong>
      ";
        // line 73
        if ((($tmp = ($context["description_modifiee"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 74
            yield "        <span class=\"badge badge-oui\">OUI</span>
      ";
        } else {
            // line 76
            yield "        <span class=\"badge badge-non\">NON</span>
      ";
        }
        // line 78
        yield "    </p>
    <p>
      <strong>Image modifiée :</strong>
      ";
        // line 81
        if ((($tmp = ($context["image_modifiee"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 82
            yield "        <span class=\"badge badge-oui\">OUI</span>
      ";
        } else {
            // line 84
            yield "        <span class=\"badge badge-non\">NON</span>
      ";
        }
        // line 86
        yield "    </p>
    ";
        // line 87
        if ((($tmp = ($context["description_modifiee"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 88
            yield "    <p><strong>Nouvelle description :</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nouvelle_description"] ?? null), "html", null, true);
            yield "</p>
    ";
        }
        // line 90
        yield "  </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/promo_affaire_edit_admin_notif.html.twig";
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
        return array (  177 => 90,  171 => 88,  169 => 87,  166 => 86,  162 => 84,  158 => 82,  156 => 81,  151 => 78,  147 => 76,  143 => 74,  141 => 73,  135 => 70,  127 => 65,  123 => 64,  119 => 63,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/promo_affaire_edit_admin_notif.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/promo_affaire_edit_admin_notif.html.twig");
    }
}
