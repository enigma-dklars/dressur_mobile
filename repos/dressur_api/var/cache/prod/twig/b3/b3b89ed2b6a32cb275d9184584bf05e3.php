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

/* tuto/index.html.twig */
class __TwigTemplate_cfa83b5479ac845e1021da1f714eccbd extends Template
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
        return "baseAdmin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("baseAdmin.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Tuto index";
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
        yield "    <div class=\"row g-2\">
        <div class=\"col-8\">
            <span class=\"h4 me-3\">Tuto index</span>
        </div>
        <div class=\"col-4 text-end fs-5 d-flex gap-2 justify-content-end align-items-center\">
            <a class=\"btn btn-sm btn-primary h4 js-confirm-orphan\" href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tuto_new");
        yield "\">Nouveau Tuto</a>
        </div>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Url</th>
                    <th>Activated</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                    <th>Id</th>
                </tr>
            </thead>

            <tbody>
                ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["tutos"] ?? null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["tuto"]) {
            // line 32
            yield "                <tr>
                    <td>
                        ";
            // line 34
            yield Twig\Extension\CoreExtension::include($this->env, $context, "tuto/_delete_form.html.twig");
            yield "
                    </td>

                    <td>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "titre", [], "any", false, false, false, 37), "html", null, true);
            yield "</td>

                    <td class=\"text-center\">
                        ";
            // line 40
            if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "description", [], "any", false, false, false, 40))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 41
                yield "                            <button
                                class=\"btn btn-sm btn-outline-primary\"
                                data-bs-toggle=\"modal\"
                                data-bs-target=\"#descriptionModal";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "id", [], "any", false, false, false, 44), "html", null, true);
                yield "\"
                                title=\"Afficher la description\">
                                Afficher <i class=\"fas fa-eye\"></i>
                            </button>
                        ";
            } else {
                // line 49
                yield "                            <button
                                class=\"btn btn-sm btn-outline-secondary\"
                                disabled
                                title=\"Aucune description\">
                                Afficher <i class=\"fas fa-eye-slash\"></i>
                            </button>
                        ";
            }
            // line 56
            yield "                    </td>

                    ";
            // line 59
            yield "                    <td class=\"text-center\">
                        <button
                                class=\"btn btn-sm btn-outline-warning copy-url\"
                                data-url=\"";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "url", [], "any", false, false, false, 62), "html", null, true);
            yield "\"
                                title=\"Copier l\x27URL\">
                            Copier <i class=\"fas fa-copy\"></i>
                        </button>
                    </td>

                    <td class=\"text-center\">
                        ";
            // line 69
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "activated", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            // line 71
            yield "
                    </td>

                    <td>";
            // line 74
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "createdAt", [], "any", false, false, false, 74)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "createdAt", [], "any", false, false, false, 74), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 75
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "updatedAt", [], "any", false, false, false, 75)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "updatedAt", [], "any", false, false, false, 75), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "id", [], "any", false, false, false, 76), "html", null, true);
            yield "</td>
                </tr>

                ";
            // line 80
            yield "                <div class=\"modal fade\"
                    id=\"descriptionModal";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "id", [], "any", false, false, false, 81), "html", null, true);
            yield "\"
                    tabindex=\"-1\"
                    aria-hidden=\"true\">

                    <div class=\"modal-dialog modal-dialog-centered modal-lg\">
                        <div class=\"modal-content\">

                            <div class=\"modal-header\">
                                <h5 class=\"modal-title\">
                                    ";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "titre", [], "any", false, false, false, 90), "html", null, true);
            yield "
                                </h5>

                                <button
                                        type=\"button\"
                                        class=\"btn-close\"
                                        data-bs-dismiss=\"modal\">
                                </button>
                            </div>

                            <div class=\"modal-body\">
                                ";
            // line 101
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tuto"], "description", [], "any", false, false, false, 101), "html", null, true));
            yield "
                            </div>

                            <div class=\"modal-footer\">
                                <button
                                        class=\"btn btn-secondary\"
                                        data-bs-dismiss=\"modal\">
                                    Fermer
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 117
        if (!$context['_iterated']) {
            // line 118
            yield "                <tr>
                    <td colspan=\"8\">no records found</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tuto'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 122
        yield "            </tbody>
        </table>
    </div>
";
        yield from [];
    }

    // line 127
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 128
        yield "    ";
        yield from $this->yieldParentBlock("script", $context, $blocks);
        yield "

    <script>
        document.addEventListener(\x27DOMContentLoaded\x27, () => {

            document.querySelectorAll(\x27.copy-url\x27).forEach(button => {

                button.addEventListener(\x27click\x27, async function () {

                    const url = this.dataset.url;

                    try {
                        await navigator.clipboard.writeText(url);

                        const icon = this.querySelector(\x27i\x27);

                        icon.classList.remove(\x27fa-copy\x27);
                        icon.classList.add(\x27fa-check\x27);

                        setTimeout(() => {
                            icon.classList.remove(\x27fa-check\x27);
                            icon.classList.add(\x27fa-copy\x27);
                        }, 1500);

                    } catch (e) {
                        alert(\"Impossible de copier l\x27URL.\");
                    }

                });

            });

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
        return "tuto/index.html.twig";
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
        return array (  283 => 128,  276 => 127,  268 => 122,  259 => 118,  257 => 117,  228 => 101,  214 => 90,  202 => 81,  199 => 80,  193 => 76,  189 => 75,  185 => 74,  180 => 71,  178 => 69,  168 => 62,  163 => 59,  159 => 56,  150 => 49,  142 => 44,  137 => 41,  135 => 40,  129 => 37,  123 => 34,  119 => 32,  101 => 31,  78 => 11,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "tuto/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/tuto/index.html.twig");
    }
}
