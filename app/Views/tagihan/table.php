<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" crosorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>
            <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
            <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
                <table id='table-tagihan' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Subtotal</th>
                            <th>PPN</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tagihan</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTagihan" method="post" action="<?=base_url('tagihan') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tgl" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subtotal</label>
                                <input type="text" name="subtotal" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PPN</label>
                                <input type="text" name="ppn" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Petugas</label>
                                <select name="petugas_id" class="form-control">
                                    <?php
                                        use App\Models\PetugasModel;


                                        $r = (new PetugasModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_lengkap']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-menambahkan" >Menambahkan</button>
                        </div>
                    </div>
                </div>
            </div>

<script>
    $(document).ready(function(){
        
        
        $('form#formTagihan').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-tagihan").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formTagihan').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formTagihan').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-tagihan').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/tagihan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl]').val(e.tgl);
                $('input[name=subtotal]').val(e.subtotal);
                $('input[name=ppn]').val(e.ppn);
                $('input[name=petugas_id]').val(e.petugas_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-tagihan').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/tagihan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-tagihan').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-tagihan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('tagihan/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'tgl',},
                {data: 'subtotal',},
                {data: 'ppn',},
                {data: 'nama_lengkap', render:(data,type,row,meta)=>{
                    return `${data}`;
                }},
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='btn btn-light' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });
</script>