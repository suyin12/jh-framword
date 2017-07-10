<?php
/**
 * Description of compiler
 *
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
/** 
* Switch statement plugin for smarty. 
*    This smarty plugin provides php switch statement functionality in smarty tags. 
*    To install this plugin just drop it into your smarty sysplugins folder. 
* 
* @author Steven Roebert <steven@roebert.nl> (version 2 by Jeremy Pyne <jeremy.pyne@gmail.com>) 
* - Updated: 24/01/2010 - Version 3 
* - File: smarty/plugins/compiler.switch.php 
* - Updates 
*    Version 2: 
*       Changed the break attribute to cause a break to be printed before the next case, instead of before this 
*          case.  This way makes more sense and simplifies the code.  This change in incompatible with code in 
*          from version one.  This is written to support nested switches and will work as expected. 
*    Version 2.1: 
*       Added {/case} tag, this is identical to {break}. 
*    Version 3: 
*       Rewritten for use with Smarty 3 
* - Bugs/Notes: 
*       If you are using the short form, you must case condition before the break option.  In long hand this is 
*          not necessary. 
* 
* @package Smarty 
* @subpackage plugins 
* 
* Sample usage: 
* <code> 
* {foreach item=$debugItem from=$debugData} 
*  // Switch on $debugItem.type 
*    {switch $debugItem.type} 
*       {case 1} 
*       {case "invalid_field"} 
*          // Case checks for string and numbers. 
*       {/case} 
*       {case $postError} 
*       {case $getError|cat:"_ajax"|lower} 
*          // Case checks can also use variables and modifiers. 
*          {break} 
*       {default} 
*          // Default case is supported. 
*    {/switch} 
* {/foreach} 
* </code> 
* 
* Note in the above example that the break statements work exactly as expected.  Also the switch and default 
*    tags can take the break attribute. If set they will break automatically before the next case is printed. 
* 
* Both blocks produce the same switch logic: 
* <code> 
*    {case 1 break} 
*       Code 1 
*    {case 2} 
*       Code 2 
*    {default break} 
*       Code 3 
* </code> 
* 
* <code> 
*    {case 1} 
*     Code 1 
*       {break} 
*    {case 2} 
*       Code 2 
*    {default} 
*       Code 3 
*       {break} 
* </code> 
* 
* Finally, there is an alternate long hand style for the switch statments that you may need to use in some cases. 
* 
* <code> 
* {switch var=$type} 
*    {case value="box" break=true} 
*    {case value="line"} 
*       {break} 
*    {default} 
* {/switch} 
*/ 

class Smarty_Compiler_Switch extends Smarty_Internal_CompileBase 
{ 
   /** 
    * Close all current open case/default tags 
    * 
    * @return int amount of closed tags 
    */ 
   protected function close_open_statements() 
   { 
      $counter = 0; 
      while (count($this->compiler->_tag_stack)) 
      { 
         list($open_tag, $data) = end($this->compiler->_tag_stack); 
         if (in_array($open_tag, array('case', 'default'))) 
         { 
            $this->_close_tag(array('case', 'default')); 
            $counter++; 
         } 
         else { 
            break; 
         } 
      } 
      return $counter; 
   } 
    
   /** 
    * Check whether the previous case/default needs a break 
    */ 
   protected function needs_break() 
   { 
      if (count($this->compiler->_tag_stack)) 
      { 
         list($open_tag, $data) = end($this->compiler->_tag_stack); 
         if (in_array($open_tag, array('case', 'default'))) { 
            return $data; 
         } 
      } 
      return false; 
   } 
    
   /** 
    * Check wether the switch php code is still open and so no 
    * opening <?php is needed 
    */ 
   protected function is_switch_open() 
   { 
      if (count($this->compiler->_tag_stack)) 
      { 
         list($open_tag, $data) = end($this->compiler->_tag_stack); 
         if ($open_tag == 'switch' && $data === true) { 
            return true; 
         } 
      } 
      return false; 
   } 
    
   /** 
    * Compile code for switch statement 
    * 
    * @param array $args array with tag attributes 
    * @param $compiler the Smarty_Internal_TemplateCompilerBase class with tag stack 
    */ 
   public function compile($args, $compiler) 
   { 
      $this->compiler = $compiler; 
       
      $this->required_attributes = array('var');    
      $_attr = $this->_get_attributes($args); 
      $this->_open_tag('switch', true); 
       
      // Do not close the <?php tag yet, as empty lines after it 
      // will break the php code. 
      return "<?php switch ({$_attr['var']}) { "; 
   } 
} 

class Smarty_Compiler_Switchclose extends Smarty_Compiler_Switch 
{ 
   /** 
    * Compile code for switch close statement. 
    * 
    * @param array $args array with tag attributes 
    * @param $compiler the Smarty_Internal_TemplateCompilerBase class with tag stack 
    */ 
   public function compile($args, $compiler) 
   { 
      $this->compiler = $compiler; 
       
      $output = ''; 
      if (!$this->is_switch_open()) 
      { 
         // Switch php is closed, so use opening php tag 
         $output .= '<?php '; 
      } 
       
      // Close all case/default and switch statement 
      $this->close_open_statements(); 
      $this->_close_tag('switch'); 
       
      $output .= '} ?>'; 
      return $output; 
   } 
} 

class Smarty_Compiler_Break extends Smarty_Compiler_Switch 
{ 
   /** 
    * Compile code for break statement. 
    * 
    * @param array $args array with tag attributes 
    * @param $compiler the Smarty_Internal_TemplateCompilerBase class with tag stack 
    */ 
   public function compile($args, $compiler) 
   { 
      $this->compiler = $compiler; 
      $_attr = $this->_get_attributes($args); 
       
      // Close all current case/default statements, if 1 or more 
      // have been closed, add a break statement 
      if ($this->close_open_statements()) { 
         return '<?php break; ?>'; 
      } 
      return ''; 
   } 
} 

class Smarty_Compiler_Case extends Smarty_Compiler_Switch 
{ 
   /** 
    * Compile code for case statement. 
    * 
    * @param array $args array with tag attributes 
    * @param $compiler the Smarty_Internal_TemplateCompilerBase class with tag stack 
    */ 
   public function compile($args, $compiler) 
   { 
      $this->compiler = $compiler; 
    
      $output = ''; 
      if (!$this->is_switch_open()) 
      { 
         // Switch php is closed, so use opening php tag 
         $output .= '<?php '; 
      } 
      else 
      { 
         // Switch php is open, do not use opening php tag, 
         // instead set switch data to false (meaning: switch php is closed) 
         $this->_close_tag('switch'); 
         $this->_open_tag('switch', false); 
      } 
       
      // If a break statement is needed from previous case/default statements, add it 
      if ($this->needs_break()) 
      { 
         $this->close_open_statements(); 
         $output .= 'break; '; 
      } 
    
      $this->required_attributes = array('value'); 
      $this->optional_attributes = array('break'); 
      $_attr = $this->_get_attributes($args); 

      // Open case statement and 
      // check whether there needs to be a break before the next case/default statement 
      $break = isset($_attr['break']); 
      if ($break && $_attr['break'] !== '') { 
         eval('$break = '.$_attr['break'].';'); 
      } 
      $this->_open_tag('case', $break); 
       
      $output .= "case {$_attr['value']}: ?>"; 
      return $output; 
   } 
} 

class Smarty_Compiler_Caseclose extends Smarty_Compiler_Break { } 

class Smarty_Compiler_Default extends Smarty_Compiler_Switch 
{ 
   public function compile($args, $compiler) 
   { 
      $this->compiler = $compiler; 
       
      $output = ''; 
      if (!$this->is_switch_open()) 
      { 
         // Switch php is closed, so use opening php tag 
         $output .= '<?php '; 
      } 
      else 
      { 
         // Switch php is open, do not use opening php tag, 
         // instead set switch data to false (meaning: switch php is closed) 
         $this->_close_tag('switch'); 
         $this->_open_tag('switch', false); 
      } 
       
      // If a break statement is needed from previous case/default statements, add it 
      if ($this->needs_break()) 
      { 
         $this->close_open_statements(); 
         $output .= 'break; '; 
      } 
       
      $this->optional_attributes = array('break'); 
      $_attr = $this->_get_attributes($args); 
       
      // Open default statement and 
      // check whether there needs to be a break before the next case/default statement 
      $break = isset($_attr['break']); 
      if ($break && $_attr['break'] !== '') { 
         eval('$break = '.$_attr['break'].';'); 
      } 
      $this->_open_tag('default', $break); 
       
      $output .= 'default: ?>'; 
      return $output; 
   } 
} 

class Smarty_Compiler_Defaultclose extends Smarty_Compiler_Break { } 
?>
