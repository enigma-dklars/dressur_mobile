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

/* private/vendeur_recharge.html.twig */
class __TwigTemplate_48e4cd5557e80843493bf4fc6e19d822 extends Template
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
        yield "Recharger mon solde Vendeur";
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
.vr-wrap{max-width:560px;margin:0 auto}
.vr-solde{display:flex;align-items:center;gap:14px;background:rgba(13,110,253,.07);border:1px solid rgba(13,110,253,.18);border-radius:14px;padding:18px 20px;margin-bottom:20px}
.vr-solde i{font-size:22px;color:var(--bs-primary,#0d6efd)}
.vr-solde .vr-solde-label{font-size:.78rem;color:var(--bs-secondary-color,#6c757d);margin:0}
.vr-solde .vr-solde-val{font-size:1.5rem;font-weight:800;color:var(--bs-primary,#0d6efd);margin:0;line-height:1.1}

html.dark-theme .vr-solde,html.semi-dark .vr-solde{background:rgba(13,110,253,.15);border-color:rgba(13,110,253,.3)}
</style>

<div class=\"vr-wrap\">
    <div class=\"d-flex align-items-center gap-2 mb-3\">
        <a href=\"/parametres\" class=\"btn btn-sm btn-outline-secondary\">
            <i class=\"fas fa-chevron-left\"></i>
        </a>
        <h5 class=\"mb-0 fw-bold\">Recharger mon solde</h5>
    </div>

    ";
        // line 24
        yield "    <div class=\"vr-solde\">
        <i class=\"fas fa-wallet\"></i>
        <div>
            <p class=\"vr-solde-label\">Solde actuel</p>
            <p class=\"vr-solde-val\">";
        // line 28
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "soldeProgrammeRecompense", [], "any", true, true, false, 28) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 28)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 28), "html", null, true)) : (0));
        yield " FCFA</p>
        </div>
    </div>

    ";
        // line 33
        yield "    <div class=\"card border-0 shadow-sm p-3 mb-4\">

        ";
        // line 36
        yield "        <div class=\"mb-3\">
            <label class=\"form-label fw-semibold\">Montant à recharger <span class=\"text-muted fw-normal\">(minimum 500 FCFA)</span></label>
            <div class=\"input-group\">
                <input type=\"number\" id=\"vr_montant\" class=\"form-control\" min=\"500\" placeholder=\"Minimum 500 FCFA\">
                <span class=\"input-group-text\">FCFA</span>
            </div>
            <div id=\"vr_montantError\" class=\"text-danger small mt-1\" style=\"display:none\"></div>
        </div>

        ";
        // line 46
        yield "        <div class=\"mb-3\">
            <label class=\"form-label fw-semibold\">Indicatif + Numéro du paiement</label>
            <div class=\"input-group\">
                <span class=\"input-group-text\"><i class=\"fas fa-phone\"></i></span>
                <input type=\"tel\" id=\"vr_tel\" class=\"form-control\" placeholder=\"+22890000000\"
                       value=\"";
        // line 51
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", true, true, false, 51) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", false, false, false, 51)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", false, false, false, 51), "html", null, true)) : (""));
        yield "\">
            </div>
            <div id=\"vr_telError\" class=\"text-danger small mt-1\" style=\"display:none\"></div>
        </div>

        ";
        // line 57
        yield "        <div class=\"mb-4\">
            <label class=\"form-label fw-semibold\">Méthode de paiement</label>
            <select id=\"vr_methode\" class=\"form-select\">
                <option value=\"\" disabled selected>Choisissez un moyen de paiement</option>
                ";
        // line 61
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 62
            yield "                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["m"], "value", [], "any", false, false, false, 62), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["m"], "titre", [], "any", false, false, false, 62), "html", null, true);
            yield "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['m'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        yield "            </select>
        </div>

        <button id=\"vr_btn\" class=\"btn btn-primary w-100 btn-lg\">
            <span id=\"vr_btnText\">Recharger</span>
            <span id=\"vr_spinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display:none\"></span>
        </button>
    </div>
</div>

<div id=\"alertContainer\" class=\"position-fixed top-0 start-50 translate-middle-x mt-3\" style=\"z-index:1050\"></div>

<script>
(function(){
    document.getElementById(\x27vr_btn\x27).addEventListener(\x27click\x27, async function(){
        const montant = parseInt(document.getElementById(\x27vr_montant\x27).value,10)||0;
        const tel     = document.getElementById(\x27vr_tel\x27).value.trim();
        const methode = document.getElementById(\x27vr_methode\x27).value;
        const errM    = document.getElementById(\x27vr_montantError\x27);
        const errT    = document.getElementById(\x27vr_telError\x27);
        const btn     = document.getElementById(\x27vr_btn\x27);
        const spinner = document.getElementById(\x27vr_spinner\x27);
        const btnText = document.getElementById(\x27vr_btnText\x27);

        // Validation
        errM.style.display = \x27none\x27;
        errT.style.display = \x27none\x27;
        let ok = true;

        if(montant < 500){
            errM.textContent    = \x27Le montant minimum est de 500 FCFA.\x27;
            errM.style.display  = \x27block\x27;
            ok = false;
        }
        if(!tel){
            errT.textContent    = \x27Veuillez saisir votre numéro de paiement (format international).\x27;
            errT.style.display  = \x27block\x27;
            ok = false;
        }
        if(!methode){ showAlert(\x27Attention\x27,\x27Veuillez choisir un moyen de paiement.\x27,\x27warning\x27); ok = false; }
        if(!ok) return;

        // Envoi
        btn.disabled     = true;
        spinner.style.display = \x27inline-block\x27;
        btnText.textContent   = \x27Traitement en cours…\x27;

        try{
            const fd = new FormData();
            fd.append(\x27uid\x27,               getUID());
            fd.append(\x27methodePaiementId\x27, methode);
            fd.append(\x27montant\x27,           montant);
            fd.append(\x27tel\x27,               tel);

            const res  = await fetch(`\${API_BASE_URL}/vendeur/recharge`, { method:\x27POST\x27, body:fd });
            const data = await res.json();

            if(data.error){
                showAlert(data.titre||\x27Erreur\x27, data.message||\x27Une erreur est survenue.\x27, \x27danger\x27);
            } else if(data.url && data.url !== \x27none\x27){
                window.location.href = data.url;
            } else if(data.direct){
                showAlert(\x27Succès\x27,\x27Solde rechargé de \x27+montant+\x27 FCFA. Retour en cours…\x27,\x27success\x27);
                setTimeout(()=>{ window.location.href = \x27/parametres\x27; }, 2500);
            }
        } catch(e){
            showAlert(\x27Erreur\x27,\x27Une erreur réseau s\\\x27est produite. Veuillez réessayer.\x27,\x27danger\x27);
        } finally{
            btn.disabled          = false;
            spinner.style.display = \x27none\x27;
            btnText.textContent   = \x27Recharger\x27;
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
        return "private/vendeur_recharge.html.twig";
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
        return array (  154 => 64,  143 => 62,  139 => 61,  133 => 57,  125 => 51,  118 => 46,  107 => 36,  103 => 33,  96 => 28,  90 => 24,  70 => 5,  63 => 4,  52 => 2,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/vendeur_recharge.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/vendeur_recharge.html.twig");
    }
}
