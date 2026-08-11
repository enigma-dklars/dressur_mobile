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

/* crud_user/check_and_confirme.html.twig */
class __TwigTemplate_73104117ab73b8e0c0e6f20e5e059b28 extends Template
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
        return $this->load((((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 1) == true)) ? ("basePrivate.html.twig") : ("baseAdmin.html.twig")), 1);
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from $this->getParent($context)->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Ckeck User And Confirm";
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
        yield "    <div class=\"row g-2 mb-2\">
        <div class=\"col-6\"><p class=\"me-3 text-success\">Ckeck User And Confirm</p></div>
        <div class=\"col-6 text-end\"><a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
        yield "\">Back To List</a></div>
    </div>

    ";
        // line 12
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 13
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 14
                yield "            <div class=\"px-3 py-3 rounded text-white bg-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div> <br>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        yield "
    <form action=\"";
        // line 18
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_check_and_confirme");
        yield "\" method=\"post\" class=\"my-3 py-5 px-3 bg-success rounded\">
        <label for=\"identifier\" class=\"text-white\">Enter User Email | Phone Number | Pseudo | Uid | Id :</label>
        <div class=\"input-group\">
            <input type=\"text\" class=\"form-control form-control-lg my-2\" id=\"identifier\" name=\"identifier\" autofocus required>
            <button type=\"submit\" class=\"btn btn-lg btn-white my-2\">GO!</button>
        </div>
    </form>

    <hr>
    <p class=\"my-3\">Message</p>
    <p class=\"fs-5\">";
        // line 28
        yield ($context["message"] ?? null);
        yield "</p>

    ";
        // line 30
        if ((($tmp =  !(null === ($context["wa_message"] ?? null))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 31
            yield "    <div class=\"mt-4\">
        <p class=\"fw-semibold mb-2\">
            <i class=\"fab fa-whatsapp text-success me-1\"></i>
            Message WhatsApp à envoyer manuellement
            ";
            // line 35
            if ((($context["user_check"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["user_check"] ?? null), "user_info", [], "any", false, true, false, 35), "tel", [], "any", true, true, false, 35))) {
                // line 36
                yield "                <span class=\"text-muted fw-normal small\">— ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["user_check"] ?? null), "user_info", [], "any", false, false, false, 36), "tel", [], "any", false, false, false, 36), "html", null, true);
                yield "</span>
            ";
            }
            // line 38
            yield "        </p>
        <div class=\"position-relative\">
            <pre id=\"wa-message-box\" style=\"background:#e9fbe5;border:1px solid #b7f5c8;border-radius:12px;padding:20px 20px 20px 20px;white-space:pre-wrap;word-break:break-word;font-family:inherit;font-size:14px;line-height:1.7;margin:0;\">";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["wa_message"] ?? null), "html", null, true);
            yield "</pre>
            ";
            // line 41
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 41) != true)) {
                // line 42
                yield "            <button onclick=\"copyWaMessage()\" id=\"copy-btn\"
                    class=\"btn btn-success btn-sm position-absolute top-0 end-0 m-2\">
                <i class=\"fas fa-copy me-1\"></i>Copier
            </button>
            ";
            }
            // line 47
            yield "        </div>
        <p class=\"text-muted small mt-2\">
            Copiez ce message et envoyez-le manuellement sur WhatsApp. Le lien de confirmation est valide tant que le numéro ne change pas.
        </p>
    </div>
    ";
        }
        // line 53
        yield "
    <script>
    function copyWaMessage() {
        const text = document.getElementById(\x27wa-message-box\x27).innerText;
        const btn  = document.getElementById(\x27copy-btn\x27);
        navigator.clipboard.writeText(text).then(() => {
            btn.innerHTML = \x27<i class=\"fas fa-check me-1\"></i>Copié !\x27;
            btn.classList.replace(\x27btn-success\x27, \x27btn-outline-success\x27);
            setTimeout(() => {
                btn.innerHTML = \x27<i class=\"fas fa-copy me-1\"></i>Copier\x27;
                btn.classList.replace(\x27btn-outline-success\x27, \x27btn-success\x27);
            }, 2500);
        }).catch(() => {
            btn.innerHTML = \x27<i class=\"fas fa-times me-1\"></i>Erreur\x27;
        });
    }
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_user/check_and_confirme.html.twig";
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
        return array (  168 => 53,  160 => 47,  153 => 42,  151 => 41,  147 => 40,  143 => 38,  137 => 36,  135 => 35,  129 => 31,  127 => 30,  122 => 28,  109 => 18,  106 => 17,  100 => 16,  89 => 14,  84 => 13,  79 => 12,  73 => 8,  69 => 6,  62 => 5,  51 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user/check_and_confirme.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user/check_and_confirme.html.twig");
    }
}
