<?php /* Template Name: Static */


function removeWhitespace($buffer)
{
    return preg_replace('~>\s*\n\s*<~', '><', $buffer);
}

ob_start('removeWhitespace');
get_header();
get_template_part('template-parts/content', 'hero-static');
get_template_part('template-parts/content', 'page-static');

get_footer();
ob_end_flush();