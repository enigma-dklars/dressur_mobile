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

/* private/apropos.html.twig */
class __TwigTemplate_b53ed889bffb420263cb7cf8ce1dfd4e extends Template
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
        yield "À Propos";
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
        yield "<div class=\"row justify-content-center g-4\">

    ";
        // line 9
        yield "    <div class=\"col-12 text-center\">
        <img src=\"/assets/images/ds_logo.png\" alt=\"Dressur\" style=\"height:72px;\" class=\"mb-3\">
        <h3 class=\"fw-bold mb-0\">Dressur</h3>
        <p class=\"text-muted small\">Version 1.1.8</p>
    </div>

    ";
        // line 16
        yield "    <div class=\"col-md-8\">
        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-body p-4\">
                <h5 class=\"fw-bold mb-3\"><i class=\"fas fa-bullseye text-primary me-2\"></i>Notre Mission</h5>
                <p class=\"mb-0\">
                    Accélérer votre croissance digitale en vous donnant une visibilité maximale
                    sur vos différents réseaux sociaux et en vous connectant rapidement à de nouveaux
                    contacts WhatsApp dans les pays de votre choix.
                </p>
            </div>
        </div>
    </div>

    ";
        // line 30
        yield "    <div class=\"col-md-8\">
        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-body p-4\">
                <h5 class=\"fw-bold mb-3\"><i class=\"fas fa-star text-warning me-2\"></i>Ce que Dressur vous offre</h5>
                <ul class=\"list-unstyled mb-0\">
                    <li class=\"d-flex align-items-start gap-3 mb-3\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 flex-shrink-0\" style=\"width:40px;height:40px;\">
                            <i class=\"fas fa-store text-primary\"></i>
                        </span>
                        <div>
                            <div class=\"fw-semibold\">Promotion de produits &amp; services</div>
                            <div class=\"text-muted small\">Faites connaître vos offres à des milliers d\x27utilisateurs en 24h.</div>
                        </div>
                    </li>
                    <li class=\"d-flex align-items-start gap-3 mb-3\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 flex-shrink-0\" style=\"width:40px;height:40px;\">
                            <i class=\"fas fa-chart-line text-success\"></i>
                        </span>
                        <div>
                            <div class=\"fw-semibold\">Boost réseaux sociaux</div>
                            <div class=\"text-muted small\">Augmentez votre audience sur TikTok, Instagram, Facebook, YouTube et plus.</div>
                        </div>
                    </li>
                    <li class=\"d-flex align-items-start gap-3 mb-3\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 flex-shrink-0\" style=\"width:40px;height:40px;\">
                            <i class=\"fas fa-address-book text-warning\"></i>
                        </span>
                        <div>
                            <div class=\"fw-semibold\">Acquisition de contacts WhatsApp</div>
                            <div class=\"text-muted small\">Obtenez des contacts ciblés selon les pays de votre choix, automatiquement enregistrés.</div>
                        </div>
                    </li>
                    <li class=\"d-flex align-items-start gap-3 mb-0\">
                        <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10 flex-shrink-0\" style=\"width:40px;height:40px;\">
                            <i class=\"fab fa-whatsapp text-info\"></i>
                        </span>
                        <div>
                            <div class=\"fw-semibold\">Contact WhatsApp facilité</div>
                            <div class=\"text-muted small\">Votre contact est enregistré chez vos nouveaux contacts, et les leurs chez vous.</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    ";
        // line 77
        yield "    <div class=\"col-md-8\">
        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-body p-4\">
                <h5 class=\"fw-bold mb-3\"><i class=\"fab fa-google-play text-success me-2\"></i>Application mobile</h5>
                <p class=\"text-muted small mb-3\">Accédez à toutes les fonctionnalités depuis votre téléphone Android.</p>
                <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\" target=\"_blank\" rel=\"noopener noreferrer\"
                   class=\"btn btn-success\">
                    <i class=\"fab fa-google-play me-2\"></i>Télécharger sur Play Store
                </a>
            </div>
        </div>
    </div>

    ";
        // line 91
        yield "    <div class=\"col-md-8\">
        <div class=\"card border-0 shadow-sm\">
            <div class=\"card-body p-4\">
                <h5 class=\"fw-bold mb-3\"><i class=\"fas fa-scale-balanced text-muted me-2\"></i>Informations légales</h5>
                <div class=\"d-flex flex-wrap gap-3\">
                    <a href=\"https://dressur.site/conditions-utilisation\" target=\"_blank\" rel=\"noopener noreferrer\"
                       class=\"btn btn-outline-secondary btn-sm\">
                        <i class=\"fas fa-file-lines me-1\"></i>Conditions d\x27utilisation
                    </a>
                    <a href=\"https://dressur.site/politique-confidentialite\" target=\"_blank\" rel=\"noopener noreferrer\"
                       class=\"btn btn-outline-secondary btn-sm\">
                        <i class=\"fas fa-shield-halved me-1\"></i>Politique de confidentialité
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=\"col-12 text-center text-muted small pb-3\">
        &copy; ";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " Dressur · Tous droits réservés
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
        return "private/apropos.html.twig";
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
        return array (  181 => 110,  160 => 91,  145 => 77,  97 => 30,  82 => 16,  74 => 9,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/apropos.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/apropos.html.twig");
    }
}
