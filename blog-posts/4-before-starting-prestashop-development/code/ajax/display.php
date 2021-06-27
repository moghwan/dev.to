# my_module/controllers/front/display.php

// making the request url for our contoller in initContent() function
$url = Context::getContext()->link->getModuleLink(
    'my_module', // module name
    'ajax', // contoller name, could be 'display'
    array( // we can define more parameters here
        // 'action' => 'DoSomeAction',
        // 'ajax' => 1,
    )
);

// making variable accessible in javascript
Media::addJsDef([
    'AJAX_URL' => $url,
]);
