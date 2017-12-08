import {Injectable} from '@angular/core';
import {Http, Response, Headers} from '@angular/http';
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
        return this.http.get('http://localhost/services/api/topsubcategories').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Subcategory[0];
            }
        });
    }

    cities(): Observable<City[]> {
        return this.http.get('http://localhost/services/api/cities').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Subcategory[0];
            }
        });
    }

    categories(): Observable<any> {
        return this.http.get('http://localhost/services/api/categories').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    allSubCategories(): Observable<any> {
        return this.http.get('http://localhost/services/api/allsubcateogries').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    subCategories(id: number): Observable<Subcategory[]> {
        return this.http.get('http://localhost/services/api/subcategories/' + id).map((response: Response) => {
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
            return this.http.get('http://localhost/services/api/servicessub/' + id, {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        } else {
            return this.http.get('http://localhost/services/api/servicessub/' + id).map((response: Response) => {
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
            return this.http.get('http://localhost/services/api/myfavorites', {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    myServices(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/myservices', {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    mySearchs(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/myvisits', {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    service(id: string): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);

            return this.http.get('http://localhost/services/api/service/' + id, {headers: headers}).map((response: Response) => {
                if (response) {
                    return response.json();
                } else {
                    return new Array();
                }
            });
        }
        else {
            return this.http.get('http://localhost/services/api/service/' + id).map((response: Response) => {
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
            return this.http.get('http://localhost/services/api/markfavorite/' + id, {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    hideComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/hidecomment/' + id, {headers: headers}).map((response: Response) => {
                if (response) {
                    return response.json();
                } else {
                    return new Array();
                }
            });
        }
    }

    showComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/showcomment/' + id, {headers: headers}).map((response: Response) => {
                if (response) {
                    return response.json();
                } else {
                    return new Array();
                }
            });
        }
    }

    reportComment(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/reportcomment/' + id, {headers: headers}).map((response: Response) => {
                if (response) {
                    return response.json();
                } else {
                    return new Array();
                }
            });
        }
    }

    deleteService(id: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/deleteservice/' + id, {headers: headers}).map((response: Response) => {
                if (response) {
                    return response.json().data;
                } else {
                    return new Array();
                }
            });
        }
    }

    disMarkfavorite(id: number): Observable<Subcategory[]> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/dismarkfavorite/' + id, {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    rateService(id: number, rate: number): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/rateservice/' + id + '/' + rate, {headers: headers}).map((response: Response) => {
                if (response)
                    return response.json().data;
                else {
                    return new Array();
                }
            });
        }
    }

    report(report: any): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/complaint/' + report.id + '?complaint=' + report.report, {headers: headers}).map((response: Response) => {
                    if (response.json().result === true) {
                        return true;
                    } else {
                        return {error: response.json().result};
                    }
                }
            );
        }
    }

    addComment(id: number, comment: string): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.post('http://localhost/services/api/addcomment/' + id, {comment}, {headers: headers}).map((response: Response) => {
                    if (response) {
                        return response.json().data;
                    } else {
                        return {error: response.json().error};
                    }
                }
            );
        }
    }

    payService(id: number, body: any): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.post('http://localhost/services/api/payservice/' + id, body, {headers: headers}).map((response: Response) => {
                    if (response) {
                        return response.json().data;
                    } else {
                        return {error: response.json().error};
                    }
                }
            );
        }
    }

    memberships(): Observable<any> {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            const headers = new Headers();
            headers.append('Authorization', JSON.parse(currentUser).token);
            return this.http.get('http://localhost/services/api/memberships', {headers: headers}).map((response: Response) => {
                    if (response.json().data) {
                        return response.json().data;
                    } else {
                        return {error: 'Error en el servidor'};
                    }
                }
            );
        }
    }

    // createService(service: Service): Observable<any> {
    //     // const body = JSON.stringify(service);
    //     const currentUser = localStorage.getItem('currentUser');
    //     if (currentUser) {
    //         const headers = new Headers();
    //         headers.append('Authorization', JSON.parse(currentUser).token);
    //         console.log(service);
    //         return this.http.post('http://localhost/services/api/createservicestep1', service, {headers: headers}).map(response => response.json()).map(result => {
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
        return this.http.get('http://localhost/services/api/searchservice/' + query).map(response => {
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
    //         return this.http.post('http://localhost/services/api/createservicestep2', service, {headers: headers}).map(response => response.json()).map(result => {
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
            return this.http.post('http://localhost/services/api/createservicefull', service, {headers: headers}).map(response => {
                return response.json();
            });
        } else {
            return new Observable();
        }
    }


}
