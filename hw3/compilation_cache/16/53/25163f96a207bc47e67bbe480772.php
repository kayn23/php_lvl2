<?php

/* base.twig */
class __TwigTemplate_165325163f96a207bc47e67bbe480772 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
  <title>Document</title>
  <style>
    .img_small {
      width: 33%;
    }
  </style>
</head>
<body>
  ";
        // line 15
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "</body>
</html>";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "  ";
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function getDebugInfo()
    {
        return array (  46 => 16,  43 => 15,  38 => 17,  20 => 1,  41 => 5,  36 => 15,  31 => 3,  28 => 2,);
    }
}
