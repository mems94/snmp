<?php

/**
 * Classe SNMP client
 * @author Roméo Bien Aimé
 */
class SnmpClient {

    private $address;
    private $community;
        
    /**
     * __construct
     *
     * @param  string $address
     * @param  string $community
     * @return void
     */
    public function __construct(string $address, string $community)
    {
        $this->address = $address;
        $this->community = $community;
    }
    
    /**
     * Retourne le statut de l'hote distant
     *
     * @return bool
     */
    public function getstatus(): bool 
    {
        $sysName = snmp2_get($this->address, $this->community, "sysName.0");

        if ($sysName !== false) {
            return true;
        }

        return false;
    }
    
    /**
     * Retourne le nom du systeme surveillé
     *
     * @return string
     */
    public function getName() :string
    {
     
        $sysName = snmp2_get($this->address, $this->community, "sysName.0");
        //traitement su valeur de retour à faire
        if($sysName !== false){
            $result = explode(':', $sysName);
            return $result[1];
        } 
    
        return $this->address;
    }
    
    /**
     * Retourne l'uptime du systeme surveillé
     *
     * @return string
     */
    public function getUptime(): string
    {
        $sysUptime = snmp2_get($this->address, $this->community, "sysUpTime.0");
        if ($sysUptime ==! false) {
            $sysUptime = explode(' ', $sysUptime);
            $sysUptime = $sysUptime[2];
            $sysUptime = explode(':', $sysUptime);
            return $sysUptime[0].' h '.$sysUptime[1].' m '.$sysUptime[2].' s ';
        }

        return '00 h :00 mn :00 s';
        
    }
    
    /**
     * retourne les infos sys dans le MIB
     *
     * @return array
     */
    public function getSnmpWalk(): array
    {
        $allInfosSys = snmp2_walk($this->address, $this->community, "system");
        //traitement à faire
        return $allInfosSys;
    }

}