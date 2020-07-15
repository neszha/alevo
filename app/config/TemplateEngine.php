<?php 

return [

    /*
    |--------------------------------------------------------------------------
    | Use Template Engine
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

    'USE_TEMPLATE_ENGINE' => false,
    
    /*
    |--------------------------------------------------------------------------
    | Setup Template Engine on FIle
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

    'MINIFY_FILE_ON_RENDER' => [

        'PHP' => [

            'minify'           => true,
            'remove_comment'   => true,
            'remove_null_line' => true,

        ],

        'HTML' => [

            'minify'           => true,
            'remove_comment'   => true,
            'remove_null_line' => true,

        ],

        'CSS' => [

            'minify'           => true,
            'remove_comment'   => true,
            'remove_null_line' => true,

        ],

        'JS' => [

            'minify'           => true,
            'remove_comment'   => true,
            'remove_null_line' => true,

        ],

        'JSON' => [

            'minify'           => true,
            'remove_null_line' => true,

        ],

    ],

   /*
    |--------------------------------------------------------------------------
    | Minify View Code
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

    'VIEWS' => [

        'minify'           => true,
        'remove_comment'   => true,
        'remove_null_line' => true,
        'use_code_replace' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Minify Resource Code
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo cairo_font_options_equal(options, other)at. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */


    'RESOURCE' => [

        'minify' => true,
        'use_setting_minify_file'   => true,

    ],

    /*
    |--------------------------------------------------------------------------
    | Remove Commnet Code
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

    'EXCEPT_FILE_FORMAT' => 'exc',

    /*
    |--------------------------------------------------------------------------
    | Replace Code
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */
    
    'CODE_REPLACE' => [

        '{{{__@__}}}'   => '<?php__@__?>',
        
        '{{__@__}}'     => '<?=__@__?>',
        
        '@else'         => '<?php else: ?>',
        
        '@baseurl'      => '<?= base_url() ?>',
        
        '@assets'       => '<?= assets() ?>',
        
        '@cacheversion' => '<?= cache_version() ?>',
        
        '@view__@__'    => '<?php $this->view__@__ ?>',
        
        '@foreach__@__' => '<?php foreach__@__ :?>',
        '@endforeach'   => '<?php endforeach; ?>',
        
        '@for__@__'     => '<?php for__@__ :?>',
        '@endfor'       => '<?php endfor; ?>',
        
        '@if__@__'      => '<?php if__@__ :?>',
        '@endif'        => '<?php endif; ?>',
        
        '@php'          => '<?php',
        '@endphp'       => '?>',
        
        '@url'          => '<?= url() ?>',        
    ],

];