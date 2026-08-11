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

/* crud_user/users-inutiles.html.twig */
class __TwigTemplate_95da92651e8be35e2ab9a5ef78e585e0 extends Template
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
        yield "User : ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["option"] ?? null), "html", null, true);
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
        <div class=\"col-6\"><p class=\"h4 me-3\">User : ";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["option"] ?? null), "html", null, true);
        yield "</p></div>
    </div>
    ";
        // line 10
        yield "
    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Pseudo</th>
                    <th>Tel</th>
                    <th>Tel V.</th>
                    <th>Mail</th>
                    <th>Mail V.</th>
                    <th>N.C</th>
                    <th>B.C</th>
                    <th>P.A</th>
                    <th>P.R</th>
                    <th>C.M</th>
                    <th>Lock</th>
                    <th>LastLoginTo</th>
                    <th>CreatedAt</th>
                    <th>Uid</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 34
        $context["id_users"] = [];
        // line 35
        yield "            
            ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 37
            yield "                ";
            $context["id_users"] = Twig\Extension\CoreExtension::merge(($context["id_users"] ?? null), [CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 37)]);
            // line 38
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        yield "
            ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 41
            yield "                ";
            $context["lesContactsDuUser"] = [];
            // line 42
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["user"], "contact", [], "any", false, false, false, 42), "whoIAdd", [], "any", false, false, false, 42));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 43
                yield "                    ";
                if (CoreExtension::inFilter($context["item"], ($context["id_users"] ?? null))) {
                    // line 44
                    yield "                        ";
                    if (!CoreExtension::inFilter($context["item"], ($context["lesContactsDuUser"] ?? null))) {
                        // line 45
                        yield "                            ";
                        $context["lesContactsDuUser"] = Twig\Extension\CoreExtension::merge(($context["lesContactsDuUser"] ?? null), [$context["item"]]);
                        // line 46
                        yield "                        ";
                    }
                    // line 47
                    yield "                    ";
                }
                // line 48
                yield "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["user"], "contact", [], "any", false, false, false, 49), "whoAddMe", [], "any", false, false, false, 49));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 50
                yield "                    ";
                if (CoreExtension::inFilter($context["item"], ($context["id_users"] ?? null))) {
                    // line 51
                    yield "                        ";
                    if (!CoreExtension::inFilter($context["item"], ($context["lesContactsDuUser"] ?? null))) {
                        // line 52
                        yield "                            ";
                        $context["lesContactsDuUser"] = Twig\Extension\CoreExtension::merge(($context["lesContactsDuUser"] ?? null), [$context["item"]]);
                        // line 53
                        yield "                        ";
                    }
                    // line 54
                    yield "                    ";
                }
                // line 55
                yield "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            yield "                ";
            if (((((((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "boosts", [], "any", false, false, false, 56)) == 0) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "promotions", [], "any", false, false, false, 56)) == 0)) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "promoReseaus", [], "any", false, false, false, 56)) == 0)) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "campagneMails", [], "any", false, false, false, 56)) == 0)) && (CoreExtension::getAttribute($this->env, $this->source, $context["user"], "mailIsVerified", [], "any", false, false, false, 56) == false)) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["lesContactsDuUser"] ?? null)) < 2))) {
                // line 57
                yield "                    <tr>
                        <td>";
                // line 58
                yield from $this->load("crud_user/_delete_form.html.twig", 58)->unwrap()->yield($context);
                yield "</td>
                        <td>
                            ";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "pseudo", [], "any", false, false, false, 60), "html", null, true);
                yield "
                        </td>
                        <td>";
                // line 62
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "tel", [], "any", false, false, false, 62), "html", null, true);
                yield "</td>
                        <td class=\"text-center\">
                            ";
                // line 64
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "telIsVerified", [], "any", false, false, false, 64) == true)) {
                    // line 65
                    yield "                                <span class=\"badge bg-success\">Yes</span>
                            ";
                } else {
                    // line 67
                    yield "                                <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerTel", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 67)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation du numéro WhatsApp ?\x27)\">
                                    <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_tel" . CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 68))), "html", null, true);
                    yield "\">
                                    <button type=\"submit\" class=\"text-white badge bg-danger border-0\">Activer</button>
                                </form>
                            ";
                }
                // line 72
                yield "                        </td>
                        <td class=\"small\">";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "mail", [], "any", false, false, false, 73), "html", null, true);
                yield "</td>
                        <td class=\"text-center\">
                            ";
                // line 75
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "mailIsVerified", [], "any", false, false, false, 75) == true)) {
                    // line 76
                    yield "                                <span class=\"badge bg-success\">Yes</span>
                            ";
                } else {
                    // line 78
                    yield "                                <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerMail", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 78)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation de l\\\x27adresse mail ?\x27)\">
                                    <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 79
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_mail" . CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 79))), "html", null, true);
                    yield "\">
                                    <button type=\"submit\" class=\"text-white badge bg-danger border-0\">Activer</button>
                                </form>
                            ";
                }
                // line 83
                yield "                        </td>
                        <td class=\"text-end\">
                            ";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["lesContactsDuUser"] ?? null)), "html", null, true);
                yield "
                        </td>
                        <td class=\"text-end\">";
                // line 87
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "boosts", [], "any", false, false, false, 87)), "html", null, true);
                yield "</td>
                        <td class=\"text-end\">";
                // line 88
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "promotions", [], "any", false, false, false, 88)), "html", null, true);
                yield "</td>
                        <td class=\"text-end\">";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "promoReseaus", [], "any", false, false, false, 89)), "html", null, true);
                yield "</td>
                        <td class=\"text-end\">";
                // line 90
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "campagneMails", [], "any", false, false, false, 90)), "html", null, true);
                yield "</td>
                        <td class=\"text-center\">
                            ";
                // line 92
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "blocked", [], "any", false, false, false, 92)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-danger\">Yes</span>") : ("<span class=\"badge bg-success\">No</span>"));
                yield "
                        </td>
                        <td>";
                // line 94
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "lastLoginTo", [], "any", false, false, false, 94)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "lastLoginTo", [], "any", false, false, false, 94), "Y-m-d H:i:s"), "html", null, true)) : (""));
                yield "</td>
                        <td>";
                // line 95
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 95)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 95), "Y-m-d H:i:s"), "html", null, true)) : (""));
                yield "</td>
                        <td>";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "uid", [], "any", false, false, false, 96), "html", null, true);
                yield "</td>
                        <td>";
                // line 97
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 97), "html", null, true);
                yield "</td>
                    </tr>
                ";
            }
            // line 100
            yield "            ";
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
        if (!$context['_iterated']) {
            // line 101
            yield "                <tr>
                    <td colspan=\"27\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
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
        return "crud_user/users-inutiles.html.twig";
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
        return array (  335 => 105,  326 => 101,  313 => 100,  307 => 97,  303 => 96,  299 => 95,  295 => 94,  290 => 92,  285 => 90,  281 => 89,  277 => 88,  273 => 87,  268 => 85,  264 => 83,  257 => 79,  252 => 78,  248 => 76,  246 => 75,  241 => 73,  238 => 72,  231 => 68,  226 => 67,  222 => 65,  220 => 64,  215 => 62,  210 => 60,  205 => 58,  202 => 57,  199 => 56,  193 => 55,  190 => 54,  187 => 53,  184 => 52,  181 => 51,  178 => 50,  173 => 49,  167 => 48,  164 => 47,  161 => 46,  158 => 45,  155 => 44,  152 => 43,  147 => 42,  144 => 41,  126 => 40,  123 => 39,  117 => 38,  114 => 37,  110 => 36,  107 => 35,  105 => 34,  79 => 10,  74 => 7,  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user/users-inutiles.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user/users-inutiles.html.twig");
    }
}
