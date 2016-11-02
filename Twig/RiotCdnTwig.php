<?php

namespace Keiwen\RiotApiBundle\Twig;

use Keiwen\RiotApi\Cdn\AbstractCdn;

class RiotCdnTwig extends \Twig_Extension
{

    /** @var AbstractCdn $cdn */
	protected $cdn;

    public function __construct(AbstractCdn $cdn)
    {
		$this->cdn = $cdn;
    }

    /**
     * @return string
     */
	public function getName()
    {
		return 'riot_cdn_twig_extension';
	}

    /**
     * @return array
     */
	public function getFilters()
    {
		return array(
            new \Twig_SimpleFilter('profileIcon', array($this->cdn, 'getProfileIconUrl')),
            new \Twig_SimpleFilter('champSquare', array($this->cdn, 'getChampSquareUrl')),
            new \Twig_SimpleFilter('champSplash', array($this->cdn, 'getChampSplashUrl')),
            new \Twig_SimpleFilter('champCard', array($this->cdn, 'getChampCardUrl')),
            new \Twig_SimpleFilter('passive', array($this->cdn, 'getPassiveUrl')),
            new \Twig_SimpleFilter('ability', array($this->cdn, 'getAbilityUrl')),
            new \Twig_SimpleFilter('item', array($this->cdn, 'getItemUrl')),
            new \Twig_SimpleFilter('mastery', array($this->cdn, 'getMasteryUrl')),
            new \Twig_SimpleFilter('rune', array($this->cdn, 'getRuneUrl')),
            new \Twig_SimpleFilter('map', array($this->cdn, 'getMapUrl')),
            new \Twig_SimpleFilter('uiIcon', array($this->cdn, 'getUiIconUrl')),
		);
	}




}