<?php
/**
 * calc_ipv4 - Cálculo de máscara de sub-rede IPv4
 */
class calc_ip
{
    // O endereço IP
    public $endereco;
    
    // O cidr
    public $cidr;
    
    // O endereço IP 
    public $endereco_completo;

    /**
     * O construtor apenas configura as propriedades da classe
     */
    public function __construct( $endereco_completo ) {
        $this->endereco_completo = $endereco_completo;
        $this->valida_endereco();
    }
    
    /**
     * Valida o endereço IP
     */
    public function valida_endereco() {
        // Expressão regular
        $vex = '/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/[0-9]{1,2}$/';
        
        // Verifica o IP/CIDR
        if ( ! preg_match( $vex, $this->endereco_completo ) ) {
            return false;
        }
        
        // Separa o IP do prefixo CIDR
        $endereco = explode( '/', $this->endereco_completo );
        
        // CIDR
        $this->cidr = (int) $endereco[1];
        
        // Endereço IPv4
        $this->endereco = $endereco[0];
        
        // Verifica o prefixo
        if ( $this->cidr > 32 ) {
            return false;
        }
        
        // Faz um loop e verifica cada número do IP
        foreach( explode( '.', $this->endereco ) as $numero ) {
        
            // Garante que é um número
            $numero = (int) $numero;
            
            // Não pode ser maior que 255 nem menor que 0
            if ( $numero > 255 || $numero < 0 ) {
                return false;
            }
        }
        
        // IP "válido" (correto)
        return true;
    }

    /* Retorna o endereço IPv4/CIDR */
    public function endereco_completo() { 
        return ( $this->endereco_completo ); 
    }

    /* Retorna o endereço IPv4 */
    public function endereco() { 
        return ( $this->endereco ); 
    }


}

