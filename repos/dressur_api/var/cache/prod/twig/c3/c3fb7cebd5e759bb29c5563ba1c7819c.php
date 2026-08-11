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

/* private/guide_import_contacts.html.twig */
class __TwigTemplate_fd3901c5e890a1099e02a6c3384db42e extends Template
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
        yield "Enregistrer mes contacts dans mon téléphone";
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
        // line 8
        yield "<div class=\"mb-4\">
    <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contact");
        yield "\" class=\"btn btn-sm btn-outline-secondary mb-3\">
        <i class=\"fas fa-arrow-left me-1\"></i> Retour aux contacts
    </a>
    <h5 class=\"mb-1 fw-bold\">
        <i class=\"fas fa-mobile-alt text-primary me-2\"></i>Enregistrer mes contacts dans mon téléphone
    </h5>
    <p class=\"text-muted mb-0\" style=\"font-size:.92rem;\">
        Sur la version web, il n\x27est pas possible d\x27enregistrer les contacts directement dans votre téléphone comme sur l\x27application mobile Dressur.
    </p>
</div>

";
        // line 21
        yield "<div class=\"card border-0 shadow-sm mb-4\">
    <div class=\"card-body\">
        <div class=\"d-flex align-items-start gap-3\">
            <div class=\"flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle border border-primary\"
                 style=\"width:48px;height:48px;min-width:48px;\">
                <i class=\"fas fa-info-circle text-primary fa-lg\"></i>
            </div>
            <div>
                <h6 class=\"fw-bold mb-1\">Pourquoi cette différence ?</h6>
                <p class=\"text-muted mb-0\" style=\"font-size:.9rem;\">
                    L\x27application mobile Dressur peut accéder directement aux contacts de votre téléphone grâce aux autorisations système.
                    Un navigateur web n\x27a pas ce droit pour protéger votre vie privée.
                    <strong>La solution est simple :</strong> exporter vos contacts, télécharger le fichier, puis l\x27importer dans votre téléphone en quelques étapes.
                </p>
            </div>
        </div>
    </div>
</div>

";
        // line 41
        yield "<div class=\"card border-0 shadow-sm mb-4\">
    <div class=\"card-body\">
        <h6 class=\"fw-bold mb-3\">
            <span class=\"badge bg-primary me-2\">1</span>
            Exporter et télécharger vos contacts
        </h6>

        <p class=\"text-muted small mb-3\">
            Choisissez le format selon votre besoin. <strong>Le format VCF est recommandé</strong> pour importer directement dans l\x27application Contacts de votre téléphone.
        </p>

        <div class=\"row g-3\">

            ";
        // line 55
        yield "            <div class=\"col-sm-6\">
                <div class=\"card h-100 border-0 shadow-sm border-start border-primary\" style=\"border-left-width:4px!important;\">
                    <div class=\"card-body text-center\">
                        <span class=\"badge bg-primary mb-2\">Recommandé</span>
                        <div class=\"mb-1\"><i class=\"fas fa-address-card text-primary fa-2x\"></i></div>
                        <h6 class=\"fw-bold mb-1\">Format VCF</h6>
                        <p class=\"text-muted small mb-3\">
                            Format vCard — reconnu nativement par iPhone et Android.
                            Idéal pour importer directement dans l\x27app Contacts.
                        </p>
                        <a href=\"";
        // line 65
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_export_vcf");
        yield "\" class=\"btn btn-primary btn-sm w-100\">
                            <i class=\"fas fa-download me-1\"></i> Télécharger le VCF
                        </a>
                    </div>
                </div>
            </div>

            ";
        // line 73
        yield "            <div class=\"col-sm-6\">
                <div class=\"card h-100 border-0 shadow-sm\">
                    <div class=\"card-body text-center\">
                        <span class=\"badge bg-secondary mb-2\">Alternatif</span>
                        <div class=\"mb-1\"><i class=\"fas fa-file-csv text-secondary fa-2x\"></i></div>
                        <h6 class=\"fw-bold mb-1\">Format CSV</h6>
                        <p class=\"text-muted small mb-3\">
                            Format tableur — utile pour ouvrir dans Excel / Google Sheets ou importer via Google Contacts.
                        </p>
                        <a href=\"";
        // line 82
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_export_csv");
        yield "\" class=\"btn btn-outline-secondary btn-sm w-100\">
                            <i class=\"fas fa-download me-1\"></i> Télécharger le CSV
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

";
        // line 94
        yield "<div class=\"card border-0 shadow-sm mb-4\">
    <div class=\"card-body\">
        <h6 class=\"fw-bold mb-3\">
            <span class=\"badge bg-primary me-2\">2</span>
            Importer le fichier dans votre téléphone
        </h6>

        ";
        // line 102
        yield "        <ul class=\"nav nav-pills mb-3\" id=\"importTabs\" role=\"tablist\">
            <li class=\"nav-item\" role=\"presentation\">
                <button class=\"nav-link active\" id=\"iphone-tab\"
                        data-bs-toggle=\"pill\" data-bs-target=\"#iphone-panel\"
                        type=\"button\" role=\"tab\" aria-selected=\"true\">
                    <i class=\"fab fa-apple me-1\"></i> iPhone
                </button>
            </li>
            <li class=\"nav-item\" role=\"presentation\">
                <button class=\"nav-link\" id=\"android-tab\"
                        data-bs-toggle=\"pill\" data-bs-target=\"#android-panel\"
                        type=\"button\" role=\"tab\" aria-selected=\"false\">
                    <i class=\"fab fa-android me-1\"></i> Android
                </button>
            </li>
        </ul>

        <div class=\"tab-content\">

            ";
        // line 122
        yield "            <div class=\"tab-pane fade show active\" id=\"iphone-panel\"
                 role=\"tabpanel\" aria-labelledby=\"iphone-tab\">

                <div class=\"card border-0 shadow-sm mb-3\">
                    <div class=\"card-body py-2 small\">
                        <i class=\"fas fa-lightbulb text-warning me-1\"></i>
                        <strong>Méthode la plus simple :</strong>
                        ouvrez directement le fichier <code>.vcf</code> depuis l\x27app Fichiers ou votre messagerie —
                        iOS vous proposera de l\x27importer dans vos Contacts automatiquement.
                    </div>
                </div>

                <ol class=\"list-group list-group-flush list-group-numbered mb-3\">
                    <li class=\"list-group-item border-0 px-0\">
                        <div class=\"ms-2\">
                            <strong>Téléchargez le fichier VCF</strong> en cliquant sur le bouton ci-dessus.
                            Le fichier apparaîtra dans votre dossier <em>Téléchargements</em> (app Fichiers).
                        </div>
                    </li>
                    <li class=\"list-group-item border-0 px-0\">
                        <div class=\"ms-2\">
                            <strong>Ouvrez l\x27application Fichiers</strong> sur votre iPhone et naviguez jusqu\x27au fichier <code>.vcf</code>.
                        </div>
                    </li>
                    <li class=\"list-group-item border-0 px-0\">
                        <div class=\"ms-2\">
                            <strong>Appuyez sur le fichier</strong> — iOS affiche automatiquement <em>\"Importer X contacts ?\"</em>.
                            Tapez <strong>Importer</strong>.
                        </div>
                    </li>
                    <li class=\"list-group-item border-0 px-0\">
                        <div class=\"ms-2\">
                            Vos contacts apparaissent dans l\x27application <em>Contacts</em>. ✅
                        </div>
                    </li>
                </ol>

                <div class=\"card border-0 shadow-sm\">
                    <div class=\"card-body py-2 small text-muted\">
                        <i class=\"fas fa-info-circle text-primary me-1\"></i>
                        <strong>Alternative via iCloud :</strong>
                        connectez-vous sur
                        <a href=\"https://icloud.com/contacts\" target=\"_blank\" rel=\"noopener noreferrer\">icloud.com/contacts</a>,
                        cliquez sur la roue dentée en bas à gauche → <em>Importer une vCard</em> → sélectionnez votre fichier.
                        Les contacts se synchroniseront automatiquement sur votre iPhone.
                    </div>
                </div>

            </div>

            ";
        // line 173
        yield "            <div class=\"tab-pane fade\" id=\"android-panel\"
                 role=\"tabpanel\" aria-labelledby=\"android-tab\">

                <div class=\"card border-0 shadow-sm mb-3\">
                    <div class=\"card-body py-2 small\">
                        <i class=\"fas fa-lightbulb text-warning me-1\"></i>
                        <strong>Méthode recommandée :</strong>
                        utilisez Google Contacts — disponible sur tous les Android, il accepte les fichiers VCF et CSV.
                    </div>
                </div>

                ";
        // line 185
        yield "                <ul class=\"nav nav-tabs mb-3 small\" id=\"androidTabs\" role=\"tablist\">
                    <li class=\"nav-item\" role=\"presentation\">
                        <button class=\"nav-link active\" id=\"android-vcf-tab\"
                                data-bs-toggle=\"tab\" data-bs-target=\"#android-vcf-panel\"
                                type=\"button\" role=\"tab\" aria-selected=\"true\">
                            Méthode VCF
                        </button>
                    </li>
                    <li class=\"nav-item\" role=\"presentation\">
                        <button class=\"nav-link\" id=\"android-csv-tab\"
                                data-bs-toggle=\"tab\" data-bs-target=\"#android-csv-panel\"
                                type=\"button\" role=\"tab\" aria-selected=\"false\">
                            Méthode CSV (Google Contacts)
                        </button>
                    </li>
                </ul>

                <div class=\"tab-content\">

                    ";
        // line 205
        yield "                    <div class=\"tab-pane fade show active\" id=\"android-vcf-panel\"
                         role=\"tabpanel\" aria-labelledby=\"android-vcf-tab\">
                        <ol class=\"list-group list-group-flush list-group-numbered\">
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    <strong>Téléchargez le fichier VCF</strong> sur votre téléphone Android.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    <strong>Ouvrez l\x27application Contacts</strong>
                                    <span class=\"badge bg-secondary ms-1\">ou Google Contacts</span>.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    Appuyez sur le <strong>menu ☰</strong> ou les <strong>trois points</strong> en haut à droite,
                                    puis choisissez <em>Importer</em> ou <em>Gérer les contacts → Importer</em>.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    Sélectionnez <em>Importer depuis un fichier .vcf</em>, naviguez jusqu\x27au fichier et confirmez.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    <strong>Vos contacts sont importés.</strong> ✅
                                </div>
                            </li>
                        </ol>
                    </div>

                    ";
        // line 239
        yield "                    <div class=\"tab-pane fade\" id=\"android-csv-panel\"
                         role=\"tabpanel\" aria-labelledby=\"android-csv-tab\">
                        <ol class=\"list-group list-group-flush list-group-numbered\">
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    <strong>Téléchargez le fichier CSV</strong> sur votre ordinateur.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    Connectez-vous sur
                                    <a href=\"https://contacts.google.com\" target=\"_blank\" rel=\"noopener noreferrer\">contacts.google.com</a>
                                    depuis un navigateur.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    Dans le menu de gauche, cliquez sur <em>Importer</em>, puis sélectionnez votre fichier <code>.csv</code>.
                                </div>
                            </li>
                            <li class=\"list-group-item border-0 px-0\">
                                <div class=\"ms-2\">
                                    Les contacts s\x27ajoutent à votre compte Google et se <strong>synchronisent automatiquement</strong> sur votre téléphone Android. ✅
                                </div>
                            </li>
                        </ol>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

";
        // line 275
        yield "<div class=\"text-center mb-2\">
    <a href=\"";
        // line 276
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_contact");
        yield "\" class=\"btn btn-outline-secondary\">
        <i class=\"fas fa-arrow-left me-1\"></i> Retour à mes contacts
    </a>
</div>

";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "private/guide_import_contacts.html.twig";
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
        return array (  364 => 276,  361 => 275,  324 => 239,  289 => 205,  268 => 185,  255 => 173,  203 => 122,  182 => 102,  173 => 94,  159 => 82,  148 => 73,  138 => 65,  126 => 55,  111 => 41,  90 => 21,  76 => 9,  73 => 8,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "private/guide_import_contacts.html.twig", "/home/runner/workspace/repos/dressur_api/templates/private/guide_import_contacts.html.twig");
    }
}
