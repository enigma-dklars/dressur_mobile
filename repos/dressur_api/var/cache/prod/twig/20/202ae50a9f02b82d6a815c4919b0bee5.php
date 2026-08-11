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

/* crud_promotion/_delete_form.html.twig */
class __TwigTemplate_3058347a9d15b19bfa18b2940cada6d2 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<form method=\"post\" action=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 1)]), "html", null, true);
        yield "\" onsubmit=\"return confirm(\x27Are you sure you want to delete this item?\x27);\">
    <input type=\"hidden\" name=\"_token\" value=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 2))), "html", null, true);
        yield "\">
    <input type=\"hidden\" value=\"";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_accepter", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 3)]), "html", null, true);
        yield "\" id=\"accepter_";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 3), "html", null, true);
        yield "\">
    <input type=\"hidden\" value=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_refuser", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 4)]), "html", null, true);
        yield "\" id=\"refuser_";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 4), "html", null, true);
        yield "\">

    <a href=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 6)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-info\">Show</a>
    <a href=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 7)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success\">Edit</a>
    <button class=\"btn btn-sm btn-danger\">Delete</button>
    <span data-bs-toggle=\"modal\" data-bs-target=\"#modal_promotion_";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 9), "html", null, true);
        yield "\" class=\"btn btn-sm btn-primary\">More</span>
    ";
        // line 10
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "status", [], "any", false, false, false, 10) == 1)) {
            // line 11
            yield "        <span type=\"button\" class=\"btn btn-sm btn-success accepterPromoAffaire\" id_promo_affaire=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 11), "html", null, true);
            yield "\">Accepter</span>
        <span type=\"button\" class=\"btn btn-sm btn-danger refuserPromoAffaire\" id_promo_affaire=\"";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 12), "html", null, true);
            yield "\">Refuser</span>
    ";
        }
        // line 14
        yield "</form>

<div class=\"modal fade\" id=\"modal_promotion_";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 16), "html", null, true);
        yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-lg modal-dialog-scrollable\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <!-- Utiliser `table-responsive` pour la table -->
                <div class=\"table-responsive\">
                    <table class=\"table table-striped table-bordered\">
                        <tr>
                            <td width=\"1\">Motif</td>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "motif", [], "any", false, false, false, 25), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Id</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "id", [], "any", false, false, false, 29), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\"><img src=\"/promotion/";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "image", [], "any", false, false, false, 33), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"\" srcset=\"\"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 37
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "description", [], "any", false, false, false, 37), "html", null, true));
        yield "</td>
                        </tr>
                        <tr>
                            <th>DateDebut</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 41
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateDebut", [], "any", false, false, false, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateDebut", [], "any", false, false, false, 41), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
                        </tr>
                        <tr>
                            <th>DateExp</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 45
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateExp", [], "any", false, false, false, 45)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "dateExp", [], "any", false, false, false, 45), "Y-m-d H:i:s"), "html", null, true)) : (""));
        yield "</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "status", [], "any", false, false, false, 49), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>NombreDeVue</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nombreDeVue", [], "any", false, false, false, 53), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Mode</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "mode", [], "any", false, false, false, 57), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>NombreImpression</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "nombreImpression", [], "any", false, false, false, 61), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Limited</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 65
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "limited", [], "any", false, false, false, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td>
                        </tr>
                        <tr>
                            <th>WhoSaw</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 69
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "whoSaw", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "whoSaw", [], "any", false, false, false, 69)), "html", null, true)) : (""));
        yield "</td>
                        </tr>
                        <tr>
                            <th>IsFakeVue</th>
                            <td style=\"word-wrap: break-word; white-space: normal;\">";
        // line 73
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "isFakeVue", [], "any", false, false, false, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Yes") : ("No"));
        yield "</td>
                        </tr>
                        ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["promotion"] ?? null), "annotherInfo", [], "any", false, false, false, 75));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 76
            yield "                            <tr>
                                <td width=\"1\">";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "</td>
                                <td style=\"word-wrap: break-word; white-space: normal;\">";
            // line 78
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true));
            yield "</td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['value'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        yield "                    </table>
                </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
            </div>
        </div>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_promotion/_delete_form.html.twig";
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
        return array (  214 => 81,  205 => 78,  201 => 77,  198 => 76,  194 => 75,  189 => 73,  182 => 69,  175 => 65,  168 => 61,  161 => 57,  154 => 53,  147 => 49,  140 => 45,  133 => 41,  126 => 37,  119 => 33,  112 => 29,  105 => 25,  93 => 16,  89 => 14,  84 => 12,  79 => 11,  77 => 10,  73 => 9,  68 => 7,  64 => 6,  57 => 4,  51 => 3,  47 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_promotion/_delete_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_promotion/_delete_form.html.twig");
    }
}
