<?php
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
	
	function tgl_eng($tgl){
		$number = substr($tgl,8,2);
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($number %100) >= 11 && ($number%100) <= 13)
			$tanggal = $number. 'th';
		else
			//$abbreviation = $number. $ends[$number % 10];
			$tanggal = $number. $ends[$number % 10];
			
			//$tanggal = substr($tgl,8,2);
			$bulan = getMonth(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $bulan.' '.$tanggal.', '.$tahun;		 
	}	

	function getMonth($bln){
				switch ($bln){
					case 1: 
						return "January";
						break;
					case 2:
						return "February";
						break;
					case 3:
						return "March";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "May";
						break;
					case 6:
						return "June";
						break;
					case 7:
						return "July";
						break;
					case 8:
						return "August";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "October";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "December";
						break;
				}
			}

	function hariday($lang, $hari){
		if($lang == 'id' ) {
			if ( $hari == 'Senin' ) { return "Senin"; } else
			if ( $hari == 'Selasa' ) { return "Selasa"; } else
			if ( $hari == 'Rabu' ) { return "Rabu"; } else
			if ( $hari == 'Kamis' ) { return "Kamis"; } else
			if ( $hari == 'Jumat' ) { return "Jumat"; } else
			if ( $hari == 'Sabtu' ) { return "Sabtu"; } else
			if ( $hari == 'Minggu' ) { return "Minggu"; } 
		} else {
			if ( $hari == 'Senin' ) { return "Monday"; } else
			if ( $hari == 'Selasa' ) { return "Tuesday"; } else
			if ( $hari == 'Rabu' ) { return "Wednesday"; } else
			if ( $hari == 'Kamis' ) { return "Thursday"; } else
			if ( $hari == 'Jumat' ) { return "Friday"; } else
			if ( $hari == 'Sabtu' ) { return "Saturday"; } else
			if ( $hari == 'Minggu' ) { return "Sunday"; } 
		}
	}
?>


