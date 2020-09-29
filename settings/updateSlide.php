<?php
  include("../scripts/db_connection.php"); 
  
  if(isset($_POST["slide_id"])) {

    $judul = mysqli_real_escape_string($conn, $_POST["judul"]); 
    $isi1 = mysqli_real_escape_string($conn, $_POST["isi1"]); 
    $isi2 = mysqli_real_escape_string($conn, $_POST["isi2"]); 
    $isi3 = mysqli_real_escape_string($conn, $_POST["isi3"]); 
    $isi4 = mysqli_real_escape_string($conn, $_POST["isi4"]);
    $slide_status = mysqli_real_escape_string($conn, $_POST["slide_status"]); 

    if($_POST["slide_id"] != '') {
                           
      if(!empty($_POST["checkBoxValue"])) { 

        $foto = $_FILES['foto']['name']; 
        $size   = $_FILES['foto']['size'];
        $location = "../assets/images/".$foto;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png");

        $sql = "
                UPDATE slides SET
                judul = '$judul',isi1 = '$isi1',isi2 = '$isi2',
                isi3 = '$isi3',isi4 = '$isi4',
                foto = '$foto',slide_status = '$slide_status'
                WHERE slide_id = '".$_POST['slide_id']."'
            ";

        move_uploaded_file($_FILES['foto']['tmp_name'],$location);

      } else {
        
        $sql = "
                UPDATE slides SET
                judul = '$judul',isi1 = '$isi1',isi2 = '$isi2',
                isi3 = '$isi3',isi4 = '$isi4',
                slide_status = '$slide_status'
                WHERE slide_id = '".$_POST['slide_id']."'
            ";
        
      }      

    }
    //--Query penyimpanan data ke database--//
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Data berhasil disimpan.');</script>";                   
    } else {
      echo "<script>alert('Terjadi kegagalan dalam penyimpanan data : " . $conn->error . ". Cek koneksi database.)";
    }   
  }  
    
  //--Load Table--//
  include('view_slides.php');    

?>