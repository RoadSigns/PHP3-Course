<?php

include 'classes/PostCodeLookup.php';
include 'dumpr.php';

$apiKey = "AIzaSyA4SOZT0OP7XS6w47rgcFYHOf8NyoBmz0o";

$postCode = new PostCodeLookup();

dumpr($postCode);
?>

<form name="" action="" method="post">
    
    <table class='table table-bordered'>
        <tr>
            <th>Post code:</th>
            <td>
                <input name="postcode" type="text" value='<?= '' ?>' placeholder="CF10 8LY" class='form-control' required />
            </td>
            <td>
                <select name='type' class='form-control'>
                    <option <?= $postCode->type == 'JSON' ? 'selected' : '' ?>>JSON</option>
                    <option <?= $postCode->type == 'XML'  ? 'selected' : '' ?>>XML</option>
                </select>
            </td>
            <td>
                <button class='btn btn-primary btn-lg'>Go</button>
                
            </td>
        </tr>
    </table>
    
    <p><a href="<?= $_SERVER['PHP_SELF'] ?>" class='btn btn-primary btn-sm'>Reset</a></p>
    
</form>

<?php if($postCode->Object->postcode) { ?>

    <div id="map" style="height: 400px; width: 400px;"></div>

    <script>

        function initMap() {

            var myLatLng = {lat: <?= $postCode->Object->lat ?>, lng: <?= $postCode->Object->lng ?>};

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: <?= $postCode->Object->lat ?>, lng: <?= $postCode->Object->lng ?>},
                zoom: 16
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });

            var infowindow = new google.maps.InfoWindow({
              content: '<?= $postCode->Object->address ?>'
            });
            
            //marker.addListener('click', function() {
              infowindow.open(map, marker);
            //});

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKey ?>&callback=initMap" async defer></script>

<?php } ?>

    
    
    
