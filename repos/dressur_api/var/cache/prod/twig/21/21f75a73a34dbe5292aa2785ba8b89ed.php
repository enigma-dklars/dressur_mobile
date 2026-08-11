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

/* base.html.twig */
class __TwigTemplate_82d858b039e49d4d89ae51a77a8b1290 extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'referencement' => [$this, 'block_referencement'],
            'robots_meta' => [$this, 'block_robots_meta'],
            'style' => [$this, 'block_style'],
            'jsonld' => [$this, 'block_jsonld'],
            'body' => [$this, 'block_body'],
            'script' => [$this, 'block_script'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!doctype html>
<html lang=\"fr\" class=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["theme"] ?? null), "html", null, true);
        yield "\">
    <head>
        <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\x27gtm.start\x27:
            new Date().getTime(),event:\x27gtm.js\x27});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!=\x27dataLayer\x27?\x27&l=\x27+l:\x27\x27;j.async=true;j.src=
            \x27https://www.googletagmanager.com/gtm.js?id=\x27+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,\x27script\x27,\x27dataLayer\x27,\x27GTM-T734ZNFG\x27);</script>
        <!-- End Google Tag Manager -->
        
        <!-- Required meta tags -->
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>";
        // line 15
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield " | Dressur Web</title>
        ";
        // line 16
        yield from $this->unwrap()->yieldBlock('referencement', $context, $blocks);
        // line 17
        yield "        ";
        yield from $this->unwrap()->yieldBlock('robots_meta', $context, $blocks);
        // line 21
        yield "        <link rel=\"canonical\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 21), "schemeAndHttpHost", [], "any", false, false, false, 21) . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 21), "pathInfo", [], "any", false, false, false, 21)), "html", null, true);
        yield "\" />
        <link rel=\"icon\" href=\"/assets/images/dressur_logo_blanc.png\" type=\"image/png\" />

        <!--plugins-->
        <link href=\"/assets/plugins/simplebar/css/simplebar.css\" rel=\"stylesheet\" />
        <link href=\"/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css\" rel=\"stylesheet\" />
        <link href=\"/assets/plugins/metismenu/css/metisMenu.min.css\" rel=\"stylesheet\" />
        <link href=\"/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css\" rel=\"stylesheet\" />
        <link href=\"/assets/plugins/datatable/css/dataTables.bootstrap5.min.css\" rel=\"stylesheet\" />
        <!-- Bootstrap CSS -->
        <link href=\"/assets/css/bootstrap.min.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/bootstrap-extended.css\" rel=\"stylesheet\" />
        <link href=\"https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap\" rel=\"stylesheet\">
        <link href=\"/assets/css/style.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/icons.css\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" href=\"/assets/bootstrap-icons191/font/bootstrap-icons.css\">
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css\" integrity=\"sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" />

        <!-- loader-->
        <link href=\"/assets/css/pace.min.css\" rel=\"stylesheet\" />

        <!--Theme Styles-->
        <link href=\"/assets/css/dark-theme.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/light-theme.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/semi-dark.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/preloader.css\" rel=\"stylesheet\" />
        <link href=\"/assets/css/my-css.css\" rel=\"stylesheet\" />

        ";
        // line 49
        yield from $this->unwrap()->yieldBlock('style', $context, $blocks);
        // line 50
        yield "        ";
        yield from $this->unwrap()->yieldBlock('jsonld', $context, $blocks);
        // line 51
        yield "    </head>

    <body class=\"\">
        <!--start wrapper-->
        <div class=\"wrapper\">
            ";
        // line 56
        yield from $this->load("public/_includes/header_public.html.twig", 56)->unwrap()->yield($context);
        // line 57
        yield "            
            <!--start content-->
            <main class=\"\">
                ";
        // line 60
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 61
        yield "            </main>
            <!--end page main-->

            ";
        // line 64
        yield from $this->load("public/_includes/footer_public.html.twig", 64)->unwrap()->yield($context);
        // line 65
        yield "        </div>
        <!--end wrapper-->

        <!-- Bootstrap bundle JS -->
        <script src=\"/assets/js/bootstrap.bundle.min.js\"></script>
        <!--plugins-->
        <script src=\"/assets/js/jquery.min.js\"></script>
        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js\"></script>
        <script src=\"/assets/js/pace.min.js\"></script>
        <script src=\"/assets/js/sweetalert.js\"></script>
        <script src=\"/assets/js/custum-js-ds.js\"></script>
        
        ";
        // line 77
        yield from $this->unwrap()->yieldBlock('script', $context, $blocks);
        // line 78
        yield "    </body>
</html>";
        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_referencement(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_robots_meta(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 18
        yield "        <meta name=\"robots\" content=\"index, follow\">
        <meta name=\"googlebot\" content=\"index, follow\">
        ";
        yield from [];
    }

    // line 49
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_style(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 50
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_jsonld(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 60
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 77
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_script(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  223 => 77,  213 => 60,  203 => 50,  193 => 49,  186 => 18,  179 => 17,  169 => 16,  159 => 15,  153 => 78,  151 => 77,  137 => 65,  135 => 64,  130 => 61,  128 => 60,  123 => 57,  121 => 56,  114 => 51,  111 => 50,  109 => 49,  77 => 21,  74 => 17,  72 => 16,  68 => 15,  52 => 2,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "base.html.twig", "/home/runner/workspace/repos/dressur_api/templates/base.html.twig");
    }
}
