<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of prefilter
 *
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */

/**
 * Prefilter plugin for shorthand mode Switch plugin. (see Switch plugin for details) 
 * 
 * @author Steven Roebert <steven@roebert.nl> 
 * - Created: 25/01/2010 - Version 1 
 * - File: smarty/plugins/prefilter.switch.php 
 * 
 * @package Smarty 
 * @subpackage plugins 
 * 
 * Sample usage: 
 * <code> 
 * $smarty->autoload_filters['pre'][] = 'switch'; 
 * </code> 
 */
class Smarty_Prefilter_Switch {

    public function execute($output, $smarty) {
        // Add var= to switch statements without it 
        $output = preg_replace("/\{switch (?!(\s*)var(\s*)=)/", "{switch var=", $output);

        // Add value= to case statements without it 
        $output = preg_replace("/\{case (?!(\s*)value(\s*)=)/", "{case value=", $output);

        // Return new output 
        return $output;
    }

}

?>
