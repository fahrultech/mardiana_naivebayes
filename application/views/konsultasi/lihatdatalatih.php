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
                <h3 style="margin-bottom:20px">Tipe Kecanduan <?php echo $tipe;?></h3>
                <table class="table table-bordered table-striped table-condensed" id="tabelLihatDataLatih">
                  <thead>
                   <tr>
                    <th width="80px">No</th>
                    <th>Gejala</th>
                    <th>Bobot Jawaban</th>
                   </tr>
                  </thead>
                  <tbody>
                     <?php
                         foreach($datatabel as $dt){
                           ?>
                           <tr>
                             <td><?php echo $dt[0]; ?></td>
                             <td><?php echo $dt[1]; ?></td>
                             <td><?php echo $dt[2]; ?></td>
                           </tr><?php
                         }
                     ?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
<?php $this->load->view('footer'); ?>
<script>
    let table;
    $(document).ready(function(){
     table = $('#tabelLihatDataLatih').DataTable();
   })
</script>