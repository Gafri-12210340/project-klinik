<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

                <form method="post" action="<?=url_to('login')?>">
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
                <table id='table-pasien' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Rekam Medik</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>No TLP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Pasien</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formpasien" method="post" action="<?=base_url('pasien') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No Rekammedik</label>
                                <input type="text" name="no_rekammedik" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control">
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
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
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
                                <label class="form-label">No TLP</label>
                                <input type="text" name="no_telp" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        
                            <div class="mb-3">
                        <label class="form-label">Golongan Darah</label>
                        <select name="golongan_darah" class="form-control">
                            <option>Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                                <label class="form-label">Sandi</label>
                                <input type="text" name="sandi" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Token Reset</label>
                                <input type="text" name="token_reset" class="form-control">
                            </div>
                            
                            <div class="mb-3" id="fileberkas"></div>

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

            <script src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>

function buatDropify(filename = ''){
        $('div#fileberkas').html(`
            <input type="file" name="berkas" data-default-file="${filename}" />
        `);
        $('input[name=berkas]').dropify();
    }
    $(document).ready(function(){
        
        
        $('form#formpasien').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
            
        },
        pasca:()=>{
            $('button#btn-kirim').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pasien").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-kirim').on('click' , function(){
            $('form#formpasien').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formpasien').trigger('reset');
            $('input[name=_method]').val('');
            buatDropify('');
        });

        $('table#table-pasien').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pasien/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama]').val(e.nama);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('input[name=no_rekammedik]').val(e.no_rekammedik);
                $('input[name=nik]').val(e.nik);
                $('input[name=jenis_kelamin]').val(e.jenis_kelamin);
                $('input[name=tgl_lahir]').val(e.tgl_lahir);
                $('input[name=tempat_lahir]').val(e.tempat_lahir);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=no_telp]').val(e.no_telp);
                $('input[name=email]').val(e.email);
                $('input[name=golongan_darah]').val(e.golongan_darah);
                $('input[name=sandi]').val(e.sandi);
                $('input[name=token_reset]').val(e.token_reset);
                buatDropify(e.berkas);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-pasien').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/pasien`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pasien').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-pasien').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pasien/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'nama',},
                {data: 'no_rekammedik',},
                {data: 'nik',},
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
                {data: 'tgl_lahir',},
                {data: 'alamat',},
                {data: 'kota',},
                {data: 'no_telp',},
                
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