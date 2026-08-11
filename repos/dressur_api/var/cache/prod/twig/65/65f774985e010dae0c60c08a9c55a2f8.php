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

/* private/editprofil.html.twig */
class __TwigTemplate_7dfea289f2600930b14154046b027999 extends Template
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
        yield "Profil";
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
        yield "<div class=\"card\">
    <div class=\"card-body\">
        <h4 class=\"text-center pb-3\">Modifiez et complétez vos informations</h4>
        
        <div class=\"row g-2\">

            <div class=\"col-12\">
                <div class=\"mt-0\" id=\"msgError\" style=\"display: none;\"></div>
            </div>
            
            <div class=\"col-md-3\">
                <label for=\"inputPseudo\" class=\"mb-1\">Pseudo</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-person-circle fs-6\"></i></div>
                <input value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "pseudo", [], "any", false, false, false, 20), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputPseudo\" placeholder=\"Pseudo\">
                </div>
            </div>
            <div class=\"";
        // line 23
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 23) == false)) {
            yield "col-md-3";
        } else {
            yield "col-md-4";
        }
        yield "\">
                <label for=\"inputEmail\" class=\"mb-1\">E-mail</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-envelope-fill fs-6\"></i></div>
                <input value=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mail", [], "any", false, false, false, 27), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputEmail\" placeholder=\"E-mail\">
                </div>
            </div>
            ";
        // line 30
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 30) == false)) {
            // line 31
            yield "                <div class=\"col-md-3\">
                    <label for=\"inputTelWhatsApp\" class=\"mb-1\">Numéro WhatsApp</label>
                    <div class=\"ms-auto position-relative\">
                    <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"fab fa-whatsapp-square fs-6\"></i></div>
                    <input value=\"";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tel", [], "any", false, false, false, 35), "html", null, true);
            yield "\" type=\"text\" class=\"form-control mb-1 getInfo radius-30 ps-5\" id=\"inputTelWhatsApp\" placeholder=\"Numéro WhatsApp\">
                    </div>
                </div>
            ";
        }
        // line 39
        yield "            <div class=\"";
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 39) == false)) {
            yield "col-md-3";
        } else {
            yield "col-md-5";
        }
        yield "\">
                <label for=\"inputNomPrenom\" class=\"mb-1\">Nom & Prénom(s)</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"bi bi-person-circle fs-6\"></i></div>
                <input value=\"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 43), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 radius-30 ps-5\" id=\"inputNomPrenom\" placeholder=\"Nom et Prénom(s)\">
                </div>
            </div>
            <div class=\"col-md-3\">
                <label for=\"inputTiktok\" class=\"mb-1\">Lien TikTok</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"fas fa-link\"></i></div>
                <input value=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "tiktok", [], "any", false, false, false, 50), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 radius-30 ps-5\" id=\"inputTiktok\" placeholder=\"Lien TikTok\">
                </div>
            </div>
            <div class=\"col-md-3\">
                <label for=\"inputInstagram\" class=\"mb-1\">Lien Instagram</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"fas fa-link\"></i></div>
                <input value=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "instagram", [], "any", false, false, false, 57), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 radius-30 ps-5\" id=\"inputInstagram\" placeholder=\"Lien Instagram\">
                </div>
            </div>
            
            <div class=\"col-md-3\">
                <label for=\"inputFacebook\" class=\"mb-1\">Lien Facebook</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"fas fa-link\"></i></div>
                <input value=\"";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "facebook", [], "any", false, false, false, 65), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 radius-30 ps-5\" id=\"inputFacebook\" placeholder=\"Lien Facebook\">
                </div>
            </div>
            <div class=\"col-md-3\">
                <label for=\"inputYoutube\" class=\"mb-1\">Lien Youtube</label>
                <div class=\"ms-auto position-relative\">
                <div class=\"position-absolute top-50 translate-middle-y search-icon px-3\"><i class=\"fas fa-link\"></i></div>
                <input value=\"";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "youtube", [], "any", false, false, false, 72), "html", null, true);
        yield "\" type=\"text\" class=\"form-control mb-1 radius-30 ps-5\" id=\"inputYoutube\" placeholder=\"Lien Youtube\">
                </div>
            </div>
            <div class=\"col-md-12\">
                <label for=\"inputAPropos\" class=\"mb-1\">A propos de vous</label>
                <textarea id=\"inputAPropos\" class=\"form-control mb-1\" rows=\"15\">";
        // line 77
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "apropos", [], "any", false, false, false, 77), "html", null, true);
        yield "</textarea>
            </div>
        </div>

        <button class=\"btn btn-primary mt-3\" id=\"enregistrerProfil\">ENREGISTRER</button>
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
        return "private/editprofil.html.twig";
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
        return array (  185 => 77,  177 => 72,  167 => 65,  156 => 57,  146 => 50,  136 => 43,  124 => 39,  117 => 35,  111 => 31,  109 => 30,  103 => 27,  92 => 23,  86 => 20,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/editprofil.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/editprofil.html.twig");
    }
}
