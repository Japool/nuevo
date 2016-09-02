<?php

$diccionario = array(
    'subtitle' => array(
        VIEW_SET_SERVICIO => 'Dar de alta un servicio',
        VIEW_GET_SERVICIO => 'Buscar servicio',
        VIEW_DELETE_SERVICIO => 'Eliminar un servicio',
        VIEW_EDIT_SERVICIO => 'Modificar un servicio'
    ),
    'links_menu' => array(
        'VIEW_SET_SERVICIO' => MODULO . VIEW_SET_SERVICIO . '/',
        'VIEW_GET_SERVICIO' => MODULO . VIEW_GET_SERVICIO . '/',
        'VIEW_EDIT_SERVICIO' => MODULO . VIEW_EDIT_SERVICIO . '/',
        'VIEW_DELETE_SERVICIO' => MODULO . VIEW_DELETE_SERVICIO . '/'
    ),
    'form_actions' => array(
        'SET' => '/megadigital/home/' . MODULO . SET_SERVICIO . '/',
        'GET' => '/megadigital/home/' . MODULO . GET_SERVICIO . '/',
        'DELETE' => '/megadigital/home/' . MODULO . DELETE_SERVICIO . '/',
        'EDIT' => '/megadigital/home/' . MODULO . EDIT_SERVICIO . '/'
    )
);

function get_template($form = 'get') {
    $file = '../site_media/html/articulo/articulos_' . $form . '.html';
    $template = file_get_contents($file);
    return $template;
}

function render_dinamic_data($html, $data) {
    foreach ($data as $clave => $valor) {
        $html = str_replace('{' . $clave . '}', $valor, $html);
    }
    return $html;
}


function retornar_vista($vista, $data = array()) {
    global $diccionario;
    $html = get_template('template');
    $html = str_replace('{subtitulo}', $diccionario['subtitle'][$vista], $html);
    $html = str_replace('{formulario}', get_template($vista), $html);
    $html = render_dinamic_data($html, $diccionario['form_actions']);
    $html = render_dinamic_data($html, $diccionario['links_menu']);
    $html = render_dinamic_data($html, $data);
     //render {mensaje}
    if (array_key_exists('serie', $data) && array_key_exists('id_cliente', $data) && $vista == VIEW_EDIT_SERVICIO) {
        $mensaje = 'Editar servicio ' . $data['serie'] . ' - ' . $data['id_cliente'];
    } else {
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Datos del servicio';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}

?>
