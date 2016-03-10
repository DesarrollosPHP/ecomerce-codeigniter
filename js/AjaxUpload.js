 $(function(){
        $("input[name='file']").on("change", function(){ 
			var formData = new FormData(document.getElementById("formulario")); 
            var ruta = base_url + "productos/SubeImg";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
     });