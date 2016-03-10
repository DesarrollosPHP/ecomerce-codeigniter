<script type="text/javascript">
 var base_url = "<?php echo base_url(); ?>ecomerce/Pagina_Productos";
   $(document).ready(function(){ 
      $("#contenedor").load(base_url);
      $(document).on("click", "#pagination-digg li a", function(e){
          e.preventDefault();
         var href = $(this).attr("href");
         $("#contenedor").load(href);
      }); 
   });
</script>
 
<div id="contenedor"> </div>