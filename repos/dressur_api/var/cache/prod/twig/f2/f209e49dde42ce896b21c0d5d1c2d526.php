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

/* crud_story/new.html.twig */
class __TwigTemplate_fa37d338fec703bcf3566042565f5f08 extends Template
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
        yield "Nouvelle Story";
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
            <h4>Nouvelle Story</h4>
        </div>
        <div class=\"col-auto\">
            <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"btn btn-sm btn-secondary\">
                <i class=\"fas fa-arrow-left me-1\"></i> Retour
            </a>
        </div>
    </div>

    ";
        // line 17
        if ((array_key_exists("errors", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["errors"] ?? null)) > 0))) {
            // line 18
            yield "        <div class=\"alert alert-danger\">
            <ul class=\"mb-0\">
                ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["errors"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 21
                yield "                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            yield "            </ul>
        </div>
    ";
        }
        // line 26
        yield "
    <div class=\"card radius-10\">
        <div class=\"card-body\">
            <form id=\"storyForm\" method=\"post\" enctype=\"multipart/form-data\" action=\"";
        // line 29
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_new");
        yield "\">

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Images <small class=\"text-muted\">(plusieurs, max 3 Mo par image)</small></label>
                    <input type=\"file\" id=\"imageInput\" name=\"images[]\" class=\"form-control\" multiple accept=\"image/*\">
                    <div id=\"imageError\" class=\"mt-1\"></div>
                    <div id=\"imagePreview\" class=\"d-flex flex-column gap-2 mt-2\"></div>
                    <div class=\"form-text\">Formats acceptés : JPG, PNG, GIF, WebP...</div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Vidéos <small class=\"text-muted\">(URLs, une par ligne — YouTube, Google Drive, etc.)</small></label>
                    <textarea name=\"videos\" class=\"form-control\" rows=\"4\" placeholder=\"https://www.youtube.com/watch?v=...&#10;https://drive.google.com/...\"></textarea>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Utilisateur <small class=\"text-muted\">(optionnel)</small></label>
                    <select id=\"userSelect\" name=\"user_id\" class=\"form-select\" style=\"width:100%\">
                        <option value=\"\"></option>
                    </select>
                    <div class=\"form-text\">Recherchez par pseudo, nom, email ou téléphone (min. 2 caractères)</div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">URL <small class=\"text-muted\">(optionnel)</small></label>
                    <input type=\"url\" id=\"urlInput\" name=\"url\" class=\"form-control\" placeholder=\"https://...\">
                    <div id=\"urlError\" class=\"invalid-feedback\"></div>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Description</label>
                    <textarea name=\"description\" class=\"form-control\" rows=\"5\" placeholder=\"Texte descriptif de la story...\"></textarea>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label fw-bold\">Date d\x27expiration <small class=\"text-muted\">(optionnel)</small></label>
                    <input type=\"datetime-local\" id=\"expiredAtInput\" name=\"expired_at\" class=\"form-control\">
                    <div id=\"expiredAtError\" class=\"invalid-feedback\"></div>
                </div>

                <div class=\"text-end\">
                    <a href=\"";
        // line 70
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_story_index");
        yield "\" class=\"btn btn-secondary me-2\">Annuler</a>
                    <button type=\"submit\" id=\"submitBtn\" class=\"btn btn-primary\">
                        <i class=\"fas fa-check me-1\"></i> Créer
                    </button>
                </div>
            </form>
        </div>
    </div>
";
        yield from [];
    }

    // line 80
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 81
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
        // line 94
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
    const submitBtn    = document.getElementById(\x27submitBtn\x27);

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
            urlInput.classList.remove(\x27is-invalid\x27);
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

    imageInput.addEventListener(\x27change\x27, function () {
        validateImages(this.files);
    });

    urlInput.addEventListener(\x27input\x27, validateUrl);
    expiredInput.addEventListener(\x27change\x27, validateExpiredAt);

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
        return "crud_story/new.html.twig";
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
        return array (  196 => 94,  181 => 81,  174 => 80,  160 => 70,  116 => 29,  111 => 26,  106 => 23,  97 => 21,  93 => 20,  89 => 18,  87 => 17,  78 => 11,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_story/new.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_story/new.html.twig");
    }
}
