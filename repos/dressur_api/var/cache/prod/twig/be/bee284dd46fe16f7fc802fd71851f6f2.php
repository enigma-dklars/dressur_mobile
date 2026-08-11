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

/* communication_mail/file_attente.html.twig */
class __TwigTemplate_7f2d95f6c7aeb6a47e70a036b8ae03ae extends Template
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
        yield "Communication Mail — File d\x27attente";
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
<style>
@keyframes badge-pop {
    0%   { transform: scale(1); }
    40%  { transform: scale(1.35); }
    100% { transform: scale(1); }
}
.badge-pop { animation: badge-pop .35s ease; }
</style>

<div class=\"d-flex align-items-center mb-3\">
    <h4 class=\"mb-0\">
        <i class=\"fas fa-list me-2 text-primary\"></i>File d\x27attente d\x27envoi
        <span id=\"badge-attente\"
              class=\"badge bg-warning text-dark ms-2\"
              style=\"font-size:.65rem;vertical-align:middle;\">
            ";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 22) == "en_attente"); })), "html", null, true);
        yield " en attente
        </span>
    </h4>
    <div class=\"ms-auto d-flex gap-2\">
        ";
        // line 26
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)) > 0)) {
            // line 27
            yield "        <button type=\"button\" class=\"btn btn-sm btn-danger\" id=\"btn-delete-all\"
                data-total=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield "\">
            <i class=\"fas fa-trash-alt me-1\"></i>Tout supprimer
            <span class=\"badge bg-light text-danger ms-1\">";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield "</span>
        </button>
        ";
        }
        // line 33
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"btn btn-sm btn-outline-secondary\">
            <i class=\"fas fa-arrow-left me-1\"></i>Retour au portail
        </a>
    </div>
</div>

";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 39));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 40
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 41
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
            ";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        yield "
<div class=\"card mb-3 border-primary\">
    <div class=\"card-body py-2 px-3 d-flex align-items-center flex-wrap gap-3\">
        <div class=\"d-flex align-items-center gap-2\">
            <span id=\"batch-spinner\" class=\"spinner-border spinner-border-sm text-primary d-none\" role=\"status\"></span>
            <span id=\"batch-status\" class=\"small text-muted\">En attente du prochain envoi…</span>
        </div>
        <div class=\"ms-auto d-flex align-items-center gap-2\">
            <span class=\"small text-muted\">Prochain envoi dans <strong id=\"countdown\">1:00</strong></span>
            <button type=\"button\" class=\"btn btn-sm btn-primary\" id=\"btn-send-now\">
                <i class=\"fas fa-paper-plane me-1\"></i>Envoyer maintenant
            </button>
        </div>
    </div>
    <div id=\"batch-log\" class=\"px-3 pb-2\" style=\"display:none;max-height:120px;overflow-y:auto;font-size:0.8rem;\"></div>
</div>

";
        // line 64
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)) > 0)) {
            // line 65
            yield "<form id=\"form-delete-multiple\" method=\"post\"
      action=\"";
            // line 66
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_delete_multiple");
            yield "\">
    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("delete_multiple_file_attente"), "html", null, true);
            yield "\">

    <div class=\"d-flex align-items-center gap-2 mb-2 flex-wrap\">
        <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"btn-select-all\">
            <i class=\"fas fa-check-square me-1\"></i>Tout sélectionner
        </button>
        <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" id=\"btn-deselect-all\">
            <i class=\"fas fa-square me-1\"></i>Tout désélectionner
        </button>
        <button type=\"button\" class=\"btn btn-sm btn-danger ms-auto\" id=\"btn-delete-selected\" disabled>
            <i class=\"fas fa-trash me-1\"></i>Supprimer la sélection
            <span class=\"badge bg-light text-danger ms-1\" id=\"count-selected\">0</span>
        </button>
    </div>

    <div class=\"card\">
        <div class=\"card-body p-0\">
            <table class=\"data-table table table-bordered table-striped mb-0\">
                <thead>
                    <tr>
                        <th style=\"width:40px;\" class=\"text-center\">
                            <input type=\"checkbox\" id=\"checkbox-master\" class=\"form-check-input\" title=\"Tout sélectionner\">
                        </th>
                        <th>#</th>
                        <th>Destinataire</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                ";
            // line 99
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["entries"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
                // line 100
                yield "                    <tr class=\"row-entry\">
                        <td class=\"text-center\">
                            <input type=\"checkbox\" name=\"ids[]\" value=\"";
                // line 102
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 102), "html", null, true);
                yield "\"
                                   class=\"form-check-input row-checkbox\">
                        </td>
                        <td>";
                // line 105
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 105), "html", null, true);
                yield "</td>
                        <td>";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "sendto", [], "any", false, false, false, 106), "html", null, true);
                yield "</td>
                        <td class=\"small text-muted\" style=\"max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;\">
                            ";
                // line 108
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "sujet", [], "any", false, false, false, 108), "html", null, true);
                yield "
                        </td>
                        <td>
                            ";
                // line 111
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "statut", [], "any", false, false, false, 111) == "en_attente")) {
                    // line 112
                    yield "                                <span class=\"badge bg-warning text-dark\">En attente</span>
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 113
$context["entry"], "statut", [], "any", false, false, false, 113) == "envoye")) {
                    // line 114
                    yield "                                <span class=\"badge bg-success\">Envoyé</span>
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 115
$context["entry"], "statut", [], "any", false, false, false, 115) == "erreur")) {
                    // line 116
                    yield "                                <span class=\"badge bg-danger\">Erreur</span>
                            ";
                } else {
                    // line 118
                    yield "                                <span class=\"badge bg-secondary\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "statut", [], "any", false, false, false, 118), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 120
                yield "                        </td>
                        <td class=\"small\">";
                // line 121
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "createdAt", [], "any", false, false, false, 121), "d/m/Y H:i"), "html", null, true);
                yield "</td>
                        <td>
                            <button type=\"button\" class=\"btn btn-sm btn-outline-danger\"
                                    onclick=\"deleteSingle(";
                // line 124
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 124), "html", null, true);
                yield ", \x27";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 124))), "html", null, true);
                yield "\x27, this)\">
                                <i class=\"fas fa-trash\"></i>
                            </button>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['entry'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 130
            yield "                </tbody>
            </table>
        </div>
        <div class=\"card-footer text-muted small d-flex justify-content-between\">
            <span>";
            // line 134
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield " entrée(s) au total</span>
            <span>
                <span id=\"footer-attente\">";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 136) == "en_attente"); })), "html", null, true);
            yield "</span> en attente ·
                <span id=\"footer-envoye\">";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 137) == "envoye"); })), "html", null, true);
            yield "</span> envoyés ·
                <span id=\"footer-erreur\">";
            // line 138
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 138) == "erreur"); })), "html", null, true);
            yield "</span> erreurs
            </span>
        </div>
    </div>
</form>

<form id=\"form-delete-single\" method=\"post\" style=\"display:none;\">
    <input type=\"hidden\" name=\"_token\" id=\"single-token\">
</form>

<form id=\"form-delete-all\" method=\"post\"
      action=\"";
            // line 149
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_delete_all");
            yield "\"
      style=\"display:none;\">
    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 151
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("delete_all_file_attente"), "html", null, true);
            yield "\">
</form>

";
        } else {
            // line 155
            yield "<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"data-table table table-bordered table-striped mb-0\">
            <thead>
                <tr>
                    <th style=\"width:40px;\"></th>
                    <th>#</th>
                    <th>Destinataire</th>
                    <th>Sujet</th>
                    <th>Statut</th>
                    <th>Ajouté le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan=\"7\" class=\"text-center text-muted py-4\">Aucun mail en file d\x27attente.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
";
        }
        // line 178
        yield "
<script>
// ── Sélection multiple ───────────────────────────────────────────────────────
(function () {
    const master         = document.getElementById(\x27checkbox-master\x27);
    const checkboxes     = () => document.querySelectorAll(\x27.row-checkbox\x27);
    const btnSelectAll   = document.getElementById(\x27btn-select-all\x27);
    const btnDeselectAll = document.getElementById(\x27btn-deselect-all\x27);
    const btnDelete      = document.getElementById(\x27btn-delete-selected\x27);
    const countBadge     = document.getElementById(\x27count-selected\x27);
    const formMultiple   = document.getElementById(\x27form-delete-multiple\x27);

    if (!master) return;

    function updateUI() {
        const all     = checkboxes();
        const checked = document.querySelectorAll(\x27.row-checkbox:checked\x27);
        const n       = checked.length;

        countBadge.textContent = n;
        btnDelete.disabled     = n === 0;

        master.indeterminate = n > 0 && n < all.length;
        master.checked       = n === all.length && all.length > 0;

        document.querySelectorAll(\x27.row-entry\x27).forEach(row => {
            const cb = row.querySelector(\x27.row-checkbox\x27);
            row.classList.toggle(\x27table-active\x27, cb && cb.checked);
        });
    }

    master.addEventListener(\x27change\x27, function () {
        checkboxes().forEach(cb => { cb.checked = master.checked; });
        updateUI();
    });

    document.querySelectorAll(\x27.row-checkbox\x27).forEach(cb => {
        cb.addEventListener(\x27change\x27, updateUI);
    });

    if (btnSelectAll) btnSelectAll.addEventListener(\x27click\x27, function () {
        checkboxes().forEach(cb => { cb.checked = true; });
        updateUI();
    });

    if (btnDeselectAll) btnDeselectAll.addEventListener(\x27click\x27, function () {
        checkboxes().forEach(cb => { cb.checked = false; });
        updateUI();
    });

    if (btnDelete) btnDelete.addEventListener(\x27click\x27, function () {
        const n = document.querySelectorAll(\x27.row-checkbox:checked\x27).length;
        Swal.fire({
            title: \x27Confirmer la suppression\x27,
            text: n + \x27 élément(s) sélectionné(s) seront supprimés définitivement.\x27,
            icon: \x27warning\x27,
            showCancelButton: true,
            confirmButtonColor: \x27#dc3545\x27,
            cancelButtonColor: \x27#6c757d\x27,
            confirmButtonText: \x27<i class=\"fas fa-trash me-1\"></i>Supprimer\x27,
            cancelButtonText: \x27Annuler\x27
        }).then(function (result) {
            if (result.isConfirmed) { formMultiple.submit(); }
        });
    });

    // Tout supprimer
    const btnDeleteAll = document.getElementById(\x27btn-delete-all\x27);
    if (btnDeleteAll) {
        btnDeleteAll.addEventListener(\x27click\x27, function () {
            const total = this.dataset.total;
            Swal.fire({
                title: \x27Vider la file d\\\x27attente mail ?\x27,
                html: \x27<strong>\x27 + total + \x27 entrée(s)</strong> seront supprimées définitivement.<br>Cette action est irréversible.\x27,
                icon: \x27warning\x27,
                showCancelButton: true,
                confirmButtonColor: \x27#dc3545\x27,
                cancelButtonColor: \x27#6c757d\x27,
                confirmButtonText: \x27<i class=\"fas fa-trash-alt me-1\"></i>Tout supprimer\x27,
                cancelButtonText: \x27Annuler\x27,
                focusCancel: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    document.getElementById(\x27form-delete-all\x27).submit();
                }
            });
        });
    }
})();

function deleteSingle(id, token) {
    Swal.fire({
        title: \x27Supprimer cet envoi ?\x27,
        text: \x27Cette action est irréversible.\x27,
        icon: \x27warning\x27,
        showCancelButton: true,
        confirmButtonColor: \x27#dc3545\x27,
        cancelButtonColor: \x27#6c757d\x27,
        confirmButtonText: \x27<i class=\"fas fa-trash me-1\"></i>Supprimer\x27,
        cancelButtonText: \x27Annuler\x27
    }).then(function (result) {
        if (result.isConfirmed) {
            const form  = document.getElementById(\x27form-delete-single\x27);
            form.action = \x27/crud/communication-mail/file-attente/\x27 + id + \x27/delete\x27;
            document.getElementById(\x27single-token\x27).value = token;
            form.submit();
        }
    });
}

// ── Envoi automatique par lot (Ajax toutes les 1 min) ────────────────────────
(function () {
    const INTERVAL_MS   = 1 * 60 * 1000;
    const BATCH_URL     = \x27";
        // line 291
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_process_batch");
        yield "\x27;

    const elStatus      = document.getElementById(\x27batch-status\x27);
    const elSpinner     = document.getElementById(\x27batch-spinner\x27);
    const elCountdown   = document.getElementById(\x27countdown\x27);
    const elLog         = document.getElementById(\x27batch-log\x27);
    const btnSendNow    = document.getElementById(\x27btn-send-now\x27);
    const elBadge       = document.getElementById(\x27badge-attente\x27);
    const elFooterAtt   = document.getElementById(\x27footer-attente\x27);
    const elFooterEnv   = document.getElementById(\x27footer-envoye\x27);
    const elFooterErr   = document.getElementById(\x27footer-erreur\x27);

    function updateCounters(remaining, newEnvoye, newErreur) {
        // Badge dans le titre
        if (elBadge) {
            elBadge.textContent = remaining + \x27 en attente\x27;
            elBadge.classList.toggle(\x27bg-warning\x27, remaining > 0);
            elBadge.classList.toggle(\x27text-dark\x27,  remaining > 0);
            elBadge.classList.toggle(\x27bg-success\x27, remaining === 0);
            elBadge.classList.toggle(\x27text-white\x27, remaining === 0);
            // Animation pop subtile
            elBadge.classList.remove(\x27badge-pop\x27);
            void elBadge.offsetWidth; // reflow pour relancer l\x27animation
            elBadge.classList.add(\x27badge-pop\x27);
        }
        // Footer
        if (elFooterAtt) elFooterAtt.textContent = remaining;
        if (elFooterEnv && newEnvoye !== undefined) elFooterEnv.textContent = parseInt(elFooterEnv.textContent || 0) + newEnvoye;
        if (elFooterErr && newErreur !== undefined) elFooterErr.textContent = parseInt(elFooterErr.textContent || 0) + newErreur;
    }

    let secondsLeft = INTERVAL_MS / 1000;
    let countdownTimer = null;
    let sending = false;

    function pad(n) { return String(n).padStart(2, \x270\x27); }

    function startCountdown() {
        secondsLeft = INTERVAL_MS / 1000;
        clearInterval(countdownTimer);
        countdownTimer = setInterval(function () {
            secondsLeft--;
            const m = Math.floor(secondsLeft / 60);
            const s = secondsLeft % 60;
            elCountdown.textContent = m + \x27:\x27 + pad(s);
            if (secondsLeft <= 0) {
                clearInterval(countdownTimer);
                sendBatch();
            }
        }, 1000);
    }

    function addLog(html) {
        elLog.style.display = \x27block\x27;
        const line = document.createElement(\x27div\x27);
        line.innerHTML = html;
        elLog.prepend(line);
    }

    function updateRowStatut(id, statut) {
        const row = document.querySelector(\x27tr.row-entry [name=\"ids[]\"][value=\"\x27 + id + \x27\"]\x27);
        if (!row) return;
        const tr  = row.closest(\x27tr\x27);
        const td  = tr.querySelector(\x27td:nth-child(5)\x27);
        if (!td) return;
        const badges = {
            \x27envoye\x27: \x27<span class=\"badge bg-success\">Envoyé</span>\x27,
            \x27erreur\x27: \x27<span class=\"badge bg-danger\">Erreur</span>\x27,
        };
        td.innerHTML = badges[statut] || td.innerHTML;
    }

    function sendBatch() {
        if (sending) return;
        sending = true;
        elSpinner.classList.remove(\x27d-none\x27);
        elStatus.textContent = \x27Envoi en cours…\x27;
        btnSendNow.disabled  = true;

        fetch(BATCH_URL, {
            method: \x27POST\x27,
            headers: { \x27X-Requested-With\x27: \x27XMLHttpRequest\x27 }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            const now = new Date().toLocaleTimeString(\x27fr-FR\x27);
            if (data.processed === 0) {
                elStatus.textContent = \x27File d\\\x27attente vide.\x27;
                addLog(\x27<span class=\"text-muted\">[\x27 + now + \x27] Aucun mail en attente.</span>\x27);
                updateCounters(0);
            } else {
                const ok  = data.results.filter(function (r) { return r.statut === \x27envoye\x27; }).length;
                const err = data.results.filter(function (r) { return r.statut === \x27erreur\x27; }).length;

                elStatus.textContent = data.processed + \x27 mail(s) traité(s) — \x27 + data.remaining + \x27 restant(s).\x27;

                data.results.forEach(function (r) {
                    updateRowStatut(r.id, r.statut);
                    const icon   = r.statut === \x27envoye\x27 ? \x27✅\x27 : \x27❌\x27;
                    addLog(\x27<span class=\"text-muted\">[\x27 + now + \x27]</span> \x27 + icon + \x27 \x27 + r.sendto);
                });

                addLog(
                    \x27<strong>[\x27 + now + \x27] Lot envoyé : \x27 + ok + \x27 ✅ \x27 + err + \x27 ❌ — \x27 +
                    data.remaining + \x27 en attente</strong>\x27
                );

                updateCounters(data.remaining, ok, err);
            }
        })
        .catch(function () {
            elStatus.textContent = \x27Erreur lors de la requête.\x27;
            addLog(\x27<span class=\"text-danger\">[Erreur réseau] La requête a échoué.</span>\x27);
        })
        .finally(function () {
            sending = false;
            elSpinner.classList.add(\x27d-none\x27);
            btnSendNow.disabled = false;
            startCountdown();
        });
    }

    btnSendNow.addEventListener(\x27click\x27, function () {
        clearInterval(countdownTimer);
        sendBatch();
    });

    startCountdown();
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
        return "communication_mail/file_attente.html.twig";
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
        return array (  471 => 291,  356 => 178,  331 => 155,  324 => 151,  319 => 149,  305 => 138,  301 => 137,  297 => 136,  292 => 134,  286 => 130,  272 => 124,  266 => 121,  263 => 120,  257 => 118,  253 => 116,  251 => 115,  248 => 114,  246 => 113,  243 => 112,  241 => 111,  235 => 108,  230 => 106,  226 => 105,  220 => 102,  216 => 100,  212 => 99,  177 => 67,  173 => 66,  170 => 65,  168 => 64,  149 => 47,  135 => 42,  130 => 41,  125 => 40,  121 => 39,  111 => 33,  105 => 30,  100 => 28,  97 => 27,  95 => 26,  88 => 22,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/file_attente.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/file_attente.html.twig");
    }
}
