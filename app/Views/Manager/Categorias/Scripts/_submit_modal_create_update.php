<script>
    $('#categoria-form').submit(function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'JOSN',
            contentType: false,
            beforeSend: function(){
                $(form).find('span.error-text').text('');
            },
            success: function(response){
                window.refreshCSRFToken(response.token);
                if(response.success == false){
                    alert('erros de validação');
                    return;
                }
                // tudo certo

                //mostra a mensagem de sucesso

                $('#categoriaModal').modal('hide');
                $(form)[0].reset();
                $('#datatable').DataTable().ajax.reload(null, false);
                $('.modal-title').text('Criar Categoria');
                $(form).attr('action', <?php echo route_to('categoria.create'); ?>);
                $(form).find('input[name="id"]').val('');
                $(['name=_method']).remove();
            }
            erro: function(){
                alert('error no servidor');
            }
        });
    });
</script>