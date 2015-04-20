<?php $this->load->view('includeforexitapp/header'); ?>

<?php if(isset($segment)){ $this->load->view($segment);} ?>

<?php $this->load->view($main_content); ?>

<?php $this->load->view('includeforexitapp/footer'); ?>