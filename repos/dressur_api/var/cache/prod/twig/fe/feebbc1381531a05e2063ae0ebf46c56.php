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

/* crud_user_bot/index.html.twig */
class __TwigTemplate_9ddfd0fa236e1bb3c3abd2144d0d2a90 extends Template
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
        yield "UserBot index";
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
        yield "    <p class=\"h4 me-3\">UserBot index</p>
    ";
        // line 8
        yield "
    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Act.</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Numero</th>
                    <th>Sgn.</th>
                    <th>NbrMsg</th>
                    <th>UpdatedAt</th>
                    <th>ExpiratedAt</th>
                    <th>CreatedAt</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["user_bots"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["user_bot"]) {
            // line 28
            yield "                <tr>
                    <td>";
            // line 29
            yield from $this->load("crud_user_bot/_delete_form.html.twig", 29)->unwrap()->yield($context);
            yield "</td>
                    <td>";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "id", [], "any", false, false, false, 30), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 32
            if (($this->extensions['Twig\Extension\CoreExtension']->convertDate() > CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "expiratedAt", [], "any", false, false, false, 32))) {
                // line 33
                yield "                            <span class=\"badge bg-danger\">Non</span>
                        ";
            } else {
                // line 35
                yield "                            <span class=\"badge bg-success\">Oui</span>
                        ";
            }
            // line 37
            yield "                    </td>
                    <td>";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "nom", [], "any", false, false, false, 38), "html", null, true);
            yield "</td>
                    <td>";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "email", [], "any", false, false, false, 39), "html", null, true);
            yield "</td>
                    <td>";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "numero", [], "any", false, false, false, 40), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 42
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "signature", [], "any", false, false, false, 42) == "oui")) {
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
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "nbrMsgSent", [], "any", false, false, false, 48), "html", null, true);
            yield "</td>
                    <td>";
            // line 49
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "updatedAt", [], "any", false, false, false, 49)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "updatedAt", [], "any", false, false, false, 49), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 50
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "expiratedAt", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "expiratedAt", [], "any", false, false, false, 50), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 51
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "createdAt", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user_bot"], "createdAt", [], "any", false, false, false, 51), "Y-m-d H:i:s"), "html", null, true)) : (""));
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
        // line 53
        if (!$context['_iterated']) {
            // line 54
            yield "                <tr>
                    <td colspan=\"10\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user_bot'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
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
        return "crud_user_bot/index.html.twig";
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
        return array (  201 => 58,  192 => 54,  190 => 53,  175 => 51,  171 => 50,  167 => 49,  163 => 48,  160 => 47,  156 => 45,  152 => 43,  150 => 42,  145 => 40,  141 => 39,  137 => 38,  134 => 37,  130 => 35,  126 => 33,  124 => 32,  119 => 30,  115 => 29,  112 => 28,  94 => 27,  73 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user_bot/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user_bot/index.html.twig");
    }
}
