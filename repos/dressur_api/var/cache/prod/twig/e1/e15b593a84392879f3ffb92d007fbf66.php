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

/* communication_mail/message_personnalise_whatsapp.html.twig */
class __TwigTemplate_7005cbc56abd0c5197ff344fbdad304b extends Template
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
        yield "Message WhatsApp Personnalisé";
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
    <h4 class=\"mb-0\">
        <i class=\"fab fa-whatsapp me-2 text-success\"></i>Message WhatsApp Personnalisé
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
        yield "    <div class=\"col-md-7\">
        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fas fa-pen me-1 text-success\"></i>Composer le message
            </div>
            <div class=\"card-body\">

                <form method=\"post\" action=\"";
        // line 35
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_message_personnalise_whatsapp");
        yield "\"
                      onsubmit=\"return confirm(\x27Confirmer l\\\x27ajout des messages à la file d\\\x27attente WhatsApp ?\x27);\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("message_personnalise_whatsapp"), "html", null, true);
        yield "\">

                    ";
        // line 40
        yield "                    <div class=\"mb-4\">
                        <label for=\"audience\" class=\"form-label fw-semibold\">
                            <i class=\"fas fa-users me-1 text-primary\"></i>Audience cible
                        </label>
                        <select class=\"form-select\" id=\"audience\" name=\"audience\" required>
                            <option value=\"\" disabled selected>— Choisir une audience —</option>
                            ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["audiences"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["a"]) {
            // line 47
            yield "                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "emoji", [], "any", false, false, false, 47), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "label", [], "any", false, false, false, 47), "html", null, true);
            yield "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['a'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        yield "                        </select>
                        <div class=\"form-text\">
                            Sélectionnez le groupe d\x27utilisateurs qui recevront ce message. Seuls les utilisateurs avec un numéro WhatsApp confirmé sont inclus.
                        </div>
                    </div>

                    ";
        // line 56
        yield "                    <div class=\"mb-3\">
                        <label for=\"message\" class=\"form-label fw-semibold\">
                            <i class=\"fab fa-whatsapp me-1 text-success\"></i>Message
                        </label>
                        <textarea class=\"form-control font-monospace\"
                                  id=\"message\"
                                  name=\"message\"
                                  rows=\"10\"
                                  required
                                  placeholder=\"Bonjour {pseudo} !&#10;&#10;Votre compte Dressur ({mail}) est prêt.&#10;&#10;Contactez-nous au besoin.\"
                                  oninput=\"updatePreview()\"></textarea>
                        <div class=\"form-text\">
                            Utilisez les variables ci-dessous pour personnaliser le message pour chaque utilisateur.
                        </div>
                    </div>

                    ";
        // line 73
        yield "                    <div class=\"mb-4\">
                        <div class=\"small fw-semibold text-muted mb-2\">
                            <i class=\"fas fa-tags me-1\"></i>Variables disponibles — cliquez pour insérer :
                        </div>
                        <div class=\"d-flex flex-wrap gap-2\">
                            ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["{pseudo}" => "Pseudo", "{nom}" => "Nom", "{mail}" => "Adresse mail", "{tel}" => "Téléphone", "{uid}" => "Identifiant unique"]);
        foreach ($context['_seq'] as $context["var"] => $context["desc"]) {
            // line 85
            yield "                                <button type=\"button\"
                                        class=\"btn btn-sm btn-outline-success font-monospace\"
                                        onclick=\"insertVariable(\x27";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["var"], "html", null, true);
            yield "\x27)\">
                                    ";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["var"], "html", null, true);
            yield "
                                    <span class=\"text-muted ms-1 fw-normal\" style=\"font-family:sans-serif;font-size:11px;\">";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["desc"], "html", null, true);
            yield "</span>
                                </button>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['var'], $context['desc'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        yield "                        </div>
                    </div>

                    <div class=\"d-grid\">
                        <button type=\"submit\" class=\"btn btn-success btn-lg\">
                            <i class=\"fab fa-whatsapp me-2\"></i>Ajouter à la file d\x27attente WhatsApp
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    ";
        // line 108
        yield "    <div class=\"col-md-5\">

        ";
        // line 111
        yield "        <div class=\"card border-0 shadow-sm mb-3\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fas fa-info-circle me-1 text-primary\"></i>À propos des audiences
            </div>
            <div class=\"card-body p-0\">
                <ul class=\"list-group list-group-flush\">
                    ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["audiences"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["a"]) {
            // line 118
            yield "                    <li class=\"list-group-item d-flex align-items-center gap-2 small\">
                        <span class=\"fs-5\">";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "emoji", [], "any", false, false, false, 119), "html", null, true);
            yield "</span>
                        <div>
                            <div class=\"fw-semibold\">";
            // line 121
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "label", [], "any", false, false, false, 121), "html", null, true);
            yield "</div>
                            <div class=\"text-muted\" style=\"font-size:11px;\">Titre enregistré : ";
            // line 122
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["a"], "titre", [], "any", false, false, false, 122), "html", null, true);
            yield "</div>
                        </div>
                    </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['a'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        yield "                </ul>
            </div>
        </div>

        ";
        // line 131
        yield "        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-header fw-semibold\">
                <i class=\"fab fa-whatsapp me-1 text-success\"></i>Aperçu du message
                <span class=\"badge bg-secondary ms-2 small fw-normal\">exemple avec données fictives</span>
            </div>
            <div class=\"card-body\" style=\"background:#f8f9fa;\">
                <div id=\"preview-bubble\"
                     style=\"background:#e9fbe5;border-radius:16px 16px 4px 16px;padding:16px 20px;font-family:\x27Helvetica Neue\x27,Arial,sans-serif;font-size:14px;line-height:1.6;color:#111;white-space:pre-wrap;word-break:break-word;box-shadow:0 1px 3px rgba(0,0,0,.12);min-height:80px;\">
                    <span class=\"text-muted fst-italic\">Votre message apparaîtra ici…</span>
                </div>
                <div class=\"text-end small text-muted mt-2\" style=\"font-size:11px;\">✓✓ Envoyé</div>
                <div class=\"mt-3 p-2 rounded\" style=\"background:#fff3cd;font-size:11px;color:#856404;\">
                    <i class=\"fas fa-info-circle me-1\"></i>
                    Les variables seront remplacées par les données réelles de chaque utilisateur au moment de l\x27enregistrement.
                </div>
            </div>
        </div>

    </div>

</div>

<script>
const FAKE_DATA = {
    \x27{pseudo}\x27: \x27jean_dupont\x27,
    \x27{nom}\x27:    \x27Jean Dupont\x27,
    \x27{mail}\x27:   \x27jean.dupont@example.com\x27,
    \x27{tel}\x27:    \x27+22890123456\x27,
    \x27{uid}\x27:    \x27abc123xyz\x27,
};

function updatePreview() {
    const textarea = document.getElementById(\x27message\x27);
    const bubble   = document.getElementById(\x27preview-bubble\x27);
    const raw = textarea.value;

    bubble.textContent = \x27\x27;

    if (raw.trim() === \x27\x27) {
        const placeholder = document.createElement(\x27span\x27);
        placeholder.className = \x27text-muted fst-italic\x27;
        placeholder.textContent = \x27Votre message apparaîtra ici…\x27;
        bubble.appendChild(placeholder);
        return;
    }

    // Split text on known variables, render each part safely
    const pattern = /(\\{pseudo\\}|\\{nom\\}|\\{mail\\}|\\{tel\\}|\\{uid\\})/g;
    const parts = raw.split(pattern);

    parts.forEach(part => {
        if (FAKE_DATA[part] !== undefined) {
            const strong = document.createElement(\x27strong\x27);
            strong.className = \x27text-success\x27;
            strong.textContent = FAKE_DATA[part];
            bubble.appendChild(strong);
        } else {
            bubble.appendChild(document.createTextNode(part));
        }
    });
}

function insertVariable(variable) {
    const textarea = document.getElementById(\x27message\x27);
    const start = textarea.selectionStart;
    const end   = textarea.selectionEnd;
    textarea.value = textarea.value.substring(0, start) + variable + textarea.value.substring(end);
    textarea.selectionStart = textarea.selectionEnd = start + variable.length;
    textarea.focus();
    updatePreview();
}
</script>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "communication_mail/message_personnalise_whatsapp.html.twig";
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
        return array (  281 => 131,  275 => 126,  265 => 122,  261 => 121,  256 => 119,  253 => 118,  249 => 117,  241 => 111,  237 => 108,  220 => 92,  211 => 89,  207 => 88,  203 => 87,  199 => 85,  195 => 78,  188 => 73,  170 => 56,  162 => 49,  149 => 47,  145 => 46,  137 => 40,  132 => 37,  127 => 35,  118 => 28,  113 => 24,  99 => 19,  94 => 18,  89 => 17,  85 => 16,  77 => 11,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/message_personnalise_whatsapp.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/message_personnalise_whatsapp.html.twig");
    }
}
