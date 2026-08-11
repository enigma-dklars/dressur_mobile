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

/* emails/bienvenu_mail.html.twig */
class __TwigTemplate_e516ee0dae69f0081a673eb92c7aa1d5 extends Template
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
            'contenu_mail' => [$this, 'block_contenu_mail'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "emails/templates_mail.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("emails/templates_mail.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_contenu_mail(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "   <div>
        <p>
            Bienvenue ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pseudoUser"] ?? null), "html", null, true);
        yield ", sur Dressur ! Nous sommes ravis de vous accueillir dans notre communauté 
            et de vous offrir une nouvelle expérience numérique exceptionnelle. 
        </p>
        <p> 
            <strong>Dressur en un coup d\x27œil :</strong>  
        </p>
        <p>
            Dressur a été conçu pour être bien plus qu\x27une simple application mobile. 
            C\x27est votre allié pour gérer votre visibilité en ligne, communiquer avec style, 
            et optimiser votre présence numérique.
        </p>
   </div>
    <div>
        <p>
            <strong>Besoin d\x27aide ?</strong>
        </p> 
        <p>
            Notre équipe de support est là pour vous. N\x27hésitez pas à nous contacter 
            à adresse e-mail du support : </strong> <a href=\"mailto:dressur.ds@gmail.com\" style=\"text-decoration: none;\">dressur.ds@gmail.com</a></span>
            en cas de questions, de préoccupations ou même
            de simples salutations. Nous sommes là pour vous aider à tirer le meilleur parti de Dressur.
        </p>  
        <p>
            Encore une fois, bienvenue à bord de Dressur ! Nous sommes impatients 
            de vous accompagner dans votre parcours numérique.
        </p>  
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/bienvenu_mail.html.twig";
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
        return array (  62 => 6,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/bienvenu_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/bienvenu_mail.html.twig");
    }
}
