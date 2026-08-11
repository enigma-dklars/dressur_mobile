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

/* crud_promotion/show.html.twig */
class __TwigTemplate_9f4ccebfbbe33ae27f2ddd2f22ac82bc extends Template
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
        return "baseAdmin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("baseAdmin.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Promotion";
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
        yield "    <h1>Promotion</h1>

    <table class=\"table table-bordered table-striped\">
        <tbody>
            <tr>
                <th>Id</th>
                <td>";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 12), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src=\"/assets/images/placeholder.png\" data-original=\"/promotion/";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "image", [], "any", false, false, false, 16), "html", null, true);
        yield "\" class=\"lazy card-img-top\" alt=\"\" srcset=\"\"></td>
            </tr>
            <tr>
                <th>Description</th>
                <td>";
        // line 20
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "description", [], "any", false, false, false, 20), "html", null, true));
        yield "</td>
            </tr>
            <tr>
                <th>DateDebut</th>
                <td>";
        // line 24
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateDebut", [], "any", false, false, false, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateDebut", [], "any", false, false, false, 24), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>DateExp</th>
                <td>";
        // line 28
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateExp", [], "any", false, false, false, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateExp", [], "any", false, false, false, 28), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "status", [], "any", false, false, false, 32), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>NombreDeVue</th>
                <td>";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nombreDeVue", [], "any", false, false, false, 36), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Mode</th>
                <td>";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "mode", [], "any", false, false, false, 40), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>NombreImpression</th>
                <td>";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nombreImpression", [], "any", false, false, false, 44), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Limited</th>
                <td>";
        // line 48
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "limited", [], "any", false, false, false, 48)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td>
            </tr>
            <tr>
                <th>WhoSaw</th>
                <td>";
        // line 52
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "whoSaw", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "whoSaw", [], "any", false, false, false, 52)), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>Motif (dernier)</th>
                <td>";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "motif", [], "any", false, false, false, 56), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>IsFakeVue</th>
                <td>";
        // line 60
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "isFakeVue", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td>
            </tr>
            ";
        // line 62
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "typePromotionAffaire", [], "any", false, false, false, 62) == "sites_applications")) {
            // line 63
            yield "            <tr>
                <th colspan=\"2\" class=\"table-info text-center fw-bold\">Sites &amp; Applications</th>
            </tr>
            <tr>
                <th>Nom</th>
                <td>";
            // line 68
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nomSiteApp", [], "any", true, true, false, 68) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nomSiteApp", [], "any", false, false, false, 68)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nomSiteApp", [], "any", false, false, false, 68), "html", null, true)) : ("—"));
            yield "</td>
            </tr>
            <tr>
                <th>Sous-type</th>
                <td>
                    ";
            // line 73
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 73) == "site_web")) {
                // line 74
                yield "                        <span class=\"badge bg-info\">Site web</span>
                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 75
($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 75) == "app_mobile")) {
                // line 76
                yield "                        <span class=\"badge bg-info\">App mobile</span>
                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 77
($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 77) == "logiciel_desktop")) {
                // line 78
                yield "                        <span class=\"badge bg-info\">Logiciel / Desktop</span>
                    ";
            } else {
                // line 80
                yield "                        ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", true, true, false, 80) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 80)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "sousTypeSiteApp", [], "any", false, false, false, 80), "html", null, true)) : ("—"));
                yield "
                    ";
            }
            // line 82
            yield "                </td>
            </tr>
            <tr>
                <th>URL</th>
                <td>
                    ";
            // line 87
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "urlSiteApp", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 88
                yield "                        <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "urlSiteApp", [], "any", false, false, false, 88), "html", null, true);
                yield "\" target=\"_blank\" rel=\"noopener noreferrer\">
                            ";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "urlSiteApp", [], "any", false, false, false, 89), "html", null, true);
                yield "
                            <i class=\"fas fa-external-link-alt ms-1 small\"></i>
                        </a>
                    ";
            } else {
                // line 93
                yield "                        —
                    ";
            }
            // line 95
            yield "                </td>
            </tr>
            <tr>
                <th>Prix</th>
                <td><strong>7 750 FCFA / an</strong></td>
            </tr>
            ";
        }
        // line 102
        yield "        </tbody>
    </table>

    <h2 class=\"mt-4\">Historique des refus</h2>
    ";
        // line 106
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "motifsRefus", [], "any", false, false, false, 106)) == 0)) {
            // line 107
            yield "        <p class=\"text-muted\">Aucun refus enregistré.</p>
    ";
        } else {
            // line 109
            yield "        <ol>
            ";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::sort($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "motifsRefus", [], "any", false, false, false, 110), function ($__a__, $__b__) use ($context, $macros) { $context["a"] = $__a__; $context["b"] = $__b__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["b"] ?? null), "dateRefus", [], "any", false, false, false, 110) <=> CoreExtension::getAttribute($this->env, $this->source, ($context["a"] ?? null), "dateRefus", [], "any", false, false, false, 110)); }));
            foreach ($context['_seq'] as $context["_key"] => $context["motifEntry"]) {
                // line 111
                yield "                <li class=\"mb-2\">
                    <strong>";
                // line 112
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["motifEntry"], "dateRefus", [], "any", false, false, false, 112), "d/m/Y à H:i"), "html", null, true);
                yield "</strong><br>
                    ";
                // line 113
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["motifEntry"], "motif", [], "any", false, false, false, 113), "html", null, true);
                yield "
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['motifEntry'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            yield "        </ol>
    ";
        }
        // line 118
        yield "
    ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_promotion/show.html.twig";
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
        return array (  279 => 118,  275 => 116,  266 => 113,  262 => 112,  259 => 111,  255 => 110,  252 => 109,  248 => 107,  246 => 106,  240 => 102,  231 => 95,  227 => 93,  220 => 89,  215 => 88,  213 => 87,  206 => 82,  200 => 80,  196 => 78,  194 => 77,  191 => 76,  189 => 75,  186 => 74,  184 => 73,  176 => 68,  169 => 63,  167 => 62,  162 => 60,  155 => 56,  148 => 52,  141 => 48,  134 => 44,  127 => 40,  120 => 36,  113 => 32,  106 => 28,  99 => 24,  92 => 20,  85 => 16,  78 => 12,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_promotion/show.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_promotion/show.html.twig");
    }
}
