<?php
include('lib/gen.php');
include('lib/dor.php');
$username ="1";
$pass ="1";

system('clear');
echo "login dulu mas\n";
echo "username :";
$user = trim(fgets(STDIN));
echo "password :";
$passx = trim(fgets(STDIN));
if ( $user == $username && $passx == $pass)
{
	system('clear');
	echo "login berhasil \n";
	home();


	//echo " [1]. tembak (nomer baru!)\n";
	//echo " [2]. claim\n";





} else {
	echo "login gagal!\n";

	};





function home() {
	system('clear');
	echo " [1]. tembak (nomer baru!)\n";
	echo " [2]. claim\n";
	echo " [3]. cek nomor\n";
	echo " [4]. NIK & KK\n";
	echo " [x]. exit\n\n";
	echo " [+] masukan piilihan kamu : ";




	$pilih = trim(fgets(STDIN));
	if ( $pilih == "1" )
	  {

		tembak();
		} else {
			if ( $pilih == "4" )
	  {

		      NIKKK();
		} else {
			if ( $pilih == "3" ) {
				ceker();
			}
		}


			}
	};

function tembak() {
	system('clear');
	echo " [1]. jabodetabek\n";
	echo " [2]. Medan\n";
	echo " [3]. Surabaya\n";
	echo " [4]. ALL\n";
	echo " [0]. home\n";

	$pilih = trim(fgets(STDIN));
	if ( $pilih == "0" )
	  {

		home();
		}

	};




function claim() {
	system('clear');
	echo " [1]. jabodetabek\n";
	echo " [2]. Medan\n";
	echo " [3]. Surabaya\n";
	echo " [4]. ALL\n";
	echo " [0]. home\n";

	$pilih = trim(fgets(STDIN));
	if ( $pilih == "0" )
	  {

		home();
		}
	}


	function cek() {


		}


		function NIKKK() {
	system('clear');
	echo " [1]. generate ( buat NIK & KK)\n";
	echo " [2]. cek (NIK & KK)\n";
	echo " [0]. home\n";





	$pilih = trim(fgets(STDIN));
	if ( $pilih == "1" )
	  {

		generate();
		} else {
			if ($pilih == "2" )
			   {


				} else {
					if ( $pilih == "0" )
					    {
						home();
						}


					}



			}





	};





		function generatekk() {


			}

?>
