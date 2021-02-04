<?php 

namespace PortfolioPlugin;

/**
 * Class Form
 * @package PortfolioPlugin
 */
class Form {

    /**
     * @var array|mixed
     */
    private $authorData;
    /**
     * @var array|mixed
     */
    private $themeData;

    /**
     * Form constructor.
     * @param array $authorData
     * @param array $themeData
     */
    public function __construct($authorData = [], $themeData = []) {
        $this->authorData = $authorData;
        $this->themeData = $themeData;
    }

    public function generateAuthorInputs() {
        $this->doGeneration($this->authorData);
    }

    public function generateThemeInput() {
        $this->doGeneration($this->themeData);
    }

    /**
     * @param $data
     */
    private function doGeneration($data) {
        foreach ($data as $k => $item) {
            echo $this->generateInput(
                $item['label'],
                $item['type'],
                $k,
                $item["value"] ,
                isset($item['placeholder']) ? $item['placeholder'] : null,
                isset($item['class']) ? $item['class'] : null,
                isset( $item['id'] ) ? $item['id'] : null);
        }
    }

    /**
     * @param $label
     * @param $type
     * @param $name
     * @param null | string | number  $value
     * @param null | string $placeholder
     * @param null | string $class
     * @return string
     */
    private function generateInput($label, $type, $name, $value = null , $placeholder = null, $class = null, $id = null )  {

        if($type === 'file') {
            $imageSrc = get_option($name);

            return "
                <div class='$class'>
                    <label>$label</label>
                    <input type='hidden' name='$name' id='$id'/>
                    <div id='$id-view'>
                    "
                    .
                    ($imageSrc ? "<img src='$imageSrc' />" : "")
                    .
                    "
                    </div>
                    <button type='button'  id='$id-button'>$placeholder</button>
                </div>
            ";
        }

        return  "
            <div class='$class'>
                <label>$label</label>
                <input type='$type' name='$name' placeholder='$placeholder' value='$value' id='$id' />
            </div>
            
        ";
    }
}