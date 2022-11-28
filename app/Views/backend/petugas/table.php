<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

                <form method="post" action="<?=url_to('login')?>">
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
                <table id='table-petugas' class="datatable table table-bordered">
                    <thead>
                        <tr>
                
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Petugas</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formpetugas" method="post" action="<?=base_url('petugas') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sandi</label>
                                <input type="text" name="sandi" class="form-control">
                            </div>
                   <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-control">
                            <option value="K">KASIR</option>
                            <option value="M">MANAGER</option>
                        </select>
                    </div>

                    <div class="mb-3">
                                <label class="form-label">Reset Token</label>
                                <input type="text" name="reset_token" class="form-control">
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
        
        
        $('form#formpetugas').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
            
        },
        pasca:()=>{
            $('button#btn-kirim').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-petugas").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-kirim').on('click' , function(){
            $('form#formpetugas').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formpetugas').trigger('reset');
            $('input[name=_method]').val('');
            buatDropify('');
        });

        $('table#table-petugas').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/petugas/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=email]').val(e.email);
                $('input[name=nama_lengkap]').val(e.nama_lengkap);
                $('input[name=sandi]').val(e.sandi);
                $('input[name=level]').val(e.level);
                $('input[name=reset_token]').val(e.reset_token);
                buatDropify(e.berkas);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-petugas').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/petugas`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-petugas').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-petugas').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('petugas/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'email',},
                {data: 'nama_lengkap',},
                { data: 'level',
                  render: (data, type, meta, row)=>{
                     if( data === 'K'){
                        return 'KASIR';
                     }else if( data === 'M' ){
                        return 'MANAGER';
                     }
                     return data;
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