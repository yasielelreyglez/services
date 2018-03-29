import {Injectable} from '@angular/core';
import {BehaviorSubject} from 'rxjs/BehaviorSubject';

@Injectable()
export class Globals {
    search: BehaviorSubject<boolean> = new BehaviorSubject(false);

    constructor() {
        this.search.next(false);
    }
}
