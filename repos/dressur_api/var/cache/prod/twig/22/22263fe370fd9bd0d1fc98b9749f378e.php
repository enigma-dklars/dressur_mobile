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

/* crud_formule_promo_reseau/service_description.html.twig */
class __TwigTemplate_f83c794439f6549c2d72a54e376570f1 extends Template
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
        yield "Service + Description";
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
<div class=\"d-flex align-items-center justify-content-between mb-3\">
    <h4 class=\"mb-0\"><i class=\"bi bi-pencil-square me-2\"></i>Service + Description</h4>
    <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_formule_promo_reseau_index");
        yield "\" class=\"btn btn-sm btn-outline-secondary\">
        <i class=\"bi bi-arrow-left me-1\"></i>Retour à la liste
    </a>
</div>

";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 14));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 15
            yield "    <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield " alert-dismissible fade show\" role=\"alert\">
        ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 17
                yield "            <p class=\"mb-0\">";
                yield $context["message"];
                yield "</p>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            yield "        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        yield "
<form action=\"\" method=\"post\" id=\"form-service-desc\">
<div class=\"row g-4\">

    ";
        // line 27
        yield "    <div class=\"col-lg-5\">

        ";
        // line 30
        yield "        <div class=\"card shadow-sm mb-3\">
            <div class=\"card-header bg-danger text-white fw-bold\">
                <i class=\"bi bi-search me-2\"></i>ID du service
            </div>
            <div class=\"card-body\">
                <div class=\"input-group\">
                    <input type=\"number\"
                           name=\"id_service\"
                           id=\"id_service\"
                           class=\"form-control form-control-lg\"
                           placeholder=\"ex: 1087\"
                           value=\"";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["idService"] ?? null), "html", null, true);
        yield "\"
                           autocomplete=\"off\"
                           min=\"1\">
                    <button type=\"button\" class=\"btn btn-outline-secondary\" id=\"btn-lookup\" title=\"Rechercher\">
                        <i class=\"bi bi-search\"></i>
                    </button>
                </div>
                <div class=\"mt-2\">
                    <button type=\"button\" class=\"btn btn-warning w-100\" id=\"btn-next-sans-desc\">
                        <i class=\"bi bi-lightning-charge-fill me-1\"></i>Trouver suivant sans description
                    </button>
                    <div id=\"next-sans-desc-status\" class=\"form-text mt-1\"></div>
                </div>
                <div id=\"lookup-status\" class=\"form-text mt-1\"></div>
            </div>
        </div>

        ";
        // line 59
        yield "        <div class=\"card shadow-sm\">
            <div class=\"card-header fw-bold\">
                <i class=\"bi bi-sliders me-2\"></i>Champs à modifier
            </div>
            <div class=\"card-body\">

                <div class=\"row g-2 mb-3\">
                    <div class=\"col-6\">
                        <label class=\"form-label fw-semibold small\">Prix DS</label>
                        <input type=\"number\" step=\"any\" name=\"prix\" id=\"field-prix\"
                               class=\"form-control\" placeholder=\"0.000\">
                    </div>
                    <div class=\"col-6\">
                        <label class=\"form-label fw-semibold small\">Prix Zefame</label>
                        <input type=\"number\" step=\"any\" name=\"prix_zefame\" id=\"field-prix-zef\"
                               class=\"form-control\" placeholder=\"0.000\">
                    </div>
                    <div class=\"col-6\">
                        <label class=\"form-label fw-semibold small\">Qté Min</label>
                        <input type=\"number\" step=\"1\" name=\"qte_min\" id=\"field-qte-min\"
                               class=\"form-control\" placeholder=\"0\">
                    </div>
                    <div class=\"col-6\">
                        <label class=\"form-label fw-semibold small\">Qté Max</label>
                        <input type=\"number\" step=\"1\" name=\"qte_max\" id=\"field-qte-max\"
                               class=\"form-control\" placeholder=\"0\">
                    </div>
                </div>

                <div class=\"mb-3\">
                    <label for=\"description_service\" class=\"form-label fw-semibold small\">Description (FR)</label>
                    <textarea name=\"description_service\"
                              id=\"description_service\"
                              rows=\"10\"
                              class=\"form-control font-monospace\"
                              placeholder=\"Chargée automatiquement après la recherche…\"></textarea>
                    <div class=\"form-text\">\"Zefame\" / \"zefame\" → \"Dressur\" à l\x27enregistrement.</div>
                </div>

                <button type=\"submit\" class=\"btn btn-danger w-100\" id=\"btn-submit\" disabled>
                    <i class=\"bi bi-floppy me-2\"></i>Enregistrer les modifications
                </button>

            </div>
        </div>
    </div>

    ";
        // line 107
        yield "    <div class=\"col-lg-7\">

        <div id=\"card-loading\" class=\"card shadow-sm d-none\">
            <div class=\"card-body text-center py-5\">
                <div class=\"spinner-border text-danger\" role=\"status\"></div>
                <div class=\"mt-2 text-muted small\">Recherche en cours…</div>
            </div>
        </div>

        <div class=\"card shadow-sm\" id=\"card-info\" style=\"opacity:.35;pointer-events:none;\">
            <div class=\"card-header fw-bold d-flex justify-content-between align-items-center\">
                <span><i class=\"bi bi-info-circle me-2\"></i>Informations actuelles en base</span>
                <span id=\"badge-available\" class=\"badge bg-secondary\">—</span>
            </div>
            <div class=\"card-body\">

                <div class=\"mb-3\">
                    <label class=\"form-label text-muted small mb-1\">Titre</label>
                    <div class=\"fw-semibold fs-6\" id=\"info-titre\"><span class=\"text-muted\">—</span></div>
                </div>

                <div class=\"row g-2 mb-3\">
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">Prix DS</div>
                            <div class=\"fw-bold text-primary\" id=\"info-prix\">—</div>
                        </div>
                    </div>
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">Qté</div>
                            <div class=\"fw-bold\" id=\"info-qte\">—</div>
                        </div>
                    </div>
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">Qté Min</div>
                            <div class=\"fw-bold text-warning\" id=\"info-qteMin\">—</div>
                        </div>
                    </div>
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">Qté Max</div>
                            <div class=\"fw-bold text-danger\" id=\"info-qteMax\">—</div>
                        </div>
                    </div>
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">Prix Zefame</div>
                            <div class=\"fw-bold text-success\" id=\"info-prixZef\">—</div>
                        </div>
                    </div>
                    <div class=\"col-6 col-md-3\">
                        <div class=\"border rounded p-2 text-center\">
                            <div class=\"text-muted small mb-1\">ID interne</div>
                            <div class=\"fw-bold text-secondary\" id=\"info-id\">—</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class=\"form-label text-muted small mb-1\">Description actuellement en base</label>
                    <div class=\"border rounded p-2 bg-light font-monospace small\"
                         id=\"info-desc-preview\"
                         style=\"max-height:220px;overflow-y:auto;white-space:pre-wrap;\">(aucune description enregistrée)</div>
                </div>

            </div>
        </div>
    </div>

</div>
</form>

<script>
(function () {
    const inputId    = document.getElementById(\x27id_service\x27);
    const btnLookup  = document.getElementById(\x27btn-lookup\x27);
    const statusEl   = document.getElementById(\x27lookup-status\x27);
    const cardInfo   = document.getElementById(\x27card-info\x27);
    const cardLoad   = document.getElementById(\x27card-loading\x27);
    const btnSubmit  = document.getElementById(\x27btn-submit\x27);

    const elTitre    = document.getElementById(\x27info-titre\x27);
    const elPrix     = document.getElementById(\x27info-prix\x27);
    const elQte      = document.getElementById(\x27info-qte\x27);
    const elQteMin   = document.getElementById(\x27info-qteMin\x27);
    const elQteMax   = document.getElementById(\x27info-qteMax\x27);
    const elPrixZef  = document.getElementById(\x27info-prixZef\x27);
    const elId       = document.getElementById(\x27info-id\x27);
    const elBadge    = document.getElementById(\x27badge-available\x27);
    const elDescPrev = document.getElementById(\x27info-desc-preview\x27);

    // Champs éditables
    const fPrix      = document.getElementById(\x27field-prix\x27);
    const fPrixZef   = document.getElementById(\x27field-prix-zef\x27);
    const fQteMin    = document.getElementById(\x27field-qte-min\x27);
    const fQteMax    = document.getElementById(\x27field-qte-max\x27);
    const fDesc      = document.getElementById(\x27description_service\x27);

    let debounceTimer = null;

    function setStatus(html, type) {
        statusEl.className = \x27form-text mt-1 text-\x27 + (type || \x27secondary\x27);
        statusEl.innerHTML = html;
    }

    function setLoading(on) {
        cardLoad.classList.toggle(\x27d-none\x27, !on);
        cardInfo.classList.toggle(\x27d-none\x27, on);
    }

    function resetAll() {
        cardInfo.style.opacity = \x270.35\x27;
        cardInfo.style.pointerEvents = \x27none\x27;
        btnSubmit.disabled = true;

        elTitre.innerHTML = \x27<span class=\"text-muted\">—</span>\x27;
        [elPrix, elQte, elQteMin, elQteMax, elPrixZef, elId].forEach(el => el.textContent = \x27—\x27);
        elBadge.textContent = \x27—\x27;
        elBadge.className = \x27badge bg-secondary\x27;
        elDescPrev.textContent = \x27(aucune description enregistrée)\x27;

        fPrix.value = \x27\x27;
        fPrixZef.value = \x27\x27;
        fQteMin.value = \x27\x27;
        fQteMax.value = \x27\x27;
        fDesc.value = \x27\x27;
    }

    function fillAll(data) {
        if (!data.found) { resetAll(); return; }

        cardInfo.style.opacity = \x271\x27;
        cardInfo.style.pointerEvents = \x27auto\x27;
        btnSubmit.disabled = false;

        // Panneau info (lecture)
        let titreHtml = \x27\x27;
        if (data.parent) titreHtml += \x27<span class=\"text-muted\">\x27 + data.parent.titre + \x27 › </span>\x27;
        titreHtml += \x27<strong>\x27 + (data.titre || \x27\x27) + \x27</strong>\x27;
        elTitre.innerHTML = titreHtml;

        elPrix.textContent    = data.prix        ?? \x27—\x27;
        elQte.textContent     = data.qte         ?? \x27—\x27;
        elQteMin.textContent  = data.qteMin      ?? \x27—\x27;
        elQteMax.textContent  = data.qteMax      ?? \x27—\x27;
        elPrixZef.textContent = data.prixZefame  ?? \x27—\x27;
        elId.textContent      = data.id          ?? \x27—\x27;

        elBadge.textContent = data.available ? \x27Actif\x27 : \x27Inactif\x27;
        elBadge.className   = \x27badge \x27 + (data.available ? \x27bg-success\x27 : \x27bg-danger\x27);
        elDescPrev.textContent = data.description || \x27(aucune description enregistrée)\x27;

        // Champs éditables pré-remplis
        fPrix.value    = data.prix       !== null ? data.prix       : \x27\x27;
        fPrixZef.value = data.prixZefame !== null ? data.prixZefame : \x27\x27;
        fQteMin.value  = data.qteMin     !== null ? data.qteMin     : \x27\x27;
        fQteMax.value  = data.qteMax     !== null ? data.qteMax     : \x27\x27;
        fDesc.value    = data.description || \x27\x27;
    }

    function lookup() {
        const val = parseInt(inputId.value, 10);
        if (!val || val <= 0) {
            setStatus(\x27Saisissez un ID valide.\x27, \x27warning\x27);
            resetAll();
            return;
        }

        setStatus(\x27<span class=\"spinner-border spinner-border-sm me-1\"></span>Recherche…\x27);
        setLoading(true);

        fetch(\x27/crud/formule/promo/reseau/service_description/info?id_service=\x27 + val)
            .then(r => r.json())
            .then(data => {
                setLoading(false);
                if (data.found) {
                    setStatus(\x27<i class=\"bi bi-check-circle-fill me-1\"></i>Trouvé : <strong>\x27 + (data.titre || \x27\x27) + \x27</strong>\x27, \x27success\x27);
                } else {
                    setStatus(\x27<i class=\"bi bi-x-circle-fill me-1\"></i>\x27 + (data.message || \x27Introuvable\x27), \x27danger\x27);
                }
                fillAll(data);
            })
            .catch(() => {
                setLoading(false);
                setStatus(\x27<i class=\"bi bi-x-circle-fill me-1\"></i>Erreur réseau.\x27, \x27danger\x27);
                resetAll();
            });
    }

    btnLookup.addEventListener(\x27click\x27, lookup);

    // ── Bouton \"Trouver suivant sans description\" ──────────────
    const btnNext      = document.getElementById(\x27btn-next-sans-desc\x27);
    const nextStatus   = document.getElementById(\x27next-sans-desc-status\x27);

    function setNextStatus(html, type) {
        nextStatus.innerHTML = html;
        nextStatus.className = \x27form-text mt-1\x27 + (type ? \x27 text-\x27 + type : \x27\x27);
    }

    btnNext.addEventListener(\x27click\x27, function () {
        btnNext.disabled = true;
        setNextStatus(\x27<span class=\"spinner-border spinner-border-sm me-1\"></span>Recherche…\x27);

        fetch(\x27/crud/formule/promo/reseau/service_description/next-sans-description\x27)
            .then(r => r.json())
            .then(data => {
                btnNext.disabled = false;
                if (data.found) {
                    inputId.value = data.idZefame;
                    setNextStatus(\x27<i class=\"bi bi-check-circle-fill me-1\"></i>ID <strong>\x27 + data.idZefame + \x27</strong> chargé.\x27, \x27success\x27);
                    lookup();
                } else {
                    setNextStatus(\x27<i class=\"bi bi-check2-all me-1\"></i>\x27 + (data.message || \x27Aucune formule sans description.\x27), \x27success\x27);
                    resetAll();
                }
            })
            .catch(() => {
                btnNext.disabled = false;
                setNextStatus(\x27<i class=\"bi bi-x-circle-fill me-1\"></i>Erreur réseau.\x27, \x27danger\x27);
            });
    });

    inputId.addEventListener(\x27input\x27, function () {
        clearTimeout(debounceTimer);
        const val = parseInt(this.value, 10);
        if (val > 0) {
            setStatus(\x27…\x27);
            debounceTimer = setTimeout(lookup, 500);
        } else {
            setStatus(\x27\x27);
            resetAll();
        }
    });

    inputId.addEventListener(\x27keydown\x27, function (e) {
        if (e.key === \x27Enter\x27) { e.preventDefault(); clearTimeout(debounceTimer); lookup(); }
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
        return "crud_formule_promo_reseau/service_description.html.twig";
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
        return array (  205 => 107,  156 => 59,  136 => 41,  123 => 30,  119 => 27,  113 => 22,  105 => 19,  96 => 17,  92 => 16,  87 => 15,  83 => 14,  75 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_formule_promo_reseau/service_description.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_formule_promo_reseau/service_description.html.twig");
    }
}
