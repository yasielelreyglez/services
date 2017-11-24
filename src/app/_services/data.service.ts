import {Injectable} from '@angular/core';
import {BehaviorSubject} from 'rxjs/BehaviorSubject';

@Injectable()
export class Data {

    public storage: any;
    services: BehaviorSubject<any> = new BehaviorSubject(null);

    constructor() {
    }

}
