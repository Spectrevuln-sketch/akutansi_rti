<div class="main-panel">
  <div class="content">
    <div class="panel-header bg-primary-gradient">
      <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
          <div>
            <h2 class="text-white pb-2 fw-bold text-uppercase"><?= urldecode($title_page); ?></h2>
            <h5 class="text-white op-7 mb-2"><?= $title; ?></h5>
          </div>
          <div class="ml-md-auto py-2 py-md-0">
            <a href="" class="btn btn-secondary btn-round modalAdd" data-toggle="modal" data-target="#edit_inv">Add New</a>
          </div>
        </div>
      </div>
    </div>








    <div class="page-inner mt--5">
      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <?= $this->session->flashdata('message'); ?>
      <!-- Content -->
      <div class="row">
        <div class="col-lg">
          <div class="card-body bg-light" style="border-radius: 10px;">
            <table id="display" class="table table-dark table-bordered table-striped" style="width: 200%; min-height:80%;">
              <thead class="thead-dark text-light table-striped table-bordered">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Agen</th>
                  <th scope="col">No.invoice</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Selling</th>
                  <th scope="col">PPN</th>
                  <th scope="col">Buying</th>
                  <th scope="col">Disc. Customer</th>
                  <th scope="col">Disc. Marketing</th>
                  <th scope="col">Margin</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="EditedInv">
                <?php
                $pageCustomer = "/[^A-Za-z]\w+/";
                $query = $this->db->get_where('invoice', ['customer' => urldecode($this->uri->segment(3))])->result_array();
                ?>
                <?php
                $i = 1;
                foreach ($query as $inv) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td id="tanggal"><?= date('d - M - Y', $inv['created_at']); ?></td>
                    <td id="agen"><?= $inv['agen']; ?></td>
                    <td id="noInv"><?= $inv['no_invoice']; ?></td>
                    <td id="keterangan"><?= $inv['keterangan']; ?></td>
                    <td id="selling"><?= rupiah($inv['selling']); ?></td>
                    <td id="ppn"><?= $inv['ppn']; ?></td>
                    <td id="buying"><?= rupiah($inv['buying']); ?></td>
                    <td id="diskonCustomer"><?= $inv['diskon_customer']; ?></td>
                    <td id="diskonMarketing"><?= $inv['diskon_marketing']; ?></td>
                    <td id="margin"><?= rupiah($inv['margin']); ?></td>
                    <td>
                      <a href="" class="badge badge-warning my-2 modalEditInv" data-toggle="modal" data-target="#edit_inv" data-id="<?= $inv['id']; ?>">Edit</a>
                      <a href="" class="badge badge-danger my-2" data-toggle="modal" data-target="#del_inv<?= $inv['id']; ?>" data-id="<?= $inv['id']; ?>">Delete</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="del_inv<?= $inv['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="delgbModalLabel">Delete</h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?= base_url('user/getDel'); ?>">
                          <div class="modal-body">
                            <p>Are you sure want to delete? <b><?= $inv['customer']; ?></b></p>
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="inv_id" value="<?= $inv['id']; ?>">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button class="btn btn-danger">Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </tbody>
            </table>

            <script>
              $(function() {
                $('#display').DataTable({
                  fixedHeader: true,
                  body: true,
                  scrollY: "50vh",
                  scrollX: true,
                  scrollCollapse: true,
                  paging: true
                });
              });
            </script>
          </div>
        </div>
      </div>

      <!-- End Content -->

    </div>
  </div>


  <!-- //============================ modal Edit data =============================== -->
  <!-- Modal Input -->
  <div class="modal fade bd-Input-modal-lg" id="edit_inv" tabindex="-1" role="dialog" aria-labelledby="edit_inv_Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_inv_Label">Add New Input</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body col-sm">
          <form method="post">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="customer">Customer</label>
                <input type="hidden" class="form-control" id="inv_id" name="inv_id">
                <input type="text" class="form-control" id="customer" name="customer">
                <?= form_error('customer', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="agen">Agen</label>
                <input type="text" class="form-control" id="agen" name="agen">
                <?= form_error('agen', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="selling">Selling</label>
                <input type="text" class="form-control" id="selling" name="selling">
              </div>
              <div class="form-group col-md-6">
                <label for="ppn">PPN</label>
                <input type="text" class="form-control" id="ppn" name="ppn">
              </div>
              <div class="form-group col-md-6">
                <label for="buying">Buying</label>
                <input type="text" class="form-control" id="buying" name="buying">
              </div>
              <div class="form-group col-md-6">
                <label for="diskon_customer">Disc.Cust</label>
                <input type="text" class="form-control" id="diskon_customer" name="diskon_customer">
              </div>
            </div>
            <div class="form-group">
              <label for="diskon_marketing">Disc.Mark</label>
              <input type="text" class="form-control" id="diskon_marketing" name="diskon_marketing">
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="form-group">
              <label for="margin">Margin</label>
              <input type="text" class="form-control" id="margin" name="margin">
            </div>
            <div class="form-group">
              <label for="no_invoice">No. Invoice</label>
              <input type="text" class="form-control" id="no_invoice" name="no_invoice">
              <?= form_error('no_invoice', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="modal-footer edit-button">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- //============================ End modal Edit data =============================== -->








  <!-- ajax edit req data -->
  <script>
    $(function() {

      /* Edit Custom Modal */
      $('.modalEditInv').click(function() {
        $('#edit_inv_Label').html("Edit Data");
        $('.edit-button button[type=submit]').addClass("btn btn-warning");
        $('.edit-button button[type=submit]').html("Edit Now");
        $('.modal-body form').attr('action', '<?= base_url('user/updateInvoice'); ?>');
        var id = $(this).data('id');
        $.ajax({
          url: "<?= base_url('user/getEdit'); ?>",
          data: {
            id: id
          },
          method: "post",
          dataType: "json",
          success: function(data) {
            $('input[name=inv_id]').val(data[0].id);
            $('input[name=customer]').val(data[0].customer);
            $('input[name=agen]').val(data[0].agen);
            $('input[name=selling]').val(data[0].selling);
            $('input[name=ppn]').val(data[0].ppn);
            $('input[name=buying]').val(data[0].buying);
            $('input[name=diskon_customer]').val(data[0].diskon_customer);
            $('input[name=diskon_marketing]').val(data[0].diskon_marketing);
            $('input[name=keterangan]').val(data[0].keterangan);
            $('input[name=margin]').val(data[0].margin);
            $('input[name=no_invoice]').val(data[0].no_invoice);
          }
        })
      });

      /* Add New Inv Custom Modal */
      $('.modalAdd').click(function() {
        $('#edit_inv_Label').html("Tambah Data Baru");
        $('.edit-button button[type=submit]').addClass("btn btn-primary");
        $('.edit-button button[type=submit]').html("Add Now");
        $('.modal-body form').attr('action', '<?= base_url('user/post_add_inv'); ?>');
        $('input[name=inv_id]').val();
        $('input[name=customer]').val();
        $('input[name=agen]').val();
        $('input[name=selling]').val();
        $('input[name=ppn]').val();
        $('input[name=buying]').val();
        $('input[name=diskon_customer]').val();
        $('input[name=diskon_marketing]').val();
        $('input[name=keterangan]').val();
        $('input[name=margin]').val();
        $('input[name=no_invoice]').val();
      });




    });
  </script>
  <!-- End ajax edit req data -->