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

/* public/register.html.twig */
class __TwigTemplate_975f07cc1e769b491887ec1041fe298f extends Template
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
        $context["description"] = "Inscrivez-vous dès aujourd\x27hui sur Dressur pour gérer vos compétences et garantir une grande visibilité. Entrez vos informations essentielles pour créer votre compte.";
        // line 4
        $context["title"] = "S\x27inscrire";
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("app_inscription");
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
    <meta name=\"keywords\" content=\"inscription, Dressur inscription, gérer compétences, visibilité, créer compte, réseau social, marketing digital, Dressur web\">
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
        max-width: 980px;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    }

    /* Left panel */
    .auth-panel {
        background: linear-gradient(160deg, #0f2460 0%, #1a3a8f 55%, #1565c0 100%);
        width: 38%;
        padding: 48px 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
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
        margin-bottom: 32px;
    }
    .auth-panel-logo span { color: #4fc3f7; }
    .auth-panel h2 {
        color: #fff;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 10px;
        line-height: 1.3;
    }
    .auth-panel p {
        color: rgba(255,255,255,0.7);
        font-size: 0.87rem;
        line-height: 1.65;
        margin-bottom: 28px;
    }
    .auth-feature {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,0.85);
        font-size: 0.84rem;
        margin-bottom: 10px;
    }
    .auth-feature i {
        width: 28px; height: 28px;
        border-radius: 8px;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
        color: #4fc3f7;
    }

    /* Right panel */
    .auth-form-panel {
        flex: 1;
        background: #fff;
        padding: 44px 40px;
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
        margin-bottom: 24px;
    }

    /* Inputs */
    .auth-field { margin-bottom: 16px; }
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
        padding: 11px 14px 11px 40px;
        font-size: 0.92rem;
        color: #374151;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        font-family: inherit;
    }
    html.dark-theme .auth-input { background: #111827; border-color: #2e3a55; color: #fcfcfc; }
    .auth-input:focus {
        border-color: #1a3a8f;
        box-shadow: 0 0 0 3px rgba(26,58,143,0.1);
    }
    html.dark-theme .auth-input:focus { border-color: #4fc3f7; box-shadow: 0 0 0 3px rgba(79,195,247,0.1); }
    .auth-input::placeholder { color: #b0b8c4; }

    /* Section label */
    .auth-section-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #9ca3af;
        margin: 18px 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .auth-section-label::after { content:\x27\x27; flex:1; height:1px; background:#e9ecef; }
    html.dark-theme .auth-section-label::after { background:#2e3a55; }
    html.dark-theme .auth-section-label { color: #6b7280; }

    /* Btn */
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
        letter-spacing: 0.3px;
    }
    .btn-auth:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26,58,143,0.38); }

    .auth-link { color: #1a3a8f; font-weight: 600; text-decoration: none; }
    html.dark-theme .auth-link { color: #4fc3f7; }
    .auth-link:hover { text-decoration: underline; }

    #msgError { border-radius: 10px; font-size: 0.87rem; }

    @media (max-width: 700px) {
        .auth-panel { display: none; }
        .auth-card { max-width: 480px; }
        .auth-form-panel { padding: 36px 24px; }
    }
</style>
";
        yield from [];
    }

    // line 222
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 223
        yield "<div class=\"auth-wrap\">
    <div class=\"auth-card\">

        ";
        // line 227
        yield "        <div class=\"auth-panel\">
            <div class=\"auth-panel-logo\"><i class=\"fas fa-circle-nodes me-2\"></i>Dress<span>ur</span></div>
            <h2>Rejoignez la communauté Dressur !</h2>
            <p>Créez votre compte gratuitement et accédez à tous nos services de marketing digital.</p>
            <div class=\"auth-feature\"><i class=\"fas fa-bolt\"></i> Inscription rapide et gratuite</div>
            <div class=\"auth-feature\"><i class=\"fas fa-shield-halved\"></i> Données sécurisées</div>
            <div class=\"auth-feature\"><i class=\"fas fa-robot\"></i> Accès à tous les services</div>
            <div class=\"auth-feature\"><i class=\"fas fa-headset\"></i> Support disponible</div>
        </div>

        ";
        // line 238
        yield "        <div class=\"auth-form-panel\">
            <h3>Créer un compte</h3>
            <p class=\"sub\">Renseignez vos informations pour vous inscrire.</p>

            <div id=\"msgError\" style=\"display:none;\"></div>

            <form class=\"form-body\">

                <div class=\"auth-section-label\"><i class=\"fas fa-user me-1\"></i> Coordonnées</div>
                <div class=\"row g-3\">
                    <div class=\"col-sm-6\">
                        <div class=\"auth-field mb-0\">
                            <label class=\"auth-label\" for=\"inputNumeroWhatsApp\">Numéro WhatsApp</label>
                            <div class=\"auth-input-wrap\">
                                <i class=\"auth-input-icon fab fa-whatsapp\"></i>
                                <input type=\"text\" class=\"auth-input getInfo\" id=\"inputNumeroWhatsApp\" placeholder=\"+229 XX XX XX XX\">
                            </div>
                        </div>
                    </div>
                    <div class=\"col-sm-6\">
                        <div class=\"auth-field mb-0\">
                            <label class=\"auth-label\" for=\"inputEmail\">Adresse e-mail</label>
                            <div class=\"auth-input-wrap\">
                                <i class=\"auth-input-icon fas fa-envelope\"></i>
                                <input type=\"email\" class=\"auth-input getInfo\" id=\"inputEmail\" placeholder=\"votre@email.com\">
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"auth-section-label\"><i class=\"fas fa-lock me-1\"></i> Sécurité</div>
                <div class=\"row g-3\">
                    <div class=\"col-sm-6\">
                        <div class=\"auth-field mb-0\">
                            <label class=\"auth-label\" for=\"inputMotPasse\">Mot de passe</label>
                            <div class=\"auth-input-wrap\">
                                <i class=\"auth-input-icon fas fa-lock\"></i>
                                <input type=\"password\" class=\"auth-input getInfo\" id=\"inputMotPasse\" placeholder=\"••••••••\">
                            </div>
                        </div>
                    </div>
                    <div class=\"col-sm-6\">
                        <div class=\"auth-field mb-0\">
                            <label class=\"auth-label\" for=\"inputConfirmerMotPasse\">Confirmer le mot de passe</label>
                            <div class=\"auth-input-wrap\">
                                <i class=\"auth-input-icon fas fa-lock\"></i>
                                <input type=\"password\" class=\"auth-input getInfo\" id=\"inputConfirmerMotPasse\" placeholder=\"••••••••\">
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"mt-4\">
                    <button type=\"button\" class=\"btn-auth\" id=\"inscription\">
                        <i class=\"fas fa-user-plus me-2\"></i> Créer mon compte
                    </button>
                </div>

                <p class=\"text-center mt-3 mb-0\" style=\"font-size:.87rem; color:#6c757d;\">
                    Vous avez déjà un compte ?
                    <a href=\"";
        // line 298
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_connexion");
        yield "\" class=\"auth-link ms-1\">Se connecter →</a>
                </p>

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
        return "public/register.html.twig";
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
        return array (  416 => 298,  354 => 238,  342 => 227,  337 => 223,  330 => 222,  129 => 24,  122 => 23,  111 => 21,  100 => 20,  92 => 16,  87 => 14,  83 => 13,  77 => 10,  72 => 8,  67 => 7,  60 => 6,  55 => 1,  53 => 4,  51 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "public/register.html.twig", "/home/runner/workspace/repos/dressur_api/templates/public/register.html.twig");
    }
}
