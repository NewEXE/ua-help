<?php

namespace App\Support\SEOTools;

/**
 * SEOMeta provides implementation for `MetaTags` contract.
 * Adds custom meta-tags like <meta name="googlebot"> to parent class realization.
 *
 * @see \Artesaos\SEOTools\Contracts\MetaTags
 */
class SEOMeta extends \Artesaos\SEOTools\SEOMeta
{
    /**
     * {@inheritdoc}/
     */
    public function generate($minify = false)
    {
        $generated = parent::generate($minify);

        $html = [];

        $robots = $this->getRobots();

        if ($robots !== '') {
            $html[] = '<meta name="googlebot" content="'.$robots.'">';
        }

        $eol = $minify ? '' : PHP_EOL;

        if ($generated !== '') {
            $generated .= $eol;
        }

        $generated .= implode($eol, $html);

        return $generated;
    }
}
