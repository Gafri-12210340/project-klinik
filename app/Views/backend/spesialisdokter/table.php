<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
                <table id='table-spesialisdokter' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kota</th>
                            <th>Nama Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Spesialis Dokter</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formSpesialisdokter" method="post" action="<?=base_url('spesialisdokter') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <select name="dokter_id" class="form-control">
                                    <?php

                                        use App\Models\DokterModel;


                                        $r = (new DokterModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['kota']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                          
                            <div class="mb-3">
                                <label class="form-label">Nama Dokter</label>
                                <select name="spesialis_id" class="form-control">
                                    <?php
            
                                         use App\Models\SpesialisModel;

                                        $r = (new SpesialisModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama']}</option>";
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

            <?=$this->endSection()?>

            <?=$this->section('script')?>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>
            <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
            <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        
        
        $('form#formSpesialisdokter').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-spesialisdokter").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formSpesialisdokter').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formSpesialisdokter').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-spesialisdokter').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/spesialisdokter/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=dokter_id]').val(e.dokter_id);
                $('input[name=spesialis_id]').val(e.spesialis_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-spesialisdokter').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/spesialisdokter`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-spesialisdokter').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-spesialisdokter').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('spesialisdokter/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'kota', render:(data,type,row,meta)=>{
                    return `${data}`;
                }},

                {data: 'nama', render:(data,type,row,meta)=>{
                    return `${data}`;
                }},

                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='btn btn-success' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });
</script>

<?=$this->endSection()?>