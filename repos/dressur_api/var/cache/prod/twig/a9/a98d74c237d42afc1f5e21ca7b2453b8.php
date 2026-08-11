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

/* communication_mail/file_attente_whatsapp.html.twig */
class __TwigTemplate_3578e3f45f94fdbbb933389315984cc3 extends Template
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
        yield "Communication — File d\x27attente WhatsApp";
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
<div class=\"d-flex align-items-center mb-3\">
    <h4 class=\"mb-0\">
        <i class=\"fab fa-whatsapp me-2 text-success\"></i>File d\x27attente WhatsApp
        <span class=\"badge bg-success ms-2\" style=\"font-size:.65rem;vertical-align:middle;\">
            ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 11) == "en_attente"); })), "html", null, true);
        yield " en attente
        </span>
    </h4>
    <div class=\"ms-auto d-flex gap-2\">
        <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_whatsapp_json");
        yield "\"
           target=\"_blank\"
           class=\"btn btn-sm btn-outline-success\"
           title=\"Obtenir la file d\x27attente (en_attente) au format JSON\">
            <i class=\"fas fa-code me-1\"></i>Export JSON
        </a>
        ";
        // line 21
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)) > 0)) {
            // line 22
            yield "        <button type=\"button\" class=\"btn btn-sm btn-danger\" id=\"btn-delete-all\"
                data-total=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield "\">
            <i class=\"fas fa-trash-alt me-1\"></i>Tout supprimer
            <span class=\"badge bg-light text-danger ms-1\">";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield "</span>
        </button>
        ";
        }
        // line 28
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_portal");
        yield "\" class=\"btn btn-sm btn-outline-secondary\">
            <i class=\"fas fa-arrow-left me-1\"></i>Retour au portail
        </a>
    </div>
</div>

";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 34));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 35
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 36
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
            ";
                // line 37
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
        // line 42
        yield "
";
        // line 43
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)) > 0)) {
            // line 44
            yield "<form id=\"form-delete-multiple\" method=\"post\"
      action=\"";
            // line 45
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_whatsapp_delete_multiple");
            yield "\">
    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("delete_multiple_wa"), "html", null, true);
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
                        <th>Numéro</th>
                        <th>Campagne</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th>Ajouté le</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["entries"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
                // line 80
                yield "                    <tr class=\"row-entry\">
                        <td class=\"text-center\">
                            <input type=\"checkbox\" name=\"ids[]\" value=\"";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 82), "html", null, true);
                yield "\"
                                   class=\"form-check-input row-checkbox\">
                        </td>
                        <td>";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 85), "html", null, true);
                yield "</td>
                        <td class=\"fw-semibold\">";
                // line 86
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "sendto", [], "any", false, false, false, 86), "html", null, true);
                yield "</td>
                        <td class=\"small text-muted\" style=\"max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;\">
                            ";
                // line 88
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "titre", [], "any", false, false, false, 88), "html", null, true);
                yield "
                        </td>
                        <td style=\"max-width:260px;\">
                            <button type=\"button\"
                                    class=\"btn btn-sm btn-outline-secondary\"
                                    data-bs-toggle=\"popover\"
                                    data-bs-trigger=\"click\"
                                    data-bs-placement=\"left\"
                                    data-bs-content=\"";
                // line 96
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "message", [], "any", false, false, false, 96), "html_attr");
                yield "\"
                                    title=\"Message WhatsApp\">
                                <i class=\"fas fa-eye me-1\"></i>Voir
                            </button>
                        </td>
                        <td>
                            ";
                // line 102
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "statut", [], "any", false, false, false, 102) == "en_attente")) {
                    // line 103
                    yield "                                <span class=\"badge bg-warning text-dark\">En attente</span>
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 104
$context["entry"], "statut", [], "any", false, false, false, 104) == "envoye")) {
                    // line 105
                    yield "                                <span class=\"badge bg-success\">Envoyé</span>
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 106
$context["entry"], "statut", [], "any", false, false, false, 106) == "erreur")) {
                    // line 107
                    yield "                                <span class=\"badge bg-danger\">Erreur</span>
                            ";
                } else {
                    // line 109
                    yield "                                <span class=\"badge bg-secondary\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "statut", [], "any", false, false, false, 109), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 111
                yield "                        </td>
                        <td class=\"small\">";
                // line 112
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "createdAt", [], "any", false, false, false, 112), "d/m/Y H:i"), "html", null, true);
                yield "</td>
                        <td>
                            <button type=\"button\" class=\"btn btn-sm btn-outline-danger\"
                                    onclick=\"deleteSingle(";
                // line 115
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 115), "html", null, true);
                yield ", \x27";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_wa" . CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 115))), "html", null, true);
                yield "\x27)\">
                                <i class=\"fas fa-trash\"></i>
                            </button>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['entry'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 121
            yield "                </tbody>
            </table>
        </div>
        <div class=\"card-footer text-muted small d-flex justify-content-between\">
            <span>";
            // line 125
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["entries"] ?? null)), "html", null, true);
            yield " entrée(s) au total</span>
            <span>
                ";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 127) == "en_attente"); })), "html", null, true);
            yield " en attente ·
                ";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 128) == "envoye"); })), "html", null, true);
            yield " envoyés ·
                ";
            // line 129
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, $this->env->hasExtension(\Twig\Extension\SandboxExtension::class) && $this->env->getExtension(\Twig\Extension\SandboxExtension::class)->isSandboxed($this->source), ($context["entries"] ?? null), function ($__e__) use ($context, $macros) { $context["e"] = $__e__; return (CoreExtension::getAttribute($this->env, $this->source, ($context["e"] ?? null), "statut", [], "any", false, false, false, 129) == "erreur"); })), "html", null, true);
            yield " erreurs
            </span>
        </div>
    </div>
</form>

<form id=\"form-delete-single\" method=\"post\" style=\"display:none;\">
    <input type=\"hidden\" name=\"_token\" id=\"single-token\">
</form>

<form id=\"form-delete-all\" method=\"post\"
      action=\"";
            // line 140
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_communication_mail_file_attente_whatsapp_delete_all");
            yield "\"
      style=\"display:none;\">
    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 142
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("delete_all_wa"), "html", null, true);
            yield "\">
</form>

";
        } else {
            // line 146
            yield "<div class=\"card\">
    <div class=\"card-body p-0\">
        <table class=\"data-table table table-bordered table-striped mb-0\">
            <thead>
                <tr>
                    <th style=\"width:40px;\"></th>
                    <th>#</th>
                    <th>Numéro</th>
                    <th>Campagne</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Ajouté le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan=\"8\" class=\"text-center text-muted py-4\">
                        <i class=\"fab fa-whatsapp me-2 text-success\"></i>Aucun message WhatsApp en file d\x27attente.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
";
        }
        // line 172
        yield "
";
        yield from [];
    }

    // line 175
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 176
        yield "<script>
(function () {
    const master         = document.getElementById(\x27checkbox-master\x27);
    const checkboxes     = () => document.querySelectorAll(\x27.row-checkbox\x27);
    const btnSelectAll   = document.getElementById(\x27btn-select-all\x27);
    const btnDeselectAll = document.getElementById(\x27btn-deselect-all\x27);
    const btnDelete      = document.getElementById(\x27btn-delete-selected\x27);
    const countBadge     = document.getElementById(\x27count-selected\x27);
    const formMultiple   = document.getElementById(\x27form-delete-multiple\x27);

    // Popovers Bootstrap (bootstrap.bundle.min.js chargé avant ce bloc)
    document.querySelectorAll(\x27[data-bs-toggle=\"popover\"]\x27).forEach(function (el) {
        new bootstrap.Popover(el, { html: false, sanitize: false });
    });

    // Tout supprimer
    const btnDeleteAll = document.getElementById(\x27btn-delete-all\x27);
    if (btnDeleteAll) {
        btnDeleteAll.addEventListener(\x27click\x27, function () {
            const total = this.dataset.total;
            Swal.fire({
                title: \x27Vider la file d\\\x27attente WhatsApp ?\x27,
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

    if (!master) return;

    function updateUI() {
        const all     = checkboxes();
        const checked = document.querySelectorAll(\x27.row-checkbox:checked\x27);
        const n       = checked.length;
        countBadge.textContent = n;
        btnDelete.disabled     = n === 0;
        master.indeterminate   = n > 0 && n < all.length;
        master.checked         = n === all.length && all.length > 0;
        document.querySelectorAll(\x27.row-entry\x27).forEach(function (row) {
            const cb = row.querySelector(\x27.row-checkbox\x27);
            row.classList.toggle(\x27table-active\x27, cb && cb.checked);
        });
    }

    master.addEventListener(\x27change\x27, function () {
        checkboxes().forEach(function (cb) { cb.checked = master.checked; });
        updateUI();
    });
    document.querySelectorAll(\x27.row-checkbox\x27).forEach(function (cb) {
        cb.addEventListener(\x27change\x27, updateUI);
    });

    if (btnSelectAll)   btnSelectAll.addEventListener(\x27click\x27,   function () { checkboxes().forEach(function (cb) { cb.checked = true;  }); updateUI(); });
    if (btnDeselectAll) btnDeselectAll.addEventListener(\x27click\x27, function () { checkboxes().forEach(function (cb) { cb.checked = false; }); updateUI(); });

    if (btnDelete) btnDelete.addEventListener(\x27click\x27, function () {
        const n = document.querySelectorAll(\x27.row-checkbox:checked\x27).length;
        Swal.fire({
            title: \x27Confirmer la suppression\x27,
            text: n + \x27 élément(s) seront supprimés définitivement.\x27,
            icon: \x27warning\x27,
            showCancelButton: true,
            confirmButtonColor: \x27#dc3545\x27,
            cancelButtonColor: \x27#6c757d\x27,
            confirmButtonText: \x27<i class=\"fas fa-trash me-1\"></i>Supprimer\x27,
            cancelButtonText: \x27Annuler\x27
        }).then(function (result) { if (result.isConfirmed) formMultiple.submit(); });
    });
})();

function deleteSingle(id, token) {
    Swal.fire({
        title: \x27Supprimer ce message ?\x27,
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
            form.action = \x27/crud/communication-mail/file-attente-whatsapp/\x27 + id + \x27/delete\x27;
            document.getElementById(\x27single-token\x27).value = token;
            form.submit();
        }
    });
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
        return "communication_mail/file_attente_whatsapp.html.twig";
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
        return array (  370 => 176,  363 => 175,  357 => 172,  329 => 146,  322 => 142,  317 => 140,  303 => 129,  299 => 128,  295 => 127,  290 => 125,  284 => 121,  270 => 115,  264 => 112,  261 => 111,  255 => 109,  251 => 107,  249 => 106,  246 => 105,  244 => 104,  241 => 103,  239 => 102,  230 => 96,  219 => 88,  214 => 86,  210 => 85,  204 => 82,  200 => 80,  196 => 79,  160 => 46,  156 => 45,  153 => 44,  151 => 43,  148 => 42,  134 => 37,  129 => 36,  124 => 35,  120 => 34,  110 => 28,  104 => 25,  99 => 23,  96 => 22,  94 => 21,  85 => 15,  78 => 11,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "communication_mail/file_attente_whatsapp.html.twig", "/home/runner/workspace/repos/dressur_api/templates/communication_mail/file_attente_whatsapp.html.twig");
    }
}
