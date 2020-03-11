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
                        <h4 class="page-title float-left">Data Tingkat Kecanduan</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Naive Bayes</a></li>
                            <li class="breadcrumb-item active">Tingkat Kecanduan</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-box">
                <button onClick="tambahTingkatKecanduan()" type="button" class="btn btn-sm btn-success mb-3">
                    <i class="mdi mdi-plus-circle-outline"></i>Tambah
                </button>
                <table class="table table-bordered table-striped table-condensed" id="tabelTingkatKecanduan">
                  <thead>
                   <tr>
                    <th width="80px">No</th>
                    <th>Tipe Kecanduan</th>
                    <th>Keterangan</th>
                    <th>Solusi</th>
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
     <!-- sample modal content -->
    <div id="modalTingkatKecanduan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel"></h5>
                </div>
                <div class="modal-body">
                   <form action="" class="form-horizontal">
                     <div class="form-group row">
                       <input type="text" hidden name="idtipekecanduan">
                       <label for="" class="col-4 col-form-label">Tipe Kecanduan</label>
                       <div class="col-8">
                         <input name="tipekecanduan" type="text" class="form-control">
                       </div>
                     </div>
                     <div class="form-group row">
                       <label for="" class="col-4 col-form-label">Keterangan</label>
                       <div class="col-8">
                         <input name="keterangan" type="text" class="form-control">
                       </div>
                     </div>
                     <div class="form-group row">
                       <label for="" class="col-4 col-form-label">Solusi</label>
                       <div class="col-8">
                         <input name="solusi" type="text" class="form-control">
                       </div>
                     </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" onClick="save()" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
   let table, save_method, url;
   tambahTingkatKecanduan = () => {
     save_method = 'add';
     $('form')[0].reset();
     $('.modal-title').text('Tambah Tipe Kecanduan')
     $('#modalTingkatKecanduan').modal('show');
   }
   editTipeKecanduan = id => {
     save_method = 'edit';
     $('form')[0].reset();
     $('.modal-title').text('Edit Tipe Kecanduan');
     $.ajax({
       url :`tingkatkecanduan/edittipekecanduan/${id}`,
       type: "GET",
       dataType : "JSON",
       success : function(data){
         console.log(data);
         $('[name="idtipekecanduan"]').val(data.id);
         $('[name="tipekecanduan"]').val(data.tipekecanduan);
         $('[name="keterangan"]').val(data.keterangan);
         $('[name="solusi"]').val(data.solusi);
         $('#modalTingkatKecanduan').modal('show');
       }
     })
   }
   hapusTipeKecanduan = id => {
    if(confirm("Apakah Anda Yakin Akan Menghapus Data Ini")){
        $.ajax({
        url : `tingkatkecanduan/hapustipekecanduan/${id}`,
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
   save = () => {
     console.log('Simpan...');
     if(save_method == 'add'){
        url = 'tingkatkecanduan/tambahTipeKecanduan'
        }else{
            url = 'tingkatkecanduan/updateTipeKecanduan'
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modalTingkatKecanduan').modal('hide');
                    table.ajax.reload();
                }
            }
        })
   }
   $(document).ready(function(){
     table = $('#tabelTingkatKecanduan').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
         "url" : "<?php echo site_url('tingkatkecanduan/getAllData');?>",
         "type" : "POST"
       },
       "columnDefs": [{
         "targets": [ -1 ],
         "orderable" : false
       }]
     })
   })
</script>

