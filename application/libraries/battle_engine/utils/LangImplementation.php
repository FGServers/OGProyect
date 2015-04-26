<?php

class LangImplementation implements Lang
{
    private $_lang;

    public function __construct()
    {
        new Language('INGAME');

        $this->_lang    = $_lang;
    }

    public function getShipName($id)
    {
        return $this->_lang['tech'][$id];
    }
    public function getAttackersAttackingDescr($amount, $damage)
    {
        return $this->_lang['fleet_attack_1'] . ' ' . $damage . " " . $this->_lang['damage'] . " with $amount shots ";
    }
    public function getDefendersDefendingDescr($damage)
    {
        return $this->_lang['fleet_attack_2'] .' '. $damage . ' ' . $this->_lang['damage'];
    }
    public function getDefendersAttackingDescr($amount, $damage)
    {
        return $this->_lang['fleet_defs_1'] . ' ' . $damage . " " . $this->_lang['damage'] . " with $amount shots ";
    }
    public function getAttackersDefendingDescr($damage)
    {
        return $this->_lang['fleet_defs_2']. ' ' . $damage . ' ' . $this->_lang['damage'];
    }
    public function getAttackerHasWon()
    {
        return $this->_lang['sys_attacker_won'];
    }
    public function getDefendersHasWon()
    {
        return $this->_lang['sys_defender_won'];
    }
    public function getDraw()
    {
        return $this->_lang['sys_both_won'];
    }
    public function getStoleDescr($metal, $crystal, $deuterium)
    {
        return $this->_lang['sys_stealed_ressources'] . " $metal " . $this->_lang['Metal'] . ", $crystal " . $this->_lang['Crystal'] . " " . $this->_lang['sys_and'] . " $deuterium " . $this->_lang['Deuterium'];
    }
    public function getAttackersLostUnits($units)
    {
        return $this->_lang['sys_attacker_lostunits'] . " $units " . $this->_lang['sys_units'] . '.';
    }
    public function getDefendersLostUnits($units)
    {
        return $this->_lang['sys_defender_lostunits'] . " $units " . $this->_lang['sys_units'] . '.';
    }
    public function getFloatingDebris($metal, $crystal)
    {
        return $this->_lang['debree_field_1'] . ":  $metal " . $this->_lang['Metal'] . " $crystal " . $this->_lang['Crystal'] . ' ' . $this->_lang['debree_field_2'] . '.';
    }
    public function getMoonProb($prob)
    {
        return $this->_lang['sys_moonproba'] . " $prob% .";
    }
    public function getNewMoon()
    {
        return $this->_lang['sys_moonbuilt'];
    }
}

LangManager::getInstance()->setImplementation(new LangImplementation());

?>