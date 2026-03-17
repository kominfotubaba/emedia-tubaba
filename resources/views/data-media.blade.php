@extends('panel_theme.master')
@section('content')
    <section class="data-perpers">
        <div class="content">
            <div class="logo d-flex justify-content-end pe-lg-4 pe-md-4 pe-3">
                <img class="img-fluid" src="/assets/img/pemda.svg" alt="" />
            </div>
            <div class="row mb-4 mt-2 mt-md-0 mt-lg-0">
                <div class="col-12 jud">Data Media</div>
                <div class="col-12 mt-2">
                    Informasi, Data dan Dokumen yang diinput/diunggah sesuai dengan aslinya dan dapat dipertanggungjawabkan
                    legalitasnya. Bilamana terdapat kesulitan dalam menginput/mengunggah informasi, data dan dokumen dapat
                    menghubungi Diskominfo Tubaba melalui email dengan alamat kominfo@tubaba.go.id
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Jenis Media</label>
                    <select id="filter_jenis_media" class="form-control">
                        <option value="siber">Media Siber</option>
                        <option value="cetak">Media Cetak</option>
                        <option value="elektronik">Media Elektronik</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Provinsi</label>
                    <select id="filter_provinsi" class="form-control">
                        <option value="">Semua Provinsi</option>
                        <option value="lampung">Lampung</option>
                        </select>
                </div>
                {{-- <div class="col-md-4">
                    <label class="form-label fw-bold">Tahun Pendataan</label>
                    <select id="filter_tahun_pengajuan" class="form-control">
                        <option value="">Semua Tahun</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        </select>
                </div> --}}
            </div>

            <div class="data mt-3 m-0 p-0">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            function loadData() {
                let jenisMedia = $('#filter_jenis_media').val();
                let provinsi = $('#filter_provinsi').val().toLowerCase(); 
                let tahunPengajuan = $('#filter_tahun_pengajuan').val(); // Ambil nilai tahun

                let dynamicColumns = [
                    {
                        'data': null,
                        'sortable': false,
                        'title': 'No',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    }
                ];

                // Setup Header Kolom
                if (jenisMedia === 'cetak') {
                    dynamicColumns.push(
                        { data: 'namaMedia', title: 'Nama Media' },
                        { data: 'namaMedia', title: 'Website Media' }, 
                        { data: 'tahunBerdiriMedia', title: 'Tahun Berdiri' },
                        { data: 'domisiliRedaksiMedia', title: 'Domisili Kantor Redaksi' },
                        { data: 'namaPercetakan', title: 'Perusahaan Percetakan' },
                        { data: 'alamatPercetakan', title: 'Alamat Perusahaan Percetakan' },
                        { data: 'emailPerusahaan', title: 'Email' },
                        { data: 'tlpnPerusahaan', title: 'Telepon' },
                        { data: 'jumlahOplahMediaCetakPerMinggu', title: 'Oplah cetak per minggu' }
                    );
                } else if (jenisMedia === 'elektronik') {
                    dynamicColumns.push(
                        { data: 'namaMedia', title: 'Nama Media' },
                        { data: 'namaMedia', title: 'Website Media' }, 
                        { data: 'tahunBerdiriMedia', title: 'Tahun Berdiri' },
                        { data: 'domisiliRedaksiMedia', title: 'Domisili Kantor Redaksi' },
                        { data: 'izinIpp', title: 'No IPP' },
                        { data: 'emailPerusahaan', title: 'Email' },
                        { data: 'tlpnPerusahaan', title: 'Telepon' },
                        { data: 'jangkauanSiarMediaElektronik', title: 'Jangkauan siar' }
                    );
                } else {
                    dynamicColumns.push(
                        { data: 'namaMedia', title: 'Nama Media' },
                        { data: 'tahunBerdiriMedia', title: 'Tahun Berdiri' },
                        { data: 'domisiliRedaksiMedia', title: 'Domisili Kantor Redaksi' },
                        { data: 'emailPerusahaan', title: 'Email' },
                        { data: 'tlpnPerusahaan', title: 'Telepon' },
                        { data: 'jumlahKontenBeritaAktif', title: 'Konten berita per tahun' }
                    );
                }

                // Hancurkan tabel jika sudah ada
                if ($.fn.DataTable.isDataTable('#myTable')) {
                    $('#myTable').DataTable().clear().destroy();
                    $('#myTable').empty(); 
                }

                $("#myTable").DataTable({
                    ordering: false,
                    processing: true,
                    serverSide: false, // Memfilter di frontend
                    destroy: true,
                    paging: true,
                    lengthMenu: [10, 20, 50, 100],
                    pageLength: 20,
                    buttons: ['copy', 'excel', 'csv', 'print'],
                    order: [
                        [0, "asc"]
                    ],
                    responsive: false,
                    ajax: {
                        url: '/data-all?param=media',
                        type: 'GET',
                        dataSrc: function (json) {
                            let filteredData = json.data.filter(function(item) {
                                let isJenisMatch = true;
                                let isProvMatch = true;
                                let isTahunMatch = true;

                                // 1. Cek Filter Jenis Media
                                if (jenisMedia) {
                                    isJenisMatch = item.jenis_media === jenisMedia;
                                }

                                // 2. Cek Filter Provinsi
                                if (provinsi) {
                                    let provDB = (item.alamat_provinsi || item.alamatProvPerusahaan || "").toLowerCase();
                                    isProvMatch = provDB.includes(provinsi);
                                }

                                // 3. Cek Filter Tahun Pengajuan
                                if (tahunPengajuan) {
                                    isTahunMatch = item.tahun_pengajuan == tahunPengajuan;
                                }

                                // Hanya kembalikan data yang cocok dengan ketiga filter
                                return isJenisMatch && isProvMatch && isTahunMatch;
                            });

                            return filteredData;
                        }
                    },
                    columns: dynamicColumns, 
                    sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let title = column.header().textContent;

                                if(title !== 'No') {
                                    let input = document.createElement('input');
                                    input.placeholder = title;
                                    column.header().replaceChildren(input);

                                    input.addEventListener('keypress', (e) => {
                                        if (e.keyCode == '13') {
                                            if (column.search() !== input.value) {
                                                column.search(input.value).draw();
                                            }
                                        }
                                    });
                                }
                            });

                        var data = $(this.api().columns(0).nodes()).each(function() {
                            $(this).attr('class', 'hasu');
                        });
                        $(this.api().columns().nodes()).each(function() {
                            $(this).css("text-wrap", "wrap");
                        });
                    }
                });
            }

            // Panggil untuk render tabel pertama kali
            loadData();

            // Panggil ulang ketika dropdown filter diubah (tambahkan #filter_tahun_pengajuan)
            $('#filter_jenis_media, #filter_provinsi, #filter_tahun_pengajuan').on('change', function() {
                loadData();
            });

        });
    </script>
@endpush