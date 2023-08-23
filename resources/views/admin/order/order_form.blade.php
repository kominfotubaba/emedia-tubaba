@extends('panel.master')
@section('content')
    <main>
        <section class="scroll-section" id="title">
            <div class="page-title-container">
                <h1 class="mb-0 pb-0 display-4">Input Pesanan</h1>
            </div>
        </section>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div>
            <section class="scroll-section" id="hover">
                <div class="card mb-5">
                    <div class="card-body">
                        <form id="formOrder" action="/order/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Pesanan</label>
                                <input type="text" class="form-control" name="tahun" id="tahun"
                                    value="{{ $tahun }}" readonly>
                                @error('tahun')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_pengajuan" class="form-label">Nama Media</label>
                                <select style="width: 100%" class="form-select" name="no_pengajuan" id="no_pengajuan">
                                    <option label="&nbsp;"></option>
                                    @foreach ($data_media as $dm)
                                        <option value="{{ $dm->pengajuan_no }}">{{ $dm->nama_media }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="id_user" id="id_user" readonly hidden>
                                <input type="text" class="form-control" name="nama_media" id="nama_media" readonly
                                    hidden>
                                <input type="text" class="form-control" name="email" id="email" readonly hidden>
                                @error('no_pengajuan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                    readonly>
                                @error('nama_perusahaan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_media" class="form-label">Jenis Media</label>
                                <input type="text" class="form-control" name="jenis_media" id="jenis_media" readonly>
                                @error('jenis_media')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="grade" class="form-label">Grade</label>
                                <input type="text" class="form-control" name="grade" id="grade" readonly>
                                @error('grade')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="paket" class="form-label">Paket</label>
                                <select style="width: 100%" class="form-select" name="paket" id="paket">
                                    <option id="dataPaket" label="&nbsp;"></option>
                                </select>
                                <input type="text" class="form-control" name="paket_klasifikasi" id="paket_klasifikasi"
                                    readonly hidden>
                                <input type="text" class="form-control" name="nama_paket" id="nama_paket" readonly
                                    hidden>
                                <input type="text" class="form-control" name="detail_paket" id="detail_paket" readonly
                                    hidden>
                                @error('paket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_paket" class="form-label">Jumlah Paket</label>
                                <input type="number" class="form-control" name="jumlah_paket" id="jumlah_paket">
                                @error('jumlah_paket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" readonly>
                                @error('harga')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total_harga_paket" class="form-label">Total Harga Paket</label>
                                <input type="text" class="form-control" name="total_harga_paket"
                                    id="total_harga_paket" readonly>
                                @error('total_harga_paket')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan">
                                @error('keterangan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button id="sending" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@push('script')
    <script>
        //

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#sending').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kirim Pesanan Ke PBJ',
                text: "Anda Yakin Akan Mengirim Pesanan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formOrder').submit();
                };
            })
        });

        $('#no_pengajuan').select2({
            placeholder: 'Masukan Nama Media'
        });

        $('#paket').select2({
            placeholder: 'Masukan Nama Paket',
            ajax: {
                // url: 'https://node-api.coloredstrategies.com/products',
                url: '/order/data_paket',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    var param = $('#jenis_media').val();
                    var grade = $('#grade').val();
                    return {
                        search: {
                            value: params.term
                        },
                        page: params.page,
                        param: param,
                        grade: grade
                    };
                },
                processResults: function(data, page) {
                    return {
                        results: data,
                    };
                },
                cache: true,
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            minimumInputLength: 0,
            templateResult: function formatResult(data) {
                if (data.loading) return data.text;
                var markup = '<div class="clearfix"><div>' + data.namaPaket + '</div>';
                if (data.detailPaket) {
                    markup += '<div class="text-muted">' + data.detailPaket + '</div>';
                }
                if (data.detailPaket) {
                    markup += '<div class="text-muted">Grade :' + data.grade + '</div>';
                }
                if (data.harga) {
                    markup += '<div class="text-muted">Harga :Rp ' + data.harga + '</div>';
                }
                return markup;
            },
            templateSelection: function formatResultSelection(data) {
                var selected = data.namaPaket;
                return selected;
            },
        });

        var nilai = IMask(
            document.getElementById('harga'), {
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.'
                    }
                }
            });

        var nilaiTotal = IMask(
            document.getElementById('total_harga_paket'), {
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.'
                    }
                }
            });

        $('#no_pengajuan').change(function(e) {
            e.preventDefault();
            var noPengajuan = $(this).val();
            // console.log(namaMedia);
            $.ajax({
                type: "GET",
                url: "/order/data_media",
                data: {
                    param: 'nama',
                    noPengajuan: noPengajuan
                },
                success: function(response) {
                    $('#nama_perusahaan').val(response.data.perusahaan);
                    $('#jenis_media').val(response.data.jenis);
                    $('#grade').val(response.data.nilai);
                    $('#nama_media').val(response.data.media);
                    $('#email').val(response.data.email);
                    $('#id_user').val(response.data.id_user);
                }
            });
        });

        $('#no_pengajuan').on('select2:select', function(e) {
            var data = e.params.data;
            $('#pengajuan_no').val(data.id)
        });

        $('#paket').on('select2:select', function(e) {
            var data = e.params.data;
            let harga = data.harga;
            nilai.updateOptions({
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.'
                    }
                }
            });
            nilai.typedValue = harga.toString();
            $('#nama_paket').val(data.namaPaket)
            $('#detail_paket').val(data.detailPaket)
            $('#paket_klasifikasi').val(data.paketKlasifikasi)
        });

        $('#jumlah_paket').keyup(function(e) {
            e.preventDefault();
            var jumlahPaket = $(this).val();
            var harga = $('#harga').val();
            var hargaReplace = harga.replaceAll('.', '');
            var harga_total = jumlahPaket * hargaReplace;
            nilaiTotal.updateOptions({
                mask: 'num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.',
                        normalizeZeros: true,
                    }
                }
            });
            nilaiTotal.typedValue = harga_total.toString();
        });
    </script>
@endpush
