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

            <table id='table-pendaftarankonsultasi' class="datatable table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Pasien</th>
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
                            <h4 class="modal-title">Pendaftaran Konsul</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formpendaftarankonsultasi" method="post" action="<?=base_url('pendaftarankonsultasi') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tgl" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hari</label>
                                <input type="text" name="jadwalpraktek_id" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pasien</label>
                                <select name="pasien_id" class="form-control">
                                    <?php
                                        use App\Models\PasienModel;


                                        $r = (new PasienModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama']}</option>";
                                        }
                                    ?>
                                </select>
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

        
    $('form#formpendaftarankonsultasi').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pendaftarankonsultasi").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

        $('button#btn-menambahkan').on('click' , function(){
            $('form#formpendaftarankonsultasi').submit();

    });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formpendaftarankonsultasi').trigger('reset');
            $('input[name=_method]').val('');
    });

        $('table#table-pendaftarankonsultasi').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pendaftarankonsultasi/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl]').val(e.tgl);
                $('input[name=jadwalpraktek_id]').val(e.jadwalpraktek_id);
                $('input[name=pasien_id]').val(e.pasien_id);
                $('input[name=petugas_id').val(e.petugas_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
         });

            $('table#table-pendaftarankonsultasi').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/pendaftarankonsultasi`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pendaftarankonsultasi').DataTable().ajax.reload();
                });
                }
          });


        $('table#table-pendaftarankonsultasi').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pendaftarankonsultasi/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'tgl',},
                {data: 'jadwalpraktek_id', render:(data,type,row,meta)=>{
                    let map = {'1' : 'Minggu', '2': 'Senin', '3':'Selasa', '4':'Rabu', '5':'Kamis', '6':'Jumat', '7':'Sabtu'};
                    return `${map[row['hari']] ?? ''}`;
                }},
                {data: 'nama', render:(data,type,row,meta)=>{
                    return `${data} `;
                }},
                
                {data: 'nama_lengkap', render:(data,type,row,meta)=>{
                    return `${data} `;
                }},
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class= 'btn-light' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn-danger'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });
</script>