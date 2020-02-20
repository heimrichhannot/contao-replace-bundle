<?php

/*
 * Copyright (c) 2020 Heimrich & Hannot GmbH
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ReplaceBundle\EventListener;

use Contao\Config;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\StringUtil;

class HookListener
{
    /**
     * @var ContaoFrameworkInterface
     */
    private $framework;

    /**
     * Constructor.
     *
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Modify the front end template output buffer.
     *
     * @param string $buffer   The front end template buffer
     * @param string $template Name of current front end template
     *
     * @return string Modified front end template buffer
     */
    public function modifyFrontendPage($buffer, $template)
    {
        if (!Config::has('replace')) {
            return $buffer;
        }

        $arrConfig = StringUtil::deserialize(Config::get('replace'), true);

        $esiTagCache = [];
        $esiTagCacheIndex = 0;

        // mask esi tags, otherwise no body element is found
        $buffer = preg_replace_callback(
            '#<esi:((?!\/>).*)\s?\/>#sU',
            function ($matches) use (&$esiTagCache, &$esiTagCacheIndex) {
                $esiTagCache[$esiTagCacheIndex] = $matches[0];
                ++$esiTagCacheIndex;

                return '####esi:open####'.($esiTagCacheIndex - 1).'####esi:close####';
            },
            $buffer
        );

        preg_match('#(?<BTAG><body[^<]*>)(?<BCONTENT>.*)<\/body>#s', $buffer, $arrElements);
        if (!isset($arrElements['BTAG']) && !isset($arrElements['BCONTENT'])) {
            return $buffer;
        }
        $strTag = $arrElements['BTAG'];
        $strBody = $arrElements['BCONTENT']; // replace body content only
        foreach ($arrConfig as $name => $config) {
            if (!isset($config['search'])) {
                continue;
            }
            $search = '#'.$config['search'];
            if (!$config['tags']) {
                $search .= '(?![^<]*>)';  // ignore html tags
            }
            $search .= '#sU'; // single line & ungreedy match
            $matches = [];
            preg_match($search, $strBody, $matches);

            $strBody = preg_replace($search, $config['replace'], $strBody);
        }

        $buffer = preg_replace('#<body[^<]*>(?<BCONTENT>.*)<\/body>#s', $strTag.$strBody.'</body>', $buffer);

        $buffer = preg_replace_callback(
            '/####esi:open####(.*)####esi:close####/',
            function ($matches) use ($esiTagCache) {
                return $esiTagCache[$matches[1]];
            },
            $buffer
        );

        return $buffer;
    }
}
