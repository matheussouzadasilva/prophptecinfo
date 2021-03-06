<?php
//declare(strict_types=1);//nao utilizar pois qualquer tipo de dados diferente vai parar a aplicação, validar dados pelo validator

namespace matheus\sistemaRest\api\v1\model;

use matheus\sistemaRest\api\v1\lib\ClasseBase;
use matheus\sistemaRest\api\v1\lib\Conexao;
use matheus\sistemaRest\api\v1\lib\Login;
use Respect\Validation\Validator as v;
use Otp\Otp;
use Otp\GoogleAuthenticator;
use Base32\Base32;

/**
* classe Torcedor
*
* @author    Matheus Silva
* @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
*/
class Torcedor extends ClasseBase
{
    /**
    * @access private
    * @var int Armazena o codigo do torcedor
    */
    private $codigoTorcedor;

    /**
    * @access private
    * @var string Armazena o nome do torcedor
    */
    private $nome;

    /**
    * @access private
    * @var string Armazena a senha do torcedor
    */
    private $senha;

    /**
    * @access private
    * @var string Armazena a confirmação senha do torcedor
    */
    private $confSenha;

    /**
    * @access private
    * @var string Armazena a senha atual do torcedor
    */
    private $senhaAtual;

    /**
    * @access private
    * @var string Armazena o email atual do torcedor
    */
    private $email;

    /**
    * metodo constutor
    *
    * @access    public
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }//if (!isset($_SESSION)) {

        $this->limpaPropriedades();    
    }//public function __construct()

    /**
    * metodo limpa todas as propriedades da classe
    *
    * @access    public
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     20/08/2016
    * @version   0.1
    */
    public function limpaPropriedades()
    {
        $this->setCodigoTorcedor(0);
        $this->setNome('');
        $this->setSenha('');
        $this->setConfSenha('');
        $this->setSenhaAtual('');
        $this->setEmail('');
    }//public function limpaPropriedades()

    /**
    * metodo acessor Get que retorna a informação da propriedade codigoTorcedor
    *
    * @access    public
    * @return    integer Retorna o codigo do torcedor
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getCodigoTorcedor() : int
    {
        return $this->codigoTorcedor;
    }//public function getCodigoTorcedor() : int

    /**
    * metodo acessor Set que carrega informação na propriedade codigoTorcedor
    *
    * @access    public
    * @param     integer $codigoTorcedor Armazena o codigo do torcedor
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setCodigoTorcedor(int $codigoTorcedor)
    {
        $this->codigoTorcedor = $codigoTorcedor;
    }//public function setCodigoTorcedor(int $codigoTorcedor)


    /**
    * metodo acessor Get que retorna a informação da propriedade nome
    *
    * @access    public
    * @return    string Retorna o nome da categoria
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getNome() : string
    {
        return $this->nome;
    }//public function getNome() : string

    /**
    * metodo acessor Set que carrega informação na propriedade nome
    *
    * @access    public
    * @param     string $nome Armazena a nome atual
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }//public function setNome(string $nome)

    /**
    * metodo acessor Get que retorna a informação da propriedade email
    *
    * @access    public
    * @return    string Retorna o email do torcedor
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getEmail() : string
    {
        return $this->email;
    }//public function getEmail() : string

    /**
    * metodo acessor Set que carrega informação na propriedade email
    *
    * @access    public
    * @param     string $email Armazena o email do torcedor
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }//public function setEmail(string $email)

    /**
    * metodo acessor Get que retorna a informação da propriedade senhaAtual
    *
    * @access    public
    * @return    string Retorna a senha da categoria
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getSenhaAtual() : string
    {
        return $this->senhaAtual;
    }//public function getSenhaAtual() : string

    /**
    * metodo acessor Set que carrega informação na propriedade senhaAtual
    *
    * @access    public
    * @param     string $senhaAtual Armazena a senha atual
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setSenhaAtual(string $senhaAtual)
    {
        $this->senhaAtual = $senhaAtual;
    }//public function setSenhaAtual(string $senha)

    /**
    * metodo acessor Get que retorna a informação da propriedade senha
    *
    * @access    public
    * @return    string Retorna a senha da categoria
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getSenha() : string
    {
        return $this->senha;
    }//public function getSenha() : string

    /**
    * metodo acessor Set que carrega informação na propriedade senha
    *
    * @access    public
    * @param     string $senha Armazena a senha atual
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setSenha(string $senha)
    {
        $salt1 = "15353oiwHSDDKFJNGmfnsjfjqbhdgkjk";
        $salt2 = "NSBDFSDBFisoetiihskkdfgjfdkj56767";
        $salt3 = "zXCdsqGHiSpYxwHqJ8r7F21pFe93452";
        $this->senha =  Login::criptografiaEstatica($senha, 'sha512', $salt1, $salt2, $salt3, 4, 128);
    }//public function setSenha(string $senha)


    /**
    * metodo acessor Get que retorna a informação da propriedade confSenha
    *
    * @access    public
    * @return    string Retorna a confirmação da senha
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function getConfSenha() : string
    {
        return $this->confSenha;
    }//public function getConfSenha() : string

    /**
    * metodo acessor Set que carrega informação na propriedade confSenha
    *
    * @access    public
    * @param     string $confSenha Armazena a confirmação da senha
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setConfSenha(string $confSenha)
    {
        $this->confSenha = $confSenha;
    }//public function setConfSenha(string $senha)

    /**
    * metodo que tem função de excluir o tecnico
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function desativarAutenticacao2fatores()
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {

            $sql   = "\n UPDATE torcedor";
            $sql  .= "\n SET otpsecret = :otpsecret";
            $sql  .= "\n ,otpativado = :otpativado";
            $sql  .= "\n WHERE token = :token";

            $token = $this->getToken();
            $otpsecret = "";
            $otpAtivado = 0;

            $conexao = Conexao::getConexao();
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":token", $token, \PDO::PARAM_INT);
            $stmt->bindParam(":otpsecret", $otpsecret, \PDO::PARAM_STR);
            $stmt->bindParam(":otpativado", $otpAtivado, \PDO::PARAM_INT);
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
    }//public function desativarAutenticacao2fatores()

    /**
    * metodo que tem função de excluir o tecnico
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function ativarAutenticacao2fatores()
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {

            $secret = GoogleAuthenticator::generateRandom();
                
            $sql   = "\n UPDATE torcedor";
            $sql  .= "\n SET otpsecret = :otpsecret";
            $sql  .= "\n WHERE token = :token";

            $token = $this->getToken();

            $conexao = Conexao::getConexao();
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":token", $token, \PDO::PARAM_INT);
            $stmt->bindParam(":otpsecret", $secret, \PDO::PARAM_STR);
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
    }//public function ativarAutenticacao2fatores()

    /**
    * metodo que tem função de verificar se autenticação 2 fatores esta ativa
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function tokenAutenticacao2fatores()
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {
    
            $sql   = "\n SELECT otpsecret, otpAtivado";
            $sql  .= "\n FROM torcedor";
            $sql  .= "\n WHERE token = :token";

            $token = $this->getToken();
            $otpsecret = "";

            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":token", $token, \PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);
            return $retorno;
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function tokenAutenticacao2fatores()


    /**
    * metodo que tem função de verificar se autenticação 2 fatores esta ativa
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function retornaBase64ImgAutenticacao2fatores()
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {
    
            $secret = $this->tokenAutenticacao2fatores();

            if (empty($secret["otpsecret"])) {
                return '';
            }

            $secret = trim($secret["otpsecret"]);

            $otp = new Otp();
            return GoogleAuthenticator::getQrCodeUrl('totp', 'sistemaRest', $secret);
        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function retornaBase64ImgAutenticacao2fatores()


    /**
    * metodo que tem função de verificar se autenticação 2 fatores esta ativa
    *
    * @access    public
    * @param     integer $key Chave de autenticacao de dois fatores a ser validado
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function tokenAutenticacao2fatoresEhValido(int $key)
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {
        
            $key = preg_replace('/[^0-9]/', '', $key);
    
            // Standard is 6 for keys, but can be changed with setDigits on $otp
            if (strlen($key) == 6) {
                $secret = $this->tokenAutenticacao2fatores();

                if (empty($secret["otpsecret"])) {
                    return 2; // nao verifica o token de autenticacao 2 fatores e valido pois o mesmo nao existe
                }
                
                $secret = trim($secret["otpsecret"]);
                
                $key = (int) $key;
                
                $otp = new Otp();
                
                if ($otp->checkTotp(Base32::decode($secret), $key)) {
                    return 1;
                    //o token de autenticacao 2 fatores esta incorreto 
                } else {
                    return 0;
                }
            } else {
                return 3; //tamanho do token de autenticacao 2 fatores esta incorreto
            }

        } catch (\PDOException $e) {
            $conexao = null;
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function desativarAutenticacao2fatores()


    /**
    * metodo que tem função de verificar se autenticação 2 fatores esta ativa
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function setTokenAutenticacao2fatoresAtivado()
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return array();
            }//if ($this->tokenEhValido() === false) {

            $otpAtivado = "1";
                
            $sql   = "\n UPDATE torcedor";
            $sql  .= "\n SET otpativado = :otpativado";
            $sql  .= "\n WHERE token = :token";

            $token = $this->getToken();

            $conexao = Conexao::getConexao();
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":token", $token, \PDO::PARAM_INT);
            $stmt->bindParam(":otpativado", $otpAtivado, \PDO::PARAM_STR);
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
    * @param     string $login Armazena o login do usuario
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function validaTorcedor(string $login)
    {
        try {
            if ($this->tokenEhValido() === false) {
                $this->setErro("Sua sessão expirou. Faça o login novamente.");
                return 999;
            }//if ($this->tokenEhValido() === false) {

            $sql   = "\n SELECT DISTINCT 1 AS resultado";
            $sql  .= "\n FROM torcedor AS tor";
            $sql  .= "\n WHERE tor.login = :login";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindParam(":login", $login, \PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($retorno["resultado"] != 1) {
                $this->setErro("Usuário inexistente.");
                return 997;
            }

            return true;
        } catch (\PDOException $e) {
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function validaCodigoTorcedor(string $login)

    /**
    * metodo que tem função de listar os dados do torcedor pelo código.
    *
    * @access    public
    * @return    array retorna as informacoes
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function retornaDadosTorcedor()
    {
        try {
            $codigo  = $this->getCodigoTorcedor();
            //$usuario  = $_SESSION['u'];
            //$retorno = $this->validaTorcedor($usuario);

            //if ($retorno !== true) {
                //return $retorno;
            //}//if (!$retorno) {

            $sql   = "\n SELECT nome, email";
            $sql  .= "\n FROM torcedor";
            $sql  .= "\n WHERE codigo_torcedor = :codigo";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch(\PDO::FETCH_ASSOC);
            return $retorno;
        } catch (\PDOException $e) {
            $fp = fopen('34hsGAxZSgdfwksz1356.log', 'a');
            fwrite($fp, $e);
            fclose($fp);
            return false;
        }
    }//public function retornaDadosTorcedor()

    /**
    * metodo que tem função de fazer alteração do registro
    *
    * @access    public
    * @return    boolean|integer retorna um valor indicando se tudo ocorreu bem ou não
    * @author    Matheus Silva
    * @copyright © Copyright 2010-2016 Matheus Silva. Todos os direitos reservados.
    * @since     14/12/2010
    * @version   0.2
    */
    public function alterar()
    {
        try {
            $codigo   = $this->getCodigoTorcedor();
            $nome      = $this->getNome();
            $email     = $this->getEmail();
            $senha     = $this->getSenha();
            $confSenha = $this->getConfSenha();

            //$retorno = $this->validaTorcedor($usuario);

            //if ($retorno !== true) {
                //return $retorno;
            //}//if (!$retorno) {

            if (!(v::alnum()->length(2, 30)->validate($nome))) {
                $this->setErro("O seu nome deve ser alfanumérico de 2 a 30 caracteres.");
                return 996;
            }

            //verificar se senha atual esta certa, verifica se nova senha bate com a confirmação

            $sql  = "\n UPDATE torcedor";
            $sql .= "\n SET nome = :nome";
            $sql .= "\n ,email = :email";

            if (!empty($senha)) {
                $sql .= "\n ,senha = :senha";
            }

            $sql .= "\n WHERE codigo_torcedor = :codigo";

            $conexao = Conexao::getConexao();
            $conexao->beginTransaction();
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, \PDO::PARAM_STR, 30);
            $stmt->bindParam(":email", $email, \PDO::PARAM_STR, 100);

            if (!empty($senha)) {
                $stmt->bindParam(":senha", $senha, \PDO::PARAM_STR, 128);
            }

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
    }//public function alterar()
}
