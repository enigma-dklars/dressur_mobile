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

/* crud_boost/new_admin.html.twig */
class __TwigTemplate_65f8c79988c69128a5124e3818735890 extends Template
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
        yield "Nouveau Boost Admin";
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
<div class=\"row g-2 mb-3\">
    <div class=\"col\">
        <span class=\"h4\"><i class=\"bi bi-rocket-takeoff me-2\"></i>Ajouter un Boost Contact</span>
        <span class=\"badge bg-success ms-2\">Activé immédiatement</span>
    </div>
    <div class=\"col-auto\">
        <a href=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\" class=\"btn btn-sm btn-secondary\">
            <i class=\"bi bi-arrow-left me-1\"></i>Retour à la liste
        </a>
    </div>
</div>

";
        // line 19
        if ((array_key_exists("errors", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["errors"] ?? null)) > 0))) {
            // line 20
            yield "    <div class=\"alert alert-danger\">
        <ul class=\"mb-0\">
            ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 23
                yield "                <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "        </ul>
    </div>
";
        }
        // line 28
        yield "
";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 29));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 30
            yield "    <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield " alert-dismissible fade show\">
        ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                yield "<p class=\"mb-0\">";
                yield $context["message"];
                yield "</p>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        yield "
<form method=\"post\" action=\"";
        // line 36
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_admin_new");
        yield "\">
<div class=\"row g-3\">

    ";
        // line 40
        yield "    <div class=\"col-md-7\">

        <div class=\"card mb-3\">
            <div class=\"card-header fw-semibold\">
                <i class=\"bi bi-person me-2\"></i>Bénéficiaire
            </div>
            <div class=\"card-body\">
                <label class=\"form-label\">Utilisateur <span class=\"text-danger\">*</span></label>
                <select name=\"user_id\" class=\"form-select single-select\" required>
                    <option value=\"\">-- Choisir un utilisateur --</option>
                    ";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 51
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 51), "html", null, true);
            yield "\">
                            ";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "pseudo", [], "any", false, false, false, 52), "html", null, true);
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 52), "html", null, true);
            }
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "mail", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "mail", [], "any", false, false, false, 52), "html", null, true);
                yield ")";
            }
            // line 53
            yield "                        </option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "                </select>
            </div>
        </div>

        <div class=\"card mb-3\">
            <div class=\"card-header fw-semibold\">
                <i class=\"bi bi-list-check me-2\"></i>Formule &amp; Mode
            </div>
            <div class=\"card-body\">
                <label class=\"form-label\">Formule <span class=\"text-danger\">*</span></label>
                <select name=\"formule_id\" id=\"formule_select\" class=\"form-select mb-3\" required>
                    <option value=\"\">-- Choisir une formule --</option>
                    ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 68
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "id", [], "any", false, false, false, 68), "html", null, true);
            yield "\"
                            data-type=\"";
            // line 69
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "typeBoost", [], "any", false, false, false, 69), "html", null, true);
            yield "\"
                            data-jours=\"";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 70), "html", null, true);
            yield "\"
                            data-quota=\"";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbContactsMax", [], "any", false, false, false, 71), "html", null, true);
            yield "\"
                            data-prix=\"";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 72), "html", null, true);
            yield "\">
                            ";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 73), "html", null, true);
            yield " — ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 73), "html", null, true);
            yield " FCFA —
                            ";
            // line 74
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["f"], "typeBoost", [], "any", false, false, false, 74) == "quota")) {
                // line 75
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbContactsMax", [], "any", false, false, false, 75), "html", null, true);
                yield " contacts
                            ";
            } else {
                // line 77
                yield "                                ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 77), "html", null, true);
                yield " jour(s)
                            ";
            }
            // line 79
            yield "                        </option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        yield "                </select>

                <div id=\"expiration_info\" class=\"alert alert-info py-2 mb-3\" style=\"display:none;\">
                    <i class=\"bi bi-calendar-check me-1\"></i>
                    Date d\x27expiration : <strong id=\"expiration_date\"></strong>
                </div>

                <label class=\"form-label\">Mode</label>
                <select name=\"mode\" class=\"form-select\">
                    <option value=\"Gratuit\">Gratuit</option>
                    <option value=\"Payant\">Payant</option>
                    <option value=\"Kdo\">Kdo</option>
                </select>
            </div>
        </div>

    </div>

    ";
        // line 100
        yield "    <div class=\"col-md-5\">

        <div class=\"card mb-3\">
            <div class=\"card-header fw-semibold\">
                <i class=\"bi bi-info-circle me-2\"></i>Récapitulatif
            </div>
            <div class=\"card-body small\">
                <table class=\"table table-sm mb-0\">
                    <tr><td>Source</td><td><span class=\"badge bg-dark\">admin</span></td></tr>
                    <tr><td>Date début</td><td>Maintenant</td></tr>
                    <tr>
                        <td>Type</td>
                        <td id=\"recap_type\" class=\"text-muted\">—</td>
                    </tr>
                    <tr>
                        <td id=\"recap_exp_label\">Date expiration</td>
                        <td id=\"recap_exp\" class=\"text-muted\">— choisir une formule —</td>
                    </tr>
                    <tr>
                        <td>Prix formule</td>
                        <td id=\"recap_prix\" class=\"text-muted\">—</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class=\"d-grid mt-2\">
            <button type=\"submit\" class=\"btn btn-success btn-lg\">
                <i class=\"bi bi-rocket-takeoff me-2\"></i>Enregistrer le boost
            </button>
        </div>

    </div>

</div>
</form>

";
        yield from [];
    }

    // line 139
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 140
        yield "<script>
(function () {
    var select    = document.getElementById(\x27formule_select\x27);
    var infoBox   = document.getElementById(\x27expiration_info\x27);
    var expDate   = document.getElementById(\x27expiration_date\x27);
    var recapExp  = document.getElementById(\x27recap_exp\x27);
    var recapExpLabel = document.getElementById(\x27recap_exp_label\x27);
    var recapType = document.getElementById(\x27recap_type\x27);
    var recapPrix = document.getElementById(\x27recap_prix\x27);
    select.addEventListener(\x27change\x27, function () {
        var opt   = this.options[this.selectedIndex];
        var type  = opt.getAttribute(\x27data-type\x27);
        var jours = parseInt(opt.getAttribute(\x27data-jours\x27) || \x270\x27);
        var quota = opt.getAttribute(\x27data-quota\x27);
        var prix  = opt.getAttribute(\x27data-prix\x27);
        if (!type) {
            infoBox.style.display  = \x27none\x27;
            recapExp.textContent   = \x27— choisir une formule —\x27;
            recapType.textContent  = \x27—\x27;
            recapPrix.textContent  = \x27—\x27;
            return;
        }
        recapPrix.textContent = prix ? prix + \x27 FCFA\x27 : \x27—\x27;
        recapType.textContent = type === \x27quota\x27 ? \x27Par Contacts (quota)\x27 : \x27Par Durée (date)\x27;
        if (type === \x27quota\x27) {
            infoBox.style.display      = \x27none\x27;
            recapExpLabel.textContent  = \x27Quota contacts\x27;
            recapExp.textContent       = quota ? quota + \x27 contacts max\x27 : \x27—\x27;
        } else {
            recapExpLabel.textContent  = \x27Date expiration\x27;
            var d = new Date();
            d.setDate(d.getDate() + jours);
            var label = d.toLocaleDateString(\x27fr-FR\x27, { day: \x272-digit\x27, month: \x27long\x27, year: \x27numeric\x27 });
            expDate.textContent   = label + \x27 (\x27 + jours + \x27 jour\x27 + (jours > 1 ? \x27s\x27 : \x27\x27) + \x27)\x27;
            recapExp.textContent  = label;
            infoBox.style.display = \x27block\x27;
        }
    });
})();
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_boost/new_admin.html.twig";
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
        return array (  327 => 140,  320 => 139,  278 => 100,  258 => 81,  251 => 79,  245 => 77,  239 => 75,  237 => 74,  231 => 73,  227 => 72,  223 => 71,  219 => 70,  215 => 69,  210 => 68,  206 => 67,  192 => 55,  185 => 53,  174 => 52,  169 => 51,  165 => 50,  153 => 40,  147 => 36,  144 => 35,  136 => 32,  125 => 31,  120 => 30,  116 => 29,  113 => 28,  108 => 25,  99 => 23,  95 => 22,  91 => 20,  89 => 19,  80 => 13,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_boost/new_admin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_boost/new_admin.html.twig");
    }
}
