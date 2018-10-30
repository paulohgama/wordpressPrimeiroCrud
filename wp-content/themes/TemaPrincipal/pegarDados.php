<?php
/*
Template Name: PegarDados
*/
?>
<?php

        $pegadados = CriarDataTable();
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row['post_title'];
            $sub_dados[] = (substr($row['inscrito_data'], 8, 2)."/".substr($row['inscrito_data'], 5, 2)."/".substr($row['inscrito_data'], 0, 4));
            $sub_dados[] = $row['inscrito_nome'];
            $sub_dados[] = $row['inscrito_email'];
            $sub_dados[] = $row['inscrito_status'];
            $sub_dados[] = "<form method='POST' action=''><input type='hidden' name='inscrito_id' value='".$row['inscrito_id']."'/><button type='submit' role='button' class='btn btn-success' name='visualizar' value='visualizando' data-toggle='tooltip' title='Visualizar'><span class='glyphicon glyphicon-eye-open'></span></button></form>";
            $sub_dados[] = "<form method='POST' action=''><input type='hidden' name='inscrito_id' value='".$row['inscrito_id']."'/><button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar Item' value='deletando' name='deletar'><span class='glyphicon glyphicon-trash'></span></button></form>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST['draw']),
            "recordsTotal" => TodosRegistros(), 
            "recordsFiltered" => RegistrosFiltrados(),
            "data" => $dados
        );
        echo json_encode($output);
        
    $order = array('post_title','inscrito_data', 'inscrito_nome','inscrito_email', 'inscrito_status' , null, null );
    
    function CriarQuery()
    {
        $query = "select * from wp_inscritos inner join wp_posts on ID = pk_post";
        if(isset($_POST['post']) && intval($_POST['post']) > 0)
        {
            $query = $query." where pk_post = ".$_POST['post']; 
        }
        if(isset($_POST['order']) && !empty($_POST['order']))
        {
            $query = $query." order by ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir'];
        }
        else
        {
            $query = $query." order by inscrito_id desc";
        }
        return $query;
    }
    
    function CriarDataTable()
    {
        global $wpdb;
        $query = CriarQuery();
        $formato = "ARRAY_A";
        if($_POST['length'] != -1)
        {
            $query = $query." limit ".$_POST['length']." offset ".$_POST['start'];
        }
        $queryFinal = $wpdb->get_results($query, $formato);
        return $queryFinal;
    }
    
    function RegistrosFiltrados()
    {
        global $wpdb;
        $query = CriarQuery();
        $formato = "ARRAY_A";
        $wpdb->get_results($query, $formato);
        return $wpdb->num_rows;
    }
    
    function TodosRegistros()
    {   
        global $wpdb;
        $query = "select * from wp_inscritos inner join wp_posts on id = pk_post";
        $formato = "ARRAY_A";
        $wpdb->get_results($query, $formato);
        return $wpdb->num_rows;
    }