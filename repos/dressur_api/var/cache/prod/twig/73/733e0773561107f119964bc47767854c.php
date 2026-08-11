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

/* confirm_tel/index.html.twig */
class __TwigTemplate_d07b57917a052a40bc85f7cc8a7beaee extends Template
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
        yield "Confirmation de votre numéro — Dressur";
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
        if ((($context["status"] ?? null) == "prerequisites")) {
            // line 9
            yield "        <div style=\"background:#fffbeb;border:1px solid #fcd34d;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">⚠️</div>
            <h1 style=\"color:#92400e;font-size:24px;margin-bottom:12px;\">Action requise avant la confirmation</h1>
            <p style=\"color:#78350f;margin-bottom:24px;\">
                Pour confirmer votre numéro WhatsApp, vous devez d\x27abord compléter les étapes suivantes sur Dressur :
            </p>
            <ul style=\"text-align:left;color:#374151;font-size:15px;margin:0 auto 32px;max-width:360px;padding-left:20px;line-height:2;\">
                ";
            // line 16
            if ((($tmp = ($context["missing_mail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 17
                yield "                    <li>📧 <strong>Confirmer votre adresse e-mail</strong></li>
                ";
            }
            // line 19
            yield "            </ul>
            <p style=\"color:#6b7280;font-size:14px;margin-bottom:32px;\">
                Une fois ces étapes complétées, revenez sur ce lien pour finaliser la confirmation de votre numéro.
            </p>
            <a href=\"https://dressur.site\"
               style=\"display:inline-block;padding:14px 36px;background:#d97706;color:white;text-decoration:none;border-radius:8px;font-weight:bold;font-size:16px;margin-bottom:16px;\">
                Aller sur Dressur
            </a>
            <br>
            <a href=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["confirm_url"] ?? null), "html", null, true);
            yield "\"
               style=\"display:inline-block;margin-top:12px;padding:12px 28px;background:white;color:#92400e;text-decoration:none;border-radius:8px;font-weight:bold;font-size:15px;border:2px solid #fcd34d;\">
                ↩ Relancer la confirmation
            </a>
        </div>

    ";
        } elseif ((        // line 34
($context["status"] ?? null) == "success")) {
            // line 35
            yield "        <div style=\"background:#d1fae5;border:1px solid #6ee7b7;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">✅</div>
            <h1 style=\"color:#065f46;font-size:24px;margin-bottom:12px;\">Numéro confirmé !</h1>
            <p style=\"color:#047857;margin-bottom:32px;\">";
            // line 38
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
        } elseif ((        // line 48
($context["status"] ?? null) == "already")) {
            // line 49
            yield "        <div style=\"background:#eff6ff;border:1px solid #93c5fd;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">ℹ️</div>
            <h1 style=\"color:#1e40af;font-size:24px;margin-bottom:12px;\">Déjà confirmé</h1>
            <p style=\"color:#1d4ed8;margin-bottom:32px;\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
            yield "</p>
            <a href=\"https://dressur.site\"
               style=\"display:inline-block;padding:14px 36px;background:#2563eb;color:white;text-decoration:none;border-radius:8px;font-weight:bold;font-size:16px;\">
                Retourner sur Dressur
            </a>
        </div>

    ";
        } else {
            // line 60
            yield "        <div style=\"background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:48px 32px;\">
            <div style=\"font-size:64px;margin-bottom:16px;\">❌</div>
            <h1 style=\"color:#991b1b;font-size:24px;margin-bottom:12px;\">Lien invalide</h1>
            <p style=\"color:#dc2626;margin-bottom:32px;\">";
            // line 63
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
        // line 73
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
        return "confirm_tel/index.html.twig";
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
        return array (  167 => 73,  154 => 63,  149 => 60,  138 => 52,  133 => 49,  131 => 48,  118 => 38,  113 => 35,  111 => 34,  102 => 28,  91 => 19,  87 => 17,  85 => 16,  76 => 9,  74 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "confirm_tel/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/confirm_tel/index.html.twig");
    }
}
