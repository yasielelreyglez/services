import {Injectable} from '@angular/core';
import {Http, Headers} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import {Subcategory} from '../_models/subcategory';
import {City} from '../_models/city';
import {Service} from '../_models/service';


@Injectable()
export class ApiService {

    constructor(private http: Http) {
    }

    topSubcategories(): Observable<Subcategory[]> {
        return this.http.get('services/api/topsubcategories').map((response) => {
            if (response.json().count > 0)
                return response.json().data;
            else {
                return new Subcategory[0];
            }
        });
    }

    cities(): Observable<City[]> {
        return this.http.get('services/api/cities').map((response) => {
            if (response)
                return response.json().data;
            else {
                return new Subcategory[0];
            }
        });
    }

    categories(): Observable<any> {
        return this.http.get('services/api/categories').map((response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    allSubCategories(): Observable<any> {
        return this.http.get('services/api/allsubcateogries').map((response) => {
            if (response.json().data)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    subCategories(id: number): Observable<Subcategory[]> {
        return this.http.get('services/api/subcategories/' + id).map((response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    servicesSub(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/servicessub/' + id, {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        } else {
            return this.http.get('services/api/servicessub/' + id).map((response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    myfavorites(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/myfavorites', {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/myservices', {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/myvisits', {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);

            return this.http.get('services/api/service/' + id, {headers: headers}).map((response) => {
                if (response) {
                    return response.json();
                } else {
                    return new Array();
                }
            });
        }
        else {
            return this.http.get('services/api/service/' + id).map((response) => {
                if (response)
                    return response.json();
                else {
                    return new Array();
                }
            });
        }
    }

    markfavorite(id: number): Observable<Subcategory[]> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/markfavorite/' + id, {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/hidecomment/' + id, {headers: headers}).map((response) => {
                if (response) {
                    return response.json();
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/showcomment/' + id, {headers: headers}).map((response) => {
                if (response) {
                    return response.json();
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/reportcomment/' + id, {headers: headers}).map((response) => {
                if (response) {
                    return response.json();
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/deleteservice/' + id, {headers: headers}).map((response) => {
                if (response) {
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/dismarkfavorite/' + id, {headers: headers}).map((response) => {
                if (response)
                    return response.json().data;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/rateservice/' + id + '/' + rate, {headers: headers}).map((response) => {
                if (response)
                    return response.json();
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/complaint/' + report.id + '?complaint=' + report.report, {headers: headers}).map((response) => {
                console.log(response);
                if (!response.json().error) {
                        return true;
                    } else {
                        return response.json().error;
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.post('services/api/addcomment/' + id, {comment}, {headers: headers}).map((response) => {
                    if (response) {
                        return response.json().data;
                    } else {
                        return {error: response.json().error};
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.post('services/api/payservice/' + id, body, {headers: headers}).map((response) => {
                    if (response) {
                        return response.json().data;
                    } else {
                        return {error: response.json().error};
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('services/api/memberships', {headers: headers}).map((response) => {
                    if (response.json().data) {
                        return response.json().data;
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
    //         headers.append('Authorization', JSON.parse(currentUser).token);
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
            if (response)
                return response.json().data;
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
    //         headers.append('Authorization', JSON.parse(currentUser).token);
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
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.post('services/api/createservicefull', service, {headers: headers}).map(response => {
                return response.json();
            });
        } else {
            return new Observable();
        }
    }


}
