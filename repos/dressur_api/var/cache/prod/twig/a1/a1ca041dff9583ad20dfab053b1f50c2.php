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

/* private/espace_partenaire.html.twig */
class __TwigTemplate_31970692f08e346f0a3c534a10536ab7 extends Template
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
        yield "Espace Partenaire";
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
.ep-wrap{max-width:620px;margin:0 auto}
.ep-cond-list{list-style:none;padding:0;margin:0 0 20px}
.ep-cond-list li{display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid var(--bs-border-color,rgba(0,0,0,.07));font-size:14px}
.ep-cond-list li:last-child{border-bottom:none}
.ep-cond-list .ep-ok{color:#198754;font-size:16px}
.ep-cond-list .ep-nok{color:#dc3545;font-size:16px}
.ep-code-box{background:var(--bs-secondary-bg,#f8f9fa);border-radius:12px;padding:18px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:20px}
.ep-code-val{font-size:1.6rem;font-weight:700;letter-spacing:4px;font-family:monospace}
html.dark-theme .ep-cond-list li,html.semi-dark .ep-cond-list li{border-color:rgba(255,255,255,.08)}
html.dark-theme .ep-code-box,html.semi-dark .ep-code-box{background:rgba(255,255,255,.06)}
.ep-accompagne-card{background:var(--bs-body-bg,#fff);border:1px solid var(--bs-border-color,rgba(0,0,0,.08));border-radius:12px;padding:14px 16px;margin-bottom:10px}
html.dark-theme .ep-accompagne-card,html.semi-dark .ep-accompagne-card{background:#202a40;border-color:rgba(255,255,255,.08)}
</style>
<div class=\"ep-wrap mt-3\">
";
        // line 19
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "estPartenaire", [], "any", false, false, false, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "    ";
            // line 21
            yield "    ";
            // line 22
            yield "    ";
            // line 23
            yield "    <div class=\"card mb-3\">
        <div class=\"card-body\">
            <h5 class=\"mb-3\"><i class=\"fas fa-star text-warning me-2\"></i>Votre Espace Partenaire</h5>
            ";
            // line 27
            yield "            <p class=\"fw-semibold mb-2\" style=\"font-size:13px;text-transform:uppercase;letter-spacing:.5px\">Votre Code Partenaire</p>
            <div class=\"ep-code-box\">
                <span class=\"ep-code-val\" id=\"epCodeVal\">";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "codePartenaire", [], "any", false, false, false, 29), "html", null, true);
            yield "</span>
                <button class=\"btn btn-outline-primary btn-sm\" id=\"btnCopierCode\">
                    <i class=\"fas fa-copy me-1\"></i>Copier
                </button>
            </div>
            <p class=\"text-muted mb-4\" style=\"font-size:12px\">Partagez ce code à vos contacts pour les affilier. Il change automatiquement après chaque utilisation.</p>
            ";
            // line 36
            yield "            <p class=\"fw-semibold mb-2\" style=\"font-size:13px;text-transform:uppercase;letter-spacing:.5px\">
                Mes Accompagnés
                <span class=\"badge bg-primary ms-1\">";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["accompagnes"] ?? null)), "html", null, true);
            yield "</span>
            </p>
            ";
            // line 40
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["accompagnes"] ?? null)) == 0)) {
                // line 41
                yield "                <p class=\"text-muted text-center py-3\" style=\"font-size:13px\">Aucun accompagné pour l\x27instant. Partagez votre code !</p>
            ";
            } else {
                // line 43
                yield "                ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["accompagnes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["acc"]) {
                    // line 44
                    yield "                <div class=\"ep-accompagne-card\">
                    <div class=\"d-flex align-items-center gap-2 mb-1\">
                        <span class=\"fw-semibold\">";
                    // line 46
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getNom", [], "method", false, false, false, 46)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getNom", [], "method", false, false, false, 46), "html", null, true)) : ("—"));
                    yield "</span>
                        <span class=\"text-muted ms-2\" style=\"font-size:12px\">@";
                    // line 47
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getPseudo", [], "method", false, false, false, 47), "html", null, true);
                    yield "</span>
                    </div>
                    <div style=\"font-size:12px;color:var(--bs-secondary-color,#6c757d)\">
                        <i class=\"fab fa-whatsapp text-success me-1\"></i>";
                    // line 50
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getTel", [], "method", false, false, false, 50)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getTel", [], "method", false, false, false, 50), "html", null, true)) : ("—"));
                    yield "
                        &nbsp;·&nbsp;
                        <i class=\"fas fa-envelope me-1\"></i>";
                    // line 52
                    yield ((CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getMail", [], "method", false, false, false, 52)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getMail", [], "method", false, false, false, 52), "html", null, true)) : ("—"));
                    yield "
                        &nbsp;·&nbsp;
                        <i class=\"fas fa-calendar me-1\"></i>Affilié le ";
                    // line 54
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getCreatedAt", [], "method", false, false, false, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["acc"], "getCreatedAt", [], "method", false, false, false, 54), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "
                    </div>
                </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['acc'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 58
                yield "            ";
            }
            // line 59
            yield "            ";
            // line 60
            yield "            <div class=\"mt-4 pt-2 border-top\">
                <a href=\"#presentationSection\" class=\"text-muted\" style=\"font-size:13px\">
                    <i class=\"fas fa-info-circle me-1\"></i>Revoir la présentation de l\x27Espace Partenaire
                </a>
            </div>
        </div>
    </div>
    ";
            // line 68
            yield "    <div id=\"presentationSection\">
";
        }
        // line 70
        yield "    ";
        // line 71
        yield "    ";
        // line 72
        yield "    ";
        // line 73
        yield "    <div class=\"card mb-3\">
        <div class=\"card-body\">
            <h5 class=\"mb-1\"><i class=\"fas fa-handshake text-primary me-2\"></i>Qu\x27est-ce que l\x27Espace Partenaire ?</h5>
            <p class=\"text-muted mt-2 mb-0\" style=\"font-size:14px;line-height:1.7\">
                Le Partenaire Dressur est un utilisateur confirmé qui <strong>maîtrise la plateforme</strong> et s\x27engage à
                <strong>accompagner, aider et expliquer</strong> Dressur aux personnes qui utilisent son code d\x27affiliation.
                C\x27est un rôle actif, pas seulement un statut.
            </p>
        </div>
    </div>
    <div class=\"card mb-3\">
        <div class=\"card-body\">
            <h5 class=\"mb-1\"><i class=\"fas fa-gift text-success me-2\"></i>Vos avantages en tant que Partenaire</h5>
            <ul class=\"mt-3 mb-0\" style=\"font-size:14px;line-height:2\">
                <li><strong>2 % de commission</strong> sur chaque transaction payante de vos accompagnés, crédités automatiquement sur votre solde Dressur</li>
                <li>Le solde accumulé est utilisable sur tous les services payants de la plateforme (boost contact, promos…)</li>
                <li>Accès à votre tableau de bord dédié avec la liste de vos accompagnés</li>
            </ul>
        </div>
    </div>
    <div class=\"card mb-3\">
        <div class=\"card-body\">
            <h5 class=\"mb-3\"><i class=\"fas fa-list-check text-warning me-2\"></i>Conditions pour devenir Partenaire</h5>
            ";
        // line 96
        $context["condNom"] = (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 96) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 96) != ""));
        // line 97
        yield "            ";
        $context["condTel"] = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 97);
        // line 98
        yield "            ";
        $context["condMail"] = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mailIsVerified", [], "any", false, false, false, 98);
        // line 99
        yield "            ";
        $context["condAnciennete"] = (($context["joursInscrit"] ?? null) >= 7);
        // line 100
        yield "            ";
        $context["condCumul"] = (($context["cumulFcfa"] ?? null) >= 2000);
        // line 101
        yield "            <ul class=\"ep-cond-list\">
                <li>
                    ";
        // line 103
        if ((($tmp = ($context["condNom"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<i class=\"fas fa-check-circle ep-ok\"></i>";
        } else {
            yield "<i class=\"fas fa-times-circle ep-nok\"></i>";
        }
        // line 104
        yield "                    <span>Nom complet renseigné dans le profil</span>
                </li>
                <li>
                    ";
        // line 107
        if ((($tmp = ($context["condTel"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<i class=\"fas fa-check-circle ep-ok\"></i>";
        } else {
            yield "<i class=\"fas fa-times-circle ep-nok\"></i>";
        }
        // line 108
        yield "                    <span>Numéro WhatsApp confirmé</span>
                </li>
                <li>
                    ";
        // line 111
        if ((($tmp = ($context["condMail"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<i class=\"fas fa-check-circle ep-ok\"></i>";
        } else {
            yield "<i class=\"fas fa-times-circle ep-nok\"></i>";
        }
        // line 112
        yield "                    <span>Adresse e-mail confirmée</span>
                </li>
                <li>
                    ";
        // line 115
        if ((($tmp = ($context["condAnciennete"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<i class=\"fas fa-check-circle ep-ok\"></i>";
        } else {
            yield "<i class=\"fas fa-times-circle ep-nok\"></i>";
        }
        // line 116
        yield "                    <span>
                        Inscrit depuis au moins 7 jours
                        ";
        // line 118
        if ((($tmp =  !($context["condAnciennete"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 119
            yield "                            <span class=\"text-muted ms-1\" style=\"font-size:11px\">(";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["joursInscrit"] ?? null), "html", null, true);
            yield "j / 7j)</span>
                        ";
        }
        // line 121
        yield "                    </span>
                </li>
                <li>
                    ";
        // line 124
        if ((($tmp = ($context["condCumul"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<i class=\"fas fa-check-circle ep-ok\"></i>";
        } else {
            yield "<i class=\"fas fa-times-circle ep-nok\"></i>";
        }
        // line 125
        yield "                    <span>
                        Au moins 2 000 FCFA cumulés en services payants
                        <span class=\"text-muted ms-1\" style=\"font-size:11px\">(";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["cumulFcfa"] ?? null), 0, ",", " "), "html", null, true);
        yield " / 2 000 FCFA)</span>
                    </span>
                </li>
                <li>
                    <i class=\"fab fa-whatsapp text-success\" style=\"font-size:16px\"></i>
                    <span>Entretien de validation avec l\x27équipe Dressur sur WhatsApp (dernière étape)</span>
                </li>
            </ul>
            ";
        // line 136
        yield "            <div id=\"epFeedback\" class=\"alert\" style=\"display:none\"></div>
            ";
        // line 138
        yield "            ";
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "estPartenaire", [], "any", false, false, false, 138)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 139
            yield "                ";
            if (((((($context["condNom"] ?? null) && ($context["condTel"] ?? null)) && ($context["condMail"] ?? null)) && ($context["condAnciennete"] ?? null)) && ($context["condCumul"] ?? null))) {
                // line 140
                yield "                    <a href=\"https://wa.me/22964044294?text=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("Bonjour, j\x27aimerais passer l\x27entretien pour devenir Partenaire Dressur. Mon pseudo est : " . Twig\Extension\CoreExtension::urlencode(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 140))), "html", null, true);
                yield "\"
                       target=\"_blank\" rel=\"noopener noreferrer\"
                       class=\"btn btn-success w-100 mt-2\">
                        <i class=\"fab fa-whatsapp me-2\"></i>Demander l\x27entretien WhatsApp
                    </a>
                    <p class=\"text-muted text-center mt-2\" style=\"font-size:12px\">
                        Toutes vos conditions sont remplies. Contactez l\x27équipe Dressur pour planifier votre entretien.
                        Après validation, votre statut Partenaire sera activé.
                    </p>
                ";
            } else {
                // line 150
                yield "                    <button class=\"btn btn-secondary w-100 mt-2\" disabled>
                        Demander l\x27entretien WhatsApp
                    </button>
                    <p class=\"text-danger text-center mt-2\" style=\"font-size:12px\">
                        Complétez toutes les conditions ci-dessus pour débloquer l\x27entretien.
                    </p>
                ";
            }
            // line 157
            yield "            ";
        }
        // line 158
        yield "        </div>
    </div>
";
        // line 160
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "estPartenaire", [], "any", false, false, false, 160)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 161
            yield "    </div>";
        }
        // line 163
        yield "</div>
<script>
document.getElementById(\x27btnCopierCode\x27)?.addEventListener(\x27click\x27, function () {
    const code = document.getElementById(\x27epCodeVal\x27)?.textContent.trim();
    if (!code) return;
    navigator.clipboard.writeText(code).then(() => {
        this.innerHTML = \x27<i class=\"fas fa-check me-1\"></i>Copié !\x27;
        this.classList.replace(\x27btn-outline-primary\x27, \x27btn-success\x27);
        setTimeout(() => {
            this.innerHTML = \x27<i class=\"fas fa-copy me-1\"></i>Copier\x27;
            this.classList.replace(\x27btn-success\x27, \x27btn-outline-primary\x27);
        }, 2000);
    });
});
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/espace_partenaire.html.twig";
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
        return array (  355 => 163,  352 => 161,  350 => 160,  346 => 158,  343 => 157,  334 => 150,  320 => 140,  317 => 139,  314 => 138,  311 => 136,  300 => 127,  296 => 125,  290 => 124,  285 => 121,  279 => 119,  277 => 118,  273 => 116,  267 => 115,  262 => 112,  256 => 111,  251 => 108,  245 => 107,  240 => 104,  234 => 103,  230 => 101,  227 => 100,  224 => 99,  221 => 98,  218 => 97,  216 => 96,  191 => 73,  189 => 72,  187 => 71,  185 => 70,  181 => 68,  172 => 60,  170 => 59,  167 => 58,  157 => 54,  152 => 52,  147 => 50,  141 => 47,  137 => 46,  133 => 44,  128 => 43,  124 => 41,  122 => 40,  117 => 38,  113 => 36,  104 => 29,  100 => 27,  95 => 23,  93 => 22,  91 => 21,  89 => 20,  87 => 19,  70 => 4,  63 => 3,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/espace_partenaire.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/espace_partenaire.html.twig");
    }
}
