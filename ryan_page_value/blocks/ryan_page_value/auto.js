	ryanPageValueTabSetup = function() {
		$('ul#ccm-ryanPageValue-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-ryanPageValue-tab-','');
				ryanPageValueShowPane(pane);
			}
		});		
	}
	
	ryanPageValueShowPane = function (pane) {
		$('ul#ccm-ryanPageValue-tabs li').each(function(num,el){ $(el).removeClass('ccm-nav-active') });
		$(document.getElementById('ccm-ryanPageValue-tab-'+pane).parentNode).addClass('ccm-nav-active');
		$('div.ryanPageValue-pane').each(function(num,el){ el.style.display='none'; });
		$('#ccm-ryanPageValue-'+pane).css('display','block');
		if(pane=='preview') { 
			//reloadPreview(document.blockForm);
		}
	}
	$(function() {	
		ryanPageValueTabSetup();		
		}
	);

