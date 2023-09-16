$(document).ready(function() {
    var dropdown = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">'+
                    '<a class="dropdown-item eliminarDoc" idArchivo href="#">Eliminar</a>'+
                    '<a class="dropdown-item DownloadDoc" download idArchivo href="#">Descargar</a>'+
                    '</div>';

    var dropdownCarpeta = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">'+
                    '<a class="dropdown-item verCarpeta" idArchivo href="#">Ver Contenido</a>'+
                    '<a class="dropdown-item eliminarDoc" idArchivo href="#">Eliminar</a>'+
                    '<a class="dropdown-item DownloadCarpeta" idArchivo href="#">Descargar</a>'+
                    '</div>';

  	var dataTableEmpresas = $('#dataTable').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": {
            "url": 'ajax/empresa.ajax.php?getDataCarpeta='+$("#idCarpetaPadre").val(),
            "type": "POST"
        },
        "columns": [
            { "data": "doc_descripcion_v" },
            { "data": "doc_tipo_v" },
            { "data": "doc_fecha_d" },
            { "data": "doc_user_registrador_i" },
            {}
        ],
        "columnDefs": [
            {
                "targets": -1,
                "data": null,
                "defaultContent": '',
                render: {
                        display: function (data, type, row) {
                            if (row.doc_tipo_v == 'Archivo') {
                                return '<button class="btn btn-circle btn-default dropdown no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></button>'+dropdown
                            } else {
                                return '<button class="btn btn-circle btn-default dropdown no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></button>'+dropdownCarpeta
                            }
                        },
                    },
            }
        ],
        "order": [[ 1, "desc" ], [ 0, "asc" ]],
        responsive: true,
		"language" : {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			    "sFirst":    "Primero",
			    "sLast":     "Último",
			    "sNext":     "Siguiente",
			    "sPrevious": "Anterior"
			},
			"oAria": {
			    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		} 
  	});

    $('#dataTable tbody').on( 'click', 'a', function () {
        var data = dataTableEmpresas.row( $(this).parents('tr') ).data();
        $(this).attr("idArchivo", data.doc_id_i);
    });

    $('#dataTable tbody').on("click", ".DownloadDoc", function(){
        var data = dataTableEmpresas.row( $(this).parents('tr') ).data();
        $(this).attr('href', data.doc_ruta_v);
        //window.location = data.doc_ruta_v;
    });

    $('#dataTable tbody').on("click", ".eliminarDoc", function(){
        var x = $(this).attr('idArchivo');
        swal({
            title: '¿Está seguro de borrar el archivo?',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar arhivo!'
        },function(isConfirm) {
            if (isConfirm) {
                var formData = new FormData();
                formData.append('D_emp_id_i', x);
                $.ajax({
                    url: 'ajax/empresa.ajax.php',
                    type  : 'post',
                    data: formData,
                    dataType : 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $.blockUI({ 
                            message : '<h3>Un momento por favor....</h3>',
                            baseZ: 2000,
                            css: { 
                                border: 'none', 
                                padding: '1px', 
                                backgroundColor: '#000', 
                                '-webkit-border-radius': '10px', 
                                '-moz-border-radius': '10px', 
                                opacity: .5, 
                                color: '#fff' 
                            } 
                        }); 
                    },
                    complete:function(){
                        $.unblockUI();
                    },
                    //una vez finalizado correctamente
                    success: function(data){
                        if(data.code == 0){
                            alertify.error('Proceso terminado, '+data.mensaje);
                        }else{
                            alertify.success('Proceso terminado, '+data.mensaje);
                        }
                        dataTableEmpresas.ajax.reload();
                    },
                    //si ha ocurrido un error
                    error: function(){
                        //after_save_error();
                        alertify.error('Error al realizar el proceso');
                    }
                });
            }
        })
    });


    $('#dataTable tbody').on("click", ".verCarpeta", function(){
        var x = $(this).attr('idArchivo');
        window.location = 'index.php?ruta=carpetas&cata='+x;
    });
    

  	$("#enviarFormNuevo").click(function(){
  		var formData = new FormData($("#nuevaEmpresa")[0]);
        $.ajax({
            url: 'ajax/empresa.ajax.php',
            type  : 'post',
            data: formData,
            dataType : 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $.blockUI({ 
                    message : '<h3>Un momento por favor....</h3>',
                    baseZ: 2000,
                    css: { 
                        border: 'none', 
                        padding: '1px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                }); 
            },
            complete:function(){
                $.unblockUI();
            },
            //una vez finalizado correctamente
            success: function(data){
                if(data.code == 0){
                    alertify.error('Proceso terminado, '+data.mensaje);
                }else{
                    alertify.success('Proceso terminado, '+data.mensaje);
                }
                dataTableEmpresas.ajax.reload();
                $("#nuevaEmpresa")[0].reset();
                $("#modalEmpresaNueva").modal('hide');
            },
            //si ha ocurrido un error
            error: function(){
                //after_save_error();
                alertify.error('Error al realizar el proceso');
            }
        });
  	});

    $("#enviarFormNuevaCarpet").click(function(){
        var formData = new FormData($("#nuevaCarpeta")[0]);
        $.ajax({
            url: 'ajax/empresa.ajax.php',
            type  : 'post',
            data: formData,
            dataType : 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $.blockUI({ 
                    message : '<h3>Un momento por favor....</h3>',
                    baseZ: 2000,
                    css: { 
                        border: 'none', 
                        padding: '1px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                }); 
            },
            complete:function(){
                $.unblockUI();
            },
            //una vez finalizado correctamente
            success: function(data){
                if(data.code == 0){
                    alertify.error('Proceso terminado, '+data.mensaje);
                }else{
                    alertify.success('Proceso terminado, '+data.mensaje);
                }
                dataTableEmpresas.ajax.reload();
                $("#nuevaCarpeta")[0].reset();
                $("#modalCarpetaNueva").modal('hide');
            },
            //si ha ocurrido un error
            error: function(){
                //after_save_error();
                alertify.error('Error al realizar el proceso');
            }
        });
    });
});