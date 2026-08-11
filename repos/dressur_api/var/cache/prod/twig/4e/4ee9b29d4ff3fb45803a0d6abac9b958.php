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

/* sitemap.xml.twig */
class __TwigTemplate_8912a1226c38e8696eaceda8c73ea373 extends Template
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
        yield "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">

    <url><loc>https://dressur.site/</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>https://dressur.site/actualite</loc><changefreq>daily</changefreq><priority>0.9</priority></url>
    <url><loc>https://dressur.site/services</loc><changefreq>monthly</changefreq><priority>0.9</priority></url>
    <url><loc>https://dressur.site/tarifs</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>https://dressur.site/boost-contact</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>https://dressur.site/promotion-affaire</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>https://dressur.site/promotion-reseaux-sociaux</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>

    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formules_reseau_parents"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            yield "    <url>
        <loc>https://dressur.site/promotion-reseaux-sociaux/";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "token", [], "any", false, false, false, 14), "html", null, true);
            yield "</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        yield "
    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formules_reseau_services"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 21
            yield "    <url>
        <loc>https://dressur.site/promotion-reseaux-sociaux/service/";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "token", [], "any", false, false, false, 22), "html", null, true);
            yield "</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        yield "
    <url><loc>https://dressur.site/dressur-bot</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>https://dressur.site/contacts</loc><changefreq>yearly</changefreq><priority>0.5</priority></url>
    <url><loc>https://dressur.site/conditions-utilisation</loc><changefreq>yearly</changefreq><priority>0.3</priority></url>
    <url><loc>https://dressur.site/politique-confidentialite</loc><changefreq>yearly</changefreq><priority>0.3</priority></url>

    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["promos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["promo"]) {
            // line 34
            yield "    <url>
        <loc>https://dressur.site/actualite/";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "token", [], "any", false, false, false, 35), "html", null, true);
            yield "</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promo'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        yield "
</urlset>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "sitemap.xml.twig";
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
        return array (  120 => 40,  109 => 35,  106 => 34,  102 => 33,  94 => 27,  83 => 22,  80 => 21,  76 => 20,  73 => 19,  62 => 14,  59 => 13,  55 => 12,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "sitemap.xml.twig", "/home/runner/workspace/repos/dressur_api/templates/sitemap.xml.twig");
    }
}
