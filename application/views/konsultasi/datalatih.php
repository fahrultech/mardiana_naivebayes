<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Data Latih Responden</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Naive Bayes</a></li>
                            <li class="breadcrumb-item"><a href="#">Konsultasi</a></li>
                            <li class="breadcrumb-item active">Data Latih</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-box">
                <button onClick="tambahGejala()" type="button" class="btn btn-sm btn-success mb-3">
                    <i class="mdi mdi-plus-circle-outline"></i>Tambah
                </button>
                <table class="table table-bordered table-striped table-condensed" id="tabelDataLatih">
                  <thead>
                   <tr>
                    <th width="80px">No</th>
                    <th>Pernyataan</th>
                    <th width="200px">Action</th>
                   </tr>
                  </thead>
                </table>
                </div>
              </div>
            </div>
           
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
   let table, save_method, url;
   lihatDataLatih = id => {
   }
   $(document).ready(function(){
     table = $('#tabelDataLatih').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
         "url" : "<?php echo site_url('datalatih/getAllData');?>",
         "type" : "POST"
       },
       "columnDefs": [{
         "targets": [ -1 ],
         "orderable" : false
       }]
     })
   })
</script>

