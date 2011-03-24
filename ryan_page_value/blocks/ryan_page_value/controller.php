<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));
	Loader::model('attribute/categories/collection');
	Loader::model('collection_types');
	/**
	 * @author Ryan Tyler
	 *
	 */
	class RyanPageValueBlockController extends BlockController {
				
		/**
		 * @var Page
		*/
		public $cobj;
		protected $btTable = 'btRyanPageValue';		
		protected $btInterfaceWidth = "500";
		protected $btInterfaceHeight = "365";
		public $dateFormat = "m/d/y h:i:a";
		
		public function __construct($obj = null) {
			$cobj = Page::getCurrentPage();
			if (is_object($cobj)) {	
				$this->cobj = $cobj;
			} elseif(is_object($obj) && strtolower(get_class($obj))=="block") {
				$this->bID = $obj->bID;
				$this->cobj = $obj->getBlockCollectionObject();
			}
			parent::__construct($obj);
		}
				
		public function getBlockTypeDescription() {
			return t("Displays the value of a page property");
		}
		
		public function getBlockTypeName() {
			return t("Page Properties");
		}
		
		/**
		 * @return mixed AttributeValue
		 */
		public function getContent() {
			$content = "";
			switch($this->attributeHandle) {
				case "rpv_pageName":
					$content = $this->cobj->getCollectionName();
				break;
				case "rpv_pageDescription":
					$content = $this->cobj->getCollectionDescription();
				break;
				case "rpv_pageDateCreated":
					$content = $this->cobj->getCollectionDateAdded();
				break;
				case "rpv_pageDatePublic":
					$content = $this->cobj->getCollectionDatePublic();
				break;
				default:
					$content = $this->cobj->getAttribute($this->attributeHandle);
				break;
			}
		
			if(!strlen($content) && $this->cobj->isMasterCollection()) {
				$content = $this->getPlaceHolderText($this->attributeHandle);
			}
			return $content;
		}
		
		/**
		 * returns a place holder for pages that are new or when editing default page types
		 * @param string $handle
		 * @return string
		 */
		public function getPlaceHolderText($handle) {
			$pageValues = $this->getAvailablePageValues();
			if(in_array($handle,array_keys($pageValues))) {
				$placeHolder =  $pageValues[$handle];
			} else {
				$attributeKey = CollectionAttributeKey::getByHandle($handle);
				if(is_object($attributeKey)) {
					$placeHolder = $attributeKey->getAttributeKeyName();
				}
			}
			return "[".$placeHolder."]";
		}
		
		/**
		 * returns the title text to display in front of the valie
		 * @return string
		 */
		public function getTitle() {
			return (strlen($this->attributeTitleText)?$this->attributeTitleText." ":"");
		}
		
		public function getAvailablePageValues() {
			return array(
				'rpv_pageName'=>t('Page Name'),
				'rpv_pageDescription'=>t('Page Description'),
				'rpv_pageDateCreated'=>t('Page Date Created'),
				'rpv_pageDatePublic'=>t('Page Date Published')
			);
		}
		
		public function getAvailableAttributes() {
			$ctype = CollectionType::getByHandle($this->cobj->getCollectionTypeHandle());
			return $ctype->getAvailableAttributeKeys();
		}
		
		public function getAvailableTemplates() {
			return $this->getBlockObject()->getBlockTypeObject()->getBlockTypeCustomTemplates();
		}
	
		protected function getTemplateHandle() {
			if(in_array($this->attributeHandle,array_keys($this->getAvailablePageValues()))) {
				switch($this->attributeHandle) {
					case "rpv_pageDateCreated":
					case "rpv_pageDatePublic":
						$templateHandle = 'date_time';
					break;
				}
			} else {
				$attributeKey = CollectionAttributeKey::getByHandle($this->attributeHandle);
				if(is_object($attributeKey)) {
					$attributeType = $attributeKey->getAttributeType();	
					$templateHandle = $attributeType->getAttributeTypeHandle();		
				}
			}
			return $templateHandle;
		}
		
		/**
		 * returns opening html tag
		 * @return string
		 */
		public function getOpenTag(){
			$tag = "";
			if(strlen($this->displayTag)){
				$tag = "<".$this->displayTag.">";
			}
			return $tag;
		}
		
		/**
		 * returns closing html tag
		 * @return string
		 */
		public function getCloseTag(){
			$tag = "";
			if(strlen($this->displayTag)){
				$tag = "</".$this->displayTag.">";
			}
			return $tag;
		}
		
		public function view() {
			$templateHandle = $this->getTemplateHandle();
			$this->render('templates/'.$templateHandle);
		}
	}
?>