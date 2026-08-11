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

/* private/listeboostcontact.html.twig */
class __TwigTemplate_b6fe2412fd3c5e24d0a26115e8617b43 extends Template
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

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Liste Boost Contact";
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
";
        // line 8
        yield "<div class=\"d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2\">
    <div>
        <h5 class=\"mb-0 fw-bold\">Liste Boost Contact</h5>
        <small class=\"text-muted\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["lesBoostContact"] ?? null)), "html", null, true);
        yield " boost";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["lesBoostContact"] ?? null)) != 1)) ? ("s") : (""));
        yield " au total</small>
    </div>
    <a href=\"/newboostcontact\" class=\"btn btn-primary btn-sm\">
        <i class=\"bi bi-plus-circle me-1\"></i> Nouveau Boost
    </a>
</div>

";
        // line 19
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["lesBoostContact"] ?? null)) > 0)) {
            // line 20
            yield "<div class=\"d-flex flex-wrap gap-2 mb-3 small\">
    <span class=\"badge bg-success\">Gratuit</span>
    <span class=\"badge bg-danger\">Payant</span>
    <span class=\"badge\" style=\"background:#455a64;\">Par Durée</span>
    <span class=\"badge\" style=\"background:#512da8;\">Par Contacts</span>
    <span class=\"badge bg-warning text-dark\">En cours</span>
    <span class=\"badge bg-primary\">Programmé</span>
    <span class=\"badge bg-success\">Terminé</span>
</div>
";
        }
        // line 30
        yield "
";
        // line 32
        yield "<div class=\"row g-3\">
    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["lesBoostContact"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["b"]) {
            // line 34
            yield "
        ";
            // line 36
            yield "        ";
            if ((((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "typeBoost", [], "any", false, false, false, 36) == "quota") &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 36))) && (CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 36) > 0))) {
                // line 37
                yield "            ";
                $context["pct"] = Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsObtenus", [], "any", false, false, false, 37) / CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 37)) * 100));
                // line 38
                yield "            ";
                $context["pct"] = (((($context["pct"] ?? null) > 100)) ? (100) : (($context["pct"] ?? null)));
                // line 39
                yield "        ";
            } else {
                // line 40
                yield "            ";
                $context["pct"] = 0;
                // line 41
                yield "        ";
            }
            // line 42
            yield "
        <div class=\"col-md-4 col-sm-6\">
            <div class=\"card h-100 border-0 shadow-sm\">
                <div class=\"card-body pb-2\">

                    ";
            // line 48
            yield "                    <div class=\"d-flex align-items-center justify-content-between mb-2 flex-wrap gap-1\">
                        <div class=\"d-flex gap-1 flex-wrap\">
                            ";
            // line 51
            yield "                            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeNumber", [], "any", false, false, false, 51) == 1)) {
                // line 52
                yield "                                <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeBoostFormule", [], "any", false, false, false, 52), "html", null, true);
                yield "</span>
                            ";
            } else {
                // line 54
                yield "                                <span class=\"badge bg-danger\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeBoostFormule", [], "any", false, false, false, 54), "html", null, true);
                yield "</span>
                            ";
            }
            // line 56
            yield "
                            ";
            // line 58
            yield "                            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "typeBoost", [], "any", false, false, false, 58) == "quota")) {
                // line 59
                yield "                                <span class=\"badge\" style=\"background:#512da8;\">
                                    <i class=\"bi bi-people me-1\"></i>Par Contacts
                                </span>
                            ";
            } else {
                // line 63
                yield "                                <span class=\"badge\" style=\"background:#455a64;\">
                                    <i class=\"bi bi-clock me-1\"></i>Par Durée
                                </span>
                            ";
            }
            // line 67
            yield "                        </div>

                        ";
            // line 70
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statusNumber", [], "any", false, false, false, 70) == 1)) {
                // line 71
                yield "                            <span class=\"badge bg-warning text-dark\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 71), "html", null, true);
                yield "</span>
                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 72
$context["b"], "statusNumber", [], "any", false, false, false, 72) == 2)) {
                // line 73
                yield "                            <span class=\"badge bg-primary\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 73), "html", null, true);
                yield "</span>
                        ";
            } else {
                // line 75
                yield "                            <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 75), "html", null, true);
                yield "</span>
                        ";
            }
            // line 77
            yield "                    </div>

                    ";
            // line 80
            yield "                    <p class=\"fw-semibold mb-2\" style=\"font-size:.95rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;\" title=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nomFormule", [], "any", false, false, false, 80), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "prixFormule", [], "any", false, false, false, 80), "html", null, true);
            yield ")\">
                        ";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nomFormule", [], "any", false, false, false, 81), "html", null, true);
            yield " <span class=\"text-muted fw-normal\">(";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "prixFormule", [], "any", false, false, false, 81), "html", null, true);
            yield ")</span>
                    </p>

                    ";
            // line 85
            yield "                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "typeBoost", [], "any", false, false, false, 85) == "quota")) {
                // line 86
                yield "
                        ";
                // line 88
                yield "                        <div class=\"d-flex justify-content-between align-items-center mb-1 small\">
                            <span class=\"text-muted\">Contacts reçus</span>
                            <strong class=\"text-primary\">
                                ";
                // line 91
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsObtenus", [], "any", false, false, false, 91), "html", null, true);
                yield " / ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", true, true, false, 91) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 91)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 91), "html", null, true)) : ("?"));
                yield "
                            </strong>
                        </div>

                        ";
                // line 96
                yield "                        <div class=\"progress mb-2\" style=\"height:8px; border-radius:4px;\">
                            <div class=\"progress-bar ";
                // line 97
                yield (((($context["pct"] ?? null) >= 100)) ? ("bg-success") : ("bg-primary"));
                yield "\"
                                 role=\"progressbar\"
                                 style=\"width: ";
                // line 99
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "%;\"
                                 aria-valuenow=\"";
                // line 100
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "\"
                                 aria-valuemin=\"0\"
                                 aria-valuemax=\"100\">
                            </div>
                        </div>

                        <p class=\"text-muted mb-0\" style=\"font-size:.78rem;\">";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateDebutFormule", [], "any", false, false, false, 106), "html", null, true);
                yield "</p>

                    ";
            } else {
                // line 109
                yield "
                        <p class=\"text-muted mb-0 small\">";
                // line 110
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateDebutFormule", [], "any", false, false, false, 110), "html", null, true);
                yield "</p>

                    ";
            }
            // line 113
            yield "
                </div>

                ";
            // line 117
            yield "                <div class=\"card-footer bg-transparent border-0 pt-0 text-end\">
                    <button type=\"button\"
                            class=\"btn btn-sm btn-outline-secondary rounded-pill\"
                            data-bs-toggle=\"modal\"
                            data-bs-target=\"#modal-boost-";
            // line 121
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "id", [], "any", false, false, false, 121), "html", null, true);
            yield "\">
                        <i class=\"bi bi-info-circle me-1\"></i>Détails
                    </button>
                </div>
            </div>
        </div>

        ";
            // line 129
            yield "        <div class=\"modal fade\" id=\"modal-boost-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "id", [], "any", false, false, false, 129), "html", null, true);
            yield "\" tabindex=\"-1\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-dialog-centered\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h6 class=\"modal-title fw-bold\">Détails du Boost</h6>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
                    </div>
                    <div class=\"modal-body\">

                        ";
            // line 139
            yield "                        <div class=\"d-flex flex-wrap gap-2 mb-3\">
                            ";
            // line 140
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeNumber", [], "any", false, false, false, 140) == 1)) {
                // line 141
                yield "                                <span class=\"badge bg-success fs-6\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeBoostFormule", [], "any", false, false, false, 141), "html", null, true);
                yield "</span>
                            ";
            } else {
                // line 143
                yield "                                <span class=\"badge bg-danger fs-6\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "modeBoostFormule", [], "any", false, false, false, 143), "html", null, true);
                yield "</span>
                            ";
            }
            // line 145
            yield "                            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "typeBoost", [], "any", false, false, false, 145) == "quota")) {
                // line 146
                yield "                                <span class=\"badge fs-6\" style=\"background:#512da8;\">
                                    <i class=\"bi bi-people me-1\"></i>Par Contacts
                                </span>
                            ";
            } else {
                // line 150
                yield "                                <span class=\"badge fs-6\" style=\"background:#455a64;\">
                                    <i class=\"bi bi-clock me-1\"></i>Par Durée
                                </span>
                            ";
            }
            // line 154
            yield "                            ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statusNumber", [], "any", false, false, false, 154) == 1)) {
                // line 155
                yield "                                <span class=\"badge bg-warning text-dark fs-6\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 155), "html", null, true);
                yield "</span>
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 156
$context["b"], "statusNumber", [], "any", false, false, false, 156) == 2)) {
                // line 157
                yield "                                <span class=\"badge bg-primary fs-6\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 157), "html", null, true);
                yield "</span>
                            ";
            } else {
                // line 159
                yield "                                <span class=\"badge bg-success fs-6\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "statutFormule", [], "any", false, false, false, 159), "html", null, true);
                yield "</span>
                            ";
            }
            // line 161
            yield "                        </div>

                        <table class=\"table table-sm table-borderless mb-0\">
                            <tbody>
                                <tr>
                                    <th class=\"text-muted fw-normal ps-0\" style=\"width:40%\">Formule</th>
                                    <td class=\"fw-semibold\">";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nomFormule", [], "any", false, false, false, 167), "html", null, true);
            yield "</td>
                                </tr>
                                <tr>
                                    <th class=\"text-muted fw-normal ps-0\">Prix</th>
                                    <td class=\"fw-semibold\">";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "prixFormule", [], "any", false, false, false, 171), "html", null, true);
            yield "</td>
                                </tr>
                                <tr>
                                    <th class=\"text-muted fw-normal ps-0\">Date de début</th>
                                    <td>";
            // line 175
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateDebut", [], "any", false, false, false, 175), "html", null, true);
            yield "</td>
                                </tr>
                                ";
            // line 177
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "typeBoost", [], "any", false, false, false, 177) == "quota")) {
                // line 178
                yield "                                    <tr>
                                        <th class=\"text-muted fw-normal ps-0\">Contacts reçus</th>
                                        <td>
                                            <strong class=\"text-primary\">";
                // line 181
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsObtenus", [], "any", false, false, false, 181), "html", null, true);
                yield "</strong>
                                            / ";
                // line 182
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", true, true, false, 182) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 182)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "nbContactsMax", [], "any", false, false, false, 182), "html", null, true)) : ("—"));
                yield "
                                        </td>
                                    </tr>
                                    ";
                // line 185
                if ((($tmp =  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateExp", [], "any", false, false, false, 185))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 186
                    yield "                                        <tr>
                                            <th class=\"text-muted fw-normal ps-0\">Date fin</th>
                                            <td>";
                    // line 188
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateExp", [], "any", false, false, false, 188), "html", null, true);
                    yield "</td>
                                        </tr>
                                    ";
                }
                // line 191
                yield "                                    <tr>
                                        <th class=\"text-muted fw-normal ps-0\">Progression</th>
                                        <td>
                                            <div class=\"progress mt-1\" style=\"height:10px; border-radius:5px;\">
                                                <div class=\"progress-bar ";
                // line 195
                yield (((($context["pct"] ?? null) >= 100)) ? ("bg-success") : ("bg-primary"));
                yield "\"
                                                     style=\"width: ";
                // line 196
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield "%;\"></div>
                                            </div>
                                            <small class=\"text-muted\">";
                // line 198
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pct"] ?? null), "html", null, true);
                yield " %</small>
                                        </td>
                                    </tr>
                                ";
            } else {
                // line 202
                yield "                                    <tr>
                                        <th class=\"text-muted fw-normal ps-0\">Date d\x27expiration</th>
                                        <td>";
                // line 204
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateExp", [], "any", true, true, false, 204) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateExp", [], "any", false, false, false, 204)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateExp", [], "any", false, false, false, 204), "html", null, true)) : ("—"));
                yield "</td>
                                    </tr>
                                    <tr>
                                        <th class=\"text-muted fw-normal ps-0\">Période</th>
                                        <td class=\"small\">";
                // line 208
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["b"], "dateDebutFormule", [], "any", false, false, false, 208), "html", null, true);
                yield "</td>
                                    </tr>
                                ";
            }
            // line 211
            yield "                            </tbody>
                        </table>

                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    ";
            $context['_iterated'] = true;
        }
        // line 222
        if (!$context['_iterated']) {
            // line 223
            yield "        <div class=\"col-12\">
            <div class=\"card border-0 bg-light text-center py-5\">
                <div class=\"card-body\">
                    <i class=\"bi bi-rocket-takeoff text-muted\" style=\"font-size: 3rem;\"></i>
                    <p class=\"mt-3 mb-1 fw-semibold text-muted\">Aucun Boost Contact trouvé.</p>
                    <p class=\"small text-muted mb-3\">Créez votre premier boost pour apparaître dans les listes de contacts.</p>
                    <a href=\"/newboostcontact\" class=\"btn btn-primary btn-sm\">
                        <i class=\"bi bi-plus-circle me-1\"></i> Créer un Boost
                    </a>
                </div>
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['b'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 236
        yield "</div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/listeboostcontact.html.twig";
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
        return array (  499 => 236,  481 => 223,  479 => 222,  464 => 211,  458 => 208,  451 => 204,  447 => 202,  440 => 198,  435 => 196,  431 => 195,  425 => 191,  419 => 188,  415 => 186,  413 => 185,  407 => 182,  403 => 181,  398 => 178,  396 => 177,  391 => 175,  384 => 171,  377 => 167,  369 => 161,  363 => 159,  357 => 157,  355 => 156,  350 => 155,  347 => 154,  341 => 150,  335 => 146,  332 => 145,  326 => 143,  320 => 141,  318 => 140,  315 => 139,  302 => 129,  292 => 121,  286 => 117,  281 => 113,  275 => 110,  272 => 109,  266 => 106,  257 => 100,  253 => 99,  248 => 97,  245 => 96,  236 => 91,  231 => 88,  228 => 86,  225 => 85,  217 => 81,  210 => 80,  206 => 77,  200 => 75,  194 => 73,  192 => 72,  187 => 71,  184 => 70,  180 => 67,  174 => 63,  168 => 59,  165 => 58,  162 => 56,  156 => 54,  150 => 52,  147 => 51,  143 => 48,  136 => 42,  133 => 41,  130 => 40,  127 => 39,  124 => 38,  121 => 37,  118 => 36,  115 => 34,  110 => 33,  107 => 32,  104 => 30,  92 => 20,  90 => 19,  78 => 11,  73 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/listeboostcontact.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/listeboostcontact.html.twig");
    }
}
