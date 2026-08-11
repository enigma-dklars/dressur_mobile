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

/* public/passe4get.html.twig */
class __TwigTemplate_b51e807047cc95125382a98d0e92b247 extends Template
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
            'referencement' => [$this, 'block_referencement'],
            'robots_meta' => [$this, 'block_robots_meta'],
            'title' => [$this, 'block_title'],
            'style' => [$this, 'block_style'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $context["description"] = "Réinitialisez votre mot de passe sur Dressur. Entrez votre e-mail pour recevoir les instructions de récupération.";
        // line 4
        $context["title"] = "Mot de passe oublié";
        // line 1
        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    <meta property=\"og:title\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta property=\"og:description\" content=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta property=\"og:image\" content=\"https://dressur.site/assets/img/hero.jpg\" />
    <meta property=\"og:url\" content=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_mot_de_passe_oublier");
        yield "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta name=\"twitter:card\" content=\"summary_large_image\" />
    <meta name=\"twitter:title\" content=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " | Dressur Web\" />
    <meta name=\"twitter:description\" content=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"twitter:image\" content=\"https://dressur.site/assets/img/hero.jpg\" />
    <meta name=\"description\" content=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["description"] ?? null), "html", null, true);
        yield "\" />
    <meta name=\"keywords\" content=\"mot de passe oublié, réinitialisation mot de passe, récupération mot de passe, Dressur\" />
";
        yield from [];
    }

    // line 20
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_robots_meta(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "<meta name=\"robots\" content=\"noindex, nofollow\">";
        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 24
        yield "<style>
    body { background: #f4f6fb; }
    html.dark-theme body { background: #111827; }

    .auth-wrap {
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 16px;
    }
    .auth-card {
        display: flex;
        width: 100%;
        max-width: 860px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    }

    /* Left panel */
    .auth-panel {
        background: linear-gradient(160deg, #0f2460 0%, #1a3a8f 55%, #1565c0 100%);
        width: 44%;
        padding: 48px 36px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    .auth-panel::before {
        content: \x27\x27;
        position: absolute;
        top: -60px; right: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .auth-panel::after {
        content: \x27\x27;
        position: absolute;
        bottom: -40px; left: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .auth-panel-logo {
        font-size: 1.6rem;
        font-weight: 900;
        color: #fff;
        letter-spacing: -0.5px;
        margin-bottom: 36px;
    }
    .auth-panel-logo span { color: #4fc3f7; }
    .auth-lock-icon {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #4fc3f7;
        margin: 0 auto 24px;
    }
    .auth-panel h2 {
        color: #fff;
        font-weight: 800;
        font-size: 1.3rem;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    .auth-panel p {
        color: rgba(255,255,255,0.7);
        font-size: 0.88rem;
        line-height: 1.65;
        margin: 0;
    }

    /* Right panel */
    .auth-form-panel {
        flex: 1;
        background: #fff;
        padding: 52px 44px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    html.dark-theme .auth-form-panel { background: #1a2232; }
    .auth-form-panel h3 {
        font-weight: 800;
        font-size: 1.5rem;
        color: #0f2460;
        margin-bottom: 4px;
    }
    html.dark-theme .auth-form-panel h3 { color: #fcfcfc; }
    .auth-form-panel .sub {
        font-size: 0.87rem;
        color: #6c757d;
        margin-bottom: 28px;
        line-height: 1.6;
    }

    /* Steps hint */
    .auth-steps {
        background: #f1f5fd;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 24px;
    }
    html.dark-theme .auth-steps { background: #111827; }
    .auth-step {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.83rem;
        color: #374151;
        margin-bottom: 6px;
    }
    .auth-step:last-child { margin-bottom: 0; }
    html.dark-theme .auth-step { color: #c8cdd4; }
    .auth-step-num {
        width: 20px; height: 20px;
        border-radius: 50%;
        background: #1a3a8f;
        color: #fff;
        font-size: 0.68rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* Input */
    .auth-field { margin-bottom: 18px; }
    .auth-label {
        font-size: 0.81rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
        display: block;
    }
    html.dark-theme .auth-label { color: #c8cdd4; }
    .auth-input-wrap { position: relative; }
    .auth-input-icon {
        position: absolute;
        top: 50%; left: 14px;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.9rem;
        pointer-events: none;
    }
    .auth-input {
        width: 100%;
        background: #f8f9ff;
        border: 1.5px solid #e9ecef;
        border-radius: 12px;
        padding: 13px 14px 13px 42px;
        font-size: 0.95rem;
        color: #374151;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        font-family: inherit;
    }
    html.dark-theme .auth-input { background: #111827; border-color: #2e3a55; color: #fcfcfc; }
    .auth-input:focus { border-color: #1a3a8f; box-shadow: 0 0 0 3px rgba(26,58,143,0.1); }
    html.dark-theme .auth-input:focus { border-color: #4fc3f7; box-shadow: 0 0 0 3px rgba(79,195,247,0.1); }
    .auth-input::placeholder { color: #b0b8c4; }

    /* Buttons */
    .btn-auth {
        width: 100%;
        background: linear-gradient(135deg, #0f2460, #1a3a8f);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 13px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.28s;
        box-shadow: 0 4px 16px rgba(26,58,143,0.3);
        margin-bottom: 12px;
    }
    .btn-auth:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26,58,143,0.38); }
    .btn-auth-back {
        width: 100%;
        background: transparent;
        border: 1.5px solid #e9ecef;
        border-radius: 12px;
        padding: 11px;
        font-weight: 600;
        font-size: 0.9rem;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        text-decoration: none;
        display: block;
    }
    html.dark-theme .btn-auth-back { border-color: #2e3a55; color: #9ea4aa; }
    .btn-auth-back:hover { border-color: #1a3a8f; color: #1a3a8f; }
    html.dark-theme .btn-auth-back:hover { border-color: #4fc3f7; color: #4fc3f7; }

    #msgError { border-radius: 10px; font-size: 0.87rem; margin-bottom: 16px; }

    @media (max-width: 650px) {
        .auth-panel { display: none; }
        .auth-card { max-width: 440px; }
        .auth-form-panel { padding: 36px 24px; }
    }
</style>
";
        yield from [];
    }

    // line 244
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 245
        yield "<div class=\"auth-wrap\">
    <div class=\"auth-card\">

        ";
        // line 249
        yield "        <div class=\"auth-panel\">
            <div class=\"auth-panel-logo\"><i class=\"fas fa-circle-nodes me-2\"></i>Dress<span>ur</span></div>
            <div class=\"auth-lock-icon\"><i class=\"fas fa-key\"></i></div>
            <h2>Récupération de compte</h2>
            <p>Pas de panique ! Entrez votre adresse e-mail et nous vous enverrons un nouveau mot de passe.</p>
        </div>

        ";
        // line 257
        yield "        <div class=\"auth-form-panel\">
            <h3>Mot de passe oublié ?</h3>
            <p class=\"sub\">Un nouveau mot de passe sera envoyé à votre adresse email. Utilisez-le pour vous reconnecter.</p>

            <div class=\"auth-steps\">
                <div class=\"auth-step\"><span class=\"auth-step-num\">1</span> Entrez votre adresse email ci-dessous</div>
                <div class=\"auth-step\"><span class=\"auth-step-num\">2</span> Consultez votre boîte mail</div>
                <div class=\"auth-step\"><span class=\"auth-step-num\">3</span> Connectez-vous avec le nouveau mot de passe reçu</div>
            </div>

            <div id=\"msgError\" style=\"display:none;\"></div>

            <form class=\"form-body\">
                <div class=\"auth-field\">
                    <label class=\"auth-label\" for=\"inputEmail\">Votre adresse e-mail</label>
                    <div class=\"auth-input-wrap\">
                        <i class=\"auth-input-icon fas fa-envelope\"></i>
                        <input type=\"email\" class=\"auth-input getInfo\" id=\"inputEmail\" placeholder=\"votre@email.com\">
                    </div>
                </div>

                <button type=\"button\" class=\"btn-auth\" id=\"passe4get\">
                    <i class=\"fas fa-paper-plane me-2\"></i> Envoyer le nouveau mot de passe
                </button>

                <a href=\"";
        // line 282
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_connexion");
        yield "\" class=\"btn-auth-back\">
                    <i class=\"fas fa-arrow-left me-2\"></i> Retour à la connexion
                </a>
            </form>
        </div>

    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/passe4get.html.twig";
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
        return array (  400 => 282,  373 => 257,  364 => 249,  359 => 245,  352 => 244,  129 => 24,  122 => 23,  111 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/passe4get.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/passe4get.html.twig");
    }
}
