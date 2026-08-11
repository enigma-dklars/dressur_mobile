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

/* private/vendeur_adhesion.html.twig */
class __TwigTemplate_8d91ef1652a777f0c15d95cbd2325837 extends Template
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

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Devenir Vendeur";
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 5
        yield "<style>
.va-wrap{max-width:620px;margin:0 auto;padding-bottom:40px}

/* ── Header gradient ── */
.va-header{background:linear-gradient(135deg,var(--bs-primary,#0d6efd) 0%,#0047c9 100%);padding:28px 24px;color:#fff;margin-bottom:0}
.va-header i.va-icon{font-size:2.5rem;margin-bottom:14px;display:block;opacity:.95}
.va-header h1{font-size:1.5rem;font-weight:700;margin-bottom:8px}
.va-header p{font-size:.9rem;opacity:.88;margin:0;line-height:1.5}

/* ── Sections ── */
.va-body{padding:20px 16px}
.va-section-title{font-size:1rem;font-weight:700;margin-bottom:12px;color:var(--bs-body-color)}
.va-divider{border-color:var(--bs-border-color,rgba(0,0,0,.1));margin:20px 0}

/* ── Texte paragraphe ── */
.va-paragraph{font-size:.88rem;color:var(--bs-secondary-color,#6c757d);line-height:1.6;margin-bottom:0}

/* ── Bullet avantages ── */
.va-bullet{display:flex;align-items:flex-start;gap:10px;margin-bottom:10px}
.va-bullet .va-bullet-icon{color:var(--bs-primary,#0d6efd);margin-top:2px;flex-shrink:0;font-size:.8rem}
.va-bullet span{font-size:.88rem;color:var(--bs-secondary-color,#6c757d);line-height:1.5}

/* ── Étapes ── */
.va-step{display:flex;align-items:flex-start;gap:12px;margin-bottom:12px}
.va-step-num{width:22px;height:22px;border-radius:50%;background:var(--bs-primary,#0d6efd);color:#fff;font-size:.7rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.va-step span{font-size:.88rem;color:var(--bs-secondary-color,#6c757d);line-height:1.5}

/* ── Box frais ── */
.va-fee-box{background:rgba(13,110,253,.07);border:1px solid rgba(13,110,253,.2);border-radius:14px;padding:20px;text-align:center}
.va-fee-box .va-fee-amount{font-size:2rem;font-weight:800;color:var(--bs-primary,#0d6efd);line-height:1}
.va-fee-box .va-fee-note{font-size:.78rem;color:var(--bs-secondary-color,#6c757d);margin-top:6px}

/* ── Total dynamique ── */
.va-total-box{background:rgba(13,110,253,.07);border:1px solid rgba(13,110,253,.2);border-radius:10px;padding:12px 16px;margin-bottom:20px}

/* ── Dark ── */
html.dark-theme .va-header,html.semi-dark .va-header{background:linear-gradient(135deg,#1a3a6b 0%,#0d2554 100%)}
html.dark-theme .va-bullet span,html.semi-dark .va-bullet span,
html.dark-theme .va-step span,html.semi-dark .va-step span,
html.dark-theme .va-paragraph,html.semi-dark .va-paragraph{color:#9ea4aa}
html.dark-theme .va-fee-box,html.semi-dark .va-fee-box,
html.dark-theme .va-total-box,html.semi-dark .va-total-box{background:rgba(13,110,253,.15);border-color:rgba(13,110,253,.3)}
html.dark-theme .va-divider,html.semi-dark .va-divider{border-color:rgba(255,255,255,.08)}
</style>

<div class=\"va-wrap\">

    ";
        // line 53
        yield "    <div class=\"d-flex align-items-center gap-2 mb-0 px-2 pt-2\">
        <a href=\"/parametres\" class=\"btn btn-sm btn-outline-secondary\">
            <i class=\"fas fa-chevron-left\"></i>
        </a>
        <h5 class=\"mb-0 fw-bold\">Devenir Vendeur</h5>
    </div>

    ";
        // line 61
        yield "    <div class=\"va-header mt-3 rounded-3\">
        <i class=\"fas fa-store va-icon\"></i>
        <h1>Devenez Vendeur Dressur</h1>
        <p>Accédez à des avantages exclusifs et développez votre activité avec Dressur.</p>
    </div>

    <div class=\"va-body\">

        ";
        // line 70
        yield "        <p class=\"va-section-title\">Présentation</p>
        <p class=\"va-paragraph\">
            Le statut Vendeur Dressur est réservé aux utilisateurs qui souhaitent bénéficier d\x27avantages commerciaux sur la plateforme.
            Il s\x27obtient via un paiement unique d\x27adhésion et donne accès à des fonctionnalités et tarifs privilégiés.
        </p>

        <hr class=\"va-divider\">

        ";
        // line 79
        yield "        <p class=\"va-section-title\">Avantages vendeur</p>
        <div class=\"va-bullet\">
            <i class=\"fas fa-tag va-bullet-icon\"></i>
            <span>10% de réduction sur toutes les promotions réseau sociaux</span>
        </div>
        <div class=\"va-bullet\">
            <i class=\"fas fa-wallet va-bullet-icon\"></i>
            <span>Solde rechargeable utilisable pour vos achats sur Dressur</span>
        </div>
        <div class=\"va-bullet\">
            <i class=\"fas fa-headset va-bullet-icon\"></i>
            <span>Support prioritaire réservé aux vendeurs</span>
        </div>

        <hr class=\"va-divider\">

        ";
        // line 96
        yield "        <p class=\"va-section-title\">Comment ça marche</p>
        <div class=\"va-step\">
            <div class=\"va-step-num\">1</div>
            <span>Choisissez votre méthode de paiement (Mobile Money ou carte).</span>
        </div>
        <div class=\"va-step\">
            <div class=\"va-step-num\">2</div>
            <span>Payez les frais d\x27adhésion de 2 000 FCFA (paiement unique).</span>
        </div>
        <div class=\"va-step\">
            <div class=\"va-step-num\">3</div>
            <span>Effectuez une recharge initiale de votre solde (minimum 500 FCFA).</span>
        </div>
        <div class=\"va-step\">
            <div class=\"va-step-num\">4</div>
            <span>Votre statut vendeur est activé immédiatement après confirmation du paiement.</span>
        </div>

        <hr class=\"va-divider\">

        ";
        // line 117
        yield "        <p class=\"va-section-title\">Frais d\x27adhésion</p>
        <div class=\"va-fee-box mb-0\">
            <div class=\"va-fee-amount\">2 000 FCFA</div>
            <div class=\"va-fee-note\">Paiement unique, non répétable.</div>
        </div>

        <hr class=\"va-divider\">

        ";
        // line 126
        yield "        <p class=\"va-section-title\">Paiement</p>
        <div class=\"card border-0 shadow-sm p-3\">

            ";
        // line 130
        yield "            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold small text-secondary\">Méthode de paiement</label>
                <select id=\"va_methode\" class=\"form-select\">
                    <option value=\"\" disabled selected>Moyen de paiement mobile ou par carte</option>
                    ";
        // line 134
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 135
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["m"], "value", [], "any", false, false, false, 135), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["m"], "titre", [], "any", false, false, false, 135), "html", null, true);
            yield "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['m'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 137
        yield "                </select>
            </div>

            ";
        // line 141
        yield "            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold small text-secondary\">Indicatif + Numéro du paiement</label>
                <div class=\"input-group\">
                    <span class=\"input-group-text\"><i class=\"fas fa-phone\"></i></span>
                    <input type=\"tel\" id=\"va_tel\" class=\"form-control\" placeholder=\"+22890000000\"
                           value=\"";
        // line 146
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", true, true, false, 146) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", false, false, false, 146)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", false, false, false, 146), "html", null, true)) : (""));
        yield "\">
                </div>
            </div>

            ";
        // line 151
        yield "            <div class=\"mb-3\">
                <label class=\"form-label fw-semibold small text-secondary\">
                    Recharge initiale <span class=\"fw-normal text-muted\">(obligatoire, min 500 FCFA)</span>
                </label>
                <div class=\"input-group\">
                    <input type=\"number\" id=\"va_montant\" class=\"form-control\" min=\"500\" value=\"500\" placeholder=\"500\">
                    <span class=\"input-group-text\">FCFA</span>
                </div>
                <div id=\"va_montantError\" class=\"text-danger small mt-1\" style=\"display:none\"></div>
            </div>

            ";
        // line 163
        yield "            <div class=\"va-total-box d-flex justify-content-between align-items-center\">
                <span class=\"fw-semibold\">Total à payer</span>
                <strong id=\"va_total\" class=\"text-primary\" style=\"font-size:1.2rem\">2 500 FCFA</strong>
            </div>

            <button id=\"va_btn\" class=\"btn btn-primary w-100 btn-lg mt-1\">
                <span id=\"va_btnText\">Payer <span id=\"va_btnTotal\">2 500</span> FCFA</span>
                <span id=\"va_spinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display:none\"></span>
            </button>
        </div>
    </div>
</div>

<div id=\"alertContainer\" class=\"position-fixed top-0 start-50 translate-middle-x mt-3\" style=\"z-index:1050\"></div>

<script>
(function(){
    const montantInput = document.getElementById(\x27va_montant\x27);
    const totalEl      = document.getElementById(\x27va_total\x27);
    const btnTotalEl   = document.getElementById(\x27va_btnTotal\x27);
    const errEl        = document.getElementById(\x27va_montantError\x27);
    const btn          = document.getElementById(\x27va_btn\x27);
    const spinner      = document.getElementById(\x27va_spinner\x27);

    function fmt(n){ return n.toString().replace(/\\B(?=(\\d{3})+(?!\\d))/g,\x27 \x27); }

    function updateTotal(){
        const recharge = Math.max(0, parseInt(montantInput.value,10)||0);
        const total = 2000 + recharge;
        totalEl.textContent    = fmt(total) + \x27 FCFA\x27;
        btnTotalEl.textContent = fmt(total);
    }
    montantInput.addEventListener(\x27input\x27, updateTotal);
    updateTotal();

    btn.addEventListener(\x27click\x27, async function(){
        const methode = document.getElementById(\x27va_methode\x27).value;
        const tel     = document.getElementById(\x27va_tel\x27).value.trim();
        const montant = parseInt(montantInput.value,10)||0;

        if(!methode){ showAlert(\x27Attention\x27,\x27Veuillez choisir un moyen de paiement.\x27,\x27warning\x27); return; }
        if(!tel)    { showAlert(\x27Attention\x27,\x27Veuillez saisir votre numéro de paiement (format international).\x27,\x27warning\x27); return; }
        if(montant < 500){
            errEl.textContent    = \x27Une recharge initiale d\\\x27au moins 500 FCFA est obligatoire.\x27;
            errEl.style.display  = \x27block\x27;
            return;
        }
        errEl.style.display = \x27none\x27;

        btn.disabled = true;
        spinner.style.display = \x27inline-block\x27;

        try{
            const fd = new FormData();
            fd.append(\x27uid\x27,               getUID());
            fd.append(\x27methodePaiementId\x27, methode);
            fd.append(\x27montantRecharge\x27,   montant);
            fd.append(\x27tel\x27,               tel);

            const res  = await fetch(`\${API_BASE_URL}/vendeur/adhesion`, { method:\x27POST\x27, body:fd });
            const data = await res.json();

            if(data.error){
                showAlert(data.titre||\x27Erreur\x27, data.message||\x27Une erreur est survenue.\x27, \x27danger\x27);
            } else if(data.url && data.url !== \x27none\x27){
                window.location.href = data.url;
            } else if(data.direct){
                showAlert(\x27Succès 🎉\x27,\x27Paiement confirmé. Vous êtes maintenant vendeur ! Actualisation en cours…\x27,\x27success\x27);
                setTimeout(()=>{ window.location.href = \x27/parametres\x27; }, 2500);
            }
        } catch(e){
            showAlert(\x27Erreur\x27,\x27Une erreur réseau s\\\x27est produite. Veuillez réessayer.\x27,\x27danger\x27);
        } finally{
            btn.disabled = false;
            spinner.style.display = \x27none\x27;
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
        return "private/vendeur_adhesion.html.twig";
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
        return array (  256 => 163,  243 => 151,  236 => 146,  229 => 141,  224 => 137,  213 => 135,  209 => 134,  203 => 130,  198 => 126,  188 => 117,  166 => 96,  148 => 79,  138 => 70,  128 => 61,  119 => 53,  70 => 5,  63 => 4,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/vendeur_adhesion.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/vendeur_adhesion.html.twig");
    }
}
