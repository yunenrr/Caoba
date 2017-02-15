


<html>
    <head>
        <style type="text/css">
            body {
                font-family: Trebuchet MS,Helvetica,Verdana,Arial,sans-serif;;
                font-size: 10pt;
            } 
            .treeMenuDefault {
                font-style: italic;
            }
        </style>
        <script src="TreeMenu.js" language="JavaScript" type="text/javascript"></script>
    </head>
    <body>

        <?php
error_reporting(0);

require_once('TreeMenu.php');

$icon = 'folder.gif';
$expandedIcon = 'folder-expanded.gif';

$menu = new HTML_TreeMenu();

$nodo1 = new HTML_TreeNode(array('text' => 'Directorio', 'link' => 'http://www.desarrolloweb.com/directorio', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$menu->addItem($nodo1);

$nodo1_1 = new HTML_TreeNode(array('text' => 'Programación', 'link' => 'http://www.desarrolloweb.com/directorio/programacion', 'icon' => $icon, 'expandedIcon' => $expandedIcon), array('ontoggle' => 'alert("Has cambiado la rama Programación");'));
$nodo1->addItem($nodo1_1);

$nodo1_1_1 = new HTML_TreeNode(array('text' => 'HTML', 'link' => 'http://www.desarrolloweb.com/directorio/programacion/html/', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1_1->addItem($nodo1_1_1);

$nodo1_1_2 = new HTML_TreeNode(array('text' => 'javascript', 'link' => 'http://www.desarrolloweb.com/directorio/programacion/javascript/', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1_1->addItem($nodo1_1_2);

$nodo1_1_3 = new HTML_TreeNode(array('text' => 'PHP', 'link' => 'http://www.desarrolloweb.com/directorio/programacion/php/', 'icon' => $icon, 'expandedIcon' => $expandedIcon), array('onexpand' => 'alert("Has expandido la rama PHP");', 'oncollapse' => 'alert("Has cerrado la rama PHP");'));
$nodo1_1->addItem($nodo1_1_3);

$nodo1_1_3_1 = new HTML_TreeNode(array('text' => 'Scripts PHP', 'link' => 'http://www.desarrolloweb.com/directorio/programacion/php/scripts_en_php/', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1_1_3->addItem($nodo1_1_3_1);

$nodo1_1_3_2 = new HTML_TreeNode(array('text' => 'Manuales PHP', 'link' => 'http://www.desarrolloweb.com/directorio/programacion/php/manuales_de_php/', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1_1_3->addItem($nodo1_1_3_2);


$nodo1_2 = new HTML_TreeNode(array('text' => 'Sistemas', 'link' => 'http://www.desarrolloweb.com/directorio/sistemas', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1->addItem($nodo1_2);

$nodo1_3 = new HTML_TreeNode(array('text' => 'Bases de datos', 'link' => 'http://www.desarrolloweb.com/directorio/bases_de_datos/', 'icon' => $icon, 'expandedIcon' => $expandedIcon));
$nodo1->addItem($nodo1_3);

//Crear la presentación del árbol
$treeMenu = new HTML_TreeMenu_DHTML($menu, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
?>
    </body>
</html>