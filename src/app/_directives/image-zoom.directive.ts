import {Directive, ElementRef, HostListener} from '@angular/core';
import {MatDialog} from '@angular/material';
import {ImageComponent} from '../components/_modals/image/image.component';

@Directive({
    selector: '[appImageZoom]'
})
export class ImageZoomDirective {

    constructor(public dialog: MatDialog, private element: ElementRef) {
        this.element.nativeElement.style.cursor = 'pointer';
    }

    @HostListener('click', ['$event'])
    onClick($event) {
        this.dialog.open(ImageComponent, {
            width: '80%',
            height: '80%',
            data: {src: this.element.nativeElement.src}
        });

    }
}
