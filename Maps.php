<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Google Maps</title>
  <style>
  </style>
  <link rel="stylesheet" href="includes/bootstrap.min.css">
  <link rel="stylesheet" href="includes/c.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div id="map" class="col-lg-9 col-xs-12 an">
      </div>
      
      
       
      <div class="photo-wrapper col-lg-3 col-md-12 col-xs-12">
        <div id="LogIn" class="LogIn">
          <?php if(!isset($_SESSION['user_id'])){ ?>
          <div class="Espacio">
            <form action="login.php" method="POST">
          <div class="row plusmrg ">
            <div class="col" >
                <h2 style="color: white">Log In</h2>
            </div>
          </div>
          <div class="row plusmrg">
            <div class="col">
              <input type="text" class="form-control" name="NoControl" placeholder="No. Control"/>
            </div>
          </div>
            <div class="row plusmrg">
              <div class="col">
                <input type="password" class="form-control" name="Contraseña" placeholder="Contraseña"/>
              </div>
            </div>
            <div class="row plusmrg">
                <div class="col">
                  <input type="submit" name="submit" class="btn btn-primary" id="BtnLogIn" value="Log In"/>
                </div>
              </div>
            </form>
            </div>
            <div class="col-xs-3">
            <button class="registrar btn btn-warning Espacio1" onclick="Registrar()">Registrarse</button>
          </div>
              <?php }else{ ?>
          <div class="col-xs-3">
            <button class="btn btn-primary Espacio " onclick="Chofer()">Chofer</button>
          </div>
          <div class="col-xs-3">
            <button class="btn btn-success Espacio1 " onclick="Pasajero()">Pasajero</button>
          </div>
          <?php } ?>
          
        </div>

        <div id="Registrar" class="DivRegistrar row">
          <div class="col" id="Chof" onclick="CambiaAChofer()">
            <label class="label info    ">Chofer</label>
          </div>
          <div class="col" id="Pasa" onclick="CambiaAPasajero()">
            <label class="label success">Pasajero</label>
          </div>
        </div>
        <div id="FormChofer" class="FormChofer">
          <form action="registrar.php" method="POST">
            <div class="row plusmrg">
              <div class="col">
                <label>No. de Control:</label>
              </div>
              <div class="col">
                <input type="text" name="Control" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Marca de Carro:</label>
              </div>
              <div class="col">
                <input type="text" name="Carro" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Modelo de Carro:</label>
              </div>
              <div class="col">
                <input type="text" name="Mod" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Año del Carro:</label>
              </div>
              <div class="col">
                <input type="text" name="Year" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Color:</label>
              </div>
              <div class="col">
                <input type="text" name="Color" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Placas:</label>
              </div>
              <div class="col">
                <input type="text" name="Placas" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Contraseña:</label>
              </div>
              <div class="col">
                <input type="text" name="Pass" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <input type="submit" name="submit" value="Registrar" class="btn btn-primary" id="RegistrarChofer">
              </div>
              <div class="col">
                <input type="button" value="Regresar" class="btn btn-warning" onclick="Regresar()">
              </div>
            </div>
          </form>
        </div>
        <div id="FormPasajero" class="FormPasajero">
          <form action="registrarA.php" method="POST">
            <div class="row plusmrg">
              <div class="col">
                <label>No. de Control:</label>
              </div>
              <div class="col">
                <input type="text" name="Control" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <label>Contraseña:</label>
              </div>
              <div class="col">
                <input type="text" name="Pass" class="form-control">
              </div>
            </div>
            <div class="row plusmrg">
              <div class="col">
                <input type="submit" name="submit" value="Registrar" class="btn btn-primary" id="RegistrarChofer">
              </div>
              <div class="col">
                <input type="button" value="Regresar" class="btn btn-warning" onclick="Regresar()">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyB_6GRlbqkiAOlsix24WI0wbIR9xtn7T40",
      authDomain: "meto-c96ac.firebaseapp.com",
      databaseURL: "https://meto-c96ac.firebaseio.com",
      projectId: "meto-c96ac",
      storageBucket: "meto-c96ac.appspot.com",
      messagingSenderId: "817694075465"
    };
    firebase.initializeApp(config);
  </script>
    
     

  <script type="text/javascript">

    var firebase = new Firebase('https://meto-c96ac.firebaseio.com/');
    var pasajero = false;
    var chofer = false;
    function initMap() {
      var directionsDisplay = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;

      var location = { lat: 31.720474, lng: -106.423584 };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 18,
        center: location
      });
      

      //Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var location = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          infoWindow.setPosition(location);
          infoWindow.setContent('Aquí Estas :D');
          map.setCenter(location);

        }, function () {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }

      var infoWindow = new google.maps.InfoWindow({ map: map });
       

      
      directionsDisplay.setMap(map);

      //calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng);
      /*document.getElementById('mode').addEventListener('change', function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng);
      });*/

    }

    function Pasajero(){
      pasajero = true;
      chofer = false;
      
      ShowPasajero();
    }
    function Chofer(){
      chofer = true;
      pasajero = false;
      ShowChofer();
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    }

    function ShowChofer(){
       var directionsDisplay = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;
      //Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          infoWindow.setPosition(pos);
          firebase.database().ref("Cofer").push(pos);
          calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng);
          map.setCenter(pos);
        }, function () {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }
       var location = { lat: 31.718760, lng: -106.422446 };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 18,
        center: location
      });
     
          

         
           ref = firebase.database().ref("Ubicaciones").once('value',function(snap){

            datos = snap.val();
            for(k in datos){
              fila = datos[k];

              pos = {lat: parseFloat(fila.lat), lng: parseFloat(fila.lng)};
              marker = new google.maps.Marker({
                position: pos,
                map: map
              });
            }

          });
        
        
    


      var infoWindow = new google.maps.InfoWindow({ map: map });

      
      directionsDisplay.setMap(map);
    }

    function ShowPasajero(){
       var directionsDisplay = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;
      //Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          infoWindow.setPosition(pos);
          infoWindow.setContent('Aquí Estas :D');
          map.setCenter(pos);
        }, function () {
          handleLocationError(true, infoWindow, map.getCenter());
        });
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }
       var location = { lat: 31.718760, lng: -106.422446 };
      var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 18,
        center: location
      });
      if(pasajero){
      map.addListener('click', function(e) {
          data = {};
          data.lat = e.latLng.lat();
          data.lng = e.latLng.lng();
          firebase.database().ref("Ubicaciones").push(data);

         
           ref = firebase.database().ref("Ubicaciones").once('value',function(snap){

            datos = snap.val();
            for(k in datos){
              fila = datos[k];

              pos = {lat: parseFloat(fila.lat), lng: parseFloat(fila.lng)};
              marker = new google.maps.Marker({
                position: pos,
                map: map
              });
            }

          });
         });
        
    }
     ref = firebase.database().ref("Cofer").once('value',function(snap){
      datos = snap.val();
            for(k in datos){
              fila = datos[k];
            calculateAndDisplayRoute(directionsService, directionsDisplay, parseFloat(fila.lat), parseFloat(fila.lng));
          }
           // 

          });


      var infoWindow = new google.maps.InfoWindow({ map: map });

      
      directionsDisplay.setMap(map);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay, lat, lng) {

   
      //var selectedMode = document.getElementById('mode').value;
      directionsService.route({
        origin: { lat: lat, lng: lng },  // Haight.
        destination: { lat: 31.718760, lng: -106.422446 },  // Ocean Beach.
        // Note that Javascript allows us to access the constant
        // using square brackets and a string value as its
        // "property."
        travelMode: google.maps.TravelMode.DRIVING
      }, function (response, status) {
        if (status == 'OK') {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    }
  </script>

      
    </script>













  <script type="text/javascript">
    function CambiaAChofer() {
      var x = document.getElementById('FormChofer')
      var y = document.getElementById('FormPasajero')
      var z = document.getElementById('Chof')
      var w = document.getElementById('Pasa')
      z.className = 'col selected'
      w.classList = 'col'
      x.style.display = 'Block'
      y.style.display = 'None'
    }
    function CambiaAPasajero() {
      var x = document.getElementById('FormChofer')
      var y = document.getElementById('FormPasajero')
      var z = document.getElementById('Chof')
      var w = document.getElementById('Pasa')
      w.className = 'col selected'
      z.classList = 'col'
      x.style.display = 'None'
      y.style.display = 'Block'
    }

    function Registrar(){
     document.getElementById('LogIn').style.display = "none";
     document.getElementById('Registrar').style.display = "-webkit-box";
    }
    function Regresar(){
     document.getElementById('FormChofer').style.display = "none";
     document.getElementById('FormPasajero').style.display = "none";
     document.getElementById('LogIn').style.display = "block";
     document.getElementById('Registrar').style.display = "none";
     var z = document.getElementById('Chof')
     var w = document.getElementById('Pasa')
     w.className = 'col'
     z.classList = 'col'
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXuqrWX0g1JOz20c2mFeazEUcyvPbir9w&callback=initMap"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>