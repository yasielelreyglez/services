import { Imagen } from "./Imagen";


export class sendGalery{
  id?:any;
  title?:any;
  filename:string;
  filetype:string;
  value	:string;

}
export class getHorarios{
  end_time: string;
  start_time: string;
  week_days: number[];
}
export class sendPositions{
  title: string;
  latitude: any;
  longitude: any;
}
export class sendService {
  id?: number;
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
  subcategoriesList: any[];
  timesList: any[];
  whatsapp:boolean;
}

