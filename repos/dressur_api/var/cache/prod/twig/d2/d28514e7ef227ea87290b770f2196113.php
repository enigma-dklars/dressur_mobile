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

/* private/confirmer_mail.html.twig */
class __TwigTemplate_7cddaa141d30b6f2fc27211eb0b8f48b extends Template
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
        yield "Confirmation de l\x27adresse mail";
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
        yield "<input type=\"hidden\" id=\"uid\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "uid", [], "any", false, false, false, 8), "html", null, true);
        yield "\">

<div class=\"row justify-content-center\">
    <div class=\"col-12 col-md-8 col-lg-6 col-xl-5\">

        ";
        // line 14
        yield "        <div class=\"text-center mb-4 mt-2\">
            <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-primary mb-3\" style=\"width:80px;height:80px;\">
                <i class=\"fas fa-envelope-open fa-2x text-white\"></i>
            </span>
            <h4 class=\"fw-bold mb-1\">Vérifiez vos e-mails</h4>
            <p class=\"text-muted mb-0\">
                Nous avons envoyé un code de confirmation à votre adresse&nbsp;:
            </p>
            <span class=\"d-inline-block mt-2 px-3 py-2 rounded fw-semibold text-white bg-primary\" style=\"font-size:.9rem;letter-spacing:.2px;word-break:break-all;\">
                ";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mail", [], "any", false, false, false, 23), "html", null, true);
        yield "
            </span>
        </div>

        ";
        // line 28
        yield "        <div class=\"card border-0 shadow-sm radius-10 mb-3\">
            <div class=\"card-body p-4\">

                ";
        // line 32
        yield "                <div class=\"mb-3 msgError\" id=\"msgErrorValideMail\" style=\"display:none;\"></div>

                ";
        // line 35
        yield "                <div class=\"mb-3\">
                    <label for=\"codeVerifMail\" class=\"form-label fw-semibold\">
                        <i class=\"fas fa-key me-1 text-primary\"></i> Code reçu par e-mail
                    </label>
                    <input
                        type=\"text\"
                        class=\"form-control form-control-lg text-center fw-bold getInfo getInfoVerifMail\"
                        id=\"codeVerifMail\"
                        placeholder=\"------\"
                        maxlength=\"6\"
                        autocomplete=\"one-time-code\"
                        inputmode=\"numeric\"
                        style=\"letter-spacing: 6px; font-size: 1.4rem;\"
                    >
                </div>

                ";
        // line 52
        yield "                <button class=\"btn btn-primary w-100 py-3 fw-bold mb-3\" id=\"validerVerifMail\" style=\"font-size:1rem;\">
                    <i class=\"fas fa-check-circle me-2\"></i> CONFIRMER
                </button>

                ";
        // line 57
        yield "                <div class=\"d-flex align-items-center gap-2 mb-3\">
                    <hr class=\"flex-grow-1 m-0\">
                    <span class=\"text-muted small\">ou</span>
                    <hr class=\"flex-grow-1 m-0\">
                </div>

                ";
        // line 64
        yield "                <button class=\"btn btn-outline-primary w-100 py-2 fw-semibold\" id=\"envoyerCodeMail\" style=\"font-size:.95rem;\">
                    <i class=\"fas fa-paper-plane me-2\"></i> Renvoyer le code
                </button>

            </div>
        </div>

        ";
        // line 72
        yield "        <div class=\"card border-0 shadow-sm radius-10\" style=\"border-left: 4px solid var(--bs-primary) !important;\">
            <div class=\"card-body p-4\">

                <p class=\"fw-semibold mb-3 text-primary\">
                    <i class=\"fas fa-circle-info me-2\"></i>Vous ne recevez pas le code ?
                </p>

                <ul class=\"list-unstyled mb-0 d-flex flex-column gap-2\">

                    <li class=\"d-flex align-items-start gap-2\">
                        <span class=\"text-primary mt-1\" style=\"font-size:.55rem;\">&#9679;</span>
                        <span class=\"text-muted small lh-base\">
                            Vérifiez que votre adresse e-mail a été saisie correctement lors de l\x27inscription.
                        </span>
                    </li>

                    <li class=\"d-flex align-items-start gap-2\">
                        <span class=\"text-primary mt-1\" style=\"font-size:.55rem;\">&#9679;</span>
                        <span class=\"text-muted small lh-base\">
                            Si elle est incorrecte, rendez-vous dans
                            <a href=\"/editprofil\" class=\"text-primary fw-semibold text-decoration-none\">Paramètres → Profil</a>
                            pour la corriger, puis revenez ici et renvoyez un nouveau code.
                        </span>
                    </li>

                    <li class=\"d-flex align-items-start gap-2\">
                        <span class=\"text-primary mt-1\" style=\"font-size:.55rem;\">&#9679;</span>
                        <span class=\"text-muted small lh-base\">
                            Pensez à vérifier votre dossier <strong>Spam</strong> ou <strong>Indésirables</strong> — le mail peut parfois s\x27y retrouver.
                        </span>
                    </li>

                    <li class=\"d-flex align-items-start gap-2\">
                        <span class=\"text-primary mt-1\" style=\"font-size:.55rem;\">&#9679;</span>
                        <span class=\"text-muted small lh-base\">
                            Si vous utilisez plusieurs adresses e-mail, assurez-vous d\x27ouvrir la bonne boîte de réception.
                        </span>
                    </li>

                </ul>

                <div class=\"mt-3 pt-3 border-top text-center\">
                    <span class=\"text-muted small\">Toujours bloqué ? </span>
                    <a href=\"/support\" class=\"text-primary small fw-semibold text-decoration-none\">
                        <i class=\"fas fa-headset me-1\"></i>Contacter le support
                    </a>
                </div>

            </div>
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
        return "private/confirmer_mail.html.twig";
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
        return array (  150 => 72,  141 => 64,  133 => 57,  127 => 52,  109 => 35,  105 => 32,  100 => 28,  93 => 23,  82 => 14,  73 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/confirmer_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/confirmer_mail.html.twig");
    }
}
