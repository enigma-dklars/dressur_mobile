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

/* private/preferencePays.html.twig */
class __TwigTemplate_e0b737fd9baeb6e64c5b48b9819098a5 extends Template
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
            'script' => [$this, 'block_script'],
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
        yield "Préférence Pays";
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
    NB: Sélectionnez parmi les pays disponibles. Ces pays sélectionnés seront ceux à partir desquels vous recevrez des propositions de contacts et d\x27actualités, ainsi que vers lesquels seront orientées vos promotions commerciales et vos boosts contacts.
</div>

<div class=\"card mt-3\">
    <div class=\"card-body\">
        <p class=\"h4 text-center\">Choix des Pays</p>
        <p class=\"text-center mb-3\">Cliquez sur un pays pour selectionner ou déselectionner.</p>
        <div class=\"row g-2\">

            <div class=\"col-12\">
                <div class=\"input-group\">
                    <input type=\"search\" class=\"form-control\" id=\"searchPays\" placeholder=\"Exp : +229 ou Bénin\">
                    <button class=\"btn btn-primary savedPaysCgoisie\" id=\"savedPaysCgoisie\">Enregistrer les Modifications</button>
                </div>
            </div>
            <div class=\"col-12\">
                <label class=\"me-2\">
                    <div class=\"form-check-danger form-check form-switch fs-6\">
                        <input class=\"form-check-input\" type=\"radio\" name=\"filter\" value=\"all\" checked>
                        <label class=\"form-check-label\">Tous</label>
                    </div>
                </label>
                <label class=\"me-2\">
                    <div class=\"form-check-danger form-check form-switch fs-6\">
                        <input class=\"form-check-input\" type=\"radio\" name=\"filter\" value=\"chosen\">
                        <label class=\"form-check-label\">Pays choisis</label>
                    </div>
                </label>
                <label class=\"me-2\">
                    <div class=\"form-check-danger form-check form-switch fs-6\">
                        <input class=\"form-check-input\" type=\"radio\" name=\"filter\" value=\"not-chosen\">
                        <label class=\"form-check-label\">Pays non choisis</label>
                    </div>
                </label>
            </div>
            ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["countryCodes"] ?? null));
        foreach ($context['_seq'] as $context["indicatif"] => $context["nomDuPays"]) {
            // line 43
            yield "                <div class=\"col-md-3 country-container\">
                    <btn type=\"button\" class=\"btn ";
            // line 44
            if (CoreExtension::inFilter($context["indicatif"], ($context["paysChoisieJson"] ?? null))) {
                yield "btn-success";
            } else {
                yield "btn-light";
            }
            yield " w-100 text-start un-pays\" indicatif=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["indicatif"], "html", null, true);
            yield "\">
                        <p class=\"m-0 indicatif\">+";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["indicatif"], "html", null, true);
            yield "</p>
                        <p class=\"m-0 small nomDuPays\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["nomDuPays"], "html", null, true);
            yield "</p>
                    </btn>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['indicatif'], $context['nomDuPays'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        yield "            <div class=\"col-12\">
                <button class=\"btn btn-primary savedPaysCgoisie\" id=\"savedPaysCgoisie\">Enregistrer les Modifications</button>
            </div>
        </div>
    </div>
</div>

";
        yield from [];
    }

    // line 59
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 60
        yield "<script>
\$(document).ready(function(){
    function filterCountries() {
        var searchTerm = \$(\x27#searchPays\x27).val().toLowerCase();
        var filter = \$(\x27input[name=\"filter\"]:checked\x27).val();

        \$(\x27.country-container\x27).each(function() {
            var indicatif = \$(this).find(\x27.indicatif\x27).text().toLowerCase();
            var nomDuPays = \$(this).find(\x27.nomDuPays\x27).text().toLowerCase();
            var isChosen = \$(this).find(\x27.btn\x27).hasClass(\x27btn-success\x27);

            var matchesSearch = indicatif.includes(searchTerm) || nomDuPays.includes(searchTerm);
            var matchesFilter = 
                (filter === \x27all\x27) || 
                (filter === \x27chosen\x27 && isChosen) || 
                (filter === \x27not-chosen\x27 && !isChosen);

            if (matchesSearch && matchesFilter) {
                \$(this).show();
            } else {
                \$(this).hide();
            }
        });
    }

    \$(\x27#searchPays\x27).on(\x27input\x27, filterCountries);
    \$(\x27input[name=\"filter\"]\x27).on(\x27change\x27, filterCountries);
});
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/preferencePays.html.twig";
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
        return array (  159 => 60,  152 => 59,  140 => 50,  130 => 46,  126 => 45,  116 => 44,  113 => 43,  109 => 42,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/preferencePays.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/preferencePays.html.twig");
    }
}
