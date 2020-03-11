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
                <button onClick="tambahGejala()" type="button" class="btn btn-sm btn-success mb-3">
                    <i class="mdi mdi-plus-circle-outline"></i>Tambah
                </button>
                <table class="table table-bordered table-striped table-condensed" id="tabelGejala">
                  <thead>
                   <tr>
                    <th width="80px">No</th>
                    <th>Gejala</th>
                    <th>Ringan</th>
                    <th>Sedang</th>
                    <th>Berat</th>
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
    <div id="modalGejala" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel"></h5>
                </div>
                <div class="modal-body">
                   <form action="" class="form-horizontal">
                     <div class="form-group row">
                       <input type="text" hidden name="idgejala">
                       <label for="" class="col-4 col-form-label">Gejala</label>
                       <div class="col-8">
                         <input name="gejala" type="text" class="form-control">
                       </div>
                     </div>
                     <div class="form-group row">
                       <label for="" class="col-4 col-form-label">Ringan</label>
                       <div class="col-8">
                         <select name="ringan" id="" class="form-control">
                            <option value="Y">Y</option>
                            <option value="T">T</option>
                         </select>
                       </div>
                     </div>
                     <div class="form-group row">
                       <label for="" class="col-4 col-form-label">Sedang</label>
                       <div class="col-8">
                         <select name="sedang" id="" class="form-control">
                            <option value="Y">Y</option>
                            <option value="T">T</option>
                         </select>
                       </div>
                     </div>
                     <div class="form-group row">
                       <label for="" class="col-4 col-form-label">Berat</label>
                       <div class="col-8">
                         <select name="berat" id="" class="form-control">
                            <option value="Y">Y</option>
                            <option value="T">T</option>
                         </select>
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
   tambahGejala = () => {
     save_method = 'add';
     $('form')[0].reset();
     $('.modal-title').text('Tambah Gejala')
     $('#modalGejala').modal('show');
   }
   editGejala = id => {
     save_method = 'edit';
     $('form')[0].reset();
     $.ajax({
       url :`gejala/editGejala/${id}`,
       type: "GET",
       dataType : "JSON",
       success : function(data){
         console.log(data);
         $('[name="idgejala"]').val(data.id);
         $('[name="gejala"]').val(data.gejala);
         $('[name="ringan"]').val(data.ringan);
         $('[name="sedang"]').val(data.sedang);
         $('[name="berat"]').val(data.berat);
         $('#modalGejala').modal('show');
       }
     })
   }
   hapusGejala = id => {
    if(confirm("Apakah Anda Yakin Akan Menghapus Data Ini")){
        $.ajax({
        url : `gejala/hapusGejala/${id}`,
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
        url = 'gejala/tambahGejala'
        }else{
            url = 'gejala/updateGejala'
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modalGejala').modal('hide');
                    table.ajax.reload();
                }
            }
        })
   }
   $(document).ready(function(){
     table = $('#tabelGejala').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
         "url" : "<?php echo site_url('gejala/getAllData');?>",
         "type" : "POST"
       },
       "columnDefs": [{
         "targets": [ -1 ],
         "orderable" : false
       }]
     })
   })
</script>

