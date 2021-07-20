<?php
/***Cunningpro Creative
*
*
* Cunningpro Creative serves customers all at one place who
searches
* for different types of extensions and themes for Magento 2.
*
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this
extension to newer
* version in the future.
*
* @category  
Cunningpro Creative
* @package
Cunningpro_Storeswitcher
* @copyright
Copyright (c) Cunningpro Creative
(https://cunningpro.com/)
* See COPYING.txt for license details.
*/
namespace Cunningpro\Storeswitcher\Block;
use GeoIp2\Database\Reader;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

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
    public function getGeoIp(){
      $reader = new Reader(dirname(__FILE__) . '/../data/GeoLite2-City.mmdb');
      $ipaddress = $_SERVER['REMOTE_ADDR'];
      $record = $reader->city($ipaddress);
      //$record = $reader->city('192.199.248.75');
      return $record->country->isoCode;
    }
    public function getModule(){
      $module = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
      $storemodule = $this->_scopeConfig->getvalue('cunningpro/general/enable', $module);
      return $storemodule;
    }
    public function getstore(){
      $store = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
      $storevalue =$this->_scopeConfig->getvalue('cunningpro/genral/buttons', $store);
      return $storevalue;
    }
    public function storebtn(){
      $store = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
      $storevalues =$this->_scopeConfig->getvalue('cunningpro/genral/buttom', $store);
      return $storevalues;
    }
    public function storebt(){
      $store = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
      $storevalu =$this->_scopeConfig->getvalue('cunningpro/genral/buttont', $store);
      return $storevalu;
    }
    public function autodirect(){
      $store = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
      $storeval =$this->_scopeConfig->getvalue('cunningpro/storefront/enables', $store);
      return $storeval;
    }
    public function getStoreInfo()
    {
      $ipinfo = $this->getGeoIp();
      $groups = $this->storeManager->getWebsite()->getGroups();
      $storeName = [];
      $storeViewName = [];
      foreach ($groups as $key => $group) {
        $stores = $group->getStores();
        foreach ($stores as $store) {
         if ("uk" == $store->getCode()){ 
          return $store->getUrl();   
        } 
      }
    }   
  }
}
?>
