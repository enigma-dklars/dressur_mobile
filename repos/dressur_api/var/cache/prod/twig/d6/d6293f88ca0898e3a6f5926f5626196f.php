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

/* crud_methode_paiement/index.html.twig */
class __TwigTemplate_e25ed0b1bd3319f21a0d869f23a937d9 extends Template
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
        yield "MethodePaiement index";
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
        <div class=\"col-6\"><p class=\"h4 me-3\">Methode Paiement</p></div>
        <div class=\"col-6 text-end\"><a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_methode_paiement_new");
        yield "\" class=\"btn btn-sm btn-primary\">Create new</a></div>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>C.P</th>
                    <th>Pays</th>
                    <th>Titre</th>
                    <th>Code</th>
                    <th>Aggreg.</th>
                    <th>Type</th>
                    <th>Activ.</th>
                    <th>Isdirect</th>
                    <th>Requires</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["methode_paiements"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["methode_paiement"]) {
            // line 30
            yield "                <tr>
                    <td>
                        ";
            // line 32
            yield Twig\Extension\CoreExtension::include($this->env, $context, "crud_methode_paiement/_delete_form.html.twig");
            yield "
                    </td>
                    <td>";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "id", [], "any", false, false, false, 34), "html", null, true);
            yield "</td>
                    <td>";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "codePays", [], "any", false, false, false, 35), "html", null, true);
            yield "</td>
                    <td>";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "pays", [], "any", false, false, false, 36), "html", null, true);
            yield "</td>
                    <td>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "titre", [], "any", false, false, false, 37), "html", null, true);
            yield "</td>
                    <td>";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "code", [], "any", false, false, false, 38), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 40
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "aggregator", [], "any", false, false, false, 40) == "FeexPay")) {
                // line 41
                yield "                            <span class=\"badge bg-orange\">FeexPay</span>
                        ";
            }
            // line 43
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "aggregator", [], "any", false, false, false, 43) == "FedaPay")) {
                // line 44
                yield "                            <span class=\"badge bg-primary\">FedaPay</span>
                        ";
            }
            // line 46
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "aggregator", [], "any", false, false, false, 46) == "KPay")) {
                // line 47
                yield "                            <span class=\"badge bg-dark\">KPay</span>
                        ";
            }
            // line 49
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 51
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "typeFeexPay", [], "any", false, false, false, 51) == "paiementLocal")) {
                // line 52
                yield "                            <span class=\"badge bg-success\">Local</span>
                        ";
            }
            // line 54
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "typeFeexPay", [], "any", false, false, false, 54) == "requestToPayWeb")) {
                // line 55
                yield "                            <span class=\"badge bg-primary\">Pay Web</span>
                        ";
            }
            // line 57
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "typeFeexPay", [], "any", false, false, false, 57) == "paiementCard")) {
                // line 58
                yield "                            <span class=\"badge bg-danger\">Card</span>
                        ";
            }
            // line 60
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 62
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "activated", [], "any", false, false, false, 62) == true)) {
                // line 63
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 65
                yield "                            <span class=\"badge bg-danger\">No</span>
                        ";
            }
            // line 67
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 69
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "isdirect", [], "any", false, false, false, 69) == true)) {
                // line 70
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 72
                yield "                            <span class=\"badge bg-danger\">No</span>
                        ";
            }
            // line 74
            yield "                    </td>
                    <td>";
            // line 75
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "requires", [], "any", false, false, false, 75)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(CoreExtension::getAttribute($this->env, $this->source, $context["methode_paiement"], "requires", [], "any", false, false, false, 75), ", "), "html", null, true)) : (""));
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
        // line 77
        if (!$context['_iterated']) {
            // line 78
            yield "                <tr>
                    <td colspan=\"9\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['methode_paiement'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
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
        return "crud_methode_paiement/index.html.twig";
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
        return array (  247 => 82,  238 => 78,  236 => 77,  221 => 75,  218 => 74,  214 => 72,  210 => 70,  208 => 69,  204 => 67,  200 => 65,  196 => 63,  194 => 62,  190 => 60,  186 => 58,  183 => 57,  179 => 55,  176 => 54,  172 => 52,  170 => 51,  166 => 49,  162 => 47,  159 => 46,  155 => 44,  152 => 43,  148 => 41,  146 => 40,  141 => 38,  137 => 37,  133 => 36,  129 => 35,  125 => 34,  120 => 32,  116 => 30,  98 => 29,  74 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_methode_paiement/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_methode_paiement/index.html.twig");
    }
}
