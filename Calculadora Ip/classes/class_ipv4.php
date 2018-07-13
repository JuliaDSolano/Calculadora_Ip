<?php
/**
 * calc_ipv4 - Cálculo de máscara de sub-rede IPv4
 */
class calc_ipv4
{
    // O endereço IP
    public $endereco;

    // O cidr /...
    public $cidr;

    // O endereço IP
    public $endereco_completo;

    //O status da rede

    public $status;

    //classe do ip
    public $classe;

    /** construtor apenas configura as propriedades da classe*/
    public function __construct($endereco_completo)
    {
        $this->endereco_completo = $endereco_completo;
        $this->valida_endereco();
    }

    /** Valida o endereço IPv4 */

    public function valida_endereco()
    {
        // Expressão regular
        $regexp = '/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/[0-9]{1,2}$/';

        // Verifica o IP/CIDR
        if (!preg_match($regexp, $this->endereco_completo)) {
            return false;
        }

        // Separa o IP do prefixo CIDR
        $endereco = explode('/', $this->endereco_completo);

        // CIDR
        $this->cidr = (int)$endereco[1];

        // Endereço IPv4
        $this->endereco = $endereco[0];

        // Verifica o prefixo
        if ($this->cidr > 32) {
            return false;
        }

        // Faz loop e verifica cada número do IP
        foreach (explode('.', $this->endereco) as $numero) {

            // verifica que é um número
            $numero = (int)$numero;

            // Não pode ser maior que 255 nem menor que 0
            if ($numero > 255 || $numero < 0) {
                return false;
            }
        }

        // ip válido (correto)
        return true;
    }

    /* retorna o endereço IPv4/CIDR */
    public function endereco_completo()
    {
        return ($this->endereco_completo);
    }

    /* retorna o endereço IPv4 */
    public function endereco()
    {
        return ($this->endereco);
    }

    /* Retorna o prefixo CIDR */
    public function cidr()
    {
        return ($this->cidr);
    }

    /* Retorna a máscara de sub-rede */
    public function mascara()
    {

        if ($this->cidr() == 0) {
            return '0.0.0.0';
        }

        return (
        long2ip(
            ip2long("255.255.255.255") << (32 - $this->cidr)
        )
        );
    }

    /* Retorna a rede na qual o IP está */
    public function rede()
    {
        if ($this->cidr() == 0) {
            return '0.0.0.0';
        }

        return (
        long2ip(
            (ip2long($this->endereco)) & (ip2long($this->mascara()))
        )
        );
    }

    /* Retorna o IP de broadcast da rede */
    public function broadcast()
    {
        if ($this->cidr() == 0) {
            return '255.255.255.255';
        }

        return (
        long2ip(ip2long($this->rede()) | (~(ip2long($this->mascara()))))
        );
    }

    /* Retorna o número total de IPs (com a rede e o broadcast) */
    public function total_ips()
    {
        return (pow(2, (32 - $this->cidr())));
    }

    /* Retorna os número de IPs que podem ser utilizados na rede */
    public function ips_rede(){

        if ($this->cidr() == 32) {
            return 0;

        } elseif ($this->cidr() == 31) {
            return 0;
        }
        return (abs($this->total_ips() - 2));
    }

    /* Retorna os número de IPs que podem ser utilizados na rede */
    public function primeiro_ip()
    {
        if ($this->cidr() == 32) {
            return null;

        } elseif ($this->cidr() == 31) {
            return null;

        } elseif ($this->cidr() == 0) {
            return '0.0.0.1';
        }

        return (
        long2ip(ip2long($this->rede()) | 1)
        );
    }

    /* Retorna os número de IPs que podem ser utilizados na rede */
    public function ultimo_ip()
    {

        if ($this->cidr() == 32) {
            return null;

        } elseif ($this->cidr() == 31) {
            return null;
        }

        return (
        long2ip(ip2long($this->rede()) | ((~(ip2long($this->mascara()))) - 1))
        );
    }

    public function statusRede(){


//        $octetos = explode('.', $this->endereco);

        if ($this->endereco() == 10) {

            $result = "Privado";
            return $result;

        } elseif ($this->endereco() == 127) {

            $result = "Reservao/Privado";
            return $result;

        }elseif($this->endereco() >= 172.16 AND $this->endereco() <= 172.31 ){

            $result = "Privado";
            return $result;

        }elseif($this->endereco() == 192.168){

            $result = "Privado";
            return $result;

        }elseif($this->endereco() == 169.254){

            $result = "ZeroConf/Privado";
            return $result;

        }else{

            $result = "Público";
            return $result;
        }
  }

  public function classe(){

        if($this->endereco() <128){

            $classe = "Classe A";
            return $classe;

        }elseif($this->endereco() >= 128 AND $this->endereco() <192){

            $classe = "Classe B";
            return $classe;

        }elseif($this->endereco() >= 192 AND $this->endereco() <224){

            $classe = "Classe C";
            return $classe;

        }elseif($this->endereco() >= 224 AND $this->endereco() <240){

            $classe = "Classe D";
            return $classe;

        }else{

            $classe = "Classe E";
            return $classe;

        }
  }


}
