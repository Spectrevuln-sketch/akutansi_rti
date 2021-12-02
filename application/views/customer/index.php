<div class="main-panel">
  <div class="content">
    <div class="panel-header bg-primary-gradient">
      <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
          <div>
            <h2 class="text-white pb-2 fw-bold"><?= $title; ?></h2>
            <h5 class="text-white op-7 mb-2"><?= $title_page; ?></h5>
          </div>
          <!-- <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-secondary btn-round" id="add_customer_name">Add Customer</a>
          </div> -->
        </div>
      </div>
    </div>
    <div class="page-inner mt--5">
      <!-- Content --><?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <?= $this->session->flashdata('message'); ?>
      <div class="row">
        <div class="col-4">
          <div class="card-body bg-light" style="border-radius: 10px;">
            <table id="display" class="table" style="width: 100%; min-height:80%;">
              <thead class="thead-dark text-light">
                <tr>
                  <th scope="col">Customer</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="EditedInv">
                <?php
                foreach ($invoice as $inv) : ?>
                  <tr>
                    <td id="customer"><a href="<?= base_url('customer/filter_by_customer/') . $inv['cust_name']; ?>"><?= $inv['cust_name']; ?></a></td>
                    <td id="delete_cs">
                      <a href="#" class="modalDeleteInv" data-id="<?= $inv['id']; ?>"><i class="fa-fw fas fa-times" id="Icon_Btn_Show"></i></a>
                      <a href='' class='DelCust badge badge-danger' style='text-decoration:none' data-toggle='modal' data-target='#del_cust' data-id='<?= $inv['id']; ?>' hidden>Delete</a>
                      <button class='EditCust badge badge-warning' style='text-decoration:none' data-id='<?= $inv['id']; ?>' hidden>Edit</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- Data Tabels -->
            <script>
              $(function() {
                $('#display').DataTable({
                  fixedHeader: true,
                  body: true,
                  scrollY: "50vh",
                  scrollX: "30%",
                  scrollCollapse: true,
                  paging: false
                });
              });
            </script>
            <!-- End Data Tabels -->
            <!-- End Content -->
          </div>
        </div>
        <div class="col-8 form_edited" hidden>
          <div class="row">
            <div class="card-body bg-light" style="border-radius: 10px;">
              <div id="show_edited">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete -->
  <div class="modal fade" id="del_cust" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="delgbModalLabel">Delete</h3>
        </div>
        <form class="form-horizontal" method="post" action="<?= base_url('customer/getDelCust'); ?>">
          <div class="modal-body">
            <p>Are you sure want to delete? <b class="cust_modal"></b></p>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="inv_id">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Delete -->

  <!-- Modal Add new -->

  <!-- End Modal Add new -->




  <!-- Ajax Request -->
  <script>
    $(function() {
      /* Animate Button */
      $('.modalDeleteInv').on('click', function() {
        var parent = $('#EditedInv').parent().get(0)
        const id = $(this).data('id');
        $('i[id="Icon_Btn_Show"]').fadeOut(1000, function() {
          $('.DelCust').attr("hidden", false).fadeIn(800);
          $('.EditCust').attr("hidden", false).fadeIn(800);
        });
      });
      /* End Animate Button */

      /* Edit Show Form */
      $('.EditCust').on('click', function() {
        const id = $(this).data('id');
        $('.form_edited').attr('hidden', false);

        function FormCust(data) {
          $('#show_edited').html('<form action="<?= base_url('customer/UpdateCustomer'); ?>" method="POST" id="form_edit_customer"><div class="form-group"><label for="CustomerName">Change Customer Name</label><input type="text" class="form-control" id="customer_name" name="customer_name"><input type="text" class="form-control" id="cust_id" name="cust_id" hidden></div><button type="submit" class="btn btn-warning mt-3">Edited</button></form>');
        }

        /* Ajax Request Fill Values */
        $.ajax({
          url: "<?= base_url('customer/getRenderTable'); ?>",
          data: {
            id: id
          },
          dataType: "json",
          method: "post",
          success: function(data) {
            FormCust(data);
            $('form[id="form_edit_customer"]').before('<h3>Edit Customer</h3>')
            $('input[name=customer_name]').val(data[0].cust_name);
            $('input[name=cust_id]').val(data[0].id);
          }
        });
        /* End Ajax Request Fill Values */
      });
      /* End Edit Show Form*/
      /* Delete Modal */
      $('.DelCust').on('click', function() {
        const id = $(this).data('id');
        $.ajax({
          url: "<?= base_url('customer/getRenderTable'); ?>",
          data: {
            id: id
          },
          dataType: "json",
          method: "post",
          success: function(data) {
            $('input[name="inv_id"]').val(data[0].id);
            $('b[class="cust_modal"]').html(data[0].cust_name);
          }
        });
      });
      /* End Delete Modal */

    });
  </script>
  <!-- End Ajax Request -->