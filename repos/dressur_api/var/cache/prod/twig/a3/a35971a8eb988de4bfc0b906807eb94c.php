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

/* communication_mail/campagne_prospect.html.twig */
class __TwigTemplate_a7cad1170c98391b5ace0ab018307e34 extends Template
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
        yield "Campagne — Attirer de nouveaux utilisateurs";
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
    <h4 class=\"mb-0\"><i class=\"fas fa-paper-plane me-2 text-primary\"></i>Attirer de nouveaux utilisateurs</h4>
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
<div class=\"row g-4\">

    ";
        // line 26
        yield "    <div class=\"col-md-5\">
        <div class=\"card h-100\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fas fa-at me-1\"></i>Adresses destinataires
            </div>
            <div class=\"card-body\">

                <form method=\"post\" action=\"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_prospect");
        yield "\">

                    <div class=\"mb-3\">
                        <label class=\"form-label small fw-semibold\">Sujet du mail</label>
                        <p class=\"mb-0 border rounded px-2 py-2 small fw-semibold\">";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sujet"] ?? null), "html", null, true);
        yield "</p>
                    </div>

                    <div class=\"mb-3\">
                        <label class=\"form-label small fw-semibold\">Reply-to</label>
                        <p class=\"mb-0 border rounded px-2 py-2 small font-monospace\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["replyto"] ?? null), "html", null, true);
        yield "</p>
                    </div>

                    <div class=\"mb-3\">
                        <label for=\"emails\" class=\"form-label fw-semibold\">
                            Adresses mail <span class=\"text-danger\">*</span>
                        </label>
                        <textarea
                            id=\"emails\"
                            name=\"emails\"
                            class=\"form-control font-monospace\"
                            rows=\"10\"
                            placeholder=\"exemple@mail.com, autre@mail.com&#10;encore@mail.com\"
                            required
                        ></textarea>
                        <div class=\"form-text\">
                            Séparateurs : virgule, point-virgule, espace, retour à la ligne.<br>
                            Doublons et adresses invalides ignorés automatiquement.<br>
                            Chaque adresse est conservée dans la base de prospects.
                        </div>
                    </div>

                    <div class=\"d-grid\">
                        <button type=\"submit\" class=\"btn btn-primary\">
                            <i class=\"fas fa-paper-plane me-1\"></i>Valider et mettre en file d\x27attente
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    ";
        // line 76
        yield "    <div class=\"col-md-7\">
        <div class=\"card h-100\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fas fa-eye me-1\"></i>Aperçu du mail envoyé
            </div>
            <div class=\"card-body p-0\" style=\"background:#f8f9fa;\">
                <div class=\"p-3\">
                    ";
        // line 83
        yield ($context["contentmail"] ?? null);
        yield "
                </div>
            </div>
        </div>
    </div>

</div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "communication_mail/campagne_prospect.html.twig";
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
        return array (  185 => 83,  176 => 76,  140 => 42,  132 => 37,  125 => 33,  116 => 26,  111 => 22,  97 => 17,  92 => 16,  87 => 15,  83 => 14,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/campagne_prospect.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/campagne_prospect.html.twig");
    }
}
