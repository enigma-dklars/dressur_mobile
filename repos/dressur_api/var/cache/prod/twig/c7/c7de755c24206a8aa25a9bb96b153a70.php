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

/* crud_env_paiement_api/index.html.twig */
class __TwigTemplate_bc60ae42d0340552ba618d3496b3243b extends Template
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
        yield "EnvPaiementApi index";
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
        yield "    <div class=\"row g-2 mb-2\">
        <div class=\"col-md-6\">
            <span class=\"h4 me-3\">EnvPaiementApi index</span>
            <a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_env_paiement_api_new");
        yield "\">Create new</a>
        </div>
        <div class=\"col-md-6 text-end\">
            <a class=\"btn btn-sm btn-danger h4\" href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_env_paiement_api_remise_zero");
        yield "\">Remise à zéro</a>
        </div>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Count.TA</th>
                    <th>Activ.</th>
                    <th>Aggregator</th>
                    <th>Account</th>
                    <th>Link</th>
                    <th>ApiKey</th>
                    <th>Environment</th>
                    <th>EndpointSecret</th>
                    <th>RouteWebhook</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["env_paiement_apis"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["env_paiement_api"]) {
            // line 35
            yield "                <tr>
                    <td>
                        ";
            // line 37
            yield from $this->load("crud_env_paiement_api/_delete_form.html.twig", 37)->unwrap()->yield($context);
            // line 38
            yield "                    </td>
                    <td>";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "id", [], "any", false, false, false, 39), "html", null, true);
            yield "</td>
                    <td>";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "countTransactionApproved", [], "any", false, false, false, 40), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 42
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "activated", [], "any", false, false, false, 42)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 43
                yield "                            <span class=\"badge bg-success\">Oui</span>
                        ";
            } else {
                // line 45
                yield "                            <span class=\"badge bg-danger\">Non</span>
                        ";
            }
            // line 47
            yield "                    </td>
                    <td>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "aggregator", [], "any", false, false, false, 48), "html", null, true);
            yield "</td>
                    <td>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "accountName", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "linkPaiement", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 52
                yield "                            <a class=\"badge bg-primary text-white\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "linkPaiement", [], "any", false, false, false, 52), "html", null, true);
                yield "\" target=\"_blank\">Open</a>
                        ";
            }
            // line 54
            yield "                    </td>
                    <td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "apiKey", [], "any", false, false, false, 55), "html", null, true);
            yield "</td>
                    <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "environment", [], "any", false, false, false, 56), "html", null, true);
            yield "</td>
                    <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "endpointSecret", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                    <td>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_paiement_api"], "routeWebhook", [], "any", false, false, false, 58), "html", null, true);
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
        // line 60
        if (!$context['_iterated']) {
            // line 61
            yield "                <tr>
                    <td colspan=\"8\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['env_paiement_api'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        yield "            </tbody>
        </table>
    </div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_env_paiement_api/index.html.twig";
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
        return array (  213 => 65,  204 => 61,  202 => 60,  187 => 58,  183 => 57,  179 => 56,  175 => 55,  172 => 54,  166 => 52,  164 => 51,  159 => 49,  155 => 48,  152 => 47,  148 => 45,  144 => 43,  142 => 42,  137 => 40,  133 => 39,  130 => 38,  128 => 37,  124 => 35,  106 => 34,  81 => 12,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_env_paiement_api/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_env_paiement_api/index.html.twig");
    }
}
