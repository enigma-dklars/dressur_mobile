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

/* communication_mail/portal.html.twig */
class __TwigTemplate_5ac5006b7440eae1a1e60bbba871830f extends Template
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
        yield "Communication Mail — Portail";
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
<div class=\"d-flex align-items-center mb-4\">
    <h4 class=\"mb-0\"><i class=\"fas fa-envelope me-2 text-primary\"></i>Communication par Mail</h4>
</div>

";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 11));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 12
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 13
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
            ";
                // line 14
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
        // line 19
        yield "
";
        // line 21
        yield "<div class=\"row g-3 mb-4\">
    <div class=\"col-md-3\">
        <div class=\"card border-0 shadow-sm text-center py-3\">
            <div class=\"display-6 fw-bold text-warning\">";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_attente"] ?? null), "html", null, true);
        yield "</div>
            <div class=\"text-muted small\">En attente d\x27envoi</div>
        </div>
    </div>
    <div class=\"col-md-3\">
        <div class=\"card border-0 shadow-sm text-center py-3\">
            <div class=\"display-6 fw-bold text-success\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_envoye"] ?? null), "html", null, true);
        yield "</div>
            <div class=\"text-muted small\">Envoyés (file)</div>
        </div>
    </div>
    <div class=\"col-md-3\">
        <div class=\"card border-0 shadow-sm text-center py-3\">
            <div class=\"display-6 fw-bold text-primary\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_prospects"] ?? null), "html", null, true);
        yield "</div>
            <div class=\"text-muted small\">Adresses en base</div>
        </div>
    </div>
    <div class=\"col-md-3\">
        <a href=\"";
        // line 41
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_log");
        yield "\" class=\"card border-0 shadow-sm text-center py-3 text-decoration-none\">
            <div class=\"display-6 fw-bold text-info\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_logs"] ?? null), "html", null, true);
        yield "</div>
            <div class=\"text-muted small\">Mails loggués <i class=\"fas fa-external-link-alt ms-1\" style=\"font-size:0.6rem;\"></i></div>
        </a>
    </div>
</div>

";
        // line 49
        yield "<h5 class=\"mb-3 fw-semibold\">Campagnes</h5>
<div class=\"row g-3 mb-4\">

    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"mb-3\"><span class=\"fs-1\">🚀</span></div>
                <h5 class=\"card-title fw-semibold\">Attirer de nouveaux utilisateurs</h5>
                <p class=\"card-text text-muted small flex-grow-1\">
                    Envoyez un mail engageant à des adresses externes pour les inviter à rejoindre Dressur via le web ou l\x27application mobile.
                </p>
                <a href=\"";
        // line 60
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_prospect");
        yield "\" class=\"btn btn-primary mt-2\">
                    <i class=\"fas fa-paper-plane me-1\"></i>Lancer la campagne
                </a>
            </div>
        </div>
    </div>

    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"mb-3\"><span class=\"fs-1\">📋</span></div>
                <h5 class=\"card-title fw-semibold\">File d\x27attente mail</h5>
                <p class=\"card-text text-muted small flex-grow-1\">
                    Consultez et gérez les mails en attente d\x27envoi, envoyés ou en erreur.
                    ";
        // line 74
        if ((($context["nb_attente"] ?? null) > 0)) {
            // line 75
            yield "                        <br><span class=\"badge bg-warning text-dark mt-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_attente"] ?? null), "html", null, true);
            yield " en attente</span>
                    ";
        }
        // line 77
        yield "                </p>
                <a href=\"";
        // line 78
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente");
        yield "\" class=\"btn btn-outline-secondary mt-2\">
                    <i class=\"fas fa-list me-1\"></i>Voir la file d\x27attente
                </a>
            </div>
        </div>
    </div>

    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-success\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"mb-3\"><span class=\"fs-1\">💬</span></div>
                <h5 class=\"card-title fw-semibold\">File d\x27attente WhatsApp</h5>
                <p class=\"card-text text-muted small flex-grow-1\">
                    Consultez et gérez les messages WhatsApp en attente d\x27envoi.
                    ";
        // line 92
        if ((array_key_exists("nb_whatsapp_attente", $context) && (($context["nb_whatsapp_attente"] ?? null) > 0))) {
            // line 93
            yield "                        <br><span class=\"badge bg-success mt-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_whatsapp_attente"] ?? null), "html", null, true);
            yield " en attente</span>
                    ";
        }
        // line 95
        yield "                </p>
                <a href=\"";
        // line 96
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_whatsapp");
        yield "\" class=\"btn btn-outline-success mt-2\">
                    <i class=\"fab fa-whatsapp me-1\"></i>Voir la file WhatsApp
                </a>
            </div>
        </div>
    </div>

</div>

";
        // line 106
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fab fa-whatsapp me-1 text-success\"></i>Message WhatsApp Personnalisé
</h5>
<div class=\"row g-3 mb-4\">
    <div class=\"col-md-12\">
        <div class=\"card border-0 shadow-sm border-top border-3 border-success\">
            <div class=\"card-body d-flex align-items-center gap-4\">
                <div class=\"fs-1 flex-shrink-0\">✍️</div>
                <div class=\"flex-grow-1\">
                    <h5 class=\"card-title fw-semibold mb-1\">Envoyer un message libre à vos utilisateurs</h5>
                    <p class=\"card-text text-muted small mb-0\">
                        Rédigez un message personnalisé et envoyez-le à tous les utilisateurs d\x27un service (Boost Contact, Promotion Affaire ou Promotion Réseaux Sociaux).
                        Le message est personnalisé avec les variables <code>{nom}</code>, <code>{pseudo}</code>, <code>{mail}</code>, <code>{tel}</code>, <code>{uid}</code> pour chaque utilisateur.
                    </p>
                </div>
                <a href=\"";
        // line 121
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_message_personnalise_whatsapp");
        yield "\" class=\"btn btn-success flex-shrink-0\">
                    <i class=\"fab fa-whatsapp me-1\"></i>Rédiger un message
                </a>
            </div>
        </div>
    </div>
</div>

";
        // line 130
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fas fa-redo me-1 text-warning\"></i>Réactivation des utilisateurs inactifs
</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 134
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["reactivation"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 135
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "color", [], "any", false, false, false, 136), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "emoji", [], "any", false, false, false, 139), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "label", [], "any", false, false, false, 141), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 142
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "desc", [], "any", false, false, false, 142), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 146
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "color", [], "any", false, false, false, 146), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "nb", [], "any", false, false, false, 146), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <a href=\"";
            // line 149
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["r"], "key", [], "any", false, false, false, 149)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 150
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "color", [], "any", false, false, false, 150), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["r"], "nb", [], "any", false, false, false, 150) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fas fa-bolt me-1\"></i>
                    ";
            // line 152
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["r"], "nb", [], "any", false, false, false, 152) > 0)) {
                // line 153
                yield "                        Voir & lancer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["r"], "nb", [], "any", false, false, false, 153), "html", null, true);
                yield ")
                    ";
            } else {
                // line 155
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 157
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['r'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        yield "</div>

";
        // line 165
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fas fa-sync-alt me-1 text-primary\"></i>Relance par service
</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 169
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["services"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
            // line 170
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "color", [], "any", false, false, false, 171), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "emoji", [], "any", false, false, false, 174), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 176
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "label", [], "any", false, false, false, 176), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 177
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "desc", [], "any", false, false, false, 177), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 181
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "color", [], "any", false, false, false, 181), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "nb", [], "any", false, false, false, 181), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <a href=\"";
            // line 184
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["s"], "key", [], "any", false, false, false, 184)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 185
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "color", [], "any", false, false, false, 185), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["s"], "nb", [], "any", false, false, false, 185) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fas fa-bolt me-1\"></i>
                    ";
            // line 187
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["s"], "nb", [], "any", false, false, false, 187) > 0)) {
                // line 188
                yield "                        Voir & lancer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "nb", [], "any", false, false, false, 188), "html", null, true);
                yield ")
                    ";
            } else {
                // line 190
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 192
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['s'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 197
        yield "</div>

";
        // line 200
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fab fa-whatsapp me-1 text-success\"></i>Relance WhatsApp par service
</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 204
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["services_wa"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sw"]) {
            // line 205
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 206
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "color", [], "any", false, false, false, 206), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 209
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "emoji", [], "any", false, false, false, 209), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 211
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "label", [], "any", false, false, false, 211), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 212
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "desc", [], "any", false, false, false, 212), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 216
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "color", [], "any", false, false, false, 216), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "nb", [], "any", false, false, false, 216), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <a href=\"";
            // line 219
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "key", [], "any", false, false, false, 219)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 220
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "color", [], "any", false, false, false, 220), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "nb", [], "any", false, false, false, 220) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fab fa-whatsapp me-1\"></i>
                    ";
            // line 222
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "nb", [], "any", false, false, false, 222) > 0)) {
                // line 223
                yield "                        Voir & préparer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["sw"], "nb", [], "any", false, false, false, 223), "html", null, true);
                yield ")
                    ";
            } else {
                // line 225
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 227
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['sw'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 232
        yield "</div>

";
        // line 235
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fas fa-envelope-open-text me-1 text-warning\"></i>Confirmation d\x27adresse mail
</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 239
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["confirm"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
            // line 240
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 241
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "color", [], "any", false, false, false, 241), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 244
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "emoji", [], "any", false, false, false, 244), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 246
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "label", [], "any", false, false, false, 246), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 247
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "desc", [], "any", false, false, false, 247), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 251
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "color", [], "any", false, false, false, 251), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "nb", [], "any", false, false, false, 251), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <a href=\"";
            // line 254
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["c"], "key", [], "any", false, false, false, 254)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 255
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "color", [], "any", false, false, false, 255), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["c"], "nb", [], "any", false, false, false, 255) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fas fa-bolt me-1\"></i>
                    ";
            // line 257
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["c"], "nb", [], "any", false, false, false, 257) > 0)) {
                // line 258
                yield "                        Voir & lancer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["c"], "nb", [], "any", false, false, false, 258), "html", null, true);
                yield ")
                    ";
            } else {
                // line 260
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 262
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['c'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 267
        yield "</div>

";
        // line 270
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fab fa-whatsapp me-1 text-success\"></i>Confirmation numéro WhatsApp
    ";
        // line 272
        if ((array_key_exists("nb_whatsapp_attente", $context) && (($context["nb_whatsapp_attente"] ?? null) > 0))) {
            // line 273
            yield "        <span class=\"badge bg-success ms-2\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_whatsapp_attente"] ?? null), "html", null, true);
            yield " en attente d\x27envoi</span>
    ";
        }
        // line 275
        yield "</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 277
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["confirm_wa"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["w"]) {
            // line 278
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 279
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "color", [], "any", false, false, false, 279), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 282
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "emoji", [], "any", false, false, false, 282), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 284
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "label", [], "any", false, false, false, 284), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 285
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "desc", [], "any", false, false, false, 285), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 289
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "color", [], "any", false, false, false, 289), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "nb", [], "any", false, false, false, 289), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <a href=\"";
            // line 292
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["w"], "key", [], "any", false, false, false, 292)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 293
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "color", [], "any", false, false, false, 293), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["w"], "nb", [], "any", false, false, false, 293) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fab fa-whatsapp me-1\"></i>
                    ";
            // line 295
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["w"], "nb", [], "any", false, false, false, 295) > 0)) {
                // line 296
                yield "                        Voir & préparer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["w"], "nb", [], "any", false, false, false, 296), "html", null, true);
                yield ")
                    ";
            } else {
                // line 298
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 300
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['w'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 305
        yield "</div>

";
        // line 308
        yield "<h5 class=\"mb-3 fw-semibold\">
    <i class=\"fas fa-star me-1 text-warning\"></i>Feedback WhatsApp par service
</h5>
<div class=\"row g-3 mb-4\">
    ";
        // line 312
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["feedback_wa"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 313
            yield "    <div class=\"col-md-4\">
        <div class=\"card h-100 border-0 shadow-sm border-top border-3 border-";
            // line 314
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "color", [], "any", false, false, false, 314), "html", null, true);
            yield "\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"d-flex align-items-center mb-2\">
                    <span class=\"fs-2 me-2\">";
            // line 317
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "emoji", [], "any", false, false, false, 317), "html", null, true);
            yield "</span>
                    <div>
                        <div class=\"fw-semibold\">";
            // line 319
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "label", [], "any", false, false, false, 319), "html", null, true);
            yield "</div>
                        <div class=\"small text-muted\">";
            // line 320
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "desc", [], "any", false, false, false, 320), "html", null, true);
            yield "</div>
                    </div>
                </div>
                <div class=\"my-2\">
                    <span class=\"display-6 fw-bold text-";
            // line 324
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "color", [], "any", false, false, false, 324), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nb", [], "any", false, false, false, 324), "html", null, true);
            yield "</span>
                    <span class=\"text-muted small ms-1\">utilisateur(s) ciblé(s)</span>
                </div>
                <div class=\"small text-muted mb-2\">
                    <i class=\"fas fa-clock me-1\"></i>Cooldown : 365 jours (envoi unique/an)
                </div>
                <a href=\"";
            // line 330
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_campagne_reactivation", ["type" => CoreExtension::getAttribute($this->env, $this->source, $context["f"], "key", [], "any", false, false, false, 330)]), "html", null, true);
            yield "\"
                   class=\"btn btn-";
            // line 331
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "color", [], "any", false, false, false, 331), "html", null, true);
            yield " mt-auto ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nb", [], "any", false, false, false, 331) == 0)) {
                yield "disabled";
            }
            yield "\">
                    <i class=\"fab fa-whatsapp me-1\"></i>
                    ";
            // line 333
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nb", [], "any", false, false, false, 333) > 0)) {
                // line 334
                yield "                        Voir & préparer (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nb", [], "any", false, false, false, 334), "html", null, true);
                yield ")
                    ";
            } else {
                // line 336
                yield "                        Aucun utilisateur ciblé
                    ";
            }
            // line 338
            yield "                </a>
            </div>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 343
        yield "</div>

<h5 class=\"mb-3 fw-semibold\">Base de données & historique</h5>
<div class=\"row g-3\">

    <div class=\"col-md-6\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"mb-3\"><span class=\"fs-1\">🗂️</span></div>
                <h5 class=\"card-title fw-semibold\">Adresses en base</h5>
                <p class=\"card-text text-muted small flex-grow-1\">
                    Consultez toutes les adresses mail collectées lors des campagnes. Ces adresses sont conservées pour des réutilisations futures.
                    <br><span class=\"badge bg-primary mt-1\">";
        // line 355
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_prospects"] ?? null), "html", null, true);
        yield " adresse(s)</span>
                </p>
                <a href=\"";
        // line 357
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_prospects");
        yield "\" class=\"btn btn-outline-primary mt-2\">
                    <i class=\"fas fa-database me-1\"></i>Voir la liste
                </a>
            </div>
        </div>
    </div>

    <div class=\"col-md-6\">
        <div class=\"card h-100 border-0 shadow-sm\">
            <div class=\"card-body d-flex flex-column\">
                <div class=\"mb-3\"><span class=\"fs-1\">📊</span></div>
                <h5 class=\"card-title fw-semibold\">Historique des envois</h5>
                <p class=\"card-text text-muted small flex-grow-1\">
                    Consultez l\x27historique complet de tous les mails envoyés par le système. Filtrez par raison, compte sender ou période.
                    Permet de visualiser la répartition round-robin entre les comptes SMTP.
                    <br><span class=\"badge bg-info text-dark mt-1\">";
        // line 372
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nb_logs"] ?? null), "html", null, true);
        yield " log(s)</span>
                </p>
                <a href=\"";
        // line 374
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_log");
        yield "\" class=\"btn btn-outline-info mt-2\">
                    <i class=\"fas fa-history me-1\"></i>Voir l\x27historique
                </a>
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
        return "communication_mail/portal.html.twig";
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
        return array (  804 => 374,  799 => 372,  781 => 357,  776 => 355,  762 => 343,  752 => 338,  748 => 336,  742 => 334,  740 => 333,  731 => 331,  727 => 330,  716 => 324,  709 => 320,  705 => 319,  700 => 317,  694 => 314,  691 => 313,  687 => 312,  681 => 308,  677 => 305,  667 => 300,  663 => 298,  657 => 296,  655 => 295,  646 => 293,  642 => 292,  634 => 289,  627 => 285,  623 => 284,  618 => 282,  612 => 279,  609 => 278,  605 => 277,  601 => 275,  595 => 273,  593 => 272,  589 => 270,  585 => 267,  575 => 262,  571 => 260,  565 => 258,  563 => 257,  554 => 255,  550 => 254,  542 => 251,  535 => 247,  531 => 246,  526 => 244,  520 => 241,  517 => 240,  513 => 239,  507 => 235,  503 => 232,  493 => 227,  489 => 225,  483 => 223,  481 => 222,  472 => 220,  468 => 219,  460 => 216,  453 => 212,  449 => 211,  444 => 209,  438 => 206,  435 => 205,  431 => 204,  425 => 200,  421 => 197,  411 => 192,  407 => 190,  401 => 188,  399 => 187,  390 => 185,  386 => 184,  378 => 181,  371 => 177,  367 => 176,  362 => 174,  356 => 171,  353 => 170,  349 => 169,  343 => 165,  339 => 162,  329 => 157,  325 => 155,  319 => 153,  317 => 152,  308 => 150,  304 => 149,  296 => 146,  289 => 142,  285 => 141,  280 => 139,  274 => 136,  271 => 135,  267 => 134,  261 => 130,  250 => 121,  233 => 106,  221 => 96,  218 => 95,  212 => 93,  210 => 92,  193 => 78,  190 => 77,  184 => 75,  182 => 74,  165 => 60,  152 => 49,  143 => 42,  139 => 41,  131 => 36,  122 => 30,  113 => 24,  108 => 21,  105 => 19,  91 => 14,  86 => 13,  81 => 12,  77 => 11,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/portal.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/portal.html.twig");
    }
}
