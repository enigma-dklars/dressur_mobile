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

/* private/_includes/_sociaux.html.twig */
class __TwigTemplate_d383e45e7f07ff0be678ad0e29f597c7 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 2
        yield "<div class=\"ds-sociaux-card mt-4 mb-2\">
    <div class=\"ds-sociaux-inner\">

        <div class=\"d-flex align-items-start gap-3\">
            <div class=\"flex-grow-1\">
                <p class=\"ds-sociaux-title\">Abonnez-vous et partagez&nbsp;!</p>
                <p class=\"ds-sociaux-sub\">Ne manquez aucune offre et faites-en profiter vos proches.</p>
            </div>
            <div class=\"ds-sociaux-icons\">
                <div class=\"d-flex gap-2 mb-2 justify-content-end\">
                    <a href=\"https://www.tiktok.com/@bluelife.tech\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-soc-btn\" title=\"TikTok\"><i class=\"fab fa-tiktok\"></i></a>
                    <a href=\"https://www.facebook.com/dressurds\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-soc-btn\" title=\"Facebook\"><i class=\"fab fa-facebook-f\"></i></a>
                </div>
                <div class=\"d-flex gap-2 justify-content-end\">
                    <a href=\"https://www.instagram.com/bluelife.tech?igsh=Mjcyc2tpMmw4dXhu\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-soc-btn\" title=\"Instagram\"><i class=\"fab fa-instagram\"></i></a>
                    <a href=\"https://whatsapp.com/channel/0029Vag8B6cCBtxMRvCqaA3t\" target=\"_blank\" rel=\"noopener\"
                       class=\"ds-soc-btn\" title=\"WhatsApp\"><i class=\"fab fa-whatsapp\"></i></a>
                </div>
            </div>
        </div>

        <button type=\"button\"
                class=\"ds-sociaux-share-btn mt-3 w-100\"
                id=\"ds-share-dressur-btn\">
            <i class=\"fas fa-share-nodes me-2\"></i>PARTAGER DRESSUR
        </button>

    </div>
</div>

<style>
.ds-sociaux-card { padding: 0 4px; }
.ds-sociaux-inner {
    background: linear-gradient(135deg, #2a4b9a 0%, rgba(42,75,154,.85) 100%);
    border-radius: 16px;
    padding: 18px 16px 14px;
    box-shadow: 0 8px 24px rgba(42,75,154,.28);
}
.ds-sociaux-title { color:#fff; font-weight:600; font-size:.97rem; margin-bottom:4px; }
.ds-sociaux-sub   { color:rgba(255,255,255,.82); font-size:.82rem; margin-bottom:0; line-height:1.4; }
.ds-soc-btn {
    width:40px; height:40px; border-radius:50%;
    background:rgba(255,255,255,.15);
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:16px; text-decoration:none;
    transition:background .2s, transform .15s;
}
.ds-soc-btn:hover { background:rgba(255,255,255,.30); transform:scale(1.1); color:#fff; }
.ds-sociaux-share-btn {
    background:#fff; color:#2a4b9a;
    border:none; border-radius:50px;
    padding:10px 20px; font-weight:700; font-size:.85rem; letter-spacing:.5px;
    cursor:pointer; display:flex; align-items:center; justify-content:center;
    transition:box-shadow .2s, opacity .15s;
}
.ds-sociaux-share-btn:hover { box-shadow:0 4px 16px rgba(255,255,255,.35); opacity:.92; }
</style>

<script>
(function () {
    var MSG = \"ADD WhatsApp Gratuitement.\\n\"
            + \"Utilisez simplement la fonctionnalit\\u00e9 Boost Contact de Dressur apr\\u00e8s votre inscription.\\n\"
            + \"Pour Android\\u00a0: https://play.google.com/store/apps/details?id=com.dressur.ds\\n\"
            + \"Pour iPhone\\u00a0: https://dressur.site/inscription\";

    var FLYER_URL = \x27/assets/images/flyers_dressur_fr.png\x27;

    /* ── Bouton PARTAGER DRESSUR ──
       Règle : l\x27affiche accompagne TOUJOURS le partage.
       Si le partage avec fichier est impossible → téléchargement de l\x27affiche (jamais de texte seul).
       1. navigator.share absent                          → téléchargement
       2. navigator.canShare({ files }) = false           → téléchargement
       3. navigator.canShare({ files }) = true            → partage natif avec image + texte ✅
       4. Utilisateur annule (AbortError)                 → rien
       5. Autre erreur (fetch échoué, etc.)               → téléchargement */
    document.addEventListener(\x27click\x27, function (e) {
        if (!e.target.closest(\x27#ds-share-dressur-btn\x27)) return;

        if (typeof navigator.share !== \x27function\x27) {
            dsDownloadFlyer();
            return;
        }

        fetch(FLYER_URL)
            .then(function (r) { return r.blob(); })
            .then(function (blob) {
                var file = new File([blob], \x27flyer-dressur.png\x27, { type: blob.type });
                var shareData = {
                    title: \x27ADD WhatsApp Gratuitement\\u00a0!\x27,
                    text:  MSG,
                    files: [file]
                };
                if (navigator.canShare && navigator.canShare(shareData)) {
                    /* Partage natif avec l\x27affiche + le texte */
                    return navigator.share(shareData);
                }
                /* Partage de fichiers non supporté → téléchargement à la place */
                dsDownloadFlyer();
            })
            .catch(function (err) {
                if (err.name !== \x27AbortError\x27) {
                    dsDownloadFlyer();
                }
            });
    });

    function dsDownloadFlyer() {
        var a = document.createElement(\x27a\x27);
        a.href = FLYER_URL;
        a.download = \x27flyer-dressur.png\x27;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
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
        return "private/_includes/_sociaux.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  42 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/_includes/_sociaux.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/_includes/_sociaux.html.twig");
    }
}
