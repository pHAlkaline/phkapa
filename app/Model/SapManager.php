<?php

/**
 * SapMAnager
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SapManager extends AppModel {

    /**
     * Used for runtime configuration of model
     *
     * @var array
     * @access public
     */
    public $runtime = array();

    /**
     * Array Used for Sap Login Production
     *
     * @var array
     * @access public
     */
    private $sap_login_production = array(
        "ASHOST" => "*****",
        "SYSNR" => "00",
        "CLIENT" => "500",
        "USER" => "_GCTO_IDOC",
        "PASSWD" => "06071992",
        "LANG" => "PT",
            #"TRACE"=>"Y"
            #"LANG"=>"EN"
    );
    
    /**
     * Array Used for Sap WM Login Production
     *
     * @var array
     * @access public
     */
    private $sap_login_wm_production = array(
        "ASHOST" => "*****", // 
        "SYSNR" => "21", //21
        "CLIENT" => "300", // 300
        "USER" => "sistst", //sistst //GCT00011
        "PASSWD" => "asdfgh", //asdfgh //iaka!!
        "LANG" => "PT", //PT
            #"TRACE"=>"Y"
            #"LANG"=>"EN"
    );
    
    /**
     * Array Used for Sap Login Tests
     *
     * @var array
     * @access public
     */
    private $sap_login_test = array(
        "ASHOST" => "*****",
        "SYSNR" => "00",
        "CLIENT" => "500",
        "USER" => "",
        "PASSWD" => "",
        "LANG" => "PT",
            #"TRACE"=>"Y"
            #"LANG"=>"EN"
    );

    /**
     * SapRpc Var
     * 
     * @var string
     * @access public
     */
    public $sapRfc;

    /**
     * SapMod Array
     * 
     * @var string
     * @access public
     */
    public $sapMod;

    /**
     * error Details Array
     * 
     * @var array
     * @access public
     */
    public $errorDetails = null;

    
    /**
     * __destruct
     *
     * @return void
     * @access protected
     */
    protected function __destruct() {
        $this->sapLogout();
    }

    /**
     * sapLogout
     *
     * @return void
     * @access private
     */
    public function sapLogout() {
        if ($this->sapMod != null) {
            foreach ($this->sapMod as $key => $value) {
                saprfc_function_free($this->sapMod[$key]);
            }
            $this->sapMod = null;
        }
        if ($this->sapRfc != null) {

            saprfc_close($this->sapRfc);
            $this->sapRfc = null;
        }
    }

    /**
     * sapLogn
     *
     * @param string $conn - Connection string "Test","Production","Production_wm"
     * @return boolean
     * @access private
     */
    public function saplogin($conn = null) {
        switch ($conn) {
            case "Test":
                $this->sapRfc = @saprfc_open($this->sap_login_test);
                break;

            case "Production":
                $this->sapRfc = @saprfc_open($this->sap_login_production);
                break;

            case "Production_wm":
                $this->sapRfc = @saprfc_open($this->sap_login_wm_production);
                break;

            default:
                $this->sapRfc = @saprfc_open($this->sap_login_test);
                break;
        }

        if (!$this->sapRfc) {
            return false;
        }
        return true;
    }

    
    /**
     * sapConn
     *
     * @param string $conn - Connection string "Test","Production","Production_wm"
     * @param string $module - Sap Module to connect ...
     * @return saprfc_function reference
     * @access private
     */
    public function sapConn($conn, $module) {

        if (isset($this->sapMod[$module]) and $this->sapMod[$module]) {
            return $this->sapMod[$module];
        }

        if (!$this->sapRfc && !$this->saplogin($conn)) {
            trigger_error("Sap connection failed!", E_USER_ERROR);
            $this->errorDetails[] = array('Result' => '0', 'Message' => 'Ligação ao servido Sap falhou!');
            return false;
        }


        $sapModule = $module;
        $this->sapMod[$module] = saprfc_function_discover($this->sapRfc, $sapModule);
        if (!$this->sapMod[$module]) {
            trigger_error('SAP module function not found', E_USER_ERROR);
            $this->errorDetails[] = array('Result' => '0', 'Message' => 'Módulo de função ' . $sapModule . ' não encontrado');
            return false;
        }

        return $this->sapMod[$module];
    }

     /**
     * getLastErrorDetail
     *
     * @return array
     * @access private
     */
    public function getLastErrorDetail() {
        $lastElement = count($this->errorDetails) - 1;
        return $this->errorDetails[$lastElement];
    }

}

?>