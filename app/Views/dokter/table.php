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

                <form method="POST" action="<?=url_to('login')?>">
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-sm btn-danger">Logout</button>
                </form>
                <table id='table-dokter' class="datatable table table-bordered">
                    <thead>
                        <tr>
                
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
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
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama_depan" class="form-control">
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
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-kirim" >kirim</button>
                        </div>
                    </div>
                </div>
            </div>

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

        $('table#table-dokter').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/dokter/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('select[name=jenis_kelamin]').val(e.jenis_kelamin);
                $('input[name=email]').val(e.email);
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
                {data: 'email',},
             
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