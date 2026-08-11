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

/* crud_user/_form.html.twig */
class __TwigTemplate_bc53020bf1955f81b4245007ac6bd115 extends Template
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
        // line 1
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_start');
        yield "

<div class=\"row g-3\">

    ";
        // line 6
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Identité</h6></div>

    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 9
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pseudo", [], "any", false, false, false, 9), 'label');
        yield "</label>
        ";
        // line 10
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pseudo", [], "any", false, false, false, 10), 'widget');
        yield "
        ";
        // line 11
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pseudo", [], "any", false, false, false, 11), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 14
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "nom", [], "any", false, false, false, 14), 'label');
        yield "</label>
        ";
        // line 15
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "nom", [], "any", false, false, false, 15), 'widget');
        yield "
        ";
        // line 16
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "nom", [], "any", false, false, false, 16), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 19
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mail", [], "any", false, false, false, 19), 'label');
        yield "</label>
        ";
        // line 20
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mail", [], "any", false, false, false, 20), 'widget');
        yield "
        ";
        // line 21
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mail", [], "any", false, false, false, 21), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tel", [], "any", false, false, false, 24), 'label');
        yield "</label>
        ";
        // line 25
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tel", [], "any", false, false, false, 25), 'widget');
        yield "
        ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tel", [], "any", false, false, false, 26), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <label class=\"form-label fw-semibold\">";
        // line 29
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pays", [], "any", false, false, false, 29), 'label');
        yield "</label>
        ";
        // line 30
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pays", [], "any", false, false, false, 30), 'widget');
        yield "
        ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "pays", [], "any", false, false, false, 31), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <label class=\"form-label fw-semibold\">";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lang", [], "any", false, false, false, 34), 'label');
        yield "</label>
        ";
        // line 35
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lang", [], "any", false, false, false, 35), 'widget');
        yield "
        ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lang", [], "any", false, false, false, 36), 'errors');
        yield "
    </div>
    <div class=\"col-12\">
        <label class=\"form-label fw-semibold\">";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "apropos", [], "any", false, false, false, 39), 'label');
        yield "</label>
        ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "apropos", [], "any", false, false, false, 40), 'widget');
        yield "
        ";
        // line 41
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "apropos", [], "any", false, false, false, 41), 'errors');
        yield "
    </div>

    ";
        // line 45
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Réseaux sociaux</h6></div>

    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 48
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tiktok", [], "any", false, false, false, 48), 'label');
        yield "</label>
        ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tiktok", [], "any", false, false, false, 49), 'widget');
        yield "
        ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "tiktok", [], "any", false, false, false, 50), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 53
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "instagram", [], "any", false, false, false, 53), 'label');
        yield "</label>
        ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "instagram", [], "any", false, false, false, 54), 'widget');
        yield "
        ";
        // line 55
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "instagram", [], "any", false, false, false, 55), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "facebook", [], "any", false, false, false, 58), 'label');
        yield "</label>
        ";
        // line 59
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "facebook", [], "any", false, false, false, 59), 'widget');
        yield "
        ";
        // line 60
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "facebook", [], "any", false, false, false, 60), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "youtube", [], "any", false, false, false, 63), 'label');
        yield "</label>
        ";
        // line 64
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "youtube", [], "any", false, false, false, 64), 'widget');
        yield "
        ";
        // line 65
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "youtube", [], "any", false, false, false, 65), 'errors');
        yield "
    </div>

    ";
        // line 69
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Statuts & Droits</h6></div>

    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 73
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mailIsVerified", [], "any", false, false, false, 73), 'widget');
        yield "
            ";
        // line 74
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mailIsVerified", [], "any", false, false, false, 74), 'label');
        yield "
        </div>
        ";
        // line 76
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "mailIsVerified", [], "any", false, false, false, 76), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 80
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "telIsVerified", [], "any", false, false, false, 80), 'widget');
        yield "
            ";
        // line 81
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "telIsVerified", [], "any", false, false, false, 81), 'label');
        yield "
        </div>
        ";
        // line 83
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "telIsVerified", [], "any", false, false, false, 83), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 87
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "admin", [], "any", false, false, false, 87), 'widget');
        yield "
            ";
        // line 88
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "admin", [], "any", false, false, false, 88), 'label');
        yield "
        </div>
        ";
        // line 90
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "admin", [], "any", false, false, false, 90), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <div class=\"mb-3\">
            ";
        // line 94
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lecteur", [], "any", false, false, false, 94), 'errors');
        yield "
            ";
        // line 95
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lecteur", [], "any", false, false, false, 95), 'widget');
        yield "
            ";
        // line 96
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lecteur", [], "any", false, false, false, 96), 'label');
        yield "
        </div>
    </div>
    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 101
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "blocked", [], "any", false, false, false, 101), 'widget');
        yield "
            ";
        // line 102
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "blocked", [], "any", false, false, false, 102), 'label');
        yield "
        </div>
        ";
        // line 104
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "blocked", [], "any", false, false, false, 104), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 108
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "vendeur", [], "any", false, false, false, 108), 'widget');
        yield "
            ";
        // line 109
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "vendeur", [], "any", false, false, false, 109), 'label');
        yield "
        </div>
        ";
        // line 111
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "vendeur", [], "any", false, false, false, 111), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 115
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "estPartenaire", [], "any", false, false, false, 115), 'widget');
        yield "
            ";
        // line 116
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "estPartenaire", [], "any", false, false, false, 116), 'label');
        yield "
        </div>
        ";
        // line 118
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "estPartenaire", [], "any", false, false, false, 118), 'errors');
        yield "
    </div>

    ";
        // line 122
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Programme de récompenses</h6></div>

    <div class=\"col-md-4\">
        <div class=\"form-check mt-2\">
            ";
        // line 126
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "isInscritProgrammeRecompense", [], "any", false, false, false, 126), 'widget');
        yield "
            ";
        // line 127
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "isInscritProgrammeRecompense", [], "any", false, false, false, 127), 'label');
        yield "
        </div>
        ";
        // line 129
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "isInscritProgrammeRecompense", [], "any", false, false, false, 129), 'errors');
        yield "
    </div>
    <div class=\"col-md-4\">
        <label class=\"form-label fw-semibold\">";
        // line 132
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 132), 'label');
        yield "</label>
        ";
        // line 133
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 133), 'widget');
        yield "
        ";
        // line 134
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 134), 'errors');
        yield "
    </div>

    ";
        // line 138
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Identifiants techniques</h6></div>

    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 141
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "uid", [], "any", false, false, false, 141), 'label');
        yield "</label>
        ";
        // line 142
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "uid", [], "any", false, false, false, 142), 'widget');
        yield "
        ";
        // line 143
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "uid", [], "any", false, false, false, 143), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 146
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lid", [], "any", false, false, false, 146), 'label');
        yield "</label>
        ";
        // line 147
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lid", [], "any", false, false, false, 147), 'widget');
        yield "
        ";
        // line 148
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lid", [], "any", false, false, false, 148), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 151
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "codePartenaire", [], "any", false, false, false, 151), 'label');
        yield "</label>
        ";
        // line 152
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "codePartenaire", [], "any", false, false, false, 152), 'widget');
        yield "
        ";
        // line 153
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "codePartenaire", [], "any", false, false, false, 153), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 156
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "registerSource", [], "any", false, false, false, 156), 'label');
        yield "</label>
        ";
        // line 157
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "registerSource", [], "any", false, false, false, 157), 'widget');
        yield "
        ";
        // line 158
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "registerSource", [], "any", false, false, false, 158), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 161
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginSource", [], "any", false, false, false, 161), 'label');
        yield "</label>
        ";
        // line 162
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginSource", [], "any", false, false, false, 162), 'widget');
        yield "
        ";
        // line 163
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginSource", [], "any", false, false, false, 163), 'errors');
        yield "
    </div>

    ";
        // line 167
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Dates</h6></div>

    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 170
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "createdAt", [], "any", false, false, false, 170), 'label');
        yield "</label>
        ";
        // line 171
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "createdAt", [], "any", false, false, false, 171), 'widget');
        yield "
        ";
        // line 172
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "createdAt", [], "any", false, false, false, 172), 'errors');
        yield "
    </div>
    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 175
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginTo", [], "any", false, false, false, 175), 'label');
        yield "</label>
        ";
        // line 176
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginTo", [], "any", false, false, false, 176), 'widget');
        yield "
        ";
        // line 177
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "lastLoginTo", [], "any", false, false, false, 177), 'errors');
        yield "
    </div>

    ";
        // line 181
        yield "    <div class=\"col-12\"><h6 class=\"text-muted text-uppercase fw-bold border-bottom pb-1 mt-2\">Sécurité</h6></div>

    <div class=\"col-md-6\">
        <label class=\"form-label fw-semibold\">";
        // line 184
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "password", [], "any", false, false, false, 184), 'label');
        yield "</label>
        ";
        // line 185
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "password", [], "any", false, false, false, 185), 'widget');
        yield "
        <div class=\"form-text text-muted\">Laisser vide pour conserver le mot de passe actuel.</div>
        ";
        // line 187
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "password", [], "any", false, false, false, 187), 'errors');
        yield "
    </div>

    ";
        // line 191
        yield "    <div class=\"col-12 mt-3\">
        <button class=\"btn btn-primary\">";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("button_label", $context)) ? (Twig\Extension\CoreExtension::default(($context["button_label"] ?? null), "Save")) : ("Save")), "html", null, true);
        yield "</button>
    </div>

</div>

";
        // line 197
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? null), 'form_end');
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_user/_form.html.twig";
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
        return array (  504 => 197,  496 => 192,  493 => 191,  487 => 187,  482 => 185,  478 => 184,  473 => 181,  467 => 177,  463 => 176,  459 => 175,  453 => 172,  449 => 171,  445 => 170,  440 => 167,  434 => 163,  430 => 162,  426 => 161,  420 => 158,  416 => 157,  412 => 156,  406 => 153,  402 => 152,  398 => 151,  392 => 148,  388 => 147,  384 => 146,  378 => 143,  374 => 142,  370 => 141,  365 => 138,  359 => 134,  355 => 133,  351 => 132,  345 => 129,  340 => 127,  336 => 126,  330 => 122,  324 => 118,  319 => 116,  315 => 115,  308 => 111,  303 => 109,  299 => 108,  292 => 104,  287 => 102,  283 => 101,  275 => 96,  271 => 95,  267 => 94,  260 => 90,  255 => 88,  251 => 87,  244 => 83,  239 => 81,  235 => 80,  228 => 76,  223 => 74,  219 => 73,  213 => 69,  207 => 65,  203 => 64,  199 => 63,  193 => 60,  189 => 59,  185 => 58,  179 => 55,  175 => 54,  171 => 53,  165 => 50,  161 => 49,  157 => 48,  152 => 45,  146 => 41,  142 => 40,  138 => 39,  132 => 36,  128 => 35,  124 => 34,  118 => 31,  114 => 30,  110 => 29,  104 => 26,  100 => 25,  96 => 24,  90 => 21,  86 => 20,  82 => 19,  76 => 16,  72 => 15,  68 => 14,  62 => 11,  58 => 10,  54 => 9,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user/_form.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user/_form.html.twig");
    }
}
