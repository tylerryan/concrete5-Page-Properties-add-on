<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 * @author rtyler
 *
 */
class RyanPageValuePackage extends Package {

	/**
	 * @var string
	 */
	protected $pkgHandle = 'ryan_page_value';
	
	/**
	 * @var string
	 */
	protected $appVersionRequired = '5.3.3';
	/**
	 * @var string
	*/
	protected $pkgVersion = '1.0.1';
		
	public function getPackageDescription() {
		return t("Displays the value of a page property.");
	}
	
	public function getPackageName() {
		return t("Page Properties");
	}
	
	public function install() {
		$pkg = parent::install();
		BlockType::installBlockTypeFromPackage('ryan_page_value', $pkg);
	}
}