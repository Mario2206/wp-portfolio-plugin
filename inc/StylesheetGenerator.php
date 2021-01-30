<?php


namespace PortfolioPlugin;


class StylesheetGenerator
{

    public static function generateStaticFile($colors) {
        $path = dirname(plugin_dir_path( __FILE__ ) ).'/style/custom-style.css';

        file_put_contents($path, self::generateStylesheet($colors));
    }

    private static function generateStylesheet($colors) {
        $content = ":root {\n";
        foreach($colors as $k=> $color) {
            $content.= "--$k : " .$color['value'] . ";\n";
        }
        return $content . "\n}";
    }
}