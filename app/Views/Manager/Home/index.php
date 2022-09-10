<?= $this->extend('Manager/Layout/main'); ?>



<!-- envio de arquivos css e styles para tamplete principal da viwe -->
<?= $this->section('title'); ?>
    <?php echo $title ?? ''; ?>
<?= $this->endsection(); ?>



<?= $this->section('styles'); ?>
<?= $this->endsection(); ?>



<!-- envio de arquivos conteudo da view -->
<?= $this->section('content'); ?>
    <h1><?php echo $title  ?? ''; ?></h1>
<?= $this->endsection(); ?>



<!-- envio de scripts para view --> 
<?= $this->section('scripts'); ?>
<?= $this->endsection(); ?>


