<?php
/**
* Cunningpro Creative
*
*
* Cunningpro Creative serves customers all at one place who searches
* for different types of extensions and themes for Magento 2.
*
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this extension to newer
* version in the future.
*
* @category  Cunningpro Creative
* @package   Cunningpro_Storeswitcher
* @copyright Copyright (c) Cunningpro Creative (https://cunningpro.com/)
* See COPYING.txt for license details.
*/

namespace Cunningpro\Storeswitcher\Block;
use GeoIp2\Database\Reader;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
* class Storeswitcher
* @package Cunningpro\Storeswitcher\Block
*/
class Storeswitcher extends \Magento\Framework\View\Element\Template
{
    /**
    * @var scopeConfig
    */
    protected $scopeConfig;

    /**
    * @var storeManager
    */
    protected $storeManager;
    
    /**
    * @param Context $context
    * @param ScopeConfigInterface $scopeConfig
    * @param ScopeInterface $scopeManage
    * 
    */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) 
    {
    	$this->scopeConfig = $scopeConfig;
    	$this->storeManager = $storeManager;
    	parent::__construct($context, $data);
    }

    /**
    * getGeoIp function used to get user data by their local ip address
    *
    */
    public function getGeoIp(){
        $reader = new Reader(dirname(__FILE__) . '/../data/GeoLite2-City.mmdb');
        // $ipaddress = $_SERVER['REMOTE_ADDR'];
        // $record = $reader->city($ipaddress);
        $record = $reader->city('192.199.248.75');
        return $record->country->isoCode;
    }

    /**
    * getModule function used to get module value
    *  
    */
    public function getModule(){
        $module = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $modulevalue = $this->_scopeConfig->getvalue('cunningpro/general/enable', $module);
        return $modulevalue;
    }

    /**
    * getPopupContent function used to get pop-up content value
    *
    */
    public function getPopupContent(){
        $popupcontent= \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $popupvalue =$this->scopeConfig->getvalue('cunningpro/content/popupcontent', $popupcontent);
        return $popupvalue;
    }

    /**
    * getYesBtn function used to yes button value
    * 
    */
    public function getYesBtn(){
        $yesbutton = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $yesbuttonvalue =$this->scopeConfig->getvalue('cunningpro/content/yesbutton',$yesbutton);
        return $yesbuttonvalue;
    }

    /**
    * getNoBtn function used to get no button value
    *
    */
    public function getNoBtn(){
        $nobutton = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $nobuttonvalue =$this->scopeConfig->getvalue('cunningpro/content/nobutton', $nobutton);
        return $nobuttonvalue;
    }

    /**
    * autoDirect function used to get autoredirect value 
    *
    */


    public function autoDirect(){
        $redirect = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $redirectvalue = $this->scopeConfig->getvalue('cunningpro/redirect/autoredirect', $redirect);
        return $redirectvalue;
    }

    /**
    * getStoreInfo function used to get store information  
    *
    */
    public function getStoreInfo(){
        $ipinfo = $this->getGeoIp();
        $groups = $this->storeManager->getWebsite()->getGroups();
        $storeName = [];
        $storeViewName = [];
        foreach ($groups as $key => $group) {
        $stores = $group->getStores();
        foreach ($stores as $store) {
        if ("de" == $store->getCode()){ 
           return $store->getUrl();

        } 
      }
     }   
    }
}
?>
