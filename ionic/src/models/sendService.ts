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
  description: string;
  categories:number[];
  cities:number[];
  gallery:sendGalery[];
  positions:sendPositions[];
  icon:sendGalery;
  other_phone: any;
  email: string;
  url: string;
  times: any;
  // start_time: string;
  // end_time: string;
  // week_days:any;
  dropsImages: any[];
  imagesList	:Imagen[];
}

