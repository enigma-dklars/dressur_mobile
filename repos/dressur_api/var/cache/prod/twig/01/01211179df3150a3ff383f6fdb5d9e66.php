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

/* private/notification.html.twig */
class __TwigTemplate_88ab847d22a26def0b2970519ff82588 extends Template
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
        yield "Notifications";
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
.ds-notif-wrap{max-width:720px;margin:0 auto}

.ds-notif-wa-banner{
    display:flex;align-items:center;gap:14px;
    margin-bottom:16px;padding:14px 16px;border-radius:16px;
    background:linear-gradient(135deg,#128C7E,#25D366);
    box-shadow:0 5px 14px rgba(37,211,102,.30);
    text-decoration:none;color:#fff;
}
.ds-notif-wa-banner:hover{color:#fff}
.ds-notif-wa-icon{width:48px;height:48px;border-radius:12px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ds-notif-wa-icon i{font-size:22px;color:#fff}
.ds-notif-wa-body{flex:1}
.ds-notif-wa-title{font-weight:700;font-size:14px;margin:0 0 3px}
.ds-notif-wa-sub{font-size:12px;margin:0;opacity:.9;line-height:1.4}
.ds-notif-wa-follow{padding:6px 14px;border-radius:20px;background:#fff;color:#128C7E;font-weight:700;font-size:12px;flex-shrink:0}

.ds-notif-day-sep{display:flex;align-items:center;gap:10px;margin:18px 0 10px}
.ds-notif-day-sep:first-of-type{margin-top:10px}
.ds-notif-day-sep hr{flex:1;margin:0;border-color:var(--bs-border-color,rgba(0,0,0,.12))}
.ds-notif-day-badge{padding:4px 12px;border-radius:20px;background:rgba(13,110,253,.10);border:1px solid rgba(13,110,253,.25);color:var(--bs-primary,#0d6efd);font-size:12px;font-weight:600;white-space:nowrap}

.ds-notif-card{display:flex;align-items:flex-start;gap:12px;background:var(--bs-body-bg,#fff);border:1px solid var(--bs-border-color,rgba(0,0,0,.08));border-radius:14px;box-shadow:0 3px 8px rgba(0,0,0,.07);padding:13px 14px;margin-bottom:8px}
.ds-notif-card-icon{width:38px;height:38px;border-radius:10px;background:rgba(13,110,253,.10);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.ds-notif-card-icon i{font-size:16px;color:var(--bs-primary,#0d6efd)}
.ds-notif-card-text{font-size:14px;font-weight:500;color:var(--bs-body-color,#212529);line-height:1.45;margin:0}
.ds-notif-card-time{font-size:11px;color:var(--bs-secondary-color,#adb5bd);margin:5px 0 0}

.ds-notif-state{text-align:center;padding:60px 20px}
.ds-notif-state i{font-size:40px;color:#ced4da;margin-bottom:14px;display:block}
.ds-notif-state p{color:#8a8f98;font-size:14px;margin:0 0 16px}

html.dark-theme .ds-notif-card,html.semi-dark .ds-notif-card{background:#202a40;border-color:rgba(255,255,255,.08);box-shadow:0 3px 8px rgba(0,0,0,.3)}
html.dark-theme .ds-notif-card-text,html.semi-dark .ds-notif-card-text{color:#fcfcfc}
html.dark-theme .ds-notif-day-sep hr,html.semi-dark .ds-notif-day-sep hr{border-color:rgba(255,255,255,.12)}
</style>

<div class=\"ds-notif-wrap\">

    <h5 class=\"ds-hub-title\" style=\"font-weight:700;font-size:1.1rem;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:8px\">
        <span><i class=\"fas fa-bell text-primary\"></i> Notifications</span>
        <button type=\"button\" id=\"dsNotifRefreshBtn\" class=\"btn btn-sm btn-light\" title=\"Actualiser\">
            <i class=\"fas fa-arrows-rotate\"></i>
        </button>
    </h5>

    <a href=\"";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["chaine_whatsapp"] ?? null), "html", null, true);
        yield "\" target=\"_blank\" rel=\"noopener\" class=\"ds-notif-wa-banner\">
        <div class=\"ds-notif-wa-icon\"><i class=\"fab fa-whatsapp\"></i></div>
        <div class=\"ds-notif-wa-body\">
            <p class=\"ds-notif-wa-title\">Chaîne WhatsApp Dressur</p>
            <p class=\"ds-notif-wa-sub\">Offres flash, promos immédiates et actus en temps réel</p>
        </div>
        <div class=\"ds-notif-wa-follow\">Suivre</div>
    </a>

    <div id=\"dsNotifList\"></div>

    <div id=\"dsNotifLoading\" class=\"ds-notif-state\">
        <div class=\"spinner-border text-primary\" role=\"status\"></div>
    </div>

    <div id=\"dsNotifError\" class=\"ds-notif-state\" style=\"display:none\">
        <i class=\"fas fa-circle-exclamation\"></i>
        <p>Impossible de charger les notifications.</p>
        <button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"dsNotifRetryBtn\">
            <i class=\"fas fa-arrows-rotate me-1\"></i>Réessayer
        </button>
    </div>

    <div id=\"dsNotifEmpty\" class=\"ds-notif-state\" style=\"display:none\">
        <i class=\"fas fa-bell-slash\"></i>
        <p>Aucune notification reçue</p>
    </div>

</div>
";
        yield from [];
    }

    // line 83
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 84
        yield "<script>
(function(){
    const LAST_SEEN_KEY = \x27ds_notif_last_seen_total\x27;
    const listEl    = document.getElementById(\x27dsNotifList\x27);
    const loadingEl = document.getElementById(\x27dsNotifLoading\x27);
    const errorEl   = document.getElementById(\x27dsNotifError\x27);
    const emptyEl   = document.getElementById(\x27dsNotifEmpty\x27);

    const MOIS = [\x27\x27, \x27Janvier\x27, \x27Février\x27, \x27Mars\x27, \x27Avril\x27, \x27Mai\x27, \x27Juin\x27, \x27Juillet\x27, \x27Août\x27, \x27Septembre\x27, \x27Octobre\x27, \x27Novembre\x27, \x27Décembre\x27];

    function dayKey(d){ return d.getFullYear() + \x27-\x27 + (d.getMonth()+1) + \x27-\x27 + d.getDate(); }

    function headerLabel(d){
        const now = new Date();
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        const dd = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const diffDays = Math.round((today - dd) / 86400000);
        if (diffDays === 0) return \"Aujourd\x27hui\";
        if (diffDays === 1) return \"Hier\";
        if (d.getFullYear() === now.getFullYear()) return d.getDate() + \x27 \x27 + MOIS[d.getMonth()+1];
        return d.getDate() + \x27 \x27 + MOIS[d.getMonth()+1] + \x27 \x27 + d.getFullYear();
    }

    function timeLabel(d){
        return String(d.getHours()).padStart(2,\x270\x27) + \x27:\x27 + String(d.getMinutes()).padStart(2,\x270\x27);
    }

    function escapeHtml(str){
        const div = document.createElement(\x27div\x27);
        div.textContent = str;
        return div.innerHTML;
    }

    function setState(state){
        loadingEl.style.display = state === \x27loading\x27 ? \x27\x27 : \x27none\x27;
        errorEl.style.display   = state === \x27error\x27   ? \x27\x27 : \x27none\x27;
        emptyEl.style.display   = state === \x27empty\x27   ? \x27\x27 : \x27none\x27;
        listEl.style.display    = state === \x27list\x27    ? \x27\x27 : \x27none\x27;
    }

    function render(notifications){
        if (!notifications.length) {
            listEl.innerHTML = \x27\x27;
            setState(\x27empty\x27);
            return;
        }

        let html = \x27\x27;
        let currentKey = null;
        notifications.forEach(function(n){
            const dt = new Date(n.createdAt.replace(\x27 \x27, \x27T\x27));
            const key = dayKey(dt);
            if (key !== currentKey) {
                html += \x27<div class=\"ds-notif-day-sep\"><hr><span class=\"ds-notif-day-badge\">\x27 + headerLabel(dt) + \x27</span><hr></div>\x27;
                currentKey = key;
            }
            html += \x27<div class=\"ds-notif-card\">\x27 +
                        \x27<div class=\"ds-notif-card-icon\"><i class=\"fas fa-bell\"></i></div>\x27 +
                        \x27<div>\x27 +
                            \x27<p class=\"ds-notif-card-text\">\x27 + escapeHtml(n.text) + \x27</p>\x27 +
                            \x27<p class=\"ds-notif-card-time\">\x27 + timeLabel(dt) + \x27</p>\x27 +
                        \x27</div>\x27 +
                    \x27</div>\x27;
        });
        listEl.innerHTML = html;
        setState(\x27list\x27);
    }

    function markAsSeen(total){
        try { localStorage.setItem(LAST_SEEN_KEY, String(total)); } catch(e) {}
        if (window.dsUpdateNotifBadge) window.dsUpdateNotifBadge(0);
    }

    function fetchNotifications(){
        setState(\x27loading\x27);
        fetch(\x27/api/getNotifications\x27, { method: \x27POST\x27, credentials: \x27same-origin\x27 })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.error) { setState(\x27error\x27); return; }
                const notifications = data.notifications || [];
                render(notifications);
                markAsSeen(notifications.length);
            })
            .catch(function(){ setState(\x27error\x27); });
    }

    document.getElementById(\x27dsNotifRefreshBtn\x27).addEventListener(\x27click\x27, fetchNotifications);
    document.getElementById(\x27dsNotifRetryBtn\x27).addEventListener(\x27click\x27, fetchNotifications);

    fetchNotifications();
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
        return "private/notification.html.twig";
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
        return array (  162 => 84,  155 => 83,  120 => 52,  71 => 5,  64 => 4,  53 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/notification.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/notification.html.twig");
    }
}
