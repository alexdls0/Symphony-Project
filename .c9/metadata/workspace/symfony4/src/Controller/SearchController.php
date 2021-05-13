{"changed":true,"filter":false,"title":"SearchController.php","tooltip":"/symfony4/src/Controller/SearchController.php","value":"<?php\nnamespace App\\Controller;\nuse Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\nuse Symfony\\Component\\HttpFoundation\\RedirectResponse;\nuse Symfony\\Component\\Routing\\Annotation\\Route;\n\nuse Symfony\\Component\\Security\\Core\\Authorization\\AuthorizationChecker;\nuse Symfony\\Component\\Security\\Core\\Exception\\AccessDeniedException;\n\n\nclass BrowseController extends AbstractController {\n    /**\n     * Matches the site base dir\n     * @Route(\"/browse\", name=\"capsule_browse\")\n     */\n    public function index() {\n        \n        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');\n        \n        \n        \n        \n        return $this->render('browse.html.twig');\n        \n        \n        \n        //Ver si usuario tiene cuneta o no\n        //Sacar los datos que queramos\n        \n        \n        \n        /*\n        $json = $gm->readGamers();\n        $properties = ['urltitle' => 'TopGamers Dashboard',\n            'analytics' => getenv('TG_ANALYTICS'),\n            'tggames' => $json];\n        return $this->render('dashboard.html.twig', $properties);*/\n    }\n}","undoManager":{"mark":-2,"position":2,"stack":[[{"start":{"row":10,"column":6},"end":{"row":10,"column":12},"action":"remove","lines":["Search"],"id":2},{"start":{"row":10,"column":6},"end":{"row":10,"column":7},"action":"insert","lines":["B"]},{"start":{"row":10,"column":7},"end":{"row":10,"column":8},"action":"insert","lines":["r"]},{"start":{"row":10,"column":8},"end":{"row":10,"column":9},"action":"insert","lines":["o"]},{"start":{"row":10,"column":9},"end":{"row":10,"column":10},"action":"insert","lines":["s"]}],[{"start":{"row":10,"column":9},"end":{"row":10,"column":10},"action":"remove","lines":["s"],"id":3}],[{"start":{"row":10,"column":9},"end":{"row":10,"column":10},"action":"insert","lines":["w"],"id":4},{"start":{"row":10,"column":10},"end":{"row":10,"column":11},"action":"insert","lines":["s"]},{"start":{"row":10,"column":11},"end":{"row":10,"column":12},"action":"insert","lines":["e"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":10,"column":12},"end":{"row":10,"column":12},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1556415514877}