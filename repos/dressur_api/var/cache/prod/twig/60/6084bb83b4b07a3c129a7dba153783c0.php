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

/* private/assistant.html.twig */
class __TwigTemplate_b11a0c4419567c1c60fc4a577bf390c6 extends Template
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

    // line 2
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Assistant IA";
        yield from [];
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 5
        yield "<style>
.ds-chat-wrap{max-width:720px;margin:0 auto;display:flex;flex-direction:column;height:calc(100vh - 200px);min-height:420px}

.ds-chat-header{display:flex;align-items:center;gap:12px;margin-bottom:12px}
.ds-chat-header-icon{width:44px;height:44px;border-radius:12px;background:rgba(13,110,253,.10);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ds-chat-header-icon i{font-size:20px;color:var(--bs-primary,#0d6efd)}
.ds-chat-header-title{font-weight:700;font-size:15px;margin:0}
.ds-chat-header-sub{font-size:12px;color:var(--bs-secondary-color,#6c757d);margin:0}

.ds-chat-scroll{flex:1;overflow-y:auto;padding:6px 4px 12px;display:flex;flex-direction:column;gap:10px}

.ds-chat-msg{max-width:80%;padding:10px 14px;border-radius:16px;font-size:14px;line-height:1.5;white-space:pre-wrap;word-break:break-word}
.ds-chat-msg.ds-user{align-self:flex-end;background:var(--bs-primary,#0d6efd);color:#fff;border-bottom-right-radius:4px}
.ds-chat-msg.ds-assistant{align-self:flex-start;background:var(--bs-tertiary-bg,#f0f2f5);color:var(--bs-body-color,#212529);border-bottom-left-radius:4px}

.ds-chat-typing{align-self:flex-start;display:flex;gap:4px;padding:12px 16px;background:var(--bs-tertiary-bg,#f0f2f5);border-radius:16px;border-bottom-left-radius:4px}
.ds-chat-typing span{width:6px;height:6px;border-radius:50%;background:#adb5bd;display:inline-block;animation:dsTypingBlink 1.2s infinite ease-in-out}
.ds-chat-typing span:nth-child(2){animation-delay:.2s}
.ds-chat-typing span:nth-child(3){animation-delay:.4s}
@keyframes dsTypingBlink{0%,80%,100%{opacity:.3}40%{opacity:1}}

.ds-chat-empty{text-align:center;color:#8a8f98;font-size:13px;padding:30px 20px}
.ds-chat-empty i{font-size:32px;color:#ced4da;display:block;margin-bottom:10px}

.ds-chat-inputbar{display:flex;gap:10px;align-items:flex-end;padding-top:10px;border-top:1px solid var(--bs-border-color,rgba(0,0,0,.08))}
.ds-chat-input{flex:1;border-radius:20px;border:1px solid var(--bs-border-color,rgba(0,0,0,.15));padding:10px 16px;font-size:14px;resize:none;max-height:120px;background:var(--bs-body-bg,#fff);color:var(--bs-body-color,#212529)}
.ds-chat-input:focus{outline:none;border-color:var(--bs-primary,#0d6efd)}
.ds-chat-send{width:42px;height:42px;border-radius:50%;background:var(--bs-primary,#0d6efd);color:#fff;border:none;display:flex;align-items:center;justify-content:center;flex-shrink:0;cursor:pointer}
.ds-chat-send:disabled{opacity:.5;cursor:default}

html.dark-theme .ds-chat-msg.ds-assistant,html.semi-dark .ds-chat-msg.ds-assistant{background:#202a40;color:#fcfcfc}
html.dark-theme .ds-chat-typing,html.semi-dark .ds-chat-typing{background:#202a40}
html.dark-theme .ds-chat-input,html.semi-dark .ds-chat-input{background:#202a40;color:#fcfcfc;border-color:rgba(255,255,255,.12)}
html.dark-theme .ds-chat-inputbar,html.semi-dark .ds-chat-inputbar{border-color:rgba(255,255,255,.08)}
</style>

<div class=\"ds-chat-wrap\">

    <div class=\"ds-chat-header\">
        <div class=\"ds-chat-header-icon\"><i class=\"fas fa-comments\"></i></div>
        <div>
            <p class=\"ds-chat-header-title\">Assistant IA Dressur</p>
            <p class=\"ds-chat-header-sub\">Pose ta question sur l\x27application</p>
        </div>
    </div>

    <div class=\"ds-chat-scroll\" id=\"dsChatScroll\">
        <div class=\"ds-chat-empty\" id=\"dsChatEmpty\">
            <i class=\"fas fa-robot\"></i>
            Pose ta première question, je suis là pour t\x27aider !
        </div>
    </div>

    <div class=\"ds-chat-inputbar\">
        <textarea id=\"dsChatInput\" class=\"ds-chat-input\" rows=\"1\" placeholder=\"Écris ton message...\"></textarea>
        <button type=\"button\" id=\"dsChatSendBtn\" class=\"ds-chat-send\" title=\"Envoyer\">
            <i class=\"fas fa-paper-plane\"></i>
        </button>
    </div>

</div>
";
        yield from [];
    }

    // line 68
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 69
        yield "<script>
(function(){
    const scrollEl = document.getElementById(\x27dsChatScroll\x27);
    const emptyEl  = document.getElementById(\x27dsChatEmpty\x27);
    const inputEl  = document.getElementById(\x27dsChatInput\x27);
    const sendBtn  = document.getElementById(\x27dsChatSendBtn\x27);

    let isSending = false;

    function escapeHtml(str){
        const div = document.createElement(\x27div\x27);
        div.textContent = str || \x27\x27;
        return div.innerHTML;
    }

    function scrollToBottom(){
        scrollEl.scrollTop = scrollEl.scrollHeight;
    }

    function appendMessage(role, content){
        emptyEl.style.display = \x27none\x27;
        const div = document.createElement(\x27div\x27);
        div.className = \x27ds-chat-msg \x27 + (role === \x27user\x27 ? \x27ds-user\x27 : \x27ds-assistant\x27);
        div.innerHTML = escapeHtml(content);
        scrollEl.appendChild(div);
        scrollToBottom();
        return div;
    }

    function showTyping(){
        const div = document.createElement(\x27div\x27);
        div.className = \x27ds-chat-typing\x27;
        div.id = \x27dsChatTyping\x27;
        div.innerHTML = \x27<span></span><span></span><span></span>\x27;
        scrollEl.appendChild(div);
        scrollToBottom();
    }

    function hideTyping(){
        const el = document.getElementById(\x27dsChatTyping\x27);
        if (el) el.remove();
    }

    function autoGrow(){
        inputEl.style.height = \x27auto\x27;
        inputEl.style.height = Math.min(inputEl.scrollHeight, 120) + \x27px\x27;
    }
    inputEl.addEventListener(\x27input\x27, autoGrow);

    function loadHistory(){
        fetch(\x27/api/chat/history\x27, { method: \x27POST\x27, credentials: \x27same-origin\x27 })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.error || !data.messages || !data.messages.length) return;
                data.messages.forEach(function(m){ appendMessage(m.role, m.content); });
            })
            .catch(function(){});
    }

    function sendMessage(){
        const text = inputEl.value.trim();
        if (!text || isSending) return;

        isSending = true;
        sendBtn.disabled = true;
        appendMessage(\x27user\x27, text);
        inputEl.value = \x27\x27;
        autoGrow();
        showTyping();

        const form = new URLSearchParams();
        form.set(\x27message\x27, text);
        form.set(\x27platform\x27, \x27web\x27);

        fetch(\x27/api/chat\x27, {
            method: \x27POST\x27,
            credentials: \x27same-origin\x27,
            headers: { \x27Content-Type\x27: \x27application/x-www-form-urlencoded\x27 },
            body: form.toString()
        })
            .then(function(r){ return r.json(); })
            .then(function(data){
                hideTyping();
                if (data.error) {
                    appendMessage(\x27assistant\x27, data.message || \"Une erreur est survenue.\");
                } else {
                    appendMessage(\x27assistant\x27, data.reply || \x27\x27);
                }
            })
            .catch(function(){
                hideTyping();
                appendMessage(\x27assistant\x27, \"Erreur de connexion à l\x27assistant.\");
            })
            .finally(function(){
                isSending = false;
                sendBtn.disabled = false;
                inputEl.focus();
            });
    }

    sendBtn.addEventListener(\x27click\x27, sendMessage);
    inputEl.addEventListener(\x27keydown\x27, function(e){
        if (e.key === \x27Enter\x27 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    loadHistory();
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
        return "private/assistant.html.twig";
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
        return array (  144 => 69,  137 => 68,  71 => 5,  64 => 4,  53 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/assistant.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/assistant.html.twig");
    }
}
