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

/* crud_story/edit.html.twig */
class __TwigTemplate_1d2380b5cd02f20688a68f9920b96752 extends Template
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
        yield "Modifier Story #";
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
            <h4>Modifier Story #";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 8), "html", null, true);
        yield "</h4>
        </div>
        <div class=\"col-auto\">
            <a href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 11)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-info me-2\">
                <i class=\"fas fa-eye me-1\"></i> Voir
            </a>
            <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"btn btn-sm btn-secondary\">
                <i class=\"fas fa-arrow-left me-1\"></i> Retour
            </a>
        </div>
    </div>

    ";
        // line 20
        if ((array_key_exists("errors", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["errors"] ?? null)) > 0))) {
            // line 21
            yield "        <div class=\"alert alert-danger\">
            <ul class=\"mb-0\">
                ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 24
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            yield "            </ul>
        </div>
    ";
        }
        // line 29
        yield "
    <div class=\"card radius-10\">
        <div class=\"card-body\">
            <form id=\"storyForm\" method=\"post\" enctype=\"multipart/form-data\" action=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "id", [], "any", false, false, false, 32)]), "html", null, true);
        yield "\">

                ";
        // line 34
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "images", [], "any", false, false, false, 34)) > 0)) {
            // line 35
            yield "                <div class=\"mb-4\">
                    <label class=\"form-label fw-bold\"><i class=\"fas fa-images me-1\"></i> Images existantes</label>
                    <div class=\"d-flex flex-wrap gap-3\">
                        ";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "images", [], "any", false, false, false, 38));
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
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 39
                yield "                        <div class=\"text-center flex-shrink-0\" id=\"existing-img-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 39), "html", null, true);
                yield "\">
                            <div class=\"rounded shadow overflow-hidden existing-thumb\" style=\"width:120px; height:213px;\">
                                <img src=\"/story/";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\"
                                    style=\"width:100%; height:100%; object-fit:cover; object-position:center; display:block;\">
                            </div>
                            <div class=\"form-check justify-content-center d-flex mt-2\">
                                <input class=\"form-check-input me-2 delete-checkbox\" type=\"checkbox\" name=\"delete_images[]\" value=\"";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["image"], "html", null, true);
                yield "\" id=\"del_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 45), "html", null, true);
                yield "\">
                                <label class=\"form-check-label text-danger small\" for=\"del_";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 46), "html", null, true);
                yield "\">Supprimer</label>
                            </div>
                        </div>
                        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            yield "                    </div>
                </div>
                ";
        }
        // line 53
        yield "
                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Ajouter des images <small class=\"text-muted\">(max 3 Mo par image)</small></label>
                    <input type=\"file\" id=\"imageInput\" name=\"images[]\" class=\"form-control\" multiple accept=\"image/*\">
                    <div id=\"imageError\" class=\"mt-1\"></div>
                    <div id=\"imagePreview\" class=\"d-flex flex-column gap-2 mt-2\"></div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Vidéos <small class=\"text-muted\">(URLs, une par ligne)</small></label>
                    <textarea name=\"videos\" class=\"form-control\" rows=\"4\" placeholder=\"https://www.youtube.com/watch?v=...\">";
        // line 63
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "videos", [], "any", false, false, false, 63), "
"), "html", null, true);
        yield "</textarea>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Utilisateur <small class=\"text-muted\">(optionnel)</small></label>
                    <select id=\"userSelect\" name=\"user_id\" class=\"form-select\" style=\"width:100%\">
                        ";
        // line 69
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 70
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 70), "id", [], "any", false, false, false, 70), "html", null, true);
            yield "\" selected>
                                ";
            // line 71
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 71), "pseudo", [], "any", false, false, false, 71), "html", null, true);
            yield " — ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 71), "nom", [], "any", false, false, false, 71), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "user", [], "any", false, false, false, 71), "mail", [], "any", false, false, false, 71), "html", null, true);
            yield ")
                            </option>
                        ";
        } else {
            // line 74
            yield "                            <option value=\"\"></option>
                        ";
        }
        // line 76
        yield "                    </select>
                    <div class=\"form-text\">Recherchez par pseudo, nom, email ou téléphone (min. 2 caractères)</div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">URL <small class=\"text-muted\">(optionnel)</small></label>
                    <input type=\"url\" id=\"urlInput\" name=\"url\" class=\"form-control\" value=\"";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "url", [], "any", false, false, false, 82), "html", null, true);
        yield "\" placeholder=\"https://...\">
                    <div id=\"urlError\" class=\"invalid-feedback\"></div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Description</label>
                    <textarea name=\"description\" class=\"form-control\" rows=\"5\">";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "description", [], "any", false, false, false, 88), "html", null, true);
        yield "</textarea>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Date d\x27expiration <small class=\"text-muted\">(optionnel — laisser vide pour supprimer)</small></label>
                    <input type=\"datetime-local\" id=\"expiredAtInput\" name=\"expired_at\" class=\"form-control\"
                        value=\"";
        // line 94
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 94)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "expiredAt", [], "any", false, false, false, 94), "Y-m-d\\TH:i"), "html", null, true)) : (""));
        yield "\">
                    <div id=\"expiredAtError\" class=\"invalid-feedback\"></div>
                </div>

                <div class=\"row g-2 mb-3 text-muted small\">
                    <div class=\"col-auto\">
                        <i class=\"fas fa-calendar-plus me-1\"></i> Créé le : <strong>";
        // line 100
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "createdAt", [], "any", false, false, false, 100)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "createdAt", [], "any", false, false, false, 100), "d/m/Y H:i:s"), "html", null, true)) : ("—"));
        yield "</strong>
                    </div>
                    ";
        // line 102
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "updatedAt", [], "any", false, false, false, 102)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 103
            yield "                    <div class=\"col-auto\">
                        <i class=\"fas fa-calendar-check me-1\"></i> Dernière modification : <strong>";
            // line 104
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["story"] ?? null), "updatedAt", [], "any", false, false, false, 104), "d/m/Y H:i:s"), "html", null, true);
            yield "</strong>
                    </div>
                    ";
        }
        // line 107
        yield "                </div>

                <div class=\"text-end\">
                    <a href=\"";
        // line 110
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"btn btn-secondary me-2\">Annuler</a>
                    <button type=\"submit\" id=\"submitBtn\" class=\"btn btn-success\">
                        <i class=\"fas fa-check me-1\"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
";
        yield from [];
    }

    // line 120
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 121
        yield "<script>
\$(document).ready(function () {
    \$(\x27#userSelect\x27).select2({
        theme: \x27bootstrap4\x27,
        placeholder: \x27Rechercher un utilisateur...\x27,
        allowClear: true,
        minimumInputLength: 2,
        language: {
            inputTooShort: function () { return \x27Saisissez au moins 2 caractères\x27; },
            searching:     function () { return \x27Recherche en cours...\x27; },
            noResults:     function () { return \x27Aucun utilisateur trouvé\x27; },
        },
        ajax: {
            url: \x27";
        // line 134
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_user_search");
        yield "\x27,
            dataType: \x27json\x27,
            delay: 250,
            data: function (params) { return { q: params.term }; },
            processResults: function (data) { return { results: data.results }; },
            cache: true,
        },
    });
});

(function () {
    const MAX_SIZE = 3 * 1024 * 1024;
    const imageInput   = document.getElementById(\x27imageInput\x27);
    const imageError   = document.getElementById(\x27imageError\x27);
    const imagePreview = document.getElementById(\x27imagePreview\x27);
    const urlInput     = document.getElementById(\x27urlInput\x27);
    const urlError     = document.getElementById(\x27urlError\x27);
    const expiredInput = document.getElementById(\x27expiredAtInput\x27);
    const expiredError = document.getElementById(\x27expiredAtError\x27);
    const form         = document.getElementById(\x27storyForm\x27);

    function formatSize(bytes) {
        return (bytes / (1024 * 1024)).toFixed(2) + \x27 Mo\x27;
    }

    function validateImages(files) {
        imageError.innerHTML = \x27\x27;
        imagePreview.innerHTML = \x27\x27;
        let hasError = false;

        Array.from(files).forEach(function (file) {
            const row = document.createElement(\x27div\x27);
            row.className = \x27d-flex align-items-center gap-3 border rounded p-2\x27;

            if (file.size > MAX_SIZE) {
                hasError = true;
                row.classList.add(\x27border-danger\x27, \x27bg-danger-subtle\x27);
                row.innerHTML =
                    \x27<div class=\"flex-shrink-0 d-flex align-items-center justify-content-center rounded bg-danger-subtle\" style=\"width:80px;height:80px;\">\x27 +
                    \x27<i class=\"fas fa-exclamation-triangle text-danger fs-2\"></i></div>\x27 +
                    \x27<div class=\"flex-grow-1 overflow-hidden\">\x27 +
                    \x27<p class=\"mb-0 fw-semibold text-truncate\">\x27 + file.name + \x27</p>\x27 +
                    \x27<p class=\"mb-0 text-danger small\">\x27 + formatSize(file.size) + \x27 — dépasse la limite de 3 Mo</p>\x27 +
                    \x27</div>\x27;
                const msg = document.createElement(\x27div\x27);
                msg.className = \x27alert alert-danger py-1 px-2 mb-1 small\x27;
                msg.textContent = \x27\"\x27 + file.name + \x27\" dépasse 3 Mo (\x27 + formatSize(file.size) + \x27).\x27;
                imageError.appendChild(msg);
            } else {
                row.classList.add(\x27border-success-subtle\x27);
                const reader = new FileReader();
                reader.onload = function (e) {
                    row.innerHTML =
                        \x27<div class=\"rounded overflow-hidden flex-shrink-0 shadow-sm\" style=\"width:60px;height:107px;\">\x27 +
                        \x27<img src=\"\x27 + e.target.result + \x27\" style=\"width:100%;height:100%;object-fit:cover;object-position:center;display:block;\" alt=\"\"></div>\x27 +
                        \x27<div class=\"flex-grow-1 overflow-hidden\">\x27 +
                        \x27<p class=\"mb-0 fw-semibold text-truncate\">\x27 + file.name + \x27</p>\x27 +
                        \x27<p class=\"mb-0 text-muted small\">\x27 + formatSize(file.size) + \x27</p>\x27 +
                        \x27</div>\x27 +
                        \x27<span class=\"badge bg-success flex-shrink-0\">\x27 + formatSize(file.size) + \x27</span>\x27;
                };
                reader.readAsDataURL(file);
            }

            imagePreview.appendChild(row);
        });

        return !hasError;
    }

    function validateUrl() {
        const val = urlInput.value.trim();
        if (val === \x27\x27) {
            urlInput.classList.remove(\x27is-invalid\x27, \x27is-valid\x27);
            urlError.textContent = \x27\x27;
            return true;
        }
        try {
            new URL(val);
            urlInput.classList.remove(\x27is-invalid\x27);
            urlInput.classList.add(\x27is-valid\x27);
            urlError.textContent = \x27\x27;
            return true;
        } catch (_) {
            urlInput.classList.add(\x27is-invalid\x27);
            urlInput.classList.remove(\x27is-valid\x27);
            urlError.textContent = \x27URL invalide. Ex : https://example.com\x27;
            return false;
        }
    }

    function validateExpiredAt() {
        const val = expiredInput.value;
        if (!val) {
            expiredInput.classList.remove(\x27is-invalid\x27, \x27is-valid\x27);
            expiredError.textContent = \x27\x27;
            return true;
        }
        const chosen = new Date(val);
        const now    = new Date();
        if (chosen <= now) {
            expiredInput.classList.add(\x27is-invalid\x27);
            expiredInput.classList.remove(\x27is-valid\x27);
            expiredError.textContent = \x27La date d\\\x27expiration doit être dans le futur.\x27;
            return false;
        }
        expiredInput.classList.remove(\x27is-invalid\x27);
        expiredInput.classList.add(\x27is-valid\x27);
        expiredError.textContent = \x27\x27;
        return true;
    }

    /* Visual feedback on existing image delete checkboxes */
    document.querySelectorAll(\x27.delete-checkbox\x27).forEach(function (cb) {
        cb.addEventListener(\x27change\x27, function () {
            const container = this.closest(\x27[id^=\"existing-img-\"]\x27);
            if (!container) return;
            const thumb = container.querySelector(\x27.existing-thumb\x27);
            if (this.checked) {
                thumb.style.opacity      = \x270.25\x27;
                thumb.style.filter       = \x27grayscale(100%)\x27;
                thumb.style.outline      = \x273px solid #dc3545\x27;
                thumb.style.borderRadius = \x276px\x27;
            } else {
                thumb.style.opacity      = \x271\x27;
                thumb.style.filter       = \x27none\x27;
                thumb.style.outline      = \x27none\x27;
            }
        });
    });

    imageInput.addEventListener(\x27change\x27, function () {
        validateImages(this.files);
    });

    urlInput.addEventListener(\x27input\x27, validateUrl);
    expiredInput.addEventListener(\x27change\x27, validateExpiredAt);

    /* Trigger URL validation on load if value already present */
    if (urlInput.value.trim() !== \x27\x27) validateUrl();

    form.addEventListener(\x27submit\x27, function (e) {
        if (imageInput.files.length > 0) validateImages(imageInput.files);
        const urlOk = validateUrl();
        const expOk = validateExpiredAt();
        if (!urlOk || !expOk) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: \x27smooth\x27 });
        }
    });
})();
</script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_story/edit.html.twig";
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
        return array (  334 => 134,  319 => 121,  312 => 120,  298 => 110,  293 => 107,  287 => 104,  284 => 103,  282 => 102,  277 => 100,  268 => 94,  259 => 88,  250 => 82,  242 => 76,  238 => 74,  228 => 71,  223 => 70,  221 => 69,  211 => 63,  199 => 53,  194 => 50,  176 => 46,  170 => 45,  161 => 41,  155 => 39,  138 => 38,  133 => 35,  131 => 34,  126 => 32,  121 => 29,  116 => 26,  107 => 24,  103 => 23,  99 => 21,  97 => 20,  88 => 14,  82 => 11,  76 => 8,  72 => 6,  65 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_story/edit.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_story/edit.html.twig");
    }
}
