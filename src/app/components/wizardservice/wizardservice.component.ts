import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Service} from '../../_models/service';
import {City} from '../../_models/city';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';


@Component({
    selector: 'app-wizardservice',
    templateUrl: './wizardservice.component.html',
    styleUrls: ['./wizardservice.component.css']
})

export class WizardserviceComponent implements OnInit {

    // step_title: string;
    previews: any;
    previewvalue: string;
    service: Service;
    moreImage: boolean;
    positiontitle: string;
    cities: City[];
    categories: any;
    latitude: string;
    longitude: string;
    positions: any;

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


    constructor(private apiServices: ApiService, private router: Router) {
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
        this.positions = new Array();
        this.previewvalue = '../../../assets/service_img.png';
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
            address: new FormControl('', [Validators.required]),
            phone: new FormControl('', [Validators.required]),
            description: new FormControl('', [Validators.required]),
            cities: new FormControl('', [Validators.required]),
            categories: new FormControl('', [Validators.required]),
        });
    }

    getErrorMessage() {
        return this.firstForm.controls['title'].hasError('required') ? 'You must enter a value' :
            this.firstForm.controls['subtitle'].hasError('required') ? 'You must enter a value' :
                this.firstForm.controls['address'].hasError('required') ? 'You must enter a value' :
                    this.firstForm.controls['phone'].hasError('required') ? 'You must enter a value' :
                        this.firstForm.controls['description'].hasError('required') ? 'You must enter a value' :
                            this.firstForm.controls['cities'].hasError('required') ? 'You must enter a value' :
                                this.firstForm.controls['categories'].hasError('required') ? 'You must enter a value' :
                                    '';
    }


    addPosition() {
        this.positions.push({
            title: this.positiontitle,
            longitude: this.longitude,
            latitude: this.latitude
        });
        this.positiontitle = '';
        this.longitude = '';
        this.latitude = '';
    }

    deletePosition(pos: number) {
        this.positions.splice(pos, 1);
    }

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
    }


    finishFunction() {
        if (this.previews.length > 0) {
            for (let i = 0; i < 9; i++) {
                const current = this.previews[i];
                if (current.position) {
                    this.service.galery.push({
                        filename: current.filename,
                        filetype: current.filetype,
                        value: current.value
                    });
                }
            }
        }

        if (this.positions.length > 0) {
            for (let i = 0; i < this.positions.length; i++) {
                const current = this.positions[i];

                this.service.positions.push({
                    title: current.title,
                    longitude: current.longitude,
                    latitude: current.latitude
                });
            }
        }

        this.apiServices.createFullService(this.service).subscribe(result => {
            if (result)
                this.router.navigate(['myservices/service', result.id]);
        });
    }


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

}
