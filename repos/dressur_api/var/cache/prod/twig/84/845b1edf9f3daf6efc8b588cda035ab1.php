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

/* crud_formule_promo_reseau/index.html.twig */
class __TwigTemplate_c26e1d50f2996b8a3f9bb714ec8e3d7a extends Template
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
        yield "FormulePromoReseau index";
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
        yield "    <span class=\"h4 me-3\">FormulePromoReseau index</span>
    <a class=\"btn btn-sm btn-warning h4\" href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_available");
        yield "\">Available</a>
    <a class=\"btn btn-sm btn-primary h4 ms-1\" href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_new");
        yield "\">Create new</a>
    <a class=\"btn btn-sm btn-danger h4 ms-1\" href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_service_description");
        yield "\">Service + Description</a>

    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 11));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 12
            yield "        <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield "\">
            ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 14
                yield "                <p>";
                yield $context["message"];
                yield "</p>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            yield "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        yield "

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id.Zef</th>
                    <th>Titre</th>
                    <th>Descp</th>
                    <th>Prix DS</th>
                    <th>Prix VD</th>
                    <th>Prix ZF</th>
                    <th>QteMin</th>
                    <th>QteMax</th>
                    <th>Qte</th>
                    <th>Activ.</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formule_promo_reseaus"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["formule_promo_reseau"]) {
            // line 40
            yield "                <tr>
                    <td>";
            // line 41
            yield from $this->load("crud_formule_promo_reseau/_delete_form.html.twig", 41)->unwrap()->yield($context);
            yield "</td>
                    <td>";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "idZefame", [], "any", false, false, false, 42), "html", null, true);
            yield "</td>
                    <td>
                        ";
            // line 44
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "parent", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 45
                yield "                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "parent", [], "any", false, false, false, 45), "titre", [], "any", false, false, false, 45), "html", null, true);
                yield " 
                        ";
            }
            // line 47
            yield "                        ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "titre", [], "any", false, false, false, 47), "html", null, true);
            yield "
                    </td>
                    <td class=\"text-center\">
                        ";
            // line 50
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "description", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 51
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 53
                yield "                            <span class=\"badge bg-danger\">No</span>
                        ";
            }
            // line 55
            yield "                    </td>
                    <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "prix", [], "any", false, false, false, 56), "html", null, true);
            yield "</td>
                    <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "prixVendeur", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                    <td>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "prixZefame", [], "any", false, false, false, 58), "html", null, true);
            yield "</td>
                    <td>";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "qteMin", [], "any", false, false, false, 59), "html", null, true);
            yield "</td>
                    <td>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "qteMax", [], "any", false, false, false, 60), "html", null, true);
            yield "</td>
                    <td>";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "qte", [], "any", false, false, false, 61), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">";
            // line 62
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "available", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "</td>
                    <td>";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formule_promo_reseau"], "id", [], "any", false, false, false, 63), "html", null, true);
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
        // line 65
        if (!$context['_iterated']) {
            // line 66
            yield "                <tr>
                    <td colspan=\"11\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['formule_promo_reseau'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
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
        return "crud_formule_promo_reseau/index.html.twig";
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
        return array (  250 => 70,  241 => 66,  239 => 65,  224 => 63,  220 => 62,  216 => 61,  212 => 60,  208 => 59,  204 => 58,  200 => 57,  196 => 56,  193 => 55,  189 => 53,  185 => 51,  183 => 50,  176 => 47,  170 => 45,  168 => 44,  163 => 42,  159 => 41,  156 => 40,  138 => 39,  115 => 18,  108 => 16,  99 => 14,  95 => 13,  90 => 12,  86 => 11,  81 => 9,  77 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_promo_reseau/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_promo_reseau/index.html.twig");
    }
}
