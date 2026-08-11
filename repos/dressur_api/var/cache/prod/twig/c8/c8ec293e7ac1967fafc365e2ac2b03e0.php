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

/* private/newpromoaffaire.html.twig */
class __TwigTemplate_0adcd37d3fa9422f4eeff5cc846f7577 extends Template
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
        yield "Nouvelle Promo. Affaire";
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
    <!-- Information Card -->
    <div class=\"row mb-4\">
        <div class=\"col-12\">
            <div class=\"card border-0 info-card\">
                <div class=\"card-body bg-gradient-red text-white rounded\">
                    <p class=\"small mb-0 text-justify\">
                        <strong>Informations :</strong><br>
                        - Après avoir rempli et envoyer votre promotion, elle sera analysée par les administrateurs de Dressur. 
                        Si votre promotion est acceptée, elle sera visible par des milliers d\x27utilisateurs correspondants à vos 
                        préférences pays.<br>
                        - Si la promotion est rejetée, vous aurez la possibilité de la modifier.<br>
                        - Les utilisateurs intéressés par votre Promotion Affaire vous contacterons sur votre numéro WhatsApp.<br>
                        - Les Promotions Affaires (Offre d\x27emploi et Demande d\x27emploi) sont gratuites.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Type Selection -->
    <div class=\"row mb-4\">
        <div class=\"col-12\">
            <div class=\"form-group\">
                <label for=\"typePromoAffaire\" class=\"form-label\">Type Promotion Affaire</label>
                <select id=\"typePromoAffaire\" class=\"form-select\">
                    <option value=\"produit_service\" selected>Produit ou Service</option>
                    <option value=\"sites_applications\">Sites &amp; Applications</option>
                    <option value=\"offre_emploi\">Offre d\x27emploi</option>
                    <option value=\"dmd_emploi\">Demande d\x27emploi</option>
                </select>
            </div>
        </div>
    </div>

    <hr class=\"my-4\">

    <!-- SECTION 1: PRODUITS/SERVICES -->
    <div id=\"produitServiceSection\" class=\"form-section\">
        <form id=\"produitServiceForm\" enctype=\"multipart/form-data\">
            <div class=\"row\">
                <!-- Formule Selection -->
                <div class=\"col-12 mb-3\">
                    <label for=\"formulePromoPageNewAffaire\" class=\"form-label\">Formule de Promotion Affaire</label>
                    <select id=\"formulePromoPageNewAffaire\" class=\"form-select getInfo\">
                        <option value=\"\" disabled selected>Veuillez choisir une formule...</option>
                        ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["formuleBoosts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["formuleBoost"]) {
            // line 53
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formuleBoost"], "id", [], "any", false, false, false, 53), "html", null, true);
            yield "\" 
                                    data-prix=\"";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formuleBoost"], "prix", [], "any", false, false, false, 54), "html", null, true);
            yield "\" 
                                    data-jours=\"";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formuleBoost"], "nbrJour", [], "any", false, false, false, 55), "html", null, true);
            yield "\"
                                    data-titre=\"";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formuleBoost"], "titre", [], "any", false, false, false, 56), "html", null, true);
            yield "\">
                                ";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["formuleBoost"], "titre", [], "any", false, false, false, 57), "html", null, true);
            yield "
                            </option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['formuleBoost'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        yield "                    </select>
                    <small class=\"text-muted d-block mt-2\" id=\"formuleMessage\"></small>
                </div>

                <!-- Image Upload -->
                <div class=\"col-12 mb-3\">
                    <label for=\"imageUpload\" class=\"form-label\">Sélectionner l\x27image</label>
                    <button type=\"button\" class=\"btn btn-primary w-100\" id=\"imageUploadBtn\" disabled>
                        <i class=\"fas fa-image me-2\"></i>Sélectionner l\x27image
                    </button>
                    <input type=\"file\" id=\"imageUpload\" class=\"d-none\" accept=\"image/*\">
                    <div id=\"imagePreview\" class=\"mt-3\"></div>
                </div>

                <!-- Description -->
                <div class=\"col-12 mb-3\">
                    <label for=\"descriptionPromo\" class=\"form-label\">Description</label>
                    <textarea id=\"descriptionPromo\" class=\"form-control\" rows=\"5\" placeholder=\"Entrez votre description...\"></textarea>
                </div>

                <!-- WhatsApp Contact -->
                <div class=\"col-12 mb-3\">
                    <label for=\"whatsappContact\" class=\"form-label\">
                        <i class=\"fab fa-whatsapp text-success me-1\"></i>Numéro WhatsApp de contact
                    </label>
                    <input type=\"tel\" id=\"whatsappContact\" class=\"form-control\"
                           value=\"";
        // line 86
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 86), "tel", [], "any", true, true, false, 86) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 86), "tel", [], "any", false, false, false, 86)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, false, false, 86), "tel", [], "any", false, false, false, 86), "html", null, true)) : (""));
        yield "\"
                           placeholder=\"+22890000000\">
                    <div class=\"invalid-feedback\">Le numéro doit commencer par + suivi d\x27au moins 11 chiffres (ex : +22890000000).</div>
                    <small class=\"text-muted\">Les utilisateurs intéressés vous contacteront sur ce numéro WhatsApp.</small>
                </div>

                <!-- Reward Program Section -->
                <div class=\"col-12 mb-4\">
                    <div class=\"d-flex align-items-center mb-3\">
                        <i class=\"fas fa-star text-warning me-2\"></i>
                        <h5 class=\"mb-0\">Programme de Récompense</h5>
                    </div>
                    
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"participateReward\">
                        <label class=\"form-check-label\" for=\"participateReward\">
                            Ajouter votre promotion au programme
                        </label>
                    </div>
                    <small class=\"text-muted d-block mt-2\">
                        Attirez plus de vues en récompensant les utilisateurs qui le publieront sur leur statut WhatsApp. 
                        Dressur se charge de la mise en application et de la vérification.
                    </small>

                    <div id=\"rewardSection\" class=\"mt-3\" style=\"display: none;\">
                        <input type=\"hidden\" id=\"rewardBudget\" value=\"500\">
                        <label class=\"form-label fw-semibold\">Choisissez votre budget récompenses</label>
                        <div class=\"d-flex gap-2 flex-wrap mb-3\" id=\"rewardBudgetOptions\">
                            <button type=\"button\" class=\"btn btn-outline-primary budget-btn active\" data-budget=\"500\">500 F</button>
                            <button type=\"button\" class=\"btn btn-outline-primary budget-btn\" data-budget=\"1000\">1 000 F</button>
                            <button type=\"button\" class=\"btn btn-outline-primary budget-btn\" data-budget=\"2000\">2 000 F</button>
                            <button type=\"button\" class=\"btn btn-outline-primary budget-btn\" data-budget=\"5000\">5 000 F</button>
                        </div>
                    </div>
                </div>

                <!-- Boost Page Facebook Section -->
                <div class=\"col-12 mb-4\">
                    <div class=\"d-flex align-items-center mb-3\">
                        <i class=\"fab fa-facebook text-primary me-2\"></i>
                        <h5 class=\"mb-0\">Boost Page Facebook Dressur</h5>
                    </div>

                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"boostFacebook\">
                        <label class=\"form-check-label\" for=\"boostFacebook\">
                            Publier et booster sur la page Facebook de Dressur
                        </label>
                    </div>
                    <small class=\"text-muted d-block mt-2\">
                        Votre promotion sera publiée sur la page Facebook officielle de Dressur et boostée auprès d\x27une audience ciblée.
                        Budget minimum : 700 FCFA.
                    </small>

                    <div id=\"boostFacebookSection\" class=\"mt-3\" style=\"display: none;\">
                        <label class=\"form-label fw-semibold\">Budget boost Facebook (FCFA)</label>
                        <input type=\"number\" id=\"boostFacebookAmount\" class=\"form-control\" value=\"700\" min=\"700\"
                               placeholder=\"Montant minimum 700 FCFA\">
                        <div class=\"invalid-feedback\">Le montant minimum est de 700 FCFA.</div>
                    </div>
                </div>

                <!-- Dressur WhatsApp Status & Story Section -->
                <div class=\"col-12 mb-4\" id=\"dressurStatusBlock\" style=\"display:none;\">
                    <div class=\"d-flex align-items-center mb-3\">
                        <i class=\"fas fa-check-circle text-success me-2\"></i>
                        <h5 class=\"mb-0\">Statut WhatsApp de Dressur et Story</h5>
                    </div>
                    
                    <div class=\"form-check form-switch\">
                        <input class=\"form-check-input\" type=\"checkbox\" id=\"publishDressurStatus\">
                        <label class=\"form-check-label\" for=\"publishDressurStatus\">
                            Ajouter au statut WhatsApp de Dressur et à la Story sur Dressur
                        </label>
                    </div>
                    <small class=\"text-muted d-block mt-2\">
                        Bénéficiez d\x27une visibilité maximale : votre promotion sera publiée sur le statut WhatsApp de Dressur
                        et apparaîtra dans les Stories sur l\x27application pendant toute la durée de votre promotion.
                    </small>

                    <div id=\"statusSection\" class=\"mt-3\" style=\"display: none;\">
                        <div class=\"alert alert-info\">
                            <strong>Frais Statut WhatsApp &amp; Story Dressur :</strong> <span id=\"statusAmount\">0</span> FCFA
                        </div>
                    </div>
                </div>

                <!-- Pricing Summary -->
                <div class=\"col-12 mb-4\">
                    <div class=\"card border-0 bg-light\">
                        <div class=\"card-body\">
                            <h6 class=\"card-title mb-3\">Récapitulatif des frais</h6>
                            <div class=\"mb-2\">
                                <span>Prix Formule :</span>
                                <strong id=\"summaryFormulePrice\" class=\"float-end\">0 F</strong>
                            </div>
                            <div class=\"mb-2\">
                                <span>Récompense Programme :</span>
                                <strong id=\"summaryRewardPrice\" class=\"float-end\">0 F</strong>
                            </div>
                            <div class=\"mb-2\">
                                <span>Frais Statut WhatsApp &amp; Story Dressur :</span>
                                <strong id=\"summaryStatusPrice\" class=\"float-end\">0 F</strong>
                            </div>
                            <div class=\"mb-2\">
                                <span>Boost Page Facebook :</span>
                                <strong id=\"summaryBoostFacebookPrice\" class=\"float-end\">0 F</strong>
                            </div>
                            <hr>
                            <div class=\"mb-2 text-success\">
                                <span><strong>Total TTC :</strong></span>
                                <strong id=\"summaryTotal\" class=\"float-end\">0 F</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class=\"col-md-6 mb-3\">
                    <label for=\"paymentMethod\" class=\"form-label\">Moyen de paiement mobile ou par carte</label>
                    <select id=\"paymentMethod\" class=\"form-select getInfo getInfoPayant\">
                        <option value=\"\" disabled selected>Choisissez le Moyen de paiement mobile ou par carte</option>
                        ";
        // line 208
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["uneMethodePaiement"]) {
            // line 209
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "value", [], "any", false, false, false, 209), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "titre", [], "any", false, false, false, 209), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['uneMethodePaiement'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 211
        yield "                    </select>
                </div>

                <!-- Payment Number -->
                <div class=\"col-md-6 mb-3\">
                    <label for=\"paymentNumber\" class=\"form-label\">Numéro du paiement</label>
                    <input type=\"tel\" id=\"paymentNumber\" class=\"form-control\" placeholder=\"Entrez votre numéro de paiement\">
                </div>

                <!-- Submit Button -->
                <div class=\"col-12 mb-3\">
                    <button type=\"submit\" id=\"submitProduitService\" class=\"btn btn-primary w-100 btn-lg\" disabled>
                        <span id=\"submitText\">VALIDER ET PAYER</span>
                        <span id=\"submitSpinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display: none;\"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- SECTION 2: SITES & APPLICATIONS -->
    <div id=\"siteApplicationSection\" class=\"form-section\" style=\"display: none;\">
        <form id=\"siteApplicationForm\" enctype=\"multipart/form-data\">
            <div class=\"row\">

                <!-- Sous-type -->
                <div class=\"col-12 mb-3\">
                    <label class=\"form-label fw-semibold\">Type de promotion</label>
                    <div class=\"d-flex gap-4 flex-wrap mt-1\">
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" type=\"radio\" name=\"sousTypeSiteApp\" id=\"sousType_site_web\" value=\"site_web\" checked>
                            <label class=\"form-check-label\" for=\"sousType_site_web\">Site web</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" type=\"radio\" name=\"sousTypeSiteApp\" id=\"sousType_app_mobile\" value=\"app_mobile\">
                            <label class=\"form-check-label\" for=\"sousType_app_mobile\">Application mobile</label>
                        </div>
                        <div class=\"form-check\">
                            <input class=\"form-check-input\" type=\"radio\" name=\"sousTypeSiteApp\" id=\"sousType_logiciel\" value=\"logiciel_desktop\">
                            <label class=\"form-check-label\" for=\"sousType_logiciel\">Logiciel / Application desktop</label>
                        </div>
                    </div>
                </div>

                <!-- Nom -->
                <div class=\"col-12 mb-3\">
                    <label for=\"nomSiteApp\" class=\"form-label\">Nom du site / de l\x27application <span class=\"text-danger\">*</span></label>
                    <input type=\"text\" id=\"nomSiteApp\" class=\"form-control\" maxlength=\"150\" placeholder=\"Ex : MonApplication\">
                </div>

                <!-- URL -->
                <div class=\"col-12 mb-3\">
                    <label for=\"urlSiteApp\" class=\"form-label\">URL <span class=\"text-danger\">*</span></label>
                    <input type=\"url\" id=\"urlSiteApp\" class=\"form-control\" placeholder=\"https://monsite.com\">
                    <small class=\"text-muted\" id=\"urlSiteAppHelp\">Entrez l\x27URL de votre site ou application.</small>
                </div>

                <!-- Description -->
                <div class=\"col-12 mb-3\">
                    <label for=\"descriptionSiteApp\" class=\"form-label\">Description courte <span class=\"text-muted\">(max 120 caractères)</span></label>
                    <textarea id=\"descriptionSiteApp\" class=\"form-control\" rows=\"3\" maxlength=\"120\" placeholder=\"Décrivez brièvement votre site ou application...\"></textarea>
                    <small class=\"text-muted\"><span id=\"descSiteAppCounter\">120</span> caractères restants</small>
                </div>

                <!-- Image Upload -->
                <div class=\"col-12 mb-3\">
                    <label for=\"imageSiteApp\" class=\"form-label\">Icône ou logo <span class=\"text-danger\">*</span></label>
                    <input type=\"file\" id=\"imageSiteApp\" class=\"form-control\" accept=\"image/*\">
                    <small class=\"text-muted\">Icône ou logo de votre application (image carrée recommandée)</small>
                    <div id=\"imageSiteAppPreview\" class=\"mt-2\"></div>
                </div>

                <!-- Prix fixe -->
                <div class=\"col-12 mb-3\">
                    <div class=\"alert alert-info mb-0\">
                        <i class=\"fas fa-tag me-2\"></i><strong>Prix : 7 750 FCFA / an</strong>
                        <span class=\"text-muted small d-block\">Durée fixée à 365 jours par l\x27admin à la validation — non modifiable.</span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class=\"col-md-6 mb-3\">
                    <label for=\"paymentMethodSiteApp\" class=\"form-label\">Moyen de paiement mobile ou par carte</label>
                    <select id=\"paymentMethodSiteApp\" class=\"form-select\">
                        <option value=\"\" disabled selected>Choisissez le Moyen de paiement mobile ou par carte</option>
                        ";
        // line 296
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["listeMethodePaiements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["uneMethodePaiement"]) {
            // line 297
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "value", [], "any", false, false, false, 297), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["uneMethodePaiement"], "titre", [], "any", false, false, false, 297), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['uneMethodePaiement'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 299
        yield "                    </select>
                </div>

                <!-- Payment Number -->
                <div class=\"col-md-6 mb-3\">
                    <label for=\"paymentNumberSiteApp\" class=\"form-label\">Numéro du paiement</label>
                    <input type=\"tel\" id=\"paymentNumberSiteApp\" class=\"form-control\" placeholder=\"Entrez votre numéro de paiement\">
                </div>

                <!-- Submit -->
                <div class=\"col-12 mb-3\">
                    <button type=\"submit\" id=\"submitSiteApp\" class=\"btn btn-primary w-100 btn-lg\">
                        <span id=\"submitSiteAppText\">VALIDER ET PAYER</span>
                        <span id=\"submitSiteAppSpinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display: none;\"></span>
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- SECTION 3: DEMANDES D\x27EMPLOI -->
    <div id=\"demandeEmploiSection\" class=\"form-section\" style=\"display: none;\">
        <form id=\"demandeEmploiForm\">
            <div class=\"row\">
                <div class=\"col-12 mb-3\">
                    <label for=\"titreDemande\" class=\"form-label\">Titre de la demande ou poste recherché</label>
                    <input type=\"text\" id=\"titreDemande\" class=\"form-control\">
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"descriptionProfil\" class=\"form-label\">Description du profil du demandeur</label>
                    <textarea id=\"descriptionProfil\" class=\"form-control\" rows=\"3\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"competences\" class=\"form-label\">Compétences et qualification (listes)</label>
                    <textarea id=\"competences\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"niveauExperience\" class=\"form-label\">Niveau d\x27expérience (Nombre d\x27années d\x27expérience)</label>
                    <textarea id=\"niveauExperience\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"secteurActivite\" class=\"form-label\">Secteur d\x27activité recherché</label>
                    <textarea id=\"secteurActivite\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"typeContrat\" class=\"form-label\">Type de contrat recherché</label>
                    <textarea id=\"typeContrat\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"localisationSouhaite\" class=\"form-label\">Localisation souhaitée</label>
                    <textarea id=\"localisationSouhaite\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"salaireSouhaite\" class=\"form-label\">Salaire souhaité</label>
                    <input type=\"text\" id=\"salaireSouhaite\" class=\"form-control\">
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"languesParle\" class=\"form-label\">Langues parlées</label>
                    <textarea id=\"languesParle\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"lienPortfolio\" class=\"form-label\">Lien vers votre portfolio ou CV</label>
                    <input type=\"url\" id=\"lienPortfolio\" class=\"form-control\">
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"coordonneesDemandeur\" class=\"form-label\">Coordonnées du demandeur</label>
                    <textarea id=\"coordonneesDemandeur\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <button type=\"submit\" id=\"submitDemande\" class=\"btn btn-primary w-100 btn-lg\" disabled>
                        <span id=\"submitDemandeText\">ENREGISTRER</span>
                        <span id=\"submitDemandeSpinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display: none;\"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- SECTION 3: OFFRES D\x27EMPLOI -->
    <div id=\"offreEmploiSection\" class=\"form-section\" style=\"display: none;\">
        <form id=\"offreEmploiForm\">
            <div class=\"row\">
                <div class=\"col-12 mb-3\">
                    <label for=\"titrePoste\" class=\"form-label\">Titre du poste</label>
                    <input type=\"text\" id=\"titrePoste\" class=\"form-control\">
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"descriptionPoste\" class=\"form-label\">Description du poste</label>
                    <textarea id=\"descriptionPoste\" class=\"form-control\" rows=\"3\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"competencesRequises\" class=\"form-label\">Compétences requises</label>
                    <textarea id=\"competencesRequises\" class=\"form-control\" rows=\"3\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"typeContratOffre\" class=\"form-label\">Type de contrat</label>
                    <textarea id=\"typeContratOffre\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"lieuTravail\" class=\"form-label\">Lieu de travail</label>
                    <textarea id=\"lieuTravail\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"salaireOffre\" class=\"form-label\">Salaire</label>
                    <textarea id=\"salaireOffre\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"niveauExperienceOffre\" class=\"form-label\">Niveau d\x27expériences</label>
                    <textarea id=\"niveauExperienceOffre\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"horaireTravail\" class=\"form-label\">Horaire de travail</label>
                    <textarea id=\"horaireTravail\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"avantages\" class=\"form-label\">Avantages</label>
                    <textarea id=\"avantages\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"dureeContrat\" class=\"form-label\">Durée du contrat si ce n\x27est pas CDI</label>
                    <textarea id=\"dureeContrat\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"contactEmployeur\" class=\"form-label\">Contact de l\x27employeur</label>
                    <textarea id=\"contactEmployeur\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"dateLimiteCandidature\" class=\"form-label\">Date limite de la candidature</label>
                    <input type=\"date\" id=\"dateLimiteCandidature\" class=\"form-control\">
                </div>

                <div class=\"col-12 mb-3\">
                    <label for=\"lienInformation\" class=\"form-label\">Lien vers plus d\x27information (optionnel)</label>
                    <textarea id=\"lienInformation\" class=\"form-control\" rows=\"2\"></textarea>
                </div>

                <div class=\"col-12 mb-3\">
                    <button type=\"submit\" id=\"submitOffre\" class=\"btn btn-primary w-100 btn-lg\" disabled>
                        <span id=\"submitOffreText\">ENREGISTRER</span>
                        <span id=\"submitOffreSpinner\" class=\"spinner-border spinner-border-sm ms-2\" style=\"display: none;\"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Alert Container -->
<div id=\"alertContainer\" class=\"position-fixed top-0 start-50 translate-middle-x mt-3\" style=\"z-index: 1050;\"></div>

<style>
    .bg-gradient-red {
        background: linear-gradient(135deg, #dc3545 0%, #550303 100%);
    }

    .info-card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .text-justify {
        text-align: justify;
    }

    #imagePreview {
        max-width: 300px;
        margin: 0 auto;
    }

    #imagePreview img {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<script>
// ── Section switching ──────────────────────────────────────────────────────
const typeSelect = document.getElementById(\x27typePromoAffaire\x27);
const allSections = {
    \x27produit_service\x27:    document.getElementById(\x27produitServiceSection\x27),
    \x27sites_applications\x27: document.getElementById(\x27siteApplicationSection\x27),
    \x27dmd_emploi\x27:         document.getElementById(\x27demandeEmploiSection\x27),
    \x27offre_emploi\x27:       document.getElementById(\x27offreEmploiSection\x27),
};

typeSelect.addEventListener(\x27change\x27, function () {
    Object.values(allSections).forEach(s => { if (s) s.style.display = \x27none\x27; });
    const target = allSections[this.value];
    if (target) target.style.display = \x27\x27;
});

// ── URL placeholder selon le sous-type ────────────────────────────────────
const urlPlaceholders = {
    \x27site_web\x27:         \x27https://monsite.com\x27,
    \x27app_mobile\x27:       \x27https://play.google.com/... ou https://apps.apple.com/...\x27,
    \x27logiciel_desktop\x27: \x27https://monlogiciel.com/telecharger\x27,
};
document.querySelectorAll(\x27input[name=\"sousTypeSiteApp\"]\x27).forEach(radio => {
    radio.addEventListener(\x27change\x27, function () {
        const input = document.getElementById(\x27urlSiteApp\x27);
        if (input) input.placeholder = urlPlaceholders[this.value] || \x27\x27;
    });
});

// ── Compteur de caractères description ────────────────────────────────────
const descTextarea = document.getElementById(\x27descriptionSiteApp\x27);
const descCounter  = document.getElementById(\x27descSiteAppCounter\x27);
if (descTextarea && descCounter) {
    descTextarea.addEventListener(\x27input\x27, function () {
        descCounter.textContent = 120 - this.value.length;
    });
}

// ── Prévisualisation image ─────────────────────────────────────────────────
const imageSiteAppInput = document.getElementById(\x27imageSiteApp\x27);
if (imageSiteAppInput) {
    imageSiteAppInput.addEventListener(\x27change\x27, function () {
        const file    = this.files[0];
        const preview = document.getElementById(\x27imageSiteAppPreview\x27);
        if (!file || !preview) return;
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src=\"\${e.target.result}\" style=\"max-width:200px;border-radius:8px;margin-top:8px;\">`;
        };
        reader.readAsDataURL(file);
    });
}

// ── Soumission formulaire Sites & Applications ────────────────────────────
const siteAppForm = document.getElementById(\x27siteApplicationForm\x27);
if (siteAppForm) {
    siteAppForm.addEventListener(\x27submit\x27, async function (e) {
        e.preventDefault();

        const btn     = document.getElementById(\x27submitSiteApp\x27);
        const btnText = document.getElementById(\x27submitSiteAppText\x27);
        const spinner = document.getElementById(\x27submitSiteAppSpinner\x27);

        const sousType        = document.querySelector(\x27input[name=\"sousTypeSiteApp\"]:checked\x27)?.value;
        const nom             = document.getElementById(\x27nomSiteApp\x27).value.trim();
        const url             = document.getElementById(\x27urlSiteApp\x27).value.trim();
        const description     = document.getElementById(\x27descriptionSiteApp\x27).value.trim();
        const image           = document.getElementById(\x27imageSiteApp\x27).files[0];
        const methodePaiement = document.getElementById(\x27paymentMethodSiteApp\x27).value;
        const tel             = document.getElementById(\x27paymentNumberSiteApp\x27).value.trim();

        if (!nom) { showAlert(\x27danger\x27, \x27Veuillez renseigner le nom du site / de l\\\x27application.\x27); return; }
        if (!url) { showAlert(\x27danger\x27, \x27Veuillez renseigner l\\\x27URL.\x27); return; }
        if (!image) { showAlert(\x27danger\x27, \x27Veuillez sélectionner une image (icône ou logo).\x27); return; }
        if (!methodePaiement) { showAlert(\x27danger\x27, \x27Veuillez choisir un moyen de paiement.\x27); return; }
        if (!tel) { showAlert(\x27danger\x27, \x27Veuillez renseigner le numéro de paiement.\x27); return; }

        btn.disabled = true;
        btnText.textContent = \x27Envoi en cours...\x27;
        spinner.style.display = \x27inline-block\x27;

        const formData = new FormData();
        formData.append(\x27sousType\x27,        sousType);
        formData.append(\x27nom\x27,             nom);
        formData.append(\x27url\x27,             url);
        formData.append(\x27description\x27,     description);
        formData.append(\x27image\x27,           image);
        formData.append(\x27methodePaiement\x27, methodePaiement);
        formData.append(\x27tel\x27,             tel);

        try {
            const response = await fetch(\x27/api/addSiteApplication\x27, { method: \x27POST\x27, body: formData });
            const data     = await response.json();

            if (data.error) {
                showAlert(\x27danger\x27, (data.titre ? data.titre + \x27 : \x27 : \x27\x27) + data.message);
            } else if (data.solde_used) {
                showAlert(\x27success\x27, data.message || \x27Promotion Sites & Applications enregistrée avec succès !\x27);
                siteAppForm.reset();
                document.getElementById(\x27imageSiteAppPreview\x27).innerHTML = \x27\x27;
                if (descCounter) descCounter.textContent = \x27120\x27;
            } else if (data.url) {
                showAlert(\x27success\x27, \x27Redirection vers le paiement...\x27);
                window.location.href = data.url;
            } else {
                showAlert(\x27success\x27, \x27Demande de paiement envoyée. Vérifiez votre téléphone.\x27);
            }
        } catch (err) {
            showAlert(\x27danger\x27, \x27Une erreur est survenue. Veuillez réessayer.\x27);
        } finally {
            btn.disabled = false;
            btnText.textContent = \x27VALIDER ET PAYER\x27;
            spinner.style.display = \x27none\x27;
        }
    });
}

function showAlert(type, message) {
    const container = document.getElementById(\x27alertContainer\x27);
    if (!container) return;
    const div = document.createElement(\x27div\x27);
    div.className = `alert alert-\${type} alert-dismissible fade show shadow`;
    div.role = \x27alert\x27;
    div.innerHTML = `\${message}<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>`;
    container.appendChild(div);
    setTimeout(() => div.remove(), 6000);
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
        return "private/newpromoaffaire.html.twig";
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
        return array (  418 => 299,  407 => 297,  403 => 296,  316 => 211,  305 => 209,  301 => 208,  176 => 86,  148 => 60,  139 => 57,  135 => 56,  131 => 55,  127 => 54,  122 => 53,  118 => 52,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/newpromoaffaire.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/newpromoaffaire.html.twig");
    }
}
