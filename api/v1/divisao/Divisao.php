<?php

require_once "../lib/ClasseBase.php";

/**
* classe Divisao
*
* @author    Matheus Silva
* @copyright © Copyright 2010-2015 Matheus Silva. Todos os direitos reservados.
*/
class Divisao extends ClasseBase
{
    private $codigoDivisao;
    private $nome;

    function __construct()
    {
        require_once "../lib/Conexao.php";
    }

    public function getCodigo_divisao()
    {
        return $this->codigoDivisao;
    }

    public function setCodigo_divisao($codigo)
    {
        $this->codigoDivisao = $codigo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function inserir($token)
    {
        try {
            if ($this->tokenEhValido($token) === false) {
                    return false;
            }//if ($this->tokenEhValido($token) === false) {

            $nome  = $this->getNome();

            $sql   = "\n INSERT INTO divisao (";
            $sql  .= "\n nome";
            $sql  .= "\n ) VALUES (";
            $sql  .= "\n :nome";
            $sql  .= "\n )";

            $conexao = Conexao::getConexao(); 
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR, 25);
            $retorno = $stmt->execute();
            $conexao->commit();
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }

    public function alterar($token)
    {
        try {
            if ($this->tokenEhValido($token) === false) {
                    return false;
            }//if ($this->tokenEhValido($token) === false) {

            $codigo = $this->getcodigo_divisao();
            $nome   = $this->getNome();

            $sql   = "\n UPDATE divisao";
            $sql  .= "\n SET nome = :nome";
            $sql  .= "\n WHERE Codigo_divisao = :codigo";

            $conexao = Conexao::getConexao(); 
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR, 25);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $retorno = $stmt->execute();
            $conexao->commit();
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }

    /**
    * metodo que tem função de fazer validacao da restricao de integridade
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.1
    */
    public function validaFkDivisao($token)
    {
        try {
            if ($this->tokenEhValido($token) === false) {
                return 999;
            }//if ($this->objClasseBase->tokenEhValido($token) === false) {
            
            $codigo  = $this->getcodigo_divisao();

            $sql   = "\n SELECT DISTINCT 1 AS resultado";
            $sql  .= "\n FROM divisao AS dv"; 
            $sql  .= "\n ,time AS tim";
            $sql  .= "\n WHERE tim.divisao_codigo_divisao = dv.codigo_divisao";
            $sql  .= "\n AND dv.codigo_divisao = :id";

            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);
            $conexao = null;
            return $retorno["resultado"];
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function validaFkDivisao($codigo)

    public function excluir($token)
    {
        try {
            if ($this->tokenEhValido($token) !== true) {
                    return false;
            }//if ($this->tokenEhValido($token) === false) {

            $codigo = $this->getcodigo_divisao();

            $sql   = "\n DELETE"; 
            $sql  .= "\n FROM divisao";
            $sql  .= "\n WHERE codigo_divisao = :codigo";

            $conexao = Conexao::getConexao(); 
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $retorno = $stmt->execute();
            $conexao->commit();
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }

    public static function listarPorCodigo($codigo)
    {
        try {
            $sql   = "\n SELECT codigo_divisao";
            $sql  .= "\n ,nome";
            $sql  .= "\n FROM divisao";
            $sql  .= "\n WHERE codigo_divisao = :codigo";

            $conexao = Conexao::getConexao(); 		  
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }
        
    public static function listarPorNome($nome)
    {
        try {
            $nome .= "%";
            $sql   = "\n SELECT codigo_divisao";
            $sql  .= "\n ,nome";
            $sql  .= "\n FROM divisao";
            $sql  .= "\n WHERE nome LIKE :nome";

            $conexao = Conexao::getConexao(); 		  
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR, 25);
            $stmt->execute();
            $retorno =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }

    public static function listarTudo($strRequire = '../lib/Conexao.php')
    {     
        try {
            $sql   = "\n SELECT *";
            $sql  .= "\n FROM divisao";

            $conexao = Conexao::getConexao(); 		  
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            $retorno =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }
    
    public static function listaDivisaoPorTime($strRequire = '../lib/Conexao.php', $intCodigo)
    {     
        try {
            $sql   = "\n SELECT d.codigo_divisao";
            $sql  .= "\n ,d.nome";
            $sql  .= "\n FROM time.time AS t";
            $sql  .= "\n ,time.divisao AS d";
            $sql  .= "\n WHERE  d.codigo_divisao = t.divisao_codigo_divisao";
            $sql  .= "\n AND t.codigo_time = :codigo";

            $conexao = Conexao::getConexao(); 		  
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":codigo", $intCodigo, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);
            $conexao = null;
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }
}
