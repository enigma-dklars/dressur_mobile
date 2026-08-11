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

/* crud_story/show.html.twig */
class __TwigTemplate_450489868b8fb380b45f24648dd555ad extends Template
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
        yield "Story #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 3), "html", null, true);
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
        <div class=\"col\">
            <h4>Story #";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 8), "html", null, true);
        yield "</h4>
        </div>
        <div class=\"col-auto\">
            <a href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 11)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-success me-2\">
                <i class=\"fas fa-pencil me-1\"></i> Modifier
            </a>
            <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"btn btn-sm btn-secondary\">
                <i class=\"fas fa-arrow-left me-1\"></i> Retour
            </a>
        </div>
    </div>

    <div class=\"row g-3\">

        ";
        // line 22
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "images", [], "any", false, false, false, 22)) > 0)) {
            // line 23
            yield "        <div class=\"col-12\">
            <div class=\"card radius-10\">
                <div class=\"card-header bg-transparent\">
                    <h6 class=\"mb-0\"><i class=\"fas fa-images me-1\"></i> Images (";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "images", [], "any", false, false, false, 26)), "html", null, true);
            yield ")</h6>
                </div>
                <div class=\"card-body\">
                    <div class=\"d-flex flex-wrap gap-3\">
                        ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "images", [], "any", false, false, false, 30));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 31
                yield "                        <div class=\"text-center flex-shrink-0\">
                            <div class=\"rounded shadow overflow-hidden\" style=\"width:120px; height:213px;\">
                                <img src=\"/story/";
                // line 33
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\"
                                    style=\"width:100%; height:100%; object-fit:cover; object-position:center; display:block;\">
                            </div>
                            <p class=\"text-muted small mt-1 text-truncate\" style=\"max-width:120px;\">";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "</p>
                        </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            yield "                    </div>
                </div>
            </div>
        </div>
        ";
        }
        // line 44
        yield "
        ";
        // line 45
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "videos", [], "any", false, false, false, 45)) > 0)) {
            // line 46
            yield "        <div class=\"col-12\">
            <div class=\"card radius-10\">
                <div class=\"card-header bg-transparent\">
                    <h6 class=\"mb-0\"><i class=\"fas fa-circle-play me-1\"></i> Vidéos (";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "videos", [], "any", false, false, false, 49)), "html", null, true);
            yield ")</h6>
                </div>
                <div class=\"card-body\">
                    <ul class=\"list-group list-group-flush\">
                        ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "videos", [], "any", false, false, false, 53));
            foreach ($context['_seq'] as $context["_key"] => $context["video"]) {
                // line 54
                yield "                        <li class=\"list-group-item\">
                            <a href=\"";
                // line 55
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["video"], "html", null, true);
                yield "\" target=\"_blank\" class=\"text-break\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["video"], "html", null, true);
                yield "</a>
                        </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['video'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            yield "                    </ul>
                </div>
            </div>
        </div>
        ";
        }
        // line 63
        yield "
        <div class=\"col-md-6\">
            <div class=\"card radius-10 h-100\">
                <div class=\"card-header bg-transparent\">
                    <h6 class=\"mb-0\"><i class=\"fas fa-circle-info me-1\"></i> Informations</h6>
                </div>
                <div class=\"card-body\">
                    <table class=\"table table-borderless mb-0\">
                        <tr>
                            <th class=\"text-muted\" style=\"width:140px\">Utilisateur</th>
                            <td>";
        // line 73
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 73), "pseudo", [], "any", false, false, false, 73) . " (#") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 73), "id", [], "any", false, false, false, 73)) . ")"), "html", null, true)) : ("<span class=\"text-muted\">—</span>"));
        yield "</td>
                        </tr>
                        <tr>
                            <th class=\"text-muted\">URL</th>
                            <td>
                                ";
        // line 78
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "url", [], "any", false, false, false, 78)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 79
            yield "                                    <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "url", [], "any", false, false, false, 79), "html", null, true);
            yield "\" target=\"_blank\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "url", [], "any", false, false, false, 79), "html", null, true);
            yield "</a>
                                ";
        } else {
            // line 81
            yield "                                    <span class=\"text-muted\">—</span>
                                ";
        }
        // line 83
        yield "                            </td>
                        </tr>
                        <tr>
                            <th class=\"text-muted\">Créé le</th>
                            <td>";
        // line 87
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "createdAt", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "createdAt", [], "any", false, false, false, 87), "d/m/Y à H:i:s"), "html", null, true)) : ("—"));
        yield "</td>
                        </tr>
                        <tr>
                            <th class=\"text-muted\">Modifié le</th>
                            <td>
                                ";
        // line 92
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "updatedAt", [], "any", false, false, false, 92)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 93
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "updatedAt", [], "any", false, false, false, 93), "d/m/Y à H:i:s"), "html", null, true);
            yield "
                                ";
        } else {
            // line 95
            yield "                                    <span class=\"text-muted\">Jamais modifié</span>
                                ";
        }
        // line 97
        yield "                            </td>
                        </tr>
                        <tr>
                            <th class=\"text-muted\">Expire le</th>
                            <td>
                                ";
        // line 102
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 102)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 103
            yield "                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 103) < $this->extensions['Twig\Extension\CoreExtension']->convertDate())) {
                // line 104
                yield "                                        <span class=\"badge bg-danger\">Expiré — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 104), "d/m/Y à H:i"), "html", null, true);
                yield "</span>
                                    ";
            } else {
                // line 106
                yield "                                        <span class=\"badge bg-warning text-dark\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 106), "d/m/Y à H:i"), "html", null, true);
                yield "</span>
                                    ";
            }
            // line 108
            yield "                                ";
        } else {
            // line 109
            yield "                                    <span class=\"text-muted\">Pas d\x27expiration</span>
                                ";
        }
        // line 111
        yield "                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class=\"col-md-6\">
            <div class=\"card radius-10 h-100\">
                <div class=\"card-header bg-transparent\">
                    <h6 class=\"mb-0\"><i class=\"fas fa-paragraph me-1\"></i> Description</h6>
                </div>
                <div class=\"card-body\">
                    ";
        // line 124
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "description", [], "any", false, false, false, 124)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 125
            yield "                        ";
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "description", [], "any", false, false, false, 125), "html", null, true));
            yield "
                    ";
        } else {
            // line 127
            yield "                        <span class=\"text-muted\">Aucune description</span>
                    ";
        }
        // line 129
        yield "                </div>
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
        return "crud_story/show.html.twig";
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
        return array (  304 => 129,  300 => 127,  294 => 125,  292 => 124,  277 => 111,  273 => 109,  270 => 108,  264 => 106,  258 => 104,  255 => 103,  253 => 102,  246 => 97,  242 => 95,  236 => 93,  234 => 92,  226 => 87,  220 => 83,  216 => 81,  208 => 79,  206 => 78,  198 => 73,  186 => 63,  179 => 58,  168 => 55,  165 => 54,  161 => 53,  154 => 49,  149 => 46,  147 => 45,  144 => 44,  137 => 39,  128 => 36,  120 => 33,  116 => 31,  112 => 30,  105 => 26,  100 => 23,  98 => 22,  87 => 14,  81 => 11,  75 => 8,  71 => 6,  64 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_story/show.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_story/show.html.twig");
    }
}
