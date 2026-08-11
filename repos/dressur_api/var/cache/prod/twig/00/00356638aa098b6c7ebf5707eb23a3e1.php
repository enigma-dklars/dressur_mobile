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

/* private/listepromoreseau.html.twig */
class __TwigTemplate_8bc809d8dabe7eb7c923213b34873102 extends Template
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
        yield "Promo. Réseau";
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
        yield "<div class=\"row g-3\">
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listepromoreseau"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["promotion"]) {
            // line 8
            yield "        <div class=\"col-md-6\">
            <div class=\"card mb-0\">
                <div class=\"card-body\">
                    ";
            // line 11
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "statusNumber", [], "any", false, false, false, 11) == 0)) {
                $context["bgStatus"] = "bg-danger";
            }
            // line 12
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "statusNumber", [], "any", false, false, false, 12) == 1)) {
                $context["bgStatus"] = "bg-warning";
            }
            // line 13
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "statusNumber", [], "any", false, false, false, 13) == 2)) {
                $context["bgStatus"] = "bg-success";
            }
            // line 14
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "statusNumber", [], "any", false, false, false, 14) == 3)) {
                $context["bgStatus"] = "bg-success";
            }
            // line 15
            yield "                    <div class=\"d-flex justify-content-between\">
                        <div><span class=\"badge ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bgStatus"] ?? null), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "status", [], "any", false, false, false, 16), "html", null, true);
            yield "</span></div>
                        <h5 class=\"card-title\">";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "titre", [], "any", false, false, false, 17), "html", null, true);
            yield "</h5>
                    </div>
                    <div class=\"row g-1\">
                        <div class=\"col-md-6\">
                            <p><strong>Compteur Début:</strong> ";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "compteurDebut", [], "any", false, false, false, 21), "html", null, true);
            yield "</p>
                            <p><strong>Quantité Demandée:</strong> ";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "qteDemander", [], "any", false, false, false, 22), "html", null, true);
            yield "</p>
                            <p><strong>Référence:</strong> ";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "reference", [], "any", false, false, false, 23), "html", null, true);
            yield "</p>
                        </div>
                        <div class=\"col-md-6\">
                            <p><strong>Compteur Restant:</strong> ";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "compteurRestant", [], "any", false, false, false, 26), "html", null, true);
            yield "</p>
                            <p><strong>Prix Fixé:</strong> ";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "prixFixer", [], "any", false, false, false, 27), "html", null, true);
            yield "</p>
                            <p><strong>URL:</strong> <a href=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "url", [], "any", false, false, false, 28), "html", null, true);
            yield "\" target=\"_blank\">Cliquez ici URL</a></p>
                        </div>
                    </div>
                    <div class=\"d-flex justify-content-between\">
                        <small>Créé : ";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "createdAt", [], "any", false, false, false, 32), "html", null, true);
            yield "</small>
                        <small>Modifier : ";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promotion"], "updatedAt", [], "any", false, false, false, 33), "html", null, true);
            yield "</small>
                    </div>
                </div>
            </div>
        </div>
    ";
            $context['_iterated'] = true;
        }
        // line 38
        if (!$context['_iterated']) {
            // line 39
            yield "        <div class=\"alert alert-info text-center fw-semibold fs-6\">
            Aucune Promotion Réseau Sociaux trouvé.
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promotion'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        yield "</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/listepromoreseau.html.twig";
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
        return array (  172 => 43,  163 => 39,  161 => 38,  151 => 33,  147 => 32,  140 => 28,  136 => 27,  132 => 26,  126 => 23,  122 => 22,  118 => 21,  111 => 17,  105 => 16,  102 => 15,  97 => 14,  92 => 13,  87 => 12,  83 => 11,  78 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/listepromoreseau.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/listepromoreseau.html.twig");
    }
}
