<?=$this->extend('backend/template')?>

<?=$this->section('content')?>
        

            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

                
                <table id='table-dokter' class="datatable table table-bordered">
                    <thead>
                        <tr>
                
                            <th>No</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Gelar</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Dokter</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formDokter" method="post" action="<?=base_url('dokter') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gelar</label>
                                <input type="text" name="gelar_depan" class="form-control">
                            </div>
                
                            <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Telp Rumah</label>
                                <input type="text" name="no_telp_rmh" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No WA</label>
                                <input type="text" name="no_wa" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sandi</label>
                                <input type="text" name="sandi" class="form-control">
                            </div>
                    
                            <div class="mb-3">
                                <label class="form-label">No Izin Praktek</label>
                                <input type="text" name="no_izin_praktek" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Sk Izin </label>
                                <input type="date" name="tgl_sk_izin" class="form-control">
                            </div>
                          
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-kirim" >kirim</button>
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
        
        
        $('form#formDokter').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
            
        },
        pasca:()=>{
            $('button#btn-kirim').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-dokter").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-kirim').on('click' , function(){
            $('form#formDokter').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formDokter').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-dokter').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/dokter/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('input[name=gelar_depan]').val(e.gelar_depan);
                $('select[name=jenis_kelamin]').val(e.jenis_kelamin);
                $('input[name=tempat_lahir]').val(e.tempat_lahir);
                $('input[name=tgl_lahir]').val(e.tgl_lahir);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=no_telp_rmh]').val(e.no_telp_rmh);
                $('input[name=no_hp]').val(e.no_hp);
                $('input[name=no_wa]').val(e.no_wa);
                $('input[name=email]').val(e.email);
                $('input[name=sandi]').val(e.sandi);
                $('input[name=no_izin_praktek]').val(e.no_izin_praktek);
                $('input[name=tgl_sk_izin]').val(e.tgl_sk_izin);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-dokter').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/dokter`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-dokter').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-dokter').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('dokter/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'nama_depan',},
                {data: 'nama_belakang',},
                {data: 'gelar_depan',},
                { data: 'jenis_kelamin',
                  render: (data, type, meta, row)=>{
                     if( data === 'L'){
                        return 'Laki-Laki';
                     }else if( data === 'P' ){
                        return 'Perempuan';
                     }
                     return data;
                  }
                },
                {data: 'tempat_lahir',},
                {data: 'tgl_lahir',},
                {data: 'alamat',},
                {data: 'kota',},
               
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