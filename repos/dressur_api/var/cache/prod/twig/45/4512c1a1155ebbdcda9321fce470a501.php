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

/* emails/templates_mail.html.twig */
class __TwigTemplate_c24c09f2f80fb99cbb618ed4efe16bf5 extends Template
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
            'contenu_mail' => [$this, 'block_contenu_mail'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Dressur</title>
        <style>
            * {
                font-family: \x27Poppins\x27, sans-serif;
            }
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            }
            .email-signature {
            width: 440px;
            margin: 0 auto;
            border: 1px solid #ccc;
            color: #808080;
            font-family: Arial, sans-serif;
            background: transparent !important;
            }
            .header {
            background-color: #fcfdff;
            color: #2a4b9a;
            font-size: 18pt;
            line-height: 22pt;
            padding: 10px;
            }
            .barre {
                width: 100%;
                height: 8px; /* Hauteur de la barre */
                background-color: #2a4b9a;
            }
            .body {
            padding: 10px;
            }
            .contenu_mail{
                color: #000000;
            }
            .body table {
            width: 100%;
            }
            .body td {
            font-size: 12pt;
            font-family: Arial, sans-serif;
            color: #808080;
            line-height: 14pt;
            padding-bottom: 2px;
            }
            .social-icons img {
            border: 0;
            width: 20px;
            height: 20px;
            }
            .footer {
            font-size: 9pt;
            color: #000000; 
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            }
            a{
                text-decoration: none; 
                color: #2a4b9a !important;
            }
        </style>
    </head>
   
    <div class=\"email-signature\">
        <div class=\"barre\"></div>
        <div class=\"header\">
            <table>
                <th>
                    <td><img src=\"https://dressur.site/assets/images/ds_logo1.png\" height=\"60\" title=\"#\" alt=\"#\"></td>
                </th>
                <th>
                    <td><strong> Dressur</strong></td>
                </th>
            </table>
        </div>

        <div class=\"body\">
            <div class=\"contenu_mail\">
                ";
        // line 86
        yield from $this->unwrap()->yieldBlock('contenu_mail', $context, $blocks);
        // line 87
        yield "            </div>
            <table>
                <tr>
                    <td width=\"260\">
                        <span style=\"color: #2a4b9a; font-weight:bolder;\">Dressur</span>
                    </td>
                    <td width=\"160\" style=\"text-align: right;\">
                        <table class=\"social-icons\">
                        <tr>
                            <td><a href=\"https://www.facebook.com/dressurds\" target=\"_blank\" rel=\"noopener\"><img src=\"https://dressur.site/assets/images/icon_facebook.png\" alt=\"facebook icon\"></a></td>
                        </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td colspan=\"2\" style=\"padding-top: 15px; border-top: solid 1px #2a4b9a; font-size: 13px;\">
                        <span><strong>Site Web :</strong> <a href=\"https://dressur.site\"> Dressur Web </a> </span>
                        <span><strong>Google Play :</strong> <a href=\"https://play.google.com/store/apps/details?id=com.dressur.ds\"> Dressur Mobile </a></span> <br>

                        <span><strong>Appel :</strong> <a href=\"tel:+22964044294\"> +229 64 04 42 94 </a> | </span>

                        <span><strong>WhatsApp :</strong> <a href=\"https://wa.me/+22964044294\"> +229 64 04 42 94 </a> </span> <br>

                        <span><strong>Email:</strong> <a href=\"mailto:dressur.ds@gmail.com\" style=\"text-decoration: none;\">dressur.ds@gmail.com</a></span> <br>

                        <span><strong>Dressur</strong>, Cotonou, Bénin</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class=\"footer\">
            <p>
                Dressur © ";
        // line 121
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " - 
                <a href=\"https://dressur.site/conditions-utilisation\">Termes et Conditions</a> | 
                <a href=\"https://dressur.site/politique-confidentialite\">Politique de confidentialité.</a> 
            </p>
        </div>
    </div>
</html>";
        yield from [];
    }

    // line 86
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_contenu_mail(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/templates_mail.html.twig";
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
        return array (  180 => 86,  168 => 121,  132 => 87,  130 => 86,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "emails/templates_mail.html.twig", "/home/runner/workspace/repos/dressur_api/templates/emails/templates_mail.html.twig");
    }
}
