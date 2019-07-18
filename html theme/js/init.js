jQuery(document).ready(function(){
	"use strict";
	jQuery('.table').basictable();
	jQuery('.tablebusqueda').DataTable({
		"language": {
            "lengthMenu": "Se muestran _MENU_ por pagina",
            "zeroRecords": "No hay resultados que mostrar",
            "info": "Esta en la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay pacientes",
            "infoFiltered": "(filtrados de un total de _MAX_ pacientes)",
			"loadingRecords": "Loading...",
			"processing":     "procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Sig.",
				"previous":   "Ant."
			}
        }
	});
	jQuery('.maskdate').mask('00/00/0000');
	jQuery('.masktime').mask('00:00:00');
	jQuery('.masktel').mask('0000-0000');
	jQuery('.maskdui').mask('00000000-0');
	jQuery('.richeditor').richText();
	
	jQuery("[data-toggle=popover]").each(function(i, obj) {
		jQuery(this).popover({
			html: true,
			content: function() {
				var id = jQuery(this).attr('id');
				return jQuery('#popover-content-' + id).html();
			}
		});
	});
	
	jQuery.get(ajaxurl, { action: "get_statues", nonce: jQuery('body').attr('data-nonce') }, function(data){
		jQuery(".getstatus").typeahead({ source:data }); //source:data
	},'json');
	
	jQuery.get(ajaxurl, { action: "get_referencias", nonce: jQuery('body').attr('data-nonce') }, function(data){
		jQuery(".getreferencia").typeahead({ source:data }); //source:data
	},'json');
	
	jQuery('.print').click(function(){
		window.print();
	});
});