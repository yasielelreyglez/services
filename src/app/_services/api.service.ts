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


    // Metodo utilizado para poder utilizar el proxy en desarrollo y el baseURI en producción
    getBaseURL() {
        if (document.baseURI === 'http://localhost:4200/')
            return 'services/';
        return '';
    }

    topSubcategories(): Observable<Subcategory[]> {
        return this.http.get(this.getBaseURL() + 'api/topsubcategories').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Subcategory[0];
            }
        });
    }

    moreVisits(): Observable<Subcategory[]> {
        return this.http.get(this.getBaseURL() + 'api/morevisits').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    recentVisits(): Observable<Subcategory[]> {
        return this.http.get(this.getBaseURL() + 'api/recentvisits').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    categoriesLoaded(): Observable<Subcategory[]> {
        return this.http.get(this.getBaseURL() + 'api/categoriesloaded').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    cities(): Observable<City[]> {
        return this.http.get(this.getBaseURL() + 'api/cities').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Subcategory[0];
            }
        });
    }

    categories(): Observable<any> {
        return this.http.get(this.getBaseURL() + 'api/categories').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    allPositions(): Observable<any> {
        return this.http.get(this.getBaseURL() + 'api/allpositions').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    mvPositions(): Observable<any> {
        return this.http.get(this.getBaseURL() + 'api/mvpositions').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }

    filter(cities?: any, categories?: any, distance?: number, current?: any): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        return this.http.post(this.getBaseURL() + 'api/filter', {
            cities,
            categories,
            distance,
            current
        },{headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
            if (response['services']) {
                return response['services'];
            } else {
                return new Array();
            }
        });
    }

    allSubCategories(): Observable<any> {
        return this.http.get(this.getBaseURL() + 'api/allsubcategories').map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }
    mensajes(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        return this.http.get(this.getBaseURL() + 'api/mensajes',{headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
            if (response['data'])
                return response['data'];
            else {
                return new Array();
            }
        });
    }


    subCategories(id: number): Observable<Subcategory[]> {
        return this.http.get(this.getBaseURL() + 'api/subcategories/' + id).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/servicessub/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data'])
                    return response['data'];
                else {
                    return new Array();
                }
            });
        } else {
            return this.http.get(this.getBaseURL() + 'api/servicessub/' + id).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/myfavorites', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/myservices', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/myvisits', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/service/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
                if (response['data']) {
                    return response;
                } else {
                    return new Array();
                }
            });
        }
        else {
            return this.http.get(this.getBaseURL() + 'api/service/' + id).map((response) => {
                if (response['data'])
                    return response;
                else {
                    return new Array();
                }
            });
        }
    }

    markfavorite(id: number): Observable<Subcategory[]> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.get(this.getBaseURL() + 'api/markfavorite/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/hidecomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/showcomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/reportcomment/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/deleteservice/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/dismarkfavorite/' + id, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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

    rateService(id: number, rate: number, comment: string): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.post(this.getBaseURL() + 'api/rateservice/' + id + '/' + rate, { comment }, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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

    reportService(report: any): Observable<any> {
        console.log('en la api', report);
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            return this.http.post(this.getBaseURL() + 'api/complaint/' + report.id, {complaint: report.complaint}, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.post(this.getBaseURL() + 'api/addcomment/' + id, {comment}, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.post(this.getBaseURL() + 'api/payservice/' + id, body, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
            return this.http.get(this.getBaseURL() + 'api/memberships', {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map((response) => {
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
    //         return this.http.post(this.getBaseURL() + 'api/createservicestep1', service, {headers: headers}).map(response => response.json()).map(result => {
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
        return this.http.get(this.getBaseURL() + 'api/searchservice/' + query).map(response => {
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
    //         return this.http.post(this.getBaseURL() + 'api/createservicestep2', service, {headers: headers}).map(response => response.json()).map(result => {
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
            return this.http.post(this.getBaseURL() + 'api/createservicefull', service, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)}).map(response => {
                return response;
            });
        } else {
            return new Observable();
        }
    }

}
