{"filter":false,"title":"footer.php","tooltip":"/symfony4/public/news/wp-content/themes/capsule/footer.php","undoManager":{"mark":33,"position":33,"stack":[[{"start":{"row":36,"column":33},"end":{"row":36,"column":34},"action":"insert","lines":["T"],"id":2}],[{"start":{"row":36,"column":33},"end":{"row":36,"column":34},"action":"remove","lines":["T"],"id":3},{"start":{"row":36,"column":32},"end":{"row":36,"column":33},"action":"remove","lines":["t"]}],[{"start":{"row":36,"column":32},"end":{"row":36,"column":33},"action":"insert","lines":["T"],"id":4}],[{"start":{"row":2,"column":8},"end":{"row":55,"column":14},"action":"remove","lines":["<a href=\"<?= get_option('Home');?>\">","            <div id=\"tituloFooter\">","                <h1 class=\"h1\"><?= get_bloginfo('name'); ?></h1>","            </div>","        </a>","        <div id=\"logos\">","            <div><a href=\"#\"><img src=\"<?= get_template_directory_uri(); ?>/images/facebook-logo.svg\" class=\"logo\"></a></div>","            <div><a href=\"#\"><img src=\"<?= get_template_directory_uri(); ?>/images/instagram-social-network-logo-of-photo-camera.svg\" class=\"logo\"></a></div>","            <div><a href=\"#\"><img src=\"<?= get_template_directory_uri(); ?>/images/linkedin-logo.svg\" class=\"logo\"></a></div>","            <div><a href=\"#\"><img src=\"<?= get_template_directory_uri(); ?>/images/pinterest-circular-logo-symbol.svg\" class=\"logo\"></a></div>","            <div><a href=\"#\"><img src=\"<?= get_template_directory_uri(); ?>/images/twitter-logo-silhouette.svg\" class=\"logo\"></a></div>","        </div>","        <div id=\"footerInfo\">","            <div id=\"col1\">","                <div class=\"info\">","                    <h3><?= __('Navegación', 'zapa'); ?></h3>","                    <ul>","                        <li><a href=\"<?php echo get_option('Home');?>\"><?= __('Inicio', 'zapa'); ?></a></li>","                        <li><a href=\"<?= get_page_link(get_page_by_title('Galería')->ID) ?>\"><?= __('Galería', 'zapa'); ?></a></li>","                        <li><a href=\"https://pdz-scorpions.c9users.io/tienda/\"><?= __('Tienda', 'zapa'); ?></a></li>","                        <li><a href=\"<?= get_page_link(get_page_by_title('Contact')->ID) ?>\"><?= __('Contacto', 'zapa'); ?></a></li>","                    </ul>","                </div>","                <div class=\"info\">","                    <h3><?= __('Comunidad', 'zapa'); ?></h3>","                    <ul>","                        <li><a href=\"<?= get_page_link(get_page_by_title('Archives')->ID) ?>\"><?= __('Archivos', 'zapa'); ?></a></li>","                        <li><a href=\"<?php echo get_page_link(get_page_by_title('Blog')->ID);?>\"><?= __('Blog', 'zapa'); ?></a></li>","                        <li><a href=\"<?= get_page_link(get_page_by_title('Privado')->ID) ?>\"><?= __('Privado', 'zapa'); ?></a></li>","                    </ul>","                </div>    ","            </div>","            <!--<div id=\"col2\">","                <div class=\"info\">","                    <h3><?= __('Titulo de la columna3', 'zapa'); ?></h3>","                    <ul>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                    </ul>","                </div>","                <div class=\"info\">","                    <h3><?= __('Inicio', 'zapa'); ?>titulo de la columna4</h3>","                    <ul>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                        <li><a href=\"\"><?= __('Elemento 1', 'zapa'); ?></a></li>","                    </ul>","                </div>    ","            </div>-->","        </div>","        <div id=\"copyright\">","            <p>© 2019 <?= get_bloginfo('name'); ?>. <?= __('Todos los derechos reservados', 'zapa'); ?>.</p>","        </div>"],"id":5},{"start":{"row":2,"column":8},"end":{"row":33,"column":6},"action":"insert","lines":["<div class=\"footer\">","    <div class=\"logo-footer\">","        <img src=\"{{asset('/assets/img/logo-white.png')}}\">","    </div>","    <div class=\"info-footer\">","        <p>It's connected</p>","    </div>","</div>","","<div class=\"footer2\">","    <div class=\"nav2\">","        <p class=\"navinfo\">Navigation</p>","        <ul>","            <li><a class=\"linksMenu\" href=\"/\">Home</a></li>","            <li><a class=\"linksMenu\" href=\"/news\">News</a></li>","            <li><a class=\"linksMenu\" href=\"/news/upcomings/\">News - Upcomings</a></li>","        </ul>","    </div>","    <div class=\"capsule-social\">","        <a href=\"#\"><img src=\"{{asset('/assets/img/facebook.png')}}\"></a>","        <a href=\"#\"><img src=\"{{asset('/assets/img/instagram.png')}}\"></a>","        <a href=\"#\"><img src=\"{{asset('/assets/img/twitter.png')}}\"></a>","    </div>","    <div class=\"address\">","        <p class=\"navinfo\">Adress</p>","        <p class=\"single-address\">Granada, Andalucía Spain</p>","        <p class=\"single-address\">Barcelona, Catalonia Spain</p>","    </div>","    <div class=\"endfooter\">","        <p>Capsule Copyleft - 2019</p>","    </div>","</div>"]}],[{"start":{"row":0,"column":4},"end":{"row":0,"column":8},"action":"remove","lines":["    "],"id":6},{"start":{"row":0,"column":0},"end":{"row":0,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":1,"column":4},"end":{"row":1,"column":8},"action":"remove","lines":["    "],"id":7},{"start":{"row":1,"column":0},"end":{"row":1,"column":4},"action":"remove","lines":["    "]}],[{"start":{"row":2,"column":4},"end":{"row":2,"column":8},"action":"remove","lines":["    "],"id":8}],[{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"insert","lines":["    "],"id":9},{"start":{"row":4,"column":0},"end":{"row":4,"column":4},"action":"insert","lines":["    "]},{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"insert","lines":["    "]},{"start":{"row":6,"column":0},"end":{"row":6,"column":4},"action":"insert","lines":["    "]},{"start":{"row":7,"column":0},"end":{"row":7,"column":4},"action":"insert","lines":["    "]},{"start":{"row":8,"column":0},"end":{"row":8,"column":4},"action":"insert","lines":["    "]},{"start":{"row":9,"column":0},"end":{"row":9,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":11,"column":0},"end":{"row":11,"column":4},"action":"insert","lines":["    "],"id":10},{"start":{"row":12,"column":0},"end":{"row":12,"column":4},"action":"insert","lines":["    "]},{"start":{"row":13,"column":0},"end":{"row":13,"column":4},"action":"insert","lines":["    "]},{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]},{"start":{"row":32,"column":0},"end":{"row":32,"column":4},"action":"insert","lines":["    "]},{"start":{"row":33,"column":0},"end":{"row":33,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":35,"column":8},"end":{"row":35,"column":12},"action":"remove","lines":["    "],"id":11},{"start":{"row":35,"column":4},"end":{"row":35,"column":8},"action":"remove","lines":["    "]}],[{"start":{"row":11,"column":0},"end":{"row":11,"column":4},"action":"insert","lines":["    "],"id":12},{"start":{"row":12,"column":0},"end":{"row":12,"column":4},"action":"insert","lines":["    "]},{"start":{"row":13,"column":0},"end":{"row":13,"column":4},"action":"insert","lines":["    "]},{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]},{"start":{"row":32,"column":0},"end":{"row":32,"column":4},"action":"insert","lines":["    "]},{"start":{"row":33,"column":0},"end":{"row":33,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":34,"column":4},"end":{"row":34,"column":8},"action":"insert","lines":["    "],"id":13}],[{"start":{"row":11,"column":0},"end":{"row":11,"column":4},"action":"insert","lines":["    "],"id":14},{"start":{"row":12,"column":0},"end":{"row":12,"column":4},"action":"insert","lines":["    "]},{"start":{"row":13,"column":0},"end":{"row":13,"column":4},"action":"insert","lines":["    "]},{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]},{"start":{"row":32,"column":0},"end":{"row":32,"column":4},"action":"insert","lines":["    "]},{"start":{"row":33,"column":0},"end":{"row":33,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"insert","lines":["    "],"id":15},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"insert","lines":["    "]},{"start":{"row":4,"column":0},"end":{"row":4,"column":4},"action":"insert","lines":["    "]},{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"insert","lines":["    "]},{"start":{"row":6,"column":0},"end":{"row":6,"column":4},"action":"insert","lines":["    "]},{"start":{"row":7,"column":0},"end":{"row":7,"column":4},"action":"insert","lines":["    "]},{"start":{"row":8,"column":0},"end":{"row":8,"column":4},"action":"insert","lines":["    "]},{"start":{"row":9,"column":0},"end":{"row":9,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":2,"column":0},"end":{"row":2,"column":4},"action":"insert","lines":["    "],"id":16},{"start":{"row":3,"column":0},"end":{"row":3,"column":4},"action":"insert","lines":["    "]},{"start":{"row":4,"column":0},"end":{"row":4,"column":4},"action":"insert","lines":["    "]},{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"insert","lines":["    "]},{"start":{"row":6,"column":0},"end":{"row":6,"column":4},"action":"insert","lines":["    "]},{"start":{"row":7,"column":0},"end":{"row":7,"column":4},"action":"insert","lines":["    "]},{"start":{"row":8,"column":0},"end":{"row":8,"column":4},"action":"insert","lines":["    "]},{"start":{"row":9,"column":0},"end":{"row":9,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":9,"column":18},"end":{"row":10,"column":0},"action":"remove","lines":["",""],"id":17}],[{"start":{"row":1,"column":0},"end":{"row":1,"column":4},"action":"insert","lines":["    "],"id":18}],[{"start":{"row":1,"column":4},"end":{"row":1,"column":8},"action":"insert","lines":["    "],"id":19}],[{"start":{"row":4,"column":38},"end":{"row":4,"column":39},"action":"remove","lines":["'"],"id":20},{"start":{"row":4,"column":37},"end":{"row":4,"column":38},"action":"remove","lines":["("]},{"start":{"row":4,"column":36},"end":{"row":4,"column":37},"action":"remove","lines":["t"]},{"start":{"row":4,"column":35},"end":{"row":4,"column":36},"action":"remove","lines":["e"]},{"start":{"row":4,"column":34},"end":{"row":4,"column":35},"action":"remove","lines":["s"]},{"start":{"row":4,"column":33},"end":{"row":4,"column":34},"action":"remove","lines":["s"]},{"start":{"row":4,"column":32},"end":{"row":4,"column":33},"action":"remove","lines":["a"]},{"start":{"row":4,"column":31},"end":{"row":4,"column":32},"action":"remove","lines":["{"]},{"start":{"row":4,"column":30},"end":{"row":4,"column":31},"action":"remove","lines":["{"]}],[{"start":{"row":4,"column":56},"end":{"row":4,"column":57},"action":"remove","lines":["'"],"id":21},{"start":{"row":4,"column":56},"end":{"row":4,"column":57},"action":"remove","lines":[")"]},{"start":{"row":4,"column":56},"end":{"row":4,"column":57},"action":"remove","lines":["}"]},{"start":{"row":4,"column":56},"end":{"row":4,"column":57},"action":"remove","lines":["}"]}],[{"start":{"row":20,"column":42},"end":{"row":20,"column":51},"action":"remove","lines":["{{asset('"],"id":22}],[{"start":{"row":20,"column":66},"end":{"row":20,"column":70},"action":"remove","lines":["')}}"],"id":23}],[{"start":{"row":21,"column":42},"end":{"row":21,"column":51},"action":"remove","lines":["{{asset('"],"id":24}],[{"start":{"row":21,"column":67},"end":{"row":21,"column":71},"action":"remove","lines":["')}}"],"id":25}],[{"start":{"row":22,"column":42},"end":{"row":22,"column":51},"action":"remove","lines":["{{asset('"],"id":26}],[{"start":{"row":22,"column":65},"end":{"row":22,"column":69},"action":"remove","lines":["')}}"],"id":27}],[{"start":{"row":16,"column":73},"end":{"row":16,"column":80},"action":"remove","lines":["News - "],"id":28}],[{"start":{"row":1,"column":17},"end":{"row":1,"column":23},"action":"remove","lines":["footer"],"id":29}],[{"start":{"row":27,"column":76},"end":{"row":28,"column":0},"action":"insert","lines":["",""],"id":30},{"start":{"row":28,"column":0},"end":{"row":28,"column":20},"action":"insert","lines":["                    "]}],[{"start":{"row":28,"column":20},"end":{"row":30,"column":76},"action":"insert","lines":["<p class=\"navinfo\">Adress</p>","                    <p class=\"single-address\">Granada, Andalucía Spain</p>","                    <p class=\"single-address\">Barcelona, Catalonia Spain</p>"],"id":31}],[{"start":{"row":28,"column":39},"end":{"row":28,"column":45},"action":"remove","lines":["Adress"],"id":32},{"start":{"row":28,"column":39},"end":{"row":28,"column":40},"action":"insert","lines":["C"]},{"start":{"row":28,"column":40},"end":{"row":28,"column":41},"action":"insert","lines":["o"]},{"start":{"row":28,"column":41},"end":{"row":28,"column":42},"action":"insert","lines":["n"]},{"start":{"row":28,"column":42},"end":{"row":28,"column":43},"action":"insert","lines":["t"]},{"start":{"row":28,"column":43},"end":{"row":28,"column":44},"action":"insert","lines":["a"]},{"start":{"row":28,"column":44},"end":{"row":28,"column":45},"action":"insert","lines":["c"]},{"start":{"row":28,"column":45},"end":{"row":28,"column":46},"action":"insert","lines":["t"]}],[{"start":{"row":29,"column":74},"end":{"row":30,"column":76},"action":"remove","lines":["","                    <p class=\"single-address\">Barcelona, Catalonia Spain</p>"],"id":33}],[{"start":{"row":29,"column":46},"end":{"row":29,"column":70},"action":"remove","lines":["Granada, Andalucía Spain"],"id":34},{"start":{"row":29,"column":46},"end":{"row":29,"column":47},"action":"insert","lines":["h"]},{"start":{"row":29,"column":47},"end":{"row":29,"column":48},"action":"insert","lines":["i"]},{"start":{"row":29,"column":48},"end":{"row":29,"column":49},"action":"insert","lines":["@"]},{"start":{"row":29,"column":49},"end":{"row":29,"column":50},"action":"insert","lines":["c"]},{"start":{"row":29,"column":50},"end":{"row":29,"column":51},"action":"insert","lines":["a"]},{"start":{"row":29,"column":51},"end":{"row":29,"column":52},"action":"insert","lines":["p"]},{"start":{"row":29,"column":52},"end":{"row":29,"column":53},"action":"insert","lines":["s"]},{"start":{"row":29,"column":53},"end":{"row":29,"column":54},"action":"insert","lines":["u"]},{"start":{"row":29,"column":54},"end":{"row":29,"column":55},"action":"insert","lines":["l"]},{"start":{"row":29,"column":55},"end":{"row":29,"column":56},"action":"insert","lines":["e"]},{"start":{"row":29,"column":56},"end":{"row":29,"column":57},"action":"insert","lines":["."]},{"start":{"row":29,"column":57},"end":{"row":29,"column":58},"action":"insert","lines":["c"]},{"start":{"row":29,"column":58},"end":{"row":29,"column":59},"action":"insert","lines":["o"]},{"start":{"row":29,"column":59},"end":{"row":29,"column":60},"action":"insert","lines":["m"]}],[{"start":{"row":26,"column":74},"end":{"row":27,"column":76},"action":"remove","lines":["","                    <p class=\"single-address\">Barcelona, Catalonia Spain</p>"],"id":35}]]},"ace":{"folds":[],"scrolltop":60,"scrollleft":0,"selection":{"start":{"row":26,"column":74},"end":{"row":26,"column":74},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":3,"state":"start","mode":"ace/mode/php"}},"timestamp":1559394854515,"hash":"1abb3f0d0c79af11d0adf5512ac231c0d6f2f8ed"}