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

/* confirm_mail/index.html.twig */
class __TwigTemplate_b6c814a1e13e19feb855791da6fd7555 extends Template
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
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Confirmation de votre adresse mail — Dressur";
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
        yield "<div style=\"font-family:Arial,sans-serif;max-width:560px;margin:80px auto;padding:0 16px;text-align:center;\">

    ";
        // line 8
        if ((($context["status"] ?? null) == "success")) {
            // line 9
            yield "        <div style=\"background:#d1fae5;border:1px solid #6ee7b7;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">✅</div>
            <h1 style=\"color:#065f46;font-size:24px;margin-bottom:12px;\">Adresse mail confirmée !</h1>
            <p style=\"color:#047857;margin-bottom:32px;\">";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
            yield "</p>
            <p style=\"color:#374151;font-size:15px;margin-bottom:32px;\">
                Vous pouvez maintenant profiter de toutes les fonctionnalités de Dressur en toute sécurité.
            </p>
            <a href=\"https://dressur.site\"
               style=\"display:inline-block;padding:14px 36px;background:#059669;color:white;text-decoration:none;border-radius:8px;font-weight:bold;font-size:16px;\">
                Retourner sur Dressur
            </a>
        </div>

    ";
        } elseif ((        // line 22
($context["status"] ?? null) == "already")) {
            // line 23
            yield "        <div style=\"background:#eff6ff;border:1px solid #93c5fd;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">ℹ️</div>
            <h1 style=\"color:#1e40af;font-size:24px;margin-bottom:12px;\">Déjà confirmée</h1>
            <p style=\"color:#1d4ed8;margin-bottom:32px;\">";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
            yield "</p>
            <a href=\"https://dressur.site\"
               style=\"display:inline-block;padding:14px 36px;background:#2563eb;color:white;text-decoration:none;border-radius:8px;font-weight:bold;font-size:16px;\">
                Retourner sur Dressur
            </a>
        </div>

    ";
        } else {
            // line 34
            yield "        <div style=\"background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">❌</div>
            <h1 style=\"color:#991b1b;font-size:24px;margin-bottom:12px;\">Lien invalide</h1>
            <p style=\"color:#dc2626;margin-bottom:32px;\">";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
            yield "</p>
            <p style=\"color:#374151;font-size:14px;margin-bottom:32px;\">
                Ce lien est peut-être expiré ou déjà utilisé. Connectez-vous à votre compte pour en générer un nouveau.
            </p>
            <a href=\"https://dressur.site/connexion\"
               style=\"display:inline-block;padding:14px 36px;background:#dc2626;color:white;text-decoration:none;border-radius:8px;font-weight:bold;font-size:16px;\">
                Se connecter
            </a>
        </div>
    ";
        }
        // line 47
        yield "
    <p style=\"color:#9ca3af;font-size:12px;margin-top:32px;\">
        <a href=\"https://dressur.site\" style=\"color:#9ca3af;\">dressur.site</a> —
        <a href=\"mailto:dressur.ds@gmail.com\" style=\"color:#9ca3af;\">dressur.ds@gmail.com</a>
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
        return "confirm_mail/index.html.twig";
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
        return array (  130 => 47,  117 => 37,  112 => 34,  101 => 26,  96 => 23,  94 => 22,  81 => 12,  76 => 9,  74 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "confirm_mail/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/confirm_mail/index.html.twig");
    }
}
