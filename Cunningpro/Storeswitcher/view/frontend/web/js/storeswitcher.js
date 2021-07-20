/**
*Cunningpro Creative
*
*
* Cunningpro Creative serves customers all at one place who
searches* for different types of extensions and themes for Magento 2.
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
define([
	"jquery",
	'Magento_Ui/js/modal/modal',
	'mage/cookies'], function($,modal){
		return function storeswitcher(config, element) {
			var currenturl = window.location.href;
			if (window.redirect == "0" && window.enable == "1") {
				var modaloption = {
					type: 'popup',
					modalClass: 'modal-popup',
					responsive: true,
					innerScroll: true,
					clickableOverlay: true,
					title: 'Simple Modal',
					buttons: [{
						text: $.mage.__(yesbutton),
						class: 'modal-Yes',
						click: function (){
							window.location = window.url;
						}
					},
					{
						text: $.mage.__(nobutton),
						class: 'modal-No',
						click: function (){
							this.closeModal();
						}
					}]
				};
				$( window ).on( "load", function() {
					if (currenturl != window.url){
						var popup = modal(modaloption, $('.callfor-popup'));
						if ($.cookie('popuplogintext') == null) {
							$(".callfor-popup").modal('openModal');
							$.cookie('popuplogintext', '365', { expires: 1 });
						}
					}
				});
			}
			else{
				if ($.cookie('popuplogintext') == null) {
					$.cookie('popuplogintext', '365');
					window.location = window.url;
				}
			}
		}
	});
