

<script>
//chama de requisição ajax, para edição das categorias

    $(document).on('click', '#updateCategoryBtn', function () {
       var id = $(this).data('id');
       var url = '<?php echo route_to('categorias.get.info'); ?>';
       
       $.get(url, {
            id: id
       }, function(response){
            $('#categoriaModal').modal('show');
            $('.modal-title').text('Atualizar Categoria');
            $('#categoria-form').attr('action', '<?php echo route_to('categorias.update'); ?>');
            $('#categoria-form').find('input[name="id"]').val(response.categoria.id);
            $('#categoria-form').find('input[name="name"]').val(response.categoria.name);
            $('#categoria-form').append("<input type='hidden' name='_method' value='PUT'>");
            $('#boxParents').html(response.parents);
            $('#categoria-form').find('span.error-text').text('');
       }, 'json');
    });
</script>