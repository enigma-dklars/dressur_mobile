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

/* crud_env_mail_sender/index.html.twig */
class __TwigTemplate_63bf6465d64bdb5822a375543bb0ea1f extends Template
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
        yield "EnvMailSender index";
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
        <div class=\"col-md-6\">
            <span class=\"h4 me-3\">EnvMailSender index</span>
            <a class=\"btn btn-sm btn-primary h4\" href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_new");
        yield "\">Create new</a>
        </div>
        <div class=\"col-md-6 text-end\">
            <button class=\"btn btn-sm btn-warning h4 me-2\" onclick=\"confirmVerifyAll()\">Vérifier tous</button>
            <button class=\"btn btn-sm btn-success h4 me-2\" onclick=\"confirmReactivate()\">Réactiver tous</button>
            <button class=\"btn btn-sm btn-danger h4 me-2\" onclick=\"confirmRemiseZero()\">Remise à zéro</button>
            <button class=\"btn btn-sm btn-secondary h4\" onclick=\"confirmResetLastUsedAt()\">Reset rotation</button>
        </div>
    </div>

    <div class=\"table-responsive\">
        <table class=\"data-table table table-bordered table-striped\">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Count.MS</th>
                    <th>Dernier envoi</th>
                    <th>Activ.</th>
                    <th>MailAdresse</th>
                    <th>Password</th>
                    <th>SmtpServer</th>
                    <th>SmtpPort</th>
                    <th>SmtpSecured</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["env_mail_senders"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["env_mail_sender"]) {
            // line 37
            yield "                <tr>
                    <td>
                        ";
            // line 39
            yield from $this->load("crud_env_mail_sender/_delete_form.html.twig", 39)->unwrap()->yield($context);
            // line 40
            yield "                    </td>
                    <td>";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "id", [], "any", false, false, false, 41), "html", null, true);
            yield "</td>
                    <td>";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "countMailSent", [], "any", false, false, false, 42), "html", null, true);
            yield "</td>
                    <td class=\"small text-nowrap\">
                        ";
            // line 44
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "lastUsedAt", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 45
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "lastUsedAt", [], "any", false, false, false, 45), "d/m/Y H:i:s"), "html", null, true);
                yield "
                        ";
            } else {
                // line 47
                yield "                            <span class=\"badge bg-secondary\">Jamais</span>
                        ";
            }
            // line 49
            yield "                    </td>
                    <td class=\"text-center\">
                        ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "activated", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 52
                yield "                            <span class=\"badge bg-success\">Oui</span>
                        ";
            } else {
                // line 54
                yield "                            <span class=\"badge bg-danger\">Non</span>
                        ";
            }
            // line 56
            yield "                    </td>
                    <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "mailAdresse", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                    <td>";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "password", [], "any", false, false, false, 58), "html", null, true);
            yield "</td>
                    <td>";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "smtpServer", [], "any", false, false, false, 59), "html", null, true);
            yield "</td>
                    <td>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "smtpPort", [], "any", false, false, false, 60), "html", null, true);
            yield "</td>
                    <td>";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["env_mail_sender"], "smtpSecured", [], "any", false, false, false, 61), "html", null, true);
            yield "</td>
                </tr>
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
        // line 63
        if (!$context['_iterated']) {
            // line 64
            yield "                <tr>
                    <td colspan=\"10\">no records found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['env_mail_sender'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "            </tbody>
        </table>
    </div>

";
        yield from [];
    }

    // line 74
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 75
        yield "<script>
function confirmVerifyAll() {
    Swal.fire({
        title: \x27Vérifier tous les senders ?\x27,
        text: \x27Une connexion SMTP sera testée pour chaque compte. Les comptes invalides seront désactivés automatiquement.\x27,
        icon: \x27info\x27,
        showCancelButton: true,
        confirmButtonText: \x27Oui, vérifier\x27,
        cancelButtonText: \x27Annuler\x27,
        confirmButtonColor: \x27#ffc107\x27,
        cancelButtonColor: \x27#6c757d\x27,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = \x27";
        // line 88
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_verify_all");
        yield "\x27;
        }
    });
}

function confirmReactivate() {
    Swal.fire({
        title: \x27Réactiver tous les senders ?\x27,
        text: \x27Tous les senders désactivés seront remis actifs.\x27,
        icon: \x27question\x27,
        showCancelButton: true,
        confirmButtonText: \x27Oui, réactiver\x27,
        cancelButtonText: \x27Annuler\x27,
        confirmButtonColor: \x27#198754\x27,
        cancelButtonColor: \x27#6c757d\x27,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = \x27";
        // line 105
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_reactivate_all");
        yield "\x27;
        }
    });
}

function confirmResetLastUsedAt() {
    Swal.fire({
        title: \x27Réinitialiser la rotation ?\x27,
        text: \x27La date de dernier envoi de tous les comptes sera effacée. Le prochain envoi repartira du premier compte disponible.\x27,
        icon: \x27question\x27,
        showCancelButton: true,
        confirmButtonText: \x27<i class=\"fas fa-sync-alt me-1\"></i>Oui, réinitialiser\x27,
        cancelButtonText: \x27Annuler\x27,
        confirmButtonColor: \x27#6c757d\x27,
        cancelButtonColor: \x27#6c757d\x27,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = \x27";
        // line 122
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_reset_last_used_at");
        yield "\x27;
        }
    });
}

function confirmRemiseZero() {
    Swal.fire({
        title: \x27Remettre à zéro les compteurs ?\x27,
        text: \"Tous les compteurs d\x27envoi seront réinitialisés à 0.\",
        icon: \x27warning\x27,
        showCancelButton: true,
        confirmButtonText: \x27Oui, remettre à zéro\x27,
        cancelButtonText: \x27Annuler\x27,
        confirmButtonColor: \x27#dc3545\x27,
        cancelButtonColor: \x27#6c757d\x27,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = \x27";
        // line 139
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_env_mail_sender_remise_zero");
        yield "\x27;
        }
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
        return "crud_env_mail_sender/index.html.twig";
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
        return array (  304 => 139,  284 => 122,  264 => 105,  244 => 88,  229 => 75,  222 => 74,  213 => 68,  204 => 64,  202 => 63,  187 => 61,  183 => 60,  179 => 59,  175 => 58,  171 => 57,  168 => 56,  164 => 54,  160 => 52,  158 => 51,  154 => 49,  150 => 47,  144 => 45,  142 => 44,  137 => 42,  133 => 41,  130 => 40,  128 => 39,  124 => 37,  106 => 36,  76 => 9,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_env_mail_sender/index.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_env_mail_sender/index.html.twig");
    }
}
