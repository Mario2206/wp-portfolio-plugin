<?php

/**
 * Slug for option group
 */
const PLUGIN_SLUG = 'portfolio_author_data';

/**
 * Author data for form
 */
const P_AUTHOR_DATA = [
    "p_author_firstname" => [
        "value" => "",
        "label" => "Prénom",
        "placeholder" => "Prénom",
        "type" => "text",
        "class" => "p-author-label"
    ],
    "p_author_lastname" => [
        "value" => "",
        "label" => "Nom de famille",
        "placeholder" => "Nom de famille",
        "type" => "text",
        "class" => "p-author-label"
    ],
    "p_author_job" => [
        "value" => "",
        "label" => "Métier",
        "placeholder" => "Métier",
        "type" => "text",
        "class" => "p-author-label"
    ],
    "p_author_skills" => [
      "value" => "",
      "label" => "Compétences",
      "placeholder" => "compétences",
      "type" => "formfield",
        "class" => "p-author-label"
    ],
    "p_author_img" => [
        "value"=> "",
        "label" => "Portrait",
        "placeholder" => "Upload",
        "type" => "file",
        "class" => "p-author-label p-upload",
        "id" => "upload_portrait"
    ]
];

/**
 * Theme data for form
 */
const P_THEME_DATA = [
    
    "p_first_font_color" => [
        "value" => "#000000",
        "label" => "Première couleur de texte",
        "placeholder" => "",
        "type" => "color",
        "class" => "p-theme-label"
    ],
    "p_sec_font_color" => [
        "value" => "#FFFFFF",
        "label" => "Seconde couleur de texte",
        "placeholder" => "",
        "type" => "color",
        "class" => "p-theme-label"
    ],
    "p_first_back_color" => [
        "value" => "#000000",
        "label" => "Première couleur de fond",
        "placeholder" => "",
        "type" => "color",
        "class" => "p-theme-label"
    ],
    "p_sec_back_color" => [
        "value" => "#FFFFFF",
        "label" => "Seconde couleur de fond",
        "placeholder" => "",
        "type" => "color",
        "class" => "p-theme-label"
    ]

];

