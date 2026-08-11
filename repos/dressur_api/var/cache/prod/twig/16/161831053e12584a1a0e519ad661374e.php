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

/* private/index.html.twig */
class __TwigTemplate_0281d920131185255ea6b926de2cb5a2 extends Template
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
        yield "DASHBOARD";
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
        yield "
";
        // line 7
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(($context["stories"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 8
            yield "<div class=\"mb-3\">
    ";
            // line 10
            yield "    <div style=\"position:relative;\">
        ";
            // line 12
            yield "        <button id=\"storyScrollLeft\" onclick=\"scrollStrip(-1)\" style=\"display:none;position:absolute;left:-4px;top:50%;transform:translateY(-50%);z-index:10;background:rgba(13,110,253,0.85);border:none;color:#fff;border-radius:50%;width:30px;height:30px;cursor:pointer;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.3);\">&#8249;</button>
        ";
            // line 14
            yield "        <button id=\"storyScrollRight\" onclick=\"scrollStrip(1)\" style=\"position:absolute;right:-4px;top:50%;transform:translateY(-50%);z-index:10;background:rgba(13,110,253,0.85);border:none;color:#fff;border-radius:50%;width:30px;height:30px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.3);\">&#8250;</button>
        ";
            // line 16
            yield "        <div id=\"storyFadeRight\" style=\"pointer-events:none;position:absolute;right:0;top:0;bottom:8px;width:40px;background:linear-gradient(to right,transparent,rgba(0,0,0,0.35));z-index:5;border-radius:0 12px 12px 0;\"></div>
        ";
            // line 18
            yield "        <div id=\"storyFadeLeft\" style=\"pointer-events:none;position:absolute;left:0;top:0;bottom:8px;width:40px;background:linear-gradient(to left,transparent,rgba(0,0,0,0.35));z-index:5;border-radius:12px 0 0 12px;display:none;\"></div>

    <div class=\"story-strip pb-1\" id=\"storyStrip\" style=\"display:flex;flex-wrap:nowrap;overflow-x:scroll;overflow-y:hidden;gap:8px;-webkit-overflow-scrolling:touch;scrollbar-width:none;-ms-overflow-style:none;\">
        ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stories"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
                // line 22
                yield "        ";
                $context["hasMedia"] = ((!Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 22))) || (!Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "videos", [], "any", false, false, false, 22))));
                // line 23
                yield "        ";
                if ((($tmp = ($context["hasMedia"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 24
                    yield "        <div class=\"story-card flex-shrink-0\" onclick=\"openStory(";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 24), "html", null, true);
                    yield ")\"
             style=\"cursor:pointer;width:105px;height:175px;border-radius:12px;overflow:hidden;position:relative;border:2px solid #0d6efd;background:#111;\">
            ";
                    // line 26
                    if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 26))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 27
                        yield "                <img src=\"/story/";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 27)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[0] ?? null) : null), "html", null, true);
                        yield "\" alt=\"story\"
                     style=\"width:100%;height:100%;object-fit:cover;display:block;\">
            ";
                    } else {
                        // line 30
                        yield "                <div style=\"width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1a1a2e;\">
                    <i class=\"fas fa-play text-primary fs-2\"></i>
                </div>
            ";
                    }
                    // line 34
                    yield "            <div style=\"position:absolute;inset:0;background:linear-gradient(to bottom,transparent 50%,rgba(0,0,0,0.75) 100%);\"></div>
            <div style=\"position:absolute;bottom:8px;left:0;right:0;text-align:center;color:#fff;font-size:11px;font-weight:600;padding:0 4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;\">
                ";
                    // line 36
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 36), "pseudo", [], "any", false, false, false, 36), 0, 12), "html", null, true)) : ("Story"));
                    yield "
            </div>
        </div>
        ";
                }
                // line 40
                yield "        ";
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
            unset($context['_seq'], $context['_key'], $context['story'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            yield "    </div>
    </div>";
            // line 43
            yield "</div>
<script>
(function() {
    const strip = document.getElementById(\x27storyStrip\x27);
    const btnLeft = document.getElementById(\x27storyScrollLeft\x27);
    const btnRight = document.getElementById(\x27storyScrollRight\x27);
    const fadeLeft = document.getElementById(\x27storyFadeLeft\x27);
    const fadeRight = document.getElementById(\x27storyFadeRight\x27);

    function updateIndicators() {
        const atStart = strip.scrollLeft <= 4;
        const atEnd = strip.scrollLeft + strip.clientWidth >= strip.scrollWidth - 4;

        btnLeft.style.display = atStart ? \x27none\x27 : \x27flex\x27;
        fadeLeft.style.display = atStart ? \x27none\x27 : \x27block\x27;
        btnRight.style.display = atEnd ? \x27none\x27 : \x27flex\x27;
        fadeRight.style.display = atEnd ? \x27none\x27 : \x27block\x27;
    }

    strip.addEventListener(\x27scroll\x27, updateIndicators, { passive: true });
    window.addEventListener(\x27resize\x27, updateIndicators);
    updateIndicators();
})();

function scrollStrip(dir) {
    const strip = document.getElementById(\x27storyStrip\x27);
    strip.scrollBy({ left: dir * 230, behavior: \x27smooth\x27 });
}
</script>

";
            // line 74
            yield "<script>
const storiesData = [
    ";
            // line 76
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stories"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["story"]) {
                // line 77
                yield "    ";
                $context["hasMedia"] = ((!Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 77))) || (!Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "videos", [], "any", false, false, false, 77))));
                // line 78
                yield "    ";
                if ((($tmp = ($context["hasMedia"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 79
                    yield "    {
        id: ";
                    // line 80
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "id", [], "any", false, false, false, 80), "html", null, true);
                    yield ",
        user: \"";
                    // line 81
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["story"], "user", [], "any", false, false, false, 81), "pseudo", [], "any", false, false, false, 81), "js"), "html", null, true)) : ("Story"));
                    yield "\",
        description: \"";
                    // line 82
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "description", [], "any", false, false, false, 82)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "description", [], "any", false, false, false, 82), "js"), "html", null, true)) : (""));
                    yield "\",
        url: \"";
                    // line 83
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["story"], "url", [], "any", false, false, false, 83)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "url", [], "any", false, false, false, 83), "js"), "html", null, true)) : (""));
                    yield "\",
        images: [";
                    // line 84
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "images", [], "any", false, false, false, 84));
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
                    foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
                        yield "\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["img"], "js"), "html", null, true);
                        yield "\"";
                        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                            yield ",";
                        }
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
                    unset($context['_seq'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    yield "],
        videos: [";
                    // line 85
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["story"], "videos", [], "any", false, false, false, 85));
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
                    foreach ($context['_seq'] as $context["_key"] => $context["vid"]) {
                        yield "\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["vid"], "js"), "html", null, true);
                        yield "\"";
                        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 85)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                            yield ",";
                        }
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
                    unset($context['_seq'], $context['_key'], $context['vid'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    yield "]
    }";
                    // line 86
                    if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 86)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield ",";
                    }
                    // line 87
                    yield "    ";
                }
                // line 88
                yield "    ";
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
            unset($context['_seq'], $context['_key'], $context['story'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            yield "].filter(s => s.images.length > 0 || s.videos.length > 0);
</script>

";
            // line 93
            yield "<div id=\"storyModal\" style=\"display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.95);flex-direction:column;align-items:center;justify-content:center;\">
    ";
            // line 95
            yield "    <div id=\"storyProgressBar\" style=\"position:absolute;top:0;left:0;right:0;display:flex;gap:3px;padding:8px 10px;\">
    </div>

    ";
            // line 99
            yield "    <div style=\"position:absolute;top:28px;left:0;right:0;display:flex;align-items:center;justify-content:space-between;padding:0 12px;\">
        <span id=\"storyUserName\" style=\"color:#fff;font-weight:600;font-size:14px;\"></span>
        <button onclick=\"closeStory()\" style=\"background:none;border:none;color:#fff;font-size:22px;cursor:pointer;line-height:1;\">&times;</button>
    </div>

    ";
            // line 105
            yield "    <div id=\"storyContent\" style=\"width:100%;max-width:420px;max-height:80vh;display:flex;align-items:center;justify-content:center;position:relative;\">
    </div>

    ";
            // line 109
            yield "    <div id=\"storyDescBox\" style=\"display:none;position:absolute;bottom:0;left:0;right:0;padding:10px 14px 20px;background:linear-gradient(to bottom,transparent,rgba(0,0,0,0.82));pointer-events:auto;\">
        ";
            // line 111
            yield "        <a id=\"storyLinkBtn\" href=\"#\" target=\"_blank\" rel=\"noopener noreferrer\"
           onclick=\"event.stopPropagation()\"
           style=\"display:none;margin-bottom:10px;width:100%;text-align:center;padding:8px 16px;background:#25a244;border:none;border-radius:24px;color:#fff;font-size:13px;font-weight:600;text-decoration:none;letter-spacing:0.3px;\">
            🔗 Voir le lien
        </a>
        <p id=\"storyDescText\" style=\"margin:0 0 4px;color:#fff;font-size:13px;line-height:1.5;word-break:break-word;\"></p>
        <button id=\"storyVoirPlus\" onclick=\"expandStoryDesc()\" style=\"display:none;background:none;border:none;color:#90caf9;font-size:12px;padding:2px 0 0;cursor:pointer;font-weight:600;\">Lire la suite</button>
    </div>

    ";
            // line 121
            yield "    <button onclick=\"prevStoryItem()\" style=\"position:absolute;left:8px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:#fff;border-radius:50%;width:36px;height:36px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;\">&#8249;</button>
    <button onclick=\"nextStoryItem()\" style=\"position:absolute;right:8px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.15);border:none;color:#fff;border-radius:50%;width:36px;height:36px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;\">&#8250;</button>
</div>

<script>
let currentStoryIndex = 0;
let currentMediaIndex = 0;
let storyTimer = null;
const STORY_DURATION = 60000;

function getStoryMedia(story) {
    const media = [];
    story.images.forEach(img => media.push({ type: \x27image\x27, src: \x27/story/\x27 + img }));
    story.videos.forEach(url => media.push({ type: \x27video\x27, src: url }));
    return media;
}

function openStory(index) {
    currentStoryIndex = index;
    currentMediaIndex = 0;
    document.getElementById(\x27storyModal\x27).style.display = \x27flex\x27;
    document.body.style.overflow = \x27hidden\x27;
    renderStory();
}

function closeStory() {
    clearTimeout(storyTimer);
    document.getElementById(\x27storyModal\x27).style.display = \x27none\x27;
    document.body.style.overflow = \x27\x27;
    document.getElementById(\x27storyContent\x27).innerHTML = \x27\x27;
}

function renderStory() {
    clearTimeout(storyTimer);
    const story = storiesData[currentStoryIndex];
    const media = getStoryMedia(story);

    // Nom
    document.getElementById(\x27storyUserName\x27).textContent = story.user;

    // Bouton lien
    const linkBtn = document.getElementById(\x27storyLinkBtn\x27);
    if (story.url && story.url.trim() !== \x27\x27) {
        linkBtn.href = story.url;
        linkBtn.style.display = \x27block\x27;
    } else {
        linkBtn.style.display = \x27none\x27;
        linkBtn.href = \x27#\x27;
    }

    // Description style WhatsApp
    const descBox = document.getElementById(\x27storyDescBox\x27);
    const descText = document.getElementById(\x27storyDescText\x27);
    const voirPlus = document.getElementById(\x27storyVoirPlus\x27);
    const hasDesc = story.description && story.description.trim() !== \x27\x27;
    const hasUrl  = story.url && story.url.trim() !== \x27\x27;
    if (hasDesc) {
        const full = story.description.trim();
        descText.dataset.full = full;
        // Afficher avec clamp 2 lignes
        descText.innerHTML = linkify(full);
        descText.style.cssText = \x27margin:0 0 0;color:#fff;font-size:13px;line-height:1.5;word-break:break-word;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;\x27;
        voirPlus.style.display = \x27none\x27;
        // Détecter si le texte dépasse 2 lignes après rendu
        requestAnimationFrame(() => {
            if (descText.scrollHeight > descText.clientHeight + 2) {
                voirPlus.style.display = \x27block\x27;
                descText.style.marginBottom = \x272px\x27;
            }
        });
    } else {
        descText.innerHTML = \x27\x27;
        descText.style.cssText = \x27\x27;
        voirPlus.style.display = \x27none\x27;
    }
    // Afficher le bloc si url OU description présente
    descBox.style.display = (hasDesc || hasUrl) ? \x27block\x27 : \x27none\x27;

    // Barre de progression
    const bar = document.getElementById(\x27storyProgressBar\x27);
    bar.innerHTML = \x27\x27;
    media.forEach((_, i) => {
        const seg = document.createElement(\x27div\x27);
        seg.style.cssText = \x27flex:1;height:3px;border-radius:2px;background:rgba(255,255,255,0.3);overflow:hidden;\x27;
        const fill = document.createElement(\x27div\x27);
        fill.style.cssText = \x27height:100%;background:#fff;width:\x27 + (i < currentMediaIndex ? \x27100\x27 : i === currentMediaIndex ? \x270\x27 : \x270\x27) + \x27%;transition:width linear;\x27;
        seg.appendChild(fill);
        bar.appendChild(seg);
    });

    // Media
    const content = document.getElementById(\x27storyContent\x27);
    content.innerHTML = \x27\x27;
    const item = media[currentMediaIndex];

    if (item.type === \x27image\x27) {
        const img = document.createElement(\x27img\x27);
        img.src = item.src;
        img.style.cssText = \x27max-width:100%;max-height:80vh;object-fit:contain;border-radius:6px;\x27;
        content.appendChild(img);
    } else {
        const vid = document.createElement(\x27video\x27);
        vid.src = item.src;
        vid.controls = true;
        vid.autoplay = true;
        vid.style.cssText = \x27max-width:100%;max-height:80vh;border-radius:6px;\x27;
        content.appendChild(vid);
    }

    // Animer la barre du segment actif
    setTimeout(() => {
        const fills = bar.querySelectorAll(\x27div > div\x27);
        if (fills[currentMediaIndex]) {
            fills[currentMediaIndex].style.transition = \x27width \x27 + (STORY_DURATION / 1000) + \x27s linear\x27;
            fills[currentMediaIndex].style.width = \x27100%\x27;
        }
    }, 30);

    storyTimer = setTimeout(() => nextStoryItem(), STORY_DURATION);
}

function nextStoryItem() {
    const story = storiesData[currentStoryIndex];
    const media = getStoryMedia(story);
    if (currentMediaIndex < media.length - 1) {
        currentMediaIndex++;
        renderStory();
    } else if (currentStoryIndex < storiesData.length - 1) {
        currentStoryIndex++;
        currentMediaIndex = 0;
        renderStory();
    } else {
        closeStory();
    }
}

function prevStoryItem() {
    if (currentMediaIndex > 0) {
        currentMediaIndex--;
        renderStory();
    } else if (currentStoryIndex > 0) {
        currentStoryIndex--;
        currentMediaIndex = 0;
        renderStory();
    }
}

document.addEventListener(\x27keydown\x27, e => {
    if (document.getElementById(\x27storyModal\x27).style.display !== \x27none\x27) {
        if (e.key === \x27ArrowRight\x27) nextStoryItem();
        if (e.key === \x27ArrowLeft\x27) prevStoryItem();
        if (e.key === \x27Escape\x27) closeStory();
    }
});

// Swipe tactile gauche/droite sur le viewer
(function() {
    let touchStartX = 0;
    let touchStartY = 0;
    const modal = document.getElementById(\x27storyModal\x27);

    modal.addEventListener(\x27touchstart\x27, e => {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
    }, { passive: true });

    modal.addEventListener(\x27touchend\x27, e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        const dy = e.changedTouches[0].clientY - touchStartY;
        // Ignorer si le mouvement est surtout vertical (scroll texte)
        if (Math.abs(dx) < 40 || Math.abs(dy) > Math.abs(dx)) return;
        if (dx < 0) nextStoryItem();
        else prevStoryItem();
    }, { passive: true });
})();

function linkify(text) {
    const escaped = text.replace(/&/g,\x27&amp;\x27).replace(/</g,\x27&lt;\x27).replace(/>/g,\x27&gt;\x27);
    return escaped.replace(
        /(https?:\\/\\/[^\\s<>\"\x27]+)/gi,
        \x27<a href=\"\$1\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color:#90caf9;text-decoration:underline;\" onclick=\"event.stopPropagation()\">\$1</a>\x27
    );
}

function expandStoryDesc() {
    // Pause le défilement automatique tant que le texte est ouvert
    clearTimeout(storyTimer);
    storyTimer = null;
    // Figer la barre de progression sur sa position actuelle
    const bar = document.getElementById(\x27storyProgressBar\x27);
    if (bar) {
        const fills = bar.querySelectorAll(\x27div > div\x27);
        fills.forEach(f => {
            const current = getComputedStyle(f).width;
            f.style.transition = \x27none\x27;
            f.style.width = current;
        });
    }

    const descText = document.getElementById(\x27storyDescText\x27);
    const voirPlus = document.getElementById(\x27storyVoirPlus\x27);
    const full = descText.dataset.full || \x27\x27;
    descText.innerHTML = linkify(full);
    // Retirer le clamp — texte complet visible, scrollable si très long
    descText.style.cssText = \x27margin:0 0 4px;color:#fff;font-size:13px;line-height:1.5;word-break:break-word;max-height:55vh;overflow-y:auto;display:block;\x27;
    voirPlus.style.display = \x27none\x27;
}
</script>
";
        }
        // line 330
        yield "
    <div class=\"row g-3 mb-3\">
        
        ";
        // line 333
        if ((((((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 333) <= 0) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "boostEnCours", [], "any", false, false, false, 333) == false)) || (CoreExtension::getAttribute($this->env, $this->source,         // line 334
($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 334) == false)) || (Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source,         // line 335
($context["user"] ?? null), "nom", [], "any", false, false, false, 335), [" " => ""]) == "")) || (null === CoreExtension::getAttribute($this->env, $this->source,         // line 336
($context["user"] ?? null), "nom", [], "any", false, false, false, 336)))) {
            // line 337
            yield "
        ";
        }
        // line 339
        yield "
        ";
        // line 340
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 340) == false)) {
            // line 341
            yield "            <div class=\"col-12\">
                <div class=\"card radius-10 mb-0\" style=\"border:2px solid #198754;\">
                    <div class=\"card-body\">

                        <div class=\"d-flex align-items-center gap-3 mb-3\">
                            <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-success flex-shrink-0\" style=\"width:46px;height:46px;\">
                                <i class=\"fab fa-whatsapp text-white fs-4\"></i>
                            </span>
                            <p class=\"mb-0 fw-semibold text-success fs-6\">Confirmation du numéro WhatsApp</p>
                        </div>

                        <p class=\"text-muted small mb-2\">Pour confirmer votre numéro, suivez ces étapes&nbsp;:</p>

                        <ol class=\"small text-muted mb-3 ps-3\" style=\"line-height:1.9;\">
                            <li>Ouvrez <strong>WhatsApp</strong> depuis le numéro utilisé pour votre inscription.</li>
                            <li>Envoyez-nous <strong>exactement</strong> ce message, sans faute ni modification&nbsp;:
                                <div class=\"mt-2 mb-1 px-3 py-2 rounded text-center fw-bold text-success\" style=\"background:rgba(25,135,84,.1);font-size:1.05rem;font-family:monospace;letter-spacing:.5px;\">
                                    WhatsApp Confirmation
                                </div>
                            </li>
                            <li>Votre numéro sera confirmé dès que possible.</li>
                        </ol>

                        <a href=\"https://wa.me/22964044294?text=WhatsApp%20Confirmation\" target=\"_blank\" class=\"btn btn-success w-100\">
                            <i class=\"fab fa-whatsapp me-2\"></i> Envoyer la demande sur WhatsApp
                        </a>

                    </div>
                </div>
            </div>
        ";
        }
        // line 372
        yield "
        ";
        // line 373
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mailIsVerified", [], "any", false, false, false, 373) == false)) {
            // line 374
            yield "            <div class=\"col-12\">
                <a href=\"/confirmer-votre-mail\" style=\"text-decoration:none;\">
                    <div class=\"card radius-10 mb-0 h-100 border-primary\" style=\"border:2px solid;\">
                        <div class=\"card-body d-flex align-items-center gap-3\">
                            <span class=\"d-inline-flex align-items-center justify-content-center rounded-circle bg-primary flex-shrink-0\" style=\"width:46px;height:46px;\">
                                <i class=\"fas fa-envelope-open-text text-white fs-5\"></i>
                            </span>
                            <div class=\"flex-grow-1 min-w-0\">
                                <p class=\"mb-0 fw-semibold text-primary\">Confirmer votre adresse mail</p>
                                <p class=\"mb-0 text-muted small text-truncate\">";
            // line 383
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "mail", [], "any", false, false, false, 383), "html", null, true);
            yield "</p>
                            </div>
                            <i class=\"fas fa-chevron-right text-primary flex-shrink-0\"></i>
                        </div>
                    </div>
                </a>
            </div>
        ";
        }
        // line 391
        yield "
        ";
        // line 392
        if (((Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 392), [" " => ""]) == "") || (null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nom", [], "any", false, false, false, 392)))) {
            // line 393
            yield "            <div class=\"col-12\">
                <a href=\"/editprofil\" class=\"dropdown-item\">
                    <div class=\"card radius-10 mb-0 h-100\">
                        <div class=\"card-body\">
                            <div class=\"d-flex align-items-center\">
                                <div class=\"setting-icon\"></div>
                                <div class=\"setting-text ms-3 fs-6\"><span>Compléter votre Profil</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        ";
        }
        // line 406
        yield "
        ";
        // line 407
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "addPageActu", [], "any", false, false, false, 407) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 407) <= 100)) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "boostEnCours", [], "any", false, false, false, 407) == false))) {
            // line 408
            yield "            <div class=\"col-12\">
                <a href=\"/newboostcontact\" style=\"text-decoration:none;\" class=\"text-white\">
                    <div class=\"card radius-10 mb-0 h-100 bg-danger\">
                        <div class=\"card-body\">
                            <i class=\"fas fa-user fs-6\"></i>
                            <span class=\"ms-1 fs-6\">Faire un Boost Contact pour avoir plus de contact</span>
                        </div>
                    </div>
                </a>
            </div>
        ";
        }
        // line 419
        yield "
        ";
        // line 420
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "addPageActu", [], "any", false, false, false, 420) && (CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 420) > 0))) {
            // line 421
            yield "            <div class=\"col-md-12\">
                <div class=\"card radius-10 mb-0 h-100\">
                    <div class=\"card-body\">
                        <p class=\"mb-2 text-primary fw-normal fs-4\">
                            <i class=\"fas fa-users-rectangle me-1\"></i> Contacts Disponibles
                        </p>
                        <p class=\"mb-2 fs-6 mb-1\">
                            ";
            // line 428
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 428), "html", null, true);
            yield " contact(s) disponible(s) selon vos préférences pays.
                        </p>
                        <p class=\"px-3 py-2 mb-2 small bg-warning rounded text-dark\">
                            <i class=\"fas fa-info-circle me-1\"></i>
                            Cliquez sur le bouton ci-dessous pour récupérer vos contacts. Vous serez ensuite redirigé vers votre liste de contacts, depuis laquelle vous pourrez les exporter au format <strong>VCF</strong> ou <strong>CSV</strong> et suivre le <strong>guide d\x27import</strong> pour les enregistrer dans votre téléphone.
                        </p>
                        <div class=\"mt-2 mb-1\">
                            ";
            // line 435
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "telIsVerified", [], "any", false, false, false, 435) == true)) {
                // line 436
                yield "                                <button class=\"btn btn-md btn-info me-2 mb-2 mb-md-0\" url=\"/api/addTousUserContact/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "uid", [], "any", false, false, false, 436), "html", null, true);
                yield "/fr\" id=\"ajouter_tous_les_contacts\" data-boost-en-cours=\"";
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "boostEnCours", [], "any", false, false, false, 436)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("1") : ("0"));
                yield "\">
                                    Ajouter Tous les ";
                // line 437
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 437), "html", null, true);
                yield " Contact(s)
                                </button>
                            ";
            } else {
                // line 440
                yield "                                <button class=\"btn btn-md btn-info me-2 mb-2 mb-md-0\" data-bs-toggle=\"modal\" data-bs-target=\"#doit_confirmer_le_numéro_whatsapp\">
                                    Ajouter Tous les ";
                // line 441
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "nombreContactDispo", [], "any", false, false, false, 441), "html", null, true);
                yield " Contact(s)
                                </button>
                            ";
            }
            // line 444
            yield "                        </div>
                    </div>
                </div>
            </div>
        ";
        }
        // line 449
        yield "    </div>

    <div class=\"modal fade\" id=\"doit_faire_boost_contact\" tabindex=\"-1\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-centered\">
            <div class=\"modal-content\">
                <div class=\"modal-body p-0\">
                    <div class=\"card radius-10 mb-0 h-100\">
                        <div class=\"card-body\">
                            <p class=\"mb-0 text-secondary\"><i class=\"fas fa-rocket me-1\"></i> Boost Contact requis</p>
                            <p class=\"mt-1 mb-2\">
                                Vous n\x27avez pas de Boost Contact en cours. Veuillez faire un Boost Contact pour avoir l\x27autorisation d\x27ajouter les contacts disponibles.
                            </p>
                            <a href=\"/newboostcontact\" class=\"btn btn-primary btn-sm\">
                                <i class=\"fas fa-rocket me-1\"></i> Faire un Boost Contact
                            </a>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class=\"modal fade\" id=\"doit_confirmer_le_numéro_whatsapp\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-scrollable\">
            <div class=\"modal-content\">
                <div class=\"modal-body p-0\">
                    <div class=\"card radius-10 mb-0 h-100\">
                        <div class=\"card-body\">
                            <p class=\"mb-0 text-secondary\"><i class=\"fab fa-whatsapp me-1\"></i> Configuration et Confirmation du Compte</p>
                            <p class=\"mt-1 mb-2\">
                                Vous n’avez pas encore terminé la configuration et la confirmation de votre compte. 
                                Veuillez fermer cette fenêtre, lire attentivement les instructions affichées sur la page actuelle afin de savoir quoi faire pour finaliser la configuration et la confirmation de votre compte. 
                                Une fois cette étape terminée, vous pourrez revenir et utiliser cette fonctionnalité sans problème.
                            </p>
                        </div>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                </div>
            </div>
        </div>
    </div>


    <div class=\"mb-3\">
        ";
        // line 498
        yield ($context["actu"] ?? null);
        yield "
        <div class=\"text-end mt-2\">
            <a href=\"/actu\" class=\"btn btn-sm btn-outline-primary rounded-pill px-3\">
                <i class=\"fas fa-newspaper me-1\"></i>Voir plus
            </a>
        </div>
    </div>

";
        // line 506
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "admin", [], "any", false, false, false, 506)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 507
            yield "    <div class=\"modal fade\" id=\"warningModal\" tabindex=\"-1\"
     aria-labelledby=\"warningModalLabel\"
     aria-hidden=\"true\"
     data-bs-backdrop=\"static\"
     data-bs-keyboard=\"false\">

  <div class=\"modal-dialog modal-dialog-centered\">
    <div class=\"modal-content border-danger\">
      <div class=\"modal-header bg-danger text-white\">
        <h5 class=\"modal-title text-center w-100\" id=\"warningModalLabel\">
          ⚠️ Avertissement important
        </h5>
      </div>

      <div class=\"modal-body\">
        <p>
          Dressur ne peut garantir la fiabilité ou la moralité des utilisateurs de la plateforme.<br><br>
          Il est fortement conseillé de ne jamais envoyer d’argent pour un service sans être certain
          de pouvoir entrer en possession de ce pour quoi vous payez.<br><br>
          <strong>
            Dressur ne saurait être tenu responsable en cas d’arnaque ou de perte financière
            causée par un autre utilisateur.
          </strong>
        </p>
      </div>

      <div class=\"modal-footer\">
        <button type=\"button\"
                id=\"closeWarningBtn\"
                class=\"btn btn-sm btn-danger\"
                data-bs-dismiss=\"modal\"
                disabled>
          Fermer (5)
        </button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener(\"DOMContentLoaded\", function () {
    const modalEl = document.getElementById(\x27warningModal\x27);
    const closeBtn = document.getElementById(\x27closeWarningBtn\x27);

    // Ouvre le modal automatiquement
    const warningModal = new bootstrap.Modal(modalEl);
    warningModal.show();

    let countdown = 5;
    closeBtn.textContent = `Fermer (\${countdown}s)`;

    const timer = setInterval(() => {
        countdown--;
        if (countdown > 0) {
            closeBtn.textContent = `Fermer (\${countdown}s)`;
        } else {
            clearInterval(timer);
            closeBtn.textContent = \"Fermer\";
            closeBtn.disabled = false;
        }
    }, 1000);
});
</script>
";
        }
        // line 570
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/index.html.twig";
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
        return array (  891 => 570,  826 => 507,  824 => 506,  813 => 498,  762 => 449,  755 => 444,  749 => 441,  746 => 440,  740 => 437,  733 => 436,  731 => 435,  721 => 428,  712 => 421,  710 => 420,  707 => 419,  694 => 408,  692 => 407,  689 => 406,  674 => 393,  672 => 392,  669 => 391,  658 => 383,  647 => 374,  645 => 373,  642 => 372,  609 => 341,  607 => 340,  604 => 339,  600 => 337,  598 => 336,  597 => 335,  596 => 334,  595 => 333,  590 => 330,  379 => 121,  368 => 111,  365 => 109,  360 => 105,  353 => 99,  348 => 95,  345 => 93,  340 => 89,  326 => 88,  323 => 87,  319 => 86,  282 => 85,  245 => 84,  241 => 83,  237 => 82,  233 => 81,  229 => 80,  226 => 79,  223 => 78,  220 => 77,  203 => 76,  199 => 74,  167 => 43,  164 => 41,  150 => 40,  143 => 36,  139 => 34,  133 => 30,  126 => 27,  124 => 26,  118 => 24,  115 => 23,  112 => 22,  95 => 21,  90 => 18,  87 => 16,  84 => 14,  81 => 12,  78 => 10,  75 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/index.html.twig");
    }
}
