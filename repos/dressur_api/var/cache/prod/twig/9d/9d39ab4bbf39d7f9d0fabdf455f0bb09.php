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

/* private/accepterSansSuite.html.twig */
class __TwigTemplate_99661033bbe6631cd28bea5b0ca35f4b extends Template
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
        yield "Accepter Sans Suite";
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
        yield "<div class=\"row g-3\">
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["accepterSansSuite"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["promoaffaire"]) {
            // line 8
            yield "        <div class=\"col-md-4\">
            <div class=\"card mb-0 h-100\">
                ";
            // line 10
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 10) == 0)) {
                $context["bg_badge"] = "bg-danger";
            }
            // line 11
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 11) == 1)) {
                $context["bg_badge"] = "bg-warning";
            }
            // line 12
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 12) == 2)) {
                $context["bg_badge"] = "bg-warning";
            }
            // line 13
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 13) == 3)) {
                $context["bg_badge"] = "bg-success";
            }
            // line 14
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 14) == 4)) {
                $context["bg_badge"] = "bg-success";
            }
            // line 15
            yield "                <img src=\"/promotion/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "image", [], "any", false, false, false, 15), "html", null, true);
            yield "\" alt=\"\" class=\"card-img-top\">
                <div class=\"card-body\">
                    <p class=\"mb-2\">
                        Poster Par : ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "username", [], "any", false, false, false, 18), "html", null, true);
            yield "
                    </p>
                    <span class=\"badge ";
            // line 20
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg_badge"] ?? null), "html", null, true);
            yield " text-white mb-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "status", [], "any", false, false, false, 20), "html", null, true);
            yield "</span>
                    ";
            // line 21
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 21) == 0)) {
                // line 22
                yield "                        <p>
                            Motif : ";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "motif", [], "any", false, false, false, 23), "html", null, true);
                yield "
                        </p>
                        <span class=\"text-success small\">
                            Tenez compte du motif de refus pour soumettre une nouvelle demande. Merci...
                        </span>
                    ";
            } else {
                // line 29
                yield "                        <div class=\"d-flex justify-content-between mb-1\">
                            <div>
                                Impressions : <strong>";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nombreImpression", [], "any", false, false, false, 31), "html", null, true);
                yield "</strong>
                            </div>
                            <div>
                                Vues : <strong>";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "nombreDeVues", [], "any", false, false, false, 34), "html", null, true);
                yield "</strong>
                            </div>
                        </div>                        
                        ";
                // line 37
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 37) == "produit_service")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 37), "html", null, true);
                    yield " </div> ";
                }
                // line 38
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 38) == "offre_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "annotherInfo", [], "any", false, false, false, 38), "description_poste", [], "any", false, false, false, 38), "html", null, true);
                    yield " </div> ";
                }
                // line 39
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "typePromotionAffaire", [], "any", false, false, false, 39) == "dmd_emploi")) {
                    yield " <div class=\"actu-small-description mb-1\"> ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "annotherInfo", [], "any", false, false, false, 39), "description_profil_demandeur", [], "any", false, false, false, 39), "html", null, true);
                    yield " </div> ";
                }
                // line 40
                yield "                    ";
            }
            // line 41
            yield "                    
                    <div class=\"";
            // line 42
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 42) == 2)) {
                yield "d-flex justify-content-between";
            } else {
                yield "text-end";
            }
            yield " mt-2\">
                        ";
            // line 43
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "statusNumber", [], "any", false, false, false, 43) == 2)) {
                // line 44
                yield "                            ";
                // line 45
                yield "                            <button class=\"btn btn-sm btn-warning text-white\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_payer_bonus_promoaffaire_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 45), "html", null, true);
                yield "\"><i class=\"fas fa-credit-card me-1\"></i> Payer Bonus</button>
                        ";
            }
            // line 47
            yield "                        <button class=\"btn btn-sm btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#modal_promoaffaire_";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 47), "html", null, true);
            yield "\"><i class=\"fas fa-info me-2\"></i>Détails</button>
                    </div>
                </div>
            </div>

            <div class=\"modal fade\" id=\"modal_payer_bonus_promoaffaire_";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 52), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5>Démarer la promotion affaire Gratuitement</h5>
                        </div>
                        <div class=\"modal-body\">
                            <div class=\"col-12\">
                                <div class=\"mt-0 msgError\" id=\"msgError-";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 60), "html", null, true);
            yield "\" style=\"display: none;\"></div>
                            </div>
                            <div hidden>
                                <input type=\"text\" id=\"idPromoAffaire-";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 63), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 63), "html", null, true);
            yield "\">
                            </div>
                            <div class=\"mb-2\">
                                <label for=\"formulBoost\">Formule de Boost</label>
                                <select id=\"formulBosst\" class=\"form-select getInfoBoost-";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 67), "html", null, true);
            yield " formulBoost-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 67), "html", null, true);
            yield "\">
                                    <option value=\"\" selected disabled>Choissisez une Formule de Boost</option>
                                    ";
            // line 69
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["listeFormulBoost"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["formulBoost"]) {
                // line 70
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "id", [], "any", false, false, false, 70), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "label", [], "any", false, false, false, 70), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['formulBoost'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            yield "                                </select>
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm me-2\" data-bs-dismiss=\"modal\">Fermer</button>
                            <button type=\"button\" class=\"btn btn-primary btn-sm validePromoAffaireByAdmin\" payerpromoaffaire=\"";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 77), "html", null, true);
            yield "\" id=\"validePromoAffaireByAdmin-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 77), "html", null, true);
            yield "\">BOOSTER</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"modal fade\" id=\"modal_payerpromoaffaire_";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 83), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5>Démarer la promotion affaire</h5>
                        </div>
                        <div class=\"modal-body\">
                            <div class=\"col-12\">
                                <div class=\"mt-0 msgError msgError-";
            // line 91
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 91), "html", null, true);
            yield "\" id=\"msgError-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 91), "html", null, true);
            yield "\" style=\"display: none;\"></div>
                            </div>
                            <div hidden>
                                <input type=\"text\" id=\"idPromoAffaire-";
            // line 94
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 94), "html", null, true);
            yield "\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 94), "html", null, true);
            yield "\">
                            </div>
                            <div class=\"mb-2\">
                                <label for=\"formulBoost\">Formule de Boost</label>
                                <select id=\"formulBosst\" class=\"form-select getInfoBoostPayant-";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 98), "html", null, true);
            yield " formulBoostPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 98), "html", null, true);
            yield "\">
                                    <option value=\"\" selected disabled>Choissisez une Formule de Boost</option>
                                    ";
            // line 100
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["listeFormulBoost"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["formulBoost"]) {
                // line 101
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "id", [], "any", false, false, false, 101), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formulBoost"], "label", [], "any", false, false, false, 101), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['formulBoost'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            yield "                                </select>
                            </div>
                            <div class=\"mb-2\">
                                <label for=\"moyen-paiement\">Moyen de paiement mobile ou par carte</label>
                                <select id=\"moyen-paiement-";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 107), "html", null, true);
            yield "\" class=\"form-select getInfo getInfoBoostPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 107), "html", null, true);
            yield " moyenPaiementPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 107), "html", null, true);
            yield "\">
                                    <option value=\"\" disabled selected>Choisisez le Moyen de paiement mobile ou par carte</option>
                                    ";
            // line 109
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["uneMethodePaiement"]) {
                // line 110
                yield "                                        <option value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "value", [], "any", false, false, false, 110), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "titre", [], "any", false, false, false, 110), "html", null, true);
                yield "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['uneMethodePaiement'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 112
            yield "                                </select>
                            </div>
                            <div>
                                <label for=\"numero-paiement\">Indicatif + Numéro de Paiement</label>
                                <input type=\"text\" class=\"form-control getInfo getInfoBoostPayant-";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield " numeroPaiementPayant-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield "\" id=\"numero-paiement-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield "\">
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm me-2\" data-bs-dismiss=\"modal\">Fermer</button>
                            <button type=\"button\" class=\"btn btn-primary btn-sm payerpromoaffaire\" payerpromoaffaire=\"";
            // line 121
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 121), "html", null, true);
            yield "\" id=\"payerpromoaffaire-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 121), "html", null, true);
            yield "\">PAYER et BOOSTER</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"modal fade\" id=\"modal_promoaffaire_";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "id", [], "any", false, false, false, 127), "html", null, true);
            yield "\" tabindex=\"-1\" style=\"display: none;\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-dialog-scrollable\">
                    <div class=\"modal-content\">
                        <div class=\"modal-body p-0\">
                            <img src=\"/promotion/";
            // line 131
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "image", [], "any", false, false, false, 131), "html", null, true);
            yield "\" alt=\"\" class=\"card-img-top mb-3\">
                            <p class=\"px-3\">
                                Formule de promotion : ";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "formulePromotion", [], "any", false, false, false, 133), "html", null, true);
            yield " Fcfa
                            </p>
                            <p class=\"px-3\">
                                Date de début : ";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "dateDebut", [], "any", false, false, false, 136), "html", null, true);
            yield "
                            </p>
                            <p class=\"px-3\">
                                Date de fin : ";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "dateExp", [], "any", false, false, false, 139), "html", null, true);
            yield "
                            </p>
                            <p class=\"px-3\">
                                ";
            // line 142
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["promoaffaire"], "description", [], "any", false, false, false, 142), "html", null, true));
            yield "
                            </p>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
            $context['_iterated'] = true;
        }
        // line 152
        if (!$context['_iterated']) {
            // line 153
            yield "        <div class=\"alert alert-info text-center fw-semibold fs-6\">
            Aucune Promotion Affaire trouvé.
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['promoaffaire'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 157
        yield "</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/accepterSansSuite.html.twig";
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
        return array (  438 => 157,  429 => 153,  427 => 152,  412 => 142,  406 => 139,  400 => 136,  394 => 133,  389 => 131,  382 => 127,  371 => 121,  359 => 116,  353 => 112,  342 => 110,  338 => 109,  329 => 107,  323 => 103,  312 => 101,  308 => 100,  301 => 98,  292 => 94,  284 => 91,  273 => 83,  262 => 77,  255 => 72,  244 => 70,  240 => 69,  233 => 67,  224 => 63,  218 => 60,  207 => 52,  198 => 47,  192 => 45,  190 => 44,  188 => 43,  180 => 42,  177 => 41,  174 => 40,  167 => 39,  160 => 38,  154 => 37,  148 => 34,  142 => 31,  138 => 29,  129 => 23,  126 => 22,  124 => 21,  118 => 20,  113 => 18,  106 => 15,  101 => 14,  96 => 13,  91 => 12,  86 => 11,  82 => 10,  78 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/accepterSansSuite.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/accepterSansSuite.html.twig");
    }
}
