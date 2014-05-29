// JavaScript Document

$(document).ready(function() {
			setTimeout(function() {
				// Slide
				$('#menu1 > li > a.expanded + ul').slideToggle('medium');
				$('#menu1 > li > a.btn_accordion').click(function() {
					$(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
				});
				$('#accordlist .expand_all').click(function() {
					$('#menu1 > li > a.collapsed').addClass('expanded').removeClass('collapsed').parent().find('> ul').slideDown('medium');
				});
				$('#accordlist .collapse_all').click(function() {
					$('#menu1 > li > a.expanded').addClass('collapsed').removeClass('expanded').parent().find('> ul').slideUp('medium');
				});
				
				// Accordion
				$('#menu5 > li > a.expanded + ul').slideToggle('medium');
				$('#menu5 > li > a.btn_accordion').click(function() {
					$('#menu5 > li > a.expanded').not(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
					$(this).toggleClass('expanded').toggleClass('collapsed').parent().find('> ul').slideToggle('medium');
				});
			}, 250);
		});