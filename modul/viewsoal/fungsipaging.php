<?php
include 'include/connection.php'; //koneksi ke mysql;
/** Fungsi Paging
tabel : tabel yang akan diquery;
dataPerPage : batas data yang akan di tampilkan misal 10 data;
noPage : halaman data 1,2,3 dst;
link : link utama misal index.php?;
**/

function paging($tabel, $dataPerPage, $noPage, $link)
{

	 $query = "SELECT COUNT(*) AS jumData FROM soal";
    $hasil = mysql_query($query);
    $data = mysql_fetch_array($hasil);
    $jumData = $data['jumData'];
    if($dataPerPage==1){
        $dataPerPage=$jumData;
    }
    $jumPage = ceil($jumData / $dataPerPage);
	$showPage = 0;
    // menampilkan link previous

    if ($noPage > 1)
        echo "<a href='" . $link . "hal=" . ($noPage - 1) ."'>&lt;&lt; Prev</a>";

    // memunculkan nomor halaman dan linknya

    for ($page = 1; $page <= $jumPage; $page++)
    {
        if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
        {
            if (($showPage == 1) && ($page != 2))
                echo "...";
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                echo "...";
            if ($page == $noPage)
                echo " <b>" . $page . "</b> ";
            else
                echo " <a href='" . $link . "hal=" . $page . "'>" . $page . "</a> ";
            $showPage = $page;
        }
    }

    // menampilkan link next

    if ($noPage < $jumPage)
        echo "<a href='" . $link . "hal=" . ($noPage + 1) . "'>Next &gt;&gt;</a>";

}

?>
