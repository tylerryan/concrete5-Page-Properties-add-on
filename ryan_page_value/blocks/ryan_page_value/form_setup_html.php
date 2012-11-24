<?php   defined('C5_EXECUTE') or die(_("Access Denied."));
$form = Loader::helper('form');
?>
<ul id="ccm-ryanPageValue-tabs" class="ccm-dialog-tabs">
	<li class="ccm-nav-active"><a id="ccm-ryanPageValue-tab-add"
		href="javascript:void(0);"><?php echo t('Edit')?></a></li>
	<li class=""><a id="ccm-ryanPageValue-tab-options"
		href="javascript:void(0);"><?php echo t('Options')?></a></li>
</ul>
<div style="padding: 10px;">
	<div class="ryanPageValue-pane" id="ccm-ryanPageValue-options" style="display: none">
		<div style="padding-bottom: 6px">
			<strong><?php  echo t('Display property with formatting')?></strong><br/>
			<select name="displayTag">
				<option value="">- none -</option>
				<option value="h1" <?php echo ($this->controller->displayTag=="h1"?"selected":"")?>>H1 (Heading 1)</option>
				<option value="h2" <?php echo ($this->controller->displayTag=="h2"?"selected":"")?>>H2 (Heading 2)</option>
				<option value="h3" <?php echo ($this->controller->displayTag=="h3"?"selected":"")?>>H3 (Heading 3)</option>
				<option value="p" <?php echo ($this->controller->displayTag=="p"?"selected":"")?>>p (paragraph)</option>
				<option value="b" <?php echo ($this->controller->displayTag=="b"?"selected":"")?>>b (bold)</option>
				<option value="address" <?php echo ($this->controller->displayTag=="address"?"selected":"")?>>address</option>
				<option value="pre" <?php echo ($this->controller->displayTag=="pre"?"selected":"")?>>pre (preformated)</option>
				<option value="blockquote" <?php echo ($this->controller->displayTag=="blockquote"?"selected":"")?>>blockquote</option>
				<option value="div" <?php echo ($this->controller->displayTag=="div"?"selected":"")?>>div</option>
			</select>
		</div>
		<div style="padding-bottom: 6px">
			<strong><?php  echo t('Format of Date Properties')?></strong><br/>
			<input type="text" name="dateFormat" value="<?php  echo $this->controller->dateFormat ?>"/><br/>			
			<?php echo sprintf(t('See the formatting options at %s.'), '<a href="http://www.php.net/date" target="_blank">php.net/date</a>'); ?>
		</div>
		<div style="padding-bottom: 6px">
			<strong><?php echo t('Thumbnail'); ?></strong><br/>
			<label for="thumbnail_width"><?php echo t('Width'); ?></label>
			<input id="thumbnail_width" type="text" name="thumbnailWidth" value="<?php echo $this->controller->thumbnailWidth; ?>"/><br/>
			<label for="thumbnail_height"><?php echo t('Height'); ?></label>
			<input id="thumbnail_height" type="text" name="thumbnailHeight" value="<?php echo $this->controller->thumbnailHeight; ?>"/><br/>
		</div>
	</div>
	
	<div id="ccm-ryanPageValue-add" class="ryanPageValue-pane">
	<div style="padding-bottom: 6px">
		<strong><?php  echo t('Property to Display:')?></strong><br/>
		<select name="attributeHandle">
		<optgroup label="<?php  echo t('Page Values');?>">
		<?php 
		$corePageValues = $this->controller->getAvailablePageValues();
		foreach(array_keys($corePageValues) as $cpv) {
			echo "<option value=\"".$cpv."\" ".($cpv==$this->controller->attributeHandle?"selected=\"selected\"":"").">".
			$corePageValues[$cpv]."</option>\n";
		}
		?>
		</optgroup>
		<optgroup label="<?php  echo t('Page Attributes');?>">
		<?php  
		$aks = $this->controller->getAvailableAttributes();
		foreach($aks as $ak) {
			echo "<option value=\"".$ak->getAttributeKeyHandle()."\" ".($ak->getAttributeKeyHandle()==$this->controller->attributeHandle?"selected=\"selected\"":"").">".
			$ak->getAttributeKeyName()."</option>\n";
		}
		?>
		</optgroup>
		</select>
	</div>
	
	<div style="padding-bottom: 6px">
		<strong><?php  echo t('Title Text')?></strong><br/>
		<input type="text" name="attributeTitleText" value="<?php  echo $this->controller->attributeTitleText ?>"/>	
	</div>
</div>
</div>
