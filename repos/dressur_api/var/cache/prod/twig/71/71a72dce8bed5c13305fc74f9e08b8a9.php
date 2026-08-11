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

/* communication_mail/log_boite_mail.html.twig */
class __TwigTemplate_8cf113e1d57e58c3df9650591c67aae1 extends Template
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
        yield "Communication Mail — Historique des envois";
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
    <h4 class=\"mb-0\"><i class=\"fas fa-history me-2 text-primary\"></i>Historique des envois</h4>
    <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"btn btn-sm btn-outline-secondary ms-auto\">
        <i class=\"fas fa-arrow-left me-1\"></i>Retour au portail
    </a>
</div>

";
        // line 15
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["stats_sender"] ?? null)) > 0)) {
            // line 16
            yield "<div class=\"card border-0 shadow-sm mb-4\">
    <div class=\"card-header py-2 px-3 bg-transparent d-flex align-items-center\">
        <span class=\"fw-semibold small\">
            <i class=\"fas fa-chart-bar me-1 text-primary\"></i>Répartition round-robin par compte d\x27envoi
        </span>
        <button class=\"btn btn-sm btn-outline-secondary ms-auto\"
                type=\"button\"
                data-bs-toggle=\"collapse\"
                data-bs-target=\"#stats-rr\"
                aria-expanded=\"false\"
                aria-controls=\"stats-rr\"
                id=\"btn-toggle-stats\">
            <i class=\"fas fa-eye me-1\"></i>Afficher
        </button>
    </div>
    <div class=\"collapse\" id=\"stats-rr\">
        <div class=\"card-body p-3\">
            ";
            // line 33
            $context["total_all"] = 0;
            // line 34
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stats_sender"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                $context["total_all"] = (($context["total_all"] ?? null) + CoreExtension::getAttribute($this->env, $this->source, $context["s"], "total", [], "any", false, false, false, 34));
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['s'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            yield "            <div class=\"row g-2\">
            ";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stats_sender"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
                // line 37
                yield "                ";
                $context["pct"] = (((($context["total_all"] ?? null) > 0)) ? (Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, $context["s"], "total", [], "any", false, false, false, 37) / ($context["total_all"] ?? null)) * 100), 1)) : (0));
                // line 38
                yield "                <div class=\"col-md-6 col-lg-4\">
                    <div class=\"p-2 border rounded\">
                        <div class=\"d-flex justify-content-between align-items-center mb-1\">
                            <span class=\"small fw-semibold text-truncate\" style=\"max-width:70%;\" title=\"";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "sender", [], "any", false, false, false, 41), "html", null, true);
                yield "\">
                                <i class=\"fas fa-envelope-open-text me-1 text-muted\"></i>";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "sender", [], "any", false, false, false, 42), "html", null, true);
                yield "
                            </span>
                            <span class=\"badge bg-primary\">";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "total", [], "any", false, false, false, 44), "html", null, true);
                yield "</span>
                        </div>
                        <div class=\"progress\" style=\"height:6px;\">
                            <div class=\"progress-bar\" role=\"progressbar\" style=\"width:";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "%\"
                                 aria-valuenow=\"";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                        </div>
                        <div class=\"text-end text-muted small mt-1\">";
                // line 50
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "%</div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['s'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            yield "            </div>
        </div>
    </div>
</div>
<script>
(function () {
    const el  = document.getElementById(\x27stats-rr\x27);
    const btn = document.getElementById(\x27btn-toggle-stats\x27);
    if (!el || !btn) return;
    el.addEventListener(\x27show.bs.collapse\x27,  function () { btn.innerHTML = \x27<i class=\"fas fa-eye-slash me-1\"></i>Masquer\x27; });
    el.addEventListener(\x27hide.bs.collapse\x27,  function () { btn.innerHTML = \x27<i class=\"fas fa-eye me-1\"></i>Afficher\x27; });
})();
</script>
";
        }
        // line 68
        yield "
";
        // line 70
        yield "<form method=\"get\" class=\"card border-0 shadow-sm mb-3\">
    <div class=\"card-body p-3\">
        <div class=\"row g-2 align-items-end\">
            <div class=\"col-md-3\">
                <label class=\"form-label small mb-1\">Raison</label>
                <select name=\"raison\" class=\"form-select form-select-sm\">
                    <option value=\"\">Toutes les raisons</option>
                    ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["raisons"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 78
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "raison", [], "any", false, false, false, 78), "html", null, true);
            yield "\" ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "raison", [], "any", false, false, false, 78) == CoreExtension::getAttribute($this->env, $this->source, $context["row"], "raison", [], "any", false, false, false, 78))) ? ("selected") : (""));
            yield ">
                            ";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "raison", [], "any", false, false, false, 79), "html", null, true);
            yield "
                        </option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        yield "                </select>
            </div>
            <div class=\"col-md-3\">
                <label class=\"form-label small mb-1\">Sender</label>
                <select name=\"sender\" class=\"form-select form-select-sm\">
                    <option value=\"\">Tous les comptes</option>
                    ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["senders"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 89
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "sender", [], "any", false, false, false, 89), "html", null, true);
            yield "\" ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "sender", [], "any", false, false, false, 89) == CoreExtension::getAttribute($this->env, $this->source, $context["row"], "sender", [], "any", false, false, false, 89))) ? ("selected") : (""));
            yield ">
                            ";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "sender", [], "any", false, false, false, 90), "html", null, true);
            yield "
                        </option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        yield "                </select>
            </div>
            <div class=\"col-md-2\">
                <label class=\"form-label small mb-1\">Du</label>
                <input type=\"date\" name=\"date_from\" class=\"form-control form-control-sm\"
                       value=\"";
        // line 98
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "date_from", [], "any", false, false, false, 98), "html", null, true);
        yield "\">
            </div>
            <div class=\"col-md-2\">
                <label class=\"form-label small mb-1\">Au</label>
                <input type=\"date\" name=\"date_to\" class=\"form-control form-control-sm\"
                       value=\"";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "date_to", [], "any", false, false, false, 103), "html", null, true);
        yield "\">
            </div>
            <div class=\"col-md-2 d-flex gap-2\">
                <button type=\"submit\" class=\"btn btn-sm btn-primary w-100\">
                    <i class=\"fas fa-filter me-1\"></i>Filtrer
                </button>
                <a href=\"";
        // line 109
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_log");
        yield "\" class=\"btn btn-sm btn-outline-secondary\">
                    <i class=\"fas fa-times\"></i>
                </a>
            </div>
        </div>
    </div>
</form>

";
        // line 118
        yield "<div class=\"card border-0 shadow-sm\">
    <div class=\"card-body p-0\">
        <table class=\"data-table table table-bordered table-striped mb-0\" data-order=\x27[[4,\"desc\"]]\x27>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Raison</th>
                    <th>Sender</th>
                    <th>Destinataire</th>
                    <th>Date d\x27envoi</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 131
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["logs"] ?? null)) == 0)) {
            // line 132
            yield "                <tr>
                    <td colspan=\"5\" class=\"text-center text-muted py-4\">
                        ";
            // line 134
            if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "raison", [], "any", false, false, false, 134) || CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "sender", [], "any", false, false, false, 134)) || CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "date_from", [], "any", false, false, false, 134)) || CoreExtension::getAttribute($this->env, $this->source, ($context["filters"] ?? null), "date_to", [], "any", false, false, false, 134))) {
                // line 135
                yield "                            Aucun résultat pour ces filtres.
                        ";
            } else {
                // line 137
                yield "                            Aucun envoi enregistré pour le moment.
                        ";
            }
            // line 139
            yield "                    </td>
                </tr>
            ";
        } else {
            // line 142
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["logs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 143
                yield "                <tr>
                    <td class=\"text-muted small\">";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "id", [], "any", false, false, false, 144), "html", null, true);
                yield "</td>
                    <td>
                        ";
                // line 146
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "raison", [], "any", false, false, false, 146) == "campagne_prospect")) {
                    // line 147
                    yield "                            <span class=\"badge bg-primary\">campagne_prospect</span>
                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 148
$context["log"], "raison", [], "any", false, false, false, 148) == "report")) {
                    // line 149
                    yield "                            <span class=\"badge bg-secondary\">report</span>
                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 150
$context["log"], "raison", [], "any", false, false, false, 150) == "general")) {
                    // line 151
                    yield "                            <span class=\"badge bg-light text-dark border\">general</span>
                        ";
                } else {
                    // line 153
                    yield "                            <span class=\"badge bg-info text-dark\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "raison", [], "any", false, false, false, 153), "html", null, true);
                    yield "</span>
                        ";
                }
                // line 155
                yield "                    </td>
                    <td class=\"small text-muted\">";
                // line 156
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "emailSender", [], "any", false, false, false, 156), "html", null, true);
                yield "</td>
                    <td class=\"small\">";
                // line 157
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "emailRecepteur", [], "any", false, false, false, 157), "html", null, true);
                yield "</td>
                    <td class=\"small text-muted\">";
                // line 158
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "datEnvoi", [], "any", false, false, false, 158), "d/m/Y H:i:s"), "html", null, true);
                yield "</td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['log'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 161
            yield "            ";
        }
        // line 162
        yield "            </tbody>
        </table>
    </div>
    ";
        // line 165
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["logs"] ?? null)) > 0)) {
            // line 166
            yield "    <div class=\"card-footer text-muted small d-flex justify-content-between\">
        <span>";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["logs"] ?? null)), "html", null, true);
            yield " entrée(s) affichée(s)</span>
        ";
            // line 168
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["logs"] ?? null)) == 500)) {
                // line 169
                yield "            <span class=\"text-warning\"><i class=\"fas fa-exclamation-triangle me-1\"></i>Limite de 500 résultats atteinte — affinez les filtres.</span>
        ";
            }
            // line 171
            yield "    </div>
    ";
        }
        // line 173
        yield "</div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "communication_mail/log_boite_mail.html.twig";
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
        return array (  394 => 173,  390 => 171,  386 => 169,  384 => 168,  380 => 167,  377 => 166,  375 => 165,  370 => 162,  367 => 161,  358 => 158,  354 => 157,  350 => 156,  347 => 155,  341 => 153,  337 => 151,  335 => 150,  332 => 149,  330 => 148,  327 => 147,  325 => 146,  320 => 144,  317 => 143,  312 => 142,  307 => 139,  303 => 137,  299 => 135,  297 => 134,  293 => 132,  291 => 131,  276 => 118,  265 => 109,  256 => 103,  248 => 98,  241 => 93,  232 => 90,  225 => 89,  221 => 88,  213 => 82,  204 => 79,  197 => 78,  193 => 77,  184 => 70,  181 => 68,  165 => 54,  155 => 50,  150 => 48,  146 => 47,  140 => 44,  135 => 42,  131 => 41,  126 => 38,  123 => 37,  119 => 36,  116 => 35,  106 => 34,  104 => 33,  85 => 16,  83 => 15,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/log_boite_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/log_boite_mail.html.twig");
    }
}
