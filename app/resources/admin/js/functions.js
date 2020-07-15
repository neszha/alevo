function randomId()
{
	var x = Math.random().toString(36).replace(/[^a-zA-Z]+/g, '').substr(2, 10);	
	var y = Math.random().toString(36).replace(/[^a-zA-Z]+/g, '').substr(2, 10);	
	return x + y;
}

function toDom(htmlString)
{
	return $('<div>'+ htmlString +'</div>');
}

function setDataSiswaKeTabel(json)
{
	var p = $('#p-001');
	var forCheck = [];
	$.each(json, function(i, x)
	{
		var id = randomId();
		var data = {
			id: id,
			nisn: x.NISN,
		}
		forCheck.push(data);
		var t = $('#t-001').html();
		t = t.replace('@id', id);
		t = t.replace('@no', i+1);
		t = t.replace('@nisn', x.NISN);
		t = t.replace('@nama', x.NAMA);
		t = t.replace('@angkatan', x.ANGKATAN);
		t = t.replace('@status', x.STATUS);
		t = t.replace('@jurusan', x.JURUSAN);
		p.append(t);
		if (json.length == i+1)
		{
			setTimeout(function()
			{
				cekSemuaDataSiswa(forCheck);
			}, 500);
		}
	});
}

function cekSemuaDataSiswa(data)
{
	var url = baseUrl + '/admin-api/siswa/check-before-input';
	$.each(data, function(i, x)
	{
		$.post(url, x, function(res)
		{
			res = $.parseJSON(res);
			var p = $('tr[data-id="'+ res.id +'"]');
			var t = $('#t-002').html();
			if (res.result == true)
			{
				var t = $('#t-003').html();
				p.find('.check').attr('data-action', 'update');
			}
			p.find('.check').html(t);
			p.attr('data-insert', true);
		});
	});
}

function inputDataSiswa(tr)
{
	var x = $(tr);
	var data = {
		nisn: x.find('.nisn').text(),
		nama: x.find('.nama').text(),
		angkatan: x.find('.angkatan').text(),
		status: x.find('.status').text(),
		jurusan: x.find('.jurusan').text(),
		action: x.find('.check').attr('data-action'),
	}

	if (data.action == 'insert') 
	{
		var url = baseUrl + '/admin-api/siswa/main-insert';
		
		$.post(url, data, function(res) 
		{
			var res = $.parseJSON(res);

			if (res.result) 
			{
				var t = $('#t-004').html();
				x.find('.check').html(t);
			}
		});
	}
}

function getJsonFromXlsx(event)
{
	var selectedFile = event.target.files[0];
	var fileReader = new FileReader();
	var fileReader = new FileReader();
	fileReader.onload = function(event) 
	{
		var data = event.target.result;
		var workbook = XLSX.read(data, 
		{
			type: "binary"
		});
		workbook.SheetNames.forEach(sheet => 
		{
			let jsonXlsx = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
			$('#f-001').text(jsonXlsx.length);
			if (jsonXlsx.length > 0) 
			{
				$('.select-file').hide();
				$('.table-upload').show();
				setDataSiswaKeTabel(jsonXlsx);
			}else{

			}
		});
	};
	fileReader.readAsBinaryString(selectedFile);
}

function getDataSiswa(q = null, getAll = false)
{
	var mainBtn = $('#main-search');
	var x = $('#search-filter');
	var data = {
		type: x.find('input#type').val(),
		preview: x.find('input#preview').val(),
		limit: x.find('input#limit').val(),
	};

	if (getAll) 
	{
		var data = {
			preview: 'lengkap',
			get_all: true
		};
	}

	mainBtn.text('Loading...').removeClass('btn-primary');
	if(q != null) data.query_search = q;
	var p = $('#data-table-place');
	p.html($('#t_2').html());
	var url = baseUrl + '/admin-api/siswa/get-data?cache=' + randomId();
	$.post(url, data, function(res) 
	{
		var json = JSON.parse(res);
		setDataSiswaToTable(json, data.preview);
		$('.table-loading').remove();
		mainBtn.text('Search').addClass('btn-primary');
		window.location = '#result';
	});	
}

function getAllDataSiswa()
{
	getDataSiswa(null, true);
}

function setDataSiswaToTable(data, preview)
{
	data = setTableAction(data);

	var column = setTableColumns(preview);

	$('#data-siswa').bootstrapTable({
		pagination: true,
		search: true,
		exportDataType: 'all',

		columns: column,
		data: data

	});
}

function setTableColumns(preview)
{
	var columns = {
		default: [

		// Data main
		{field: 'no', title: 'No', align: 'center'},
		{field: 'siswa_akun', title: 'ID', align: 'center', visible: false},
		{field: 'nama', title: 'Nama',},
		{field: 'nisn', title: 'NISN',},
		{field: 'password', title: 'Password', visible: false},
		{field: 'jenis_kelamin', title: 'Jenis Kelamin',},
		{field: 'jurusan', title: 'Jurusan',},
		{field: 'angkatan', title: 'Angkatan', align: 'center'},
		{field: 'status', title: 'Status',},
		{field: 'data_status', title: 'Status Data', align: 'center',},
		{field: 'lengkap.presentase2', title: 'Lengkap',},

		// Data main tambahan
		{field: 'nik', title: 'NIK', visible: false},
		{field: 'no_kartu_keluarga', title: 'No. KK', visible: false},
		{field: 'ttl', title: 'TTL', visible: false},
		{field: 'no_akta_kelahiran', title: 'No. Akte', visible: false},
		{field: 'anak_ke', title: 'Anak Ke-', visible: false},
		{field: 'agama', title: 'Agama', visible: false},
		{field: 'kewarganegaraan', title: 'Kewarganegaraan', visible: false},
		{field: 'berkebutuhan_khusus', title: 'Berkebutuhan Khusus', visible: false},
		{field: 'alamat', title: 'Aalamat', visible: false},
		{field: 'rt', title: 'RT', visible: false},
		{field: 'rw', title: 'RW', visible: false},
		{field: 'desa', title: 'Desa', visible: false},
		{field: 'kecamatan', title: 'Kecamatan', visible: false},
		{field: 'kabupaten', title: 'Kabupaten', visible: false},
		{field: 'provinsi', title: 'Provinsi', visible: false},
		{field: 'kode_pos', title: 'Kode Pos', visible: false},
		{field: 'tempat_tinggal', title: 'Tempat Tinggal', visible: false},
		{field: 'transportasi', title: 'Transportasi', visible: false},

		// Data Kontak
		{field: 'tlp', title: 'No. HP', visible: false},
		{field: 'email', title: 'E-Mail', visible: false},

		// Data Periodik
		{field: 'tinggi_badan', title: 'Tinggi Badan', align: 'center', visible: false},
		{field: 'berat_badan', title: 'Berat Badan', align: 'center', visible: false},
		{field: 'lingkar_kepala', title: 'Lingkar Kepala', align: 'center', visible: false},
		{field: 'jarak_tinggal', title: 'Jarak Tempat Tinggal', align: 'center', visible: false},
		{field: 'waktu_tempuh', title: 'Waktu Tempuh', align: 'center', visible: false},
		{field: 'saudara_kandung', title: 'Saudara Kandung', align: 'center', visible: false},
		
		// Data Ayah
		{field: 'ayah_nama', title: 'Nama Ayah', visible: false},
		{field: 'ayah_nik', title: 'NIK Ayah', visible: false},
		{field: 'ayah_tahun_lahir', title: 'Tahun Lahir Ayah', align: 'center', visible: false},
		{field: 'ayah_pendidikan', title: 'Pendidikan Ayah', visible: false},
		{field: 'ayah_pekerjaan', title: 'Pekerjaan Ayah', visible: false},
		{field: 'ayah_penghasilan', title: 'Penghasilan Ayah', visible: false},
		{field: 'ayah_berkebutuhan_khusus', title: 'Ayah Berkebutuhan Khusus?', visible: false},

		// Data Ibu
		{field: 'ibu_nama', title: 'Nama Ibu', visible: false},
		{field: 'ibu_nik', title: 'NIK Ibu', visible: false},
		{field: 'ibu_tahun_lahir', title: 'Tahun Lahir Ibu', align: 'center', visible: false},
		{field: 'ibu_pendidikan', title: 'Pendidikan Ibu', visible: false},
		{field: 'ibu_pekerjaan', title: 'Pekerjaan Ibu', visible: false},
		{field: 'ibu_penghasilan', title: 'Penghasilan Ibu', visible: false},
		{field: 'ibu_berkebutuhan_khusus', title: 'Ibu Berkebutuhan Khusus?', visible: false},

		// Data Wali
		{field: 'wali_nama', title: 'Nama Wali', visible: false},
		{field: 'wali_nik', title: 'NIK Wali', visible: false},
		{field: 'wali_tahun_lahir', title: 'Tahun Lahir Wali', align: 'center', visible: false},
		{field: 'wali_pendidikan', title: 'Pendidikan Wali', visible: false},
		{field: 'wali_pekerjaan', title: 'Pekerjaan Wali', visible: false},
		{field: 'wali_penghasilan', title: 'Penghasilan Wali', visible: false},
		{field: 'wali_berkebutuhan_khusus', title: 'Wali Berkebutuhan Khusus?', visible: false},

		{field: 'action', title: 'Action', class: 'data-action', align: 'center',}
		
		],

		sederhana: [

		// Data main
		{field: 'no', title: 'No', align: 'center',},
		{field: 'siswa_akun', title: 'ID', align: 'center', visible: false},
		{field: 'nama', title: 'Nama',},
		{field: 'nisn', title: 'NISN',},
		{field: 'password', title: 'Password', visible: false},
		{field: 'jenis_kelamin', title: 'Jenis Kelamin',},
		{field: 'jurusan', title: 'Jurusan',},
		{field: 'angkatan', title: 'Angkatan', align: 'center',},
		{field: 'status', title: 'Status',},
		{field: 'data_status', title: 'Status Data', align: 'center',},
		{field: 'lengkap.presentase2', title: 'Lengkap', visible: false},

		// Data main tambahan
		{field: 'nik', title: 'NIK',},
		{field: 'no_kartu_keluarga', title: 'No. KK',},
		{field: 'ttl', title: 'TTL', visible: false},
		{field: 'no_akta_kelahiran', title: 'No. Akte', visible: false},
		{field: 'anak_ke', title: 'Anak Ke-', visible: false},
		{field: 'agama', title: 'Agama', visible: false},
		{field: 'kewarganegaraan', title: 'Kewarganegaraan', visible: false},
		{field: 'berkebutuhan_khusus', title: 'Berkebutuhan Khusus', visible: false},
		{field: 'alamat', title: 'Aalamat', visible: false},
		{field: 'rt', title: 'RT', visible: false},
		{field: 'rw', title: 'RW', visible: false},
		{field: 'desa', title: 'Desa', visible: false},
		{field: 'kecamatan', title: 'Kecamatan', visible: false},
		{field: 'kabupaten', title: 'Kabupaten', visible: false},
		{field: 'provinsi', title: 'Provinsi', visible: false},
		{field: 'kode_pos', title: 'Kode Pos', visible: false},
		{field: 'tempat_tinggal', title: 'Tempat Tinggal', visible: false},
		{field: 'transportasi', title: 'Transportasi', visible: false},

		// Data Kontak
		{field: 'tlp', title: 'No. HP',},
		{field: 'email', title: 'E-Mail',},

		// Data Periodik
		{field: 'tinggi_badan', title: 'Tinggi Badan', align: 'center', visible: false},
		{field: 'berat_badan', title: 'Berat Badan',align: 'center', visible: false},
		{field: 'lingkar_kepala', title: 'Lingkar Kepala',align: 'center', visible: false},
		{field: 'jarak_tinggal', title: 'Jarak Tempat Tinggal',align: 'center', visible: false},
		{field: 'waktu_tempuh', title: 'Waktu Tempuh',align: 'center', visible: false},
		{field: 'saudara_kandung', title: 'Saudara Kandung',align: 'center', visible: false},
		
		// Data Ayah
		{field: 'ayah_nama', title: 'Nama Ayah',},
		{field: 'ayah_nik', title: 'NIK Ayah', visible: false},
		{field: 'ayah_tahun_lahir', title: 'Tahun Lahir Ayah', align: 'center', visible: false},
		{field: 'ayah_pendidikan', title: 'Pendidikan Ayah', visible: false},
		{field: 'ayah_pekerjaan', title: 'Pekerjaan Ayah', visible: false},
		{field: 'ayah_penghasilan', title: 'Penghasilan Ayah', visible: false},
		{field: 'ayah_berkebutuhan_khusus', title: 'Ayah Berkebutuhan Khusus?', visible: false},

		// Data Ibu
		{field: 'ibu_nama', title: 'Nama Ibu',},
		{field: 'ibu_nik', title: 'NIK Ibu', visible: false},
		{field: 'ibu_tahun_lahir', title: 'Tahun Lahir Ibu', align: 'center', visible: false},
		{field: 'ibu_pendidikan', title: 'Pendidikan Ibu', visible: false},
		{field: 'ibu_pekerjaan', title: 'Pekerjaan Ibu', visible: false},
		{field: 'ibu_penghasilan', title: 'Penghasilan Ibu', visible: false},
		{field: 'ibu_berkebutuhan_khusus', title: 'Ibu Berkebutuhan Khusus?', visible: false},

		// Data Wali
		{field: 'wali_nama', title: 'Nama Wali', visible: false},
		{field: 'wali_nik', title: 'NIK Wali', visible: false},
		{field: 'wali_tahun_lahir', title: 'Tahun Lahir Wali', align: 'center', visible: false},
		{field: 'wali_pendidikan', title: 'Pendidikan Wali', visible: false},
		{field: 'wali_pekerjaan', title: 'Pekerjaan Wali', visible: false},
		{field: 'wali_penghasilan', title: 'Penghasilan Wali', visible: false},
		{field: 'wali_berkebutuhan_khusus', title: 'Wali Berkebutuhan Khusus?', visible: false},

		{field: 'action', title: 'Action', class: 'data-action'}
		
		],

		sedang: [

		// Data main
		{field: 'no', title: 'No', align: 'center',},
		{field: 'siswa_akun', title: 'ID', align: 'center', visible: false},
		{field: 'nama', title: 'Nama',},
		{field: 'nisn', title: 'NISN',},
		{field: 'password', title: 'Password', visible: false},
		{field: 'jenis_kelamin', title: 'Jenis Kelamin',},
		{field: 'jurusan', title: 'Jurusan',},
		{field: 'angkatan', title: 'Angkatan', align: 'center',},
		{field: 'status', title: 'Status',},
		{field: 'data_status', title: 'Status Data', align: 'center',},
		{field: 'lengkap.presentase2', title: 'Lengkap',},

		// Data main tambahan
		{field: 'nik', title: 'NIK',},
		{field: 'no_kartu_keluarga', title: 'No. KK',},
		{field: 'ttl', title: 'TTL', visible: false},
		{field: 'no_akta_kelahiran', title: 'No. Akte', visible: false},
		{field: 'anak_ke', title: 'Anak Ke-', visible: false},
		{field: 'agama', title: 'Agama', visible: false},
		{field: 'kewarganegaraan', title: 'Kewarganegaraan', visible: false},
		{field: 'berkebutuhan_khusus', title: 'Berkebutuhan Khusus', visible: false},
		{field: 'alamat', title: 'Aalamat',},
		{field: 'rt', title: 'RT', visible: false},
		{field: 'rw', title: 'RW', visible: false},
		{field: 'desa', title: 'Desa',},
		{field: 'kecamatan', title: 'Kecamatan',},
		{field: 'kabupaten', title: 'Kabupaten',},
		{field: 'provinsi', title: 'Provinsi', visible: false},
		{field: 'kode_pos', title: 'Kode Pos', visible: false},
		{field: 'tempat_tinggal', title: 'Tempat Tinggal', visible: false},
		{field: 'transportasi', title: 'Transportasi', visible: false},

		// Data Kontak
		{field: 'tlp', title: 'No. HP',},
		{field: 'email', title: 'E-Mail',},

		// Data Periodik
		{field: 'tinggi_badan', title: 'Tinggi Badan', align: 'center',},
		{field: 'berat_badan', title: 'Berat Badan', align: 'center',},
		{field: 'lingkar_kepala', title: 'Lingkar Kepala', align: 'center',},
		{field: 'jarak_tinggal', title: 'Jarak Tempat Tinggal', align: 'center',},
		{field: 'waktu_tempuh', title: 'Waktu Tempuh', align: 'center',},
		{field: 'saudara_kandung', title: 'Saudara Kandung', align: 'center',},
		
		// Data Ayah
		{field: 'ayah_nama', title: 'Nama Ayah',},
		{field: 'ayah_nik', title: 'NIK Ayah', visible: false},
		{field: 'ayah_tahun_lahir', title: 'Tahun Lahir Ayah', align: 'center', visible: false},
		{field: 'ayah_pendidikan', title: 'Pendidikan Ayah', visible: false},
		{field: 'ayah_pekerjaan', title: 'Pekerjaan Ayah',},
		{field: 'ayah_penghasilan', title: 'Penghasilan Ayah',},
		{field: 'ayah_berkebutuhan_khusus', title: 'Ayah Berkebutuhan Khusus?', visible: false},

		// Data Ibu
		{field: 'ibu_nama', title: 'Nama Ibu',},
		{field: 'ibu_nik', title: 'NIK Ibu', visible: false},
		{field: 'ibu_tahun_lahir', title: 'Tahun Lahir Ibu', align: 'center', visible: false},
		{field: 'ibu_pendidikan', title: 'Pendidikan Ibu', visible: false},
		{field: 'ibu_pekerjaan', title: 'Pekerjaan Ibu',},
		{field: 'ibu_penghasilan', title: 'Penghasilan Ibu',},
		{field: 'ibu_berkebutuhan_khusus', title: 'Ibu Berkebutuhan Khusus?', visible: false},

		// Data Wali
		{field: 'wali_nama', title: 'Nama Wali',},
		{field: 'wali_nik', title: 'NIK Wali', visible: false},
		{field: 'wali_tahun_lahir', title: 'Tahun Lahir Wali', align: 'center', visible: false},
		{field: 'wali_pendidikan', title: 'Pendidikan Wali', visible: false},
		{field: 'wali_pekerjaan', title: 'Pekerjaan Wali',},
		{field: 'wali_penghasilan', title: 'Penghasilan Wali',},
		{field: 'wali_berkebutuhan_khusus', title: 'Wali Berkebutuhan Khusus?', visible: false},

		{field: 'action', title: 'Action', class: 'data-action'}
		
		],

		lengkap: [

		// Data main
		{field: 'no', title: 'No', align: 'center',},
		{field: 'siswa_akun', title: 'ID', align: 'center',},
		{field: 'nama', title: 'Nama',},
		{field: 'nisn', title: 'NISN',},
		{field: 'password', title: 'Password',},
		{field: 'jenis_kelamin', title: 'Jenis Kelamin',},
		{field: 'jurusan', title: 'Jurusan',},
		{field: 'angkatan', title: 'Angkatan', align: 'center',},
		{field: 'status', title: 'Status',},
		{field: 'data_status', title: 'Status Data', align: 'center',},
		{field: 'lengkap.presentase2', title: 'Lengkap',},

		// Data main tambahan
		{field: 'nik', title: 'NIK',},
		{field: 'no_kartu_keluarga', title: 'No. KK',},
		{field: 'ttl', title: 'TTL',},
		{field: 'no_akta_kelahiran', title: 'No. Akte',},
		{field: 'anak_ke', title: 'Anak Ke-',},
		{field: 'agama', title: 'Agama',},
		{field: 'kewarganegaraan', title: 'Kewarganegaraan',},
		{field: 'berkebutuhan_khusus', title: 'Berkebutuhan Khusus',},
		{field: 'alamat', title: 'Aalamat',},
		{field: 'rt', title: 'RT',},
		{field: 'rw', title: 'RW',},
		{field: 'desa', title: 'Desa',},
		{field: 'kecamatan', title: 'Kecamatan',},
		{field: 'kabupaten', title: 'Kabupaten',},
		{field: 'provinsi', title: 'Provinsi',},
		{field: 'kode_pos', title: 'Kode Pos',},
		{field: 'tempat_tinggal', title: 'Tempat Tinggal',},
		{field: 'transportasi', title: 'Transportasi',},

		// Data Kontak
		{field: 'tlp', title: 'No. HP',},
		{field: 'email', title: 'E-Mail',},

		// Data Periodik
		{field: 'tinggi_badan', title: 'Tinggi Badan', align: 'center',},
		{field: 'berat_badan', title: 'Berat Badan', align: 'center',},
		{field: 'lingkar_kepala', title: 'Lingkar Kepala', align: 'center',},
		{field: 'jarak_tinggal', title: 'Jarak Tempat Tinggal', align: 'center',},
		{field: 'waktu_tempuh', title: 'Waktu Tempuh', align: 'center',},
		{field: 'saudara_kandung', title: 'Saudara Kandung', align: 'center',},
		
		// Data Ayah
		{field: 'ayah_nama', title: 'Nama Ayah',},
		{field: 'ayah_nik', title: 'NIK Ayah',},
		{field: 'ayah_tahun_lahir', title: 'Tahun Lahir Ayah', align: 'center',},
		{field: 'ayah_pendidikan', title: 'Pendidikan Ayah',},
		{field: 'ayah_pekerjaan', title: 'Pekerjaan Ayah',},
		{field: 'ayah_penghasilan', title: 'Penghasilan Ayah',},
		{field: 'ayah_berkebutuhan_khusus', title: 'Ayah Berkebutuhan Khusus?',},

		// Data Ibu
		{field: 'ibu_nama', title: 'Nama Ibu',},
		{field: 'ibu_nik', title: 'NIK Ibu',},
		{field: 'ibu_tahun_lahir', title: 'Tahun Lahir Ibu', align: 'center',},
		{field: 'ibu_pendidikan', title: 'Pendidikan Ibu',},
		{field: 'ibu_pekerjaan', title: 'Pekerjaan Ibu',},
		{field: 'ibu_penghasilan', title: 'Penghasilan Ibu',},
		{field: 'ibu_berkebutuhan_khusus', title: 'Ibu Berkebutuhan Khusus?',},

		// Data Wali
		{field: 'wali_nama', title: 'Nama Wali',},
		{field: 'wali_nik', title: 'NIK Wali',},
		{field: 'wali_tahun_lahir', title: 'Tahun Lahir Wali', align: 'center',},
		{field: 'wali_pendidikan', title: 'Pendidikan Wali',},
		{field: 'wali_pekerjaan', title: 'Pekerjaan Wali',},
		{field: 'wali_penghasilan', title: 'Penghasilan Wali',},
		{field: 'wali_berkebutuhan_khusus', title: 'Wali Berkebutuhan Khusus?',},

		{field: 'action', title: 'Action', class: 'data-action'}
		
		],
	};
	return columns[preview];
}

function setTableAction(data)
{
	var newData = [];
	var item = $('#t_1').html();

	$.each(data, function(i, x) 
	{
		x.siswa_akun = Number(x.siswa_akun);
		x.action = item.replace(/__id__/g, x.siswa_akun);

		var status_data = '<button class="btn btn-xs btn-custon-rounded-three btn-danger">Belum Lengkap</button>';
		if(x.data_status == 1) status_data = '<button class="btn btn-xs btn-custon-rounded-three btn-warning">Proses Verifikasi</button>';
		if(x.data_status == 2) status_data = '<button class="btn btn-xs btn-custon-rounded-three btn-primary">Terverifikasi</button>';

		x.data_status = status_data;

		x.ttl = x.tempat_lahir + ', ' + x.tanggal_lahir;
		newData.push(x);
	});

	return newData;
}

function deletePermanent(x)
{
	$(x).text('Loading...');
	var id = $(x).parents('tr').data('id');
	var url = baseUrl + '/admin-api/siswa/' + id + '/delete-permanent';
	$.post(url, null, function(res) 
	{
		$(x).parents('tr').remove();
	});
}

function dataRestore(x)
{
	$(x).text('Loading...');
	var id = $(x).parents('tr').data('id');
	var url = baseUrl + '/admin-api/siswa/' + id + '/data-restore';
	$.post(url, null, function(res) 
	{
		$(x).parents('tr').remove();
	});
}

function getDataSiswaVerifikasi()
{
	var url = "/admin-api/siswa/verifikasi/get-data";
	$.post(url, null, function(res) 
	{
		var json = JSON.parse(res);
		var placa = $('#p-1 tbody');
		placa.empty();
		if(!json.length)
		{
			var template = $('#t-2').html();
			placa.html(template);
			return;
		}else{
			$('.btn-for-all').show();
		}
		$.each(json, function(i, x)
		{
			var template = $('#t-1').html();
			template = template.replace('#nisn', x.nisn);
			template = template.replace('#nama', x.nama);
			template = template.replace('#jk', x.jenis_kelamin);
			template = template.replace('#jurusan', x.jurusan);
			template = template.replace(/#id/g, x.id);
			placa.append(template);
		});
	});
}