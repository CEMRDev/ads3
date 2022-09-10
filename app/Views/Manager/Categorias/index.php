<?= $this->extend('Manager/Layout/main'); ?>



<!-- envio de arquivos css e styles para tamplete principal da viwe -->
<?= $this->section('title'); ?>
    <?php echo $title ?? ''; ?>
<?= $this->endsection(); ?>



<?= $this->section('styles'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
 
<?= $this->endsection(); ?>



<!-- envio de arquivos conteudo da view -->
<?= $this->section('content'); ?>
    
<div class="content_fluid pd-3">
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header">
                <h5><?php echo $title  ?? ''; ?></h5>

                </div>
                <div class="card-body">
                <table class="table table-borderless table striped" id="dataTable">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    

<!-- Modal de dados das categorias-->
<div class="modal fade" id="categoriaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Criar Categorias</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <?php echo form_open(route_to('categorias.create'), ['id' => 'categoria-form'], ['id' => '']); ?>
      
      <div class="modal-body">
        <div class="mb-3">

            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name">
            <span class="text-danger error-text name"></span>

        </div>

        <div class="mb-3">

            <label for="parent_id" class="form-label">Categoria Pai</label>
            <!--select preenchido pelo javascript-->
            <span id="boxParents"></span>
            <span class="text-danger error-text parent_id"></span>

        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


<?= $this->endsection(); ?>



<!-- envio de scripts para view --> 
<?= $this->section('scripts'); ?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    
    
<?php echo $this->include('Manager/Categorias/Scripts/_datatable_all') ?>;
<?php echo $this->include('Manager/Categorias/Scripts/_get_categoria_info') ?>;
<?php echo $this->include('Manager/Categorias/Scripts/_submit_modal_create_update'); ?>


<script>
  function refreshCDRFToken(token){
    $('[name="<?php echo csrf_token(); ?>"]').val(token);
    $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
  }
</script>
    
<?= $this->endsection(); ?>


