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

/* communication_mail/campagne_reactivation.html.twig */
class __TwigTemplate_d4322ccb321e09af260777077c709374 extends Template
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
        yield "Campagne Réactivation — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "label", [], "any", false, false, false, 3), "html", null, true);
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
    <h4 class=\"mb-0\">
        ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "emoji", [], "any", false, false, false, 9), "html", null, true);
        yield " Réactivation — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "label", [], "any", false, false, false, 9), "html", null, true);
        yield "
    </h4>
    <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"btn btn-sm btn-outline-secondary ms-auto\">
        <i class=\"fas fa-arrow-left me-1\"></i>Retour au portail
    </a>
</div>

";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 16));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 17
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 18
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
            ";
                // line 19
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
        // line 24
        yield "
<div class=\"row g-4\">

    ";
        // line 28
        yield "    <div class=\"col-md-5\">

        <div class=\"card border-0 shadow-sm mb-3\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fas fa-info-circle me-1 text-primary\"></i>Résumé de la campagne
            </div>
            <div class=\"card-body\">

                <dl class=\"row mb-0 small\">
                    <dt class=\"col-sm-5\">Segment</dt>
                    <dd class=\"col-sm-7\">";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "label", [], "any", false, false, false, 38), "html", null, true);
        yield "</dd>

                    <dt class=\"col-sm-5\">Sujet</dt>
                    <dd class=\"col-sm-7 fw-semibold\">";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sujet"] ?? null), "html", null, true);
        yield "</dd>

                    <dt class=\"col-sm-5\">Reply-to</dt>
                    <dd class=\"col-sm-7 font-monospace\">";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["replyto"] ?? null), "html", null, true);
        yield "</dd>

                    ";
        // line 46
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "group", [], "any", false, false, false, 46) == "service")) {
            // line 47
            yield "                    <dt class=\"col-sm-5\">Fenêtre analysée</dt>
                    <dd class=\"col-sm-7\">";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "maxDaysAgo", [], "any", false, false, false, 48), "html", null, true);
            yield " derniers jours</dd>
                    ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 49
($context["config"] ?? null), "group", [], "any", false, false, false, 49) == "confirm")) {
            // line 50
            yield "                    <dt class=\"col-sm-5\">Critère</dt>
                    <dd class=\"col-sm-7\">Mail non confirmé</dd>
                    ";
        } else {
            // line 53
            yield "                    <dt class=\"col-sm-5\">Inactivité ciblée</dt>
                    <dd class=\"col-sm-7\">
                        ";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "minDays", [], "any", false, false, false, 55), "html", null, true);
            yield "j
                        ";
            // line 56
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "maxDays", [], "any", false, false, false, 56)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "→ ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "maxDays", [], "any", false, false, false, 56), "html", null, true);
                yield "j";
            } else {
                yield "+";
            }
            // line 57
            yield "                    </dd>
                    ";
        }
        // line 59
        yield "                </dl>

            </div>
        </div>

        ";
        // line 65
        yield "        <div class=\"row g-2 mb-3\">
            <div class=\"col-6\">
                <div class=\"card border-0 shadow-sm text-center py-3\">
                    <div class=\"display-5 fw-bold text-";
        // line 68
        yield (((($context["nb_to_send"] ?? null) > 0)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "color", [], "any", false, false, false, 68), "html", null, true)) : ("secondary"));
        yield "\">
                        ";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
        yield "
                    </div>
                    <div class=\"small text-muted\">à envoyer</div>
                </div>
            </div>
            <div class=\"col-6\">
                <div class=\"card border-0 shadow-sm text-center py-3\">
                    <div class=\"display-5 fw-bold text-secondary\">
                        ";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_excluded"] ?? null), "html", null, true);
        yield "
                    </div>
                    <div class=\"small text-muted\">
                        ignorés
                        <span class=\"d-block\" style=\"font-size:11px;\">(contactés &lt; ";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["cooldown_days"] ?? null), "html", null, true);
        yield "j)</span>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 88
        yield "        <div class=\"card border-0 shadow-sm border-top border-3 border-";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "color", [], "any", false, false, false, 88), "html", null, true);
        yield "\">
            <div class=\"card-body\">

                ";
        // line 91
        if ((($context["nb_to_send"] ?? null) > 0)) {
            // line 92
            yield "                    ";
            if ((($context["nb_excluded"] ?? null) > 0)) {
                // line 93
                yield "                    <p class=\"small mb-2\" style=\"color:#6c757d;\">
                        <i class=\"fas fa-info-circle me-1 text-info\"></i>
                        <strong>";
                // line 95
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_excluded"] ?? null), "html", null, true);
                yield "</strong> utilisateur(s) déjà contacté(s) dans les
                        <strong>";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["cooldown_days"] ?? null), "html", null, true);
                yield " derniers jours</strong> seront automatiquement ignorés.
                    </p>
                    ";
            }
            // line 99
            yield "
                    <p class=\"small mb-3 text-muted\">
                        <i class=\"fas fa-exclamation-triangle me-1 text-";
            // line 101
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "color", [], "any", false, false, false, 101), "html", null, true);
            yield "\"></i>
                        ";
            // line 102
            if ((array_key_exists("is_whatsapp", $context) && ($context["is_whatsapp"] ?? null))) {
                // line 103
                yield "                            <strong>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
                yield " message(s) WhatsApp</strong> vont être ajoutés à la file.
                            Chaque message est personnalisé avec le pseudo et un lien de confirmation unique.
                        ";
            } else {
                // line 106
                yield "                            <strong>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
                yield " mail(s)</strong> vont être ajoutés à la file.
                            Chaque mail est personnalisé avec le pseudo de l\x27utilisateur.
                        ";
            }
            // line 109
            yield "                    </p>

                    <form method=\"post\"
                          action=\"";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation_lancer", ["type" => ($context["type"] ?? null)]), "html", null, true);
            yield "\"
                          onsubmit=\"return confirm(\x27Confirmer l\\\x27envoi de ";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
            yield " ";
            if ((array_key_exists("is_whatsapp", $context) && ($context["is_whatsapp"] ?? null))) {
                yield "message(s) WhatsApp";
            } else {
                yield "mail(s)";
            }
            yield " ?\x27);\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("reactivation_" . ($context["type"] ?? null))), "html", null, true);
            yield "\">
                        <div class=\"d-grid\">
                            <button type=\"submit\" class=\"btn btn-";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "color", [], "any", false, false, false, 116), "html", null, true);
            yield " btn-lg\">
                                ";
            // line 117
            if ((array_key_exists("is_whatsapp", $context) && ($context["is_whatsapp"] ?? null))) {
                // line 118
                yield "                                    <i class=\"fab fa-whatsapp me-2\"></i>
                                    Lancer — ";
                // line 119
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
                yield " message(s) WhatsApp
                                ";
            } else {
                // line 121
                yield "                                    <i class=\"fas fa-bolt me-2\"></i>
                                    Lancer — ";
                // line 122
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_to_send"] ?? null), "html", null, true);
                yield " mail(s)
                                ";
            }
            // line 124
            yield "                            </button>
                        </div>
                    </form>

                ";
        } elseif ((        // line 128
($context["nb_excluded"] ?? null) > 0)) {
            // line 129
            yield "                    <div class=\"text-center text-muted py-3\">
                        <i class=\"fas fa-clock fa-2x text-warning mb-2 d-block\"></i>
                        Tous les utilisateurs de cette tranche ont déjà été contactés dans les
                        <strong>";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["cooldown_days"] ?? null), "html", null, true);
            yield " derniers jours</strong>.<br>
                        <span class=\"small\">Revenez dans quelques jours.</span>
                    </div>

                ";
        } else {
            // line 137
            yield "                    <div class=\"text-center text-muted py-3\">
                        <i class=\"fas fa-check-circle fa-2x text-success mb-2 d-block\"></i>
                        ";
            // line 139
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["config"] ?? null), "group", [], "any", false, false, false, 139) == "confirm")) {
                // line 140
                yield "                            Tous les utilisateurs ont confirmé leur adresse mail.
                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 141
($context["config"] ?? null), "group", [], "any", false, false, false, 141) == "service")) {
                // line 142
                yield "                            Aucun utilisateur ciblé pour ce service actuellement.
                        ";
            } else {
                // line 144
                yield "                            Aucun utilisateur inactif dans cette tranche actuellement.
                        ";
            }
            // line 146
            yield "                    </div>
                ";
        }
        // line 148
        yield "
            </div>
        </div>

    </div>

    ";
        // line 155
        yield "    <div class=\"col-md-7\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-header fw-semibold\">
                ";
        // line 158
        if ((array_key_exists("is_whatsapp", $context) && ($context["is_whatsapp"] ?? null))) {
            // line 159
            yield "                    <i class=\"fab fa-whatsapp me-1 text-success\"></i>Aperçu du message WhatsApp
                ";
        } else {
            // line 161
            yield "                    <i class=\"fas fa-eye me-1\"></i>Aperçu du mail
                ";
        }
        // line 163
        yield "                <span class=\"badge bg-secondary ms-2 small fw-normal\">
                    personnalisé avec le pseudo de chaque utilisateur
                </span>
            </div>
            <div class=\"card-body p-0\" style=\"background:#f8f9fa;\">
                ";
        // line 168
        if ((array_key_exists("is_whatsapp", $context) && ($context["is_whatsapp"] ?? null))) {
            // line 169
            yield "                    ";
            // line 170
            yield "                    <div class=\"p-4\">
                        <div style=\"background:#e9fbe5;border-radius:16px 16px 4px 16px;padding:16px 20px;max-width:420px;margin-left:auto;font-family:\x27Helvetica Neue\x27,Arial,sans-serif;font-size:14px;line-height:1.6;color:#111;white-space:pre-wrap;word-break:break-word;box-shadow:0 1px 3px rgba(0,0,0,.12);\">";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["contentmail"] ?? null), "html", null, true);
            yield "</div>
                        <div class=\"text-end small text-muted mt-2\" style=\"font-size:11px;\">✓✓ Envoyé</div>
                    </div>
                ";
        } else {
            // line 175
            yield "                    <div class=\"p-3\">
                        ";
            // line 176
            yield ($context["contentmail"] ?? null);
            yield "
                    </div>
                ";
        }
        // line 179
        yield "            </div>
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
        return "communication_mail/campagne_reactivation.html.twig";
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
        return array (  425 => 179,  419 => 176,  416 => 175,  409 => 171,  406 => 170,  404 => 169,  402 => 168,  395 => 163,  391 => 161,  387 => 159,  385 => 158,  380 => 155,  372 => 148,  368 => 146,  364 => 144,  360 => 142,  358 => 141,  355 => 140,  353 => 139,  349 => 137,  341 => 132,  336 => 129,  334 => 128,  328 => 124,  323 => 122,  320 => 121,  315 => 119,  312 => 118,  310 => 117,  306 => 116,  301 => 114,  291 => 113,  287 => 112,  282 => 109,  275 => 106,  268 => 103,  266 => 102,  262 => 101,  258 => 99,  252 => 96,  248 => 95,  244 => 93,  241 => 92,  239 => 91,  232 => 88,  223 => 81,  216 => 77,  205 => 69,  201 => 68,  196 => 65,  189 => 59,  185 => 57,  177 => 56,  173 => 55,  169 => 53,  164 => 50,  162 => 49,  158 => 48,  155 => 47,  153 => 46,  148 => 44,  142 => 41,  136 => 38,  124 => 28,  119 => 24,  105 => 19,  100 => 18,  95 => 17,  91 => 16,  83 => 11,  76 => 9,  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/campagne_reactivation.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/campagne_reactivation.html.twig");
    }
}
