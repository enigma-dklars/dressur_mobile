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

/* crud_promotion/new_admin.html.twig */
class __TwigTemplate_e1792295fecec06515414e6000a1ee06 extends Template
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
        yield "Nouvelle Promotion Admin";
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
        yield "<div class=\"row g-2 mb-3\">
    <div class=\"col\">
        <span class=\"h4\">Nouvelle Promotion Admin</span>
        <span class=\"badge bg-success ms-2\">Acceptée automatiquement</span>
    </div>
    <div class=\"col-auto\">
        <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index");
        yield "\" class=\"btn btn-sm btn-secondary\">← Retour à la liste</a>
    </div>
</div>

";
        // line 16
        if ((array_key_exists("errors", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["errors"] ?? null)) > 0))) {
            // line 17
            yield "    <div class=\"alert alert-danger\">
        <ul class=\"mb-0\">
            ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 20
                yield "                <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            yield "        </ul>
    </div>
";
        }
        // line 25
        yield "
<form method=\"post\" action=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_admin_new");
        yield "\" enctype=\"multipart/form-data\">

    <div class=\"row g-3\">

        ";
        // line 31
        yield "        <div class=\"col-md-7\">

            <div class=\"card mb-3\">
                <div class=\"card-header fw-semibold\">Bénéficiaire</div>
                <div class=\"card-body\">
                    <label class=\"form-label\">Utilisateur <span class=\"text-danger\">*</span></label>
                    <select name=\"user_id\" class=\"form-select single-select mb-2\" required>
                        <option value=\"\">-- Choisir un utilisateur --</option>
                        ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
            // line 40
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "id", [], "any", false, false, false, 40), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "pseudo", [], "any", false, false, false, 40), "html", null, true);
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "nom", [], "any", false, false, false, 40), "html", null, true);
            }
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["u"], "mail", [], "any", false, false, false, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield " (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["u"], "mail", [], "any", false, false, false, 40), "html", null, true);
                yield ")";
            }
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['u'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        yield "                    </select>
                </div>
            </div>

            <div class=\"card mb-3\">
                <div class=\"card-header fw-semibold\">Formule &amp; Type</div>
                <div class=\"card-body\">
                    <label class=\"form-label mt-1\">Type de promotion <span class=\"text-danger\">*</span></label>
                    <select name=\"type_promotion_affaire\" id=\"type_select\" class=\"form-select mb-3\" required>
                        <option value=\"produit_service\">Produit / Service</option>
                        <option value=\"sites_applications\">Sites &amp; Applications</option>
                        <option value=\"offre_emploi\">Offre d\x27emploi</option>
                        <option value=\"dmd_emploi\">Demande d\x27emploi</option>
                    </select>

                    <div id=\"formule_section\">
                        <label class=\"form-label\">Formule <span class=\"text-danger\">*</span></label>
                        <select name=\"formule_id\" id=\"formule_select\" class=\"form-select mb-2\">
                            <option value=\"\">-- Choisir une formule --</option>
                            ";
        // line 61
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["f"]) {
            // line 62
            yield "                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "id", [], "any", false, false, false, 62), "html", null, true);
            yield "\" data-jours=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 62), "html", null, true);
            yield "\">
                                    ";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "titre", [], "any", false, false, false, 63), "html", null, true);
            yield " — ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "prix", [], "any", false, false, false, 63), "html", null, true);
            yield " FCFA — ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["f"], "nbrJour", [], "any", false, false, false, 63), "html", null, true);
            yield " jour(s)
                                </option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['f'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        yield "                        </select>

                        <div id=\"expiration_info\" class=\"alert alert-info py-2 mb-2\" style=\"display:none;\">
                            <i class=\"fas fa-calendar-check me-1\"></i>
                            Date d\x27expiration calculée : <strong id=\"expiration_date\"></strong>
                        </div>
                    </div>

                    <div id=\"sites_applications_section\" style=\"display:none;\">
                        <div class=\"alert alert-info py-2 mb-3\">
                            <i class=\"fas fa-calendar-check me-1\"></i>
                            Durée fixe : <strong>365 jours</strong> — Prix : <strong>7 750 FCFA</strong>
                        </div>

                        <label class=\"form-label\">Sous-type <span class=\"text-danger\">*</span></label>
                        <select name=\"sous_type_site_app\" id=\"sous_type_select\" class=\"form-select mb-3\">
                            <option value=\"site_web\">Site web</option>
                            <option value=\"app_mobile\">Application mobile</option>
                            <option value=\"logiciel_desktop\">Logiciel / Application desktop</option>
                        </select>

                        <label class=\"form-label\">Nom du site / de l\x27application <span class=\"text-danger\">*</span></label>
                        <input type=\"text\" name=\"nom_site_app\" id=\"nom_site_app\" class=\"form-control mb-3\" maxlength=\"150\" placeholder=\"Ex : MonApplication\">

                        <label class=\"form-label\">URL <span class=\"text-danger\">*</span></label>
                        <input type=\"url\" name=\"url_site_app\" id=\"url_site_app\" class=\"form-control mb-1\" placeholder=\"https://monsite.com\">
                        <small class=\"text-muted d-block mb-2\" id=\"url_site_app_help\">Entrez l\x27URL de votre site ou application.</small>
                    </div>
                </div>
            </div>

            <div class=\"card mb-3\">
                <div class=\"card-header fw-semibold\">Description</div>
                <div class=\"card-body\">
                    <textarea name=\"description\" class=\"form-control\" rows=\"4\" placeholder=\"Décrivez la promotion…\" required></textarea>
                </div>
            </div>

        </div>

        ";
        // line 107
        yield "        <div class=\"col-md-5\">

            <div class=\"card mb-3\">
                <div class=\"card-header fw-semibold\">Image <span class=\"text-danger\">*</span> <span class=\"text-muted fw-normal small\">(max 1 Mo)</span></div>
                <div class=\"card-body\">
                    <input type=\"file\" name=\"image\" id=\"image_input\" class=\"form-control mb-3\" accept=\"image/*\" required>

                    <div id=\"image_preview_wrapper\" style=\"display:none;\">
                        <p class=\"mb-1 small text-muted\">Aperçu :</p>
                        <img id=\"image_preview\"
                             src=\"\"
                             alt=\"Aperçu\"
                             style=\"max-width:100%; max-height:260px; border-radius:8px; border:1px solid #dee2e6; object-fit:contain;\">
                        <div id=\"image_size_warning\" class=\"alert alert-warning py-1 mt-2 small\" style=\"display:none;\">
                            <i class=\"fas fa-exclamation-triangle me-1\"></i> Image trop grande (&gt; 1 Mo) — elle sera refusée.
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"card mb-3\">
                <div class=\"card-header fw-semibold\">Récapitulatif</div>
                <div class=\"card-body small\">
                    <table class=\"table table-sm mb-0\">
                        <tr><td>Status</td><td><span class=\"badge bg-success\">Acceptée (3)</span></td></tr>
                        <tr><td>Mode</td><td><span class=\"badge bg-secondary\">Admin</span></td></tr>
                        <tr><td>Source</td><td><span class=\"badge bg-dark\">admin</span></td></tr>
                        <tr><td>Date début</td><td>Maintenant</td></tr>
                        <tr><td>Date expiration</td><td id=\"recap_exp\" class=\"text-muted\">— choisir une formule —</td></tr>
                        <tr id=\"recap_soustype_row\" style=\"display:none;\"><td>Sous-type</td><td id=\"recap_soustype\" class=\"text-muted\">—</td></tr>
                        <tr id=\"recap_nom_row\" style=\"display:none;\"><td>Nom</td><td id=\"recap_nom\" class=\"text-muted\">—</td></tr>
                    </table>
                </div>
            </div>

            <div class=\"d-grid\">
                <button type=\"submit\" class=\"btn btn-success btn-lg\">
                    <i class=\"fas fa-check-circle me-2\"></i>Enregistrer la promotion
                </button>
            </div>
        </div>

    </div>

</form>
";
        yield from [];
    }

    // line 154
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 155
        yield "<script>
(function () {

    // ── Prévisualisation image ──────────────────────────────────────
    var input   = document.getElementById(\x27image_input\x27);
    var wrapper = document.getElementById(\x27image_preview_wrapper\x27);
    var preview = document.getElementById(\x27image_preview\x27);
    var warning = document.getElementById(\x27image_size_warning\x27);

    input.addEventListener(\x27change\x27, function () {
        var file = this.files[0];
        if (!file) { wrapper.style.display = \x27none\x27; return; }
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            wrapper.style.display = \x27block\x27;
            warning.style.display = (file.size > 1 * 1024 * 1024) ? \x27block\x27 : \x27none\x27;
        };
        reader.readAsDataURL(file);
    });

    // ── Placeholders URL selon sous-type ───────────────────────────
    var urlPlaceholders = {
        \x27site_web\x27:         \x27https://monsite.com\x27,
        \x27app_mobile\x27:       \x27https://play.google.com/... ou https://apps.apple.com/...\x27,
        \x27logiciel_desktop\x27: \x27https://monlogiciel.com/telecharger\x27
    };
    var sousTypeLabels = {
        \x27site_web\x27:         \x27Site web\x27,
        \x27app_mobile\x27:       \x27Application mobile\x27,
        \x27logiciel_desktop\x27: \x27Logiciel / Desktop\x27
    };

    var sousTypeSelect  = document.getElementById(\x27sous_type_select\x27);
    var urlInput        = document.getElementById(\x27url_site_app\x27);
    var recapSoustypeRow = document.getElementById(\x27recap_soustype_row\x27);
    var recapSoustype    = document.getElementById(\x27recap_soustype\x27);

    if (sousTypeSelect) {
        sousTypeSelect.addEventListener(\x27change\x27, function () {
            if (urlInput) urlInput.placeholder = urlPlaceholders[this.value] || \x27\x27;
            if (recapSoustype) recapSoustype.textContent = sousTypeLabels[this.value] || this.value;
        });
    }

    var nomInput    = document.getElementById(\x27nom_site_app\x27);
    var recapNomRow = document.getElementById(\x27recap_nom_row\x27);
    var recapNom    = document.getElementById(\x27recap_nom\x27);
    if (nomInput) {
        nomInput.addEventListener(\x27input\x27, function () {
            if (recapNom) recapNom.textContent = this.value || \x27—\x27;
        });
    }

    // ── Basculement sections selon type ────────────────────────────
    var typeSelect        = document.getElementById(\x27type_select\x27);
    var formuleSection    = document.getElementById(\x27formule_section\x27);
    var siteAppSection    = document.getElementById(\x27sites_applications_section\x27);
    var formuleSelectEl   = document.getElementById(\x27formule_select\x27);
    var recapExp          = document.getElementById(\x27recap_exp\x27);

    function toggleSections() {
        var isSiteApp = (typeSelect.value === \x27sites_applications\x27);

        formuleSection.style.display  = isSiteApp ? \x27none\x27 : \x27block\x27;
        siteAppSection.style.display  = isSiteApp ? \x27block\x27 : \x27none\x27;

        // formule non requise pour sites_applications
        if (formuleSelectEl) formuleSelectEl.required = !isSiteApp;

        if (isSiteApp) {
            var d = new Date();
            d.setDate(d.getDate() + 365);
            recapExp.textContent = d.toLocaleDateString(\x27fr-FR\x27, { day: \x272-digit\x27, month: \x27long\x27, year: \x27numeric\x27 }) + \x27 (365 jours)\x27;
            if (recapSoustypeRow) recapSoustypeRow.style.display = \x27\x27;
            if (recapNomRow)      recapNomRow.style.display      = \x27\x27;
            // Initialiser les valeurs recap
            if (recapSoustype) recapSoustype.textContent = sousTypeLabels[sousTypeSelect.value] || \x27—\x27;
            if (recapNom)      recapNom.textContent      = (nomInput && nomInput.value) ? nomInput.value : \x27—\x27;
        } else {
            recapExp.textContent = \x27— choisir une formule —\x27;
            if (recapSoustypeRow) recapSoustypeRow.style.display = \x27none\x27;
            if (recapNomRow)      recapNomRow.style.display      = \x27none\x27;
        }
    }

    typeSelect.addEventListener(\x27change\x27, toggleSections);
    toggleSections(); // init

    // ── Date d\x27expiration calculée (formule) ───────────────────────
    var infoBox  = document.getElementById(\x27expiration_info\x27);
    var expDate  = document.getElementById(\x27expiration_date\x27);

    if (formuleSelectEl) {
        formuleSelectEl.addEventListener(\x27change\x27, function () {
            var opt   = this.options[this.selectedIndex];
            var jours = parseInt(opt.getAttribute(\x27data-jours\x27));
            if (!jours) { infoBox.style.display = \x27none\x27; recapExp.textContent = \x27— choisir une formule —\x27; return; }

            var d = new Date();
            d.setDate(d.getDate() + jours);
            var label = d.toLocaleDateString(\x27fr-FR\x27, { day: \x272-digit\x27, month: \x27long\x27, year: \x27numeric\x27 });

            expDate.textContent  = label + \x27 (\x27 + jours + \x27 jour\x27 + (jours > 1 ? \x27s\x27 : \x27\x27) + \x27)\x27;
            recapExp.textContent = label;
            infoBox.style.display = \x27block\x27;
        });
    }

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
        return "crud_promotion/new_admin.html.twig";
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
        return array (  298 => 155,  291 => 154,  241 => 107,  199 => 66,  186 => 63,  179 => 62,  175 => 61,  154 => 42,  134 => 40,  130 => 39,  120 => 31,  113 => 26,  110 => 25,  105 => 22,  96 => 20,  92 => 19,  88 => 17,  86 => 16,  79 => 12,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_promotion/new_admin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_promotion/new_admin.html.twig");
    }
}
