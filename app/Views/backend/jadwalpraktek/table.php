<?=$this->extend('backend/template')?>

<?=$this->section('content')?>



            <div class="container">
                <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
                <table id='table-jadwalpraktek' class="datatable table table-bordered">
                    <thead>
                        <tr>
                
                            <th>No</th>
                            <th>Poli Dokter</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
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
                            <form id="formJadwalpraktek" method="post" action="<?=base_url('jadwalpraktek') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Poli Dokter</label>
                                <input type="text" name="polidokter_id" class="form-control">
                            </div>
                            <div class="mb-3">
                       
                    </div>
                            <div class="mb-3">
                                <label class="form-label">Hari</label>
                                <input type="text" name="hari" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="text" name="jam_mulai" class="form-control">
                            </div>
                            <div class="mb-3">

                            <div class="mb-3">
                                <label class="form-label">Jam Selesai</label>
                                <input type="text" name="jam_selesai" class="form-control">
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
        
        
        $('form#formJadwalpraktek').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
            
        },
        pasca:()=>{
            $('button#btn-kirim').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-jadwalpraktek").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-kirim').on('click' , function(){
            $('form#formJadwalpraktek').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formJadwalpraktek').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-jadwalpraktek').on('click', '.btn-success', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/jadwalpraktek/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=polidokter_id]').val(e.polidokter_id);
                $('input[name=hari]').val(e.hari);
                $('input[name=jam_mulai]').val(e.jam_mulai);
                $('input[name=jam_selesai]').val(e.jam_selesai);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-jadwalpraktek').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('serius hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/jadwalpraktek`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-jadwalpraktek').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-jadwalpraktek').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('jadwalpraktek/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'polidokter_id',},
                {data: 'hari',},
                {data: 'jam_mulai',},
                {data: 'jam_selesai',},
             
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