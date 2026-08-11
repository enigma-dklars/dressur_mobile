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

/* private/partagerDressur.html.twig */
class __TwigTemplate_fbc4db9a69d7aa45f979803242dae738 extends Template
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
        yield "Partager Dressur";
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
        <h4 class=\"text-center pb-0 mb-1\">Partager Dressur</h4>
        <p class=\"text-center pb-0 mb-0 small\">Partager Dressur sur vos statuts et compte Facebook, Instagram, TikTok, Télégram, etc... pour avoir des Points Bonus </p>
        <p class=\"text-center pb-3 small\">Avec les points bonus, vous pourrez obtenir plus de contacts et promouvoir vos services/produits/événements gratuitement sur Dressur.</p>
        
        <div class=\"row g-2\">
            <div class=\"col-md-6\">
                <div class=\"card\"><img src=\"/promotion/dressur_pro_1718183113.jpg\" alt=\"\" class=\"card-img-top\"></div>
            </div>
            <div class=\"col-md-6\">
                <p>
                    Utilise Dressur, une application simple, sûr et fiable pour avoir de la visibilité sur tes différents réseaux sociaux et surtout sur tes statuts WhatsApp.
                    <br>
                    Grâce à Dressur, fait la promotion de tes produits et services qui seront visibles par des milliers d\x27utilisateurs en seulement 24H.
                    <br>
                    Elle te permet d\x27avoir plus facilement des contacts WhatsApp selon les pays de ton choix. De plus, ses contacts sont automatiquement enregistrés dans ton téléphone et ton contact dans les leurs, etc.
                    <br><br>
                    A télécharger gratuitement sur Play Store : https://play.google.com/store/apps/details?id=com.dressur.ds
                    <br><br>
                    Rejoins-moi sur Dressur et découvre ses services !
                </p>
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
        return "private/partagerDressur.html.twig";
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
        return array (  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/partagerDressur.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/partagerDressur.html.twig");
    }
}
