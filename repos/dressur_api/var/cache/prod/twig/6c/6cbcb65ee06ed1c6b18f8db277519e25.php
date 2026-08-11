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

/* crud_story/index.html.twig */
class __TwigTemplate_bdf368d334b5e88e688cf9550a49c65f extends Template
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
        yield "Stories";
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
        yield "    <div class=\"row g-2 mb-3\">
        <div class=\"col-8\">
            <span class=\"h4\">Stories Dressur</span>
        </div>
        <div class=\"col-4 text-end\">
            <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_delete_images_no_use");
        yield "\" class=\"btn btn-sm btn-danger me-2 js-confirm-orphan\">
                <i class=\"fas fa-trash me-1\"></i> Suppr. images orphelines
            </a>
            <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_new");
        yield "\" class=\"btn btn-sm btn-primary\">
                <i class=\"fas fa-plus me-1\"></i> Nouvelle Story
            </a>
        </div>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Images</th>
                    <th>Vidéos</th>
                    <th>User</th>
                    <th>URL</th>
                    <th>Description</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th>Expire le</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["stories"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
            // line 38
            yield "                <tr>
                    <td class=\"text-nowrap\">
                        <a href=\"";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 40)]), "html", null, true);
            yield "\" class=\"btn btn-xs btn-info me-1\"><i class=\"fas fa-eye\"></i></a>
                        <a href=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 41)]), "html", null, true);
            yield "\" class=\"btn btn-xs btn-success me-1\"><i class=\"fas fa-pencil\"></i></a>
                        <form method=\"post\" action=\"";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 42)]), "html", null, true);
            yield "\" style=\"display:inline\" onsubmit=\"return confirm(\x27Supprimer cette story ?\x27)\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 43))), "html", null, true);
            yield "\">
                            <button class=\"btn btn-xs btn-danger\"><i class=\"fas fa-trash\"></i></button>
                        </form>
                    </td>
                    <td>";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 47), "html", null, true);
            yield "</td>
                    <td class=\"text-center\">
                        ";
            // line 49
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 49)) > 0)) {
                // line 50
                yield "                            <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 50)), "html", null, true);
                yield "</span>
                        ";
            } else {
                // line 52
                yield "                            <span class=\"badge bg-secondary\">0</span>
                        ";
            }
            // line 54
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 56
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "videos", [], "any", false, false, false, 56)) > 0)) {
                // line 57
                yield "                            <span class=\"badge bg-info\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["story"], "videos", [], "any", false, false, false, 57)), "html", null, true);
                yield "</span>
                        ";
            } else {
                // line 59
                yield "                            <span class=\"badge bg-secondary\">0</span>
                        ";
            }
            // line 61
            yield "                    </td>
                    <td>";
            // line 62
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 62), "pseudo", [], "any", false, false, false, 62), "html", null, true)) : ("<span class=\"text-muted\">—</span>"));
            yield "</td>
                    <td>
                        ";
            // line 64
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "url", [], "any", false, false, false, 64)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 65
                yield "                            <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "url", [], "any", false, false, false, 65), "html", null, true);
                yield "\" target=\"_blank\" class=\"text-truncate d-inline-block\" style=\"max-width:120px\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "url", [], "any", false, false, false, 65), "html", null, true);
                yield "</a>
                        ";
            } else {
                // line 67
                yield "                            <span class=\"text-muted\">—</span>
                        ";
            }
            // line 69
            yield "                    </td>
                    <td class=\"text-truncate\" style=\"max-width:160px\">";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "description", [], "any", false, false, false, 70), "html", null, true);
            yield "</td>
                    <td class=\"text-nowrap\">";
            // line 71
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "createdAt", [], "any", false, false, false, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "createdAt", [], "any", false, false, false, 71), "d/m/Y H:i"), "html", null, true)) : (""));
            yield "</td>
                    <td class=\"text-nowrap\">
                        ";
            // line 73
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "updatedAt", [], "any", false, false, false, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 74
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "updatedAt", [], "any", false, false, false, 74), "d/m/Y H:i"), "html", null, true);
                yield "
                        ";
            } else {
                // line 76
                yield "                            <span class=\"text-muted\">—</span>
                        ";
            }
            // line 78
            yield "                    </td>
                    <td class=\"text-nowrap\">
                        ";
            // line 80
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "expiredAt", [], "any", false, false, false, 80)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 81
                yield "                            ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["story"], "expiredAt", [], "any", false, false, false, 81) < $this->extensions['Twig\Extension\CoreExtension']->convertDate())) {
                    // line 82
                    yield "                                <span class=\"badge bg-danger\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "expiredAt", [], "any", false, false, false, 82), "d/m/Y"), "html", null, true);
                    yield "</span>
                            ";
                } else {
                    // line 84
                    yield "                                <span class=\"badge bg-warning text-dark\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "expiredAt", [], "any", false, false, false, 84), "d/m/Y"), "html", null, true);
                    yield "</span>
                            ";
                }
                // line 86
                yield "                        ";
            } else {
                // line 87
                yield "                            <span class=\"text-muted\">—</span>
                        ";
            }
            // line 89
            yield "                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 91
        if (!$context['_iterated']) {
            // line 92
            yield "                <tr>
                    <td colspan=\"10\" class=\"text-center text-muted\">Aucune story trouvée</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['story'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        yield "            </tbody>
        </table>
    </div>
";
        yield from [];
    }

    // line 101
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 102
        yield "<script>
document.querySelectorAll(\x27.js-confirm-orphan\x27).forEach(function (btn) {
    btn.addEventListener(\x27click\x27, function (e) {
        e.preventDefault();
        var href = this.href;
        Swal.fire({
            title: \x27Supprimer les images orphelines ?\x27,
            text: \x27Toutes les images non liées à une story seront définitivement supprimées.\x27,
            icon: \x27warning\x27,
            showCancelButton: true,
            confirmButtonColor: \x27#d33\x27,
            cancelButtonColor: \x27#6c757d\x27,
            confirmButtonText: \x27Oui, supprimer\x27,
            cancelButtonText: \x27Annuler\x27
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = href;
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
        return "crud_story/index.html.twig";
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
        return array (  277 => 102,  270 => 101,  262 => 96,  253 => 92,  251 => 91,  245 => 89,  241 => 87,  238 => 86,  232 => 84,  226 => 82,  223 => 81,  221 => 80,  217 => 78,  213 => 76,  207 => 74,  205 => 73,  200 => 71,  196 => 70,  193 => 69,  189 => 67,  181 => 65,  179 => 64,  174 => 62,  171 => 61,  167 => 59,  161 => 57,  159 => 56,  155 => 54,  151 => 52,  145 => 50,  143 => 49,  138 => 47,  131 => 43,  127 => 42,  123 => 41,  119 => 40,  115 => 38,  110 => 37,  84 => 14,  78 => 11,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_story/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_story/index.html.twig");
    }
}
