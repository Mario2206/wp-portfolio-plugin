<?php


namespace PortfolioPlugin;


/**
 * Class DBLinker
 * @package PortfolioPlugin
 */
class DBLinker
{

    /**
     * @var
     */
    private $authorData;
    /**
     * @var
     */
    private $themeData;

    /**
     * DBLinker constructor.
     * @param $authorData
     * @param $themeData
     */
    public function __construct($authorData, $themeData)
    {
        $this->authorData = $authorData;
        $this->themeData = $themeData;
    }

    /**
     * @return $this
     */
    public function updateAuthorData() {
        foreach ($this->authorData as $k => $auth) {
            $this->authorData[$k]["value"] = get_option($k);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function  updateThemeData() {
        foreach ($this->themeData as $k => $theme) {
            $this->themeData[$k]["value"] = get_option($k);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorData()
    {
        return $this->authorData;
    }

    /**
     * @return mixed
     */
    public function getThemeData()
    {
        return $this->themeData;
    }
}