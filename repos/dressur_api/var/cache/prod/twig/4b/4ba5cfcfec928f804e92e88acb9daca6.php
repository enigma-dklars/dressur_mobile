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

/* crud_user/index.html.twig */
class __TwigTemplate_46ee3d1d22f04a66398c4395692086c3 extends Template
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
            'script' => [$this, 'block_script'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return $this->load((((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 1) == true)) ? ("basePrivate.html.twig") : ("baseAdmin.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "User : ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["option"] ?? null), "html", null, true);
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
        yield "    <div class=\"row g-2 mb-4\">
        <div class=\"col-md-6\">
            <p class=\"h4 me-3\">User : ";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["option"] ?? null), "html", null, true);
        yield "</p>
        </div>
        <div class=\"col-md-6\">
            <!-- Barre de recherche -->
            <form method=\"get\" class=\"d-flex\">
                <input type=\"text\" name=\"search\" class=\"form-control me-2\" 
                       placeholder=\"Rechercher...\" value=\"";
        // line 14
        yield (((array_key_exists("search", $context) &&  !(null === $context["search"]))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["search"], "html", null, true)) : (""));
        yield "\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    <i class=\"fas fa-search\"></i>
                </button>
                ";
        // line 18
        if ((($tmp = ($context["search"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 19
            yield "                    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
            yield "\" class=\"btn btn-secondary ms-2\">
                        <i class=\"fas fa-times\"></i>
                    </a>
                ";
        }
        // line 23
        yield "            </form>
        </div>
    </div>

    <!-- Filtre Source -->
    <div class=\"mb-3 d-flex align-items-center gap-2\">
        <span class=\"fw-semibold me-1\">Source :</span>
        <a href=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["search" => ($context["search"] ?? null), "limit" => ($context["limit"] ?? null)]), "html", null, true);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">Tous (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "total", [], "any", false, false, false, 30), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "mobile", "search" => ($context["search"] ?? null), "limit" => ($context["limit"] ?? null)]), "html", null, true);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "mobile")) ? ("bg-warning text-dark") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">mobile (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "mobile", [], "any", false, false, false, 31), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "web", "search" => ($context["search"] ?? null), "limit" => ($context["limit"] ?? null)]), "html", null, true);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "web")) ? ("bg-primary text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">web (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "web", [], "any", false, false, false, 32), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "none", "search" => ($context["search"] ?? null), "limit" => ($context["limit"] ?? null)]), "html", null, true);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "none")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">none (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "none", [], "any", false, false, false, 33), "html", null, true);
        yield ")</a>
    </div>

    <!-- Informations sur les résultats -->
    <div class=\"alert alert-info mb-3 small p-1 text-center\">
        <strong>";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["totalItems"] ?? null), "html", null, true);
        yield "</strong> utilisateur(s) trouvé(s)
        ";
        // line 39
        if ((($tmp = ($context["search"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 40
            yield "            pour la recherche : \"<strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["search"] ?? null), "html", null, true);
            yield "</strong>\"
        ";
        }
        // line 42
        yield "    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped my-5\">
            <thead>
                <tr>
                    <th></th>
                    <th>Source</th>
                    <th>Pseudo</th>
                    <th>Tel</th>
                    <th>Tel V.</th>
                    <th>Mail</th>
                    <th>Mail V.</th>
                    <th>Rec?</th>
                    <th>Vendeur?</th>
                    <th>Solde</th>
                    ";
        // line 59
        yield "                    ";
        // line 60
        yield "                    ";
        // line 61
        yield "                    <th>Lock</th>
                    <th>LastLoginTo</th>
                    <th>CreatedAt</th>
                    <th>Uid</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 69
        $context["adminUser"] = ($context["user"] ?? null);
        // line 70
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 71
            yield "                <tr>
                    <td>";
            // line 72
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["adminUser"] ?? null), "lecteur", [], "any", false, false, false, 72) != true)) {
                yield from $this->load("crud_user/_delete_form.html.twig", 72)->unwrap()->yield($context);
            }
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 74
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "registerSource", [], "any", false, false, false, 74) == "web")) {
                // line 75
                yield "                            <span class=\"badge bg-primary\">web</span>
                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 76
$context["user"], "registerSource", [], "any", false, false, false, 76) == "mobile")) {
                // line 77
                yield "                            <span class=\"badge bg-warning text-dark\">mobile</span>
                        ";
            } else {
                // line 79
                yield "                            <span class=\"badge bg-secondary\">none</span>
                        ";
            }
            // line 81
            yield "                    </td>
                    <td>
                        ";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "pseudo", [], "any", false, false, false, 83), "html", null, true);
            yield "
                    </td>
                    <td>";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "tel", [], "any", false, false, false, 85), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 87
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "telIsVerified", [], "any", false, false, false, 87) == true)) {
                // line 88
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 90
                yield "                            ";
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["adminUser"] ?? null), "lecteur", [], "any", false, false, false, 90) != true)) {
                    // line 91
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerTel", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 91)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation du numéro WhatsApp ?\x27)\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 92
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_tel" . CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 92))), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"text-white badge bg-danger border-0\">Activer</button>
                            </form>
                            ";
                }
                // line 96
                yield "                        ";
            }
            // line 97
            yield "                    </td>
                    <td class=\"small\">";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "mail", [], "any", false, false, false, 98), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 100
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "mailIsVerified", [], "any", false, false, false, 100) == true)) {
                // line 101
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 103
                yield "                            ";
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["adminUser"] ?? null), "lecteur", [], "any", false, false, false, 103) != true)) {
                    // line 104
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerMail", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 104)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation de l\\\x27adresse mail ?\x27)\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 105
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_mail" . CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 105))), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"text-white badge bg-danger border-0\">Activer</button>
                            </form>
                            ";
                }
                // line 109
                yield "                        ";
            }
            // line 110
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 112
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isInscritProgrammeRecompense", [], "any", false, false, false, 112)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 113
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 115
                yield "                            <span class=\"badge bg-danger\">No</span>                                
                        ";
            }
            // line 117
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 119
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isVendeur", [], "any", false, false, false, 119)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 120
                yield "                            <span class=\"badge bg-success\">Yes</span>
                        ";
            } else {
                // line 122
                yield "                            <span class=\"badge bg-danger\">No</span>
                        ";
            }
            // line 124
            yield "                    </td>
                    <td class=\"text-end\">";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "soldeProgrammeRecompense", [], "any", false, false, false, 125), "html", null, true);
            yield "</td>
                    ";
            // line 135
            yield "                    <td class=\"text-center\">
                        ";
            // line 136
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "blocked", [], "any", false, false, false, 136)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-danger\">Yes</span>") : ("<span class=\"badge bg-success\">No</span>"));
            yield "
                    </td>
                    <td>";
            // line 138
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "lastLoginTo", [], "any", false, false, false, 138)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "lastLoginTo", [], "any", false, false, false, 138), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 139
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 139)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 139), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "uid", [], "any", false, false, false, 140), "html", null, true);
            yield "</td>
                    <td>";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 141), "html", null, true);
            yield "</td>
                </tr>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 143
        if (!$context['_iterated']) {
            // line 144
            yield "                <tr>
                    <td colspan=\"22\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        yield "            </tbody>
        </table>
    </div>

    <!-- Pagination Bootstrap 5 -->
    ";
        // line 153
        if ((($context["totalPages"] ?? null) > 1)) {
            // line 154
            yield "    <nav aria-label=\"Page navigation\" class=\"mt-3\">
        <ul class=\"pagination justify-content-center\">
            <!-- Premier -->
            <li class=\"page-item ";
            // line 157
            if ((($context["currentPage"] ?? null) == 1)) {
                yield "disabled";
            }
            yield "\">
                <a class=\"page-link\" 
                   href=\"";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["page" => 1, "search" => ($context["search"] ?? null)]), "html", null, true);
            yield "\">
                    <i class=\"fas fa-angle-double-left\"></i>
                </a>
            </li>
            
            <!-- Précédent -->
            <li class=\"page-item ";
            // line 165
            if ((($context["currentPage"] ?? null) == 1)) {
                yield "disabled";
            }
            yield "\">
                <a class=\"page-link\" 
                   href=\"";
            // line 167
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["page" => (($context["currentPage"] ?? null) - 1), "search" => ($context["search"] ?? null)]), "html", null, true);
            yield "\">
                    <i class=\"fas fa-angle-left\"></i>
                </a>
            </li>
            
            <!-- Pages -->
            ";
            // line 173
            $context["startPage"] = max(1, (($context["currentPage"] ?? null) - 2));
            // line 174
            yield "            ";
            $context["endPage"] = min(($context["totalPages"] ?? null), (($context["startPage"] ?? null) + 4));
            // line 175
            yield "            ";
            $context["startPage"] = max(1, (($context["endPage"] ?? null) - 4));
            // line 176
            yield "            
            ";
            // line 177
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(($context["startPage"] ?? null), ($context["endPage"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 178
                yield "                <li class=\"page-item ";
                if (($context["i"] == ($context["currentPage"] ?? null))) {
                    yield "active";
                }
                yield "\">
                    <a class=\"page-link\" 
                       href=\"";
                // line 180
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["page" => $context["i"], "search" => ($context["search"] ?? null)]), "html", null, true);
                yield "\">
                        ";
                // line 181
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
                yield "
                    </a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 185
            yield "            
            <!-- Suivant -->
            <li class=\"page-item ";
            // line 187
            if ((($context["currentPage"] ?? null) == ($context["totalPages"] ?? null))) {
                yield "disabled";
            }
            yield "\">
                <a class=\"page-link\" 
                   href=\"";
            // line 189
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["page" => (($context["currentPage"] ?? null) + 1), "search" => ($context["search"] ?? null)]), "html", null, true);
            yield "\">
                    <i class=\"fas fa-angle-right\"></i>
                </a>
            </li>
            
            <!-- Dernier -->
            <li class=\"page-item ";
            // line 195
            if ((($context["currentPage"] ?? null) == ($context["totalPages"] ?? null))) {
                yield "disabled";
            }
            yield "\">
                <a class=\"page-link\" 
                   href=\"";
            // line 197
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["page" => ($context["totalPages"] ?? null), "search" => ($context["search"] ?? null)]), "html", null, true);
            yield "\">
                    <i class=\"fas fa-angle-double-right\"></i>
                </a>
            </li>
        </ul>
    </nav>
    ";
        }
        // line 204
        yield "
    <!-- Sélecteur de limite par page -->
    <div class=\"d-flex justify-content-end align-items-center mt-3\">
        <span class=\"me-2\">Afficher :</span>
        <select class=\"form-select form-select-sm\" style=\"width: auto;\" onchange=\"changeLimit(this.value)\">
            <option value=\"10\" ";
        // line 209
        if ((($context["limit"] ?? null) == 10)) {
            yield "selected";
        }
        yield ">10</option>
            <option value=\"20\" ";
        // line 210
        if ((($context["limit"] ?? null) == 20)) {
            yield "selected";
        }
        yield ">20</option>
            <option value=\"50\" ";
        // line 211
        if ((($context["limit"] ?? null) == 50)) {
            yield "selected";
        }
        yield ">50</option>
            <option value=\"100\" ";
        // line 212
        if ((($context["limit"] ?? null) == 100)) {
            yield "selected";
        }
        yield ">100</option>
        </select>
        <span class=\"ms-2\">par page</span>
    </div>
";
        yield from [];
    }

    // line 218
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 219
        yield "<script>
function changeLimit(limit) {
    const url = new URL(window.location.href);
    url.searchParams.set(\x27limit\x27, limit);
    url.searchParams.set(\x27page\x27, 1); // Retour à la première page
    window.location.href = url.toString();
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
        return "crud_user/index.html.twig";
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
        return array (  551 => 219,  544 => 218,  532 => 212,  526 => 211,  520 => 210,  514 => 209,  507 => 204,  497 => 197,  490 => 195,  481 => 189,  474 => 187,  470 => 185,  460 => 181,  456 => 180,  448 => 178,  444 => 177,  441 => 176,  438 => 175,  435 => 174,  433 => 173,  424 => 167,  417 => 165,  408 => 159,  401 => 157,  396 => 154,  394 => 153,  387 => 148,  378 => 144,  376 => 143,  361 => 141,  357 => 140,  353 => 139,  349 => 138,  344 => 136,  341 => 135,  337 => 125,  334 => 124,  330 => 122,  326 => 120,  324 => 119,  320 => 117,  316 => 115,  312 => 113,  310 => 112,  306 => 110,  303 => 109,  296 => 105,  291 => 104,  288 => 103,  284 => 101,  282 => 100,  277 => 98,  274 => 97,  271 => 96,  264 => 92,  259 => 91,  256 => 90,  252 => 88,  250 => 87,  245 => 85,  240 => 83,  236 => 81,  232 => 79,  228 => 77,  226 => 76,  223 => 75,  221 => 74,  214 => 72,  211 => 71,  192 => 70,  190 => 69,  180 => 61,  178 => 60,  176 => 59,  158 => 42,  152 => 40,  150 => 39,  146 => 38,  134 => 33,  126 => 32,  118 => 31,  110 => 30,  101 => 23,  93 => 19,  91 => 18,  84 => 14,  75 => 8,  71 => 6,  64 => 5,  52 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user/index.html.twig");
    }
}
