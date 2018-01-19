import { Position } from "./position";
import { City } from "./city";
import { Comment } from "./Comment";
import { Imagen } from "./Imagen";
import { SubCategory } from "./subCategory";

export class Service {
  id: number;
  title: string;
  icon: string | any;
  description: string;
  subtitle: string;
  phone: string;
  address: string;
  other_phone: string;
  email: string;
  url: string;
  week_days: string;
  start_time: string;
  end_time: string;
  visits	:number;
  author	:any;
  positionsList	: Position[];
  citiesList:City[];
  subcategoriesList:SubCategory[];
  globalrate:number;
  servicecommentsList:Comment[];
  imagesList	:Imagen[];
  visited:number;
  contacted:number;
  complain:string;
  favorite:number;
  rated:number;
}
