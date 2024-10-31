// Plugin Created by Alex Moss: http://alex-moss.co.uk/
//Plugin Site: http://pleer.co.uk/wordpress/plugins/rel-external/    	
$(function(){$('a[rel*=external]').click(function(){window.open(this.href);return false;});});