<?php

/* img_small.twig */
class __TwigTemplate_dd591bae8bb23ba6d41d4424b3244c01 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "  ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["picture"]) ? $context["picture"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
            // line 4
            echo "  <a href=\"img/small/";
            echo twig_escape_filter($this->env, (isset($context["img"]) ? $context["img"] : null), "html", null, true);
            echo "\">
    <img class=\"img_small\" src=\"img/small/";
            // line 5
            echo twig_escape_filter($this->env, (isset($context["img"]) ? $context["img"] : null), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, (isset($context["img"]) ? $context["img"] : null), "html", null, true);
            echo "\">
  </a>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "img_small.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 5,  36 => 4,  31 => 3,  28 => 2,);
    }
}
