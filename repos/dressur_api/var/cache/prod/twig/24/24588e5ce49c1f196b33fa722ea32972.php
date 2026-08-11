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

/* crud_transaction/index.html.twig */
class __TwigTemplate_46c562d0e4b27cc026de0a9cecbec76b extends Template
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
        yield "Transaction index";
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
        yield "    <p class=\"h4 me-3\">Transaction index</p>
    ";
        // line 8
        yield "
    <!-- Filtre Source -->
    <div class=\"mb-3 d-flex align-items-center gap-2\">
        <span class=\"small fw-semibold me-1\">Source :</span>
        <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index");
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">Tous (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "total", [], "any", false, false, false, 12), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "mobile"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "mobile")) ? ("bg-warning text-dark") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">mobile (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "mobile", [], "any", false, false, false, 13), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "web"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "web")) ? ("bg-primary text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">web (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "web", [], "any", false, false, false, 14), "html", null, true);
        yield ")</a>
        <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "none"]);
        yield "\" class=\"badge text-decoration-none ";
        yield (((($context["sourceFilter"] ?? null) == "none")) ? ("bg-dark text-white") : ("bg-secondary text-white"));
        yield "\" style=\"font-size:.8rem\">none (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["sourceCounts"] ?? null), "none", [], "any", false, false, false, 15), "html", null, true);
        yield ")</a>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Source</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>TransactionFor</th>
                    <th>IdTransaction</th>
                    <th>Amount</th>
                    <th>Reference</th>
                    <th>CustomerId</th>
                    <th>CurrencyId</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["transactions"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 40
            yield "                <tr>
                    <td></td>
                    <td>";
            // line 42
            yield from $this->load("crud_transaction/_delete_form.html.twig", 42)->unwrap()->yield($context);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 44
            $context["_src"] = (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "user", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "user", [], "any", false, false, false, 44), "registerSource", [], "any", false, false, false, 44)) : (null));
            // line 45
            yield "                        ";
            if ((($context["_src"] ?? null) == "web")) {
                // line 46
                yield "                            <span class=\"badge bg-primary\">web</span>
                        ";
            } elseif ((            // line 47
($context["_src"] ?? null) == "mobile")) {
                // line 48
                yield "                            <span class=\"badge bg-warning text-dark\">mobile</span>
                        ";
            } else {
                // line 50
                yield "                            <span class=\"badge bg-secondary\">none</span>
                        ";
            }
            // line 52
            yield "                    </td>
                    <td>
                        ";
            // line 54
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "user", [], "any", false, false, false, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 55
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "user", [], "any", false, false, false, 55), "pseudo", [], "any", false, false, false, 55), "html", null, true);
                yield "
                        ";
            } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,             // line 56
$context["transaction"], "userBot", [], "any", false, false, false, 56)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 57
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "userBot", [], "any", false, false, false, 57), "nom", [], "any", false, false, false, 57), "html", null, true);
                yield "
                            <span class=\"badge bg-secondary ms-1\">bot</span>
                        ";
            } else {
                // line 60
                yield "                            -
                        ";
            }
            // line 62
            yield "                    </td>
                    <td>                        
                        <span class=\"badge text-white fw-normal
                        ";
            // line 65
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 65) == "pending")) {
                yield "bg-warning";
            }
            // line 66
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 66) == "canceled")) {
                yield "bg-danger";
            }
            // line 67
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 67) == "approved")) {
                yield "bg-success";
            }
            // line 68
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 68) == "transferred")) {
                yield "bg-primary";
            }
            // line 69
            yield "                        ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 69) == "expired")) {
                yield "bg-dark";
            }
            // line 70
            yield "                        \">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "status", [], "any", false, false, false, 70), "html", null, true);
            yield "</span>
                    </td>
                    <td>";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "transactionFor", [], "any", false, false, false, 72), "html", null, true);
            yield "</td>
                    <td>";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "idTransaction", [], "any", false, false, false, 73), "html", null, true);
            yield "</td>
                    <td>";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "amount", [], "any", false, false, false, 74), "html", null, true);
            yield "</td>
                    <td>";
            // line 75
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "reference", [], "any", false, false, false, 75), "html", null, true);
            yield "</td>
                    <td>";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "customerId", [], "any", false, false, false, 76), "html", null, true);
            yield "</td>
                    <td>";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "currencyId", [], "any", false, false, false, 77), "html", null, true);
            yield "</td>
                    <td>";
            // line 78
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "createdAt", [], "any", false, false, false, 78)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "createdAt", [], "any", false, false, false, 78), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 79
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "updatedAt", [], "any", false, false, false, 79)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "updatedAt", [], "any", false, false, false, 79), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "id", [], "any", false, false, false, 80), "html", null, true);
            yield "</td>
                    ";
            // line 82
            yield "                </tr>
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
        // line 83
        if (!$context['_iterated']) {
            // line 84
            yield "                <tr>
                    <td colspan=\"13\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['transaction'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        yield "            </tbody>
        </table>
    </div>
";
        yield from [];
    }

    // line 93
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 94
        yield "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
<script>
\$(document).on(\x27click\x27, \x27.btn-force-process\x27, function () {
    const btn       = \$(this);
    const id        = btn.data(\x27id\x27);
    const forType   = btn.data(\x27for\x27);
    const status    = btn.data(\x27status\x27);

    Swal.fire({
        title: \x27Forcer le traitement ?\x27,
        html:  \x27<b>Type :</b> \x27 + forType + \x27<br><b>Statut actuel :</b> \x27 + status +
               \x27<br><br>Cette action va vérifier le paiement sur FedaPay et exécuter le traitement correspondant si le paiement est approuvé.\x27,
        icon:  \x27warning\x27,
        showCancelButton:  true,
        confirmButtonColor: \x27#f59e0b\x27,
        cancelButtonColor:  \x27#6b7280\x27,
        confirmButtonText:  \x27Oui, vérifier & traiter\x27,
        cancelButtonText:   \x27Annuler\x27,
    }).then((result) => {
        if (!result.isConfirmed) return;

        btn.prop(\x27disabled\x27, true).html(\x27<span class=\"spinner-border spinner-border-sm\"></span>\x27);

        fetch(\x27/api/admin/force-process/\x27 + id, {
            method: \x27POST\x27,
            headers: { \x27X-Requested-With\x27: \x27XMLHttpRequest\x27 },
        })
        .then(r => r.json())
        .then(data => {
            if (data.error) {
                Swal.fire({
                    title: \x27Échec\x27,
                    text:  data.message,
                    icon:  \x27error\x27,
                    confirmButtonText: \x27OK\x27,
                });
                btn.prop(\x27disabled\x27, false).html(\x27<i class=\"bi bi-arrow-repeat\"></i>\x27);
            } else {
                Swal.fire({
                    title: \x27Succès !\x27,
                    text:  data.message,
                    icon:  \x27success\x27,
                    confirmButtonText: \x27OK\x27,
                }).then(() => location.reload());
            }
        })
        .catch(() => {
            Swal.fire(\x27Erreur réseau\x27, \x27La requête a échoué. Réessayez.\x27, \x27error\x27);
            btn.prop(\x27disabled\x27, false).html(\x27<i class=\"bi bi-arrow-repeat\"></i>\x27);
        });
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
        return "crud_transaction/index.html.twig";
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
        return array (  314 => 94,  307 => 93,  299 => 88,  290 => 84,  288 => 83,  275 => 82,  271 => 80,  267 => 79,  263 => 78,  259 => 77,  255 => 76,  251 => 75,  247 => 74,  243 => 73,  239 => 72,  233 => 70,  228 => 69,  223 => 68,  218 => 67,  213 => 66,  209 => 65,  204 => 62,  200 => 60,  193 => 57,  191 => 56,  186 => 55,  184 => 54,  180 => 52,  176 => 50,  172 => 48,  170 => 47,  167 => 46,  164 => 45,  162 => 44,  157 => 42,  153 => 40,  135 => 39,  104 => 15,  96 => 14,  88 => 13,  80 => 12,  74 => 8,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_transaction/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_transaction/index.html.twig");
    }
}
