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

/* private/deleteCompte.html.twig */
class __TwigTemplate_e6503e8d438b0bdc2fe8b34410b4b15f extends Template
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
        yield "Supprimer mon compte";
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
        yield "<div class=\"row justify-content-center\">
    <div class=\"col-md-7 col-lg-6\">

        ";
        // line 10
        yield "        <div class=\"alert alert-danger d-flex gap-3 align-items-start mb-4\" role=\"alert\">
            <i class=\"fas fa-triangle-exclamation fa-lg mt-1 flex-shrink-0\"></i>
            <div>
                <div class=\"fw-bold mb-1\">Action irréversible</div>
                <div class=\"small\">
                    La suppression de votre compte entraîne la perte définitive de toutes vos données :
                    contacts, boosts, promotions, préférences et historiques.
                    Cette action <strong>ne peut pas être annulée</strong>.
                </div>
            </div>
        </div>

        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-body p-4\">
                <h5 class=\"fw-bold mb-4 text-danger\">
                    <i class=\"fas fa-trash me-2\"></i>Supprimer mon compte
                </h5>

                ";
        // line 29
        yield "                <div class=\"mb-3\">
                    <label for=\"inputMotif\" class=\"form-label fw-semibold\">
                        Motif de suppression <span class=\"text-danger\">*</span>
                    </label>
                    <textarea id=\"inputMotif\" class=\"form-control\" rows=\"4\"
                              placeholder=\"Expliquez brièvement pourquoi vous souhaitez supprimer votre compte…\"
                              maxlength=\"500\"></textarea>
                    <div class=\"form-text\">Minimum 100 caractères.</div>
                </div>

                ";
        // line 40
        yield "                <div class=\"mb-4\">
                    <label for=\"inputConfirm\" class=\"form-label fw-semibold\">
                        Tapez <code>supprimer</code> pour confirmer <span class=\"text-danger\">*</span>
                    </label>
                    <input type=\"text\" id=\"inputConfirm\" class=\"form-control\"
                           placeholder=\"supprimer\" autocomplete=\"off\">
                </div>

                ";
        // line 49
        yield "                <div id=\"msgDeleteError\" class=\"alert alert-danger py-2 small\" style=\"display:none;\"></div>
                <div id=\"msgDeleteSuccess\" class=\"alert alert-success py-2 small\" style=\"display:none;\"></div>

                ";
        // line 53
        yield "                <div class=\"d-flex gap-2\">
                    <a href=\"/private\" class=\"btn btn-outline-secondary flex-fill\">
                        <i class=\"fas fa-arrow-left me-1\"></i>Annuler
                    </a>
                    <button id=\"btnDeleteCompte\" class=\"btn btn-danger flex-fill\">
                        <span id=\"btnDeleteLabel\"><i class=\"fas fa-trash me-1\"></i>Supprimer définitivement</span>
                        <span id=\"btnDeleteSpinner\" style=\"display:none;\">
                            <span class=\"spinner-border spinner-border-sm me-1\" role=\"status\"></span>Suppression…
                        </span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
    const apiUrl       = \"/api/deleteCompteDS\";

    const btnDelete    = document.getElementById(\x27btnDeleteCompte\x27);
    const inputMotif   = document.getElementById(\x27inputMotif\x27);
    const inputConfirm = document.getElementById(\x27inputConfirm\x27);
    const msgError     = document.getElementById(\x27msgDeleteError\x27);
    const msgSuccess   = document.getElementById(\x27msgDeleteSuccess\x27);
    const btnLabel     = document.getElementById(\x27btnDeleteLabel\x27);
    const btnSpinner   = document.getElementById(\x27btnDeleteSpinner\x27);

    function showError(msg) {
        msgError.textContent = msg;
        msgError.style.display = \x27block\x27;
        msgSuccess.style.display = \x27none\x27;
    }

    function setLoading(loading) {
        btnDelete.disabled = loading;
        btnLabel.style.display  = loading ? \x27none\x27  : \x27inline\x27;
        btnSpinner.style.display = loading ? \x27inline\x27 : \x27none\x27;
    }

    btnDelete.addEventListener(\x27click\x27, async function () {
        msgError.style.display   = \x27none\x27;
        msgSuccess.style.display = \x27none\x27;

        const motif   = inputMotif.value.trim();
        const confirm = inputConfirm.value.trim().toLowerCase();

        if (motif.length < 100) {
            showError(\"Veuillez saisir un motif d\x27au moins 100 caractères.\");
            return;
        }
        if (confirm !== \x27supprimer\x27) {
            showError(\"Veuillez taper exactement « supprimer » pour confirmer.\");
            return;
        }

        setLoading(true);

        try {
            const formData = new FormData();
            formData.append(\x27motifDeleted\x27,  motif);

            const response = await fetch(apiUrl, {
                method: \x27POST\x27,
                body:   formData
            });

            const data = await response.json();

            if (response.ok && data.error === false) {
                msgSuccess.textContent = \"Votre compte a été supprimé. Vous allez être déconnecté…\";
                msgSuccess.style.display = \x27block\x27;
                setTimeout(function () {
                    window.location.href = \x27/logout\x27;
                }, 2500);
            } else {
                showError(data.message ?? \"Une erreur est survenue. Veuillez réessayer.\");
                setLoading(false);
            }
        } catch (e) {
            showError(\"Impossible de contacter le serveur. Vérifiez votre connexion.\");
            setLoading(false);
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
        return "private/deleteCompte.html.twig";
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
        return array (  122 => 53,  117 => 49,  107 => 40,  95 => 29,  75 => 10,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/deleteCompte.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/deleteCompte.html.twig");
    }
}
