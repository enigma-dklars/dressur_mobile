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

/* preuve/index.html.twig */
class __TwigTemplate_9c93ac88ffb653076e404f8f53e0ae69 extends Template
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
        yield "Preuve index
";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "\t<div class=\"\">
\t\t<div class=\"row mb-3 align-items-center\">
\t\t\t<div class=\"col-md-6\">
\t\t\t\t<p class=\"h4 me-3\">Liste des Preuves</p>
\t\t\t</div>
\t\t\t<div class=\"col-md-6 text-end\">
\t\t\t\t<a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_preuve_new");
        yield "\" class=\"btn btn-primary\">Nouvelle preuve</a>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"table-responsive\">
            <table class=\"data-table table table-bordered table-striped\">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Id</th>
                        <th>User</th>
                        <th>Historique</th>
                        <th>Capture Liste</th>
                        <th>Capture Ouvert</th>
                        <th>Traitée</th>
                        <th>Créé le</th>
                        <th>Modifié le</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["preuves"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["preuve"]) {
            // line 34
            yield "                        <tr>
                            <td>
                                ";
            // line 36
            yield from $this->load("preuve/_delete_form.html.twig", 36)->unwrap()->yield(CoreExtension::merge($context, ["preuve" => $context["preuve"]]));
            // line 37
            yield "                            </td>

                            <td>";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "id", [], "any", false, false, false, 39), "html", null, true);
            yield "</td>

                            <!-- USER -->
                            <td>
                                ";
            // line 43
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "user", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 44
                yield "                                    <span class=\"badge bg-primary\">
                                        ";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "user", [], "any", false, false, false, 45), "pseudo", [], "any", false, false, false, 45), "html", null, true);
                yield "
                                    </span>
                                ";
            } else {
                // line 48
                yield "                                    <span class=\"badge bg-danger\">Aucun user</span>
                                ";
            }
            // line 50
            yield "                            </td>

                            <!-- HISTORIQUE -->
                            <td>
                                ";
            // line 54
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "historiqueProgrammeRecompense", [], "any", false, false, false, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 55
                yield "                                    <span class=\"badge bg-info\">
                                        #";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "historiqueProgrammeRecompense", [], "any", false, false, false, 56), "id", [], "any", false, false, false, 56), "html", null, true);
                yield "
                                    </span>
                                ";
            } else {
                // line 59
                yield "                                    <span class=\"badge bg-secondary\">Non lié</span>
                                ";
            }
            // line 61
            yield "                            </td>

                            <!-- IMAGE 1 -->
                            <td class=\"text-center\">
                                ";
            // line 65
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureListeStatut", [], "any", false, false, false, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 66
                yield "                                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureListeStatut", [], "any", false, false, false, 66))), "html", null, true);
                yield "\" target=\"_blank\">
                                        <img src=\"";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureListeStatut", [], "any", false, false, false, 67))), "html", null, true);
                yield "\" class=\"img-fluid rounded\" style=\"max-width:100px;\">
                                    </a>
                                ";
            } else {
                // line 70
                yield "                                    <span class=\"badge bg-danger\">Non fourni</span>
                                ";
            }
            // line 72
            yield "                            </td>

                            <!-- IMAGE 2 -->
                            <td class=\"text-center\">
                                ";
            // line 76
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureStatutOuvert", [], "any", false, false, false, 76)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 77
                yield "                                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureStatutOuvert", [], "any", false, false, false, 77))), "html", null, true);
                yield "\" target=\"_blank\">
                                        <img src=\"";
                // line 78
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("preuve_recompense/" . CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "captureStatutOuvert", [], "any", false, false, false, 78))), "html", null, true);
                yield "\" class=\"img-fluid rounded\" style=\"max-width:100px;\">
                                    </a>
                                ";
            } else {
                // line 81
                yield "                                    <span class=\"badge bg-danger\">Non fourni</span>
                                ";
            }
            // line 83
            yield "                            </td>

                            <!-- IS TREATED -->
                            <td class=\"text-center\">
                                ";
            // line 87
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "isTreated", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 88
                yield "                                    <span class=\"badge bg-success\">Traitée</span>
                                ";
            } else {
                // line 90
                yield "                                    <span class=\"badge bg-warning text-dark\">En attente</span>
                                ";
            }
            // line 92
            yield "                            </td>

                            <td>";
            // line 94
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "createdAt", [], "any", false, false, false, 94)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "createdAt", [], "any", false, false, false, 94), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                            <td>";
            // line 95
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "updatedAt", [], "any", false, false, false, 95)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["preuve"], "updatedAt", [], "any", false, false, false, 95), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>

                        </tr>
                    ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 98
        if (!$context['_iterated']) {
            // line 99
            yield "                        <tr>
                            <td colspan=\"9\" class=\"text-center\">Aucun enregistrement trouvé</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['preuve'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        yield "                </tbody>
            </table>
        </div>
\t</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "preuve/index.html.twig";
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
        return array (  270 => 103,  261 => 99,  259 => 98,  243 => 95,  239 => 94,  235 => 92,  231 => 90,  227 => 88,  225 => 87,  219 => 83,  215 => 81,  209 => 78,  204 => 77,  202 => 76,  196 => 72,  192 => 70,  186 => 67,  181 => 66,  179 => 65,  173 => 61,  169 => 59,  163 => 56,  160 => 55,  158 => 54,  152 => 50,  148 => 48,  142 => 45,  139 => 44,  137 => 43,  130 => 39,  126 => 37,  124 => 36,  120 => 34,  102 => 33,  79 => 13,  71 => 7,  64 => 6,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "preuve/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/preuve/index.html.twig");
    }
}
