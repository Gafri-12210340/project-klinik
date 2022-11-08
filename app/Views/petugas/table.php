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
                            <th>Sandi</th>
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
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-kirim" >kirim</button>
                        </div>
                    </div>
                </div>
            </div>

<script>
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
        });

        $('table#table-petugas').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/petugas/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=email]').val(e.email);
                $('input[name=nama_lengkap]').val(e.nama_lengkap);
                $('input[name=sandi]').val(e.sandi);
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
                {data: 'sandi',},
            
             
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