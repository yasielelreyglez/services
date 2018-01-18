import { Component, ViewChild ,ElementRef  } from '@angular/core';
import { IonicPage, NavController, NavParams, Platform } from 'ionic-angular';
import { Geolocation ,GeolocationOptions ,Geoposition ,PositionError } from '@ionic-native/geolocation'
/**
 * Generated class for the TabMapaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
declare var google;
declare var Connection;
@IonicPage()
@Component({
  selector: 'page-tab-mapa',
  templateUrl: 'tab-mapa.html',
})
export class TabMapaPage {
  options : GeolocationOptions;
  currentPos : Geoposition;
  infowindow = new google.maps.InfoWindow;
  wacthed: any;
  watch:any;
  latLng: any;
  currentP: any;

  @ViewChild('map') mapElement: ElementRef;
  map: any;
  places : Array<any> ;

  constructor( platform: Platform,public navCtrl: NavController, public navParams: NavParams,private geolocation : Geolocation) {
    platform.ready().then(() => {
      this.getUserPosition();
    });
  }
  // ionViewDidEnter(){
  //   this.getUserPosition();
  // }
  addMap(lat,long){

        let latLng = new google.maps.LatLng(lat, long);

        let mapOptions = {
        center: latLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);

        this.getRestaurants(latLng).then((results : Array<any>)=>{
            this.places = results;
            for(let i = 0 ;i < results.length ; i++)
            {
                this.createMarker(results[i]);
            }
        },(status)=>console.log(status));

        this.addMarker();

    }
    addMarker(){

      this.currentP = new google.maps.Marker({
      map: this.map,
      animation: google.maps.Animation.DROP,
      position: this.map.getCenter()
      });

      let content = "<p>This is your current position !</p>";
      let infoWindow = new google.maps.InfoWindow({
      content: content
      });

      google.maps.event.addListener(this.currentP, 'click', () => {
      infoWindow.open(this.map, this.currentP);
      });

    }
    getLocation() {
      console.log("current");
      // this.geolocation.getCurrentPosition({ enableHighAccuracy : false}).then((resp) => {
        // this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
        this.map.setCenter(this.latLng);
        this.map.setZoom(15);
        this.currentP = new google.maps.Marker({
          map: this.map,
           icon: "http://www.googlemapsmarkers.com/v1/009900/",
          position: this.latLng
        });
        let content = "<h4>Mi posición</h4>";
        this.addInfoWindow(this.currentP, content);

      // });

    }
    addInfoWindow(marker, content) {

          google.maps.event.addListener(marker, 'click', () => {
            this.infowindow.setContent(content)
            this.infowindow.open(this.map, marker);
          });

        }
  getUserPosition(){

    this.options = {
      enableHighAccuracy : false
    };

    this.geolocation.getCurrentPosition(this.options).then((pos) => {
      this.latLng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
      this.addMap(pos.coords.latitude,pos.coords.longitude);
      console.log("encontro ",this.latLng);

      this.watch = this.geolocation.watchPosition({maximumAge :60000,timeout:60000})
      .filter((p) => p.coords !== undefined)
      .subscribe(position => {
        this.wacthed=true;
        console.log("CAMBIO");
         let newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
         if(!this.latLng.equals( newPosition ))
         {
           console.log("muevete");
          this.latLng = newPosition;
          this.map.setZoom(this.map.getZoom());
          this.currentP.setPosition(this.latLng);
         }
      });
    },(err : PositionError)=>{
        console.log("error : " + err.message);
    ;
  })
}
getRestaurants(latLng)
{
    var service = new google.maps.places.PlacesService(this.map);
    let request = {
        location : latLng,
        radius : 800000 ,
        types: ["restaurant"]
    };
    return new Promise((resolve,reject)=>{
        service.nearbySearch(request,function(results,status){
            if(status === google.maps.places.PlacesServiceStatus.OK)
            {
               resolve(results);
            }else
            {
                reject(status);
            }

        });
    });

}
createMarker(place)
{
    let marker = new google.maps.Marker({
    map: this.map,
    animation: google.maps.Animation.DROP,
    position: place.geometry.location
    });
}

  ionViewDidLoad() {
    console.log('ionViewDidLoad TabMapaPage');
  }

}
