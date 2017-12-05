import {Component, OnInit, ViewChild} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Service} from '../../_models/service';
import {City} from '../../_models/city';
// import {WizardComponent} from 'ng2-archwizard/dist';
import {FormControl, FormGroup, Validators} from '@angular/forms';


@Component({
    selector: 'app-wizardservice',
    templateUrl: './wizardservice.component.html',
    styleUrls: ['./wizardservice.component.css']
})

export class WizardserviceComponent implements OnInit {
    // @ViewChild(WizardComponent)
    // public wizards: WizardComponent;
    //
    // step_title: string;
    previews: any;
    // previews: string[][];
    previewvalue = '../../../assets/service_img.png';
    service: Service;
    moreImage: boolean;
    positiontitle: string;
    cities: City[];
    categories: any;
    currentPos = 0;
    // latitude: string;
    // longitude: string;
    //
    week_days = [
        {title: 'Lunes', value: false},
        {title: 'Martes', value: false},
        {title: 'Miercoles', value: false},
        {title: 'Jueves', value: false},
        {title: 'Viernes', value: false},
        {title: 'Sabado', value: false},
        {title: 'Domingo', value: false},
    ];

    firstForm: FormGroup;
    // secondForm: FormGroup;


    constructor(private apiServices: ApiService) {
        // this.previews = [
        //     ['../../../assets/service_img.png', '../../../assets/service_img.png', '../../../assets/service_img.png'],
        //     ['../../../assets/service_img.png', '../../../assets/service_img.png', '../../../assets/service_img.png'],
        //     ['../../../assets/service_img.png', '../../../assets/service_img.png', '../../../assets/service_img.png']
        // ];
        this.previews = [
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null},
            {position: false, src: '../../../assets/service_img.png', filename: null, filetype: null, value: null}];

        // this.step_title = 'Datos iniciales';
        this.service = new Service();
        this.moreImage = true;
        this.service.galery = new Array();
        this.service.positions = new Array();
        this.service.week_days = [false, false, false, false, false, false, false];
    }

    ngOnInit() {
        this.apiServices.cities().subscribe(result => this.cities = result);
        this.apiServices.allSubCategories().subscribe(result => this.categories = result);
        this.createForms();
    }

    createForms() {
        this.firstForm = new FormGroup({
            title: new FormControl('', [Validators.required]),
            subtitle: new FormControl('', [Validators.required]),
            address: new FormControl(''),
            phone: new FormControl(''),
            cities: new FormControl(''),
            categories: new FormControl(''),
        });

        // this.secondForm = new FormGroup({});
    }

    getErrorMessage() {
        return this.firstForm.controls['title'].hasError('required') ? 'You must enter a value' :
            this.firstForm.controls['subtitle'].hasError('required') ? 'You must enter a value' :
                '';
    }


// changeCity(city) {
//     console.log('cualquier cosa');
//     console.log(city);
// }
//
// changeCity2() {
//     console.log('cualquier cosa');
// }
//
// create() {
//     console.log('MADO A GUARDAR');
//     this.apiServices.createService(this.service).subscribe(result => this.siguiente(result));
// }
//
// step3() {
//     console.log('MADO A GUARDAR');
//     this.apiServices.createService(this.service).subscribe(result => this.siguiente(result));
// }
//
// galery() {
//     console.log('MADO A GUARDAR');
//     this.apiServices.createGalery(this.service).subscribe(result => this.siguiente(result));
// }
//
// siguiente(result) {
//     if (result.id) {
//         this.service.id = result.id;
//         this.wizards.navigation.goToNextStep();
//     } else {
//         //TODO SOLO PARA PRUEBAS QUITAR
//         this.service.id = 2;
//         this.wizards.navigation.goToNextStep();
//     }
// }
//
// addPosition() {
//     this.service.positions.push({
//         title: this.positiontitle,
//         longitude: this.longitude,
//         latitude: this.latitude
//     });
//     this.positiontitle = "";
//     this.longitude = "0";
//     this.latitude = "0";
// }
//
//
    moreImageGalery() {
        let count = 9;
        for (let i = 0; i < 9; i++) {
            const current = this.previews[i];
            if (current.position) {
                count--;
            }
        }
        if (count === 0) {
            this.moreImage = false;
        }
        else {
            this.moreImage = true;
        }
        // console.log(count);
    }

    onFotoChange(event) {
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                for (let i = 0; i < 9; i++) {
                    const current = this.previews[i];
                    if (!current.position) {
                        current.position = true;
                        current.src = reader.result;
                        current.filename = file.name;
                        current.filetype = file.type;
                        current.value = reader.result.split(',')[1];
                        break;
                    }
                }
                // console.log('Se inserto', this.previews);
                this.moreImageGalery();
            };
        }
    }

    deleteImage(pos: number) {
        this.previews[pos].position = false;
        this.previews[pos].src = '../../../assets/service_img.png';
        this.previews[pos].filename = null;
        this.previews[pos].filetype = null;
        this.previews[pos].value = null;
        this.moreImageGalery();
        // console.log('Se elimino: ', this.previews);
    }

//
//     finishFunction() {
//         for (let i = 0; i < 9; i++) {
//             const current = this.previews[i];
//             if (current.position) {
//                 this.service.galery.push({
//                     filename: current.filename,
//                     filetype: current.filetype,
//                     value: current.value
//                 });
//             }
//         }
//
//         this.apiServices.createFullService(this.service).subscribe(result => this.showService(result));
//     }

//
// showService(servic) {
//
// }
//
    onFileChange(event) {
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.service.icon = ({
                    filename: file.name,
                    filetype: file.type,
                    value: reader.result.split(',')[1]
                });
                this.previewvalue = reader.result;
            };
        }
    }

// onFileChange(event) {
//     let reader = new FileReader();
//     if(event.target.files && event.target.files.length > 0) {
//         let file = event.target.files[0];
//         reader.readAsDataURL(file);
//         reader.onload = () => {
//             this.form.get('avatar').setValue({
//                 filename: file.name,
//                 filetype: file.type,
//                 value: reader.result.split(',')[1]
//             })
//         };
//     }
// }


}
