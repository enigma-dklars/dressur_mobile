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

/* private/newpromoreseau.html.twig */
class __TwigTemplate_45605e2a09d79cfacaba7e59d2376b2a extends Template
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
        yield "Nouvelle Promo. Réseau";
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
        yield "<div class=\"bg-danger text-white p-3 rounded\">
    <strong>Informations :</strong>
    <br>
    - Vos préférences sur Dressur ne s’appliquent pas aux promotions sur les réseaux sociaux.
    <br>
    - Les comptes qui interagiront avec votre promotion seront sélectionnés directement par le réseau social, sans que Dressur puisse intervenir.
    <br>
    - Ce service peut vous aider à obtenir des votes sur les réseaux sociaux, notamment pour les systèmes de vote basés sur les likes, les commentaires, les partages, etc.
    <br>
    - Ce service vous permet d’attirer davantage l’attention sur vos réseaux sociaux, car aujourd’hui l’être humain accorde plus facilement sa confiance aux comptes ayant un grand nombre d’abonnés, de likes et d’interactions.
    <br>
    - Lisez correctement la description du service réseau auquel vous voulez souscrire.
</div>

<div class=\"card mt-3\">
    <div class=\"card-body\">
        <h4 class=\"text-center pb-3\">Nouvelle Promotion Réseau Sociaux</h4>
        
        <div class=\"row g-3\">

            <div class=\"col-12\">
                <div class=\"mt-0\" id=\"msgError\" style=\"display: none;\"></div>
            </div>
            <div class=\"col-md-6\">
                <div class=\"mb-3\">
                    <label for=\"socialNetwork\">Réseau Social</label>
                    <select id=\"socialNetwork\" class=\"form-select getInfo\">
                        <option value=\"\" selected disabled>Choissez un réseau</option>
                        ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listSocialNetworks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["network"]) {
            // line 35
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "id", [], "any", false, false, false, 35), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "titre", [], "any", false, false, false, 35), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['network'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        yield "                    </select>
                </div>
                ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listSocialNetworks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["network"]) {
            // line 40
            yield "                    <div class=\"lesFormulesFils\" id=\"fils-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "id", [], "any", false, false, false, 40), "html", null, true);
            yield "\" network-id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "id", [], "any", false, false, false, 40), "html", null, true);
            yield "\" hidden>
                        <label for=\"\">Services de ";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "titre", [], "any", false, false, false, 41), "html", null, true);
            yield "</label>
                        <select id=\"select-fils-";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "id", [], "any", false, false, false, 42), "html", null, true);
            yield "\" class=\"form-select getInfo select-service-network\">
                            <option value=\"\" selected disabled>Choissez un service de ";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "titre", [], "any", false, false, false, 43), "html", null, true);
            yield "</option>
                            ";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "lesFormulesFils", [], "any", false, false, false, 44));
            foreach ($context['_seq'] as $context["_key"] => $context["unfils"]) {
                // line 45
                yield "                                <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "id", [], "any", false, false, false, 45), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "label", [], "any", false, false, false, 45), "html", null, true);
                yield "</option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['unfils'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "                        </select>
                        ";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["network"], "lesFormulesFils", [], "any", false, false, false, 48));
            foreach ($context['_seq'] as $context["_key"] => $context["unfils"]) {
                // line 49
                yield "                            <div class=\"unfils\" id=\"unfils-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "id", [], "any", false, false, false, 49), "html", null, true);
                yield "\" unfils-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "id", [], "any", false, false, false, 49), "html", null, true);
                yield "\" unfils-prix=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "prix", [], "any", false, false, false, 49), "html", null, true);
                yield "\" unfils-qte=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "qte", [], "any", false, false, false, 49), "html", null, true);
                yield "\" unfils-qteMin=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "qteMin", [], "any", false, false, false, 49), "html", null, true);
                yield "\" unfils-qteMax=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "qteMax", [], "any", false, false, false, 49), "html", null, true);
                yield "\" hidden>
                                <p class=\"mt-3\">
                                    ";
                // line 51
                yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["unfils"], "description", [], "any", false, false, false, 51), "html", null, true));
                yield "
                                </p>
                            </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['unfils'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            yield "                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['network'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        yield "            </div>
            <div class=\"col-md-6\">
                <div class=\"mb-3\">
                    <label for=\"quantity\">Quantité</label>
                    <input type=\"number\" class=\"form-control getInfo\" id=\"quantity\" value=\"0\">
                    <div id=\"message\" class=\"alert alert-danger py-2 px-3 mt-3 small d-none\"></div>
                </div>
        
                <div class=\"mb-3\">
                    <label for=\"price\" class=\"\">Prix (FCFA)</label>
                    <input type=\"text\" class=\"form-control getInfo\" id=\"price\" disabled>
                </div>
        
                <div class=\"mb-3\">
                    <label for=\"link\" class=\"\">Lien</label>
                    <input type=\"url\" class=\"form-control getInfo\" id=\"link\">
                </div>
        
                <div class=\"mb-3\">
                    <label for=\"paymentMethod\" class=\"\">Moyen de paiement mobile ou par carte</label>
                    <select id=\"paymentMethod\" class=\"form-select getInfo\">
                        <option value=\"\" disabled selected>Choisisez le Moyen de paiement mobile ou par carte</option>
                        ";
        // line 79
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["uneMethodePaiement"]) {
            // line 80
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "value", [], "any", false, false, false, 80), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "titre", [], "any", false, false, false, 80), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['uneMethodePaiement'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        yield "                    </select>
                </div>
        
                <div class=\"mb-3\">
                    <label for=\"tel\" class=\"\">Indicatif + Numéro de paiement</label>
                    <input type=\"tel\" class=\"form-control getInfo\" id=\"tel\">
                </div>
            </div>
        </div>

        <button class=\"btn btn-primary\" id=\"newPromoReseau\">Payer et Démarrer</button>    
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
        return "private/newpromoreseau.html.twig";
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
        return array (  236 => 82,  225 => 80,  221 => 79,  197 => 57,  190 => 55,  180 => 51,  164 => 49,  160 => 48,  157 => 47,  146 => 45,  142 => 44,  138 => 43,  134 => 42,  130 => 41,  123 => 40,  119 => 39,  115 => 37,  104 => 35,  100 => 34,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/newpromoreseau.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/newpromoreseau.html.twig");
    }
}
