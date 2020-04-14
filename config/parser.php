<?php
return [
    [
        'name'    => 'brand',
        'pattern' => '{brand}\s+{model}\s+{width}/{height}\s*{construct}{diameter}\s+{loadIdx}{speedIdx}\s*{abbr}?\s*{runflat}?\s*.*?\s*{camera}?\s*{season}',
        'tokens'  => [
            'brand'     => 'Nokian|BFGoodrich|Pirelli|Toyo|Continental|Hankook|Mitas',
            'model'     => '.*?',
            'width'     => '\d+',
            'height'    => '\d+',
            'construct' => '[a-zA-Z]+',
            'diameter'  => '\d+',
            'loadIdx'   => '\d+',
            'speedIdx'  => '[a-zA-Z]+',
            'abbr'      => '[a-z]+',
            'runflat'   => 'RunFlat|Run Flat|ROF|ZP|SSR|ZPS|HRS|RFT',
            'camera'    => 'TT|TL|TL/TT',
            'season'    => 'Зимние \(шипованные\)|Внедорожные|Летние|Зимние \(нешипованные\)|Всесезонные',
        ],
    ],
];
