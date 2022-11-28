<?=$this->extend('backend/template')?>

<?=$this->section('content')?>



            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
                <table id='table-poli' class="datatable table table-bordered">
                    <thead>
                        <tr>
                
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Poli</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formPoli" method="post" action="<?=base_url('poli') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                       
                    </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control">
                            </div>
                            <div class="mb-3">
                        </form>
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
        
        
        $('form#formPoli').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
            
        },
        pasca:()=>{
            $('button#btn-kirim').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-poli").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-kirim').on('click' , function(){
            $('form#formPoli').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formPoli').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-poli').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/poli/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nama]').val(e.nama);
                $('input[name=deskripsi]').val(e.deskripsi);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-poli').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/poli`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-poli').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-poli').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('poli/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'nama',},
                
                {data: 'deskripsi',},
             
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