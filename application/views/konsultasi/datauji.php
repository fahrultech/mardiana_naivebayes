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
                        <h4 class="page-title float-left">Data Uji Responden</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Naive Bayes</a></li>
                            <li class="breadcrumb-item"><a href="#">Konsultasi</a></li>
                            <li class="breadcrumb-item active">Data Uji</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-box">
                <table class="table table-bordered table-striped table-condensed" id="tabelDataUji">
                  <thead>
                   <tr>
                    <th width="80px">No</th>
                    <th>Username</th>
                    <th>Tipe Kecanduan</th>
                    <th>Tanggal</th>
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
     table = $('#tabelDataUji').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
         "url" : "<?php echo base_url('datauji/getAllData');?>",
         "type" : "POST"
       },
       "columnDefs": [{
         "targets": [ -1 ],
         "orderable" : false
       }]
     })
   })
   hapusDataUji = id => {
    if(confirm("Apakah Anda Yakin Akan Menghapus Data Ini")){
        $.ajax({
        url : `datauji/hapusDataUji/${id}`,
        type: "POST",
        dataType: "JSON",
        success : function(data){
            if(data.status){
                table.ajax.reload();
            }
        }
      })
    }
   }
</script>

