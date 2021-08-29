<?php  

  function ambil_cost(){
    $kota_asal = $_POST['kota_asal'];
    $kota_tujuan = $_POST['kota_tujuan'];
    $berat = $_POST['berat'];
    $kurir = $_POST['kurir'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir,
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: a7635953c63f9c02fe291a94939e5c8b"
      ),
    ));

    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result,true);

  }

  $result = ambil_cost();

  $kota_asal = $result['rajaongkir']['origin_details']['city_name'];
  $provinsi_asal = $result['rajaongkir']['origin_details']['province'];
  $kota_tujuan = $result['rajaongkir']['destination_details']['city_name'];
  $provinsi_tujuan = $result['rajaongkir']['destination_details']['province'];
  $berat = $result['rajaongkir']['query']['weight'];
  $kurir = $result['rajaongkir']['results'][0]['name'];

  $nama_paket = [];
  $biaya_paket = [];

  foreach($result['rajaongkir']['results'][0]['costs'] as $paket){
    $biaya_paket[] = $paket['cost'][0]['value'];
    $nama_paket[] = $paket['service'];
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Shipping Rate Calculator</title>
  </head>
  <body style="background-color: #DED6D6;">

  <!-- Tabel Hasil Ongkir -->
  <section class="tabelOngkir mt-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          
          <a href="index.php" class="btn btn-warning"> Kembali</a>

          <table class="table table-bordered mt-2">
            <thead bgcolor="orange">
              <tr>
                <th>Kota Asal</th>
                <th>Provinsi</th>
                <th>Kota Tujuan</th>
                <th>Provinsi</th>
                <th>Kurir</th>
                <th>Berat</th>
              </tr>
            </thead>
            <tbody bgcolor="white">
              <tr>
                <td><?php echo $kota_asal; ?></td>
                <td><?php echo $provinsi_asal; ?></td>
                <td><?php echo $kota_tujuan; ?></td>
                <td><?php echo $provinsi_tujuan; ?></td>
                <td><?php echo $kurir; ?></td>
                <td><?php echo $berat.' gram'; ?></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          
          <p>Paket Yang Tersedia : </p>
          <table class="table mt-2">
            
            
              
              <tr bgcolor="orange">
                <td>Nama Paket</td>
                <td>Biaya</td>
              </tr>

            <?php foreach(array_combine($nama_paket,$biaya_paket) as $np => $bp) : ?>

              <tr bgcolor="white">
                <td><?php echo $np; ?></td>
                <td><?php echo 'Rp '.number_format($bp); ?></td>
              </tr>

            <?php endforeach; ?>

          </table>

        </div>
      </div>

    </div>
  </section>
  <!-- Penutup Tabel Hasil Ongkir -->
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>