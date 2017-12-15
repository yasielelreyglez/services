import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import {Subcategory} from '../_models/subcategory';
import {City} from '../_models/city';
import {Service} from '../_models/service';
import {HttpClient, HttpHeaders} from '@angular/common/http';


@Injectable()
export class ApiService {

    constructor(private http: HttpClient) {
    }

    // document.baseURI+'/api/createservicefull'

    topSubcategories(): Observable<Subcategory[]> {
        return this.http.get('services/api/topsubcategories').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Subcategory[0];
            }
        });
    }

    cities(): Observable<City[]> {
        return this.http.get('services/api/cities').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Subcategory[0];
            }
        });
    }

    categories(): Observable<any> {
        return this.http.get('services/api/categories').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    allSubCategories(): Observable<any> {
        return this.http.get('services/api/allsubcateogries').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    subCategories(id: number): Observable<Subcategory[]> {
        return this.http.get('services/api/subcategories/' + id).map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    servicesSub(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/servicessub/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        } else {
            return this.http.get('services/api/servicessub/' + id).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
    }

    myfavorites(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/myfavorites', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    myServices(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/myservices', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    mySearchs(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/myvisits', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    service(id: string): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/service/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data']) {
                    return response;
                } else {
                    return new Array();
                }
            });
        }
        else {
            return this.http.get('services/api/service/' + id).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
    }

    markfavorite(id: number): Observable<Subcategory[]> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/markfavorite/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    hideComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/hidecomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response) {
                    return response;
                } else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    showComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/showcomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response) {
                    return response;
                } else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    reportComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/reportcomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response) {
                    return response;
                } else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    deleteService(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/deleteservice/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data']) {
                    return response['data'];
                } else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    disMarkfavorite(id: number): Observable<Subcategory[]> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/dismarkfavorite/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    rateService(id: number, rate: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/rateservice/' + id + '/' + rate, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response)
                    return response;
                else {
                    return new Observable();
                }
            });
        }
        else {
            return new Observable();
        }
    }

    report(report: any): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/complaint/' + report.id + '?complaint=' + report.report, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                    console.log(response);
                    if (!response['error']) {
                        return true;
                    } else {
                        return response['error'];
                    }
                }
            );
        }
        else {
            return new Observable();
        }
    }

    addComment(id: number, comment: string): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.post('services/api/addcomment/' + id, {comment}, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                    if (response['data']) {
                        return response['data'];
                    } else {
                        return {error: response['error']};
                    }
                }
            );
        }
        else {
            return new Observable();
        }
    }

    payService(id: number, body: any): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.post('services/api/payservice/' + id, body, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                    if (response['data']) {
                        return response['data'];
                    } else {
                        return {error: response['error']};
                    }
                }
            );
        }
        else {
            return new Observable();
        }
    }

    memberships(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get('services/api/memberships', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                    if (response['data']) {
                        return response['data'];
                    } else {
                        return {error: 'Error en el servidor'};
                    }
                }
            );
        }
        else {
            return new Observable();
        }
    }

    // createService(service: Service): Observable<any> {
    //     // const body = JSON.stringify(service);
    //     const currentUser = localStorage.getItem('currentUser');
    //     if (currentUser) {
    //         const headers = new Headers();
    //         headers.set('Authorization', JSON.parse(currentUser).token);
    //         console.log(service);
    //         return this.http.post('services/api/createservicestep1', service, {headers: headers}).map(response => response.json()).map(result => {
    //             if (!result.error) {
    //                 return result;
    //             }
    //             return result;
    //         });
    //     } else {
    //         return new Observable();
    //     }
    // }

    searchService(query: any): Observable<any> {
        return this.http.get('services/api/searchservice/' + query).map(response => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    // createGalery(service: Service): Observable<any> {
    //     // const body = JSON.stringify(service);
    //     const currentUser = localStorage.getItem('currentUser');
    //     if (currentUser) {
    //         const headers = new Headers();
    //         headers.set('Authorization', JSON.parse(currentUser).token);
    //         console.log(service);
    //         return this.http.post('services/api/createservicestep2', service, {headers: headers}).map(response => response.json()).map(result => {
    //             if (!result.error) {
    //                 return result;
    //             }
    //             return result;
    //         });
    //     } else {
    //         return new Observable();
    //     }
    // }

    createFullService(service: Service): Observable<any> {
        // const body = JSON.stringify(service);
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.post('services/api/createservicefull', service, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map(response => {
                return response;
            });
        } else {
            return new Observable();
        }
    }

}
