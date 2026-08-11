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

/* private/index_admin.html.twig */
class __TwigTemplate_777cd21073b7d266511d3f14255300d9 extends Template
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
        yield "ADMIN DASHBOARD";
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
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "flashes", [], "any", false, false, false, 6));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 7
            yield "        <div class=\"alert alert-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield " mb-5\">
            ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 9
                yield "                <p>";
                yield $context["message"];
                yield "</p>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            yield "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        yield "
    ";
        // line 23
        yield "    <div class=\"row g-2 mb-2 row-cols-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5\">

        ";
        // line 26
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Solde</p>
                            <h4 class=\"my-1\">
                                <span class=\"";
        // line 33
        if ((($context["soldeZefame"] ?? null) <= 5)) {
            yield "text-danger";
        } elseif ((($context["soldeZefame"] ?? null) <= 10)) {
            yield "text-warning";
        } else {
            yield "text-success";
        }
        yield "\">
                                    ";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(($context["soldeZefame"] ?? null), 2, ".", " "), "html", null, true);
        yield " €
                                </span>
                            </h4>
                            <p class=\"mb-0 font-13 text-secondary\">Solde API PRS</p>
                        </div>
                        <div class=\"widget-icon-large ";
        // line 39
        if ((($context["soldeZefame"] ?? null) <= 5)) {
            yield "bg-danger";
        } elseif ((($context["soldeZefame"] ?? null) <= 10)) {
            yield "bg-warning";
        } else {
            yield "bg-success";
        }
        yield " text-white ms-auto\">
                            <i class=\"fas fa-euro-sign\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 48
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Inscrits</p>
                            <h4 class=\"my-1\">";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nbr_user"] ?? null), "html", null, true);
        yield " <span class=\"text-secondary\" style=\"font-size:.85rem\">|</span> ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["nbr_user_bot"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Réels&nbsp;|&nbsp;Bots</p>
                        </div>
                        <div class=\"widget-icon-large bg-primary text-white ms-auto\">
                            <i class=\"fas fa-users\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 66
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <p class=\"mb-0\">
                        ";
        // line 70
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["topPays"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 71
            yield "                            ";
            $context["colors"] = ["bg-primary", "bg-success", "bg-warning", "bg-info", "bg-secondary", "bg-danger", "bg-dark"];
            // line 72
            yield "                            <span class=\"badge ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = ($context["colors"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 72)] ?? null) : null), "html", null, true);
            yield " text-white me-1 mb-1\" style=\"font-size:.80rem;font-weight:500;\">
                                +";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pays", [], "any", false, false, false, 73), "html", null, true);
            yield " &middot; ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "nbr", [], "any", false, false, false, 73), "html", null, true);
            yield "
                            </span>
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
        // line 75
        if (!$context['_iterated']) {
            // line 76
            yield "                            <p class=\"mb-0 text-secondary\" style=\"font-size:.8rem;\">Aucune donnée</p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['row'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        yield "                    </p>
                </div>
            </div>
        </div>

        ";
        // line 84
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">En attente</p>
                            <h4 class=\"my-1 ";
        // line 90
        if ((($context["valid_promo_affaire"] ?? null) > 0)) {
            yield "text-warning";
        }
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["valid_promo_affaire"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Validation P. Affaire</p>
                        </div>
                        <div class=\"widget-icon-large bg-warning text-white ms-auto\">
                            <a href=\"";
        // line 94
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_promo_en_attente");
        yield "\" class=\"text-white\"><i class=\"fas fa-hourglass-half\"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 102
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">En attente</p>
                            <h4 class=\"my-1 ";
        // line 108
        if ((($context["valid_promo_reseau"] ?? null) > 0)) {
            yield "text-warning";
        }
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["valid_promo_reseau"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Validation P. Réseau</p>
                        </div>
                        <div class=\"widget-icon-large bg-warning text-white ms-auto\">
                            <a href=\"";
        // line 112
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_promo_reseau_en_attente");
        yield "\" class=\"text-white\"><i class=\"fas fa-hourglass-half\"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 120
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">En cours</p>
                            <h4 class=\"my-1 text-primary\">";
        // line 126
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["encour_boost"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Boost Contact</p>
                        </div>
                        <div class=\"widget-icon-large bg-primary text-white ms-auto\">
                            <i class=\"fas fa-bolt\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 138
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Programmé</p>
                            <h4 class=\"my-1 text-info\">";
        // line 144
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["programmer_boost"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Boost Contact</p>
                        </div>
                        <div class=\"widget-icon-large bg-info text-white ms-auto\">
                            <i class=\"fas fa-calendar-check\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 156
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">En cours</p>
                            <h4 class=\"my-1 text-info\">";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["encour_affaire"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Promo Affaire</p>
                        </div>
                        <div class=\"widget-icon-large bg-info text-white ms-auto\">
                            <i class=\"fas fa-briefcase\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 174
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Programme</p>
                            <h4 class=\"my-1 text-success\">";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["users_prog_recomp"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Récompenses</p>
                        </div>
                        <div class=\"widget-icon-large bg-success text-white ms-auto\">
                            <i class=\"fas fa-trophy\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 192
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Vendeurs</p>
                            <h4 class=\"my-1\">";
        // line 198
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["users_vendeur"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Compte vendeur</p>
                        </div>
                        <div class=\"widget-icon-large bg-secondary text-white ms-auto\">
                            <i class=\"fas fa-store\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 210
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Promo Affaire</p>
                            <h4 class=\"my-1 text-success\">";
        // line 216
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["p_aff_recomp"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Prog. Récompenses</p>
                        </div>
                        <div class=\"widget-icon-large bg-success text-white ms-auto\">
                            <i class=\"fas fa-trophy\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 228
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Promo Affaire</p>
                            <h4 class=\"my-1 text-success\">";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["p_aff_ds_statut"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">DS Statut</p>
                        </div>
                        <div class=\"widget-icon-large bg-success text-white ms-auto\">
                            <i class=\"fas fa-circle-check\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 246
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Supprimés</p>
                            <h4 class=\"my-1 text-danger\">";
        // line 252
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["deleted_users"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Comptes</p>
                        </div>
                        <div class=\"widget-icon-large bg-danger text-white ms-auto\">
                            <i class=\"fas fa-user-minus\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 264
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Bannis</p>
                            <h4 class=\"my-1 text-danger\">";
        // line 270
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["banned_users"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Comptes</p>
                        </div>
                        <div class=\"widget-icon-large bg-danger text-white ms-auto\">
                            <i class=\"fas fa-ban\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 282
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Sans service</p>
                            <h4 class=\"my-1 text-warning\">";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["users_inactifs"] ?? null), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">Aucune utilisation</p>
                        </div>
                        <a href=\"";
        // line 291
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_sans_service");
        yield "\" class=\"widget-icon-large bg-warning text-white ms-auto text-decoration-none\" title=\"Voir la liste\">
                            <i class=\"fas fa-user-clock\"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Graphique évolution 30 jours -->
    <div class=\"mt-4 mb-2\">
        <h6 class=\"text-secondary fw-semibold mb-2\"><i class=\"bi bi-graph-up me-1\"></i>Évolution sur 30 jours</h6>
    </div>
    <div class=\"card radius-10 mb-3\">
        <div class=\"card-body\">
            <canvas id=\"evolutionChart\" style=\"max-height: 380px;\"></canvas>
        </div>
    </div>

    ";
        // line 312
        yield "    <div class=\"row g-2 mb-2\">
        <div class=\"col-12\">
            <p class=\"mb-1 text-secondary fw-semibold\" style=\"font-size:.85rem;letter-spacing:.04em;\">
                <i class=\"fas fa-calendar-week me-1\"></i> TRANSACTIONS APPROUVÉES — 4 DERNIÈRES SEMAINES
            </p>
        </div>
    </div>
    <div class=\"row g-2 mb-4 row-cols-2 row-cols-md-4\">
        ";
        // line 320
        $context["weekColors"] = ["#4e73df", "#1cc88a", "#f6a21e", "#9b59b6"];
        // line 321
        yield "        ";
        $context["weekBgs"] = ["bg-primary", "bg-success", "bg-warning", "bg-secondary"];
        // line 322
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["weeklyTransactions"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["week"]) {
            // line 323
            yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid ";
            // line 324
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v1 = ($context["weekColors"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 324)] ?? null) : null), "html", null, true);
            yield ";\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-start justify-content-between\">
                        <div>
                            <p class=\"mb-0 fw-semibold\" style=\"font-size:.8rem;color:";
            // line 328
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v2 = ($context["weekColors"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2[CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 328)] ?? null) : null), "html", null, true);
            yield ";\">
                                ";
            // line 329
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["week"], "label", [], "any", false, false, false, 329), "html", null, true);
            yield "
                            </p>
                            <p class=\"mb-1 text-secondary\" style=\"font-size:.72rem;\">
                                ";
            // line 332
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["week"], "dateStart", [], "any", false, false, false, 332), "html", null, true);
            yield " → ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["week"], "dateEnd", [], "any", false, false, false, 332), "html", null, true);
            yield "
                            </p>
                            <h4 class=\"my-1 fw-bold\" style=\"color:";
            // line 334
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v3 = ($context["weekColors"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3[CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 334)] ?? null) : null), "html", null, true);
            yield ";\">
                                ";
            // line 335
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["week"], "total", [], "any", false, false, false, 335), 0, ",", " "), "html", null, true);
            yield "
                                <span class=\"text-secondary\" style=\"font-size:.7rem;font-weight:400;\">FCFA</span>
                            </h4>
                            <p class=\"mb-0 font-13 text-secondary\">
                                <i class=\"fas fa-check-circle text-success me-1\" style=\"font-size:.75rem;\"></i>
                                ";
            // line 340
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["week"], "nbr", [], "any", false, false, false, 340), "html", null, true);
            yield " transaction";
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["week"], "nbr", [], "any", false, false, false, 340) > 1)) ? ("s") : (""));
            yield "
                            </p>
                        </div>
                        <div class=\"widget-icon ";
            // line 343
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v4 = ($context["weekBgs"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4[CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 343)] ?? null) : null), "html", null, true);
            yield " text-white ms-2\" style=\"width:38px;height:38px;min-width:38px;border-radius:8px;display:flex;align-items:center;justify-content:center;\">
                            <i class=\"fas fa-calendar-check\" style=\"font-size:.9rem;\"></i>
                        </div>
                    </div>
                </div>
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
        unset($context['_seq'], $context['_key'], $context['week'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 351
        yield "    </div>

    ";
        // line 354
        yield "    <div class=\"row g-2 mb-2\">
        <div class=\"col-12\">
            <p class=\"mb-1 text-secondary fw-semibold\" style=\"font-size:.85rem;letter-spacing:.04em;\">
                <i class=\"fas fa-chart-bar me-1\"></i> TRANSACTIONS APPROUVÉES — COMPARAISON MENSUELLE
            </p>
        </div>
    </div>
    <div class=\"row g-2 mb-4 row-cols-1 row-cols-md-3\">

        ";
        // line 364
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #1cc88a;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\" style=\"font-size:.8rem;\">Mois en cours</p>
                            <p class=\"mb-1 fw-semibold\" style=\"font-size:.75rem;color:#1cc88a;\">
                                ";
        // line 371
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "current", [], "any", false, false, false, 371), "label", [], "any", false, false, false, 371), "html", null, true);
        yield "
                            </p>
                            <h4 class=\"my-1 fw-bold\" style=\"color:#1cc88a;\">
                                ";
        // line 374
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "current", [], "any", false, false, false, 374), "total", [], "any", false, false, false, 374), 0, ",", " "), "html", null, true);
        yield "
                                <span class=\"text-secondary\" style=\"font-size:.7rem;font-weight:400;\">FCFA</span>
                            </h4>
                            <p class=\"mb-0 font-13 text-secondary\">
                                <i class=\"fas fa-check-circle text-success me-1\" style=\"font-size:.75rem;\"></i>
                                ";
        // line 379
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "current", [], "any", false, false, false, 379), "nbr", [], "any", false, false, false, 379), "html", null, true);
        yield " transaction";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "current", [], "any", false, false, false, 379), "nbr", [], "any", false, false, false, 379) > 1)) ? ("s") : (""));
        yield "
                            </p>
                        </div>
                        <div class=\"widget-icon-large bg-success text-white ms-auto\">
                            <i class=\"fas fa-calendar-alt\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 391
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #858796;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\" style=\"font-size:.8rem;\">Mois précédent</p>
                            <p class=\"mb-1 fw-semibold\" style=\"font-size:.75rem;color:#858796;\">
                                ";
        // line 398
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "previous", [], "any", false, false, false, 398), "label", [], "any", false, false, false, 398), "html", null, true);
        yield "
                            </p>
                            <h4 class=\"my-1 fw-bold text-secondary\">
                                ";
        // line 401
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "previous", [], "any", false, false, false, 401), "total", [], "any", false, false, false, 401), 0, ",", " "), "html", null, true);
        yield "
                                <span class=\"text-secondary\" style=\"font-size:.7rem;font-weight:400;\">FCFA</span>
                            </h4>
                            <p class=\"mb-0 font-13 text-secondary\">
                                <i class=\"fas fa-check-circle text-success me-1\" style=\"font-size:.75rem;\"></i>
                                ";
        // line 406
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "previous", [], "any", false, false, false, 406), "nbr", [], "any", false, false, false, 406), "html", null, true);
        yield " transaction";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "previous", [], "any", false, false, false, 406), "nbr", [], "any", false, false, false, 406) > 1)) ? ("s") : (""));
        yield "
                            </p>
                        </div>
                        <div class=\"widget-icon-large bg-secondary text-white ms-auto\">
                            <i class=\"fas fa-calendar\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ";
        // line 418
        yield "        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\"
                 style=\"border-left:4px solid ";
        // line 420
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "isBetter", [], "any", false, false, false, 420)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "#1cc88a";
        } else {
            yield "#e74a3b";
        }
        yield ";\">
                <div class=\"card-body d-flex flex-column justify-content-center\">
                    <p class=\"mb-1 text-secondary\" style=\"font-size:.8rem;\">Comparaison</p>
                    ";
        // line 423
        if ((($tmp =  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "variation", [], "any", false, false, false, 423))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 424
            yield "                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "isBetter", [], "any", false, false, false, 424)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 425
                yield "                            <h3 class=\"fw-bold mb-1\" style=\"color:#1cc88a;\">
                                <i class=\"fas fa-arrow-up me-1\"></i>+";
                // line 426
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "variation", [], "any", false, false, false, 426), "html", null, true);
                yield "%
                            </h3>
                            <p class=\"mb-0 font-13 text-success fw-semibold\">
                                Ce mois est meilleur que le précédent
                            </p>
                        ";
            } else {
                // line 432
                yield "                            <h3 class=\"fw-bold mb-1\" style=\"color:#e74a3b;\">
                                <i class=\"fas fa-arrow-down me-1\"></i>";
                // line 433
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "variation", [], "any", false, false, false, 433), "html", null, true);
                yield "%
                            </h3>
                            <p class=\"mb-0 font-13 text-danger fw-semibold\">
                                Ce mois est en dessous du précédent
                            </p>
                        ";
            }
            // line 439
            yield "                        <p class=\"mb-0 font-13 text-secondary mt-1\">
                            Écart :
                            ";
            // line 441
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(abs((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "current", [], "any", false, false, false, 441), "total", [], "any", false, false, false, 441) - CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["monthlyTransactions"] ?? null), "previous", [], "any", false, false, false, 441), "total", [], "any", false, false, false, 441))), 0, ",", " "), "html", null, true);
            yield " FCFA
                        </p>
                    ";
        } else {
            // line 444
            yield "                        <h3 class=\"fw-bold mb-1 text-secondary\">—</h3>
                        <p class=\"mb-0 font-13 text-secondary\">Pas encore de données comparatives</p>
                    ";
        }
        // line 447
        yield "                </div>
            </div>
        </div>

    </div>

    <!-- Performances du mois (30 j vs 30 j précédents) -->
    <div class=\"mt-2 mb-2\">
        <h6 class=\"text-secondary fw-semibold mb-2\"><i class=\"bi bi-bar-chart-steps me-1\"></i>Performances du mois</h6>
    </div>
    <div class=\"row g-2 mb-4\">
        ";
        // line 458
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["chartSummary"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 459
            yield "        <div class=\"col-12 col-sm-6 col-xl-3\">
            <div class=\"card radius-10 h-100\" style=\"border-left: 4px solid ";
            // line 460
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "color", [], "any", false, false, false, 460), "html", null, true);
            yield ";\">
                <div class=\"card-body py-3\">
                    <div class=\"d-flex align-items-center mb-2\">
                        <i class=\"";
            // line 463
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 463), "html", null, true);
            yield " me-2\" style=\"color:";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "color", [], "any", false, false, false, 463), "html", null, true);
            yield ";font-size:1.1rem;\"></i>
                        <span class=\"text-secondary small fw-semibold\">";
            // line 464
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 464), "html", null, true);
            yield "</span>
                    </div>
                    <div class=\"d-flex align-items-end justify-content-between\">
                        <div>
                            <div class=\"fs-3 fw-bold\" style=\"color:";
            // line 468
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "color", [], "any", false, false, false, 468), "html", null, true);
            yield ";\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "current", [], "any", false, false, false, 468), "html", null, true);
            yield "</div>
                            <div class=\"text-secondary\" style=\"font-size:.75rem;\">30 derniers jours</div>
                        </div>
                        <div class=\"text-end\">
                            ";
            // line 472
            if ((null === CoreExtension::getAttribute($this->env, $this->source, $context["item"], "variation", [], "any", false, false, false, 472))) {
                // line 473
                yield "                                <span class=\"badge bg-secondary\">–</span>
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 474
$context["item"], "variation", [], "any", false, false, false, 474) > 0)) {
                // line 475
                yield "                                <span class=\"badge bg-success\"><i class=\"bi bi-arrow-up-short\"></i> +";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "variation", [], "any", false, false, false, 475), "html", null, true);
                yield "%</span>
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 476
$context["item"], "variation", [], "any", false, false, false, 476) < 0)) {
                // line 477
                yield "                                <span class=\"badge bg-danger\"><i class=\"bi bi-arrow-down-short\"></i> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "variation", [], "any", false, false, false, 477), "html", null, true);
                yield "%</span>
                            ";
            } else {
                // line 479
                yield "                                <span class=\"badge bg-secondary\">0%</span>
                            ";
            }
            // line 481
            yield "                            <div class=\"text-secondary mt-1\" style=\"font-size:.72rem;\">vs ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "previous", [], "any", false, false, false, 481), "html", null, true);
            yield " période préc.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 488
        yield "    </div>

    <!-- Répartition par source -->
    <div class=\"mt-3 mb-2\">
        <h6 class=\"text-secondary fw-semibold mb-2\"><i class=\"bi bi-bar-chart-fill me-1\"></i>Répartition par source</h6>
    </div>
    <div class=\"row g-2 row-cols-1 row-cols-md-3 row-cols-xl-5 mb-4\">
        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\">
                <div class=\"card-body p-3\">
                    <a href=\"";
        // line 498
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
        yield "\" class=\"text-decoration-none\">
                        <p class=\"mb-2 text-secondary small fw-semibold\">Users</p>
                    </a>
                    <div class=\"d-flex flex-wrap gap-1\">
                        <a href=\"";
        // line 502
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index");
        yield "\" class=\"badge bg-dark text-white text-decoration-none\" style=\"font-size:.8rem\">Tous ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["userSourceCounts"] ?? null), "total", [], "any", false, false, false, 502), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 503
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "mobile"]);
        yield "\" class=\"badge bg-warning text-dark text-decoration-none\" style=\"font-size:.8rem\">mobile ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["userSourceCounts"] ?? null), "mobile", [], "any", false, false, false, 503), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 504
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "web"]);
        yield "\" class=\"badge bg-primary text-white text-decoration-none\" style=\"font-size:.8rem\">web ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["userSourceCounts"] ?? null), "web", [], "any", false, false, false, 504), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 505
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_user_index", ["source" => "none"]);
        yield "\" class=\"badge bg-secondary text-white text-decoration-none\" style=\"font-size:.8rem\">none ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["userSourceCounts"] ?? null), "none", [], "any", false, false, false, 505), "html", null, true);
        yield "</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\">
                <div class=\"card-body p-3\">
                    <a href=\"";
        // line 513
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index");
        yield "\" class=\"text-decoration-none\">
                        <p class=\"mb-2 text-secondary small fw-semibold\">Promotions</p>
                    </a>
                    <div class=\"d-flex flex-wrap gap-1\">
                        <a href=\"";
        // line 517
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index");
        yield "\" class=\"badge bg-dark text-white text-decoration-none\" style=\"font-size:.8rem\">Tous ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotionSourceCounts"] ?? null), "total", [], "any", false, false, false, 517), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 518
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "mobile"]);
        yield "\" class=\"badge bg-warning text-dark text-decoration-none\" style=\"font-size:.8rem\">mobile ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotionSourceCounts"] ?? null), "mobile", [], "any", false, false, false, 518), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 519
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "web"]);
        yield "\" class=\"badge bg-primary text-white text-decoration-none\" style=\"font-size:.8rem\">web ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotionSourceCounts"] ?? null), "web", [], "any", false, false, false, 519), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 520
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promotion_index", ["source" => "none"]);
        yield "\" class=\"badge bg-secondary text-white text-decoration-none\" style=\"font-size:.8rem\">none ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promotionSourceCounts"] ?? null), "none", [], "any", false, false, false, 520), "html", null, true);
        yield "</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\">
                <div class=\"card-body p-3\">
                    <a href=\"";
        // line 528
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index");
        yield "\" class=\"text-decoration-none\">
                        <p class=\"mb-2 text-secondary small fw-semibold\">Promo Réseau</p>
                    </a>
                    <div class=\"d-flex flex-wrap gap-1\">
                        <a href=\"";
        // line 532
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index");
        yield "\" class=\"badge bg-dark text-white text-decoration-none\" style=\"font-size:.8rem\">Tous ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promoReseauSourceCounts"] ?? null), "total", [], "any", false, false, false, 532), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 533
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "mobile"]);
        yield "\" class=\"badge bg-warning text-dark text-decoration-none\" style=\"font-size:.8rem\">mobile ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promoReseauSourceCounts"] ?? null), "mobile", [], "any", false, false, false, 533), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 534
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "web"]);
        yield "\" class=\"badge bg-primary text-white text-decoration-none\" style=\"font-size:.8rem\">web ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promoReseauSourceCounts"] ?? null), "web", [], "any", false, false, false, 534), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 535
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_promo_reseau_index", ["source" => "none"]);
        yield "\" class=\"badge bg-secondary text-white text-decoration-none\" style=\"font-size:.8rem\">none ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["promoReseauSourceCounts"] ?? null), "none", [], "any", false, false, false, 535), "html", null, true);
        yield "</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\">
                <div class=\"card-body p-3\">
                    <a href=\"";
        // line 543
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\" class=\"text-decoration-none\">
                        <p class=\"mb-2 text-secondary small fw-semibold\">Boosts</p>
                    </a>
                    <div class=\"d-flex flex-wrap gap-1\">
                        <a href=\"";
        // line 547
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index");
        yield "\" class=\"badge bg-dark text-white text-decoration-none\" style=\"font-size:.8rem\">Tous ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boostSourceCounts"] ?? null), "total", [], "any", false, false, false, 547), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 548
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "mobile"]);
        yield "\" class=\"badge bg-warning text-dark text-decoration-none\" style=\"font-size:.8rem\">mobile ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boostSourceCounts"] ?? null), "mobile", [], "any", false, false, false, 548), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 549
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "web"]);
        yield "\" class=\"badge bg-primary text-white text-decoration-none\" style=\"font-size:.8rem\">web ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boostSourceCounts"] ?? null), "web", [], "any", false, false, false, 549), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 550
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_boost_index", ["source" => "none"]);
        yield "\" class=\"badge bg-secondary text-white text-decoration-none\" style=\"font-size:.8rem\">none ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["boostSourceCounts"] ?? null), "none", [], "any", false, false, false, 550), "html", null, true);
        yield "</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\">
                <div class=\"card-body p-3\">
                    <a href=\"";
        // line 558
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index");
        yield "\" class=\"text-decoration-none\">
                        <p class=\"mb-2 text-secondary small fw-semibold\">Transactions</p>
                    </a>
                    <div class=\"d-flex flex-wrap gap-1\">
                        <a href=\"";
        // line 562
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index");
        yield "\" class=\"badge bg-dark text-white text-decoration-none\" style=\"font-size:.8rem\">Tous ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transactionSourceCounts"] ?? null), "total", [], "any", false, false, false, 562), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 563
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "mobile"]);
        yield "\" class=\"badge bg-warning text-dark text-decoration-none\" style=\"font-size:.8rem\">mobile ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transactionSourceCounts"] ?? null), "mobile", [], "any", false, false, false, 563), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 564
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "web"]);
        yield "\" class=\"badge bg-primary text-white text-decoration-none\" style=\"font-size:.8rem\">web ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transactionSourceCounts"] ?? null), "web", [], "any", false, false, false, 564), "html", null, true);
        yield "</a>
                        <a href=\"";
        // line 565
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_crud_transaction_index", ["source" => "none"]);
        yield "\" class=\"badge bg-secondary text-white text-decoration-none\" style=\"font-size:.8rem\">none ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["transactionSourceCounts"] ?? null), "none", [], "any", false, false, false, 565), "html", null, true);
        yield "</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    ";
        // line 574
        yield "    <div class=\"row g-2 mb-4 row-cols-1 row-cols-sm-2 row-cols-xl-4\">

        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #0d6efd;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Boost Contact</p>
                            <h4 class=\"my-1\" style=\"color:#0d6efd;\">";
        // line 582
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (($_v5 = ($context["revenueByService"] ?? null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5["boost_contact"] ?? null) : null), "total", [], "any", false, false, false, 582), 0, ",", " "), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">";
        // line 583
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v6 = ($context["revenueByService"] ?? null)) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6["boost_contact"] ?? null) : null), "nbr", [], "any", false, false, false, 583), "html", null, true);
        yield " transactions</p>
                        </div>
                        <div class=\"widget-icon-large bg-primary text-white ms-auto\">
                            <i class=\"fas fa-bolt\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #17ad37;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Promo Affaire</p>
                            <h4 class=\"my-1\" style=\"color:#17ad37;\">";
        // line 599
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (($_v7 = ($context["revenueByService"] ?? null)) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7["boost_affaire"] ?? null) : null), "total", [], "any", false, false, false, 599), 0, ",", " "), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">";
        // line 600
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v8 = ($context["revenueByService"] ?? null)) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8["boost_affaire"] ?? null) : null), "nbr", [], "any", false, false, false, 600), "html", null, true);
        yield " transactions</p>
                        </div>
                        <div class=\"widget-icon-large bg-success text-white ms-auto\">
                            <i class=\"fas fa-briefcase\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #f7971e;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Re-Boost Affaire</p>
                            <h4 class=\"my-1\" style=\"color:#f7971e;\">";
        // line 616
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (($_v9 = ($context["revenueByService"] ?? null)) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9["re_boost_affaire"] ?? null) : null), "total", [], "any", false, false, false, 616), 0, ",", " "), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">";
        // line 617
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v10 = ($context["revenueByService"] ?? null)) && is_array($_v10) || $_v10 instanceof ArrayAccess ? ($_v10["re_boost_affaire"] ?? null) : null), "nbr", [], "any", false, false, false, 617), "html", null, true);
        yield " transactions</p>
                        </div>
                        <div class=\"widget-icon-large bg-warning text-white ms-auto\">
                            <i class=\"fas fa-redo\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col\">
            <div class=\"card radius-10 mb-0 h-100\" style=\"border-left:4px solid #00c6fb;\">
                <div class=\"card-body\">
                    <div class=\"d-flex align-items-center\">
                        <div>
                            <p class=\"mb-0 text-secondary\">Réseaux Sociaux</p>
                            <h4 class=\"my-1\" style=\"color:#00c6fb;\">";
        // line 633
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (($_v11 = ($context["revenueByService"] ?? null)) && is_array($_v11) || $_v11 instanceof ArrayAccess ? ($_v11["boost_reseau_sociaux"] ?? null) : null), "total", [], "any", false, false, false, 633), 0, ",", " "), "html", null, true);
        yield "</h4>
                            <p class=\"mb-0 font-13 text-secondary\">";
        // line 634
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (($_v12 = ($context["revenueByService"] ?? null)) && is_array($_v12) || $_v12 instanceof ArrayAccess ? ($_v12["boost_reseau_sociaux"] ?? null) : null), "nbr", [], "any", false, false, false, 634), "html", null, true);
        yield " transactions</p>
                        </div>
                        <div class=\"widget-icon-large bg-info text-white ms-auto\">
                            <i class=\"fas fa-share-alt\"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    ";
        // line 647
        yield "    ";
        $context["servicesTables"] = [["id" => "tbl-boost-contact", "title" => "Boost Contact", "color" => "#0d6efd", "rows" =>         // line 648
($context["topUsersBoostContact"] ?? null)], ["id" => "tbl-promo-affaire", "title" => "Promo Affaire (Boost + Re-Boost)", "color" => "#17ad37", "rows" =>         // line 649
($context["topUsersPromoAffaire"] ?? null)], ["id" => "tbl-reseau-sociaux", "title" => "Réseaux Sociaux", "color" => "#00c6fb", "rows" =>         // line 650
($context["topUsersReseauxSociaux"] ?? null)]];
        // line 652
        yield "
    ";
        // line 653
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["servicesTables"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["svc"]) {
            // line 654
            yield "    <div class=\"card radius-10 mb-4\">
        <div class=\"card-body\">
            <div class=\"d-flex align-items-center justify-content-between mb-3\">
                <h6 class=\"mb-0 fw-semibold\" style=\"color:";
            // line 657
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "color", [], "any", false, false, false, 657), "html", null, true);
            yield ";\">
                    <i class=\"fas fa-trophy me-1\"></i> Top utilisateurs — ";
            // line 658
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "title", [], "any", false, false, false, 658), "html", null, true);
            yield "
                </h6>
                <div class=\"d-flex align-items-center gap-2\">
                    <label class=\"mb-0 text-secondary small\">Afficher</label>
                    <input type=\"number\"
                           class=\"form-control form-control-sm top-limit-input\"
                           data-table=\"";
            // line 664
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "id", [], "any", false, false, false, 664), "html", null, true);
            yield "\"
                           value=\"10\" min=\"1\" max=\"";
            // line 665
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "rows", [], "any", false, false, false, 665)), "html", null, true);
            yield "\"
                           style=\"width:70px;\">
                    <span class=\"text-secondary small\">/ ";
            // line 667
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "rows", [], "any", false, false, false, 667)), "html", null, true);
            yield " chargés</span>
                </div>
            </div>

            ";
            // line 671
            if (Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "rows", [], "any", false, false, false, 671))) {
                // line 672
                yield "                <p class=\"text-secondary small mb-0\">Aucune donnée.</p>
            ";
            } else {
                // line 674
                yield "            <div class=\"table-responsive\">
                <table class=\"table table-hover table-sm align-middle mb-0\" id=\"";
                // line 675
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "id", [], "any", false, false, false, 675), "html", null, true);
                yield "\">
                    <thead class=\"table-light\">
                        <tr>
                            <th>#</th>
                            <th>Pseudo</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Mail</th>
                            <th class=\"text-end\">Montant dépensé</th>
                            <th class=\"text-center\">Transactions</th>
                            <th>Création compte</th>
                            <th>Dernière connexion</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
                // line 690
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "rows", [], "any", false, false, false, 690));
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
                foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                    // line 691
                    yield "                        <tr class=\"top-row\">
                            <td>
                                ";
                    // line 693
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 693) == 1)) {
                        // line 694
                        yield "                                    <span class=\"badge bg-warning text-dark\">🥇 1</span>
                                ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 695
$context["loop"], "index", [], "any", false, false, false, 695) == 2)) {
                        // line 696
                        yield "                                    <span class=\"badge bg-secondary\">🥈 2</span>
                                ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source,                     // line 697
$context["loop"], "index", [], "any", false, false, false, 697) == 3)) {
                        // line 698
                        yield "                                    <span class=\"badge bg-danger\">🥉 3</span>
                                ";
                    } else {
                        // line 700
                        yield "                                    <span class=\"text-secondary\">";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 700), "html", null, true);
                        yield "</span>
                                ";
                    }
                    // line 702
                    yield "                            </td>
                            <td class=\"fw-semibold\">";
                    // line 703
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pseudo", [], "any", true, true, false, 703) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pseudo", [], "any", false, false, false, 703)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pseudo", [], "any", false, false, false, 703), "html", null, true)) : ("—"));
                    yield "</td>
                            <td>";
                    // line 704
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "nom", [], "any", true, true, false, 704) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["row"], "nom", [], "any", false, false, false, 704)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "nom", [], "any", false, false, false, 704), "html", null, true)) : ("—"));
                    yield "</td>
                            <td class=\"text-nowrap\">
                                ";
                    // line 706
                    if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pays", [], "any", false, false, false, 706)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        yield "+";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "pays", [], "any", false, false, false, 706), "html", null, true);
                    }
                    // line 707
                    yield "                                ";
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "tel", [], "any", true, true, false, 707) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["row"], "tel", [], "any", false, false, false, 707)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "tel", [], "any", false, false, false, 707), "html", null, true)) : ("—"));
                    yield "
                            </td>
                            <td>";
                    // line 709
                    yield (((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "mail", [], "any", true, true, false, 709) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["row"], "mail", [], "any", false, false, false, 709)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "mail", [], "any", false, false, false, 709), "html", null, true)) : ("—"));
                    yield "</td>
                            <td class=\"text-end fw-bold\" style=\"color:";
                    // line 710
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["svc"], "color", [], "any", false, false, false, 710), "html", null, true);
                    yield ";\">
                                ";
                    // line 711
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "total", [], "any", false, false, false, 711), 0, ",", " "), "html", null, true);
                    yield "
                            </td>
                            <td class=\"text-center\">
                                <span class=\"badge bg-warning border\">";
                    // line 714
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "nbr_tx", [], "any", false, false, false, 714), "html", null, true);
                    yield "</span>
                            </td>
                            <td class=\"text-nowrap small text-secondary\">
                                ";
                    // line 717
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["row"], "created_at", [], "any", false, false, false, 717)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "created_at", [], "any", false, false, false, 717), "d/m/Y"), "html", null, true)) : ("—"));
                    yield "
                            </td>
                            <td class=\"text-nowrap small text-secondary\">
                                ";
                    // line 720
                    yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["row"], "last_login", [], "any", false, false, false, 720)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "last_login", [], "any", false, false, false, 720), "d/m/Y H:i"), "html", null, true)) : ("—"));
                    yield "
                            </td>
                        </tr>
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
                unset($context['_seq'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 724
                yield "                    </tbody>
                </table>
            </div>
            ";
            }
            // line 728
            yield "        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['svc'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 731
        yield "
";
        yield from [];
    }

    // line 734
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 735
        yield "<script src=\"https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js\"></script>
<script>
(function () {
    var labels        = ";
        // line 738
        yield json_encode(($context["chartLabels"] ?? null));
        yield ";
    var users         = ";
        // line 739
        yield json_encode(($context["chartUsers"] ?? null));
        yield ";
    var boostsGratuit = ";
        // line 740
        yield json_encode(($context["chartBoostsGratuit"] ?? null));
        yield ";
    var boostsPayant  = ";
        // line 741
        yield json_encode(($context["chartBoostsPayant"] ?? null));
        yield ";
    var promoAff      = ";
        // line 742
        yield json_encode(($context["chartPromoAff"] ?? null));
        yield ";
    var promoRes      = ";
        // line 743
        yield json_encode(($context["chartPromoRes"] ?? null));
        yield ";

    var shortLabels = labels.map(function(d) {
        var parts = d.split(\x27-\x27);
        return parts[2] + \x27/\x27 + parts[1];
    });

    var ctx = document.getElementById(\x27evolutionChart\x27).getContext(\x272d\x27);
    new Chart(ctx, {
        type: \x27line\x27,
        data: {
            labels: shortLabels,
            datasets: [
                {
                    label: \x27Inscriptions utilisateurs\x27,
                    data: users,
                    borderColor: \x27#4e73df\x27,
                    backgroundColor: \x27rgba(78,115,223,0.08)\x27,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.35,
                    fill: true,
                },
                {
                    label: \x27Boost Contact Gratuit\x27,
                    data: boostsGratuit,
                    borderColor: \x27#f6a21e\x27,
                    backgroundColor: \x27rgba(246,162,30,0.08)\x27,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.35,
                    fill: true,
                },
                {
                    label: \x27Boost Contact Payant\x27,
                    data: boostsPayant,
                    borderColor: \x27#e74c3c\x27,
                    backgroundColor: \x27rgba(231,76,60,0.08)\x27,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.35,
                    fill: true,
                },
                {
                    label: \x27Promotion Affaire\x27,
                    data: promoAff,
                    borderColor: \x27#1cc88a\x27,
                    backgroundColor: \x27rgba(28,200,138,0.08)\x27,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.35,
                    fill: true,
                },
                {
                    label: \x27Promo Réseau Sociaux\x27,
                    data: promoRes,
                    borderColor: \x27#9b59b6\x27,
                    backgroundColor: \x27rgba(155,89,182,0.08)\x27,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.35,
                    fill: true,
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: \x27index\x27,
                intersect: false,
            },
            plugins: {
                legend: {
                    position: \x27top\x27,
                    labels: { usePointStyle: true, padding: 16 }
                },
                tooltip: {
                    callbacks: {
                        title: function(items) {
                            return labels[items[0].dataIndex];
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { maxRotation: 45, minRotation: 30 }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: \x27rgba(0,0,0,0.05)\x27 }
                }
            }
        }
    });
})();

// ── Top utilisateurs : affichage dynamique ───────────────────
document.querySelectorAll(\x27.top-limit-input\x27).forEach(function(input) {
    function applyLimit() {
        var tableId = input.getAttribute(\x27data-table\x27);
        var limit   = Math.max(1, parseInt(input.value) || 10);
        var rows    = document.querySelectorAll(\x27#\x27 + tableId + \x27 tbody .top-row\x27);
        rows.forEach(function(row, i) {
            row.style.display = i < limit ? \x27\x27 : \x27none\x27;
        });
    }
    applyLimit();
    input.addEventListener(\x27input\x27, applyLimit);
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
        return "private/index_admin.html.twig";
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
        return array (  1409 => 743,  1405 => 742,  1401 => 741,  1397 => 740,  1393 => 739,  1389 => 738,  1384 => 735,  1377 => 734,  1371 => 731,  1363 => 728,  1357 => 724,  1339 => 720,  1333 => 717,  1327 => 714,  1321 => 711,  1317 => 710,  1313 => 709,  1307 => 707,  1302 => 706,  1297 => 704,  1293 => 703,  1290 => 702,  1284 => 700,  1280 => 698,  1278 => 697,  1275 => 696,  1273 => 695,  1270 => 694,  1268 => 693,  1264 => 691,  1247 => 690,  1229 => 675,  1226 => 674,  1222 => 672,  1220 => 671,  1213 => 667,  1208 => 665,  1204 => 664,  1195 => 658,  1191 => 657,  1186 => 654,  1182 => 653,  1179 => 652,  1177 => 650,  1176 => 649,  1175 => 648,  1173 => 647,  1158 => 634,  1154 => 633,  1135 => 617,  1131 => 616,  1112 => 600,  1108 => 599,  1089 => 583,  1085 => 582,  1075 => 574,  1062 => 565,  1056 => 564,  1050 => 563,  1044 => 562,  1037 => 558,  1024 => 550,  1018 => 549,  1012 => 548,  1006 => 547,  999 => 543,  986 => 535,  980 => 534,  974 => 533,  968 => 532,  961 => 528,  948 => 520,  942 => 519,  936 => 518,  930 => 517,  923 => 513,  910 => 505,  904 => 504,  898 => 503,  892 => 502,  885 => 498,  873 => 488,  859 => 481,  855 => 479,  849 => 477,  847 => 476,  842 => 475,  840 => 474,  837 => 473,  835 => 472,  826 => 468,  819 => 464,  813 => 463,  807 => 460,  804 => 459,  800 => 458,  787 => 447,  782 => 444,  776 => 441,  772 => 439,  763 => 433,  760 => 432,  751 => 426,  748 => 425,  745 => 424,  743 => 423,  733 => 420,  729 => 418,  713 => 406,  705 => 401,  699 => 398,  690 => 391,  674 => 379,  666 => 374,  660 => 371,  651 => 364,  640 => 354,  636 => 351,  614 => 343,  606 => 340,  598 => 335,  594 => 334,  587 => 332,  581 => 329,  577 => 328,  570 => 324,  567 => 323,  549 => 322,  546 => 321,  544 => 320,  534 => 312,  511 => 291,  505 => 288,  497 => 282,  483 => 270,  475 => 264,  461 => 252,  453 => 246,  439 => 234,  431 => 228,  417 => 216,  409 => 210,  395 => 198,  387 => 192,  373 => 180,  365 => 174,  351 => 162,  343 => 156,  329 => 144,  321 => 138,  307 => 126,  299 => 120,  289 => 112,  278 => 108,  270 => 102,  260 => 94,  249 => 90,  241 => 84,  234 => 78,  227 => 76,  225 => 75,  208 => 73,  203 => 72,  200 => 71,  182 => 70,  176 => 66,  160 => 54,  152 => 48,  135 => 39,  127 => 34,  117 => 33,  108 => 26,  104 => 23,  101 => 13,  94 => 11,  85 => 9,  81 => 8,  76 => 7,  71 => 6,  64 => 5,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/index_admin.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/index_admin.html.twig");
    }
}
