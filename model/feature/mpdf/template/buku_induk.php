  <head>
    <style>
      body {
        background: #cccccc;
      }

      page[size="A4"] {
        background: white;
        width: 21cm;
        height: 29.7cm;
        display: block;
        margin: 0 auto;
        padding: 0.5cm;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
      }

      @media print {
        body, page[size="A4"] {
          margin: 0;
          box-shadow: 0;
        }
      }
    </style>
  </head>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/model/feature/mpdf/mpdf.php";
	include_once "model/class/master.php";

	$kelasx= new Kelas($kelas,$subkelas);
	$daftar_siswa= $kelasx->getSiswa();
  	$jumlah_siswa= sizeof($daftar_siswa);
  	$jumlah_siswa=32;
  	$jumlah_L= $kelasx->getBanyakSiswaL();
  	$jumlah_P= $kelasx->getBanyakSiswaP();
  	$nip_wali= $kelasx->getWaliKelasNIP();
  	$guru = new Guru($nip_wali);
  	$nama_wali = $guru->getNama();
  	//$nama_wali = strtoupper($nama_wali);
  	$daftar_siswa= json_decode(json_encode($daftar_siswa),true);


	$mpdf=new mPDF('win-1252','A4',0,'','5','5','10','3','',''); 
	$mpdf->useOnlyCoreFonts = true;
	$mpdf->useSubstitutions=false;
	$mpdf->simpleTables = true;


	if($kelas==""){
		echo '<page size="A4"><p style="text-align:center">Masukan data Kelas dan Sub Kelas terlebih dahulu</p></page>';

	}else{
		if($jumlah_siswa==0){
			echo '<page size="A4"><p style="text-align:center">Data siswa belum dimasukan</p></page>';
			if($_GET['download']=="1"){
				$mpdf->WriteHTML('Data siswa belum dimasukan');
				$mpdf->Output('Absensi '.$kelas.$subkelas.'.pdf','D');
			}
		}else{
			$html= array();
			for ($i=0; $i < $jumlah_siswa; $i++) { 
				$html[$i]='';
				$html[$i].= '
				    <table style="width:100%" >
				        <tr>
				            <td style="width:12%;text-align:right">
				                <img height="90px" src="assets/img/logo-pemkot.jpg">
				            </td>
				            <td style="width:*;text-align:center">
				                <strong><font size="3">PEMERINTAH KOTA SEMARANG<br>DINAS PENDIDIKAN</font><br><font size="5">SMP NEGERI 1 SEMARANG</font></strong><br>
				                <font size="2">Jl. Ronggolawe, Tlp.(024)7606340 fax.(024)7624850, Semarang 50149</font>
				            </td>
				            <td style="width:12%;text-align:left;">
				                <img height="90px" src="assets/img/logo-smp1.png">
				            </td>
				        </tr>
				    </table>
				    <hr style="height:2px;border:none;color:#333;background-color:#333;">
				    <h5 style="text-align:center">DATA SISWA</h5>
				    ';
				$html[$i].='
					<table style="width:90%;border-collapse:collapse;font-size:80%" align="center" >
						<tr>
							<td style="width:25%">NIS</td><td style="width:1%">:</td><td style="width:55%">xxxxxxxxxx</td><td rowspan="7" style="width:19%"><img src="assets/img/pas-foto.jpg" style="height:4cm;width:3cm"></td>
						</tr>
						<tr>
							<td>NISN</td><td valign="top">:</td><td>xxxxxxxxxx</td>
						</tr>
						<tr>
							<td>Nama Lengkap</td><td valign="top">:</td><td>Paijo bin Subekti</td>
						</tr>
						<tr>
							<td>Nama Panggilan</td><td valign="top">:</td><td>Paijo</td>
						</tr>	
						<tr>
							<td>Tempat, Tanggal Lahir</td><td valign="top">:</td><td>Semarang, 30 Februari 1999</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td><td valign="top">:</td><td>Laki-Laki</td>
						</tr>
						<tr>
							<td>Anak ke</td><td valign="top">:</td><td>1</td>
						</tr>		
						<tr>
							<td>Jumlah Saudara kandung</td><td valign="top">:</td><td>2</td>
						</tr>																
						<tr>
							<td valign="top">Alamat Rumah</td><td valign="top">:</td><td>Jalan Elang Raya No 90, Bojong, Semarang 50189 Jalan Elang Raya No 90, Bojong, Semarang 50189 </td>
						</tr>
						<tr>
							<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kota/Kab: Semarang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RT :06 / RW :03&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K.Pos: 50181</td>
						</tr>							
						<tr>
							<td>Telepon/HP</td><td valign="top">:</td><td>085678952456 / 02476584235</td>
						</tr>
						<tr>
							<td>Asal Sekolah</td><td valign="top">:</td><td>SD Karang Miring 5</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>		
						<tr>
							<td><b>DATA ORANG TUA</b></td>
						</tr>	
						<tr>
							<td>Nama Ayah</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pendidikan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pekerjaan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Nomor Telepon</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>						
						<tr>
							<td>&nbsp;</td>
						</tr>			
						<tr>
							<td>Nama Ibu</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pendidikan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pekerjaan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Nomor Telepon</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>						
						<tr>
							<td>&nbsp;</td>
						</tr>	
						<tr>
							<td><b>DATA WALI (BILA ADA)</b></td>
						</tr>																											
						<tr>
							<td>Nama Wali</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Tempat, Tanggal Lahir</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pendidikan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Pekerjaan</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>
						<tr>
							<td>Nomor Telepon</td><td valign="top">:</td><td>[iki opo]</td>
						</tr>						
						<tr>
							<td>&nbsp;</td>
						</tr>							
					</table>
				';	
			}

			$htmlx='';
			for ($i=0; $i < $jumlah_siswa; $i++) { 
				$htmlx.=$html[$i].'<pagebreak />';
			}

			if($_GET['download']=="1"){
				//Buat pdf jika isinya tidak kosong
				if(($htmlx!=null)||($htmlx!="")){
					$mpdf->WriteHTML($htmlx);
					$mpdf->Output('Buku Induk Kelas '.$kelas.$subkelas.'.pdf','D');
				}
			}

			for ($i=0; $i < $jumlah_siswa; $i++) { 
				echo '<page size="A4">'.$html[$i].'</page>';
			}


		}
	}

	exit;

?>