{"filter":false,"title":"archive-criticas.php","tooltip":"/symfony4/public/news/wp-content/themes/Diso/archive-criticas.php","undoManager":{"mark":39,"position":39,"stack":[[{"start":{"row":29,"column":29},"end":{"row":29,"column":53},"action":"remove","lines":["Archivos de la categoría"],"id":3},{"start":{"row":29,"column":29},"end":{"row":29,"column":30},"action":"insert","lines":["A"]},{"start":{"row":29,"column":30},"end":{"row":29,"column":31},"action":"insert","lines":["r"]}],[{"start":{"row":40,"column":5},"end":{"row":41,"column":0},"action":"insert","lines":["",""],"id":4},{"start":{"row":41,"column":0},"end":{"row":41,"column":4},"action":"insert","lines":["    "]},{"start":{"row":41,"column":4},"end":{"row":42,"column":0},"action":"insert","lines":["",""]},{"start":{"row":42,"column":0},"end":{"row":42,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":42,"column":4},"end":{"row":54,"column":5},"action":"insert","lines":["if(is_category()){","        $archive_title = 'Archives for the category: '.single_cat_title('',false);","    } elseif(is_tag){","        $archive_title = 'Archives for the tag: '. single_cat_title('',false);","    } elseif(is_day){","        $archive_title = 'Archives of the day: '. get_the_date();","    } elseif(is_month){","        $archive_title = 'Archives of the month: '. get_the_date('F Y');","    } elseif(is_year){","        $archive_title = 'Archives of the year: '. get_the_date('Y');","    } else {","        $archive_title = 'Archives: ';","    }"],"id":5}],[{"start":{"row":28,"column":4},"end":{"row":41,"column":4},"action":"remove","lines":["if(is_category()){","        $archive_title = __('Ar: ', 'zapa').' '. single_cat_title('',false);","    } elseif(is_tag){","        $archive_title = __('Archivos de la etiqueta: ', 'zapa').' '. single_cat_title('',false);","    } elseif(is_day){","        $archive_title = __('Archivos del día: ', 'zapa').' '. get_the_date();","    } elseif(is_month){","        $archive_title = __('Archivos del mes: ', 'zapa').' '. get_the_date('F Y');","    } elseif(is_year){","        $archive_title = __('Archivos del año: ', 'zapa').' '. get_the_date('Y');","    } else {","        $archive_title = __('Archivos: ', 'zapa');","    }","    "],"id":6}],[{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"remove","lines":["    "],"id":7},{"start":{"row":27,"column":46},"end":{"row":28,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":28,"column":3},"end":{"row":28,"column":4},"action":"remove","lines":[" "],"id":8}],[{"start":{"row":29,"column":3},"end":{"row":29,"column":6},"action":"remove","lines":["   "],"id":9},{"start":{"row":29,"column":3},"end":{"row":29,"column":4},"action":"remove","lines":[" "]},{"start":{"row":29,"column":3},"end":{"row":29,"column":4},"action":"remove","lines":[" "]}],[{"start":{"row":29,"column":3},"end":{"row":29,"column":6},"action":"insert","lines":["   "],"id":10}],[{"start":{"row":30,"column":3},"end":{"row":30,"column":4},"action":"remove","lines":[" "],"id":11}],[{"start":{"row":31,"column":3},"end":{"row":31,"column":6},"action":"remove","lines":["   "],"id":12},{"start":{"row":31,"column":3},"end":{"row":31,"column":4},"action":"remove","lines":[" "]}],[{"start":{"row":31,"column":3},"end":{"row":31,"column":6},"action":"insert","lines":["   "],"id":13}],[{"start":{"row":31,"column":3},"end":{"row":31,"column":6},"action":"remove","lines":["   "],"id":14}],[{"start":{"row":31,"column":3},"end":{"row":31,"column":4},"action":"remove","lines":[" "],"id":15}],[{"start":{"row":31,"column":3},"end":{"row":31,"column":6},"action":"insert","lines":["   "],"id":16}],[{"start":{"row":32,"column":3},"end":{"row":32,"column":4},"action":"remove","lines":[" "],"id":17}],[{"start":{"row":34,"column":3},"end":{"row":34,"column":4},"action":"remove","lines":[" "],"id":19}],[{"start":{"row":36,"column":3},"end":{"row":36,"column":4},"action":"remove","lines":[" "],"id":20}],[{"start":{"row":38,"column":3},"end":{"row":38,"column":4},"action":"remove","lines":[" "],"id":21}],[{"start":{"row":40,"column":3},"end":{"row":40,"column":4},"action":"remove","lines":[" "],"id":22}],[{"start":{"row":39,"column":3},"end":{"row":39,"column":6},"action":"remove","lines":["   "],"id":23},{"start":{"row":39,"column":3},"end":{"row":39,"column":4},"action":"remove","lines":[" "]},{"start":{"row":39,"column":3},"end":{"row":39,"column":4},"action":"remove","lines":[" "]}],[{"start":{"row":39,"column":3},"end":{"row":39,"column":6},"action":"insert","lines":["   "],"id":24}],[{"start":{"row":37,"column":6},"end":{"row":37,"column":7},"action":"remove","lines":[" "],"id":25},{"start":{"row":37,"column":6},"end":{"row":37,"column":7},"action":"remove","lines":[" "]}],[{"start":{"row":35,"column":6},"end":{"row":35,"column":7},"action":"remove","lines":[" "],"id":26},{"start":{"row":35,"column":6},"end":{"row":35,"column":7},"action":"remove","lines":[" "]}],[{"start":{"row":33,"column":6},"end":{"row":33,"column":7},"action":"remove","lines":[" "],"id":27},{"start":{"row":33,"column":6},"end":{"row":33,"column":7},"action":"remove","lines":[" "]}],[{"start":{"row":23,"column":11},"end":{"row":24,"column":18},"action":"remove","lines":["","                  "],"id":28}],[{"start":{"row":43,"column":0},"end":{"row":44,"column":0},"action":"remove","lines":["      <!-- Wraper -->",""],"id":29}],[{"start":{"row":44,"column":0},"end":{"row":45,"column":0},"action":"remove","lines":["         <!-- Page Wraper -->",""],"id":30}],[{"start":{"row":45,"column":0},"end":{"row":46,"column":0},"action":"remove","lines":["            <!--  Bread Crumb -->",""],"id":31}],[{"start":{"row":50,"column":57},"end":{"row":52,"column":56},"action":"remove","lines":["","                           <!--<li><a href=\"index-2.html\">Home</a></li>-->","                           <!--<li>Shopping Cart</li>-->"],"id":32}],[{"start":{"row":55,"column":22},"end":{"row":57,"column":41},"action":"remove","lines":["","            <!-- Bread Crumb -->","            <!-- Content page wrapper -->"],"id":33}],[{"start":{"row":105,"column":0},"end":{"row":106,"column":0},"action":"remove","lines":["                              <!--<p>Páginas: </p>-->",""],"id":36}],[{"start":{"row":128,"column":0},"end":{"row":129,"column":0},"action":"remove","lines":["            <!-- Content page wrapper -->",""],"id":37}],[{"start":{"row":129,"column":0},"end":{"row":130,"column":0},"action":"remove","lines":["         <!-- Page Wraper -->",""],"id":38}],[{"start":{"row":76,"column":17},"end":{"row":77,"column":0},"action":"insert","lines":["",""],"id":39},{"start":{"row":77,"column":0},"end":{"row":77,"column":15},"action":"insert","lines":["    \t\t\t\t\t\t\t    "]},{"start":{"row":77,"column":15},"end":{"row":78,"column":0},"action":"insert","lines":["",""]},{"start":{"row":78,"column":0},"end":{"row":78,"column":15},"action":"insert","lines":["    \t\t\t\t\t\t\t    "]}],[{"start":{"row":78,"column":15},"end":{"row":90,"column":17},"action":"insert","lines":["<?php","            \t\t\t\t\t\tswitch($total_busqueda){","    \t\t\t\t\t\t\t        case 0:","    \t\t\t\t\t\t\t            echo \"<p> No results </p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t        case 1:","    \t\t\t\t\t\t\t            echo \"<p> One result</p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t        default:","    \t\t\t\t\t\t\t            echo \"<p>\". 'There are '. $total_busqueda . ' results'.\"</p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t    }","    \t\t\t\t\t\t\t    ?>"],"id":40}],[{"start":{"row":65,"column":18},"end":{"row":78,"column":15},"action":"remove","lines":["switch($total_busqueda){","    \t\t\t\t\t\t\t        case 0:","    \t\t\t\t\t\t\t            echo \"<p>\".__('No hay resultados', 'zapa').\"</p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t        case 1:","    \t\t\t\t\t\t\t            echo \"<p>\".__('Hay 1 resultado', 'zapa').\"</p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t        default:","    \t\t\t\t\t\t\t            echo \"<p>\".__('Hay ', 'zapa') . $total_busqueda . __(' resultados', 'zapa').\"</p>\";","    \t\t\t\t\t\t\t            break;","    \t\t\t\t\t\t\t    }","    \t\t\t\t\t\t\t    ?>","    \t\t\t\t\t\t\t    ","    \t\t\t\t\t\t\t    "],"id":41}],[{"start":{"row":66,"column":0},"end":{"row":66,"column":3},"action":"insert","lines":["   "],"id":42},{"start":{"row":67,"column":0},"end":{"row":67,"column":3},"action":"insert","lines":["   "]},{"start":{"row":68,"column":0},"end":{"row":68,"column":3},"action":"insert","lines":["   "]},{"start":{"row":69,"column":0},"end":{"row":69,"column":3},"action":"insert","lines":["   "]},{"start":{"row":70,"column":0},"end":{"row":70,"column":3},"action":"insert","lines":["   "]},{"start":{"row":71,"column":0},"end":{"row":71,"column":3},"action":"insert","lines":["   "]},{"start":{"row":72,"column":0},"end":{"row":72,"column":3},"action":"insert","lines":["   "]},{"start":{"row":73,"column":0},"end":{"row":73,"column":3},"action":"insert","lines":["   "]},{"start":{"row":74,"column":0},"end":{"row":74,"column":3},"action":"insert","lines":["   "]},{"start":{"row":75,"column":0},"end":{"row":75,"column":3},"action":"insert","lines":["   "]},{"start":{"row":76,"column":0},"end":{"row":76,"column":3},"action":"insert","lines":["   "]},{"start":{"row":77,"column":0},"end":{"row":77,"column":3},"action":"insert","lines":["   "]}],[{"start":{"row":84,"column":95},"end":{"row":84,"column":123},"action":"remove","lines":["<?= __('Título', 'zapa'); ?>"],"id":43},{"start":{"row":84,"column":95},"end":{"row":84,"column":96},"action":"insert","lines":["T"]},{"start":{"row":84,"column":96},"end":{"row":84,"column":97},"action":"insert","lines":["i"]},{"start":{"row":84,"column":97},"end":{"row":84,"column":98},"action":"insert","lines":["t"]},{"start":{"row":84,"column":98},"end":{"row":84,"column":99},"action":"insert","lines":["l"]},{"start":{"row":84,"column":99},"end":{"row":84,"column":100},"action":"insert","lines":["e"]}],[{"start":{"row":86,"column":71},"end":{"row":86,"column":102},"action":"remove","lines":["<?= __('Publicado', 'zapa'); ?>"],"id":44},{"start":{"row":86,"column":71},"end":{"row":86,"column":87},"action":"insert","lines":["Publication date"]}],[{"start":{"row":85,"column":0},"end":{"row":85,"column":110},"action":"remove","lines":["                                             \t<th class=\"product-description\"><?= __('Autor', 'zapa'); ?></th>"],"id":45},{"start":{"row":84,"column":105},"end":{"row":85,"column":0},"action":"remove","lines":["",""]}]]},"ace":{"folds":[],"scrolltop":900,"scrollleft":0,"selection":{"start":{"row":84,"column":105},"end":{"row":84,"column":105},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":74,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1558341126979,"hash":"7e3fcedd4fabaace438149ecc52de10cca7c8eca"}