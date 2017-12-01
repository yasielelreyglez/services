import {Component, ViewChild, ElementRef} from '@angular/core';
import {
  Platform,
  IonicPage,
  NavController,
  NavParams,
  ModalController
} from "ionic-angular";
import {RatePage} from "../rate/rate";
import {Geolocation} from '@ionic-native/geolocation';
import {CallNumber} from "@ionic-native/call-number";
import {ServiceProvider} from "../../providers/service/service.service";
import {AuthProvider} from "../../providers/auth/auth";
import {Positions} from "../../models/positions";
import { Events } from 'ionic-angular';

declare var google;

@IonicPage()
@Component({
  selector: 'page-mapa',
  templateUrl: 'mapa.html',
})
export class MapaPage {
  locations: Positions[] = []
  positions: Positions[] = [];
  infowindow = new google.maps.InfoWindow;
  response: any;
  latLng: any;
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  distanceM = new google.maps.DistanceMatrixService();
  // distanceMatrix = new google.maps.DistanceMatrixService;
 pepe:any;
  @ViewChild('map') mapElement: ElementRef;
  map: any;
  private service: any = {};
  private baseUrl: any;
  // latitude:any
  // longitude:any;
  loggedIn: boolean;
  currentPosition: any;

  constructor(public auth: AuthProvider, public servPro: ServiceProvider, private callNumber: CallNumber, private platform: Platform,
              public navCtrl: NavController,
              public navParams: NavParams,
              public modalCtrl: ModalController,
              private geolocation: Geolocation,public events: Events) {

    platform.ready().then(() => {
      events.subscribe('user:created', (user, time) => {
        // user and time are the same arguments passed in `events.publish(user, time)`
        console.log('Welcome', user, 'at', time);
      });

      // // get current position
      // geolocation.getCurrentPosition().then(pos => {
      //   this.currentPosition = pos;
      //   // this.longitude = pos.coords.longitude;
      //   this.latLng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
      //   this.loadMap();
      // });
      // const watch = geolocation.watchPosition().subscribe(pos => {
      //   this.currentPosition = pos;
      // });

    });
  }

  ionViewDidLoad() {


    this.response = this.navParams.get("response");
    this.service = this.response['data'];
    this.positions = this.response['positions'];
    this.baseUrl = this.navParams.get("baseUrl");

    this.geolocation.getCurrentPosition().then((resp) => {
      //agrgando los positions del servicio
      this.loadMap();

      // this.latitude=resp.coords.latitude;
      // this.longitude =resp.coords.longitude
      this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
      this.map.setCenter(this.latLng);
      this.map.setZoom(15);
      let marker = new google.maps.Marker({
        map: this.map,
        // icon: "http://localhost/login/resources/image/categories/current.png",
        position: this.latLng
      });
      let content = "<h4>Mi posición</h4>";
      this.addInfoWindow(marker, content);


      // para calcular la distancia
      //  let destino1 = new google.maps.LatLng(23.126606, -82.32528);

      var destinos = [];
      //  destinos.push(destino1);

      for (let i = 0; i < this.positions.length; i++) {
        destinos.push(new google.maps.LatLng(this.positions[i].latitude,this.positions[i].longitude));
      }
      this.distanceM.getDistanceMatrix(
        {
          origins: [this.latLng],
          destinations: destinos,
          travelMode: 'DRIVING'
        },this.showDistance(this.events));

    });

  }

  showDistance(event) {
     return function(response, status) {
      if(status == "OK"){
        event.publish('user:created', "user", Date.now());
        for (let i = 0; i < response.rows[0].elements.length; i++) {
          var el = document.getElementById('pos'+i);
          el.innerHTML = ":"+response.rows[0].elements[i].distance.text;
        }

      } else {
          alert("Error: " + status);
      }
    // }
    // let asd = [];
    // for (let i = 0; i < response.rows[0].elements.length; i++) {
    //  // this.positions[i].distance = response.rows[0].elements[i];
    //   console.log(response.rows[0].elements[i]);
    //   asd.push(response.rows[0].elements[i]);
    //  // this.prueba(asd);
    // }
    // console.log(this.positions);
  }
}

  prueba(a){
    console.log(a);

  }

  // mostrar ruta entre 2 puntos
  calculateAndDisplayRoute(p) {
    var end = new google.maps.LatLng(p.latitude, p.longitude);
    this.directionsService.route({
      origin: this.latLng,
      destination: end,
      travelMode: 'DRIVING'
    }, (response, status) => {
      console.log(status);
      if (status === 'OK') {
        this.directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

  openRate() {
    const profileModal = this.modalCtrl.create(RatePage);
    profileModal.onDidDismiss(data => {
      if (data.rate != "cancel")
        this.servPro.rateservice(this.service.id, data.rate).then(
          data => {
            console.log(data);
          });

    });

    profileModal.present();
  }

  Llamar(number) {
    this.callNumber.callNumber(number, true)
      .then(() => console.log('Launched dialer!'))
      .catch(() => console.log('Error launching dialer'));
  }

  loadMap() {
    let mapOptions = {
      center: this.latLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.directionsDisplay.setMap(this.map);
    this.directionsDisplay.setOptions({suppressMarkers: true});
    this.positions = this.response.data.positionsList;

    for (let i = 0; i < this.positions.length; i++) {
      let marker = new google.maps.Marker({
        map: this.map,
        position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude)
      });
      let content = "<h4>" + this.positions[i].title + "</h4>";
      this.addInfoWindow(marker, content);
    }
  }

  getLocation() {
    this.geolocation.getCurrentPosition().then((resp) => {
      this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
      this.map.setCenter(this.latLng);
      this.map.setZoom(15);
      let marker = new google.maps.Marker({
        map: this.map,
        position: this.latLng
      });
      let content = "<h4>Mi posición</h4>";
      this.addInfoWindow(marker, content);
    }).catch((error) => {
      console.log('Error getting location', error);
    });

  }

  addInfoWindow(marker, content) {

    google.maps.event.addListener(marker, 'click', () => {
      this.infowindow.setContent(content)
      this.infowindow.open(this.map, marker);
    });

  }

}
