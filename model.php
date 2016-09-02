<?php

require_once('../core/db_abstract_model.php');

class Promo extends DBModel {

    public $id_promocion;
    public $numero;
    public $usuario; 

    public $titulo;
    public $subtitulo; 
    public $promocion;


    function __construct() {
        $this->db_name = 'megadigital';
    }
    //lista toda la informacion de la base de datos
    public function show(){
        
            $this->query = "SELECT * FROM promociones";
            $this->get_all_query();
            return $this->rows;

}
    public function get($numero = '') {
        if ($numero != '') {
            $this->query = "SELECT numero, usuario, fecha, titulo, subtitulo, promocion FROM promociones WHERE numero = '$numero'";
            $this->get_results_query();
            $this->mensaje = "";
        }
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = "Promocion encontrado";
        } else {
            $this->mensaje = "Promocion no encontrado";
        }
    }

    public function set($user_data = array()) {
        if (array_key_exists('numero', $user_data)) {
            $this->get($user_data['numero']);
            if ($user_data['numero'] != $this->numero) {
                foreach ($user_data as $campo => $valor) {
                    echo $campo;
                    $$campo = $valor;
                }
                $this->query="INSERT INTO promociones(numero,usuario,titulo,subtitulo,promocion) VALUES ('$numero','$usuario','$titulo','$subtitulo','$promocion')";

                $this->execute_query();
                $this->mensaje = "Promocion agregado exitosamente";
            } else {
                $this->mensaje = "La promocion ya existe";
            }
        } else {
            $this->mensaje = "No se ha agregado la promocion";
        }
    }

    public function edit($user_data = array()) {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE promociones SET titulo='$titulo', subtitulo='$subtitulo', promocion='$promocion'  WHERE numero='$numero'";

        $this->execute_query();
        $this->mensaje = "Promocion modificado";
    }

    public function delete($numero = '') {
        $this->query = "DELETE FROM promociones WHERE numero = '$numero'";
        $this->execute_query();
        $this->mensaje = "Promocion eliminado";
    }

    function __destruct() {
        unset($this);
    }

}

?>