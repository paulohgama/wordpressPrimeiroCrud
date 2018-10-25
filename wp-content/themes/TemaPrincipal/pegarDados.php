<?php

        $pegadados = $this->CriarDataTable();
        $dados = array();
        foreach ($pegadados as $row) {
             $sub_dados = array();
             $sub_dados[] = $row->carrer_id;
             $sub_dados[] = $row->carrer_name;
             $sub_dados[] = $row->profession_name;
             $sub_dados[] = ($row->carrer_active) ? 'Ativa' : 'Inativa';

             $sub_dados[] = ($row->carrer_active) ? 
            
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field().
             "<button type='submit' role='button' class='btn btn-warning' data-toggle='tooltip' title='Inativar Item'><i class='fa fa-times'></i></button> </span></button> </form>" : 
 
             "<form method='POST' action='".route('ativarcarrer', $row->carrer_id)."'>".
                 method_field('PATCH').
                 @csrf_field()."<button type='submit' role='button' class='btn btn-success' data-toggle='tooltip' title='Ativar Item'><i class='fa fa-check'></i></button> </button></form>";
             

             $sub_dados[] = "<a href='".route('carrer.edit', $row->carrer_id)."' role='button' class='btn btn-primary' data-toggle='tooltip' title='Alterar'><span class='glyphicon glyphicon-edit'></span></a>";
             $sub_dados[] = "<form method='POST' action='".route('carrer.destroy', $row->carrer_id)."'>".
                            method_field('DELETE').
                            csrf_field().
                            "<button type='submit' role='button' class='btn btn-danger' data-toggle='tooltip' title='Deletar Item'><span class='glyphicon glyphicon-trash'></span></button></form>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST['draw']),
            "recordsTotal" => $this->TodosRegistros(), 
            "recordsFiltered" => $this->RegistrosFiltrados(),
            "data" => $dados
        );
        echo json_encode($output);
        
    $order = ['carrer_id','carrer_name', 'carrer_active','profession_name', null, null ];
    
    function CriarQuery()
    {
        $query = "select * from wp_inscritos inner join wp_posts on post_id = fk_post";
        if($_POST['search']['value'] != null)
        {
            $query += "where inscritos_status like ".$_POST['search']['value']."%";         
        }
        if($request->order!= null)
        {
            $query += " order by ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir'];
        }
        else
        {
            $query += " order by inscrito_id desc";
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
            $query += " limit ".$_POST['length']." offset ".$_POST['start'];
        }
        $queryFinal = $wpdb->get_results($query, $formato);
        return $queryFinal;
    }
    
    function RegistrosFiltrados()
    {
        global $wpdb;
        $query = CriarQuery();
        $formato = "ARRAY_A";
        $queryFinal = $wpdb->get_results($query, $formato);
        return $queryFinal->num_rows;
    }
    
    function TodosRegistros()
    {   
        global $wpdb;
        $query = "select * from wp_inscritos inner join wp_posts on post_id = fk_post";
        $formato = "ARRAY_A";
        $queryFinal = $wpdb->get_results($query, $formato);
        return $queryFinal->num_rows;
    }