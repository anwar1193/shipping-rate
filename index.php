<?php  

function ambil_kota(){
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "key: a7635953c63f9c02fe291a94939e5c8b"
    ),
  ));

  $result = curl_exec($curl);
  curl_close($curl);
  return json_decode($result,true);
}

$result = ambil_kota();

$kota = [];
$kotaId = [];
foreach($result['rajaongkir']['results'] as $kotaa){
  $kota[] = $kotaa['city_name'];
  $kotaId[] = $kotaa['city_id'];
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
  <body style="background-color: #A29F9F;">

    <!-- Form Shipping Rate -->
    <section class="shipping mt-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 offset-sm-2">

            <div class="card">

              <div class="card-header">
                Shipping Rate Calculator
              </div>

              <div class="card-body">
                <form method="post" action="hasil_ongkir.php">

                  <div class="form-group">
                    <label>Kota Asal</label>
                    <select class="form-control form-control-sm" name="kota_asal" required="">
                      <option value="">-Pilih Kota-</option>
                      <?php foreach(array_combine($kota,$kotaId) as $city => $cityId) : ?>
                      <option value="<?php echo $cityId; ?>"><?php echo $city; ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kota Tujuan</label>
                    <select class="form-control form-control-sm" name="kota_tujuan" required="">
                      <option value="">-Pilih Kota-</option>
                      <?php foreach(array_combine($kota, $kotaId) as $city=> $cityId) : ?>
                      <option value="<?php echo $cityId; ?>"><?php echo $city; ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Berat (Dalam Gram)</label>
                    <input type="text" class="form-control form-control-sm" name="berat" placeholder="Masukan Berat" required="">
                  </div>

                  <div class="form-group">
                    <label>Kurir</label>
                    <select name="kurir" class="form-control form-control-sm" required="">
                      <option value="">-Pilih Kurir-</option>
                      <option value="jne">JNE</option>
                      <option value="tiki">TIKI</option>
                      <option value="pos">POS</option>
                    </select>
                  </div>   


                  <button type="submit" class="btn btn-success btn-sm">Cek Ongkir</button>
                
                </form>
              </div>

            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- Form Shipping Rate -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>