<?php

// Vars

$parent_parent = '../';
$cache_dir = $parent_parent.'css_cache';
$filename = htmlentities($_GET['filename']);
$file = array_slice(explode('/', $filename),-1)[0];
$less_file = $parent_parent.'less/'.$file.'.less';
$css_file = $parent_parent.'css/'.$file.'.css';
$is_dev = $_SERVER['HTTP_HOST'] == 'localhost';


// Functions

function parse_less($filename, $file) {

    global $less_file, $is_dev;

    $options = array();

    if ( $is_dev ) {

        $options['sourceMap'] = true;
        $options['sourceMapWriteTo'] = '../css/'.$file.'.map';
        $options['sourceMapURL'] = '../css/'.$file.'.map';

    } else {

        $options['compress'] = true;

    }

    $options['cache_dir'] = '../css_cache';

    try{
        $parser = new Less_Parser($options);
        $parser->parseFile($less_file, '../css/');
        ob_start();
        echo $parser->getCss();
        $css = ob_get_contents();
        ob_end_clean();

        header("Content-type: text/css");
        @file_put_contents('../css/'.$file.'.css', $css);
        return $css;
    } catch (Exception $e) {
        header("Content-type: text/css");
        echo '/* LESS ERROR : '."\n\n".$e->getMessage()."\n\n".'*/';
        showError($file.'.less');
    }


}

function showError($error_message) {

    if ( $_SERVER['HTTP_HOST'] == 'preprod.digitaweb.com') {
        echo '/* Warning: '.$error_message.' */'."\n\n";
    }
    if ( $_SERVER['HTTP_HOST'] == 'localhost') {
        echo '
            body:before {
                content: "/!\\\ LESS Error: '.$error_message.'";
                color: #fff;
                background: #F00;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 999999999999999;
            }
        '."\n\n";
    }

}


// Compilation

if (
        (file_exists($cache_dir) AND is_writable($cache_dir))
        OR
        (!file_exists($cache_dir) AND is_writable($parent_parent))
) {

    header("Content-type: text/css");
    require_once 'lessphp/Less.php';
    $filename = str_replace('css', 'less', $filename);
    echo parse_less('../'.$filename, $file);

} else {

    $error_message = 'cache_dir not writable: '.$cache_dir;

    header("Content-type: text/css");

    if (!file_exists($css_file)) {
        $error_message .= ' && '.$css_file.' not existing ! ';
    } else {
        echo file_get_contents($css_file);
    }

    showError($error_message);
    
}