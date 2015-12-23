<?php

require_once "Tecnico.php";

$acao  = "";
$id    = "";
$token = "";
$p     = "";

if (isset($_REQUEST["a"]) && empty($_REQUEST["a"]) === false) {
    $acao  = $_REQUEST["a"];        
}

if (isset($_REQUEST["id"]) && empty($_REQUEST["id"]) === false) {
    $id  = $_REQUEST["id"];        
}

if (isset($_REQUEST["tk"]) && empty($_REQUEST["tk"]) === false) {
    $token  = $_REQUEST["tk"];        
}

if (isset($_REQUEST["p"]) && empty($_REQUEST["p"]) === false) {
    $p  = $_REQUEST["p"];
}

header('Content-Type: application/json');

if (empty($acao)) {
    $tecnico = new tecnico();
    $items   = $tecnico->listarTudo();
    $results = array();

    if(!empty($items)) {
        // get all results
        foreach($items as $row) {
            $itemArray = array(
                'codigo' => $row['codigo_tecnico'],
                'nome' => $row['nome'],
            );
            array_push($results, $itemArray);
        }
        
        $json  = "{\"tecnicos\":";
        $json .= json_encode($results);
        $json .= "}";

        echo $json;
    }
} else if ($acao == 1) {
    $objTecnico = new tecnico();
    $arrTodosTecnico   = $objTecnico->listarTudo();
    $arrTecnicoTime   = $objTecnico->listaTecnicoPorTime(null,$id);
    $results = array();

    if(!empty($arrTodosTecnico)) {
        // get all results
        foreach($arrTodosTecnico as $valor) {
            
            $boolSelected = false;
            $idDivisao = $valor['codigo_tecnico'];
            
            if ($arrTecnicoTime && $idDivisao === $arrTecnicoTime['codigo_tecnico']) {
                $boolSelected = true;
            }
            
            $itemArray = array(
                'codigo' => $idDivisao,
                'nome'   => $valor['nome'],
                'selected'   => $boolSelected
            );
            
            array_push($results, $itemArray);
        }
        
        $json = "{\"tecnicos\":";
        $json .= json_encode($results);
        $json .= "}";

        echo $json;
    } else {
        $itemArray = array(
                'codigo' => "",
                'nome'   => "Nenhum tecnico cadastrado",
                'selected'   => true
        );
            
        array_push($results, $itemArray);

        $json = "{\"tecnicos\":";
        $json .= json_encode($results);
        $json .= "}";
            
        echo $json;
    }     
} else if ($acao == 2) {
    $tecnico = new tecnico();
    $items = $tecnico->listarPorCodigo($id);
    
    if(!empty($items)) {
        echo json_encode($items);
    } 
} else if ($acao == 3) {
    $tecnico = new tecnico();
    $items   = $tecnico->listarPorNome($p);
    
    if(!empty($items)) {
        $json = "{\"tecnicos\":";
        $json .= json_encode($items);
        $json .= "}";
        echo $json;
    } else {
        $json["mensagem"] = "Nenhum tecnico cadastrado.";
        echo json_encode($json);
    }

} else if ($acao == 4) {	
    $request_body = file_get_contents('php://input');
    $tecnico    = json_decode($request_body, true);
    $objtecnico = new tecnico();
    $objtecnico->setNome($tecnico["txtNome"]);	

    $dia  = $tecnico["cmbDia"];
    $mes  = $tecnico["cmbMes"];
    $ano  = $tecnico["cmbAno"];
    $data = $dia."/".$mes."/".$ano;
    $objtecnico->setData($data);

    if ($objtecnico->inserir($token)) {
        $tecnico["mensagem"] = "tecnico cadastrado com sucesso";	 	
    } else {
        $tecnico["mensagem"] = "Falha ao cadastrar tecnico";	
    }

    $json = json_encode($tecnico);
    echo $json;
} else if ($acao == 5) {	
    $request_body = file_get_contents('php://input');
    $tecnico    = json_decode($request_body, true);
    $objtecnico = new tecnico();
    $objtecnico->setCodigoTecnico($id);
    $objtecnico->setNome($tecnico["txtNome"]);	


    if ($objtecnico->alterar($token)) {	 	
        $tecnico["mensagem"] = "tecnico atualizado com sucesso";	 	
    } else {
        $tecnico["mensagem"] = "Falha ao atualizar tecnico";	
    }

    $json = json_encode($tecnico);
    echo $json;
} else if ($acao == 6) {	
    $tecnico    = "";
    $objtecnico = new tecnico();
    $objtecnico->setCodigoTecnico($id);

    if ($objtecnico->excluir($token)) {	 	
        $tecnico["mensagem"] = "tecnico excluido com sucesso";	 	
    } else {
        $tecnico["mensagem"] = "Falha ao excluir tecnico";	
    }

    $json = json_encode($tecnico);
    echo $json;
}

$acao  = "";
$id    = "";
$token = "";
$p     = "";