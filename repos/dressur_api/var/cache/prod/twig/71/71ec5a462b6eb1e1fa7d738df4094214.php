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

/* private/newboostcontact.html.twig */
class __TwigTemplate_3c1036f05a23f38122e32351a73f4f08 extends Template
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
        yield "Nouveau Boost Contact";
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
        yield "<div class=\"mb-3\">
    <button class=\"btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2\"
            type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#boostInfoCollapse\" aria-expanded=\"false\">
        <i class=\"bi bi-info-circle\"></i>
        Voir les informations sur le service
    </button>
    <div class=\"collapse mt-2\" id=\"boostInfoCollapse\">
        <div class=\"card border-0 bg-light\">
            <div class=\"card-body\">
                <ul class=\"list-unstyled mb-0 small\">
                    <li class=\"mb-2\"><i class=\"bi bi-clock text-primary me-2\"></i><strong>Par Durée :</strong> votre numéro est visible X jours dans vos pays préférés.</li>
                    <li class=\"mb-2\"><i class=\"bi bi-people text-primary me-2\"></i><strong>Par Quota :</strong> vous recevez un nombre précis de contacts ; le boost se termine automatiquement.</li>
                    <li class=\"mb-2\"><i class=\"bi bi-trophy text-warning me-2\"></i>Les Boosts Payants sont beaucoup plus mis en avant !</li>
                    <li class=\"mb-2\"><i class=\"bi bi-calendar-check text-primary me-2\"></i>Vous pouvez programmer plusieurs Boosts Payants.</li>
                    <li class=\"mb-2\"><i class=\"bi bi-clock-history text-danger me-2\"></i>Votre Boost devient Inactif si votre dernière connexion remonte à plus de 48H.</li>
                    <li class=\"mb-2\"><i class=\"bi bi-arrow-repeat text-primary me-2\"></i>Après un Boost Gratuit, faites au moins un Boost Payant avant d\x27en refaire un Gratuit.</li>
                    <li class=\"mb-0\"><i class=\"bi bi-box-arrow-in-right text-primary me-2\"></i>Connectez-vous chaque jour pour récupérer les contacts obtenus.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class=\"card\">
    <div class=\"card-body\">
        <p class=\"h4 text-center mb-4\">Nouveau Boost Contact</p>

        <div class=\"row justify-content-center\">
            <div class=\"col-md-8\">

                ";
        // line 39
        yield "                <p class=\"fw-semibold text-muted small mb-1\">Type de boost</p>
                <div class=\"d-flex mb-3\">
                    <button type=\"button\" class=\"btn btn-primary flex-fill py-3\" id=\"typeBoostDate\"
                            style=\"border-radius: 10px 0 0 10px;\">
                        <i class=\"bi bi-clock d-block mb-1 mt-1\"></i>
                        <strong>Par Durée</strong>
                        <small class=\"d-block opacity-75\">Limité en jours</small>
                    </button>
                    <button type=\"button\" class=\"btn btn-outline-secondary flex-fill py-3\" id=\"typeBoostQuota\"
                            style=\"border-radius: 0 10px 10px 0;\">
                        <i class=\"bi bi-people d-block mb-1 mt-1\"></i>
                        <strong>Par Quota</strong>
                        <small class=\"d-block opacity-75\">Nombre précis</small>
                    </button>
                </div>

                ";
        // line 56
        yield "                <p class=\"fw-semibold text-muted small mb-1\">Mode de boost</p>
                <div class=\"d-flex mb-3\">
                    <button type=\"button\" class=\"btn btn-success flex-fill py-2\" id=\"modeBoostGratuit\"
                            style=\"border-radius: 10px 0 0 10px;\">
                        <i class=\"bi bi-gift me-1\"></i><strong>Gratuit</strong>
                    </button>
                    <button type=\"button\" class=\"btn btn-outline-danger flex-fill py-2\" id=\"modeBoostPayant\"
                            style=\"border-radius: 0 10px 10px 0;\">
                        <i class=\"bi bi-credit-card me-1\"></i><strong>Payant</strong>
                    </button>
                </div>

                ";
        // line 69
        yield "                <div class=\"p-3 rounded border bg-light text-center text-muted small mb-3\" id=\"boostDescription\">
                    Chargement des informations...
                </div>

                ";
        // line 74
        yield "                <div id=\"boostContactGratuit\">
                    <div class=\"mt-0\" id=\"msgErrorBoostGratuit\" style=\"display: none;\"></div>
                    <button class=\"btn btn-success w-100 py-2\" id=\"newBoostGratuit\">
                        <i class=\"bi bi-gift me-1\"></i> Demander un Boost Gratuit
                    </button>
                </div>

                ";
        // line 82
        yield "                <div id=\"boostContactPayant\" hidden>
                    <div class=\"mt-0\" id=\"msgErrorBoostPayant\" style=\"display: none;\"></div>

                    <div class=\"mb-3\">
                        <label for=\"formule-boost-payant\" class=\"form-label small fw-semibold\">Formule de Boost Payant</label>
                        <select id=\"formule-boost-payant\" class=\"form-select getInfoPayant\">
                            <option value=\"\" disabled selected>Chargement des formules...</option>
                        </select>
                    </div>

                    <div class=\"py-2 text-center bg-info rounded px-2 text-white small mb-3\" id=\"description-boost-payant\">
                        Veuillez choisir une formule payante...
                    </div>

                    <div class=\"mb-3\">
                        <label for=\"paymentMethod\" class=\"form-label small fw-semibold\">Moyen de paiement mobile ou par carte</label>
                        <select id=\"paymentMethod\" class=\"form-select getInfoPayant\">
                            <option value=\"\" disabled selected>Choisissez le moyen de paiement</option>
                        </select>
                    </div>

                    <div class=\"mb-3\">
                        <label for=\"telPaiement\" class=\"form-label small fw-semibold\">Indicatif + Numéro de paiement</label>
                        <input type=\"tel\" class=\"form-control getInfoPayant\" id=\"telPaiement\" placeholder=\"+229 XX XX XX XX\">
                    </div>

                    <button class=\"btn btn-primary w-100 py-2\" id=\"newBoostPayant\">
                        <i class=\"bi bi-credit-card me-1\"></i> PAYER & BOOSTER
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

";
        // line 119
        yield "<div id=\"boostChecklistOverlay\" style=\"display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.65); align-items:center; justify-content:center; padding:16px;\">
    <div style=\"background:#fff; border-radius:18px; width:90vw; max-width:520px; max-height:90vh; overflow-y:auto; padding:32px 24px 24px; box-shadow:0 24px 64px rgba(0,0,0,.35);\">
        <h5 id=\"boostChecklistTitle\" style=\"font-size:1.1rem; font-weight:700; color:#1a1a2e; margin:0 0 20px; text-align:center; line-height:1.5;\">
            ✅ Votre boost est activé ! Voici ce que vous devez faire
        </h5>
        <div id=\"boostChecklistItems\" style=\"display:flex; flex-direction:column; gap:10px; margin-bottom:24px;\"></div>
        <button id=\"boostChecklistBtn\" disabled
                style=\"width:100%; padding:14px; border:none; border-radius:10px; font-size:1rem; font-weight:600; cursor:not-allowed; background:#d1d5db; color:#9ca3af; transition:background .3s, color .3s, cursor .3s;\">
            J\x27ai tout compris, continuer
        </button>
    </div>
</div>

<style>
.ds-checklist-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 15px;
    border-radius: 10px;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    cursor: pointer;
    transition: background .25s, border-color .25s;
    user-select: none;
}
.ds-checklist-item.checked {
    background: #f0fdf4;
    border-color: #22c55e;
}
.ds-checklist-icon {
    font-size: 1.2rem;
    flex-shrink: 0;
    margin-top: 1px;
    transition: transform .3s;
}
.ds-checklist-item.checked .ds-checklist-icon {
    transform: scale(1.2);
}
.ds-checklist-text {
    font-size: .93rem;
    line-height: 1.45;
    color: #374151;
}
.ds-checklist-item.checked .ds-checklist-text {
    color: #166534;
    font-weight: 500;
}
</style>
";
        yield from [];
    }

    // line 170
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 171
        yield "<script>
(function () {
    \x27use strict\x27;

    var CHECKLIST = {
        quota: [
            \"Connectez-vous au moins 4 fois par jour pour ne manquer aucun contact disponible\",
            \"Surveillez votre progression dans la page Liste des Boosts. Quand votre quota est atteint, votre boost s\x27arrête automatiquement\",
            \"Dès que votre quota est atteint, revenez faire un nouveau boost pour continuer à recevoir des contacts\",
            \"Allez sur la page Contacts et téléchargez le fichier VCF pour importer vos contacts dans votre téléphone\"
        ],
        date: [
            \"Connectez-vous au moins 4 fois par jour pour ne manquer aucun contact disponible\",
            \"Surveillez la date de fin de votre boost dans la page Liste des Boosts\",
            \"Dès que votre boost expire, revenez immédiatement faire un nouveau boost pour ne pas perdre de contacts\",
            \"Allez sur la page Contacts et téléchargez le fichier VCF pour importer vos contacts dans votre téléphone\"
        ]
    };

    window.showBoostSuccessModal = function (typeBoost) {
        var type   = (typeBoost === \x27quota\x27) ? \x27quota\x27 : \x27date\x27;
        var points = CHECKLIST[type];
        var items  = document.getElementById(\x27boostChecklistItems\x27);
        var btn    = document.getElementById(\x27boostChecklistBtn\x27);
        var overlay = document.getElementById(\x27boostChecklistOverlay\x27);
        var checked = 0;

        // Construire la checklist
        items.innerHTML = \x27\x27;
        points.forEach(function (text, i) {
            var el = document.createElement(\x27div\x27);
            el.className = \x27ds-checklist-item\x27;
            el.dataset.index = i;
            el.innerHTML =
                \x27<span class=\"ds-checklist-icon\">☐</span>\x27 +
                \x27<span class=\"ds-checklist-text\">\x27 + text + \x27</span>\x27;
            el.addEventListener(\x27click\x27, function () {
                if (el.classList.contains(\x27checked\x27)) return;
                el.classList.add(\x27checked\x27);
                el.querySelector(\x27.ds-checklist-icon\x27).textContent = \x27✅\x27;
                checked++;
                if (checked === points.length) {
                    btn.disabled = false;
                    btn.style.background   = \x27#16a34a\x27;
                    btn.style.color        = \x27#fff\x27;
                    btn.style.cursor       = \x27pointer\x27;
                }
            });
            items.appendChild(el);
        });

        // Réinitialiser le bouton
        btn.disabled = true;
        btn.style.background = \x27#d1d5db\x27;
        btn.style.color      = \x27#9ca3af\x27;
        btn.style.cursor     = \x27not-allowed\x27;

        // Afficher le modal (flex)
        overlay.style.display = \x27flex\x27;

        // Bloquer le scroll du body
        document.body.style.overflow = \x27hidden\x27;

        // Empêcher fermeture sur clic extérieur
        overlay.addEventListener(\x27click\x27, function (e) {
            if (e.target === overlay) { e.stopPropagation(); }
        }, true);

        // Empêcher fermeture sur touche Escape
        var escHandler = function (e) {
            if (e.key === \x27Escape\x27) { e.preventDefault(); e.stopPropagation(); }
        };
        document.addEventListener(\x27keydown\x27, escHandler, true);

        // Action du bouton Continuer
        btn.onclick = function () {
            overlay.style.display    = \x27none\x27;
            document.body.style.overflow = \x27\x27;
            document.removeEventListener(\x27keydown\x27, escHandler, true);
            window.location.href = \x27/contact\x27;
        };
    };
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
        return "private/newboostcontact.html.twig";
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
        return array (  252 => 171,  245 => 170,  191 => 119,  153 => 82,  144 => 74,  138 => 69,  124 => 56,  106 => 39,  74 => 8,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/newboostcontact.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/newboostcontact.html.twig");
    }
}
