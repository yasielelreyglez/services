import { Imagen } from "./Imagen";


export class sendGalery{
  id?:any;
  title?:any;
  filename:string;
  filetype:string;
  value	:string;

}
export class sendPositions{
  title: string;
  latitude: any;
  longitude: any;
}
export class sendService {
  title	: string;
  subtitle: string;
  address: string;
  phone: string;
  email: string;
  url: string;
  description: string;
  // start_time: string;
  // end_time: string;
  other_phone: any;
  times: any;
  gallery:sendGalery[];
  positions:sendPositions[];
  // week_days:any;
  cities:number[];
  dropsImages: any[];
  categories:number[];
  imagesList	:Imagen[];
  icon:sendGalery;



}

