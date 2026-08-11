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

/* crud_user/check_user.html.twig */
class __TwigTemplate_e68b5ae98877e16dd968587b83f11b92 extends Template
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
        yield "Check User";
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
        yield "<div class=\"row g-2 mb-3 align-items-center\">
    <div class=\"col\"><p class=\"h4 text-info mb-0\">Check User</p></div>
    <div class=\"col-auto\"><a class=\"btn btn-sm btn-primary\" href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
        yield "\">Back To List</a></div>
</div>

";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 11));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 12
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 13
                yield "        <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " py-2\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        yield "
<form action=\"";
        // line 17
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_check");
        yield "\" method=\"post\" class=\"mb-4 py-4 px-3 bg-info rounded\">
    <label for=\"identifier\" class=\"text-white fw-semibold mb-1 d-block\">Email · Téléphone · Pseudo · Uid · Id</label>
    <div class=\"input-group\">
        <input type=\"text\" class=\"form-control form-control-lg\" id=\"identifier\" name=\"identifier\" autofocus required>
        <button type=\"submit\" class=\"btn btn-light btn-lg\">Rechercher</button>
    </div>
</form>

";
        // line 25
        if ((($tmp = ($context["user_check"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 26
            yield "    ";
            $context["u"] = (($_v0 = ($context["user_check"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["user_info"] ?? null) : null);
            // line 27
            yield "
    ";
            // line 29
            yield "    ";
            $context["id_users"] = [];
            // line 30
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["usr"]) {
                $context["id_users"] = Twig\Extension\CoreExtension::merge(($context["id_users"] ?? null), [CoreExtension::getAttribute($this->env, $this->source, $context["usr"], "id", [], "any", false, false, false, 30)]);
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['usr'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            yield "    ";
            $context["lesContactsDuUser"] = [];
            // line 32
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "contact", [], "any", false, false, false, 32), "whoIAdd", [], "any", false, false, false, 32));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 33
                yield "        ";
                if ((CoreExtension::inFilter($context["item"], ($context["id_users"] ?? null)) && !CoreExtension::inFilter($context["item"], ($context["lesContactsDuUser"] ?? null)))) {
                    $context["lesContactsDuUser"] = Twig\Extension\CoreExtension::merge(($context["lesContactsDuUser"] ?? null), [$context["item"]]);
                }
                // line 34
                yield "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "contact", [], "any", false, false, false, 35), "whoAddMe", [], "any", false, false, false, 35));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 36
                yield "        ";
                if ((CoreExtension::inFilter($context["item"], ($context["id_users"] ?? null)) && !CoreExtension::inFilter($context["item"], ($context["lesContactsDuUser"] ?? null)))) {
                    $context["lesContactsDuUser"] = Twig\Extension\CoreExtension::merge(($context["lesContactsDuUser"] ?? null), [$context["item"]]);
                }
                // line 37
                yield "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            yield "
    <hr>

    ";
            // line 42
            yield "    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 42) != true)) {
                yield "<div class=\"mb-3\">";
                yield from $this->load("crud_user/_delete_form.html.twig", 42)->unwrap()->yield(CoreExtension::toArray(["user" => ($context["u"] ?? null)]));
                yield "</div>";
            }
            // line 43
            yield "
    ";
            // line 45
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">🪪 Identité</div>
        <div class=\"card-body\">
            <div class=\"row g-2\">
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Pseudo</small><strong>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "pseudo", [], "any", false, false, false, 49), "html", null, true);
            yield "</strong></div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Nom</small>";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "nom", [], "any", false, false, false, 50), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Id</small>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "id", [], "any", false, false, false, 51), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Uid</small><span class=\"text-break small\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "uid", [], "any", false, false, false, 52), "html", null, true);
            yield "</span></div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Langue</small>";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lang", [], "any", false, false, false, 53), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Pays</small>";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "pays", [], "any", false, false, false, 54), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Lid</small>";
            // line 55
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lid", [], "any", true, true, false, 55) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lid", [], "any", false, false, false, 55)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lid", [], "any", false, false, false, 55), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Source inscription</small>";
            // line 56
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "registerSource", [], "any", true, true, false, 56) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "registerSource", [], "any", false, false, false, 56)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "registerSource", [], "any", false, false, false, 56), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Source dernière connexion</small>";
            // line 57
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lastLoginSource", [], "any", true, true, false, 57) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lastLoginSource", [], "any", false, false, false, 57)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lastLoginSource", [], "any", false, false, false, 57), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Admin</small>
                    ";
            // line 60
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "admin", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-secondary\">No</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Vendeur</small>
                    ";
            // line 64
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "isVendeur", [], "any", false, false, false, 64)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-secondary\">No</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Bloqué</small>
                    ";
            // line 68
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "blocked", [], "any", false, false, false, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-danger\">Yes</span>") : ("<span class=\"badge bg-success\">No</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Créé le</small>";
            // line 70
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "createdAt", [], "any", false, false, false, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "createdAt", [], "any", false, false, false, 70), "d/m/Y H:i"), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Dernière connexion</small>";
            // line 71
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lastLoginTo", [], "any", false, false, false, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lastLoginTo", [], "any", false, false, false, 71), "d/m/Y H:i"), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Lecteur</small>
                    ";
            // line 74
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "lecteur", [], "any", false, false, false, 74)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-info\">Oui</span>") : ("<span class=\"badge bg-secondary\">Non</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Est Partenaire</small>
                    ";
            // line 78
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "estPartenaire", [], "any", false, false, false, 78)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Oui</span>") : ("<span class=\"badge bg-secondary\">Non</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Code Partenaire</small><strong>";
            // line 80
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "codePartenaire", [], "any", true, true, false, 80) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "codePartenaire", [], "any", false, false, false, 80)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "codePartenaire", [], "any", false, false, false, 80), "html", null, true)) : ("—"));
            yield "</strong></div>
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Partenaire lié</small>
                    ";
            // line 83
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "partenaire", [], "any", false, false, false, 83)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 84
                yield "                        <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_check");
                yield "?identifier=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "partenaire", [], "any", false, false, false, 84), "id", [], "any", false, false, false, 84), "html", null, true);
                yield "\" class=\"small\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "partenaire", [], "any", false, false, false, 84), "pseudo", [], "any", false, false, false, 84), "html", null, true);
                yield " (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "partenaire", [], "any", false, false, false, 84), "id", [], "any", false, false, false, 84), "html", null, true);
                yield ")</a>
                    ";
            } else {
                // line 85
                yield "—";
            }
            // line 86
            yield "                </div>
            </div>
        </div>
    </div>

    ";
            // line 92
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">📞 Contact</div>
        <div class=\"card-body\">
            <div class=\"row g-3\">
                <div class=\"col-12 col-md-6\">
                    <small class=\"text-muted d-block\">Numéro WhatsApp</small>
                    <strong>";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "tel", [], "any", false, false, false, 98), "html", null, true);
            yield "</strong>
                    <div class=\"mt-1\">
                        ";
            // line 100
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "telIsVerified", [], "any", false, false, false, 100)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 101
                yield "                            <span class=\"badge bg-success\">Vérifié</span>
                        ";
            } else {
                // line 103
                yield "                            <span class=\"badge bg-danger me-2\">Non vérifié</span>
                            ";
                // line 104
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 104) != true)) {
                    // line 105
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerTel", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "id", [], "any", false, false, false, 105)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation du numéro WhatsApp ?\x27)\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 106
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_tel" . CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "id", [], "any", false, false, false, 106))), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"btn btn-sm btn-warning\">Activer</button>
                            </form>
                            ";
                }
                // line 110
                yield "                        ";
            }
            // line 111
            yield "                    </div>
                </div>
                <div class=\"col-12 col-md-6\">
                    <small class=\"text-muted d-block\">Adresse Mail</small>
                    <strong>";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "mail", [], "any", false, false, false, 115), "html", null, true);
            yield "</strong>
                    <div class=\"mt-1\">
                        ";
            // line 117
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "mailIsVerified", [], "any", false, false, false, 117)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 118
                yield "                            <span class=\"badge bg-success\">Vérifié</span>
                        ";
            } else {
                // line 120
                yield "                            <span class=\"badge bg-danger me-2\">Non vérifié</span>
                            ";
                // line 121
                if ((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "lecteur", [], "any", false, false, false, 121) != true)) {
                    // line 122
                    yield "                            <form action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_activerMail", ["id" => CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "id", [], "any", false, false, false, 122)]), "html", null, true);
                    yield "\" method=\"post\" class=\"d-inline\" onsubmit=\"return confirm(\x27Confirmer l\\\x27activation de l\\\x27adresse mail ?\x27)\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 123
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("activer_mail" . CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "id", [], "any", false, false, false, 123))), "html", null, true);
                    yield "\">
                                <button type=\"submit\" class=\"btn btn-sm btn-warning\">Activer</button>
                            </form>
                            ";
                }
                // line 127
                yield "                        ";
            }
            // line 128
            yield "                    </div>
                </div>
            </div>
        </div>
    </div>

    ";
            // line 135
            yield "    ";
            if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "tiktok", [], "any", false, false, false, 135) || CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "instagram", [], "any", false, false, false, 135)) || CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "facebook", [], "any", false, false, false, 135)) || CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "youtube", [], "any", false, false, false, 135))) {
                // line 136
                yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">🌐 Réseaux sociaux</div>
        <div class=\"card-body\">
            <div class=\"row g-2\">
                ";
                // line 140
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "tiktok", [], "any", false, false, false, 140)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">TikTok</small><a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "tiktok", [], "any", false, false, false, 140), "html", null, true);
                    yield "\" target=\"_blank\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "tiktok", [], "any", false, false, false, 140), "html", null, true);
                    yield "</a></div>";
                }
                // line 141
                yield "                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "instagram", [], "any", false, false, false, 141)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Instagram</small><a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "instagram", [], "any", false, false, false, 141), "html", null, true);
                    yield "\" target=\"_blank\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "instagram", [], "any", false, false, false, 141), "html", null, true);
                    yield "</a></div>";
                }
                // line 142
                yield "                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "facebook", [], "any", false, false, false, 142)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Facebook</small><a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "facebook", [], "any", false, false, false, 142), "html", null, true);
                    yield "\" target=\"_blank\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "facebook", [], "any", false, false, false, 142), "html", null, true);
                    yield "</a></div>";
                }
                // line 143
                yield "                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "youtube", [], "any", false, false, false, 143)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "<div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">YouTube</small><a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "youtube", [], "any", false, false, false, 143), "html", null, true);
                    yield "\" target=\"_blank\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "youtube", [], "any", false, false, false, 143), "html", null, true);
                    yield "</a></div>";
                }
                // line 144
                yield "            </div>
        </div>
    </div>
    ";
            }
            // line 148
            yield "
    ";
            // line 150
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">🎁 Programme Récompense</div>
        <div class=\"card-body\">
            <div class=\"row g-2\">
                <div class=\"col-6 col-md-3\">
                    <small class=\"text-muted d-block\">Inscrit</small>
                    ";
            // line 156
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "isInscritProgrammeRecompense", [], "any", false, false, false, 156)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("<span class=\"badge bg-success\">Yes</span>") : ("<span class=\"badge bg-danger\">No</span>"));
            yield "
                </div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Solde</small>";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "soldeProgrammeRecompense", [], "any", false, false, false, 158), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Réseau retrait</small>";
            // line 159
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "reseauRetrait", [], "any", true, true, false, 159) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "reseauRetrait", [], "any", false, false, false, 159)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "reseauRetrait", [], "any", false, false, false, 159), "html", null, true)) : ("—"));
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Numéro retrait</small>";
            // line 160
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "numeroRetrait", [], "any", true, true, false, 160) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "numeroRetrait", [], "any", false, false, false, 160)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "numeroRetrait", [], "any", false, false, false, 160), "html", null, true)) : ("—"));
            yield "</div>
            </div>
        </div>
    </div>

    ";
            // line 166
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">📊 Préférences & Stats</div>
        <div class=\"card-body\">
            <div class=\"row g-2\">
                <div class=\"col-12\"><small class=\"text-muted d-block\">Pays préférés (";
            // line 170
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nbr_pays_preference"] ?? null), "html", null, true);
            yield ")</small><span class=\"small\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["pays_preference"] ?? null), "html", null, true);
            yield "</span></div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Contacts</small>";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["contactCount"] ?? null), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Boosts</small>";
            // line 172
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "boosts", [], "any", false, false, false, 172)), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Promo Affaire</small>";
            // line 173
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promotions", [], "any", false, false, false, 173)), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Promo Réseau</small>";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promoReseaus", [], "any", false, false, false, 174)), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Transactions</small>";
            // line 175
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["transactions"] ?? null)), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Accompagnés</small>";
            // line 176
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "accompagnes", [], "any", false, false, false, 176)), "html", null, true);
            yield "</div>
                <div class=\"col-6 col-md-3\"><small class=\"text-muted d-block\">Suggestions</small>";
            // line 177
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "suggestions", [], "any", false, false, false, 177)), "html", null, true);
            yield "</div>
            </div>
        </div>
    </div>

    ";
            // line 183
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">⚡ Boosts (";
            // line 184
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "boosts", [], "any", false, false, false, 184)), "html", null, true);
            yield ")</div>
        ";
            // line 185
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "boosts", [], "any", false, false, false, 185)) > 0)) {
                // line 186
                yield "        <div class=\"table-responsive\">
            <table class=\"table table-sm table-bordered table-striped mb-0\">
                <thead class=\"table-dark\">
                    <tr>
                        <th>Id</th>
                        <th>Formule</th>
                        <th>Mode</th>
                        <th>Type</th>
                        <th>Source</th>
                        <th>Contacts obtenus</th>
                        <th>Début</th>
                        <th>Exp.</th>
                    </tr>
                </thead>
                <tbody>
                ";
                // line 201
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "boosts", [], "any", false, false, false, 201));
                foreach ($context['_seq'] as $context["_key"] => $context["boost"]) {
                    // line 202
                    yield "                    <tr>
                        <td>";
                    // line 203
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "id", [], "any", false, false, false, 203), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 204
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "formuleBoost", [], "any", false, false, false, 204), "titre", [], "any", false, false, false, 204), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 205
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "mode", [], "any", false, false, false, 205), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 206
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "typeBoost", [], "any", false, false, false, 206), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 207
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "source", [], "any", true, true, false, 207) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "source", [], "any", false, false, false, 207)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "source", [], "any", false, false, false, 207), "html", null, true)) : ("—"));
                    yield "</td>
                        <td class=\"text-end\">";
                    // line 208
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "nbContactsObtenus", [], "any", false, false, false, 208), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 209
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateDebut", [], "any", false, false, false, 209)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateDebut", [], "any", false, false, false, 209), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 210
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 210)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["boost"], "dateExp", [], "any", false, false, false, 210), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['boost'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 213
                yield "                </tbody>
            </table>
        </div>
        ";
            } else {
                // line 217
                yield "        <div class=\"card-body text-muted\">Aucun boost.</div>
        ";
            }
            // line 219
            yield "    </div>

    ";
            // line 222
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">📢 Promo Affaire (";
            // line 223
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promotions", [], "any", false, false, false, 223)), "html", null, true);
            yield ")</div>
        ";
            // line 224
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promotions", [], "any", false, false, false, 224)) > 0)) {
                // line 225
                yield "        <div class=\"table-responsive\">
            <table class=\"table table-sm table-bordered table-striped mb-0\">
                <thead class=\"table-dark\">
                    <tr>
                        <th>Id</th>
                        <th>Formule</th>
                        <th>Type</th>
                        <th>Mode</th>
                        <th>Status</th>
                        <th>Source</th>
                        <th>Début</th>
                        <th>Exp.</th>
                        <th>Créé le</th>
                    </tr>
                </thead>
                <tbody>
                ";
                // line 241
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promotions", [], "any", false, false, false, 241));
                foreach ($context['_seq'] as $context["_key"] => $context["promo"]) {
                    // line 242
                    yield "                    <tr>
                        <td>";
                    // line 243
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "id", [], "any", false, false, false, 243), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 244
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "formulePromoAffaire", [], "any", false, false, false, 244)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "formulePromoAffaire", [], "any", false, false, false, 244), "titre", [], "any", false, false, false, 244), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 245
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "typePromotionAffaire", [], "any", true, true, false, 245) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "typePromotionAffaire", [], "any", false, false, false, 245)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "typePromotionAffaire", [], "any", false, false, false, 245), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 246
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "mode", [], "any", true, true, false, 246) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "mode", [], "any", false, false, false, 246)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "mode", [], "any", false, false, false, 246), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>
                            ";
                    // line 248
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "status", [], "any", false, false, false, 248) == 0)) {
                        yield "<span class=\"badge bg-danger\">Rejeté</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 249
$context["promo"], "status", [], "any", false, false, false, 249) == 1)) {
                        yield "<span class=\"badge bg-warning text-dark\">En attente</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 250
$context["promo"], "status", [], "any", false, false, false, 250) == 2)) {
                        yield "<span class=\"badge bg-info\">Att. paiement</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 251
$context["promo"], "status", [], "any", false, false, false, 251) == 3)) {
                        yield "<span class=\"badge bg-success\">En cours</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 252
$context["promo"], "status", [], "any", false, false, false, 252) == 4)) {
                        yield "<span class=\"badge bg-secondary\">Terminé</span>
                            ";
                    } else {
                        // line 253
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "status", [], "any", false, false, false, 253), "html", null, true);
                    }
                    // line 254
                    yield "                        </td>
                        <td>";
                    // line 255
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "source", [], "any", true, true, false, 255) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "source", [], "any", false, false, false, 255)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "source", [], "any", false, false, false, 255), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 256
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "dateDebut", [], "any", false, false, false, 256)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "dateDebut", [], "any", false, false, false, 256), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 257
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "dateExp", [], "any", false, false, false, 257)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "dateExp", [], "any", false, false, false, 257), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 258
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "createdAt", [], "any", false, false, false, 258)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["promo"], "createdAt", [], "any", false, false, false, 258), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['promo'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 261
                yield "                </tbody>
            </table>
        </div>
        ";
            } else {
                // line 265
                yield "        <div class=\"card-body text-muted\">Aucune promo affaire.</div>
        ";
            }
            // line 267
            yield "    </div>

    ";
            // line 270
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">🌐 Promo Réseau (";
            // line 271
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promoReseaus", [], "any", false, false, false, 271)), "html", null, true);
            yield ")</div>
        ";
            // line 272
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promoReseaus", [], "any", false, false, false, 272)) > 0)) {
                // line 273
                yield "        <div class=\"table-responsive\">
            <table class=\"table table-sm table-bordered table-striped mb-0\">
                <thead class=\"table-dark\">
                    <tr>
                        <th>Id</th>
                        <th>Formule</th>
                        <th>Qte</th>
                        <th>Prix (FCFA)</th>
                        <th>Compteur</th>
                        <th>Status</th>
                        <th>Id Zef</th>
                        <th>Source</th>
                        <th>URL</th>
                        <th>Créé le</th>
                    </tr>
                </thead>
                <tbody>
                ";
                // line 290
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["u"] ?? null), "promoReseaus", [], "any", false, false, false, 290));
                foreach ($context['_seq'] as $context["_key"] => $context["pr"]) {
                    // line 291
                    yield "                    <tr>
                        <td>";
                    // line 292
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "id", [], "any", false, false, false, 292), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 293
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "formulePromoReseau", [], "any", false, false, false, 293), "titre", [], "any", false, false, false, 293), "html", null, true);
                    yield "</td>
                        <td class=\"text-end\">";
                    // line 294
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "qteDemander", [], "any", false, false, false, 294), "html", null, true);
                    yield "</td>
                        <td class=\"text-end\">";
                    // line 295
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "prixFixer", [], "any", false, false, false, 295), "html", null, true);
                    yield "</td>
                        <td class=\"text-end\">";
                    // line 296
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "compteurRestant", [], "any", false, false, false, 296), "html", null, true);
                    yield " / ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "qteDemander", [], "any", false, false, false, 296), "html", null, true);
                    yield "</td>
                        <td>
                            ";
                    // line 298
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "status", [], "any", false, false, false, 298) == 0)) {
                        yield "<span class=\"badge bg-warning text-dark\">Remboursé</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 299
$context["pr"], "status", [], "any", false, false, false, 299) == 1)) {
                        yield "<span class=\"badge bg-secondary\">En attente</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 300
$context["pr"], "status", [], "any", false, false, false, 300) == 2)) {
                        yield "<span class=\"badge bg-success\">En cours</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 301
$context["pr"], "status", [], "any", false, false, false, 301) == 3)) {
                        yield "<span class=\"badge bg-dark\">Terminé</span>
                            ";
                    } else {
                        // line 302
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "status", [], "any", false, false, false, 302), "html", null, true);
                    }
                    // line 303
                    yield "                        </td>
                        <td>";
                    // line 304
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "idZefame", [], "any", true, true, false, 304) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "idZefame", [], "any", false, false, false, 304)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "idZefame", [], "any", false, false, false, 304), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 305
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "source", [], "any", true, true, false, 305) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "source", [], "any", false, false, false, 305)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "source", [], "any", false, false, false, 305), "html", null, true)) : ("—"));
                    yield "</td>
                        <td><a href=\"";
                    // line 306
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "url", [], "any", false, false, false, 306), "html", null, true);
                    yield "\" target=\"_blank\" class=\"text-break small\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "url", [], "any", false, false, false, 306), 0, 40), "html", null, true);
                    if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "url", [], "any", false, false, false, 306)) > 40)) {
                        yield "…";
                    }
                    yield "</a></td>
                        <td>";
                    // line 307
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "createdAt", [], "any", false, false, false, 307)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["pr"], "createdAt", [], "any", false, false, false, 307), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['pr'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 310
                yield "                </tbody>
            </table>
        </div>
        ";
            } else {
                // line 314
                yield "        <div class=\"card-body text-muted\">Aucune promo réseau.</div>
        ";
            }
            // line 316
            yield "    </div>

    ";
            // line 319
            yield "    <div class=\"card mb-3\">
        <div class=\"card-header fw-bold\">💳 Transactions (";
            // line 320
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["transactions"] ?? null)), "html", null, true);
            yield ")</div>
        ";
            // line 321
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["transactions"] ?? null)) > 0)) {
                // line 322
                yield "        <div class=\"table-responsive\">
            <table class=\"table table-sm table-bordered table-striped mb-0\">
                <thead class=\"table-dark\">
                    <tr>
                        <th>Id</th>
                        <th>Id Transaction</th>
                        <th>Référence</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th>Pour</th>
                        <th>Créé le</th>
                    </tr>
                </thead>
                <tbody>
                ";
                // line 336
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["transactions"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["tx"]) {
                    // line 337
                    yield "                    <tr>
                        <td>";
                    // line 338
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "id", [], "any", false, false, false, 338), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 339
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "idTransaction", [], "any", true, true, false, 339) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "idTransaction", [], "any", false, false, false, 339)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "idTransaction", [], "any", false, false, false, 339), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 340
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "reference", [], "any", true, true, false, 340) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "reference", [], "any", false, false, false, 340)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "reference", [], "any", false, false, false, 340), "html", null, true)) : ("—"));
                    yield "</td>
                        <td class=\"text-end\">";
                    // line 341
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "amount", [], "any", false, false, false, 341), "html", null, true);
                    yield "</td>
                        <td>
                            ";
                    // line 343
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", false, false, false, 343) == "approved")) {
                        yield "<span class=\"badge bg-success\">Approuvé</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 344
$context["tx"], "status", [], "any", false, false, false, 344) == "pending")) {
                        yield "<span class=\"badge bg-warning text-dark\">En attente</span>
                            ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 345
$context["tx"], "status", [], "any", false, false, false, 345) == "declined")) {
                        yield "<span class=\"badge bg-danger\">Refusé</span>
                            ";
                    } else {
                        // line 346
                        yield "<span class=\"badge bg-secondary\">";
                        yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", true, true, false, 346) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", false, false, false, 346)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "status", [], "any", false, false, false, 346), "html", null, true)) : ("—"));
                        yield "</span>";
                    }
                    // line 347
                    yield "                        </td>
                        <td>";
                    // line 348
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "transactionFor", [], "any", true, true, false, 348) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "transactionFor", [], "any", false, false, false, 348)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "transactionFor", [], "any", false, false, false, 348), "html", null, true)) : ("—"));
                    yield "</td>
                        <td>";
                    // line 349
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "createdAt", [], "any", false, false, false, 349)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tx"], "createdAt", [], "any", false, false, false, 349), "d/m/Y H:i"), "html", null, true)) : ("—"));
                    yield "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['tx'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 352
                yield "                </tbody>
            </table>
        </div>
        ";
            } else {
                // line 356
                yield "        <div class=\"card-body text-muted\">Aucune transaction.</div>
        ";
            }
            // line 358
            yield "    </div>

";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "crud_user/check_user.html.twig";
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
        return array (  924 => 358,  920 => 356,  914 => 352,  905 => 349,  901 => 348,  898 => 347,  893 => 346,  888 => 345,  884 => 344,  880 => 343,  875 => 341,  871 => 340,  867 => 339,  863 => 338,  860 => 337,  856 => 336,  840 => 322,  838 => 321,  834 => 320,  831 => 319,  827 => 316,  823 => 314,  817 => 310,  808 => 307,  799 => 306,  795 => 305,  791 => 304,  788 => 303,  785 => 302,  780 => 301,  776 => 300,  772 => 299,  768 => 298,  761 => 296,  757 => 295,  753 => 294,  749 => 293,  745 => 292,  742 => 291,  738 => 290,  719 => 273,  717 => 272,  713 => 271,  710 => 270,  706 => 267,  702 => 265,  696 => 261,  687 => 258,  683 => 257,  679 => 256,  675 => 255,  672 => 254,  669 => 253,  664 => 252,  660 => 251,  656 => 250,  652 => 249,  648 => 248,  643 => 246,  639 => 245,  635 => 244,  631 => 243,  628 => 242,  624 => 241,  606 => 225,  604 => 224,  600 => 223,  597 => 222,  593 => 219,  589 => 217,  583 => 213,  574 => 210,  570 => 209,  566 => 208,  562 => 207,  558 => 206,  554 => 205,  550 => 204,  546 => 203,  543 => 202,  539 => 201,  522 => 186,  520 => 185,  516 => 184,  513 => 183,  505 => 177,  501 => 176,  497 => 175,  493 => 174,  489 => 173,  485 => 172,  481 => 171,  475 => 170,  469 => 166,  461 => 160,  457 => 159,  453 => 158,  448 => 156,  440 => 150,  437 => 148,  431 => 144,  422 => 143,  413 => 142,  404 => 141,  396 => 140,  390 => 136,  387 => 135,  379 => 128,  376 => 127,  369 => 123,  364 => 122,  362 => 121,  359 => 120,  355 => 118,  353 => 117,  348 => 115,  342 => 111,  339 => 110,  332 => 106,  327 => 105,  325 => 104,  322 => 103,  318 => 101,  316 => 100,  311 => 98,  303 => 92,  296 => 86,  293 => 85,  281 => 84,  279 => 83,  273 => 80,  268 => 78,  261 => 74,  255 => 71,  251 => 70,  246 => 68,  239 => 64,  232 => 60,  226 => 57,  222 => 56,  218 => 55,  214 => 54,  210 => 53,  206 => 52,  202 => 51,  198 => 50,  194 => 49,  188 => 45,  185 => 43,  178 => 42,  173 => 38,  167 => 37,  162 => 36,  157 => 35,  151 => 34,  146 => 33,  141 => 32,  138 => 31,  128 => 30,  125 => 29,  122 => 27,  119 => 26,  117 => 25,  106 => 17,  103 => 16,  88 => 13,  83 => 12,  79 => 11,  73 => 8,  69 => 6,  62 => 5,  51 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "crud_user/check_user.html.twig", "/home/runner/workspace/repos/dressur_api/templates/crud_user/check_user.html.twig");
    }
}
