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

/* communication_mail/prospect_list.html.twig */
class __TwigTemplate_294804eb0beebe6b24aea88187a698ae extends Template
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
        yield "Communication Mail — Adresses en base";
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
        yield "
<div class=\"d-flex align-items-center mb-3\">
    <h4 class=\"mb-0\"><i class=\"fas fa-database me-2 text-primary\"></i>Adresses mail en base</h4>
    <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"btn btn-sm btn-outline-secondary ms-auto\">
        <i class=\"fas fa-arrow-left me-1\"></i>Retour au portail
    </a>
</div>

";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 14));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 15
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 16
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
            ";
                // line 17
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        yield "
<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"data-table table table-bordered table-striped mb-0\" data-order=\x27[[0,\"desc\"]]\x27>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Adresse mail</th>
                    <th>Ajoutée le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["prospects"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["prospect"]) {
            // line 36
            yield "                <tr>
                    <td>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prospect"], "id", [], "any", false, false, false, 37), "html", null, true);
            yield "</td>
                    <td class=\"font-monospace\">";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["prospect"], "email", [], "any", false, false, false, 38), "html", null, true);
            yield "</td>
                    <td class=\"small\">";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["prospect"], "createdAt", [], "any", false, false, false, 39), "d/m/Y H:i"), "html", null, true);
            yield "</td>
                    <td>
                        <form method=\"post\" action=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_prospect_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["prospect"], "id", [], "any", false, false, false, 41)]), "html", null, true);
            yield "\"
                              onsubmit=\"return confirm(\x27Supprimer cette adresse de la base ?\x27)\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["prospect"], "id", [], "any", false, false, false, 43))), "html", null, true);
            yield "\">
                            <button type=\"submit\" class=\"btn btn-sm btn-outline-danger\">
                                <i class=\"fas fa-trash\"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 50
        if (!$context['_iterated']) {
            // line 51
            yield "                <tr>
                    <td colspan=\"4\" class=\"text-center text-muted py-4\">Aucune adresse enregistrée.</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['prospect'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "            </tbody>
        </table>
    </div>
    ";
        // line 58
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["prospects"] ?? null)) > 0)) {
            // line 59
            yield "    <div class=\"card-footer text-muted small\">
        ";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["prospects"] ?? null)), "html", null, true);
            yield " adresse(s) en base
    </div>
    ";
        }
        // line 63
        yield "</div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "communication_mail/prospect_list.html.twig";
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
        return array (  191 => 63,  185 => 60,  182 => 59,  180 => 58,  175 => 55,  166 => 51,  164 => 50,  152 => 43,  147 => 41,  142 => 39,  138 => 38,  134 => 37,  131 => 36,  126 => 35,  111 => 22,  97 => 17,  92 => 16,  87 => 15,  83 => 14,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/prospect_list.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/prospect_list.html.twig");
    }
}
