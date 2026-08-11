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

/* private/code_partenaire.html.twig */
class __TwigTemplate_a99a8b71d770f143e7d5b1f656c1dc50 extends Template
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
        return "basePrivate.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("basePrivate.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Code Partenaire";
        yield from [];
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<style>
.cp-wrap{max-width:560px;margin:0 auto}
.cp-cond-list{list-style:none;padding:0;margin:0 0 20px}
.cp-cond-list li{display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--bs-border-color,rgba(0,0,0,.07));font-size:14px}
.cp-cond-list li:last-child{border-bottom:none}
.cp-cond-list .cp-ok{color:#198754;font-size:16px}
.cp-cond-list .cp-nok{color:#dc3545;font-size:16px}
html.dark-theme .cp-cond-list li,html.semi-dark .cp-cond-list li{border-color:rgba(255,255,255,.08)}
</style>
<div class=\"cp-wrap mt-3\">
    ";
        // line 15
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "aUnPartenaire", [], "any", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "    <div class=\"card\">
        <div class=\"card-body text-center py-4\">
            <i class=\"fas fa-handshake text-success\" style=\"font-size:3rem\"></i>
            <p class=\"mt-3 mb-0\">Vous avez déjà un partenaire. Cette section n\x27est plus accessible.</p>
            <a href=\"/parametres\" class=\"btn btn-primary mt-3\">Retour aux paramètres</a>
        </div>
    </div>
    ";
        } else {
            // line 24
            yield "    <div class=\"card\">
        <div class=\"card-body\">
            <h5 class=\"mb-1\"><i class=\"fas fa-handshake text-primary me-2\"></i>Utiliser un Code Partenaire</h5>
            <p class=\"text-muted mb-4\" style=\"font-size:13px\">
                Un partenaire vous a transmis un code à 8 caractères. Renseignez-le ci-dessous pour être associé.
            </p>
            ";
            // line 31
            yield "            ";
            $context["inscritDepuis24h"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "codePartenaireDisponible", [], "any", true, true, false, 31)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "codePartenaireDisponible", [], "any", false, false, false, 31), false)) : (false));
            // line 32
            yield "            <p class=\"fw-semibold mb-2\" style=\"font-size:13px;text-transform:uppercase;letter-spacing:.5px\">Conditions requises</p>
            <ul class=\"cp-cond-list\">
                <li>
                    ";
            // line 35
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 35)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 36
                yield "                        <i class=\"fas fa-check-circle cp-ok\"></i>
                    ";
            } else {
                // line 38
                yield "                        <i class=\"fas fa-times-circle cp-nok\"></i>
                    ";
            }
            // line 40
            yield "                    <span>Nom &amp; prénom renseignés</span>
                </li>
                <li>
                    ";
            // line 43
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 44
                yield "                        <i class=\"fas fa-check-circle cp-ok\"></i>
                    ";
            } else {
                // line 46
                yield "                        <i class=\"fas fa-times-circle cp-nok\"></i>
                    ";
            }
            // line 48
            yield "                    <span>Numéro WhatsApp confirmé</span>
                </li>
                <li>
                    ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mailIsVerified", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 52
                yield "                        <i class=\"fas fa-check-circle cp-ok\"></i>
                    ";
            } else {
                // line 54
                yield "                        <i class=\"fas fa-times-circle cp-nok\"></i>
                    ";
            }
            // line 56
            yield "                    <span>Adresse e-mail confirmée</span>
                </li>
                <li>
                    ";
            // line 59
            if ((($tmp = ($context["inscritDepuis24h"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 60
                yield "                        <i class=\"fas fa-check-circle cp-ok\"></i>
                    ";
            } else {
                // line 62
                yield "                        <i class=\"fas fa-times-circle cp-nok\"></i>
                    ";
            }
            // line 64
            yield "                    <span>Inscrit depuis moins de 24h</span>
                </li>
            </ul>
            ";
            // line 68
            yield "            <div id=\"cpFeedback\" class=\"alert\" style=\"display:none\"></div>
            ";
            // line 70
            yield "            ";
            $context["canSubmit"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 70) && CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 70)) && CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mailIsVerified", [], "any", false, false, false, 70)) && ($context["inscritDepuis24h"] ?? null));
            // line 71
            yield "            <div class=\"mb-3\">
                <label for=\"inputCode\" class=\"form-label fw-semibold\">Code Partenaire</label>
                <input type=\"text\"
                       id=\"inputCode\"
                       class=\"form-control\"
                       maxlength=\"8\"
                       placeholder=\"Ex: A3B7KX2P\"
                       style=\"text-transform:uppercase;letter-spacing:3px;font-size:18px;font-weight:600\"
                       ";
            // line 79
            if ((($tmp =  !($context["canSubmit"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "disabled";
            }
            yield ">
                <div class=\"form-text\">8 caractères, insensible à la casse.</div>
            </div>
            <button id=\"btnValider\"
                    class=\"btn btn-primary w-100\"
                    ";
            // line 84
            if ((($tmp =  !($context["canSubmit"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "disabled";
            }
            yield ">
                <span id=\"btnLabel\">VALIDER LE CODE</span>
                <span id=\"btnSpinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display:none\"></span>
            </button>
            ";
            // line 88
            if ((($tmp =  !($context["canSubmit"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 89
                yield "            <p class=\"text-danger text-center mt-2\" style=\"font-size:12px\">
                Complétez les conditions ci-dessus pour pouvoir utiliser un code partenaire.
            </p>
            ";
            }
            // line 93
            yield "        </div>
    </div>
    <script>
    document.getElementById(\x27btnValider\x27)?.addEventListener(\x27click\x27, async function () {
        const code = document.getElementById(\x27inputCode\x27).value.trim().toUpperCase();
        const feedback = document.getElementById(\x27cpFeedback\x27);
        const spinner = document.getElementById(\x27btnSpinner\x27);
        const btn = this;
        feedback.style.display = \x27none\x27;
        if (code.length !== 8) {
            feedback.className = \x27alert alert-danger\x27;
            feedback.textContent = \x27Le code doit contenir exactement 8 caractères.\x27;
            feedback.style.display = \x27block\x27;
            return;
        }
        btn.disabled = true;
        spinner.style.display = \x27inline-block\x27;
        try {
            const response = await fetch(\x27/api/utiliserCodePartenaire\x27, {
                method: \x27POST\x27,
                headers: { \x27Content-Type\x27: \x27application/x-www-form-urlencoded;charset=UTF-8\x27 },
                body: new URLSearchParams({ codePartenaire: code }),
                credentials: \x27same-origin\x27
            });
            const data = await response.json();
            if (data.error === false) {
                feedback.className = \x27alert alert-success\x27;
                feedback.textContent = data.message || \x27Partenaire associé avec succès !\x27;
                feedback.style.display = \x27block\x27;
                document.getElementById(\x27inputCode\x27).disabled = true;
                btn.disabled = true;
                // Redirige vers les paramètres après 2 secondes
                setTimeout(() => { window.location.href = \x27/parametres\x27; }, 2000);
            } else {
                feedback.className = \x27alert alert-danger\x27;
                feedback.textContent = data.message || \x27Une erreur est survenue.\x27;
                feedback.style.display = \x27block\x27;
                btn.disabled = false;
            }
        } catch (e) {
            feedback.className = \x27alert alert-danger\x27;
            feedback.textContent = \x27Erreur réseau. Veuillez réessayer.\x27;
            feedback.style.display = \x27block\x27;
            btn.disabled = false;
        } finally {
            spinner.style.display = \x27none\x27;
        }
    });
    </script>
    ";
        }
        // line 143
        yield "</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/code_partenaire.html.twig";
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
        return array (  266 => 143,  214 => 93,  208 => 89,  206 => 88,  197 => 84,  187 => 79,  177 => 71,  174 => 70,  171 => 68,  166 => 64,  162 => 62,  158 => 60,  156 => 59,  151 => 56,  147 => 54,  143 => 52,  141 => 51,  136 => 48,  132 => 46,  128 => 44,  126 => 43,  121 => 40,  117 => 38,  113 => 36,  111 => 35,  106 => 32,  103 => 31,  95 => 24,  85 => 16,  82 => 15,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/code_partenaire.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/code_partenaire.html.twig");
    }
}
