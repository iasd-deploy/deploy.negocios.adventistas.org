<?php

// This example is registering a option page using ACF. Please see the
// documentation for more information:
// https://www.advancedcustomfields.com/resources/acf_add_options_page/


use Extended\ACF\Fields\Select;
use Extended\ACF\Location;


class PaAcfSiteMinistries {
	public function __construct(){
        add_action('init', [$this, 'createAcfFields' ], 998);
	}

    function createAcfFields(){
        register_extended_field_group([
            'title' => __('Ministry select', 'iasd'),
            'style' => 'default',
            'fields' => [
                Select::make(__('Ministry', 'iasd'), 'departamento')
                    ->choices([
                        'institucional' => __('Institucional', 'iasd'),
                        'depto-adolescente' => __('Adolescente', 'iasd'),
                        'depto-adra' => __('ADRA', 'iasd'),
                        'depto-afam' => __('AFAM', 'iasd'),
                        'depto-asa' => __('ASA', 'iasd'),
                        'depto-associacao-ministerial' => __('Associação Ministerial', 'iasd'),
                        'depto-aventureiro' => __('Aventureiros', 'iasd'),
                        'depto-comunicacao' => __('Comunicação', 'iasd'),
                        'depto-crianca' => __('Criança', 'iasd'),
                        'depto-desbravador' => __('Desbravadores', 'iasd'),
                        'depto-educacao' => __('Educação', 'iasd'),
                        'depto-escola-sabatina' => __('Escola Sabatina', 'iasd'),
                        'depto-espirito-profecia' => __('Espirito de Profecia', 'iasd'),
                        'depto-evangelismo' => __('Evangelismo', 'iasd'),
                        'depto-familia' => __('Família', 'iasd'),
                        'depto-jovem' => __('Jovens', 'iasd'),
                        'depto-liberdade-religiosa' => __('Liberdade Religiosa', 'iasd'),
                        'depto-map' => __('Ministério Adventista das Possibilidades', 'iasd'),
                        'depto-ministerio-pessoal' => __('Ministério Pessoal', 'iasd'),
                        'depto-missao-global' => __('Missão Global', 'iasd'),
                        'depto-mordomia' => __('Mordomia', 'iasd'),
                        'depto-mulher' => __('Mulher', 'iasd'),
                        'depto-musica' => __('Música', 'iasd'),
                        'depto-publicacoes' => __('Publicações', 'iasd'),
                        'depto-recepcao' => __('Recepção', 'iasd'),
                        'depto-salt' => __('SALT', 'iasd'),
                        'depto-saude' => __('Saúde', 'iasd'),
                        'depto-universitario' => __('Universitários', 'iasd'),
                        'depto-voluntario' => __('Voluntários', 'iasd'),
                    ])
                    ->returnFormat('value'), // array, label or value (default)
            ],
            'location' => [
                Location::where('options_page', '==', 'iasd_custom_settings'),
            ],
        ]);
    }
}
$PaAcfSiteMinistries = new PaAcfSiteMinistries();
